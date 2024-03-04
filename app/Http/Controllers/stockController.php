<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use App\Tbl_godowns;
use App\Tbl_places;
use App\Tbl_countrys;
use App\Tbl_states;
use App\Tbl_districts;
use App\User;
use App\Tbl_physicalstock_masters;
use App\tbl_physicalstock_trans;
use App\Tbl_brand_products;
use App\Tbl_inventory_masters;
use App\Tbl_inventory_trans;


use DB;
use Hash;
use Auth;
use Response;


class stockController extends Controller
{
  
 
	
	public function godown(){
	
		$con = Tbl_countrys::where('deleted_status', 0)->get();
		$cond = Tbl_states::where('deleted_status', 0)->get();
		$dis = Tbl_districts::where('deleted_status', 0)->get();
		$plac = Tbl_places::leftJoin('tbl_districts', 'tbl_places.district_id', '=', 'tbl_districts.id')
			->leftJoin('tbl_states', 'tbl_districts.state_id', '=', 'tbl_states.id')
			->leftJoin('tbl_countrys', 'tbl_states.country_id', '=', 'tbl_countrys.id')
			->select('tbl_places.*', 'tbl_districts.state_id', 'tbl_states.country_id', 'tbl_countrys.country_name', 'tbl_states.state_name', 'tbl_districts.district_name')
			->get();
	
		$type = "";
		$stock = DB::table('tbl_godowns')->orderBy('id', 'DESC')
		->leftJoin('tbl_places', 'tbl_godowns.place_id', '=', 'tbl_places.id')
		->select(
			'tbl_godowns.*',
			'tbl_places.place_name'
		)
		->get();

		$role=Auth::user()->user_type;
		
		return view('stock.godown',compact('con', 'cond', 'dis', 'plac', 'type','stock','role'));
	}



	public function godowninsert(Request $request) {
			
		$user = new User;
		$user->name=$request->name;
		$user->email = $request->email;
		$user->password = Hash::make($request->password);
		
		$user->user_type = 8; 
		$user->login_status = 0;
		if($user->save()){
			$stock=new Tbl_godowns;
			
				$stock->name=$request->name;
				$placeIds = $request->input('place_id');
				$lastPlaceId = end($placeIds);

				$stock->place_id = $lastPlaceId;

				$stock->landmark=$request->landmark;
				$stock->phone_number=$request->phone_number;
				$stock->email=$request->email;
				$stock->user_id = $user->id;
				$stock->GST_Num	 = $request->GST_Num;
				
				
				$stock->save();
		}
		
			return redirect('godown')->with('success', 'Data inserted successfully.');
		}

	
		public function godownfetch(Request $request){
			$id=$request->id;
			$stock=Tbl_godowns::find($id);
			print_r(json_encode($stock));
		}


		public function godownedit(Request $request){
			$id=$request->id;
			$stock=Tbl_godowns::find($id);
			$stock->name=$request->name;
			$stock->landmark=$request->landmark;
			$stock->phone_number=$request->phone_number;
			$stock->GST_Num	 = $request->GST_Num;
			
			$stock->save();
			return redirect('godown')->with('success', 'Data edited successfully.');
		}

    


		public function physical_stock() {
		
			$physical = DB::table('tbl_physicalstock_masters')
				->leftJoin('tbl_godowns', 'tbl_physicalstock_masters.godown_id', '=', 'tbl_godowns.id')
				->leftJoin('tbl_physicalstock_trans', 'tbl_physicalstock_masters.id', '=', 'tbl_physicalstock_trans.master_id')

				->leftJoin('tbl_brand_products', 'tbl_physicalstock_trans.product_id', '=', 'tbl_brand_products.id')

				->select(
					'tbl_physicalstock_masters.*',
					'tbl_godowns.name',
					'tbl_physicalstock_trans.master_id',
					'tbl_brand_products.product_name',
					'tbl_physicalstock_trans.quantity'
				)
				
				->groupBy('tbl_physicalstock_masters.id')
				->get();
		

				$role = Auth::user()->user_type;
		
				$stock = DB::table('tbl_godowns')->get();
				$prod = DB::table('tbl_brand_products')->get();
					
	
				return view('stock.physical_stock', compact('physical', 'stock', 'prod', 'role'));
			}
			
	
	
		
		public function productSearch(Request $request) {
			$alphabet = $request->input('alphabet');
			
			if (!empty($alphabet)) {
				$productList = DB::table('tbl_brand_products')
								->where('product_name', 'like', $alphabet . '%')
								->get(['id', 'product_name', 'offer_price']); 
				
				return response()->json($productList);
			}
			
			return response()->json([]);
		}
		


		public function physical_stockinsert(Request $request)
		{
			try {
				\Log::info('Debug: Request data', ['request' => $request->all()]);
		
				$lastPhysicalStock = Tbl_physicalstock_masters::latest()->first();
				$bill_number = $lastPhysicalStock ? $lastPhysicalStock->bill_number + 1 : 1;
		
				$physical = new Tbl_physicalstock_masters;
				$physical->bill_number = $bill_number;
				$physical->remarks = 0;
				$physical->godown_id = $request->godown;
				$physical->added_date = now();
				$physical->login_id = auth()->user()->id;
		
				if ($physical->save()) {
					
					foreach ($request->product_name as $index => $productName) {
						\Log::info('Debug: Inside Loop');
		
						$quantity = $request->quantity[$index];
		
						$product = Tbl_brand_products::where('product_name', $productName)->first();
						\Log::info('Debug: Product', ['product' => $product]);
		
						if ($product) {
							$stockTrans = new Tbl_physicalstock_trans;
							$stockTrans->master_id = $physical->id;
							$stockTrans->quantity = $quantity;
							$stockTrans->product_id = $product->id;
		
							if (!$stockTrans->save()) {
								\Log::error('Error saving stock transaction:', ['errors' => $stockTrans->getErrors()]);
							}
						} else {
							\Log::error('Product not found:', ['product_name' => $productName]);
						}
					}
		
					Session::flash('success', 'Physical stock added successfully!');
				} else {
					Session::flash('error', 'Error adding Physical stock. Please try again.');
				}
		
				return redirect('physical_stock');
			} catch (\Exception $e) {
				\Log::error($e->getMessage());
				dd($e->getMessage());
			}
		}
		

		
		public function getProductsByMasterId($masterId) {
			$physical_trans = DB::table('tbl_physicalstock_trans')
				->leftJoin('tbl_brand_products', 'tbl_physicalstock_trans.product_id', '=', 'tbl_brand_products.id')
				->leftJoin('tbl_physicalstock_masters', 'tbl_physicalstock_trans.master_id', '=', 'tbl_physicalstock_masters.id')
				->select(
					'tbl_physicalstock_trans.*',
					'tbl_physicalstock_trans.master_id',
					'tbl_brand_products.product_name'
					
					
				)
				->where('tbl_physicalstock_trans.master_id', $masterId)
				->orderBy('tbl_physicalstock_trans.id', 'DESC')
				->get();
		
			return response()->json($physical_trans);
		}




		public function inventory_transfer(){
			
			$stock = DB::table('tbl_godowns')->get();

			$inventory = DB::table('tbl_inventory_masters')
			->leftJoin('tbl_godowns as from_godowns', 'tbl_inventory_masters.inventory_from', '=', 'from_godowns.id')
			->leftJoin('tbl_godowns as to_godowns', 'tbl_inventory_masters.inventory_to', '=', 'to_godowns.id')
			->leftJoin('tbl_inventory_trans', 'tbl_inventory_masters.id', '=', 'tbl_inventory_trans.master_id')
			->leftJoin('tbl_brand_products', 'tbl_inventory_trans.product_id', '=', 'tbl_brand_products.id')
			->select(
				'tbl_inventory_masters.*',
				'from_godowns.name as from_godown_name',
				'to_godowns.name as to_godown_name'
			)
			->groupBy('tbl_inventory_masters.id')
			->get();

			$role=Auth::user()->user_type;
			$latestTransferNumber = Tbl_inventory_masters::max('bill_number');

			return view('stock.inventory_transfer', ['latestTransferNumber' => $latestTransferNumber],compact('stock','inventory','role'));
		}



		public function inventory_transferinsert(Request $request)
		{
			try {
				\Log::info('Debug: Request data', ['request' => $request->all()]);

        $inventory = new Tbl_inventory_masters;
        $inventory->bill_number = $request->transfer_number;
        $inventory->remarks = 0;
        $inventory->total_amount = $request->total_amount;
        $inventory->total_quantity = $request->total_quantity;
        $inventory->inventory_from = $request->inventory_from;
        $inventory->inventory_to = $request->inventory_to;
        $inventory->added_date = $request->transfer_date;
        $inventory->login_id = auth()->user()->id;

        if ($inventory->save()) {
           
            foreach ($request->product_name as $index => $productName) {
                \Log::info('Debug: Inside Loop');

                $quantity = $request->quantity[$index] ?? null;
                $unitprice = isset($request->unitprice[$index]) ? $request->unitprice[$index] : null;
                $total = $request->total[$index] ?? null;

                \Log::info('Debug: Product ' . $index . ' - Quantity: ' . $quantity . ', Unit Price: ' . $unitprice . ', Total: ' . $total);

                $product = Tbl_brand_products::where('product_name', $productName)->first();
                \Log::info('Debug: Product', ['product' => $product]);

                if ($product) {
                    $inventoryTrans = new Tbl_inventory_trans;
                    $inventoryTrans->master_id = $inventory->id;
                    $inventoryTrans->quantity = $quantity;
                    $inventoryTrans->product_id = $product->id;
                    $inventoryTrans->unitprice = $unitprice;
                    $inventoryTrans->total_amount = $total;

                    if (!$inventoryTrans->save()) {
                        \Log::error('Error saving stock transaction:', ['errors' => $inventoryTrans->getErrors()]);
                    }
                } else {
                    \Log::error('Product not found:', ['product_name' => $productName]);
                }
            }

            Session::flash('success', 'Inventory transfer added successfully!');
        } else {
            Session::flash('error', 'Error adding Inventory transfer. Please try again.');
        }

        return redirect('inventory_transfer');
    } catch (\Exception $e) {
        \Log::error($e->getMessage());
        dd($e->getMessage());
    }
}


public function transfer_products($masterId) {
	$transfer = DB::table('tbl_inventory_trans')
		->leftJoin('tbl_brand_products', 'tbl_inventory_trans.product_id', '=', 'tbl_brand_products.id')
		->leftJoin('tbl_inventory_masters', 'tbl_inventory_trans.master_id', '=', 'tbl_inventory_masters.id')
		->select(
			'tbl_inventory_trans.*',
			'tbl_inventory_masters.id',
			'tbl_brand_products.product_name'
			)
		->where('tbl_inventory_trans.master_id',$masterId)
		
		->get();

	return response()->json($transfer);
}
		


public function inventoryTransferFetch(Request $request){
    $id = $request->id;
    $inventoryTransfer = DB::table('tbl_inventory_masters')
        ->leftJoin('tbl_inventory_trans', 'tbl_inventory_masters.id', '=', 'tbl_inventory_trans.master_id')
		->leftJoin('tbl_brand_products', 'tbl_inventory_trans.product_id', '=', 'tbl_brand_products.id')
        ->where('tbl_inventory_masters.id', $id)
        ->select(
            'tbl_inventory_masters.*',
            'tbl_inventory_trans.product_id',  
			'tbl_brand_products.product_name',
            'tbl_inventory_trans.quantity',
            'tbl_inventory_trans.unitprice',
            'tbl_inventory_trans.total_amount'
        )
        ->get();
    return response()->json([
        'inventory_from' => $inventoryTransfer->first()->inventory_from,
        'inventory_to' => $inventoryTransfer->first()->inventory_to,
        'bill_number' => $inventoryTransfer->first()->bill_number,
        'added_date' => $inventoryTransfer->first()->added_date,
        'id' => $id,
        'products' => $inventoryTransfer, // Return products along with other data
    ]);
}



public function inventoryTransferEdit(Request $request){
    $id = $request->id;
    $inventoryTransfer = Tbl_inventory_masters::find($id);
    if($inventoryTransfer){
        $inventoryTransfer->bill_number = $request->transfer_number;
        $inventoryTransfer->total_amount = $request->total_amount;
        $inventoryTransfer->total_quantity = $request->total_quantity;
        $inventoryTransfer->inventory_from = $request->inventory_from;
        $inventoryTransfer->inventory_to = $request->inventory_to;
        $inventoryTransfer->added_date = $request->transfer_date;
        $inventoryTransfer->save();

        $existingProductIds = []; // Keep track of existing product ids
        
        foreach ($request->product_name as $index => $productName) {
            $quantity = $request->quantity[$index] ?? null;
            $unitprice = $request->unitprice[$index] ?? null;
            $total = $request->total[$index] ?? null;

            $product = Tbl_brand_products::where('product_name', $productName)->first();

            if ($product) {
                $existingProductIds[] = $product->id; 

                $inventoryTrans = Tbl_inventory_trans::where('master_id', $inventoryTransfer->id)
                                                    ->where('product_id', $product->id)
                                                    ->first();

                if ($inventoryTrans) {
                    $inventoryTrans->quantity = $quantity;
                    $inventoryTrans->unitprice = $unitprice;
                    $inventoryTrans->total_amount = $total;
                    $inventoryTrans->save();
                } else {
                    $inventoryTrans = new Tbl_inventory_trans;
                    $inventoryTrans->master_id = $inventoryTransfer->id;
                    $inventoryTrans->product_id = $product->id;
                    $inventoryTrans->quantity = $quantity;
                    $inventoryTrans->unitprice = $unitprice;
                    $inventoryTrans->total_amount = $total;
                    $inventoryTrans->save();
                }
            }
        }

        Tbl_inventory_trans::where('master_id', $inventoryTransfer->id)
                            ->whereNotIn('product_id', $existingProductIds)
                            ->delete();

        return redirect()->back()->with('success', 'Inventory transfer edited successfully!');
    } else {
        return redirect()->back()->with('error', 'Inventory transfer not found!');
    }
}



		
}
