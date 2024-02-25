<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_inventory_trans extends Model
{
    public function products()
    {
        return $this->hasMany(Tbl_inventory_product::class, 'inventory_trans_id', 'id');
    }
    
}
