@extends('layout.mainlayout')
@section('content')

<head>

<!-- <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-N2Lp0O1trMbsN01NJZSdZlPz53LW3fmBkSo2B1bFOcJOYc6sjvI4xkgUEQ8Hf/AClQQ5Np0UV5z/vlj+B6qSRg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

<style>


</style>
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
 <li class="breadcrumb-item active">View Purchase Order</li>
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



                     <h3 class="card-title">View Purchase Order</h3>



                
                  </div>



                  <!-- /.card-header -->
                  <div class="card-body">
<table id="example1" class="table table-bordered table-striped">
   <thead>
    <tr>
   <th>id</th>
   <th>Item Name </th>
   
         <th>Total Qty</th>
         <th>P Rate</th>
    
        
</tr>
   </thead>
   <tbody id="non-searchshoplist">

@php 

  $i=1;

  @endphp

 
              

            @foreach($ordersQuery as $key)
                <tr>
                <td>{{$i}}</td>
                    <td>{{ $key->product_name }}</td>
                    <td>{{ $key->qty }}</td>
                    <td>{{ $key->offer_amount }}</td>
                   
</tr>



@php 



$i++;



@endphp



@endforeach

</tbody>
  <tfoot>
  <tr>
 <th></th>
 
   <th><a href="{{url('updatepo/'.$key->vendor_id)}}"><button type="button" class="btn btn-sm btn-success">Place Order</button></th>
         <th>Quantity</th>
         <th>P Rate</th>         
      
         
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
