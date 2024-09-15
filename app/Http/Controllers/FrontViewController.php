<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Blog;
use App\Models\AboutUs;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB; 

class FrontViewController extends Controller
{
    public function index()
    {
        $services = Service::latest()->take(4)->get();
        $blogs = Blog::latest()->get();
        $aboutuss = AboutUs::latest()->take(1)->get();
        $testimonials = Testimonial::latest()->get();
        $properties = Property::latest()->take(4)->get();

        // Debugging Step: Check properties fetched in the index method
        // dd($properties);

        return view('frontend.welcome', compact('services', 'blogs', 'aboutuss', 'testimonials', 'properties'));
    }


    public function search(Request $request)
    {
        
        $searchController = new SearchPropertiesController();
        $properties = $searchController->filterProperties($request);
        return view('frontend.search', compact('properties'));
    }

    // Example of a single post method that is currently commented out
    // public function singlePost($slug)
    // {
    //     $blogs = Blog::where('slug', $slug)->firstOrFail();
    //     $relatedPosts = blog::where('id', '!=', $blogs->id)->get();
    //     return view('singleblogpost', compact('blogs', 'relatedPosts'));
    // }
}