<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class FrontViewController extends Controller
{
    public function index()
    {
      
        $services = Service::latest()->get()->take(4);


        return view('frontend.welcome',  compact([
            'services',
        ]));
    }
    // public function singlePost($slug)
    // {
    //     $post = Post::where('slug', $slug)->firstOrFail();
    //     $relatedPosts = Post::where('id', '!=', $post->id)->get();

    //     return view('frontend.posts', compact('post', 'relatedPosts'));
    // }
}
