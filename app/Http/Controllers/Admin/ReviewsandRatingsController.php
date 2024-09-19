<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReviewAndRating;

class ReviewsandRatingsController extends Controller
{
    public function index()
    {
        $reviews = ReviewAndRating::all();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'reviews' => 'required|string',
            'ratings' => 'required|string',
        ]);

        ReviewAndRating::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'reviews' => $request->input('reviews'),
            'ratings' => $request->input('ratings'),
        ]);
    
         return redirect()->route('property.index')->with('success', 'Offer updated successfully.');
    }
}
