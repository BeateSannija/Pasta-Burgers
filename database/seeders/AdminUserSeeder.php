<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'usertype' => 'admin',
            'phone' => '00000000',
            'address' => 'Admin iela 1',
            'password' => Hash::make('parole123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
