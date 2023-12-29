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

                <h3 class="card-title">Franchises</h3>

                <p align="right">

               

                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Franchises</button>

              
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<form method="POST" action="{{url('franinsert')}}" enctype="multipart/form-data">
@csrf
<div class="modal-dialog modal-lg" role="document">



<div class="modal-content">



<div class="modal-header">



<h5 class="modal-title" id="exampleModalLabel">PERSONAL DETAILS</h5>



<button type="button" class="close" data-dismiss="modal" aria-label="Close">



<span aria-hidden="true">&times;</span>



</button>



</div>



<div class="modal-body row">






<div class="form-group col-sm-6">



<label class="exampleModalLabel">Name</label>



<input class="form-control" name="franchise_name" placeholder="Enter Name" required>


</div>



<div class="form-group col-sm-6">



<label class="exampleModalLabel">Phone Number</label>



<input class="form-control" name="phone_number" placeholder="Enter Phone Number" required>


</div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">Area Name</label>



<input class="form-control" name="area" placeholder="Enter Area" required>


</div>



<div class="form-group col-sm-6">


<label class="exampleModalLabel">Pincode</label>



<input class="form-control" name="pincode" placeholder="Enter pincode" oninput="validatePincode(this)" required>


</div>


<div class="form-group col-sm-6">
        <label class="exampleModalLabel">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
        <small id="emailHelp" class="form-text text-muted">Please enter a valid email with the domain @example.com</small>
    </div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">Password</label>



<input class="form-control" name="password" placeholder="Enter Password" required>


</div>
</div>
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">FRANCHISE DETAILS</h5>
    <button type="button" class="btn btn-success btn-sm" id="addFranchise">+</button>
    <button type="button" class="btn btn-danger btn-sm" id="removeFranchise">-</button>
</div>
<div class="modal-body row" id="franchiseDetailsContainer">
    <!-- Initial FRANCHISE DETAILS section -->
    
    <div class="franchise-details-section">
        <ul class="list-group col-sm-12">
            <li class="list-group-item">
                <div class="form-row">
                <div class="form-group col-sm-6">



<label class="exampleModalLabel">Country</label>



<select name="country" class="form-control statefetchadd" id="country">
                    <option value="0">Select country</option>
                    @foreach($con as $country)
                        <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                    @endforeach
                </select>


</div>
<div class="form-group col-sm-6" >

<label class="exampleModalLabel">States</label>



<select name="states" class="form-control districtfetchadd" id="state">
                    <option value="0">Select state</option>
                </select>


</div>

<div class="form-group col-sm-6" >

<label class="exampleModalLabel">Type</label>
<select name="type[]" class="form-control selecttype" id="type" required>

<option value="0">Select Type</option>
<option value="1">Panchayath</option>
<option value="2">Muncipality</option>
<option value="3">Coperation</option>
<option value="4">District</option>

</select>

</div>	


<div class="form-group col-sm-6">



<label class="exampleModalLabel">District</label>

<select name="district_id[]" class="form-control districtadd" id="district">


                    <option value="0">Select District</option>
                </select>


</div>

		

<div class="form-group col-sm-6" id="typediv">



<label class="exampleModalLabel">Muncipality/Corporation/Panchayat/District</label>


<select name="place_id[]" id="place_id" class="form-control"></select>




</div>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" name="submit" class="btn btn-primary ml-auto">Add</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

</form>


</div>
</div>
              

                </p>

               

              </div>

              <!-- /.card-header -->
              <form method="POST" action="{{url('franchasefilter')}}" >
               @csrf
              <div style="display: flex; gap: 10px; align-items: center;">
  <br> <br>   <select class="form-control" name="type" style="width: 15%;">
        <option value="1" {{ $type== '1' ? 'selected' : '' }}>Panchayath</option>
        <option value="2" {{ $type== '2' ? 'selected' : '' }}>Municipality</option>
        <option value="3" {{ $type== '3' ? 'selected' : '' }}>Corporation</option>
        <option value="4" {{ $type== '4' ? 'selected' : '' }}>District</option>
    </select>
    <button type="submit" class="btn btn-sm btn-success" style="width: 5%;">FILTER</button>
</div>
</form>

                              
              <div class="card-body">
             

                <table id="example1" class="table table-bordered table-striped">

                  <thead>

                  <tr>

                    <th>id</th>

                    <th>Name</th>

                    <th>Phone Number</th>
                    
                    <th>Area Name</th>
                    <th>Pincode</th>
                    <th>State</th>
                    <th>District</th>
                  

                    <th>Place</th>
                   
                    @if($role==1)

					<th>Action</th>
          @endif

                  </tr>

                  </thead>
                  <tbody>
    @php $i = 1; @endphp

    @foreach($fran as $key)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $key->franchise_name }}</td>
            <td>{{ $key->phone_number }}</td>
            <td>{{ $key->area }}</td>
            <td>{{ $key->pincode }}</td>
            <td>{{ $key->state_name }}</td>
            <td>{{ $key->district_name }}</td>
            <td>
                @if($key->place_type != 4)
                    {{ $key->place_name }}
                @else
                    {{ $key->district->district_name }}
                @endif
            </td>
            @if($role == 1)
                <td>
                    <i class="fa fa-edit edit_fran" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>
                    <i class="fa fa-view view_fran" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>
                </td>
            @endif
        </tr>
    @endforeach
</tbody>


                  <tfoot>

                  <tr>

                  <th>id</th>

                   <th>Name</th>

                    
                   <th>Phone Number</th>
                   
                    <th>Area Name</th>
                    <th>Pincode</th>
                    <th>State</th>
                    <th>District</th>
                   
                    <th>Place</th>
                  
                    <!-- <th></th>  -->
                    @if($role==1)

					<th>Action</th>
          @endif
                  </tr>

                  </tfoot>
                
                </table>
                
                <div class="modal" id="editfranchises_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Franchises</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form method="POST" action="{{ url('franedit') }}" enctype="multipart/form-data" name="franedit">


@csrf
      <div class="modal-body row" id="countrylist">


      <div class="form-group col-sm-6">
<input type="hidden" name="id" id="id">


<label class="exampleModalLabel">Name</label>



<input class="form-control" name="franchise_name" id="franchise_name" required>


</div>




<div class="form-group col-sm-6">

<label class="exampleModalLabel">Phone Number</label>

<input class="form-control" name="phone_number" id="phone_number" required>

</div>

<div class="form-group col-sm-12">



<label class="exampleModalLabel">Muncipality/Corporation/Panchayat</label>



<input class="form-control" id="placevalue" readonly required>
<p>Do yo want edit place ?<strong id="clickme">click</strong><strong id="hideme" style="display:none;">Hide</strong></p>


</div>

<div class="form-group col-sm-6 editplaceTree" style="display:none;" >
    <label class="exampleModalLabel">Country</label>
    <select name="country" id="country_name" class="form-control countrylist">
        <option value="0">Select Country</option>
        @foreach($con as $country)
            <option value="{{ $country->id }}">{{ $country->country_name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-sm-6 editplaceTree" style="display:none;">
    <label class="exampleModalLabel">State</label>
    <select name="state" id="state_name" class="form-control districtfetchadd">
        <option value="0">Select State</option>
        @foreach($cond as $state)
            <option value="{{ $state->id }}">{{ $state->state_name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-sm-6 editplaceTree" style="display:none;">
    <label class="exampleModalLabel">District</label>
    <select name="district_id[]" id="district_name" class="form-control">
        <option value="0">Select District</option>
        @foreach($dis as $district)
            <option value="{{ $district->id }}">{{ $district->district_name }}</option>
        @endforeach
    </select>
</div>
                                        
<div class="form-group col-sm-6 editplaceTree" style="display:none;">

<label class="exampleModalLabel">Type</label>

<select name="type[]" id="type" class="form-control selecttype"  required>
<option value="0">Select Type</option>
	<option value="1">Panchayath</option>



	<option value="2">Muncipality</option>

	<option value="3">Coperatiion</option>
	


</select>

</div>	


<div class="form-group col-sm-12 editplaceTree" style="display:none;">
    <label class="exampleModalLabel">Muncipality/Corporation/Panchayat</label>
    <select name="place_id[]" id="place_idd" class="form-control"></select>
</div>




<div class="form-group col-sm-6">



<label class="exampleModalLabel">Area Name</label>



<input class="form-control" id="area" name="area"  required>


</div>



<div class="form-group col-sm-6">



<label class="exampleModalLabel">Pincode</label>



<input class="form-control" id="pincode" name="pincode" placeholder="Enter pincode">


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
         <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div><td>Phone number</td>
        <td>Address</td>
        <td></td>
        </tr>
        </thead>
        <tbody id="visitedshoptbody">
        </tbody>
        </table>
      </div>
      <div class="modal-footer">
       

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
    function validatePincode(input) {
        // Use a regular expression to check if the input contains only numbers
        if (!/^\d*$/.test(input.value)) {
            // If not, display an alert and clear the input
            alert("Please enter only numeric values for the pincode.");
            input.value = "";
        }
    }
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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>
    $(document).ready(function () {
        var franchiseDetailsCounter = 1;

        function addFranchiseDetailsSection() {
            var originalSection = $("#franchiseDetailsContainer .franchise-details-section:first");

            // Clone the original section
            var newSection = originalSection.clone();

            // Update IDs and names to make them unique
            newSection.find('[id]').each(function () {
                var idAttr = $(this).attr('id');
                $(this).attr('id', idAttr + franchiseDetailsCounter);
            });

            newSection.find('[name]').each(function () {
                var nameAttr = $(this).attr('name');
                $(this).attr('name', nameAttr.replace(/\[\d+\]/g, '[' + franchiseDetailsCounter + ']'));
            });

            newSection.appendTo("#franchiseDetailsContainer");
            franchiseDetailsCounter++;
            initializeNewSection(newSection);
        }

        function removeFranchiseDetailsSection() {
            if (franchiseDetailsCounter > 1) {
                $("#franchiseDetailsContainer .franchise-details-section:last").remove();
                franchiseDetailsCounter--;
            }
        }

        function togglePlaceRow(selectType) {
            var selectedType = selectType.val();
            var placeRow = selectType.closest('.franchise-details-section').find('.form-row #typediv');
            if (selectedType === "4") {
                placeRow.hide();
            } else {
                placeRow.show();
            }
        }

        function initializeNewSection(newSection) {
            newSection.find('.selecttype').on('change', function () {
                togglePlaceRow($(this));
            });
        }

        $("#addFranchise").on("click", function () {
            addFranchiseDetailsSection();
        });

        $("#removeFranchise").on("click", function () {
            removeFranchiseDetailsSection();
        });

        togglePlaceRow($("#franchiseDetailsContainer .franchise-details-section:first .selecttype"));
        initializeNewSection($("#franchiseDetailsContainer .franchise-details-section:first"));
    });
</script>

  @endsection



  
