@extends('layout.mainlayout')
@section('content')
<head>
  <!-- Add these lines in your HTML layout -->
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
    <style>
  .additional-data-container {
        display: inline-block;
        margin-left: 5px;
        border: 2px solid #008080; /* Border color for the rectangle (teal) */
        padding: 5px; /* Adjust padding as needed */
        border-radius: 8px; /* Adjust border-radius for rounded corners */
        background-color: #008080; /* Background color for the rectangle (teal) */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
    }

    .additional-data-arrow {
        font-size: 20px; /* Adjust the font size as needed */
        color: #ffffff; /* Change the color to white or another contrasting color */
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
   <th>OrderId</th>

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
     <td>{{$i++}}</td>
     <td>{{$key->order_id}}</td>

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
    @if ($key->order_status == 0)
        Pending
    @elseif ($key->order_status == 1)
        Confirmed
    @elseif ($key->order_status == 2)
       Shipped
        @elseif ($key->order_status == 3)
       Delivered
        @elseif ($key->order_status == 4)
        Return
        @elseif ($key->order_status == 5)
       Cash Received
        
    @else
    @endif
</td>         <td>{{$key->delivery_date}}</td>
         <td>{{$key->order_date}}</td>
         <td>
    <div class="additional-data-container" onclick="toggleTable(event,'{{ $key->id }}')">
        <span class="additional-data-arrow" aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}">↓</span>
        
    </div>
</td>    
<td style="width: 50px;">
  <form method="get" action="{{ route('order_trans', ['orderId' => $key->id]) }}">
    <button type="submit" class="btn btn-success btn-sm">Bill</button>
  </form>
</td>
<td>
    <button class="btn btn-primary editstatus" data-toggle="modal" data-target="#editstatusmodal" data-id="{{ $key->id }}">
        Update Status
    </button>
</td>


<div class="modal" id="editstatusmodal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Update Order Status</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <form id="statusEditForm" method="post" action="{{ route('statusedit', ['id' => '__id__'],['total_amount' => '__id__']) }}" enctype="multipart/form-data">
                @csrf
                                 <div class="modal-body row">
                                 <input type="hidden" name="id" id="stat_id" value="">
                                 <input type="hidden" name="total_amount" id="total_amount" value="">
                         


                                 <div class="form-group col-sm-12">
        <label class="exampleModalLabel">Order Status</label>
        <select name="order_status" id="order_status" class="form-control"required>
        <option value="0">Pending</option>
            <option value="1">Confirmed</option>
            <option value="2">Shipped</option>
            <option value="3">Delivered</option>
            <option value="4">Return</option>
            <option value="5">Cash Received</option>
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
                  </div>
                  <tr id="orderDetailsRow{{ $key->id }}" style="display: none;">
    <td colspan="16">
      <div class="order-details-container">
        <div id="tableContainer{{ $key->id }}" style="display: none;">
          <input type="hidden" name="order_id" value="{{ $key->id }}">
          <div class="invoice-details">
            <div class="card-body">
              <div class="invoice-table">
                <div class="invoice-header">
                  <div class="invoice-title"></div>
                </div>
                <table id="example1{{ $key->id }}" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <!-- Add your header content here -->
                      @if($role==1)
                        <!-- Add header content for role 1 if needed -->
                      @endif
                    </tr>
                  </thead>
                  <tbody id="productDetailsBody{{ $key->id }}">
                    <!-- Product details will be appended here -->
                  </tbody>
                  <tfoot>
                    <tr>
                      <!-- Add your footer content here -->
                      @if($role==1)
                        <!-- Add footer content for role 1 if needed -->
                      @endif
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </td>
  </tr>               
@endforeach
  @if($role==1) 
  @endif
 </tr>
  @php 
   $i++;
  @endphp

</tbody>
  <tfoot>
  <tr>
 <th>id</th>
 <th>OrderId</th>

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
<div class="row">
    <div class="col-12">
        <div class="float-left">
            {{ $order->links() }}
        </div>
    </div>
</div>
				<!-- Add pagination links below the table -->
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
<!-- ... Your existing HTML code ... -->
<!-- ... Your existing HTML code ... -->
<script>
    function toggleTable(event, orderId) {
        event.stopPropagation();

        // Toggle display of the order details row
        $('#orderDetailsRow' + orderId).toggle();

        if (orderId) {
            $.ajax({
                type: "POST",
                url: "{{ route('order_masterfetch') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: orderId
                },
                success: function (res) {
                    console.log(res);
                    var orderDetails = JSON.parse(res);

                    // Update HTML content
                    $('#shopName').text(orderDetails[0].shopname);

                    // Clear existing product details
                    $('#productDetailsBody' + orderId).empty();

                    // Append details for each product
                    $('#productDetailsBody' + orderId).append(`
                        <tr>
                            <th>Brand Name</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <!-- Add more headings as needed -->
                        </tr>
                    `);
                    orderDetails.forEach(function (product) {
                        $('#productDetailsBody' + orderId).append(`
                            <tr>
                                <td>${product.brand_name}</td>
                                <td>${product.product_name}</td>
                                <td>${product.qty}</td>
                                <td>${product.offer_amount}</td>
                                <!-- Add more columns as needed -->
                            </tr>
                        `);
                    });

                    // Toggle display of the order details container
                    $('#tableContainer' + orderId).toggle();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    }
</script>


@endsection
