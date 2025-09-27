<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'image_path' => 'banners/banner-1.jpg',
                'title' => 'Wujudkan Desain Impian Anda',
                'url' => null,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'image_path' => 'banners/banner-2.jpg',
                'title' => 'Kualitas Premium Harga Terjangkau',
                'url' => null,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'image_path' => 'banners/banner-3.jpg',
                'title' => 'Percetakan Digital Terdepan',
                'url' => null,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'image_path' => 'banners/banner-4.jpg',
                'title' => 'Solusi Lengkap Kebutuhan Cetak',
                'url' => null,
                'sort_order' => 4,
                'is_active' => false,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
