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



                  <li class="breadcrumb-item active"> SubCategory</li>



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



                     <h3 class="card-title">SubCategory</h3>



                     <p align="right">



                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add SubCategory</button>



                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



                     <form method="POST" action="{{ route('subcategoryinsert')}}" enctype="multipart/form-data">



                           @csrf



                           <div class="modal-dialog" role="document" style="width:80%;">



                              <div class="modal-content">



                                 <div class="modal-header">


                                    <h5 class="modal-title" id="exampleModalLabel">SubCategory</h5>



                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">



                                    <span aria-hidden="true">&times;</span>



                                    </button>



                                 </div>


                                 

                                 <div class="modal-body row">
                                    <input type="hidden" value="{{$catId}}" name="catid">
                                    <div class="form-group col-sm-12">
                                       <label class="exampleModalLabel">SubCategory Name</label>
                                       <input type="text" class="form-control" name="subcategory_name" placeholder="Enter SubCategory Name" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label class="exampleModalLabel">SubCategory Image</label>
                                       <input type="file" name="subcategoryimage" accept="image/*">
                                    </div>  </div>



                                 <div class="modal-footer">



                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>



                                    <button type="submit" name="submit" class="btn btn-primary">Add</button>



                                 </div>



                              </div>



                           </div>



                        </form>



                     </div>



                  </div>



						<!-- /.card-header -->
	
						<div class="card-body">



<table id="example1" class="table table-bordered table-striped">
  


    <thead>
        <tr>
            <th colspan="5" style="text-align: center; background-color: yellow;">
                <h4 style="color: black;">CATEGORY: {{ $categoryname }}</h4>
            </th>
        </tr>
        <tr>
            <th>ID</th>
            <th>SubCategory Name</th>
            <th>SubCategory Image</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>



                        <tbody>
                           @php $i=1; @endphp
                           @foreach($markk as $key)
                           <tr>
                              <td>{{$i}}</td>
                              <td>{{$key->category_name}}</td>
                              <td>
    @if($key->image)
        <img src="{{ asset('/market/'.$key->image) }}" alt="" width="200" height="100" />
    @else
        <!-- Display a placeholder text when there is no image -->
        No Image
    @endif
</td>

                              <td>
                                 @if($key->status==0) Active @else Inactive @endif
                              </td>
                              <td>
                                 <i class="fa fa-edit edit_subcategory" aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                              </td>
                           </tr>
                           @php $i++; @endphp
                           @endforeach
                        </tbody>
                        <tfoot>
                           <tr>
                              <th>id</th>
                              <th>SubCategory Name</th>
                              <th>SubCategory Image</th>
                              <th>Status</th>
                              <th>Action</th>
                           </tr>
                        </tfoot>
                     </table>
	<div class="modal" id="editsubcategory_modal" tabindex="-1" role="dialog">



   <div class="modal-dialog" role="document">



	  <div class="modal-content">



		 <div class="modal-header">



			<h5 class="modal-title">Edit SubCategory</h5>



			<button type="button" class="close" data-dismiss="modal" aria-label="Close">



			<span aria-hidden="true">&times;</span>



			</button>



		 </div>



       <form method="POST" action="{{url('subcategoryedit')}}" enctype="multipart/form-data">



			@csrf



			<div class="modal-body row">



			   <div class="form-group col-sm-12">



				  <input type="hidden" name="id" id="subcatid">


				  <div class="form-group col-sm-12">

				  <label class="exampleModalLabel">SubCategory Name</label>



				  <input type="text" class="form-control" name="subcategory_name" id="subcategory_name" required>
				  </div>
				  <div class="form-group col-sm-12">
				  <label class="exampleModalLabel">SubCategory Image</label>
													<input type="file" name="subcategoryimage" accept="image/*" id="subcategoryimage">
												</div>

				  <div class="form-group col-sm-12">

<label class="exampleModalLabel">Status</label>

<select name="status" id="status" class="form-control"  required>

<option value="0">Active</option>



<option value="1">In Active</option>




</select>

</div>

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




		 



	   


		 </form>



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










