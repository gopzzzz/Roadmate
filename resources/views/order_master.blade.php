@extends('layout.mainlayout')
@section('content')
<head>
  <!-- Add these lines in your HTML layout -->
 <style>
        .print-button {
            background: linear-gradient(45deg, #007bff, #007bff); /* Use a gradient background with a mix of two colors */
            color: #fff;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            float: right; /* Align the button to the right */
        }
        
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
        border: 2px solid #2dd22d; /* Border color for the rectangle (teal) */
        padding: 5px; /* Adjust padding as needed */
        border-radius: 8px; /* Adjust border-radius for rounded corners */
        background: linear-gradient(45deg, #28a745, #28a745); /* Gradient background from deep blue to light blue */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
    }

    .additional-data-arrow {
        font-size: 20px; /* Adjust the font size as needed */
        color: #fff; /* Change the color to red */
    }
</style>

</head>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    @if(session('success'))
        <h3 style="margin-left: 19px;color: green;">{{ session('success') }}</h3>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order</h3>
                            <p align="right">
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  
                                        <div class="modal-dialog" role="document" style="width:80%;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Order</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body row">
                                                  
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </p>
                        </div>
                  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            
            <tr>
                <th>id</th>
                <th>OrderId</th>
                <th>Shop Name</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Total Amount</th>
                <th>Discount</th>
                
                <th>Payment Mode</th>
                    <th>Payment Status</th>
                <th>Order Status</th>
                <th>Delivery Date</th>
                <th>Order Date</th>
                <th></th>
                @if($role==1)
                    <!-- Add your header content for role 1 if needed -->
                @endif
            </tr>
        </thead>
        <tbody>
            @php 
           
                $i = 1;
                
            @endphp
            @foreach($order as $key)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $key->order_id }}</td>
                <td>{{ $key->shopname }}</td>
               
                <td>{{ $key->phone }}</td>
                <td>Area : {{ $key->area }} ,  {{ $key->area1 }}<br>{{ $key->district }},{{ $key->state }} <br>{{ $key->country }},{{ $key->pincode }}</td>
                <td>{{ $key->total_amount }}</td>
                <td>{{ $key->discount }}</td>
                
                <td>      @if($key->payment_mode==0) Cash on Delivery @else Online @endif
                </td>
                
              
               
                <td>
                    @if($key->payment_status==0) Unpaid @else Paid @endif
                </td>         
                <td>
                    @if ($key->order_status == 0)
                       <strong class="bg-warning"> Pending </strong>
                    @elseif ($key->order_status == 1)
                    <strong class="bg-info"> Confirmed </strong>
                    @elseif ($key->order_status == 2)
                        Shipped
                    @else
                    <strong class="bg-success"> Delivered </strong>
                    @endif
                </td>
                <td>{{ $key->delivery_date }}</td>
                <td>{{ $key->order_date }}</td>
              
                <td>
                    <div class="additional-data-container" onclick="toggleTable(event,'{{ $key->id }}')">
                        <span class="additional-data-arrow" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}">↓</span>
                    </div>
                </td>
                <!-- <td style="width: 50px;">
                    <form method="get" action="{{ route('order_trans', ['orderId' => $key->id]) }}">
                        <button type="submit" class="print-button">Bill</button>
                    </form>
                </td> -->
                <td style="width: 50px;">
                    <form method="get" action="{{ route('order_invoice', ['orderId' => $key->id]) }}">
                        <button type="submit" class="print-button">Invoice</button>
                    </form>
                </td>
                <td>
    <button class="btn btn-primary editstatus" data-toggle="modal" data-target="#editstatusmodal" data-id="{{ $key->id }}"
        style="background: linear-gradient(45deg, #28a745, #28a745); color: #fff;">
        Update 
    </button>
</td>



            </tr>

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
                                                    @if($role==1)
                                                       
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody id="productDetailsBody{{ $key->id }}">
                                               
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                   
                                                    @if($role==1)
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
        </tbody>
        <tfoot>
            <tr>
                <th>id</th>
                <th>OrderId</th>
                <th>Shop Name</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Total Amount</th>
                <th>Discount</th>
             
                <th>Payment Mode</th>
              
               
             
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
</div>  
</div>
</div>
</div>
</section>
</div>

<div class="modal" id="editstatusmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Order Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="statusEditForm" method="post" action="{{ route('statusedit', ['id' => 'id'],['total_amount' => 'id']) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body row">
                    <input type="hidden" name="id" id="stat_id" value="">
                    <input type="hidden" name="total_amount" id="total_amount" value="">

                    <div class="form-group col-sm-12">
                        <label class="exampleModalLabel">Order Status</label>
                        <select name="order_status" id="order_status" class="form-control" required>
                       
                        <option value="0">Pending</option>
                            <option value="1">Confirmed</option>
                            <option value="2">Shipped</option>
                            <option value="3">Delivered</option>
                            <!-- <option value="4">Cancel</option>
                            <option value="5">Return</option> -->
                        </select>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="exampleModalLabel">Pay Status</label>
                        <select name="paystatus" id="paystatus" class="form-control" required>
                      
                            <option value="0">Not Paid</option>
                            <option value="1">Paid</option>
                            
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