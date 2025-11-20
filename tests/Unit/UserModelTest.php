<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that user password is hashed when creating a user.
     */
    public function test_user_password_is_hashed(): void
    {
        $password = 'plainPassword123!';
        
        $user = User::factory()->create([
            'password' => $password,
        ]);

        $this->assertNotEquals($password, $user->password);
        $this->assertTrue(Hash::check($password, $user->password));
    }

    /**
     * Test that user can be created with fillable attributes.
     */
    public function test_user_can_be_created_with_fillable_attributes(): void
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ];

        $user = User::create($userData);

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'role' => 'user',
        ]);

        $this->assertEquals('John Doe', $user->name);
        $this->assertEquals('john@gmail.com', $user->email);
        $this->assertEquals('user', $user->role);
    }

    /**
     * Test that password and remember_token are hidden from array.
     */
    public function test_password_and_token_are_hidden(): void
    {
        $user = User::factory()->create([
            'password' => 'password123',
            'remember_token' => 'token123',
        ]);

        $userArray = $user->toArray();

        $this->assertArrayNotHasKey('password', $userArray);
        $this->assertArrayNotHasKey('remember_token', $userArray);
    }

    /**
     * Test that user has correct casts.
     */
    public function test_user_has_correct_casts(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $user->email_verified_at);
    }

    /**
     * Test user factory creates user with valid data.
     */
    public function test_user_factory_creates_valid_user(): void
    {
        $user = User::factory()->create();

        $this->assertNotNull($user->name);
        $this->assertNotNull($user->email);
        $this->assertNotNull($user->password);
        $this->assertIsString($user->email);
        $this->assertStringContainsString('@', $user->email);
    }

    /**
     * Test user can have different roles.
     */
    public function test_user_can_have_different_roles(): void
    {
        $adminUser = User::factory()->create(['role' => 'admin']);
        $regularUser = User::factory()->create(['role' => 'user']);
        $buyerUser = User::factory()->create(['role' => 'buyer']);
        $sellerUser = User::factory()->create(['role' => 'seller']);

        $this->assertEquals('admin', $adminUser->role);
        $this->assertEquals('user', $regularUser->role);
        $this->assertEquals('buyer', $buyerUser->role);
        $this->assertEquals('seller', $sellerUser->role);
    }

    /**
     * Test that email is unique.
     */
    public function test_user_email_must_be_unique(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        User::factory()->create(['email' => 'unique@gmail.com']);
        User::factory()->create(['email' => 'unique@gmail.com']);
    }

    /**
     * Test user model uses HasFactory trait.
     */
    public function test_user_model_uses_has_factory_trait(): void
    {
        $this->assertTrue(method_exists(User::class, 'factory'));
    }

    /**
     * Test user model uses Notifiable trait.
     */
    public function test_user_model_uses_notifiable_trait(): void
    {
        $user = User::factory()->create();
        
        $this->assertTrue(method_exists($user, 'notify'));
        $this->assertTrue(method_exists($user, 'notifyNow'));
    }
}
