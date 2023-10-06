<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Executives;

use App\Booktimemasters;

use App\Banner;

use App\User;

use App\Store_lists;

use App\Shop_provide_categories;

use App\Shiop_categories;

use App\Shops;

use App\Shop_offer_models;

use App\User_lists;

use App\Vehicle_types;

use App\Vehicles;

use App\Brand_lists;

use App\Fuel_types;

use App\Brand_models;

use App\Features;

use App\Packages;

use App\Packages_dets;

use App\Packages_shops;

use App\Package_features;

use App\Package_books;

use App\Package_service_lists;

use App\Product_offers;

use App\Store_product_categories;

use App\Shop_services;

use App\Shop_timeslots;

use App\Reviews;

use App\Mystorequerys;

use App\Storequery_answers;

use App\User_vehicles;

use App\Wallets;

use App\Wallet_credit_his;

use App\Wallet_debit_his;

use App\Tbl_shop_offers;

use App\Tbl_terms_conditions;

use App\Tbl_sugg_complaints;

use App\Packages_forvehmodels;

use App\Tbl_shopbankdetails;

use App\Tbl_customertype;

use App\Tbl_notification;

use App\Tbl_giveaways;

use App\Tbl_giveawayshops;

use DB;

use Hash;

use Auth;



class GiveController extends Controller

{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        $this->middleware('auth');

    }



    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function giveaway()

    {

     $packages=DB::table('tbl_giveaways')

     ->leftJoin('vehicle_types', 'tbl_giveaways.vehicle_type', '=', 'vehicle_types.id')

     ->select('tbl_giveaways.*','vehicle_types.veh_type')

     ->orderBy('tbl_giveaways.id', 'DESC')

     ->get();

     $veh=Vehicle_types::all();

     $veh1=Vehicle_types::all();
     return view('giveaway.index',compact('packages','veh','veh1'));  

    }

    public function editgiveawaypackages(Request $request){

        $id=$request->package_id;

        $give=Tbl_giveaways::find($id); 


		if($files=$request->file('image')){  

            

			$name=$files->getClientOriginalName();  

          //  echo $name;

			$files->move('img/',$name);  

			

            $give->giveaway_image=$name; 
        }

			$give->title=$request->tilte;

			$give->price=$request->price;

			$give->normal_price=$request->normal;

			$give->description=$request->desc;

		

            $give->vehicle_type=$request->type;
            
            $give->deleted_status=$request->status;

			$give->save();

			return redirect('giveaway');

		

    }

    public function giveawaypackages(Request $request){

        $give=new Tbl_giveaways;

        $date=date('Y-m-d_h:i:s');

        //echo  $date;exit;

		if($files=$request->file('image')){  

            

			$name=$files->getClientOriginalName();  

          //  echo $name;

			$files->move('img/',$name);  

			

			$give->giveaway_image=$name; 

			$give->title=$request->tilte;

			$give->price=$request->price;

			$give->normal_price=$request->normal;

			$give->description=$request->desc;

		

			$give->vehicle_type=$request->type;

			$give->save();

			return redirect('giveaway');

		

		}else{

            echo "Please upload image";exit;

        }

    }
    public function giveshops(){
       $shops=DB::table('tbl_giveawayshops')
       ->leftJoin('shops', 'tbl_giveawayshops.shop_id', '=', 'shops.id')
       ->leftJoin('tbl_giveaways', 'tbl_giveawayshops.package_id', '=', 'tbl_giveaways.id')
       ->select('tbl_giveawayshops.*','shops.shopname','tbl_giveaways.title')
       ->orderBy('tbl_giveawayshops.id', 'DESC')
       ->get();
       $shoplist=Shops::all();

       $packages=DB::table('tbl_giveaways')->where('deleted_status',0)->get();

        return view('giveaway.giveshops',compact('shops','shoplist','packages'));  
    }
    public function giveawayfetch(Request $request){
		$id=$request->id;
		$package=Tbl_giveaways::find($id);
		print_r(json_encode($package));
	}
    public function giveshopinsert(Request $request){
        $give=new Tbl_giveawayshops;
        $give->shop_id=$request->shop;
        $give->package_id=$request->packages;
        $give->save();
        return redirect('giveshops');
    }


   

	

	

	

	

}

