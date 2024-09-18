<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Property;
class SearchPropertiesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $states = Property::distinct('state')->pluck('state');
        $properties = Property::latest()->take(5)->get();
        return view('frontend.index', compact('categories', 'subcategories', 'states', 'properties'));
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
        if ($request->filled('sub_category_id')) {
            $query->where(function($q) use ($request) {
                $q->where('sub_category_id', $request->input('sub_category_id'))
                  ->orWhereNull('sub_category_id');
            });
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
        $properties = $query->get();
        $categories = Category::all();
        return view('frontend.searching', compact('properties', 'categories'));
    }
}