<?php
namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\Property;
use App\Models\Blog;
use App\Models\Testimonial;
use Illuminate\Http\Request;
class SingleController extends Controller
{


    
    public function render_properties()
    {
        $properties = Property::latest()->get();
        return view('frontend.properties', compact( 'properties'));
    }

    public function render_about()
    {
        $testimonials=Testimonial::latest()->get();
        $testimonials=Testimonial::latest()->get();
        $services = Service::latest()->get();
        return view('frontend.about', compact( 'services' ,'testimonials'));
        return view('frontend.about', compact( 'services' ,'testimonials'));
    }
    public function render_blog()
    {
        $blogs = Blog::latest()->get();
        $services =Service::latest()->get();
        return view('frontend.blog', compact( 'blogs' ,'services'));
    }
    public function singlePost($id)
    {
        $blogs = Blog::where('id', $id)->firstOrFail();
        $blogs = Blog::latest()->get();
        $services =Service::latest()->get();
        return view('frontend.blog', compact( 'blogs' ,'services'));
    }
    public function singlePost($id)
    {
        $blogs = Blog::where('id', $id)->firstOrFail();
        $services = Service::latest()->get();
        $relatedPosts = blog::where('id', '!=', $blogs->id)->get();
        return view('frontend.singleblogpost', compact('blogs','relatedPosts','services'));
        $relatedPosts = blog::where('id', '!=', $blogs->id)->get();
        return view('frontend.singleblogpost', compact('blogs','relatedPosts','services'));
    }

    public function render_singleProperties($id)
    public function render_singleProperties($id)
    {
        $properties = Property::where('id', $id)->firstOrFail();
        $relatedService = Property::where('id', '!=', $properties->id)->get();
        return view('frontend.singleproperties', compact('properties','relatedService'));
    }

    
    
}


