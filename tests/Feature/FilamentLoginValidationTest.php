<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Filament\Pages\Auth\Login;

class FilamentLoginValidationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that Filament login rejects incorrect password.
     */
    public function test_filament_login_rejects_incorrect_password(): void
    {
        // Create a test user with known password
        $user = User::factory()->create([
            'email' => 'test@gmail.com',
            'password' => Hash::make('CorrectPassword123!'),
            'role' => 'admin',
        ]);

        // Attempt to login with incorrect password
        $response = Livewire::test(Login::class)
            ->fillForm([
                'email' => 'test@gmail.com',
                'password' => 'WrongPassword123!',
            ])
            ->call('authenticate');

        // Check that there are validation errors
        $response->assertHasErrors();

        // Verify user is not authenticated
        $this->assertGuest();
    }

    /**
     * Test that Filament login accepts correct credentials.
     */
    public function test_filament_login_accepts_correct_credentials(): void
    {
        // Create a test user with known password
        $user = User::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('CorrectPassword123!'),
            'role' => 'admin',
        ]);

        // Attempt to login with correct credentials
        Livewire::test(Login::class)
            ->fillForm([
                'email' => 'admin@gmail.com',
                'password' => 'CorrectPassword123!',
            ])
            ->call('authenticate')
            ->assertHasNoErrors();

        // Verify user is authenticated
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test that login fails with non-existent email.
     */
    public function test_filament_login_rejects_non_existent_email(): void
    {
        // Attempt to login with non-existent email
        $response = Livewire::test(Login::class)
            ->fillForm([
                'email' => 'nonexistent@gmail.com',
                'password' => 'SomePassword123!',
            ])
            ->call('authenticate');

        // Check that there are validation errors
        $response->assertHasErrors();

        // Verify user is not authenticated
        $this->assertGuest();
    }

    /**
     * Test that login requires email field.
     */
    public function test_filament_login_requires_email(): void
    {
        Livewire::test(Login::class)
            ->fillForm([
                'email' => '',
                'password' => 'SomePassword123!',
            ])
            ->call('authenticate')
            ->assertHasErrors();
    }

    /**
     * Test that login requires password field.
     */
    public function test_filament_login_requires_password(): void
    {
        Livewire::test(Login::class)
            ->fillForm([
                'email' => 'test@gmail.com',
                'password' => '',
            ])
            ->call('authenticate')
            ->assertHasErrors();
    }

    /**
     * Test error message when wrong credentials are provided.
     */
    public function test_filament_login_shows_error_message_for_wrong_credentials(): void
    {
        // Create a test user
        $user = User::factory()->create([
            'email' => 'error@gmail.com',
            'password' => Hash::make('CorrectPassword123!'),
            'role' => 'user',
        ]);

        // Attempt login with wrong password
        $response = Livewire::test(Login::class)
            ->fillForm([
                'email' => 'error@gmail.com',
                'password' => 'WrongPassword!',
            ])
            ->call('authenticate');

        // Assert that errors exist (Filament shows generic error for security)
        $response->assertHasErrors();
        
        // User should not be authenticated
        $this->assertGuest();
    }

    /**
     * Test that multiple login attempts with wrong password fail.
     * This verifies the system consistently rejects wrong passwords.
     */
    public function test_filament_login_consistently_rejects_wrong_password(): void
    {
        // Create a test user
        $user = User::factory()->create([
            'email' => 'consistent@gmail.com',
            'password' => Hash::make('CorrectPassword123!'),
            'role' => 'user',
        ]);

        // Attempt login with wrong password multiple times
        for ($i = 0; $i < 3; $i++) {
            $response = Livewire::test(Login::class)
                ->fillForm([
                    'email' => 'consistent@gmail.com',
                    'password' => 'WrongPassword' . $i,
                ])
                ->call('authenticate');

            // Each attempt should fail
            $response->assertHasErrors();
            
            // User should remain unauthenticated
            $this->assertGuest();
        }
    }
}
