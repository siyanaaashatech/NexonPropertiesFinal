<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Testimonial;

class FrontViewController extends Controller
{
    public function index()
    {
      
        $services = Service::latest()->get()->take(6);
        $testimonials = Testimonial::latest()->get()->take(3);
        $blogs = Blog::latest()->get()->take(6);

        return view('frontend.welcome', compact([
            'services','testimonials','blogs'
        ]));

    }
    // public function singlePost($slug)
    // {
    //     $post = Post::where('slug', $slug)->firstOrFail();
    //     $relatedPosts = Post::where('id', '!=', $post->id)->get();

    //     return view('frontend.posts', compact('post', 'relatedPosts'));
    // }
}
