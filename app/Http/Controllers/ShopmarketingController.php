<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Tbl_deliveryaddres;
use App\Shops;
use App\Tbl_carts;
use App\Tbl_rm_wishlists;
use App\Tbl_order_trans;
use App\Tbl_order_masters;
use App\Tbl_wallet_transactions;
use App\Tbl_cancel_orders;
use App\Tbl_product_ratings;
use App\User_lists;
use App\Tbl_b2corders;
use App\Tbl_b2cordertrans;
use App\Tbl_b2c_cancel_orders;
class ShopmarketingController extends Controller
{
  public function mhomepage(Request $request){
    try {
        $categorylist = DB::table('tbl_rm_categorys')
            ->where('status', 0)
            ->where('cat_id',0)
            ->get();

        $productlist = DB::table('tbl_brand_products')
            ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
            ->where('tbl_rm_products.status', 0)
           // ->where('tbl_rm_categorys.status', 0)
            ->select('tbl_brand_products.*') 
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
$index=$data1->index;
$offset=($index*20);
$limit=20;
  $categoryId=$data1->categoryid; 
  try{	
     if (property_exists($data1, 'type')) {
        $productlist=DB::table('tbl_brand_products')
        ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
        ->join('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
      ->select('tbl_brand_products.*','tbl_hsncodes.tax')
      ->where('tbl_rm_products.status',0)
  
        ->where('tbl_brand_products.b2c_status',0)
        ->where('tbl_rm_products.cat_id', $categoryId)
        ->orderBy('id', 'DESC')
        ->offset($offset) 
        ->limit($limit)
         ->get();
      }else{
        $productlist=DB::table('tbl_brand_products')
        ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
        ->join('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
      ->select('tbl_brand_products.*','tbl_hsncodes.tax')
      ->where('tbl_rm_products.status',0)
  
        ->where('tbl_brand_products.status',0)
        ->where('tbl_rm_products.cat_id', $categoryId)
        ->orderBy('id', 'DESC')
        ->offset($offset) 
        ->limit($limit)
         ->get();
      }
     
       
  $products = [];
  
  foreach ($productlist as $proItem) {
      $imageArray = DB::table('tbl_productimages')->where('prod_id', $proItem->id)->first();  
      //echo "<pre>";print_r($imageArray);exit;
  
      // Check if $imageArray is not null before accessing its properties
      if ($imageArray) {
          // Assuming there is a column named 'images' in tbl_productimages table
          $proItem->images = $imageArray->images;
      } else {
          // If no images are found, set it to an empty array or null, depending on your needs
          $proItem->images = "";
          // or $cartItem->images = null;
      }
  
      // Add the $cartItem to the $cart array
      $products[] = $proItem;
  }
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
    ->where('cat_id',0)
     ->where('status',0)
     ->get();
 if($categorylist == null){
        echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								
        $json_data = 0;
       echo json_encode(array('error' => false,"categorylist"=>$categorylist, "message" => "Success"));

                }}

catch (Exception $e)

{
 //return Json("Sorry! Please check input parameters and values");
 echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}
public function subcategorylist(){
      
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $cat_id=$data1->cat_id;


  try{	
       $subcatlist=DB::table('tbl_rm_categorys')
    ->where('cat_id',$cat_id)
    ->where('status',0)
    ->get();
 if($subcatlist == null){

  echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								
            $json_data = 0;

            echo json_encode(array('error' => false,"subcategorylist"=>$subcatlist, "message" => "Success"));

                }
}

catch (Exception $e)

{  //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}
public function productdetails(){
       
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $productId=$data1->productid;
  try{	
    $productDetails = DB::table('tbl_brand_products')
    ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
    ->select('tbl_brand_products.*','tbl_rm_products.cat_id')
    ->where('tbl_brand_products.id',$productId) 
    //->where('tbl_rm_products.status',0)

    // ->where('tbl_brand_products.status',0)
    ->first(); 

    $ratings = DB::table('tbl_product_ratings')
   // ->where('shopid', $shopId)
    ->where('product_id', $productId)
    //->where('type', $type)
    ->avg('rating');

    if($ratings==null){
        $stars=0;
    }else{
        $stars=$ratings;
    }

    

if ($productDetails) {
    $images = DB::table('tbl_productimages')
        ->select('images')
        ->where('prod_id',$productDetails->id)
        ->get()
        ->pluck('images')
        ->all();
$productDetails->images = $images;
    
    return response()->json([
        'error' => false,
        'productdetails' => [$productDetails],
        'rating'=>$stars,
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
  $u_type=1;
try{	
$wishlist = DB::table('tbl_rm_wishlists')
    ->join('tbl_brand_products', 'tbl_rm_wishlists.product_id', '=', 'tbl_brand_products.id')
    ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
    ->select('tbl_rm_wishlists.*', 'tbl_brand_products.offer_price', 'tbl_brand_products.price', 'tbl_brand_products.product_name', 'tbl_brand_products.description')
    ->where('tbl_rm_wishlists.shop_id', $shopId)
    ->where('tbl_rm_wishlists.u_type', $u_type)
    ->get();

// Initialize $cart outside the loop
$wish = [];

foreach ($wishlist as $cartItem) {
    $imageArray = DB::table('tbl_productimages')->where('prod_id', $cartItem->product_id)->first();

    // Check if $imageArray is not null before accessing its properties
    if ($imageArray) {
        // Assuming there is a column named 'images' in tbl_productimages table
        $cartItem->images = $imageArray->images;
    } else {
        // If no images are found, set it to an empty array or null, depending on your needs
        $cartItem->images = "";
        // or $cartItem->images = null;
    }

    // Add the $cartItem to the $cart array
    $wish[] = $cartItem;
}
 //  echo "<pre>";print_r($wish);exit;
      if($wish == null){
 echo json_encode(array('error' => true,"wishlist"=>$wish, "message" => "Error"));

             }

            else{								
 $json_data = 0;

            echo json_encode(array('error' => false,"wishlist"=>$wish, "message" => "Success"));

                }
}

catch (Exception $e)

{
 //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}
public function customerwishlist(){

    
    $postdata = file_get_contents("php://input");					

    $json = str_replace(array("\t","\n"), "", $postdata);
  
    $data1 = json_decode($json);
  
    $shopId=$data1->customerid;
    $u_type=2;
  try{	
  $wishlist = DB::table('tbl_rm_wishlists')
      ->join('tbl_brand_products', 'tbl_rm_wishlists.product_id', '=', 'tbl_brand_products.id')
      ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
      ->select('tbl_rm_wishlists.*', 'tbl_brand_products.offer_price', 'tbl_brand_products.price', 'tbl_brand_products.product_name', 'tbl_brand_products.description')
      ->where('tbl_rm_wishlists.shop_id', $shopId)
      ->where('tbl_rm_wishlists.u_type', $u_type)
      ->get();
  
  // Initialize $cart outside the loop
  $wish = [];
  
  foreach ($wishlist as $cartItem) {
      $imageArray = DB::table('tbl_productimages')->where('prod_id', $cartItem->product_id)->first();
  
      // Check if $imageArray is not null before accessing its properties
      if ($imageArray) {
          // Assuming there is a column named 'images' in tbl_productimages table
          $cartItem->images = $imageArray->images;
      } else {
          // If no images are found, set it to an empty array or null, depending on your needs
          $cartItem->images = "";
          // or $cartItem->images = null;
      }
  
      // Add the $cartItem to the $cart array
      $wish[] = $cartItem;
  }
   //  echo "<pre>";print_r($wish);exit;
        if($wish == null){
   echo json_encode(array('error' => true,"wishlist"=>$wish, "message" => "Error"));
  
               }
  
              else{								
   $json_data = 0;
  
              echo json_encode(array('error' => false,"wishlist"=>$wish, "message" => "Success"));
  
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
  $u_type=1;
try{	
$cartlist = DB::table('tbl_carts')
    ->join('tbl_brand_products', 'tbl_carts.product_id', '=', 'tbl_brand_products.id')
    ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
    ->join('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
    //->select('tbl_brand_products.*','tbl_hsncodes.tax')
    ->select('tbl_carts.*','tbl_hsncodes.tax','tbl_brand_products.offer_price', 'tbl_brand_products.price', 'tbl_brand_products.product_name', 'tbl_brand_products.description')
   
    ->where('tbl_carts.shop_id', $shopId)
    ->where('tbl_carts.u_type', $u_type)
    ->get();

// Initialize $cart outside the loop
$cart = [];

foreach ($cartlist as $cartItem) {
    $imageArray = DB::table('tbl_productimages')->where('prod_id', $cartItem->product_id)->first();

    // Check if $imageArray is not null before accessing its properties
    if ($imageArray) {
        // Assuming there is a column named 'images' in tbl_productimages table
        $cartItem->images = $imageArray->images;
    } else {
        // If no images are found, set it to an empty array or null, depending on your needs
        $cartItem->images = "";
        // or $cartItem->images = null;
    }

    // Add the $cartItem to the $cart array
    $cart[] = $cartItem;
}

if (empty($cart)) {
    echo json_encode(array('error' => true,"cart" => $cart, "message" => "Error"));
} else {
    echo json_encode(array('error' => false, "cart" => $cart, "message" => "Success"));
}
}

catch (Exception $e)

{
//return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}
public function customercart(){
    $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shopId=$data1->customerid;
  $u_type=2;
try{	
$cartlist = DB::table('tbl_carts')
    ->join('tbl_brand_products', 'tbl_carts.product_id', '=', 'tbl_brand_products.id')
    ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
    ->join('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
    //->select('tbl_brand_products.*','tbl_hsncodes.tax')
    ->select('tbl_carts.*','tbl_hsncodes.tax','tbl_brand_products.selling_rate', 'tbl_brand_products.selling_mrp', 'tbl_brand_products.product_name', 'tbl_brand_products.description')
   
    ->where('tbl_carts.shop_id', $shopId)
    ->where('tbl_carts.u_type', $u_type)
    ->get();

// Initialize $cart outside the loop
$cart = [];

foreach ($cartlist as $cartItem) {
    $imageArray = DB::table('tbl_productimages')->where('prod_id', $cartItem->product_id)->first();

    // Check if $imageArray is not null before accessing its properties
    if ($imageArray) {
        // Assuming there is a column named 'images' in tbl_productimages table
        $cartItem->images = $imageArray->images;
    } else {
        // If no images are found, set it to an empty array or null, depending on your needs
        $cartItem->images = "";
        // or $cartItem->images = null;
    }

    // Add the $cartItem to the $cart array
    $cart[] = $cartItem;
}

if (empty($cart)) {
    echo json_encode(array('error' => true,"cart" => $cart, "message" => "Error"));
} else {
    echo json_encode(array('error' => false, "cart" => $cart, "message" => "Success"));
}
}

catch (Exception $e)

{
//return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}
public function deliveryaddressadd()
{
 $postdata = file_get_contents("php://input");					
 $json = str_replace(array("\t","\n"), "", $postdata);
 $data1 = json_decode($json);
 $query=new Tbl_deliveryaddres;
  $query->shop_id=$data1->shop_id;
  $query->u_type=1;
$query->area=$data1->area;
  $query->area1=$data1->area1;
  $query->country=$data1->country;
$query->state	=$data1->state;
  $query->district=$data1->district;
  $query->city=$data1->area1;
  $query->phone=$data1->phone;
  $query->pincode=$data1->pincode;if($query->save()){

    $last=$query->id;

    echo json_encode(array('error' => false, "data" => $last, "message" => "Success"));

  }else{

    echo json_encode(array('error' => true, "message" => "Error"));

  }

}
public function customerdeliveryaddressadd(){

    $postdata = file_get_contents("php://input");					
    $json = str_replace(array("\t","\n"), "", $postdata);
    $data1 = json_decode($json);
    $query=new Tbl_deliveryaddres;
     $query->shop_id=$data1->shop_id;
     $query->u_type=2;
   $query->area=$data1->area;
     $query->area1=$data1->area1;
     $query->country=$data1->country;
   $query->state	=$data1->state;
     $query->district=$data1->district;
     $query->city=$data1->area1;
     $query->phone=$data1->phone;
     $query->pincode=$data1->pincode;if($query->save()){
   
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

  $index=$data1->index;
  $offset=($index*20);
  $limit=20;
 try{	
    if (property_exists($data1, 'type')) {
        $productlist=DB::table('tbl_brand_products')
        ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
        ->join('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
        ->select('tbl_brand_products.*','tbl_hsncodes.tax')
        ->orderBy('id', 'DESC')
        ->where('tbl_rm_products.status',0)
    
        ->where('tbl_brand_products.b2c_status',0)
        ->offset($offset) 
        ->limit($limit) 
         ->get();
    }else{
        $productlist=DB::table('tbl_brand_products')
        ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
        ->join('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
        ->select('tbl_brand_products.*','tbl_hsncodes.tax')
        ->orderBy('id', 'DESC')
        ->where('tbl_rm_products.status',0)
    
        ->where('tbl_brand_products.status',0)
        ->offset($offset) 
        ->limit($limit) 
         ->get();
    }
 
       $products = [];

foreach ($productlist as $proItem) {
    $imageArray = DB::table('tbl_productimages')->where('prod_id', $proItem->id)->first();
    
    //echo "<pre>";print_r($imageArray);exit;

    // Check if $imageArray is not null before accessing its properties
    if ($imageArray) {
        // Assuming there is a column named 'images' in tbl_productimages table
        $proItem->images = $imageArray->images;
    } else {
        // If no images are found, set it to an empty array or null, depending on your needs
        $proItem->images = "";
        // or $cartItem->images = null;
    }

    // Add the $cartItem to the $cart array
    $products[] = $proItem;
}
 if($productlist == null){
 echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

             $json_data = 0;

            echo json_encode(array('error' => false,"product"=>$products, "message" => "Success"));

                }
}

catch (Exception $e)

{
  //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}
public function priorityproducts(){
    $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

 
 try{	

    $productlist=DB::table('tbl_brand_products')
    ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
    ->join('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
    ->select('tbl_brand_products.*','tbl_hsncodes.tax')
    ->orderBy('id', 'DESC')
    ->where('tbl_brand_products.status',0)
    ->where('tbl_brand_products.priority',1)
     ->get();
       $products = [];

foreach ($productlist as $proItem) {
    $imageArray = DB::table('tbl_productimages')->where('prod_id', $proItem->id)->first();
    
    //echo "<pre>";print_r($imageArray);exit;

    // Check if $imageArray is not null before accessing its properties
    if ($imageArray) {
        // Assuming there is a column named 'images' in tbl_productimages table
        $proItem->images = $imageArray->images;
    } else {
        // If no images are found, set it to an empty array or null, depending on your needs
        $proItem->images = "";
        // or $cartItem->images = null;
    }

    // Add the $cartItem to the $cart array
    $products[] = $proItem;
}


 if($productlist == null){
 echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

             $json_data = 0;

            echo json_encode(array('error' => false,"product"=>$productlist, "message" => "Success"));

                }
}

catch (Exception $e)

{
  //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}

public function brandfilter(){
    $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $brand_id=$data1->brand_id;
  
   $index=$data1->index;
    $offset=($index*20);
    $limit=20;
  try{	

    if (property_exists($data1, 'type')) {

        $productlist=DB::table('tbl_brand_products')
        ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
        ->join('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
        ->select('tbl_brand_products.*','tbl_hsncodes.tax')
        ->where('tbl_brand_products.brand_id',$brand_id)
        ->where('tbl_rm_products.status',0)
  
        ->where('tbl_brand_products.b2c_status',0)
        ->orderBy('id', 'DESC')

          ->offset($offset) 
          ->limit($limit) 
         ->get();
    }else{
        
  $productlist=DB::table('tbl_brand_products')
  ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
  ->join('tbl_hsncodes', 'tbl_brand_products.hsncode', '=', 'tbl_hsncodes.id')
  ->select('tbl_brand_products.*','tbl_hsncodes.tax')
  ->where('tbl_brand_products.brand_id',$brand_id)
  ->where('tbl_rm_products.status',0)
  
            ->where('tbl_brand_products.status',0)
  ->orderBy('id', 'DESC')
    ->offset($offset) 
    ->limit($limit) 
   ->get();
    }

     
     
        $products = [];

foreach ($productlist as $proItem) {
    $imageArray = DB::table('tbl_productimages')->where('prod_id', $proItem->id)->first();
    
    //echo "<pre>";print_r($imageArray);exit;

    // Check if $imageArray is not null before accessing its properties
    if ($imageArray) {
        // Assuming there is a column named 'images' in tbl_productimages table
        $proItem->images = $imageArray->images;
    } else {
        // If no images are found, set it to an empty array or null, depending on your needs
        $proItem->images = "";
        // or $cartItem->images = null;
    }

    // Add the $cartItem to the $cart array
    $products[] = $proItem;
}
        if($productlist == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

             $json_data = 0;

            echo json_encode(array('error' => false,"product"=>$products, "message" => "Success"));

                }
}

catch (Exception $e)

{
  //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}
public function searchproduct(){
    $postdata = file_get_contents("php://input");					

    $json = str_replace(array("\t","\n"), "", $postdata);
  
    $data1 = json_decode($json);
  
    $search=$data1->productname;
    $index=$data1->index;
    $offset=($index*20);
    $limit=20;
    try{	

       if (property_exists($data1, 'type')) {
            $productlist=DB::table('tbl_brand_products')
            ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
            ->select('tbl_brand_products.*')
            ->orWhere('tbl_brand_products.product_name', 'like', "%{$search}%")
            ->offset($offset) 
            ->limit($limit) 
            ->where('tbl_rm_products.status',0)
  
            ->where('tbl_brand_products.b2c_status',0)
             ->get();
        }else{
            $productlist=DB::table('tbl_brand_products')
            ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
            ->select('tbl_brand_products.*')
            ->orWhere('tbl_brand_products.product_name', 'like', "%{$search}%")
            ->offset($offset) 
            ->limit($limit) 
              ->where('tbl_rm_products.status',0)
  
             ->where('tbl_brand_products.status',0)
             ->get();
        }

    
       
       
          $products = [];
  
  foreach ($productlist as $proItem) {
      $imageArray = DB::table('tbl_productimages')->where('prod_id', $proItem->id)->first();
      
      //echo "<pre>";print_r($imageArray);exit;
  
      // Check if $imageArray is not null before accessing its properties
      if ($imageArray) {
          // Assuming there is a column named 'images' in tbl_productimages table
          $proItem->images = $imageArray->images;
      } else {
          // If no images are found, set it to an empty array or null, depending on your needs
          $proItem->images = "";
          // or $cartItem->images = null;
      }
  
      // Add the $cartItem to the $cart array
      $products[] = $proItem;
  }
  
 if($productlist == null){
   echo json_encode(array('error' => true, "message" => "Error"));
  
               }
  
              else{								
  
               $json_data = 0;
  
              echo json_encode(array('error' => false,"product"=>$products, "message" => "Success"));
  
                  }
  }
  
  catch (Exception $e)
  
  {
    //return Json("Sorry! Please check input parameters and values");
  
          echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));
  
  }
}
public function brand_list(){
    
    
    $postdata = file_get_contents("php://input");                    

    $json = str_replace(array("\t","\n"), "", $postdata);

    $data1 = json_decode($json);

    $subcat_id=$data1->subcat_id;

    // $shopId = $data1->shopid;
    
    try {    
        $brandlist = DB::table('tbl_rm_products')
            ->where('cat_id', $subcat_id)
            ->where('status', 0)
            ->get();

        if ($brandlist == null) {
            echo json_encode(array('error' => true, "message" => "Error"));
        } else {                                
            $json_data = 0;
            echo json_encode(array('error' => false, "brandlist" => $brandlist, "message" => "Success"));
        }
    } catch (Exception $e) {
        // Handle the exception here
        echo json_encode(array('error' => true, "message" => "An error occurred."));
    }
}


 public function deliveryaddressupdate(){

  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

 $data1 = json_decode($json);

 $deliveryid=$data1->deliveryid;
 $shop_id=$data1->shop_id;

 $deliveryaddressupdate=Shops::find($shop_id);

 $deliveryaddressupdate->delivery_id=$deliveryid;


 if($deliveryaddressupdate->save()){

  $json_data = 1;

  echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

 }else{

  $json_data = 1;

  echo json_encode(array('error' => true, "data" => $json_data, "message" => "error"));

 }
}
public function deliveryaddressdelete(){
    $postdata = file_get_contents("php://input");					

    $json = str_replace(array("\t","\n"), "", $postdata);
  
   $data1 = json_decode($json);
  
   $deliveryid=$data1->deliveryid;
   
  
  
  
  
   if(DB::table('tbl_deliveryaddres')->where('id',$deliveryid)->delete()){
  
    $json_data = 1;
  
    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));
  
   }else{
  
    $json_data = 1;
  
    echo json_encode(array('error' => true, "data" => $json_data, "message" => "error"));
  
   }
}
public function customerdeliveryaddressupdate(){
    $postdata = file_get_contents("php://input");	
    $json = str_replace(array("\t","\n"), "", $postdata);

 $data1 = json_decode($json);

 $deliveryid=$data1->deliveryid;
 $shop_id=$data1->customerid;

 $deliveryaddressupdate=user_lists::find($shop_id);

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
            ->where('u_type',1)
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
public function customerdeliveryaddresslist(){
    $postdata = file_get_contents("php://input");                    

    $json = str_replace(array("\t","\n"), "", $postdata);

    $data1 = json_decode($json);

    $shopId = $data1->shopid;
    
    try {  

        $deliveryaddress = DB::table('tbl_deliveryaddres')
            ->where('shop_id', $shopId)
            ->where('u_type', 2)
            ->get();


            $addreesId=DB::table('user_lists')->where('id',$shopId)->get()

            ->toArray();

            

    

     
       //print_r($bookedtime);exit;

      // For removing object and converting to one dimensional array

       $addreesId = array_column( array_map( function($value) { return (array)$value; }, $addreesId ),'delivery_id');

    

       $deliveryAddlist=array();

       for($i=0;$i<count($deliveryaddress);$i++){

        

        

          if(in_array($deliveryaddress[$i]->id, $addreesId)){  //If booking is present

            

              $data = array(

                    'id' => $deliveryaddress[$i]->id,
                      'u_type' => $deliveryaddress[$i]->u_type,
                        'shop_id' => $deliveryaddress[$i]->shop_id,
                          'area' => $deliveryaddress[$i]->area,
                            'area1' => $deliveryaddress[$i]->area1,
                              'country' => $deliveryaddress[$i]->country,
                                'state' => $deliveryaddress[$i]->state,
'district' => $deliveryaddress[$i]->district,
'city' => $deliveryaddress[$i]->city,
'phone' => $deliveryaddress[$i]->phone,
'pincode' => $deliveryaddress[$i]->pincode,

                    'status' => 1);

            }else{//If booking is not present
 $data = array(

                    'id' => $deliveryaddress[$i]->id,
                      'u_type' => $deliveryaddress[$i]->u_type,
                        'shop_id' => $deliveryaddress[$i]->shop_id,
                          'area' => $deliveryaddress[$i]->area,
                            'area1' => $deliveryaddress[$i]->area1,
                              'country' => $deliveryaddress[$i]->country,
                                'state' => $deliveryaddress[$i]->state,
'district' => $deliveryaddress[$i]->district,
'city' => $deliveryaddress[$i]->city,
'phone' => $deliveryaddress[$i]->phone,
'pincode' => $deliveryaddress[$i]->pincode,

                    'status' => 0);

            }

          //  echo "<pre>";print_r($data);exit;

            array_push($deliveryAddlist,$data);

    

       } 

       
         

      

    

            if($deliveryAddlist==null){

              echo json_encode(array('error' => true, "message" => "Error"));

                 }

                else{								

                  $json_data = 0;

                  echo json_encode(array('error' => false, "data" => $deliveryAddlist, "message" => "Success"));

               }

             


    

     
    } catch (Exception $e) {
        // Handle the exception here
        echo json_encode(array('error' => true, "message" => "An error occurred."));
    }
}
public function placeorder(){
  

    $postdata = file_get_contents("php://input");					

   $json = str_replace(array("\t","\n"), "", $postdata);

   $data1 = json_decode($json);

   $wallet=DB::table('tbl_wallets')->where('shop_id',$data1->shop_id)->first();
   if($wallet){
    $walletamount=$wallet->wallet_amount;
    if($walletamount>=$data1->wallet_redeem_id){

   $lastrow=DB::table('tbl_order_masters')->orderBy('id', 'DESC')->first();
   if($lastrow){
   $order_id=$lastrow->order_id+1;
   }else{
    $order_id=1000;
   }

   $order=new Tbl_order_masters;
   $order->shop_id=$data1->shop_id;
   $order->order_id=$order_id;
   $order->total_amount=$data1->total_amount;
   $order->discount=$data1->discount;
   $order->coupen_id=$data1->coupen_id;
   $order->wallet_redeem_id=$data1->wallet_redeem_id;
   $order->payment_mode=$data1->payment_mode;
   $order->total_mrp=$data1->total_mrp;
   $order->shipping_charge=$data1->shipping_charge;
   $order->tax_amount=$data1->tax_amount;
   $order->payment_status=$data1->payment_status;
   $order->order_status=$data1->order_status;
   $order->delivery_date=$data1->delivery_date;
   $order->order_date=$data1->order_date;
   $order->save();

   $orderid=$order->id; 
    //echo $walletamount;exit;
    
       // echo "hi";exit;
        $wamount=$walletamount-$data1->wallet_redeem_id;
        DB::table('tbl_wallets')
        ->where('id',$wallet->id)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('wallet_amount' => $wamount)); 

        // DB::table('tbl_wallet_trabsactions')->insertGetId(
        //     [
        //       'type' => 2,
        //       'amount' => $data1->wallet_redeem_id,
        //       'shop_id' => $data1->shop_id,
        //       'created_at'=>date('Y-m-d H:i:s'),
        //       'updated_at'=>date('Y-m-d H:i:s')
        //     ]
        //   );

        $his=new Tbl_wallet_transactions;
        $his->u_type=1;
        $his->type=2;
        $his->amount=$data1->wallet_redeem_id;
        $his->shop_id=$data1->shop_id;
        $his->save();
   foreach($data1->orderlist as $singlelist){	
      $trans = new Tbl_order_trans();

      $trans->product_id = $singlelist->product_id;

      $trans->order_id =$orderid;

      $trans->qty = $singlelist->qty;

      $trans->offer_amount	 = $singlelist->offer_amount;

      $trans->price = $singlelist->price;

      $trans->taxable_amount = $singlelist->taxable_amount;

      $trans->save();

      $check=DB::table('tbl_carts')->where('shop_id',$data1->shop_id)->where('product_id',$singlelist->product_id)->first();
      if($check){
        DB::table('tbl_carts')->where('id',$check->id)->delete();
      }
}
        $json_data = 1;     

        echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));
    }else{
        $json_data = 0;     

        echo json_encode(array('error' => true, "data" => $json_data, "message" => "insufficient amount"));
    }
 
    }else{
        $json_data = 0;     

        echo json_encode(array('error' => true, "data" => $json_data, "message" => "insufficient amount"));
    }
 } 

 public function customerplaceorder(){
    $postdata = file_get_contents("php://input");					

    $json = str_replace(array("\t","\n"), "", $postdata);
 
    $data1 = json_decode($json);
 
    // $wallet=DB::table('user_lists')->where('id',$data1->customer_id)->first();
    // if($wallet){
    //  $walletamount=$wallet->wallet_amount;
    //  if($walletamount>=$data1->wallet_redeem_id){
 
    $lastrow=DB::table('tbl_b2corders')->orderBy('id', 'DESC')->first();
    if($lastrow){
    $order_id=$lastrow->order_id+1;
    }else{
     $order_id=1000;
    }
 
    $order=new Tbl_b2corders;
    $order->shop_id=$data1->customer_id;
    $order->order_id=$order_id;
    $order->total_amount=$data1->total_amount;
    $order->discount=$data1->discount;
    $order->coupen_id=$data1->coupen_id;
    $order->wallet_redeem_id=$data1->wallet_redeem_id;
    $order->payment_mode=$data1->payment_mode;
    $order->selling_mrp=$data1->total_mrp;
    $order->shipping_charge=$data1->shipping_charge;
    $order->tax_amount=$data1->tax_amount;
    $order->payment_status=$data1->payment_status;
    $order->order_status=$data1->order_status;
    $order->sale_status=0;
    $order->delivery_date=$data1->delivery_date;
    $order->order_date=$data1->order_date;
    $order->save();
 
    $orderid=$order->id; 
     //echo $walletamount;exit;
     
        // echo "hi";exit;
        //  $wamount=$walletamount-$data1->wallet_redeem_id;
        //  DB::table('user_lists')
        //  ->where('id',$wallet->id)  // find your user by their email
        //  ->limit(1)  // optional - to ensure only one record is updated.
        //  ->update(array('wallet_amount' => $wamount)); 
 
         // DB::table('tbl_wallet_trabsactions')->insertGetId(
         //     [
         //       'type' => 2,
         //       'amount' => $data1->wallet_redeem_id,
         //       'shop_id' => $data1->shop_id,
         //       'created_at'=>date('Y-m-d H:i:s'),
         //       'updated_at'=>date('Y-m-d H:i:s')
         //     ]
         //   );
 
        //  $his=new Tbl_wallet_transactions;
        //  $his->u_type=2;
        //  $his->type=2;
        //  $his->amount=$data1->wallet_redeem_id;
        //  $his->shop_id=$data1->customer_id;
        //  $his->save();
    foreach($data1->orderlist as $singlelist){	
       $trans = new Tbl_b2cordertrans();
 
       $trans->product_id = $singlelist->product_id;
 
       $trans->order_id =$orderid;
 
       $trans->qty = $singlelist->qty;
 
       $trans->selling_rate	= $singlelist->selling_rate;
 
       $trans->price = $singlelist->selling_mrp;
 
       $trans->taxable_amount = $singlelist->taxable_amount;

       $trans->order_status =0;
 
       $trans->save();
 
       $check=DB::table('tbl_carts')->where('u_type',2)->where('shop_id',$data1->customer_id)->where('product_id',$singlelist->product_id)->first();
       if($check){
         DB::table('tbl_carts')->where('id',$check->id)->delete();
       }
 }
         $json_data = 1;     
 
         echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));
    //  }else{
    //      $json_data = 0;     
 
    //      echo json_encode(array('error' => true, "data" => $json_data, "message" => "insufficient amount"));
    //  }
  
    //  }else{
    //      $json_data = 0;     
 
    //      echo json_encode(array('error' => true, "data" => $json_data, "message" => "insufficient amount"));
    //  }
 }

 public function cartadd(){

    $postdata = file_get_contents("php://input");					
  
    $json = str_replace(array("\t","\n"), "", $postdata);
  
    $data1 = json_decode($json);


    $check=DB::table('tbl_carts')->where('product_id',$data1->product_id)->where('shop_id',$data1->shop_id)->where('u_type',1)->first();
    if($check){

        $cartupdate=Tbl_carts::find($check->id);
        $cartupdate->qty=$check->qty+1;
       
        if($cartupdate->save()){
       
         $json_data = 1;
       
         echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));
       
        }else{
       
         $json_data = 1;
       
         echo json_encode(array('error' => true, "data" => $json_data, "message" => "error"));
       
        }

    }else{
        $query=new Tbl_carts;
        $query->product_id=$data1->product_id;

        $query->u_type=1;
    
        $query->shop_id=$data1->shop_id;
      
        $query->qty=$data1->qty;
       
      
      
        if($query->save()){
      
          $last=$query->id;
      
          echo json_encode(array('error' => false, "data" => $last, "message" => "Success"));
      
        }else{
      
          echo json_encode(array('error' => true, "message" => "Error"));
      
        }
    }
   }
   public function customercartadd(){
    $postdata = file_get_contents("php://input");					
  
    $json = str_replace(array("\t","\n"), "", $postdata);
  
    $data1 = json_decode($json);


    $check=DB::table('tbl_carts')->where('product_id',$data1->product_id)->where('shop_id',$data1->customerid)->where('u_type',2)->first();
    if($check){

        $cartupdate=Tbl_carts::find($check->id);
        $cartupdate->qty=$check->qty+1;
        
        if($cartupdate->save()){
       
         $json_data = 1;
       
         echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));
       
        }else{
       
         $json_data = 1;
       
         echo json_encode(array('error' => true, "data" => $json_data, "message" => "error"));
       
        }

    }else{
        $query=new Tbl_carts;
        $query->product_id=$data1->product_id;

        $query->u_type=2;
    
        $query->shop_id=$data1->customerid;
      
        $query->qty=$data1->qty;
       
      
      
        if($query->save()){
      
          $last=$query->id;
      
          echo json_encode(array('error' => false, "data" => $last, "message" => "Success"));
      
        }else{
      
          echo json_encode(array('error' => true, "message" => "Error"));
      
        }
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

  
public function wishlistadd(){

    $postdata = file_get_contents("php://input");					
  
    $json = str_replace(array("\t","\n"), "", $postdata);
  
    $data1 = json_decode($json);
    $query=new Tbl_rm_wishlists;
    $query->u_type=$data1->u_type;
    $query->product_id=$data1->product_id;

    $query->shop_id=$data1->shop_id;
    if($query->save()){
  
      $last=$query->id;
  
      echo json_encode(array('error' => false, "data" => $last, "message" => "Success"));
  
    }else{
  
      echo json_encode(array('error' => true, "message" => "Error"));
  
    }
  
   }
   public function cuswishlistadd(){
    $postdata = file_get_contents("php://input");					
  
    $json = str_replace(array("\t","\n"), "", $postdata);
  
    $data1 = json_decode($json);
    $query=new Tbl_rm_wishlists;
    $query->u_type=2;
    $query->product_id=$data1->product_id;

    $query->shop_id=$data1->customer_id;
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

    $shop_id=$data1->shop_id;
    $product_id=$data1->product_id;
    $u_type=1;

    if(DB::table('tbl_rm_wishlists')->where('shop_id',$shop_id)->where('product_id',$product_id)->where('u_type',$u_type)->delete()){

    $json_data = 1;      

    echo json_encode(array('error' => false, "data" => $json_data,"message" => "success")); 

    }else{

    $json_data = 0;      

    echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

    }

}
public function customerwishlistdelete(){


    $postdata = file_get_contents("php://input");					

    $json = str_replace(array("\t","\n"), "", $postdata);

    $data1 = json_decode($json);

    $shop_id=$data1->customerid;
    $product_id=$data1->product_id;
    $u_type=2;

    if(DB::table('tbl_rm_wishlists')->where('shop_id',$shop_id)->where('product_id',$product_id)->where('u_type',$u_type)->delete()){

    $json_data = 1;      

    echo json_encode(array('error' => false, "data" => $json_data,"message" => "success")); 

    }else{

    $json_data = 0;      

    echo json_encode(array('error' => true, "data" => $json_data,"message" => "Error"));

    }
}
public function updateqty(){
    $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

 $data1 = json_decode($json);

 $cartid=$data1->cartid;
 $qty=$data1->qty;

 $cartupdate=Tbl_carts::find($cartid);

 $cartupdate->qty=$qty;


 if($cartupdate->save()){

  $json_data = 1;

  echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

 }else{

  $json_data = 1;

  echo json_encode(array('error' => true, "data" => $json_data, "message" => "error"));

 }

}
public function customerorderhistory(){
    
     
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shop_id=$data1->customerid;
  $index=$data1->index;
  $offset=($index*10);
  $limit=10;


  try{	

    $products=DB::table('tbl_b2cordertrans')
    ->join('tbl_b2corders', 'tbl_b2cordertrans.order_id', '=', 'tbl_b2corders.id')
    ->join('tbl_brand_products', 'tbl_b2cordertrans.product_id', '=', 'tbl_brand_products.id')
    ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
    ->select('tbl_b2cordertrans.*','tbl_b2corders.order_status as status','tbl_brand_products.product_name','tbl_brand_products.product_name')
   ->where('tbl_b2corders.order_status',3)
    ->where('tbl_b2corders.shop_id',$shop_id)
    ->offset($offset) 
      ->limit($limit) 
      ->orderBy('tbl_b2cordertrans.id', 'DESC')
    ->get();
    $order_list = [];
    foreach ($products as $proItem) {
        $imageArray = DB::table('tbl_productimages')->where('prod_id',$proItem->product_id)->first();
        
        //echo "<pre>";print_r($imageArray);exit;
    
        // Check if $imageArray is not null before accessing its properties
        if ($imageArray) {
            // Assuming there is a column named 'images' in tbl_productimages table
            $proItem->images = $imageArray->images;
        } else {
            // If no images are found, set it to an empty array or null, depending on your needs
            $proItem->images = "";
            // or $cartItem->images = null;
        }
    
        // Add the $cartItem to the $cart array
        $order_list[] = $proItem;
    }

        if($order_list == null){

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            $json_data = 0;

            echo json_encode(array('error' => false,"order_history"=>$order_list, "message" => "Success"));

                }
}

catch (Exception $e)

{
  //return Json("Sorry! Please check input parameters and values");
   echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

}
public function upcomingorders(){
       
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shop_id=$data1->customerid;
  $index=$data1->index;
  $offset=($index*10);
  $limit=10;


  try{	

    $products=DB::table('tbl_b2cordertrans')
    ->join('tbl_b2corders', 'tbl_b2cordertrans.order_id', '=', 'tbl_b2corders.id')
    ->join('tbl_brand_products', 'tbl_b2cordertrans.product_id', '=', 'tbl_brand_products.id')
    ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
    ->select('tbl_b2cordertrans.*','tbl_b2corders.order_status as status','tbl_brand_products.product_name','tbl_brand_products.product_name')
   ->where('tbl_b2corders.order_status','!=',3)
    ->where('tbl_b2corders.shop_id',$shop_id)
    ->offset($offset) 
      ->limit($limit) 
      ->orderBy('tbl_b2cordertrans.id', 'DESC')
    ->get();
    $order_list = [];
    foreach ($products as $proItem) {
        $imageArray = DB::table('tbl_productimages')->where('prod_id',$proItem->product_id)->first();
        
        //echo "<pre>";print_r($imageArray);exit;
    
        // Check if $imageArray is not null before accessing its properties
        if ($imageArray) {
            // Assuming there is a column named 'images' in tbl_productimages table
            $proItem->images = $imageArray->images;
        } else {
            // If no images are found, set it to an empty array or null, depending on your needs
            $proItem->images = "";
            // or $cartItem->images = null;
        }
    
        // Add the $cartItem to the $cart array
        $order_list[] = $proItem;
    }

        if($order_list == null){

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            $json_data = 0;

            echo json_encode(array('error' => false,"order_history"=>$order_list, "message" => "Success"));

                }
}

catch (Exception $e)

{
  //return Json("Sorry! Please check input parameters and values");
   echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

}

public function orderhistory(){
     
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shop_id=$data1->shop_id;
  $index=$data1->index;
  $offset=($index*10);
  $limit=10;


  try{	

    $order_list=DB::table('tbl_order_masters')
    ->where('shop_id',$shop_id)
    ->offset($offset) 
      ->limit($limit) 
      ->orderBy('id', 'DESC')
    ->get();

        if($order_list == null){

          echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								

            $json_data = 0;

            echo json_encode(array('error' => false,"order_history"=>$order_list, "message" => "Success"));

                }
}

catch (Exception $e)

{
  //return Json("Sorry! Please check input parameters and values");
   echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

}

public function vieworder(){     
  $postdata = file_get_contents("php://input");					
  $json = str_replace(array("\t","\n"), "", $postdata);
  $data1 = json_decode($json);
  $order_id=$data1->order_id;
  try{	
    $products=DB::table('tbl_order_trans')
    ->join('tbl_order_masters', 'tbl_order_trans.order_id', '=', 'tbl_order_masters.id')
    ->join('tbl_brand_products', 'tbl_order_trans.product_id', '=', 'tbl_brand_products.id')
    ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
    ->select('tbl_order_masters.*','tbl_brand_products.id as pro_id','tbl_order_trans.id as trans_id','tbl_order_trans.qty', 'tbl_order_trans.offer_amount', 'tbl_order_trans.price', 'tbl_order_trans.taxable_amount','tbl_brand_products.product_name','tbl_order_trans.order_status as product_status')
    
    ->where('tbl_order_masters.id',$order_id)
   // ->where('status',0)
    ->get();
    $order_list = [];
    foreach ($products as $proItem) {
        $imageArray = DB::table('tbl_productimages')->where('prod_id', $proItem->pro_id)->first();
        
        //echo "<pre>";print_r($imageArray);exit;
    
        // Check if $imageArray is not null before accessing its properties
        if ($imageArray) {
            // Assuming there is a column named 'images' in tbl_productimages table
            $proItem->images = $imageArray->images;
        } else {
            // If no images are found, set it to an empty array or null, depending on your needs
            $proItem->images = "";
            // or $cartItem->images = null;
        }
    
        // Add the $cartItem to the $cart array
        $order_list[] = $proItem;
    }
 if($order_list == null){
 echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								
 $json_data = 0;
 echo json_encode(array('error' => false,"order_history"=>$order_list, "message" => "Success"));

                }
            }

catch (Exception $e)

{
//return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}

}
public function orderdetails(){
    $postdata = file_get_contents("php://input");					
  $json = str_replace(array("\t","\n"), "", $postdata);
  $data1 = json_decode($json);
  $order_id=$data1->order_id;

  $shopId = $data1->customer_id;

  $productId = $data1->productid;

  $type = $data1->type;
  try{	
   

    $products=DB::table('tbl_b2cordertrans')
    ->join('tbl_b2corders', 'tbl_b2cordertrans.order_id', '=', 'tbl_b2corders.id')
    ->join('tbl_brand_products', 'tbl_b2cordertrans.product_id', '=', 'tbl_brand_products.id')
    ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
    ->select('tbl_b2cordertrans.*','tbl_brand_products.product_name','tbl_b2corders.order_status as status','tbl_b2corders.order_id as salesorderid')
    
    ->where('tbl_b2cordertrans.id',$order_id)
   // ->where('status',0)
    ->get();

    $ratings = DB::table('tbl_product_ratings')
    ->where('shopid', $shopId)
    ->where('product_id', $productId)
    ->where('type', $type)
    ->first();

    if($ratings==null){
        $stars=0;
    }else{
        $stars=$ratings->rating;
    }

    $order_list = [];
    foreach ($products as $proItem) {
        $imageArray = DB::table('tbl_productimages')->where('prod_id', $proItem->product_id)->first();
        
        //echo "<pre>";print_r($imageArray);exit;
    
        // Check if $imageArray is not null before accessing its properties
        if ($imageArray) {
            // Assuming there is a column named 'images' in tbl_productimages table
            $proItem->images = $imageArray->images;
        } else {
            // If no images are found, set it to an empty array or null, depending on your needs
            $proItem->images = "";
            // or $cartItem->images = null;
        }
    
        // Add the $cartItem to the $cart array
        $order_list[] = $proItem;
    }
 if($order_list == null){
 echo json_encode(array('error' => true, "message" => "Error"));

             }

            else{								
 $json_data = 0;
 echo json_encode(array('error' => false,"order_history"=>$order_list,"ratings" => $stars, "message" => "Success"));

                }
            }

catch (Exception $e)

{
//return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
  
}
public function updateorder(){

    
    $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

 $data1 = json_decode($json);

 $order_id=$data1->order_id;
 $status=4;

 $orderstatus=Tbl_order_masters::find($order_id);

 $orderstatus->order_status=$status;


 if($orderstatus->save()){

  $json_data = 1;

  echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

 }else{

  $json_data = 1;

  echo json_encode(array('error' => true, "data" => $json_data, "message" => "error"));

 }

}
public function shopwallet(){
         
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shop_id=$data1->shop_id;
  try{	
    $wallet=DB::table('tbl_wallets')
    ->where('shop_id',$shop_id)
   // ->where('status',0)
    ->first();

     

        if($wallet == null){
       

          echo json_encode(array('error' => true, "wallet"=>$wallet,"message" => "Error"));

             }

            else{								
  $json_data = 0;

            echo json_encode(array('error' => false,"wallet"=>$wallet, "message" => "Success"));

            } 

}

catch (Exception $e)

{
 //return Json("Sorry! Please check input parameters and values");

        echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));

}
}
public function cancelorder(){
    
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

 $data1 = json_decode($json);

 $order_id=$data1->trans_id;
 $orderstatus=Tbl_order_trans::find($order_id);
 $orderstatus->order_status=2;
 if($orderstatus->save()){

    $id=DB::table('tbl_order_trans')->where('id',$order_id)->first();

    $masterorder=Tbl_order_masters::find($id->order_id);
    $masterorder->total_amount=$data1->total_amount;
    $masterorder->discount=$data1->discount;
    $masterorder->total_mrp=$data1->total_mrp;
    $masterorder->shipping_charge=$data1->shipping_charge;
    if($data1->total_amount==0){
        $masterorder->order_status=4;
    }
    $masterorder->tax_amount=0;
    $masterorder->save();
    $cancel =new Tbl_cancel_orders;
    $cancel->type=1;
    $cancel->order_trans_id=$order_id;
    $cancel->qty=0;
    $cancel->comment=$data1->reason;
    $cancel->save();
$json_data = 1;

  echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

 }else{

  $json_data = 1;

  echo json_encode(array('error' => true, "data" => $json_data, "message" => "error"));

 }
}
public function cuscancelorder(){
    $postdata = file_get_contents("php://input");					

    $json = str_replace(array("\t","\n"), "", $postdata);
  
   $data1 = json_decode($json);
  
   $order_id=$data1->trans_id;

  
   $orderstatus=Tbl_b2cordertrans::find($order_id);
   $orderstatus->order_status=2;
   
  
   if($orderstatus->save()){
  
      $cancel =new Tbl_b2c_cancel_orders;
      $cancel->type=1;
      $cancel->order_trans_id=$order_id;
      $cancel->qty=0;
      $cancel->pay_returnstatus=0;
      $cancel->comment=$data1->reason;
      $cancel->save();

      $check=DB::table('tbl_b2cordertrans')->where('id',$order_id)->first();
      $masterid=$check->order_id;
      $invoicecount=DB::table('tbl_b2cordertrans')->where('order_id',$masterid)->count();
      $cancelcount=DB::table('tbl_b2cordertrans')->where('order_status',2)->where('order_id',$masterid)->count();
      if($invoicecount=$cancelcount){
       
           $masterorder=Tbl_b2corders::find($masterid);
           $masterorder->order_status=4;
           $masterorder->save();
       }else{
        $OrderMaster=DB::table('tbl_b2corders')->where('id',$masterid)->first();
        $totalAmount=$OrderMaster->total_amount-($check->selling_rate);
        $totalmrp=$OrderMaster->selling_mrp-($check->selling_rate);
        $discount=$check->price-$check->selling_rate;
        $finaldiscount=$OrderMaster->discount-$discount;
        $masterorder=Tbl_b2corders::find($masterid);
        $masterorder->total_amount=$totalAmount;
        $masterorder->discount=$finaldiscount;
        $masterorder->total_mrp=$totalmrp;
       // $masterorder->shipping_charge=$data1->shipping_charge;
        if($data1->total_amount==0){
            $masterorder->order_status=4;
        }
        $masterorder->tax_amount=0;
        $masterorder->save();
       }
      
  
      $json_data = 1;
  
      echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));
  
   }else{
  
    $json_data = 1;
  
    echo json_encode(array('error' => true, "data" => $json_data, "message" => "error"));
  
   }   
}
public function returnorder(){

    
    
    $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

 $data1 = json_decode($json);

 $order_id=$data1->trans_id;


 $orderstatus=Tbl_order_trans::find($order_id);
 $orderstatus->order_status=3;
 

 if($orderstatus->save()){

   
    $cancel =new Tbl_cancel_orders;
    $cancel->type=2;
    $cancel->order_trans_id=$order_id;
    $cancel->qty=0;
    $cancel->pay_returnstatus=0;
    $cancel->comment=$data1->reason;
    $cancel->save();



  $json_data = 1;

  echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));

 }else{

  $json_data = 1;

  echo json_encode(array('error' => true, "data" => $json_data, "message" => "error"));

 }
}
public function cusreturnorder(){
    $postdata = file_get_contents("php://input");					

    $json = str_replace(array("\t","\n"), "", $postdata);
  
   $data1 = json_decode($json);
  
   $order_id=$data1->trans_id;
  
  
   $orderstatus=Tbl_b2cordertrans::find($order_id);
   $orderstatus->order_status=3;
   
  
   if($orderstatus->save()){
  
     
      $cancel =new Tbl_b2c_cancel_orders;
      $cancel->type=2;
      $cancel->order_trans_id=$order_id;
      $cancel->qty=0;
      $cancel->comment=$data1->reason;
      $cancel->pay_returnstatus=0;
      $cancel->save();
  
  
  
    $json_data = 1;
  
    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));
  
   }else{
  
    $json_data = 1;
  
    echo json_encode(array('error' => true, "data" => $json_data, "message" => "error"));
  
   }  
}
public function productrating(){
    $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

 $data1 = json_decode($json);

 $type=$data1->type;

 $shopid=$data1->shopid;

 $productid=$data1->productid;

 $stars=$data1->stars;
 

 $check=DB::table('tbl_product_ratings')->where('type',$type)->where('product_id',$productid)->where('shopid',$shopid)->first();

 if($check==null){

    
    $rating =new Tbl_product_ratings;
    $rating->product_id=$productid;
    $rating->type=$type;
    $rating->rating=$stars;
    $rating->shopid=$shopid;
    $rating->save();

    $json_data = 1;

    echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));
 }else{
    $json_data = 0;

    echo json_encode(array('error' => true, "data" => $json_data, "message" => "error"));

 }


}
public function getproductorderdetails(){
    
    
    $postdata = file_get_contents("php://input");                    

    $json = str_replace(array("\t","\n"), "", $postdata);

    $data1 = json_decode($json);

    $shopId = $data1->shopid;

    $productId = $data1->productid;

    $type = $data1->type;

    $trans_id=$data1->billproductid;
    
    try {  
        
        $ratings = DB::table('tbl_product_ratings')
            ->where('shopid', $shopId)
            ->where('product_id', $productId)
            ->where('type', $type)
            ->first();

            if($ratings==null){
                $stars=0;
            }else{
                $stars=$ratings->rating;
            }


            $products=DB::table('tbl_order_trans')
           ->join('tbl_order_masters', 'tbl_order_trans.order_id', '=', 'tbl_order_masters.id')
            ->join('tbl_brand_products', 'tbl_order_trans.product_id', '=', 'tbl_brand_products.id')
            ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
            ->select('tbl_brand_products.id as pro_id','tbl_order_trans.id as trans_id','tbl_order_trans.qty', 'tbl_order_trans.offer_amount', 'tbl_order_trans.price', 'tbl_order_trans.taxable_amount','tbl_brand_products.product_name','tbl_order_trans.order_status as product_status','tbl_order_masters.order_status','tbl_order_masters.delivery_date')
            ->where('tbl_order_trans.id',$trans_id)
           // ->where('status',0)
            ->get();
            $order_list = [];
            foreach ($products as $proItem) {
                $imageArray = DB::table('tbl_productimages')->where('prod_id', $proItem->pro_id)->first();
                
                //echo "<pre>";print_r($imageArray);exit;
            
                // Check if $imageArray is not null before accessing its properties
                if ($imageArray) {
                    // Assuming there is a column named 'images' in tbl_productimages table
                    $proItem->images = $imageArray->images;
                } else {
                    // If no images are found, set it to an empty array or null, depending on your needs
                    $proItem->images = "";
                    // or $cartItem->images = null;
                }
            
                // Add the $cartItem to the $cart array
                $order_list[] = $proItem;
            }

        if ($order_list == null) {
            echo json_encode(array('error' => true, "message" => "Error"));
        } else {                                
            $json_data = 0;
            echo json_encode(array('error' => false, "ratings" => $stars,"order_list"=>$order_list,"message" => "Success"));
        }
    } catch (Exception $e) {
        // Handle the exception here
        echo json_encode(array('error' => true, "message" => "An error occurred."));
    }
}

}
