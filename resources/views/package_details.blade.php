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
                  <li class="breadcrumb-item active">Packages Details</li>
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
                     <h3 class="card-title">Packages Details</h3>
                     <p align="right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Packages Details</button>
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="POST" action="{{url('packagedetinsert')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="modal-dialog" role="document" style="width:80%;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Packages Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body row">
                                
                                  <input type="hidden" value="1" name="package_id" id="id"> 
								  
                                    <div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Package</label>
                                        <select name="packag" class="form-control">
                                        <option value="0">select package</option>
                                        @foreach($com as $key1)
                                        <option value="{{$key1->id}}">{{$key1->title}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									<div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Details</label>
                                      <textarea  name="desc" class="form-control" Placeholder="Enter Details" ></textarea>
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
                              <th>Package</th>
                              <th>Details</th>
                             
                              @if($role==1)<th>Action</th>@endif
                           </tr>
                        </thead>
                        <tbody>
                           @php 
                           $i=1;
                           @endphp
                           @foreach($packagedet as $key)
                           <tr>
                              <td>{{$i}}</td>
                              <td>{{$key->title}}</td>
                              <td>{{$key->pkg_det_details}}</td>
                          
                              
                              @if($role==1) <td>
                                <i class="fa fa-edit editpackdet"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                                 <i class="fa fa-eye viewpackdet"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                               <a href="{{url('packagedetdelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>
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
                              <th>Package</th>
                              <th>Details</th>
                             
                              @if($role==1) <th>Action</th>@endif
                           </tr>
                        </tfoot>
                     </table>
                   <div class="modal" id="viewpackdetmodal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">View Package Details</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              
                                 <div class="modal-body row">
                                <input type="hidden" id="id" name="id">
								 <div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Package</label>
                                        <select name="packag" class="form-control" id="pack">
                                        <option value="0">select package</option>
                                        @foreach($com as $key1)
                                        <option value="{{$key1->id}}">{{$key1->title}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									<div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Details</label>
                                      <textarea  name="desc" class="form-control" Placeholder="Enter Details" id="det"></textarea>
                                    </div>
                                 <div class="modal-footer">
                                    
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 </div>
                              
                           </div>
                        </div>
                     </div>
                  </div>
				   <div class="modal" id="editpackdetmodal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Edit Package Details</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <form method="POST" action="{{url('packagedetedit')}}" enctype="multipart/form-data">
                                 @csrf
                                 <div class="modal-body row">
                                <input type="hidden" id="edit_id" name="id">
								 <div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Package</label>
                                        <select name="packag" class="form-control" id="pack1">
                                        <option value="0">select package</option>
                                        @foreach($com as $key1)
                                        <option value="{{$key1->id}}">{{$key1->title}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									<div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Details</label>
                                      <textarea  name="desc" class="form-control" Placeholder="Enter Details" id="det1"></textarea>
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