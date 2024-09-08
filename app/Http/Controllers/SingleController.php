<?php
namespace App\Http\Controllers;
use App\Models\Service;
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
        $services = Service::latest()->get();
        return view('frontend.about', compact( 'services'));
    }
    public function render_blog()
    {
        $services = Service::latest()->get();
        return view('frontend.blog', compact( 'services'));
    }


    public function render_singleblogpost()
    {
        $services = Service::latest()->get();
        return view('frontend.singleblogpost', compact('services'));
    }
}