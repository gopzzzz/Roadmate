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



                        <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Order</button> -->



                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



                        <form method="POST" action="{{url('ordertransinsert')}}" enctype="multipart/form-data">



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
   <th>Shop Address</th>
   <th>Total MRP</th>
   <th>Discount</th>
   <th>Shipping Charge</th>
   <th>Total Amount</th>
  


   @if($role==1)


   @endif

</tr>



</thead>
<tbody>



@php 



$i=1;



@endphp



@foreach($order as $key)

@endforeach

<tr>



   <td>{{$i}}</td>


   <td>{{$key->shopname}}</td>

   <td>{{$key->address}}</td>

   <td>{{$key->total_mrp}}</td>
   <td>{{$key->discount}}</td>

         <td>{{$key->shipping_charge}}</td>
         <td>{{$key->total_amount}}</td>

         
      

   
     




   @if($role==1) <td>




     




   </td>@endif



</tr>



@php 



$i++;



@endphp







</tbody>

<tfoot>



<tr>
<th>id</th>



<th>Shop Name</th>
   <th>Shop Address</th>
   <th>Total MRP</th>
   <th>Discount</th>
   <th>Shipping Charge</th>
   <th>Total Amount</th>

   @if($role==1)


   @endif

</tr>



</tfoot>

</table>
<br><br>
                  </div>
                                    <div class="card-body">

<table id="example2" class="table table-bordered table-striped">



<thead>



<tr>



   <th>id</th>



   <th>Product Name</th>
   <th>Quantity</th>
   <th>Offer Amount</th>
   <th>Price</th>
   <th>Taxable Amount</th>
  


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



   <td>{{$key->product_title}}</td>
 
   <td>{{$key->qty}}</td>
   <td>{{$key->offer_amount}}</td>
   <td>{{$key->price}}</td>
   <td>{{$key->taxable_amount}}</td>
     




   @if($role==1) <td>




     




   </td>@endif



</tr>



@php 



$i++;



@endphp



@endforeach



</tbody>



<tfoot>



<tr>
<th>id</th>



<th>Product Name</th>
<th>Quantity</th>
<th>Offer Amount</th>
<th>Price</th>
<th>Taxable Amount</th>

   @if($role==1)


   @endif

</tr>



</tfoot>



</table>

   </div>



</div>



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