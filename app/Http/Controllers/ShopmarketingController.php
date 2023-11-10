<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Tbl_deliveryaddres;
use App\shops;

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

      $productlist = DB::table('tbl_rm_products')
          ->join('tbl_rm_categorys', 'tbl_rm_products.cat_id', '=', 'tbl_rm_categorys.id')
          ->select('tbl_rm_products.*', 'tbl_rm_categorys.category_name')
          ->where('tbl_rm_products.cat_id', $categoryId) 
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

    ->first();

     

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

  $shopId=$data1->shop_id;



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

  $shopId=$data1->shop_id;



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
public function deliveryaddress(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

 

  $query=new Tbl_deliveryaddres;
  $query->shop_id=$data1->shop_id;

  $query->area=$data1->area;
  $query->landmark=$data1->landmark;
  $query->city=$data1->city;
  $query->district=$data1->district;
  $query->state=$data1->state;
  $query->country=$data1->country;
  $query->pincode=$data1->pincode;


  if($query->save()){

    $last=$query->id;

    echo json_encode(array('error' => false, "data" => $last, "message" => "Success"));

  }else{

    echo json_encode(array('error' => true, "message" => "Error"));

  }

 }

 public function product(){
    
    
    
    
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  


  try{	

   

   

    $product=DB::table('tbl_rm_products')
     ->get();

     

        if($product == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            

            $json_data = 0;

            echo json_encode(array('error' => false,"product"=>$product, "message" => "Success"));

                }

    

  

}

catch (Exception $e)

{

        

    //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}


 public function deliveryaddressupdate(){
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

 $data1 = json_decode($json);

 $deliveryid=$data1->deliveryid;
 $shop_id=$data1->shop_id;

 $deliveryaddressupdate=shops::find($shop_id);

 $deliveryaddressupdate->delivery_id=$deliveryid;


 if($deliveryaddressupdate->save()){

  $json_data = 1;

  echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

 }else{

  $json_data = 1;

  echo json_encode(array('error' => true, "data" => $json_data, "message" => "error"));

 }

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