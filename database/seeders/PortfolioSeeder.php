<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $portfolios = [
            [
                'name' => 'Custom T-Shirt Design',
                'slug' => 'custom-tshirt-design',
                'description' => '<p>Proyek desain dan pencetakan t-shirt custom untuk perusahaan teknologi. Menggunakan bahan katun berkualitas tinggi dengan sablon DTG untuk hasil yang tahan lama dan warna yang tajam.</p><p>Spesifikasi:</p><ul><li>Bahan: Cotton Combed 30s</li><li>Teknik: Direct to Garment (DTG)</li><li>Jumlah: 500 pcs</li><li>Variasi: 5 desain berbeda</li></ul>',
                'image' => null, // Will be set manually if needed
                'is_active' => true,
            ],
            [
                'name' => 'Corporate Branding Package',
                'slug' => 'corporate-branding-package',
                'description' => '<p>Paket branding lengkap untuk startup fintech meliputi logo design, business card, letterhead, dan merchandise. Konsep modern minimalis dengan sentuhan warna biru dan emas.</p><p>Deliverables:</p><ul><li>Logo design (berbagai format)</li><li>Business card premium</li><li>Letterhead resmi</li><li>Envelope custom</li><li>Merchandise (mug, notebook, pen)</li></ul>',
                'image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Wedding Invitation Suite',
                'slug' => 'wedding-invitation-suite',
                'description' => '<p>Desain undangan pernikahan elegan dengan tema vintage floral. Menggunakan kertas art paper 260gsm dengan finishing spot UV dan emboss untuk kesan mewah.</p><p>Package includes:</p><ul><li>Main invitation card</li><li>RSVP card</li><li>Thank you card</li><li>Envelope dengan custom liner</li><li>Wax seal custom</li></ul>',
                'image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Food Packaging Design',
                'slug' => 'food-packaging-design',
                'description' => '<p>Desain kemasan makanan untuk produk UMKM keripik singkong. Fokus pada identitas lokal dengan warna-warna hangat dan ilustrasi yang menarik untuk target pasar modern.</p><p>Features:</p><ul><li>Desain kemasan stand up pouch</li><li>Logo dan branding produk</li><li>Nutritional fact layout</li><li>Barcode integration</li><li>Food grade material</li></ul>',
                'image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Event Banner & Signage',
                'slug' => 'event-banner-signage',
                'description' => '<p>Proyek signage lengkap untuk event tech conference termasuk backdrop, banner, roll banner, dan directional signage. Desain konsisten dengan brand identity event.</p><p>Specifications:</p><ul><li>Main backdrop 6x3 meter</li><li>Welcome banner 2x1 meter</li><li>Roll banner 10 pcs</li><li>Directional signage</li><li>Material: Flexi Korea 440gsm</li></ul>',
                'image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Digital Menu Board',
                'slug' => 'digital-menu-board',
                'description' => '<p>Desain menu board digital untuk restoran modern. Interface yang user-friendly dengan kategorisasi yang jelas dan gambar makanan yang menggugah selera.</p><p>Features:</p><ul><li>Interactive menu navigation</li><li>High-resolution food photography</li><li>Multi-language support</li><li>Price management system</li><li>Responsive design</li></ul>',
                'image' => null,
                'is_active' => true,
            ],
        ];

        foreach ($portfolios as $portfolio) {
            Portfolio::create($portfolio);
        }
    }
}
