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

              <li class="breadcrumb-item active">Shop Categories</li>

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

                <h3 class="card-title">Add Shop Categories</h3>

                <p align="right">

               

                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Shop Categories</button>

              
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



                <form method="POST" action="{{url('shop_categoriesinsert')}}" enctype="multipart/form-data">



                @csrf



                <div class="modal-dialog" role="document" style="width:80%;">



                <div class="modal-content">



                <div class="modal-header">



                <h5 class="modal-title" id="exampleModalLabel">Add Shop Category</h5>



                <button type="button" class="close" data-dismiss="modal" aria-label="Close">



                <span aria-hidden="true">&times;</span>



                </button>



                </div>



                <div class="modal-body row">




                <div class="form-group col-sm-6">


                <label class="exampleModalLabel">Category</label>



                <input class="form-control" name="category" id="category" required>


                </div>

                <div class="form-group col-sm-6">


<label class="exampleModalLabel">Percentage</label>



<input class="form-control" name="percentage"  required>


</div>

                <div class="form-group col-sm-6">



                <label class="exampleModalLabel">Image</label>



                <input type="file"  name="image" accept="image/*" required>


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
              


               

              </div>

              <!-- /.card-header -->

              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">

                  <thead>

                  <tr>

                    <th>id</th>

                    <th>Category</th>

                    <th>Image</th>

                    @if($role==1)

<th>Action</th>

@endif

                  </tr>

                  </thead>

                  <tbody>

                  @php 

                  $i=1;

                  @endphp

                  @foreach($shop_categories as $key)

                  <tr>

                    <td>{{$i}}</td>
                    <td>{{$key->category}}</td>

                    <td><img src="{{ asset('/img/'.$key->image) }}" alt="" width="50"/></td>
					
					         

                    @if($role==1)

                    <td>
                    <i class="fa fa-edit edit_shopcategory"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
					<i class="fa fa-eye view_shopcategory"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                    <a href="{{url('shop_categoriesrdelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>
                    </td>

@endif

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

                  <th>Image</th>
                  @if($role==1)

<th>Action</th>

@endif

                  </tr>

                  </tfoot>

                </table>
                
				
				<div class="modal" id="editcategory_modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Shop Category</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST" action="{{url('shop_categoriesedit')}}" enctype="multipart/form-data" name="categoriesedit">

              @csrf
                    <div class="modal-body row">

                    <div class="form-group col-sm-6">

                      <input type="hidden" name="id" id="categoryid">
                      <input type="hidden" name="image" id="image">

                      <label class="exampleModalLabel">Category</label>

                      <input class="form-control" name="category" id="categoryname" required>


                      </div>
                      <div class="form-group col-sm-6">
                      <label class="exampleModalLabel">Order Number</label>

<input class="form-control" name="ordernumber" id="ordernumber" required>


</div>
<div class="form-group col-sm-6">

<label class="exampleModalLabel">Percentage</label>

<input class="form-control" name="percentage" id="percentage" required>


</div>

                      <div class="form-group col-sm-6">



                      <label class="exampleModalLabel">Image</label>



                      <input type="file"  name="image" accept="image/*" >


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
			  <div class="modal" id="viewcategory_modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">View Shop Category</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                   
                    <div class="modal-body row">

                    <div class="form-group col-sm-6">

                      <input type="hidden" name="id" id="categoryviewid">
                      <input type="hidden" name="image" id="image">

                      <label class="exampleModalLabel">Category</label>

                      <input class="form-control" name="category" id="categoryname1" required>


                      </div>

                      <div class="form-group col-sm-6">



                      <label class="exampleModalLabel">Image</label>



                      <input type="file"  name="image" accept="image/*" >


                      </div>

             

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

  @endsection