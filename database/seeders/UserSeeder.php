<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'zaky',
            'email' => 'achmadzaky477@gmail.com',
            'role' => 'owner',
            'password' => bcrypt('123qweasd'),
            'email_verified_at' => now()
        ]);
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('123qweasd'),
            'email_verified_at' => now()
        ]);
    }
}
