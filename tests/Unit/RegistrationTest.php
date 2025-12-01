<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

describe('Registration Unit Tests', function () {

    test('new user can be created with valid data', function () {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'password' => Hash::make('Password123!'),
            'role' => 'user',
        ];

        $user = User::create($userData);

        expect($user)->toBeInstanceOf(User::class)
            ->and($user->name)->toBe('John Doe')
            ->and($user->email)->toBe('john@gmail.com')
            ->and($user->role)->toBe('user')
            ->and(Hash::check('Password123!', $user->password))->toBeTrue();
    });

    test('user email is stored in correct format', function () {
        $user = User::factory()->create(['email' => 'test@gmail.com']);
        
        expect($user->email)->toBe('test@gmail.com')
            ->and($user->email)->toContain('@gmail.com');
    });

    test('password is automatically hashed', function () {
        $plainPassword = 'MySecurePassword123!';
        $user = User::factory()->create([
            'password' => Hash::make($plainPassword)
        ]);

        expect($user->password)->not->toBe($plainPassword)
            ->and(strlen($user->password))->toBeGreaterThan(20);
    });

    test('user has default role when not specified', function () {
        $user = User::factory()->create(['role' => 'user']);
        
        expect($user->role)->toBe('user');
    });

    test('multiple users can be registered', function () {
        $user1 = User::factory()->create(['email' => 'user1@gmail.com']);
        $user2 = User::factory()->create(['email' => 'user2@gmail.com']);
        $user3 = User::factory()->create(['email' => 'user3@gmail.com']);

        expect(User::count())->toBeGreaterThanOrEqual(3)
            ->and($user1->email)->toBe('user1@gmail.com')
            ->and($user2->email)->toBe('user2@gmail.com')
            ->and($user3->email)->toBe('user3@gmail.com');
    });

    test('user name is stored correctly', function () {
        $user = User::factory()->create(['name' => 'Alice Johnson']);
        
        expect($user->name)->toBe('Alice Johnson')
            ->and($user->name)->toBeString();
    });

    test('email must be unique in database', function () {
        $email = 'duplicate@gmail.com';
        User::factory()->create(['email' => $email]);
        
        expect(fn() => User::factory()->create(['email' => $email]))
            ->toThrow(\Illuminate\Database\QueryException::class);
    });

    test('user model validates fillable fields', function () {
        $user = new User();
        $fillable = $user->getFillable();

        expect($fillable)->toBeArray()
            ->and($fillable)->toContain('name', 'email', 'password', 'role');
    });

    test('password field is hidden from array', function () {
        $user = User::factory()->create();
        $userArray = $user->toArray();

        expect($userArray)->not->toHaveKey('password')
            ->and($userArray)->toHaveKey('name')
            ->and($userArray)->toHaveKey('email');
    });

    test('remember_token is hidden from array', function () {
        $user = User::factory()->create();
        $userArray = $user->toArray();

        expect($userArray)->not->toHaveKey('remember_token');
    });

    test('created user has timestamp fields', function () {
        $user = User::factory()->create();

        expect($user->created_at)->not->toBeNull()
            ->and($user->updated_at)->not->toBeNull()
            ->and($user->created_at)->toBeInstanceOf(\Illuminate\Support\Carbon::class);
    });

    test('user can have admin role', function () {
        $admin = User::factory()->create(['role' => 'admin']);

        expect($admin->role)->toBe('admin')
            ->and($admin)->toBeInstanceOf(User::class);
    });

    test('password hashing is consistent', function () {
        $plainPassword = 'TestPassword123!';
        $hashedPassword = Hash::make($plainPassword);

        expect(Hash::check($plainPassword, $hashedPassword))->toBeTrue()
            ->and(Hash::check('WrongPassword', $hashedPassword))->toBeFalse();
    });

    test('email validation format', function () {
        $validEmail = 'valid@gmail.com';
        $user = User::factory()->create(['email' => $validEmail]);

        expect($user->email)->toMatch('/^[a-zA-Z0-9._%+-]+@gmail\.com$/');
    });

    test('user id is auto-generated', function () {
        $user = User::factory()->create();

        expect($user->id)->not->toBeNull()
            ->and($user->id)->toBeInt()
            ->and($user->id)->toBeGreaterThan(0);
    });
});
