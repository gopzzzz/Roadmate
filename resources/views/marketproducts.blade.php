@extends('layout.mainlayout')
@section('content')

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

              <li class="breadcrumb-item active">Market Brands</li>

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

    <h3 class="card-title">Add Brands</h3>

    <p align="right">
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Brands</button>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="POST" action="{{url('marketproductinsert')}}" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog" role="document" style="width:80%;">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add Brands</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body row">                  
    <div class="form-group col-sm-6">
    <label class="exampleModalLabel">Main Category</label>
    <select name="category" id="category" class="form-control subcategoryadd" required>
    <option value="0">Select Category</option>
    @foreach($mark as $key)
    <option value="{{ $key->id }}">{{ $key->category_name }}</option>
    @endforeach
    </select>
    </div>

<div class="form-group col-sm-6">
    <label class="exampleModalLabel">Sub Category</label>
    <select name="subcategory" id="subcategory" class="form-control" required>
        <option value="0">Select Subcategory</option>
    </select>
</div>
<div class="form-group col-sm-12">
                <label class="exampleModalLabel">Supplier</label>
                <select name="supplier" id="supplier" class="form-control" required>
                    <option value="" disabled selected>Select Supplier</option>
                    @foreach($vendor as $key)
                        <option value="{{ $key->id }}">{{ $key->vendor_name }}</option>
                    @endforeach
                </select>
            </div>

<div class="form-group col-sm-12">
<label class="exampleModalLabel">Brand Name</label>
<input class="form-control" name="brand_name" placeholder="Enter Product Name" required>
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
  </p>
 </div>
 <!-- /.card-header -->

              <div class="card-body">
             

                <table  class="table table-bordered table-striped" id="example1">
                 <thead>

                  <tr>
                    <th>id</th>
                    <th>Category</th>
                    <th>SubCategory</th>
                    <th>Supplier</th>
                    <th>Brand Name</th>
                    <th>Status</th>
                    <th>Action</th>
                    </tr>
                    </thead>

                  <tbody id="non-searchshoplist">

                  @php 

                    $i=1;

                    @endphp

                    @foreach($market as $key)

                 

                  <tr>

                  <td>{{$i}}</td>
                    

                  <!-- <td><button type="button" class="btn btn-sm btn-success image_show" data-id="{{$key->id}}" ><i class="fa fa-eye"></i> Images</button></td> -->
                
                    <td>@php  $cat=$key->cat_id; $catlist=DB::table('tbl_rm_categorys')->where('id',$cat)->first();@endphp @if(!$catlist) @else{{$catlist->category_name}}@endif</td>
                    <td>{{$key->category_name}}</td>
                    <td>{{$key->vendor_name}}</td>
                    <td>{{$key->brand_name}}</td>
                    <td>@if($key->status==0) Active @else Inactive @endif</td>
                    <td>

<i class="fa fa-edit edit_marketproduct"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}" data-cid="@if(!$catlist) @else{{$catlist->id}}@endif"></i>


<a href="{{ route('brandproducts', ['Id' => $key->id, 'BrandName' => $key->brand_name]) }}" class="btn btn-success btn-sm brand_products">Products</a>


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
                    <th>Category</th>
                    <th>SubCategory</th>
                    <th>Brand Name</th>
                    <th>Status</th>
                    <th>Action</th>
                    </tr>
</tfoot>
</table>

<script>
  $(document).ready(function(){
  $('#fil').change(function() {
  $('#target').submit();
});
});
  </script>
    

<div class="modal" id="editmarketproduct_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('marketproductedit')}}" enctype="multipart/form-data" name="exeedit">

@csrf
<div class="modal-body row">   
  <input type="hidden" id="marketproid" name="id">
            <div class="form-group col-sm-12">
                <label class="exampleModalLabel">Main Category</label>
                <select name="category" id="category_name" class="form-control categorylist" required>
                    <option value="" disabled selected>Select Category</option>
                    @foreach($mark as $key)
                        <option value="{{ $key->id }}">{{ $key->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-sm-12">
                <label class="exampleModalLabel">SubCategory</label>
                <select name="subcategory" id="subcategory_name" class="form-control" required>
                    <option value="" disabled selected>Select Subcategory</option>
                </select>
            </div>
            <div class="form-group col-sm-12">
                <label class="exampleModalLabel">Supplier</label>
                <select name="supplier" id="vendor_name" class="form-control" required>
                    <option value="" disabled selected>Select Supplier</option>
                    @foreach($vendor as $key)
                        <option value="{{ $key->id }}">{{ $key->vendor_name }}</option>
                    @endforeach
                </select>
            </div>
<div class="form-group col-sm-12">
<label class="exampleModalLabel">Brand Name</label>
<input class="form-control" name="brand_name" id="brand_name" required>
</div>
<div class="form-group col-sm-12">

<label class="exampleModalLabel">Status</label>

<select name="status" id="status" class="form-control"  required>

<option value="0">Active</option>

<option value="1">In Active</option>

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
<div class="modal" tabindex="-1" role="dialog" id="imageshowmodal">
<form action="{{ route('marketproductimageinsert') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Images</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="form-group col-sm-6">
                    
                    <label class="exampleModalLabel">Image</label>
                    <input type="hidden" name="prod_id" id="prod_id">

                    <input class="form-control" type="file" name="images[]" accept="image/*" multiple required>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>id</td>
                                <td>Images</td>
                            </tr>
                        </thead>
                        <tbody id="imageshowtbody"></tbody>
                    </table>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
    <script>
    $('.add-new-images').on('click', function () {
        var prod_id = $(this).data('id');
        $('#new_images_prod_id').val(prod_id);
    });
</script>
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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
    $(document).ready(function() {
        $('input[name="original_amount"], input[name="offer_price"]').on('input', function() {
            var value = $(this).val();
            if (!$.isNumeric(value) && value !== '') {
                alert('Please enter a valid number.');
                $(this).val(''); // Clear the input if not a number
            }
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Add this script to your page -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        $("form").submit(function(event) {
            var category = $("#category").val();
            var subcategory = $("#subcategory").val();
          
            
            // Check if the values are empty or have default values
            // if (category === "0" || subcategory === "0") {
            //     alert("Please fill out all required fields.");
            //     event.preventDefault(); // Prevent form submission
            // }
        });
    });
</script>
@endsection
