<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;

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
    public function totalexpense(){
        $role=Auth::user()->user_type;
        $userid=Auth::user()->id;
        if($role==1){
            $e2=0;
            $e4=0;
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
        $order_master = collect();
		
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
        

               $shopsQuery1=DB::table('tbl_sale_order_masters')
               ->leftJoin('shops', 'tbl_sale_order_masters.shop_id', '=', 'shops.id')
              ->leftJoin('tbl_places', 'shops.place_id', '=', 'tbl_places.id')
              ->where('tbl_places.district_id', $singleFranlist->district_id)
              ->select('tbl_sale_order_masters.*');
       
             
                
                } else {
				    $shopsQuery=DB::table('tbl_sale_order_trans')
                    ->leftJoin('tbl_sale_order_masters', 'tbl_sale_order_trans.order_id', '=', 'tbl_sale_order_masters.id')
                   ->leftJoin('shops', 'tbl_sale_order_masters.shop_id', '=', 'shops.id')
                   ->leftJoin('tbl_places', 'shops.place_id', '=', 'tbl_places.id')
                   ->leftJoin('tbl_brand_products', 'tbl_sale_order_trans.product_id', '=', 'tbl_brand_products.id')
                   ->leftJoin('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
                   ->where('tbl_places.id', $singleFranlist->place_id)
                   ->select('tbl_sale_order_trans.*','tbl_sale_order_masters.invoice_number','tbl_brand_products.product_name','tbl_brand_products.offer_price','tbl_brand_products.prate','tbl_hsncodes.tax','shops.shopname');
                  
                   $shopsQuery1=DB::table('tbl_sale_order_masters')
                  ->leftJoin('shops', 'tbl_sale_order_masters.shop_id', '=', 'shops.id')
                  ->leftJoin('tbl_places', 'shops.place_id', '=', 'tbl_places.id')
                  ->where('tbl_places.id', $singleFranlist->place_id)
                  ->select('tbl_sale_order_masters.*');
           
                 
			}

            $order_trans = $order_trans->merge($shopsQuery->get());
            $order_master = $order_master->merge($shopsQuery1->get());
		
			
		}

      
		

        }

       $fexpense=DB::table('tbl_franchises')->where('user_id', $userid)->first();
       if($fexpense){
        $e2=$fexpense->staff_count*$fexpense->salary;
        $e3=$fexpense->maintanance_cost;
        $e4=$fexpense->rent;
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

                 $dexpense=0;
            //     $totalamount=0;
              // $totalAmount=0;
               

                foreach($order_master as $key){
                    $totalamount=$key->total_amount;
                   // echo $totalamount;
                    if($totalamount>300){
                         $DcharGe=$totalamount*(2/100);
                    }else{
                       
                        $DcharGe=($totalamount-40)*(2/100);
                    }
                   // echo $totalAmount;
                   
                    if($DcharGe<40){
                          $e1=40;
                    }else{
                       $e1=$DcharGe;
                       
                    }
                    $dexpense +=$e1;
                }

//exit;
             //  echo $dexpense;exit;

                
        return view('accounts.profit',compact('role','totalRevenue','expense','turnover','e2','e3','e4','dexpense'));
    
    }
    public function turnover(){
    
    }
   
}
