<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_sale_order_trans extends Model
{
    public function saleOrderMaster()
    {
        return $this->belongsTo(Tbl_sale_order_masters::class, 'sale_order_id');
        
    }

protected $fillable = ['order_id', 'product_id', 'sale_order_id', 'qty', 'offer_amount', 'price', 'taxable_amount'];

}
