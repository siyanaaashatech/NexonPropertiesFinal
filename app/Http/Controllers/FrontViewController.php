<?php
namespace App\Http\Controllers;
use App\Models\Property;
use App\Models\Category;
use App\Models\Service;
use App\Models\Blog;
use App\Models\Testimonial;
use App\Models\Whyus;
use App\Models\AboutUs;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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
        $propertie = Property::where('status', 1)->latest()->take(6)->get();
        $categories = Category::all();
        $states = Property::distinct('state')->pluck('state');
        $subcategories = Subcategory::all();
        $suburbs = Property::distinct('suburb')->pluck('suburb');
        $subPropertyCount = Property::distinct('suburb')->count();
        return view('frontend.welcome', compact([
            'services', 'blogs', 'aboutuss', 'testimonials', 'whyuss', 'properties', 'categories','subcategories', 'states', 'suburbs', 'propertie', 'subPropertyCount'
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
        $states = Property::distinct('state')->pluck('state');
        return view('frontend.properties', compact('properties', 'categories', 'states'));
    }
}
