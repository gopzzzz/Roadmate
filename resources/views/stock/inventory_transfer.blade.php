@extends('layout.mainlayout')

@section('content')

<head>

<!-- Include SweetAlert CSS and JS files -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- Include SweetAlert CSS and JS files -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>

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

              <li class="breadcrumb-item"><a href="home">Home</a></li>

              <li class="breadcrumb-item active">Inventory Transfer</li>

            </ol>

          </div>

        </div>

      </div><!-- /.container-fluid -->

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
        <h3 class="card-title">Inventory Transfer</h3>
        <p align="right">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Inventory Transfer</button>
        </p>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="POST" action="{{ url('inventory_transferinsert') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-xl" role="document" style="width:80%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Inventory Transfer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6">
                       
                        <div class="row align-items-center mb-3"> 
                            <div class="col-md-4">
                                <label> From</label>
                            </div>
                            <div class="col-md-8">
                                <select name="inventory_from" class="form-control" required>
                                    <option value="">Select Godown</option>
                                    @foreach($stock as $godown)
                                    <option value="{{ $godown->id }}">{{ $godown->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <label>To</label>
                            </div>
                            <div class="col-md-8">
                                <select name="inventory_to" class="form-control" required>
                                    <option value="">Select Godown</option>
                                    @foreach($stock as $godown)
                                    <option value="{{ $godown->id }}">{{ $godown->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        
                        <div class="row align-items-center mb-3"> 
                            <div class="col-md-4">
                                <label>Transfer Number</label>
                            </div>
                            <div class="col-md-8">
                            <input type="hidden" id="current_transfer_number" value="{{ $latestTransferNumber ?? 0 }}">

                                <input type="text" class="form-control" id="transfer_number" name="transfer_number" readonly>
                            </div>
                        </div>
                        <div class="row align-items-center"> 
                        <div class="col-md-4">
                            <label>Date</label>
                        </div>
                        <div class="col-md-8">
                            <input type="date" class="form-control" name="transfer_date" required min="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>

                    </div>

                    <div class="form-group col-md-12">
                        <h5><b>Product Details</b></h5>
                        <table class="table" id="stockTable">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Item Name</th>
                                    <th>Stock</th>
                                    <th>Quantity</th>
                                    <th>Unit price</th>
                                    <th>Total</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
    <td>1</td>
    <td><input type="text" name="product_name[]" class="form-control product_search" id="product_search" placeholder="Search Product" value="" required></td>
    <td><input type="text" class="form-control stock" name="stock[]" required></td>
    
    <td><input type="text" class="form-control quantity" name="quantity[]" required></td>
    <td><input type="text" class="form-control unitprice" name="unitprice[]" required readonly></td>
    <td><input type="text" class="form-control total" name="total[]" required readonly></td>
</tr>

        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Total</th>
                <th id="totalStock"><input type="text" class="form-control" name="total_stock" required></th> 
                <th id="totalQuantity"><input type="text" class="form-control" name="total_quantity" required readonly></th>
                <th></th> 
                <th id="totalAmount"><input type="text" class="form-control" name="total_amount" required readonly></th>
            </tr>
        </tfoot>
                        
                        </table>
                        <div id="product_list"></div>
                        <button type="button" class="btn btn-success btn-sm" id="addRow">+</button>
                       
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


              

              <div class="card-body">

              <table id="example1" class="table table-bordered table-striped">

<thead>

<tr>

                    <th>Sl No</th>
                    <th>Bill Number</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Total Amount</th>
                    <th>Total Quantity</th>
                    <th>Added date</th>
                    
  

<th>Action</th>


</tr>

</thead>
<tbody>
@php
$i = 1;
@endphp

@foreach($inventory as $key)
<tr>
<td>{{ $i }}</td>
    <td>{{ $key->bill_number }}</td>
    <td>{{ $key->from_godown_name }}</td>
    <td>{{ $key->to_godown_name }}</td>
    <td>{{ $key->total_amount }}</td>
    <td>{{ $key->total_quantity }}</td>
    <td>{{ $key->added_date }}</td>
    

    <td>

<i class="fa fa-edit edit_inventory"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>

</td><td>
<button type="button" class="btn btn-primary view-products" data-toggle="modal" data-target="#productsModal" data-id="{{ $key->id }}">View Products</button>


</td>



</tr>
@php
$i++;
@endphp
@endforeach

</tbody>


<tfoot>

<tr>

                    <th>Sl No</th>
                    <th>Bill Number</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Total Amount</th>
                    <th>Total Quantity</th>
                    <th>Added date</th>

<th>Action</th>

</tr>

</tfoot>

</table>

</div>



<div class="modal" id="editinventory_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Inventory Transfer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('inventoryTransferEdit') }}" enctype="multipart/form-data" name="exeedit">
                @csrf
                <div class="modal-body row">
                    <input type="hidden" id="transfer_id" name="id"> 
                    <div class="row" id="productRowsContainer"></div>

                    <div class="col-md-6">
                        <div class="row align-items-center mb-3">
                            <div class="col-md-4">
                                <label for="inventory_from">From</label> 
                            </div>
                            <div class="col-md-8">
                                <select name="inventory_from" id="inventory_from" class="form-control" required>
                                    <option value="">Select Godown</option>
                                    @foreach($stock as $godown)
                                    <option value="{{ $godown->id }}">{{ $godown->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <label for="inventory_to">To</label>
                            </div>
                            <div class="col-md-8">
                                <select name="inventory_to" id="inventory_to" class="form-control" required>
                                    <option value="">Select Godown</option>
                                    @foreach($stock as $godown)
                                    <option value="{{ $godown->id }}">{{ $godown->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row align-items-center mb-3">
                            <div class="col-md-4">
                                <label for="transfer_number">Transfer Number</label>
                            </div>
                            <div class="col-md-8">
                                <input type="hidden" id="current_transfer_number" value="{{ $latestTransferNumber ?? 0 }}">
                                <input type="text" class="form-control" id="transfer_number1" name="transfer_number" readonly>
                            </div>
                        </div>
                        
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <label for="transfer_date">Date</label>
                            </div>
                            <div class="col-md-8">
                                <input type="date" class="form-control" id="transfer_date" name="transfer_date" required min="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
    <h5><b>Product Details</b></h5>
    <table class="table" id="stockTable">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Item Name</th>
                <!-- <th>Stock</th> -->
                <th>Quantity</th>
                <th>Unit price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>      
            <tr>
                <th colspan="2">Total</th>
                <th><input type="text" class="form-control total-quantity" name="total_quantity" required readonly></th>
                <th></th>
                <th><input type="text" class="form-control total-amount" name="total_amount" required readonly></th>
                <th></th>
            </tr>
        </tfoot>
    
                        </table>
                        <button type="button" class="btn btn-success btn-sm" id="addRow1">+</button>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
         

 
<div class="modal fade" id="productsModal" tabindex="-1" role="dialog" aria-labelledby="productsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inventory Transfer products</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <table id="productTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>Sl No</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
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





  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    
    function addRow() {
        var rowNum = $('#stockTable tbody tr').length + 1;
        var row = '<tr>' +
            '<td>' + rowNum + '</td>' +
            '<td>' +
            '<input type="text" class="form-control product_search" name="product_name[]" placeholder="Search Product">' +
            '<div class="product_list"></div>' +
            '</td>' +
            '<td><input type="text" class="form-control stock" name="stock[]" required></td>' +
            '<td><input type="text" class="form-control quantity" name="quantity[]" required></td>' +
            '<td><input type="text" class="form-control unitprice" name="unitprice[]" required readonly></td>' +
            '<td><input type="text" class="form-control total" name="total[]" required readonly></td>' +
             '<td><button type="button" class="btn btn-danger btn-sm deleteRow">-</button></td>' +
            '</tr>'; 
        $('#stockTable tbody').append(row);
     
    }

    $('#addRow').click(function() {
        addRow();
    });

   
    $(document).on('click', '.deleteRow', function() {
        $(this).closest('tr').remove();
 
        $('#stockTable tbody tr').each(function(index) {
            $(this).find('td:first').text(index + 1);
        });
    });

    $(document).on('click', '.product_item', function() {
        var productName = $(this).text(); 
        var offerPrice = $(this).data('offer-price'); 
        console.log("Product Name:", productName); 
        console.log("Offer Price:", offerPrice); 

        var row = $(this).closest('tr');
        row.find('.product_search').val(productName); 
        row.find('.unitprice').val(offerPrice); 

        $(this).closest('.product_list').hide();

        showProductList = false;
    });

    $(document).on('keyup', '.product_search', function() {
        var alphabet = $(this).val().trim().charAt(0).toUpperCase(); 
        var productListContainer = $(this).siblings('.product_list'); 

        if (alphabet != '') {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('product_search') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    alphabet: alphabet
                },
                success: function(response) {
                    var productList = '';
                    if (response.length > 0) {
                        $.each(response, function(index, product) {
                            productList += '<div class="product_item" data-offer-price="' + product.offer_price + '">' + product.product_name + '</div>';
                        });
                    } else {
                        productList = '<div class="product_item">No products found</div>'; 
                    }
                    productListContainer.html(productList).show();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); 
                }
            });
        } else {
            productListContainer.html('').hide(); 
        }
    });
    
});
</script>


<script> 
    function generateTransferNumber() {
        var currentTransferNumber = parseInt(document.getElementById("current_transfer_number").value);
        var transferNumberField = document.getElementById("transfer_number");
        
        var nextTransferNumber = currentTransferNumber + 1; 
        transferNumberField.value = nextTransferNumber; 
        
        document.getElementById("current_transfer_number").value = nextTransferNumber;
    }
   
    generateTransferNumber();
</script>





<script>
    $(document).ready(function() {
       
        function calculateRowTotal(row) {
            var quantity = $(row).find('.quantity').val();
            var unitprice = $(row).find('.unitprice').val();
            var total = quantity * unitprice;
            $(row).find('.total').val(total);   
        }
       
        function calculateTotal() {
            var totalQuantity = 0;
            var totalAmount = 0;
            $('#stockTable tbody tr').each(function() {
                var quantity = parseFloat($(this).find('.quantity').val());
                totalQuantity += isNaN(quantity) ? 0 : quantity;
                var total = parseFloat($(this).find('.total').val());
                totalAmount += isNaN(total) ? 0 : total;
            });
            $('#totalQuantity input').val(totalQuantity);
            $('#totalAmount input').val(totalAmount);
        }
       
        $('#stockTable tbody').on('keyup', '.quantity, .unitprice', function() {
            var row = $(this).closest('tr');
            calculateRowTotal(row);
            calculateTotal();
        });
       
        $('#stockTable tbody').on('click', '.deleteRow', function() {
            $(this).closest('tr').remove();
            calculateTotal();
            recalculateRowNumbers();
        });

        function recalculateRowNumbers() {
            $('#stockTable tbody tr').each(function(index) {
                $(this).find('td:first').text(index + 1);
            });
        }
       
        $('#stockTable tbody tr').each(function() {
            calculateRowTotal(this);
        });
        calculateTotal();
    });
</script>




<script>
    $(document).ready(function() {
        $('.view-products').click(function() {
            var masterId = $(this).data('id');
            $('#master_id').val(masterId);
            $('#productsModal').modal('show'); 
            
            
            $.ajax({
                url: '{{ route("get-products", ":masterId") }}'.replace(':masterId', masterId),
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var tbody = $('#productTable tbody');
                    tbody.empty(); 


                    $.each(response, function(index, product) {
                        var row = '<tr>' +
                                  '<td>' + (index + 1) + '</td>' +
                                  '<td>' + product.product_name + '</td>' +
                                  '<td>' + product.quantity + '</td>' +
                                  '<td>' + product.unitprice + '</td>' +
                                  '<td>' + product.total_amount + '</td>' +
                                  '</tr>';
                        tbody.append(row);
                    });
                },
                error: function(xhr) {
                   
                }
            });
        });
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
            '<input type="text" class="form-control product_search" name="product_name[]" placeholder="Search Product">' +
            '<div class="product_list"></div>' +
            '</td>' +
            '<td><input type="text" class="form-control quantity" name="quantity[]" required></td>' +
            '<td><input type="text" class="form-control unitprice" name="unitprice[]" required readonly></td>' +
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
</script>

  @endsection