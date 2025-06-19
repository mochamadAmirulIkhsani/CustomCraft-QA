<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the contact form view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        // Return the contact page view
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string',
            'message' => 'required|string|min:10',
        ]);

        return redirect()->route('contact.form')
                         ->with('success', 'Terima kasih! Pesan Anda telah berhasil dikirim.');
    }
}
