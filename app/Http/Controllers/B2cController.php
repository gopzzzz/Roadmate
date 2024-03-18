<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use App\Tbl_b2corders;
use App\Shops;
use App\Tbl_coupens;
use App\Tbl_b2cordertrans;
use App\User;
use App\Tbl_b2csales;
use App\Tbl_b2csalestrans;
use App\Tbl_brand_products;
use App\Tbl_wallets;
use App\Tbl_wallet_transactions;


use DB;
use Hash;
use Auth;
use Response;

class B2cController extends Controller
{
	public function b2corders(Request $request)
{
    $role = Auth::user()->user_type;
    $userid = Auth::user()->id;
    
    $statusFilter = $request->input('status');

    $ordersQuery = DB::table('tbl_b2corders')
        ->leftJoin('shops', 'tbl_b2corders.shop_id', '=', 'shops.id')
        ->leftJoin('tbl_deliveryaddres', 'shops.delivery_id', '=', 'tbl_deliveryaddres.id')
        ->leftJoin('tbl_coupens', 'tbl_b2corders.coupen_id', '=', 'tbl_coupens.id')
        ->select('tbl_b2corders.*', 'shops.shopname', 'shops.address', 'tbl_coupens.coupencode', 'tbl_deliveryaddres.area', 'tbl_deliveryaddres.area1', 'tbl_deliveryaddres.country', 'tbl_deliveryaddres.state', 'tbl_deliveryaddres.district', 'tbl_deliveryaddres.city', 'tbl_deliveryaddres.phone', 'tbl_deliveryaddres.pincode')
		->orderBy('tbl_b2corders.id', 'DESC');
    
		if ($statusFilter !== null) {
			$ordersQuery = $ordersQuery->where('order_status', $statusFilter);
		}

    $orders = $ordersQuery->get();

    return view('B2C.b2corders', ['orders' => $orders, 'role' => $role]);
}

	



public function b2csale_order($orderId) {

$markk=DB::table('tbl_b2cordertrans')->get();
$saleorder=DB::table('tbl_b2corders')
->leftJoin('tbl_b2cordertrans', 'tbl_b2corders.id', '=', 'tbl_b2cordertrans.order_id')
->leftJoin('tbl_brand_products', 'tbl_b2cordertrans.product_id', '=', 'tbl_brand_products.id')
->leftJoin('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
->leftJoin('shops', 'tbl_b2corders.shop_id', '=', 'shops.id') 
->leftJoin('tbl_deliveryaddres', 'shops.delivery_id', '=', 'tbl_deliveryaddres.id')
->where('tbl_b2corders.id',$orderId)
    ->select( 
        'tbl_b2corders.*',
        'tbl_b2cordertrans.product_id',
        'tbl_b2cordertrans.qty',
        'tbl_b2cordertrans.price',
        'tbl_b2cordertrans.selling_rate',
        'shops.id as shop_id',
        'shops.shopname',
        'shops.address' ,
        'shops.delivery_id' ,
        'tbl_brand_products.id as proid',
        'tbl_brand_products.product_name',
        'tbl_deliveryaddres.phone',
        'tbl_deliveryaddres.pincode',
        'tbl_deliveryaddres.area',
        'tbl_deliveryaddres.area1',
        'tbl_deliveryaddres.city',
        'tbl_deliveryaddres.district',
        'tbl_deliveryaddres.state',
        'tbl_deliveryaddres.country',
        'tbl_hsncodes.tax'
        )
    ->get();

    //echo "<pre>";print_r($saleorder);exit;
$role = Auth::user()->user_type;
return view('B2C.b2csale_order',compact('role','markk','saleorder','orderId'));
}
    

public function b2csale_orderinsert(Request $request)
		{
			try {
				\Log::info('Debug: Request data', ['request' => $request->all()]);
		
				$shopId = $request->input('shop_id');


				$check=DB::table('tbl_b2csales')->orderBy('id','DESC')->first();
				if($check==null){
                 $invoice=1000;
				}else{
					$invoice=$check->invoice_number+1;
				}

				//$ordermaster=DB::table('')->where('',$request->idd)->first();


		
				$saleMaster = new Tbl_b2csales;
				$saleMaster->shop_id = $shopId; 
				$saleMaster->order_id = $request->idd;
				
				$saleMaster->invoice_number=$invoice;
				$saleMaster->total_amount = $request->total_amount;
				$saleMaster->bill_number = $request->billnumber 	;
				$saleMaster->discount = $request->discount;
				$saleMaster->coupen_id = 0;
				$saleMaster->wallet_redeem_id = $request->walletamount;
				$paymentMode = $request->payment == 'Cash on Delivery' ? 0 : 1;
                $saleMaster->payment_mode = $paymentMode;

				$saleMaster->selling_mrp = 0;
				$saleMaster->shipping_charge = $request->shipping_charge;
				$saleMaster->tax_amount = 0;
				
				
				// $saleMaster->order_status = $request->order_status;
				$saleMaster->delivery_date = $request->delivery_date;
				$saleMaster->order_date = $request->orderdate;
		
				if ($saleMaster->save()) {
					// Loop through the products and save them
					foreach ($request->product_name as $index => $productName) {
						$productId = $request->product_id[$index];
						$qty = $request->qty[$index];
						$selling_rate = $request->selling_rate[$index];
						$price = $request->total_mrp[$index];
		
						
						$product = Tbl_brand_products::where('product_name', $productName)->first();
						\Log::info('Debug: Product', ['product' => $product]);		
						$saleTrans = new Tbl_b2csalestrans;
						$saleTrans->order_id = $saleMaster->id;
						$saleTrans->product_id = $product ? $product->id : 0;
						$saleTrans->sale_order_id = $saleMaster->id;
						$saleTrans->qty = $qty;
						$saleTrans->selling_rate = $selling_rate;
						$saleTrans->price = $request->total_mrp;
						$saleTrans->taxable_amount = 0;
		
						
						if (!$saleTrans->save()) {
							\Log::error('Error saving sale transaction:', ['errors' => $saleTrans->getErrors()]);
							break; 
						}
					}
		
					
					Tbl_b2corders::where('id', $request->idd)->update(['sale_status' => 1,
					'order_status' => 1
				]);
		
					
					Session::flash('success', 'Sale Invoice generated successfully!');
				} else {
					
					Session::flash('error', 'Error adding Sale Invoice. Please try again.');
				}
		
				return redirect('b2corders');
			}
			catch (\Exception $e) {
				\Log::error($e->getMessage());
				dd($e->getMessage());
			}
		}


		public function b2c_salelist(Request $request)
{
    $role = Auth::user()->user_type;
    $statusFilter = $request->input('status');

    $ordersQuery = DB::table('tbl_b2csales')
        ->leftJoin('shops', 'tbl_b2csales.shop_id', '=', 'shops.id')
        ->leftJoin('tbl_deliveryaddres', 'shops.delivery_id', '=', 'tbl_deliveryaddres.id')
        ->leftJoin('tbl_coupens', 'tbl_b2csales.coupen_id', '=', 'tbl_coupens.id')
        ->leftJoin('tbl_b2corders', 'tbl_b2csales.order_id', '=', 'tbl_b2corders.id')
        ->select('tbl_b2csales.*', 'shops.shopname', 'shops.address', 'tbl_b2corders.order_status', 'tbl_b2corders.payment_status', 'tbl_coupens.coupencode', 'tbl_deliveryaddres.area', 'tbl_deliveryaddres.area1', 'tbl_deliveryaddres.country', 'tbl_deliveryaddres.state', 'tbl_deliveryaddres.district', 'tbl_deliveryaddres.city', 'tbl_deliveryaddres.phone', 'tbl_deliveryaddres.pincode')
        ->orderBy('tbl_b2csales.id', 'DESC');

    if ($statusFilter !== null) {
        $ordersQuery = $ordersQuery->where('order_status', $statusFilter);
    }

    try {
        $sale = $ordersQuery->paginate(10);

        return view('B2C.b2c_salelist', compact('sale', 'role'))->render();
    } catch (\Exception $e) {
        \Log::error($e->getMessage());
        dd($e->getMessage());
    }
}

		public function b2corder_invoice($orderId) {

			$markk=DB::table('tbl_b2cordertrans')
				->get();
			$invoice=DB::table('tbl_b2corders')
			->leftJoin('tbl_b2cordertrans', 'tbl_b2corders.id', '=', 'tbl_b2cordertrans.order_id')
			->leftJoin('tbl_brand_products', 'tbl_b2cordertrans.product_id', '=', 'tbl_brand_products.id')
			->leftJoin('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
			->leftJoin('shops', 'tbl_b2corders.shop_id', '=', 'shops.id') 
			->leftJoin('tbl_deliveryaddres', 'shops.delivery_id', '=', 'tbl_deliveryaddres.id')
			->where('tbl_b2corders.id',$orderId)
				->select(
					'tbl_b2corders.*',
					
					'tbl_b2cordertrans.qty',
					'tbl_b2cordertrans.selling_rate',
					'shops.shopname',
					'shops.address' ,
					'shops.delivery_id' ,
					'tbl_brand_products.product_name',
					'tbl_deliveryaddres.area',
					'tbl_deliveryaddres.area1',
					'tbl_deliveryaddres.city',
					'tbl_deliveryaddres.district',
					'tbl_deliveryaddres.state',
					'tbl_deliveryaddres.pincode',
					'tbl_deliveryaddres.country',
					'tbl_hsncodes.tax',
					'tbl_hsncodes.hsncode',

					'tbl_hsncodes.cgst',
					'tbl_hsncodes.igst',
					)
				->get();
			$role=Auth::user()->user_type;
			return view('B2C.b2corder_invoice',compact('role','markk','invoice'));
			}

			public function b2csale_bill($orderId) {

				$markk=DB::table('tbl_b2csalestrans')
					->get();
				$salebill=DB::table('tbl_b2csales')
				->leftJoin('tbl_b2csalestrans', 'tbl_b2csales.id', '=', 'tbl_b2csalestrans.order_id')
				->leftJoin('tbl_brand_products', 'tbl_b2csalestrans.product_id', '=', 'tbl_brand_products.id')
					->leftJoin('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
				->leftJoin('shops', 'tbl_b2csales.shop_id', '=', 'shops.id') 
				->leftJoin('tbl_deliveryaddres', 'shops.delivery_id', '=', 'tbl_deliveryaddres.id')
				->where('tbl_b2csales.id',$orderId)
					->select(
						'tbl_b2csales.*',
						
						'tbl_b2csalestrans.sale_order_id',
						'tbl_b2csalestrans.qty',
						'tbl_b2csalestrans.selling_rate',
						'shops.shopname',
						'shops.address' ,
						'shops.delivery_id' ,
						'tbl_brand_products.product_name',
						'tbl_deliveryaddres.area',
						'tbl_deliveryaddres.area1',
						'tbl_deliveryaddres.city',
						'tbl_deliveryaddres.district',
						'tbl_deliveryaddres.state',
						'tbl_deliveryaddres.pincode',
						'tbl_deliveryaddres.country',
						'tbl_hsncodes.tax',
						'tbl_hsncodes.hsncode',

						'tbl_hsncodes.cgst',
						'tbl_hsncodes.igst',
						)
					->get();
				$role=Auth::user()->user_type;
				return view('B2C.b2csale_bill',compact('role','markk','salebill'));
				}


				public function b2cancelorder($orderId) {
					try {
						
						Tbl_b2corders::where('id', $orderId)->update(['order_status' => 4]);
				
						
						Tbl_b2cordertrans::where('order_id', $orderId)->update(['order_status' => 2]);
				
						\Session::flash('success', 'Order Cancelled Successfully!');
					} catch (\Exception $e) {
						\Log::error('Error canceling order: ' . $e->getMessage());
						\Session::flash('error', 'Error canceling order. Please try again.');
					}
				
					return redirect('b2corders'); 
				}


public function b2corderfetch(Request $request)
		{
			$order_id = $request->id; // assuming id in the request is the order_id
			$order = Tbl_b2corders::where('id', $order_id)->first();
		
		
		
			if ($order) {
				$orderArray = $order->toArray();
				return response()->json($orderArray);
			} else {
				return response()->json(['error' => 'Order details not found'], 404);
			}
		}


public function b2cstatusedit(Request $request, $order_id)
{
    \Log::info('Received order_id for b2cstatusedit: ' . $order_id);

    $total_amount = $request->input('total_amount');

    \Log::info('Received total_amount for b2cstatusedit: ' . $total_amount);

    if (!is_numeric($total_amount)) {
        \Log::error('Invalid total_amount received: ' . $total_amount);
        return redirect('b2c_salelist')->with('error', 'Invalid total_amount received.');
    }

    $order = Tbl_b2corders::where('id',$order_id)->first();

    if ($order) {
        $order->order_status = $request->order_status;
        
        // Ensure payment_status is properly set
        if ($request->has('paystatus') && $request->paystatus !== null) {
            $order->payment_status = $request->paystatus;
        } elseif ($order->payment_status === null) {
            // If payment_status is null, set it to its current value
            $order->payment_status = $order->payment_status;
        }

        if ($request->paystatus == '1') {

			if($order->wallet_redeem_id==0){
				$percentage = ($total_amount * 10) / 100;
				\Log::info('Calculated Percentage: ' . $percentage);
	
				$shop_id = $order->shop_id;
	
				$wallet = Tbl_wallets::where('shop_id', $shop_id)->first();
	
				if ($wallet) {
					$wallet->wallet_amount += $wallet->amount + $percentage;
					$wallet->save();
					\Log::info('Wallet Amount Updated: ' . $wallet->wallet_amount);
				} else {
					$w = new Tbl_wallets;
					$w->shop_id = $shop_id;
					$w->wallet_amount += $percentage;
					$w->save();
				}
	
				$wh = new Tbl_wallet_transactions;
				$wh->amount = $percentage;
				$wh->type = 1;
				$wh->shop_id = $shop_id;
				$wh->save();
			}

           
        }

        $order->save();

        return redirect('b2c_salelist')->with('success', 'Order status updated successfully.');
    } else {
        return redirect('b2c_salelist')->with('error', 'Order not found.');
    }
}

}
