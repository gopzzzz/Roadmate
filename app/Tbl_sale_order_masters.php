<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_sale_order_masters extends Model
{
    // public function saleOrderTrans()
    // {
    //     return $this->hasMany(Tbl_sale_order_trans::class, 'sale_order_id', 'id');
    // }
    
    protected $fillable = [
        'shop_id', // Add the missing field 'shop_id' to the fillable array
        'order_id',
        'incoice_number',
        'total_amount',
        'discount',
        'coupen_id',
        'wallet_redeem_id',
        'payment_mode',
        'total_mrp',
        'total_mrp',
        'shipping_charge',
        'tax_amount',
        'delivery_date',
        'order_date',
        // Add any other fields that should be fillable
    ];
}
