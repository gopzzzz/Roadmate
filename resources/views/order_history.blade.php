@extends('layout.mainlayout')
@section('content')

<head>

</head>

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
 <li class="breadcrumb-item active">Orders History</li>
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



                     <h3 class="card-title">Orders History</h3>



                     <p align="right">

                  </div>



                  <!-- /.card-header -->
                  <div class="card-body">
<table id="example1" class="table table-bordered table-striped">
   <thead>
    <tr>
   <th>id</th>
   <th>Product Name</th>
         <th>Quantity</th>
         <th>Total Price</th>
    
         <th></th>
   @if($role==1)
  @endif
</tr>
   </thead>
   <tbody id="non-searchshoplist">

   @php 

$i=1;


              $groupedOrders = $orders->groupBy('product_name');
          @endphp

          @foreach($groupedOrders as $product_name => $groupedOrder)
              <tr>
              <td>{{$i}}</td>
                  <td>{{ $product_name }}</td>
                  <td>{{ $groupedOrder->sum('qty') }}</td>
                  <td>{{ $groupedOrder->sum('amount') }}</td>
                  <!-- -->
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
         <th>Total Price</th>         
         
         <th></th>
 @if($role==1)
 @endif
 </tr>
</tfoot>
</table>
<!-- /.card-body -->
 </div>  <!-- /.card -->
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
