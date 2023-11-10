<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ShopmarketingController extends Controller
{
   public function mhomepage(){
    
    
    
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);
  


  try{	

   

    $categorylist=DB::table('tbl_rm_categorys')
    
    ->limit(3)

    ->get();

    $productlist=DB::table('tbl_rm_products')
    
    ->limit(6)

    ->get();

     

        if($categorylist == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false, "categorylist" => $categorylist,"productlist"=>$productlist, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}
public function categoryproductlist(){
    
    
    
    
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $categoryId=$data1->categoryid;
  


  try{	

   

   

    $productlist=DB::table('tbl_rm_products')
    
   ->where('cat_id',$categoryId)

    ->get();

     

        if($productlist == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false,"productlist"=>$productlist, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}

public function categorylist(){
    
    
    
    
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  


  try{	

   

   

    $categorylist=DB::table('tbl_rm_categorys')
     ->get();

     

        if($categorylist == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false,"categorylist"=>$categorylist, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}


public function productdetails(){
    
    
    
    
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $productId=$data1->productid;


  try{	

   

   

    $productdetails=DB::table('tbl_rm_products')

    ->where('id',$productId)

     ->get();

     

        if($productdetails == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false,"productdetails"=>$productdetails, "message" => "Success"));

                }
  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}


public function wishlist(){
    
    
    
    
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shopId=$data1->shopid;


  try{	

   

   

    $wishlist=DB::table('tbl_rm_wishlist')

    ->where('shop_id',$shopId)

     ->get();

     

        if($wishlist == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false,"wishlist"=>$wishlist, "message" => "Success"));

                }
  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}

public function cart(){
    
    
    
    
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shopId=$data1->shopid;


  try{	

   

   

    $cart=DB::table('tbl_cart')

    ->where('shop_id',$shopId)

     ->get();

     

        if($cart == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false,"cart"=>$cart, "message" => "Success"));

                }
  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}

public function deliveryaddressadd(Request $request){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  

  $delivery = new Tbl_deliveryaddres;

  $delivery->shop_id=$request->shop_id;

  $delivery->area=$request->area;

  $delivery->landmark=$request->landmark;

  $delivery->city=$request->city;

  $delivery->district=$request->district;

  $delivery->state=$request->state;

  $delivery->country=$request->country;

  $delivery->pincode=$request->pincode;

  
 if($delivery->save()){

    $json_data = 1;

    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

  } else{

    echo json_encode(array('error' => true, "message" => "Error"));

  }

}


}