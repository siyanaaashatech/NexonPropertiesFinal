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
        $services = Service::latest()->get()->take(4);
        $blogs = Blog::latest()->get();
        $testimonials =Testimonial::latest()->get();
        $whyuss=Whyus::latest()->get();
        $aboutuss =AboutUs::latest()->get()->take(1);
        $properties=Property::latest()->get()->take(6);
        $categories = Category::all(); 
        $subcategories = SubCategory::all();

        // dd($categories, $subcategories);


        return view('frontend.welcome',  compact([
            'services','blogs','aboutuss','testimonials','whyuss','properties','categories','subcategories'
        ]));
    }


    public function search(Request $request)
    {
        
        $searchController = new SearchPropertiesController();
        $properties = $searchController->filterProperties($request);
        return view('frontend.search', compact('properties'));
    }

    // Example of a single post method that is currently commented out
    // public function singlePost($slug)
    // {
    //     $blogs = Blog::where('slug', $slug)->firstOrFail();
    //     $relatedPosts = blog::where('id', '!=', $blogs->id)->get();
    //     return view('singleblogpost', compact('blogs', 'relatedPosts'));
    // }
}