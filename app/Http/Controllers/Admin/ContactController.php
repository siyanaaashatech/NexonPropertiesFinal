<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::all();
        return view('admin.contact.index', compact('contact')); 
    }

    public function store(Request $request)
    {
        // For logged-in users, take the name and email from the Auth facade
        if (Auth::check()) {
            $contact = new Contact();
            $contact->name = Auth::user()->name;
            $contact->email = Auth::user()->email;
            $contact->message = $request->input('message');
            $contact->save();
        } 
        // For guests, validate and take all inputs
        else {
            $request->validate([
                'person_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'message' => 'required|string',
            ]);

            Contact::create([
                'name' => $request->input('person_name'),
                'email' => $request->input('email'),
                'message' => $request->input('message'),
            ]);
        }

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
