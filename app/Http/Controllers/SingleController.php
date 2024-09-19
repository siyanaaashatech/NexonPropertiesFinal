<?php
namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\Property;
use App\Models\Category;
use App\Models\SubCategory;
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
        $testimonials=Testimonial::latest()->get();
         $categories = Category::latest()->get();
        $teams=Team::latest()->get();
        $faqs=FAQ::Latest()->get();
        $aboutDescriptions=AboutDescription::latest()->get();
        return view('frontend.about', compact('aboutDescriptions','teams','testimonials' ,'faqs',"categories"));
    }
    public function render_blog()
    {
        $blogs = Blog::latest()->get();
        $properties =Property::latest()->get();
        $categories=Category::latest()->get();
        return view('frontend.blog', compact( 'blogs' ,'properties','categories'));
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
        $categories = Category::latest()->get();
        $subcategories = SubCategory::all();
        return view('frontend.properties', compact( 'properties', 'categories','subcategories'));
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
        return view('frontend.singleproperties', compact('categories','properties', 'relatedProperties', 'otherImages'));
    }
    

    public function render_contact()
    {
        $siteSettings=SiteSetting::latest()->get();
        $categories=Category::latest()->get();
        return view('frontend.contact', compact("categories",'siteSettings'));
    }

    public function render_search()
    {
        $properties = Property::latest()->get();
        return view('frontend.searching', compact('properties'));
    }

    public function properties(Request $request, $categoryId = null)
{
    // Fetch all categories for the navbar
    $categories = Category::all();
    $subcategories = SubCategory::all(); // Fetch subcategories here

    // Get the categoryId from the request query
    $categoryId = $request->query('categoryId');

    // Fetch properties filtered by category and active status
    $propertiesQuery = Property::where('status', 1); // Ensure properties are active

    if ($categoryId) {
        $propertiesQuery->where('category_id', $categoryId); // Filter by category
    }

    // Paginate the results
    $properties = $propertiesQuery->paginate(6); // You can adjust the number of properties per page

    // Pass $subcategories to the view
    return view('frontend.properties', compact('properties', 'categories', 'subcategories'));
}


}
