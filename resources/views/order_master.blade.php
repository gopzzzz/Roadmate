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



                  <li class="breadcrumb-item active">Orders</li>



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



                     <h3 class="card-title">Order</h3>



                     <p align="right">


<!-- 
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Order</button> -->



                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



                        <form method="POST" action="{{url('orderinsert')}}" enctype="multipart/form-data">



                           @csrf



                           <div class="modal-dialog" role="document" style="width:80%;">



                              <div class="modal-content">



                                 <div class="modal-header">



                                    <h5 class="modal-title" id="exampleModalLabel">Order</h5>



                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">



                                    <span aria-hidden="true">&times;</span>



                                    </button>



                                 </div>



                                 <div class="modal-body row">

                                 <div class="form-group col-sm-6">


<label class="exampleModalLabel">Shop</label>



<select name="shopname" class="form-control">

<option value="0">Select Shop</option>
@foreach($mark as $key)

<option value="{{$key->id}}">{{$key->shopname}}</option>

@endforeach
</select>


</div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">Total Amount</label>



<input type="text"  class="form-control" name="total_amount" placeholder="Enter Total Amount" required>



</div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">Discount</label>



<input type="text"  class="form-control" name="discount" placeholder="Enter Discount" required>



</div>




<div class="form-group col-sm-6">


<label class="exampleModalLabel">Coupen</label>



<select name="coupencode" class="form-control">
<option value="0">Select Coupen Code</option>
@foreach($orderr as $key)

<option value="{{$key->id}}">{{$key->coupencode}}</option>

@endforeach


</select>

</div>

<div class="form-group col-sm-6">


<label class="exampleModalLabel">Wallet</label>



<select name="wallet" class="form-control">


</select>


</div>
<div class="form-group col-sm-6">


<br><br><label class="exampleModalLabel">Payment Mode</label> &nbsp;&nbsp;

<input type="radio"  name="paymentmode" required value="1"> Online

<input type="radio"  name="paymentmode" required value="0"> COD
</div>
                                   
<div class="form-group col-sm-6">


<label class="exampleModalLabel">Total MRP</label>



<input type="text"  class="form-control" name="total_mrp" placeholder="Enter Total MRP" required>



</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">Shipping Charge</label>



<input type="text"  class="form-control" name="shipping_charge" placeholder="Enter Shipping charge" required>



</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">Tax Amount</label>



<input type="text"  class="form-control" name="tax_amount" placeholder="Enter Tax Amount" required>



</div>

<div class="form-group col-sm-6">


<br><br><label class="exampleModalLabel">Payment Status</label> &nbsp;&nbsp;

<input type="radio"  name="pay_status" required value="1"> Paid

<input type="radio"  name="pay_status" required value="0"> Unpaid


</div>

<div class="form-group col-sm-6">


<label class="exampleModalLabel">Order Status</label>



<select name="orderstat" class="form-control">

<option value="0">Select Order Status</option>


<option value="1">Pending</option>
<option value="2">Confirmed</option>
<option value="3">Shipped</option>
<option value="4">Delivered</option>
<option value="5">Return</option>


</select>


</div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Delivery Date</label>



<input type="date"  class="form-control" name="delivery_date" placeholder="Enter Delivery Date" required>



</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">Order Date</label>



<input type="date"  class="form-control" name="order_date" placeholder="Enter Order Date" required>



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



<table id="example1" class="table table-bordered table-striped">



   <thead>



      <tr>



         <th>id</th>



         <th>Shop Name</th>
         <th>Total Amount</th>
         <th>Discount</th>
         <th>Coupen Code</th>
         <th>Wallet</th>
         <th>Payment Mode</th>
         <th>Total MRP</th>
         <th>Shipping Charge</th>
         <th>Tax Amount</th>
         <th>Payment Status</th>
         <th>Order Status</th>
         <th>Delivery Date</th>
         <th>Order Date</th>
         <th></th>


         @if($role==1)


         @endif

      </tr>



   </thead>



   <tbody>



      @php 



      $i=1;



      @endphp



      @foreach($order as $key)



      <tr>



         <td>{{$i}}</td>



         <td>{{$key->shopname}}</td>
         <td>{{$key->total_amount}}</td>
       
         <td>{{$key->discount}}</td>
         <td>{{$key->coupencode}}</td>
         <td>{{$key->wallet_redeem_id}}</td>
         <td>

@if($key->payment_mode==0) Cash on Delivery @else Online @endif


 </td>         <td>{{$key->total_mrp}}</td>
         <td>{{$key->shipping_charge}}</td>
         <td>{{$key->tax_amount}}</td>
         <td>

@if($key->payment_status==0) Unpaid @else Paid @endif


 </td>         
 <td>
    @if ($key->order_status == 1)
        Pending
    @elseif ($key->order_status == 2)
        Confirmed
    @elseif ($key->order_status == 3)
       Shipped
        @elseif ($key->order_status == 4)
       Delivered
        @elseif ($key->order_status == 5)
        Return
    @else
    @endif
</td>         <td>{{$key->delivery_date}}</td>
         <td>{{$key->order_date}}</td>
         <td style="width: 50px;">
         <!-- <a href="{{ route('order_trans', ['orderId' => $key->id]) }}" class="btn btn-success btn-sm order_trans">Bill</a> -->

         <a href="{{ route('order_trans', ['orderId' => $key->id]) }}" class="btn btn-success btn-sm order_trans">Bill</a>

</td>


         @if($role==1) 



            <!-- <i class="fa fa-edit edit_order"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i> -->

           

           <!-- <a href="{{url('orderdelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_order text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a> -->



         @endif



      </tr>



      @php 



      $i++;



      @endphp



      @endforeach



   </tbody>



   <tfoot>



      <tr>



         <th>id</th>




         <th>Shop Name</th>
         <th>Total Amount</th>
         <th>Discount</th>
         <th>Coupen Code</th>
         <th>Wallet</th>
         <th>Payment Mode</th>
         <th>Total MRP</th>
         <th>Shipping Charge</th>
         <th>Tax Amount</th>
         <th>Payment Status</th>
         <th>Order Status</th>
         <th>Delivery Date</th>
         <th>Order Date</th>
         <th></th>

         @if($role==1)


         @endif

      </tr>



   </tfoot>



</table>



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