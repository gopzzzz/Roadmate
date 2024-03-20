<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
});


Auth::routes();

Route::get('/custmrlist', [
    'middleware' => 'auth',
    'uses' => 'HomeController@customerlistfetch'
])->name('custmrlist');

Route::get('/timeslot', [
    'middleware' => 'auth',
    'uses' => 'HomeController@booking_timeslots'
])->name('timeslot');

Route::post('/search_timeslot', [
    'middleware' => 'auth',
    'uses' => 'HomeController@search_booking_timeslots'
])->name('search_timeslot');

Route::post('/timeslotinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@booking_timeslotsinsert'
])->name('timeslotinsert');

Route::post('/updatestatus', [
    'middleware' => 'auth',
    'uses' => 'HomeController@updatestatus'
])->name('updatestatus');

Route::post('/updatecallstatus', [
    'middleware' => 'auth',
    'uses' => 'HomeController@updatecallstatus'
])->name('updatecallstatus');

Route::post('/updatecallstatusfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@updatecallstatusfetch'
])->name('updatecallstatusfetch');

Route::post('/updatecallstatusfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@updatecallstatusfetch'
])->name('updatecallstatusfetch');

Route::post('/updatecallstatusfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@updatecallstatusfetch'
])->name('updatecallstatusfetch');

Route::post('/timeslotedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@booking_timeslotsedit'
])->name('timeslotedit');

Route::post('/timeslotfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@timeslotfetch'
])->name('timeslotfetch');


Route::post('/createaccount', [
    'middleware' => 'auth',
    'uses' => 'HomeController@createaccount'
])->name('createaccount');


Route::get('timeslotdelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@timeslotdelete'
])->name('timeslotdelete');

Route::get('accountdelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@accountdelete'
])->name('accountdelete');


Route::get('/executive', [
    'middleware' => 'auth',
    'uses' => 'HomeController@executive'
])->name('executive');





Route::get('/franchises', [
    'middleware' => 'auth',
    'uses' => 'HomeController@franchises'
])->name('franchises');

Route::post('/franinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@franinsert'
])->name('franinsert');

Route::post('/franchiseaddon', [
    'middleware' => 'auth',
    'uses' => 'HomeController@franchiseaddon'
])->name('franchiseaddon');

Route::post('/getfranchisedetails', [
    'middleware' => 'auth',
    'uses' => 'HomeController@getfranchisedetails'
])->name('getfranchisedetails');

Route::post('/getfranchisedetailsdistrict', [
    'middleware' => 'auth',
    'uses' => 'HomeController@getfranchisedetailsdistrict'
])->name('getfranchisedetailsdistrict');

Route::post('/franfetch', 'HomeController@franfetch')->name('franfetch')->middleware('auth');


Route::post('/franchasefilter', [
    'middleware' => 'auth',
    'uses' => 'HomeController@franchasefilter'
])->name('franchasefilter');
Route::post('/franedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@franedit'
])->name('franedit');

Route::get('/crm', [
    'middleware' => 'auth',
    'uses' => 'HomeController@crm'
])->name('crm');

Route::post('/crminsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@crminsert'
])->name('crminsert');

Route::post('/crmfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@crmfetch'
])->name('crmfetch');

Route::post('/crmedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@crmedit'
])->name('crmedit');


Route::get('deleteCrm/{crmId}', 'HomeController@deleteCrm')->name('deleteCrm');




Route::post('/addedshop', [
    'middleware' => 'auth',
    'uses' => 'HomeController@addedshop'
])->name('addedshop');


Route::get('/executivenew', [
    'middleware' => 'auth',
    'uses' => 'HomeController@executivenew'
])->name('executivenew');

Route::get('/giveawaybooking', [
    'middleware' => 'auth',
    'uses' => 'HomeController@giveawaybooking'
])->name('giveawaybooking');

Route::post('/exeinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@exeinsert'
])->name('exeinsert');

Route::post('/visitedshop', [
    'middleware' => 'auth',
    'uses' => 'HomeController@visitedshop'
])->name('visitedshop');

Route::post('/executivefetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@executivefetch'
])->name('executivefetch');

Route::post('/exeedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@exeedit'
])->name('exeedit');

Route::get('exedelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@exedelete'
])->name('exedelete');
//
Route::get('/superadmin', [
    'middleware' => 'auth',
    'uses' => 'HomeController@superadmin'
])->name('superadmin');

Route::post('/supadminsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@supadminsert'
])->name('supadminsert');

Route::post('/supabfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@supabfetch'
])->name('supabfetch');

//

Route::get('/banner', [
    'middleware' => 'auth',
    'uses' => 'HomeController@banner'
])->name('banner');

Route::post('/bannerinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@bannerinsert'
])->name('bannerinsert');

Route::post('/bannerfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@bannerfetch'
])->name('bannerfetch');

Route::post('/banneredit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@banneredit'
])->name('banneredit');

Route::get('bannerdelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@bannerdelete'
])->name('bannerdelete');

Route::get('/store_listing', [
    'middleware' => 'auth',
    'uses' => 'HomeController@store_listing'
])->name('store_listing');

Route::post('/storesinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@storesinsert'
])->name('storesinsert');

Route::post('/storesedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@storesedit'
])->name('storesedit');

Route::post('/storefetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@storefetch'
])->name('storefetch');

Route::get('/store_categories', [
    'middleware' => 'auth',
    'uses' => 'HomeController@store_categories'
])->name('store_categories');

Route::post('/store_categoriesinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@store_categoriesinsert'
])->name('store_categoriesinsert');

Route::post('/store_categoriesfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@store_categoriesfetch'
])->name('store_categoriesfetch');

Route::post('/store_categoriesedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@store_categoriesedit'
])->name('store_categoriesedit');

Route::get('store_categoriesdelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@store_categoriesdelete'
])->name('store_categoriesdelete');

Route::get('/shop_providcat', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shop_providcat'
])->name('shop_providcat');

Route::post('/shop_providcatinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shop_providcatinsert'
])->name('shop_providcatinsert');

Route::post('/shop_providcatfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shop_providcatfetch'
])->name('shop_providcatfetch');

Route::post('/shop_providcatedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shop_providcatedit'
])->name('shop_providcatedit');

Route::get('shop_providcatdelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shop_providcatdelete'
])->name('shop_providcatdelete');

Route::get('/shop_categories', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shop_categories'
])->name('shop_categories');

Route::post('/shop_categoriesinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shop_categoriesinsert'
])->name('shop_categoriesinsert');

Route::post('/shop_categoriesfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shop_categoriesfetch'
])->name('shop_categoriesfetch');

Route::post('/shop_categoriesedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shop_categoriesedit'
])->name('shop_categoriesedit');

Route::get('shop_categoriesdelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shop_categoriesdelete'
])->name('shop_categoriesdelete');

Route::get('/shop_offers', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shop_offers'
])->name('shop_offers');

Route::post('/shop_offersinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shop_offersinsert'
])->name('shop_offersinsert');

Route::post('/shop_offersfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shop_offersfetch'
])->name('shop_offersfetch');

Route::post('/shop_offersedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shop_offersedit'
])->name('shop_offersedit');

Route::get('shop_offersdelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shop_offersdelete'
])->name('shop_offersdelete');

Route::get('/shops', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shops'
])->name('shops');

Route::get('/exportshop', [
    'middleware' => 'auth',
    'uses' => 'HomeController@exportshop'
])->name('exportshop');



Route::post('/search_shop', [
    'middleware' => 'auth',
    'uses' => 'HomeController@search_shop'
])->name('search_shop');

Route::post('/search_shop_service', [
    'middleware' => 'auth',
    'uses' => 'HomeController@search_shop_service'
])->name('search_shop_service');

Route::get('/vshops', [
    'middleware' => 'auth',
    'uses' => 'HomeController@vshops'
])->name('vshops');

Route::get('/ashops', [
    'middleware' => 'auth',
    'uses' => 'HomeController@ashops'
])->name('ashops');

Route::post('/shopinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopinsert'
])->name('shopinsert');

Route::post('/shopfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopfetch'
])->name('shopfetch');

Route::post('/shopedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopedit'
])->name('shopedit');

Route::get('shopdelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopdelete'
])->name('shopdelete');

Route::get('/shopproduct_offers', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopproduct_offers'
])->name('shopproduct_offers');

Route::post('/product_offersinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@product_offersinsert'
])->name('product_offersinsert');

Route::post('/product_offersfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@product_offersfetch'
])->name('product_offersfetch');

Route::post('/product_offersedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@product_offersedit'
])->name('product_offersedit');

Route::get('product_offersdelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@product_offersdelete'
])->name('product_offersdelete');

Route::get('/shopoffermodels', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopoffermodels'
])->name('shopoffermodels');

 
Route::post('/shopoffermodelsinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopoffermodelsinsert'
])->name('shopoffermodelsinsert');

Route::post('/shopoffermodelsfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopoffermodelsfetch'
])->name('shopoffermodelsfetch');

Route::post('/shopoffermodels_edit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopoffermodels_edit'
])->name('shopoffermodels_edit');

Route::get('shopoffermodelsdelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopoffermodelsdelete'
])->name('shopoffermodelsdelete');

Route::get('/shopservices', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopservices'
])->name('shopservices');

Route::post('/shopservicesinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopservicesinsert'
])->name('shopservicesinsert');

Route::post('/shopservicesfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopservicesfetch'
])->name('shopservicesfetch');

Route::post('/shopservicesedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopservicesedit'
])->name('shopservicesedit');

Route::get('shopservicesdelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopservicesdelete'
])->name('shopservicesdelete');

Route::get('/shoptimeslot', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shoptimeslot'
])->name('shoptimeslot');

Route::post('/shoptimeslotinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shoptimeslotinsert'
])->name('shoptimeslotinsert');

Route::post('/shoptimeslotfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shoptimeslotfetch'
])->name('shoptimeslotfetch');

Route::post('/shoptimeslotedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shoptimeslotedit'
])->name('shoptimeslotedit');

Route::get('shoptimeslotdelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shoptimeslotdelete'
])->name('shoptimeslotdelete');

Route::get('/shopreviews', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopreviews'
])->name('shopreviews');

Route::get('/deletefranchise/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@deletefranchise'
])->name('deletefranchise');



Route::post('/shopreviewsfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopreviewsfetch'
])->name('shopreviewsfetch');

Route::get('shopreviewsdelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopreviewsdelete'
])->name('shopreviewsdelete');

Route::post('/editstore', [
    'middleware' => 'auth',
    'uses' => 'HomeController@editstore'
])->name('editstore');

Route::get('storedelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@storedelete'
])->name('storedelete');

Route::get('/mystorequeries', [
    'middleware' => 'auth',
    'uses' => 'HomeController@mystorequeries'
])->name('mystorequeries');

Route::post('/mystorequeriesfeatch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@mystorequeriesfeatch'
])->name('mystorequeriesfeatch');

Route::get('mystorequerydelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@mystorequerydelete'
])->name('mystorequerydelete');

Route::get('converttoaddedshops/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@converttoaddedshops'
])->name('converttoaddedshops');


Route::get('/storequeryanswr', [
    'middleware' => 'auth',
    'uses' => 'HomeController@storequeryanswr'
])->name('storequeryanswr');

Route::post('/storequeryanswrinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@storequeryanswrinsert'
])->name('storequeryanswrinsert');

Route::post('/storequeryanswrfeatch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@storequeryanswrfeatch'
])->name('storequeryanswrfeatch');

Route::post('/storequeryanswredit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@storequeryanswredit'
])->name('storequeryanswredit');

Route::get('storequeryanswrdelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@storequeryanswrdelete'
])->name('storequeryanswrdelete');

Route::any('/customers', [
    'middleware' => 'auth',
    'uses' => 'HomeController@customers'
])->name('customers');

Route::get('/vehtype', [
    'middleware' => 'auth',
    'uses' => 'HomeController@vehtype'
])->name('vehtype');

Route::get('/fueltype', [
    'middleware' => 'auth',
    'uses' => 'HomeController@fueltype'
])->name('fueltype');

Route::post('/fueltypeinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@fueltypeinsert'
])->name('fueltypeinsert');

Route::post('/vehtypefetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@vehtypefetch'
])->name('vehtypefetch');

Route::post('/fueltypefetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@fueltypefetch'
])->name('fueltypefetch');

Route::post('/editfueltype', [
    'middleware' => 'auth',
    'uses' => 'HomeController@editfueltype'
])->name('editfueltype');

Route::get('fueltypedelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@fueltypedelete'
])->name('fueltypedelete');

Route::post('/editvehtype', [
    'middleware' => 'auth',
    'uses' => 'HomeController@editvehtype'
])->name('editvehtype');

Route::post('/vehtypeinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@vehtypeinsert'
])->name('vehtypeinsert');

Route::get('vehtypedelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@vehtypedelete'
])->name('vehtypedelete');

Route::get('/vehcle', [
    'middleware' => 'auth',
    'uses' => 'HomeController@vehcle'
])->name('vehcle');

Route::post('/vehcleinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@vehcleinsert'
])->name('vehcleinsert');

Route::post('/vehclefetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@vehclefetch'
])->name('vehclefetch');

Route::post('/vehcleedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@vehcleedit'
])->name('vehcleedit');

Route::get('vehcledelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@vehcledelete'
])->name('vehcledelete');

Route::get('/uservehcle', [
    'middleware' => 'auth',
    'uses' => 'HomeController@uservehcle'
])->name('uservehcle');

Route::post('/uservehcleinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@uservehcleinsert'
])->name('uservehcleinsert');

Route::post('/uservehclefetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@uservehclefetch'
])->name('uservehclefetch');

Route::post('/uservehcleedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@uservehcleedit'
])->name('uservehcleedit');

Route::get('uservehcledelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@uservehcledelete'
])->name('uservehcledelete');

Route::get('/brand', [
    'middleware' => 'auth',
    'uses' => 'HomeController@brand'
])->name('brand');

Route::post('/brandfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@brandfetch'
])->name('brandfetch');

Route::post('/packagevehicleinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packagevehicleinsert'
])->name('packagevehicleinsert');

Route::post('/vehbrandfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@vehbrandfetch'
])->name('vehbrandfetch');

Route::post('/brmodelfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@brmodelfetch'
])->name('brmodelfetch');

Route::post('/editbarnd', [
    'middleware' => 'auth',
    'uses' => 'HomeController@editbarnd'
])->name('editbarnd');

Route::post('/brandinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@brandinsert'
])->name('brandinsert');

Route::get('branddelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@branddelete'
])->name('branddelete');

Route::get('/models', [
    'middleware' => 'auth',
    'uses' => 'HomeController@models'
])->name('models');

Route::post('/brandidfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@brandidfetch'
])->name('brandidfetch');

Route::post('/modelinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@modelinsert'
])->name('modelinsert');

Route::post('/modelfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@modelfetch'
])->name('modelfetch');

Route::post('/modeledit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@modeledit'
])->name('modeledit');

Route::get('modeledelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@modeledelete'
])->name('modeledelete');

Route::get('deletegiveawayshops/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@deletegiveawayshops'
])->name('deletegiveawayshops');

Route::get('/packfeatures', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packfeatures'
])->name('packfeatures');

Route::post('/shopsearch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopsearch'
])->name('shopsearch');

Route::post('/shopseachnew', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopseachnew'
])->name('shopseachnew');


Route::post('/shopbankinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopbankinsert'
])->name('shopbankinsert');

Route::get('/shopbank', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopbank'
])->name('shopbank');

Route::get('shopbankdelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopbankdelete'
])->name('shopbankdelete');

Route::post('/packfeaturesinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packfeaturesinsert'
])->name('packfeaturesinsert');

Route::post('/packfeaturesfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packfeaturesfetch'
])->name('packfeaturesfetch');

Route::post('/featurefetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@featurefetch'
])->name('featurefetch');

Route::post('/shopidfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@shopidfetch'
])->name('shopidfetch');

Route::post('/editshopbank', [
    'middleware' => 'auth',
    'uses' => 'HomeController@editshopbank'
])->name('editshopbank');

Route::post('/editfeature', [
    'middleware' => 'auth',
    'uses' => 'HomeController@editfeature'
])->name('editfeature');

Route::post('/editpackfeatures', [
    'middleware' => 'auth',
    'uses' => 'HomeController@editpackfeatures'
])->name('editfeature');

Route::get('packfeaturesdelete/{id}', [    
    'middleware' => 'auth',
    'uses' => 'HomeController@packfeaturesdelete'
])->name('packfeaturesdelete');
 
Route::get('/common', [
    'middleware' => 'auth',
    'uses' => 'HomeController@common'
])->name('common');

Route::post('/packageforvehiclefetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packageforvehiclefetch'
])->name('packageforvehiclefetch');

Route::get('/packageveh', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packageveh'
])->name('packageveh');

Route::post('/compackageinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@compackageinsert'
])->name('compackageinsert');

Route::post('/packagefetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packagefetch'
])->name('packagefetch');


Route::post('/editcompackage', [
    'middleware' => 'auth',
    'uses' => 'HomeController@editcompackage'
])->name('editcompackage');

Route::get('packagedelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packagedelete'
])->name('packagedelete');

Route::get('/packagedet', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packagedet'
])->name('packagedet');

Route::post('/packagedetinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packagedetinsert'
])->name('packagedetinsert');

Route::post('/packagedetfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packagedetfetch'
])->name('packagedetfetch');

Route::post('/packagedetedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packagedetedit'
])->name('packagedetedit');

Route::get('packagedetdelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packagedetdelete'
])->name('packagedetdelete');

Route::get('/packageshop', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packageshop'
])->name('packageshop');

Route::post('/packageshopinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packageshopinsert'
])->name('packageshopinsert');

Route::post('/packageshopfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packageshopfetch'
])->name('packageshopfetch');

Route::post('/packageshopedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packageshopedit'
])->name('packageshopedit');

Route::get('packageshopdelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packageshopdelete'
])->name('packageshopdelete');

Route::get('/packagebook', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packagebook'
])->name('packagebook');

Route::post('/packagebookfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packagebookfetch'
])->name('packagebookfetch');

Route::post('/packagefeaturefetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packagefeaturefetch'
])->name('packagefeaturefetch');


Route::get('packagebookdelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packagebookdelete'
])->name('packagebookdelete');

Route::get('featuredelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@featuredelete'
])->name('featuredelete');

Route::get('packagedeleteforveh/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packagedeleteforveh'
])->name('packagedeleteforveh');

Route::get('/packageservice', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packageservice'
])->name('packageservice');

Route::post('/packageserviceinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packageserviceinsert'
])->name('packageserviceinsert');

Route::post('/packageservicefetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packageservicefetch'
])->name('packageservicefetch');

Route::post('/packageserviceedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packageserviceedit'
])->name('packageserviceedit');

Route::get('packageservicedelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@packageservicedelete'
])->name('packageservicedelete');

Route::get('/exclusive', [
    'middleware' => 'auth',
    'uses' => 'HomeController@exclusive'
])->name('exclusive');

Route::post('/exclusiveinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@exclusiveinsert'
])->name('exclusiveinsert');

Route::post('/editexclusive', [
    'middleware' => 'auth',
    'uses' => 'HomeController@editexclusive'
])->name('editexclusive');

Route::get('/queiry', [
    'middleware' => 'auth',
    'uses' => 'HomeController@queiry'
])->name('queiry');

Route::post('/queryfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@queryfetch'
])->name('queryfetch');

Route::post('/editquery', [
    'middleware' => 'auth',
    'uses' => 'HomeController@editquery'
])->name('editquery');

Route::get('/wallets', [
    'middleware' => 'auth',
    'uses' => 'HomeController@wallets'
])->name('wallets');

Route::post('/walletsfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@walletsfetch'
])->name('walletsfetch');

Route::get('/walletcredithis', [
    'middleware' => 'auth',
    'uses' => 'HomeController@walletcredithis'
])->name('walletcredithis');

Route::post('/walletcredithisfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@walletcredithisfetch'
])->name('walletcredithisfetch');

Route::get('/walletdebtthis', [
    'middleware' => 'auth',
    'uses' => 'HomeController@walletdebtthis'
])->name('walletdebtthis');

Route::post('/walletdebtthisfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@walletdebtthisfetch'
])->name('walletdebtthisfetch');

Route::get('/suggcomplnt', [
    'middleware' => 'auth',
    'uses' => 'HomeController@suggession_complaints'
])->name('suggcomplnt');

Route::post('/suggcomplntfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@suggcomplntfetch'
])->name('suggcomplntfetch');

Route::get('suggcomplntdelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@suggcomplntdelete'
])->name('suggcomplntdelete');

Route::get('/termcondition', [
    'middleware' => 'auth',
    'uses' => 'HomeController@termcondition'
])->name('termcondition');

Route::get('/feature', [
    'middleware' => 'auth',
    'uses' => 'HomeController@feature'
])->name('feature');

Route::post('/featureinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@featureinsert'
])->name('featureinsert');

Route::post('/termconditioninsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@termconditioninsert'
])->name('termconditioninsert');

Route::post('/termconditionfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@termconditionfetch'
])->name('termconditionfetch');

Route::post('/edittermcondition', [
    'middleware' => 'auth',
    'uses' => 'HomeController@edittermcondition'
])->name('edittermcondition');

Route::get('termconditiondelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@termconditiondelete'
])->name('termconditiondelete');






Route::get('/marketproducts', 'HomeController@marketproducts')->name('marketproducts');

Route::post('/marketproductinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@marketproductinsert'
])->name('marketproductinsert');

Route::post('/marketproductimageinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@marketproductimageinsert'
])->name('marketproductimageinsert');

Route::post('marketproductfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@marketproductfetch'
])->name('marketproductfetch');

Route::post('getmarketsubcatlist', [
    'middleware' => 'auth',
    'uses' => 'HomeController@getmarketsubcatlist'
])->name('getmarketsubcatlist');

Route::post('productimagefetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@productimagefetch'
])->name('productimagefetch');


Route::post('/marketproductedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@marketproductedit'
])->name('marketproductedit');


Route::get('/vouchers', 'HomeController@vouchers')->name('vouchers');

Route::post('/voucherinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@voucherinsert'
])->name('voucherinsert');

Route::post('voucherfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@voucherfetch'
])->name('voucherfetch');

Route::post('/voucheredit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@voucheredit'
])->name('voucheredit'); 

Route::post('/sendfirbasemessage', [
    'middleware' => 'auth',
    'uses' => 'HomeController@sendfirbasemessage'
])->name('sendfirbasemessage'); 

Route::get('/brands', 'HomeController@brands')->name('brands');

Route::post('/brandsinsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@brandsinsert'
])->name('brandsinsert');

Route::post('brandsfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@brandsfetch'
])->name('brandsfetch');

Route::post('/brandsedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@brandsedit'
])->name('brandsedit'); 


Route::get('/brandproducts/{Id}/{BrandName}', 'HomeController@brandproducts')->name('brandproducts');

Route::post('/brandproductsinsert/{Id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@brandproductsinsert'
])->name('brandproductsinsert');

Route::post('brandproductsfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@brandproductsfetch'
])->name('brandproductsfetch');

Route::post('/brandproductsedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@brandproductsedit'
])->name('brandproductsedit'); 
// web.php
Route::get('/shop_vehicle/{Id}', 'HomeController@shop_vehicle')->name('shop_vehicle');

Route::get('/get-subcategories/{categoryId}', 'HomeController@getSubcategories');

Route::get('/hsn', 'HomeController@hsn')->name('hsn');

Route::post('/hsninsert', [
    'middleware' => 'auth',
    'uses' => 'HomeController@hsninsert'
])->name('hsninsert');

Route::post('hsnfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@hsnfetch'
])->name('hsnfetch');

Route::post('/hsnedit', [
    'middleware' => 'auth',
    'uses' => 'HomeController@hsnedit'
])->name('hsnedit'); 


Route::get('hsndelete/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@hsndelete'
])->name('hsndelete');


Route::get('/product_order', 'HomeController@product_order')->name('product_order');


Route::post('/updateOrderStatus', [App\Http\Controllers\HomeController::class, 'updateOrderStatus'])->name('updateOrderStatus');




Route::get('/order_history', 'HomeController@order_history')->name('order_history');

Route::get('/product-orders', 'HomeController@showProductOrders')->name('productOrders');



Route::get('/customertype', [App\Http\Controllers\HomeController::class, 'customertype'])->name('customertype');
Route::post('/customertypeinsert', [App\Http\Controllers\HomeController::class, 'customertypeinsert'])->name('customertypeinsert');
Route::post('/customertypefetch', [App\Http\Controllers\HomeController::class, 'customertypefetch'])->name('customertypefetch');
Route::post('/customertypeedit', [App\Http\Controllers\HomeController::class, 'customertypeedit'])->name('customertypeedit');

//Route::post('/mobilenotificationweb', [App\Http\Controllers\HomeController::class, 'mobilenotificationweb'])->name('mobilenotificationweb');
Route::get('/notification', [App\Http\Controllers\HomeController::class, 'notification'])->name('notification');
Route::post('/notificationinsert', [App\Http\Controllers\HomeController::class, 'notificationinsert'])->name('notificationinsert');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::post('/searchcustomer', [App\Http\Controllers\HomeController::class, 'searchcustomer'])->name('searchcustomer');

//======================================================================
Route::get('/giveaway', 'GiveController@giveaway')->name('home');
Route::post('/giveawaypackages', 'GiveController@giveawaypackages')->name('giveawaypackages');
Route::get('/giveshops', 'GiveController@giveshops')->name('giveshops');
Route::post('/giveshopinsert', 'GiveController@giveshopinsert')->name('giveshopinsert');
Route::post('/giveawayfetch', [
    'middleware' => 'auth',
    'uses' => 'GiveController@giveawayfetch'
])->name('giveawayfetch');

Route::post('/editgiveawaypackages', [
    'middleware' => 'auth',
    'uses' => 'GiveController@editgiveawaypackages'
])->name('editgiveawaypackages');
Route::post('/payment_support', 'HomeController@payment_support')->name('payment_support');
//Requests
Route::get('/accrequests', 'WebController@index')->name('accrequests');
Route::post('/account/delete_request', 'WebController@delete_request')->name('account.delete_request');
//Admin
Route::get('/account_delete_requests', 'HomeController@account_delete_requests')->name('admin.account_delete_requests');
Route::get('/country', 'HomeController@country')->name('country');
Route::post('/countryinsert', [App\Http\Controllers\HomeController::class, 'countryinsert'])->name('countryinsert');
Route::post('/countryfetch', [
    'middleware' => 'auth',
    'uses' => 'HomeController@countryfetch'
])->name('countryfetch');
Route::post('/countryedit', [App\Http\Controllers\HomeController::class, 'countryedit'])->name('countryedit');
Route::get('/state', 'HomeController@state')->name('state');
Route::post('/stateinsert', [App\Http\Controllers\HomeController::class, 'stateinsert'])->name('stateinsert');
Route::post('/statefetch', [App\Http\Controllers\HomeController::class, 'statefetch'])->name('statefetch');
Route::post('/stateedit', [App\Http\Controllers\HomeController::class, 'stateedit'])->name('stateedit');
Route::get('/district', 'HomeController@district')->name('district');
Route::post('/districtinsert', [App\Http\Controllers\HomeController::class, 'districtinsert'])->name('districtinsert');
Route::post('/fetchstate', [App\Http\Controllers\HomeController::class, 'fetchstate'])->name('fetchstate');
Route::post('/fetchplaces', [App\Http\Controllers\HomeController::class, 'fetchplaces'])->name('fetchplaces');


Route::post('/districtfetch', [App\Http\Controllers\HomeController::class, 'districtfetch'])->name('districtfetch');
Route::post('/districtedit', [App\Http\Controllers\HomeController::class, 'districtedit'])->name('districtedit');
Route::get('/place', 'HomeController@place')->name('place');
Route::post('/placeinsert', [App\Http\Controllers\HomeController::class, 'placeinsert'])->name('placeinsert');
Route::post('/fetchdistrict', [App\Http\Controllers\HomeController::class, 'fetchdistrict'])->name('fetchdistrict');

Route::post('/placefetch', [App\Http\Controllers\HomeController::class, 'placefetch'])->name('placefetch');
Route::post('/placeedit', [App\Http\Controllers\HomeController::class, 'placeedit'])->name('placeedit');
Route::get('/market_category', 'HomeController@market_category')->name('market_category');
Route::get('/purchase_order', 'HomeController@purchase_order')->name('purchase_order');
Route::get('/view_bill/{id}', 'HomeController@view_bill')->name('view_bill');
Route::get('/purchaseorder_bill', 'HomeController@purchaseorder_bill')->name('purchaseorder_bill');
Route::get('/updatepo/{id}', 'HomeController@updatepo')->name('updatepo');


Route::post('/marketinsert', [App\Http\Controllers\HomeController::class, 'marketinsert'])->name('marketinsert');
Route::post('/marketfetch', [App\Http\Controllers\HomeController::class, 'marketfetch'])->name('marketfetch');
Route::post('/marketedit', [App\Http\Controllers\HomeController::class, 'marketedit'])->name('marketedit');
// Route::post('/ordertransinsert', [App\Http\Controllers\HomeController::class, 'ordertransinsert'])->name('ordertransinsert');
Route::get('/order_trans/{orderId}', 'HomeController@order_trans')->name('order_trans');

Route::get('/order_invoice/{orderId}', 'HomeController@order_invoice')->name('order_invoice');

Route::get('/order_master', 'HomeController@order_master')->name('order_master');


Route::post('/order_masterfetch', [App\Http\Controllers\HomeController::class, 'order_masterfetch'])->name('order_masterfetch');

Route::post('/orderfetch', [App\Http\Controllers\HomeController::class, 'orderfetch'])->name('orderfetch');

Route::post('/statusedit/{id}', 'HomeController@statusedit')->name('statusedit');

Route::get('/sale_order_master/{orderId}', 'HomeController@sale_order_master')->name('sale_order_master');

// Route::post('/sale_orderinsert', [App\Http\Controllers\HomeController::class, 'sale_orderinsert'])->name('sale_orderinsert');
Route::post('/sale_orderinsert', 'HomeController@sale_orderinsert');



Route::get('cancel-order/{orderId}', 'HomeController@cancelorder')->name('cancel-order');

Route::get('/sale_list', 'HomeController@sale_list')->name('sale_list');

Route::get('/sale_bill/{orderId}', 'HomeController@sale_bill')->name('sale_bill');





Route::post('/imagecompress', 'HomeController@imagecompress')->name('imagecompress');

// Route::get('orderdelete/{id}', [
//     'middleware' => 'auth',
//     'uses' => 'HomeController@orderdelete'
// ])->name('orderdelete');
// Route::post('/orderedit', [App\Http\Controllers\HomeController::class, 'orderedit'])->name('orderedit');

Route::get('/app_version', 'HomeController@app_version')->name('app_version');

Route::post('/appversionfetch', [App\Http\Controllers\HomeController::class, 'appversionfetch'])->name('appversionfetch');

Route::post('/appversionedit', [App\Http\Controllers\HomeController::class, 'appversionedit'])->name('appversionedit');

Route::get('/imgcompress', 'HomeController@imgcompress')->name('imgcompress');

Route::post('/imagecompressinsert', [App\Http\Controllers\HomeController::class, 'imagecompressinsert'])->name('imagecompressinsert');

// Inside your routes/web.php
Route::post('/subcategoryfetch', [App\Http\Controllers\HomeController::class, 'subcategoryfetch'])->name('subcategoryfetch');
Route::get('/subcategory/{catId}/{categoryname}', 'HomeController@subcategory')->name('subcategory');
Route::post('/subcategoryinsert', [App\Http\Controllers\HomeController::class, 'subcategoryinsert'])->name('subcategoryinsert');
Route::post('/subcategoryedit', [App\Http\Controllers\HomeController::class, 'subcategoryedit'])->name('subcategoryedit');
Route::delete('/delete-image/{imageName}', 'HomeController@deleteImage');
Route::post('/deleteImages', 'HomeController@deleteImages')->name('deleteImages');
Route::get('/marketwallet', 'HomeController@marketwallet')->name('marketwallet');
Route::post('/fetchsubcategory', [App\Http\Controllers\HomeController::class, 'fetchsubcategory'])->name('fetchsubcategory');
Route::post('/marketproductimagedelete', [App\Http\Controllers\HomeController::class, 'marketproductimagedelete'])->name('marketproductimagedelete');
Route::get('/marketvendor', 'HomeController@marketvendor')->name('marketvendor');
Route::post('/vendorinsert', [App\Http\Controllers\HomeController::class, 'vendorinsert'])->name('vendorinsert');
Route::post('/vendorfetch', [App\Http\Controllers\HomeController::class, 'vendorfetch'])->name('vendorfetch');
Route::post('/vendoredit', [App\Http\Controllers\HomeController::class, 'vendoredit'])->name('vendoredit');
Route::post('/purchaseorderfetch', [App\Http\Controllers\HomeController::class, 'purchaseorderfetch'])->name('purchaseorderfetch');

Route::get('/bill/{id}', 'HomeController@bill')->name('bill');
Route::get('/purchaseeditorder/{purchaseid}', 'HomeController@purchaseeditorder')->name('purchaseeditorder');
Route::post('/editorderpurchase', [App\Http\Controllers\HomeController::class, 'editorderpurchase'])->name('editorderpurchase');

Route::post('/purchaseorderedit', [App\Http\Controllers\HomeController::class, 'purchaseorderedit'])->name('purchaseorderedit');

Route::post('/delete-product', [App\Http\Controllers\HomeController::class, 'deleteProduct'])->name('delete_product');


Route::post('/purchaseorder/{id}', 'HomeController@updatePurchaseOrder')->name('updatePurchaseOrder');
Route::get('/remove-product/{id}', 'HomeController@removeProduct')->name('remove.product');
Route::get('/productfetchdetails', 'HomeController@productfetchdetails')->name('productfetchdetails');
Route::post('/search_products', [App\Http\Controllers\HomeController::class, 'productSearch'])->name('search_products');


Route::post('/deleteProduct', 'HomeController@deleteProduct')->name('deleteProduct');

Route::get('/productpriority', 'HomeController@productpriority')->name('productpriority');
Route::post('/search_product', [
    'middleware' => 'auth',
    'uses' => 'HomeController@search_product'
])->name('search_product');
Route::post('/update_Priority', [App\Http\Controllers\HomeController::class, 'update_Priority'])->name('update_Priority');
Route::get('/remove-priority/{productId}', 'HomeController@removePriority')->name('removePriority');
Route::post('/search_sale',['middleware' => 'auth',
'uses' => 'HomeController@search_sale'])->name('search_sale');
Route::post('/search_order',['middleware' => 'auth',
'uses' => 'HomeController@search_order'])->name('search_order');
Route::post('/delete-product', 'HomeController@deleteProduct')->name('delete_product');
Route::get('/salesreturn','HomeController@salesreturn')->name('salesreturn');
Route::get('/purchase_order_master/{orderId}','HomeController@purchase_order_master')->name('purchase_order_master');

Route::post('/returnfetch', [App\Http\Controllers\HomeController::class, 'returnfetch'])->name('returnfetch');
Route::post('/returnedit', [App\Http\Controllers\HomeController::class, 'returnedit'])->name('returnedit');
Route::get('/rolemenu','HomeController@rolemenu')->name('rolemenu');
Route::post('/roleinsert', [App\Http\Controllers\HomeController::class, 'roleinsert'])->name('roleinsert');
Route::post('/rolefetch', [App\Http\Controllers\HomeController::class, 'rolefetch'])->name('rolefetch');
Route::post('/roleedit', [App\Http\Controllers\HomeController::class, 'roleedit'])->name('roleedit');
Route::post('/purchase_orderinsert', [App\Http\Controllers\HomeController::class, 'purchase_orderinsert'])->name('purchase_orderinsert');

Route::get('/godown', [App\Http\Controllers\stockController::class, 'godown'])->name('godown');
Route::get('/stockreport', [App\Http\Controllers\stockController::class, 'stockreport'])->name('stockreport');

Route::post('/godowninsert', [App\Http\Controllers\stockController::class, 'godowninsert'])->name('godowninsert');

Route::post('/godownfetch', [App\Http\Controllers\stockController::class, 'godownfetch'])->name('godownfetch');

Route::post('/godownedit', [App\Http\Controllers\stockController::class, 'godownedit'])->name('godownedit');

Route::get('/physical_stock', [App\Http\Controllers\stockController::class, 'physical_stock'])->name('physical_stock');

Route::post('/product_search', [App\Http\Controllers\stockController::class, 'productSearch'])->name('product_search');

Route::post('/physical_stockinsert', [App\Http\Controllers\stockController::class, 'physical_stockinsert'])->name('physical_stockinsert');


Route::post('/get-products/{masterId}', [App\Http\Controllers\stockController::class, 'getProductsByMasterId'])->name('get-products');

Route::get('/inventory_transfer', [App\Http\Controllers\stockController::class, 'inventory_transfer'])->name('inventory_transfer');

Route::post('/inventory_transferinsert', [App\Http\Controllers\stockController::class, 'inventory_transferinsert'])->name('inventory_transferinsert');

Route::post('/transfer_products/{masterId}', [App\Http\Controllers\stockController::class, 'transfer_products'])->name('transfer_products');

Route::post('/inventoryTransferEdit', [App\Http\Controllers\stockController::class, 'inventoryTransferEdit'])->name('inventoryTransferEdit');

Route::post('/inventoryTransferFetch', [App\Http\Controllers\stockController::class, 'inventoryTransferFetch'])->name('inventoryTransferFetch');

Route::get('/ledger_master', [App\Http\Controllers\ledgerController::class, 'ledger_master'])->name('ledger_master');

Route::post('/ledger_masterinsert', [App\Http\Controllers\ledgerController::class, 'ledger_masterinsert'])->name('ledger_masterinsert');

Route::post('/ledger_masteredit', [App\Http\Controllers\ledgerController::class, 'ledger_masteredit'])->name('ledger_masteredit');

Route::post('/ledgerfetch', [App\Http\Controllers\ledgerController::class, 'ledgerfetch'])->name('ledgerfetch');


Route::get('/expense', [App\Http\Controllers\ledgerController::class, 'expense'])->name('expense');

Route::post('/expenseinsert', [App\Http\Controllers\ledgerController::class, 'expenseinsert'])->name('expenseinsert');

Route::post('/expensefetch', [App\Http\Controllers\ledgerController::class, 'expensefetch'])->name('expensefetch');

Route::post('/expensedit', [App\Http\Controllers\ledgerController::class, 'expensedit'])->name('expensedit');

Route::get('/expensedelete/{id}', [App\Http\Controllers\ledgerController::class, 'expensedelete'])->name('expensedelete');



//Accounts Module 
Route::get('/revenue_master', 'AccountController@revenue_master')->name('revenue_master');

Route::get('/totalexpense', 'AccountController@totalexpense')->name('totalexpense');

Route::get('/turnover', 'AccountController@turnover')->name('turnover');


Route::get('/b2corders', [App\Http\Controllers\B2cController::class, 'b2corders'])->name('b2corders');

Route::get('/b2c_salelist', [App\Http\Controllers\B2cController::class, 'b2c_salelist'])->name('b2c_salelist');

Route::get('/b2csale_order/{orderId}', [App\Http\Controllers\B2cController::class, 'b2csale_order'])->name('b2csale_order');

Route::post('/b2csale_orderinsert', [App\Http\Controllers\B2cController::class, 'b2csale_orderinsert'])->name('b2csale_orderinsert');

Route::get('/b2corder_invoice/{orderId}', [App\Http\Controllers\B2cController::class, 'b2corder_invoice'])->name('b2corder_invoice');

Route::get('/b2csale_bill/{orderId}', [App\Http\Controllers\B2cController::class, 'b2csale_bill'])->name('b2csale_bill');

Route::get('/b2cancel-order/{orderId}', [App\Http\Controllers\B2cController::class, 'b2cancelorder'])->name('b2cancel-order');

Route::post('/b2csearch_order', [App\Http\Controllers\B2cController::class, 'b2csearch_order'])->name('b2csearch_order');

Route::post('/b2cstatusedit/{id}', [App\Http\Controllers\B2cController::class, 'b2cstatusedit'])->name('b2cstatusedit');

Route::post('/b2corderfetch', [App\Http\Controllers\B2cController::class, 'b2corderfetch'])->name('b2corderfetch');

Route::get('/b2corders/search', [App\Http\Controllers\B2cController::class, 'search'])->name('b2corders.search');


