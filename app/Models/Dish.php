<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    protected $fillable = [
        'dish_name',
        'dish_description',
        'dish_category',
        'dish_price',
        'image',         // Add image to fillable
        'status',        // Add status to fillable
    ];
}
