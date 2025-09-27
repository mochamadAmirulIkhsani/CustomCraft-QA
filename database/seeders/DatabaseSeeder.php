<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan semua seeder secara berurutan
        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
            BannerSeeder::class,
            TestimonialSeeder::class,
            PortfolioSeeder::class,
            TeamSeeder::class,
        ]);
    }
}
