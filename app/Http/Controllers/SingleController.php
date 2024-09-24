<?php
namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\Property;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Favorites;
use App\Models\Blog;
use App\Models\Testimonial;
use App\Models\Team;
use App\Models\FAQ;
use App\Models\AboutDescription;
use App\Models\ReviewAndRating;
use App\Models\SiteSetting;
// use App\Models\ReviewAndRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SingleController extends Controller
{
   public function render_about()
    {
        $testimonials=Testimonial::latest()->get();
        $properties = Property::latest()->get();
        $categories = Category::latest()->get();
        $teams=Team::latest()->get();
        $faqs=FAQ::Latest()->get();
        $aboutDescriptions=AboutDescription::latest()->get();
        return view('frontend.about', compact('aboutDescriptions','teams','testimonials' ,'faqs','categories','properties'));
    }
    public function render_blog()
    {
        $blogs = Blog::where('status', 1)->latest()->paginate(10);
        $properties = Property::where('status', 1)->latest()->get();
        $categories = Category::all();
        
        return view('frontend.blog', compact('blogs', 'properties', 'categories'));
    }
    public function singlePost($id)
    {
        $blogs = Blog::where('id', $id)->firstOrFail();
        $properties = Property::latest()->get();
        $relatedPosts = blog::where('id', '!=', $blogs->id)->get();
        $categories=Category::latest()->get();
        return view('frontend.singleblogpost', compact('blogs','relatedPosts','properties','categories'));
    }


    public function render_properties()
    {
        $properties = Property::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::all();
        $properties = Property::where('status', 1)->latest()->get();
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
        $acceptedReviews = ReviewAndRating::where('status', 'accepted')
        ->where('properties_id', $id)
        ->get();
        
        // Handle the 'other_images' field if it exists
        $otherImages = !empty($properties->other_images) ? json_decode($properties->other_images, true) : [];
        return view('frontend.singleproperties', compact('categories', 'properties', 'relatedProperties', 'otherImages','acceptedReviews'));

    }
    

    public function render_contact()
    {
        $siteSettings=SiteSetting::latest()->get();
        $properties = Property::latest()->get();
        $categories=Category::latest()->get();
        return view('frontend.contact', compact("categories",'siteSettings','properties'));
    }

    public function render_search()
    {
        $properties = Property::latest()->get();
        $categories=Category::latest()->get();
        return view('frontend.searching', compact('properties','categories'));
    }
    
    public function properties(Request $request, $categoryId = null)
{
    
    $categories = Category::all();
    $subcategories = SubCategory::all(); 
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

    public function render_favourite()
    {
    
    $userEmail = Auth::user()->email;
    $favoritePropertyIds = Favorites::where('email', $userEmail)->pluck('properties_id');
    $properties = Property::whereIn('id', $favoritePropertyIds)->latest()->get();
    $categories = Category::latest()->get();
    return view('frontend.favourite', compact('properties', 'categories'));
    }

}
