<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Blog;
use App\Models\AboutUs;
use App\Models\Testimonial;
use App\Models\Whyus;
use App\Models\Property;


class FrontViewController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get()->take(4);
        $blogs = Blog::latest()->get();
        $testimonials =Testimonial::latest()->get();
        $whyuss=Whyus::latest()->get();
        $aboutuss =AboutUs::latest()->get()->take(1);
        $properties=Property::latest()->get()->take(6);


        return view('frontend.welcome',  compact([
            'services','blogs','aboutuss','testimonials','whyuss','properties',
        ]));
    }
    // public function singlePost($slug)
    // {
    //     $blogs = Blog::where('slug', $slug)->firstOrFail();
    //     $relatedPosts = blog::where('id', '!=', $blogs->id)->get();
    //     return view('singleblogpost', compact('blogs', 'relatedPosts'));
    // }
}




















