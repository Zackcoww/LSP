<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'product_name' => 'Apel',
            'category' => 'buah',
            'price' => 25000,
            'stok' => 50,
            'foto1' => 'apple.jpg',
            'foto2' => 'apple2.jpeg',
            'foto3' => 'apple3.jpeg',
            'deskripsi' => 'Apel segar dari kebun kami di Cianjur, manis dan renyah.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'product_name' => 'Pisang',
            'category' => 'buah',
            'price' => 18000,
            'stok' => 70,
            'foto1' => 'banana.jpeg',
            'foto2' => 'banana2.jpeg',
            'foto3' => 'banana3.jpeg',
            'deskripsi' => 'Pisang matang alami, cocok untuk camilan sehat atau olahan kue.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'product_name' => 'Bayam',
            'category' => 'sayur',
            'price' => 8000,
            'stok' => 100,
            'foto1' => 'bayam.jpeg',
            'foto2' => 'bayam2.jpeg',
            'foto3' => 'bayam3.jpeg',
            'deskripsi' => 'Bayam segar kaya zat besi, langsung dipetik dari kebun organik kami.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'product_name' => 'Brokoli',
            'category' => 'sayur',
            'price' => 20000,
            'stok' => 60,
            'foto1' => 'brok.jpeg',
            'foto2' => 'brok2.jpeg',
            'foto3' => 'brok3.jpg',
            'deskripsi' => 'Brokoli hijau segar, cocok untuk salad dan tumisan sehat.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'product_name' => 'Jagung',
            'category' => 'sayur',
            'price' => 12000,
            'stok' => 80,
            'foto1' => 'corn.png',
            'foto2' => 'corn2.jpeg',
            'foto3' => 'corn3.jpeg',
            'deskripsi' => 'Jagung manis, cocok untuk direbus, dibakar, atau campuran sayur.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'product_name' => 'Kol',
            'category' => 'sayur',
            'price' => 9000,
            'stok' => 90,
            'foto1' => 'kol.jpg',
            'foto2' => 'kol2.jpg',
            'foto3' => 'kol3.jpeg',
            'deskripsi' => 'Kol renyah dan segar, sempurna untuk lalapan atau masakan tumis.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'product_name' => 'Mangga',
            'category' => 'buah',
            'price' => 22000,
            'stok' => 55,
            'foto1' => 'mangga.jpeg',
            'foto2' => 'mangga2.jpeg',
            'foto3' => 'mangga3.jpg',
            'deskripsi' => 'Mangga manis dan harum, langsung dari kebun tropis kami.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'product_name' => 'Melon',
            'category' => 'buah',
            'price' => 20000,
            'stok' => 60,
            'foto1' => 'melon.jpeg',
            'foto2' => 'melon2.jpeg',
            'foto3' => 'melon3.jpeg',
            'deskripsi' => 'Melon segar, lembut dan manis, cocok disantap dingin.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'product_name' => 'Naga',
            'category' => 'buah',
            'price' => 24000,
            'stok' => 40,
            'foto1' => 'naga.jpeg',
            'foto2' => 'naga2.jpeg',
            'foto3' => 'naga3.jpeg',
            'deskripsi' => 'Buah naga kaya antioksidan, baik untuk kesehatan dan tampilan menarik.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'product_name' => 'Pepaya',
            'category' => 'buah',
            'price' => 15000,
            'stok' => 65,
            'foto1' => 'pepaya.jpeg',
            'foto2' => 'pepaya2.jpeg',
            'foto3' => 'pepaya3.jpeg',
            'deskripsi' => 'Pepaya matang dan segar, kaya vitamin C dan baik untuk pencernaan.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

    }
}

