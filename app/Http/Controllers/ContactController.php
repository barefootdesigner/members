<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contactInfo = \App\Models\SiteSetting::where('key', 'contact_info')->value('value');
        return view('contact', compact('contactInfo'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        // Simple validation and mock send
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // In a real app, send mail here.
        // Mail::to('admin@example.com')->send(new ContactForm($validated));

        return back()->with('success', 'Thank you for your message. We will be in touch shortly.');
    }
}
