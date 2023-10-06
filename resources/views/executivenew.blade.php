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

                  <li class="breadcrumb-item"><a href="#">Home</a></li>

                  <li class="breadcrumb-item active"> Fuel Type</li>

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

                     <h3 class="card-title">Fuel Types</h3>

                     <p align="right">

                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Fuel Type</button>

                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <form method="POST" action="{{url('fueltypeinsert')}}" enctype="multipart/form-data">

                           @csrf

                           <div class="modal-dialog" role="document" style="width:80%;">

                              <div class="modal-content">

                                 <div class="modal-header">

                                    <h5 class="modal-title" id="exampleModalLabel">Fuel Type</h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                    <span aria-hidden="true">&times;</span>

                                    </button>

                                 </div>

                                 <div class="modal-body row">

                                    <div class="form-group col-sm-12">

                                       <label class="exampleModalLabel">Fuel Type</label>

                                       <input type="text"  class="form-control" name="fueltype" placeholder="Enter fuel type" required>

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

<th>Name</th>

<th>Phone Numbe</th>

<th>Email</th>



<th>Addrress</th>

<th></th>

<th></th>

<th>Action</th>

                           </tr>

                        </thead>

                        <tbody>

                  @php 

                  $i=1;

                  @endphp

                  @foreach($exe as $key)

                  <tr>

                    <td>{{$i}}</td>

                    <td>{{$key->name}}

                     

                    </td>

                    <td>{{$key->phonenum}}</td>

                    <td>{{$key->email}}</td>
					
					<td>{{$key->addrress}}</td>
          <td><button type="button" class="btn btn-sm btn-success visitedshop" data-id="{{$key->id}}" ><i class="fa fa-eye"></i>Visited Shop</button></td>
          <td><button type="button" class="btn btn-sm btn-primary addedshop"><i class="fa fa-eye"></i>Added Shop</button></td>
					
					<td><i class="fa fa-edit edit_exe"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
					<i class="fa fa-eye view_execu"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
					 
					   <a href="{{url('exedelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>
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

<th>Name</th>

<th>Phone Numbe</th>

<th>Email</th>



<th>Addrress</th>

<th></th>

<th></th>

<th>Action</th>

                           </tr>

                        </tfoot>

                     </table>

                   
					 
					

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