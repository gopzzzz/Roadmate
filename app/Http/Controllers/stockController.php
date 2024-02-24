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
		
		$user->user_type = 8; // You may need to adjust this based on your user type logic.
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
				->select(
					'tbl_physicalstock_masters.*',
					'tbl_godowns.name'
				)
				
				->groupBy('tbl_physicalstock_masters.id')
				->get();
		
			$role = Auth::user()->user_type;
		
			$stock = DB::table('tbl_godowns')->get();
			$prod = DB::table('tbl_brand_products')->get();
		
			$physical_trans = DB::table('tbl_physicalstock_trans')
				->leftJoin('tbl_brand_products', 'tbl_physicalstock_trans.product_id', '=', 'tbl_brand_products.id')
				
				->select(
					'tbl_physicalstock_trans.master_id',
					'tbl_brand_products.product_name',
					'tbl_physicalstock_trans.quantity'
				)
				->orderBy('tbl_physicalstock_trans.id', 'DESC')
				->get();
		

			return view('stock.physical_stock', compact('physical', 'stock', 'prod', 'role', 'physical_trans'));
		}
		
	
		

		public function productSearch(Request $request) {
			$alphabet = $request->input('alphabet');
		
			if (!empty($alphabet)) {
				$productList = DB::table('tbl_brand_products')
								->where('product_name', 'like', $alphabet . '%')
								
								->get();
		
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
					// Loop through each product and quantity
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
		
		
		
}
