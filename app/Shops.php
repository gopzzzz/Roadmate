<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
    protected $fillable = [
       
        'images', // assuming you have a column named 'images' in your database
    ];

   
    protected $casts = [
        'images' => 'array',
    ];
}
