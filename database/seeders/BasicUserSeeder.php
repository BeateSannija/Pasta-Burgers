<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class BasicUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Justine Klava',
            'email' => 'justine@example.com',
            'usertype' => 'user',
            'phone' => '20000000',
            'address' => 'Testa iela 1',
            'password' => Hash::make('parole123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
