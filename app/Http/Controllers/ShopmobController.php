<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;



use App\Tbl_sugg_complaints;



use App\User;



use App\Shops;



use Auth;



use DB;



use App\User_lists;



use App\Packages_shops;



use App\Vehicle_types;



use App\User_vehicles;



use App\Post_querys;



use App\Shiop_categories;



use App\Shop_provide_categories;



use App\Store_lists;



use App\Reviews;



use App\Shop_services;



use App\Mystorequerys;



use App\Storequery_answers;



use App\Package_books;



use App\Tbl_shop_offers;



use App\Booktimemasters;



use App\Shopoffer_customer_bookings;



use App\Product_offers;



use App\Shop_offer_models;



use App\Shop_timeslots;



use App\Shop_booking_payments;



use App\Tbl_shopbankdetails;

use App\Brand_models;

use App\Tbl_bulkdatas;



class ShopmobController extends Controller

{



  public function sendsmsotp($otp,$mob){



    $curl = curl_init();



    $authkey        =   '293880AKkOsHqp5f830090P1';

   

    //$email          =   'alwinespylabs@gmail.com';

    // $template_id    =   '5fc9d192733e90375b65746f';
    $template_id    =   '64cb55efd6fc05417a720692';


   // $otp            =   rand(1000,9999);

    $url            =   "https://api.msg91.com/api/v5/otp?";





    $params             =   array(

                                'extra_param' => '{"section":"login"}',

                                'unicode' => 0,

                                'authkey' => $authkey,

                                'template_id' => $template_id,

                                'mobile' => $mob,

                                'invisible' => 0,

                                'mobile' => $mob,

                                'otp' => $otp,

                                //'email' => $email,

                                'otp_length' => 4,

                            );



    $url_with_params= $url.http_build_query($params);

    //echo $url_with_params;exit;



    curl_setopt_array($curl, array(

      CURLOPT_URL => $url_with_params,

      CURLOPT_RETURNTRANSFER => true,

      CURLOPT_ENCODING => "",

      CURLOPT_MAXREDIRS => 10,

      CURLOPT_TIMEOUT => 30,

      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

      CURLOPT_CUSTOMREQUEST => "GET",

      CURLOPT_SSL_VERIFYHOST => 0,

      CURLOPT_SSL_VERIFYPEER => 0,

      CURLOPT_HTTPHEADER => array(

        "content-type: application/json"

      ),

    ));



    $response = curl_exec($curl);

    $err = curl_error($curl);



    //$info = curl_getinfo($curl);

    //print_r($info);

    curl_close($curl);



    if ($err) {



      //echo "cURL Error #:" . $err;

      $resp = array(

                  'status' => 'error',

                );

      return $resp;



    } else {



      //echo $response;

      $resp = array(

                'status' => 'success',

                'otp'    => $otp

              );

      return $resp;

      

    }



}



	public function shoplogin(Request $request){



  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

   $data1 = json_decode($json);

   $mob=$data1->mobnum;

  // $data=User::all();

   

  $mobilecheck=DB::table('shops')

   ->where('phone_number',$mob)

   ->value('id');



   

 if($mobilecheck==null){

    echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

   }else{

    if($mob==9947629002){
      $otp=5252;

      $authKey =  env('AUTH_KEY',"");

     // $sms="{$otp} is your Roadmate verification code. Please DO NOT share this OTP with anyone to ensure account security";



      $sms=$otp;

      

      $this->sendsmsotp($sms,$mob);



      



      $affectedRows = Shops::where('phone_number',$mob)->update(array('otp' => $otp));



      echo json_encode(array('error' => false, "data" => $sms, "message" => "Success"));


    }else{
       $otp=rand(1000, 9999);
      
      // $otp=5252;

      $authKey =  env('AUTH_KEY',"");

     // $sms="{$otp} is your Roadmate verification code. Please DO NOT share this OTP with anyone to ensure account security";



      $sms=$otp;

      

      $this->sendsmsotp($sms,$mob);



      



      $affectedRows = Shops::where('phone_number',$mob)->update(array('otp' => $otp));



      echo json_encode(array('error' => false, "data" => $sms, "message" => "Success"));


    }

     

            	//	sendSMS($mob, $mess,$otp);

   }

}

public function sendsms($sms,$mob){



  echo json_encode(array('error' => false, "data" => $sms, "message" => "Success"));

  //print_r($sms);



}

public function otpshop(Request $request){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $otp=$data1->otp;

  $phnum=$data1->phnum;

  $otpcheck=DB::table('shops')

   ->where('otp',$otp)

   ->where('phone_number',$phnum)

   ->select('shops.id','shops.shopname','shops.type','shops.pay_status')

   ->get();

   if($otpcheck==null){

    echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

   }else{

    echo json_encode(array('error' => false, "data" => $otpcheck, "message" => "Success"));

   }

}

public function shopreg1(Request $request){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  

  $shop = new Shops;

  $shop->shopname=$request->shopname;

  $shop->type=$request->type;

  $shop->phone_number=$request->phnum;

  $shop->phone_number2=$request->phnum2;

  $shop->description=$request->desc;

  $shop->open_time=$request->opentime;

  $shop->close_time=$request->closetime;

  $shop->agrimentverification_status=$request->agrimentverification_status;

  $shop->status=0;

 if($shop->save()){

    $json_data = 1;

    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

  } else{

    echo json_encode(array('error' => true, "message" => "Error"));

  }

}

public function shopreg(Request $request){

   $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $mobilecheck=DB::table('shops')

  ->where('phone_number',$request->phnum)

  ->value('id');

 

  if($mobilecheck==null){

	   $shops = new Shops;

  if($files=$request->file('image')){  

    $name=$files->getClientOriginalName();  

    $files->move('img',$name);  

     $shops->image=$name; 

    } 

	

  $shops->type=$request->type;

  $shops->shopname=$request->shopname;

  $shops->status=1;

  $shops->phone_number=$request->phnum;

  $shops->phone_number2=$request->phnum2;

  $shops->description=$request->desc;

  $shops->open_time=$request->opentime;

  $shops->close_time=$request->closetime;

  $shops->agrimentverification_status=$request->agrimentverification_status;

  $shops->address=$request->address;

  $shops->pincode=$request->pincode;

  $shops->lattitude=$request->latitude;

  $shops->logitude=$request->logitude;

  $shops->trans_id=$request->trans_id;

  $shops->exeid=$request->exeid;

 if($shops->save()){

  $lastid=$shops->id;



   $shopcat=new Shop_provide_categories;

    $shopcat->shop_id=$lastid;

    $shopcat->shop_cat_id=$request->type;

    if($shopcat->save()){



      $otp=rand(1000, 9999);

      $authKey =  env('AUTH_KEY',"");

      // $sms="{$otp} is your Roadmate verification code. Please DO NOT share this OTP with anyone to ensure account security";

      $mob=$request->phnum;

      $sms=$otp;
      
     // $sms=5252;

       

      $this->sendsmsotp($sms,$mob);

 

     $affectedRows = Shops::where('phone_number',$mob)->update(array('otp' => $otp));



     echo json_encode(array('error' => false,'data'=>$sms, "message" => "success"));



    }else{

      echo json_encode(array('error' => true, "message" => "Error"));

    }

	  

    

  } else{

    echo json_encode(array('error' => true, "message" => "Error"));

  }

}else{

	echo json_encode(array('error' => false, "data" => 2, "message" => "Already existed"));

}

}









 public function bannershop(){

 

  try{	

   

    $banner=DB::table('banners')

    ->select('banners.banner_image')

	->where('banner_type',2)

    ->get();

     

        if($banner == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false, "data" => $banner, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

 }

 public function packagerandomdetails(){

	 $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $random=$data1->randomnumber;

    try{	

   

    $package=DB::table('package_books')

	 ->leftJoin('packages', 'package_books.package_id', '=', 'packages.id')

	 ->leftJoin('package_features', 'packages.id', '=', 'package_features.package_id')

	 ->leftJoin('shiop_categories', 'packages.package_type', '=', 'shiop_categories.id')

	 ->leftJoin('fuel_types', 'packages.fuel', '=', 'fuel_types.id')

	 ->leftJoin('vehicle_types', 'packages.vehtype', '=', 'vehicle_types.id')

	 ->leftJoin('brand_models', 'packages.vehmodel', '=', 'brand_models.id')

    ->where('package_books.random_num',$random)

	->select('packages.*','package_features.feature','shiop_categories.category','fuel_types.fuel_type','brand_models.brand_model','vehicle_types.veh_type')

    ->get();

     

        if($package == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false, "data" => $package, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

 }

 

 public function shop_offers(Request $request){

	  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $image_uploded_status=$request->image_uploded_status;

  $tbloffers = new Tbl_shop_offers;

  if($image_uploded_status==1){

  

   if($files=$request->file('image')){  

    $name=$files->getClientOriginalName();  

    $files->move('img',$name);  

    $tbloffers->pic=$name;  

    } }else{

      

      $name=DB::table('shiop_categories')

      ->where('id',$request->shop_cat_id)

      ->first()->image;

    

      $tbloffers->pic=$name;

       

    }

  

  $tbloffers->shop_id=$request->shop_id;

  $tbloffers->shop_cat_id=$request->shop_cat_id;

  $tbloffers->title=$request->title;

  $tbloffers->small_desc=$request->small_desc;

  $tbloffers->normal_amount=$request->normal_amount;

  $tbloffers->offer_amount=$request->offer_amount;

  $tbloffers->offer_type=$request->offer_type;

   $tbloffers->vehicle_typeid=$request->vehicle_typeid;

   $tbloffers->brand_id=$request->brand_id;

    $tbloffers->model_id=$request->model_id;

   

  $tbloffers->offer_end_date=$request->offer_end_date; 

  if($tbloffers->save()){

    $shopofferid=$tbloffers->id;

    $shopoffer= new Shop_offer_models;

    $shopoffer->shop_id = $request->shop_id;

    $shopoffer->offer_id = $shopofferid;

    $shopoffer->vehicle_typeid = $request->vehicle_typeid;

    $shopoffer->brand_id = $request->brand_id;

    $shopoffer->model_id = $request->model_id;

    $shopoffer->fuel_type =$request->fuel_type;

    if($shopoffer->save()){

    $json_data = 1;

    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

  }else{

    echo json_encode(array('error' => true, "message" => "Error"));

  }

  } else{

    echo json_encode(array('error' => true, "message" => "Error"));

  }

 }



 public function shopoffer_list(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $offertype=$data1->offertype;

   $shopid=$data1->shopid;

  $offertypes=DB::table('tbl_shop_offers')



  ->leftJoin('shops', 'tbl_shop_offers.shop_id', '=', 'shops.id')	

   ->leftJoin('shiop_categories', 'tbl_shop_offers.shop_cat_id', '=', 'shiop_categories.id')	 

	 ->leftJoin('vehicle_types', 'tbl_shop_offers.vehicle_typeid', '=', 'vehicle_types.id')

   ->leftJoin('brand_models', 'tbl_shop_offers.model_id', '=', 'brand_models.id')

   ->leftJoin('brand_lists', 'tbl_shop_offers.brand_id', '=', 'brand_lists.id')

   ->select('tbl_shop_offers.*','shops.shopname','shiop_categories.category','brand_models.brand_model','brand_lists.brand','vehicle_types.veh_type as vehice_type_name')

   //->where('tbl_shop_offers.offer_type',$offertype)

   ->where('tbl_shop_offers.shop_id',$shopid)

   ->get();

   if($offertypes==null){

    echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

   }else{

    echo json_encode(array('error' => false, "data" => $offertypes, "message" => "Success"));

   }

}

public function bookingnotification($shops){

 

  



  $msg = array

  (

       "body" => "Customer booked your service.please check it",

       "title" => "Booking Alert",

       "sound" => "mySound"

  );

  

  $friendToken = [];

  



  $friendToken=DB::table('shops')

  ->select('shops.shop_device_tocken as device_token')

  ->where('id',$shops)

  ->get()

  ->toArray();



  //print_r($friendToken);exit;

  

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



public function updatecompletedstatus($cusid,$offeramount,$shopid){

 

  





  

  //echo $msg;exit;

  $friendToken = [];

  $friendToken=DB::table('user_lists')

  ->where('id',$cusid)

  ->select('user_lists.device_token')

  ->get()

  ->toArray();

  $shopname=DB::table('shops')->where('id',$shopid)->first();
  $shopnamee= $shopname->shopname;





    $msg = array

  (

       "body" => "Your vehicle work is complete, please make a payment of RS.".$offeramount,

       "title" => $shopnamee,

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

public function sob_time(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $timeslot=date("H:i:s", strtotime($data1->timeslot));

  $date=date('y-m-d');

  $datacheck=DB::table('booktimemasters')

  ->where('adate',$data1->bookdate)

  ->where('timeslots',$timeslot)

  ->where('shop_id',$data1->shopid)

  

  ->value('id');



 // print_r($datacheck);exit;

  $vehiclenumber=DB::table('user_vehicles')->where('user_id',$data1->customer_id)->where('vehicle_model',$data1->model_id)->first();

  if($vehiclenumber==null){

   $uservehid=0;

  }else{

    $uservehid=$vehiclenumber->id;

  }

  if($datacheck==null){

  $soAvailable= new Booktimemasters;

  $soAvailable->shop_id=$data1->shopid;

  $soAvailable->timeslots=date("H:i", strtotime($data1->timeslot));

  $soAvailable->adate=$data1->bookdate;

  if($data1->book_type==2){

    $offer=DB::table('tbl_shop_offers')->where('id',$data1->book_id)->first();

    if($offer->offer_discount_type==1){

      $soAvailable->totalamt_shop=$offer->offer_amount;

    }else{

      $percentage=$offer->discount_percentage;

      $normalamount=$offer->normal_amount;

      $peramt=($normalamount*$percentage)/100;

      $payamount=$normalamount-$peramt;

      $soAvailable->totalamt_shop=$payamount;

    }

  }else if($data1->book_type==4){

    $giveaway=DB::table('tbl_giveaways')->where('id',$data1->book_id)->first();

    $soAvailable->totalamt_shop=$giveaway->price;

  }else{

    $soAvailable->totalamt_shop=0;

  }

  $soAvailable->book_type=$data1->book_type;

   $soAvailable->customer_id=$data1->customer_id;

   $soAvailable->book_id=$data1->book_id;

   $soAvailable->shop_category_id=$data1->shop_category_id;

    $soAvailable->model_id=$data1->model_id;

    $soAvailable->user_vehid=$uservehid;

    $shops=$data1->shopid;

   

  if($soAvailable->save()){

   

    $json_data = 1;



    echo json_encode(array('error' => false, "data" => $soAvailable->id, "message" => "Success"));

    $this->bookingnotification($shops);

  }else{

    echo json_encode(array('error' => true, "message" => "Error"));

  }

}else{

  $json_data = 2;

  echo json_encode(array('error' => true, "data" => $json_data, "message" => "already added"));

}

}

public function bookstatusupdation(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $booktimemasterid=$data1->booktimemasterid;

  $updatestatus=Booktimemasters::find($booktimemasterid);

  $updatestatus->work_status=1;

  $updatestatus->totalamt_shop=$data1->totalamt_shop;

  $updatestatus->offeramt_shop=$data1->offeramt_shop;

  $cusid=$updatestatus->customer_id;

 

  //echo $cusid;exit;

  if($updatestatus->save()){

    $json_data = 1; 
    
    $offeramount=$data1->offeramt_shop;
    $shopid=$updatestatus->shop_id;

    $this->updatecompletedstatus($cusid,$offeramount,$shopid); 

    echo json_encode(array('error' => false, "data" => $json_data,"message" => "success"));

    

  }else{

    $json_data = 0;      

    echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

  }



}

public function bookstatusupdation_giveaway(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $booktimemasterid=$data1->booktimemasterid;

  $updatestatus=Booktimemasters::find($booktimemasterid);

  $updatestatus->work_status=1;

  //$updatestatus->totalamt_shop=$data1->totalamt_shop;

//  $updatestatus->offeramt_shop=$data1->offeramt_shop;

  $cusid=$updatestatus->customer_id;

 

  //echo $cusid;exit;

  if($updatestatus->save()){

    $json_data = 1;   
    
      $offeramount=$updatestatus->totalamt_shop;
    $shopid=$updatestatus->shop_id;

    $this->updatecompletedstatus($cusid,$offeramount,$shopid); 

    echo json_encode(array('error' => false, "data" => $json_data,"message" => "success"));

    

  }else{

    $json_data = 0;      

    echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

  }



}



public function updatepaystatus(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $booktimemasterid=$data1->booktimemasterid;

  $pay_type=$data1->pay_type;

  

  $updatestatus=Booktimemasters::find($booktimemasterid);

  $updatestatus->pay_status=1;

  if($updatestatus->save()){



    $shopbookingpay = new Shop_booking_payments;

    $shopbookingpay->pay_type=$pay_type;

    $shopbookingpay->booktimemaster_id=$booktimemasterid;

    if($shopbookingpay->save()){

    $json_data = 1;      

    echo json_encode(array('error' => false, "data" => $json_data,"message" => "success"));

  }else{

    $json_data = 0;      

    echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

  }

  }else{

    $json_data = 0;      

    echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

  }

}

public function paymentuncompletedcount(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

 $customerid=$data1->userid;

 try{	

   

  $uncomplitedlistcount=DB::table('booktimemasters')

  ->where('booktimemasters.pay_status',0)

                 ->where('booktimemasters.work_status',1)

                 ->where('booktimemasters.customer_id',$customerid)

                 ->where('book_type',1) 

 ->count();

   

            

          echo json_encode(array('error' => false, "data" => $uncomplitedlistcount, "message" => "Success"));

             



}

catch (Exception $e)

{

      

  //return Json("Sorry! Please check input parameters and values");

      echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

}



public function addshopbankdetails(){

  $postdata = file_get_contents("php://input");					



  $json = str_replace(array("\t","\n"), "", $postdata);



  $data1 = json_decode($json);



  $paymentdel=new Tbl_shopbankdetails;



  $paymentdel->shop_id=$data1->shop_id;



  $paymentdel->account_holdername=$data1->account_holdername;



  $paymentdel->bank=$data1->bank;



  $paymentdel->branch=$data1->branch;



  $paymentdel->ifsc=$data1->ifsc;



  $paymentdel->bankaccount=$data1->bankaccount;



 

  if($paymentdel->save()){



    $json_data = 1;      

    echo json_encode(array('error' => false, "data" => $json_data,"message" => "success"));



  }else{

    $json_data = 0;      

    echo json_encode(array('error' => true, "data" => $json_data,"message" => "error"));

  }



}

public function paymentuncompletedlist(){

	

	 $postdata 	= file_get_contents("php://input");					

	 $json 		= str_replace(array("\t","\n"), "", $postdata);

	 $data1 	= json_decode($json);

	 $customerid	=	$data1->userid;

	 try{	

	 

	   //WHEN booktimemasters.book_type = 3 THEN packages.amount

	   DB::enableQueryLog();

		  $uncomplitedlist = DB::table('booktimemasters')

								 ->leftJoin('shops', 'booktimemasters.shop_id', '=', 'shops.id')

                 ->where('booktimemasters.pay_status',0)

                 ->where('booktimemasters.work_status',1)

                 ->where('booktimemasters.customer_id',$customerid)

                 ->where('book_type',1)

               // ->select('booktimemasters.*','shops.shopname')

               

								 ->select(DB::raw('booktimemasters.*,shops.shopname,

								 (

									CASE 

										WHEN booktimemasters.book_type = 1 THEN packages.offer_amount

										WHEN booktimemasters.book_type = 2 THEN tbl_shop_offers.normal_amount

                    WHEN booktimemasters.book_type = 3 THEN pack.amount

                    

									ELSE 0

									END) AS amount

								 '))

								 ->leftJoin('packages', function($join)

									 {

										 $join->on('booktimemasters.book_id', '=', 'packages.id');

										 $join->on('booktimemasters.book_type', '=', DB::raw('1'));

										 

									 })

								->leftJoin('tbl_shop_offers', function($join)

									 {

										 $join->on('booktimemasters.book_id', '=', 'tbl_shop_offers.id');

										 $join->on('booktimemasters.book_type', '=', DB::raw('2'));

										 

                   })	 

                ->leftJoin(DB::raw('packages pack'), function($join)

									 {

										 $join->on('booktimemasters.book_id', '=', 'pack.id'); 

										 $join->on('booktimemasters.book_type', '=', DB::raw('3'));

										 

									 })

							->get();

   

          //print_r(DB::getQueryLog());exit;   

          echo json_encode(array('error' => false, "data" => $uncomplitedlist, "message" => "Success"));

             



		}

		catch (Exception $e)

		{

			  

		  //return Json("Sorry! Please check input parameters and values");

			  echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

		} 

}

public function completedpaylistcount(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

 $customerid=$data1->userid;

  try{	

   

    $complitedlistcount=DB::table('booktimemasters')

   ->where('pay_status',1)

   ->where('customer_id',$customerid)

	 ->count();

     

       		   

            echo json_encode(array('error' => false, "data" => $complitedlistcount, "message" => "Success"));

               

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

}

public function sob_timelist(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shop=$data1->shop;

  try{	

   

    $sobtimelist=DB::table('shop_timeslots')

	 ->where('shop_id',$shop)

	 ->get();

     

        if($sobtimelist == null){

          $json_data = 0;      

          echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

             }

            else{								

              

            echo json_encode(array('error' => false, "data" => $sobtimelist, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

}



public function package_features_list(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $package_id=$data1->package_id;

  try{	

   

    $sobtimelist=DB::table('package_features')

    ->leftJoin('features', 'package_features.feature', '=', 'features.id')

   ->where('package_features.package_id',$package_id)

   ->select('package_features.id as id','features.id as featurid','features.feature')

	 ->get();

     

        if($sobtimelist == null){

          $json_data = 0;      

          echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

             }

            else{								

              

            echo json_encode(array('error' => false, "data" => $sobtimelist, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

}





public function customer_booktimeslots(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

 $timeslot=$data1->timeslot;

  $date=date('y-m-d');

  $datacheck=DB::table('shopoffer_customer_bookings')

  ->where('date',$date)

  ->where('timeslot',$timeslot)

  ->value('id');

  if($datacheck==null){

  $cusbook= new Shopoffer_customer_bookings;

  $cusbook->customer_id=$data1->cusid;

  $cusbook->shop_id=$data1->shopid;

  $cusbook->timeslot=$data1->timeslot;

  $cusbook->date=date('y-m-d');

  $shop=$data1->shopid;

  if($cusbook->save()){

    $this->bookingnotification($shop);

    $json_data = 1;

    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

  }else{

    echo json_encode(array('error' => true, "message" => "Error"));

  }

}else{

  $json_data = 2;

  echo json_encode(array('error' => true, "data" => $json_data, "message" => "already added"));

}

}

public function customer_booktimeslotslist(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shop=$data1->shop;

  $book_type=$data1->book_type;  

   //$model_id=$data1->model_id;

  try{	

   if($book_type==0){

    $cbtime=DB::table('booktimemasters')

    ->leftJoin('user_lists', 'booktimemasters.customer_id', '=', 'user_lists.id')

	->leftJoin('brand_models', 'booktimemasters.model_id', '=', 'brand_models.id')

	->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')

	  ->leftJoin('fuel_types', 'brand_models.fuel_type', '=', 'fuel_types.id')

   ->where('shop_id',$shop)

   ->where('pay_status',0)



   ->orderBy('booktimemasters.id', 'DESC')

   ->select('booktimemasters.work_status','booktimemasters.adate','booktimemasters.pay_status','booktimemasters.id','booktimemasters.customer_id','booktimemasters.timeslots','user_lists.name','booktimemasters.book_type','booktimemasters.book_id','brand_lists.brand','brand_models.brand_model','fuel_types.fuel_type','user_lists.phnum')

	 ->get();  

   }else{

    $cbtime=DB::table('booktimemasters')

    ->leftJoin('user_lists', 'booktimemasters.customer_id', '=', 'user_lists.id')

	->leftJoin('brand_models', 'booktimemasters.model_id', '=', 'brand_models.id')

	->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')

	  ->leftJoin('fuel_types', 'brand_models.fuel_type', '=', 'fuel_types.id')

   ->where('shop_id',$shop)

   ->where('pay_status',0)

   ->where('book_type',$book_type)

   //->where('model_id',$model_id)

   ->orderBy('booktimemasters.id', 'DESC')

   ->select('booktimemasters.work_status','booktimemasters.adate','booktimemasters.pay_status','booktimemasters.id','booktimemasters.customer_id','booktimemasters.timeslots','user_lists.name','booktimemasters.book_type','booktimemasters.book_id','brand_lists.brand','brand_models.brand_model','fuel_types.fuel_type','user_lists.phnum')

	 ->get();

   }

  

     

        if($cbtime == null){

          $json_data = 0;      

          echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

             }

            else{								

              

            echo json_encode(array('error' => false, "data" => $cbtime, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

}



public function shopregpaymentupdate(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shop=$data1->shop;

  $transid=$data1->transid;

  $paystatus=$data1->paystatus;

  $UpdateDetails = Shops::where('id', '=', $shop)->first();

  $UpdateDetails->trans_id = $transid;

  $UpdateDetails->pay_status = $paystatus;

  if($UpdateDetails->save()){

    $json_data = 1;      

    echo json_encode(array('error' => false, "data" => $json_data,"message" => "Success"));

  }else{

    $json_data = 0;      

    echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

  }

}





public function booktypelist(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $booktype=$data1->booktype;

  $bookid=$data1->bookid;

  try{	

   if($booktype==1){

     

    $booktypelist=DB::table('packages')

    ->leftJoin('fuel_types', 'packages.fuel', '=', 'fuel_types.id')

  

    ->leftJoin('vehicle_types', 'packages.vehtype', '=', 'vehicle_types.id')

    ->leftJoin('brand_models', 'packages.vehmodel', '=', 'brand_models.id') 

   ->where('packages.id',$bookid)

   ->select('packages.*','fuel_types.fuel_type as fueltypename','vehicle_types.veh_type','brand_models.brand_model')

  ->get();

   

   }else if($booktype==2){

    $booktypelist=DB::table('booktimemasters')

    ->leftJoin('tbl_shop_offers', 'booktimemasters.book_id', '=', 'tbl_shop_offers.id')

    ->leftJoin('brand_models', 'booktimemasters.model_id', '=', 'brand_models.id')

    ->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')

    ->leftJoin('vehicle_types', 'brand_lists.vehicle', '=', 'vehicle_types.id')

    ->leftJoin('user_lists', 'booktimemasters.customer_id', '=', 'user_lists.id')

     ->where('booktimemasters.id',$bookid)

     ->select('tbl_shop_offers.*','booktimemasters.adate','booktimemasters.timeslots','brand_lists.brand','vehicle_types.veh_type','brand_models.brand_model','booktimemasters.work_status','user_lists.name as cusname','user_lists.phnum as cusphnum','booktimemasters.pay_status')

  ->get();

 

   }else if($booktype==3){

    $booktypelist=DB::table('booktimemasters')

    ->leftJoin('shop_services', 'booktimemasters.book_id', '=', 'shop_services.id')

    ->leftJoin('brand_models', 'booktimemasters.model_id', '=', 'brand_models.id')

    ->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')

    ->leftJoin('vehicle_types', 'brand_lists.vehicle', '=', 'vehicle_types.id')

    ->leftJoin('user_lists', 'booktimemasters.customer_id', '=', 'user_lists.id')

     ->where('booktimemasters.id',$bookid)

     ->select('shop_services.*','booktimemasters.adate','booktimemasters.timeslots','brand_lists.brand','vehicle_types.veh_type','brand_models.brand_model','booktimemasters.work_status','user_lists.name as cusname','user_lists.phnum as cusphnum','booktimemasters.pay_status')

  ->get();

  

   }else if($booktype==4){

    $booktypelist=DB::table('booktimemasters')

   ->leftJoin('tbl_giveaways', 'booktimemasters.book_id', '=', 'tbl_giveaways.id')

    ->leftJoin('vehicle_types', 'tbl_giveaways.vehicle_type', '=', 'vehicle_types.id')

    ->leftJoin('user_lists', 'booktimemasters.customer_id', '=', 'user_lists.id')

    //->leftJoin('brand_models', 'shop_services.vehicle_model_id', '=', 'brand_models.id')

     ->where('booktimemasters.id',$bookid)

     ->select('tbl_giveaways.*','booktimemasters.adate','booktimemasters.timeslots','booktimemasters.work_status','user_lists.name as cusname','user_lists.phnum as cusphnum','booktimemasters.pay_status')

  ->get(); 

  

   }

   

   

   else{

    $booktypelist = 0;      

   

   }

   echo json_encode(array('error' => false, "data" => $booktypelist, "message" => "Success"));

     

      

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

}



public function shop_services(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  foreach($data1->servicelist as $singlelist){	

    $checklist=DB::table('shop_services')

    ->where('shop_id',$singlelist->shopid)

   // ->where('shop_category',$singlelist->shopcat)

    ->where('vehicle_type_id',$singlelist->vehicle)

    ->where('vehicle_model_id',$singlelist->model)

   // ->where('vehicle_brand_id', $singlelist->brand)	

    ->first('id');

    $provide=DB::table('shop_provide_categories')->where('shop_id',$singlelist->shopid)->where('shop_cat_id',$singlelist->shopcat)->first();

    if($provide==null){

      $shopprovidcategory = new Shop_provide_categories();

      $shopprovidcategory->shop_id = $singlelist->shopid;

      $shopprovidcategory->shop_cat_id = $singlelist->shopcat;

      $shopprovidcategory->save();

      $shopcatpro=$shopprovidcategory->id;

    }else{

      $shopcatpro=$provide->id;

    }

    if($checklist==null){

    $service = new Shop_services();

    $service->shop_id = $singlelist->shopid;

    $service->shop_category = $singlelist->shopcat;

    $service->vehicle_type_id = $singlelist->vehicle;

    $service->vehicle_model_id = $singlelist->model;

    $service->vehicle_brand_id = $singlelist->brand;

    $service->shop_pro_cat_id =$shopcatpro;

    $service->save();

  }	

   

   

}

$json_data = 1;

echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

 }

 public function vmb_service_list(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  try{	

   

    $shop=$data1->shop;



    $shoplist=DB::table('shop_services')

    // ->leftJoin('shiop_categories', 'shop_services.shop_category', '=', 'shiop_categories.id')

    ->leftJoin('shops', 'shop_services.shop_id', '=', 'shops.id')
    
      ->leftJoin('brand_models', 'shop_services.vehicle_model_id', '=', 'brand_models.id')

    ->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')

    ->leftJoin('vehicle_types', 'brand_lists.vehicle', '=', 'vehicle_types.id')

  

    ->where('shop_services.shop_id',$shop)
    
     ->groupBy('brand_models.id')
     
     ->orderBy('shop_services.id', 'ASC')

   

    ->select('shop_services.*','shops.shopname','shops.shopname','vehicle_types.veh_type','vehicle_types.veh_type','brand_models.brand_model','brand_lists.brand')

     ->get();

    

        if($shoplist){

          $json_data = 0;

          echo json_encode(array('error' => false, "data" => $shoplist, "message" => "Success"));

        

             }

            else{								

              echo json_encode(array('error' => true, "message" => "Error"));

           }

    

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

 }

 public function packagebanner(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  

  try{	

   

    $bannerpackage=DB::table('banners')

	 ->where('banner_type',3)

	 ->get();

     

        if($bannerpackage == null){

          $json_data = 0;      

          echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

             }

            else{								

              

            echo json_encode(array('error' => false, "data" => $bannerpackage, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

 }

 public function addshoppackage(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  

  foreach($data1->packagelist as $singlelist){

    $package_check=DB::table('packages_shops')	

    ->where('pkg_shp_id',$singlelist->shopid)	

    ->where('pkg_id',$singlelist->pkid)

    ->value('id');

    if($package_check==null){

      $package = new Packages_shops();

      $package->pkg_shp_id = $singlelist->shopid;

      $package->pkg_id = $singlelist->pkid;

      $package->save();

    }			

   

     

}





  $json_data = 1;

  echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));





 }

 public function shoppackagelist(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  // $vehicle_type=$data1->vehicletype;

  // $brand=$data1->brand;

  $shopid=$data1->shopid;

  try{	

   

    $shopackage=DB::table('packages_shops')

    ->leftJoin('packages', 'packages_shops.pkg_id', '=', 'packages.id')

    ->leftJoin('brand_models', 'packages.vehmodel', '=', 'brand_models.id')

    ->leftJoin('brand_lists', 'brand_models.brand_model', '=', 'brand_lists.id')

    ->leftJoin('vehicle_types', 'packages.vehtype', '=', 'vehicle_types.id')

    ->leftJoin('fuel_types', 'packages.fuel', '=', 'fuel_types.id')

   ->where('packages_shops.pkg_shp_id',$shopid)

  

   ->select('packages.*','vehicle_types.veh_type','brand_lists.brand','fuel_types.fuel_type','packages_shops.id as rowid','brand_models.brand_model')

	 ->get();

     

        if($shopackage == null){

          $json_data = 0;      

          echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

             }

            else{								

              

            echo json_encode(array('error' => false, "data" => $shopackage, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

 }

 public function updatepayment(Request $request){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shopid=$data1->shopid;

  $transid=$data1->transid;

  $shop = Shops::where('id', '=',  $shopid)->first();

  $shop->trans_id = $transid;

  $shop->pay_status = $data1->paystatus; 

     

  if($shop->save())

  {

	 $json_data = 1;      

     echo json_encode(array('error' => false, "data" => $json_data,"message" => "Success")); 

  }else{

	  $json_data = 0;      

     echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error")); 

  }

 

  

 }

 public function product_offers(Request $request){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $poffers = new Product_offers;

   if($files=$request->file('image')){  

    $name=$files->getClientOriginalName();  

    $files->move('img',$name);  

    

    $poffers->product_picture=$name; 

    } 

    

  $poffers->shop_id=$request->shopid;

  $poffers->title=$request->title;

  $poffers->description=$request->description;

  $poffers->normal_amount=$request->normal;

  $poffers->discount_amount=$request->discount;

  $poffers->end_date=$request->enddate;

  $poffers->start_date=$request->start_date;

  $poffers->offer_type=2;

  $poffers->sale_status=0; 

  $title=$request->title;

  $desc=$request->description;

  if($poffers->save()){

   

    $json_data = 1;



    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

    //commnt by alwin 19sep2021
   // $this->sendNotificationcustomer($title,$desc);

   

  } else{

    echo json_encode(array('error' => true, "message" => "Error"));

  }

 }

 

 public function updatenddate(){

	$postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $offertype=$data1->offertype;

  $offerid =$data1->offerid;

  $enddate=$data1->endate;

  if($offertype==1){

	  if(DB::table('tbl_shop_offers')

            ->where('id', $offerid)

			 ->update(['offer_end_date' => $enddate])){

				 $json_data = 1;

    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

			 }else{

				 echo json_encode(array('error' => true, "message" => "Error"));

			 }

			 

  }else if($offertype==2){

	 if(DB::table('product_offers')

           ->where('id', $offerid)

		 ->update(['end_date' => $enddate])){

			  $json_data = 1;

    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

		 }else{

			echo json_encode(array('error' => true, "message" => "Error")); 

		 }

  }

  



 }

 

  public function shop_providecat(){

	 $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  foreach($data1->shopprovidcategory as $singlelist){	

    $check = DB::table('shop_provide_categories')

	->where('shop_id',$singlelist->shopid)

	->where('shop_cat_id',$singlelist->catid)

	->value('id');

	if($check==null){

    $shopprovidcategory = new Shop_provide_categories();

    $shopprovidcategory->shop_id = $singlelist->shopid;

    $shopprovidcategory->shop_cat_id = $singlelist->catid;

    $shopprovidcategory->save();

      } 

  }

     $json_data = 1;

      echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

 }

 public function shop_providecatlist(){

		$postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

 

  try{	

   

    $shopprvdcat=DB::table('shop_provide_categories')

    ->leftJoin('shops', 'shop_provide_categories.shop_id', '=', 'shops.id')

    ->leftJoin('shiop_categories', 'shop_provide_categories.shop_cat_id', '=', 'shiop_categories.id')

   ->select('shop_provide_categories.*','shops.shopname','shiop_categories.category')

	 ->get();

     

        if($shopprvdcat == null){

          $json_data = 0;      

          echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

             }

            else{								

              

            echo json_encode(array('error' => false, "data" => $shopprvdcat, "message" => "Success"));

                }

	}

	catch (Exception $e)

			{

					

				//return Json("Sorry! Please check input parameters and values");

					echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

			} 

	}

 public function storebanner(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $latitude=$data1->lat;

  $longitude=$data1->long; 

  $radius=50;//Range to be covered in kms

  



  try{	

   

    $banner=DB::table('product_offers')

    ->leftJoin('shops', 'product_offers.shop_id', '=', 'shops.id')

    ->select(DB::raw('product_offers.id,product_offers.title,product_offers.normal_amount,product_offers.discount_amount,product_offers.product_picture as banner_image,ROUND(cast(6371 * acos ( cos ( radians('.$latitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$latitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))

		//->havingRaw(DB::raw('distance < '.$radius))

	//	->orderByRaw('distance ASC')

		->get();

     

        if($banner == null){

          $json_data = 0;      

          echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

             }

            else{								

              

            echo json_encode(array('error' => false, "data" => $banner, "message" => "Success"));

                }

    

  

              }

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

}

public function storebanner_shop(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shop=$data1->shop_id;



  try{	

   

    $banner=DB::table('product_offers')

    ->leftJoin('shops', 'product_offers.shop_id', '=', 'shops.id')

   // ->where('shop_id',$shop)

    ->where('offer_type',2)

    ->select(DB::raw('product_offers.id,product_offers.title,product_offers.normal_amount,product_offers.discount_amount,product_offers.product_picture as banner_image'))

		->get();

     

        if($banner == null){

          $json_data = 0;      

          echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

             }

            else{								

              

            echo json_encode(array('error' => false, "data" => $banner, "message" => "Success"));

                }

    

  

              }

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

}

public function shop_providedpackagecount(){

    $postdata = file_get_contents("php://input");					

    $json = str_replace(array("\t","\n"), "", $postdata);

    $data1 = json_decode($json);

  //$catid=$data1->shocatid;

    $shopid=$data1->shopid;

  

       try{	

   

            $categorycount=DB::table('package_service_lists')

            ->leftJoin('shiop_categories', 'package_service_lists.service_id', '=', 'shiop_categories.id')

            ->leftJoin('shop_provide_categories', 'shiop_categories.id', '=', 'shop_provide_categories.shop_cat_id')

            ->where('shop_provide_categories.shop_id',$shopid)

           ->selectRaw('count(package_service_lists.package_id) as shopackagecount')

            ->get();



     

            if($categorycount == null){

                $json_data = 0;      

                 echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

                }

                else{								

              

                    echo json_encode(array('error' => false, "data" => $categorycount, "message" => "Success"));

                  }

    

  

              }

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

 

}

public function updateproductoffersale(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $productoffid=$data1->productoffid;

  $sale_status=$data1->sale_status;

  $sale=Product_offers::find($productoffid);

  $sale->sale_status=$sale_status;

  if($sale->save()){

    $json_data = 1;      

    echo json_encode(array('error' => false, "data" => $json_data,"message" => "success"));

  }else{

    $json_data = 0;      

    echo json_encode(array('error' => true, "data" => $json_data,"message" => "false"));

  }

}

public function mystorelist_shop(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

 $data1 = json_decode($json);

  try{	

    $scat=$data1->scat;

    //$utype=$data1->utype;

    if($scat==0){

      $storlist=DB::table('store_lists')

      ->leftJoin('store_product_categories', 'store_lists.store_prod_category', '=', 'store_product_categories.id')

      ->leftJoin('user_lists', 'store_lists.user_id', '=', 'user_lists.id')

      ->leftJoin('shops', 'store_lists.user_id', '=', 'shops.id')

    ->where('store_lists.sale_satus',0)

   // ->where('user_type',1)

    ->orderBy('store_lists.id', 'DESC')

		  ->select('store_lists.*','store_product_categories.cat_name','user_lists.name','user_lists.phnum','shops.shopname','shops.phone_number as shopnumber')

		  ->get();

       

          if($storlist){

            $json_data = 0;

            echo json_encode(array('error' => false, "data" => $storlist, "message" => "Success"));

          

               }

              else{								

                echo json_encode(array('error' => true, "message" => "Error"));

             }

    }else{

      $storlist=DB::table('store_lists')

      ->leftJoin('store_product_categories', 'store_lists.store_prod_category', '=', 'store_product_categories.id')

      ->leftJoin('user_lists', 'store_lists.user_id', '=', 'user_lists.id')

      ->leftJoin('shops', 'store_lists.user_id', '=', 'shops.id')

      ->where('store_lists.store_prod_category',$scat)

    ->where('store_lists.sale_satus',0)

    //->where('user_type',1)

      ->orderBy('store_lists.id', 'DESC')

    ->select('store_lists.*','store_product_categories.cat_name','user_lists.name','user_lists.phnum','shops.shopname','shops.phone_number as shopnumber')

     ->get();

       

          if($storlist){

            $json_data = 0;

            echo json_encode(array('error' => false, "data" => $storlist, "message" => "Success"));

          

               }

              else{								

                echo json_encode(array('error' => true, "message" => "Error"));

             }

    }



 

    

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 



}



public function mystorelist_shop_new(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

 $data1 = json_decode($json);

  try{	

   // $scat=$data1->scat;

    $shop_id=$data1->shop_id;

    

      $storlist=DB::table('store_lists')

      ->leftJoin('store_product_categories', 'store_lists.store_prod_category', '=', 'store_product_categories.id')

      ->leftJoin('user_lists', 'store_lists.user_id', '=', 'user_lists.id')

      ->leftJoin('shops', 'store_lists.user_id', '=', 'shops.id')

    ->where('store_lists.sale_satus',0)

    ->where('store_lists.user_id',$shop_id)

    ->where('store_lists.user_type',2)

    ->orderBy('store_lists.id', 'DESC')

		  ->select('store_lists.*','store_product_categories.cat_name','user_lists.name','user_lists.phnum','shops.shopname','shops.phone_number as shopnumber')

		  ->get();

       

          if($storlist){

            $json_data = 0;

            echo json_encode(array('error' => false, "data" => $storlist, "message" => "Success"));

          

               }

              else{								

                echo json_encode(array('error' => true, "message" => "Error"));

             }

  



 

    

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 



}

public function mystorelist_shopdata(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

 $data1 = json_decode($json);

  try{	

    $scat=$data1->scat;

   // $utype=$data1->utype;

    if($scat==0){

      $storlist=DB::table('store_lists')

      ->leftJoin('store_product_categories', 'store_lists.store_prod_category', '=', 'store_product_categories.id')

	    ->leftJoin('shops', 'store_lists.user_id', '=', 'shops.id')

    ->where('store_lists.sale_satus',0)

    ->where('user_type',2)

    ->orderBy('store_lists.id', 'DESC')

		  ->select('store_lists.*','store_product_categories.cat_name','shops.shopname','shops.phone_number')

		  ->get();

       

          if($storlist){

            $json_data = 0;

            echo json_encode(array('error' => false, "data" => $storlist, "message" => "Success"));

          

               }

              else{								

                echo json_encode(array('error' => true, "message" => "Error"));

             }

    }else{

      $storlist=DB::table('store_lists')

      ->leftJoin('store_product_categories', 'store_lists.store_prod_category', '=', 'store_product_categories.id')

      ->leftJoin('shops', 'store_lists.user_id', '=', 'shops.id')

      ->where('store_lists.store_prod_category',$scat)

      ->where('user_type',2)

	  ->where('store_lists.sale_satus',0)

      ->orderBy('store_lists.id', 'DESC')

    ->select('store_lists.*','store_product_categories.cat_name','shops.shopname','shops.phone_number')

     ->get();

       

          if($storlist){

            $json_data = 0;

            echo json_encode(array('error' => false, "data" => $storlist, "message" => "Success"));

          

               }

              else{								

                echo json_encode(array('error' => true, "message" => "Error"));

             }

    }



 

    

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

}

public function vehmfuel(){

	  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $model_id=$data1->model_id;

  

  try{	

   

	$vehmfuel=DB::table('brand_models')

	->leftJoin('fuel_types', 'brand_models.fuel_type', '=', 'fuel_types.id')

    ->where('brand_models.id',$model_id)

    ->select('brand_models.*','fuel_types.fuel_type','brand_models.fuel_type as fuel_type_id')

	->get();

  

     

        if($vehmfuel == null){

          $json_data = 0;      

          echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

             }

            else{								

              

            echo json_encode(array('error' => false, "data" => $vehmfuel, "message" => "Success"));

                }

    

  

              }

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

}

public function shopimage(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shopid=$data1->shopid;

  try{	

   

	$shopimage=DB::table('shops')

    ->where('id',$shopid)

    ->select('shops.image','shops.open_time','shops.close_time','shops.shopname','shops.address','shops.phone_number','shops.pincode','shops.description','shops.lattitude','shops.logitude','shops.id')

	->get();

  

     

        if($shopimage == null){

          $json_data = 0;      

          echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

             }

            else{								

              

            echo json_encode(array('error' => false, "data" => $shopimage, "message" => "Success"));

                }

    

  

              }

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}



}

public function shopcostatus(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $id=$data1->shopid;

   $shop =Shops::find($id);

  $shop->shop_oc_status = $data1->status;

  if($shop->save()){

    $json_data = 1; 

    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

  }else{

    $json_data = 0;      

    echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

  }

}

public function shopservicedit(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $id=$data1->serviceid;

  $shopser=Shop_services::find($id);

  $shopser->shop_category = $data1->shopcatid;

  $shopser->vehicle_type_id = $data1->vehicletypeid;

  $shopser->vehicle_model_id = $data1->modelid;

  $shopser->vehicle_brand_id = $data1->brandid;

  if($shopser->save()){

    $json_data = 1; 

    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

  }else{

    $json_data = 0;      

    echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

  }



}

public function shopreviews(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shopid=$data1->shopid;

  try{	

   

    $reviews=DB::table('reviews')

    ->leftJoin('user_lists', 'reviews.user_id', '=', 'user_lists.id')

    ->where('shop_id',$shopid)

    ->select('reviews.*','user_lists.name')

   ->get();



     

        if($reviews == null){

          $json_data = 0;      

          echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

             }

            else{								

              

            echo json_encode(array('error' => false, "data" => $reviews, "message" => "Success"));

                }

    

  

              }

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}



}

public function suggcompinsert(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $sc= new Tbl_sugg_complaints;

  $sc->shopid=$data1->shopid;

  $sc->suggestion=$data1->suggestion;

  $sc->complaint=$data1->complaint;

  if($sc->save()){

    $json_data = 1; 

    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

  }else{

    $json_data = 0;      

    echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

  }

}

public function tclist(){

  try{	

   

    $tc=DB::table('tbl_terms_conditions')

   ->get();



     

        if($tc == null){

          $json_data = 0;      

          echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

             }

            else{								

              

            echo json_encode(array('error' => false, "data" => $tc, "message" => "Success"));

                }

    

  

              }

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

}



public function shoplist(){

	 $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shop = $data1->shopid;

  try{	

   

    $shcat=DB::table('shops')

	->where('id',$shop)

   ->get();



     

        if($shcat == null){

          $json_data = 0;      

          echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

             }

            else{								

              

            echo json_encode(array('error' => false, "data" => $shcat, "message" => "Success"));

                }

    

  

              }

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

}

public function addshoptimeslot(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  foreach($data1->timeslot as $singlelist){

    $checklist=DB::table('shop_timeslots')

    ->where('shop_id',$singlelist->shopid)	

    ->where('timeslot', $singlelist->timeslot)	

    ->first('id');	

    if($checklist==null){	

    $stimeslot = new Shop_timeslots();

    $stimeslot->shop_id = $singlelist->shopid;

    $stimeslot->timeslot = $singlelist->timeslot;

    $stimeslot->save(); 

  }

}

$json_data = 1;

echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

}



public function timeslot_list(){

	 $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shop = $data1->shopid;

  try{	

   

    $shcat=DB::table('shop_timeslots')

	->where('shop_id',$shop)

	 ->select('shop_timeslots.id','shop_timeslots.shop_id','shop_timeslots.timeslot')

   ->get();



     

        if($shcat == null){

          $json_data = 0;      

          echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

             }

            else{								

              

            echo json_encode(array('error' => false, "data" => $shcat, "message" => "Success"));

                }

    

  

              }

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

}

public function timeslot_delete(Request $request){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $timeslotid = $data1->timeslotid;

  if(DB::table('shop_timeslots')->where('id', $timeslotid)->delete()){

    $json_data = 1;      

    echo json_encode(array('error' => false, "data" => $json_data,"message" => "success"));

  }else{

    $json_data = 0;      

    echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

  }

}



public function shopcatlist(){

	 $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shop = $data1->shopid;

  try{	

   

    $shcat=DB::table('shop_provide_categories')

	->leftJoin('shiop_categories', 'shop_provide_categories.shop_cat_id', '=', 'shiop_categories.id')

	->where('shop_id',$shop)

	 ->select('shiop_categories.id','shiop_categories.category','shiop_categories.roadmate_percentage','shop_provide_categories.id as shopdeleteid')

	 ->get();



     

        if($shcat == null){

          $json_data = 0;      

          echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

             }

            else{								

              

            echo json_encode(array('error' => false, "data" => $shcat, "message" => "Success"));

                }

    

  

              }

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

}



public function shoplistnew(){

	

		  $postdata = file_get_contents("php://input");					

		  $json = str_replace(array("\t","\n"), "", $postdata);

		  $data1 = json_decode($json);

      $vehicle_type=$data1->vehtype;

		  try{	

		   

			   //Start 

				$brand_list = DB::table('brand_lists')

                ->select('brand AS brand_name','id AS brand_id')

                ->where('vehicle',$vehicle_type)

								->get()

								->toArray();

				$brand_list=json_decode(json_encode($brand_list, true),true);

					

				$final_brand_model_list = array();	

				$i=0;

				

				foreach($brand_list as $brand){

					

					$final_brand_model_list[$i] = $brand;

					

					$brand_model_list	=	DB::table('brand_models')

												->where('brand',$brand['brand_id'])

												->select('brand_model AS model_name','id AS model_id','brand AS brand_id')

												->get();

												

					$brand_model_list	=	json_decode(json_encode($brand_model_list, true),true);

					$final_brand_model_list[$i]['models']  = $brand_model_list;

					$i++;

				}

			   //End

		   

		   

		   

				if($final_brand_model_list == null){

					$json_data = 0;      

					echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

				}

				else{								

					  

					echo json_encode(array('error' => false, "brand_model_list" => $final_brand_model_list, "message" => "Success"));

				}

			

		  

			}

			catch (Exception $e)

			{

					

				//return Json("Sorry! Please check input parameters and values");

					echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

			} 

	}

// 	public function packagefulllist(Request $request){

// 		$postdata = file_get_contents("php://input");					

//   $json = str_replace(array("\t","\n"), "", $postdata);

//   $data1 = json_decode($json);

// //  $shop=$data1->shopid;

//   try{	

   

//     $shopackage=DB::table('packages_shops')

//     ->leftJoin('packages', 'packages_shops.pkg_id', '=', 'packages.id')

//     ->leftJoin('brand_models', 'packages.vehmodel', '=', 'brand_models.id')

//     ->leftJoin('brand_lists', 'brand_models.brand_model', '=', 'brand_lists.id')

//     ->leftJoin('vehicle_types', 'packages.vehtype', '=', 'vehicle_types.id')

//     ->leftJoin('fuel_types', 'packages.fuel', '=', 'fuel_types.id')

//     // ->where('packages_shops.pkg_shp_id',$shop)

//    ->select('packages.*','vehicle_types.veh_type','brand_lists.brand','fuel_types.fuel_type')

// 	 ->get();

     

//         if($shopackage == null){

//           $json_data = 0;      

//           echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

//              }

//             else{								

              

//             echo json_encode(array('error' => false, "data" => $shopackage, "message" => "Success"));

//                 }

// 	}

// 	catch (Exception $e)

// 			{

					

// 				//return Json("Sorry! Please check input parameters and values");

// 					echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

// 			} 

//   }

  

  public function packagefulllist(Request $request){

		$postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shop=$data1->shopid;

 //echo $shop;

 //exit; 

  try{	

  

    $shopackage=DB::table('packages')

   

    ->leftJoin('brand_models', 'packages.vehmodel', '=', 'brand_models.id')

    

    ->leftJoin('brand_lists', 'brand_models.brand_model', '=', 'brand_lists.id')

    ->leftJoin('vehicle_types', 'packages.vehtype', '=', 'vehicle_types.id')

    ->leftJoin('fuel_types', 'packages.fuel', '=', 'fuel_types.id')

    ->leftJoin('shop_provide_categories', 'packages.shop_category_id', '=', 'shop_provide_categories.shop_cat_id')

  

    ->where('shop_provide_categories.shop_id',$shop)

   ->select('packages.*','vehicle_types.veh_type','brand_lists.brand','fuel_types.fuel_type','brand_models.brand_model')

   ->get();

  



     

        if($shopackage == null){

          $json_data = 0;      

          echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

             }

            else{								

              

            echo json_encode(array('error' => false, "data" => $shopackage, "message" => "Success"));

                }

	}

	catch (Exception $e)

			{

					

				//return Json("Sorry! Please check input parameters and values");

					echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

			} 

	}

	public function vehalltypeserviceadd(){

	$postdata = file_get_contents("php://input");					

	$json = str_replace(array("\t","\n"), "", $postdata);

	$data1 = json_decode($json);

	$shop=$data1->shopid;

	$shopcat=$data1->shopcat;

	$vehicle=$data1->vehicle;

	

	//start

	$list = DB::table('brand_models')

			->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')

			->where('brand_lists.vehicle',$vehicle)

			->select('brand_lists.vehicle as vehicle_type','brand_models.id AS model_id','brand_models.brand AS brand_id')

			->get();

    $data=[];
    $data_new=[];

	foreach($list as $value){

		


		$check=DB::table('shop_services')

				 ->where([

							['vehicle_type_id', '=', $vehicle],

							['vehicle_model_id', '=', $value->model_id],

							['shop_id', '=', $shop]
						])

				 ->exists();
				 
		

		if(!$check)	{ 
		    
		  

      $provide=DB::table('shop_provide_categories')->where('shop_id',$shop)->where('shop_cat_id',$shopcat)->first();

      if($provide==null){

        $shopprovidcategory = new Shop_provide_categories();

        $shopprovidcategory->shop_id = $shop;

        $shopprovidcategory->shop_cat_id = $shopcat;

        $shopprovidcategory->save();

        $shopcatpro=$shopprovidcategory->id;

      }else{

        $shopcatpro=$provide->id;

      }

			
		

     $data[] = [
    'shop_id' => $shop,
    'shop_category' => $shopcat,
    'vehicle_type_id' => $vehicle,
    'vehicle_model_id' =>$value->model_id,
    'vehicle_brand_id' =>$value->brand_id,
    'shop_pro_cat_id'=>$shopcatpro,
    'created_at' => now(),
    'updated_at' => now(),
  ];

		}

	

	}
	
	Shop_services::insert($data);



	

	 $json_data = 1;      

     echo json_encode(array('error' => false, "data" => $json_data,"message" => "success"));

  }

  public function shopackagexists(){

    $postdata = file_get_contents("php://input");					

    $json = str_replace(array("\t","\n"), "", $postdata);

    $data1 = json_decode($json);

    $shop = $data1->shopid;

    try{	

     

      $shpackage=DB::table('packages_shops')

       ->where('pkg_shp_id',$shop)

        ->first('id');

      

       

          if($shpackage == null){

            $json_data = 0;      

            echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

               }

              else{								

                $json_data = 1;     

              echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

                  }

      

    

                }

  catch (Exception $e)

  {

          

      //return Json("Sorry! Please check input parameters and values");

          echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

  } 

  }

  public function shopfcmupdate(){

    $postdata = file_get_contents("php://input");					

    $json = str_replace(array("\t","\n"), "", $postdata);

    $data1 = json_decode($json);

    $shopid=$data1->shopid;

    $fcmid=$data1->fcmid;

    $UpdateDetails = Shops::where('id', '=',  $shopid)->first();

          $UpdateDetails->shop_device_tocken = $fcmid;

          if($UpdateDetails->save()){

            $json_data = 1;

            echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

          }else{

            $json_data = 0;

            echo json_encode(array('error' => true, "data" => $json_data, "message" => "false"));

          }

  }

  public function shopofferlist(){

    $postdata = file_get_contents("php://input");					

    $json = str_replace(array("\t","\n"), "", $postdata);

    $data1 = json_decode($json);

   

    try{	

     

      $shopoffers=DB::table('tbl_shop_offers')

      ->leftJoin('shops', 'tbl_shop_offers.shop_id', '=', 'shops.id')

      ->leftJoin('shiop_categories', 'tbl_shop_offers.shop_cat_id', '=', 'shiop_categories.id')

      ->leftJoin('brand_models', 'tbl_shop_offers.model_id', '=', 'brand_models.id')

          ->leftJoin('brand_lists', 'tbl_shop_offers.brand_id', '=', 'brand_lists.id')

          ->leftJoin('vehicle_types', 'tbl_shop_offers.vehicle_typeid', '=', 'vehicle_types.id')

          ->select('tbl_shop_offers.*','shops.shopname','shiop_categories.category','vehicle_types.veh_type','brand_models.brand_model','brand_lists.brand')

          ->get();

      

      

       

          if($shopoffers == null){

            $json_data = 0;      

            echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

               }

              else{								

                $json_data = 1;     

              echo json_encode(array('error' => false, "data" => $shopoffers, "message" => "Success"));

                  }

      

    

                }

  catch (Exception $e)

  {

          

      //return Json("Sorry! Please check input parameters and values");

          echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

  } 

  }



  function sendNotificationcustomer($title,$desc)

  {

    //echo $msg;exit;

      $friendToken = [];

    $friendToken=DB::table('user_lists')

    ->select('user_lists.device_token')

    ->get()

    ->toArray();

  

    $msg = array

      (

           "body" => $desc,

           "title" => $title,

           "sound" => "mySound"

      );

    

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





  public function shopoffer_new(Request $request){

    $postdata = file_get_contents("php://input");					

   $json = str_replace(array("\t","\n"), "", $postdata);

   $data1 = json_decode($json);
   
 

  $imageservice=Shiop_categories::where('id',$data1->shop_cat_id)->first();



   $sc= new Tbl_shop_offers;

  $sc->shop_id=$data1->shop_id; 

  $sc->shop_cat_id=$data1->shop_cat_id;

  $sc->title=$data1->title;

  $sc->small_desc=$data1->small_desc;

  $sc->normal_amount=$data1->normal_amount;

  $sc->offer_amount=$data1->offer_amount;

  $sc->vehicle_typeid=$data1->vehicle_typeid;

  $sc->brand_id=$data1->brand_id;

  $sc->model_id=$data1->model_id;

  $sc->offer_type=$data1->offer_type; 

  $sc->offer_discount_type=$data1->offer_discount_type;   

  $sc->discount_percentage=$data1->discount_percentage;  

  $sc->offer_start_date=$data1->offer_start_date;

  $sc->offer_end_date=$data1->offer_end_date;

  $sc->pic=$imageservice->image;

  $sc->category_percentage=$data1->cat_percentage;

    $title=$data1->title;

    $desc=$data1->small_desc;

      // $sc->pic=$name;

 

  if($sc->save()){
      
      

    
     if(empty($data1->status)){
        
			foreach($data1->shopoffermodel as $singlelist){	

      $datacheck=DB::table('shop_offer_models')

      ->where('shop_id',$singlelist->shopid)

      ->where('offer_id',$sc->id)

      ->where('vehicle_typeid',$singlelist->vehicletype)

      ->where('brand_id',$singlelist->brand)

      ->where('model_id',$singlelist->model)


      ->value('id');	

     

      if($datacheck==null){

      $shopoffermodel = new Shop_offer_models();

      $shopoffermodel->shop_id = $singlelist->shopid;

      $shopoffermodel->offer_id = $sc->id;

      $shopoffermodel->vehicle_typeid = $singlelist->vehicletype;

      $shopoffermodel->brand_id	 = $singlelist->brand;

      $shopoffermodel->model_id = $singlelist->model;

      $shopoffermodel->fuel_type = $singlelist->fuel_type;

      $shopoffermodel->save();

     }	

     

         }
       
    }else{
        
          $json_data = 1;     

          $offerid=$sc->id;

         echo json_encode(array('error' => false, "data" => $json_data,"offerid"=>$offerid, "message" => "Success"));
       
     
			
// 			$list = Brand_models::query()
// 				        ->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')
// 				        ->where('brand_lists.vehicle',$data1->vehicle_typeid)
//                         ->select('brand_lists.vehicle as vehicle_type','brand_models.id AS model_id','brand_models.brand AS brand_id')

// 			            ->get();
			            
// $data=[];
// foreach($list as $listnew) {
   
//      $data[] = [
//     'shop_id' => $data1->shop_id,
//     'offer_id' => $sc->id,
//     'vehicle_typeid' => $listnew->vehicle_type,
//     'brand_id' => $listnew->brand_id,
//     'model_id' => $listnew->model_id,
//     'fuel_type' =>0,
//     'created_at' => now(),
//     'updated_at' => now(),
//   ];

// }
// Shop_offer_models::insert($data);
			
			
		
    

    }

    

        


  }else{

    $json_data = 0;      

    echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

  }   

      

 } 





  public function shopoffer_models(){

    $postdata = file_get_contents("php://input");					

   $json = str_replace(array("\t","\n"), "", $postdata);

   $data1 = json_decode($json);



   foreach($data1->shopoffermodel as $singlelist){	

     $datacheck=DB::table('shop_offer_models')

     ->where('shop_id',$singlelist->shopid)

     ->where('offer_id',$singlelist->offerid)

     ->where('vehicle_typeid',$singlelist->vehicletype)

     ->where('brand_id',$singlelist->brand)

     ->where('model_id',$singlelist->model)

     ->where('fuel_type',$singlelist->fuel_type)

     ->value('id');	

    

     if($datacheck==null){

      $shopoffermodel = new Shop_offer_models();

      $shopoffermodel->shop_id = $singlelist->shopid;

      $shopoffermodel->offer_id = $singlelist->offerid;

      $shopoffermodel->vehicle_typeid = $singlelist->vehicletype;

      $shopoffermodel->brand_id	 = $singlelist->brand;

      $shopoffermodel->model_id = $singlelist->model;

      $shopoffermodel->fuel_type = $singlelist->fuel_type;

      $shopoffermodel->save();

    }	

    

        }

       

        $json_data = 1;     

        echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

      

 } 

 public function shopnotificationlist(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $userid=$data1->userid;

  try{	

     

    $notificationindividal=DB::table('tbl_notification_historys')

    ->where('user_type',1)

    ->where('user_id',$userid)

    ->get()

    ->toArray();

    

    $notificationall=DB::table('tbl_notification_historys')

    ->where('user_type',1)

    ->where('allorindividual',1)

    ->get()

    ->toArray();

   

    $notification = array_merge($notificationindividal, $notificationall); 

   

    

     

        if($notification == null){

          $json_data = 0;      

          echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

             }

            else{								

              $json_data = 1;     

            echo json_encode(array('error' => false, "data" => $notification, "message" => "Success"));

                }

    

  

              }

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

 }

 public function editshop(Request $request){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shopid=$request->shopid;

  $shop =Shops::find($shopid);

  $img_status=$request->img_status;

  if($img_status==1){

if($files=$request->file('image')){  	  

    $name=$files->getClientOriginalName();  

    $files->move('img/',$name);  

    $shop->image=$name;

}

  }



  $shop->open_time=$request->opentime;

  $shop->close_time=$request->closetime;

  $shop->shopname=$request->shopname;

  $shop->address=$request->address;

  $shop->phone_number=$request->phonenumber;

  $shop->pincode=$request->pincode;

  $shop->description=$request->description;

  $shop->lattitude=$request->lattitude;

  $shop->logitude=$request->logitude;

 if($shop->save()){

  $json_data = 1;      

  echo json_encode(array('error' => false, "data" => $json_data,"message" => "success"));

 }else{

  $json_data = 0;      

  echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

 }

   

 }

 public function shopprovidedatdelete(){

	   $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $id=$data1->shpcatid;

  if(DB::table('shop_provide_categories')->where('id', $id)->delete()){

	 $json_data = 1;      

  echo json_encode(array('error' => false, "data" => $json_data,"message" => "success")); 

  }else{

	   $json_data = 0;      

  echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

  }

 }



 public function shopprovidepackagedelete(){

    $postdata = file_get_contents("php://input");					

    $json = str_replace(array("\t","\n"), "", $postdata);

    $data1 = json_decode($json);

    $id=$data1->id;

    if(DB::table('packages_shops')->where('id', $id)->delete()){

    $json_data = 1;      

    echo json_encode(array('error' => false, "data" => $json_data,"message" => "success")); 

    }else{

    $json_data = 0;      

    echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

    }

}



 public function productofferdetails(){

	  $postdata = file_get_contents("php://input");					

    $json = str_replace(array("\t","\n"), "", $postdata);

    $data1 = json_decode($json);

    $id=$data1->id;

    try{	

     

      $productofferdetaillist=DB::table('product_offers')

     ->where('product_offers.id',$id)

	 ->leftJoin('shops', 'product_offers.shop_id', '=', 'shops.id')

          ->select('product_offers.*','shops.shopname','shops.phone_number')

          ->get();

      

      

       

          if($productofferdetaillist == null){

            $json_data = 0;      

            echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

               }

              else{								

                $json_data = 1;     

              echo json_encode(array('error' => false, "data" => $productofferdetaillist, "message" => "Success"));

                  }

      

    

                }

  catch (Exception $e)

  {

          

      //return Json("Sorry! Please check input parameters and values");

          echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

  } 

 }

 public function shopgcmupdate(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shopid=$data1->shopid;

  $fcmid=$data1->fcmid;

  $UpdateDetails = Shops::where('id', '=',  $shopid)->first();

        $UpdateDetails->shop_device_tocken = $fcmid;

        if($UpdateDetails->save()){

          $json_data = 1;

          echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

        }else{

          $json_data = 0;

          echo json_encode(array('error' => true, "data" => $json_data, "message" => "false"));

        }



}



//alwin new services 25-july-2021



public function shop_services_delete(Request $request){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $serviceid = $data1->service_id;

  if(DB::table('shop_services')->where('id', $serviceid)->delete()){

    $json_data = 1;      

    echo json_encode(array('error' => false, "data" => $json_data,"message" => "success"));

  }else{

    $json_data = 0;      

    echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error")); 

  }

}



//ALWIN ADDEDSERVICES 29-JULY-2021

public function product_offersshop(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shop=$data1->shop_id;



  try{	

   

    $banner=DB::table('product_offers')

    ->leftJoin('shops', 'product_offers.shop_id', '=', 'shops.id')

    ->where('shop_id',$shop)

    ->where('offer_type',2)

    ->select(DB::raw('product_offers.id,product_offers.title,product_offers.normal_amount,product_offers.discount_amount,product_offers.product_picture as banner_image'))

		->get();

     

        if($banner == null){

          $json_data = 0;      

          echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

             }

            else{								

              

            echo json_encode(array('error' => false, "data" => $banner, "message" => "Success"));

                }

    

  

              }

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

}



public function shop_offerdetails(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $id=$data1->id;

  try{	

   

    $shopofferdetaillist=DB::table('tbl_shop_offers')

   ->where('tbl_shop_offers.id',$id)

 ->leftJoin('shops', 'tbl_shop_offers.shop_id', '=', 'shops.id')

        ->select('tbl_shop_offers.*','shops.shopname')

        ->get();

    

    

     

        if($shopofferdetaillist == null){

          $json_data = 0;      

          echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

             }

            else{								

              $json_data = 1;     

            echo json_encode(array('error' => false, "data" => $shopofferdetaillist, "message" => "Success"));

                }

    

  

              }

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

}



public function shop_current_oc(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $id=$data1->shopid;

  $status=DB::table('shops')->where('id',$id)->select('shops.shop_oc_status')->first();

  if($status == null){

    $json_data = 0;      

    echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

       }

      else{								

        $json_data = 1;     

      echo json_encode(array('error' => false, "data" => $status, "message" => "Success"));

          }

}
public function bulkupdate(){
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

 $shop_id=$data1->shop_id;

  foreach($data1->servicelist as $singlelist){

    

    $method=$singlelist->method;// vehicle or offer
    $type=$singlelist->type; // vehicle / brand
    $vehtype=$singlelist->vehtype;
    $brand=$singlelist->brand;
    $offer_id=$singlelist->offer_id;
    
    $check=DB::table('tbl_bulkdatas')
    ->where('method',$method)
    ->where('type',$type)
    ->where('type',$vehtype)
    ->where('brand',$brand)
    ->where('offer_id',$offer_id)
    ->where('shop_id',$shop_id)->first();
    
    
    if(!$check){
        $new =new Tbl_bulkdatas;
    $new->method = $method;
    $new->type   =$type;
    $new->vehtype=$vehtype;
    $new->brand=$brand;
    $new->offer_id=$offer_id;
    $new->shop_id=$shop_id;
    $new->save();  
    }
   

  


  }

  $json_data = 1;     

  echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

}
public function bulkdataupload(){
  $mybulkdata=DB::table('tbl_bulkdatas')->get();
  
  foreach($mybulkdata as $key){
     
   if($key->method==1){

     if($key->type==1){

      $list = DB::table('brand_models')

			->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')

			->where('brand_lists.vehicle',$key->vehtype)

			->select('brand_lists.vehicle as vehicle_type','brand_models.id AS model_id','brand_models.brand AS brand_id')
			
			->orderBy('brand_models.id', 'ASC')

			->get();
			

			
		  $data=[];
      

	    foreach($list as $value){
	        
	        
	   
    $check=DB::table('shop_services')
    ->where('shop_id',$key->shop_id)
    ->where('vehicle_model_id',$value->model_id)->first();
    
    if(!$check){
         $data[] = [
        'shop_id' => $key->shop_id,
        'vehicle_model_id' =>$value->model_id
       
      ];
  
    }
   

	

	}
	
	Shop_services::insert($data);

		

      
	

     }else if($key->type==2){

      $list = DB::table('brand_models')

			->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')

			->where('brand_lists.vehicle',$key->vehtype)

      
			->where('brand_lists.id',$key->brand)

			->select('brand_lists.vehicle as vehicle_type','brand_models.id AS model_id','brand_models.brand AS brand_id')

			->get();

        $data=[];
     

	    foreach($list as $value){

		



	   
    $check=DB::table('shop_services')
    ->where('shop_id',$key->shop_id)
    ->where('vehicle_model_id',$value->model_id)->first();
    
    if(!$check){
         $data[] = [
        'shop_id' => $key->shop_id,
        'vehicle_model_id' =>$value->model_id
       
      ];
  
    }
   
	

	

	}
	
	Shop_services::insert($data);

     }


   }else if($key->method==2){
       if($key->type==1){
            			$list = Brand_models::query()
				        ->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')
				        ->where('brand_lists.vehicle',$key->vehtype)
                        ->select('brand_lists.vehicle as vehicle_type','brand_models.id AS model_id','brand_models.brand AS brand_id')

			            ->get();
			            
$data=[];
foreach($list as $listnew) {
   
     $data[] = [
    'shop_id' => $key->shop_id,
    'offer_id' => $key->offer_id,
    'vehicle_typeid' => $listnew->vehicle_type,
    'brand_id' => $listnew->brand_id,
    'model_id' => $listnew->model_id,
    'fuel_type' =>0
  ];

}
Shop_offer_models::insert($data);
       }else if($key->type==2){
            			$list = Brand_models::query()
				        ->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')
				        ->where('brand_lists.vehicle',$key->vehtype)
				         ->where('brand_lists.id',$key->brand)
                        ->select('brand_lists.vehicle as vehicle_type','brand_models.id AS model_id','brand_models.brand AS brand_id')

			            ->get();
			            
$data=[];
foreach($list as $listnew) {
   
     $data[] = [
    'shop_id' => $key->shop_id,
    'offer_id' => $key->offer_id,
    'vehicle_typeid' => $listnew->vehicle_type,
    'brand_id' => $listnew->brand_id,
    'model_id' => $listnew->model_id,
    'fuel_type' =>0,
    'created_at' => now(),
    'updated_at' => now(),
  ];

}
Shop_offer_models::insert($data);
       }
    

   }
    DB::table('tbl_bulkdatas')->where('id',$key->id)->delete();
  }
}
public function testrun(){
      $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

 

    
DB::table('shop_services AS s1')
    ->join('shop_services AS s2', function($join) {
        $join->on('s1.shop_id', '=', 's2.shop_id')
            ->on('s1.vehicle_model_id', '=', 's2.vehicle_model_id')
            ->where('s1.id', '>', 's2.id');
    })
    ->delete();


}
}