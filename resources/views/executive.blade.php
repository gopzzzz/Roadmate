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
        <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
        <small id="emailHelp" class="form-text text-muted">Please enter a valid email with the domain @example.com.</small>
    </div>

    <div class="modal-body row" id="franchiseDetailsContainer">

<div class="form-group col-sm-6">



<label class="exampleModalLabel">Phone Number</label>



<input class="form-control" name="phonenumber" placeholder="Enter Phone Number" required>
</div> 



            <div class="form-group col-sm-6">
                <label for="country">Country</label>
                <select name="country" class="form-control statefetchadd" data-order="1"  id="country">
                    <option value=" "disabled selected>Select country</option>
                    @foreach($con as $country)
                        <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-sm-6">
                <label for="state">State</label>
                <select name="state" class="form-control districtfetchadd" data-order="1" id="state_1">
                    <option value=" " disabled selected>Select state</option>
                </select>
            </div>

            <div class="form-group col-sm-6">
                <label for="district">District</label>
                <select name="district" class="form-control" data-order="1" id="district_1">
                    <option value=" "disabled selected>Select district</option>
                </select>
            </div> 
            </div> 
         

<div class="form-group col-sm-6">



<label class="exampleModalLabel">Location</label>



<input class="form-control" name="location" placeholder="Enter Location" required>


</div>



<div class="form-group col-sm-6">



<label class="exampleModalLabel">Address</label>



<textarea class="form-control" name="address" placeholder="Enter address" required></textarea>


</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">Image</label>



<input class="form-control" type="file" name="image" accept="image/*" required>


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

                   

                    <th>Address</th>
                    <th>Status</th>

                    <th></th>

                    <th></th>
                    @if($role==1)

					<th>Action</th>
          @endif

                  </tr>

                  </thead>

                  <tbody id="executives">

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
          <td>@if($key->exestatus==0) Active
            @else Inactive 
            @endif
          </td>

          <td>
            @if($key->user_id==null)
            <button type="button" class="btn btn-success btn-sm createaccount" data-email="{{$key->email}}" data-id="{{$key->id}}">Create Account</button>
            @endif
            <!-- <button type="button" class="btn btn-sm btn-success visitedshop" data-id="{{$key->id}}" ><i class="fa fa-eye"></i>Visited Shop</button> -->
          </td>
          <td><button type="button" class="btn btn-sm btn-primary addedshop" data-id="{{$key->id}}" ><i class="fa fa-eye"></i>Added Shop</button></td>
					
					@if($role==1)
<td><i class="fa fa-edit edit_exe"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
					<i class="fa fa-eye view_execu"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
					  <i class="fa fa-view view_execu"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
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

                   <th>Name</th>

                    <th>Phone Number</th>

                    <th>Email</th>

                    <th>Address</th>
                    <th>Status</th>

                    <th></th>

                    <th></th> 
                    @if($role==1)

					<th>Action</th>
          @endif
                  </tr>

                  </tfoot>

                </table>



                <div class="modal" id="editexecutivemodal" tabindex="-1" role="dialog">



<div class="modal-dialog" role="document">



   <div class="modal-content">



      <div class="modal-header">



         <h5 class="modal-title">Create Account </h5>



         <button type="button" class="close" data-dismiss="modal" aria-label="Close">



         <span aria-hidden="true">&times;</span>



         </button>



      </div>

      <form method="POST" action="{{url('createaccount')}}" enctype="multipart/form-data">

         @csrf

         <div class="modal-body row">

            <div class="form-group col-sm-12">

               <input type="hidden" name="id" id="countryid">

               <label class="exampleModalLabel">Email</label>

               <input type="email" class="form-control" name="email" id="email" required>
               <input type="hidden" id="exeid" name="id">
              
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



      </form>



   </div>



</div>



</div>



</div>
				
				<div class="modal" id="editexecutive_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Executive</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('exeedit') }}" enctype="multipart/form-data" name="exeedit">

@csrf
      <div class="modal-body row">


      <div class="form-group col-sm-6">
<input type="hidden" name="id" id="exeid">


<label class="exampleModalLabel">Name</label>



<input class="form-control" name="exename" id="name" required>


</div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">Email</label>



<input class="form-control" name="email" id="gemail" required>


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



<input class="form-control" id="location" name="location" >


</div>



<div class="form-group col-sm-6">



<label class="exampleModalLabel">Address</label>



<textarea class="form-control" id="address" name="address" placeholder="Enter address"></textarea>


</div>
 <div class="form-group col-sm-6">



                      <label class="exampleModalLabel">Image</label>



                      <input type="file"  name="image"  >


                      </div>
                      <div class="form-group col-sm-6">

                      <label class="exampleModalLabel">Status</label>

<select name="status" id="status" class="form-control"  required>

	<option value="0">Active</option>
<option value="1">In Active</option>
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
        <h5 class="modal-title"> Shops</h5>
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
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
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
    document.addEventListener('DOMContentLoaded', function () {
        var emailInput = document.querySelector('input[name="email"]');
        var emailHelp = document.getElementById('emailHelp');

        emailInput.addEventListener('input', function () {
            var emailValue = emailInput.value.toLowerCase();
            
            // Check if the email has a valid format
            if (!/^[\w.%+-]+@[\w.-]+\.[a-zA-Z]{2,}$/.test(emailValue) && emailValue !== '') {
                emailInput.setCustomValidity('Please enter a valid email address.');
                emailHelp.style.color = 'red';
            } else {
                emailInput.setCustomValidity('');
                emailHelp.style.color = 'inherit';
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var phoneInput = document.querySelector('input[name="phonenumber"]');

        phoneInput.addEventListener('input', function () {
            var value = phoneInput.value;

            // Remove non-numeric characters
            var numericValue = value.replace(/\D/g, '');

            // Limit to 10 digits
            numericValue = numericValue.substring(0, 10);

            // Update the input value with the cleaned numeric value
            phoneInput.value = numericValue;

            if (/[^\d]/.test(value) && value !== '') {
                alert('Please enter a valid numeric phone number.');
                phoneInput.value = ''; // Clear the input if non-numeric characters are present
            }
        });
    });
</script>

<script>
    function confirmDelete(executiveId) {
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
                window.location.href = "{{ url('exedelete') }}/" + executiveId;
            }
        });
    }
</script>

  @endsection