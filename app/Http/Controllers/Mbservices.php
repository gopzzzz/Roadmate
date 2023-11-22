<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;



use App\User;



use App\Shops;



use Auth;



use DB;



use App\User_lists;



use App\packages_shop;



use App\Vehicle_types;



use App\User_vehicles;



use App\Post_querys;



use App\Shiop_categories;



use App\Store_lists;



use App\Reviews;



use App\Shop_services;



use App\Mystorequerys;



use App\Storequery_answers;



use App\Package_books;



use App\Wallets;



use App\Wallet_debitorcredit_his;



use App\Booktimemasters;



use App\Shop_booking_payments;



use App\Review_offers;



use App\Tbl_default_vehs;







class Mbservices extends Controller

{

    public function list(){

       

        try{	

            $data=User::all();

              echo json_encode(array('error' => false, "data" => $data, "message" => "Success"));

                exit();

                

                    if($data == null){

                        $json_data = 0;

                        //echo $json_data;

                        echo json_encode(array('error' => false, "data" => $data, "message" => "Success"));

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



public function mobilenotification($msg){

		

					$data=DB::table('user_lists')

					->select('user_lists.device_token')

					->get()

					->toArray();

					

		

					foreach($data as $field){

					

					$ff[]=$field->device_token;	

					print_r($ff); 					

					}

					if(empty($ff)){

				

						echo "is empty";

					}

					else{  

					

					

	

    define( 'API_ACCESS_KEY', 'AAAALcAJIGo:APA91bE19OVa4q934aQNj7NR-o653sdLzUDj-7HAuCLLxOPREHU3Yv75VcVnbI58gKgkUewBvwu4uyTxN0KcklAlweB1VPv0HDjuwMViM9cDOa4OEgVwYM7mp2vxdRhig8jTcngdwox2' );

			

				

				$fields = array

				(

		

			'registration_ids' => $ff,

			'notification'=>$msg

				);

	

	

				$headers = array

				(

				'Authorization: key='.API_ACCESS_KEY,

				'Content-Type: application/json'

				);

				

				print_r($headers);

					

					$ch = curl_init();

					curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );

					curl_setopt( $ch,CURLOPT_POST, true );

					curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );

					curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );

					curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );

					curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );

					$result = curl_exec($ch );

					curl_close( $ch );

			

				print_r($result);

			}

}

    public function shop(Request $request){

      $shop= new Shops;

       $shop->shop_name=$request->shopname;

       if($shop->save()){

        $json_data = 1;

        echo $json_data;

       }

       else{			

        $json_data = 0;

        echo $json_data;

    }

    }

//Gopika New

    public function searchshop(Request $request){

      $postdata = file_get_contents("php://input");					

      $json = str_replace(array("\t","\n"), "", $postdata);

      $data1 = json_decode($json);

      $shop = $data1->shopname;

      $latitude=$data1->latitude;

      $longitude=$data1->longitude;

      try{	

       

        $shopslist=DB::table('shops')

        ->leftJoin('reviews', 'shops.id', '=', 'reviews.shop_id')

        

        ->where('shopname', 'like', '%' . $shop . '%')

      

        ->select(DB::raw('shops.*, ROUND(cast(6371 * acos ( cos ( radians('.$latitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$latitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))
        
     ->groupBy('shops.id')

        

        ->get();



        $shopsearch=array();



        foreach($shopslist as $shops){

           $reviewcount=DB::table('reviews')

           ->where('shop_id',$shops->id)

           ->select(DB::raw('count(reviews.id) as reviewcount,ROUND(avg(reviews.review_count)) AS rateaverage'))

           ->first();



           $data = array(

             'id' => $shops->id,

             'type' => $shops->type,

             'image' => $shops->image,

             'open_time'=> $shops->open_time,

             'close_time'=> $shops->close_time,

             'shopname'=> $shops->shopname,

             'address'=> $shops->address,

             'status'=> $shops->status,

             'phone_number'=> $shops->phone_number,

             'phone_number2'=> $shops->phone_number2,

             'agrimentverification_status'=> $shops->agrimentverification_status,

             'pincode'=> $shops->pincode,

             'description'=> $shops->description,

             'lattitude'=> $shops->lattitude,

             'logitude'=> $shops->logitude,

             'trans_id'=> $shops->trans_id,

             'otp'=> $shops->otp,

             'pay_status'=> $shops->pay_status,

             'shop_oc_status'=> $shops->shop_oc_status,

             'exeid'=> $shops->exeid,

             'authorised_status'=> $shops->authorised_status,

             'shop_device_tocken'=> $shops->shop_device_tocken,

             'created_at'=> $shops->created_at,

             'updated_at'=> $shops->updated_at,

             'distance'=> $shops->distance,

             'reviewcount'=>$reviewcount->reviewcount,

             'rateaverage'=>$reviewcount->rateaverage);

           //echo "<pre>";print_r($reviewcount);

           array_push($shopsearch,$data);

        }

        

            if($shopsearch == null){

              $json_data = 0;      

              echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

                 }

                else{								

                  

                echo json_encode(array('error' => false, "data" => $shopsearch, "message" => "Success"));

                    }

        

      

                  }

    catch (Exception $e)

    {

            

        //return Json("Sorry! Please check input parameters and values");

            echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

    } 

  

    }

    //endGopika 

    public function insert_exe1(Request $request){

		  

        $postdata = file_get_contents("php://input");					

          $json = str_replace(array("\t","\n"), "", $postdata);

           $data1 = json_decode($json);

          $data2=$data1->stock_list;

          //$pro_stock_prodid_d=$data2[0]->pro_stock_prodid_d;

          print_r($data2[1]->pro_stock_prodid_d);

   

  }

  public function insert_exe(Request $request){

		  

    $postdata = file_get_contents("php://input");					

      $json = str_replace(array("\t","\n"), "", $postdata);

       $data1 = json_decode($json);

      //$data2=$data1->stock_list;

      //$count=count($data2);

      

      //$pro_stock_prodid_d=$data2[0]->pro_stock_prodid_d;

     

      foreach($data1->stock_list as $singlelist){					

        $shipment_detail = new shops();

        $shipment_detail->shop_name = $singlelist->pro_stock_prodid_d;

       

        $shipment_detail->save();

       

}



}



public function updatepaystatuscustomer(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);



  foreach($data1->paymentcustomer as $singlelist){	



    $booktimemasterid=$singlelist->booktimemasterid;

    $pay_type=$singlelist->pay_type;

    $transid=$singlelist->transid;



	$debited_purpose="Booking";



    $updatestatus=Booktimemasters::find($booktimemasterid);

    $updatestatus->pay_status=1;

    if($updatestatus->save()){

	  $userid=$updatestatus->customer_id;

	  

	  $package=$updatestatus->book_id;

      $cusbookingpay = new Shop_booking_payments;

      $cusbookingpay->pay_type=$pay_type;

      $cusbookingpay->trans_id=$transid;

      $cusbookingpay->booktimemaster_id=$booktimemasterid;

	

      $cusbookingpay->save();



    }

  

   

}

$json_data = 1;

//echo $json_data;

echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));







}



public function cuslogin(Request $request){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

   $data1 = json_decode($json);

   $mob=$data1->mobnum;
   
  

  // $data=User::all();
  $mobilecheck=DB::table('user_lists')
    ->where('phnum',$mob)
   ->where('status',1)
   ->value('id');
 if($mobilecheck==null){

    echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

   }else{

	   if($mob==6282930014){

      
      $otp=5252;

      $authKey =  env('AUTH_KEY',"");

     // $sms="{$otp} is your Roadmate verification code. Please DO NOT share this OTP with anyone to ensure account security";

     // $otp=$otp;

     $this->sendsmsotp($otp,$mob);

      echo json_encode(array('error' => false, "data" => $otp, "message" => "Success"));


     $affectedRows = User_lists::where('phnum',$mob)->update(array('otp' => $otp));

     }else{

       $otp=rand(1000, 9999);
      
    // $otp=5252;

      $authKey =  env('AUTH_KEY',"");

     // $sms="{$otp} is your Roadmate verification code. Please DO NOT share this OTP with anyone to ensure account security";

     // $otp=$otp;

     $this->sendsmsotp($otp,$mob);
      echo json_encode(array('error' => false, "data" => $otp, "message" => "Success"));

     $affectedRows = User_lists::where('phnum',$mob)->update(array('otp' => $otp));


     }
    	//	sendSMS($mob, $mess,$otp);

   }

}

public function sendsms($sms,$mob){



  echo json_encode(array('error' => false, "data" => $sms, "message" => "Success"));

  //print_r($sms);



}

public function newsendOTP(Request $request){ //For testing purpose only



      $postdata   = file_get_contents("php://input");					

      $json       = str_replace(array("\t","\n"), "", $postdata);

      $data       = json_decode($json);

      $mobile     = $data->mobile_number; //including coutry code eg: 91xxxxxxxxxxx



      $response = $this->sendsmsotp('1234',$mobile);



      if($response['status'] == 'success'){//success



          $otp = $response['otp'];

          echo json_encode(array('error' => false, "data" => $otp, "message" => "Success"));



      }

      else{//failure



        echo json_encode(array('error' => true, "data" => '', "message" => "Failure"));



      }



}

public function sendjavascriptotp(){
echo '<script type="text/JavaScript"> 
     prompt("GeeksForGeeks");
     </script>'
;
}


public function sendsmsotp($otp,$mob){



    $curl = curl_init();



    $authkey        =   '293880AKkOsHqp5f830090P1';

   

    $email          =   'alwinespylabs@gmail.com';

    // $template_id    =   '5f8c62b94b50c6314a2570c7';
    // $template_id    =   '5fc9d192733e90375b65746f';
    // $template_id    =   '628c8138a9738e16e764f1a3';
      $template_id    =   '64cb55efd6fc05417a720692';
    
   //  $template_id    =   '62ed034ed6fc0515b55c0fe4';

  //  $otp            =   rand(1000,9999);

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

                                'email' => $email,

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





public function sendsmsotp_jango($otp,$mob){  



  $curl = curl_init();



  $authkey        =   '346099A3m8C6NgNS5f9f90beP1';

 

  $email          =   'alwinespylabs@gmail.com';

  // $template_id    =   '5fa0253a3d7eb230895e458b';
  $template_id    =   '5fc9d192733e90375b65746f';

  $otp            =   rand(1000,9999);

  $url            =   "https://api.msg91.com/api/v5/otp?";





  $params             =   array(

                              'extra_param' => '{"section":"login"}',

                              'unicode' => 0,

                              'authkey' => $authkey,

                              'template_id' => $template_id,

                              'mobile' => $mob,

                              'invisible' => 0,

                              'otp' => $otp,

                              'email' => $email,

                              'otp_length' => 4,

                              'company_name' => 'JANGO ONLINE' 

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



public function otpcheck(Request $request){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $otp=$data1->otp;

  $phnum=$data1->phnum;

  $otpcheck=DB::table('user_lists')

   ->where('otp',$otp)

   ->where('phnum',$phnum)

   ->select('user_lists.id','user_lists.sex','user_lists.status','user_lists.name','user_lists.phnum','user_lists.otp','user_lists.created_at','user_lists.updated_at')

   ->get();

   if($otpcheck==null){

    echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

   }else{

	  // $msg = array

		//		(

		//		'body'       => "Login succesfully",

		//		'title'         => "Roadmate"

		//		);  

	//  $this->mobilenotification($msg);

    echo json_encode(array('error' => false, "data" => $otpcheck, "message" => "Success"));

   }

}

 public function customer_registration(Request $request){



  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

   $data1 = json_decode($json);

  // print_r($data1->name);exit;

  $checkphnum=DB::table('user_lists')->where('phnum',$data1->phone)->first();

  if($checkphnum==null){

    $cusreg = new User_lists;

    $cusreg->name = $data1->name;

    $cusreg->phnum = $data1->phone;

    if($cusreg->save()){

     $wallet= new Wallets;

     $wallet->user_id=$cusreg->id;

     $wallet->amount_credited=500;

     if($wallet->save()){

     $mob=$data1->phone;

     $otp=rand(1000, 9999);

     $authKey =  env('AUTH_KEY',"");

    // $sms="{$otp} is your Roadmate verification code. Please DO NOT share this OTP with anyone to ensure account security";

     

     $sms=$otp;
     
     //$sms=5252;

     

     $this->sendsmsotp($sms,$mob);

   

     $affectedRows = User_lists::where('phnum',$mob)->update(array('otp' => $otp));

   

      echo	json_encode(array('error' => false,'data'=>$otp, "message" => "Success"));

   

   }

   

    }else{

     echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

    }

  }else{

    echo	json_encode(array('error' => true, "message" => "already regsitered"));

  }



 }



 public function vetype(){



  try{	

    //$vehtype=Vehicle_types::all();

    $vehtype=DB::table('vehicle_types')

    ->select('vehicle_types.id','vehicle_types.veh_type','vehicle_types.veh_img')

    ->get();

      echo json_encode(array('error' => false, "data" => $vehtype, "message" => "Success"));

        exit();

        

            if($data == null){

                $json_data = 0;

                //echo $json_data;

                echo json_encode(array('error' => false, "data" => $vehtype, "message" => "Success"));

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

 public function brand(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

   $data1 = json_decode($json);

  



   try{	

    //$vehtype=Vehicle_types::all();

  $vehtype=$data1->vehtype;

  //echo $vehtype;exit;

   $brand=DB::table('brand_lists')

   ->where('vehicle',$vehtype)

   ->select('brand_lists.id','brand_lists.brand')

   ->get();

      echo json_encode(array('error' => false, "data" => $brand, "message" => "Success"));

        exit();

        

            if($data == null){

                $json_data = 0;

                //echo $json_data;

                echo json_encode(array('error' => false, "data" => $brand, "message" => "Success"));

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

 public function model(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

   $data1 = json_decode($json);

  



   try{	

    //$vehtype=Vehicle_types::all();

  $brand=$data1->brand;

  //echo $vehtype;exit;

   $model=DB::table('brand_models')

   ->where('brand',$brand)

   ->select('brand_models.id','brand_models.brand_model as model')

   ->get();

      echo json_encode(array('error' => false, "data" => $model, "message" => "Success"));

        exit();

        

            if($data == null){

                $json_data = 0;

                //echo $json_data;

                echo json_encode(array('error' => false, "data" => $model, "message" => "Success"));

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

 public function packagefeaturelist(Request $request){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

   $data1 = json_decode($json);

  



   try{

    //$vehtype=Vehicle_types::all();

  $package_id=$data1->packageid;

  //echo $vehtype;exit;

   $packagefeature=DB::table('package_features')

   ->leftJoin('features', 'package_features.feature', '=', 'features.id')

   ->where('package_features.package_id',$package_id)

   //->groupBy('package_features.package_id')

   ->select('features.id','features.feature')

   ->get();

     

      

        

            if($packagefeature != null){

                $json_data = 0;

                //echo $json_data;

                echo json_encode(array('error' => false, "data" => $packagefeature, "message" => "Success"));

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

 public function fuel_type(){



  try{	

    //$vehtype=Vehicle_types::all();

    $fuel=DB::table('fuel_types')

    ->select('fuel_types.id','fuel_types.fuel_type')

    ->get();

      echo json_encode(array('error' => false, "data" => $fuel, "message" => "Success"));

        exit();

        

            if($data == null){

                $json_data = 0;

                //echo $json_data;

                echo json_encode(array('error' => false, "data" => $fuel, "message" => "Success"));

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

 public function user_vehicles(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $vehnum=$data1->veh_number;

  $check=DB::table('user_vehicles')

  ->where('vehicle_number',$vehnum)

  ->value('id');

  if($check==null){

  $uveh = new User_vehicles;

  $uveh->user_id=$data1->userid;

  $uveh->vehicle_number=$data1->veh_number;

  $uveh->vehicle_type=$data1->veh_type;

  $uveh->vehicle_brand=$data1->veh_brand;

  $uveh->vehicle_model=$data1->veh_model;

  $uveh->fuel_type=$data1->fuel_type;

  if($uveh->save()){

    $lastid=$uveh->id;

    echo json_encode(array('error' => false, "data" =>  $lastid, "message" => "Success"));

  }else{

   echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

  }

 

}else{

  echo	json_encode(array('error' => true, "message" => "Sorry! Already inserted"));

}

}

public function wallet(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $user=$data1->user_id;

  try{	

   

    $wallet=DB::table('wallets')

    ->select('wallets.user_id','wallets.amount_credited')

    ->where('user_id',$user)

    ->get();

     

        if($wallet == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false, "data" => $wallet, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

  

 }

 public function banner(){

 

  try{	

   

    $banner=DB::table('banners')

    ->select('banners.banner_image')

	->where('banner_type',1)

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

 public function post_querys(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  date_default_timezone_set("Asia/Kolkata"); # add your city to set local time zone

  $now = date('Y-m-d H:i:s');

  $query=new Mystorequerys;

  $query->question=$data1->Post_querys;

   $query->quserid=$data1->userid;

   $query->created_at=$now;

  if($query->save()){

    $last=$query->id;

    echo json_encode(array('error' => false, "data" => $last, "message" => "Success"));

  }else{

    echo json_encode(array('error' => true, "message" => "Error"));

  }

 }

 public function shop_categories(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  try{	

    $shcat=DB::table('shiop_categories')

        ->select('shiop_categories.category','shiop_categories.image','shiop_categories.id')

        ->orderBy('order_number', 'ASC')

        ->get();

     

        if($shcat){

           $json_data = 0;

          echo json_encode(array('error' => false, "data" => $shcat, "message" => "Success"));

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

 public function shopcat_limited(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  try{	

    $shcat=DB::table('shiop_categories')

        ->select('shiop_categories.category','shiop_categories.image','shiop_categories.id')

        ->limit(4)

        ->get();

     

        if($shcat){

           $json_data = 0;

          echo json_encode(array('error' => false, "data" => $shcat, "message" => "Success"));

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



 public function shops(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  try{	

  

		$shcat=$data1->shcat;

		$latitude=$data1->lat;

		$longitude=$data1->long; 

		$radius=5000;//Range to be covered in kms

		

		//DB::enableQueryLog();



    $shoplist=DB::table('shops')

    ->leftJoin('reviews', 'shops.id', '=', 'reviews.shop_id')

    ->leftJoin('shop_provide_categories', 'shops.id', '=', 'shop_provide_categories.shop_id')

		->select(DB::raw('shops.*, ROUND(cast(6371 * acos ( cos ( radians('.$latitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$latitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))

		->where('shop_provide_categories.shop_cat_id',$shcat) 		

		->havingRaw(DB::raw('distance < '.$radius))

    ->orderByRaw('distance ASC')

      ->groupBy('shops.id')

		->get();



    foreach($shoplist as $shops){
        
     

      $reviewcount=DB::table('reviews')

      ->where('shop_id',$shops->id)

      ->select(DB::raw('count(reviews.id) as reviewcount,ROUND(avg(reviews.review_count)) AS rateaverage'))

      ->first();



       $data = array(

         'id' => $shops->id,

         'type' => $shops->type,

         'image' => $shops->image,

         'open_time'=> $shops->open_time,

         'close_time'=> $shops->close_time,

         'shopname'=> $shops->shopname,

         'address'=> $shops->address,

         'status'=> $shops->status,

         'phone_number'=> $shops->phone_number,

         'phone_number2'=> $shops->phone_number2,

         'agrimentverification_status'=> $shops->agrimentverification_status,

         'pincode'=> $shops->pincode,

         'description'=> $shops->description,

         'lattitude'=> $shops->lattitude,

         'logitude'=> $shops->logitude,

         'trans_id'=> $shops->trans_id,

         'otp'=> $shops->otp,

         'pay_status'=> $shops->pay_status,

         'shop_oc_status'=> $shops->shop_oc_status,

         'exeid'=> $shops->exeid,

         'authorised_status'=> $shops->authorised_status,

         'shop_device_tocken'=> $shops->shop_device_tocken,

         'created_at'=> $shops->created_at,

         'updated_at'=> $shops->updated_at,

         'distance'=> $shops->distance,

         'reviewcount'=>$reviewcount->reviewcount,

         'rateaverage'=>$reviewcount->rateaverage
         );

      

       array_push($shop,$data);

    }
   


        if($shop==null){

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

              $json_data = 0;

              echo json_encode(array('error' => false, "data" => $shop, "message" => "Success"));

           }

    

	}

	catch (Exception $e)

	{

			

		//return Json("Sorry! Please check input parameters and values");

			echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

	} 

 

  

 }

 public function storelistinsert(Request $request){

 // $postdata = file_get_contents("php://input");					

 // $json = str_replace(array("\t","\n"), "", $postdata);

 // $data1 = json_decode($json);

 // $image1=$data1->image1;

 // $image2=$data1->image2;

 // $image3=$data1->image3;



  $storelist= new Store_lists;  

  if($files=$request->file('image1')){  

    $name=$files->getClientOriginalName();  

    $files->move('img',$name);  

    

    $storelist->image_1=$name; 

    } 

    if($files1=$request->file('image2')){  

      $name2=$files1->getClientOriginalName();  

      $files1->move('img',$name2);  

      

      $storelist->image_2=$name2; 

      }  

      if($files3=$request->file('image3')){  

        $name3=$files3->getClientOriginalName();  

        $files3->move('img',$name3);  

        

        $storelist->image_3=$name3; 

        } 

        $storelist->user_type=$request->usertype;      

  $storelist->user_id=$request->userid;

  $storelist->product_name=$request->pro_name;

  $storelist->price=$request->price;

  $storelist->store_prod_category=$request->category;

  $storelist->description=$request->description;

  if($storelist->save()){

    $json_data = 1;

    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

  } else{

    echo json_encode(array('error' => true, "message" => "Error"));

  }

  

 }

 public function store_product_categslist(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

 // $data1 = json_decode($json);

  try{	

    //$shcat=$data1->shcat;



    $pcat=DB::table('store_product_categories')

    ->select('store_product_categories.cat_name','store_product_categories.id')

    ->get();

     

        if($pcat){

          $json_data = 0;

          echo json_encode(array('error' => false, "data" => $pcat, "message" => "Success"));

         

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

 public function mystorelist(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

 $data1 = json_decode($json);

  try{	

    $scat=$data1->scat;

   // $utype=$data1->utype;

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

 public function app_version(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

 $data1 = json_decode($json);

  try{	

    $apptype=$data1->apptype;



    $appversion=DB::table('app_versions')

  

	  ->where('app_type',$apptype)

   

    ->get();

     

        if($appversion){

          $json_data = 0;

          echo json_encode(array('error' => false, "data" => $appversion, "message" => "Success"));

        

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

 public function mystorelistuser(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

 $data1 = json_decode($json);

  try{	

    $uid=$data1->userid;



    $storlist=DB::table('store_lists')

    ->leftJoin('store_product_categories', 'store_lists.store_prod_category', '=', 'store_product_categories.id')

	->leftJoin('user_lists', 'store_lists.user_id', '=', 'user_lists.id')

  // ->leftJoin('user_lists', 'store_lists.user_id', '=', 'user_lists.id')

    ->where('store_lists.user_id',$uid)

	->where('store_lists.sale_satus',0)

    ->select('store_lists.*','store_product_categories.cat_name','user_lists.name','user_lists.phnum')

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

 public function singlestorelist(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

 $data1 = json_decode($json);

  try{	

    $product=$data1->productid;



    $storlist=DB::table('store_lists')

    ->leftJoin('store_product_categories', 'store_lists.store_prod_category', '=', 'store_product_categories.id')

    ->leftJoin('user_lists', 'store_lists.user_id', '=', 'user_lists.id')

    ->leftJoin('shops', 'store_lists.user_id', '=', 'shops.id')

    ->where('store_lists.id',$product)

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

 public function updatesalestatus(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

 $data1 = json_decode($json);

 $store_id=$data1->storeid;

 $store=Store_lists::find($store_id);

 $store->sale_satus=1;

 if($store->save()){

  $json_data = 1;

  echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

 }else{

  $json_data = 1;

  echo json_encode(array('error' => true, "data" => $json_data, "message" => "error"));

 }

 }

 public function cancelbooking(){
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

 $data1 = json_decode($json);

 $bookid=$data1->bookid;

 $bookupdate=Booktimemasters::find($bookid);

 $bookupdate->work_status=2;

 if($bookupdate->save()){

  $json_data = 1;

  echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

 }else{

  $json_data = 1;

  echo json_encode(array('error' => true, "data" => $json_data, "message" => "error"));

 }

 }

 public function shopslist(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  try{	

    $shop=$data1->shopid;

    $lattitude=$data1->lat;

   $longitude=$data1->long;





    $shoplistnew=DB::table('shops')

   

    ->where('id',$shop)

    ->select(DB::raw('shops.*,ROUND(cast(6371 * acos ( cos ( radians('.$lattitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$lattitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))

        

     ->get();



    $shoplist=array();



     foreach($shoplistnew as $shops){

        $reviewcount=DB::table('reviews')

        ->where('shop_id',$shops->id)

        ->select(DB::raw('count(reviews.id) as reviewcount,ROUND(avg(reviews.review_count)) AS rateaverage'))

        ->first();



        $data = array(

          'id' => $shops->id,

          'type' => $shops->type,

          'image' => $shops->image,

          'open_time'=> $shops->open_time,

          'close_time'=> $shops->close_time,

          'shopname'=> $shops->shopname,

          'address'=> $shops->address,

          'status'=> $shops->status,

          'phone_number'=> $shops->phone_number,

          'phone_number2'=> $shops->phone_number2,

          'agrimentverification_status'=> $shops->agrimentverification_status,

          'pincode'=> $shops->pincode,

          'description'=> $shops->description,

          'lattitude'=> $shops->lattitude,

          'logitude'=> $shops->logitude,

          'trans_id'=> $shops->trans_id,

          'otp'=> $shops->otp,

          'pay_status'=> $shops->pay_status,

          'shop_oc_status'=> $shops->shop_oc_status,

          'exeid'=> $shops->exeid,

          'authorised_status'=> $shops->authorised_status,

          'shop_device_tocken'=> $shops->shop_device_tocken,

          'created_at'=> $shops->created_at,

          'updated_at'=> $shops->updated_at,

          'distance'=> $shops->distance,

          'reviewcount'=>$reviewcount->reviewcount,

          'rateaverage'=>$reviewcount->rateaverage);

        //echo "<pre>";print_r($reviewcount);

        array_push($shoplist,$data);

     }

     

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

 public function singlemystore(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  try{	

    $store=$data1->storeid;



    $storelist=DB::table('store_lists')

    //->leftJoin('store_product_categories', 'store_lists.store_prod_category', '=', 'store_product_categories.id')

    ->where('id',$store)

     ->get();

     

        if($storelist){

          $json_data = 0;

          echo json_encode(array('error' => false, "data" => $storelist, "message" => "Success"));

        

             }

            else{								

              echo json_encode(array('error' => true, "message" => "Error"));

           }

    

}

catch (Exception $e)

{

      echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}



 }



 public function review(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $review= new Reviews;

  $review->user_id=$data1->userid;

  $review->shop_id=$data1->shop;

  $review->comment=$data1->comment;

  $review->review_count=$data1->review;

  if($review->save()){

    $json_data = 1;

    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

  }else{

    echo json_encode(array('error' => true, "message" => "Error"));

  }

 }



 public function reviews_offer(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $review_offer= new Review_offers;

  $review_offer->user_id=$data1->userid;

  $review_offer->shop_id=$data1->shop;

  $review_offer->offer_id=$data1->offerid;

  $review_offer->comment=$data1->comment;

  $review_offer->review_count=$data1->review;

  if($review_offer->save()){

    $json_data = 1;

    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

  }else{

    echo json_encode(array('error' => true, "message" => "Error"));

  }

 }



 public function reviewlist(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  try{	

    $shop=$data1->shop;



    $shoplist=DB::table('reviews')

    ->leftJoin('user_lists', 'reviews.user_id', '=', 'user_lists.id')

    ->where('reviews.shop_id',$shop)

     ->get();

	 

	 $reviewcount=DB::table('reviews')

    ->where('shop_id',$shop)

     ->avg('review_count');

	 

     

        if($shoplist){

          $json_data = 0;

          echo json_encode(array('error' => false, "data" => $shoplist,"dataavg"=>$reviewcount,"message" => "Success"));

        

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

 public function myboking_count(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  try{	

    $userid=$data1->userid;



    // $shoplist=DB::table('reviews')

    // ->leftJoin('user_lists', 'reviews.user_id', '=', 'user_lists.id')

    // ->where('reviews.shop_id',$shop)

    //  ->get();

	 

	 $totalbooking=DB::table('booktimemasters')

    ->where('customer_id',$userid)

    ->where('work_status','!=',2)

     ->count('id');

	 

     

        if($totalbooking){

          $json_data = 0;

          echo json_encode(array('error' => false, "data" => $totalbooking,"message" => "Success"));

        

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





 public function offers_reviewlist(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  try{	

    $shopid=$data1->shop;

    $offerid=$data1->offerid;



    $offer_shoplist=DB::table('review_offers')

    ->leftJoin('user_lists', 'review_offers.user_id', '=', 'user_lists.id')

    ->where('review_offers.offer_id',$offerid)

    ->select('review_offers.*','user_lists.name')

     ->get();

	 

	 $reviewcount=DB::table('review_offers')

    ->where('review_offers.offer_id',$offerid)

     ->avg('review_count');

	 

     

        if($offer_shoplist){

          $json_data = 0;

          echo json_encode(array('error' => false, "data" => $offer_shoplist,"dataavg"=>$reviewcount,"message" => "Success"));

        

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



 public function reviewavg(){

	  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  try{	

    $shop=$data1->shop;



    $reviewcount=DB::table('reviews')

    ->where('shop_id',$shop)

     ->avg('review_count');

     

        if($reviewcount){

          $json_data = 0;

          echo json_encode(array('error' => false, "data" => $reviewcount, "message" => "Success"));

        

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



 public function shop_serviceslist(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  try{	

    $shop=$data1->shop;



    $shoplist=DB::table('shop_provide_categories')

    ->leftJoin('shiop_categories', 'shop_provide_categories.shop_cat_id', '=', 'shiop_categories.id')

    ->leftJoin('shops', 'shop_provide_categories.shop_id', '=', 'shops.id')

    ->select('shop_provide_categories.shop_id','shop_provide_categories.shop_cat_id','shiop_categories.category','shops.shopname')

    ->where('shop_provide_categories.shop_id',$shop)

   // ->groupBy('shop_services.shop_id')

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

 public function vehicleuserlist(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  try{	

    $user=$data1->userid;



    $vehicle=DB::table('user_vehicles')

    ->leftJoin('vehicle_types', 'user_vehicles.vehicle_type', '=', 'vehicle_types.id')

    ->leftJoin('brand_lists', 'user_vehicles.vehicle_brand', '=', 'brand_lists.id')

    ->leftJoin('brand_models', 'user_vehicles.vehicle_model', '=', 'brand_models.id')

    ->leftJoin('fuel_types', 'user_vehicles.fuel_type', '=', 'fuel_types.id')

    ->select('user_vehicles.*','vehicle_types.veh_type','vehicle_types.veh_img','brand_lists.brand','brand_models.brand_model','fuel_types.fuel_type')

    ->where('user_vehicles.user_id',$user)

     ->get();

     

        if($vehicle){

          $json_data = 0;

          echo json_encode(array('error' => false, "data" => $vehicle, "message" => "Success"));

         }

            else{								

              echo json_encode(array('error' => true, "message" => "Error"));

           }

    

}

catch (Exception $e)

{

         echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

 }

 public function storequeryinsert(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $store=new Mystorequerys;

  $store->question=$data1->question;

  $store->quserid=$data1->quserid;

  if($store->save()){

    $json_data = 1;

    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

  }else{

    echo json_encode(array('error' => true, "message" => "Error"));

  }

 }

 public function storanswer(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $question=$data1->questionid;

  $answers = new Storequery_answers;

  $answers->question_id=$question;

  $answers->answer=$data1->answer;

  $answers->anuserid=$data1->anusid;

  if($answers->save()){

    $json_data = 1;

    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

  }else{

    echo json_encode(array('error' => true, "message" => "Error"));

  }

 }

 public function answercount(){

	$postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  //$question=$data1->questionid;

   

   $answercount=Storequery_answers::select('storequery_answers.* ')

    ->groupBy('storequery_answers.question_id')

    ->get()

    ->count();

  if($answercount){

    $json_data = 1;

    echo json_encode(array('error' => false, "data" => $answercount, "message" => "Success"));

  }else{

    echo json_encode(array('error' => true, "message" => "Error"));

  } 

 }

 public function queanswer(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  

  try{	

    //$user=$data1->userid;

    $question=$data1->questionid;

    $queanswer=DB::table('mystorequerys')

    ->leftJoin('storequery_answers', 'mystorequerys.id', '=', 'storequery_answers.question_id')

    ->leftJoin('user_lists', 'storequery_answers.anuserid', '=', 'user_lists.id')

     ->where('question_id',$question)

     //->select(DB::raw('mystorequerys.*,storequery_answers.answer,UNIX_TIMESTAMP(STR_TO_DATE(products.release_date, '%M %d %Y %h:%i%p'))date("h:i:s", strtotime(storequery_answers.created_at)) as time'))

   ->select(DB::raw("mystorequerys.*,storequery_answers.answer,storequery_answers.created_at as time,user_lists.name"))

     ->get();

     

    if($queanswer){

          $json_data = 0;

          echo json_encode(array('error' => false, "data" => $queanswer, "message" => "Success"));

        }

      else{								

              echo json_encode(array('error' => true, "message" => "Error"));

          }

    

}

catch (Exception $e)

{

      echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}



 }

 public function package(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $user_id=$data1->user_id;

  $model_id=$data1->model_id;

  try{	

    

    $package=DB::table('packages_forvehmodels')

    ->leftJoin('user_vehicles', 'packages_forvehmodels.model_id', '=', 'user_vehicles.vehicle_model')

    ->leftJoin('packages', 'packages_forvehmodels.package_id', '=', 'packages.id')

    ->leftJoin('brand_models', 'packages_forvehmodels.model_id', '=', 'brand_models.id')

    ->leftJoin('brand_lists', 'brand_models.brand', '=', 'brand_lists.id')

    ->leftJoin('vehicle_types', 'brand_lists.vehicle', '=', 'vehicle_types.id')

    ->where('user_id',$user_id)

	->where('packages_forvehmodels.model_id',$model_id)

    ->select('packages.*','vehicle_types.veh_type','vehicle_types.veh_img','brand_lists.brand','brand_models.brand_model')

    ->get();

     

    if($package){

          $json_data = 0;

          echo json_encode(array('error' => false, "data" => $package, "message" => "Success"));

        }

      else{								

              echo json_encode(array('error' => true, "message" => "Error"));

          }

    

}

catch (Exception $e)

{

      echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

 }

 public function packagedel(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  

  try{	

    $datadel=$data1->servicepackageid;

    $package=DB::table('packages')

    ->where('packages.id',$datadel)

     ->select('packages.title','packages.image','packages.amount','packages.offer_amount','packages.description')

     ->get();



    



    //  $feature=DB::table('package_features')

    //  ->leftJoin('features', 'package_features.feature', '=', 'features.id')

    //  ->where('package_id',$datadel)

    //  ->select('features.id','features.feature')

    //  ->get();

     

    if($package){

          $json_data = 0;

          echo json_encode(array('error' => false, "data" => $package, "message" => "Success"));

        }

      else{								

              echo json_encode(array('error' => true, "message" => "Error"));

          }

    

}

catch (Exception $e)

{

      echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

 }

 

 public function packageshoplist(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  

  try{	

    $datadel=$data1->servicepackageid;

	$package = DB::table('packages_shop')->where('packages_shop'.'id',$datadel)

	->leftJoin('shops', 'packages_shop.pkg_shp_id', '=', 'shops.id')->get();

	//->leftJoin('packages', 'packages.	package_for', '=', 'packages_shop.pkg_id')->get();

   // $package1=DB::table('packages_shop')

  //  ->where('id',$datadel)

  //   ->select('packages_shop.pkg_id','packages_shop.image','packages_shop.amount','packages_shop.offer_amount','packages_shop.description')

   //  ->get();

     

    if($package){

          $json_data = 0;

          echo json_encode(array('error' => false, "data" => $package, "message" => "Success"));

        }

      else{								

              echo json_encode(array('error' => true, "message" => "Error"));

          }

    

}

catch (Exception $e)

{

      echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

 }

 

 

 

 public function serviceshop(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  

  try{	

    $service=$data1->serviceid;

    $shopservices=DB::table('shop_services')

    ->leftJoin('shops', 'shop_services.shop_id', '=', 'shops.id')

    ->where('shop_category',$service)

    ->get();

     

    if($shopservices){

          $json_data = 0;

          echo json_encode(array('error' => false, "data" => $shopservices, "message" => "Success"));

        }

      else{								

              echo json_encode(array('error' => true, "message" => "Error"));

          }

    

}

catch (Exception $e)

{

      echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

 }

 public function packshop(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $packageid=$data1->packageid;

  $latitude=$data1->lat;

  $longitude=$data1->long;

  $radius = 50; 

  try{	

   

    $pack=DB::table('packages_shops')

    ->leftJoin('shops', 'packages_shops.pkg_shp_id', '=', 'shops.id')

    ->leftJoin('reviews', 'shops.id', '=', 'reviews.shop_id')

    ->where('pkg_id',$packageid)

  //  ->select('shops.shopname','shops.id','shops.address','shops.timming')

	->select(DB::raw('shops.*, ROUND(cast(6371 * acos ( cos ( radians('.$latitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$latitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))

  ->groupBy('shops.id')

  ->havingRaw(DB::raw('distance < '.$radius))

  ->orderByRaw('distance ASC') 

  

  ->get();

  

  $packshoplist=array();



  foreach($pack as $shops){

     $reviewcount=DB::table('reviews')

     ->where('shop_id',$shops->id)

     ->select(DB::raw('count(reviews.id) as reviewcount,ROUND(avg(reviews.review_count)) AS rateaverage'))

     ->first();



     $data = array(

       'id' => $shops->id,

       'type' => $shops->type,

       'image' => $shops->image,

       'open_time'=> $shops->open_time,

       'close_time'=> $shops->close_time,

       'shopname'=> $shops->shopname,

       'address'=> $shops->address,

       'status'=> $shops->status,

       'phone_number'=> $shops->phone_number,

       'phone_number2'=> $shops->phone_number2,

       'agrimentverification_status'=> $shops->agrimentverification_status,

       'pincode'=> $shops->pincode,

       'description'=> $shops->description,

       'lattitude'=> $shops->lattitude,

       'logitude'=> $shops->logitude,

       'trans_id'=> $shops->trans_id,

       'otp'=> $shops->otp,

       'pay_status'=> $shops->pay_status,

       'shop_oc_status'=> $shops->shop_oc_status,

       'exeid'=> $shops->exeid,

       'authorised_status'=> $shops->authorised_status,

       'shop_device_tocken'=> $shops->shop_device_tocken,

       'created_at'=> $shops->created_at,

       'updated_at'=> $shops->updated_at,

       'distance'=> $shops->distance,

       'reviewcount'=>$reviewcount->reviewcount,

       'rateaverage'=>$reviewcount->rateaverage,);

     //echo "<pre>";print_r($reviewcount);

     array_push($packshoplist,$data);

  }

     

    if($packshoplist){

          $json_data = 0;

          echo json_encode(array('error' => false, "data" => $packshoplist, "message" => "Success"));

        }

      else{								

              echo json_encode(array('error' => true, "message" => "Error"));

          }

    

}

catch (Exception $e)

{

      echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

 }

 public function packageservicelist(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  

  try{	

    $packageid=$data1->packageid;

    $packservicelist=DB::table('package_service_list')

    ->leftJoin('shiop_categories', 'package_service_list.service_id', '=', 'shiop_categories.id')

    ->where('package_id',$packageid)

    ->select('shiop_categories.category','shiop_categories.id')

    ->get();

     

    if($packservicelist){

          $json_data = 0;

          echo json_encode(array('error' => false, "data" => $packservicelist, "message" => "Success"));

        }

      else{								

              echo json_encode(array('error' => true, "message" => "Error"));

          }

    

}

catch (Exception $e)

{

      echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

 }

 public function mechnearestshop(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  try{	

    $latitude=$data1->latitude;

    $longitude=$data1->longitude;

    $user_id=$data1->user_id;

	$model_id=$data1->model_id;

  	$radius = 50;

    $shoplist=DB::table('shops')

    ->leftJoin('reviews', 'shops.id', '=', 'reviews.shop_id')

    ->leftJoin('shop_services', 'shops.id', '=', 'shop_services.shop_id')

   // ->leftJoin('user_vehicles', 'shop_services.vehicle_model_id', '=', 'user_vehicles.vehicle_model')

    ->where('shop_services.vehicle_model_id',$model_id)

    ->where('shop_services.shop_category',1) 

   // ->select('shops.*')

	->select(DB::raw('shops.*, ROUND(cast(6371 * acos ( cos ( radians('.$latitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$latitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))

  

  ->havingRaw(DB::raw('distance < '.$radius))

  ->groupBy('shops.id')

  //->groupBy('reviews.id')

	->orderByRaw('distance ASC')

	->limit(5)

    ->get();



    $shop=array();



    foreach($shoplist as $shops){

       $reviewcount=DB::table('reviews')

       ->where('shop_id',$shops->id)

       ->select(DB::raw('count(reviews.id) as reviewcount,ROUND(avg(reviews.review_count)) AS rateaverage'))

       ->first();



       $data = array(

         'id' => $shops->id,

         'type' => $shops->type,

         'image' => $shops->image,

         'open_time'=> $shops->open_time,

         'close_time'=> $shops->close_time,

         'shopname'=> $shops->shopname,

         'address'=> $shops->address,

         'status'=> $shops->status,

         'phone_number'=> $shops->phone_number,

         'phone_number2'=> $shops->phone_number2,

         'agrimentverification_status'=> $shops->agrimentverification_status,

         'pincode'=> $shops->pincode,

         'description'=> $shops->description,

         'lattitude'=> $shops->lattitude,

         'logitude'=> $shops->logitude,

         'trans_id'=> $shops->trans_id,

         'otp'=> $shops->otp,

         'pay_status'=> $shops->pay_status,

         'shop_oc_status'=> $shops->shop_oc_status,

         'exeid'=> $shops->exeid,

         'authorised_status'=> $shops->authorised_status,

         'shop_device_tocken'=> $shops->shop_device_tocken,

         'created_at'=> $shops->created_at,

         'updated_at'=> $shops->updated_at,

         'distance'=> $shops->distance,

         'reviewcount'=>$reviewcount->reviewcount,

         'rateaverage'=>$reviewcount->rateaverage,);

       //echo "<pre>";print_r($reviewcount);

       array_push($shop,$data);

    }

     

        if($shop==null){

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

              $json_data = 0;

              echo json_encode(array('error' => false, "data" => $shop, "message" => "Success"));

           }

    

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

 

 }

 public function mechnearestshopall(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  try{	

    $latitude=$data1->latitude;

    $longitude=$data1->longitude;

	$radius = 50;

    $user_id=$data1->user_id;

	$model_id=$data1->model_id;

    $shoplist=DB::table('shops')

  //  ->leftJoin('reviews', 'shops.id', '=', 'reviews.shop_id')

  //  ->leftJoin('shop_services', 'shops.id', '=', 'shop_services.shop_id')

  //  ->leftJoin('user_vehicles', 'shop_services.vehicle_model_id', '=', 'user_vehicles.vehicle_model')

 //   ->where('user_vehicles.user_id',$user_id)

  ->leftJoin('reviews', 'shops.id', '=', 'reviews.shop_id') 

    ->leftJoin('shop_services', 'shops.id', '=', 'shop_services.shop_id')

   ->where('shop_services.vehicle_model_id',$model_id)

   ->where('shop_services.shop_category',1) 

    //->select('shops.*')

	->select(DB::raw('shops.*, ROUND(cast(6371 * acos ( cos ( radians('.$latitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$latitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))

  

  ->havingRaw(DB::raw('distance < '.$radius)) 

	->groupBy('shops.id')

	->orderByRaw('distance ASC') 

    ->get();



    $shop=array();



    foreach($shoplist as $shops){

       $reviewcount=DB::table('reviews')

       ->where('shop_id',$shops->id)

       ->select(DB::raw('count(reviews.id) as reviewcount,ROUND(avg(reviews.review_count)) AS rateaverage'))

       ->first();



       $data = array(

         'id' => $shops->id,

         'type' => $shops->type,

         'image' => $shops->image,

         'open_time'=> $shops->open_time,

         'close_time'=> $shops->close_time,

         'shopname'=> $shops->shopname,

         'address'=> $shops->address,

         'status'=> $shops->status,

         'phone_number'=> $shops->phone_number,

         'phone_number2'=> $shops->phone_number2,

         'agrimentverification_status'=> $shops->agrimentverification_status,

         'pincode'=> $shops->pincode,

         'description'=> $shops->description,

         'lattitude'=> $shops->lattitude,

         'logitude'=> $shops->logitude,

         'trans_id'=> $shops->trans_id,

         'otp'=> $shops->otp,

         'pay_status'=> $shops->pay_status,

         'shop_oc_status'=> $shops->shop_oc_status,

         'exeid'=> $shops->exeid,

         'authorised_status'=> $shops->authorised_status,

         'shop_device_tocken'=> $shops->shop_device_tocken,

         'created_at'=> $shops->created_at,

         'updated_at'=> $shops->updated_at,

         'distance'=> $shops->distance,

         'reviewcount'=>$reviewcount->reviewcount,

         'rateaverage'=>$reviewcount->rateaverage,);

      

       array_push($shop,$data);

    }

     

        if($shop==null){

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

              $json_data = 0;

              echo json_encode(array('error' => false, "data" => $shop, "message" => "Success"));

           }

    

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

 }

 public function quesanswer(){

	 

	  try{	

    

			$qa=DB::table('mystorequerys')

          ->leftJoin('storequery_answers', 'mystorequerys.id', '=', 'storequery_answers.question_id')

          ->leftJoin('user_lists', 'mystorequerys.quserid', '=', 'user_lists.id')

          ->groupBy('mystorequerys.id')

         

        //  ->select('mystorequerys.id as quid','mystorequerys.question','storequery_answers.answer','storequery_answers.anuserid as anname','storequery_answers.answer','user_lists.name as quname')

          ->select(DB::raw('mystorequerys.id as quid,count(storequery_answers.answer) as answercount,mystorequerys.question,storequery_answers.answer,storequery_answers.anuserid as anname,storequery_answers.answer,user_lists.name as quname,mystorequerys.created_at as time'))

          ->orderBy('mystorequerys.id', 'DESC')

          //	->leftJoin('users', 'mystorequerys.quserid', '=', 'users.id')

				//	->select('mystorequerys.id as quid','users.name as quname','mystorequerys.question','storequery_answers.answer','users.name as anname')

				//	->groupBy('mystorequerys.id')

          ->get();

          

			if($qa==null){

				echo json_encode(array('error' => true, "message" => "Error"));

            }

            else{								

              $json_data = 0;

              echo json_encode(array('error' => false, "data" => $qa, "message" => "Success"));

			}

    

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

 }

 public function packagebook(Request $request){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  

  $book=DB::table('package_books')

  ->value('id');

  if($book==null){

    $unique=1000;

  }else{

    $lastrandom=DB::table('package_books')

    ->orderBy('id', 'DESC')

    ->limit(1)

    ->value('random_num');

    $unique=$lastrandom+1;

  }

  $pbook=new Package_books;

  $pbook->shop_id=$data1->shopid;

  $pbook->customer_id=$data1->customerid;

  $pbook->random_num=$unique;

  $pbook->package_id=$data1->packageid;

  if($pbook->save()){

    $json_data = 0;

    echo json_encode(array('error' => false, "data" => $unique, "message" => "Success"));

  }else{

    echo json_encode(array('error' => true, "message" => "Error"));

  }



 }

 public function catshoplist(){

      $postdata = file_get_contents("php://input");					

      $json = str_replace(array("\t","\n"), "", $postdata);

      $data1 = json_decode($json);

      $catid=$data1->catid;

      $latitude=$data1->latitude;

      $longitude=$data1->longitude;

      $userid=$data1->user_id;

      $model_id=$data1->modelid; 

      $index=$data1->index;
      $offset=($index*10);
      $limit=10;


      $date=date('Y-m-d');



      try{	 

        

         $radius = 50;

          if($model_id==""){



            $catshop=DB::table('shops')

           ->leftJoin('reviews', 'shops.id', '=', 'reviews.shop_id')

           ->leftJoin('shop_provide_categories', 'shops.id', '=', 'shop_provide_categories.shop_id')

           ->select(DB::raw('shops.*,ROUND(cast(6371 * acos ( cos ( radians('.$latitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$latitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance,shops.id as shopserviceid'))

            ->where('shop_provide_categories.shop_cat_id',$catid) 
            
            ->orderByRaw('distance ASC')

            ->groupBy('shops.id')

            ->offset($offset) 
             ->limit($limit) 

            ->get();

            

          }else{

            


             $catshop=DB::table('shop_services')

             ->leftJoin('shops', 'shop_services.shop_id', '=', 'shops.id')

             ->leftJoin('shop_provide_categories', 'shops.id', '=', 'shop_provide_categories.shop_id')

             ->leftJoin('reviews', 'shops.id', '=', 'reviews.shop_id')

              ->where('shop_provide_categories.shop_cat_id',$catid)

             ->where('shop_services.vehicle_model_id',$model_id)

             ->select(DB::raw('shops.*, ROUND(cast(6371 * acos ( cos ( radians('.$latitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$latitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance,shop_services.id as shopserviceid'))

             ->groupBy('shops.id')

             ->orderByRaw('distance ASC')
            ->offset($offset) 
             ->limit($limit) 

             ->get();

          }
          
        

          $catshoplist=array();



          foreach($catshop as $shops){

             $reviewcount=DB::table('reviews')

             ->where('shop_id',$shops->id)

             ->select(DB::raw('count(reviews.id) as reviewcount,ROUND(avg(reviews.review_count)) AS rateaverage'))

             ->first();

             $offercount=DB::table('tbl_shop_offers')

             ->where('shop_id',$shops->id)

             ->where('offer_end_date','>=',$date)

             ->select(DB::raw('count(tbl_shop_offers.id) as offercount'))

             ->first();

 

             $data = array(

               'id' => $shops->id,

               'type' => $shops->type,

               'image' => $shops->image,

               'open_time'=> $shops->open_time,

               'close_time'=> $shops->close_time,

               'shopname'=> $shops->shopname,

               'address'=> $shops->address,

               'status'=> $shops->status,

               'phone_number'=> $shops->phone_number,

               'phone_number2'=> $shops->phone_number2,

               'agrimentverification_status'=> $shops->agrimentverification_status,

               'pincode'=> $shops->pincode,

               'description'=> $shops->description,

               'lattitude'=> $shops->lattitude,

               'logitude'=> $shops->logitude,

               'trans_id'=> $shops->trans_id,

               'otp'=> $shops->otp,

               'pay_status'=> $shops->pay_status,

               'shop_oc_status'=> $shops->shop_oc_status,

               'exeid'=> $shops->exeid,

               'authorised_status'=> $shops->authorised_status,

               'shop_device_tocken'=> $shops->shop_device_tocken,

               'created_at'=> $shops->created_at,

               'updated_at'=> $shops->updated_at,

               'distance'=> $shops->distance,

               'reviewcount'=>$reviewcount->reviewcount,

               'rateaverage'=>$reviewcount->rateaverage,

              'shopserviceid'=>$shops->shopserviceid,

              'offercount'=>$offercount->offercount);


             array_push($catshoplist,$data);

          }

        

      

        

            if($catshoplist==null){

              echo json_encode(array('error' => true, "message" => "Error"));

                }

                else{								

                  $json_data = 0;

                  echo json_encode(array('error' => false, "data" => $catshoplist, "message" => "Success"));

              }

        

    }

    catch (Exception $e)

    {

            

        //return Json("Sorry! Please check input parameters and values");

            echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

    }

 }

public function giveawaylist(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $userveh=$data1->userveh;

  try{	

   

    $givway=DB::table('tbl_giveaways')

  ->where('vehicle_type',$userveh)

  ->where('deleted_status',0)

    ->get();

     

        if($givway==null){

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

              $json_data = 0;

              echo json_encode(array('error' => false, "data" => $givway, "message" => "Success"));

           }

    

}

catch (Exception $e)

{

        

    

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

}

public function giveawayshops(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $latitude=$data1->latitude;

  $longitude=$data1->longitude;

  $package_id=$data1->package_id;

  

  //$radius=50;//Range to be covered in kms

  try{	

   



    // $givway=DB::table('tbl_giveawayshops')

   

    // ->leftJoin('shops', 'tbl_giveawayshops.shop_id', '=', 'shops.id')

    

    //  ->leftJoin('reviews', 'shops.id', '=', 'reviews.shop_id')



    // //  ->join('shop_timeslots', 'shops.id', '=', 'shop_timeslots.shop_id')



    //  ->where('tbl_giveawayshops.package_id',$package_id)

     

    //   ->select(DB::raw('shops.*,count(reviews.id) as reviewcount,ROUND(avg(reviews.review_count)) AS rateaverage,ROUND(cast(6371 * acos ( cos ( radians('.$latitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$latitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))

    

    // // ->groupBy('shops.id')

    //  //->havingRaw(DB::raw('distance < '.$radius))

    // // ->orderByRaw('distance ASC')

    // //->limit(5)

    //  ->get();

 

         $giveshops=DB::table('tbl_giveawayshops')



         ->leftJoin('shops', 'tbl_giveawayshops.shop_id', '=', 'shops.id')



         ->where('tbl_giveawayshops.package_id',$package_id)



        // ->where('tbl_giveawayshops.package_id',$package_id)



         ->select(DB::raw('shops.*,ROUND(cast(6371 * acos ( cos ( radians('.$latitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$latitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))



         ->orderByRaw('distance ASC')

         

         ->get();



         $givway=array();



         foreach($giveshops as $shops){

            $reviewcount=DB::table('reviews')

            ->where('shop_id',$shops->id)

            ->select(DB::raw('count(reviews.id) as reviewcount,ROUND(avg(reviews.review_count)) AS rateaverage'))

            ->first();



            $data = array(

              'id' => $shops->id,

              'type' => $shops->type,

              'image' => $shops->image,

              'open_time'=> $shops->open_time,

              'close_time'=> $shops->close_time,

              'shopname'=> $shops->shopname,

              'address'=> $shops->address,

              'status'=> $shops->status,

              'phone_number'=> $shops->phone_number,

              'phone_number2'=> $shops->phone_number2,

              'agrimentverification_status'=> $shops->agrimentverification_status,

              'pincode'=> $shops->pincode,

              'description'=> $shops->description,

              'lattitude'=> $shops->lattitude,

              'logitude'=> $shops->logitude,

              'trans_id'=> $shops->trans_id,

              'otp'=> $shops->otp,

              'pay_status'=> $shops->pay_status,

              'shop_oc_status'=> $shops->shop_oc_status,

              'exeid'=> $shops->exeid,

              'authorised_status'=> $shops->authorised_status,

              'shop_device_tocken'=> $shops->shop_device_tocken,

              'created_at'=> $shops->created_at,

              'updated_at'=> $shops->updated_at,

              'distance'=> $shops->distance,

              'reviewcount'=>$reviewcount->reviewcount,

              'rateaverage'=>$reviewcount->rateaverage,);

            //echo "<pre>";print_r($reviewcount);

            array_push($givway,$data);

         }

      

     

        if($givway==null){

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

              $json_data = 0;

              echo json_encode(array('error' => false, "data" => $givway, "message" => "Success"));

           }

    

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

}

public function giveawaydel(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $give_id=$data1->giveid;

  try{	

   



    $givway=DB::table('tbl_giveaways')

   ->where('id',$give_id)

  

     ->first();

     

        if($givway==null){

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

              $json_data = 0;

              echo json_encode(array('error' => false, "data" => $givway, "message" => "Success"));

           }

    

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

}

public function givwawaybookingcount(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  

  try{	

   



    $givway=DB::table('booktimemasters')

   ->where('book_type',4)

   ->where('work_status',1)

     ->count();

     

      						

              

              echo json_encode(array('error' => false, "count" => $givway, "message" => "Success"));

         

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

}

 public function availabletime(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $bookdate=$data1->bookdate;

  $shop=$data1->shopid; 

  	  try{	

    if($bookdate==null){

      echo json_encode(array('error' => true, "message" => "Error"));

    }else{

      $booktime=DB::table('shop_timeslots')

      //->leftJoin('shops', 'shop_services.shop_id', '=', 'shops.id')

      ->where('shop_id',$shop)

      ->select('shop_timeslots.timeslot','shop_timeslots.id')

      ->get();

      //print_r($booktime);exit;

      $bookedtime=DB::table('booktimemasters')

      //->leftJoin('shops', 'shop_services.shop_id', '=', 'shops.id')

      ->where('shop_id',$shop)

      ->where('adate',$bookdate)

      ->where('work_status','!=',2)

      ->select('booktimemasters.timeslots')

      ->get()

      ->toArray();

       //print_r($bookedtime);exit;

      // For removing object and converting to one dimensional array

       $bookedtime = array_column( array_map( function($value) { return (array)$value; }, $bookedtime ),'timeslots');

    

       $time=array();

       for($i=0;$i<count($booktime);$i++){

        

        

          if(in_array(date("h:i", strtotime($booktime[$i]->timeslot)), $bookedtime)){  //If booking is present

            

              $data = array(

                    'id' => $booktime[$i]->id,

                    'time' => date("h:i", strtotime($booktime[$i]->timeslot)),

                    'Availabel' => 1);

            }else{//If booking is not present

              $data = array(

                    'id' => $booktime[$i]->id,

                    'time' => date("h:i", strtotime($booktime[$i]->timeslot)),

                    'Availabel' => 0);

            }

          //  echo "<pre>";print_r($data);exit;

            array_push($time,$data);

    

       } 

       

      $bookarray =array();

      

    

            if($time==null){

              echo json_encode(array('error' => true, "message" => "Error"));

                 }

                else{								

                  $json_data = 0;

                  echo json_encode(array('error' => false, "data" => $time, "message" => "Success"));

               }

        

    }

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

 }



 public function bookedhistory(){

	$postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $customerid=$data1->customerid;

  $bookedtype=$data1->bookedtype;

  	  try{	

    // if($bookedtype==4){

      $bookedhis=DB::table('booktimemasters')

      ->leftJoin('shops', 'booktimemasters.shop_id', '=', 'shops.id')

      ->leftJoin('packages', 'booktimemasters.book_id', '=', 'packages.id')

      ->leftJoin('tbl_shop_offers', 'booktimemasters.book_id', '=', 'tbl_shop_offers.id'  , 'ǍND' , 'booktimemasters.book_type', '=', '2')

      ->leftJoin('shop_services', 'booktimemasters.book_id', '=', 'shop_services.id'  , 'ǍND' , 'booktimemasters.book_type', '=', '3')

      ->leftJoin('tbl_giveaways', 'booktimemasters.book_id', '=', 'tbl_giveaways.id'  , 'ǍND' , 'booktimemasters.book_type', '=', '4')

     ->leftJoin('shiop_categories', 'booktimemasters.shop_category_id', '=', 'shiop_categories.id')

     ->leftJoin('user_vehicles', 'booktimemasters.user_vehid', '=', 'user_vehicles.id')

      ->leftJoin('vehicle_types', 'user_vehicles.vehicle_type', '=', 'vehicle_types.id')

     ->where('customer_id',$customerid)

      ->orderBy('booktimemasters.id', 'DESC')

      ->select('booktimemasters.*','user_vehicles.vehicle_number','user_vehicles.vehicle_type','vehicle_types.veh_img','shops.shopname','shops.address','packages.title as packagename','tbl_shop_offers.title as shopoffer','shiop_categories.category as servicename','tbl_giveaways.title as giveawyaname')

        ->get();

    // }else{

    //   $bookedhis=DB::table('booktimemasters')

    //   ->leftJoin('shops', 'booktimemasters.shop_id', '=', 'shops.id')

    //   ->leftJoin('packages', 'booktimemasters.book_id', '=', 'packages.id')

    //   ->leftJoin('tbl_shop_offers', 'booktimemasters.book_id', '=', 'tbl_shop_offers.id')

    //   ->leftJoin('shop_services', 'booktimemasters.book_id', '=', 'shop_services.id')

    //   ->leftJoin('shiop_categories', 'shop_services.shop_category', '=', 'shiop_categories.id')

    //   ->where('customer_id',$customerid)

    //   ->where('book_type',$bookedtype)

    //   ->orderBy('booktimemasters.id', 'DESC')

    //   ->select('booktimemasters.*','shops.shopname','shops.address','packages.title as packagename','tbl_shop_offers.title as shopoffer','shiop_categories.category as servicename')

    //     ->get();

    // }

  

     

        if($bookedhis==null){

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

              $json_data = 0;

              echo json_encode(array('error' => false, "data" => $bookedhis, "message" => "Success"));

           }

    

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

 }

 public function offerlistveh(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $user_id=$data1->user_id;

  $model_id=$data1->model_id;

  $lattitude=$data1->lat;

  $longitude=$data1->long;


//Range to be covered in kms
   $radius=50;

 

   $date=date('y-m-d');

  	  try{	

      //   $package=DB::table('tbl_shop_offers')

      //   ->leftJoin('shop_offer_models', 'tbl_shop_offers.id', '=', 'shop_offer_models.offer_id')

      //   ->leftJoin('shiop_categories', 'tbl_shop_offers.shop_cat_id', '=', 'shiop_categories.id')

      //   ->leftJoin('shops', 'tbl_shop_offers.shop_id', '=', 'shops.id')

      //   ->leftJoin('user_vehicles', 'tbl_shop_offers.model_id', '=', 'user_vehicles.vehicle_model')

      //  // ->leftJoin('tbl_shop_offers', 'shop_offer_models.offer_id', '=', 'tbl_shop_offers.id')

      //  ->leftJoin('vehicle_types', 'shop_offer_models.vehicle_typeid', '=', 'vehicle_types.id')

      //  ->leftJoin('brand_lists', 'shop_offer_models.brand_id', '=', 'brand_lists.id')

      //  ->leftJoin('brand_models', 'shop_offer_models.model_id', '=', 'brand_models.id')

       

      //  ->where('shop_offer_models.model_id',$model_id)

      //   ->where('user_vehicles.user_id',$user_id)

       

      //   ->where('tbl_shop_offers.offer_end_date','>=',$date)

      //   ->groupBy('tbl_shop_offers.id')

      //   ->select(DB::raw('tbl_shop_offers.*,shops.address as location,shiop_categories.category,vehicle_types.veh_type,vehicle_types.veh_img,brand_lists.brand,brand_models.brand_model, ROUND(cast(6371 * acos ( cos ( radians('.$lattitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$lattitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))

      //   ->havingRaw(DB::raw('distance < '.$radius))

      //   ->orderByRaw('distance ASC')

      

      //   ->get();



        $package=DB::table('tbl_shop_offers')

        ->leftJoin('shiop_categories', 'tbl_shop_offers.shop_cat_id', '=', 'shiop_categories.id')

        ->leftJoin('shop_offer_models', 'tbl_shop_offers.id', '=', 'shop_offer_models.offer_id')

        ->leftJoin('shops', 'tbl_shop_offers.shop_id', '=', 'shops.id')

        ->leftJoin('user_vehicles', 'tbl_shop_offers.model_id', '=', 'user_vehicles.vehicle_model')

       // ->leftJoin('tbl_shop_offers', 'shop_offer_models.offer_id', '=', 'tbl_shop_offers.id')

        ->leftJoin('vehicle_types', 'shop_offer_models.vehicle_typeid', '=', 'vehicle_types.id')

        ->leftJoin('brand_lists', 'shop_offer_models.brand_id', '=', 'brand_lists.id')

        ->leftJoin('brand_models', 'shop_offer_models.model_id', '=', 'brand_models.id')

       // ->where('user_id',$user_id)

        ->where('shop_offer_models.model_id',$model_id)

        ->where('tbl_shop_offers.offer_end_date','>=',$date)

        ->groupBy('tbl_shop_offers.id')



        ->select(DB::raw('tbl_shop_offers.*,shops.address as location,shops.shopname,shiop_categories.category,shiop_categories.image as catimage,vehicle_types.veh_type,vehicle_types.veh_img,brand_lists.brand,brand_models.brand_model, ROUND(cast(6371 * acos ( cos ( radians('.$lattitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$lattitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))

        ->havingRaw(DB::raw('distance < '.$radius))

        ->orderByRaw('distance ASC')

      

        ->get();

     

        if($package==null){

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



 public function topoffers(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $user_id=$data1->user_id;

  $model_id=$data1->model_id;

  $lattitude=$data1->lat;

  $longitude=$data1->long;



   $radius=50;//Range to be covered in kms

 

   $date=date('y-m-d');

  	  try{	

      //   $package=DB::table('tbl_shop_offers')

      //   ->leftJoin('shop_offer_models', 'tbl_shop_offers.id', '=', 'shop_offer_models.offer_id')

      //   ->leftJoin('shiop_categories', 'tbl_shop_offers.shop_cat_id', '=', 'shiop_categories.id')

      //   ->leftJoin('shops', 'tbl_shop_offers.shop_id', '=', 'shops.id')

      //   ->leftJoin('user_vehicles', 'tbl_shop_offers.model_id', '=', 'user_vehicles.vehicle_model')

      //  // ->leftJoin('tbl_shop_offers', 'shop_offer_models.offer_id', '=', 'tbl_shop_offers.id')

      //  ->leftJoin('vehicle_types', 'shop_offer_models.vehicle_typeid', '=', 'vehicle_types.id')

      //   ->leftJoin('brand_lists', 'shop_offer_models.brand_id', '=', 'brand_lists.id')

      //   ->leftJoin('brand_models', 'shop_offer_models.model_id', '=', 'brand_models.id')

        

      //   ->where('shop_offer_models.model_id',$model_id)

      //   ->where('user_vehicles.user_id',$user_id)

      

      //   ->where('tbl_shop_offers.offer_end_date','>=',$date)

      //   ->groupBy('tbl_shop_offers.id')

      //   ->select(DB::raw('tbl_shop_offers.*,shops.address as location,shiop_categories.category,vehicle_types.veh_type,vehicle_types.veh_img,brand_lists.brand,brand_models.brand_model, ROUND(cast(6371 * acos ( cos ( radians('.$lattitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$lattitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))

      //   //->havingRaw(DB::raw('distance < '.$radius))

      //   ->orderByRaw('discount_percentage DESC')

      

      //   ->get();



        $package=DB::table('tbl_shop_offers')

        ->leftJoin('shiop_categories', 'tbl_shop_offers.shop_cat_id', '=', 'shiop_categories.id')

        ->leftJoin('shop_offer_models', 'tbl_shop_offers.id', '=', 'shop_offer_models.offer_id')

        ->leftJoin('shops', 'tbl_shop_offers.shop_id', '=', 'shops.id')

        ->leftJoin('user_vehicles', 'tbl_shop_offers.model_id', '=', 'user_vehicles.vehicle_model')

       // ->leftJoin('tbl_shop_offers', 'shop_offer_models.offer_id', '=', 'tbl_shop_offers.id')

        ->leftJoin('vehicle_types', 'shop_offer_models.vehicle_typeid', '=', 'vehicle_types.id')

        ->leftJoin('brand_lists', 'shop_offer_models.brand_id', '=', 'brand_lists.id')

        ->leftJoin('brand_models', 'shop_offer_models.model_id', '=', 'brand_models.id')

        

        ->where('shop_offer_models.model_id',$model_id)

        ->where('tbl_shop_offers.offer_end_date','>=',$date)

        ->groupBy('tbl_shop_offers.id')



        ->select(DB::raw('tbl_shop_offers.*,shops.address as location,shiop_categories.category,shiop_categories.image as catimage,vehicle_types.veh_type,vehicle_types.veh_img,brand_lists.brand,brand_models.brand_model, ROUND(cast(6371 * acos ( cos ( radians('.$lattitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$lattitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))

        ->havingRaw(DB::raw('distance < '.$radius))

        ->orderByRaw('discount_percentage DESC')

      

        ->get();

     

        if($package==null){

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

 public function upcomingcstmr_offers(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $user_id=$data1->user_id;

  $model_id=$data1->model_id;

  $lattitude=$data1->lat;

  $longitude=$data1->long;



   $radius=50;//Range to be covered in kms

 

   $date=date('y-m-d');

  	  try{	

      //   $package=DB::table('tbl_shop_offers')

      //   ->leftJoin('shop_offer_models', 'tbl_shop_offers.id', '=', 'shop_offer_models.offer_id')

      //   ->leftJoin('shiop_categories', 'tbl_shop_offers.shop_cat_id', '=', 'shiop_categories.id')

      //   ->leftJoin('shops', 'tbl_shop_offers.shop_id', '=', 'shops.id')

      //   ->leftJoin('user_vehicles', 'tbl_shop_offers.model_id', '=', 'user_vehicles.vehicle_model')

      //  // ->leftJoin('tbl_shop_offers', 'shop_offer_models.offer_id', '=', 'tbl_shop_offers.id')

      //  ->leftJoin('vehicle_types', 'shop_offer_models.vehicle_typeid', '=', 'vehicle_types.id')

      //   ->leftJoin('brand_lists', 'shop_offer_models.brand_id', '=', 'brand_lists.id')

      //   ->leftJoin('brand_models', 'shop_offer_models.model_id', '=', 'brand_models.id')

        

      //   ->where('shop_offer_models.model_id',$model_id)

      //   ->where('user_vehicles.user_id',$user_id)

      

      //   ->where('tbl_shop_offers.offer_end_date','>=',$date)

      //   ->groupBy('tbl_shop_offers.id')

      //   ->select(DB::raw('tbl_shop_offers.*,shops.address as location,shiop_categories.category,vehicle_types.veh_type,vehicle_types.veh_img,brand_lists.brand,brand_models.brand_model, ROUND(cast(6371 * acos ( cos ( radians('.$lattitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$lattitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))

      //   //->havingRaw(DB::raw('distance < '.$radius))

      //   ->orderByRaw('discount_percentage DESC')

      

      //   ->get();



        $package=DB::table('tbl_shop_offers')

        ->leftJoin('shiop_categories', 'tbl_shop_offers.shop_cat_id', '=', 'shiop_categories.id')

        ->leftJoin('shop_offer_models', 'tbl_shop_offers.id', '=', 'shop_offer_models.offer_id')

        ->leftJoin('shops', 'tbl_shop_offers.shop_id', '=', 'shops.id')

        ->leftJoin('user_vehicles', 'tbl_shop_offers.model_id', '=', 'user_vehicles.vehicle_model')

       // ->leftJoin('tbl_shop_offers', 'shop_offer_models.offer_id', '=', 'tbl_shop_offers.id')

        ->leftJoin('vehicle_types', 'shop_offer_models.vehicle_typeid', '=', 'vehicle_types.id')

        ->leftJoin('brand_lists', 'shop_offer_models.brand_id', '=', 'brand_lists.id')

        ->leftJoin('brand_models', 'shop_offer_models.model_id', '=', 'brand_models.id')

        

        ->where('shop_offer_models.model_id',$model_id)

        ->where('tbl_shop_offers.offer_start_date','>',$date)

        ->groupBy('tbl_shop_offers.id')



        ->select(DB::raw('tbl_shop_offers.*,shops.address as location,shiop_categories.category,shiop_categories.image as catimage,vehicle_types.veh_type,vehicle_types.veh_img,brand_lists.brand,brand_models.brand_model, ROUND(cast(6371 * acos ( cos ( radians('.$lattitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$lattitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))

        ->havingRaw(DB::raw('distance < '.$radius))

        ->orderByRaw('discount_percentage DESC')

      

        ->get();

     

        if($package==null){

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



 public function offerlistvehv2(){

  $postdata = file_get_contents("php://input");					

$json = str_replace(array("\t","\n"), "", $postdata);

$data1 = json_decode($json);

$user_id=$data1->user_id;

$model_id=$data1->model_id;

$lattitude=$data1->lat;

$longitude=$data1->long;

$shopcatid=$data1->shopcatid;



$radius=5000;//Range to be covered in kms



$date=date('y-m-d');

   try{	

    $package=DB::table('tbl_shop_offers')

    ->leftJoin('shiop_categories', 'tbl_shop_offers.shop_cat_id', '=', 'shiop_categories.id')

    ->leftJoin('shop_offer_models', 'tbl_shop_offers.id', '=', 'shop_offer_models.offer_id')

    ->leftJoin('shops', 'tbl_shop_offers.shop_id', '=', 'shops.id')

    ->leftJoin('user_vehicles', 'tbl_shop_offers.model_id', '=', 'user_vehicles.vehicle_model')

   // ->leftJoin('tbl_shop_offers', 'shop_offer_models.offer_id', '=', 'tbl_shop_offers.id')

    ->leftJoin('vehicle_types', 'shop_offer_models.vehicle_typeid', '=', 'vehicle_types.id')

    ->leftJoin('brand_lists', 'shop_offer_models.brand_id', '=', 'brand_lists.id')

    ->leftJoin('brand_models', 'shop_offer_models.model_id', '=', 'brand_models.id')

    // ->where('user_id',$user_id)

     ->where('shop_offer_models.model_id',$model_id)

     ->where('tbl_shop_offers.offer_end_date','>=',$date)

     ->where('tbl_shop_offers.shop_cat_id',$shopcatid)

     ->groupBy('tbl_shop_offers.id')

     ->select(DB::raw('tbl_shop_offers.*,vehicle_types.veh_type,vehicle_types.veh_img,brand_lists.brand,brand_models.brand_model, ROUND(cast(6371 * acos ( cos ( radians('.$lattitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$lattitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))

     ->havingRaw(DB::raw('distance < '.$radius))

     ->orderByRaw('distance ASC')

   

     ->get();

  

     if($package==null){

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

 

 public function offerdetails(){

	$postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $offerid= $data1->offerid;

  $shopid= $data1->shopid;

  $latitude= $data1->lat;

  $longitude= $data1->long;

  $radius=50;//Range to be covered in kms

  	  try{	

    

    $offerlist=DB::table('tbl_shop_offers')

	->leftJoin('shops', 'tbl_shop_offers.shop_id', '=', 'shops.id')

	->leftJoin('vehicle_types', 'tbl_shop_offers.vehicle_typeid', '=', 'vehicle_types.id')

	->leftJoin('brand_lists', 'tbl_shop_offers.brand_id', '=', 'brand_lists.id')

	->leftJoin('brand_models', 'tbl_shop_offers.model_id', '=', 'brand_models.id')

	->where('tbl_shop_offers.id',$offerid)

  ->where('tbl_shop_offers.shop_id',$shopid)

  //->where('tbl_shop_offers.offer_end_date','>=',$date)

  ->groupBy('tbl_shop_offers.id')

	->select(DB::raw('tbl_shop_offers.*,shops.shopname,vehicle_types.veh_type,vehicle_types.veh_img,brand_lists.brand,brand_lists.brand,brand_models.brand_model, ROUND(cast(6371 * acos ( cos ( radians('.$latitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$latitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))

	//->select('tbl_shop_offers.*','vehicle_types.veh_type','brand_lists.brand','brand_lists.brand','brand_models.brand_model')

    ->get();

     

        if($offerlist==null){

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

              $json_data = 0;

              echo json_encode(array('error' => false, "data" => $offerlist, "message" => "Success"));

           }

    

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

 }

public function walletbalance(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $userid= $data1->userid;

  

  	  try{	

 

        $totaldebit=DB::table('wallet_debitorcredit_his')

        ->where('creditordebit',1)

        ->where('user_id',$userid)

        ->sum('wallet_debitorcredit_his.amount');

        $wallet=DB::table('wallets')

        ->where('user_id',$userid)

        ->value('amount_credited');

        $wallet_balance=$wallet-$totaldebit;



      // print_r($wallet_balance);exit;

        if($wallet_balance==null){

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

              $json_data = 0;

              echo json_encode(array('error' => false, "balance" => $wallet_balance, "message" => "Success"));

           }

    

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

}

public function walletuse(Request $request){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

	date_default_timezone_set("Asia/Kolkata"); # add your city to set local time zone

                $now = date('Y-m-d H:i');



  $wallet=new Wallet_debitorcredit_his;

  $wallet->amount=$data1->amount;

  $wallet->user_id=$data1->user_id;

  $wallet->created_at=$now;

  $wallet->debited_purpose=$data1->debited_purpose;

  $wallet->creditordebit=1;

  $wallet->package_id=$data1->package_id;

  if($wallet->save()){

    $json_data = 1;

    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

  }else{

    $json_data = 0;

    echo json_encode(array('error' => true, "data" => $json_data, "message" => "false"));

  }

}

public function gcmupdate(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $customerid=$data1->customerid;

  $fcmid=$data1->fcmid;

  $UpdateDetails = User_lists::where('id', '=',  $customerid)->first();

        $UpdateDetails->device_token = $fcmid;

        if($UpdateDetails->save()){

          $json_data = 1;

          echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

        }else{

          $json_data = 0;

          echo json_encode(array('error' => true, "data" => $json_data, "message" => "false"));

        }



}

function sendNotification(Request $request)

{

    $friendToken = [];

    $postdata = file_get_contents("php://input");					

    $json = str_replace(array("\t","\n"), "", $postdata);

    $data1 = json_decode($json);

  

    //$usernames=$data1->fcmnotify;

   

    //print_r($usernames);exit;

   // $usernames = $request->all()['friend_usernames'];

    //$dialog_id = $request->all()['dialog_id'];

   // $usernames=$request->userid;

    //$dialog_id=$request->dialog_id;

    foreach ($data1->fcmnotify as $username) {

        $friendToken[] = DB::table('user_lists')->where('id', $username->usernames)

            ->get()->pluck('device_token')[0];

            $dialog_id=$username->dialog_id;

    }

  //print_r($friendToken);exit;

    $url = 'https://fcm.googleapis.com/fcm/send';

    foreach ($friendToken as $tok) {

        $fields = array(

            'to' => $tok,

            'data' => $message = array(

                //"message" => $request->all()['message'],

                "dialog_id" => $dialog_id

            )

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

public function customernotification(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $customerid=$data1->userid;

  try{	

     

    $notificationindividal=DB::table('tbl_notification_historys')

    ->where('user_type',2)

    ->where('user_id',$customerid)

    

    ->select(DB::raw("tbl_notification_historys.*,tbl_notification_historys.created_at as time"))

    ->get()

    ->toArray();

    

    $notificationall=DB::table('tbl_notification_historys')

    ->where('user_type',2)

    ->where('allorindividual',1)

    ->select(DB::raw("tbl_notification_historys.*,tbl_notification_historys.created_at as time"))

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

public function uservehicledelete(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $id=$data1->id;

  if(DB::table('user_vehicles')->where('id', $id)->delete()){

	 $json_data = 1;    

  echo json_encode(array('error' => false, "data" => $json_data,"message" => "success")); 

  }else{

	   $json_data = 0;      

  echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

  }  

}

public function userlistedit(){

	$postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $id=$data1->id;

  $userlist=User_lists::find($id);

  $userlist->name = $data1->name;

  $userlist->phnum = $data1->phnum;

  if($userlist->save()){

	  $json_data = 1;      

  echo json_encode(array('error' => false, "data" => $json_data,"message" => "success"));

  }else{

	  $json_data = 0;      

  echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));  

  }

  

}



public function notificationlist(Request $request){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

   $data1 = json_decode($json);

  



   try{

    //$vehtype=Vehicle_types::all(); 

  $usertype_id=$data1->usertypeid;

  //echo $vehtype;exit;

   $notificationlist=DB::table('tbl_notifications')  

   ->where('customertype_id',$usertype_id)

   //->groupBy('package_features.package_id')

   ->select('tbl_notifications.id','tbl_notifications.title','tbl_notifications.message','tbl_notifications.customertype_id')

   ->get();

     

      

        

            if($notificationlist != null){

                $json_data = 0;

                //echo $json_data;

                echo json_encode(array('error' => false, "data" => $notificationlist, "message" => "Success"));

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

 //roadmate new api==================================================

 public function shopofferlistnew(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

   $data1 = json_decode($json);

  



   try{

    $date=date('y-m-d');

   $shop=$data1->shopid;



   $lattitude=$data1->lat; 

   $longitude=$data1->long;

  

  //  $shopofferlist=DB::table('tbl_shop_offers') 

  //  ->leftJoin('shop_offer_models', 'tbl_shop_offers.id', '=', 'shop_offer_models.offer_id')

  //  ->leftJoin('shops', 'tbl_shop_offers.shop_id', '=', 'shops.id')

  //  ->leftJoin('shiop_categories', 'tbl_shop_offers.shop_cat_id', '=', 'shiop_categories.id')

  //  ->leftJoin('vehicle_types', 'shop_offer_models.vehicle_typeid', '=', 'vehicle_types.id')

  // ->leftJoin('brand_lists', 'shop_offer_models.brand_id', '=', 'brand_lists.id') 

  // ->leftJoin('brand_models', 'shop_offer_models.model_id', '=', 'brand_models.id')

  //  ->where('tbl_shop_offers.shop_id',$shop)

  //  ->where('tbl_shop_offers.offer_end_date','>=',$date)

  //  ->groupBy('tbl_shop_offers.id')

  // // ->select(DB::raw('tbl_shop_offers.*,shops.shopname,vehicle_types.veh_type,vehicle_types.veh_img,brand_lists.brand,brand_lists.brand,brand_models.brand_model'))

  //  ->select(DB::raw('tbl_shop_offers.*,shops.shopname,shops.address as location,vehicle_types.veh_type,vehicle_types.veh_img,brand_lists.brand,brand_lists.brand,brand_models.brand_model, ROUND(cast(6371 * acos ( cos ( radians('.$lattitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$lattitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))

  //  ->get();



   $shopofferlist=DB::table('tbl_shop_offers')

   ->leftJoin('shiop_categories', 'tbl_shop_offers.shop_cat_id', '=', 'shiop_categories.id')

   ->leftJoin('shop_offer_models', 'tbl_shop_offers.id', '=', 'shop_offer_models.offer_id')

   ->leftJoin('shops', 'tbl_shop_offers.shop_id', '=', 'shops.id')

   //->leftJoin('user_vehicles', 'tbl_shop_offers.model_id', '=', 'user_vehicles.vehicle_model')

  // ->leftJoin('tbl_shop_offers', 'shop_offer_models.offer_id', '=', 'tbl_shop_offers.id')

   ->leftJoin('vehicle_types', 'shop_offer_models.vehicle_typeid', '=', 'vehicle_types.id')

   ->leftJoin('brand_lists', 'shop_offer_models.brand_id', '=', 'brand_lists.id')

   ->leftJoin('brand_models', 'shop_offer_models.model_id', '=', 'brand_models.id')

  // ->where('user_id',$user_id)

  ->where('tbl_shop_offers.shop_id',$shop)

  ->where('tbl_shop_offers.offer_end_date','>=',$date)

   ->groupBy('tbl_shop_offers.id')



   ->select(DB::raw('tbl_shop_offers.*,shops.address as location,shops.shopname,shiop_categories.category,shiop_categories.image as catimage,vehicle_types.veh_type,vehicle_types.veh_img,brand_lists.brand,brand_models.brand_model, ROUND(cast(6371 * acos ( cos ( radians('.$lattitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$lattitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))

  

   ->get();

     

      

        

            if($shopofferlist != null){

                $json_data = 0;

                //echo $json_data;

                echo json_encode(array('error' => false, "data" => $shopofferlist, "message" => "Success"));

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



 public function pastupcomingbookings(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $customerid=$data1->customerid;



  //$work_status=$data1->work_status;

  $pay_status=$data1->pay_status;

  

  	  try{	

 

      $bookedhis=DB::table('booktimemasters')

      ->leftJoin('shops', 'booktimemasters.shop_id', '=', 'shops.id')

      ->leftJoin('packages', 'booktimemasters.book_id', '=', 'packages.id')

      ->leftJoin('tbl_shop_offers', 'booktimemasters.book_id', '=', 'tbl_shop_offers.id'  , 'ǍND' , 'booktimemasters.book_type', '=', '2')

      ->leftJoin('shop_services', 'booktimemasters.book_id', '=', 'shop_services.id'  , 'ǍND' , 'booktimemasters.book_type', '=', '3')

      ->leftJoin('tbl_giveaways', 'booktimemasters.book_id', '=', 'tbl_giveaways.id'  , 'ǍND' , 'booktimemasters.book_type', '=', '4')

     ->leftJoin('shiop_categories', 'booktimemasters.shop_category_id', '=', 'shiop_categories.id')

    // ->leftJoin('vehicle_types', 'user_vehicles.vehicle_type', '=', 'vehicle_types.id')



    // ->leftJoin('shiop_categories AS shopcat', 'shop_services.shop_category' , '=', 'shopcat.id', 'OR' ,'tbl_shop_offers.shop_cat_id', '=', 'shopcat.id' )

  

  //    ->leftJoin('shiop_categories', function($q) {

  //     $q->on('shop_services.shop_category', '=', 'shiop_categories.id');

  //     $q->on('tbl_shop_offers.shop_cat_id', '=','shiop_categories.id');

  // })

      ->leftJoin('user_vehicles', 'booktimemasters.user_vehid', '=', 'user_vehicles.id')

      ->leftJoin('vehicle_types', 'user_vehicles.vehicle_type', '=', 'vehicle_types.id')



      ->where('customer_id',$customerid)

      ->where('booktimemasters.work_status','!=',2)

      ->where('booktimemasters.pay_status',$pay_status)



      

     

       // ->where('pay_status',$pay_status)

     

     

      ->orderBy('booktimemasters.id', 'DESC')

      ->select('booktimemasters.*','user_vehicles.vehicle_number','user_vehicles.vehicle_type','vehicle_types.veh_img','shops.shopname','shops.address','packages.title as packagename','tbl_shop_offers.title as shopoffer','shiop_categories.category as servicename','shops.lattitude','shops.logitude','tbl_giveaways.title as giveawyaname') 

        ->get();



        $pastupcount=DB::table('booktimemasters')

        ->where('customer_id',$customerid)

        ->where('pay_status',$pay_status)

        ->where('booktimemasters.work_status','!=',2)

        ->count('id');

   

     

        if($bookedhis==null){

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

              $json_data = 0;

              echo json_encode(array('error' => false, "data" => $bookedhis,'pastupcount'=>$pastupcount, "message" => "Success"));

           }

    

}

catch (Exception $e)

{

        

   

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

 }



 public function allshopoffers(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  //$user_id=$data1->user_id;

  $model_id=$data1->model_id;

  $lattitude=$data1->lat;

  $longitude=$data1->long;



   $radius=50;//Range to be covered in kms

 

   $date=date('y-m-d');

  	  try{	

        $package=DB::table('tbl_shop_offers')

        ->leftJoin('shiop_categories', 'tbl_shop_offers.shop_cat_id', '=', 'shiop_categories.id')

        ->leftJoin('shop_offer_models', 'tbl_shop_offers.id', '=', 'shop_offer_models.offer_id')

        ->leftJoin('shops', 'tbl_shop_offers.shop_id', '=', 'shops.id')

        ->leftJoin('user_vehicles', 'tbl_shop_offers.model_id', '=', 'user_vehicles.vehicle_model')

       // ->leftJoin('tbl_shop_offers', 'shop_offer_models.offer_id', '=', 'tbl_shop_offers.id')

        ->leftJoin('vehicle_types', 'shop_offer_models.vehicle_typeid', '=', 'vehicle_types.id')

        ->leftJoin('brand_lists', 'shop_offer_models.brand_id', '=', 'brand_lists.id')

        ->leftJoin('brand_models', 'shop_offer_models.model_id', '=', 'brand_models.id')

        

        ->where('shop_offer_models.model_id',$model_id)

        ->where('tbl_shop_offers.offer_end_date','>=',$date)

        ->groupBy('tbl_shop_offers.id')

        ->select(DB::raw('tbl_shop_offers.*,shops.address as location,shiop_categories.category,shiop_categories.image as catimage,vehicle_types.veh_type,vehicle_types.veh_img,brand_lists.brand,brand_models.brand_model, ROUND(cast(6371 * acos ( cos ( radians('.$lattitude.') ) * cos( radians( `lattitude` ) ) * cos( radians( `logitude` ) - radians('.$longitude.') ) + sin ( radians('.$lattitude.') ) * sin( radians( `lattitude` ) ) ) as decimal(8,2)) , 2) AS distance'))

        

        ->orderByRaw('distance ASC')

      

        ->get();

     

        if($package==null){

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

public function defaultveh(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);



  $user_id=$data1->userid;

  $veh_id=$data1->veh_id;



  $checkveh=DB::table('tbl_default_vehs')->where('user_id',$user_id)->first();

  if($checkveh==null){

  $default=new Tbl_default_vehs;

  $default->user_id=$user_id;

  $default->veh_id=$veh_id;

  $default->save();

  $json_data = 0;

  echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

  }else{

    Tbl_default_vehs::where('user_id', $user_id)

    ->update([

        'veh_id' => $veh_id

     ]);

     $json_data = 1;

  echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

  }



}

public function defaultvehcall(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $user_id=$data1->user_id;

 



  

 

  

  	  try{	

       $defaultveh=DB::table('tbl_default_vehs')

       ->leftJoin('user_vehicles', 'tbl_default_vehs.veh_id', '=', 'user_vehicles.id')

       ->leftJoin('brand_lists', 'user_vehicles.vehicle_brand', '=', 'brand_lists.id')

       ->leftJoin('brand_models', 'user_vehicles.vehicle_model', '=', 'brand_models.id')

       ->leftJoin('vehicle_types', 'user_vehicles.vehicle_type', '=', 'vehicle_types.id')

       ->where('tbl_default_vehs.user_id',$user_id)

       ->select('user_vehicles.*','brand_lists.brand as brandname','brand_models.brand_model','vehicle_types.veh_img')

       ->first();

     

        if($defaultveh==null){

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

              $json_data = 0;

              echo json_encode(array('error' => false, "data" => $defaultveh, "message" => "Success"));

           }

    

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

}

public function deleteuserveh(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);



 

  $veh_id=$data1->veh_id;



  if(DB::table('user_vehicles')->where('id',$veh_id)->delete()){

    $json_data = 0;

    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

  }else{

    $json_data = 1;

    echo json_encode(array('error' => true, "data" => $json_data, "message" => "failed"));

  }



}

public function productdelete(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);



 

  $product_id=$data1->product_id;



  if(DB::table('store_lists')->where('id',$product_id)->delete()){

    $json_data = 0;

    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

  }else{

    $json_data = 1;

    echo json_encode(array('error' => true, "data" => $json_data, "message" => "failed"));

  }



}



public function soldoutproduct(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);



 

  $product_id=$data1->product_id;



  if(DB::table('store_lists')->where('id',$product_id)->update(['sale_satus' => 1])){

    $json_data = 0;

    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

  }else{

    $json_data = 1;

    echo json_encode(array('error' => true, "data" => $json_data, "message" => "failed"));

  }



}

  public function newsendOTPJango(Request $request){ 



    $postdata   = file_get_contents("php://input");					

    $json       = str_replace(array("\t","\n"), "", $postdata);

    $data       = json_decode($json);

    $mobile     = $data->mobile_number; //including coutry code eg: 91xxxxxxxxxxx



    $response = $this->sendsmsotp_jango('9898',$mobile);



    if($response['status'] == 'success'){//success



        $otp = $response['otp'];

        echo json_encode(array('error' => false, "data" => $otp, "message" => "Success"));



    }

    else{//failure



      echo json_encode(array('error' => true, "data" => '', "message" => "Failure"));



    }

 

}
public function send_testsmsotp()
{
  

    $postdata = file_get_contents("php://input");					

    $json = str_replace(array("\t","\n"), "", $postdata);

    $data1 = json_decode($json);

    $otp=$data1->otp;

    $mob=$data1->mob;

   
    $curl = curl_init();

    $authkey        =   '293880AKkOsHqp5f830090P1';
    $email          =   'alwinespylabs@gmail.com';

    // $template_id    =   '5f8c62b94b50c6314a2570c7';
    // $template_id    =   '5fc9d192733e90375b65746f';
    // $template_id    =   '628c8138a9738e16e764f1a3';
    //  $template_id    =   '6295c03e98eeb5780e215cc3';
    $template_id    =   '62ed034ed6fc0515b55c0fe4';
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

                            'email' => $email,

                            'otp_length' => 4,

                        );

    $url_with_params= $url.http_build_query($params);
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
    print_r($response);
    exit;
    $err = curl_error($curl);
  
    curl_close($curl);
    if ($err) 
    {
        $resp = array(

                    'status' => 'error',

                  );

        return $resp;



      } 
      else 
      {

        $resp = array(

                  'status' => 'success',

                  'otp'    => $otp

                );

        return $resp;
      }
  }
  public function deactivate_account()
  {
      $postdata = file_get_contents("php://input");					
      $json = str_replace(array("\t","\n"), "", $postdata);
      $data1 = json_decode($json);
      $user_id=$data1->user_id;
      $userlist=User_lists::find($user_id);
      $userlist->status =0;
      if($userlist->save())
      {
        $json_data = 0;
        echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));
      }else{
      $json_data = 1;
      echo json_encode(array('error' => true, "data" => $json_data, "message" => "failed"));
       }
  }


}

