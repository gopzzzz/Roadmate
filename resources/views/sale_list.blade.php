
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
                    <h1>Sale List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Sale List</li>
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
                            <h3 class="card-title">Sale List</h3>
                            <p align="right">
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  
                                    <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Sale List</h5>
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
                
                 <br>
                  <div class="row">
    <div class="col-md-4">
    <input type="text" id="search" placeholder="Search by Shop Name or Order ID or Phone" class="form-control form-control-sm">
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


  <table class="table table-bordered table-striped table-sm">
        <thead>
      

            <tr>
                <th>id</th>
                <th>OrderId</th>
                <th>Shop Name</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Total Amount</th>
                
                <th>Payment Mode</th>
                    <th>Payment Status</th>
                <th>Order Status</th>
                <th>Delivery Date</th>
                <th>Order Date</th>
               

                @if($role==1)
                    <!-- Add your header content for role 1 if needed -->
                @endif
            </tr>
        </thead>
        <tbody id="salelist">
        @php 
           
           $i = 1;
            
       @endphp
       @foreach($sale as $key)
       <tr>
           <td>{{ $i++ }}</td>
           <td>{{ $key->invoice_number }}</td>
           <td>{{ $key->shopname }}</td>
          
           <td>{{ $key->phone }}</td>
           <td>Area : {{ $key->area }} ,  {{ $key->area1 }}<br>{{ $key->district }},{{ $key->state }} <br>{{ $key->country }},{{ $key->pincode }}</td>
           <td>{{ $key->total_amount }}</td>
           
           <td>      @if($key->payment_mode==0) Cash on Delivery @else Online @endif
           </td>
          
         
          
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
                          Cancelled
                   
                    @else
                    @endif
                </td>
           <td>{{ $key->delivery_date }}</td>
           <td>{{ $key->order_date }}</td>
           
          <td style="width: 50px;">
    <form method="get" action="{{ route('sale_bill', ['orderId' => $key->id]) }}" target="_blank">
        <button type="submit" class="print-button">
            <i class="material-icons">&#xe8ad;</i>
        
                </button>     
            </form>
        </td>
        <td>
        @if($role!=3)
        <button class="btn btn-primary editstatus" data-toggle="modal" data-target="#editstatusmodal" data-id="{{ $key->order_id }}"
                style="background: linear-gradient(45deg, #28a745, #28a745); color: #fff;">
                Update 
            </button>     
                  @endif
        
        </td>

            </tr>

          
            @endforeach

       
        </tbody>
        <tfoot>
    <tr>
        <td colspan="12">
            {{$sale->links()}}
        </td>
    </tr>
</tfoot>
    </table>

    
   
   
   
    

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


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var searchText = $(this).val().toLowerCase();
            $('#salelist tr').filter(function() {
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
        $('#applyFilter').click(function() {
            var statusFilter = $('#orderStatusFilter').val();
            $.ajax({
                type: "GET",
                url: "{{ route('sale_list') }}",
                data: { status: statusFilter },
                success: function(response) {
                    $('#salelist').html($(response).find('#salelist').html());
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>


@endsection