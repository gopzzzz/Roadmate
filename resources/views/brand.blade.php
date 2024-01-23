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
                  <li class="breadcrumb-item active">Add Brands</li>
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
                     <h3 class="card-title">Brands</h3>
                     <p align="right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Brands</button>
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="POST" action="{{url('brandinsert')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="modal-dialog" role="document" style="width:80%;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Brands</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body row">
                                 <div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Vehicle Type</label>
                                       <select name="vehtype" class="form-control">
                                       <option value="0">select vehicle type</option>
                                       @foreach($vehtype as $vehtype)
                                       <option value="{{$vehtype->id}}">{{$vehtype->veh_type}}</option>
                                       @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Brand</label>
                                      <input type="text" name="brand" class="form-control" >
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
                              <th>Vehicle Type</th>
                              <th>Brand</th>
                              @if($role==1)<th>Action</th>@endif
                           </tr>
                        </thead>
                        <tbody>
                           @php 
                           $i=1;
                           @endphp
                           @foreach($brand as $key)
                           <tr>
                              <td>{{$i}}</td>
                              <td>{{$key->veh_type}}</td>
                              <td>{{$key->brand}}</td>
                              @if($role==1) <td>
                                <i class="fa fa-edit editbrand"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                                 <i class="fa fa-eye view_brand"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
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
                              <th>Vehicle Type</th>
                              <th>Brand</th>
                              @if($role==1) <th>Action</th>@endif
                           </tr>
                        </tfoot>
                     </table>
                    <div class="modal" id="editbrand_modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Edit Brand</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <form method="POST" action="{{url('editbarnd')}}">
                                 @csrf
                                 <div class="modal-body row">
                                    <div class="form-group col-sm-12">
                                       <input type="hidden" name="id" id="vehid_edit">
                                       <label class="exampleModalLabel">Vehicle Type</label>
                                       <select name="vehtype" class="form-control" id="vehtype1">
                                       <option value="0">select vehicle type</option>
                                       @foreach($vehtype1 as $vehtype1)
                                       <option value="{{$vehtype1->id}}">{{$vehtype1->veh_type}}</option>
                                       @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Brand</label>
                                      <input type="text" name="brand" class="form-control" id="brand1">
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
					 <div class="modal" id="viewbrand_modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">View Brand</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                             
                                 <div class="modal-body row">
								 <input type="hidden" name="id" id="vehid_view">
                                    <div class="form-group col-sm-12">
                                       
                                       <label class="exampleModalLabel">Vehicle Type</label>
                                       <select name="vehtype" class="form-control" id="vehtype_view">
                                       <option value="0">select vehicle type</option>
                                       @foreach($vehtype2 as $key2)
                                       <option value="{{$key2->id}}">{{$key2->veh_type}}</option>
                                       @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Brand</label>
                                      <input type="text" name="brand" class="form-control" id="brand_view">
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    
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
<script>
    function confirmDelete(brandId) {
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
                window.location.href = "{{ url('branddelete') }}/" + brandId;
            }
        });
    }
</script>

@endsection