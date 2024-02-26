@extends('layout.mainlayout')

@section('content')

<head>

<!-- Include SweetAlert CSS and JS files -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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

              <li class="breadcrumb-item active">Godown</li>

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



            <div class="card"  id="franchiseDetailsContainer">

              <div class="card-header">

                <h3 class="card-title">Godown</h3>

                <p align="right">

               

                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Godown</button>

              
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



<form method="POST" action="{{url('godowninsert')}}" enctype="multipart/form-data">



@csrf



<div class="modal-dialog modal-lg" role="document" style="width:80%;">



<div class="modal-content">



<div class="modal-header">



<h5 class="modal-title" id="exampleModalLabel">Add Godown</h5>



<button type="button" class="close" data-dismiss="modal" aria-label="Close">



<span aria-hidden="true">&times;</span>



</button>



</div>



<div class="modal-body row">


<div class="form-group col-sm-6">


<label class="exampleModalLabel">Name</label>

<input class="form-control" name="name" placeholder="Enter Name" required>




</div>



<div class="form-group col-sm-6">



<label class="exampleModalLabel">Landmark</label>



<input class="form-control" name="landmark" placeholder="Enter landmark" required>


</div>

<div class="modal-body row">
                           <div id="franchise-details-section_1">
                              <div class="row">
                <div class="form-group col-sm-6">
                                    <label class="exampleModalLabel">Country</label>
                                    <select name="country" class="form-control statefetchadd" data-order="1" id="country_1">
                                       <option value="0">Select country</option>
                                       @foreach($con as $country)
                                       <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="form-group col-sm-6" >
                                    <label class="exampleModalLabel">States</label>
                                    <select name="states" class="form-control districtfetchadd" data-order="1" id="state_1">
                                       <option value="0">Select state</option>
                                    </select>
                                 </div>
                                 <div class="form-group col-sm-6" >
                                    <label class="exampleModalLabel">Type</label>
                                    <select name="type[]" class="form-control selecttype" data-order="1" id="type_1" required>
                                       <option value="0">Select Type</option>
                                       <option value="1">Panchayath</option>
                                       <option value="2">Muncipality</option>
                                       <option value="3">Coperation</option>
                                       <!-- <option value="4">District</option> -->
                                    </select>
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label class="exampleModalLabel">District</label>
                                    <select name="district[]" class="form-control districtadd" data-order="1" id="district_1">
                                       <option value="0">Select District</option>
                                    </select>
                                 </div>
                                 <div class="form-group col-sm-6" id="typediv_1">
                                    <label class="exampleModalLabel">Muncipality/Corporation/Panchayat</label>
                                    <select name="place_id[]" id="place_id_1" class="form-control" data-order="1">
                                       <option value="0">Select District</option>
                                    </select>
                                 </div>
</div>
</div>
</div>
<div class="form-group col-sm-6">


<label class="exampleModalLabel">Phone Number</label>



<input class="form-control" name="phone_number" placeholder="Enter phone number" oninput="validatePhoneNumber(this)" required>


</div>






<div class="form-group col-sm-6">

<label class="exampleModalLabel">Email</label>

<input class="form-control" name="email" placeholder="Enter email" required>

</div>

<div class="form-group col-sm-6">
    <label class="exampleModalLabel">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Enter Password" required pattern=".{8,}" title="Password must be at least 8 characters long">
    <small id="passwordHelp" class="form-text text-muted">Password must be at least 8 characters long.</small>
</div>


<div class="form-group col-sm-6">

<label class="exampleModalLabel">GST number</label>

<input class="form-control" name="GST_Num" placeholder="Enter gst num" required>

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
                    <th>Landmark</th>
                    <th>Place</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>GST Number<th>
  

<th>Action</th>


</tr>

</thead>


<tbody>
@php
$i = 1;
@endphp

@foreach($stock as $key)
<tr>
<td>{{ $i }}</td>
    <td>{{ $key->name }}</td>
    <td>{{ $key->landmark }}</td>
    <td>{{ $key->place_name }}</td>
    <td>{{ $key->phone_number }}</td>   
    <td>{{ $key->email }}</td>
    <td>{{ $key->GST_Num }}</td>
<td></td>


<td>
<i class="fa fa-edit edit_godown" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>
<a href="#" onclick="confirmDelete('{{ $key->id }}')">
<!-- <i class="fa fa-trash delete_banner text-danger" aria-hidden="true" data-id="{{ $key->id }}"></i> -->
</a>
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
                    <th>Landmark</th>
                    <th>Place</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>GST Number<th>

<th>Action</th>

</tr>

</tfoot>

</table>





                <div class="modal" id="editgodown_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Godown</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('godownedit')}}" enctype="multipart/form-data" name="exeedit">

@csrf
      <div class="modal-body row">


      
<input type="hidden" name="id" id="godown_id">
<div class="form-group col-sm-6">


<label class="exampleModalLabel">Name</label>

<input class="form-control" name="name" id="name" placeholder="Enter Name" required>




</div>



<div class="form-group col-sm-6">



<label class="exampleModalLabel">Landmark</label>



<input class="form-control" name="landmark" id="landmark" placeholder="Enter landmark" required>


</div>

<div class="form-group col-sm-6">


<label class="exampleModalLabel">Phone Number</label>



<input class="form-control" name="phone_number" id="phone_number" placeholder="Enter phone number" required>


</div>



<div class="form-group col-sm-6">

<label class="exampleModalLabel">GST number</label>

<input class="form-control" name="GST_Num" id="GST_Num" placeholder="Enter gst num" required>

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



  @endsection