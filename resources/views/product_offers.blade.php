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
                  <li class="breadcrumb-item active">Product Offers</li>
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
                     <h3 class="card-title">Product Offers</h3>
                     <p align="right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Product Offers</button>
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="POST" action="{{url('product_offersinsert')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="modal-dialog" role="document" style="width:80%;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Product Offers</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body row">
                                
                                  <input type="hidden" value="1" name="package_id" id="id"> 
								  <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop</label>
                                        <select name="shop" class="form-control">
                                        <option value="0">select Shop</option>
                                        @foreach($shops as $key)
                                        <option value="{{$key->id}}">{{$key->shopname}}</option>
                                        @endforeach
                                        </select>
                                    </div>
								  <div class="form-group col-sm-6">

                                           <label class="exampleModalLabel">Offer Type</label>

                                                    <select name="otype" class="form-control">

                                                     <option value="0">Select Type</option>
                                                     <option value="1">Service</option>
                                                     <option value="2">Product</option>
                                                   </select>

                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Title</label>
                                      <input type="text" name="title" class="form-control" Placeholder="Enter Title" >
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Description</label>
                                      <textarea  name="desc" class="form-control" Placeholder="Enter Description" ></textarea>
                                    </div>
                                
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Image</label>
                                      <input type="file" name="image" class="form-control"  >
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Normal Amount</label>
                                      <input type="text" name="norm_amunt" class="form-control"  Placeholder="Enter Normal Amount">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Discount Amount</label>
                                      <input type="text" name="dis_amunt" class="form-control"  Placeholder="Enter Discount Amount">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">End Date</label>
                                      <input type="date" name="edate" class="form-control" Placeholder="Enter Description" >
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
							  <th>Shop</th>
                              <th>Title</th>
                              <th>Description</th>
                             
                              <th>Normal Amount</th>
                              <th>Discount Amount</th>
                              <th>End Date</th>
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
                           @foreach($prodoffr as $key)
                           <tr>
                              <td>{{$i}}</td>
							  <td>{{$key->shopname}}</td>
                              <td>{{$key->title}}</td>
                              <td>{{$key->description}}</td>
                              <td>{{$key->normal_amount}}</td>
                              <td>{{$key->discount_amount}}</td>
                              <td>{{$key->end_date}}</td>
                              <td><img src="{{ asset('/img/'.$key->product_picture) }}" alt="" width="50"/></td>
                             
                              @if($role==1) <td>
                                <i class="fa fa-edit editprdtoffr"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                                 <i class="fa fa-eye viewprdtoffr"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                               <a href="{{url('product_offersdelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>
                              </td>@endif

                           </tr>
                           @php 
                           $i++;
                           @endphp
                           @endforeach
                        </tbody>
                        <tfoot>
                           <tr>
                              <th>id</th>
                              <th>Title</th>
                              <th>Description</th>
                             
                              <th>Vehicle Type</th>
                              <th>Fuel Type</th>
                              <th>Amount</th>
                              <th>Image</th>
                              <th>Offer Amount</th>
                              @if($role==1)
                              <th>Action</th>
                              @endif
                           </tr>
                        </tfoot>
                     </table>
                    <div class="modal" id="viewprodoffrmodal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">View Product Offers</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              
                                 <div class="modal-body row">
                                <input type="hidden" id="id" name="id">
								 <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop</label>
                                        <select name="shop" class="form-control" id="shop">
                                        <option value="0">select Shop</option>
                                        @foreach($shops as $key)
                                        <option value="{{$key->id}}">{{$key->shopname}}</option>
                                        @endforeach
                                        </select>
                                    </div>
								  <div class="form-group col-sm-6">

                                           <label class="exampleModalLabel">Offer Type</label>

                                                    <select name="otype" id="otype" class="form-control">

                                                     <option value="0">Select Type</option>
                                                     <option value="1">Service</option>
                                                     <option value="2">Product</option>
                                                   </select>

                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Title</label>
                                      <input type="text" name="title" class="form-control" id="title" Placeholder="Enter Title" >
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Description</label>
                                      <textarea  name="desc" class="form-control" Placeholder="Enter Description" id="desc"></textarea>
                                    </div>
                                
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Normal Amount</label>
                                      <input type="text" name="norm_amunt" class="form-control"  id="norm_amunt">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Discount Amount</label>
                                      <input type="text" name="dis_amunt" class="form-control"  id="dis_amunt">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">End Date</label>
                                      <input type="date" name="edate" class="form-control" id="edate" >
                                    </div>
                                 <div class="modal-footer">
                                   
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 </div>
                             
                           </div>
                        </div>
                     </div>
                  </div>
				       <div class="modal" id="editprodoffrmodal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Edit Product Offers</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <form method="POST" action="{{url('product_offersedit')}}" enctype="multipart/form-data">
                                 @csrf
                                 <div class="modal-body row">
                                <input type="hidden" id="edit_id" name="id">
								 <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop</label>
                                        <select name="shop" class="form-control" id="shop1">
                                        <option value="0">select Shop</option>
                                        @foreach($shops as $key)
                                        <option value="{{$key->id}}">{{$key->shopname}}</option>
                                        @endforeach
                                        </select>
                                    </div>
								  <div class="form-group col-sm-6">

                                           <label class="exampleModalLabel">Offer Type</label>

                                                    <select name="otype" id="otype1" class="form-control">

                                                     <option value="0">Select Type</option>
                                                     <option value="1">Service</option>
                                                     <option value="2">Product</option>
                                                   </select>

                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Title</label>
                                      <input type="text" name="title" class="form-control" id="title1" Placeholder="Enter Title" >
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Description</label>
                                      <textarea  name="desc" class="form-control" Placeholder="Enter Description" id="desc1"></textarea>
                                    </div>
                                
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Normal Amount</label>
                                      <input type="text" name="norm_amunt" class="form-control"  id="norm_amunt1">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Discount Amount</label>
                                      <input type="text" name="dis_amunt" class="form-control"  id="dis_amunt1">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">End Date</label>
                                      <input type="date" name="edate" class="form-control" id="edate1" >
                                    </div>
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Image</label>
                                      <input type="file" name="image" class="form-control"  >
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