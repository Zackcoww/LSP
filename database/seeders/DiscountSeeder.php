<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DiscountsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('discounts')->insert([
            [
                'id_barang' => 0,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(10),
                'percentage' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_barang' => 2,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(7),
                'percentage' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_barang' => 4,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(5),
                'percentage' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
