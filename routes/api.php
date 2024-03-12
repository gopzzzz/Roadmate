<?php



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;





Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();

});

Route::post('customernotification','Mbservices@customernotification');



Route::get('list','Mbservices@list');



Route::post('listinsert','Mbservices@shop');



Route::post('sendNotification','Mbservices@sendNotification');



Route::post('gcmupdate','Mbservices@gcmupdate');



Route::post('shopgcmupdate','ShopmobController@shopgcmupdate');



Route::post('newsendOTP','Mbservices@newsendOTP');



Route::post('newsendOTPJango','Mbservices@newsendOTPJango');



Route::post('insert_exe','Mbservices@insert_exe');



Route::post('cuslogin','Mbservices@cuslogin');



Route::post('otpcheck','Mbservices@otpcheck');



Route::post('cusreg','Mbservices@customer_registration');



Route::get('vetype','Mbservices@vetype');



Route::post('brand','Mbservices@brand');



Route::post('model','Mbservices@model');



Route::get('fuel_type','Mbservices@fuel_type');



Route::post('user_vehicles','Mbservices@user_vehicles');



Route::post('packagefeaturelist','Mbservices@packagefeaturelist');



Route::post('wallet','Mbservices@wallet');



Route::get('mobilenotification','Mbservices@mobilenotification');



Route::get('banner','Mbservices@banner');



Route::post('post_querys','Mbservices@post_querys');



Route::get('shop_categories','Mbservices@shop_categories');



Route::get('shopcat_limited','Mbservices@shopcat_limited');



Route::post('shops','Mbservices@shops');



Route::post('deleteuserveh','Mbservices@deleteuserveh');







Route::post('storelistinsert','Mbservices@storelistinsert');



Route::post('app_version','Mbservices@app_version');



Route::get('store_product_categslist','Mbservices@store_product_categslist');



Route::post('mystorelist','Mbservices@mystorelist');









Route::post('mystorelistuser','Mbservices@mystorelistuser');



Route::post('singlemystore','Mbservices@singlemystore');



Route::post('shopslist','Mbservices@shopslist');



Route::post('singlestorelist','Mbservices@singlestorelist');



Route::post('updatesalestatus','Mbservices@updatesalestatus');



Route::post('review','Mbservices@review');



Route::post('reviewlist','Mbservices@reviewlist');



Route::post('storequeryinsert','Mbservices@storequeryinsert');



Route::post('reviewavg','Mbservices@reviewavg');







Route::post('shop_serviceslist','Mbservices@shop_serviceslist');



Route::post('vehicleuserlist','Mbservices@vehicleuserlist');



Route::post('storanswer','Mbservices@storanswer');



Route::get('answercount','Mbservices@answercount');



Route::post('queanswer','Mbservices@queanswer');



Route::post('package','Mbservices@package');



Route::post('packagedel','Mbservices@packagedel');



Route::post('packageshoplist','Mbservices@packageshoplist');



Route::post('serviceshop','Mbservices@serviceshop');



Route::post('mechnearestshop','Mbservices@mechnearestshop');



Route::post('mechnearestshopall','Mbservices@mechnearestshopall');



Route::get('quesanswer','Mbservices@quesanswer');



Route::post('packshop','Mbservices@packshop');



Route::post('packageservicelist','Mbservices@packageservicelist');



Route::post('packagebook','Mbservices@packagebook');



Route::post('catshoplist','Mbservices@catshoplist');



Route::post('availabletime','Mbservices@availabletime');



Route::post('bookedhistory','Mbservices@bookedhistory');



Route::post('offerlistveh','Mbservices@offerlistveh');



Route::post('topoffers','Mbservices@topoffers');



Route::post('offerdetails','Mbservices@offerdetails');



Route::post('walletbalance','Mbservices@walletbalance');



Route::post('walletuse','Mbservices@walletuse');



Route::post('searchshop','Mbservices@searchshop');



Route::post('uservehicledelete','Mbservices@uservehicledelete');



Route::post('userlistedit','Mbservices@userlistedit');



Route::post('shopofferlistnew','Mbservices@shopofferlistnew');



Route::post('pastupcomingbookings','Mbservices@pastupcomingbookings');



Route::post('allshopoffers','Mbservices@allshopoffers');



Route::post('defaultveh','Mbservices@defaultveh');



Route::post('defaultvehcall','Mbservices@defaultvehcall');









Route::post('updatepaystatuscustomer','Mbservices@updatepaystatuscustomer');





Route::post('cancelbooking','Mbservices@cancelbooking');





Route::post('packagecategory','Mbservices@packagecategory');





Route::post('myboking_count','Mbservices@myboking_count');


Route::get('sendjavascriptotp','Mbservices@sendjavascriptotp');






//--------------------------------------------------------------------------



Route::post('shopnotificationlist','ShopmobController@shopnotificationlist');



Route::post('shop_current_oc','ShopmobController@shop_current_oc');



Route::post('package_features_list','ShopmobController@package_features_list');



Route::post('shopprovidedatdelete','ShopmobController@shopprovidedatdelete');



Route::post('shopprovidepackagedelete','ShopmobController@shopprovidepackagedelete');



Route::post('productofferdetails','ShopmobController@productofferdetails');



Route::post('shoplogin','ShopmobController@shoplogin');



Route::post('mystorelist_shopdata','ShopmobController@mystorelist_shopdata');



Route::post('mystorelist_shop_new','ShopmobController@mystorelist_shop_new');



Route::post('shop_providedpackagecount','ShopmobController@shop_providedpackagecount');



Route::get('shopofferlist','ShopmobController@shopofferlist');



Route::post('addshopbankdetails','ShopmobController@addshopbankdetails');





Route::post('otpshop','ShopmobController@otpshop');



Route::post('shopreg1','ShopmobController@shopreg1');



Route::post('shopreg','ShopmobController@shopreg'); 



Route::post('shopprvdcat','ShopmobController@shop_providecat');



Route::post('shopprvdcatlist','ShopmobController@shop_providecatlist');



Route::get('bannershop','ShopmobController@bannershop');



Route::post('packagerandomdetails','ShopmobController@packagerandomdetails');



Route::post('shop_offers','ShopmobController@shop_offers');



Route::post('shopoffer_list','ShopmobController@shopoffer_list');



Route::post('sob_time','ShopmobController@sob_time');



Route::post('sob_timelist','ShopmobController@sob_timelist');



Route::post('customer_booktimeslots','ShopmobController@customer_booktimeslots');



Route::post('customer_booktimeslotslist','ShopmobController@customer_booktimeslotslist');



Route::post('shopregpaymentupdate','ShopmobController@shopregpaymentupdate');



Route::post('vehmfuel','ShopmobController@vehmfuel');





Route::post('booktypelist','ShopmobController@booktypelist');



Route::post('customer_details','ShopmobController@customer_details');



Route::post('shop_services','ShopmobController@shop_services');



Route::post('vmb_service_list','ShopmobController@vmb_service_list');



Route::get('packagebanner','ShopmobController@packagebanner');



Route::post('addshoppackage','ShopmobController@addshoppackage');



Route::post('shoppackagelist','ShopmobController@shoppackagelist');



Route::post('updatepayment','ShopmobController@updatepayment');



Route::post('product_offers','ShopmobController@product_offers');



Route::post('shopoffer_models','ShopmobController@shopoffer_models');



Route::post('shopoffer_new','ShopmobController@shopoffer_new'); 



Route::post('updatenddate','ShopmobController@updatenddate');



Route::post('addshoptimeslot','ShopmobController@addshoptimeslot');



Route::post('storebanner','ShopmobController@storebanner');



Route::post('updateproductoffersale','ShopmobController@updateproductoffersale');



Route::post('storebanner_shop','ShopmobController@storebanner_shop');



Route::post('mystorelist_shop','ShopmobController@mystorelist_shop');



Route::post('shopimage','ShopmobController@shopimage');



Route::post('shopcostatus','ShopmobController@shopcostatus');



Route::post('shopservicedit','ShopmobController@shopservicedit');



Route::post('shopreviews','ShopmobController@shopreviews');



Route::post('suggcompinsert','ShopmobController@suggcompinsert');



Route::get('tclist','ShopmobController@tclist');



Route::post('shoplist','ShopmobController@shoplist');







Route::post('shoplistnew','ShopmobController@shoplistnew');



Route::post('packagefulllist','ShopmobController@packagefulllist');



Route::post('vehalltypeserviceadd','ShopmobController@vehalltypeserviceadd');



Route::post('shopackagexists','ShopmobController@shopackagexists');



Route::post('timeslot_delete','ShopmobController@timeslot_delete');



Route::post('bookstatusupdation','ShopmobController@bookstatusupdation');



Route::post('updatepaystatus','ShopmobController@updatepaystatus');



Route::post('paymentuncompletedcount','ShopmobController@paymentuncompletedcount');



Route::post('paymentuncompletedlist','ShopmobController@paymentuncompletedlist');







Route::get('completedpaylistcount','ShopmobController@completedpaylistcount');



Route::post('shopfcmupdate','ShopmobController@shopfcmupdate');



Route::post('bookstatusupdation_giveaway','ShopmobController@bookstatusupdation_giveaway');





//==============================executive =========================================



Route::post('excutivelogin','ExectiveController@excutivelogin');



Route::post('shoplistexe','ShopmobController@shoplistexe');



Route::post('executivenotification','ExectiveController@executivenotification');



Route::post('exeotp','ExectiveController@exeotp'); 



Route::post('executivedel','ExectiveController@executivedel');



Route::post('exeshopreg','ExectiveController@exeshopreg');



Route::post('shopreg_exe_authorised','ExectiveController@shopreg_exe_authorised');



Route::post('shopreg_exe_unauthorised','ExectiveController@shopreg_exe_unauthorised');



Route::post('authorised_shop_list','ExectiveController@authorised_shop_list');



Route::post('unauthorised_shop_list','ExectiveController@unauthorised_shop_list');



Route::post('visitedshop','ExectiveController@visitedshop');



Route::post('addvisitedshop','ExectiveController@addvisitedshop');



Route::post('visitedshoplist','ExectiveController@visitedshoplist');





Route::post('addedshoplist','ExectiveController@addedshoplist');



Route::post('custranhistory','ExectiveController@custranhistory');



Route::post('exefcmupdate','ExectiveController@exefcmupdate');



Route::post('update_paycustomer','ExectiveController@update_paycustomer');


Route::get('countrylist','ExectiveController@countrylist');


Route::post('statelist','ExectiveController@statelist');

Route::post('districtlist','ExectiveController@districtlist');

Route::post('placelist','ExectiveController@placelist');

Route::post('serachplaces','ExectiveController@serachplaces');

Route::post('uploadimage','ExectiveController@uploadimage');










//------------alwin-------------------------------------

//shop app-----------------------------------



Route::post('timeslot_list','ShopmobController@timeslot_list');





Route::post('shopcatlist','ShopmobController@shopcatlist');





Route::post('editshop','ShopmobController@editshop');



Route::post('notificationlist','Mbservices@notificationlist');



Route::post('offerlistvehv2','Mbservices@offerlistvehv2');



Route::post('reviews_offer','Mbservices@reviews_offer');



Route::post('offers_reviewlist','Mbservices@offers_reviewlist');



//alwin new service 25-july-2021



Route::post('shop_services_delete','ShopmobController@shop_services_delete'); 



//29-july-2021 



Route::post('product_offersshop','ShopmobController@product_offersshop');



Route::post('shop_offerdetails','ShopmobController@shop_offerdetails');

//=============

Route::post('giveawaylist','Mbservices@giveawaylist');

Route::post('giveawayshops','Mbservices@giveawayshops');

Route::post('giveawaydel','Mbservices@giveawaydel');

Route::get('givwawaybookingcount','Mbservices@givwawaybookingcount');

Route::post('productdelete','Mbservices@productdelete');

Route::post('soldoutproduct','Mbservices@soldoutproduct');

Route::post('send_testsmsotp','Mbservices@send_testsmsotp')->name('send_testsmsotp');

Route::post('deactivate_account','Mbservices@deactivate_account')->name('deactivate_account');

/*==============================================================================================
Giveway checking (23-11-2023)
=============================================================================================*/
Route::post('checkgiveawaysubscription','Mbservices@checkgiveawaysubscription');

/*==============================================================================================
Shop marketing new feature addon (07-11-2023)
=============================================================================================*/

Route::get('mhomepage','ShopmarketingController@mhomepage');
Route::post('categoryproductlist','ShopmarketingController@categoryproductlist');
Route::get('categorylist','ShopmarketingController@categorylist');
Route::post('subcategorylist','ShopmarketingController@subcategorylist');
Route::post('productdetails','ShopmarketingController@productdetails');
Route::post('wishlist','ShopmarketingController@wishlist');     
Route::post('customerwishlist','ShopmarketingController@customerwishlist'); 
Route::post('cart','ShopmarketingController@cart');
Route::post('customercart','ShopmarketingController@customercart');

             
Route::post('deliveryaddressadd','ShopmarketingController@deliveryaddressadd');
Route::post('customerdeliveryaddressadd','ShopmarketingController@customerdeliveryaddressadd');
Route::post('deliveryaddresslist','ShopmarketingController@deliveryaddresslist');
Route::post('customerdeliveryaddresslist','ShopmarketingController@customerdeliveryaddresslist');
Route::post('cartadd','ShopmarketingController@cartadd');
Route::post('customercartadd','ShopmarketingController@customercartadd');
Route::post('cartdelete','ShopmarketingController@cartdelete');
Route::post('wishlistdelete','ShopmarketingController@wishlistdelete');
Route::post('customerwishlistdelete','ShopmarketingController@customerwishlistdelete');
Route::post('wishlistadd','ShopmarketingController@wishlistadd');
Route::post('cuswishlistadd','ShopmarketingController@cuswishlistadd');

Route::post('placeorder','ShopmarketingController@placeorder');
Route::post('updateqty','ShopmarketingController@updateqty');
Route::post('orderhistory','ShopmarketingController@orderhistory');
Route::post('vieworder','ShopmarketingController@vieworder');
Route::post('updateorder','ShopmarketingController@updateorder');
Route::post('shopwallet','ShopmarketingController@shopwallet');
Route::post('brandfilter','ShopmarketingController@brandfilter');
Route::post('brand_list','ShopmarketingController@brand_list');
Route::post('searchproduct','ShopmarketingController@searchproduct');
//b2c module 
Route::post('customerplaceorder','ShopmarketingController@customerplaceorder');
Route::post('customerorderhistory','ShopmarketingController@customerorderhistory');

Route::post('deliveryaddressupdate','ShopmarketingController@deliveryaddressupdate');

Route::post('customerdeliveryaddressupdate','ShopmarketingController@customerdeliveryaddressupdate');
Route::post('product','ShopmarketingController@product');
Route::post('cancelorder','ShopmarketingController@cancelorder');
Route::post('returnorder','ShopmarketingController@returnorder');
Route::post('productrating','ShopmarketingController@productrating');
Route::post('averagerating','ShopmarketingController@averagerating');
Route::get('priorityproducts','ShopmarketingController@priorityproducts');
Route::post('getproductorderdetails','ShopmarketingController@getproductorderdetails');



Route::post('bulkupdate','ShopmobController@bulkupdate');

Route::get('bulkdataupload','ShopmobController@bulkdataupload');


Route::get('testrun','ShopmobController@testrun');

