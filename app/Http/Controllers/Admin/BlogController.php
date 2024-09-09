<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Metadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    // Show all blogs
    public function index()
    {
        $blogs = Blog::with('metadata')->latest()->get();
        
        return view('admin.blogs.index', compact('blogs'));
    }

    // Show form to create a new blog
    public function create()
    {
        $metadata = Metadata::all();
        return view('admin.blogs.create', compact('metadata'));
    }

    // Store new blog in the database
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'author' => 'nullable|string|max:255',
        'keywords' => 'nullable|string',
        'image' => 'required|array',
        'image.*' => 'required|string',
        'status' => 'required|boolean',
        'cropData' => 'nullable|string',
    ]);

    $cropData = $request->input('cropData') ? json_decode($request->input('cropData'), true) : null;
    $images = [];

    foreach ($request->input('image') as $base64Image) {
        $image = explode(',', $base64Image);
        $decodedImage = base64_decode($image[1]);
        $imageResource = imagecreatefromstring($decodedImage);

        if ($imageResource !== false) {
            $imageName = time() . '-' . Str::uuid() . '.webp';
            $destinationPath = storage_path('app/public/blog_images'); // Fixed path to save images

            // Create the directory if it doesn't exist
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $savedPath = $destinationPath . '/' . $imageName;
            imagewebp($imageResource, $savedPath);
            imagedestroy($imageResource);

            // Use relative path to access the image
            $relativeImagePath = 'storage/blog_images/' . $imageName;
            $images[] = $relativeImagePath;
        }
    }

    // Create metadata entry
    $metadata = Metadata::create([
        'meta_title' => $request->title,
        'meta_description' => $request->description,
        'meta_keywords' => $request->keywords,
        'slug' => Str::slug($request->title)
    ]);

    // Create new blog record and associate with metadata
    Blog::create([
        'title' => $request->title,
        'description' => $request->description,
        'author' => $request->author,
        'image' => json_encode($images), // Store images as JSON
        'status' => $request->status,
        'metadata_id' => $metadata->id,
    ]);

    session()->flash('success', 'Blog created successfully.');
    return redirect()->route('admin.blogs.index');
}


    // Show form to edit the blog
    public function edit(Blog $blog)
    {
        $metadata = Metadata::all();
        return view('admin.blogs.update', compact('blog', 'metadata'));
    }

   // Update blog in the database
   public function update(Request $request, Blog $blog)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'author' => 'nullable|string|max:255',
        'image' => 'sometimes|array',
        'image.*' => 'required|string',
        'status' => 'required|boolean',
        'cropData' => 'nullable|string',
    ]);

    $cropData = $request->input('cropData') ? json_decode($request->input('cropData'), true) : null;
    $images = !empty($blog->image) ? json_decode($blog->image, true) : [];

    if ($request->has('image')) {
        foreach ($request->input('image') as $base64Image) {
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
                $decodedImage = base64_decode($base64Image);

                if ($decodedImage === false) {
                    continue;
                }

                $imageType = strtolower($type[1]);
                if (!in_array($imageType, ['jpg', 'jpeg', 'gif', 'png', 'webp'])) {
                    continue;
                }

                $imageResource = imagecreatefromstring($decodedImage);
                if ($imageResource !== false) {
                    $imageName = time() . '-' . Str::uuid() . '.webp';
                    $destinationPath = storage_path('app/public/blog_images'); // Fixed path to save images

                    if (!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, 0755, true, true);
                    }

                    $savedPath = $destinationPath . '/' . $imageName;
                    imagewebp($imageResource, $savedPath);
                    imagedestroy($imageResource);

                    $relativeImagePath = 'storage/blog_images/' . $imageName;
                    $images[] = $relativeImagePath;
                }
            }
        }
    }

    // Update metadata record
    $blog->metadata()->updateOrCreate([], [
        'meta_title' => $request->title,
        'meta_description' => $request->description,
        'meta_keywords' => $request->keywords,
        'slug' => Str::slug($request->title)
    ]);

    // Update blog record
    $blog->update([
        'title' => $request->title,
        'description' => $request->description,
        'author' => $request->author,
        'image' => json_encode($images), // Store updated images as JSON
        'status' => $request->status,
    ]);

    session()->flash('success', 'Blog updated successfully.');
    return redirect()->route('admin.blogs.index');
}

    // Upload image via AJAX
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('public/uploads');
            $url = asset('storage/uploads/' . basename($path));

            return response()->json(['url' => $url]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
