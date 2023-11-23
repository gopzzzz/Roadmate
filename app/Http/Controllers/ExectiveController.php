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



use App\Store_lists;



use App\Reviews;



use App\Shop_services;



use App\Mystorequerys;



use App\Storequery_answers;



use App\Package_books;



use App\Tbl_shop_offers;



use App\Shopoffer_avatimeslots;



use App\Shopoffer_customer_bookings;



use App\Product_offers;



use App\Shop_offer_models;



use App\Executives;



use App\Shop_provide_categories;



class ExectiveController extends Controller

{

	public function excutivelogin(Request $request){



  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

   $data1 = json_decode($json);

   $mob=$data1->mobnum;

  // $data=User::all();

   

  $mobilecheck=DB::table('executives')

   ->where('phonenum',$mob)

   ->value('id');



   

 if($mobilecheck==null){

    echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

   }else{

    if($mob==6282930014){
      $otp=5252;

      $authKey =  env('AUTH_KEY',"");

     // $sms="{$otp} is your Roadmate verification code. Please DO NOT share this OTP with anyone to ensure account security";



     // $sms=$otp;

      

      $this->sendsms($otp,$mob);



      $affectedRows = Executives::where('phonenum',$mob)->update(array('otp' => $otp));
    }else{
       $otp=rand(1000, 9999);
    
    

      $authKey =  env('AUTH_KEY',"");


      

      $this->sendsms($otp,$mob);



      $affectedRows = Executives::where('phonenum',$mob)->update(array('otp' => $otp));
    }

    

     



            	

   }

}

public function sendsms($otp,$mob){

  $curl = curl_init();



    $authkey        =   '293880AKkOsHqp5f830090P1';

   

    $email          =   'alwinespylabs@gmail.com';

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



     echo json_encode(array('error' => false, "data" => $otp, "message" => "Success"));



      return $resp;

      

    }





 

 



}

public function exeotp(Request $request){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $otp=$data1->otp;

  $phnum=$data1->phnum;

  $otpcheck=DB::table('executives')

   ->where('otp',$otp)

   ->where('phonenum',$phnum)

   ->get();

   if($otpcheck==null){

    echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

   }else{

    echo json_encode(array('error' => false, "data" => $otpcheck, "message" => "Success"));

   }

}

 public function executivedel(){

   $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $exeid=$data1->userid;

  try{	

   

    $executive=DB::table('executives')

   ->where('id',$exeid)

    ->get();

     

        if($executive == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false, "data" => $executive, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

 }

 

 public function exeshopreg(Request $request){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shop = new Shops;

  $mobilecheck=DB::table('shops')

  ->where('phone_number',$request->phnum)

  ->value('id');

  if($mobilecheck==null){

  if($files=$request->file('image')){  

    $name=$files->getClientOriginalName();  

    $files->move('img',$name);  

     $shop->image=$name; 

    } 

  $shop->type=$request->type;

  $shop->shopname=$request->shopname;

  $shop->status=1;

  $shop->phone_number=$request->phnum;

  $shop->phone_number2=$request->phnum2;

  $shop->description=$request->desc;

  $shop->open_time=$request->opentime;

  $shop->close_time=$request->closetime;

  $shop->agrimentverification_status=$request->agrimentverification_status;

  $shop->address=$request->address;
  
    if($request->place_id){
      
     $shops->place_id=$request->place_id;
   
  }
  

  $shop->pincode=$request->pincode;

  $shop->lattitude=$request->latitude;

  $shop->logitude=$request->logitude;

  $shop->trans_id=$request->trans_id;

  $shop->exeid=$request->exeid;

 

 if($shop->save()){

	 $otp=rand(1000, 9999);

     $authKey =  env('AUTH_KEY',"");

     // $sms="{$otp} is your Roadmate verification code. Please DO NOT share this OTP with anyone to ensure account security";

	$mob=$request->phnum;

    // $sms=$otp;

      

//	$this->sendsms($otp,$mob);



    // $affectedRows = Shops::where('phone_number',$mob)->update(array('otp' => $otp));

    

  } else{

    echo json_encode(array('error' => true, "message" => "Error"));

  }

}else{

	echo json_encode(array('error' => false, "data" => 2, "message" => "Already existed"));

}

}



public function shopreg_exe_authorised(Request $request){

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
  
  if($request->place_id){
      
     $shops->place_id=$request->place_id;
   
  }
  

  $shops->exeid=$request->exeid;

  $shops->pay_status=$request->pay_status;

 if($shops->save()){

  $lastid=$shops->id;



   $shopcat=new Shop_provide_categories;

    $shopcat->shop_id=$lastid;

    $shopcat->shop_cat_id=$request->type;

    if($shopcat->save()){


      $result=0;

      echo json_encode(array('error' => false, "data" => $result, "message" => "Success"));

       


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



public function update_paycustomer(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $exeid=$data1->exeid;

  $paystatus=$data1->paystatus; 

  $shop_id=$data1->shopid; 

  $UpdateDetails_pay = Shops::where('exeid','=',$exeid)->where('id',$shop_id)->first();

        $UpdateDetails_pay->pay_status = $paystatus;

        if($UpdateDetails_pay->save()){

          $json_data = 1;

          echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

        }else{

          $json_data = 0;

          echo json_encode(array('error' => true, "data" => $json_data, "message" => "false"));

        }

}



public function shopreg_exe_unauthorised(Request $request){

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
  
    if($request->place_id){
      
     $shops->place_id=$request->place_id;
   
  }
  

  $shops->lattitude=$request->latitude;

  $shops->logitude=$request->logitude;

  $shops->trans_id=$request->trans_id;

  $shops->exeid=$request->exeid;

  $shops->authorised_status=$request->authorised_status;

 

 if($shops->save()){

  $lastid=$shops->id;



   $shopcat=new Shop_provide_categories;

    $shopcat->shop_id=$lastid;

    $shopcat->shop_cat_id=$request->type;

    if($shopcat->save()){


      $result=0;

      echo json_encode(array('error' => false, "data" => $result, "message" => "Success"));

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



public function authorised_shop_list(){

	$postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $exeid=$data1->executiveid;

  try{	

   

    $shoplist=DB::table('shops')

   ->where('exeid',$exeid)

   ->where('authorised_status',1)

    ->get();

     

        if($shoplist == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false, "data" => $shoplist, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

}



public function shoplistexe(){

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

public function unauthorised_shop_list(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $exeid=$data1->executiveid;

  try{	

   

    $shoplist=DB::table('shops')

   ->where('exeid',$exeid)

   ->where('authorised_status',0)

    ->get();

     

        if($shoplist == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false, "data" => $shoplist, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 

}



public function visitedshop(){

$postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $exeid=$data1->userid;

  try{	

   

    $shoplist=DB::table('shops')

   ->where('exeid',$exeid)

   ->where('pay_status',0)

    ->get();

     

        if($shoplist == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false, "data" => $shoplist, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 	

}
public function uploadimage(Request $request){
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  if($files=$request->file('image')){  

    $image = $request->file('image');

    

    $image_name = time().'_'.$image->getClientOriginalName();
   
        $path = public_path('uploads/') . "/" . $image_name;
        //$files->move('uploads',$image_name); 
        Image::make($image->getRealPath())->resize(150, 150)->save($path);

        return response()->json(
          [
              'data' => 'Image compressed and added'
          ], 
          201
      );
          

    } 

}

public function addvisitedshop(Request $request){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shop = new Shops;

  $mobilecheck=DB::table('shops')

  ->where('phone_number',$request->phnum)

  ->value('id');

  if($mobilecheck==null){

  if($files=$request->file('image')){  

    $name=$files->getClientOriginalName();  

    $files->move('img',$name);  

     $shop->image=$name; 

    } 

  $shop->type=$request->type;

  $shop->shopname=$request->shopname;

  $shop->status=1;

  $shop->phone_number=$request->phnum;

  $shop->phone_number2=$request->phnum2;

  $shop->description=$request->desc;

  $shop->open_time=$request->opentime;

  $shop->close_time=$request->closetime;

  $shop->agrimentverification_status=$request->agrimentverification_status;

  $shop->address=$request->address;

  $shop->pincode=$request->pincode;

  $shop->lattitude=$request->latitude;

  $shop->logitude=$request->logitude;

  $shop->trans_id=$request->trans_id;

  $shop->exeid=$request->exeid;

  $shop->authorised_status=0;

 if($shop->save()){

	 $otp=rand(1000, 9999);

     $authKey =  env('AUTH_KEY',"");

     // $sms="{$otp} is your Roadmate verification code. Please DO NOT share this OTP with anyone to ensure account security";

	$mob=$request->phnum;

     $sms=$otp;

      

	//$this->sendsms($sms,$mob);



    // $affectedRows = Shops::where('phone_number',$mob)->update(array('otp' => $otp));

    

  } else{

    echo json_encode(array('error' => true, "message" => "Error"));

  }

}else{

	echo json_encode(array('error' => false, "data" => 2, "message" => "Already existed"));

}

}

public function visitedshoplist(Request $request){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $userid=$data1->userid;

  try{	

   

    $visitedshop=DB::table('shops')

    ->where('authorised_status',0)

    ->where('exeid',$userid)

    ->get();

     

        if($visitedshop == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false, "data" => $visitedshop, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 	

}

public function addedshoplist(){



    $postdata = file_get_contents("php://input");					

    $json = str_replace(array("\t","\n"), "", $postdata);

    $data1 = json_decode($json);

    $userid=$data1->userid;

    try{	

     

      $visitedshop=DB::table('shops')

      ->where('authorised_status',1)

      ->where('exeid',$userid)

      ->get();

       

          if($visitedshop == null){

                 

            echo json_encode(array('error' => true, "message" => "Error"));

               }

              else{								

              

              $json_data = 0;

              echo json_encode(array('error' => false, "data" => $visitedshop, "message" => "Success"));

                  }

      

    

  }

  catch (Exception $e)

  {

          

      //return Json("Sorry! Please check input parameters and values");

          echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

  } 	

}

public function custranhistory(){



  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $userid=$data1->userid;

  try{	

   

    $paymenthistory=DB::table('booktimemasters')

    ->where('customer_id',$userid)

    ->get();

     

        if($paymenthistory == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false, "data" => $paymenthistory, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

} 	

}


public function exefcmupdate(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $exeid=$data1->exeid;

  $fcmid=$data1->fcmid;

  $UpdateDetails = Executives::where('id', '=',  $exeid)->first();

        $UpdateDetails->device_tocken = $fcmid;

        if($UpdateDetails->save()){

          $json_data = 1;

          echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

        }else{

          $json_data = 0;

          echo json_encode(array('error' => true, "data" => $json_data, "message" => "false"));

        }

}

public function executivenotification(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $customerid=$data1->userid;

  try{	

     

    $notificationindividal=DB::table('tbl_notification_historys')

    ->where('user_type',3)

    ->where('user_id',$customerid)

    ->get()

    ->toArray();

    

    $notificationall=DB::table('tbl_notification_historys')

    ->where('user_type',3)

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





public function countrylist(){
    
    
    $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

 

  try{	

   

    $countrylist=DB::table('tbl_countrys')

    ->where('deleted_status',0)

    ->get();

     

        if($countrylist == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false, "data" => $countrylist, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}
public function statelist(){
    
     $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);
  
   $conid=$data1->country_id;

 

  try{	

   

    $statelist=DB::table('tbl_states')
    
    ->where('country_id',$conid)

    ->where('deleted_status',0)

    ->get();

     

        if($statelist == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false, "data" => $statelist, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
    
}
public function districtlist(){
      $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);
  
   $state=$data1->state_id;

 

  try{	

   

    $districtlist=DB::table('tbl_districts')
    
    ->where('state_id',$state)

    ->where('deleted_status',0)

    ->get();

     

        if($districtlist == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false, "data" => $districtlist, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}
public function placelist(){
    
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);
  
  $district=$data1->district_id;
   
  $type=$data1->type;

 

  try{	

   

    $placelist=DB::table('tbl_places')
    
    ->where('district_id',$district)
    
    ->where('type',$type)

    ->where('deleted_status',0)

    ->get();

     

        if($placelist == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false, "data" => $placelist, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}
public function serachplaces(){
    
    
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);
  
  $district=$data1->district_id;
   
  $type=$data1->type;
  
  $place_name=$data1->place_name;

 

  try{	

   

    $placelist=DB::table('tbl_places')
    
    ->where('district_id',$district)
    
    ->where('type',$type)

    ->where('deleted_status',0)
    
    ->where('place_name', 'LIKE', "%" . $place_name . "%")
    
    ->limit(5)

    ->get();

     

        if($placelist == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false, "data" => $placelist, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}

}