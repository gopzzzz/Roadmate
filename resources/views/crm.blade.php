@extends('layout.mainlayout')



@section('content')
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

              <li class="breadcrumb-item active">Add Staff</li>

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

                <h3 class="card-title">Staff</h3>

                <p align="right">

               

                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Staff</button>

              
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



<form method="POST" action="{{url('crminsert')}}" enctype="multipart/form-data">



@csrf



<div class="modal-dialog" role="document" style="width:80%;">



<div class="modal-content">



<div class="modal-header">



<h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>



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



<input type="date" class="form-control" name="dob" placeholder="Enter date of birth" required max="<?php echo date('Y-m-d'); ?>">


</div>


<!-- <div class="form-group col-sm-6">



<label class="exampleModalLabel">Email</label>



<input class="form-control" name="email" placeholder="Enter Email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">


</div> -->

<!-- <form novalidate> -->
    <!-- Your form fields here -->

    <div class="form-group col-sm-6">
        <label class="exampleModalLabel">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
        <small id="emailHelp" class="form-text text-muted">Please enter a valid email with the domain @example.com.</small>
    </div>

    <!-- Other form fields and buttons -->

<!-- </form> -->


<div class="form-group col-sm-6">
    <label class="exampleModalLabel">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Enter Password" required pattern=".{8,}" title="Password must be at least 8 characters long">
    <small id="passwordHelp" class="form-text text-muted">Password must be at least 8 characters long.</small>
</div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Role</label>

<select name="role"  class="form-control" required>
                    <option value="" disabled selected>Select Role</option>
                    @foreach($crrr as $key)
                        <option value="{{ $key->id }}">{{ $key->designation }}</option>
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
              

                </p>

               

              </div>
             
              <!-- <script>
$(document).ready(function() {
    // Phone number validation
    $('input[name="phone_number"]').on('input', function() {
        var phoneNumber = $(this).val();
        if (!/^[0-9]{10}$/.test(phoneNumber)) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    // Email validation
    $('input[name="email"]').on('input', function() {
        var email = $(this).val();
        if (!/\S+@\S+\.\S+/.test(email)) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    // Password validation
    $('input[name="password"]').on('input', function() {
        var password = $(this).val();
        if (password.length < 8) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });
});
</script> -->

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
                    <th>Designation</th>
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

   @foreach($crr as $key)
<tr>
    <td>{{ $i }}</td>
    <td>{{ $key->crm_name }}</td>
    <td>{{ $key->phone_number }}</td>
    <td>{{ $key->address }}</td>
    <td>{{ $key->dob }}</td>
    <td>
        @if ($key->user_type)
            {{ $key->designation }}</td>
            <td>{{ $key->email }}</td>
        @else
            User data not available
        @endif
    </td>

        @if($role == 1)
          <td>
              <i class="fa fa-edit edit_crm" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>
              <!-- <i class="fa fa-trash delete_crm" aria-hidden="true" data-id="{{ $key->id }}" data-url="{{ route('deleteCrm', ['crmId' => $key->id]) }}"></i> -->
              <!-- <a href="{{url('deleteCrm')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a> -->
              <a href="#" onclick="confirmDelete('{{ $key->id }}')">
    <i class="fa fa-trash delete_banner text-danger" aria-hidden="true" data-id="{{ $key->id }}"></i>
</a>



              <i class="fa fa-view view_fran" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>

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
                    <th>Designation</th>
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
        <h5 class="modal-title">Edit Staff</h5>
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

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        var phoneInput = document.querySelector('input[name="phone_number"]');

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
    document.addEventListener('DOMContentLoaded', function () {
        var dobInput = document.querySelector('input[name="dob"]');
        
        // Calculate the minimum date for an 18-year-old
        var minDate = new Date();
        minDate.setFullYear(minDate.getFullYear() - 18);
        
        // Format the date in YYYY-MM-DD format
        var formattedMinDate = minDate.toISOString().split('T')[0];

        // Set the max attribute to restrict future dates
        dobInput.max = formattedMinDate;
    });
</script>



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
        var passwordInput = document.querySelector('input[name="password"]');
        var passwordHelp = document.getElementById('passwordHelp');

        passwordInput.addEventListener('input', function () {
            // Check if the password meets additional criteria (you can customize this)
            if (passwordInput.value.length < 8 && passwordInput.value !== '') {
                passwordInput.setCustomValidity('Password must be at least 8 characters long.');
                passwordHelp.style.color = 'red';
            } else {
                passwordInput.setCustomValidity('');
                passwordHelp.style.color = 'inherit';
            }
        });
    });
</script>

<script>
    function confirmDelete(crmId) {
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
                window.location.href = "{{ url('deleteCrm') }}/" + crmId;
            }
        });
    }
</script>


  @endsection