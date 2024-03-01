<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class AccountController extends Controller
{
    public function revenue_master(){
        $userid=Auth::user()->id;
        $role=Auth::user()->user_type;
        if($role==1){
            $order_trans=DB::table('tbl_sale_order_trans')
            ->leftJoin('tbl_sale_order_masters', 'tbl_sale_order_trans.order_id', '=', 'tbl_sale_order_masters.id')
           ->leftJoin('shops', 'tbl_sale_order_masters.shop_id', '=', 'shops.id')
           ->leftJoin('tbl_brand_products', 'tbl_sale_order_trans.product_id', '=', 'tbl_brand_products.id')
           ->leftJoin('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
           ->select('tbl_sale_order_trans.*','tbl_sale_order_masters.invoice_number','tbl_brand_products.product_name','tbl_brand_products.offer_price','tbl_brand_products.prate','tbl_hsncodes.tax','shops.shopname')
           ->orderby('tbl_sale_order_trans.id','desc')
        ->paginate(20);
        }else{
             
			$fran = DB::table('tbl_franchase_details')
			->leftJoin('tbl_franchises', 'tbl_franchase_details.franchise_id', '=', 'tbl_franchises.id')
			->where('tbl_franchises.user_id', $userid)
			->select('tbl_franchase_details.*')
			->get();
		
		$order_trans = collect();
		
		foreach ($fran as $singleFranlist) {
			if ($singleFranlist->type == 4) {
			

                    $shopsQuery=DB::table('tbl_sale_order_trans')
                    ->leftJoin('tbl_sale_order_masters', 'tbl_sale_order_trans.order_id', '=', 'tbl_sale_order_masters.id')
                   ->leftJoin('shops', 'tbl_sale_order_masters.shop_id', '=', 'shops.id')
                   ->leftJoin('tbl_places', 'shops.place_id', '=', 'tbl_places.id')
                   ->leftJoin('tbl_brand_products', 'tbl_sale_order_trans.product_id', '=', 'tbl_brand_products.id')
                   ->leftJoin('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
                   ->where('tbl_places.district_id', $singleFranlist->district_id)
                   ->select('tbl_sale_order_trans.*','tbl_sale_order_masters.invoice_number','tbl_brand_products.product_name','tbl_brand_products.offer_price','tbl_brand_products.prate','tbl_hsncodes.tax','shops.shopname');
			
               
                } else {
				
                    
                    $shopsQuery=DB::table('tbl_sale_order_trans')
                    ->leftJoin('tbl_sale_order_masters', 'tbl_sale_order_trans.order_id', '=', 'tbl_sale_order_masters.id')
                   ->leftJoin('shops', 'tbl_sale_order_masters.shop_id', '=', 'shops.id')
                   ->leftJoin('tbl_places', 'shops.place_id', '=', 'tbl_places.id')
                   ->leftJoin('tbl_brand_products', 'tbl_sale_order_trans.product_id', '=', 'tbl_brand_products.id')
                   ->leftJoin('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
                   ->where('tbl_places.id', $singleFranlist->place_id)
                   ->select('tbl_sale_order_trans.*','tbl_sale_order_masters.invoice_number','tbl_brand_products.product_name','tbl_brand_products.offer_price','tbl_brand_products.prate','tbl_hsncodes.tax','shops.shopname');
			
			}
		
			$order_trans = $order_trans->merge($shopsQuery->get());
		}
		
		// Pagination
		$perPage = 12;
		$page = request()->get('page', 1);
		
		// Convert $shops collection to a paginator instance
		$order_trans = new \Illuminate\Pagination\LengthAwarePaginator(
			$order_trans->forPage($page, $perPage),
			$order_trans->count(),
			$perPage,
			$page,
			['path' => request()->url(), 'query' => request()->query()]
		);
		
        }
     
      

        return view('accounts.revenue_master',compact('role','order_trans'));
        //echo "<pre>";print_r($order_trans);exit;


	 
    }
    public function profit(){
        $role=Auth::user()->user_type;
        $userid=Auth::user()->id;
        if($role==1){
            $order_trans=DB::table('tbl_sale_order_trans')
            ->leftJoin('tbl_sale_order_masters', 'tbl_sale_order_trans.order_id', '=', 'tbl_sale_order_masters.id')
            ->leftJoin('tbl_brand_products', 'tbl_sale_order_trans.product_id', '=', 'tbl_brand_products.id')
           ->leftJoin('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
           ->select('tbl_sale_order_trans.*','tbl_brand_products.prate','tbl_hsncodes.tax')
           ->get();
        }else{
               
			$fran = DB::table('tbl_franchase_details')
			->leftJoin('tbl_franchises', 'tbl_franchase_details.franchise_id', '=', 'tbl_franchises.id')
			->where('tbl_franchises.user_id', $userid)
			->select('tbl_franchase_details.*')
			->get();
		
		$order_trans = collect();
		
		foreach ($fran as $singleFranlist) {
			if ($singleFranlist->type == 4) {
			
                $shopsQuery=DB::table('tbl_sale_order_trans')
                ->leftJoin('tbl_sale_order_masters', 'tbl_sale_order_trans.order_id', '=', 'tbl_sale_order_masters.id')
               ->leftJoin('shops', 'tbl_sale_order_masters.shop_id', '=', 'shops.id')
               ->leftJoin('tbl_places', 'shops.place_id', '=', 'tbl_places.id')
               ->leftJoin('tbl_brand_products', 'tbl_sale_order_trans.product_id', '=', 'tbl_brand_products.id')
               ->leftJoin('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
               ->where('tbl_places.district_id', $singleFranlist->district_id)
               ->select('tbl_sale_order_trans.*','tbl_sale_order_masters.invoice_number','tbl_brand_products.product_name','tbl_brand_products.offer_price','tbl_brand_products.prate','tbl_hsncodes.tax','shops.shopname');
        
             
                
                } else {
				    $shopsQuery=DB::table('tbl_sale_order_trans')
                    ->leftJoin('tbl_sale_order_masters', 'tbl_sale_order_trans.order_id', '=', 'tbl_sale_order_masters.id')
                   ->leftJoin('shops', 'tbl_sale_order_masters.shop_id', '=', 'shops.id')
                   ->leftJoin('tbl_places', 'shops.place_id', '=', 'tbl_places.id')
                   ->leftJoin('tbl_brand_products', 'tbl_sale_order_trans.product_id', '=', 'tbl_brand_products.id')
                   ->leftJoin('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
                   ->where('tbl_places.id', $singleFranlist->place_id)
                   ->select('tbl_sale_order_trans.*','tbl_sale_order_masters.invoice_number','tbl_brand_products.product_name','tbl_brand_products.offer_price','tbl_brand_products.prate','tbl_hsncodes.tax','shops.shopname');
			
                 
			}

            $order_trans = $order_trans->merge($shopsQuery->get());
		
			
		}

       // echo "<pre>";print_r($order_trans);exit;
		

        }
      
       $expense=DB::table('tbl_expenses')->sum('amount');
        $totalRevenue = 0;
        $turnover =0;

                foreach ($order_trans as $order) {

                    $r1=$order->offer_amount;
                    $r2=$order->prate;
                    $rev=$r1-$r2;
                    // Calculate revenue for each order transaction
                    $revenue =$order->qty *  $rev; // Assuming quantity is available in $order_trans

                   
                    
                    // Add revenue from this order transaction to total revenue
                    $turnover +=$order->qty*$order->offer_amount;
                    $totalRevenue += $revenue;
                }

                
        return view('accounts.profit',compact('role','totalRevenue','expense','turnover'));
    
    }
    public function turnover(){
    
    }
   
}
