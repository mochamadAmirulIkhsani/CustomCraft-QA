<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Budi Santoso',
                'rating' => 5,
                'description' => 'Pelayanan sangat memuaskan! Hasil cetak kartu nama saya sangat berkualitas dan sesuai dengan yang saya harapkan. Pengerjaan juga sangat cepat.',
                'is_active' => true,
            ],
            [
                'name' => 'Sari Wulandari',
                'rating' => 5,
                'description' => 'CustomCraft adalah pilihan terbaik untuk kebutuhan percetakan. Stiker produk yang saya pesan hasilnya sangat bagus dan tahan lama.',
                'is_active' => true,
            ],
            [
                'name' => 'Ahmad Firdaus',
                'rating' => 4,
                'description' => 'Kualitas banner yang dicetak sangat bagus, warna-warnanya cerah dan tajam. Proses pemesanannya juga mudah dan responsif.',
                'is_active' => true,
            ],
            [
                'name' => 'Dewi Lestari',
                'rating' => 5,
                'description' => 'Sangat puas dengan hasil cetak undangan pernikahan saya. Desainnya elegan dan kertas yang digunakan berkualitas premium.',
                'is_active' => true,
            ],
            [
                'name' => 'Rudi Hartono',
                'rating' => 5,
                'description' => 'Tim CustomCraft sangat profesional dan kreatif. Mereka berhasil mewujudkan ide desain brosur perusahaan saya dengan sempurna.',
                'is_active' => true,
            ],
            [
                'name' => 'Maya Indrawati',
                'rating' => 4,
                'description' => 'Hasil cetak kemasan produk sangat memuaskan. Kualitas printing tajam dan finishing yang rapi. Pasti akan order lagi.',
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
