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

              <li class="breadcrumb-item active">Stores</li>

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

                <h3 class="card-title">Stores</h3>

                <p align="right">

               

                </div>

              <!-- /.card-header -->

              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">

                  <thead>

                  <tr>

                    <th>id</th>
					
					<th>Customer</th>

                    <th>Image1</th>

                    <th>Image2</th>

                    <th>Image3</th>

                    <th>Product Name</th>

                    <th>Price</th>

                    <th>Description</th>

                    <th>Category</th>

                    <th>Status</th>

                    <th>Action</th>



                  </tr>

                  </thead>

                  <tbody>

                  @php 

                  $i=1;

                  @endphp

                  @foreach($stores as $key)

                  <tr>

                    <td>{{$i}}</td>
					<td>{{$key->name}}</td>
                    <td><img src="{{ asset('/img/'.$key->image_1) }}" alt="" width="50"/></td>
                    <td><img src="{{ asset('/img/'.$key->image_2) }}" alt="" width="50"/></td>
                    <td><img src="{{ asset('/img/'.$key->image_3) }}" alt="" width="50"/></td>
                    <td>{{$key->product_name}}</td>
                    <td>{{$key->price}}</td>
                    <td>{{$key->description}}</td>
                    <td>{{$key->cat_name}}</td>
                    <td>
                    @if($key->status==1)
                    <i class="fa fa-check text-success"  aria-hidden="true" ></i>
                    @else
                    <i class="fa fa-times text-danger"  aria-hidden="true" ></i>
                    @endif
                    </td>   
                    <td>
                    <i class="fa fa-edit editstore"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                    <a href="{{url('storedelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>
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

                  <th>Image1</th>

                    <th>Image2</th>

                    <th>Image3</th>

                  <th>Product Name</th>

                  <th>Price</th>

                  <th>Description</th>

                  <th>Category</th>

                  <th>Status</th>

                  <th>Action</th>

                  </tr>

                  </tfoot>

                </table>
				
                <div class="modal" id="editstore_modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Store </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST" action="{{url('editstore')}}" enctype="multipart/form-data" name="shopedit">

              @csrf
                    <div class="modal-body row">


                      <input type="hidden" name="id" id="id">
                     

                      <div class="form-group col-sm-6">

                      <select name="category" id="category" class="form-control">

                      <option value="0">Select category</option>

                      @foreach($category as $category)

                      <option value="{{$category->id}}">{{$category->cat_name}}</option>

                      @endforeach
                     
                      </select>


                      </div>
                      

                      <div class="form-group col-sm-6">


                      <label class="exampleModalLabel">Product name</label>



                      <input class="form-control" name="pname" id="pname" type="text" required>


                      </div>
                      <div class="form-group col-sm-6">


                      <label class="exampleModalLabel">Price</label>



                      <input class="form-control" name="price" id="price" required>


                      </div>
                      <div class="form-group col-sm-6">


                      <label class="exampleModalLabel">Description</label>


                      <textarea class="form-control" name="desc" id="desc" required></textarea>


                      </div>

                      <div class="form-group col-sm-6">

                    <select name="status" id="status" class="form-control">

                    <label class="exampleModalLabel">Status</label>

                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                    

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

              </div>


        <!-- /.row -->

      </div>

      <!-- /.container-fluid -->

    </section>

    <!-- /.content -->

  </div>

  @endsection