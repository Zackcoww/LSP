<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CustomersSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [
                'nama_customer' => 'Dayu',
                'no_hp' => '081234567890',
                'email' => 'dayu@gmail.com',
                'address' => 'Jl. Sukamaju No. 5, Cianjur',
            ],
            [
                'nama_customer' => 'Doni',
                'no_hp' => '082345678901',
                'email' => 'doni@gmail.com',
                'address' => 'Jl. Cikidang No. 12, Cianjur',
            ],
            [
                'nama_customer' => 'Sonic',
                'no_hp' => '083456789012',
                'email' => 'sonic@gmail.com',
                'address' => 'Jl. Sukanagara No. 21, Cianjur',
            ],
        ];

        foreach ($customers as $customer) {
            DB::table('customers')->insert([
                'nama_customer' => $customer['nama_customer'],
                'no_hp' => $customer['no_hp'],
                'email' => $customer['email'],
                'address' => $customer['address'],
                'password' => bcrypt('123qweasd'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
