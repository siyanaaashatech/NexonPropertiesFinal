<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Metadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    /**
     * Display a listing of the properties.
     */
    public function index()
    {
        $properties = Property::with('metadata')->latest()->get();
        return view('admin.property.index', compact('properties'));
    }
    

    /**
     * Show the form for creating a new property.
     */
    public function create()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $metadata = Metadata::all();
        return view('admin.property.create', compact('categories', 'subCategories', 'metadata'));
    }

    /**
     * Store a newly created property in storage.
     */

    
        public function store(Request $request)
        {
            // Validate the incoming request data
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'sub_category_id' => 'required|exists:sub_categories,id',
                'street' => 'required|string|max:255',
                'suburb' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'post_code' => 'required|integer',
                'country' => 'required|string|max:255',
                'price' => 'required|numeric',
                'price_type' => 'required|in:fixed,negotiable,on_request',
                'bedrooms' => 'required|integer',
                'bathrooms' => 'required|integer',
                'area' => 'required|numeric',
                'status' => 'required|boolean',
                'availability_status' => 'required|in:available,sold,rental',
                'rental_period' => 'nullable|string',
                'main_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'other_images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'googlemap' => 'nullable|string',
            ]);
    
            // Handle file uploads
            if ($request->hasFile('main_image')) {
                $mainImage = $request->file('main_image')->store('images/properties', 'public');
            }
    
            $property = new Property();
            $property->title = $request->input('title');
            $property->description = $request->input('description');
            $property->category_id = $request->input('category_id');
            $property->sub_category_id = $request->input('sub_category_id');
            $property->street = $request->input('street');
            $property->suburb = $request->input('suburb');
            $property->state = $request->input('state');
            $property->post_code = $request->input('post_code');
            $property->country = $request->input('country');
            $property->price = $request->input('price');
            $property->price_type = $request->input('price_type');
            $property->bedrooms = $request->input('bedrooms');
            $property->bathrooms = $request->input('bathrooms');
            $property->area = $request->input('area');
            $property->status = $request->input('status');
            $property->availability_status = $request->input('availability_status');
            $property->rental_period = $request->input('rental_period');
            $property->googlemap = $request->input('googlemap');
            $property->main_image = $mainImage;
    
            // Handle other images
            if ($request->hasFile('other_images')) {
                $otherImages = [];
                foreach ($request->file('other_images') as $image) {
                    $otherImages[] = $image->store('images/properties', 'public');
                }
                $property->other_images = json_encode($otherImages);
            }
    
            $property->save();
    
            return redirect()->route('property.index')->with('success', 'Property created successfully.');
        }
    
    

    /**
     * Display the specified property.
     */
    public function show(Property $property)
    {
        return view('admin.property.show', compact('property'));
    }

    /**
     * Show the form for editing the specified property.
     */
    public function edit(Property $property)
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $metadata = Metadata::all();
        return view('admin.property.update', compact('property', 'categories', 'subCategories', 'metadata'));
    }

    /**
     * Update the specified property in storage.
     */
    public function update(Request $request, Property $property)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'main_image' => 'sometimes|array',
            'main_image.*' => 'sometimes|string',
            'cropData' => 'sometimes|string',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'street' => 'required|string|max:255',
            'suburb' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'post_code' => 'required|string|max:20',
            'country' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'price_type' => 'required|in:fixed,negotiable,on_request',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'area' => 'required|integer',
            'status' => 'required|boolean',
            'availability_status' => 'required|in:available,sold,rental',
            'rental_period' => 'nullable|string',
            'keywords' => 'nullable|string',
            'googlemap' => 'nullable|string',
            'other_images' => 'required|array',
            'other_images.*' => 'required|file|mimes:jpg,jpeg,png,webp|max:2048',
            'update_time' => now()->toDateString(),
        ]);

        // Handle main image update
        $images = $this->handleBase64Images($request->input('main_image'), 'property', $property->main_image);

        // Handle other images update
        $otherImages = $this->handleUploadedImages($request->file('other_images'), 'property/other-images', $property->other_images);

        // Update metadata record
        $metaKeywordsArray = array_map('trim', explode(',', $request->keywords));
        $property->metadata()->updateOrCreate([], [
            'meta_title' => $request->title,
            'meta_description' => $request->description,
            'meta_keywords' => json_encode($metaKeywordsArray),
            'slug' => Str::slug($request->title),
        ]);

        // Update the property record
        $property->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'street' => $request->street,
            'suburb' => $request->suburb,
            'state' => $request->state,
            'post_code' => $request->post_code,
            'country' => $request->country,
            'price' => $request->price,
            'price_type' => $request->price_type,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'area' => $request->area,
            'keywords' => $request->keywords,
            'googlemap' => $request->googlemap,
            'status' => $request->status,
            'main_image' => json_encode($images),
            'other_images' => json_encode($otherImages),
            'availability_status' => $request->availability_status,
            'rental_period' => $request->rental_period,
            'update_time' => now()->toDateString(),
        ]);

        session()->flash('success', 'Property updated successfully.');

        return redirect()->route('property.index');
    }

    /**
     * Remove the specified property from storage.
     */
    public function destroy(Property $property)
    {
        // Delete main images
        $this->deleteImages(json_decode($property->main_image, true));

        // Delete other images
        $this->deleteImages(json_decode($property->other_images, true));

        $property->delete();

        return redirect()->route('property.index')->with('success', 'Property deleted successfully.');
    }

    /**
 * Handle base64 image uploads and conversions to WEBP.
 */
private function handleBase64Images(array $base64Images, $folder, $existingImages = [])
{
    // Initialize with existing images if provided
    $images = !empty($existingImages) ? json_decode($existingImages, true) : [];

    foreach ($base64Images as $base64Image) {
        // Extract base64 encoded part and decode it
        $image = explode(',', $base64Image);
        $decodedImage = base64_decode($image[1]);
        $imageResource = imagecreatefromstring($decodedImage);

        if ($imageResource !== false) {
            // Generate unique image name
            $imageName = time() . '-' . Str::uuid() . '.webp';
            // Correct destination path
            $destinationPath = storage_path("app/public/$folder");

            // Create the directory if it does not exist
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            // Save the image in WEBP format
            $savedPath = $destinationPath . '/' . $imageName;
            imagewebp($imageResource, $savedPath);
            imagedestroy($imageResource);

            // Correctly formatted relative path for storage link
            $relativeImagePath = "storage/$folder/$imageName";
            $images[] = $relativeImagePath;
        }
    }

    return $images;
}


   /**.
 * Handle uploaded image files and convert them to WEBP.
 */
private function handleUploadedImages($uploadedFiles, $folder, $existingImages = [])
{
    // Initialize with existing images if any
    $images = !empty($existingImages) ? json_decode($existingImages, true) : [];

    if ($uploadedFiles) {
        foreach ($uploadedFiles as $file) {
            // Generate a unique name for each image
            $imageName = time() . '-' . Str::uuid() . '.webp';
            // Correct destination path for storage
            $destinationPath = storage_path("app/public/$folder");

            // Create the directory if it does not exist
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            // Convert the uploaded image to WEBP format
            $imageResource = imagecreatefromstring(file_get_contents($file));
            $savedPath = $destinationPath . '/' . $imageName;
            imagewebp($imageResource, $savedPath);
            imagedestroy($imageResource);

            // Correctly formatted relative path for storage link
            $relativeImagePath = "storage/$folder/$imageName";
            $images[] = $relativeImagePath;
        }
    }

    return $images;
}


    /**
     * Delete images from storage.
     */
    private function deleteImages($images)
    {
        if ($images) {
            foreach ($images as $image) {
                $filePath = storage_path('app/' . $image);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }
    }

    public function getSubcategories($categoryId)
{
    $subcategories = SubCategory::where('category_id', $categoryId)->get();
    return response()->json($subcategories);
}
}   