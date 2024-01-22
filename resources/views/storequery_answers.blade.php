@extends('layout.mainlayout')

@section('content')
<head>
   <!-- Include SweetAlert CSS and JS files -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>

</head>
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

                  <li class="breadcrumb-item active">Store Query Answers</li>

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

                     <h3 class="card-title">Store Query Answers</h3>

                     <p align="right">

                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Store Query Answers</button>

                      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="POST" action="{{url('storequeryanswrinsert')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="modal-dialog" role="document" style="width:80%;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Query Answers</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body row">
                                
                                  <input type="hidden" value="1" name="answr_id" id="id"> 
								  <div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Customer</label>
                                        <select name="usr" class="form-control">
                                        <option value="0">select Customer</option>
                                        @foreach($custmr1 as $key1)
                                        <option value="{{$key1->id}}">{{$key1->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
								  <div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Question</label>
                                        <select name="qustn" class="form-control">
                                        <option value="0">select Question</option>
                                        @foreach($mystrquris as $key)
                                        <option value="{{$key->id}}">{{$key->question}}</option>
                                        @endforeach
                                        </select>
                                    </div>
								
                                    <div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Answer</label>
                                      <textarea name="answr" class="form-control"  Placeholder="Enter Answer"></textarea>
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

                              <th>Question</th>
							  
							  <th>Answer</th>

                       @if($role==1) <th>Action</th>@endif

                           </tr>

                        </thead>

                        <tbody>

                           @php 

                           $i=1;

                           @endphp

                           @foreach($strquransr as $key)

                           <tr>

                              <td>{{$i}}</td>
							   <td>{{$key->name}}</td>

                              <td>{{$key->question}}</td>
							  
							  <td>{{$key->answer}}</td>

                       @if($role==1) <td>

                                 <i class="fa fa-edit editquerianswr"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
								 
                                <i class="fa fa-eye viewquerianswr"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                                <a href="#" onclick="confirmDelete('{{ $key->id }}')">
    <i class="fa fa-trash delete_banner text-danger" aria-hidden="true" data-id="{{ $key->id }}"></i>
</a>

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
							  
							  <th>Answer</th>

                       @if($role==1) <th>Action</th>@endif

                           </tr>

                        </tfoot>

                     </table>

                     <div class="modal" id="viewstrquryanswermodal" tabindex="-1" role="dialog">

                        <div class="modal-dialog" role="document">

                           <div class="modal-content">

                              <div class="modal-header">

                                 <h5 class="modal-title">View Query Answers</h5>

                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                 <span aria-hidden="true">&times;</span>

                                 </button>

                              </div>

                             

                             <div class="modal-body row">
							 
							  <input type="hidden" name="id" class="form-control" id="qanswr_id">
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
                                        <select name="qustn" class="form-control" id="quest1">
                                        <option value="0">select Question</option>
                                        @foreach($mystrquris as $key)
                                        <option value="{{$key->id}}">{{$key->question}}</option>
                                        @endforeach
                                        </select>
                                    </div>
								
                                    <div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Answer</label>
                                      <textarea name="answr" class="form-control"  id="answr1"></textarea>
                                    </div>

                                   

                                 <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                 </div>


                           </div>

                        </div>

                     </div>

                  </div>
				  <div class="modal" id="editstrquryanswermodal" tabindex="-1" role="dialog">

                        <div class="modal-dialog" role="document">

                           <div class="modal-content">

                              <div class="modal-header">

                                 <h5 class="modal-title">Edit Query Answers</h5>

                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                 <span aria-hidden="true">&times;</span>

                                 </button>

                              </div>

                              <form method="POST" action="{{url('storequeryanswredit')}}" enctype="multipart/form-data">
                                 @csrf

                             <div class="modal-body row">
							 
							  <input type="hidden" name="id" class="form-control" id="qanswredit_id">
								 <div class="form-group col-sm-12">

                                        <label class="exampleModalLabel">Customer</label>

                                       <select name="usr" class="form-control" id="customer">
                                       <option value="0">Select Customer</option>

                                       @foreach($custmr1 as $key)

                                       <option value="{{$key->id}}">{{$key->name}}</option>

                                       @endforeach
                                      

                                       </select>

                                    </div>

                                 <div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Question</label>
                                        <select name="qustn" class="form-control" id="quest">
                                        <option value="0">select Question</option>
                                        @foreach($mystrquris as $key)
                                        <option value="{{$key->id}}">{{$key->question}}</option>
                                        @endforeach
                                        </select>
                                    </div>
								
                                    <div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Answer</label>
                                      <textarea name="answr" class="form-control"  id="answr"></textarea>
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

<script>
    function confirmDelete(storeQueryAnswerId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user clicks "Yes", proceed with the deletion
                window.location.href = "{{ url('storequeryanswrdelete') }}/" + storeQueryAnswerId;
            }
        });
    }
</script>

@endsection