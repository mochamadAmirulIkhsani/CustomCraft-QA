<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class ContactController extends Controller
{
    /**
     * Display the contact form view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        // Get remaining attempts untuk ditampilkan ke user
        $key = 'contact-submissions:' . request()->ip();
        $attempts = RateLimiter::attempts($key);
        $maxAttempts = 3;
        $remainingAttempts = max(0, $maxAttempts - $attempts);
        
        return view('pages.contact', compact('remainingAttempts'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:20',
                'subject' => 'required|string',
                'message' => 'required|string|min:10',
            ]);

            // Create contact record in database
            Contact::create($validated);

            return redirect()->route('contact.create')
                             ->with('success', 'Terima kasih! Pesan Anda telah berhasil dikirim dan akan kami proses segera.');
                             
        } catch (\Illuminate\Http\Exceptions\ThrottleRequestsException $e) {
            // Handle rate limit exceeded
            $seconds = $e->getHeaders()['Retry-After'] ?? 300; // Default 5 minutes
            $minutes = ceil($seconds / 60);
            
            return redirect()->route('contact.create')
                             ->with('rate_limit_error', "Anda telah mencapai batas pengiriman pesan. Silakan coba lagi dalam {$minutes} menit.")
                             ->withInput();
        }
    }
}
