@extends('layout.mainlayout')
@section('content')
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
<div class="content-wrapper" style="background-color: #fff;">
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
                                  
                                    <div class="modal-dialog modal-lg" role="document">
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
                       
                  <!-- /.card-header -->
                  <!-- sale_order_master.blade.php -->
                  @if (session('custom_error'))
    <div style="background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 8px; border-radius: 4px; margin-bottom: 10px; color: #721c24;">
        <strong>Error!</strong> {{ session('custom_error') }}
    </div>
@endif



<style>
.alert-danger {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}
</style>

<!-- Rest of your HTML content -->

<div class="row">

    <div class="col-md-4">
    @if($role!=3)
    <input type="text" id="search" placeholder="Search by Shop Name or Order ID or Phone" class="form-control form-control-sm">
    @endif
    @if($role==3)
    <input type="text" id="search" placeholder="Search by Shop Name or Order ID " class="form-control form-control-sm">
@endif
    </div>
   
    <div class="col-md-4"></div> <!-- Empty column for spacing -->
<div class="col-md-4 text-right">
    <div class="input-group input-group-sm">
        <label class="input-group-text" for="orderStatusFilter">
            <i class="fas fa-filter"></i>
        </label>
        <select id="orderStatusFilter" class="custom-select">
            <option value="">All</option>
            <option value="0">Pending</option>
            <option value="1">Confirmed</option>
            <option value="2">Shipped</option>
            <option value="3">Delivered</option>
        </select>
        <div class="input-group-append">
            <button id="applyFilter" class="btn btn-primary btn-sm ml-2">Apply Filter</button>
        </div>
    </div>
</div>

       
   
</div>
<br>
<br>

  <table class="table table-bordered table-striped table-sm">
        <thead>
            
            <tr>
                <th>id</th>
                <th>OrderId</th>
                <th>Shop Name</th>
                @if($role!=3)
                <th>Phone Number</th>
                <th>Address</th>
                @endif
                <th>Total Amount</th>
                <!-- <th>Discount</th> -->
                
                <th>Payment Mode</th>
                    <th>Payment Status</th>
                <th>Order Status</th>
                <th>Delivery Date</th>
                <th>Order Date</th>
                @if($role!=3)
                <th>Action</th>
                @endif
                <th>Print</th>
             

                @if($role==1)
                    <!-- Add your header content for role 1 if needed -->
                @endif
            </tr>
        </thead>
        <tbody id="searchorderlist">
            @php 
           
                $i = 1;
                
            @endphp
            @foreach($order as $key)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $key->order_id }}</td>
                <td>{{ $key->shopname }}</td>
                @if($role!=3)

                <td>{{ $key->phone }}</td>
                <td>Area : {{ $key->area }} ,  {{ $key->area1 }}<br>{{ $key->district }},{{ $key->state }} <br>{{ $key->country }},{{ $key->pincode }}</td>
                @endif
                <td>{{ $key->total_amount + $key->shipping_charge }}</td>
                <!-- <td>{{ $key->discount }}</td> -->
                
                <td>      @if($key->payment_mode==0) Cash on Delivery @else Online @endif
                </td>
                
              
               
                <td>
                    @if($key->payment_status==0) <strong style="background-color:yellow;">Unpaid </strong>@else <strong style="background-color:lightgreen;">Paid</a> @endif
                </td>         
                <td>
                    @if ($key->order_status == 0)
                       <strong class="bg-warning"> Pending </strong>
                    @elseif ($key->order_status == 1)
                    <strong class="bg-info"> Confirmed </strong>
                    @elseif ($key->order_status == 2)
                    <strong class="bg-primary"> Shipped</strong>
                    @elseif ($key->order_status == 3)
                    <strong class="bg-success"> Delivered </strong>
                    @else
                    <strong class="bg-success"> Cancel </strong>
                    @endif
                </td>
                <td>{{ $key->delivery_date }}</td>
                <td>{{ $key->order_date }}</td>
              
                <!-- <td>
                    <div class="additional-data-container" onclick="toggleTable(event,'{{ $key->id }}')">
                        <span class="additional-data-arrow" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}">↓</span>
                    </div>
                </td> -->
                <!-- <td style="width: 50px;">
                    <form method="get" action="{{ route('order_trans', ['orderId' => $key->id]) }}">
                        <button type="submit" class="print-button">Bill</button>
                    </form>
                </td> -->
               
                @if($role!=3)
                <td>
    @if($key->sale_status == 0)
        @if($key->order_status == 4)
            <span class="text-danger">Order Cancelled</span>
        @else
            <form method="get" action="{{ route('sale_order_master', ['orderId' => $key->id]) }}">
                <button type="submit" class="btn btn-primary sale">
                    <i class="fas fa-file-invoice"></i>
                </button>
            </form>
        @endif
    @else
        <span class="text-success">Sale Invoice Generated</span>
    @endif
</td>

@endif
 
<td style="width: 50px;">
    <form method="get" action="{{ route('order_invoice', ['orderId' => $key->id]) }}" target="_blank">
        <button type="submit" class="print-button">
            <i class="material-icons">&#xe8ad;</i> 
        </button>
    </form>
</td>
      
                <!-- <td>
    <button class="btn btn-primary editstatus" data-toggle="modal" data-target="#editstatusmodal" data-id="{{ $key->id }}"
        style="background: linear-gradient(45deg, #28a745, #28a745); color: #fff;">
        Update 
    </button>
</td> -->



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
          
                @if($role==1)
                  
                @endif
             
        </tfoot>
    </table>
    <div class="row">
        <div class="col-12">
            <div class="float-left">
            {{ $order->appends(['status' => $statusFilter])->links() }}

            </div>
        </div>
    </div>
  
</div>
</div>
</div>
</section>
</div>

<!-- <div class="modal" id="editstatusmodal" tabindex="-1" role="dialog">
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
                             <option value="4">Cancel</option>
                            <option value="5">Return</option> -->
                        <!-- </select>
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
</div>  -->

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var searchText = $(this).val().toLowerCase();
            $('#searchorderlist tr').filter(function() {
                var shopName = $(this).find('td:nth-child(3)').text().toLowerCase();
                var orderId = $(this).find('td:nth-child(2)').text().toLowerCase();
                var phoneNumber = $(this).find('td:nth-child(4)').text().toLowerCase();
                var shopMatch = shopName.indexOf(searchText) > -1;
                var orderMatch = orderId.indexOf(searchText) > -1;
                var phoneMatch = phoneNumber.indexOf(searchText) > -1;
                $(this).toggle(shopMatch || orderMatch || phoneMatch);
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var searchText = $(this).val().toLowerCase();
            $.ajax({
                type: "GET",
                url: "{{ route('order_master') }}",
                data: {
                    search: searchText,
                    status: $('#orderStatusFilter').val()
                },
                success: function(response) {
                    $('#searchorderlist').html($(response).find('#searchorderlist').html());
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('#applyFilter').click(function() {
            var statusFilter = $('#orderStatusFilter').val();
            $.ajax({
                type: "GET",
                url: "{{ route('order_master') }}",
                data: {
                    search: $('#search').val().toLowerCase(),
                    status: statusFilter
                },
                success: function(response) {
                    $('#searchorderlist').html($(response).find('#searchorderlist').html());
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
<script>
    document.getElementById('applyFilter').addEventListener('click', function() {
        var statusFilter = document.getElementById('orderStatusFilter').value;
        var baseUrl = window.location.href.split('?')[0]; // Get the base URL without query parameters
        var newUrl = baseUrl + '?status=' + statusFilter; // Construct new URL with the filter value
        
        window.location.href = newUrl; // Redirect to the new URL
    });

    // Set selected value in dropdown based on query parameter
    var statusFilterParam = new URLSearchParams(window.location.search).get('status');
    if (statusFilterParam !== null) {
        document.getElementById('orderStatusFilter').value = statusFilterParam;
    }
</script>
@endsection