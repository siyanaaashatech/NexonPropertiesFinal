<?php

namespace App\Http\Controllers;
use App\Models\Property;
use App\Models\Category;
use App\Models\Service;
use App\Models\Blog;
use App\Models\Testimonial;
use App\Models\Whyus;
use App\Models\AboutUs;
use App\Models\Subcategory;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
class FrontViewController extends Controller
{
  

    private function extractAmenities($amenities)
    {
        if (is_string($amenities)) {
            return json_decode($amenities, true) ?? [];
        } elseif (is_array($amenities)) {
            return $amenities;
        }
        return [];
    }

    public function index()
    {
        $services = Service::where('status', 1)->latest()->take(4)->get();
        $blogs = Blog::where('status', 1)->latest()->get();
        $testimonials = Testimonial::where('status', 1)->latest()->get();
        $whyuss = Whyus::where('status', 1)->latest()->get();
        $aboutuss = AboutUs::where('status', 1)->latest()->take(1)->get();
        $properties = Property::where('status', 1)->latest()->take(6)->get();
        $propertie = Property::where('status', 1)->latest()->take(6)->get();
        $subPropertyCount = Property::distinct('suburb')->count();
        $categories = Category::all();
        $states = Property::distinct('state')->pluck('state');
        $subcategories = Subcategory::all();
        $suburbs = Property::distinct('suburb')->pluck('suburb');
        $amenities = Amenity::all();

        return view('frontend.welcome', compact([
            'services', 'blogs', 'aboutuss', 'testimonials', 'whyuss', 'properties', 'categories','subcategories', 'states', 'suburbs','amenities','propertie','subPropertyCount'
        ]));
    }
    public function properties(Request $request, $categoryId = null)
    {
        $categoryId = $request->query('categoryId');
        // Fetch all categories for the navbar
        $categories = Category::all();
        // Fetch properties, optionally filtered by category, and where status is active
        $propertiesQuery = Property::where('status', '1');
        if ($categoryId) {
            $propertiesQuery->where('category_id', $categoryId);
        }
        $properties = $propertiesQuery->paginate(1);
        $states = Property::distinct('state')->pluck('state');
        $amenities = Amenity::all();

        return view('frontend.properties', compact('properties', 'categories', 'states','amenities'));
    }
    
    // public function singlePost($slug)
    // {
    //     $blogs = Blog::where('slug', $slug)->firstOrFail();
    //     $relatedPosts = blog::where('id', '!=', $blogs->id)->get();
    //     return view('singleblogpost', compact('blogs', 'relatedPosts'));
    // }
}
