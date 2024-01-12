@extends('layout.mainlayout')
@section('content')

<head>

<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Define your CSS styles for the invoice here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .invoice {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .invoice-header {
            background-color: #e4cf23;
            color: #e90f0e;
            padding: 10px;
            text-align: center;
        }
        .invoice-title {
            font-size: 40px;
            text-transform: uppercase;
        }
        .invoice-details {
            margin: 20px;
        }
        .invoice-details table {
            width: 50%;
            border-collapse: collapse;
        }
        .invoice-details th, .invoice-details td {
            padding: 10px;
            text-align: left;
        }
        .invoice-details th {
            background-color: #f2f2f2;
        }
        .invoice-table {
            margin: 20px;
        }
        .invoice-table table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-table th, .invoice-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .invoice-total {
            text-align: right;
            margin: 20px;
        }
        .invoice-total p {
            font-size: 18px;
            font-weight: bold;
        }
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
 <li class="breadcrumb-item active">Product Orders</li>
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



                     <h3 class="card-title">Product Order</h3>



                     <p align="right">

                  </div>



                  <!-- /.card-header -->
                  <div class="card-body">
<table id="example1" class="table table-bordered table-striped">
   <thead>
    <tr>
   <th>id</th>
   <th>Product Name</th>
         <th>Qunatity</th>
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
                    <td>{{ $groupedOrder->sum('price') }}</td>
                    <td>
                    <button class="btn btn-primary" onclick="changeOrderStatus({{ $groupedOrder[0]->product_id }})">
                        Place Order
                    </button>
                </td>
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
         <th>Qunatity</th>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    function changeOrderStatus(productId, qty, price) {
        var confirmation = confirm("Are you sure you want to change the order status?");
        if (confirmation) {
            $.ajax({
                type: "POST",
                url: "{{ route('updateOrderStatus') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    productId: productId,
                    qty: qty,
                    price: price
                },
                success: function(response) {
                    if (response.success) {
                        alert("Order status changed successfully!");
                        location.reload(); // Reload the page after the order status is changed
                    } else {
                        console.error("Error updating order status:", response.message);
                    }
                },
                error: function(error) {
                    console.error("Error updating order status:", error);
                }
            });
        }
    }
</script>


@endsection
