<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Tbl_deliveryaddres;
use App\shops;
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

  $categoryId=$data1->categoryid; 
  try{	

      $productlist = DB::table('tbl_brand_products')
          ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
          ->select('tbl_brand_products.*', 'tbl_rm_products.cat_id')
          ->where('tbl_rm_products.cat_id', $categoryId) 
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

            echo json_encode(array('error' => false,"productlist"=>$products, "message" => "Success"));

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

                }

    

  

}

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
    $productDetails = DB::table('tbl_brand_products')
     ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
    ->select('tbl_brand_products.*','tbl_rm_products.cat_id')
    ->where('tbl_brand_products.id',$productId) 
    ->where('tbl_brand_products.status',0)
    ->first(); 

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

   

   



$wishlist = DB::table('tbl_rm_wishlists')
    ->join('tbl_brand_products', 'tbl_rm_wishlists.product_id', '=', 'tbl_brand_products.id')
    ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
    ->select('tbl_rm_wishlists.*', 'tbl_brand_products.offer_price', 'tbl_brand_products.price', 'tbl_brand_products.product_name', 'tbl_brand_products.description')
    ->where('shop_id', $shopId)
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
        $cartItem->images = [];
        // or $cartItem->images = null;
    }

    // Add the $cartItem to the $cart array
    $wish[] = $cartItem;
}



  //  echo "<pre>";print_r($wish);exit;
     

        if($wish == null){

               

          echo json_encode(array('error' => true, "message" => "Error"));

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



  try{	

   

   
$cartlist = DB::table('tbl_carts')
    ->join('tbl_brand_products', 'tbl_carts.product_id', '=', 'tbl_brand_products.id')
    ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
    ->select('tbl_carts.*', 'tbl_brand_products.offer_price', 'tbl_brand_products.price', 'tbl_brand_products.product_name', 'tbl_brand_products.description')
    ->where('shop_id', $shopId)
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
        $cartItem->images = [];
        // or $cartItem->images = null;
    }

    // Add the $cartItem to the $cart array
    $cart[] = $cartItem;
}

if (empty($cart)) {
    echo json_encode(array('error' => true, "message" => "Error"));
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
public function deliveryaddress(){

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

   

   

    $productlist=DB::table('tbl_brand_products')
    ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
    ->select('tbl_brand_products.*')
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

            echo json_encode(array('error' => false,"product"=>$products, "message" => "Success"));

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