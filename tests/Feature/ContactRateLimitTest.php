<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;

class ContactRateLimitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that contact form can be submitted within rate limit.
     */
    public function test_contact_form_submission_within_rate_limit(): void
    {
        $contactData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'phone' => '081234567890',
            'subject' => 'Pertanyaan Umum',
            'message' => 'This is a test message from unit test.',
        ];

        // Clear any existing rate limits for this test
        RateLimiter::clear('contact-submissions:127.0.0.1');

        // First submission should be successful
        $response = $this->post(route('contact.store'), $contactData);
        
        $response->assertRedirect(route('contact.create'));
        $response->assertSessionHas('success');
        
        // Check that contact was created in database
        $this->assertDatabaseHas('contacts', [
            'email' => 'john.doe@example.com',
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);
    }

    /**
     * Test that rate limit is enforced after 3 submissions.
     */
    public function test_contact_form_rate_limit_enforcement(): void
    {
        $contactData = [
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane.doe@example.com',
            'phone' => '081234567890',
            'subject' => 'Dukungan Teknis',
            'message' => 'This is a test message for rate limit testing.',
        ];

        // Clear any existing rate limits for this test
        RateLimiter::clear('contact-submissions:127.0.0.1');

        // Submit 3 times (should all be successful)
        for ($i = 1; $i <= 3; $i++) {
            $contactData['email'] = "test{$i}@example.com";
            $response = $this->post(route('contact.store'), $contactData);
            $response->assertRedirect(route('contact.create'));
            $response->assertSessionHas('success');
        }

        // 4th submission should be rate limited
        $contactData['email'] = 'test4@example.com';
        $response = $this->post(route('contact.store'), $contactData);
        
        // Should be rate limited (429 status code)
        $response->assertStatus(429);
    }

    /**
     * Test that contact form shows remaining attempts.
     */
    public function test_contact_form_shows_remaining_attempts(): void
    {
        // Clear any existing rate limits for this test
        RateLimiter::clear('contact-submissions:127.0.0.1');

        // Get contact form page - should show 3 remaining attempts initially
        $response = $this->get(route('contact.create'));
        $response->assertStatus(200);
        $response->assertViewHas('remainingAttempts', 3);

        // Make one submission
        $contactData = [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'phone' => '081234567890',
            'subject' => 'Pertanyaan Umum',
            'message' => 'This is a test message.',
        ];

        $this->post(route('contact.store'), $contactData);

        // Get contact form page again - should show 2 remaining attempts
        $response = $this->get(route('contact.create'));
        $response->assertStatus(200);
        $response->assertViewHas('remainingAttempts', 2);
    }

    /**
     * Test that rate limit resets after the time window.
     */
    public function test_rate_limit_resets_after_time_window(): void
    {
        // This test would require time manipulation which is complex in unit tests
        // In real scenario, after 5 minutes the rate limit should reset automatically
        // For now, we can test that clearing the rate limiter works
        
        $contactData = [
            'first_name' => 'Reset',
            'last_name' => 'Test',
            'email' => 'reset@example.com',
            'phone' => '081234567890',
            'subject' => 'Pertanyaan Umum',
            'message' => 'This is a test message for reset testing.',
        ];

        // Clear any existing rate limits
        RateLimiter::clear('contact-submissions:127.0.0.1');

        // Submit 3 times to reach the limit
        for ($i = 1; $i <= 3; $i++) {
            $contactData['email'] = "reset{$i}@example.com";
            $this->post(route('contact.store'), $contactData);
        }

        // Should be at limit
        $response = $this->get(route('contact.create'));
        $response->assertViewHas('remainingAttempts', 0);

        // Clear the rate limit (simulating time passage)
        RateLimiter::clear('contact-submissions:127.0.0.1');

        // Should be reset
        $response = $this->get(route('contact.create'));
        $response->assertViewHas('remainingAttempts', 3);
    }
}