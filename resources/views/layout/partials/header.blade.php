<!--Main Navigation-->
<style>
   .info .img_logo {
   width: 192px;
   }
   .card {
   font-size: 13px;
   }
   
   .nav-item.active > a {
      background-color: #007bff; /* Set your preferred active background color */
      color: #fff; /* Set your preferred active text color */
   }

   .nav-item.menu-open > a {
      background-color: #0056b3; /* Set your preferred open background color */
      color: #fff; /* Set your preferred open text color */
   }

   .nav-item.has-treeview > a::after {
      color: #fff;
   }

</style>
@php
$role=Auth::user()->user_type;
$name=Auth::user()->name;
@endphp
<header>
   <!-- Sidebar navigation -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light"> <a href="#" class="d-block "><img
         src="{{asset('img/roadmate.png')}}" class="img_logo"></a></span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <!-- Sidebar Menu -->
         <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
               data-accordion="false">
               <!-- Add icons to the links using the .nav-icon class
                  with font-awesome or any other icon font library -->
               <li class="nav-item has-treeview menu-open {{ request()->is('home') ? 'menu-open' : '' }}">
                  <a href="{{url('home')}}" class="nav-link active {{ request()->is('home') ? 'active' : '' }}">
                     <i class="nav-icon fas fa-tachometer-alt"></i>
                     <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                     </p>
                  </a>
               </li>
               <li class="nav-item  {{ request()->is('superadmin') ? 'menu-open' : '' }}">
                  @if($role==1) <a href="{{url('superadmin')}}" class="nav-link  {{ request()->is('superadmin') ? 'active' : '' }}"> @else 
                  <a href="#"
                     class="nav-link">
                     @endif
                     <i class="nav-icon fas fa-user "></i>
                     <p>
                        {{$name}}
                     </p>
                  </a>
               </li>
               @if($role==1)
               <li class="nav-item has-treeview {{ request()->is('app_version') ? 'menu-open' : '' }}">
               <a href="{{ url('app_version') }}" class="nav-link {{ request()->is('app_version') ? 'active' : '' }}">
                     <i class="fa fa-cogs"></i>
                     <p>
                        App Version
                     </p>
                  </a>
               </li>
               <li class="nav-item has-treeview {{ request()->is(['banner', 'feature', 'notification']) ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link {{ request()->is(['banner', 'feature', 'notification']) ? 'active' : '' }}">
                     <i class="fa fa-home"></i>
                     <p>
                        Master Tables
                        <i class="fas fa-angle-left right"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                     <a href="{{ url('banner') }}" class="nav-link {{ request()->is('banner') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>
                              Banners
                           </p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{url('feature')}}" class="nav-link  {{ request()->is('feature') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>
                              Features
                           </p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('notification') }}" class="nav-link  {{ request()->is('notification') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Notification</p>
                        </a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item has-treeview {{ request()->is(['country', 'district','state', 'place','franchises']) ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link {{ request()->is(['country', 'district','state', 'place','franchises']) ? 'active' : '' }}">
                     <i class="nav-icon fas fa-briefcase"></i>
                     <p>
                        Franchise Module
                        <i class="right fas fa-angle-left"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{ url('country') }}" class="nav-link  {{ request()->is('country') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Country</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('state') }}" class="nav-link  {{ request()->is('state') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>State</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('district') }}" class="nav-link  {{ request()->is('district') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>District</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('place') }}" class="nav-link  {{ request()->is('place') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Place</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('franchises') }}" class="nav-link  {{ request()->is('franchises') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Franchise List</p>
                        </a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item has-treeview {{ request()->is(['market_category', 'marketproducts', 'vouchers', 'marketwallet', 'marketvendor', 'imgcompress', 'hsn']) ? 'menu-open' : '' }}">
   <a href="#" class="nav-link {{ request()->is(['market_category', 'marketproducts', 'vouchers', 'marketwallet', 'marketvendor', 'imgcompress', 'hsn']) ? 'active' : '' }}">
      <i class="nav-icon fas fa-briefcase"></i>
      <p>
         Market Place
         <i class="right fas fa-angle-left"></i>
      </p>
   </a>
   <ul class="nav nav-treeview">
      <li class="nav-item">
         <a href="{{ url('market_category') }}" class="nav-link {{ request()->is('market_category') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Categories</p>
         </a>
      </li>
      <li class="nav-item">
         <a href="{{ url('marketproducts') }}" class="nav-link {{ request()->is('marketproducts') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Brands</p>
         </a>
      </li>
                     <li class="nav-item">
                        <a href="{{ url('vouchers') }}" class="nav-link {{ request()->is('vouchers') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Vouchers</p>
                        </a>
                     </li>
                     
                     <li class="nav-item">
                        <a href="{{ url('marketwallet') }}" class="nav-link {{ request()->is('marketwallet') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Wallets</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('marketvendor') }}" class="nav-link {{ request()->is('marketvendor') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Vendors</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('imgcompress') }}" class="nav-link {{ request()->is('imgcompress') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Image Drive</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('hsn') }}" class="nav-link {{ request()->is('hsn') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>HSN</p>
                        </a>
                     </li>
                     
                  </ul>
               </li>
          
<li class="nav-item has-treeview {{ request()->is(['order_master', 'sale_list', 'purchase_order', 'purchaseorder_bill', 'order_history', 'productpriority', 'salesreturn']) ? 'menu-open' : '' }}">
   <a href="#" class="nav-link {{ request()->is(['order_master', 'sale_list', 'purchase_order', 'purchaseorder_bill', 'order_history', 'productpriority', 'salesreturn']) ? 'active' : '' }}">
      <i class="nav-icon fas fa-briefcase"></i>
      <p>
         Market Orders
         <i class="right fas fa-angle-left"></i>
      </p>
   </a>
   <ul class="nav nav-treeview">
      <li class="nav-item">
         <a href="{{ url('order_master') }}" class="nav-link {{ request()->is('order_master') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Orders</p>
         </a>
      </li>
      <li class="nav-item">
         <a href="{{ url('sale_list') }}" class="nav-link {{ request()->is('sale_list') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Sales List</p>
         </a>
      </li>

                           <li class="nav-item">
                        <a href="{{ url('purchase_order') }}" class="nav-link {{ request()->is('purchase_order') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>PO Request</p>
                        </a>
                     </li>

                     <li class="nav-item">
                        <a href="{{ url('purchaseorder_bill') }}" class="nav-link {{ request()->is('purchaseorder_bill') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Purchase Order</p>
                        </a>
                     </li>
                           
                           <li class="nav-item">
                              <a href="{{ url('order_history') }}" class="nav-link {{ request()->is('order_history') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Order History</p>
                              </a>
                           </li>
                              <li class="nav-item">
                                  <a href="{{ url('productpriority') }}" class="nav-link {{ request()->is('productpriority') ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>product priority</p>
                                  </a>
                              </li>
                              <!-- <li class="nav-item">
                                  <a href="{{ url('salesreturn') }}" class="nav-link {{ request()->is('salesreturn') ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Sales Return</p>
                                  </a>
                              </li> -->
                        </ul>
                     </li>
                     <li class="nav-item has-treeview {{ request()->is('timeslot') ? 'menu-open' : '' }}">
   <a href="#" class="nav-link {{ request()->is('timeslot') ? 'active' : '' }}">
      <i class="nav-icon fas fa-briefcase"></i>
      <p>
         Bookings
         <i class="right fas fa-angle-left"></i>
      </p>
   </a>
   <ul class="nav nav-treeview">
      <li class="nav-item">
         <a href="{{ url('timeslot') }}" class="nav-link {{ request()->is('timeslot') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Book Timeslots</p>
         </a>
      </li>
   </ul>
</li>
               <li class="nav-item has-treeview {{ request()->is(['giveaway','giveshops','giveawaybooking']) ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link {{ request()->is(['giveaway','giveshops','giveawaybooking']) ? 'active' : '' }}">
                     <i class="nav-icon fas fa-briefcase"></i>
                     <p>
                        Give Away
                        <i class="right fas fa-angle-left"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{url('giveaway')}}" class="nav-link {{ request()->is('giveaway') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Packages</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{url('giveshops')}}" class="nav-link {{ request()->is('giveshops') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Give Away Shops</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{url('giveawaybooking')}}" class="nav-link {{ request()->is('giveawaybooking') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Give Away Booking</p>
                        </a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item {{ request()->is('executive') ? 'menu-open' : '' }}">
   <a href="{{ url('executive') }}" class="nav-link {{ request()->is('executive') ? 'active' : '' }}">
      <i class="nav-icon fas fa-id-card"></i>
      <p>
         Executive
      </p>
   </a>
</li>

<li class="nav-item {{ request()->is('crm') ? 'menu-open' : '' }}">
   <a href="{{ url('crm') }}" class="nav-link {{ request()->is('crm') ? 'active' : '' }}">
      <i class="nav-icon fas fa-id-card"></i>
      <p>
         Staff
      </p>
   </a>
</li>
<li class="nav-item has-treeview {{ request()->is(['store_listing', 'store_categories']) ? 'menu-open' : '' }}">
   <a href="#" class="nav-link {{ request()->is(['store_listing', 'store_categories']) ? 'active' : '' }}">
      <i class="nav-icon fas fa-university"></i>
      <p>
         Stores
         <i class="fas fa-angle-left right"></i>
      </p>
   </a>
   <ul class="nav nav-treeview">
      <li class="nav-item">
         <a href="{{ url('store_listing') }}" class="nav-link {{ request()->is('store_listing') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Store list</p>
         </a>
      </li>
      <li class="nav-item">
         <a href="{{ url('store_categories') }}" class="nav-link {{ request()->is('store_categories') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Product Categories</p>
         </a>
      </li>
   </ul>
</li>
               <li class="nav-item has-treeview  {{ request()->is(['shop_categories','shops','vshops','ashops','shop_providcat','shopproduct_offers','shop_offers','shopoffermodels','shopservices','shoptimeslot','shopreviews']) ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link  {{ request()->is(['shop_categories','shops','vshops','ashops','shop_providcat','shopproduct_offers','shop_offers','shopoffermodels','shopservices','shoptimeslot','shopreviews']) ? 'active' : '' }}">
                     <i class="nav-icon fas fa-university"></i>
                     <p>
                        Shops
                        <i class="fas fa-angle-left right"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{ url('shop_categories') }}" class="nav-link {{ request()->is('shop_categories') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Shop Categories</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('shops') }}" class="nav-link {{ request()->is('shops') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Shops</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('vshops') }}" class="nav-link {{ request()->is('vshops') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Visited Shops</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('ashops') }}" class="nav-link {{ request()->is('ashops') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Added Shops</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('shop_providcat') }}" class="nav-link {{ request()->is('shop_providcat') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Provided Categories</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('shopproduct_offers') }}" class="nav-link {{ request()->is('shopproduct_offers') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Product Offers</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('shop_offers') }}" class="nav-link {{ request()->is('shop_offers') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Shop Offers</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('shopoffermodels') }}" class="nav-link {{ request()->is('shopoffermodels') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Offer Models</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('shopservices') }}" class="nav-link {{ request()->is('shopservices') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Services</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('shoptimeslot') }}" class="nav-link {{ request()->is('shoptimeslot') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Timeslots</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('shopreviews') }}" class="nav-link {{ request()->is('shopreviews') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Reviews</p>
                        </a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item has-treeview {{ request()->is(['customers', 'uservehcle']) ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link {{ request()->is(['customers', 'uservehcle']) ? 'active' : '' }}">
                     <i class="nav-icon fas fa-user"></i>
                     <p>
                        Customers Manager
                        <i class="right fas fa-angle-left"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{url('customers')}}" class="nav-link {{ request()->is('customers') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p> Customers</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{url('uservehcle')}}" class="nav-link {{ request()->is('uservehcle') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p> Customers Vehicles</p>
                        </a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item has-treeview {{ request()->is(['vehtype', 'vehcle','fueltype','brand','models']) ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link {{ request()->is(['vehtype', 'vehcle','fueltype','brand','models']) ? 'active' : '' }}">
                     <i class="nav-icon fas fa-motorcycle  "></i>
                     <p>
                        Vehicles
                        <i class="fas fa-angle-left right"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{url('vehtype')}}" class="nav-link {{ request()->is('vehtype') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Vehicle Type</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('vehcle') }}" class="nav-link {{ request()->is('vehcle') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Vehicles</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{url('fueltype')}}" class="nav-link {{ request()->is('fueltype') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Fuel Type</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{url('brand')}}" class="nav-link {{ request()->is('brand') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Brands</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('models') }}" class="nav-link {{ request()->is('models') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Models</p>
                        </a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item has-treeview {{ request()->is(['common', 'packagedet','packageshop','packagebook','packageservice','shopbank']) ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link {{ request()->is(['common', 'packagedet','packageshop','packagebook','packageservice','shopbank']) ? 'active' : '' }}">
                     <i class="nav-icon fas fa-briefcase "></i>
                     <p>
                        Packages
                        <i class="fas fa-angle-left right"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{url('common')}}" class="nav-link {{ request()->is('common') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Packages</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{url('packagedet')}}" class="nav-link {{ request()->is('packagedet') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Package Details</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{url('packageshop')}}" class="nav-link {{ request()->is('packageshop') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Shop Packages</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{url('packagebook')}}" class="nav-link {{ request()->is('packagebook') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Packages Book</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{url('packageservice')}}" class="nav-link {{ request()->is('packageservice') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Package Services</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{url('shopbank')}}" class="nav-link {{ request()->is('shopbank') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Shop bank </p>
                        </a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item has-treeview {{ request()->is(['mystorequeries', 'storequeryanswr','suggcomplnt','termcondition']) ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link {{ request()->is(['mystorequeries', 'storequeryanswr','suggcomplnt','termcondition']) ? 'active' : '' }}">
                     <i class="nav-icon fas fa-book"></i>
                     <p>
                        Queries
                        <i class="fas fa-angle-left right"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{url('mystorequeries')}}" class="nav-link {{ request()->is('mystorequeries') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Store Queries</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{url('storequeryanswr')}}" class="nav-link {{ request()->is('storequeryanswr') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Store Query Answers</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{url('suggcomplnt')}}" class="nav-link {{ request()->is('suggcomplnt') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Complaints&Suggestion </p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{url('termcondition')}}" class="nav-link {{ request()->is('termcondition') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Terms & Conditions</p>
                        </a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item has-treeview {{ request()->is(['wallets', 'walletcredithis','walletdebtthis']) ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link  {{ request()->is(['wallets', 'walletcredithis','walletdebtthis']) ? 'active' : '' }}">
                     &nbsp; <i class="fab fa-bitcoin"></i>
                     <p>
                        &nbsp;Wallets
                        <i class="fas fa-angle-left right"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{ url('wallets') }}" class="nav-link {{ request()->is('wallets') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Wallets</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('walletcredithis') }}" class="nav-link {{ request()->is('walletcredithis') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Credit History</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('walletdebtthis') }}" class="nav-link {{ request()->is('walletdebtthis') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Debit History</p>
                        </a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item">
                  <a href="{{url('account_delete_requests')}}" class="nav-link {{ request()->is('account_delete_requests') ? 'active' : '' }}">
                     <i class="far fa-circle nav-icon"></i>
                     <p> Delete Requests</p>
                  </a>
               </li>
            </ul>
            </li>
            @elseif($role==2)
            <li class="nav-item has-treeview {{ request()->is('timeslot') ? 'menu-open' : '' }}">
               <a href="#" class="nav-link {{ request()->is('timeslot') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-briefcase"></i>
                  <p>
                     Bookings
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{url('timeslot')}}" class="nav-link {{ request()->is('timeslot') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Book Timeslots</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview {{ request()->is(['customers', 'uservehcle']) ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link {{ request()->is(['customers', 'uservehcle']) ? 'active' : '' }}">
                     <i class="nav-icon fas fa-user"></i>
                     <p>
                        Customers Manager
                        <i class="right fas fa-angle-left"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{url('customers')}}" class="nav-link {{ request()->is('customers') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p> Customers</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{url('uservehcle')}}" class="nav-link {{ request()->is('uservehcle') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p> Customers Vehicles</p>
                        </a>
                     </li>
                  </ul>
               </li>
         
            <li class="nav-item has-treeview  {{ request()->is('order_master') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('order_master') ? 'active' : '' }}">
                           <i class="nav-icon fas fa-briefcase"></i>
                           <p>
                              Market Orders
                              <i class="right fas fa-angle-left"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="{{ url('order_master') }}" class="nav-link {{ request()->is('order_master') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Orders</p>
                              </a>
                           </li>
</ul>
</li>
            @elseif($role==3)
            <li class="nav-item has-treeview {{ request()->is('ashops') ? 'menu-open' : '' }}">
               <a href="#" class="nav-link {{ request()->is('ashops') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-university"></i>
                  <p>
                     Shops
                     <i class="fas fa-angle-left right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <!-- <li class="nav-item">
                     <a href="{{ url('vshops') }}" class="nav-link">
                         <i class="far fa-circle nav-icon"></i>
                         <p>Visited Shops</p>
                     </a>
                     </li> -->
                  <li class="nav-item">
                     <a href="{{ url('ashops') }}" class="nav-link {{ request()->is('ashops') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Added Shops</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview {{ request()->is('timeslot') ? 'menu-open' : '' }}">
               <a href="#" class="nav-link {{ request()->is('timeslot') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-briefcase"></i>
                  <p>
                     Bookings
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{url('timeslot')}}" class="nav-link {{ request()->is('timeslot') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Book Timeslots</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-id-card "></i>
                  <p>
                     Product Order
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="#" class="nav-link {{ request()->is('#') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-id-card "></i>
                  <p>
                     Revenue
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="#" class="nav-link {{ request()->is('#') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-id-card "></i>
                  <p>
                     Expense
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="#" class="nav-link {{ request()->is('#') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-id-card "></i>
                  <p>
                     Monthly Reports
                  </p>
               </a>
            </li>
            @elseif($role==4)
            <li class="nav-item has-treeview {{ request()->is(['country', 'district','state', 'place','franchises']) ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link {{ request()->is(['country', 'district','state', 'place','franchises']) ? 'active' : '' }}">
                     <i class="nav-icon fas fa-briefcase"></i>
                     <p>
                        Franchise Module
                        <i class="right fas fa-angle-left"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{ url('country') }}" class="nav-link  {{ request()->is('country') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Country</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('state') }}" class="nav-link  {{ request()->is('state') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>State</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('district') }}" class="nav-link  {{ request()->is('district') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>District</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('place') }}" class="nav-link  {{ request()->is('place') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Place</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('franchises') }}" class="nav-link  {{ request()->is('franchises') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Franchise List</p>
                        </a>
                     </li>
                  </ul>
               </li>
            @elseif($role==5)
            <li class="nav-item has-treeview {{ request()->is(['market_category', 'marketproducts', 'vouchers', 'sale_list','order_master']) ? 'menu-open' : '' }}">
   <a href="#" class="nav-link {{ request()->is(['market_category', 'marketproducts', 'vouchers', 'sale_list','order_master']) ? 'active' : '' }}">
      <i class="nav-icon fas fa-briefcase"></i>
      <p>
         Market Place
         <i class="right fas fa-angle-left"></i>
      </p>
   </a>
   <ul class="nav nav-treeview">
      <li class="nav-item">
         <a href="{{ url('market_category') }}" class="nav-link {{ request()->is('market_category') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Categories</p>
         </a>
      </li>
      <li class="nav-item">
         <a href="{{ url('marketproducts') }}" class="nav-link {{ request()->is('marketproducts') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Brands</p>
         </a>
      </li>
                     <li class="nav-item">
                        <a href="{{ url('vouchers') }}" class="nav-link {{ request()->is('vouchers') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Vouchers</p>
                        </a>
                     </li>
                     <li class="nav-item">
                              <a href="{{ url('order_master') }}" class="nav-link {{ request()->is('order_master') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Orders</p>
                              </a>
                           </li>
                  <li class="nav-item">
                     <a href="{{ url('sale_list') }}" class="nav-link {{ request()->is('sale_list') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sales</p>
                     </a>
                  </li>
               </ul>
            </li>
            @elseif($role==6)
            <li class="nav-item has-treeview {{ request()->is(['country', 'district','state', 'place']) ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link {{ request()->is(['country', 'district','state', 'place']) ? 'active' : '' }}">
                     <i class="nav-icon fas fa-briefcase"></i>
                     <p>
                        Franchise Module
                        <i class="right fas fa-angle-left"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{ url('country') }}" class="nav-link  {{ request()->is('country') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Country</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('state') }}" class="nav-link  {{ request()->is('state') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>State</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('district') }}" class="nav-link  {{ request()->is('district') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>District</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('place') }}" class="nav-link  {{ request()->is('place') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Place</p>
                        </a>
                     </li>
                    
                  </ul>
               </li>
            <li class="nav-item has-treeview {{ request()->is(['vshops', 'ashops']) ? 'menu-open' : '' }}">
               <a href="#" class="nav-link {{ request()->is(['vshops', 'ashops']) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-university"></i>
                  <p>
                     Shops
                     <i class="fas fa-angle-left right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ url('vshops') }}" class="nav-link {{ request()->is('vshops') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Visited Shops</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ url('ashops') }}" class="nav-link {{ request()->is('ashops') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Added Shops</p>
                     </a>
                  </li>
               </ul>
            </li>
            @elseif($role==7)
            <li class="nav-item has-treeview {{ request()->is('ashops') ? 'menu-open' : '' }}">
               <a href="#" class="nav-link {{ request()->is('ashops') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-university"></i>
                  <p>
                     Shops
                     <i class="fas fa-angle-left right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <!-- <li class="nav-item">
                     <a href="{{ url('vshops') }}" class="nav-link">
                         <i class="far fa-circle nav-icon"></i>
                         <p>Visited Shops</p>
                     </a>
                     </li> -->
                  <li class="nav-item">
                     <a href="{{ url('ashops') }}" class="nav-link {{ request()->is('ashops') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Added Shops</p>
                     </a>
                  </li>
               </ul>
            </li>
            @endif
            </ul>
         </nav>
         <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
   </aside>
   <!--/. Sidebar navigation -->
   @include('layout.partials.nav')
</header>
<!--Main Navigation-->


