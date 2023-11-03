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

              <li class="breadcrumb-item active">Add Franchises</li>

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

                <h3 class="card-title">CRMS</h3>

                <p align="right">

               

                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add CRMS</button>

              
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



<form method="POST" action="{{url('crminsert')}}" enctype="multipart/form-data">



@csrf



<div class="modal-dialog" role="document" style="width:80%;">



<div class="modal-content">



<div class="modal-header">



<h5 class="modal-title" id="exampleModalLabel">Add CRMS</h5>



<button type="button" class="close" data-dismiss="modal" aria-label="Close">



<span aria-hidden="true">&times;</span>



</button>



</div>



<div class="modal-body row">






<div class="form-group col-sm-6">



<label class="exampleModalLabel">Name</label>



<input class="form-control" name="crm_name" placeholder="Enter Name" required>


</div>



<div class="form-group col-sm-6">



<label class="exampleModalLabel">Phone Number</label>



<input class="form-control" name="phone_number" placeholder="Enter Phone Number" required>


</div>




<div class="form-group col-sm-6">



<label class="exampleModalLabel">Address</label>



<textarea class="form-control" name="address" placeholder="Enter Address" required></textarea>


</div>



<div class="form-group col-sm-6">



<label class="exampleModalLabel">DOB</label>



<input class="form-control" name="dob" placeholder="Enter date of birth">


</div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Email</label>



<input class="form-control" name="email" placeholder="Enter Email" required>


</div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Password</label>



<input class="form-control" name="password" placeholder="Enter Password" required>


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
                    <th>Address</th>
                    <th>DOB</th>
                    <!-- <th>Muncipality/Corporation</th> -->
                    <th>Email</th>
                    <!-- <th></th>

                    <th></th> -->
                    @if($role==1)

					<th>Action</th>
          @endif

                  </tr>

                  </thead>

                  <tbody>
    @php
    $i = 1;
    @endphp

    @foreach($cr as $key)
    <tr>
        <td>{{ $i }}</td>
        <td>{{ $key->crm_name }}</td>
        <td>{{ $key->phone_number }}</td>
        <td>{{ $key->address }}</td>
        <td>{{ $key->dob }}</td>
        <!-- <td>{{ $key->place_id }}</td> -->
        <td>
            @if ($key->user)
            {{ $key->user->crm_name }}
                {{ $key->user->email }}
                {{ $key->user->user_type }}
            @else
                User data not available
            @endif
        </td>

        @if($role == 1)
        <td>
            <i class="fa fa-edit edit_crm" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>
            <!-- <i class="fa fa-eye view_fran" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i> -->
            <i class="fa fa-view view_fran" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>
            <!-- <a href="{{ url('exedelete') }}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger" aria-hidden="true" data-id="{{ $key->id }}"></i></a> -->
        </td>
        @endif

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

                    <th>Address</th>
                    <th>DOB</th>
                    <!-- <th>Muncipality/Corporation</th> -->
                    <th>Email</th>
                    <!-- <th></th>  -->
                    @if($role==1)

					<th>Action</th>
          @endif
                  </tr>

                  </tfoot>

                </table>
				
                <div class="modal" id="editcrms_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit CRMS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('crmedit')}}" enctype="multipart/form-data" name="crmedit">

@csrf
      <div class="modal-body row">


      <div class="form-group col-sm-6">

<input type="hidden" name="id" id="crm_id">


<label class="exampleModalLabel">Name</label>



<input class="form-control" name="crm_name" id="crm_name" required>


</div>




<div class="form-group col-sm-6">



<label class="exampleModalLabel">Phone Number</label>



<input class="form-control" name="phone_number" id="phone_number" required>


</div>



<div class="form-group col-sm-6">



<label class="exampleModalLabel">Address</label>



<input class="form-control" id="address" name="address"  required>


</div>



<div class="form-group col-sm-6">



<label class="exampleModalLabel">DOB</label>



<input class="form-control" id="dob" name="dob" placeholder="Enter dob">


</div>
 
      
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

 <div class="modal" id="viewfranchises_modal" tabindex="-1" role="dialog">
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
<input type="hidden" name="id" id="franviewid">


<label class="exampleModalLabel">Name</label>



<input class="form-control" name="franchise_name" id="franchise_name" required>


</div>

<!-- <div class="form-group col-sm-6">



<label class="exampleModalLabel">Email</label>



<input class="form-control" name="email" id="email1" required>


</div> -->


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Phone Number</label>



<input class="form-control" name="phone_number" id="phone_number" required>


</div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">Muncipality/Corporation</label>



<select name="place_id" id="place_id" class="form-control">

<option value="0">Select Muncipality/Corporation</option>
<option value="1">Ernakulam</option>
<option value="2">Malappuram</option>
<option value="3">Palakkad</option>
</select>


</div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Area Name</label>



<input class="form-control" id="area" name="area"  required>


</div>



<div class="form-group col-sm-6">



<label class="exampleModalLabel">Pincode</label>



<input class="form-control" id="pincode" name="pincode" placeholder="Enter address">


</div>
 <!-- <div class="form-group col-sm-6">



                      <label class="exampleModalLabel">Image</label>



                      <input type="file"  name="image"  >


                      </div> -->

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