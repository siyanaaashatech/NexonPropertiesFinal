<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Amenity;
use App\Models\Property;

class SearchPropertiesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $states = Property::distinct('state')->pluck('state');
        $properties = Property::latest()->take(5)->get(); 
        $amenities = Amenity::all();
        return view('frontend.welcome', compact('categories', 'subcategories', 'states', 'properties', 'amenities'));
    }

    public function getSubcategories($categoryId)
    {
        $categories = Category::all();
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }

    public function getSuburbs($state)
    {
        $suburbs = Property::where('state', $state)->distinct('suburb')->pluck('suburb');
        return response()->json($suburbs);
    }


    public function filterProperties(Request $request)
    {
        $query = Property::with(['category', 'subCategory']); 
    
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }
    
        if ($request->filled('subcategory_id')) {
            $query->where('sub_category_id', $request->input('subcategory_id'));
        }
    
        if ($request->filled('state')) {
            $query->where('state', $request->input('state'));
        }
    
        if ($request->filled('suburb')) {
            $query->where('suburb', $request->input('suburb'));
        }
    
        if ($request->filled('location')) {
            $location = $request->input('location');
            $query->where(function($q) use ($location) {
                $q->where('title', 'like', "%{$location}%")
                  ->orWhere('description', 'like', "%{$location}%");
            });
        }
    
        if ($request->filled('amenities')) {
            $selectedAmenities = $request->input('amenities');
            $query->where(function ($q) use ($selectedAmenities) {
                foreach ($selectedAmenities as $amenityId) {
                    $q->whereJsonContains('amenities', $amenityId);
                }
            });
        }
    
        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', $request->input('bedrooms'));
        }
    
        if ($request->filled('bathrooms')) {
            $query->where('bathrooms', $request->input('bathrooms'));
        }
    
       // Area range filter
    if ($request->filled('min_area') && $request->filled('max_area')) {
        $minArea = $request->input('min_area');
        $maxArea = $request->input('max_area');
        $query->where('area', '>=', $minArea)
              ->where('area', '<=', $maxArea);
    }

    // Price range filter
    if ($request->filled('min_price') && $request->filled('max_price')) {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $query->whereBetween('price', [$minPrice, $maxPrice]);
    }
    
    
        $properties = $query->get();
        $categories = Category::all(); 
        $amenities = Amenity::all();
        
        return view('frontend.searching', compact('properties', 'categories', 'amenities'));
    }
    
}


