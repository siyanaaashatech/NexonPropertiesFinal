<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Metadata;
use Illuminate\Http\Request;
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
             'image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Validate image file types and size
             'status' => 'required|boolean',
             'cropData' => 'nullable|string',
         ]);
         $images = [];
         if ($request->hasFile('image')) {
             foreach ($request->file('image') as $file) {
                 $imageName = time() . '-' . Str::uuid() . '.' . $file->getClientOriginalExtension();
                 $file->storeAs('public/aboutus', $imageName);
                 $images[] = 'storage/aboutus/' . $imageName;
             }
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
        $cropData = $request->input('cropData') ? json_decode($request->input('cropData'), true) : null;
        $images = $aboutUs->image ? json_decode($aboutUs->image, true) : [];
        // Handle new image
        if ($request->has('croppedImage')) {
            $base64Image = $request->input('croppedImage');
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
                $decodedImage = base64_decode($base64Image);
                if ($decodedImage !== false) {
                    $imageType = strtolower($type[1]);
                    if (in_array($imageType, ['jpg', 'jpeg', 'gif', 'png', 'webp'])) {
                        $imageResource = imagecreatefromstring($decodedImage);
                        if ($imageResource !== false) {
                            $imageName = time() . '-' . Str::uuid() . '.webp';
                            $destinationPath = storage_path('app/public/aboutus');
                            if (!File::exists($destinationPath)) {
                                File::makeDirectory($destinationPath, 0755, true, true);
                            }
                            $savedPath = $destinationPath . '/' . $imageName;
                            imagewebp($imageResource, $savedPath);
                            imagedestroy($imageResource);
                            $relativeImagePath = 'storage/aboutus/' . $imageName;
                            $images[] = $relativeImagePath;  // Add new image to the array
                            // Delete old image if exists
                            if (!empty($images)) {
                                $oldImagePath = storage_path('app/public/' . $images[0]);
                                if (file_exists($oldImagePath)) {
                                    unlink($oldImagePath);
                                }
                                array_shift($images);  // Remove the old image from the array
                            }
                        }
                    }
                }
            }
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