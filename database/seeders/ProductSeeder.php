<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'nama_produk' => 'Kartu Nama Premium',
                'deskripsi' => '<p>Kartu nama berkualitas tinggi dengan bahan <strong>art paper 310gsm</strong>, laminasi doff dan finishing yang elegan.</p><p>Cocok untuk profesional dan pengusaha yang ingin memberikan kesan premium dan profesional.</p>',
                'no_whatsapp' => '6287765748275',
                'image' => '01JXX55G2FP2R9695FK303Y926.jpg',
                'image2' => '01JXX5DJQ4ENA9HYVE26Q3V1FP.png',
                'image3' => null,
                'image4' => null,
            ],
            [
                'nama_produk' => 'Banner Event',
                'deskripsi' => '<p>Banner berkualitas tinggi untuk berbagai acara dan promosi.</p><p>Menggunakan bahan <strong>flexi korea</strong> dengan tinta eco-solvent yang tahan cuaca dan tidak mudah pudar.</p>',
                'no_whatsapp' => '6287765748275',
                'image' => '01JXX5DJQ7B7SZM87WF3B521VX.png',
                'image2' => '01JXX5DJQ9VAVMCT3GV9B0ZF7K.png',
                'image3' => '01JXX78GCVJVFEAQ7EWE5C3Q3X.png',
                'image4' => null,
            ],
            [
                'nama_produk' => 'Sticker Custom',
                'deskripsi' => '<p>Sticker custom dengan berbagai ukuran dan bentuk sesuai kebutuhan Anda.</p><p>Bahan <strong>vinyl premium</strong> yang tahan air, tahan sinar UV, dan mudah dipasang. Cocok untuk branding produk dan promosi.</p>',
                'no_whatsapp' => '6287765748275',
                'image' => '01JXX7ZFACK5YYTT81XYK00W30.png',
                'image2' => '01JXX81C7BFY31QJYEBGAAHEQY.png',
                'image3' => null,
                'image4' => null,
            ],
            [
                'nama_produk' => 'Brosur Company Profile',
                'deskripsi' => '<p>Brosur company profile dengan desain profesional dan berkualitas tinggi.</p><p>Menggunakan <strong>art paper 150gsm</strong> dengan finishing laminasi doff untuk kesan premium dan tahan lama.</p>',
                'no_whatsapp' => '6287765748275',
                'image' => '01JXX836QRF6MS52XPDH2WZ3JP.png',
                'image2' => '01JXX84D32SMBZJYEFDZ3NAXVH.png',
                'image3' => '01JXX85HZ2EEEX1D1QY5TQQR7X.png',
                'image4' => '01JY0K3P1GR5HYCDE60X6XKYF5.png',
            ],
            [
                'nama_produk' => 'Undangan Pernikahan',
                'deskripsi' => '<p>Undangan pernikahan dengan desain elegan dan romantis untuk hari spesial Anda.</p><p>Tersedia berbagai pilihan kertas premium seperti <strong>jasmine, linen, dan art carton</strong> dengan finishing emboss.</p>',
                'no_whatsapp' => '6287765748275',
                'image' => '01K64N4FCNV2DC0T5C8Z2NEMPD.png',
                'image2' => '01JXX55G2FP2R9695FK303Y926.jpg',
                'image3' => '01JXX5DJQ4ENA9HYVE26Q3V1FP.png',
                'image4' => null,
            ],
            [
                'nama_produk' => 'Kemasan Produk',
                'deskripsi' => '<p>Kemasan produk custom dengan berbagai bentuk dan ukuran sesuai kebutuhan bisnis Anda.</p><p>Bahan <strong>duplex atau art carton</strong> dengan laminasi UV untuk daya tahan extra dan tampilan mengkilap.</p>',
                'no_whatsapp' => '6287765748275',
                'image' => '01JXX7ZFACK5YYTT81XYK00W30.png',
                'image2' => '01JXX836QRF6MS52XPDH2WZ3JP.png',
                'image3' => null,
                'image4' => null,
            ],
            [
                'nama_produk' => 'Poster Promosi',
                'deskripsi' => '<p>Poster promosi dengan kualitas cetak foto dan warna yang tajam serta vibrant.</p><p>Cocok untuk promosi produk, event, atau kampanye pemasaran dengan hasil yang <strong>eye-catching</strong>.</p>',
                'no_whatsapp' => '6287765748275',
                'image' => '01JXX85HZ2EEEX1D1QY5TQQR7X.png',
                'image2' => '01JY0K3P1GR5HYCDE60X6XKYF5.png',
                'image3' => '01K64N4FCNV2DC0T5C8Z2NEMPD.png',
                'image4' => null,
            ],
            [
                'nama_produk' => 'Kalender Custom',
                'deskripsi' => '<p>Kalender custom dengan desain personal atau corporate sesuai brand Anda.</p><p>Tersedia kalender <strong>meja, dinding, dan saku</strong> dengan bahan berkualitas dan spiral yang kuat.</p>',
                'no_whatsapp' => '6287765748275',
                'image' => '01JXX84D32SMBZJYEFDZ3NAXVH.png',
                'image2' => '01JXX7ZFACK5YYTT81XYK00W30.png',
                'image3' => null,
                'image4' => null,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
