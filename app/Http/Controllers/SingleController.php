<?php
namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\Property;
use App\Models\Blog;
use App\Models\Testimonial;
use App\Models\Team;
use App\Models\FAQ;
use App\Models\AboutDescription;
use Illuminate\Http\Request;
class SingleController extends Controller
{


    
  

    public function render_about()
    {
        $testimonials=Testimonial::latest()->get();
        $teams=Team::latest()->get();
        $faqs=FAQ::Latest()->get();
        $aboutDescriptions=AboutDescription::latest()->get();
        return view('frontend.about', compact('aboutDescriptions','teams','testimonials' ,'faqs'));
    }
    public function render_blog()
    {
        $blogs = Blog::latest()->get();
        $properties =Property::latest()->get();
        return view('frontend.blog', compact( 'blogs' ,'properties'));
    }
    public function singlePost($id)
    {
        $blogs = Blog::where('id', $id)->firstOrFail();
        $properties = Property::latest()->get();
        $relatedPosts = blog::where('id', '!=', $blogs->id)->get();
        return view('frontend.singleblogpost', compact('blogs','relatedPosts','properties'));
    }


    public function render_properties()
    {
        $properties = Property::latest()->get();
        return view('frontend.properties', compact( 'properties'));
    }   


    public function render_singleProperties($id)
    {
        // Fetch the property by ID
        $properties = Property::where('id', $id)->firstOrFail();
        $relatedProperties = Property::where('id', '!=', $properties->id)->get();
        $otherImages = !empty($properties->other_images) ? json_decode($properties->other_images, true) : [];
        return view('frontend.singleproperties', compact('properties', 'relatedProperties', 'otherImages'));
    }

    
    
}


