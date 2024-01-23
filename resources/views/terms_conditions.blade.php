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

                  <li class="breadcrumb-item active"> Terms & Conditions</li>

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

                     <h3 class="card-title">Terms & Conditions</h3>

                     <p align="right">

                       <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Terms & Conditions</button>

                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <form method="POST" action="{{url('termconditioninsert')}}" enctype="multipart/form-data">

                           @csrf

                           <div class="modal-dialog" role="document" style="width:80%;">

                              <div class="modal-content">

                                 <div class="modal-header">

                                    <h5 class="modal-title" id="exampleModalLabel">Add Terms & Conditions</h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                    <span aria-hidden="true">&times;</span>

                                    </button>

                                 </div>

                                 <div class="modal-body row">

                                    <div class="form-group col-sm-12">

                                       <label class="exampleModalLabel">Details</label>

                                       <textarea  class="form-control" name="tc" placeholder="Enter Details" required></textarea>

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

                  </div>-->

                  <!-- /.card-header -->

                  <div class="card-body">

                     <table id="example1" class="table table-bordered table-striped">

                        <thead>

                           <tr>

                              <th>id</th>

                              <th>Details</th>

                              @if($role==1)<th>Action</th>@endif

                           </tr>

                        </thead>

                        <tbody>

                           @php 

                           $i=1;

                           @endphp

                           @foreach($terms as $key)

                           <tr>

                              <td>{{$i}}</td>

                              <td>{{$key->tc_details}}</td>

                              @if($role==1) <td>

                                 <i class="fa fa-edit edit_tcdetails"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                                 <i class="fa fa-eye view_tcdetails"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
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

                              <th>Details</th>

                              @if($role==1) <th>Action</th>@endif

                           </tr>

                        </tfoot>

                     </table>

                     <div class="modal" id="edittc_modal" tabindex="-1" role="dialog">

                        <div class="modal-dialog" role="document">

                           <div class="modal-content">

                              <div class="modal-header">

                                 <h5 class="modal-title">Edit Terms & Conditions</h5>

                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                 <span aria-hidden="true">&times;</span>

                                 </button>

                              </div>

                              <form method="POST" action="{{url('edittermcondition')}}" enctype="multipart/form-data">

                                 @csrf

                                 <div class="modal-body row">

                                    <div class="modal-body row">
                                    <input type="hidden" name="id" id="tcedit_id" class="form-control" >
                                    <div class="form-group col-sm-12">

                                       <label class="exampleModalLabel">Details</label>

                                       <textarea  class="form-control" name="tc" id="tc_edit" required></textarea>

                                    </div>

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
					 
					 <div class="modal" id="viewtc_modal" tabindex="-1" role="dialog">

                        <div class="modal-dialog" role="document">

                           <div class="modal-content">

                              <div class="modal-header">

                                 <h5 class="modal-title">View Terms & Conditions</h5>

                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                 <span aria-hidden="true">&times;</span>

                                 </button>

                              </div>


                                 <div class="modal-body row">

                                    <div class="modal-body row">
									<input type="hidden" name="id" id="tcview_id" class="form-control" >

                                    <div class="form-group col-sm-12">

                                       <label class="exampleModalLabel">Details</label>

                                       <textarea  class="form-control" name="tc" id="tc_view" required></textarea>

                                    </div>

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

<script>
    function confirmDelete(termConditionId) {
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
                window.location.href = "{{ url('termconditiondelete') }}/" + termConditionId;
            }
        });
    }
</script>

@endsection