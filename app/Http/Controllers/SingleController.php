<?php
namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\Blog;
use App\Models\Testimonial;
use Illuminate\Http\Request;
class SingleController extends Controller
{
    public function render_service()
    {
        $services = Service::latest()->get();
        return view('frontend.properties', compact( 'services'));
    }

    public function render_about()
    {
        $testimonials=Testimonial::latest()->get();
        $services = Service::latest()->get();
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
        $services = Service::latest()->get();
        $relatedPosts = blog::where('id', '!=', $blogs->id)->get();
        return view('frontend.singleblogpost', compact('blogs','relatedPosts','services'));
    }

    public function render_singleProperties($id)
    {
        $services = Service::where('id', $id)->firstOrFail();
        $relatedService = Service::where('id', '!=', $services->id)->get();
        return view('frontend.singleproperties', compact('services','relatedService'));
    }
    
    
}