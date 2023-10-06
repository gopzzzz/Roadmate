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

                 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Stores</button>
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="POST" action="{{url('storesinsert')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="modal-dialog" role="document" style="width:80%;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Stores</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body row">
                                
                                  <input type="hidden" value="1" name="store_id" id="id"> 
								  <div class="form-group col-sm-6">

                                           <label class="exampleModalLabel">User Type</label>

                                                    <select name="utype" class="form-control">

                                                     <option value="0">Select Type</option>
                                                     <option value="1">Customer</option>
                                                     <option value="2">Shop</option>
                                                   </select>

                                    </div>
								  <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Customer</label>
                                        <select name="cust" class="form-control">
                                        <option value="0">select Customer</option>
                                        @foreach($custmr1 as $key1)
                                        <option value="{{$key1->id}}">{{$key1->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
								  <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Product Category</label>
                                        <select name="prod_cat" class="form-control">
                                        <option value="0">select Product Category</option>
                                       @foreach($category as $key)
                                        <option value="{{$key->id}}">{{$key->cat_name}}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Product Name</label>
                                      <input type="text" name="name" class="form-control" Placeholder="Enter Name" >
                                    </div>
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Price</label>
                                      <input type="text" name="price" class="form-control"  Placeholder="Enter Price">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Description</label>
                                      <textarea  name="desc" class="form-control" Placeholder="Enter Description" ></textarea>
                                    </div>
                                
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Image 1</label>
                                      <input type="file" name="image1" class="form-control"  >
                                    </div>
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Image 2</label>
                                      <input type="file" name="image2" class="form-control"  >
                                    </div>
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Image 3</label>
                                      <input type="file" name="image3" class="form-control"  >
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
					
					<th>Customer</th>

                    <th>Image1</th>

                    <th>Image2</th>

                    <th>Image3</th>

                    <th>Product Name</th>

                    <th>Price</th>

                    <th>Description</th>

                    <th>Category</th>

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

                  @foreach($stores as $key)

                  <tr>

                    <td>{{$i}}</td>
					<td>@if($key->user_type==1){{$key->name}} @elseif($key->user_type==2) {{$key->shopname}}@endif</td>
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
                    @if($role==1) <td>
                    <i class="fa fa-eye editstore"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
					<i class="fa fa-edit viewstore"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                   <a href="{{url('storedelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>
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

                 <th>Customer</th>

                    <th>Image1</th>

                    <th>Image2</th>

                    <th>Image3</th>

                    <th>Product Name</th>

                    <th>Price</th>

                    <th>Description</th>

                    <th>Category</th>

                    <th>Status</th>
                    @if($role==1)
                  <th>Action</th>
                  @endif
                  </tr>

                  </tfoot>

                </table>

                <div class="clearfix">
                     
                     {!! $stores->render( "pagination::bootstrap-4") !!}

</div>
				
                <div class="modal" id="editstore_modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">View Store </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                   
                    <div class="modal-body row">


                      <input type="hidden" name="id" id="id">
                     

                      <div class="form-group col-sm-6">

                                           <label class="exampleModalLabel">User Type</label>

                                                    <select name="utype" class="form-control" id="utype">

                                                     <option value="0">Select Type</option>
                                                     <option value="1">Customer</option>
                                                     <option value="2">Shop</option>
                                                   </select>

                                    </div>
								  <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Customer</label>
                                        <select name="cust" class="form-control" id="cust">
                                        <option value="0">select Customer</option>
                                        @foreach($custmr1 as $key1)
                                        <option value="{{$key1->id}}">{{$key1->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
								  <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Product Category</label>
                                        <select name="prod_cat" class="form-control" id="prod_cat"> 
                                        <option value="0">select Product Category</option>
                                       @foreach($category as $key)
                                        <option value="{{$key->id}}">{{$key->cat_name}}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Product Name</label>
                                      <input type="text" name="name" class="form-control" id="name" >
                                    </div>
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Price</label>
                                      <input type="text" name="price" class="form-control"  id="price">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Description</label>
                                      <textarea  name="desc" class="form-control" id="desc" ></textarea>
                                    </div>
                                
                                    
                     
             

                    </div>
                    
                    <div class="modal-footer">
                      
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                   
                  </div>
                </div>
              </div>
              <div class="modal" id="viewstore_modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Store </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST" action="{{url('storesedit')}}" enctype="multipart/form-data">
                                 @csrf
                    <div class="modal-body row">


                      <input type="hidden" name="id" id="edit_id">
                     

                      <div class="form-group col-sm-6">

                                           <label class="exampleModalLabel">User Type</label>

                                                    <select name="utype" class="form-control" id="utype1">

                                                     <option value="0">Select Type</option>
                                                     <option value="1">Customer</option>
                                                     <option value="2">Shop</option>
                                                   </select>

                                    </div>
								  <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Customer</label>
                                        <select name="cust" class="form-control" id="cust1">
                                        <option value="0">select Customer</option>
                                        @foreach($custmr1 as $key1)
                                        <option value="{{$key1->id}}">{{$key1->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
								  <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Product Category</label>
                                        <select name="prod_cat" class="form-control" id="prod_cat1"> 
                                        <option value="0">select Product Category</option>
                                       @foreach($category as $key)
                                        <option value="{{$key->id}}">{{$key->cat_name}}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Product Name</label>
                                      <input type="text" name="name" class="form-control" id="name1" >
                                    </div>
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Price</label>
                                      <input type="text" name="price" class="form-control"  id="price1">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Description</label>
                                      <textarea  name="desc" class="form-control" id="desc1" ></textarea>
                                    </div>
                                
                                   <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Image 1</label>
                                      <input type="file" name="image1" class="form-control"  >
                                    </div>
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Image 2</label>
                                      <input type="file" name="image2" class="form-control"  >
                                    </div>
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Image 3</label>
                                      <input type="file" name="image3" class="form-control"  >
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