<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Metadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the aboutus.
     */
    public function index()
    {
        $aboutUs = AboutUs::with('metadata')->latest()->get();
        return view('admin.aboutus.index', compact('aboutUs'));
    }

    /**
     * Show the form for creating a new AboutUs.
     */
    public function create()
    {
        $metadata = Metadata::all();
        return view('admin.aboutus.create', compact('metadata'));
    }

    /**
     * Store a newly created AboutUs in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'keywords' => 'nullable|string',
            'image' => 'required|array',
            'image.*' => 'required|string', // Validate as string since it's base64
            'status' => 'required|boolean',
            'cropData' => 'required|string',
        ]);

        $cropData = json_decode($request->input('cropData'), true);
        $images = [];

        foreach ($request->input('image') as $base64Image) {
            $image = explode(',', $base64Image);
            $decodedImage = base64_decode($image[1]);
            $imageResource = imagecreatefromstring($decodedImage);

            if ($imageResource !== false) {
                $imageName = time() . '-' . Str::uuid() . '.webp';
                $destinationPath = storage_path('app/uploads/images/aboutus');

                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true, true);
                }

                $savedPath = $destinationPath . '/' . $imageName;
                imagewebp($imageResource, $savedPath);
                imagedestroy($imageResource);
                $relativeImagePath = 'uploads/images/aboutus/' . $imageName;
                $images[] = $relativeImagePath;
            }
        }

        $slug = SlugService::createSlug(Metadata::class, 'slug', $request->title);

        // Create a new metadata entry
        $metadata = Metadata::create([
            'meta_title' => $request->title,
            'meta_description' => $request->description,
            'meta_keywords' => $request->keywords,
            'slug' => Str::slug($request->title)
        ]);

        // Create new aboutus record and associate with metadata
        AboutUs::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'keywords' => $request->keywords,
            'image' => json_encode($images),
            'status' => $request->status,
            'metadata_id' => $metadata->id, // Link newly created metadata
        ]);

        session()->flash('success', 'AboutUs created successfully.');

        return redirect()->route('aboutus.index');
    }

    /**
     * Show the form for editing the specified aboutus
     */
    public function edit($id)
    {
        $aboutUs = AboutUs::findOrFail($id); 
        return view('admin.aboutus.update', compact('aboutUs'));
    }
    /**
     * Update the specified aboutus in storage.
     */
    public function update(Request $request,  $id)
    {
        // Validate the request inputs
        $aboutUs = AboutUs::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'keywords' => 'nullable|string',
            'image' => 'sometimes|array',
            'image.*' => 'required|string', // Validate each image as a base64 string
            'status' => 'required|boolean',
            'cropData' => 'sometimes|string', // Optional crop data for images
        ]);
    
        // Initialize the crop data and existing images
        $cropData = $request->input('cropData') ? json_decode($request->input('cropData'), true) : null;
        $images = !empty($aboutUs->image) ? json_decode($aboutUs->image, true) : [];
    
        // Handle new images if provided
        if ($request->has('image')) {
            foreach ($request->input('image') as $base64Image) {
                // Ensure the base64 string is valid and has a valid header
                if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                    $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
                    $decodedImage = base64_decode($base64Image);
     
                    if ($decodedImage === false) {
                        continue; // Skip invalid base64 string
                    }
    
                    $imageType = strtolower($type[1]); // jpeg, png, gif, etc.
                    if (!in_array($imageType, ['jpg', 'jpeg', 'gif', 'png', 'webp'])) {
                        continue; // Skip unsupported image types
                    }
                    // Create image resource from decoded data
                    $imageResource = imagecreatefromstring($decodedImage);
                    if ($imageResource !== false) {
                        $imageName = time() . '-' . Str::uuid() . '.webp'; // Use WebP format
                        $destinationPath = storage_path('app/uploads/images/aboutus');
    
                        // Ensure the directory exists
                        if (!File::exists($destinationPath)) {
                            File::makeDirectory($destinationPath, 0755, true, true);
                        }
    
                        // Save the image and destroy the resource
                        $savedPath = $destinationPath . '/' . $imageName;
                        imagewebp($imageResource, $savedPath);
                        imagedestroy($imageResource);
    
                        // Store the relative path
                        $relativeImagePath = 'uploads/images/aboutus/' . $imageName;
                        $images[] = $relativeImagePath;
                    }
                }
            }
        }
    
        // Update metadata record
        $aboutUs->metadata()->updateOrCreate([], [
            'meta_title' => $request->title,
            'meta_description' => $request->description,
            'meta_keywords' => $request->keywords,
            'slug' => Str::slug($request->title)
        ]);
    
        // Update aboutusrecord
        $aboutUs->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'keywords' => $request->keywords,
            'image' => json_encode($images), // Store updated images as JSON
            'status' => $request->status,
        ]);
    
        // Flash success message and redirect
        session()->flash('success', 'AboutUs updated successfully.');
    
        return redirect()->route('aboutus.index');
    }
    

    /**
     * Remove the specified aboutus from storage.
     */
    public function destroy(AboutUs $aboutUs)
    {
        $images = json_decode($aboutUs->image, true);
        if ($images) {
            foreach ($images as $image) {
                $filePath = storage_path('app/' . $image);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        $aboutUs->delete();

        return redirect()->route('aboutus.index')->with('success', 'AboutUs deleted successfully.');
    }
}
