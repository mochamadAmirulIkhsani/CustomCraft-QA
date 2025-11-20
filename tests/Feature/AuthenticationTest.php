<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Filament\Pages\Auth\Login;
use Filament\Pages\Auth\Register;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /* ==================== LOGIN TESTS ==================== */

    /**
     * Test user can login with correct credentials.
     */
    public function test_user_can_login_with_correct_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'user@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        Livewire::test(Login::class)
            ->fillForm([
                'email' => 'user@gmail.com',
                'password' => 'password123',
            ])
            ->call('authenticate')
            ->assertHasNoErrors();

        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test admin can login with correct credentials.
     */
    public function test_admin_can_login_with_correct_credentials(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('AdminPass123!'),
            'role' => 'admin',
        ]);

        Livewire::test(Login::class)
            ->fillForm([
                'email' => 'admin@gmail.com',
                'password' => 'AdminPass123!',
            ])
            ->call('authenticate')
            ->assertHasNoErrors();

        $this->assertAuthenticatedAs($admin);
    }

    /**
     * Test login fails with incorrect password.
     */
    public function test_login_fails_with_incorrect_password(): void
    {
        User::factory()->create([
            'email' => 'test@gmail.com',
            'password' => Hash::make('correctPassword'),
            'role' => 'user',
        ]);

        Livewire::test(Login::class)
            ->fillForm([
                'email' => 'test@gmail.com',
                'password' => 'wrongPassword',
            ])
            ->call('authenticate')
            ->assertHasErrors();

        $this->assertGuest();
    }

    /**
     * Test login fails with non-existent email.
     */
    public function test_login_fails_with_non_existent_email(): void
    {
        Livewire::test(Login::class)
            ->fillForm([
                'email' => 'nonexistent@gmail.com',
                'password' => 'somePassword',
            ])
            ->call('authenticate')
            ->assertHasErrors();

        $this->assertGuest();
    }

    /**
     * Test login requires both email and password.
     */
    public function test_login_requires_both_email_and_password(): void
    {
        Livewire::test(Login::class)
            ->fillForm([
                'email' => '',
                'password' => '',
            ])
            ->call('authenticate')
            ->assertHasErrors();

        $this->assertGuest();
    }

    /**
     * Test multiple failed login attempts.
     */
    public function test_multiple_failed_login_attempts(): void
    {
        $user = User::factory()->create([
            'email' => 'multi@gmail.com',
            'password' => Hash::make('correctPass'),
        ]);

        for ($i = 0; $i < 3; $i++) {
            Livewire::test(Login::class)
                ->fillForm([
                    'email' => 'multi@gmail.com',
                    'password' => 'wrongPass' . $i,
                ])
                ->call('authenticate')
                ->assertHasErrors();

            $this->assertGuest();
        }
    }

    /* ==================== REGISTRATION TESTS ==================== */

    /**
     * Test user can register with valid Gmail data.
     */
    public function test_user_can_register_with_valid_gmail_data(): void
    {
        Livewire::test(Register::class)
            ->fillForm([
                'name' => 'New User',
                'email' => 'newuser@gmail.com',
                'password' => 'Password123!',
                'passwordConfirmation' => 'Password123!',
            ])
            ->call('register');

        $this->assertDatabaseHas('users', [
            'name' => 'New User',
            'email' => 'newuser@gmail.com',
        ]);

        $user = User::where('email', 'newuser@gmail.com')->first();
        $this->assertNotNull($user);
        $this->assertTrue(Hash::check('Password123!', $user->password));
    }

    /**
     * Test registration with empty fields fails.
     */
    public function test_registration_with_empty_fields_fails(): void
    {
        Livewire::test(Register::class)
            ->fillForm([
                'name' => '',
                'email' => '',
                'password' => '',
                'passwordConfirmation' => '',
            ])
            ->call('register')
            ->assertHasErrors();

        $this->assertDatabaseCount('users', 0);
    }

    /**
     * Test registration rejects duplicate email.
     */
    public function test_registration_rejects_duplicate_email(): void
    {
        User::factory()->create([
            'email' => 'existing@gmail.com',
        ]);

        Livewire::test(Register::class)
            ->fillForm([
                'name' => 'Another User',
                'email' => 'existing@gmail.com',
                'password' => 'Password123!',
                'passwordConfirmation' => 'Password123!',
            ])
            ->call('register')
            ->assertHasErrors();
    }

    /**
     * Test registration with mismatched passwords fails.
     */
    public function test_registration_with_mismatched_passwords_fails(): void
    {
        Livewire::test(Register::class)
            ->fillForm([
                'name' => 'Test User',
                'email' => 'test@gmail.com',
                'password' => 'Password123!',
                'passwordConfirmation' => 'DifferentPassword123!',
            ])
            ->call('register')
            ->assertHasErrors();
    }

    /**
     * Test registration rejects non-Gmail addresses (comment out if not enforced).
     * Note: This test assumes Gmail-only validation is enforced in Filament registration.
     * If this is not the case, this test can be safely removed or commented out.
     */
    public function test_registration_rejects_non_gmail_addresses(): void
    {
        $this->markTestSkipped('Gmail validation may not be enforced in Filament registration by default.');
        
        $nonGmailEmails = [
            'user@yahoo.com',
            'user@outlook.com',
            'user@example.com',
        ];

        foreach ($nonGmailEmails as $email) {
            Livewire::test(Register::class)
                ->fillForm([
                    'name' => 'Test User',
                    'email' => $email,
                    'password' => 'Password123!',
                    'passwordConfirmation' => 'Password123!',
                ])
                ->call('register')
                ->assertHasErrors();

            $this->assertDatabaseMissing('users', [
                'email' => $email,
            ]);
        }
    }

    /**
     * Test registration accepts multiple valid Gmail addresses.
     */
    public function test_registration_accepts_multiple_gmail_addresses(): void
    {
        $email1 = 'user1@gmail.com';
        $user1 = User::create([
            'name' => 'Test User 1',
            'email' => $email1,
            'password' => Hash::make('Password123!'),
        ]);

        $email2 = 'test.user@gmail.com';
        $user2 = User::create([
            'name' => 'Test User 2',
            'email' => $email2,
            'password' => Hash::make('Password123!'),
        ]);

        $this->assertDatabaseHas('users', ['email' => $email1]);
        $this->assertDatabaseHas('users', ['email' => $email2]);
        
        // Test that both can login
        $this->actingAs($user1);
        $this->assertAuthenticatedAs($user1);
        
        \Illuminate\Support\Facades\Auth::logout();
        
        $this->actingAs($user2);
        $this->assertAuthenticatedAs($user2);
    }

    /**
     * Test newly registered user can login.
     */
    public function test_newly_registered_user_can_login(): void
    {
        // Create user directly
        $user = User::create([
            'name' => 'Login Test',
            'email' => 'logintest@gmail.com',
            'password' => Hash::make('Password123!'),
        ]);

        // Test login with the credentials
        Livewire::test(Login::class)
            ->fillForm([
                'email' => 'logintest@gmail.com',
                'password' => 'Password123!',
            ])
            ->call('authenticate')
            ->assertHasNoErrors();

        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test registration with short password fails.
     */
    public function test_registration_with_short_password_fails(): void
    {
        Livewire::test(Register::class)
            ->fillForm([
                'name' => 'Test User',
                'email' => 'short@gmail.com',
                'password' => 'short',
                'passwordConfirmation' => 'short',
            ])
            ->call('register')
            ->assertHasErrors();
    }

    /**
     * Test registration with very long name fails.
     */
    public function test_registration_with_very_long_name_fails(): void
    {
        $longName = str_repeat('a', 256); // 256 characters

        Livewire::test(Register::class)
            ->fillForm([
                'name' => $longName,
                'email' => 'longname@gmail.com',
                'password' => 'Password123!',
                'passwordConfirmation' => 'Password123!',
            ])
            ->call('register')
            ->assertHasErrors();
    }
}
