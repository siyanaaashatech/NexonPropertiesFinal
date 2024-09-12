<?php
namespace App\Http\Controllers;
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
        $services = Service::latest()->get()->take(4);
        $blogs = Blog::latest()->get();
        $testimonials =Testimonial::latest()->get();
        $whyuss=Whyus::latest()->get();
        $aboutuss =AboutUs::latest()->get()->take(1);
        $properties=Property::latest()->get()->take(6);
        $categories = Category::all(); 



        return view('frontend.welcome',  compact([
            'services','blogs','aboutuss','testimonials','whyuss','properties','categories'
        ]));
    }

    public function properties(Request $request, $categoryId = null)
    {
        $categoryId = $request->query('categoryId');
    
        // Fetch all categories for the navbar
        $categories = Category::all();
    
        // Fetch properties, optionally filtered by category
        $propertiesQuery = Property::query();
    
        if ($categoryId) {
            $propertiesQuery->where('category_id', $categoryId);
        }
    
        $properties = $propertiesQuery->paginate(12); 
    
        return view('frontend.properties', compact('properties', 'categories'));
    }

    // public function singlePost($slug)
    // {
    //     $blogs = Blog::where('slug', $slug)->firstOrFail();
    //     $relatedPosts = blog::where('id', '!=', $blogs->id)->get();
    //     return view('singleblogpost', compact('blogs', 'relatedPosts'));
    // }
}




















