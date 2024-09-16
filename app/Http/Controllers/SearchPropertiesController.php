<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class SearchPropertiesController extends Controller
{
    public function filterProperties(Request $request)
    {
        // Initialize the query builder for the properties table
        $query = DB::table('properties');

        // Debug: Check the incoming request data
        // Uncomment this line if you need to see what data is being received
        // dd($request->all());

        // Apply filters based on request parameters

        // Filter by Category
        if ($request->filled('list_type')) {
            $query->where('category_id', $request->input('list_type'));
        }

        // Filter by Subcategory
        if ($request->filled('property_type')) {
            $query->where('sub_category_id', $request->input('property_type'));
        }

        // Filter by Location (street, suburb, state, postcode, or country)
        if ($request->filled('location')) {
            $query->where(function ($subQuery) use ($request) {
                $subQuery->where('street', 'like', '%' . $request->input('location') . '%')
                    ->orWhere('suburb', 'like', '%' . $request->input('location') . '%')
                    ->orWhere('state', 'like', '%' . $request->input('location') . '%')
                    ->orWhere('post_code', 'like', '%' . $request->input('location') . '%')
                    ->orWhere('country', 'like', '%' . $request->input('location') . '%');
            });
        }

        // Filter by Price Range
        if ($request->filled('min_price') || $request->filled('max_price')) {
            $minPrice = $request->input('min_price', 0);
            $maxPrice = $request->input('max_price', PHP_INT_MAX);
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        // Filter by State
        if ($request->filled('state')) {
            $query->where('state', $request->input('state'));
        }

        // Filter by Number of Bedrooms (optional; you can include this if the form has such a field)
        if ($request->filled('bedroom')) {
            $query->where('bedrooms', $request->input('bedroom'));
        }

        // Fetch the filtered properties
        $properties = $query->get();



        $categories = Category::get()->all();
        // Debug: Uncomment to check if the query is applying filters correctly
        //  dd($query->toSql(), $query->getBindings(), $properties);

        return view('frontend.searching', compact('properties', 'categories'));
    }
}