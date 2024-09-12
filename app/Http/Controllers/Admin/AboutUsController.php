<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Metadata;
use Illuminate\Http\Request;
use App\Models\SummernoteContent;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AboutUsController extends Controller
{
    /** 
     * Display a listing of the aboutus.
     */
    public function index()
    {
        $aboutUs = AboutUs::with('metadata')->latest()->get();
        $summernoteContent = new SummernoteContent();
        return view('admin.aboutus.index', compact('aboutUs'));
    }

    /**
     * Show the form for creating a new AboutUs.
     */
    public function create()
    {
        $summernoteContent = new SummernoteContent();
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
        'croppedImage' => 'required|json',
        'cropData' => 'required|json',
        'status' => 'required|boolean',
    ]);

    $croppedImages = json_decode($request->input('croppedImage'), true);
    $cropData = json_decode($request->input('cropData'), true);

    $images = [];

    foreach ($croppedImages as $index => $base64Image) {
        $image = explode(',', $base64Image);
        $imageData = base64_decode($image[1]);

        $imageName = time() . '-' . Str::uuid() . '.webp';
        $destinationPath = storage_path('app/public/aboutus');

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }

        $savedPath = $destinationPath . '/' . $imageName;
        file_put_contents($savedPath, $imageData);

        $relativeImagePath = 'storage/aboutus/' . $imageName;
        $images[] = $relativeImagePath;
    }

    // Handle metadata
    $metaKeywordsArray = array_map('trim', explode(',', $request->keywords));
    $metadata = Metadata::create([
        'meta_title' => $request->title,
        'meta_description' => $request->description,
        'meta_keywords' => json_encode($metaKeywordsArray),
        'slug' => Str::slug($request->title),
    ]);

    AboutUs::create([
        'title' => $request->title,
        'subtitle' => $request->subtitle,
        'description' => $request->description,
        'keywords' => $request->keywords,
        'image' => json_encode($images),
        'status' => $request->status,
        'metadata_id' => $metadata->id,
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
    public function update(Request $request, $id)
{
    $aboutUs = AboutUs::findOrFail($id);
    
    $request->validate([
        'title' => 'required|string|max:255',
        'subtitle' => 'required|string|max:255',
        'description' => 'required|string',
        'keywords' => 'nullable|string',
        'croppedImage' => 'nullable|json',
        'cropData' => 'nullable|json',
        'status' => 'required|boolean',
    ]);

    $croppedImages = json_decode($request->input('croppedImage'), true);
    $cropData = json_decode($request->input('cropData'), true);

    $images = [];

    // Delete old images
    $oldImages = json_decode($aboutUs->image, true);
    if ($oldImages) {
        foreach ($oldImages as $oldImage) {
            $oldImagePath = storage_path('app/public/' . str_replace('storage/', '', $oldImage));
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        }
    }

    // Process and save new images
    foreach ($croppedImages as $index => $base64Image) {
        $image = explode(',', $base64Image);
        $imageData = base64_decode($image[1]);

        $imageName = time() . '-' . Str::uuid() . '.webp';
        $destinationPath = storage_path('app/public/aboutus');

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }

        $savedPath = $destinationPath . '/' . $imageName;
        file_put_contents($savedPath, $imageData);

        $relativeImagePath = 'storage/aboutus/' . $imageName;
        $images[] = $relativeImagePath;
    }

    // Update or create metadata record
    $metaKeywordsArray = array_map('trim', explode(',', $request->keywords));
    $aboutUs->metadata()->updateOrCreate([], [
        'meta_title' => $request->title,
        'meta_description' => $request->description,
        'meta_keywords' => json_encode($metaKeywordsArray),
        'slug' => Str::slug($request->title),
    ]);

    // Update aboutus record
    
    $aboutUs->update([
        'title' => $request->title,
        'subtitle' => $request->subtitle,
        'description' => $request->description,
        'keywords' => $request->keywords,
        'image' => json_encode($images),
        'status' => $request->status,
    ]);

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
