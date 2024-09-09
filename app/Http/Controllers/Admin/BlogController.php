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
            'image.*' => 'required|string', // Validate as base64 string
            'status' => 'required|boolean',
            'cropData' => 'nullable|string',
        ]);
        $cropData = $request->input('cropData') ? json_decode($request->input('cropData'), true) : null;
        $images = [];
        foreach ($request->input('image') as $base64Image) {
            // Split the base64 image to separate data type prefix and the actual data
            $image = explode(',', $base64Image);
            // Decode the image data
            $decodedImage = base64_decode($image[1]);
            // Check if the decoded image is a binary string (not an array)
            if (!is_array($decodedImage) && $decodedImage !== false) {
                $imageResource = imagecreatefromstring($decodedImage);
                if ($imageResource !== false) {
                    $imageName = time() . '-' . Str::uuid() . '.webp';
                    $destinationPath = storage_path('app/uploads/images/blogs');
                    if (!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, 0755, true, true);
                    }
                    $savedPath = $destinationPath . '/' . $imageName;
                    imagewebp($imageResource, $savedPath);
                    imagedestroy($imageResource);
                    $relativeImagePath = 'uploads/images/blogs/' . $imageName;
                    $images[] = $relativeImagePath;
                }
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
   // Update blog in the database
public function update(Request $request, Blog $blog)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'author' => 'nullable|string|max:255',
        'image' => 'sometimes|array',
        'image.*' => 'required|string', // Validate each image as a base64 string
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
                    $destinationPath = storage_path('app/uploads/images/blogs');
                    if (!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, 0755, true, true);
                    }
                    $savedPath = $destinationPath . '/' . $imageName;
                    imagewebp($imageResource, $savedPath);
                    imagedestroy($imageResource);
                    $relativeImagePath = 'uploads/images/blogs/' . $imageName;
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
    // Delete a blog from the database
    public function destroy(Blog $blog)
    {
        $images = json_decode($blog->image, true);
        if ($images) {
            foreach ($images as $image) {
                $filePath = storage_path('app/' . $image);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
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