  <!--Main Navigation-->
  <style>
.info .img_logo {
    width: 192px;
}

.card {
    font-size: 13px;
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
                      <li class="nav-item has-treeview menu-open">
                          <a href="#" class="nav-link active">
                              <i class="nav-icon fas fa-tachometer-alt"></i>
                              <p>
                                  Dashboard
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>

                      </li>



                      <li class="nav-item">
                          @if($role==1) <a href="{{url('superadmin')}}" class="nav-link"> @else <a href="#"
                                  class="nav-link">@endif
                                  <i class="nav-icon fas fa-user "></i>
                                  <p>
                                      {{$name}}
                                  </p>
                              </a>
                      </li>

                      @if($role==1)

                      <li class="nav-item has-treeview">
                          <a href="{{'app_version'}}" class="nav-link">
                          <i class="fa fa-cogs"></i>
                              <p>
                                  App Version
                                 
                              </p>
                          </a>
</li>
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
                              Franchise Module
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                          <li class="nav-item">
                <a href="{{ url('country') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Country</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('state') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>State</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('district') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>District</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('place') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Place</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('franchises') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Franchise List</p>
                </a>
              </li>

                          </ul>
                      </li>


                      <li class="nav-item has-treeview">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-briefcase"></i>
                              <p>
                                  Market Place
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                          <li class="nav-item">
                                  <a href="{{ url('market_category') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Categories</p>
                                  </a>
                              </li>
                            
                            
                              <li class="nav-item">
                                  <a href="{{ url('marketproducts') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Brands</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ url('vouchers') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Vouchers</p>
                                  </a>
                              </li>

                              

                              <li class="nav-item">
                                  <a href="{{ url('order_master') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>orders</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ url('marketwallet') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Wallets</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ url('imgcompress') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Image Drive</p>
                                  </a>
</li>
                          </ul>
                      </li>





                      <li class="nav-item has-treeview">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-briefcase"></i>
                              <p>
                                  Bookings
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{url('timeslot')}}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Book Timeslots</p>
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

                              </p>
                          </a>
                      </li>

       
        

          <li class="nav-item">
            <a href="{{url('crm')}}" class="nav-link">
              <i class="nav-icon fas fa-id-card "></i>
              <p>
               Staff
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
                              <p> Delete Requests</p>
                          </a>
                      </li>


                  </ul>
                  </li>

                  @elseif($role==2)
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-briefcase"></i>
                          <p>
                              Bookings
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{url('timeslot')}}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Book Timeslots</p>
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

                      </ul>
                  </li>

                  @elseif($role==3)

                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-briefcase"></i>
                          <p>
                              Bookings
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{url('timeslot')}}" class="nav-link">
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
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-id-card "></i>
                              <p>
                              Revenue

                              </p>
                          </a>
                      </li>

      
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-id-card "></i>
                              <p>
                              Expense

                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-id-card "></i>
                              <p>
                              Monthly Reports

                              </p>
                          </a>
                      </li>
                      @elseif($role==4)
                      <li class="nav-item has-treeview">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-briefcase"></i>
                              <p>
                              Franchise Module
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                          <li class="nav-item">
                <a href="{{ url('country') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Country</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('state') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>State</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('district') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>District</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('place') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Place</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('franchises') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Franchise List</p>
                </a>
              </li>

                          </ul>
                      </li>

                      @elseif($role==5)
                      <li class="nav-item has-treeview">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-briefcase"></i>
                              <p>
                                  Market Place
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                          <li class="nav-item">
                                  <a href="{{ url('market_category') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Categories</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ url('marketproducts') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Products</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ url('vouchers') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Vouchers</p>
                                  </a>
                              </li>

                              

                              <li class="nav-item">
                                  <a href="{{ url('order_master') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>orders</p>
                                  </a>
                              </li>

                           

                          </ul>
                      </li>
                      @elseif($role==6)
                      <li class="nav-item has-treeview">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-briefcase"></i>
                              <p>
                              Franchise Module
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                          <li class="nav-item">
                <a href="{{ url('country') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Country</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('state') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>State</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('district') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>District</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('place') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Place</p>
                </a>
              </li>
             

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