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
                  <li class="breadcrumb-item active">Shop Provided Categories</li>
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
                     <h3 class="card-title">Shop Provided Categories</h3>
                     <p align="right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Shop Provided Categories</button>
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="POST" action="{{url('shop_providcatinsert')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="modal-dialog" role="document" style="width:80%;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Shop Provided Categories</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body row">
                                
                                  <input type="hidden" value="1" name="shop_id" id="id"> 
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
                                        <label class="exampleModalLabel">Shop Category</label>
                                        <select name="category" class="form-control">
                                        <option value="0">select Shop Category</option>
                                       @foreach($shop_cat as $key1)
                                        <option value="{{$key1->id}}">{{$key1->category}}</option>
                                        @endforeach
                                        </select>
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
                              <th>Category</th>
                              @if($role==1)
                              <th>Action</th>
                              @endif
                           </tr>
                        </thead>
                        <tbody>
                           @php 
                           $i=1;
                           @endphp
                           @foreach($provd_cat as $key)
                           <tr>
                              <td>{{$i}}</td>
							  <td>{{$key->shopname}}</td>
                              <td>{{$key->category}}</td>
                              
                              @if($role==1)  <td>
                                <i class="fa fa-edit editshpprvdcat"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                                 <i class="fa fa-eye viewshpprvdcat"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                                <a href="{{url('shop_providcatdelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>
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
                              <th>Shop</th>
                              <th>Category</th>
                              @if($role==1)
                              <th>Action</th>
                              @endif
                           </tr>
                        </tfoot>
                     </table>
                    <div class="modal" id="viewshpprvdcatmodal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">View Shop Provided Categories</h5>
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
                                        <label class="exampleModalLabel">Shop Category</label>
                                        <select name="cat" class="form-control" id="cat">
                                        <option value="0">select Shop Category</option>
                                       @foreach($shop_cat as $key1)
                                        <option value="{{$key1->id}}">{{$key1->category}}</option>
                                        @endforeach
                                        </select>
                                    </div>
								  
                                 <div class="modal-footer">
                                   
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 </div>
                             
                           </div>
                        </div>
                     </div>
                  </div>
				 <div class="modal" id="editshpprvdcatmodal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Edit Shop Provided Categories</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                             <form method="POST" action="{{url('shop_providcatedit')}}" enctype="multipart/form-data">
                                 @csrf
                                 <div class="modal-body row">
                                 <input type="hidden" name="id" id="edit_id" class="form-control" >
								 <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop</label>
                                        <select name="shop" class="form-control" id="shop1">
                                        <option value="0">select Shop</option>
                                        @foreach($shops1 as $key2)
                                        <option value="{{$key2->id}}">{{$key2->shopname}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop Category</label>
                                        <select name="cat" class="form-control" id="cat1">
                                        <option value="0">select Shop Category</option>
                                       @foreach($shop_cat as $key3)
                                        <option value="{{$key3->id}}">{{$key3->category}}</option>
                                        @endforeach
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