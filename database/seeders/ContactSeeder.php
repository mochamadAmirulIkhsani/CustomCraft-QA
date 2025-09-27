<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            [
                'first_name' => 'Ahmad',
                'last_name' => 'Rizki',
                'email' => 'ahmad.rizki@gmail.com',
                'phone' => '081234567890',
                'subject' => 'Pertanyaan Umum',
                'message' => 'Halo, saya ingin menanyakan tentang layanan custom t-shirt yang tersedia. Apakah bisa untuk quantity kecil?',
                'is_read' => false,
                'created_at' => now()->subDays(2),
            ],
            [
                'first_name' => 'Siti',
                'last_name' => 'Nurhaliza',
                'email' => 'siti.nurhaliza@yahoo.com',
                'phone' => '081987654321',
                'subject' => 'Penawaran',
                'message' => 'Saya tertarik dengan layanan banner printing untuk acara grand opening toko saya. Mohon informasi harga dan waktu pengerjaan.',
                'is_read' => true,
                'read_at' => now()->subDay(),
                'created_at' => now()->subDays(3),
            ],
            [
                'first_name' => 'Budi',
                'last_name' => 'Santoso',
                'email' => 'budi.santoso@gmail.com',
                'phone' => null,
                'subject' => 'Dukungan Teknis',
                'message' => 'File design saya tidak bisa diupload di form order. Format yang saya gunakan adalah AI. Apakah ada format lain yang disupport?',
                'is_read' => false,
                'created_at' => now()->subHours(5),
            ],
            [
                'first_name' => 'Maya',
                'last_name' => 'Putri',
                'email' => 'maya.putri@outlook.com',
                'phone' => '081765432109',
                'subject' => 'Penawaran',
                'message' => 'Apakah ada diskon khusus untuk order sticker dalam jumlah banyak? Saya membutuhkan sekitar 1000 pcs untuk promosi bisnis.',
                'is_read' => false,
                'created_at' => now()->subHours(2),
            ],
            [
                'first_name' => 'Indra',
                'last_name' => 'Kenz',
                'email' => 'indra.kenz@gmail.com',
                'phone' => '081543216789',
                'subject' => 'Pertanyaan Umum',
                'message' => 'Lokasi toko fisik di mana ya? Saya ingin lihat sample hasil printing sebelum order dalam jumlah besar.',
                'is_read' => true,
                'read_at' => now()->subHours(3),
                'created_at' => now()->subDay(),
            ],
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
