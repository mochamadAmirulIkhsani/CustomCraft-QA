<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

describe('Login Unit Tests', function () {
    
    beforeEach(function () {
        $this->user = User::factory()->create([
            'email' => 'test@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
    });

    test('user credentials can be validated correctly', function () {
        expect(Hash::check('password123', $this->user->password))->toBeTrue();
    });

    test('user credentials validation fails with wrong password', function () {
        expect(Hash::check('wrongpassword', $this->user->password))->toBeFalse();
    });

    test('user email is stored correctly', function () {
        expect($this->user->email)->toBe('test@gmail.com');
    });

    test('user role is stored correctly', function () {
        expect($this->user->role)->toBe('user');
    });

    test('admin user can be created with admin role', function () {
        $admin = User::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('AdminPass123!'),
            'role' => 'admin',
        ]);

        expect($admin->role)->toBe('admin')
            ->and($admin->email)->toBe('admin@gmail.com')
            ->and(Hash::check('AdminPass123!', $admin->password))->toBeTrue();
    });

    test('password is hashed when stored', function () {
        $plainPassword = 'password123';
        $hashedPassword = Hash::make($plainPassword);
        
        expect($hashedPassword)->not->toBe($plainPassword)
            ->and(Hash::check($plainPassword, $hashedPassword))->toBeTrue();
    });

    test('user model has required fillable fields', function () {
        $fillable = (new User())->getFillable();
        
        expect($fillable)->toContain('name')
            ->and($fillable)->toContain('email')
            ->and($fillable)->toContain('password')
            ->and($fillable)->toContain('role');
    });

    test('user model hides password and remember_token', function () {
        $hidden = (new User())->getHidden();
        
        expect($hidden)->toContain('password')
            ->and($hidden)->toContain('remember_token');
    });

    test('multiple users can have different credentials', function () {
        $user1 = User::factory()->create(['email' => 'user1@gmail.com']);
        $user2 = User::factory()->create(['email' => 'user2@gmail.com']);
        
        expect($user1->email)->not->toBe($user2->email)
            ->and($user1->id)->not->toBe($user2->id);
    });

    test('user email must be unique', function () {
        User::factory()->create(['email' => 'unique@gmail.com']);
        
        expect(fn() => User::factory()->create(['email' => 'unique@gmail.com']))
            ->toThrow(\Illuminate\Database\QueryException::class);
    });
});
