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
                  <li class="breadcrumb-item active">Packages Services</li>
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
                     <h3 class="card-title">Packages Services</h3>
                     <p align="right">
                       <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Packages Services</button>
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="POST" action="{{url('packageserviceinsert')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="modal-dialog" role="document" style="width:80%;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Packages Services</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body row">
                                
                                  <input type="hidden" value="1" name="package_id" id="id"> 
								  
								  <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop Category</label>
                                        <select name="shop_cat" class="form-control">
                                        <option value="0">select Shop Category</option>
                                       @foreach($shop_category as $key)
                                        <option value="{{$key->id}}">{{$key->category}}</option>
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
							  <th>Category</th>		 
                              <th>Package</th>
                              
                              @if($role==1)<th>Action</th>@endif
                           </tr>
                        </thead>
                        <tbody>
                           @php 
                           $i=1;
                           @endphp
                           @foreach($packserv as $key)
                           <tr>
                              <td>{{$i}}</td>
							  <td>{{$key->category}}</td>
                              <td>{{$key->title}}</td>
                              
                              @if($role==1) <td>
                                <i class="fa fa-edit editpackserv"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                                 <i class="fa fa-eye viewpackserv"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
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
							  <th>Category</th>		 
                              <th>Package</th>
                             
                              @if($role==1) <th>Action</th>@endif
                           </tr>
                        </tfoot>
                     </table>
                   <div class="modal" id="viewpackserv_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">View Package Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body row">
 <input type="hidden" class="form-control" name="id"  id="packservnew_id">

      <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop Category</label>
                                        <select name="shop_cat" class="form-control" id="cat_view">
                                        <option value="0">select Shop Category</option>
                                       @foreach($shop_category as $key)
                                        <option value="{{$key->id}}">{{$key->category}}</option>
                                        @endforeach
                                        </select>
                                    </div>
								  
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Package</label>
                                        <select name="packgs" class="form-control" id="pack_view">
                                        <option value="0">select package</option>
                                        @foreach($com1 as $key2)
                                        <option value="{{$key2->id}}">{{$key2->title}}</option>
                                        @endforeach
                                        </select>
                                    </div>

      </div>
      
      <div class="modal-footer">
       
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
     
    </div>
  </div>
</div>
                 <div class="modal" id="editpackserv_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Package Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('packageserviceedit')}}" enctype="multipart/form-data">
                                 @csrf
      <div class="modal-body row">
 <input type="hidden" class="form-control" name="id"  id="packservedit_id">

      <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop Category</label>
                                        <select name="shop_cat" class="form-control" id="cat_view1">
                                        <option value="0">select Shop Category</option>
                                       @foreach($shop_category as $key)
                                        <option value="{{$key->id}}">{{$key->category}}</option>
                                        @endforeach
                                        </select>
                                    </div>
								  
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Package</label>
                                        <select name="packgs" class="form-control" id="pack_view1">
                                        <option value="0">select package</option>
                                        @foreach($com1 as $key2)
                                        <option value="{{$key2->id}}">{{$key2->title}}</option>
                                        @endforeach
                                        </select>
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
    function confirmDelete(packageServiceId) {
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
                window.location.href = "{{ url('packageservicedelete') }}/" + packageServiceId;
            }
        });
    }
</script>

@endsection