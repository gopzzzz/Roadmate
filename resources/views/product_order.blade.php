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
                     <div class="float-right">
    <div class="input-group">
        <div class="input-group-prepend">
            <label class="input-group-text" for="brandFilter">
                <i class="fas fa-filter"></i>
            </label>
        </div>
        <select id="brandFilter" class="custom-select">
    <option value="" @if(empty($selectedBrand)) selected @endif>All Brands</option>
    @foreach($brands as $brand)
        <option value="{{ $brand->id }}" @if($brand->id == $selectedBrand) selected @endif>{{ $brand->brand_name }}</option>
    @endforeach
</select>
  <div class="input-group-append">
            <button class="btn btn-primary" onclick="applyBrandFilter()">Apply</button>
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
<script>
    function applyBrandFilter() {
        var selectedBrand = $("#brandFilter").val();
        // Redirect to the same page with the selected brand as a query parameter
        window.location.href = "{{ route('product_order') }}?brand=" + selectedBrand;
    }

    // Add this function to set the selected option in the dropdown
    function setBrandFilterSelection() {
        var selectedBrand = "{{ $selectedBrand }}"; // Add this line to get the selected brand from the controller
        $("#brandFilter").val(selectedBrand);

        // Move the selected option to the top
        $("#brandFilter option[value='" + selectedBrand + "']").prependTo("#brandFilter");
    }

    // Call the function to set the selected option on page load
    $(document).ready(function() {
        setBrandFilterSelection();
    });
</script>


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
                        alert(response.message);
                        if (response.inserted_data) {
                            alert("Inserted Data: " + JSON.stringify(response.inserted_data));
                        }
                        location.reload();
                    } else {
                        alert("Error: " + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error updating order status:", error);
                    alert("Error updating order status. Please check the console for details.");
                }
            });
        }
    }
</script>
@endsection
