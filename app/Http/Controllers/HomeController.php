<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use App\Executives;
use App\Tbl_franchises;
use App\Tbl_crms;
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
use App\Tbl_accdelete_requests;
use App\Tbl_notification_historys;
use App\Tbl_countrys;
use App\Tbl_states;
use App\Tbl_districts;
use App\Tbl_places;
use App\Tbl_rm_products;
use App\Tbl_coupens;
use App\Tbl_rm_categorys;
use App\Tbl_order_masters;
use App\Tbl_images;
use App\App_versions;
use App\Tbl_order_trans;
use App\Tbl_productimages;
use App\Tbl_brands;
use App\Tbl_brand_products;
use App\Tbl_franchase_details;
use App\Tbl_hsncodes;
use App\Tbl_placeorders;
use App\Tbl_wallets;
use App\Tbl_wallet_transactions;
use App\Tbl_vendors;
use App\Tbl_place_order_masters;
use App\Tbl_sale_order_masters;
use App\Tbl_sale_order_trans;
use DB;
use Hash;
use Auth;
use Response;
use Intervention\Image\Facades\Image;
use function PHPSTORM_META\elementType;
class HomeController extends Controller
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
    public function index()
    {
		$role=Auth::user()->user_type;
		$date=date('Y-m-d');
	    $tbookings=DB::table('booktimemasters')->where('adate',$date)->count();
		$customers=DB::table('user_lists')->count();
		$shops=DB::table('shops')->count();
        return view('dashboard',compact('role','tbookings','customers','shops'));
    }
	
	public function customerlistfetch(Request $request){
		$id=$request->id;
		$custmr=User_lists::find($id);
		print_r(json_encode($custmr));
	}
	public function shopidfetch(Request $request){
		$id=$request->id;
		$shopid=DB::table('tbl_shopbankdetails')
		->leftJoin('shops', 'tbl_shopbankdetails.shop_id', '=', 'shops.id')
		->select('tbl_shopbankdetails.*','shops.shopname')
		->first();
		print_r(json_encode($shopid));
	}
	public function updatestatus(Request $request){
			$key=$request->keyvalue;
			if($key==1){
			Booktimemasters::where('id', $request->keyid)
				->update([
					'work_status' => $request->status
					]);
					
						return redirect('giveawaybooking');
					}else{
						Booktimemasters::where('id', $request->keyid)
				->update([
					'work_status' => $request->status,
					'totalamt_shop' => $request->amount
					]);
					
						return redirect('timeslot');
					}
					
	}

	public function updatecallstatus(Request $request) {
		Booktimemasters::where('id', $request->keyid)
			->update([
				'crm_status' => $request->crm_status,
				'crm_remark' => $request->remark,
			]);
	
		return redirect('timeslot');
	}
	
	public function updatecallstatusfetch(Request $request) {
		$record = Booktimemasters::where('id', $request->keyid)->first();
		return response()->json([
			'crm_status' => $record->crm_status,
			'crm_remark' => $record->crm_remark,
		]);
	}
	
	
	public function booking_timeslots(){
		
		$shops=Shops::all();
		$custmr=User_lists::all();
		$custmr1=User_lists::all();
		$shop_category=Shiop_categories::all();
		$timslot=Booktimemasters::all();
		$userid=Auth::user()->id;
		$role=Auth::user()->user_type;
		$timslot=array();
		if($role==3){
			$fran=DB::table('tbl_franchase_details')
			->leftJoin('tbl_franchises', 'tbl_franchase_details.franchise_id', '=', 'tbl_franchises.id')
			->where('tbl_franchises.user_id',$userid)
			->select('tbl_franchase_details.*')
			->get();

			//echo "<pre>";print_r($fran);exit;
			
			foreach($fran as $singleFranchise){
				if($singleFranchise->type==4){
					

					$timslot[] = DB::table('booktimemasters')
					->leftJoin('user_lists', 'booktimemasters.customer_id', '=', 'user_lists.id')
					->leftJoin('brand_models', 'booktimemasters.model_id', '=', 'brand_models.id')
					->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')
					->leftJoin('shiop_categories', 'booktimemasters.shop_category_id', '=', 'shiop_categories.id')
					->leftJoin('tbl_shop_offers', 'booktimemasters.book_id', '=', 'tbl_shop_offers.id')
					->leftJoin('shops', 'booktimemasters.shop_id', '=', 'shops.id')
					->leftJoin('tbl_places', 'shops.place_id', '=', 'tbl_places.id')
					->select('booktimemasters.*','tbl_shop_offers.title as offertitle','user_lists.name', 'user_lists.phnum','shiop_categories.category','shops.shopname','shops.phone_number','brand_models.brand_model','brand_lists.brand')
					->orderBy('booktimemasters.id', 'desc')
					->where('tbl_places.district_id',$singleFranchise->district_id)
					->get();
				}else{
					$timslot[] = DB::table('booktimemasters')
					->leftJoin('user_lists', 'booktimemasters.customer_id', '=', 'user_lists.id')
					->leftJoin('brand_models', 'booktimemasters.model_id', '=', 'brand_models.id')
					->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')
					->leftJoin('shiop_categories', 'booktimemasters.shop_category_id', '=', 'shiop_categories.id')
					->leftJoin('tbl_shop_offers', 'booktimemasters.book_id', '=', 'tbl_shop_offers.id')
					->leftJoin('shops', 'booktimemasters.shop_id', '=', 'shops.id')
					->select('booktimemasters.*','tbl_shop_offers.title as offertitle','user_lists.name', 'user_lists.phnum','shiop_categories.category','shops.shopname','shops.phone_number','brand_models.brand_model','brand_lists.brand')
					->orderBy('booktimemasters.id', 'desc')
					->where('shops.place_id',$singleFranchise->place_id)
					->get();

					//echo "<pre>";print_r($timslot);exit;
				
				}
			}
			
			

		}else{
			$timslot[]= DB::table('booktimemasters')
            ->leftJoin('user_lists', 'booktimemasters.customer_id', '=', 'user_lists.id')
			->leftJoin('brand_models', 'booktimemasters.model_id', '=', 'brand_models.id')
			->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')
			->leftJoin('shiop_categories', 'booktimemasters.shop_category_id', '=', 'shiop_categories.id')
			->leftJoin('tbl_shop_offers', 'booktimemasters.book_id', '=', 'tbl_shop_offers.id')
			->leftJoin('shops', 'booktimemasters.shop_id', '=', 'shops.id')
			->select('booktimemasters.*','tbl_shop_offers.title as offertitle','user_lists.name', 'user_lists.phnum','shiop_categories.category','shops.shopname','shops.phone_number','brand_models.brand_model','brand_lists.brand')
			->orderBy('booktimemasters.id', 'desc')
			->get();

		}

		//echo "<pre>";print_r($timslot);exit;
		
	
			
		return view('booking_timeslots',compact('timslot','custmr','custmr1','shop_category','shops','role'));
	}
	
	public function booking_timeslotsinsert(Request $request){
		$timslot=new Booktimemasters;

		$timslot->customer_id=$request->cust;
		$timslot->shop_category_id=$request->shop_cat;
		$timslot->shop_id=$request->shop;
		$timslot->book_type=$request->type1;
		$timslot->adate=$request->date;
		$timslot->timeslots=$request->time;
		$timslot->save();
		return redirect('timeslot');
	}
	
	public function booking_timeslotsedit(Request $request){
		$id=$request->id;
		$book_timslot=Booktimemasters::find($id);
		$book_timslot->customer_id=$request->cust;
		$book_timslot->shop_category_id=$request->shop_cat;
		$book_timslot->shop_id=$request->shop;
		$book_timslot->book_type=$request->type1;
		$book_timslot->adate=$request->date;
		$book_timslot->timeslots=$request->time;
		$book_timslot->save();
		return redirect('timeslot');
	}
	
	public function timeslotfetch(Request $request){
		$id=$request->id;
		$timslot=Booktimemasters::find($id);
		
		print_r(json_encode($timslot));
	}
	
	public function timeslotdelete($id){
		DB::delete('delete from booktimemasters where id = ?', [$id]);
		return redirect('timeslot')->with('success', 'Deleted Successfully');
	}
	
	public function executive(){
		$exe=DB::table('executives')->orderBy('id', 'DESC')->get();
		$role=Auth::user()->user_type;
		return view('executive',compact('exe','role'));
	}
	
	public function visitedshop(Request $request){
		$id=$request->id;
		$visit=DB::table('shops')
		->where('exeid',$id)
		->where('authorised_status',0)
		->get();
		print_r(json_encode($visit));
	}
	public function addedshop(Request $request){
		$id=$request->id;
		$visit=DB::table('shops')
		->where('exeid',$id)
		->where('authorised_status',1) 
		->get();
		print_r(json_encode($visit));
	}
	
     public function exeinsert(Request $request)
    {
      $exe = new Executives;
      if ($files = $request->file('image')) {
        $name = $files->getClientOriginalName();
        $files->move('img/', $name);

        $exe->image = $name;
        $exe->name = $request->exename;
        $exe->phonenum = $request->phonenumber;
        $exe->email = $request->email;
        $exe->addrress = $request->address;
        $exe->district = $request->district;
        $exe->location = $request->location;
        $exe->save();
        return redirect('executive')->with('success', 'Executive Inserted Successfully');
    }
   }
    public function executivenew(){
		$exe=Executives::all();
		
		return view('executivenew',compact('exe'));
	}
	public function executivefetch(Request $request){
		$id=$request->id;
		$exe=Executives::find($id);
		print_r(json_encode($exe));
	}
	public function exeedit(Request $request){
		$id=$request->id;
		$exeedit=executives::find($id);
	
		$exeedit->name=$request->exename;
		$exeedit->phonenum=$request->phonenumber;
		$exeedit->email=$request->email;
		$exeedit->addrress=$request->address;
		$exeedit->district=$request->district;
		$exeedit->location=$request->location;
		if($files=$request->file('image')){  
			$name=$files->getClientOriginalName();  
			$files->move('img/',$name);  
			$exeedit->image=$name; 
		
		}
			$exeedit->save(); 
		return redirect('executive')->with('success', 'Executive Edited Successfully');

	}
	
	public function exedelete($id){
		DB::delete('delete from executives where id = ?', [$id]);
		return redirect('executive')->with('success', 'Executive Deleted Successfully');
	}
	
	public function franchises() {
		$franchiseDetails = Tbl_franchase_details::select('franchise_id', 'type', 'place_id', 'district_id')->get();
	
		$fran = DB::table('tbl_franchises')->orderBy('id', 'DESC')->get();
	
		$role = Auth::user()->user_type;
		$con = Tbl_countrys::where('deleted_status', 0)->get();
		$cond = Tbl_states::where('deleted_status', 0)->get();
		$dis = Tbl_districts::where('deleted_status', 0)->get();
		$plac = Tbl_places::leftJoin('tbl_districts', 'tbl_places.district_id', '=', 'tbl_districts.id')
			->leftJoin('tbl_states', 'tbl_districts.state_id', '=', 'tbl_states.id')
			->leftJoin('tbl_countrys', 'tbl_states.country_id', '=', 'tbl_countrys.id')
			->select('tbl_places.*', 'tbl_districts.state_id', 'tbl_states.country_id', 'tbl_countrys.country_name', 'tbl_states.state_name', 'tbl_districts.district_name')
			->get();
	
		$type = "";
		
		
		
		
	
		return view('franchises', compact('fran','role', 'con', 'cond', 'dis', 'plac', 'type', 'franchiseDetails'));
	}
	
	public function franchasefilter(Request $request)
	{
		$type = $request->type;
		$role=Auth::user()->user_type;
		$con=DB::table('tbl_countrys')
			->where('deleted_status',0)
			->get();
            $cond=DB::table('tbl_states')
			->where('deleted_status',0)
			->get();
		$dis=DB::table('tbl_districts')
		->where('deleted_status',0)
		->get();
		$plac = DB::table('tbl_places')
		->leftJoin('tbl_districts', 'tbl_places.district_id', '=', 'tbl_districts.id')
		->leftJoin('tbl_states', 'tbl_districts.state_id', '=', 'tbl_states.id')
		->leftJoin('tbl_countrys', 'tbl_states.country_id', '=', 'tbl_countrys.id')
		->select('tbl_places.*', 'tbl_districts.state_id', 'tbl_states.country_id', 'tbl_countrys.country_name','tbl_states.state_name','tbl_districts.district_name')
		->get();
	    if ($type == 4) {
			$fran = DB::table('tbl_franchises')
				->leftJoin('tbl_districts', 'tbl_franchises.district_id', '=', 'tbl_districts.id')
				->leftJoin('tbl_states', 'tbl_districts.state_id', '=', 'tbl_states.id')
				->where('tbl_franchises.type',4)
				->select(
					'tbl_franchises.*',
					'tbl_districts.district_name as place_name',
					'tbl_franchises.type as place_type',
					'tbl_districts.district_name',
					'tbl_states.state_name'
				)
				->get();
		} else {
			$fran = DB::table('tbl_franchises')
				->leftJoin('tbl_places', 'tbl_franchises.place_id', '=', 'tbl_places.id')
				->leftJoin('tbl_districts', 'tbl_franchises.place_id', '=', 'tbl_districts.id')
				->leftJoin('tbl_states', 'tbl_districts.state_id', '=', 'tbl_states.id')
				->where('tbl_franchises.type',$type)
				->select(
					'tbl_franchises.*',
					'tbl_places.place_name as place_name',
					'tbl_places.type as place_type',
					'tbl_districts.district_name',
					'tbl_states.state_name'
				)
				->get();
		}
	return view('franchises',compact('fran','role','con','cond','dis','plac','type'));
		
	}
	
	public function franinsert(Request $request) {
		

		$rules = [
			'franchise_name' => 'required',
			'email' => [
				'required',
				'email',
				Rule::unique('users')->ignore($request->id),
			],
			'password' => 'required|min:6',
			'type.*' => 'required',
			// Add other validation rules as needed
		];
	
		// Validation messages
		$messages = [
			'email.unique' => 'The email has already been taken.',
		];
	
		$validator = Validator::make($request->all(), $rules, $messages);
	
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput()->with('validationError', 'Email already exists.');

		}

		$user = new User;
		$user->name = $request->franchise_name;
		$user->email = $request->email;
		$user->password = Hash::make($request->password);
		$user->user_type = 3;
		$user->login_status = 0;
	
		if ($user->save()) {
			// Create franchise details
			$type = $request->type;
	
			
				$franchise = new Tbl_franchises;
				$franchise->franchise_name = $request->franchise_name;
				$franchise->area = $request->area;
				$franchise->pincode = $request->pincode;
				$franchise->phone_number = $request->phone_number;
				$franchise->user_id = $user->id;
	
				if ($franchise->save()) {
					for ($i = 0; $i < count($type); $i++) {
					$franchiseDetails = new Tbl_franchase_details;
					$franchiseDetails->franchise_id = $franchise->id;
					$franchiseDetails->type = $request->type[$i];
	
					if ($request->type[$i] == 4) {
						$franchiseDetails->district_id = $request->district[$i];
						
					} else {
						
						$franchiseDetails->place_id = $request->place_id[$i];
					}
	
					$franchiseDetails->save();
				}
				}
			
	
			return redirect('franchises')->with('success', 'Franchise and details added successfully');
		}
	
		return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create user, franchise, or franchise detail.']);
	}

	public function deletefranchise($id){
		DB::table('tbl_franchase_details')->where('id',$id)->delete();
		return redirect('franchises')->with('success', 'Franchise deleted successfully');
	}

	public function franchiseaddon(Request $request){
		$franchiseDetails = new Tbl_franchase_details;
					$franchiseDetails->franchise_id = $request->fran_id;
					$franchiseDetails->type = $request->type;
	
					if ($request->type == 4) {
						$franchiseDetails->district_id = $request->district;
						$franchiseDetails->place_id = null; // or set to a default value
					} else {
						$franchiseDetails->district_id = null; // or set to a default value
						$franchiseDetails->place_id = $request->place_id;
					}
	
					$franchiseDetails->save();
					return redirect('franchises')->with('success', 'Franchise and details added successfully');

	}
	

 public function franfetch(Request $request)
    {
        $id = $request->id;

        $franchiseDetails = DB::table('tbl_franchises')
       
        ->leftJoin('users', 'tbl_franchises.user_id', '=', 'users.id')
        ->where('tbl_franchises.id', $id)
		->select('tbl_franchises.*','users.email')
        ->first();

        return response()->json($franchiseDetails);
    }
	public function franedit(Request $request)
{
	
    $id = $request->id;
    $franchise = Tbl_franchises::find($id);

    if (!$franchise) {
        return redirect()->back()->withErrors(['error' => 'Franchise not found']);
    }

    $franchise->franchise_name = $request->franchise_name;
    $franchise->area = $request->area;
    $franchise->pincode = $request->pincode;
    $franchise->phone_number = $request->phone_number;
	$franchise->save();
    
	

	
    return redirect()->back()->withErrors(['error' => 'Failed to update franchise details']);
}

	
	
	
	public function crm(){
		$cr = tbl_crms::with('user')->get();
		
		$crr = DB::table('tbl_crms')
        ->leftJoin('users', 'tbl_crms.user_id', '=', 'users.id')

                ->leftJoin('tbl_roles', 'users.user_type', '=', 'tbl_roles.id')

        ->select('tbl_crms.*', 'users.user_type','users.email','tbl_roles.designation')

        ->get();

		$role=Auth::user()->user_type;
		return view('crm',compact('cr','crr','role'));
	}

	public function crminsert(Request $request) {
		
	
		$user = new User;
		$user->name=$request->crm_name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
	
    $user->user_type = $request->role; // You may need to adjust this based on your user type logic.
	$user->login_status = 0;
    if($user->save()){
		$cr=new tbl_crms;
		
			$cr->crm_name=$request->crm_name;
			//  $cr->place_id=$request->place_id;
			$cr->address=$request->address;
			$cr->dob=$request->dob;
			$cr->phone_number=$request->phone_number;
			$cr->user_id=$user->id;
			
			
			$cr->save();
	}
	
		return redirect('crm')->with('success', 'Data inserted successfully.');
	}

	
	public function crmfetch(Request $request){
		$id=$request->id;
		$cr=Tbl_crms::find($id);
		print_r(json_encode($cr));
	}
	public function crmedit(Request $request){
		$id=$request->id;
		$cr=tbl_crms::find($id);
		$cr->crm_name=$request->crm_name;
		$cr->address=$request->address;
		$cr->dob=$request->dob;
		$cr->phone_number=$request->phone_number;
		// $franchis->phone_number=$request->phone_number;
		// $franchis->email=$request->email;
		$cr->save();
		return redirect('crm');
	}

	public function deleteCrm($crmId) {
		// Get CRM record
		$crm = tbl_crms::find($crmId);
	
		if (!$crm) {
			return redirect()->back()->with('error', 'Staff entry not found.');
		}
	
		// Get user associated with CRM
		$user = User::find($crm->user_id);
	
		if ($user) {
			// Delete CRM record
			$crm->delete();
	
			// Delete user
			$user->delete();
	
			// Display a success message
			return redirect()->back()->with('success', 'Staff deleted successfully.');
		}
	
		return redirect()->back()->with('error', 'User not found.');
	}
	


	//superadmin
	public function superadmin(){
		$sup=DB::table('users')->get();
		$role=Auth::user()->user_type;
		return view('superadmin',compact('sup','role'));
	}

	public function supadminsert(Request $request){
		$sup=new user;

		
			$sup->name=$request->name;
			$sup->email=$request->email;
			$sup->password=Hash::make($request->password);
			$sup->user_type=$request->user_type;
			$sup->login_status=0;
			$sup->save();
			return redirect('superadmin');
		
	}

	public function supabfetch(Request $request){
		$id=$request->id;
		$sup=user::find($id);
		print_r(json_encode($sup));
	}
	//

	public function banner(){
		$banner=DB::table('banners')->orderBy('id', 'DESC')->get();
		
		$role=Auth::user()->user_type;
		return view('banner',compact('banner','role'));
	}
	public function bannerinsert(Request $request){
		$banner=new Banner;

		if($files=$request->file('bannerimage')){  
			$name=$files->getClientOriginalName();  
			$files->move('img/',$name);  
			
			$banner->banner_image=$name; 
			$banner->banner_type=$request->type;
			$banner->save();
		}  
		
		return redirect('banner')->with('success', 'Banner inserted successfully.');
	}
	public function bannerfetch(Request $request){
		$id=$request->id;
		$banner=Banner::find($id);
		print_r(json_encode($banner));
	}
	public function banneredit(Request $request){
		$id=$request->id;
		$banner=Banner::find($id);
		if($files=$request->file('bannerimage')){  
			$name=$files->getClientOriginalName();  
			$files->move('img/',$name);  
		
			$banner->banner_image=$name; 
			$banner->banner_type=$request->type1;
			$banner->save();
		}  
		
		return redirect('banner')->with('success', 'Banner Edited successfully.');
	}
	public function bannerdelete($id){
		DB::delete('delete from banners where id = ?', [$id]);
		return redirect('banner')->with('success', 'Banner deleted successfully.');
	}
	
   public function accountdelete($id){
       	DB::delete('delete from user_lists where id = ?',[$id]);
       	 DB::delete('delete from user_vehicles where user_id = ?',[$id]);
		return redirect('account_delete_requests');
   }
   public function store_listing(){
   // $stores=Store_lists::all();
	$stores = DB::table('store_lists')
            ->leftJoin('store_product_categories', 'store_lists.store_prod_category', '=', 'store_product_categories.id')
			->leftJoin('user_lists', 'store_lists.user_id', '=', 'user_lists.id')
			->leftJoin('shops', 'store_lists.user_id', '=', 'shops.id')
			->select('store_lists.*', 'store_product_categories.cat_name','user_lists.name','shops.shopname')
			->orderBy('store_lists.id', 'DESC') 
			->paginate(12);
	$category=Store_product_categories::all();
	$custmr1=User_lists::all();
	$role=Auth::user()->user_type;
	return view('store_listing',compact('stores','category','custmr1','role'));
   }
   public function storesinsert(Request $request){
		$store_list=new Store_lists;
		$store_list->user_type=$request->utype;
		$store_list->user_id=$request->cust;
		$store_list->product_name=$request->name;
		$store_list->price=$request->price;
		$store_list->description=$request->desc;
		$store_list->store_prod_category=$request->prod_cat;
		$store_list->status=1;
		if($files1=$request->file('image1')){  
			$name1=$files1->getClientOriginalName();  
			$files1->move('img',$name1);  
			
			$store_list->image_1=$name1; 
			
		}  
		if($files2=$request->file('image2')){  
			$name2=$files2->getClientOriginalName();  
			$files2->move('img',$name2);  
			
			$store_list->image_2=$name2; 
			
		}  
		if($files3=$request->file('image3')){  
			$name3=$files3->getClientOriginalName();  
			$files3->move('img',$name3);  
			
			$store_list->image_3=$name3; 
			
		}  
		$store_list->save();
		return redirect('store_listing')->with('success', 'Data Inserted Successfully');
	}
   public function storefetch(Request $request){
		$id=$request->id;
		$store=Store_lists::find($id);
		print_r(json_encode($store));
   }
     public function storesedit(Request $request){
		$id=$request->id;
		$store_list=Store_lists::find($id);
		$store_list->user_type=$request->utype;
		$store_list->user_id=$request->cust;
		$store_list->product_name=$request->name;
		$store_list->price=$request->price;
		$store_list->description=$request->desc;
		$store_list->store_prod_category=$request->prod_cat;
		$store_list->status=1;
		if($files1=$request->file('image1')){  
			$name1=$files1->getClientOriginalName();  
			$files1->move('img',$name1);  
			
			$store_list->image_1=$name1; 
			
		}  
		if($files2=$request->file('image2')){  
			$name2=$files2->getClientOriginalName();  
			$files2->move('img',$name2);  
			
			$store_list->image_2=$name2; 
			
		}  
		if($files3=$request->file('image3')){  
			$name3=$files3->getClientOriginalName();  
			$files3->move('img',$name3);  
			
			$store_list->image_3=$name3; 
			
		}  
		$store_list->save();
		return redirect('store_listing')->with('success', 'Data Edited Successfully');
	}
    public function store_categories(){
		$store_categories=Store_product_categories::all();
		$role=Auth::user()->user_type;
		return view('storecategories',compact('store_categories','role'));
	}
	
	public function store_categoriesinsert(Request $request){
		$store_category=new Store_product_categories;
		$store_category->cat_name=$request->category;
		$store_category->save();
		return redirect('store_categories')->with('success','Product Category inserted successfully');
	}
	
	public function store_categoriesfetch(Request $request){
		$id=$request->id;
		$store_category=Store_product_categories::find($id);
		print_r(json_encode($store_category));
	}
	
	public function store_categoriesedit(Request $request){
		$id=$request->id;
		$store_category=Store_product_categories::find($id);
		$store_category->cat_name = $request->category;
		$store_category->save();
		return redirect('store_categories')->with('success','Product Category edited successfully');
	}
	
	public function store_categoriesdelete($id){
		DB::delete('delete from store_product_categories where id = ?', [$id]);
		return redirect('store_categories')->with('success','Product Category deleted successfully');
	}
	
	public function shopproduct_offers(){
	
		$prodoffr = DB::table('product_offers')
            ->leftJoin('shops', 'product_offers.shop_id', '=', 'shops.id')
			->select('product_offers.*', 'shops.shopname')
			->orderBy('product_offers.id', 'DESC')
			->get();
		$shops=Shops::all();
		$role=Auth::user()->user_type;
		return view('product_offers',compact('prodoffr','shops','role'));
	}
	
	public function product_offersinsert(Request $request){
		$prod_offr=new Product_offers;
		$prod_offr->shop_id=$request->shop;
		$prod_offr->offer_type=$request->otype;
		$prod_offr->title=$request->title;
		$prod_offr->description=$request->desc;
		$prod_offr->normal_amount=$request->norm_amunt;
		$prod_offr->discount_amount=$request->dis_amunt;
		$prod_offr->end_date=$request->edate;
		if($files=$request->file('image')){  
			$name=$files->getClientOriginalName();  
			$files->move('img/',$name);  
			
			$prod_offr->product_picture=$name; 
			
		}  
		$prod_offr->save();
		return redirect('shopproduct_offers')->with('success','Product offer inserted successfully');
	}
	
	public function product_offersfetch(Request $request){
		$id=$request->id;
		$prod_offr=Product_offers::find($id);
		print_r(json_encode($prod_offr));
	}
	
	public function product_offersedit(Request $request){
		$id=$request->id;
		$prod_offr=Product_offers::find($id);
		$prod_offr->shop_id=$request->shop;
		$prod_offr->offer_type=$request->otype;
		$prod_offr->title=$request->title;
		$prod_offr->description=$request->desc;
		$prod_offr->normal_amount=$request->norm_amunt;
		$prod_offr->discount_amount=$request->dis_amunt;
		$prod_offr->end_date=$request->edate;
		if($files=$request->file('image')){  
			$name=$files->getClientOriginalName();  
			$files->move('img',$name);  
			
			$prod_offr->product_picture=$name; 
			
		}  
		$prod_offr->save();
		return redirect('shopproduct_offers')->with('success','Product offer edited successfully');
	}

	public function product_offersdelete($id){
		DB::delete('delete from product_offers where id = ?', [$id]);
		return redirect('shopproduct_offers')->with('success','Product offer deleted successfully');
	}
	
	public function shop_offers(){
		$shopoffr=Tbl_shop_offers::all();
		$shopoffr = DB::table('tbl_shop_offers')
            ->leftJoin('shops', 'tbl_shop_offers.shop_id', '=', 'shops.id')
			 ->leftJoin('shiop_categories', 'tbl_shop_offers.shop_cat_id', '=', 'shiop_categories.id')
			 ->leftJoin('brand_lists', 'tbl_shop_offers.brand_id', '=', 'brand_lists.id')
		     ->leftJoin('vehicle_types', 'tbl_shop_offers.vehicle_typeid', '=', 'vehicle_types.id')
		     ->leftJoin('brand_models', 'tbl_shop_offers.model_id', '=', 'brand_models.id')
			// ->leftJoin('product_offers', 'tbl_shop_offers.model_id', '=', 'product_offers.id')
			->select('tbl_shop_offers.*', 'shops.shopname','shiop_categories.category','brand_lists.brand','vehicle_types.veh_type','brand_models.brand_model')
			->get();
		$shops=Shops::all();
		$shop_cat=Shiop_categories::all();
		$brand=Brand_lists::all();
		$vehtype=Vehicle_types::all();
		$models=Brand_models::all();
		$role=Auth::user()->user_type;
		return view('shop_offers',compact('shopoffr','shop_cat','shops','brand','vehtype','models','role'));
	}
	
	public function shop_offersinsert(Request $request){
		$shop_offr=new Tbl_shop_offers;
		$shop_offr->shop_id=$request->shop;
		$shop_offr->shop_cat_id=$request->cat;
		$shop_offr->offer_type=$request->otype;
		$shop_offr->title=$request->title;
		$shop_offr->small_desc=$request->desc;
		$shop_offr->normal_amount=$request->norm_amunt;
		$shop_offr->offer_amount=$request->dis_amunt;
		$shop_offr->brand_id=$request->brand;
		$shop_offr->vehicle_typeid=$request->vetyp;
		$shop_offr->model_id=$request->model;
		$shop_offr->offer_end_date=$request->edate;
		if($files=$request->file('image')){  
			$name=$files->getClientOriginalName();  
			$files->move('img/',$name);  
			
			$shop_offr->pic=$name; 
			
		}  
		$shop_offr->save();
		return redirect('shop_offers')->with('success','Shop offer inserted successfully');
	}
	
	public function shop_offersfetch(Request $request){
		$id=$request->id;
		$shop_offr=Tbl_shop_offers::find($id);
		print_r(json_encode($shop_offr));
	}
	public function shop_offersedit(Request $request){
		$id=$request->id;
		$shop_offr=Tbl_shop_offers::find($id);
		$shop_offr->shop_id=$request->shop;
		$shop_offr->shop_cat_id=$request->cat;
		$shop_offr->offer_type=$request->otype;
		$shop_offr->title=$request->title;
		$shop_offr->small_desc=$request->desc;
		$shop_offr->normal_amount=$request->norm_amunt;
		$shop_offr->offer_amount=$request->dis_amunt;
		$shop_offr->brand_id=$request->brand;
		$shop_offr->vehicle_typeid=$request->vetyp;
		$shop_offr->model_id=$request->model;
		$shop_offr->offer_end_date=$request->edate;
		if($files=$request->file('image')){  
			$name=$files->getClientOriginalName();  
			$files->move('img/',$name);  
			
			$shop_offr->pic=$name; 
			
		}  
		$shop_offr->save();
		return redirect('shop_offers')->with('success','Shop offer edited successfully');
	}

	public function shop_offersdelete($id){
		if(DB::delete('delete from tbl_shop_offers where id = ?',[$id])){
			DB::delete('delete from shop_offer_models where offer_id = ?',[$id]);
		}

	return redirect('shop_offers')->with('success','Shop offer deleted successfully');
	}

	public function shopoffermodels(){
		$offrmodl=Shop_offer_models::all();
		$offrmodl = DB::table('shop_offer_models')
            ->leftJoin('shops', 'shop_offer_models.shop_id', '=', 'shops.id')
			->leftJoin('vehicle_types', 'shop_offer_models.vehicle_typeid', '=', 'vehicle_types.id')
			->leftJoin('brand_lists', 'shop_offer_models.brand_id', '=', 'brand_lists.id')
		    ->leftJoin('brand_models', 'shop_offer_models.model_id', '=', 'brand_models.id')
			->leftJoin('tbl_shop_offers', 'shop_offer_models.offer_id', '=', 'tbl_shop_offers.id')
			->where('shops.shopname','!=',null)
			->select('shop_offer_models.*', 'shops.shopname','brand_lists.brand','brand_models.brand_model','tbl_shop_offers.title','vehicle_types.veh_type')
			->paginate(20);

		$shops=Shops::all();
		$shopoffr=Tbl_shop_offers::all();
		$brand=Brand_lists::all();
		$vehtype=Vehicle_types::all();
		$models=Brand_models::all();
		$role=Auth::user()->user_type;
		return view('shopoffermodels',compact('offrmodl','shopoffr','shops','brand','vehtype','models','role'));
	}
	
	public function shopoffermodelsinsert(Request $request){
		$offr_model=new Shop_offer_models;
		$offr_model->shop_id=$request->shop;
		$offr_model->offer_id=$request->offr;
		$offr_model->vehicle_type_id=$request->vehtyp;
		$offr_model->brand_id=$request->brand;
		$offr_model->model_id=$request->model;
		$offr_model->save();
		return redirect('shopoffermodels');
	}
	
	public function shopoffermodelsfetch(Request $request){
		$id=$request->id;
		$offr_model=Shop_offer_models::find($id);
		print_r(json_encode($offr_model));
	}
	public function shopoffermodels_edit(Request $request){
		$id=$request->id;
		$offrm=Shop_offer_models::find($id);
		$offrm->shop_id=$request->shop;
		$offrm->offer_id=$request->offr;
		$offrm->vehicle_type_id=$request->vehtype;
		$offrm->brand_id=$request->brand_edit;
		$offrm->model_id=$request->model;
		$offrm->save();
		return redirect('shopoffermodels');
	}
	public function shopoffermodelsdelete($id){
		DB::delete('delete from shop_offer_models where id = ?',[$id]);
		return redirect('shopoffermodels');
	}



public function shopservices(){
    $uniqueShops = DB::table('shop_services')
        ->select('shops.id', 'shops.shopname', 'shops.phone_number')
        ->leftJoin('shops', 'shop_services.shop_id', '=', 'shops.id')
        ->groupBy('shops.id', 'shops.shopname', 'shops.phone_number')
        ->orderBy('shops.shopname')
        ->get();

    $shopserv = DB::table('shop_services')
        ->leftJoin('shops', 'shop_services.shop_id', '=', 'shops.id')
        ->select('shop_services.*', 'shops.shopname', 'shops.phone_number')
        ->orderBy('shop_services.id', 'desc')
        ->paginate(12);

    $role = Auth::user()->user_type;

    return view('shopservices', compact('uniqueShops', 'shopserv', 'role'));
}

public function shop_vehicle($Id) {
    $veh = DB::table('shop_services')
        ->leftJoin('shops', 'shop_services.shop_id', '=', 'shops.id')
        ->leftJoin('brand_models', 'shop_services.vehicle_model_id', '=', 'brand_models.id')
        ->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')
        ->select('shop_services.*', 'brand_lists.vehicle as veh_type', 'brand_lists.brand', 'brand_models.brand_model')
        ->orderBy('id', 'DESC')->get();

    $brand = Brand_lists::all();
    $vehtype = Vehicle_types::all();
    $models = Brand_models::all();
    $role = Auth::user()->user_type;

    return view('shop_vehicle', compact('veh', 'role', 'brand', 'vehtype', 'models', 'Id'));
}


	
	public function shopservicesinsert(Request $request){
		$shop_serv=new Shop_services;
		$shop_serv->shop_id=$request->shop;
		$shop_serv->shop_category=$request->shop_cat;
		$shop_serv->vehicle_type_id=$request->vehtyp;
		$shop_serv->vehicle_brand_id=$request->brand;
		$shop_serv->vehicle_model_id=$request->model;
		$shop_serv->save();
		return redirect('shopservices');
	}
	
	public function shopservicesfetch(Request $request){
		$id=$request->id;
		$shop_serv=Shop_services::find($id);
		print_r(json_encode($shop_serv));
	}
	public function shopservicesedit(Request $request){
		$id=$request->id;
		$shop_serv=Shop_services::find($id);
		$shop_serv->shop_id=$request->shop;
		$shop_serv->shop_category=$request->shop_cat;
		$shop_serv->vehicle_type_id=$request->vehtype;
		$shop_serv->vehicle_brand_id=$request->brand_edit;
		$shop_serv->vehicle_model_id=$request->model;
		$shop_serv->save();
		return redirect('shopservices');
	}
	public function shopservicesdelete($id){
		DB::delete('delete from shop_services where id = ?',[$id]);
		return redirect('shopservices');
	}
	public function shoptimeslot(){
		// $shoptim=Shop_timeslots::all();
		$shoptim = DB::table('shop_timeslots')
            ->leftJoin('shops', 'shop_timeslots.shop_id', '=', 'shops.id')
			->select('shop_timeslots.*', 'shops.shopname')
			->orderBy('shop_timeslots.id', 'DESC')
			->get();
		$shops=Shops::all();
		$role=Auth::user()->user_type;
		return view('shop_timeslots',compact('shoptim','shops','role'));
	}
	
	public function shoptimeslotinsert(Request $request){
		$shop_timeslots=new Shop_timeslots;
		$shop_timeslots->shop_id=$request->shop;
		$shop_timeslots->timeslot=$request->timeslot;
		$shop_timeslots->save();
		return redirect('shoptimeslot')->with('success','Shop Timeslot inserted successfully');
	}
	
	public function shoptimeslotfetch(Request $request){
		$id=$request->id;
		$shop_timeslots=Shop_timeslots::find($id);
		print_r(json_encode($shop_timeslots));
	}
	public function shoptimeslotedit(Request $request){
		$id=$request->id;
		$shop_time=Shop_timeslots::find($id);
		$shop_time->shop_id=$request->shop;
		$shop_time->timeslot=$request->timeslot;
		$shop_time->save();
		return redirect('shoptimeslot')->with('success','Shop Timeslot edited successfully');
	}
	public function shoptimeslotdelete($id){
		DB::delete('delete from shop_timeslots where id = ?', [$id]);
		return redirect('shoptimeslot')->with('success','Shop Timeslot deleted successfully');
	}
	
	public function shopreviews(){
		
		$review = DB::table('reviews')
            ->leftJoin('shops', 'reviews.shop_id', '=', 'shops.id')
			->leftJoin('user_lists', 'reviews.user_id', '=', 'user_lists.id')
			->select('reviews.*', 'shops.shopname','user_lists.name')
			->orderBy('reviews.id', 'DESC')
			->get();
		$shops=Shops::all();
		$custmr1=User_lists::all();
		$role=Auth::user()->user_type;
		return view('reviews',compact('review','shops','custmr1','role'));
	}
	
	
	
	public function shopreviewsfetch(Request $request){
		$id=$request->id;
		$review=Reviews::find($id);
		print_r(json_encode($review));
	}
	
	public function shopreviewsdelete($id){
		DB::delete('delete from reviews where id = ?',[$id]);
		return redirect('shopreviews')->with('success','Reviews deleted successfully');
	}
	
	public function shop_providcat(){
		$provd_cat=Shop_provide_categories::all();
		$provd_cat = DB::table('shop_provide_categories')
            ->leftJoin('shiop_categories', 'shop_provide_categories.shop_cat_id', '=', 'shiop_categories.id')
			->leftJoin('shops', 'shop_provide_categories.shop_id', '=', 'shops.id')
			->select('shop_provide_categories.*', 'shiop_categories.category','shops.shopname')
			->orderBy('shop_provide_categories.id', 'DESC')
			->get();
	
		$shop_cat=Shiop_categories::all();
		//$exe=Executives::all();
		$shops=Shops::all();
		$shops1=Shops::all();
		$role=Auth::user()->user_type;
		return view('shop_provided_categories',compact('provd_cat','shops','shops1','shop_cat','role'));
	}
    public function shop_providcatinsert(Request $request){
		$provd_cat=new Shop_provide_categories;
		$provd_cat->shop_id=$request->shop;
		$provd_cat->shop_cat_id=$request->category;
		$provd_cat->save();
		return redirect('shop_providcat')->with('success','Provided Category inserted successfully');
	}
	public function shop_providcatfetch(Request $request){
		$id=$request->id;
		$shop_provid=Shop_provide_categories::find($id);
		print_r(json_encode($shop_provid));
	}
	public function shop_providcatedit(Request $request){
		$id=$request->id;
		$shop_provd_cat=Shop_provide_categories::find($id);
		$shop_provd_cat->shop_id=$request->shop;
		$shop_provd_cat->shop_cat_id=$request->cat;
		$shop_provd_cat->save();
		return redirect('shop_providcat')->with('success','Provided Category edited successfully');
	}

	public function shop_providcatdelete($id){
    DB::delete('delete from shop_provide_categories where id = ?', [$id]);
    return redirect('shop_providcat')->with('success','Provided Category deleted successfully');
}

    public function shop_categories(){
		
		$shop_categories = DB::table('shiop_categories')
		->orderBy('id', 'DESC')
		->get();
		$role=Auth::user()->user_type;
		return view('shopcategories',compact('shop_categories','role'));
	}
	
	public function shop_categoriesinsert(Request $request){
		$shop_category=new Shiop_categories;
		$shop_category->category=$request->category;
		$shop_category->status=1;
		$shop_category->roadmate_percentage=$request->percentage;
		if($files=$request->file('image')){  
			$name=$files->getClientOriginalName();  
			$files->move('img/',$name);  
			
			$shop_category->image=$name; 
			
		}  
		$shop_category->save();
		return redirect('shop_categories')->with('success','Shop category inserted successfully');
	}
	public function shop_categoriesfetch(Request $request){
		$id=$request->id;
		$shop_category=Shiop_categories::find($id);
		print_r(json_encode($shop_category));
	}
	public function shop_categoriesedit(Request $request){
		$id=$request->id;
		$shop_category=Shiop_categories::find($id);
		$shop_category->category = $request->category;
		$shop_category->order_number=$request->ordernumber;
		$shop_category->roadmate_percentage=$request->percentage;
		if($files=$request->file('image')){  
			$name=$files->getClientOriginalName();  
			$files->move('img',$name);  
		
			$shop_category->image=$name; 
			
		}  else{
			$shop_category->image=$request->image;
		}
		$shop_category->save();
		return redirect('shop_categories')->with('success','Shop category inserted successfully');
	}

public function shop_categoriesdelete($id){
    DB::delete('delete from shiop_categories where id = ?', [$id]);
    return redirect('shop_categories')->with('success','Shop category deleted successfully');
}

	
	public function shops(){
		$shop_categories=Shiop_categories::all();
		$exe=Executives::all();
		$con = Tbl_countrys::where('deleted_status', 0)->get();
		$cond = Tbl_states::where('deleted_status', 0)->get();
		$dis = Tbl_districts::where('deleted_status', 0)->get();
		$plac = Tbl_places::leftJoin('tbl_districts', 'tbl_places.district_id', '=', 'tbl_districts.id')
			->leftJoin('tbl_states', 'tbl_districts.state_id', '=', 'tbl_states.id')
			->leftJoin('tbl_countrys', 'tbl_states.country_id', '=', 'tbl_countrys.id')
			->select('tbl_places.*', 'tbl_districts.state_id', 'tbl_states.country_id', 'tbl_countrys.country_name', 'tbl_states.state_name', 'tbl_districts.district_name')
			->get();
	
		$type = "";
		$shops = DB::table('shops')
            ->leftJoin('shiop_categories', 'shops.type', '=', 'shiop_categories.id')
			->leftJoin('executives', 'shops.exeid', '=', 'executives.id')
			->select('shops.*', 'shiop_categories.category','executives.name')
			->orderBy('shops.id','DESC')
			->paginate(12);
			$role=Auth::user()->user_type;
		
		return view('shops',compact('shops','shop_categories','exe','con', 'cond', 'dis', 'plac', 'type','role'));
	}
	public function exportshop()
	{
		$headers = array(
			"Content-type" => "text/csv",
			"Content-Disposition" => "attachment; filename=file.csv",
			"Pragma" => "no-cache",
			"Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
			"Expires" => "0"
		);
	
		$reviews = DB::table('shops')->get();
		$columns = array('Timing', 'Open Time', 'Close Time', 'Shop name', 'Address', 'Phone Number', 'Phone Number 2', 'Pincode', 'Description', 'Status');
	
		$callback = function() use ($reviews, $columns)
		{
			$file = fopen('php://output', 'w');
			fputcsv($file, $columns);
	
			foreach($reviews as $review) {
				fputcsv($file, array($review->timming, $review->open_time, $review->close_time, $review->shopname, $review->address, $review->phone_number, $review->phone_number2, $review->pincode, $review->description, $review->authorised_status));
			}
			fclose($file);
		};
		return Response::stream($callback, 200, $headers);
		}
	public function vshops(){
		$shop_categories=Shiop_categories::all();
		$exe=Executives::all();

		$role=Auth::user()->user_type;

		if($role==3){
			$shops = DB::table('shops')
            ->leftJoin('shiop_categories', 'shops.type', '=', 'shiop_categories.id')
			->leftJoin('executives', 'shops.exeid', '=', 'executives.id')
			->select('shops.*', 'shiop_categories.category','executives.name')
			->orderBy('shops.id','DESC')
			->where('shops.authorised_status',0)
			->paginate(12);
		}else{
			$shops = DB::table('shops')
            ->leftJoin('shiop_categories', 'shops.type', '=', 'shiop_categories.id')
			->leftJoin('executives', 'shops.exeid', '=', 'executives.id')
			->select('shops.*', 'shiop_categories.category','executives.name')
			->orderBy('shops.id','DESC')
			->where('shops.authorised_status',0)
			->paginate(12);
		}
		
		$con = Tbl_countrys::where('deleted_status', 0)->get();
		$cond = Tbl_states::where('deleted_status', 0)->get();
		$dis = Tbl_districts::where('deleted_status', 0)->get();
			
		
		return view('shops',compact('shops','shop_categories','exe','role','con','cond','dis'));	
	}
	public function ashops(){
		$shop_categories=Shiop_categories::all();
		$exe=Executives::all();
		$role=Auth::user()->user_type;
		$userid=Auth::user()->id;
		$con = Tbl_countrys::where('deleted_status', 0)->get();
		$cond = Tbl_states::where('deleted_status', 0)->get();
		$dis = Tbl_districts::where('deleted_status', 0)->get();
		$plac = Tbl_places::leftJoin('tbl_districts', 'tbl_places.district_id', '=', 'tbl_districts.id')
			->leftJoin('tbl_states', 'tbl_districts.state_id', '=', 'tbl_states.id')
			->leftJoin('tbl_countrys', 'tbl_states.country_id', '=', 'tbl_countrys.id')
			->select('tbl_places.*', 'tbl_districts.state_id', 'tbl_states.country_id', 'tbl_countrys.country_name', 'tbl_states.state_name', 'tbl_districts.district_name')
			->get();
	
		$type = "";

		
			$shops="";

		if($role==3){
			$fran=DB::table('tbl_franchase_details')
			->leftJoin('tbl_franchises', 'tbl_franchase_details.franchise_id', '=', 'tbl_franchises.id')
			->where('tbl_franchises.user_id',$userid)
			->select('tbl_franchase_details.*')
			->get();
			foreach($fran as $singleFranlist){
				if($singleFranlist->type==4){
					$shops = DB::table('shops')
					->leftJoin('tbl_places', 'shops.place_id', '=', 'tbl_places.id')
					->leftJoin('shiop_categories', 'shops.type', '=', 'shiop_categories.id')
					->leftJoin('executives', 'shops.exeid', '=', 'executives.id')
					->select('shops.*', 'shiop_categories.category','executives.name')
					->orderBy('shops.id','DESC')
					->where('shops.authorised_status',1)
					->where('tbl_places.district_id',$singleFranlist->district_id)
					->paginate(12);
				}else{
					$shops= DB::table('shops')
					->leftJoin('tbl_places', 'shops.place_id', '=', 'tbl_places.id')
					->leftJoin('shiop_categories', 'shops.type', '=', 'shiop_categories.id')
					->leftJoin('executives', 'shops.exeid', '=', 'executives.id')
					->select('shops.*', 'shiop_categories.category','executives.name')
					->orderBy('shops.id','DESC')
					->where('shops.authorised_status',1)
					->where('tbl_places.id',$singleFranlist->place_id)
					->paginate(12);
				}

			}
			
		
		}elseif($role==7){
		    $eid=DB::table('executives')->where('user_id',$userid)->first();
		    
		    	$shops = DB::table('shops')
            ->leftJoin('shiop_categories', 'shops.type', '=', 'shiop_categories.id')
			->leftJoin('executives', 'shops.exeid', '=', 'executives.id')
			->select('shops.*', 'shiop_categories.category','executives.name')
			->orderBy('shops.id','DESC')
			->where('shops.authorised_status',1)
			->where(function ($query) {
				$query->where('shops.place_id', 0)
					  ->orWhereNull('shops.place_id');
			})
			->where('shops.exeid',$eid->id)
		
			->paginate(12);
		}
		elseif($role==1){
			$shops = DB::table('shops')
            ->leftJoin('shiop_categories', 'shops.type', '=', 'shiop_categories.id')
			->leftJoin('executives', 'shops.exeid', '=', 'executives.id')
			->select('shops.*', 'shiop_categories.category','executives.name')
			->orderBy('shops.id','DESC')
			->where('shops.authorised_status',1)
		//	->where('shops.place_id',$singleFranlist->place_id)
			->paginate(12);
		
		}
		
	
		
		return view('shops',compact('shops','shop_categories','exe','role','con','cond','dis','plac','type'));	
	}

	public function shopinsert(Request $request){
		$shop = new Shops;
		$shop->type = $request->category;
		$shop->timming = 0;
		$shop->exeid = $request->exename;
		$shop->agrimentverification_status = $request->verif_status;
		$shop->pay_status = $request->pay_status;
		$shop->shop_oc_status = $request->oc_status;
		$shop->trans_id = $request->trans_id;
		$shop->open_time = $request->open;
		$shop->close_time = $request->close;
		$shop->shopname = $request->shopname;
		$shop->address = $request->address;
		$shop->phone_number = $request->phone1;
		$shop->phone_number2 = $request->phone2;
		$shop->pincode = $request->pincode;
		$shop->description = $request->desc;
		$shop->lattitude = $request->latitude;
		$shop->logitude = $request->longitude;
		$shop->authorised_status = $request->autherised;
	
		// Get the last selected place_id
		$placeIds = $request->input('place_id');
    	$lastPlaceId = end($placeIds);

    	$shop->place_id = $lastPlaceId;

	
	
		$shop->delivery_id = 0;
		$shop->status = 1;
	
		if ($files = $request->file('image')) {
			$name = $files->getClientOriginalName();
			$files->move('img/', $name);
			$shop->image = $name;
		}
	
		if ($shop->save()) {
			$shopcat = new shop_provide_categories;
			$shopcat->shop_id = $shop->id;
			$shopcat->shop_cat_id = $request->category;
			$shopcat->save();
			return redirect('shops')->with('success', 'Shop added successfully!');
		}
	}
	

	public function shopfetch(Request $request){
		$id=$request->id;
		$shop=Shops::find($id);
		print_r(json_encode($shop));
	}
	public function createaccount(Request $request){
	    $id=$request->id;
		$account=new User;
		$account->name="BDE";
		$account->email=$request->email;
		$account->user_type=7;
		$account->login_status=0;
		$account->password=Hash::make("Roadmate@BDE");
		if($account->save()){
			DB::table('executives')
            ->where('id', $id)
            ->update(['user_id' =>$account->id]);
		}
		return redirect()->back();
		
	}
	public function shopedit(Request $request){
		$id=$request->id;
		$shop=Shops::find($id);
		$shop->type=$request->category;
		$shop->timming=0;
		$shop->exeid=$request->exename;
		$shop->agrimentverification_status=$request->verif_status;
		$shop->pay_status=$request->pay_status;
		$shop->shop_oc_status=$request->oc_status;
		$shop->trans_id=$request->trans_id;
		$shop->open_time=$request->open;
		$shop->close_time=$request->close;
		$shop->shopname=$request->shopname;
		$shop->address=$request->address;
		$shop->phone_number=$request->phone1;
		$shop->phone_number2=$request->phone2;
		$shop->pincode=$request->pincode;
		$shop->place_id=$request->place_id;
		$shop->description=$request->desc;
		$shop->lattitude=$request->latitude;
		$shop->logitude=$request->longitude;
		$shop->status=1;
		if($files=$request->file('image')){  
			$name=$files->getClientOriginalName();  
			$files->move('img',$name);  
			
			$shop->image=$name; 
			
		}  
		$shop->save();
		return redirect('shops')->with('success', 'Shop edited successfully!');
	}
    public function marketproducts(){
	    $market = DB::table('tbl_rm_products')
        ->leftJoin('tbl_rm_categorys', 'tbl_rm_products.cat_id', '=', 'tbl_rm_categorys.id')
		->leftJoin('tbl_vendors', 'tbl_rm_products.vendor_id', '=', 'tbl_vendors.id')
        ->select('tbl_rm_products.*', 'tbl_rm_categorys.category_name', 'tbl_vendors.vendor_name','tbl_rm_categorys.cat_id')
        ->orderby('tbl_rm_products.id','desc')->get();
		$mark=DB::table('tbl_rm_categorys')
		->where('status',0)
		->where('cat_id',0)
		->get();
		$vendor=DB::table('tbl_vendors')
		->where('status',0)
        ->get();
        //echo "<pre>";print_r($market);exit;
		$role=Auth::user()->user_type;
		return view('marketproducts',compact('market','mark','role','vendor'));
	}
   public function marketproductinsert(Request $request)
	{
		$market = new Tbl_rm_products;
	    $market->brand_name = $request->brand_name;
		$market->cat_id = $request->subcategory;
		$market->vendor_id = $request->supplier;
        $market->status = 0;
		$market->save();
        return redirect('marketproducts')->with('success', 'Product added successfully');
	}
    public function marketproductimageinsert(Request $request)
	{
	
		$prod_id=$request->productid;
		$request->validate([
			'images.*' => 'required|image|mimes:jpeg,png,jpg,gif',
		]);
	
		foreach ($request->file('images') as $image) {
			$imageName = uniqid() . '.' . $image->getClientOriginalExtension();
			$image->move('market', $imageName);
	
			Tbl_productimages::create([
				'prod_id' => $prod_id,
				'images' => $imageName,
			]);
		}
	   return redirect()->back()->with('success', 'Images added successfully.');
	}
	public function marketproductfetch(Request $request){
		$id = $request->id;
		$market=DB::table('tbl_rm_products')
		->leftJoin('tbl_rm_categorys', 'tbl_rm_products.cat_id', '=', 'tbl_rm_categorys.id')
		->where('tbl_rm_products.id',$id)
		->select('tbl_rm_products.*','tbl_rm_categorys.cat_id as maincat_id')
		->first();

	

		// $subcat_id=
		
		
		 print_r(json_encode($market));
		}
		public function getmarketsubcatlist(Request $request){
			$subcatlist=DB::table('tbl_rm_categorys')->where('cat_id',$request->cid)->get();

			if($subcatlist){
		 	
				$namelist='';
								foreach($subcatlist as $key => $single){
		
				$namelist.='<option value="'.$single->id.'">'.$single->category_name.'</option>';
								}
						
				}
				return Response($namelist);
		}
	public function productimagefetch(Request $request){
		$id=$request->prod_id;
		$market1=DB::table('tbl_productimages')->where('prod_id',$id)->get();
		print_r(json_encode($market1));
		
	}
	public function marketproductimagedelete(Request $request)
	{
		$imageId = $request->image_id;
	
		// Fetch the image details
		$image = Tbl_productimages::find($imageId);
	
		if (!$image) {
			return response()->json(['success' => false, 'message' => 'Image not found.']);
		}
	
		// Delete the image file
		$imagePath = public_path('market/' . $image->images);
		if (file_exists($imagePath)) {
			unlink($imagePath);
		}
	
		// Delete the image record from the database
		$image->delete();
	
		return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
	}
	public function marketproductedit(Request $request)
{
    $id = $request->id;
    $market = Tbl_rm_products::find($id);
	$market->brand_name = $request->brand_name;
    $market->cat_id = $request->subcategory;
	$market->vendor_id = $request->supplier;
    $market->status = $request->status;
	$market->save();
    return redirect('marketproducts');
}
    public function customers(Request $request)
	{
       if($request->ajax())
		{
		   $status=$request->status;
		   $customers=DB::table('user_lists')->orderBy('id', 'DESC')->where('status',$status)->get();
		   return view('customer_filter',compact('customers'));
		}
		$customers=DB::table('user_lists')->orderBy('id', 'DESC')->get();
		
		return view('customers',compact('customers'));
	}

	public function shopdelete($id){
		DB::delete('delete from shops where id = ?', [$id]);
		return redirect('shops')->with('success', 'Shop Deleted Successfully');
	}
	

	public function storedelete($id){
		DB::delete('delete from store_lists where id = ?', [$id]);
		return redirect('store_listing')->with('success', 'Store Deleted Successfully');
	}
	


	public function editstore(Request $request){
		$id=$request->id;
		$store_list=Store_lists::find($id);
		$store_list->user_type=$request->utype;
		$store_list->user_id=$request->cust;
		$store_list->product_name=$request->name;
		$store_list->price=$request->price;
		$store_list->description=$request->desc;
		$store_list->store_prod_category=$request->prod_cat;
		$store_list->status=1;
		if($files1=$request->file('image1')){  
			$name1=$files1->getClientOriginalName();  
			$files1->move('img',$name1);  
			$store_list->image_1=$name1; 
			
		}  
		if($files2=$request->file('image2')){  
			$name2=$files2->getClientOriginalName();  
			$files2->move('img',$name2);  
			$store_list->image_2=$name2; 
			
		}  
		if($files3=$request->file('image3')){  
			$name3=$files3->getClientOriginalName();  
			$files3->move('img',$name3);  
			$store_list->image_3=$name3; 
			
		}  
		$store_list->save();
		return redirect('store_listing');
	}
	public function vehtype(){
		$veh=Vehicle_types::all();
		$role=Auth::user()->user_type;
		return view('vehicle_type',compact('veh','role'));
	}
	public function vehtypefetch(Request $request){
		$id=$request->id;
		$vehtype=Vehicle_types::find($id);
		print_r(json_encode($vehtype));
	}
	public function editvehtype(Request $request){
		$id=$request->id;
		$vehtype=Vehicle_types::find($id);
		$vehtype->veh_type=$request->vehtype;
		$vehtype->save();
		return redirect('vehtype')->with('success', 'Vehicle type edited successfully');
	}
	public function vehtypeinsert(Request $request){
		$vehtype=new Vehicle_types;
		$vehtype->veh_type=$request->vehtype;
		$vehtype->veh_img=0;
		$vehtype->save();
		return redirect('vehtype')->with('success', 'Vehicle type inserted successfully');
	}
	public function vehtypedelete($id){
		DB::delete('delete from vehicle_types where id = ?', [$id]);
		return redirect('vehtype')->with('success', 'Vehicle type deleted successfully');
	}
	
	public function fueltype(){
		$fuel=Fuel_types::all();
		$role=Auth::user()->user_type;
		return view('fuel_type',compact('fuel','role'));
	}
	public function fueltypeinsert(Request $request){
		$fueltype=new Fuel_types;
		$fueltype->fuel_type=$request->fueltype;
		$fueltype->save();
		return redirect('fueltype')->with('success', 'Fuel type Inserted successfully');
	}
	public function fueltypefetch(Request $request){
		$id=$request->id;
		$fueltype=Fuel_types::find($id);
		print_r(json_encode($fueltype));
	}
	public function editfueltype(Request $request){
		$id=$request->id;
		$fueltype=Fuel_types::find($id);
		$fueltype->fuel_type=$request->fueltype;
		$fueltype->save();
		return redirect('fueltype')->with('success', 'Fuel type edited successfully');
	}
	public function fueltypedelete($id){
		DB::delete('delete from fuel_types where id = ?', [$id]);
		return redirect('fueltype')->with('success', 'Fuel type deleted successfully');
	}
	
	public function brand(){
	
		$brand=DB::table('brand_lists')
		->leftJoin('vehicle_types', 'brand_lists.vehicle', '=', 'vehicle_types.id')
		->select('brand_lists.*', 'vehicle_types.veh_type')
		->orderBy('brand_lists.id', 'DESC')
		->get();
		$vehtype=Vehicle_types::all();
		$vehtype1=Vehicle_types::all();
		$vehtype2=Vehicle_types::all();
		$role=Auth::user()->user_type;
		return view('brand',compact('brand','vehtype','vehtype1','vehtype2','role'));
	}
	public function brandfetch(Request $request){
		$id=$request->id;
		$brands=Brand_lists::find($id);
		//$brand=DB::table('brand_lists')
		//->leftJoin('vehicle_types', 'brand_lists.vehicle', '=', 'vehicle_types.id')
		//->where('brand_lists',$id)
		//->select('brand_lists.*','vehicle_types.veh_type')
		//->first();
		print_r(json_encode($brands));
	}
	public function vehbrandfetch(Request $request){
		$id=$request->id;
		$brands=DB::table('brand_lists')
		->where('vehicle',$id)
		->get();
		//$brand=DB::table('brand_lists')
		//->leftJoin('vehicle_types', 'brand_lists.vehicle', '=', 'vehicle_types.id')
		//->where('brand_lists',$id)
		//->select('brand_lists.*','vehicle_types.veh_type')
		//->first();
		print_r(json_encode($brands));
	}
	public function brmodelfetch(Request $request){
		$id=$request->id;
		$models=DB::table('brand_models')
		->where('brand',$id)
		->get();
		//$brand=DB::table('brand_lists')
		//->leftJoin('vehicle_types', 'brand_lists.vehicle', '=', 'vehicle_types.id')
		//->where('brand_lists',$id)
		//->select('brand_lists.*','vehicle_types.veh_type')
		//->first();
		print_r(json_encode($models));
	}
	public function packagevehicleinsert(Request $request){
		$package=new Packages_forvehmodels;
		$package->package_id=$request->package_type;
		$package->model_id=$request->vehmodel;
		$package->fuel_type=$request->fueltype;
		$package->save();
		return redirect('common');
	}
	public function editbarnd(Request $request){
		$id=$request->id;
		$brands=Brand_lists::find($id);
		$brands->vehicle=$request->vehtype;
		$brands->brand=$request->brand;
		$brands->save();
		return redirect('brand')->with('success','Brand edited successfully');
	}
	public function brandinsert(Request $request){
		$brand=new Brand_lists;
		$brand->vehicle=$request->vehtype;
		$brand->brand=$request->brand;
		$brand->save();
		return redirect('brand')->with('success','Brand inserted successfully');
	}
	public function branddelete($id){
		DB::delete('delete from brand_lists where id = ?', [$id]);
		return redirect('brand')->with('success','Brand deleted successfully');
	}
	
	public function models(){
		$model=Brand_models::all();
		$model=DB::table('brand_models')
		->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')
		//->leftJoin('vehicle_types', 'brand_lists.vehicle', '=', 'vehicle_types.id')
		->leftJoin('fuel_types', 'brand_models.fuel_type', '=', 'fuel_types.id')
		->select('brand_models.*', 'fuel_types.fuel_type','brand_lists.brand')
		->orderBy('brand_models.id', 'DESC')
		->get();
		$fuel=Fuel_types::all();
		$vehtype=Vehicle_types::all();
		$vehtype1=Vehicle_types::all();
		$fuel1=Fuel_types::all();
		$brand=Brand_lists::all();
		$brand1=Brand_lists::all();
		$role=Auth::user()->user_type;
		return view('models',compact('model','vehtype','vehtype1','fuel','fuel1','brand','brand1','role'));
	}
	public function brandidfetch(Request $request){
		$id=$request->id;
		$brand=DB::table('brand_lists')
		->where('vehicle',$id)
		->pluck("brand","id");
		 return response()->json($brand);
	}
	public function modelinsert(Request $request){
		$model =new Brand_models;
		$model->brand_model=$request->models;
		$model->brand=$request->brand;
		$model->fuel_type=$request->fuel;
		$model->save();
		return redirect('models')->with('success','Model inserted successfully');
	}
	public function modelfetch(Request $request){
		$id=$request->id;
		$models=Brand_models::find($id);
		//$models=DB::table('brand_models')
		//->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')
		//->leftJoin('fuel_types', 'brand_models.fuel_type', '=', 'fuel_types.id')
		//->where('brand_models',$id)
		//->select('brand_models.*','brand_lists.brand','fuel_types.fuel_type')
		//->first();
		print_r(json_encode($models));
	}
	
	public function modeledit(Request $request){
		$id=$request->id;
		$models=Brand_models::find($id);
		$models->brand_model=$request->model_edit;
		$models->brand=$request->brand_edit;
		$models->fuel_type=$request->fuel_edit;
		$models->save();
		return redirect('models')->with('success','Model edited successfully');
	}

	public function modeledelete($id){
		DB::delete('delete from brand_models where id = ?', [$id]);
		return redirect('models')->with('success','Model deleted successfully');
	}
	
	public function vehcle(){
		$vehcl=Vehicles::all();
		$vehcl=DB::table('vehicles')
		->leftJoin('brand_lists', 'vehicles.brand', '=', 'brand_lists.id')
		->leftJoin('fuel_types', 'vehicles.fuel_type', '=', 'fuel_types.id')
		->select('vehicles.*', 'brand_lists.brand','fuel_types.fuel_type')
		->get();
		$fuel=Fuel_types::all();
		$brand=Brand_lists::all();
		$role=Auth::user()->user_type;
		
		return view('vehicles',compact('vehcl','fuel','brand','role'));
	}
	public function vehcleinsert(Request $request){
		$vehcl =new Vehicles;
		$vehcl->model=$request->models;
		$vehcl->brand=$request->brand;
		$vehcl->fuel_type=$request->fuel;
		$vehcl->save();
		return redirect('vehcle')->with('success','Vehicle inserted successfully');
	}
	
	public function vehclefetch(Request $request){
		$id=$request->id;
		$vehcl=Vehicles::find($id);
		//$vehcl=Vehicles::find($id);
		//$vehcl=DB::table('vehicles')
		//->leftJoin('brand_lists', 'vehicles.brand', '=', 'brand_lists.id')
		//->leftJoin('fuel_types', 'vehicles.fuel_type', '=', 'fuel_types.id')
		//->where('vehicles',$id)
		//->select('vehicles.*', 'brand_lists.brand','fuel_types.fuel_type')
		//->first();
		//$models=DB::table('brand_models')
		//->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')
		//->leftJoin('fuel_types', 'brand_models.fuel_type', '=', 'fuel_types.id')
		//->where('brand_models',$id)
		//->select('brand_models.*','brand_lists.brand','fuel_types.fuel_type')
		//->first();
		print_r(json_encode($vehcl));
	}
	public function vehcleedit(Request $request){
		$id=$request->id;
		$vehcl=Vehicles::find($id);
		$vehcl->model=$request->model_edit;
		$vehcl->brand=$request->brand_edit;
		$vehcl->fuel_type=$request->fuel_edit;
		$vehcl->save();
		return redirect('vehcle')->with('success','Vehicle edited successfully');
	}

	public function vehcledelete($id){
    DB::delete('delete from vehicles where id = ?', [$id]);
    return redirect('vehcle')->with('success','Vehicle deleted successfully');
}

	public function uservehcle(){
		
		$usrvehcl=DB::table('user_vehicles')
		->leftJoin('user_lists', 'user_vehicles.user_id', '=', 'user_lists.id')
		->leftJoin('vehicle_types', 'user_vehicles.vehicle_type', '=', 'vehicle_types.id')
		->leftJoin('fuel_types', 'user_vehicles.fuel_type', '=', 'fuel_types.id')
		->leftJoin('brand_lists', 'user_vehicles.vehicle_brand', '=', 'brand_lists.id')
		->leftJoin('brand_models', 'user_vehicles.vehicle_model', '=', 'brand_models.id')
		->select('user_vehicles.*', 'brand_lists.brand','fuel_types.fuel_type','brand_models.brand_model','vehicle_types.veh_type','user_lists.name')
		->orderBy('user_vehicles.id', 'DESC')
		->get();
		$fuel=Fuel_types::all();
		$brand=Brand_lists::all();
		$vehtype=Vehicle_types::all();
		$models=Brand_models::all();
		$custmr1=User_lists::all();
		$role=Auth::user()->user_type;
		return view('customer_vehicles',compact('usrvehcl','fuel','brand','vehtype','models','custmr1','role'));
	}
	
	public function uservehcleinsert(Request $request){
		$usrvehcl =new User_vehicles;
		$usrvehcl->user_id=$request->cust;
		$usrvehcl->vehicle_type=$request->vehtype;
		$usrvehcl->vehicle_model=$request->model;
		$usrvehcl->vehicle_brand=$request->brand;
		$usrvehcl->fuel_type=$request->fuel;
		$usrvehcl->vehicle_number=$request->vehnum;
		$usrvehcl->save();
		return redirect('uservehcle')->with('success','Customers vehicle inserted successfully');
	}
	
	public function uservehclefetch(Request $request){
		$id=$request->id;
		$usr_vehcl=User_vehicles::find($id);
		//$vehcl=Vehicles::find($id);
		//$usrvehcl=DB::table('user_vehicles')
		//->leftJoin('brand_lists', 'user_vehicles.vehicle_brand', '=', 'brand_lists.id')
		//->leftJoin('vehicle_types', 'user_vehicles.vehicle_type', '=', 'vehicle_types.id')
		//->leftJoin('brand_models', 'user_vehicles.vehicle_model', '=', 'brand_models.id')
		//->leftJoin('fuel_types', 'user_vehicles.fuel_type', '=', 'fuel_types.id')
		//->leftJoin('user_lists', 'user_vehicles.user_id', '=', 'user_lists.id')
		//->where('user_vehicles',$id)
		///->select('user_vehicles.*', 'brand_lists.brand','fuel_types.fuel_type','brand_models.brand_model','vehicle_types.veh_type','user_lists.name')
		//->first();
		//$models=DB::table('brand_models')
		//->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')
		//->leftJoin('fuel_types', 'brand_models.fuel_type', '=', 'fuel_types.id')
		//->where('brand_models',$id)
		//->select('brand_models.*','brand_lists.brand','fuel_types.fuel_type')
		//->first();
		print_r(json_encode($usr_vehcl));
	}
	public function uservehcleedit(Request $request){
		$id=$request->id;
		$usrvehcl=User_vehicles::find($id);
		$usrvehcl->user_id=$request->cust;
		$usrvehcl->vehicle_type=$request->vehtype;
		$usrvehcl->vehicle_model=$request->model;
		$usrvehcl->vehicle_brand=$request->brand_edit;
		$usrvehcl->fuel_type=$request->fuel_edit;
		$usrvehcl->vehicle_number=$request->veh_num;
		$usrvehcl->save();
		return redirect('uservehcle')->with('success','Customers vehicle edited successfully');
	}

	public function uservehcledelete($id){
		DB::delete('delete from user_vehicles where id = ?', [$id]);
		return redirect('uservehcle')->with('success','Customers vehicle deleted successfully');
	}
	
	public function mystorequeries(){
		
		$custmr1=User_lists::all();
		$mystrquris=DB::table('mystorequerys')
		->leftJoin('user_lists', 'mystorequerys.quserid', '=', 'user_lists.id')
		//->leftJoin('vehicle_types', 'brand_lists.vehicle', '=', 'vehicle_types.id')
		//->leftJoin('mystorequerys', 'user_lists.fuel_type', '=', 'fuel_types.id')
		->select('mystorequerys.*','user_lists.name')
		->orderBy('mystorequerys.id', 'DESC')
		->get();
		$role=Auth::user()->user_type;
		return view('mystorequeries',compact('mystrquris','custmr1','role'));
	}
	public function mystorequeriesfeatch(Request $request){
		$id=$request->id;
		$mystrquris=Mystorequerys::find($id);
		//$mystrquris=DB::table('mystorequerys')
		//->leftJoin('user_lists', 'mystorequerys.quserid', '=', 'user_lists.id')
		//->where('mystorequerys',$id)
		//->select('mystorequerys.*','user_lists.name')
		//->first();
		print_r(json_encode($mystrquris));
	}
	public function mystorequerydelete($id){
		DB::delete('delete from mystorequerys where id = ?', [$id]);
		return redirect('mystorequeries')->with('success', 'Data deleted successfully');
	}
	
	public function storequeryanswr(){
	
		$strquransr=DB::table('storequery_answers')
		->leftJoin('user_lists', 'storequery_answers.anuserid', '=', 'user_lists.id')
		->leftJoin('mystorequerys', 'storequery_answers.question_id', '=', 'mystorequerys.id')
		->select('storequery_answers.*','mystorequerys.question','user_lists.name')
		->orderBy('storequery_answers.id', 'DESC')
		->get();
		$mystrquris=Mystorequerys::all();
		$custmr1=User_lists::all();
		$role=Auth::user()->user_type;
		return view('storequery_answers',compact('strquransr','custmr1','mystrquris','role'));
	}
	public function storequeryanswrinsert(Request $request){
	   $qury_answr=new Storequery_answers;
	   $qury_answr->question_id=$request->qustn;
	   $qury_answr->answer=$request->answr;
	   $qury_answr->anuserid=$request->usr;
	   $qury_answr->save();
	   return redirect('storequeryanswr')->with('success', 'Data inserted successfully');
	}
	public function storequeryanswrfeatch(Request $request){
		$id=$request->id;
		$qury_answr=Storequery_answers::find($id);
		//$mystrquris=DB::table('mystorequerys')
		//->leftJoin('user_lists', 'mystorequerys.quserid', '=', 'user_lists.id')
		//->where('mystorequerys',$id)
		//->select('mystorequerys.*','user_lists.name')
		//->first();
		print_r(json_encode($qury_answr));
	}
	public function storequeryanswredit(Request $request){
	   $id=$request->id;
	   $qury_answr=Storequery_answers::find($id);
	   $qury_answr->question_id=$request->qustn;
	   $qury_answr->answer=$request->answr;
	   $qury_answr->anuserid=$request->usr;
	   $qury_answr->save();
	   return redirect('storequeryanswr')->with('success', 'Data edited successfully');
	}
	public function storequeryanswrdelete($id){
		DB::delete('delete from storequery_answers where id = ?', [$id]);
		return redirect('storequeryanswr')->with('success', 'Data deleted successfully');
	}
	
	public function packfeatures(){
		//$feature=Package_features::all();
	
		$ftre=Features::all();
		$feature=DB::table('package_features')
		//->leftJoin('features', 'packages.package_for', '=', 'features.id')
		->leftJoin('packages', 'package_features.package_id', '=', 'packages.id')
		->leftJoin('features', 'package_features.feature', '=', 'features.id')
		->select('package_features.*','features.feature as featuredel','packages.title')
		->get();
		$com1=Packages::all();
		//$custmr1=User_lists::all();
		return view('packfeatures',compact('feature','com1','ftre'));
	}
	public function shopbank(){
		$shobank =DB::table('tbl_shopbankdetails')
		->get();
		$role=Auth::user()->user_type;
		return view('shopbank',compact('shobank','role'));
	}
	public function shopsearch(Request $request){
		$shopname=$request->shopname;
		$shop = DB::table("shops")
					->where('shopname', 'LIKE', "%$shopname%")
					->get();
							 if($shop){
		 	
		$namelist='<table class="table table-bordered table-hover" style="background-color: #a4dcc2;border-radius: 10px;">';
						foreach($shop as $key => $overallstocke){

		$namelist.='<tr class="shop_click"  >
					<input type="hidden" name="id_SCR" id="id_SCR" value="'.$overallstocke->shopname.'" readonly="readonly">
					<input type="hidden" name="fff"  id="fff" value="'.$overallstocke->id.'" readonly="readonly">
				
					<td class="titleName">'.$overallstocke->shopname.'</td>
					
				  </tr>';
						}
		$namelist.='</table>';
					
		}
		return Response($namelist);
		
	}
	public function shopbankinsert(Request $request){
		$shopbank= new Tbl_shopbankdetails;
		$shopbank->shop_id=$request->shopid;
		$shopbank->account_holdername=$request->bankholdername;
		$shopbank->bank=$request->bank;
		$shopbank->branch=$request->branch;
		$shopbank->ifsc=$request->ifsc;
		$shopbank->bankaccount=$request->bankaccount;
		$shopbank->save();
		return redirect('shopbank')->with('success', 'Data inserted successfully.');
	}
	public function editshopbank(Request $request){
		$id=$request->id;
		$shopbank=Tbl_shopbankdetails::find($id);
		$shopbank->shop_id=$request->shopid;
		$shopbank->account_holdername=$request->bankholdername;
		$shopbank->bank=$request->bank;
		$shopbank->branch=$request->branch;
		$shopbank->ifsc=$request->ifsc;
		$shopbank->bankaccount=$request->bankaccount;
		$shopbank->save();
		return redirect('shopbank')->with('success', 'Data edited successfully.');
	}

	public function shopbankdelete($id){
		DB::delete('delete from tbl_shopbankdetails where id = ?', [$id]);
		return redirect('shopbank');
	}
	
	public function packfeaturesinsert(Request $request){
	   $feature=new Package_features;
	   $feature->package_id=$request->packg;
	   $feature->feature=$request->feature;
	   $feature->save();
	   return redirect('common')->with('success', 'Data inserted successfully.');
	}
	public function packageservice(){
		$packserv=Package_service_lists::all();
		$packserv=DB::table('package_service_lists')
		//->leftJoin('features', 'packages.package_for', '=', 'features.id')
		->leftJoin('packages', 'package_service_lists.package_id', '=', 'packages.id')
		->leftJoin('shiop_categories', 'package_service_lists.service_id', '=', 'shiop_categories.id')
		->select('package_service_lists.*','packages.title','shiop_categories.category')
		->get();
		$shop_category=Shiop_categories::all();
		$com1=Packages::all();
		//$custmr1=User_lists::all();
		$role=Auth::user()->user_type;
		return view('package_service_list',compact('packserv','com1','shop_category','role'));
	}
	public function packageserviceinsert(Request $request){
	   $packserv=new Package_service_lists;
	   $packserv->package_id=$request->packgs;
	   $packserv->service_id=$request->shop_cat;
	   $packserv->save();
	   return redirect('packageservice')->with('success', 'Data inserted successfully.');
	}
	public function packageservicefetch(Request $request){
		$id=$request->id;
		$packserv=Package_service_lists::find($id);
		print_r(json_encode($packserv));
	}
	public function packageserviceedit(Request $request){
	   $id=$request->id;
	   $pack_serv=Package_service_lists::find($id);
	   $pack_serv->package_id=$request->packgs;
	   $pack_serv->service_id=$request->shop_cat;
	   $pack_serv->save();
	   return redirect('packageservice')->with('success', 'Data edited successfully.');
	}
	public function packageservicedelete($id){
		DB::delete('delete from package_service_lists where id = ?', [$id]);
		return redirect('packageservice')->with('success', 'Data deleted successfully.');
	}
	
	public function packfeaturesfetch(Request $request){
		$id=$request->id;
		$feature=Package_features::find($id);
		print_r(json_encode($feature));
	}
	public function editpackfeatures(Request $request){
		$id=$request->id;
		$feature=Package_features::find($id);
		$feature->package_id=$request->packg;
	   $feature->feature=$request->feature;
	   $feature->save();
	   return redirect('packfeatures');
	}
	public function packfeaturesdelete($id){
		DB::delete('delete from package_features where id = ?',[$id]);
		return redirect('common');
	}
	public function common(){
		
		$packages=DB::table('packages')
		//->leftJoin('features', 'packages.package_for', '=', 'features.id')
		->leftJoin('brand_models', 'packages.vehmodel', '=', 'brand_models.id')
		->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')
		->leftJoin('vehicle_types', 'brand_lists.vehicle', '=', 'vehicle_types.id')
		->leftJoin('fuel_types', 'packages.fuel', '=', 'fuel_types.id')
		->select('packages.*','vehicle_types.veh_type','brand_models.brand_model','fuel_types.fuel_type')
		->orderBy('packages.id', 'DESC')
		->get();
	
		$fueltype=Fuel_types::all();
		$fueltype1=Fuel_types::all();
		$fueltype2=Fuel_types::all();
		$vehtype=Vehicle_types::all();
		$vehtype1=Vehicle_types::all();
		$vehtype2=Vehicle_types::all();
		$vehmodel=Brand_models::all();
		$ftre=Features::all();
		$role=Auth::user()->user_type;
		return view('packages',compact('ftre','packages','fueltype','vehtype','fueltype1','vehtype1','vehmodel','fueltype2','vehtype2','role'));
	}
	public function packageforvehiclefetch(Request $request){
			$id=$request->id;
			$packageveh=DB::table('packages_forvehmodels')
			->leftJoin('brand_models', 'packages_forvehmodels.model_id', '=', 'brand_models.id')
			->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')
			->leftJoin('vehicle_types', 'brand_lists.vehicle', '=', 'vehicle_types.id')
			->leftJoin('fuel_types', 'packages_forvehmodels.fuel_type', '=', 'fuel_types.id')
			->where('packages_forvehmodels.package_id',$id)
			->select('packages_forvehmodels.*','vehicle_types.veh_type','brand_models.brand_model','fuel_types.fuel_type as fuel')
			->get();
			
			print_r(json_encode($packageveh));
	}
	public function packageveh(){
		$packageveh=DB::table('packages_forvehmodels')
		->leftJoin('packages', 'packages_forvehmodels.package_id', '=', 'packages.id')
		->leftJoin('brand_models', 'packages_forvehmodels.model_id', '=', 'brand_models.id')
		->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')
		->leftJoin('vehicle_types', 'brand_lists.vehicle', '=', 'vehicle_types.id')
		->leftJoin('fuel_types', 'packages_forvehmodels.fuel_type', '=', 'fuel_types.id')
		->get();
		$fueltype=Fuel_types::all();
		$fueltype1=Fuel_types::all();
		$vehtype=Vehicle_types::all();
		$vehtype1=Vehicle_types::all();
		$vehmodel=Brand_models::all();
		return view('packageforvehicle',compact('packageveh','fueltype','fueltype1','vehtype','vehtype1','vehmodel'));
	}
	public function compackageinsert(Request $request){
		$com=new Packages;
		if($files=$request->file('image')){  
			$name=$files->getClientOriginalName();  
			$files->move('img/',$name);  
			
			$com->image=$name; 
			$com->package_type=$request->package_type;
			$com->title=$request->title;
			$com->description=$request->desc;
			$com->fuel=$request->fueltype;
			$com->amount=$request->amount;
			$com->offer_amount=$request->offeramount;
			$com->shop_amount=$request->shopamount;
			$com->vehmodel=$request->vehmodel;
			$com->status=$request->status;
			if($com->save()){
				$package_id=$com->id;
				$package = new Packages_forvehmodels;
				$package->package_id=$package_id;
				$package->model_id=$request->vehmodel;
				$package->fuel_type=$request->fueltype;
				$package->save();
				return redirect('common')->with('success', 'Data inserted successfully.');
			}
			
		
		}  
		
		
	}
	public function packagefetch(Request $request){
		$id=$request->id;
		$package=Packages::find($id);
		print_r(json_encode($package));
	}

	public function editcompackage(Request $request){
		$id=$request->id;
		$pack=Packages::find($id);
		if($files=$request->file('image')){  
			$name=$files->getClientOriginalName();  
			$files->move('img/',$name);  
			
			$pack->image=$name; 
			$pack->package_type=$request->package_type;
			$pack->title=$request->title;
			$pack->description=$request->desc;
			$pack->fuel=$request->fueltype;
			$pack->amount=$request->amount;
			$pack->offer_amount=$request->offeramount;
			$pack->shop_amount=$request->shopamount;
			$pack->vehtype=$request->vehtype;
			$pack->vehmodel=$request->vehmodel;
			$pack->status=$request->status;
			$pack->save();
			return redirect('common')->with('success', 'Data edited successfully.');
		
		}  else{
			
			$pack->package_type=$request->package_type;
			$pack->title=$request->title;
			$pack->description=$request->desc;
			$pack->fuel=$request->fueltype;
			$pack->amount=$request->amount;
			$pack->offer_amount=$request->offeramount;
			$pack->shop_amount=$request->shopamount;
			$pack->vehtype=$request->vehtype;
			$pack->vehmodel=$request->vehmodel;
			$pack->status=$request->status;
			$pack->save();
			return redirect('common')->with('success', 'Data edited successfully.');
		}
		
	}
	
	public function packagedelete($id){
		DB::delete('delete from packages where id = ?', [$id]);
		return redirect('common')->with('success', 'Data deleted successfully.');
	}


	public function packagedeleteforveh($id){
		DB::delete('delete from packages_forvehmodels where id = ?',[$id]);
		return redirect('common');
	}
	public function packagefeaturefetch(Request $request){
		$id=$request->id;
		$feature=DB::table('package_features')
		//->leftJoin('features', 'packages.package_for', '=', 'features.id')
		->leftJoin('packages', 'package_features.package_id', '=', 'packages.id')
		->leftJoin('features', 'package_features.feature', '=', 'features.id')
		->where('package_features.package_id',$id)
		->select('package_features.*','features.feature as featuredel','packages.title')
		->get();
		print_r(json_encode($feature));
	}
	public function packagedet(){
		$packagedet=DB::table('packages_dets')
		//->leftJoin('features', 'packages.package_for', '=', 'features.id')
		->leftJoin('packages', 'packages_dets.pkg_id', '=', 'packages.id')
		->select('packages_dets.*','packages.title')
		->get();
		$com=Packages::all();
		$role=Auth::user()->user_type;
		return view('package_details',compact('packagedet','com','role'));
	}
	
	public function packagedetinsert(Request $request){
		    $packagedet=new Packages_dets;
		
			$packagedet->pkg_id=$request->packag;
			$packagedet->pkg_det_details=$request->desc;
			$packagedet->save();
			return redirect('packagedet')->with('success', 'Data inserted successfully.');
		  
		
		
	}
	
	public function packagedetfetch(Request $request){
		$id=$request->id;
		$packagedet=Packages_dets::find($id);
		print_r(json_encode($packagedet));
	}
	public function packagedetedit(Request $request){
		    $id=$request->id;
		    $package_det=Packages_dets::find($id);
			$package_det->pkg_id=$request->packag;
			$package_det->pkg_det_details=$request->desc;
			$package_det->save();
			return redirect('packagedet')->with('success', 'Data edited successfully.');
		  
		
		
	}

	public function packagedetdelete($id){
		DB::delete('delete from packages_dets where id = ?', [$id]);
		return redirect('packagedet')->with('success', 'Data deleted successfully.');
	}
	
	
	public function packageshop(){
		$packageshop=DB::table('packages_shops')
		//->leftJoin('features', 'packages.package_for', '=', 'features.id')
		->leftJoin('shops', 'packages_shops.pkg_shp_id', '=', 'shops.id')
		->leftJoin('packages', 'packages_shops.pkg_id', '=', 'packages.id')
		->select('packages_shops.*','packages.title','shops.shopname')
		->get();
		$com1=Packages::all();
		$shop1=Shops::all();
		$role=Auth::user()->user_type;
		return view('package_shops',compact('packageshop','com1','shop1','role'));
	}
	
	public function packageshopinsert(Request $request){
		    $packageshop=new Packages_shops;
		
			$packageshop->pkg_shp_id=$request->shops;
			$packageshop->pkg_id=$request->packgs;
			$packageshop->save();
			return redirect('packageshop')->with('success', 'Data inserted successfully.');
		
	}
	
	public function packageshopfetch(Request $request){
		$id=$request->id;
		$package_shop=Packages_shops::find($id);
		print_r(json_encode($package_shop));
	}
	public function packageshopedit(Request $request){
		    $id=$request->id;
		    $package_shop=Packages_shops::find($id);
			$package_shop->pkg_shp_id=$request->shops;
			$package_shop->pkg_id=$request->packgs;
			$package_shop->save();
			return redirect('packageshop')->with('success', 'Data edited successfully.');
		
	}
	public function packageshopdelete($id){
		DB::delete('delete from packages_shops where id = ?', [$id]);
		return redirect('packageshop')->with('success', 'Data deleted successfully.');
	}
	
	public function packagebook(){
		$packagebook=Package_books::all();
		$packagebook=DB::table('package_books')
		//->leftJoin('features', 'packages.package_for', '=', 'features.id')
		->leftJoin('shops', 'package_books.shop_id', '=', 'shops.id')
		->leftJoin('packages', 'package_books.package_id', '=', 'packages.id')
		->leftJoin('user_lists', 'package_books.customer_id', '=', 'user_lists.id')
		->select('package_books.*','packages.title','shops.shopname','user_lists.name')
		->get();
		$com1=Packages::all();
		$shop1=Shops::all();
		$custmr1=User_lists::all();
		$role=Auth::user()->user_type;
		return view('package_book',compact('packagebook','com1','shop1','custmr1','role'));
		
	}
	public function packagebookfetch(Request $request){
		$id=$request->id;
		$pack_book=Package_books::find($id);
		print_r(json_encode($pack_book));
	}
	public function packagebookdelete($id){
		DB::delete('delete from package_books where id = ?',[$id]);
		return redirect('packagebook');
	}
	public function exclusive(){
		$packages=DB::table('packages')
		->leftJoin('features', 'packages.package_for', '=', 'features.id')
		->leftJoin('vehicle_types', 'packages.vehtype', '=', 'vehicle_types.id')
		->leftJoin('brand_models', 'packages.vehmodel', '=', 'brand_models.id')
		->leftJoin('fuel_types', 'packages.fuel', '=', 'fuel_types.id')
		->where('package_type',2)
		->select('packages.*','vehicle_types.veh_type','brand_models.brand_model','fuel_types.fuel_type')
		->get();
		$fueltype=Fuel_types::all();
		$fueltype1=Fuel_types::all();
		$vehtype=Vehicle_types::all();
		$vehtype1=Vehicle_types::all();
		$vehmodel=Brand_models::all();
		$vehmodel1=Brand_models::all();
		return view('exclusive',compact('packages','fueltype','vehtype','fueltype1','vehtype1','vehmodel','vehmodel1'));
	}
	public function exclusiveinsert(Request $request){
		$com=new Packages;
		if($files=$request->file('image')){  
			$name=$files->getClientOriginalName();  
			$files->move('img/',$name);  
			
			$com->image=$name; 
			$com->package_type=$request->package_type;
			$com->title=$request->title;
			$com->description=$request->desc;
			$com->fuel=$request->fueltype;
			$com->amount=$request->amount;
			$com->offer_amount=$request->offeramount;
			$com->shop_amount=$request->shopamount;
			$com->vehmodel=$request->model;
			$com->save();
			return redirect('exclusive');
		
		}  
	}
 public function editexclusive(Request $request){
	$id=$request->id;
	$com=Packages::find($id) ;
	if($files=$request->file('image')){  
		$name=$files->getClientOriginalName();  
		$files->move('img/',$name);  
		
		$com->image=$name; 
			$com->title=$request->title;
		$com->description=$request->desc;
		$com->fuel=$request->fueltype;
		$com->amount=$request->amount;
		$com->offer_amount=$request->offeramount;
		$com->shop_amount=$request->shopamount;
		$com->vehmodel=$request->model;
		$com->save();
		return redirect('exclusive');
	
	}  else{
		
		$com->title=$request->title;
		$com->description=$request->desc;
		$com->fuel=$request->fueltype;
		$com->amount=$request->amount;
		$com->offer_amount=$request->offeramount;
		$com->shop_amount=$request->shopamount;
		$com->vehmodel=$request->model;
		$com->save();
		return redirect('exclusive');
	}
	
 }
 public function queiry(){
	 $queiry=Mystorequerys::all();
	 $queiry=DB::table('mystorequerys')
	 ->leftJoin('store_product_categories', 'mystorequerys.quserid', '=', 'store_product_categories.id')
	 ->get();
	 $scategory=Store_product_categories::all();
	 return view('queiry',compact('queiry','scategory'));
 }
 public function queryfetch(Request $request){
	$id=$request->id;
	$query=Mystorequerys::find($id);
	print_r(json_encode($query));
 }
 public function editquery(Request $request){
	 $id=$request->id;
	 $query=Mystorequerys::find($id);
	 $query->question=$request->queryname;
	 $query->quserid=$request->category;
	 $query->save();
	 return redirect('queiry');
 }
 public function wallets(){
	    $wallets=Wallets::all();
		$wallets=DB::table('wallets')
		//->leftJoin('features', 'packages.package_for', '=', 'features.id')
		->leftJoin('user_lists', 'wallets.user_id', '=', 'user_lists.id')
		->select('wallets.*','user_lists.name')
		->get();
		$custmr1=User_lists::all();
		return view('wallets',compact('wallets','custmr1'));
	}
	
public function walletsfetch(Request $request){
	$id=$request->id;
	$wall=Wallets::find($id);
	print_r(json_encode($wall));
 }
	
public function walletcredithis(){
	    $wallcrdthis=Wallet_credit_his::all();
		$wallcrdthis=DB::table('wallet_credit_his')
		//->leftJoin('features', 'packages.package_for', '=', 'features.id')
		->leftJoin('user_lists', 'wallet_credit_his.credited_by', '=', 'user_lists.id')
		->select('wallet_credit_his.*','user_lists.name')
		->get();
		$custmr1=User_lists::all();
		return view('wallets_credit_his',compact('wallcrdthis','custmr1'));
	}
	
public function walletcredithisfetch(Request $request){
	$id=$request->id;
	$wallcrdthis=Wallet_credit_his::find($id);
	print_r(json_encode($wallcrdthis));
 }
public function walletdebtthis(){
	    $walldbtthis=Wallet_debit_his::all();
		$walldbtthis=DB::table('wallet_debit_his')
		//->leftJoin('features', 'packages.package_for', '=', 'features.id')
		->leftJoin('user_lists', 'wallet_debit_his.user_id', '=', 'user_lists.id')
		->select('wallet_debit_his.*','user_lists.name')
		->get();
		$custmr1=User_lists::all();
		return view('wallets_debit_his',compact('walldbtthis','custmr1'));
	}
	public function walletdebtthisfetch(Request $request){
	$id=$request->id;
	$walldbtthis=Wallet_debit_his::find($id);
	print_r(json_encode($walldbtthis));
 }
	public function suggession_complaints(){
		$sugg=Tbl_sugg_complaints::all();
		$sugg = DB::table('tbl_sugg_complaints')
			->leftJoin('shops', 'tbl_sugg_complaints.shopid', '=', 'shops.id')
			->select('tbl_sugg_complaints.*','shops.shopname')
			->get();
		$shops=Shops::all();
		$role=Auth::user()->user_type;
		return view('suggession_complaints',compact('sugg','shops','role'));
	}
	public function suggcomplntfetch(Request $request){
	     $id=$request->id;
	     $sugg=Tbl_sugg_complaints::find($id);
	     print_r(json_encode($sugg));
    }
	public function suggcomplntdelete($id){
		DB::delete('delete from tbl_sugg_complaints where id = ?', [$id]);
		return redirect('suggcomplnt')->with('success', 'Data deleted successfully.');
	}
	
	public function termcondition(){
		$terms=Tbl_terms_conditions::all();
		$role=Auth::user()->user_type;
		return view('terms_conditions',compact('terms','role'));
	}
	public function feature(){
		$feature=DB::table('features')->orderBy('id', 'DESC')->get();
		$role=Auth::user()->user_type;
		return view('feature',compact('feature','role'));
	}
	public function featureinsert(Request $request){
		$feature=new Features;
		$feature->feature=$request->feature;
		$feature->save();
		return redirect('feature')->with('success', 'Feature inserted successfully.');
	}
	public function featurefetch(Request $request){
		$id=$request->id;
		$feature=Features::find($id);
		print_r(json_encode($feature));
	}
	public function editfeature(Request $request){
		$id=$request->id;
		$feature=Features::find($id);
		$feature->feature=$request->feature;
		$feature->save();
		return redirect('feature')->with('success', 'Feature edited successfully.');
	}
	public function featuredelete($id){
		DB::delete('delete from features where id = ?', [$id]);
		return redirect('feature')->with('success', 'Feature Deleted successfully.');
	}
	
	public function termconditioninsert(Request $request){
		$terms=new Tbl_terms_conditions;
		$terms->tc_details=$request->tc;
		$terms->save();
		return redirect('termcondition')->with('success', 'Data inserted successfully.');
	}
	public function termconditionfetch(Request $request){
		$id=$request->id;
		$terms=Tbl_terms_conditions::find($id);
		print_r(json_encode($terms));
    }
	public function edittermcondition(Request $request){
		$id=$request->id;
		$terms=Tbl_terms_conditions::find($id);
		$terms->tc_details=$request->tc;
		$terms->save();
		return redirect('termcondition')->with('success', 'Data edited successfully.');
	}
	public function termconditiondelete($id){
		DB::delete('delete from tbl_terms_conditions where id = ?', [$id]);
		return redirect('termcondition')->with('success', 'Data Deleted successfully.');
	}
	
 
	public function customertype()
	{
		 $customertype=Tbl_customertype::all();
		 $customertype=Tbl_customertype::all();
		 $role=Auth::user()->user_type;
		  return view('customertype',compact('customertype','role'));
	 }
	 public function customertypeinsert(Request $request)
	 {  
		$customertype= new Tbl_customertype;
		$customertype->customer_type=$request->customer_type;
	   
		$customertype->save();
		return redirect('customertype');
	 }
	 public function customertypefetch(Request $request){
		 $id=$request->id;
		 $customertype = Tbl_customertype::find($id);
		 print_r(json_encode($customertype));
		 //echo $id;
	 }
	 public function customertypeedit(Request $request){
		 $id=$request->id;
		 $customertype = Tbl_customertype::find($id);
		 $customertype->customer_type=$request->customer_type;
		
		 $customertype->save();
		 return redirect('customertype');
	 
	  }

	  
public function notification(){

	$customertype = Tbl_customertype::all(); 
	$notification=DB::table('tbl_notification_historys')
			->leftJoin('tbl_customertypes', 'tbl_notification_historys.user_type', '=', 'tbl_customertypes.id')
			//->select('tbl_notification_historys.*','tbl_customertypes.customer_type')
			->orderBy('tbl_notification_historys.id', 'DESC')
		   ->get();
	$role=DB::table('role')->get();
	
	return view('notification',compact('customertype','notification','role'));
	
	}
	public function sendfirbasemessage(Request $request){
        $title=$request->titile;
		$message=$request->message;
		$custype=$request->custype;
		if($custype==2){

			$friendToken = [];
	$friendToken=DB::table('user_lists')
	->where('device_token','!=','null')
	->select('user_lists.device_token')
	->limit(25)
	->get()
	->toArray();

	//echo "<pre>";print_r($friendToken);exit;

	$msg = array
    (
         "body" => $message,
         "title" => $title,
         "sound" => "mySound"
    );
  
	
  
    $url = 'https://fcm.googleapis.com/fcm/send';
    foreach ($friendToken as $tok) {
        $fields = array(
            'to' => $tok->device_token,
			'notification' => $msg
			
		);
		
		
        $headers = array(
            'Authorization: key=AAAALcAJIGo:APA91bE19OVa4q934aQNj7NR-o653sdLzUDj-7HAuCLLxOPREHU3Yv75VcVnbI58gKgkUewBvwu4uyTxN0KcklAlweB1VPv0HDjuwMViM9cDOa4OEgVwYM7mp2vxdRhig8jTcngdwox2',
            'Content-type: Application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_exec($ch);
        curl_close($ch);
    }
	


	$res = ['error' => null, 'result' => "sucess"];
	
	

    return $res;

		}
	}
	public function mobilenotificationshop($message,$cutype,$title){
		//echo $cutype;exit;
		
	
		$msg = array
    (
         "body" => $message,
         "title" => $title,
         "sound" => "mySound"
    );
		
		$friendToken = [];
		

		$friendToken=DB::table('shops')
		->select('shops.shop_device_tocken as device_token')
		->get()
		->toArray();

		
	  
		$url = 'https://fcm.googleapis.com/fcm/send';
		foreach ($friendToken as $tok) {
			$fields = array(
				'to' => $tok->device_token,
				'notification' => $msg
				
			);
			$headers = array(
				'Authorization: key=AAAAQ-4QAC8:APA91bENTH28X2WnimIFfN6EBqBdzKgG0tXBDKG4eF-2Xrzh6Lilghz_bwSEVLUhMq1E3KPCI96y4rCuxWkmgi5YXrlC00oA-kb4dhvdjp-JfwU37O0qZG6pB5gl14JB83cA-g6Xx-ff',
				'Content-type: Application/json'
			);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
			curl_exec($ch);
			curl_close($ch);
		}
		
	
		$res = ['error' => null, 'result' => "sucess"];
	
		return $res;
}

	public function mobilenotificationcustomer($message,$cutype){
		//echo $message;exit;
		
		$data=DB::table('user_lists')
		->select('user_lists.device_token')
		->get()
		->toArray();
		

		foreach($data as $field){
		
		$ff[]=$field->device_token;	
		//print_r($ff); 					
		}
		if(empty($ff)){
	
			echo "is empty";
		}
		else{  
		
		

define( 'API_ACCESS_KEY', 'AAAALcAJIGo:APA91bE19OVa4q934aQNj7NR-o653sdLzUDj-7HAuCLLxOPREHU3Yv75VcVnbI58gKgkUewBvwu4uyTxN0KcklAlweB1VPv0HDjuwMViM9cDOa4OEgVwYM7mp2vxdRhig8jTcngdwox2' );

	
	$fields = array
	(

'registration_ids' => $ff,
'Roadmate Info'=>$message
	);


	$headers = array
	(
	'Authorization: key='.API_ACCESS_KEY,
	'Content-Type: application/json'
	);
	
	//print_r($headers);
		
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );

	//print_r($result);
}

}

public function mobilenotificationexecutive($message,$cutype,$title){
	//echo $cutype;exit;
	
	$msg = array
    (
         "body" => $message,
         "title" => $title,
         "sound" => "mySound"
    );

			$friendToken = [];
			
			$friendToken=DB::table('executives')
			->select('executives.device_tocken')
			->get()
			->toArray();
		  
			// foreach ($data1->fcmnotify as $username) {
			//     $friendToken[] = DB::table('user_lists')->where('id', $username->usernames)
			//         ->get()->pluck('device_token')[0];
			//         $dialog_id=$username->dialog_id;
			// }
		  
			$url = 'https://fcm.googleapis.com/fcm/send';
			foreach ($friendToken as $tok) {
				$fields = array(
					'to' => $tok->device_token,
					'notification' => $msg
					
				);
				$headers = array(
					'Authorization: key=AAAA-gH39pE:APA91bHe3LxmwGCkV766hf8c2gaoROfLWsFUrRUn1tTKK2d5sDNolY0JxoclZVyxVT_1hv8fMiQ9bX08QROBIFQYbDsngjvnFZmENPOLaEJf-UYweDSrtmA9irUIUMohdcMEFCguZ4yZ',
					'Content-type: Application/json'
				);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
				curl_exec($ch);
				curl_close($ch);
			}
		
			$res = ['error' => null, 'result' => "sucess"];
		
			return $res;
}
function sendNotification1($msg1,$title)
{
	//echo $msg1;exit;
    $friendToken = [];
	$friendToken=DB::table('user_lists')
	->where('device_token','!=','null')  
	->select('user_lists.device_token')
	->limit(5)
	->get()
	->toArray();

	//echo "<pre>";print_r($friendToken);exit;

	$msg = array
    (
         "body" => $msg1,
         "title" => $title,
         "sound" => "mySound"
    );
  
	
  
    $url = 'https://fcm.googleapis.com/fcm/send';
    foreach ($friendToken as $tok) {
        $fields = array(
            'to' => $tok->device_token,
			'notification' => $msg
			
		);
		
		
        $headers = array(
            'Authorization: key=AAAALcAJIGo:APA91bE19OVa4q934aQNj7NR-o653sdLzUDj-7HAuCLLxOPREHU3Yv75VcVnbI58gKgkUewBvwu4uyTxN0KcklAlweB1VPv0HDjuwMViM9cDOa4OEgVwYM7mp2vxdRhig8jTcngdwox2',
            'Content-type: Application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_exec($ch);
        curl_close($ch);
    }
	


	$res = ['error' => null, 'result' => "sucess"];
	
	

    return $res;
}
		public function notificationinsert(Request $request){
			$notification=new Tbl_notification_historys;
			$notification->notificationtable_typeid=1;
			$notification->notification_title=$request->title;
			$notification->user_type=$request->customertype_id;
			$notification->notification_message=$request->message;
			$notification->notificationtablerow_id=0;
			$notification->allorindividual=1;
			$notification->user_id=0;
			$notification->save();
			$cutype=$request->customertype_id;
			$message=$request->message;
			$title=$request->title;
			if($cutype==1){
				$this->mobilenotificationshop($message,$cutype,$title);
			}else if($cutype==2){
				return redirect('notification');
				//$this->sendNotification1($message,$title);
			}else{
				$this->mobilenotificationexecutive($message,$cutype,$title);
			}
			
			return redirect('notification');
		}
		public function searchcustomer(Request $request)
		{
			$search= $request->customer_search;
			if($search!='')
			{ 
				$customers=User_lists::where ( 'name', 'LIKE', '%' . $search . '%' )->orWhere ( 'phnum', 'LIKE', '%' . $search . '%' )->paginate (10);
				return view('customers_table',compact('customers'));
			}
			
		}
		public function giveawaybooking(){
			$booking=DB::table('booktimemasters')
			->leftJoin('user_lists', 'booktimemasters.customer_id', '=', 'user_lists.id')
			->leftJoin('shops', 'booktimemasters.shop_id', '=', 'shops.id')
			->leftJoin('tbl_giveaways', 'booktimemasters.book_id', '=', 'tbl_giveaways.id')
			->leftJoin('brand_models', 'booktimemasters.model_id', '=', 'brand_models.id')
			->where('booktimemasters.book_type',4)
			->select('booktimemasters.*','user_lists.name','user_lists.phnum','shops.shopname','shops.phone_number','tbl_giveaways.title','tbl_giveaways.price','brand_models.brand_model')
			->orderBy('booktimemasters.id', 'DESC')
			->get();
			return view('giveawaybooking',compact('booking'));
		}
		
		public function converttoaddedshops($id){
			Shops::where('id', $id)
          ->update([
           'authorised_status' => 1
		]);
		return redirect('executive');
		}

		public function shopseachnew(Request $request){
			$shopname =$request->shopname;
  

  
			if(!empty($shopname)){
		   
			$itemList = DB::table('shops')
			->where('shopname', 'like', '%' . $shopname . '%')
			->limit(5)
			->get();
			if($itemList){
			$namelist='
			<table class="table table-bordered table-hover" style="background-color: #a4dcc2;border-radius: 10px;">
			   ';
			   foreach($itemList as $new1){
			   $namelist.='
			   <tr class="subSelect_itemedit" data-value="'.$new1->id.'" >
				  <input type="hidden" name="id_SCR" id="id_SCR'.$new1->id.'" value="'.$new1->shopname.'" readonly="readonly">
				  <input type="hidden" name="fff" id="fff'.$new1->id.'" value="'.$new1->id.'" readonly="readonly">
				  <td class="titleName">'.$new1->shopname.'('.$new1->phone_number.')</td>
			   </tr>
			   ';
			   }
			   $namelist.='
			</table>
			';
			//echo $namelist;
			print_r(json_encode($namelist));
			}
			}
		}
		public function deletegiveawayshops($id){
			DB::table('tbl_giveawayshops')->where('id', $id)->delete();
			return redirect('giveshops');
		}
		public function search_booking_timeslots(Request $request)
		{
			$searchval=$request->searchval;
			if($searchval!='')
			{
				$timelsotList =DB::table('booktimemasters')
				->leftJoin('user_lists', 'booktimemasters.customer_id', '=', 'user_lists.id')
				->leftJoin('shiop_categories', 'booktimemasters.shop_category_id', '=', 'shiop_categories.id')
				->leftJoin('tbl_shop_offers', 'booktimemasters.book_id', '=', 'tbl_shop_offers.id')
				->leftJoin('shops', 'booktimemasters.shop_id', '=', 'shops.id')
				->select('booktimemasters.*','tbl_shop_offers.title as offertitle','user_lists.name', 'user_lists.phnum','shiop_categories.category','shops.shopname','shops.phone_number')
				->where('user_lists.name', 'like', '%' . $searchval . '%')
				->orWhere('shops.phone_number', 'like', '%' . $searchval . '%')
				->orderBy('booktimemasters.id', 'desc')
				->get();
			}
			else{
				$timelsotList =DB::table('booktimemasters')
				->leftJoin('user_lists', 'booktimemasters.customer_id', '=', 'user_lists.id')
				->leftJoin('shiop_categories', 'booktimemasters.shop_category_id', '=', 'shiop_categories.id')
				->leftJoin('tbl_shop_offers', 'booktimemasters.book_id', '=', 'tbl_shop_offers.id')
				->leftJoin('shops', 'booktimemasters.shop_id', '=', 'shops.id')
				->select('booktimemasters.*','tbl_shop_offers.title as offertitle','user_lists.name', 'user_lists.phnum','shiop_categories.category','shops.shopname','shops.phone_number')
				->orderBy('booktimemasters.id', 'desc')
				->get();

			}
				$role=Auth::user()->user_type;
				$namtimelsotList='';

				if(count($timelsotList) > 0)
				{
					
					$i=1;
					foreach($timelsotList as $key){
						$namtimelsotList.='<tr><td>'.$i.'</td>';
						$namtimelsotList.='<td>'.$key->name.'</td>';
						$namtimelsotList.='<td>';
						if($key->book_type==1) 
						{
							$namtimelsotList.='Eworkshop';
						}
						else if($key->book_type==2)
						{
							$namtimelsotList.='Offer'.($key->offertitle);

						}
						else{
							$namtimelsotList.='Normal Service';
							
						}
						$namtimelsotList.='</td>';
						$namtimelsotList.='<td>'.$key->phnum.'</td>';	
						$namtimelsotList.='<td>'.$key->category.'</td>';	
						$namtimelsotList.='<td>'.$key->shopname.'</td>';	
						$namtimelsotList.='<td>'.$key->phone_number.'</td>';
						$namtimelsotList.='<td>'.$key->adate.'</td>';
						$namtimelsotList.='<td>'.$key->timeslots.'</td>';
						$namtimelsotList.='<td>'.$key->totalamt_shop.'</td>';
						$namtimelsotList.='<td>'.$key->offeramt_shop.'</td>';

							if($role==1)
							{
								$namtimelsotList.='<td><i class="fa fa-edit edit_timeslot"  aria-hidden="true" data-toggle="modal" data-id="'.$key->id.'"></i><i class="fa fa-eye view_timeslot"  aria-hidden="true" data-toggle="modal" data-id="'.$key->id.'"></i>
								<a href="'.url('timeslotdelete').'/'.$key->id.'"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="'.$key->id.'"></i></a>';
							if($key->work_status==0) 
								{
									$namtimelsotList.='<button type="button" data-id="'.$key->id.'" data-toggle="modal"  class="btn tbn-sm btn-success pending-modal">Status</button>';
								}
								$namtimelsotList.='</td>';
							}
					
							$namtimelsotList.='</tr>';
							$i++;
						}

				}
				else{

					$namtimelsotList.='No Results Found';
				}
				
				
					
				print_r(json_encode($namtimelsotList));
			
			
			


		}
		public function search_shop(Request $request)
		{
			$searchval=$request->searchval;
			$namshopList='';
			if($searchval !='')
			{
				$shops = DB::table('shops')
				->leftJoin('shiop_categories', 'shops.type', '=', 'shiop_categories.id')
				->leftJoin('executives', 'shops.exeid', '=', 'executives.id')
				->select('shops.*', 'shiop_categories.category','executives.name')
				->where('shops.shopname', 'like', '%' . $searchval . '%')
				->orWhere('shiop_categories.category', 'like', '%' . $searchval . '%')
				->orWhere('shops.phone_number', 'like', '%' . $searchval . '%')
				->orderBy('shops.id','DESC')
				->get();
			}
			else{
				$shops = DB::table('shops')
				->leftJoin('shiop_categories', 'shops.type', '=', 'shiop_categories.id')
				->leftJoin('executives', 'shops.exeid', '=', 'executives.id')
				->select('shops.*', 'shiop_categories.category','executives.name')
				->orderBy('shops.id','DESC')
				->get();


			}
				
				$role=Auth::user()->user_type;
				$i=1;
				if(count($shops) > 0)
				{
					
					foreach($shops as $key){
						$namshopList.='<tr><td>'.$i.'</td>';
						$namshopList.='<td><img src="'.asset('/img/'.$key->image).'" alt="" width="50"/></td>';
						$namshopList.='<td>'.$key->category.'</td>';
						$namshopList.='<td>'.$key->shopname.'</td>';
						$namshopList.='<td>'.$key->address.'</td>';	
						$namshopList.='<td>'.$key->phone_number.'</td>';	
						$namshopList.='<td>'.$key->pincode.'</td>';
						$namshopList.='<td>';	
						if($key->authorised_status==0)
						{
							$namshopList.='<button type="button" class="btn btn-info btn-sm">Visted Shop</button>';
						}
						elseif($key->authorised_status==1)
						{
							$namshopList.='<button type="button" class="btn btn-success btn-sm">Autherised Shop</button>';
						}
						$namshopList.='<td>
						<i class="fa fa-edit edit_shop "  aria-hidden="true" data-toggle="modal" data-id="'.$key->id.'"></i>
						<i class="fa fa-eye view_shop "  aria-hidden="true" data-toggle="modal" data-id="'.$key->id.'"></i>
						<a href="'.url('shopdelete').'/'.$key->id.'"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="'.$key->id.'"></i></a>
			 			 </td>';
						$namshopList.='</tr>';

							$i++;
						}
					}
					else{

						$namshopList.='No Results Found';
					}
					
					print_r(json_encode($namshopList));

		
			
			

		}
		public function search_shop_service(Request $request)
		{
			$searchval=$request->searchval;
			$namshopsericeList='';
			if($searchval !='')
			{
				$shopserv = DB::table('shop_services')
				->leftJoin('shops', 'shop_services.shop_id', '=', 'shops.id')
				->leftJoin('vehicle_types', 'shop_services.vehicle_type_id', '=', 'vehicle_types.id')
				->leftJoin('brand_lists', 'shop_services.vehicle_brand_id', '=', 'brand_lists.id')
				->leftJoin('brand_models', 'shop_services.vehicle_model_id', '=', 'brand_models.id')
				->leftJoin('shiop_categories', 'shop_services.shop_category', '=', 'shiop_categories.id')
				->select('shop_services.*', 'shops.shopname','vehicle_types.veh_type','brand_lists.brand','brand_models.brand_model','shiop_categories.category')
				->where('shiop_categories.category', 'like', '%' . $searchval . '%')
				->orWhere('shops.shopname', 'like', '%' . $searchval . '%')
				->orWhere('vehicle_types.veh_type', 'like', '%' . $searchval . '%')
				->orWhere('brand_lists.brand', 'like', '%' . $searchval . '%')
				->orWhere('brand_models.brand_model', 'like', '%' . $searchval . '%')
				->orderBy('id','desc')->get();
			}
			else{
				$shopserv = DB::table('shop_services')
				->leftJoin('shops', 'shop_services.shop_id', '=', 'shops.id')
				->leftJoin('vehicle_types', 'shop_services.vehicle_type_id', '=', 'vehicle_types.id')
				->leftJoin('brand_lists', 'shop_services.vehicle_brand_id', '=', 'brand_lists.id')
				->leftJoin('brand_models', 'shop_services.vehicle_model_id', '=', 'brand_models.id')
				->leftJoin('shiop_categories', 'shop_services.shop_category', '=', 'shiop_categories.id')
				->select('shop_services.*', 'shops.shopname','vehicle_types.veh_type','brand_lists.brand','brand_models.brand_model','shiop_categories.category')
				->orderBy('id','desc')->get();


			}
				$role=Auth::user()->user_type;
				$i=1;
				if(count($shopserv) > 0)
				{
					
					foreach($shopserv as $key){
						$namshopsericeList.='<tr><td>'.$i.'</td>';
						$namshopsericeList.='<td>'.$key->category.'</td>';
						$namshopsericeList.='<td>'.$key->shopname.'</td>';
						$namshopsericeList.='<td>'.$key->veh_type.'</td>';	
						$namshopsericeList.='<td>'.$key->brand.'</td>';	
						$namshopsericeList.='<td>'.$key->brand_model.'</td>';
						$namshopsericeList.='<td>';	
						if($role==1)
						{
							$namshopsericeList.='<i class="fa fa-edit editshopserv"  aria-hidden="true" data-toggle="modal" data-id="'.$key->id.'"></i>';
							$namshopsericeList.='<i class="fa fa-eye viewshopserv"  aria-hidden="true" data-toggle="modal" data-id="'.$key->id.'"></i>';
							$namshopsericeList.='<a href="'.url('shopservicesdelete').'/'.$key->id.'"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="'.$key->id.'"></i></a>';

						}
						
						
						  $namshopsericeList.='</tr>';

							$i++;
						}
					}
					else{

						$namshopsericeList.='No Results Found';
					}
					

					
					print_r(json_encode(array("namshopsericeList"=>$namshopsericeList)));

		}
		public function payment_support(Request $request)
		{
			$checkpayment=DB::table('tbl_support_payments')->where('status',0)->first();
			return Response::json($checkpayment);
	
		}
		public function account_delete_requests()
		{
			$role=Auth::user()->user_type;
			$accdelete_requests=DB::table('user_lists')->where('status',0)->get();
			//echo "<pre>";print_r($accdelete_requests);exit;
			return view('account_delete_requests',compact('accdelete_requests','role'));
		}
		public function country(){
			$role=Auth::user()->user_type;
			$empl=DB::table('tbl_countrys')->get();

			return view('country',compact('role','empl'));
		}
		public function countryinsert(Request $request){
			$country = new Tbl_countrys;
			$country->country_name = $request->country_name;
			$country->deleted_status = 0;
			$country->added_id=Auth::user()->id;
			$country->save();
			return redirect('country');
		}
		public function countryfetch(Request $request){
			$id=$request->id;
			$country=Tbl_countrys::find($id);
			print_r(json_encode($country));
		}
		public function countryedit(Request $request){
			$id=$request->id;
			$country=Tbl_countrys::find($id);
			$country->country_name=$request->country_name;
			$country->deleted_status=$request->status;

			$country->save();
			return redirect('country');
		}
		public function state(){
			$role=Auth::user()->user_type;
			$con=DB::table('tbl_countrys')
			->where('deleted_status',0)
			->get();
            $cond=DB::table('tbl_states')
			->leftJoin('tbl_countrys', 'tbl_states.country_id', '=', 'tbl_countrys.id')
			->select('tbl_states.*','tbl_countrys.country_name')
			->get();

			return view('state',compact('role','con','cond'));
		}
		public function stateinsert(Request $request){
			$state = new Tbl_states;
			$state->country_id = $request->country;
			$state->state_name = $request->state_name;
			$state->deleted_status = 0;
			$state->added_id=Auth::user()->id;
			$state->save();
		    return redirect('state');
		}
		public function statefetch(Request $request){
			$id=$request->id;
			$state=Tbl_states::find($id);
			print_r(json_encode($state));
		}
		public function stateedit(Request $request){
			$id=$request->id;
			$state=Tbl_states::find($id);
			$state->country_id=$request->country;

			$state->state_name=$request->state_name;
			$state->deleted_status=$request->status;

			$state->save();
			return redirect('state');
		}
		public function district(){
			$role=Auth::user()->user_type;
			$con=DB::table('tbl_countrys')
			->where('deleted_status',0)
			->get();
			$cond=DB::table('tbl_states')
			->where('deleted_status',0)
			->get();
			$conde = DB::table('tbl_districts')
			->leftJoin('tbl_states', 'tbl_districts.state_id', '=', 'tbl_states.id')
			->leftJoin('tbl_countrys', 'tbl_states.country_id', '=', 'tbl_countrys.id')
			->select('tbl_districts.*', 'tbl_states.state_name', 'tbl_countrys.country_name')
			->get();
		
			return view('district',compact('role','con','cond','conde'));
		}
		public function districtinsert(Request $request){
			
			$district = new Tbl_districts;
			$district->state_id = $request->state;
			$district->deleted_status = 0;
			$district->added_id=Auth::user()->id;
			$district->district_name = $request->district_name;
			$district->save();
		    return redirect('district');
		}
		public function fetchStates($countryId)
		{
			$states = DB::table('tbl_states') 
			->where('country_id', $countryId)
			->where('deleted_status', 0)
			->get();
		    return response()->json($states);
		}

		public function fetchplaces(Request $request)
		{
			$type = $request->type;
			$district_id = $request->district_id;
			$state_id = $request->state_id;
		    if ($type == 4) {
				$places = DB::table('tbl_districts')
					->where('state_id', $state_id)
					->where('deleted_status', 0)
					->select('id', 'district_name as place_id')
					->get();
			} else {
				$places = DB::table('tbl_places')
					->where('district_id', $district_id)
					->where('type', $type)
					->where('deleted_status', 0)
					->get();
			}
		    return response()->json($places);
		}

		public function getfranchisedetails(Request $request){
              $id=$request->id;

			  $fran = DB::table('tbl_franchase_details')
			  ->leftJoin('tbl_places', 'tbl_franchase_details.place_id', '=', 'tbl_places.id')
			  ->leftJoin('tbl_districts', 'tbl_places.district_id', '=', 'tbl_districts.id')
			  ->leftJoin('tbl_states', 'tbl_districts.state_id', '=', 'tbl_states.id')
			  ->leftJoin('tbl_countrys', 'tbl_states.country_id', '=', 'tbl_countrys.id')
			  ->select('tbl_franchase_details.*', 'tbl_places.place_name', 'tbl_districts.district_name', 'tbl_states.state_name', 'tbl_countrys.country_name')
			  ->where('franchise_id', $id)
			  ->where('tbl_franchase_details.type', '!=', 4)
			  ->get();
		  
			 
			
			  return response()->json($fran);
		}
	
		public function getfranchisedetailsdistrict(Request $request){
			$id=$request->id;

			$fran=DB::table('tbl_franchase_details')
			//->leftJoin('tbl_districts', 'tbl_franchase_details.district_id', '=', 'tbl_districts.id')
			//->leftJoin('tbl_places', 'tbl_franchase_details.place_id', '=', 'tbl_places.id')
			->leftJoin('tbl_districts', 'tbl_franchase_details.district_id', '=', 'tbl_districts.id')
			->leftJoin('tbl_states', 'tbl_districts.state_id', '=', 'tbl_states.id')
			->leftJoin('tbl_countrys', 'tbl_states.country_id', '=', 'tbl_countrys.id')
			->select('tbl_franchase_details.*','tbl_districts.district_name','tbl_states.state_name','tbl_countrys.country_name')
			->where('franchise_id',$id)
			->where('tbl_franchase_details.type',4)
			->get();
		   
		  
			return response()->json($fran);
		}
		
		
		public function districtfetch(Request $request){
			$id=$request->id;
            $district=DB::table('tbl_districts')
			->leftJoin('tbl_states', 'tbl_districts.state_id', '=', 'tbl_states.id')
			->where('tbl_districts.id',$id)
			->select('tbl_districts.*','tbl_states.country_id')
			->first();
			print_r(json_encode($district));
		}
		public function districtedit(Request $request){
			$id=$request->id;
			$district=Tbl_districts::find($id);
            $district->state_id=$request->state;
			$district->district_name=$request->district_name;
			$district->deleted_status=$request->status;
            $district->save();
			return redirect('district');
		}
	


		public function place(){
			$role=Auth::user()->user_type;
			$con=DB::table('tbl_countrys')
			->where('deleted_status',0)
			->get();
            $cond=DB::table('tbl_states')
			->where('deleted_status',0)
			->get();
			$dis=DB::table('tbl_districts')
			->where('deleted_status',0)
			->get();
			$plac = DB::table('tbl_places')
			->leftJoin('tbl_districts', 'tbl_places.district_id', '=', 'tbl_districts.id')
			->leftJoin('tbl_states', 'tbl_districts.state_id', '=', 'tbl_states.id')
			->leftJoin('tbl_countrys', 'tbl_states.country_id', '=', 'tbl_countrys.id')
			->select('tbl_places.*', 'tbl_districts.state_id', 'tbl_states.country_id', 'tbl_countrys.country_name','tbl_states.state_name','tbl_districts.district_name')
			->get();
		    return view('place',compact('role','con','cond','dis','plac'));
		}
		public function placeinsert(Request $request){
			$place = new Tbl_places;
			$place->district_id = $request->district;
			$place->type = $request->type;
			$place->deleted_status = 0;
            $place->added_id=Auth::user()->id;
			$place->place_name = $request->place_name;
			$place->save();
		    return redirect('place');
		}
		public function placefetch(Request $request){
			$id=$request->id;
			$place = DB::table('tbl_places')
			->leftJoin('tbl_districts', 'tbl_places.district_id', '=', 'tbl_districts.id')
			->leftJoin('tbl_states', 'tbl_districts.state_id', '=', 'tbl_states.id')
			->leftJoin('tbl_countrys', 'tbl_states.country_id', '=', 'tbl_countrys.id')
			->where('tbl_places.id',$id)
			->select('tbl_places.*', 'tbl_districts.district_name', 'tbl_states.state_name', 'tbl_countrys.country_name','tbl_states.country_id','tbl_districts.state_id')
			->first();
			print_r(json_encode($place));
		}
		public function placeedit(Request $request){
			$id=$request->id;
			$place=Tbl_places::find($id);
            $place->district_id=$request->district;
            $place->place_name=$request->place_name;
            $place->deleted_status=$request->status;
			$place->type=$request->type;
            $place->save();
            return redirect('place');
		}
		public function fetchstate(Request $request) {
			$countryId = $request->countryId;
		    $states = DB::table('tbl_states')
			->where('country_id', $countryId)
			->where('deleted_status',0)
			->select('id', 'state_name')
			->get();
		    return response()->json($states);
		}
		public function fetchdistrict(Request $request) {
			$stateId = $request->input('stateId'); 
		    $districts = DB::table('tbl_districts')
			->where('state_id', $stateId)
			->where('deleted_status',0)
            ->select('id', 'district_name')
		    ->get();
		    return response()->json($districts);
		}
        public function vouchers(){
			$vouch=DB::table('tbl_coupens')
			->leftJoin('shops', 'tbl_coupens.shop_id', '=', 'shops.id')
            ->select('tbl_coupens.*', 'shops.shopname')
            ->orderBy('tbl_coupens.id', 'desc')
		    ->get();
			$vouch1=DB::table('shops')->get();
			$role=Auth::user()->user_type;
			return view('vouchers',compact('vouch','vouch1','role'));
		}
		public function voucherinsert(Request $request){
			$vouch=new Tbl_coupens;
	        $vouch->coupencode=$request->coupencode;
			$vouch->discount=$request->discount;
			$vouch->description=$request->description;
			$vouch->status=$request->status;
			$vouch->expiry_status=$request->expiry_status;
			$vouch->expiry_date=$request->expiry_date;
			$vouch->shop_id=$request->shopname;
			$vouch->save();
			return redirect('vouchers');
		}

		public function voucherfetch(Request $request){
			$id=$request->id;
			$vouch=Tbl_coupens::find($id);
			print_r(json_encode($vouch));
		}

		public function voucheredit(Request $request){
			$id=$request->id;
			$vouch=Tbl_coupens::find($id);
            $vouch->coupencode=$request->coupencode;
			$vouch->discount=$request->discount;
			$vouch->description=$request->description;
			$vouch->status=$request->status;
			$vouch->expiry_status=$request->expiry_status;
			$vouch->expiry_date=$request->expiry_date;
			$vouch->shop_id=$request->shopname;
			$vouch->save();
			return redirect('vouchers');
		}
		public function market_category(){
			$role=Auth::user()->user_type;
			$mark=DB::table('tbl_rm_categorys')
			->where('status',0)
            ->where('cat_id',0)
			->orderBy('tbl_rm_categorys.id', 'desc')
			->get();
            return view('market_category',compact('mark','role'));
		}	
		public function marketinsert(Request $request){
			$mark = new Tbl_rm_categorys;
			$mark->category_name = $request->category_name;
			if($files=$request->file('categoryimage')){  
				$name=$files->getClientOriginalName();  
				$files->move('market/',$name);
				$mark->image=$name; 

				

				
            $mark->cat_id = 0;
            $mark->status = 0;
			$mark->save();
			}
			return redirect('market_category');
		}
		public function marketfetch(Request $request){
			$id=$request->id;
			$market=Tbl_rm_categorys::find($id);
			print_r(json_encode($market));
		}
		public function marketedit(Request $request){
			$id=$request->id;
			$mark=Tbl_rm_categorys::find($id);
			$mark->category_name=$request->category_name;
			$mark->status=$request->status;
			if($files=$request->file('categoryimage')){ 
				
				
				//$imageName = uniqid() . '.' . $image->getClientOriginalExtension();
				//$image->move(public_path('market'), $imageName); // Use public_path()

				$image = $request->file('categoryimage');
		  $image_name =$image->getClientOriginalName();
		  $path = public_path('market/') . "/" . $image_name;
		  Image::make($image->getRealPath())->resize(300, 300)->save($path);

	
				$mark->image=$image_name; 
			}  
			$mark->save();
			return redirect('market_category');
		}
		public function fetchsubcategory(Request $request) {
			$categoryId = $request->categoryId;
		    $categorys = DB::table('tbl_rm_categorys')
			->where('cat_id', $categoryId)
			->where('status', 0)
            ->select('id', 'category_name')
		    ->get();
			 return response()->json($categorys);
		}


	    public function order_invoice($orderId) {

		$markk=DB::table('tbl_order_trans')
			->get();
		$invoice=DB::table('tbl_order_masters')
		->leftJoin('tbl_order_trans', 'tbl_order_masters.id', '=', 'tbl_order_trans.order_id')
		->leftJoin('tbl_brand_products', 'tbl_order_trans.product_id', '=', 'tbl_brand_products.id')
		->leftJoin('shops', 'tbl_order_masters.shop_id', '=', 'shops.id') 
		->leftJoin('tbl_deliveryaddres', 'shops.delivery_id', '=', 'tbl_deliveryaddres.id')
		->where('tbl_order_masters.id',$orderId)
			->select(
				'tbl_order_masters.*',
				'tbl_order_trans.order_id',
				'tbl_order_trans.qty',
				'tbl_order_trans.offer_amount',
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
				'tbl_deliveryaddres.country'
				)
			->get();
		$role=Auth::user()->user_type;
		return view('order_invoice',compact('role','markk','invoice'));
	    }





		
		public function order_trans($orderId)
		{
	    	$role=Auth::user()->user_type;
			$mark=DB::table('tbl_rm_products')
			->get();
			$markk=DB::table('tbl_order_masters')
			->get();
			$order = DB::table('tbl_order_trans')
			->leftJoin('tbl_order_masters', 'tbl_order_trans.order_id', '=', 'tbl_order_masters.id')
			->leftJoin('tbl_brand_products', 'tbl_order_trans.product_id', '=', 'tbl_brand_products.id')
			->leftJoin('shops', 'tbl_order_masters.shop_id', '=', 'shops.id') 
			->leftJoin('tbl_deliveryaddres', 'shops.delivery_id', '=', 'tbl_deliveryaddres.id') 

			->where('tbl_order_trans.order_id',$orderId)
			->select(
				'tbl_order_trans.*',
				'tbl_order_masters.order_id',
				'tbl_order_masters.discount',
				'tbl_order_masters.total_amount',
				'tbl_order_masters.total_mrp',
				'tbl_order_masters.shipping_charge',
				'tbl_order_masters.order_id',

				'tbl_brand_products.product_name',
				'shops.shopname',
				'shops.address' ,
				'tbl_deliveryaddres.area',
				'tbl_deliveryaddres.area1',
				'tbl_deliveryaddres.city',
				'tbl_deliveryaddres.district',
				'tbl_deliveryaddres.state',
				'tbl_deliveryaddres.country'

			)
			->get();
		   return view('order_trans',compact('role','mark','markk','order'));
		}
		public function order_master() {
			$role = Auth::user()->user_type;
		
			$order = DB::table('tbl_order_masters')
				->leftJoin('shops', 'tbl_order_masters.shop_id', '=', 'shops.id')
				->leftJoin('tbl_deliveryaddres', 'shops.delivery_id', '=', 'tbl_deliveryaddres.id')
				->leftJoin('tbl_coupens', 'tbl_order_masters.coupen_id', '=', 'tbl_coupens.id')
				->select('tbl_order_masters.*', 'shops.shopname', 'shops.address', 'tbl_coupens.coupencode','tbl_deliveryaddres.area','tbl_deliveryaddres.area1','tbl_deliveryaddres.country','tbl_deliveryaddres.state','tbl_deliveryaddres.district','tbl_deliveryaddres.city','tbl_deliveryaddres.phone','tbl_deliveryaddres.pincode')
				
				->orderBy('tbl_order_masters.id', 'DESC')
				
				->paginate(10);

			//	echo "<pre>";print_r($order);exit;
		
			$mark = DB::table('shops')->get();
			$orderr = DB::table('tbl_coupens')->get();
		
			return view('order_master', compact('order', 'role', 'orderr', 'mark'));
		}
		

		public function order_masterfetch(Request $request){
			
			$id=$request->id;
			
			$order1 = DB::table('tbl_order_masters')
				->leftJoin('shops', 'tbl_order_masters.shop_id', '=', 'shops.id')
				->leftJoin('tbl_coupens', 'tbl_order_masters.coupen_id', '=', 'tbl_coupens.id')
				->leftJoin('tbl_order_trans', 'tbl_order_masters.id', '=', 'tbl_order_trans.order_id')
				->leftJoin('tbl_brand_products', 'tbl_order_trans.product_id', '=', 'tbl_brand_products.id')
				->leftJoin('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
				->where('tbl_order_masters.id',$id)
				->select(
					'tbl_order_masters.*',
					'shops.shopname',
					'shops.address',
					'tbl_coupens.coupencode',
					'tbl_order_trans.product_id',
					'tbl_order_trans.qty',
					'tbl_order_trans.offer_amount',
					'tbl_brand_products.product_name',
					'tbl_rm_products.brand_name'
				)
				->get();
				print_r(json_encode($order1));

		}

		public function orderfetch(Request $request){
			$id = $request->id;
			$order = Tbl_order_masters::find($id);
		
			if ($order) {
		
				$orderArray = $order->toArray();
				
				return response()->json($orderArray);
			} else {
			
				return response()->json(['error' => 'Order details not found'], 404);
			}
		}
		public function orderstatus() {
			$order = Tbl_order_masters::orderBy('order_status')->get();
		
			return view('order_master', compact('order'));
		}
		

		public function statusedit(Request $request, $id)
		{
			\Log::info('Received ID for statusedit: ' . $id);
		
			// Retrieve total_amount from the request
			$total_amount = $request->input('total_amount');
		
			\Log::info('Received total_amount for statusedit: ' . $total_amount);
		
			// Ensure total_amount is a valid number
			if (!is_numeric($total_amount)) {
				\Log::error('Invalid total_amount received: ' . $total_amount);
				return redirect('order_master')->with('error', 'Invalid total_amount received.');
			}
		
			// Find the order by ID
			$order = Tbl_order_masters::find($id);
		
			// Check if the order exists
			if ($order) {
				// Update the order status
				$order->order_status = $request->order_status;
				$order->payment_status = $request->paystatus;
		
				// Check if the order status is "Cash Received" (assuming '5' is the code for 'Cash Received')
				if ($request->paystatus == '1') {
					// Calculate the percentage using the formula: percentage = (total_amount * percentage_rate) / 100
					$percentage = ($total_amount * 10) / 100;
					\Log::info('Calculated Percentage: ' . $percentage);
		
					// Update the wallet_amount in tbl_wallets table based on shop_id
					$shop_id = $order->shop_id;
		
					// Find the corresponding wallet record
					$wallet = Tbl_wallets::where('shop_id', $shop_id)->first();
		
					if ($wallet) {
						// Update the wallet_amount
						$wallet->wallet_amount += $wallet->amount+$percentage;
						$wallet->save();
						\Log::info('Wallet Amount Updated: ' . $wallet->wallet_amount);
					} else {
						$w=new Tbl_wallets;
						$w->shop_id=$shop_id;
						$w->wallet_amount += $percentage;
						$w->save();
					}
					    $wh=new Tbl_wallet_transactions;
						$wh->amount=$percentage;
						$wh->type = 1;
						$wh->shop_id =$shop_id = $percentage;

				}
		
				// Save the order
				$order->save();
		
				// Redirect to the appropriate page
				return redirect('order_master')->with('success', 'Order status updated successfully.');
			} else {
				// If the order is not found, redirect with an error message
				return redirect('order_master')->with('error', 'Order not found.');
			}
		}
	
		public function sale_order_master($orderId) {

			$markk=DB::table('tbl_order_trans')
			->get();
		$saleorder=DB::table('tbl_order_masters')
		->leftJoin('tbl_order_trans', 'tbl_order_masters.id', '=', 'tbl_order_trans.order_id')
		->leftJoin('tbl_brand_products', 'tbl_order_trans.product_id', '=', 'tbl_brand_products.id')
		->leftJoin('shops', 'tbl_order_masters.shop_id', '=', 'shops.id') 
		->leftJoin('tbl_deliveryaddres', 'shops.delivery_id', '=', 'tbl_deliveryaddres.id')
		->where('tbl_order_masters.id',$orderId)
			->select( 
				'tbl_order_masters.*',
				'tbl_order_trans.product_id',
				'tbl_order_trans.order_id',
				'tbl_order_trans.qty',
				'tbl_order_trans.price',
				'tbl_order_trans.offer_amount',
				'shops.id',
				'shops.shopname',
				'shops.address' ,
				'shops.delivery_id' ,
				'tbl_brand_products.id',
				'tbl_brand_products.product_name',
				'tbl_deliveryaddres.phone',
				'tbl_deliveryaddres.pincode',
				'tbl_deliveryaddres.area',
				'tbl_deliveryaddres.area1',
				'tbl_deliveryaddres.city',
				'tbl_deliveryaddres.district',
				'tbl_deliveryaddres.state',
				'tbl_deliveryaddres.country'
				)
			->get();
		$role=Auth::user()->user_type;
		return view('sale_order_master',compact('role','markk','saleorder'));
	    }


		
		public function sale_orderinsert(Request $request)
		{
			try {
				\Log::info('Debug: Request data', ['request' => $request->all()]);
		
				$shop = Shops::where('shopname', $request->shopname)->first();
		
				if (!$shop) {
					dd("Shop with name $request->shopname not found");
				}
		
				$saleMaster = new Tbl_sale_order_masters;
				$saleMaster->shop_id = $shop->id;
				$saleMaster->order_id = is_array($request->orderId) ? $request->orderId[0] : null;
				$saleMaster->total_amount = $request->total_amount;
				$saleMaster->discount = $request->discount;
				$saleMaster->coupen_id = 0;
				$saleMaster->wallet_redeem_id = 0;
				$saleMaster->payment_mode = $request->payment;
				$saleMaster->total_mrp = $request->total_mrp;
				$saleMaster->shipping_charge = 0;
				$saleMaster->tax_amount = 0;
				$saleMaster->payment_status = 0;
				$saleMaster->delivery_date = $request->delivery_date;
				$saleMaster->order_date = $request->orderdate;
		
				if ($saleMaster->save()) {
					// Iterate through the products submitted in the request
					foreach ($request->product_name as $index => $productName) {
						\Log::info('Debug: Inside Loop');
		
						// Retrieve values directly from arrays
						$qty = $request->qty[$index];
						$offer_amount = $request->offer_amount[$index];
						$price = $request->price[$index] ?? 0;
		
						// Find the product by name in the Tbl_brand_products table
						$product = Tbl_brand_products::where('product_name', $productName)->first();
						\Log::info('Debug: Product', ['product' => $product]);
		
						// Create a new sale transaction record
						$saleTrans = new Tbl_sale_order_trans;
						$saleTrans->order_id = $saleMaster->id;
						$saleTrans->product_id = $product ? $product->id : 0;
						$saleTrans->sale_order_id = $saleMaster->id;
						$saleTrans->qty = $qty;
						$saleTrans->offer_amount = $offer_amount;
						$saleTrans->price = 0;
						$saleTrans->taxable_amount = 0;
		
						// Save the sale transaction
						if (!$saleTrans->save()) {
							\Log::error('Error saving sale transaction:', ['errors' => $saleTrans->getErrors()]);
							break; // Stop processing if an error occurs
						}
					}
		
					// Update the sale_status in Tbl_order_masters table (if needed)
					Tbl_order_masters::where('id', $saleMaster->order_id)->update(['sale_status' => 1]);
		
					// Flash a success message
					Session::flash('success', 'Sale Invoice generated successfully!');
				} else {
					// Flash an error message if saleMaster save fails
					Session::flash('error', 'Error adding Sale Invoice. Please try again.');
				}
		
				return redirect('order_master');
			} catch (\Exception $e) {
				\Log::error($e->getMessage());
				dd($e->getMessage());
			}
		}
		
		

		public function product_order(Request $request)
        {
			$role = Auth::user()->user_type;

			// Get the list of brands for the filter dropdown
			$brands = DB::table('tbl_rm_products')->get();

			// Check if a brand filter is applied
			$selectedBrand = $request->input('brand');

			$ordersQuery = DB::table('tbl_order_trans')
				->leftJoin('tbl_brand_products', 'tbl_order_trans.product_id', '=', 'tbl_brand_products.id');

			// Apply brand filter if selected
			if ($selectedBrand) {
				$ordersQuery->where('tbl_brand_products.brand_id', $selectedBrand);
			}

			$orders = $ordersQuery
				->where('order_status', 0)
				->select(
					'tbl_order_trans.*',
					'tbl_brand_products.product_name'
				)->get();

			return view('product_order', compact('orders', 'role', 'brands', 'selectedBrand'));
		}


		public function updateOrderStatus(Request $request)
		{
			$productId = $request->input('productId');
			\Log::info("Update Order Status called with productId: " . $productId);

			$ordersToUpdate = Tbl_order_trans::where('product_id', $productId)->get();

			foreach ($ordersToUpdate as $order) {
				$order->order_status = ($order->order_status == 0);
				$order->save();

			}

			return response()->json(['success' => true]);
		}



 
//  public function updateOrderStatus(Request $request)
//  {
// 	 $productId = $request->input('productId');
// 	 $qty = $request->input('qty');
// 	 $price = $request->input('price');
 
// 	 \Log::info("Update Order Status called with productId: " . $productId);
 
// 	 $ordersToUpdate = Tbl_order_trans::where('product_id', $productId)->get();
 
// 	 foreach ($ordersToUpdate as $order) {
	
// 		 $order->order_status = ($order->order_status == 0) ? 1 : 0;
// 		 $order->save();
 
		
// 		 if ($order->order_status == 1) {
			
// 			 $placeOrder = new Tbl_placeorders;
// 			 $placeOrder->product_id = $productId;
// 			 $placeOrder->qty = $qty;
// 			 $placeOrder->amount = $price;
// 			 $placeOrder->order_date = $order->order_date;
// 			 $placeOrder->save();
// 		 }
// 	 }
 
// 	 return response()->json(['success' => true]);
//  }
 
 
 
 


// public function insertIntoPlaceOrders(Request $request)
// {
// 	$productId = $request->input('productId');

// 	// Retrieve orders with order_status = 1 from tbl_order_trans
// 	$ordersToInsert = Tbl_order_trans::where('product_id', $productId)
// 		->where('order_status', 1)
// 		->get();

// 	foreach ($ordersToInsert as $order) {
// 		// Insert into tbl_placeorders
// 		Tbl_placeorders::create([
// 			'product_id' => $order->product_id,
// 			'qty' => $order->qty,
// 			'price' => $order->price
// 			// Add other fields as needed
// 		]);
// 	}

// 	return response()->json(['success' => true]);
// }


public function order_history()
{
	$orders=DB::table('tbl_placeorders')
	->leftJoin('tbl_brand_products', 'tbl_placeorders.product_id', '=', 'tbl_brand_products.id')
	->select(
		'tbl_placeorders.*',
		'tbl_brand_products.product_name'
	)

	->get();
	
	 $role=Auth::user()->user_type;
	return view('order_history',compact('orders','role'));
 }



        public function brands()
		{
		    $brand=DB::table('tbl_brands')
			->orderBy('tbl_brands.id', 'desc')
			->get();
			 $role=Auth::user()->user_type;
			return view('brands',compact('brand','role'));
		 }
		 public function brandsinsert(Request $request)
		 {  
			$brand= new Tbl_brands;
			$brand->brand_name=$request->brand_name;
		    $brand->save();
			return redirect('brands');
		 }
		 public function brandsfetch(Request $request){
			 $id=$request->id;
			 $brand = Tbl_brands::find($id);
			 print_r(json_encode($brand));
		 }
		 public function brandsedit(Request $request){
			 $id=$request->id;
			 $brand = Tbl_brands::find($id);
			 $brand->brand_name=$request->brand_name;
			 $brand->save();
			 return redirect('brands');
		 }
		  public function brandproducts($Id,$BrandName)
		  {
			  $brandprod = DB::table('tbl_brand_products')
		      ->leftJoin('tbl_brands', 'tbl_brand_products.brand_id', '=', 'tbl_brands.id')
			  ->leftJoin('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
			  ->where('tbl_brand_products.brand_id', $Id)
			  ->select('tbl_brand_products.*', 'tbl_brands.brand_name','tbl_hsncodes.hsncode','tbl_hsncodes.tax')
			  ->orderBy('tbl_brand_products.id', 'desc')
			  ->get();
		      $brand = DB::table('tbl_brands')->get();
			  $hsn = DB::table('tbl_hsncodes')->get();
			  $role = Auth::user()->user_type;
		      return view('brandproducts', compact('brandprod', 'brand', 'role', 'Id','BrandName','hsn'));
		  }
		  
		  public function brandproductsinsert(Request $request, $Id)
		  {
			  $brandprod = new Tbl_brand_products;
			  $brandprod->brand_id = $Id;
			  $brandprod->product_name = $request->product_name;
			  $brandprod->offer_price = $request->offer_price;
              $brandprod->description = $request->description;
			  $brandprod->price = $request->original_amount;
			  $brandprod->hsncode = $request->hsncode;
			  $brandprod->status = 0;
			  $brandprod->save();
			  $prod_id = $brandprod->id;
	          $request->validate([
				  'images.*' => 'required|image|mimes:jpeg,png,jpg,gif',
			  ]);
		      foreach ($request->file('images') as $image) {

				
				 // $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
				 // $image->move(public_path('market'), $imageName); // Use public_path()

			//$image = $request->file('images');
			$image_name =$image->getClientOriginalName();
			$path = public_path('market/') . "/" . $image_name;
			Image::make($image->getRealPath())->resize(300, 300)->save($path);

		//	$files = $request->file('subcategoryimage');
		//	$name = $files->getClientOriginalName();
			//$files->move('market/', $name);
			//$mark->image = $image_name;
		          Tbl_productimages::create([
					  'prod_id' => $prod_id,
					  'images' => $image_name,
				  ]);


			  }
		      return back()->with('success', 'Product Added successfully!');;
		  }


	       public function brandproductsfetch(Request $request){
			$id=$request->id;
			$brandprod = Tbl_brand_products::find($id);
			print_r(json_encode($brandprod));
	     }
		   public function brandproductsedit(Request $request){
			$id=$request->id;
			$brandprod=Tbl_brand_products::find($id);
			$brandprod->product_name = $request->product_name;
			$brandprod->description = $request->description;
            $brandprod->offer_price = $request->offer_price;
			$brandprod->price = $request->original_amount;
			$brandprod->hsncode = $request->hsncode;
			$brandprod->status = $request->status;
			$brandprod->save();
			return back()->with('success', 'Product Edited successfully!');;
		}
	      public function imgcompress()
		{
			$role = Auth::user()->user_type;
			$imagePath = public_path('Amith/');
			$images = File::allFiles($imagePath);
		    return view('imgcompress', compact('role', 'images'));
		}
		
          public function imagecompressinsert(Request $request)
		{
		    $image=$request->image;
			for($i=0;$i<count($image);$i++){
				$image[$i] = $request->file('image')[$i];
				$image_name[$i] =$image[$i]->getClientOriginalName();
				$path[$i] = public_path('Amith/') . "/" . $image_name[$i];
				Image::make($image[$i]->getRealPath())->resize(300, 300)->save($path[$i]);
			}
			return back();
        }
          public function deleteImages(Request $request)
		{
			$imageNames = $request->input('images', []);
		    foreach ($imageNames as $imageName) {
			$imagePath = public_path('Amith/') . $imageName;
		    if (File::exists($imagePath)) {
					File::delete($imagePath);
				}
			}
		
			return back()->with('success', 'Images deleted successfully');
		}
	      public function subcategory($catId,$categoryname) 
		{
			$role = Auth::user()->user_type;
			$mark = DB::table('tbl_rm_categorys')
			->get();
		    $markk = DB::table('tbl_rm_categorys')
            ->where('cat_id',$catId)
			->orderBy('tbl_rm_categorys.id', 'desc')
			->get();
		 return view('subcategory', compact('role', 'mark', 'markk', 'catId','categoryname'));
		}
		public function app_version() 
		{
			$role = Auth::user()->user_type;
		    $app = DB::table('app_versions')
			->get();
		    return view('app_version', compact('role','app'));
		}
		public function appversionfetch(Request $request){
			$id=$request->id;
			$app=App_versions::find($id);
			print_r(json_encode($app));
		}
		public function appversionedit(Request $request){
			$id=$request->id;
			$app=App_versions::find($id);
            $app->version_code= $request->version_code;
			$app->version_name	= $request->version_name;
			$app->app_type	= $request->app_type;
			$app->phone_number	= $request->phone_number;
			$app->ios_code	= $request->ios_code;
			$app->security_code	= $request->security_code;
            $app->app_status = $request->status;
		    $app->save();
			return back();
		}
	   public function subcategoryinsert(Request $request)
	  {
		$mark = new Tbl_rm_categorys;
		$mark->category_name = $request->subcategory_name;
		$mark->cat_id = $request->input('catid');
		if ($request->hasFile('subcategoryimage')) 
		{
			$image = $request->file('subcategoryimage');
			$image_name =$image->getClientOriginalName();
			$path = public_path('market/') . "/" . $image_name;
			Image::make($image->getRealPath())->resize(300, 300)->save($path);

		//	$files = $request->file('subcategoryimage');
		//	$name = $files->getClientOriginalName();
			//$files->move('market/', $name);
			$mark->image = $image_name;
			$mark->status = 0;
			$mark->save();
			Session::flash('success', 'Subcategory added successfully!');
		} else {
			// If no file is uploaded, save without an image
			$mark->status = 0;
			$mark->save();
			Session::flash('success', 'Subcategory added successfully!');
		}
	   return back();
	  }
	  public function subcategoryfetch(Request $request){
			$id=$request->id;
			$app = Tbl_rm_categorys::find($id);
			print_r(json_encode($app));
		}

		public function subcategoryedit(Request $request){
			$id=$request->id;
			$markk=Tbl_rm_categorys::find($id);
            $markk->category_name = $request->subcategory_name;
			$markk->status=$request->status;
            if ($files = $request->file('subcategoryimage')) {  
				// $name = $files->getClientOriginalName();  
				// $files->move('market/', $name);
				// $markk->image = $name; 

					
				//$imageName = uniqid() . '.' . $image->getClientOriginalExtension();
				//$image->move(public_path('market'), $imageName); // Use public_path()

				$image = $request->file('subcategoryimage');
		  $image_name =$image->getClientOriginalName();
		  $path = public_path('market/') . "/" . $image_name;
		  Image::make($image->getRealPath())->resize(300, 300)->save($path);

	
				$markk->image=$image_name; 
			}
			$markk->save();
			return back();
	    }
	   public function marketwallet()
	    {
		    $role = Auth::user()->user_type;
            $wallet = DB::table('tbl_wallets')
		    ->leftJoin('shops', 'tbl_wallets.shop_id', '=', 'shops.id')
            ->select('tbl_wallets.*', 'shops.shopname')
			->get();
            return view('marketwallet', compact('role','wallet'));
	}

	public function hsn(){
		
		$hs=DB::table('tbl_hsncodes')->orderBy('id', 'DESC')->get();
		$role=Auth::user()->user_type;

		return view('hsn',compact('hs','role'));
	}
    public function hsninsert(Request $request){
	$hs=new Tbl_hsncodes;
	$hs->hsncode=$request->hsncode;
	$hs->tax=$request->tax;
	$hs->cgst=$request->cgst;
	$hs->igst=$request->igst;
	$hs->save();
    return redirect('hsn')->with('success', 'Added successfully');	
	}

    public function hsnfetch(Request $request){
	$id=$request->id;
	$hs=Tbl_hsncodes::find($id);
	print_r(json_encode($hs));
    }

	public function hsnedit(Request $request){
	$id=$request->id;
	$hs=Tbl_hsncodes::find($id);
	$hs->hsncode=$request->hsncode;
	$hs->tax=$request->tax;
	$hs->cgst=$request->cgst;
	$hs->igst=$request->igst;
	$hs->save();
	return redirect('hsn')->with('success', 'Edited successfully');
	}

	public function hsndelete($id){
		DB::delete('delete from tbl_hsncodes where id = ?', [$id]);
		return redirect('hsn')->with('success', 'HSN deleted successfully.');
	}
	

	public function marketvendor(){
	$vendor=DB::table('tbl_vendors')->orderBy('id', 'DESC')->get();
	$role=Auth::user()->user_type;
    return view('marketvendor',compact('vendor','role'));
	}
	public function vendorinsert(Request $request){
	$vendor=new Tbl_vendors;
	$vendor->vendor_name=$request->venname;
	$vendor->address=$request->address;
    $vendor->phone_number=$request->phonenumber;
	$vendor->email=$request->email;
	$vendor->vendor_code=$request->vendorcode;
	$vendor->Gst_number=$request->gstnumber;
	$vendor->status=0;
    $vendor->save();
    return redirect('marketvendor')->with('success', 'Added successfully');	
	}
    public function vendorfetch(Request $request){
	$id=$request->id;
	$vendor=Tbl_vendors::find($id);
	print_r(json_encode($vendor));
   }
    public function vendoredit(Request $request){
	$id=$request->id;
	$vendor=Tbl_vendors::find($id);
	$vendor->vendor_name=$request->venname;
	$vendor->address=$request->address;
	$vendor->phone_number=$request->phonenumber;
	$vendor->email=$request->email;
	$vendor->vendor_code=$request->vendorcode;
	$vendor->Gst_number=$request->gstnumber;
	$vendor->status=$request->status;
    $vendor->save();
	return redirect('marketvendor')->with('success', 'Edited successfully');
	}

	public function purchase_order(){
		$ordersQuery = DB::table('tbl_order_trans')
    ->leftJoin('tbl_brand_products', 'tbl_order_trans.product_id', '=', 'tbl_brand_products.id')
    ->leftJoin('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
    ->leftJoin('tbl_vendors', 'tbl_rm_products.vendor_id', '=', 'tbl_vendors.id')
    ->where('tbl_order_trans.order_status', 0)
    ->groupBy('tbl_rm_products.vendor_id')
    ->select(
        'tbl_order_trans.*',
        'tbl_brand_products.product_name',
        'tbl_rm_products.vendor_id',
        'tbl_vendors.vendor_name',
        DB::raw('COUNT(tbl_order_trans.id) as total_products'), // Counting the products
		DB::raw('SUM(tbl_order_trans.offer_amount) as totalamount')
    )
    ->get();

   
                 
		//echo "<pre>";print_r($ordersQuery);exit;
		$role=Auth::user()->user_type;
		return view('purchase_order',compact('role','ordersQuery'));
	}
	public function view_bill($id){
		$role=Auth::user()->user_type;
		$ordersQuery = DB::table('tbl_order_trans')
    ->leftJoin('tbl_brand_products', 'tbl_order_trans.product_id', '=', 'tbl_brand_products.id')
    ->leftJoin('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
    ->leftJoin('tbl_vendors', 'tbl_rm_products.vendor_id', '=', 'tbl_vendors.id')
    ->where('tbl_order_trans.order_status', 0)
    ->where('tbl_rm_products.vendor_id',$id)
    ->select(
        'tbl_order_trans.*',
        'tbl_brand_products.product_name',
        'tbl_rm_products.vendor_id',
        'tbl_vendors.vendor_name',
     
    )
    ->get();

	
		return view('view_bill',compact('role','ordersQuery'));
	}
	public function updatepo($id){
		
		
		 
		$ordersToInsert = DB::table('tbl_order_trans')
		->leftJoin('tbl_brand_products', 'tbl_order_trans.product_id', '=', 'tbl_brand_products.id')
		->leftJoin('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
		->where('tbl_rm_products.vendor_id',$id)
	->where('tbl_order_trans.order_status', 0)
	->select('tbl_order_trans.*')
	->get();
		 
	$bill=DB::table('tbl_place_order_masters')->orderBy('id', 'DESC')->first();
	if($bill){
		$ordernum=$bill->bill_num+1;
		
	}else{
		$ordernum=1000;

	}
		 $master=new Tbl_place_order_masters;
		 $master->bill_num=$ordernum;
		 $master->vendor_id=$id;
		 $master->request_by=Auth::user()->id;
		 $master->order_date =date('Y-m-d');
		 $master->save();
			 foreach ($ordersToInsert as $order) {

				

				$placeOrder = new Tbl_placeorders;
				$placeOrder->bill_number = $master->id;
				$placeOrder->product_id = $order->product_id;
				$placeOrder->qty = $order->qty;
				$placeOrder->amount = $order->offer_amount;
				$placeOrder->order_date =date('Y-m-d');
				$placeOrder->save();

				$update = \DB::table('tbl_order_trans') ->where('id', $order->id) ->limit(1) ->update( [ 'order_status' => 1]);
			
				
			 }
	
        return redirect('purchaseorder_bill');

	
	}

	
	public function purchaseorder_bill(){
		$ordersQuery=DB::table('tbl_place_order_masters')
		->leftJoin('tbl_vendors', 'tbl_place_order_masters.vendor_id', '=', 'tbl_vendors.id')
		->leftJoin('users', 'tbl_place_order_masters.request_by', '=', 'users.id')
		->select('tbl_place_order_masters.*','tbl_vendors.vendor_name','users.name')
		->get();
		$role=Auth::user()->user_type;
		return view('purchaseorder_bill',compact('role','ordersQuery'));
	}
	public function bill($id){
		$role=Auth::user()->user_type;
		$master=DB::table('tbl_place_order_masters')
		->leftJoin('users', 'tbl_place_order_masters.request_by', '=', 'users.id')
		->where('tbl_place_order_masters.id',$id)
		->select('tbl_place_order_masters.*','users.name')
		->first();
		$vendor=DB::table('tbl_vendors')->where('id',$master->vendor_id)->first();
		$bills=DB::table('tbl_placeorders')->where('bill_number',$id)
		->leftJoin('tbl_brand_products', 'tbl_placeorders.product_id', '=', 'tbl_brand_products.id')
		->leftJoin('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
		->select('tbl_placeorders.*','tbl_brand_products.product_name','tbl_hsncodes.tax')
		->get();
	
	
		return view('bill',compact('role','master','vendor','bills'));
		}
		public function productpriority(Request $request){
			$role = Auth::user()->user_type;
			$product = DB::table('tbl_brand_products')
				
			->leftJoin('tbl_productimages', 'tbl_brand_products.id', '=', 'tbl_productimages.prod_id')
			->where('tbl_brand_products.priority', 1)
			->select('tbl_brand_products.*','tbl_productimages.images') 
			->groupBy('tbl_brand_products.id') 
			->orderBy('tbl_brand_products.id', 'desc')
			->get();
				//echo "<pre>";print_r($product);exit;
			return view('productpriority', compact('role','product'));
		}
		
		public function search_product(Request $request)
		{
			$searchval = $request->searchval;
			$productList = '';
		
			if ($searchval != '') {
				$products = DB::table('tbl_brand_products')
				->where('tbl_brand_products.status', 0)
				->where('tbl_brand_products.priority', 0)
					->where('product_name', 'like', '%' . $searchval . '%')
					->orderBy('id', 'DESC')
					->get();
		
				$role = Auth::user()->user_type;
				$i = 1;
		
				if (count($products) > 0) {
					foreach ($products as $key) {
						$productList .= '<tr>';
						$productList .= '<td>' . $i . '</td>';
						$productList .= '<td>' . $key->product_name . '</td>';
						$productList .= '<td><input type="checkbox" name="selected_products[]" value="' . $key->id . '" style="margin-right; 5px; margin-left: 5px; background-color: red;"></td>';
						$productList .= '</tr>';
						$i++;
					}
				} else {
					$productList .= '<tr><td colspan="3">No Results Found</td></tr>';
				}
			}
		
			return response()->json(['productList' => $productList]);
		}
		public function update_Priority(Request $request)
		{
			try {
				$selectedProductIds = explode(',', $request->input('selected_product_ids'));
				$currentPriority1Count = DB::table('tbl_brand_products')->where('priority', 1)->count();
				$availableSlots = 6 - $currentPriority1Count;
				if ($availableSlots <= 0) {
					return response()->json(['success' => false, 'message' => 'PRIORITY LIST IS ALREADY FULL']);
				}
				if (count($selectedProductIds) > $availableSlots) {
					return response()->json(['success' => false, 'message' => 'YOU CAN ONLY UPDATE ' . $availableSlots . ' PRODUCTS PRIORITY']);
				}
				$recentProducts = DB::table('tbl_brand_products')
					->whereIn('id', $selectedProductIds)
					->orderBy('created_at', 'desc')
					->pluck('id');
		
				DB::table('tbl_brand_products')
					->whereIn('id', $recentProducts)
					->update(['priority' => 1]);
	   	return response()->json(['success' => true, 'message' => 'Priority updated successfully']);
			} catch (\Exception $e) {
				\Log::error($e);
				return response()->json(['success' => false, 'message' => 'Error updating priority']);
			}
		}
	public function removePriority($productId)
    {
        DB::table('tbl_brand_products')
            ->where('id', $productId)
            ->update(['priority' => 0]);

        return redirect()->back()->with('success', 'Priority removed successfully.');
    }

}
	



