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
                  <li class="breadcrumb-item active">Wallets</li>
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
                     <h3 class="card-title">Wallets</h3>
                     <p align="right">
                       <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Shop Packages</button>-->
                    
                  <!-- /.card-header -->
                  <div class="card-body">
                     <table id="example1" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th>id</th>
							  <th>Customer</th>
							  <th>Amount</th>
                             
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @php 
                           $i=1;
                           @endphp
                           @foreach($wallets as $key)
                           <tr>
                              <td>{{$i}}</td>
							  <td>{{$key->name}}</td>
							  <td>{{$key->amount_credited}}</td>
                              
                              <td>
                                <!-- <i class="fa fa-edit editcompackage"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>-->
                                 <i class="fa fa-eye viewwallet"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                                 <!--<a href="{{url('packagedelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>-->
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
							   <th>Customer</th>
							  <th>Amount</th>

                              <th>Action</th>
                           </tr>
                        </tfoot>
                     </table>
                   <div class="modal" id="viewwallet_modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">View Wallet</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                            
                                 <div class="modal-body row">
                                    
									 <input type="hidden" name="id" id="wallid">
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Customer</label>
                                        <select name="cust" class="form-control" id="cust" readonly>
                                        <option value="0">select Customer</option>
                                        @foreach($custmr1 as $key)
                                        <option value="{{$key->id}}">{{$key->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									 <div class="form-group col-sm-6">
                                    
                                       <label class="exampleModalLabel">Amount</label>
                                       <input type="text" class="form-control" name="amount" id="amount" required readonly>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                   
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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