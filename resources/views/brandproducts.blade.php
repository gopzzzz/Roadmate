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



                  <li class="breadcrumb-item active"> Brand Products</li>



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



                     <h3 class="card-title">Brand Products</h3>



                     <p align="right">






                     <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->



                     <form method="POST" action="{{ route('brandproductsinsert', ['Id' => $Id]) }}" enctype="multipart/form-data">

                           @csrf



                           <div class="modal-dialog modal-lg" role="document" style="width:80%;">



                              <div class="modal-content">



                                 <div class="modal-header">



                                    <h5 class="modal-title" id="exampleModalLabel">BRAND : {{ $BrandName }}</h5>

 </div>



                                 <div class="modal-body row">

                                 <div class="form-group col-sm-12">
    <label class="exampleModalLabel">Product Name</label>
    
    <input class="form-control" name="product_name" placeholder="Enter Product Name" required>
 
</div>
<input type="hidden" name="prod_id">

                                 <div class="form-group col-sm-6">



<label class="exampleModalLabel">Original Amount</label>



<input class="form-control" name="original_amount" placeholder="Enter original amount" required>


</div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">Offer Price</label>



<input class="form-control" name="offer_price" placeholder="Enter offer price" required>


</div>
<div class="form-group col-sm-12">

<label class="exampleModalLabel">Description</label>



<input class="form-control" name="description" placeholder="Enter Description" required>


</div>
</div>


                                



                                 <div class="modal-footer">






                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>



                                 </div>



                              </div>



                           </div>



                        </form>



                     <!-- </div>



                  </div> -->



                  <!-- /.card-header -->



                  <div class="card-body">



                     <table id="example1" class="table table-bordered table-striped">



                        <thead>



                           <tr>



                              <th>id</th>

                              <th>Images</th>


                              <th>Brand Names</th>
                             
                              <th>Offer Price</th>

                             <th>Original Amount</th>
                             <th>Description</th>


                             <th>Status</th>

                              @if($role==1)

                              <th>Action</th>

                              @endif

                           </tr>



                        </thead>



                        <tbody>

                        @php 



$i=1;



@endphp



@foreach($brandprod as $key)



<tr>



   <td>{{$i}}</td>
   <!-- <td><button type="button" class="btn btn-sm btn-success image_show" data-id="{{$key->id}}"><i class="fa fa-eye"></i> Images</button></td> -->
   <td>
    <button type="button" class="btn btn-success btn-sm image_show" 
            data-toggle="modal" 
            data-id="{{$key->id}}">
        <i class="fa fa-eye"></i> Images
    </button>
</td>



   <td>{{$key->product_name}}</td>

   <td>{{$key->offer_price}}</td>
   <td>{{$key->price}}</td>
   <td>{{$key->description}}</td>

   <td>@if($key->status==0) Active @else Inactive @endif</td>
  



  <td>



      <i class="fa fa-edit edit_brandproduct"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>

     




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


                              <th>Images</th>

                              <th>Brand Names</th>
                             

                             <th>Offer Price</th>

                             <th>Original Amount</th>
                             <th>Description</th>


                             <th>Status</th>

                              @if($role==1)

                              <th>Action</th>

                              @endif

                           </tr>



                        </tfoot>



                     </table>
<div class="modal fade" id="exampleModalimageadd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <input type="hidden" name="productid" id="prod_id">
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
                     <div class="modal" id="editbrandproduct_modal" tabindex="-1" role="dialog">



                        <div class="modal-dialog" role="document">



                           <div class="modal-content">



                              <div class="modal-header">



                                 <h5 class="modal-title">Edit Brand Products</h5>



                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">



                                 <span aria-hidden="true">&times;</span>



                                 </button>



                              </div>



                              <form method="POST" action="{{url('brandproductsedit')}}" enctype="multipart/form-data">



                                 @csrf



                                 <div class="modal-body row">



                                    <div class="form-group col-sm-12">



                                       <input type="hidden" name="id" id="brandproductid">

                                     


<label class="exampleModalLabel">Product Name</label>
<input class="form-control" name="product_name" id="product_name" placeholder="Enter Product Name" required>

</div>

</div>

<div class="form-group col-sm-12">



<label class="exampleModalLabel">Original Amount</label>



<input class="form-control" name="original_amount" id="original_amount" placeholder="Enter original amount" required>


</div>

<div class="form-group col-sm-12">



<label class="exampleModalLabel">Offer Price</label>



<input class="form-control" name="offer_price" id="offer_price" placeholder="Enter offer price" required>


</div>

<div class="form-group col-sm-12">

<label class="exampleModalLabel">Description</label>



<input class="form-control" name="description" id="description" placeholder="Enter Description" required>


</div>

<div class="form-group col-sm-12">

<label class="exampleModalLabel">Status</label>

<select name="status" id="status" class="form-control"  required>

<option value="0">Active</option>

<option value="1">In Active</option>

</select>

</div>
                                             <div class="modal-footer">



                                    <button type="submit" class="btn btn-primary">Save changes</button>



                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>



                                 </div>



                              </form>



                           </div>



                        </div>



                     </div>
                        
<!-- <script>
    $('.add-new-images').on('click', function () {
        var prod_id = $(this).data('id');
        $('#new_images_prod_id').val(prod_id);
    });
</script> -->
<script>
  $(document).ready(function(){
  $('#fil').change(function() {
  $('#target').submit();
});
});
  </script>
 

   
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



@endsection