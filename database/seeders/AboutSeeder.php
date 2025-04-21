<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'judul_website' => 'Zako',
            'logo' => 'logo.png',
            'deskripsi' => 'Kami adalah toko buah dan sayur segar asal Cianjur yang mengelola langsung kebun sendiri. Kami berkomitmen menyediakan produk berkualitas tinggi, segar, dan sehat untuk keluarga Anda, langsung dari alam Cianjur ke meja makan Anda',
            'alamat' => 'Jl. Raya Cipanas No. 45, Desa Sindanglaya, Kecamatan Cipanas, Kabupaten Cianjur, Jawa Barat 43253',
            'email' => 'zaky@gmail.com',
            'telepon' => '081234567890',
            'atas_nama' => 'Achmad Zaky',
            'no_rekening' => '081234567890'
        ]);
    }
}
