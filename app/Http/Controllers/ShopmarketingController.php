<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Tbl_deliveryaddres;
use App\shops;
use App\shop_services;
use App\Tbl_carts;
use App\Tbl_rm_wishlists;
class ShopmarketingController extends Controller
{
  public function mhomepage(Request $request){
    try {
        $categorylist = DB::table('tbl_rm_categorys')
            ->where('status', 0)
            ->get();

        $productlist = DB::table('tbl_rm_products')
            ->join('tbl_rm_categorys', 'tbl_rm_products.cat_id', '=', 'tbl_rm_categorys.id')
            ->where('tbl_rm_products.status', 0)
            ->where('tbl_rm_categorys.status', 0)
            ->select('tbl_rm_products.*') 
            ->get();

        foreach ($productlist as $product) {
            $productId = $product->id; 

            $image = DB::table('tbl_productimages')
                ->select('images')
                ->where('prod_id', $productId)
                ->first(); 

            $product->image = $image ? $image->images : null;
        }

        if ($categorylist->isEmpty() && $productlist->isEmpty()) {
            return response()->json([
                'error' => true,
                'message' => 'No categories and products found'
            ]);
        } else {
            return response()->json([
                'error' => false,
                'categorylist' => $categorylist,
                'productlist' => $productlist,
                'message' => 'Success'
            ]);
        }
    } catch (Exception $e) {
        return response()->json([
            'error' => true,
            'message' => 'Error fetching data'
        ]);
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
    $productDetails = DB::table('tbl_rm_products')
    ->select('tbl_rm_products.*')
    ->where('tbl_rm_products.id', $productId) 
    ->where('status',0)
    ->first(); 

if ($productDetails) {
    $images = DB::table('tbl_productimages')
        ->select('images')
        ->where('prod_id', $productId)
        ->get()
        ->pluck('images')
        ->all();

    
    $productDetails->images = $images;
    
    return response()->json([
        'error' => false,
        'productdetails' => [$productDetails],
        'message' => 'Success'
    ]);
} else {
    return response()->json([
        'error' => true,
        'message' => 'Product not found'
    ]);
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

    $wishlist=DB::table('tbl_rm_wishlists')
    ->join('tbl_rm_products', 'tbl_rm_wishlists.product_id', '=', 'tbl_rm_products.id')
    ->select('tbl_rm_wishlists.*', 'tbl_rm_products.product_title', 'tbl_rm_products.discription', 'tbl_rm_products.offer_price')
    ->where('tbl_rm_wishlists.shop_id', $shopId)
    ->get();
    
    foreach ($wishlist as $product) {
        $productId = $product->product_id;  

        $image = DB::table('tbl_productimages')
            ->select('images')
            ->where('prod_id', $productId)
            ->first(); 

        $product->image = $image ? $image->images : null;
    }

    if (count($wishlist ) == 0) {
        echo json_encode(array('error' => true, 'message' => 'Error'));
    } else {                                
        echo json_encode(array('error' => false, 'wishlist ' => $wishlist , 'message' => 'Success'));
    }

} catch (Exception $e) {
    echo json_encode(array('error' => true, 'message' => 'Sorry! Please check input parameters and values'));
}
}
public function wishlistadd(){

    $postdata = file_get_contents("php://input");					
  
    $json = str_replace(array("\t","\n"), "", $postdata);
  
    $data1 = json_decode($json);
  
   
  
    $query=new Tbl_rm_wishlists;
    $query->product_id=$data1->product_id;

    $query->shop_id=$data1->shop_id;
  
 
   
  
  
    if($query->save()){
  
      $last=$query->id;
  
      echo json_encode(array('error' => false, "data" => $last, "message" => "Success"));
  
    }else{
  
      echo json_encode(array('error' => true, "message" => "Error"));
  
    }
  
   }
   public function wishlistdelete(){

    $postdata = file_get_contents("php://input");					

    $json = str_replace(array("\t","\n"), "", $postdata);

    $data1 = json_decode($json);

    $id=$data1->id;

    if(DB::table('tbl_rm_wishlists')->where('id', $id)->delete()){

    $json_data = 1;      

    echo json_encode(array('error' => false, "data" => $json_data,"message" => "success")); 

    }else{

    $json_data = 0;      

    echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

    }

}



public function cart(){
    $postdata = file_get_contents("php://input");                    
    $json = str_replace(array("\t","\n"), "", $postdata);
    $data1 = json_decode($json);
    $shopId = $data1->shop_id;

    try {    
        $cart = DB::table('tbl_carts')
            ->join('tbl_rm_products', 'tbl_carts.product_id', '=', 'tbl_rm_products.id')
            ->select('tbl_carts.*', 'tbl_rm_products.product_title', 'tbl_rm_products.discription', 'tbl_rm_products.offer_price')
            ->where('tbl_carts.shop_id', $shopId)
            ->get();

        foreach ($cart as $product) {
            $productId = $product->product_id;  

            $image = DB::table('tbl_productimages')
                ->select('images')
                ->where('prod_id', $productId)
                ->first(); 

            $product->image = $image ? $image->images : null;
        }

        if (count($cart) == 0) {
            echo json_encode(array('error' => true, 'message' => 'Error'));
        } else {                                
            echo json_encode(array('error' => false, 'cart' => $cart, 'message' => 'Success'));
        }

    } catch (Exception $e) {
        echo json_encode(array('error' => true, 'message' => 'Sorry! Please check input parameters and values'));
    }
}
public function cartadd(){

    $postdata = file_get_contents("php://input");					
  
    $json = str_replace(array("\t","\n"), "", $postdata);
  
    $data1 = json_decode($json);
  
   
  
    $query=new Tbl_carts;
    $query->product_id=$data1->product_id;

    $query->shop_id=$data1->shop_id;
  
    $query->qty=$data1->qty;
   
  
  
    if($query->save()){
  
      $last=$query->id;
  
      echo json_encode(array('error' => false, "data" => $last, "message" => "Success"));
  
    }else{
  
      echo json_encode(array('error' => true, "message" => "Error"));
  
    }
  
   }

   public function cartdelete(){

    $postdata = file_get_contents("php://input");					

    $json = str_replace(array("\t","\n"), "", $postdata);

    $data1 = json_decode($json);

    $id=$data1->id;
   

    if(DB::table('tbl_carts')->where('id', $id)->delete()){

    $json_data = 1;      

    echo json_encode(array('error' => false, "data" => $json_data,"message" => "success")); 

    }else{

    $json_data = 0;      

    echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

    }

}
public function deliveryaddressadd()
{
 $postdata = file_get_contents("php://input");					
 $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);
 $query=new Tbl_deliveryaddres;
  $query->shop_id=$data1->shop_id;

  $query->area=$data1->area;
  $query->area1=$data1->area1;
  $query->country=$data1->country;

  $query->state	=$data1->state;
  $query->district=$data1->district;
  $query->city=$data1->city;
  $query->phone=$data1->phone;


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
    ->join('tbl_rm_categorys', 'tbl_rm_products.cat_id', '=', 'tbl_rm_categorys.id')
    ->select('tbl_rm_products.*', 'tbl_rm_categorys.category_name')
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

public function deliveryaddresslist(){
    
    $postdata = file_get_contents("php://input");                    

    $json = str_replace(array("\t","\n"), "", $postdata);

    $data1 = json_decode($json);

    $shopId = $data1->shopid;
    
    try {    
        $deliveryaddress = DB::table('tbl_deliveryaddres')
            ->where('shop_id', $shopId)
            ->get();

        if ($deliveryaddress == null) {
            echo json_encode(array('error' => true, "message" => "Error"));
        } else {                                
            $json_data = 0;
            echo json_encode(array('error' => false, "deliveryaddresslist" => $deliveryaddress, "message" => "Success"));
        }
    } catch (Exception $e) {
        // Handle the exception here
        echo json_encode(array('error' => true, "message" => "An error occurred."));
    }
}
}