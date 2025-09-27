<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin CustomCraft',
            'email' => 'admin@customcraft.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Seller Users
        User::create([
            'name' => 'Ahmad Seller',
            'email' => 'ahmad@seller.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Siti Seller',
            'email' => 'siti@seller.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
            'email_verified_at' => now(),
        ]);

        // Buyer Users
        User::create([
            'name' => 'Budi Buyer',
            'email' => 'budi@buyer.com',
            'password' => Hash::make('password'),
            'role' => 'buyer',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Dewi Buyer',
            'email' => 'dewi@buyer.com',
            'password' => Hash::make('password'),
            'role' => 'buyer',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Rudi Customer',
            'email' => 'rudi@customer.com',
            'password' => Hash::make('password'),
            'role' => 'buyer',
            'email_verified_at' => now(),
        ]);
    }
}
