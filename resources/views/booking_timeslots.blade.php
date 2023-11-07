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

              <li class="breadcrumb-item active">Add Executive</li>

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

                <h3 class="card-title">Booking Timeslots</h3>

                <p align="right">

               

           @if($role==1)     <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Booking Timeslots</button>@endif

              
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



<form method="POST" action="{{url('timeslotinsert')}}">



@csrf



<div class="modal-dialog" role="document" style="width:80%;">



<div class="modal-content">



<div class="modal-header">



<h5 class="modal-title" id="exampleModalLabel">Add Booking Timeslots</h5>



<button type="button" class="close" data-dismiss="modal" aria-label="Close">



<span aria-hidden="true">&times;</span>



</button>



</div>



<div class="modal-body row">




<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Customer</label>
                                        <select name="cust" class="form-control">
                                        <option value="0">select Customer</option>
                                        @foreach($custmr as $cust)
                                        <option value="{{$cust->id}}">{{$cust->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop Category</label>
                                        <select name="shop_cat" class="form-control">
                                        <option value="0">select Shop Category</option>
                                       @foreach($shop_category as $key)
                                        <option value="{{$key->id}}">{{$key->category}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									
				<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop</label>
                                        <select name="shop" class="form-control">
                                        <option value="0">select Shop</option>
                                        @foreach($shops as $key)
                                        <option value="{{$key->id}}">{{$key->shopname}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									
									<div class="form-group col-sm-6">
													<label class="exampleModalLabel">Book Type</label>
													<select name="type1" class="form-control" id="bannertype1">
													    <option value="0">Select Type</option>
														<option value="1">Normal</option>
														<option value="2">Offer</option>
														<option value="3">Service</option>
													</select>
												</div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">Added Date</label>



<input type="date" class="form-control" name="date" placeholder="Enter Date" required>


</div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">Time</label>



<input type="time" class="form-control" name="time" placeholder="Enter Time" required>


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
              

                </p>

               

              </div>

              <!-- /.card-header -->

              <div class="card-body">
                 <form>
                
                </form>
                <table id="example1" class="table table-bordered table-striped">

                  <thead>

                  <tr>

                    <th>id</th>

                    <th>Customer</th>
                    <th>Contact Number</th>
                    <th>Brand/Model </th>
                    <th>Book Type</th>
                    @if($role==1)
					<th>Customer phno</th>
          @endif

                    <th>Shop Category</th>

                    <th>Shop</th>
                    @if($role==1)
					<th>Shop mob</th>
          @endif
                    <th>Date</th>
                    <th>Time</th>
                    <th>Shop Total Amount </th>
                    <th>Shop offer Amount </th>
					
					
					@if($role==1 || $role==2)
					<th>Action</th>
          @endif
                  </tr>

                  </thead>

                  <tbody id="non-searchtimeslot">

                  @php 

                  $i=1;

                  @endphp

                  @foreach($timslot as $key)

                  <tr>

                    <td>{{$i}}</td>

                    <td>{{$key->name}} </td>
                    <td>{{$key->phnum}} </td>
                    <td>{{$key->brand}}/{{$key->brand_model}} </td>

                    <td>@if($key->book_type==1) Eworkshop @elseif($key->book_type==2) Offer ({{$key->offertitle}}) @else Normal Service @endif </td>
                    @if($role==1)
					<td>{{$key->phnum}} </td>
          @endif
                    <td>{{$key->category}}</td>

                    <td>{{$key->shopname}}</td>
                    @if($role==1)
					<td>{{$key->phone_number}}</td>
          @endif
					
					<td>{{$key->adate}}</td>
					
					<td>{{$key->timeslots}}</td>
          <td>{{$key->totalamt_shop}}</td>
          <td>{{$key->offeramt_shop}}</td>
          
					
					<!-- @if($role==1)<td><i class="fa fa-edit edit_timeslot"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
					<i class="fa fa-eye view_timeslot"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
					   <a href="{{url('timeslotdelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>
             @if($key->work_status==0)  <button type="button" data-id="{{$key->id}}" data-toggle="modal"  class="btn tbn-sm btn-success pending-modal">Status</button>@endif
            
            </td>@endif -->
            @if($role==1)
<td>
    <i class="fa fa-edit edit_timeslot" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>
    <i class="fa fa-eye view_timeslot" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>
    <a href="{{ url('timeslotdelete') }}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger" aria-hidden="true" data-id="{{ $key->id }}"></i></a>
    @if($key->work_status == 0)
        <button type="button" data-id="{{ $key->id }}" data-toggle="modal" class="btn btn-sm btn-success pending-modal">Status</button>
    @endif
</td>
@elseif($role == 2)
<td>

    <button type="button" data-id="{{ $key->id }}" data-toggle="modal" data-target="#exampleModal111" class="btn btn-sm btn-success callpending-modal" id="statusButton"> @if($key->crm_status==1) Called @else Not Called @endif</button>
</td>
@endif

                  </tr>

                  @php 

                  $i++;

                

                  @endphp

                  @endforeach

                  </tbody>
                  <tbody id="searchtimeslot">
                  </tbody>

                  <tfoot>

                  <tr>

                   <th>id</th>

                    <th>Customer</th>
                    <th>Contact Number</th>

                    <th>Shop Category</th>

                    <th>Shop</th>

                    <th>Date</th>
                    <th>Time</th>
                    <th>Shop Total Amount </th>
                    <th>Shop offer Amount </th>
					
				
					@if($role==1)
					<th>Action</th>
          @endif
                  </tr>

                  </tfoot>

                </table>
              

				
				<div class="modal" id="edittimeslot_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Booking Timeslot</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('timeslotedit')}}"  name="timeslotedit">

@csrf
      <div class="modal-body row">
 <input type="hidden" class="form-control" name="id"  id="timeedit_id">

      <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Customer</label>
                                        <select name="cust" class="form-control" id="cust">
                                        <option value="0">select Customer</option>
                                        @foreach($custmr1 as $key3)
                                        <option value="{{$key3->id}}">{{$key3->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop Category</label>
                                        <select name="shop_cat" class="form-control" id="shop_cat">
                                        <option value="0">select Shop Category</option>
                                       @foreach($shop_category as $key)
                                        <option value="{{$key->id}}">{{$key->category}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									
				<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop</label>
                                        <select name="shop" class="form-control" id="shop">
                                        <option value="0">select Shop</option>
                                        @foreach($shops as $key)
                                        <option value="{{$key->id}}">{{$key->shopname}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									
									<div class="form-group col-sm-6">
													<label class="exampleModalLabel">Book Type</label>
													<select name="type1" class="form-control" id="type1">
													    <option value="0">Select Type</option>
														<option value="1">Normal</option>
														<option value="2">Offer</option>
														<option value="3">Service</option>
													</select>
												</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">Added Date</label>



<input type="date" class="form-control" name="date" placeholder="Enter Date" id="date" required>


</div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">Time</label>



<input type="time" class="form-control" name="time" placeholder="Enter Time" id="time" required>


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

<div class="modal" id="viewtimeslot_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">View Booking Timeslot</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body row">
 <input type="hidden" class="form-control" name="time_id"  id="timeview_id">

      <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Customer</label>
                                        <select name="cust" class="form-control" id="cust1">
                                        <option value="0">select Customer</option>
                                        @foreach($custmr as $cust)
                                        <option value="{{$cust->id}}">{{$cust->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop Category</label>
                                        <select name="shop_cat" class="form-control" id="shop_cat1">
                                        <option value="0">select Shop Category</option>
                                       @foreach($shop_category as $key)
                                        <option value="{{$key->id}}">{{$key->category}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									
				<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop</label>
                                        <select name="shop" class="form-control" id="shop1">
                                        <option value="0">select Shop</option>
                                        @foreach($shops as $key)
                                        <option value="{{$key->id}}">{{$key->shopname}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									
									<div class="form-group col-sm-6">
													<label class="exampleModalLabel">Book Type</label>
													<select name="type1" class="form-control" id="type2">
													    <option value="0">Select Type</option>
														<option value="1">Normal</option>
														<option value="2">Offer</option>
														<option value="3">Service</option>
													</select>
												</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">Added Date</label>



<input type="date" class="form-control" name="date" placeholder="Enter Date" id="date1" required>


</div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">Time</label>



<input type="time" class="form-control" name="time" placeholder="Enter Time" id="time1" required>


</div>



      </div>
      
      <div class="modal-footer">
       
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
     
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="exampleModal11">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Work Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('updatestatus')}}" enctype="multipart/form-data">@csrf
      <div class="modal-body row">
         <div class="col-sm-12">
            <input type="hidden" name="keyid" id="keyid">
            <input type="hidden" name="keyvalue" id="keyvalue" value="2">
            <select name="status" class="form-control">
               <option value="0">Not Completed</option>
               <option value="1">Completed</option>
</select>
</div>

<div class="col-sm-12">
            <input type="text" name="amount" id="amount">
           
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

<div class="modal fade" id="exampleModal111" tabindex="-1" role="dialog" aria-labelledby="exampleModal111Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Call Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('updatecallstatus') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="keyid" id="keyidd">
                    <!-- <input type="hidden" name="keyvalue" id="keyvalue" value="2"> -->
                    <div class="form-group">
                        <label for="crm_status">Status</label>
                        <select name="crm_status" class="form-control" id="status">
                            <option value="0">Not Called</option>
                            <option value="1">Called</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="crm_remark">Remark</label>
                        <textarea name="remark" id="remark" class="form-control"></textarea>
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