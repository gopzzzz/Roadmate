<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class AccountController extends Controller
{
    public function revenue_master(){
        $role=Auth::user()->user_type;
        $order_trans=DB::table('tbl_sale_order_trans')
         ->leftJoin('tbl_sale_order_masters', 'tbl_sale_order_trans.order_id', '=', 'tbl_sale_order_masters.id')
        ->leftJoin('shops', 'tbl_sale_order_masters.shop_id', '=', 'shops.id')
        ->leftJoin('tbl_brand_products', 'tbl_sale_order_trans.product_id', '=', 'tbl_brand_products.id')
		->leftJoin('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
        ->select('tbl_sale_order_trans.*','tbl_sale_order_masters.invoice_number','tbl_brand_products.product_name','tbl_brand_products.offer_price','tbl_brand_products.prate','tbl_hsncodes.tax','shops.shopname')
        ->orderby('tbl_sale_order_trans.id','desc')
        ->paginate(20);

        return view('accounts.revenue_master',compact('role','order_trans'));
        //echo "<pre>";print_r($order_trans);exit;


	 
    }
    public function profit(){
        $role=Auth::user()->user_type;
        $order_trans=DB::table('tbl_sale_order_trans')
        ->leftJoin('tbl_sale_order_masters', 'tbl_sale_order_trans.order_id', '=', 'tbl_sale_order_masters.id')
        ->leftJoin('tbl_brand_products', 'tbl_sale_order_trans.product_id', '=', 'tbl_brand_products.id')
       ->leftJoin('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
       ->select('tbl_sale_order_trans.*','tbl_brand_products.prate','tbl_hsncodes.tax')
       ->get();
       $expense=DB::table('tbl_expenses')->sum('amount');
        $totalRevenue = 0;
        $turnover =0;

                foreach ($order_trans as $order) {

                    $r1=round(($order->offer_amount)/(1+$order->tax/100));
                    $r2=$order->prate;
                    $rev=$r1-$r2;
                    // Calculate revenue for each order transaction
                    $revenue =$order->qty *  $rev; // Assuming quantity is available in $order_trans

                   
                    
                    // Add revenue from this order transaction to total revenue
                    $turnover +=$order->offer_amount;
                    $totalRevenue += $revenue;
                }

                
        return view('accounts.profit',compact('role','totalRevenue','expense','turnover'));
    
    }
    public function turnover(){
    
    }
   
}
