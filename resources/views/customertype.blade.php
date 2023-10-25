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
                  <li class="breadcrumb-item active">Customertype</li>
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
                     <h3 class="card-title">Customertype</h3>
                     <p align="right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Customertype</button>
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="POST" action="{{url('customertypeinsert')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="modal-dialog" role="document" style="width:80%;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Customertype</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body row">
                                
                                    <div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Customer Type</label>
                                      <input type="text" name="customer_type" class="form-control">
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
                             <th>Id</th>
                              <th>Customer Type</th>              
                              @if($role==1)
                              <th>Action</th>
                              @endif
                           </tr>
                        </thead>
                        <tbody>
                           @php
                         $i=1;
                          @endphp
                          @foreach($customertype as $key)
                           <tr>
                              <td>{{$i}}</td>
                              <td>{{$key->customer_type}}</td>
							  
                              @if($role==1) <td align="center">
                                 <li class="fa fa-edit edit_customerype"  data-id="{{$key->id}}"></li>
							 
                              </td>@endif
                           </tr>
                           @php
                           $i++;
                           @endphp
                          @endforeach
                        </tbody>
                        <tfoot>
                           <tr>
                              <th>Id</th>
                              <th>Customer Type</th>							
                              @if($role==1)
                              <th>Action</th>
                              @endif
                           </tr>
                        </tfoot>
                     </table>
                     <div class="modal" id="editcustomertype_modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Edit Customer Type</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <form method="POST" action="{{url('customertypeedit')}}">
                                 @csrf
                                 <div class="modal-body row">
                                   
                                       <input type="hidden" name="id" id="cust_editid">
                                       
                                    <div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Customer Type</label>
                                      <input type="text" name="customer_type" class="form-control" id="c_type">
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