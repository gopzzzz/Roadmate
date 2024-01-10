<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_placeorders extends Model
{
    protected $table = 'tbl_placeorders';

    protected $fillable = ['product_id', 'qnty', 'price'];
}
