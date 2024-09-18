<?php
namespace App\Http\Controllers;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Blog;
use App\Models\AboutUs;
use App\Models\Testimonial;
use App\Models\Whyus;
use App\Models\Property;
use App\Models\Category;


class FrontViewController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 1)->latest()->take(4)->get();
        $blogs = Blog::where('status', 1)->latest()->get();
        $testimonials = Testimonial::where('status', 1)->latest()->get();
        $whyuss = Whyus::where('status', 1)->latest()->get();
        $aboutuss = AboutUs::where('status', 1)->latest()->take(1)->get();
        $properties = Property::where('status', 1)->latest()->take(6)->get();
        $categories = Category::all(); // Assuming categories don't have a status
        $subcategories = SubCategory::all();
    
        return view('frontend.welcome', compact([
            'services', 'blogs', 'aboutuss', 'testimonials', 'whyuss', 'properties', 'categories','subcategories'
        ]));
    }
    
    

    public function properties(Request $request, $categoryId = null)
    {
        $categoryId = $request->query('categoryId');
        
        // Fetch all categories for the navbar
        $categories = Category::all();
        
        // Fetch properties, optionally filtered by category, and where status is active
        $propertiesQuery = Property::where('status', '1');
        
        if ($categoryId) {
            $propertiesQuery->where('category_id', $categoryId);
        }
        
        $properties = $propertiesQuery->paginate(1); 
        
        return view('frontend.properties', compact('properties', 'categories'));
    }
    
    // public function singlePost($slug)
    // {
    //     $blogs = Blog::where('slug', $slug)->firstOrFail();
    //     $relatedPosts = blog::where('id', '!=', $blogs->id)->get();
    //     return view('singleblogpost', compact('blogs', 'relatedPosts'));
    // }
}