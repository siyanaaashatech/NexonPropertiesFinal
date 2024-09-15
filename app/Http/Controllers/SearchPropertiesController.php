<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchPropertiesController extends Controller
{
    public function filterProperties(Request $request)
    {
        // Initialize the query builder for the properties table
        $query = DB::table('properties');

        // Apply filters based on request parameters
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('sub_category_id')) {
            $query->where('sub_category_id', $request->input('sub_category_id'));
        }

        if ($request->filled('location')) {
            $query->where(function ($subQuery) use ($request) {
                $subQuery->where('street', 'like', '%' . $request->input('location') . '%')
                         ->orWhere('suburb', 'like', '%' . $request->input('location') . '%')
                         ->orWhere('state', 'like', '%' . $request->input('location') . '%')
                         ->orWhere('post_code', 'like', '%' . $request->input('location') . '%')
                         ->orWhere('country', 'like', '%' . $request->input('location') . '%');
            });
        }

        if ($request->filled('min_price') || $request->filled('max_price')) {
            $minPrice = $request->input('min_price', 0);
            $maxPrice = $request->input('max_price', PHP_INT_MAX);
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        if ($request->filled('bedroom')) {
            $query->where('bedrooms', $request->input('bedroom'));
        }

        // Fetch the filtered properties
        return $query->get();
    }
}
