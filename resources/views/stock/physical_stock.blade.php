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

              <li class="breadcrumb-item active">Physical Stock Adjustment</li>

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
        <h3 class="card-title">Physical Stock Adjustment</h3>
        <p align="right">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Physical Stock</button>
        </p>
    </div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="POST" action="{{ url('physical_stockinsert') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-lg" role="document" style="width:80%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Physical Stock Adjustment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="form-group col-sm-6">
                        <label class="exampleModalLabel">Godowns</label>
                        <select name="godown" class="form-control" data-order="1" required>
                            <option value="0">Select godown</option>
                            @foreach($stock as $godown)
                            <option value="{{ $godown->id }}">{{ $godown->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <h5><b>Product Details</b></h5>
                        <table class="table" id="stockTable">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <!-- <th>Action</th> Added for delete button -->
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Row for each item -->
                                <tr>
                                    <td>1</td>
                                    <td><input type="text" name="product_name[]" class="form-control product_search" id="product_search" placeholder="Search Product" value="" required></td></td>

                                    <td><input type="number" class="form-control" name="quantity[]" required></td>
                                    <!-- <td><button type="button" class="btn btn-danger btn-sm deleteRow">Delete</button></td> -->
                                </tr>
                            </tbody>
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

              <!-- /.card-header -->

              <div class="card-body">

              <table id="example1" class="table table-bordered table-striped">

<thead>

<tr>

                    <th>Sl No</th>
                    <th>Bill Number</th>
                    <th>Godown</th>
                    <th>Added date</th>
                    
  

<th>Action</th>


</tr>

</thead>

<tbody>
@php
$i = 1;
@endphp

@foreach($physical as $key)
<tr>
<td>{{ $i }}</td>
    <td>{{ $key->bill_number }}</td>
    <td>{{ $key->name }}</td>
    <td>{{ $key->added_date }}</td>
    

<td>
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
                    <th>Godown</th>
                    <th>Added date</th>

<th>Action</th>

</tr>

</tfoot>

</table>

</div>





<div class="modal fade" id="productsModal" tabindex="-1" role="dialog" aria-labelledby="productsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Products in Godown</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <table id="productTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Product</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Product rows will be dynamically populated here -->
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
            '<td><input type="number" class="form-control quantity" name="quantity[]" required></td>' +
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
                            productList += '<div class="product_item" data-product-id="' + product.id + '">' + product.product_name + '</div>';
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

    
    $(document).on('click', '.product_item', function() {
        var productName = $(this).text(); 
        var productId = $(this).data('product-id'); 
        var inputField = $(this).closest('td').find('.product_search'); 
        inputField.val(productName);
        inputField.data('product-id', productId); 
        $(this).closest('.product_list').hide(); 
    });
});
</script>




<script>
    $(document).ready(function() {
        $('.view-products').click(function() {
            var masterId = $(this).data('id');
            $('#master_id').val(masterId);
            $('#productsModal').modal('show'); // Show modal after setting masterId
            
            // Fetch products via AJAX when modal is opened
            $.ajax({
                url: '{{ route("get-products", ":masterId") }}'.replace(':masterId', masterId),
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var tbody = $('#productTable tbody');
                    tbody.empty(); // Clear existing rows
                    
                    // Populate product data in table
                    $.each(response, function(index, product) {
                        var row = '<tr>' +
                                  '<td>' + (index + 1) + '</td>' +
                                  '<td>' + product.product_name + '</td>' +
                                  '<td>' + product.quantity + '</td>' +
                                  '</tr>';
                        tbody.append(row);
                    });
                },
                error: function(xhr) {
                    // Handle error
                }
            });
        });
    });
</script>

  @endsection