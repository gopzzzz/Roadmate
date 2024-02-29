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
                  <li class="breadcrumb-item active">Revenue</li>
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
                     <h3 class="card-title">Revenue</h3>
                     <p align="right">
                       <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Shop Packages</button>-->
                    
                  <!-- /.card-header -->
                  <div class="card-body">
                     <table  class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th>Id</th>
							  <th>Order Id</th>
                              <th>Shop Name</th>
							  <th>Product Name</th>
                              <th>Qty</th>
                              <th>Tax</th>
                              <!-- <th>Unit Price</th> -->
                              <!-- <th>Tax Amt</th> -->
                              <th>Selling Rate (R1)</th>
                              <th>P.Rate (R2)</th>
                              <th>Turn Over</th>
                              <th>Revenue<br>(QTY*(R1-R2))</th>
                             
                           </tr>
                        </thead>
                        <tbody>
                           @php 
                           $i=1;
                           @endphp
                           @foreach($order_trans as $key)
                           <tr>
                              <td>{{$i}}</td>
							  <td>{{$key->invoice_number}}</td>
							  <td>{{$key->shopname}}</td>
                              <td>{{$key->product_name}}</td>
                              <td>{{$key->qty}}</td>
                              <td>{{$key->tax}} %</td>
                              <!-- <td>{{number_format((($key->offer_amount)/(1+$key->tax/100)),2)}}</td> -->
                              <!-- <td>{{number_format((($key->offer_amount)-($key->offer_amount)/(1+$key->tax/100)),2)}}</td> -->
                              <td>{{$key->offer_amount}}</td>
                              <td>{{$key->prate}}</td>
                              <td>{{$key->offer_amount}}</td>
                              <td>{{number_format(($key->qty)*((($key->offer_amount))-($key->prate)),2)}}</td>
                           
                           </tr>
                           @php 
                           $i++;
                           @endphp
                           @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                        <th>Id</th>
							  <th>Order Id</th>
                              <th>Shop Name</th>
							  <th>Product Name</th>
                              <th>Qty</th>
                              <th>Tax</th>
                              <!-- <th>Unit Price</th> -->
                              <!-- <th>Tax Amt</th> -->
                              <th>Selling Rate (R1)</th>
                              <th>P.Rate (R2)</th>
                              <th>Turn Over</th>
                              <th>Revenue<br>(QTY*(R1-R2))</th>
                             
                           </tr>
                        </tfoot>
                     </table>

                     <div class="row">
        <div class="col-12">
            <div class="float-left">
                {{ $order_trans->links() }}
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