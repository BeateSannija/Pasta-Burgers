<?php

namespace Database\Seeders;


use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\DishSeeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            DishSeeder::class,
            BasicUserSeeder::class,
        ]);

    }
}
