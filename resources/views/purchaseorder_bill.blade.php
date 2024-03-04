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

<div class="form-group">
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
        <tbody id="stockTableBody">
       
            <!-- Row for each item will be added here dynamically -->
        </tbody>
    </table>
    <div id="product_list"></div>

    <button type="button" class="btn btn-success btn-sm" id="addRow">+</button>

    <!-- <div class="summary totals">
    <div class="label" colspan="5"></div>

    <div class="value subtotal">
        <span class="label-text">SUBTOTAL:</span>
        <span class="amount">₹<span id="subtotalValue"></span></span>
    </div>

    <div class="value tax-rate">
        <span class="label-text">TAX RATE:</span>
        <span class="amount">₹<span id="taxableAmountValue"></span></span>
    </div>

    <div class="value total">
        <span class="label-text">TOTAL:</span>
        <span class="amount">₹<span id="sumValue"></span></span>
    </div>
</div> -->

    <br>
       
    
<div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
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

<script>
        $(document).ready(function () {
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
            $(document).on('click', '#addRow', function () {
                addRow();
            });

            // Event listener for dynamically added quantity input fields
            $('#stockTable tbody').on('input', '.qty', function () {
                var row = $(this).closest('tr');
                updateRowValues(row);
            });

      


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
                                    productList += '<div class="product_item" data-product-id="' + product.id + '" data-offer-amount="' + product.offer_price + '" data-tax="' + product.tax + '%"">' + product.product_name + '</div>';
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

            // Event listener for dynamically added product_item
            $(document).on('click', '.product_item', function () {
                var productName = $(this).text();
                var productId = $(this).data('product-id');
                var inputField = $(this).closest('td').find('.search_products');
                var offerAmount = $(this).data('offer-amount');
                var tax = $(this).data('tax');

                // Update the input fields
                inputField.val(productName);
                inputField.data('product-id', productId);
                inputField.data('offer-amount', offerAmount);
                inputField.data('tax', tax);

                // Update the quantity input field
                var qtyField = inputField.closest('tr').find('.qty');
                qtyField.val(1); // Assuming you want to set the default quantity to 1, adjust as needed

                // Update the tax input field
                var taxField = inputField.closest('tr').find('.tax');
                taxField.val(tax);

                // Update the unit price input field
                var unitPriceField = inputField.closest('tr').find('.unitprice');
                unitPriceField.val(offerAmount);

                // Calculate total and taxable amount
                updateRowValues(inputField.closest('tr'));
                $(this).closest('.product_list').hide();
            });
            function updateProductQuantity(row) {
        var productId = row.find('.search_products').data('product-id');
        var qty = parseFloat(row.find('.qty').val()) || 0;

        // Check if the product exists in Tbl_placeorders
        var existingProduct = Tbl_placeorders.find(productId);

        if (existingProduct) {
            // Update the quantity
            existingProduct.qty = qty;
            existingProduct.save();
        }
    }
            // Function to update row values based on quantity change
            function updateRowValues(row) {
                var qty = parseFloat(row.find('.qty').val()) || 0;
                var unitPrice = parseFloat(row.find('.unitprice').val()) || 0;
                var tax = parseFloat(row.find('.tax').val()) || 0;

                // Update the total field
                var total = (unitPrice * qty).toFixed(2);
                row.find('.total').val(total);

                // Update the taxable amount field
                var taxableAmount = ((unitPrice / (1 + tax / 100)).toFixed(2) * (tax / 100).toFixed(2) * qty).toFixed(2);
                row.find('.taxableamount').val(taxableAmount);
            }

            // Event listener for dynamically added rows
            $(document).on('input', '.qty', function () {
                updateRowValues($(this).closest('tr')); // Update totals when changing quantity
            });

            $(document).on('click', '.add-row', function () {
                updateRowValues($(this).closest('tr')); // Update totals when adding a new row
            });
        });

    </script>
<script>
$(document).on('click', '.deleteRow', function () {
    var productId = $(this).closest('tr').find('.search_products').data('product-id');
    var billNumber = $('#bill_number_input').val(); // Assuming you have an input field for bill number
    
    // Confirm deletion with user, optionally
    if (confirm('Are you sure you want to delete this product?')) {
        deleteProduct(productId, billNumber);
        $(this).closest('tr').remove();
    }
});

function deleteProduct(productId, billNumber) {
    $.ajax({
        type: "POST",
        url: "{{ route('delete_product') }}",
        data: {
            "_token": "{{ csrf_token() }}",
            "product_id": productId,
            "bill_number": billNumber
        },
        success: function (response) {
            console.log(response);
            // Handle success, such as showing a success message
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            // Handle error, such as showing an error message
        }
    });
}
</script>


@endsection