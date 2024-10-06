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
use App\Models\Address;
use App\Models\Favorites;
use Illuminate\Support\Facades\Auth;

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
    $aboutuss = AboutUs::where('status', 1)->first();
    $properties = Property::where('status', 1)->latest()->take(6)->get();
    $propertie = Property::where('status', 1)->latest()->take(6)->get();
    // Fetch suburb counts using the relationship
    $suburbs = Property::with('address')
    ->whereHas('address') // Ensure the property has an associated address
    ->get()
    ->groupBy('address.suburb')
    ->map(function ($group, $suburb) {
        return [
            'suburb' => $suburb,
            'count' => $group->count(),
        ];
    })
    ->sortByDesc('count')
    ->take(4);

    $categories = Category::all();
    $states = Address::distinct('state')->pluck('state');
    $subcategories = Subcategory::all();
    $amenities = Amenity::all();

    return view('frontend.welcome', compact([
        'services', 'blogs', 'aboutuss', 'testimonials', 'whyuss', 'properties',
        'categories', 'subcategories', 'states', 'amenities', 'propertie', 'suburbs'
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
        $properties = $propertiesQuery->paginate(24);
        $states = Address::distinct('state')->pluck('state');
        $amenities = Amenity::all();

        $otherImages = !empty($properties->other_images) ? json_decode($properties->other_images, true) : [];


        return view('frontend.properties', compact('properties', 'categories', 'states','amenities','otherImages'));
        // return view('frontend.properties', compact('properties', 'categories', 'states','amenities'));
    }
    
    // public function singlePost($slug)
    // {
    //     $blogs = Blog::where('slug', $slug)->firstOrFail();
    //     $relatedPosts = blog::where('id', '!=', $blogs->id)->get();
    //     return view('singleblogpost', compact('blogs', 'relatedPosts'));
    // }

    public function userFavorites()
    {
        // Fetch only the authenticated user's favorites with related property details
        $favorites = Favorites::with('property')
                              ->where('email', Auth::user()->email)
                              ->get();

        return view('frontend.favorites.index', compact('favorites'));
    }
}