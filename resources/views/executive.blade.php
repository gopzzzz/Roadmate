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

              <li class="breadcrumb-item active">Add Executive</li>

            </ol>

          </div>

        </div>

      </div><!-- /.container-fluid -->

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

                <h3 class="card-title">Executives</h3>

                <p align="right">

               

                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Executive</button>

              
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



<form method="POST" action="{{url('exeinsert')}}" enctype="multipart/form-data">



@csrf



<div class="modal-dialog" role="document" style="width:80%;">



<div class="modal-content">



<div class="modal-header">



<h5 class="modal-title" id="exampleModalLabel">Add Executive</h5>



<button type="button" class="close" data-dismiss="modal" aria-label="Close">



<span aria-hidden="true">&times;</span>



</button>



</div>



<div class="modal-body row">






<div class="form-group col-sm-6">



<label class="exampleModalLabel">Name</label>



<input class="form-control" name="exename" placeholder="Enter Name" required>


</div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">Email</label>



<input class="form-control" name="email" placeholder="Enter Email" required>


</div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Phone Number</label>



<input class="form-control" name="phonenumber" placeholder="Enter Phone Number" required>


</div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">District</label>



<select name="district" class="form-control">

<option value="0">Select Disrtict</option>
<option value="1">Ernakulam</option>
<option value="2">Malappuram</option>
<option value="3">Palakkad</option>
</select>


</div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Location</label>



<input class="form-control" name="location" placeholder="Enter Location" required>


</div>



<div class="form-group col-sm-6">



<label class="exampleModalLabel">Address</label>



<textarea class="form-control" name="address" placeholder="Enter address"></textarea>


</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">Image</label>



<input class="form-control" type="file" name="image" >


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
              

                </p>

               

              </div>

              <!-- /.card-header -->

              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">

                  <thead>

                  <tr>

                    <th>id</th>

                    <th>Name</th>

                    <th>Phone Number</th>

                    <th>Email</th>

                   

                    <th>Addrress</th>

                    <th></th>

                    <th></th>
                    @if($role==1)

					<th>Action</th>
          @endif

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
          <td><button type="button" class="btn btn-sm btn-primary addedshop" data-id="{{$key->id}}" ><i class="fa fa-eye"></i>Added Shop</button></td>
					
					@if($role==1)
<td><i class="fa fa-edit edit_exe"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
					<i class="fa fa-eye view_execu"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
					  <i class="fa fa-view view_execu"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
					   <a href="{{url('exedelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>
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

                   <th>Name</th>

                    <th>Phone Number</th>

                    <th>Email</th>

                    <th>Addrress</th>
                    <th></th>

                    <th></th> 
                    @if($role==1)

					<th>Action</th>
          @endif
                  </tr>

                  </tfoot>

                </table>
				
				<div class="modal" id="editexecutive_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Executive</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('exeedit')}}" enctype="multipart/form-data" name="exeedit">

@csrf
      <div class="modal-body row">


      <div class="form-group col-sm-6">
<input type="hidden" name="id" id="exeid">


<label class="exampleModalLabel">Name</label>



<input class="form-control" name="exename" id="name" required>


</div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">Email</label>



<input class="form-control" name="email" id="email" required>


</div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Phone Number</label>



<input class="form-control" name="phonenumber" id="phnum" required>


</div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">District</label>



<select name="district" id="district" class="form-control">

<option value="0">Select Disrtict</option>
<option value="1">Ernakulam</option>
<option value="2">Malappuram</option>
<option value="3">Palakkad</option>
</select>


</div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Location</label>



<input class="form-control" id="location" name="location"  required>


</div>



<div class="form-group col-sm-6">



<label class="exampleModalLabel">Address</label>



<textarea class="form-control" id="address" name="address" placeholder="Enter address"></textarea>


</div>
 <div class="form-group col-sm-6">



                      <label class="exampleModalLabel">Image</label>



                      <input type="file"  name="image"  >


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

 <div class="modal" id="viewexecutive_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">View Executive</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row">


      <div class="form-group col-sm-6">
<input type="hidden" name="id" id="exeviewid">


<label class="exampleModalLabel">Name</label>



<input class="form-control" name="exename" id="name1" required>


</div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">Email</label>



<input class="form-control" name="email" id="email1" required>


</div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Phone Number</label>



<input class="form-control" name="phonenumber" id="phnum1" required>


</div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">District</label>



<select name="district" id="district1" class="form-control">

<option value="0">Select Disrtict</option>
<option value="1">Ernakulam</option>
<option value="2">Malappuram</option>
<option value="3">Palakkad</option>
</select>


</div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Location</label>



<input class="form-control" id="location1" name="location"  required>


</div>



<div class="form-group col-sm-6">



<label class="exampleModalLabel">Address</label>



<textarea class="form-control" id="address1" name="address" placeholder="Enter address"></textarea>


</div>
 <div class="form-group col-sm-6">



                      <label class="exampleModalLabel">Image</label>



                      <input type="file"  name="image"  >


                      </div>

      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="visitedshopmodal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
        <thead>
        <tr>
        <td>id</td>
        <td>Shop name</td>
        <td>Phone number</td>
        <td>Address</td>
        <td></td>
        </tr>
        </thead>
        <tbody id="visitedshoptbody">
        </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
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