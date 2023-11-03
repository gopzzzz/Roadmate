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
                  <li class="breadcrumb-item active">Packages Book</li>
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
                     <h3 class="card-title">Packages Book</h3>
                     <p align="right">
                       <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Shop Packages</button>-->
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="POST" action="{{url('packageshopinsert')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="modal-dialog" role="document" style="width:80%;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Packages Book</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body row">
                                
                                  <input type="hidden" value="1" name="package_id" id="id"> 
								  
								  <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop</label>
                                        <select name="shops" class="form-control">
                                        <option value="0">select shop</option>
                                        @foreach($shop1 as $key1)
                                        <option value="{{$key1->id}}">{{$key1->shopname}}</option>
                                        @endforeach
                                        </select>
                                    </div>
								  
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Package</label>
                                        <select name="packgs" class="form-control">
                                        <option value="0">select package</option>
                                        @foreach($com1 as $key2)
                                        <option value="{{$key2->id}}">{{$key2->title}}</option>
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
							  <th>Customer</th>
							  <th>Shop</th>
                              <th>Package</th>
                              <th>Random Number</th>
                             
                              @if($role==1)<th>Action</th>@endif
                           </tr>
                        </thead>
                        <tbody>
                           @php 
                           $i=1;
                           @endphp
                           @foreach($packagebook as $key)
                           <tr>
                              <td>{{$i}}</td>
							  <td>{{$key->name}}</td>
							  <td>{{$key->shopname}}</td>
                              <td>{{$key->title}}</td>
                               <td>{{$key->random_num}}</td>
                          
                              
                               @if($role==1) <td>
                                <!-- <i class="fa fa-edit editcompackage"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>-->
                                 <i class="fa fa-eye viewpackbook"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                                <a href="{{url('packagebookdelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>
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
							   <th>Customer</th>
							  <th>Shop</th>
                              <th>Package</th>
                              <th>Random Number</th>
							  
                              
                             
                              @if($role==1) <th>Action</th>@endif
                           </tr>
                        </tfoot>
                     </table>
                     <div class="modal" id="viewpackbookmodal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">View Packages Book</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              
                                 <div class="modal-body row">
                                <input type="hidden" id="id" name="id">
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
                                        <label class="exampleModalLabel">Shop</label>
                                        <select name="shops" class="form-control" id="shop">
                                        <option value="0">select shop</option>
                                        @foreach($shop1 as $key1)
                                        <option value="{{$key1->id}}">{{$key1->shopname}}</option>
                                        @endforeach
                                        </select>
                                    </div>
								  
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Package</label>
                                        <select name="packgs" class="form-control" id="packgs">
                                        <option value="0">select package</option>
                                        @foreach($com1 as $key2)
                                        <option value="{{$key2->id}}">{{$key2->title}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Random Number</label>
                                      <input type="text" name="randnum" class="form-control" id="randnum" >
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