<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;     //by default was here

    //protected $fillable = ['user_id', 'dish_id'];

    public function user()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function dish()
    {
        return $this->hasOne('App\Models\Dish','id','dish_id');
    }
}
