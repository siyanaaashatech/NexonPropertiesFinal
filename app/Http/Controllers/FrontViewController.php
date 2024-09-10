<?php
namespace App\Http\Controllers;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Blog;
use App\Models\AboutUs;
use App\Models\Testimonial;


class FrontViewController extends Controller
{
    public function index()
    {
        // Fetch the latest services, each with related images if applicable
        $services = Service::latest()->take(4)->get();

        // Fetch blogs with images if applicable
        $blogs = Blog::latest()->get();

        // Fetch about us section, typically only one record
        $aboutuss = AboutUs::latest()->take(1)->get();

        // Fetch testimonials
        $testimonials = Testimonial::latest()->get();

        // Fetch latest properties and decode their images
        $properties = Property::latest()->take(4)->get()->map(function ($property) {
            // Decode the main images from JSON to an array
            $property->main_images = json_decode($property->main_image, true) ?: [];

            // Decode the other images from JSON to an array
            $property->other_images = json_decode($property->other_images, true) ?: [];

            return $property;
        });

        // Return the view with the fetched data
        return view('frontend.welcome', compact('services', 'blogs', 'aboutuss', 'testimonials', 'properties'));
    }
    // public function singlePost($slug)
    // {
    //     $blogs = Blog::where('slug', $slug)->firstOrFail();
    //     $relatedPosts = blog::where('id', '!=', $blogs->id)->get();
    //     return view('singleblogpost', compact('blogs', 'relatedPosts'));
    // }
}