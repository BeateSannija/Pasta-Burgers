<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DishSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('dishes')->insert([
        [    'dish_name' => 'Veģetārais burgers',
            'dish_description' => 'Šampinjoni, pupiņas, sarkanais sīpols, ķiploks, siers, gurķu mērce, salātlapas, tomāts, marinēts gurķis. Frī + mērcīte vai 0,33l dzēriens',
            'dish_category' => 'burgeru-komplekti',
            'dish_price' => '9.00',
            'image' => 'images/veg_burgers.jpg',
            'status' => 'Pieejams',
            'created_at' => now(),
            'updated_at' => now(),
            'dish_name_en' => 'Vegetarian burger',
            'dish_description_en' =>'Mushrooms, beans, red onion, garlic, cheese, cucumber sauce, lettuce, tomato, pickled cucumber. Fries + sauce or 0.33l drink',
        ],
        [
            'dish_name' => 'Cēzara salāti ar bekonu',
            'dish_description' => 'Romiešu lapas, bekons, Parmezāns, grauzdiņi, Cēzera mērce, ķiršu tomāti',
            'dish_category' => 'salati',
            'dish_price' => '7.50',
            'image' => 'images/cezara_bekons.jpg',
            'status' => 'Pieejams',
            'created_at' => now(),
            'updated_at' => now(),
            'dish_name_en' => 'Ceaser salad with bacon',
            'dish_description_en' =>'Romaine lettuce, bacon, Parmesan, toast, Caesar dressing, cherry tomatoes',
        ],
        [
            'dish_name' => 'Cēzara salāti ar grilētu vistas fileju',
            'dish_description' => 'Romiešu lapas, grilēta vistas fileja, grauzdiņi, Cēzera mērce, ķiršu tomāti',
            'dish_category' => 'salati',
            'dish_price' => '7.50',
            'image' => 'images/pasta_vista.jpg',
            'status' => 'Pieejams',
            'created_at' => now(),
            'updated_at' => now(),
            'dish_name_en' => 'Ceaser salad with grilled chicken fillet',
            'dish_description_en' =>'Romaine lettuce, grilled chicken fillet, toast, Caesar dressing, cherry tomatoes',
        ]
    ]);
    }
}
