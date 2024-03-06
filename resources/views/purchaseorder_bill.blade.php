@extends('layout.mainlayout')
@section('content')

<head>

<!-- <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-N2Lp0O1trMbsN01NJZSdZlPz53LW3fmBkSo2B1bFOcJOYc6sjvI4xkgUEQ8Hf/AClQQ5Np0UV5z/vlj+B6qSRg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

<style>

.summary-row.totals {
    display: flex;
    justify-content: flex-end;
}

.value {
    margin-left: 20px; /* Adjust as needed */
    text-align: right;
}

.label-text {
    margin-right: 10px; /* Adjust as needed */
    font-weight: bold;
}

.amount {
    font-weight: bold;
    font-size: 18px; /* Adjust the font size as needed */
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
 <li class="breadcrumb-item active">Purchase Order</li>
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
 <h3 class="card-title">Purchase Order</h3>
 </div>
 <!-- /.card-header -->
                  <div class="card-body">
<table id="example1" class="table table-bordered table-striped">
   <thead>
    <tr>
   <th>id</th>
   <th>Vendor Name </th>
         <th>PO Number</th>
         <th>Requested BY</th>
         <th></th>

         <th></th>
  
</tr>
   </thead>
   <tbody id="non-searchshoplist">
@php 
  $i=1;
  @endphp
   @foreach($ordersQuery as $key)
                <tr>
                <td>{{$i}}</td>
                    <td>{{ $key->vendor_name }}</td>
                    <td>{{ $key->bill_num }}</td>
                    <td>{{ $key->name }}</td>
               <td>     <i class="fa fa-edit edit_purchaseorder"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i></td>



              <td>      <a href="{{url('bill/'.$key->id)}}" target="_blank"><button type="button" class="btn btn-success btn-sm" >PO print</button></a>
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
 <th>Vendor Name </th>
         <th>PO Number</th>
         <th>Requested BY</th>
      <th></th>
 <th></th>
 @if($role==1)
 @endif
 </tr>
</tfoot>
</table><div class="modal" id="editpurcaseorder_modal" tabindex="-1" role="dialog">
<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Purchase Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form method="POST" action="{{ route('purchaseorderedit') }}" enctype="multipart/form-data" name="exeedit">
@csrf
<div class="modal-body row">
 <div class="form-group col-sm-6">
    <input type="hidden" name="id" id="purchaseid">
    <div class="row" id="productRowsContainer"></div>

    <label class="exampleModalLabel">VENDOR</label>

    <select name="venname" id="venname" class="form-control" required disabled>
                    <option value="" disabled selected>Select vendor name</option>
                    @foreach($vendor as $key)
                        <option value="{{ $key->id }}">{{ $key->vendor_name }}</option>
                    @endforeach
                </select>
</div>
<div class="form-group col-sm-6">
 <label class="exampleModalLabel">REQUISITIONER</label>
  <select name="requestby" id="requestby" class="form-control" required disabled>
                    <option value="" disabled selected>Select requisitioner</option>
                    @foreach($user as $key)
                        <option value="{{ $key->id }}">{{ $key->name }}</option>
                    @endforeach
                </select>
</div>  
<div class="form-group col-md-12">
    <h5><b>Product Details</b></h5>
    <table class="table" id="stockTable">
        <thead>
            <tr>
            <th>ITEM #</th>
                <th>DESCRIPTION</th>
                <th>QTY</th>
                <th>UNIT PRICE</th>
                <th>TAX %</th>
                <th>TAX AMOUNT</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody></tbody>
        <!-- <tfoot>      
            <tr>
                <th><input type="text" class="form-control total-quantity" name="total_quantity" required readonly></th>
                <th></th>
                <th><input type="text" class="form-control total-amount" name="total_amount" required readonly></th>
                <th></th>
            </tr>
        </tfoot> -->
    
                        </table>
                        <button type="button" class="btn btn-success btn-sm" id="addRow1">+</button>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
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

<script>
    // Event listener for dynamically added search_products input fields
    $('#stockTable tbody').on('keyup', '.search_products', function () {
        var alphabet = $(this).val().trim().charAt(0).toUpperCase();
        var productListContainer = $(this).siblings('.product_list');
        var vendorId = $('#venname').val(); // Assuming you have an element with id 'venname'

        if (alphabet != '') {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('search_products') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    alphabet: alphabet,
                    vendor_id: vendorId
                },
                success: function (response) {
                    var productList = '';
                    if (response.length > 0) {
                        $.each(response, function (index, product) {
                            productList += '<div class="product_item" data-offer-price="' + product.offer_price + '" data-tax="' + product.tax + '%">' + product.product_name + '</div>';
                        });
                    } else {
                        productList = '<div class="product_item">No products found</div>';
                    }
                    productListContainer.html(productList).show();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        } else {
            productListContainer.html('').hide();
        }
    });

    // Event listener for product item click
    $('#stockTable tbody').on('click', '.product_item', function () {
        var productName = $(this).text();
        var offerPrice = parseFloat($(this).data('offer-price'));
        var tax = parseFloat($(this).data('tax'));

        console.log("Offer Amount:", offerPrice);
        console.log("Tax:", tax);

        var row = $(this).closest('tr');

        // Populate fields
        row.find('.search_products').val(productName);
        row.find('.tax').val(tax + '%');

        if (!isNaN(offerPrice) && !isNaN(tax)) {
            var unitPrice = (offerPrice / (1 + tax / 100)).toFixed(2);
            console.log("Calculated Unit Price:", unitPrice);

            // Update unit price field
            row.find('.unitprice').val(unitPrice);

            // Calculate total and taxable amount
            var quantity = parseFloat(row.find('.quantity').val()) || 0;
            var total = (unitPrice * quantity).toFixed(2);
            var taxamount = (unitPrice * (tax / 100)).toFixed(2);
            var taxableamount = (parseFloat(taxamount).toFixed(2) * quantity).toFixed(2);

            // Update corresponding fields
            row.find('.taxableamount').val(taxableamount);
            row.find('.total').val(total);
        } else {
            console.error("Invalid offerPrice or tax values:", offerPrice, tax);
        }

        // Hide the product list
        $(this).closest('.product_list').hide();
    });
</script>


<script>
	$(document).ready(function() {
    // Function to add a new row
    function addRow() {
        var rowNum = $('#stockTable tbody tr').length + 1;
        var row = '<tr>' +
            '<td>' + rowNum + '</td>' +
            '<td>' +
            '<input type="text" class="form-control search_products" name="product_name[]" placeholder="Search Product">' +
            '<div class="product_list"></div>' +
            '</td>' +
            '<td><input type="text" class="form-control qty" name="qty[]" required></td>' +
                    '<td><input type="text" class="form-control unitprice" name="unitprice[]" required readonly></td>' +
                    '<td><input type="text" class="form-control tax" name="tax[]" required readonly></td>' +
                    '<td><input type="text" class="form-control taxableamount" name="taxableamount[]" required readonly></td>' +
                    '<td><input type="text" class="form-control total" name="total[]" required readonly></td>' +
            '<td><button type="button" class="btn btn-danger btn-sm deleteRow">-</button></td>' +
            '</tr>';
        $('#stockTable tbody').append(row);

    }

    // Add row when the plus button is clicked
    $('#addRow1').click(function() {
        addRow();
    });
});

$(document).on('click', '.deleteRow', function() {
        $(this).closest('tr').remove();
 
        $('#stockTable tbody tr').each(function(index) {
            $(this).find('td:first').text(index + 1);
        });
    });
  
</script>
@endsection
