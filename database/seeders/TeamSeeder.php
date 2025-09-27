<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            [
                'name' => 'Muhammad Rahman',
                'position' => 'Creative Director',
                'description' => 'Memimpin tim kreatif untuk menghasilkan desain yang inovatif dan menarik dengan pengalaman lebih dari 8 tahun di industri percetakan.',
                'photo' => null, // Will use initials
                'social_links' => [
                    'linkedin' => '#',
                    'instagram' => '#',
                ],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Putri Sari',
                'position' => 'Production Manager',
                'description' => 'Mengawasi proses produksi untuk memastikan kualitas dan ketepatan waktu dengan standar internasional.',
                'photo' => null, // Will use initials
                'social_links' => [
                    'linkedin' => '#',
                    'instagram' => '#',
                ],
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Citra Dewi',
                'position' => 'Customer Relations',
                'description' => 'Memastikan kepuasan pelanggan dan memberikan layanan terbaik dengan pendekatan personal yang ramah.',
                'photo' => null, // Will use initials
                'social_links' => [
                    'linkedin' => '#',
                    'instagram' => '#',
                ],
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Ahmad Fauzi',
                'position' => 'Quality Control',
                'description' => 'Bertanggung jawab memastikan setiap produk memenuhi standar kualitas tinggi sebelum diserahkan kepada pelanggan.',
                'photo' => null, // Will use initials
                'social_links' => [
                    'linkedin' => '#',
                    'instagram' => '#',
                ],
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($teams as $teamData) {
            Team::create($teamData);
        }
    }
}
