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
               <li class="breadcrumb-item active">Vehicles</li>
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
                  <h3 class="card-title">Vehicles</h3>
                  <p align="right">
                     <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Vehicles</button>
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <form method="POST" action="{{url('vehcleinsert')}}">
    @csrf
    <div class="modal-dialog" role="document" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Vehicle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <div class="form-group col-sm-12">
                    <label class="exampleModalLabel">Brand</label>
                    <select name="brand" class="form-control" required>
                        <option value="" disabled selected>Select Brand</option>
                        @foreach($brand as $key)                                   
                        <option value="{{$key->id}}">{{$key->brand}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-12">
                    <label class="exampleModalLabel">Fuel Type</label>                      
                    <select name="fuel" class="form-control" required>
                        <option value="" disabled selected>Select Fuel type</option>
                        @foreach($fuel as $key1)                                 
                        <option value="{{$key1->id}}">{{$key1->fuel_type}}</option>
                        @endforeach                           
                    </select>
                </div>
                <div class="form-group col-sm-12">
                    <label class="exampleModalLabel">Model</label>
                    <input type="text" name="models" class="form-control" required>
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
                           <th>Brand</th>
                           <th>Fuel Type</th>
                           <th>Model</th>
                           @if($role==1) <th>Action</th>@endif
                        </tr>
                     </thead>
                     <tbody>
                        @php 
                        $i=1;
                        @endphp
                        @foreach($vehcl as $key)
                        <tr>
                           <td>{{$i}}</td>
                           <td>{{$key->brand}}</td>
                           <td>{{$key->fuel_type}}</td>
                           <td>{{$key->model}}</td>
                           @if($role==1) <td>
                             <i class="fa fa-edit editviechle"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                              <i class="fa fa-eye viewviechle"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
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
                           <th>Model</th>
                           @if($role==1) <th>Action</th>@endif
                        </tr>
                     </tfoot>
                  </table>
                 <div class="modal" id="editvehicle_modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Edit Vehicle</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                                <form method="POST" action="{{url('vehcleedit')}}" enctype="multipart/form-data">
                                 @csrf
                                 <div class="modal-body row">
                                    <input type="hidden" name="id" id="vehcledit_id" class="form-control" >
                                    <div class="form-group col-sm-12">                               
									<label class="exampleModalLabel">Brand</label>                   
									<select name="brand_edit" class="form-control" id="brand1">                          
									<option value="0">Select Brand</option>                              
									@foreach($brand as $key3)                              
									<option value="{{$key3->id}}">{{$key3->brand}}</option>              
									@endforeach                                                      
									</select>                               
									</div>								
									<div class="form-group col-sm-12">                           
									<label class="exampleModalLabel">Fuel Type</label>                  
									<select name="fuel_edit" class="form-control" id="fuel_type1">                 
									<option value="0">Select Fuel type</option>                               
									@foreach($fuel as $key8)                              
									<option value="{{$key8->id}}">{{$key8->fuel_type}}</option>            
									@endforeach                                 
									</select>                               
									</div>                           
									<div class="form-group col-sm-12">                  
									<label class="exampleModalLabel">Model</label>              
									<input type="text" name="model_edit" class="form-control" id="model1">         
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
                  <div class="modal" id="viewvehicle_modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">View Vehicle</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                             
                                 <div class="modal-body row">
                                    <input type="hidden" name="id" id="vehclview_id" class="form-control" >
                                    <div class="form-group col-sm-12">                               
									<label class="exampleModalLabel">Brand</label>                   
									<select name="brand_edit" class="form-control" id="brand">                          
									<option value="0">Select Brand</option>                              
									@foreach($brand as $key3)                              
									<option value="{{$key3->id}}">{{$key3->brand}}</option>              
									@endforeach                                                      
									</select>                               
									</div>								
									<div class="form-group col-sm-12">                           
									<label class="exampleModalLabel">Fuel Type</label>                  
									<select name="fuel_edit" class="form-control" id="fuel_type">                 
									<option value="0">Select Fuel type</option>                               
									@foreach($fuel as $key8)                              
									<option value="{{$key8->id}}">{{$key8->fuel_type}}</option>            
									@endforeach                                 
									</select>                               
									</div>                           
									<div class="form-group col-sm-12">                  
									<label class="exampleModalLabel">Model</label>              
									<input type="text" name="model_edit" class="form-control" id="model">         
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

<script>
    function confirmDelete(vehicleId) {
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
                window.location.href = "{{ url('vehcledelete') }}/" + vehicleId;
            }
        });
    }
</script>

@endsection