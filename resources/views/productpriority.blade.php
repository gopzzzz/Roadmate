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
 <li class="breadcrumb-item"><a href="#">Home</a></li>
 <li class="breadcrumb-item active">Product Priority</li>
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
                     <h3 class="card-title">Product Priority</h3>
  <p align="right">

 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Product Priority</button>



                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    @csrf
  <div class="modal-dialog" role="document" style="width:80%;">
  <div class="modal-content">
<div class="modal-header">
   <h5 class="modal-title" id="exampleModalLabel">Product Priority</h5>
 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
 <span aria-hidden="true">&times;</span>



                                    </button>



                                 </div>



                                 <div class="modal-body row">



                                    <div class="form-group col-sm-12">



                                    <form method="POST" action="{{ url('update_Priority') }}" enctype="multipart/form-data">
   
            <input type="text" name="search_product" class="form-control" id="search_product" placeholder="Search Product" value="" style="width: 450px;">
       

    <div id="searchproductlist"></div>

    <!-- Hidden input field to store selected product IDs -->
    <input type="hidden" name="selected_product_ids" id="selected_product_ids">

    </div>
    </div>
    <div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 <button type="submit" class="submitBtn btn btn-primary">Add</button>



                                 </div>



                              </div>



                           </div>



                        </form>



                     </div>



                  </div>



						<!-- /.card-header -->
					
            <div class="card-body">
              <!-- <form>
                   <div class="col-md-4">
                      <div class="form-group">
                        <input type="text" name="search_shop" class="form-control" id="search_shop" placeholder="Search" value="">
                      </div>
                    </div>
                </form> -->
 <table  class="table table-bordered table-striped" id="example1">

                  <thead>

                  <tr>

                    <th>id</th>


                    <th>Productname</th>
                    <th>Product Image</th>

<th></th>
                  </tr>

                  </thead>

                  <tbody>

                  @php 

                    $i=1;

                    @endphp

                    @foreach($product as $key)
  <tr>

                  <td>{{$i}}</td>
                    

                  <td>{{$key->product_name}}</td>

                  <td>
											<img src="{{ asset('/market/'.$key->images) }}" alt=""  width="200" height="100" />
										</td>
                  
                    <td>
                    <button class="btn btn-primary edit_priority" data-toggle="modal" onclick="removePriority('{{$key->id}}')">
    Remove Priority
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
                    <th>Product Image</th>

                    <th></th>


</tr>
</tfoot>
</table>
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

<script>
    function removePriority(productId) {
        window.location.href = "{{ route('removePriority', ['productId' => ':productId']) }}".replace(':productId', productId);
    }
</script>

@endsection













