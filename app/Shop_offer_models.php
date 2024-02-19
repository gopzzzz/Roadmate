<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop_offer_models extends Model
{
    protected $fillable = ['shop_id', 'offer_id', 'vehicle_typeid', 'brand_id', 'model_id', 'fuel_type'];

    // Set default values for attributes
    protected $attributes = [
        'fuel_type' => 0,
    ];

}
