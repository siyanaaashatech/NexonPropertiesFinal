<?php

namespace App\Http\Controllers;


use App\Models\Service;

use Illuminate\Http\Request;


class SingleController extends Controller
{

    public function render_service()
    {
        
        $services = Service::latest()->get();
        
        return view('frontend.services', compact( 'services'));
    }

}