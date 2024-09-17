<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {
       
            $user = Auth::user();
        
            // Fetch the count of properties by status
            $availableCount = \App\Models\Property::where('availability_status', 'available')->count();
            $soldCount = \App\Models\Property::where('availability_status', 'sold')->count();
            $rentalCount = \App\Models\Property::where('availability_status', 'rental')->count();
            
            // Fetch all categories
            $categories = \App\Models\Category::all();
        
            return view('admin.index', [
                'user' => $user,
                'availableCount' => $availableCount,
                'soldCount' => $soldCount,
                'rentalCount' => $rentalCount,
                'categories' => $categories,
            ]);
        }
        
    }
    
