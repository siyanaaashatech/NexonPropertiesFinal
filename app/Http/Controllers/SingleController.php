<?php
namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Property;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Testimonial;
use App\Models\Team;
use App\Models\FAQ;
use App\Models\AboutDescription;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SingleController extends Controller
{
    public function render_about()
    {
        $testimonials = Testimonial::where('status', 1)->latest()->get();
        $teams = Team::where('status', 1)->latest()->get();
        $faqs = FAQ::where('status', 1)->latest()->get();
        $aboutDescriptions = AboutDescription::where('status', 1)->latest()->get();
        
        return view('frontend.about', compact('aboutDescriptions', 'teams', 'testimonials', 'faqs'));
    }

    public function render_blog()
    {
        $blogs = Blog::where('status', 1)->latest()->get();
        $properties = Property::where('status', 1)->latest()->get();
        $categories = Category::all();
        
        return view('frontend.blog', compact('blogs', 'properties', 'categories'));
    }

    public function singlePost($id)
    {
        $blogs = Blog::where('id', $id)->where('status', 1)->firstOrFail();
        $properties = Property::where('status', 1)->latest()->get();
        $relatedPosts = Blog::where('id', '!=', $blogs->id)->where('status', 1)->get();
        
        return view('frontend.singleblogpost', compact('blogs', 'relatedPosts', 'properties'));
    }

    public function render_properties()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $properties = Property::where('status', 1)->latest()->paginate(6);
        $states = Property::distinct('state')->pluck('state');
        return view('frontend.properties', compact('categories', 'subcategories',  'properties', 'states'));

    }

    public function render_singleProperties($id)
    {
        // Fetch the property by ID and ensure it's active
        $categories = Category::all(); 
        $subcategories = SubCategory::all(); 
        $properties = Property::where('id', $id)->where('status', 1)->firstOrFail();
        $relatedProperties = Property::where('id', '!=', $properties->id)->where('status', 1)->get();
        
        // Handle the 'other_images' field if it exists
        $otherImages = !empty($properties->other_images) ? json_decode($properties->other_images, true) : [];
        return view('frontend.singleproperties', compact('categories', 'properties', 'relatedProperties', 'otherImages'));

    }

    public function render_contact()
    {
        $siteSettings = SiteSetting::where('status', 1)->latest()->get();
        $categories = Category::all(); 
        
        return view('frontend.contact', compact('categories', 'siteSettings'));
    }

    public function render_search()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $properties = Property::latest()->take(5)->get();
        
        return view('frontend.searching', compact('properties', 'categories', 'subcategories'));
    }
    

    public function properties(Request $request)
    {
        $categories = Category::all();
        $categoryId = $request->query('categoryId');
        $propertiesQuery = Property::where('status', 1);
    
        if ($categoryId) {
            $propertiesQuery->where('category_id', $categoryId);
        }

        $properties = $propertiesQuery->paginate(6);

        $states = Property::distinct('state')->pluck('state');

        $subcategories = SubCategory::all();
    
        return view('frontend.properties', compact('properties', 'categories', 'states', 'subcategories'));
    }

}
