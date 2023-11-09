@extends('layout.mainlayout')



@section('content')

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

          

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="home">Home</a></li>

              <li class="breadcrumb-item active">Shops</li>

            </ol>

          </div>

        </div>

      </div><!-- /.container-fluid -->

    </section>

  

    @if(session('success'))

    <h3 style="margin-left: 19px;color: green;">{{session('success')}}</h3>

    @endif



    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">

        <div class="row">

          <div class="col-12">

           

            <!-- /.card -->



            <div class="card">

              <div class="card-header">

                <h3 class="card-title">Add Shops</h3>

                <p align="right">

               

                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Shops</button>

              
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



                <form method="POST" action="{{url('shopinsert')}}" enctype="multipart/form-data">



                @csrf



                <div class="modal-dialog" role="document" style="width:80%;">



                <div class="modal-content">



                <div class="modal-header">



                <h5 class="modal-title" id="exampleModalLabel">Add Shops</h5>



                <button type="button" class="close" data-dismiss="modal" aria-label="Close">



                <span aria-hidden="true">&times;</span>



                </button>



                </div>



                <div class="modal-body row">




                <div class="form-group col-sm-6">


                <label class="exampleModalLabel">Category</label>



                <select name="category" class="form-control">

                <option value="0">Select Category</option>
                @foreach($shop_categories as $key)

                <option value="{{$key->id}}">{{$key->category}}</option>

                @endforeach
                </select>


                </div>
                

                <div class="form-group col-sm-6">



                <label class="exampleModalLabel">Image</label>



                <input type="file"  name="image" accept="image/*" required>


                </div>
                <div class="form-group col-sm-6">


                <label class="exampleModalLabel">Shop Name</label>



                <input class="form-control" name="shopname"  required>


                </div>
                <div class="form-group col-sm-6">


                <label class="exampleModalLabel">Address</label>


                <textarea class="form-control" name="address" required></textarea>


                </div>
                <div class="form-group col-sm-6">


                <label class="exampleModalLabel">Phone Number 1</label>



                <input class="form-control" name="phone1" required>


                </div>
				<div class="form-group col-sm-6">


                <label class="exampleModalLabel">Call Number</label>



                <input class="form-control" name="phone2" required>


                </div>
                <div class="form-group col-sm-6">


                <label class="exampleModalLabel">Pincode</label>



                <input class="form-control" name="pincode" required>


                </div>
				
				<div class="form-group col-sm-6">


                <label class="exampleModalLabel">Open Time</label>



                <input class="form-control" name="open" required>


                </div>
				<div class="form-group col-sm-6">


                <label class="exampleModalLabel">Close Time</label>



                <input class="form-control" name="close" required>


                </div>
				
				<div class="form-group col-sm-6">


                <label class="exampleModalLabel">Transaction Id.</label>



                <input class="form-control" name="trans_id" required>


                </div>
				
				<div class="form-group col-sm-6">


                <label class="exampleModalLabel">Agrement Status</label> &nbsp;&nbsp;

                <input type="radio"  name="verif_status" required value="1"> Yes
       
                <input type="radio"  name="verif_status" required value="0"> No
				
                </div>
				
				<div class="form-group col-sm-6">


                <label class="exampleModalLabel">Pay Status</label> &nbsp;&nbsp;

                <input type="radio"  name="pay_status" required value="1"> Paid
       
                <input type="radio"  name="pay_status" required value="0"> Unpaid
				
                </div>
				
				<div class="form-group col-sm-6">


                <label class="exampleModalLabel">Shop Status</label> &nbsp;&nbsp;

                <input type="radio"  name="oc_status" required value="1"> Open
       
                <input type="radio"  name="oc_status" required value="0"> Close
				
                </div>

                <div class="form-group col-sm-6">


<label class="exampleModalLabel">Autherised status</label> &nbsp;&nbsp;

<input type="radio"  name="autherised" required value="1"> yes

<input type="radio"  name="autherised" required value="0"> No

</div>
				
				<div class="form-group col-sm-6">


                <label class="exampleModalLabel">Executive Name</label>



                <select name="exename" class="form-control">

                <option value="0">Select Executive</option>
                
				@foreach($exe as $key1)

                <option value="{{$key1->id}}">{{$key1->name}}</option>

                @endforeach
				
                </select>


                </div>
				
                <div class="form-group col-sm-6">


                <label class="exampleModalLabel">Description</label>


                <textarea class="form-control" name="desc" ></textarea>


                </div>
                <div class="form-group col-sm-6">


                <label class="exampleModalLabel">Latitude</label>



                <input class="form-control" name="latitude" required>


                </div>
                <div class="form-group col-sm-6">


                <label class="exampleModalLabel">Longitude</label>



                <input class="form-control" name="longitude" required>


                </div>

                </div>



                <div class="modal-footer">



                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>



                <button type="submit" name="submit" class="btn btn-primary">Add</button>



                </div>



                </div>



                </div>



                </form>



                </div>
              


               

              </div>

              <!-- /.card-header -->

              <div class="card-body">
              <form>
                   <div class="col-md-4">
                      <div class="form-group">
                        <input type="text" name="search_shop" class="form-control" id="search_shop" placeholder="Search" value="">
                      </div>
                    </div>
                </form>

                <a href="{{url('exportshop')}}"><button type="button" class="btn btn-secondary btn-sm">Export</button></a>

                <table  class="table table-bordered table-striped" id="example354">

                  <thead>

                  <tr>

                    <th>id</th>

                    <th>Image</th>

                    <th>Category</th>

                    <th>Shopname</th>

                    <th>Address</th>

                    <th>Phone Number </th>

                    <th>Pincode</th>

                    <th>Shop Type</th>

                  

<th>Action</th>


                  </tr>

                  </thead>

                  <tbody id="non-searchshoplist">

                  @php 

                  $i=1;

                  @endphp

                  @foreach($shops as $key)

                  <tr>

                    <td>{{$i}}</td>
                    

                    <td><img src="{{ asset('/img/'.$key->image) }}" alt="" width="75"/></td>
                    <td>{{$key->category}}</td>
                    <td>{{$key->shopname}}</td>
                    <td>{{$key->address}}</td>
                    <td>{{$key->phone_number}}</td>
                    <td>{{$key->pincode}}</td>
                    <td>@if($key->authorised_status==0) <button type="button" class="btn btn-info btn-sm">Visted Shop</button> @elseif($key->authorised_status==1)  <button type="button" class="btn btn-success btn-sm">Autherised Shop</button> @endif</td>
					         
                   

                    <td>
							  <i class="fa fa-edit edit_shop "  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                @if($role==1)
                    <i class="fa fa-eye view_shop "  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                   <a href="{{url('shopdelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>
                   @endif
                  </td>


                   

                  </tr>

                  @php 

                  $i++;

                

                  @endphp

                  @endforeach

                  </tbody>
                  <tbody id="searchshoplist">
                  </tbody>

                  <tfoot>

                    <tr>

                      <th>id</th>

                      <th>Image</th>

                      <th>Category</th>

                      <th>Shopname</th>

                      <th>Address</th>

                      <th>Phone Number </th>

                      <th>Pincode</th>

                      <th>Shop Type</th>

                     

<th>Action</th>



                    </tr>

                  </tfoot>

                </table>

                <div class="clearfix" id="shop_pagination">
                  
                {!! $shops->render( "pagination::bootstrap-4") !!}
                    

</div>
				
				<div class="modal" id="viewshop_modal" tabindex="-1" role="dialog" >
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">View Shop </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    
                    <div class="modal-body row">


                      <input type="hidden" name="id" id="id">
                      <input type="hidden" name="image" id="image">

                      <div class="form-group col-sm-6">

                      <select name="category" id="category" class="form-control">

                      <option value="0">Select Category</option>
                      @foreach($shop_categories as $key)

                      <option value="{{$key->id}}">{{$key->category}}</option>

                      @endforeach
                      </select>


                      </div>
                      

                      
                      
                      <div class="form-group col-sm-6">


                      <label class="exampleModalLabel">Shop Name</label>



                      <input class="form-control" name="shopname" id="shopname" required>


                      </div>
                      <div class="form-group col-sm-6">


                      <label class="exampleModalLabel">Address</label>


                      <textarea class="form-control" name="address" id="address" required></textarea>


                      </div>
                      <div class="form-group col-sm-6">


                      <label class="exampleModalLabel">Phone Number 1</label>



                      <input class="form-control" name="phone1" id="phone1" required>


                      </div>
					  <div class="form-group col-sm-6">


                      <label class="exampleModalLabel">Call Number</label>



                      <input class="form-control" name="phone2" id="phone2" required>


                      </div>
                      <div class="form-group col-sm-6">


                      <label class="exampleModalLabel">Pincode</label>



                      <input class="form-control" name="pincode" id="pincode" required>


                      </div>
					  <div class="form-group col-sm-6">


                     <label class="exampleModalLabel">Open Time</label>



                       <input class="form-control" name="open" id="open" required>


                     </div>
				    <div class="form-group col-sm-6">

  
                   <label class="exampleModalLabel">Close Time</label>



                   <input class="form-control" name="close" id="close" required>


                     </div>
					 <div class="form-group col-sm-6">


                <label class="exampleModalLabel">Transaction Id.</label>



                <input class="form-control" name="trans_id" id="trans_id" required>


                </div>
				<div class="form-group col-sm-6">


                <label class="exampleModalLabel">Agrement Status</label> &nbsp;&nbsp;

                <input type="radio"  name="verif_status" required value="1" id="verif_status_1"> Yes
       
                <input type="radio"  name="verif_status" required value="0" id="verif_status_0"> No
				
                </div>
				
				<div class="form-group col-sm-6">


                <label class="exampleModalLabel">Pay Status</label> &nbsp;&nbsp;

                <input type="radio"  name="pay_status" required value="1" id="pay_status_1"> Paid
       
                <input type="radio"  name="pay_status" required value="0" id="pay_status_0"> Unpaid
				
                </div>
				
				<div class="form-group col-sm-6">


                <label class="exampleModalLabel">Shop Status</label> &nbsp;&nbsp;

                <input type="radio"  name="oc_status" required value="1" id="oc_status_1"> Open
       
                <input type="radio"  name="oc_status" required value="0" id="oc_status_0"> Close
				
                </div>
				<div class="form-group col-sm-6">


                <label class="exampleModalLabel">Executive Name</label>



                <select name="exename" class="form-control" id="exename">

                <option value="0">Select Executive</option>
                
				@foreach($exe as $key1)

                <option value="{{$key1->id}}">{{$key1->name}}</option>

                @endforeach
				
                </select>


                </div>
                      <div class="form-group col-sm-6">


                      <label class="exampleModalLabel">Description</label>


                      <textarea class="form-control" name="desc"id="desc" ></textarea>


                      </div>
                      <div class="form-group col-sm-6">


                      <label class="exampleModalLabel">Latitude</label>



                      <input class="form-control" name="latitude" id="latitude" required>


                      </div>
                      <div class="form-group col-sm-6">


                      <label class="exampleModalLabel">Longitude</label>



                      <input class="form-control" name="longitude" id="longitude" required>


                      </div>

             

                    </div>
                    
                    <div class="modal-footer">
                      
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="modal" id="editshop_modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Shop </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST" action="{{url('shopedit')}}" enctype="multipart/form-data">
                                 @csrf
                    <div class="modal-body row">


                      <input type="hidden" name="id" id="edit_id">
                      <input type="hidden" name="image" id="image">

                      <div class="form-group col-sm-6">

                      <select name="category" id="category1" class="form-control">

                      <option value="0">Select Category</option>
                      @foreach($shop_categories as $key)

                      <option value="{{$key->id}}">{{$key->category}}</option>

                      @endforeach
                      </select>


                      </div>
                      

                      <div class="form-group col-sm-6">



                      <label class="exampleModalLabel">Image</label>



                      <input type="file"  name="image" accept="image/*" >


                      </div>
                      
                      <div class="form-group col-sm-6">


                      <label class="exampleModalLabel">Shop Name</label>



                      <input class="form-control" name="shopname" id="shopname1" required>


                      </div>
                      <div class="form-group col-sm-6">


                      <label class="exampleModalLabel">Address</label>


                      <textarea class="form-control" name="address" id="address1" required></textarea>


                      </div>
                      <div class="form-group col-sm-6">


                      <label class="exampleModalLabel">Phone Number 1</label>



                      <input class="form-control" name="phone1" id="phone3" required>


                      </div>
					  <div class="form-group col-sm-6">


                      <label class="exampleModalLabel">Call Number</label>



                      <input class="form-control" name="phone2" id="phone4" required>


                      </div>
                      <div class="form-group col-sm-6">


                      <label class="exampleModalLabel">Pincode</label>



                      <input class="form-control" name="pincode" id="pincode1" required>


                      </div>
					  <div class="form-group col-sm-6">


                     <label class="exampleModalLabel">Open Time</label>



                       <input class="form-control" name="open" id="open1" required>


                     </div>
				    <div class="form-group col-sm-6">

  
                   <label class="exampleModalLabel">Close Time</label>



                   <input class="form-control" name="close" id="close1" required>


                     </div>
					 <div class="form-group col-sm-6">


                <label class="exampleModalLabel">Transaction Id.</label>



                <input class="form-control" name="trans_id" id="trans_id1" required>


                </div>
				
				<div class="form-group col-sm-6">


                <label class="exampleModalLabel">Agrement Status</label> &nbsp;&nbsp;

                <input type="radio"  name="verif_status" required value="1" id="verif_status3"> Yes
       
                <input type="radio"  name="verif_status" required value="0" id="verif_statu4"> No
				
                </div>
				
				<div class="form-group col-sm-6">


                <label class="exampleModalLabel">Pay Status</label> &nbsp;&nbsp;

                <input type="radio"  name="pay_status" required value="1" id="pay_status3"> Paid
       
                <input type="radio"  name="pay_status" required value="0" id="pay_status4"> Unpaid
				
                </div>
				
				<div class="form-group col-sm-6">


                <label class="exampleModalLabel">Shop Status</label> &nbsp;&nbsp;

                <input type="radio"  name="oc_status" required value="1" id="oc_status3"> Open
       
                <input type="radio"  name="oc_status" required value="0" id="oc_status4"> Close
				
                </div>
				
				<div class="form-group col-sm-6">


                <label class="exampleModalLabel">Executive Name</label>



                <select name="exename" class="form-control" id="exename1">

                <option value="0">Select Executive</option>
                
				@foreach($exe as $key1)

                <option value="{{$key1->id}}">{{$key1->name}}</option>

                @endforeach
				
                </select>


                </div>
                      <div class="form-group col-sm-6">


                      <label class="exampleModalLabel">Description</label>


                      <textarea class="form-control" name="desc"id="desc1"></textarea>


                      </div>
                      <div class="form-group col-sm-6">


                      <label class="exampleModalLabel">Latitude</label>



                      <input class="form-control" name="latitude" id="latitude1" required>


                      </div>
                      <div class="form-group col-sm-6">


                      <label class="exampleModalLabel">Longitude</label>



                      <input class="form-control" name="longitude" id="longitude1" required>


                      </div>

             

                    </div>
                    
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save changes</button>
                       
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              </div>

              <!-- /.card-body -->

            </div>

            <!-- /.card -->

          </div>

          <!-- /.col -->

        </div>

        <!-- /.row -->

      </div>

      <!-- /.container-fluid -->

    </section>

    <!-- /.content -->

  </div>

  @endsection