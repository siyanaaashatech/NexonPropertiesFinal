<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class TestimonialController extends Controller
{
    /**
     * Display a listing of the testimonials.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::all(); // Fetch all testimonials
        return view('admin.testimonial.index', compact('testimonials'));
    }
    /**
     * Show the form for creating a new testimonial.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonial.create');
    }
    /**
     * Store a newly created testimonial in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'title' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'required|array',
            'image.*' => 'required|string', // Ensure each image is a base64 string
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
                $destinationPath = storage_path('app/public/testimonials');

                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true, true);
                }

                $savedPath = $destinationPath . '/' . $imageName;
                imagewebp($imageResource, $savedPath);
                imagedestroy($imageResource);
                $relativeImagePath = 'storage/testimonials/' . $imageName;
                $images[] = $relativeImagePath;
            }
        }

    
         // Create new testimonial record and associate with metadata
         Testimonial::create([
            'title' => $request->title,
            'designation' => $request->designation,
            'review' => $request->review,
            'rating' => $request->rating,
            'image' => json_encode($images),
            'status' => $request->status,
           
        ]);

        session()->flash('success', 'Testimonial created successfully.');

        return redirect()->route('testimonials.index');
    }
    /**
     * Show the form for editing the specified testimonial.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonial.update', compact('testimonial'));
    }
    /**
     * Update the specified testimonial in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    // Validate the input
    $request->validate([
        'title' => 'required|string|max:255',
        'designation' => 'nullable|string|max:255',
        'review' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
        'image.*' => 'nullable|string',
        'status' => 'required|boolean',
        'cropData' => 'nullable|string',
    ]);
    // Find the testimonial and update it
    $testimonial = Testimonial::findOrFail($id);
    // Prepare testimonial data
    $testimonialData = $request->except('image'); // Exclude raw image input
    if ($request->has('image')) {
        $images = [];
        foreach ($request->input('image') as $base64Image) {
            // Handle base64 image as before
            if (strpos($base64Image, 'data:image') === 0) {
                $image_parts = explode(',', $base64Image);
                $image_base64 = base64_decode($image_parts[1]);
                $imageName = time() . '-' . Str::uuid() . '.webp';
                $destinationPath = storage_path('app/public/testimonials');
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true, true);
                }
                $savedPath = $destinationPath . '/' . $imageName;
                $imageResource = imagecreatefromstring($image_base64);
                if ($imageResource !== false) {
                    imagewebp($imageResource, $savedPath);
                    imagedestroy($imageResource);
                    $relativeImagePath = 'storage/testimonials/' . $imageName;
                    $images[] = $relativeImagePath;
                }
            }
        }
        $testimonialData['image'] = json_encode($images); // Store paths as JSON
    }
    $testimonial->update($testimonialData);
    return redirect()->route('testimonials.index')
                     ->with('success', 'Testimonial updated successfully.');
}
    /**
     * Remove the specified testimonial from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();
        return redirect()->route('testimonials.index')
                         ->with('success', 'Testimonial deleted successfully.');
    }
}