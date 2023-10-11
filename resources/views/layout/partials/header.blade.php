  <!--Main Navigation-->
  <style>
  .info .img_logo{
    width:192px;
  }
  </style>

  @php
  $role=Auth::user()->user_type;
  @endphp
  <header>
  
<!-- Sidebar navigation -->
  <aside  class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
     
      <span class="brand-text font-weight-light"> <a href="#" class="d-block "><img src="{{asset('img/roadmate.png')}}" class="img_logo" ></a></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
  
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          
          </li>

          @if($role==1)
         
          <li class="nav-item">
            <a href="{{url('superadmin')}}" class="nav-link">
              <i class="nav-icon fas fa-user "></i>
              <p>
               SuperAdmin
               <!-- <span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
         @endif
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-home"></i>
              <p>
               Master Tables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="{{url('banner')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
               Banners
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('feature')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
              Features
              
              </p>
            </a>
          </li>

       
              <li class="nav-item">
                <a href="{{url('timeslot')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Book Timeslots</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="{{ url('customertype') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer Type</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="{{ url('notification') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Notification</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>
              Give Away
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('giveaway')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Packages</p>
                </a>
              </li>
			       <li class="nav-item">
                <a href="{{url('giveshops')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Give Away Shops</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('giveawaybooking')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Give Away Booking</p>
                </a>
              </li>
              </ul>
			  </li>

          
		  
		   <li class="nav-item">
            <a href="{{url('executive')}}" class="nav-link">
              <i class="nav-icon fas fa-id-card "></i>
              <p>
               Executive
               <!-- <span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>

       
          <li class="nav-item">
            <a href="{{url('franchises')}}" class="nav-link">
              <i class="nav-icon fas fa-id-card "></i>
              <p>
               Franchises
               <!-- <span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('crm')}}" class="nav-link">
              <i class="nav-icon fas fa-id-card "></i>
              <p>
               CRM
               <!-- <span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-university"></i>
              <p>
              Stores
                <i class="fas fa-angle-left right"></i>
               
              </p>
            </a>
            <ul class="nav nav-treeview">
			 <li class="nav-item">
                <a href="{{url('store_listing')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Store list</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ url('store_categories') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Categories</p>
                </a>
              </li>
             <!-- <li class="nav-item">
                <a href="{{ url('queiry') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Store Queries</p>
                </a>
              </li>-->
             
             
            
            </ul>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Shops
                <i class="fas fa-angle-left right"></i>
               
              </p>
            </a>
            <ul class="nav nav-treeview">
			 <li class="nav-item">
                <a href="{{ url('shop_categories') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shop Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('shops') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shops</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('vshops') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Visited Shops</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('ashops') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Added Shops</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ url('shop_providcat') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Provided Categories</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ url('shopproduct_offers') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Offers</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ url('shop_offers') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shop Offers</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ url('shopoffermodels') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Offer Models</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ url('shopservices') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Services</p>
                </a>
              </li>
			   <li class="nav-item">
                <a href="{{ url('shoptimeslot') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Timeslots</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ url('shopreviews') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reviews</p>
                </a>
              </li>
             
             
            
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
              Customers Manager
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('customers')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Customers</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{url('uservehcle')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Customers Vehicles</p>
                </a>
              </li>
              <!--<li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>-->
              </ul>
			  </li>
			 
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-motorcycle  "></i>
              <p>
               Vehicles
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{url('vehtype')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vehicle Type</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ url('vehcle') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vehicles</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{url('fueltype')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fuel Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('brand')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Brands</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('models') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Models</p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-briefcase "></i>
              <p>
               Packages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('common')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Packages</p>
                </a>
              </li>
              <!--<li class="nav-item">
                <a href="{{url('packageveh')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Packages for Vehicles</p>
                </a>
              </li>-->
              <li class="nav-item">
                <a href="{{url('packagedet')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Package Details</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{url('packageshop')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shop Packages</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{url('packagebook')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Packages Book</p>
                </a>
              </li>
            <!--  <li class="nav-item">
                <a href="{{url('packfeatures')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Package Features</p>
                </a>
              </li>-->
			   <li class="nav-item">
                <a href="{{url('packageservice')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Package Services</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('shopbank')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shop bank </p>
                </a>
              </li>
           
            </ul>
          </li>
        
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
             Queries
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('mystorequeries')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Store Queries</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{url('storequeryanswr')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Store Query Answers</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{url('suggcomplnt')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Complaints&Suggestion </p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{url('termcondition')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Terms & Conditions</p>
                </a>
              </li>
              <!--<li class="nav-item">
                <a href="{{ url('random_users') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payment Reports</p>
                </a>
              </li>-->
             
            </ul>
          </li>
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
             &nbsp; <i class="fab fa-bitcoin"></i>
              <p>
             &nbsp;Wallets
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('wallets') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Wallets</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('walletcredithis') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Credit History</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ url('walletdebtthis') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Debit History</p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item">
                <a href="{{url('account_delete_requests')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Account Delete Requests</p>
                </a>
              </li>
              <!--<li class="nav-item">
                <a href="{{ url('random_users') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payment Reports</p>
                </a>
              </li>-->
             
            </ul>
          </li>
         <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
             Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/UI/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Executive Reports</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('random_users') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payment Reports</p>
                </a>
              </li>
             
            </ul>
          </li>-->
         
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