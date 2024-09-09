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
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'main_image' => 'required|array', // Ensure main_image is an array
                'main_image.*' => 'required|string', // Validate as a string since it's a base64 image
                'cropData' => 'required|string',
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
                'keywords' => 'nullable|string', // Add this validation for metadata
            ]);

            // Handle the main image upload (base64 images)
            $images = [];
            foreach ($request->input('main_image') as $base64Image) {
                $image = explode(',', $base64Image);
                $decodedImage = base64_decode($image[1]);
                $imageResource = imagecreatefromstring($decodedImage);

                if ($imageResource !== false) {
                    $imageName = time() . '-' . Str::uuid() . '.webp';
                    $destinationPath = storage_path('app/uploads/images/properties');

                    if (!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, 0755, true, true);
                    }

                    $savedPath = $destinationPath . '/' . $imageName;
                    imagewebp($imageResource, $savedPath);
                    imagedestroy($imageResource);
                    $relativeImagePath = 'uploads/images/properties/' . $imageName;
                    $images[] = $relativeImagePath;
                }
            }

            // Create a metadata entry
            $metadata = Metadata::create([
                'meta_title' => $request->title,
                'meta_description' => $request->description,
                'meta_keywords' => $request->suburb,
                'slug' => Str::slug($request->title),
            ]);

            // Create new property record and associate with metadata
            $property = Property::create([
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
                'status' => $request->status,
                'main_image' => json_encode($images),
                'availability_status' => $request->availability_status,
                'rental_period' => $request->rental_period,
                'metadata_id' => $metadata->id, // Link the created metadata
            ]);

            session()->flash('success', 'Property created successfully.');

            return redirect()->route('admin.property.index');
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
                'main_image' => 'sometimes|array', // Ensure main_image is an array
                'main_image.*' => 'sometimes|string', // Validate each main_image item as a string
                'cropData' => 'sometimes|string', // Ensure cropData is a string if provided
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
            ]);
        
            // Handle main image update logic here if necessary
            $images = !empty($property->main_image) ? json_decode($property->main_image, true) : [];
            if ($request->has('main_image')) {
                foreach ($request->input('main_image') as $base64Image) {
                    $image = explode(',', $base64Image);
                    $decodedImage = base64_decode($image[1]);
                    $imageResource = imagecreatefromstring($decodedImage);
        
                    if ($imageResource !== false) {
                        $imageName = time() . '-' . Str::uuid() . '.webp';
                        $destinationPath = storage_path('app/uploads/images/properties');
        
                        if (!File::exists($destinationPath)) {
                            File::makeDirectory($destinationPath, 0755, true, true);
                        }
        
                        $savedPath = $destinationPath . '/' . $imageName;
                        imagewebp($imageResource, $savedPath);
                        imagedestroy($imageResource);
                        $relativeImagePath = 'uploads/images/properties/' . $imageName;
                        $images[] = $relativeImagePath;
                    }
                }
            }
        
            // Update metadata record
            $property->metadata()->updateOrCreate([], [
                'meta_title' => $request->title,
                'meta_description' => $request->description,
                'meta_keywords' => $request->suburb,
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
                'status' => $request->status,
                'main_image' => json_encode($images), // Update main image
                'availability_status' => $request->availability_status,
                'rental_period' => $request->rental_period,
            ]);
        
            session()->flash('success', 'Property updated successfully.');
        
            return redirect()->route('admin.property.index');
        }
        

        /**
         * Remove the specified property from storage.
         */
        public function destroy(Property $property)
        {
            // Delete images from storage
            $images = json_decode($property->main_image, true);
            if ($images) {
                foreach ($images as $image) {
                    $filePath = storage_path('app/' . $image);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }

            $property->delete();

            return redirect()->route('admin.property.index')->with('success', 'Property deleted successfully.');
        }
    }