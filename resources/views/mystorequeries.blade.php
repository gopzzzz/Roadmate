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

                  <li class="breadcrumb-item active">My Store Queries</li>

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

                     <h3 class="card-title">My Store Queries</h3>

                     <p align="right">

                        <!--<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Fetaures</button>-->

                    

                  </div>

                  <!-- /.card-header -->

                  <div class="card-body">

                     <table id="example1" class="table table-bordered table-striped">

                        <thead>

                           <tr>

                              <th>id</th>
							  
							  <th>Customer</th>

                              <th>Question</th>

                              @if($role==1) <th>Action</th>@endif

                           </tr>

                        </thead>

                        <tbody>

                           @php 

                           $i=1;

                           @endphp

                           @foreach($mystrquris as $key)

                           <tr>

                              <td>{{$i}}</td>
							   <td>{{$key->name}}</td>

                              <td>{{$key->question}}</td>

                              @if($role==1)  <td>

                                 <!--<i class="fa fa-edit viewstorequeri"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>-->
								 
                                <i class="fa fa-eye viewstorequeri"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                               <!--  <i class="fa fa-view viewfeature"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>-->
                                <a href="{{url('mystorequerydelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>
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

                              <th>Question</th>

                              @if($role==1) <th>Action</th>@endif

                           </tr>

                        </tfoot>

                     </table>

                     <div class="modal" id="viewstorequerismodal" tabindex="-1" role="dialog">

                        <div class="modal-dialog" role="document">

                           <div class="modal-content">

                              <div class="modal-header">

                                 <h5 class="modal-title">View Store Queries</h5>

                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                 <span aria-hidden="true">&times;</span>

                                 </button>

                              </div>

                             

                             <div class="modal-body row">
							 
							  <input type="hidden" name="id" class="form-control" id="query_id">
								 <div class="form-group col-sm-12">

                                        <label class="exampleModalLabel">Customer</label>

                                       <select name="cust" class="form-control" id="customer1">
                                       <option value="0">Select Customer</option>

                                       @foreach($custmr1 as $key)

                                       <option value="{{$key->id}}">{{$key->name}}</option>

                                       @endforeach
                                      

                                       </select>

                                    </div>

                                 <div class="form-group col-sm-12">

                                        <label class="exampleModalLabel">Question</label>

                                      <input type="text" name="quest" class="form-control" id="question1">

                                    </div>

                                   

                                 <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                 </div>


                           </div>

                        </div>

                     </div>

                  </div>
				  
				  <!--<div class="modal" id="viewfeaturemodal" tabindex="-1" role="dialog">

                        <div class="modal-dialog" role="document">

                           <div class="modal-content">

                              <div class="modal-header">

                                 <h5 class="modal-title">View Feature</h5>

                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                 <span aria-hidden="true">&times;</span>

                                 </button>

                              </div>

                                 <div class="modal-body row">

                                 <div class="form-group col-sm-12">

                                 <input type="hidden" name="id" class="form-control" id="feat_id">

                                        <label class="exampleModalLabel">Feature</label>

                                      <input type="text" name="feature" class="form-control" id="feature_view">

                                    </div>

                                   

                                 <div class="modal-footer">

                                   

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                 </div>


                           </div>

                        </div>

                     </div>

                  </div>-->

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