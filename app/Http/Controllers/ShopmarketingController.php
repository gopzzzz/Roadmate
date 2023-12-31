<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Tbl_deliveryaddres;
use App\shops;
use App\Tbl_carts;
use App\Tbl_rm_wishlists;
use App\Tbl_order_trans;
use App\Tbl_order_masters;
use App\Tbl_wallet_transactions;
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

      $productlist = DB::table('tbl_brand_products')
          ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
          ->select('tbl_brand_products.*', 'tbl_rm_products.cat_id')
          ->where('tbl_rm_products.cat_id', $categoryId)
          ->where('tbl_brand_products.status',0)
            ->offset($offset) 
      ->limit($limit) 
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

  $index=$data1->index;
  $offset=($index*20);
  $limit=20;

  


  try{	

   

   

    $productlist=DB::table('tbl_brand_products')
    ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
    ->select('tbl_brand_products.*')
    
  ->offset($offset) 
  ->limit($limit) 
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

public function brandfilter(){
    $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $brand_id=$data1->brand_id;
  
   $index=$data1->index;
    $offset=($index*20);
    $limit=20;
  

  


  try{	

   

   

    $productlist=DB::table('tbl_brand_products')
    ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
    ->select('tbl_brand_products.*')
    ->where('tbl_brand_products.brand_id',$brand_id)
    ->where('tbl_brand_products.status',0)
      ->offset($offset) 
      ->limit($limit) 
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
public function searchproduct(){
    $postdata = file_get_contents("php://input");					

    $json = str_replace(array("\t","\n"), "", $postdata);
  
    $data1 = json_decode($json);
  
    $search=$data1->productname;
    $index=$data1->index;
    $offset=($index*20);
    $limit=20;
  
    
  
  
    try{	
  
     
  
     
  
      $productlist=DB::table('tbl_brand_products')
      ->join('tbl_rm_products', 'tbl_brand_products.brand_id', '=', 'tbl_rm_products.id')
      ->select('tbl_brand_products.*')
      ->orWhere('tbl_brand_products.product_name', 'like', "%{$search}%")
      ->offset($offset) 
      ->limit($limit) 
      ->where('tbl_brand_products.status',0)
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
public function brand_list(){
    
    
    $postdata = file_get_contents("php://input");                    

    $json = str_replace(array("\t","\n"), "", $postdata);

    $data1 = json_decode($json);

    $subcat_id=$data1->subcat_id;

    // $shopId = $data1->shopid;
    
    try {    
        $brandlist = DB::table('tbl_rm_products')
            ->where('cat_id', $subcat_id)
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
        $his->type=2;
        $his->shop_id=$data1->wallet_redeem_id;
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

 public function cartadd(){

    $postdata = file_get_contents("php://input");					
  
    $json = str_replace(array("\t","\n"), "", $postdata);
  
    $data1 = json_decode($json);


    $check=DB::table('tbl_carts')->where('product_id',$data1->product_id)->where('shop_id',$data1->shop_id)->first();
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

    $shop_id=$data1->shop_id;
    $product_id=$data1->product_id;

    if(DB::table('tbl_rm_wishlists')->where('shop_id',$shop_id)->where('product_id',$product_id)->delete()){

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

public function orderhistory(){

    
      
  $postdata = file_get_contents("php://input");					

  $json = str_replace(array("\t","\n"), "", $postdata);

  $data1 = json_decode($json);

  $shop_id=$data1->shop_id;


  try{	

   

   

    $order_list=DB::table('tbl_order_masters')
    ->where('shop_id',$shop_id)
   // ->where('status',0)
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
    ->select('tbl_order_masters.*','tbl_brand_products.id as pro_id','tbl_order_trans.id as trans_id','tbl_order_trans.qty', 'tbl_order_trans.offer_amount', 'tbl_order_trans.price', 'tbl_order_trans.taxable_amount','tbl_brand_products.product_name')
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






}