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

                  <li class="breadcrumb-item"><a href="#">Home</a></li>

                  <li class="breadcrumb-item active">Give Away Bookings</li>

               </ol>

            </div>

         </div>

      </div>

      <!-- /.container-fluid -->

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

                     <h3 class="card-title">Give Away Bookings</h3>

                     <p align="right">

                       <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Shop Packages</button>-->

                     

                  </div>

                  <!-- /.card-header -->

                  <div class="card-body">

                     <table id="example1" class="table table-bordered table-striped">

                        <thead>

                           <tr>

                              <th>id</th>

							  <th>Customer</th>

                              <th>Vehicle Model</th>

                              <th>Customer Number</th>

							  <th>Shop</th>

                              <th>Shop Number</th>

                              <th>Booked Date</th>

                              <th>Package</th>

                              <th>price</th>

                              <th>Work Status</th>

                              <th>Paymode</th>

                             

                           </tr>

                        </thead>brand_model

                        <tbody>

                           @php 

                           $i=1;

                           @endphp

                           @foreach($booking as $key)

                           <tr>

                              <td>{{$i}}</td>

							  <td>{{$key->name}}</td>

                              <td>{{$key->brand_model}}</td>

                              <td>{{$key->phnum}}</td>

							  <td>{{$key->shopname}}</td>

                              <td>{{$key->phone_number}}</td>

                              <td>{{$key->adate}}</td>

                              <td>{{$key->title}}</td>

                               <td>{{$key->price}}</td>

                               <td>@if($key->work_status==0)<button type="button" data-id="{{$key->id}}" data-toggle="modal"  class="btn tbn-sm btn-success pending-modal">Pending</button>@else Completed @endif
                                                          
                
                              
                              </td>

                               <td>@if($key->pay_status==1) 
      
                               @php
                               
                               $status=DB::table('shop_booking_payments')->where('booktimemaster_id',$key->id)->first();
                                
                                if($status!==null){ if($status->pay_type==1){ echo "Pay At Shop";  }else{ echo "Online Payment"; } }
                               
                               @endphp
                             
                               
                                @endif</td>
                             

                            

                           </tr>

                           @php 

                           $i++;

                           @endphp

                           @endforeach

                        </tbody>

                        <tfoot>

                           <tr>
<th>id</th>

<th>Customer</th>

<th>Vehicle Model</th>

<th>Customer Number</th>

<th>Shop</th>

<th>Shop Number</th>

<th>Booked Date</th>

<th>Package</th>

<th>price</th>

<th>Work Status</th>

<th>Paymode</th>



							  

                              

                             

                             

                           </tr>

                        </tfoot>

                     </table>

                   
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
            <input type="hidden" name="keyvalue" id="keyvalue" value="1">
            <select name="status" class="form-control">
               <option value="0">Not Completed</option>
               <option value="1">Completed</option>
</select>
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