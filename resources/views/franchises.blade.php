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
                           @if(session('validationError'))
    <script>
        alert("{{ session('validationError') }}");
    </script>
@endif

                           <div class="form-group col-sm-6">
                              <label class="exampleModalLabel">Password</label>
                              <input class="form-control" name="password" placeholder="Enter Password" required>
                           </div>
                        </div>
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">FRANCHISE DETAILS</h5>
                        </div>
                        <div class="modal-body row" id="franchiseDetailsContainer">
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
                                       <option value="4">District</option>
                                    </select>
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label class="exampleModalLabel">District</label>
                                    <select name="district[]" class="form-control districtadd" data-order="1" id="district_1">
                                       <option value="0">Select District</option>
                                    </select>
                                 </div>
                                 <div class="form-group col-sm-12" id="typediv_1">
                                    <label class="exampleModalLabel">Muncipality/Corporation/Panchayat/District</label>
                                    <select name="place_id[]" id="place_id_1" class="form-control" data-order="1">
                                       <option value="0">Select District</option>
                                    </select>
                                 </div>
                              </div>
                              <hr>
                           </div>
                        </div>
                        <button type="button" class="btn btn-success btn-sm" id="addFranchise" >+ Add Franchase</button>
                        <input type="hidden" value="1" id="storeId">
                        <div class="modal-footer">
                           <button type="submit" name="submit" class="btn btn-primary ml-auto">Add</button>
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
               </form>
               </div>
               </div>
               </p>
            </div>
            <div class="card-body">
               <table id="example1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Area Name</th>
                        <th>Pincode</th>
                        <th>Franchise Details</th>
                        <th>Action</th>
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
                        <td><button type="button" class="btn btn-sm btn-primary get_franchise" data-id="{{ $key->id }}">Franchise</button><button style="margin-left:10px;" type="button" class="btn btn-sm btn-success addonfranchise" data-id="{{ $key->id }}">+ADD</button></td>
                        <td>
                           <i class="fa fa-edit edit_fran" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>
                           <i class="fa fa-view view_fran" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>
                        </td>
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
                        <th>Franchise Details</th>
                        @if($role==1)
                        <th>Action</th>
                        @endif
                     </tr>
                  </tfoot>
               </table>

               <div class="modal" tabindex="-1" role="dialog" id="addonfranchise_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create new franchise</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
     
        <form method="POST" action="{{ url('franchiseaddon') }}" enctype="multipart/form-data" name="franedit" onsubmit="return validateForm()">
          
                        @csrf    
                        <input type="hidden" name="fran_id" id="franchise_id">             
                          <div class="modal-body row" id="franchiseDetailsContaineradd">
                            <div id="franchise-details-section_0">
                              <div class="row">
                                 <div class="form-group col-sm-6">
                                    <label class="exampleModalLabel">Country</label>
                                    <select name="country" class="form-control statefetchadd" data-order="0" id="country_0" required>
                                       <option value="0">Select country</option>
                                       @foreach($con as $country)
                                       <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="form-group col-sm-6" >
                                    <label class="exampleModalLabel">States</label>
                                    <select name="states" class="form-control districtfetchadd" data-order="0" id="state_0" required>
                                       <option value="0">Select state</option>
                                    </select>
                                 </div>
                                 <div class="form-group col-sm-6" >
                                    <label class="exampleModalLabel">Type</label>
                                    <select name="type" class="form-control selecttype" data-order="0" id="type_0" required>
                                       <option value="0">Select Type</option>
                                       <option value="1">Panchayath</option>
                                       <option value="2">Muncipality</option>
                                       <option value="3">Coperation</option>
                                       <option value="4">District</option>
                                    </select>
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label class="exampleModalLabel">District</label>
                                    <select name="district" class="form-control districtadd" data-order="0" id="district_0" required>
                                       <option value="0">Select District</option>
                                    </select>
                                 </div>
                                 <div class="form-group col-sm-12" id="typediv_0">
                                    <label class="exampleModalLabel">Muncipality/Corporation/Panchayat/District</label>
                                    <select name="place_id" id="place_id_0" class="form-control" data-order="0" required>
                                       <option value="0">Select District</option>
                                    </select>
                                 </div>
                              </div>
                            </div>          
                         </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">create </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
        </form>
    </div>
  </div>
</div>
</div>

               <div class="modal" tabindex="-1" role="dialog" id="franchasedetailmodal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Franchise Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row" id="franchase_modal">
       
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

               <div class="modal" id="editfranchises_modal" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                     <form method="POST" action="{{ url('franedit') }}" enctype="multipart/form-data" name="franedit">
                        @csrf
                        <div class="modal-dialog modal-lg" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">EDIT PERSONAL DETAILS</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body row">
                                 <div class="form-group col-sm-6">
                                    <label class="exampleModalLabel">Name</label>
                                    <input type="hidden" id="id" name="id">
                                    <input class="form-control" name="franchise_name" id="franchise_name" placeholder="Enter Name" required>
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label class="exampleModalLabel">Phone Number</label>
                                    <input class="form-control" name="phone_number" id="phone_number" placeholder="Enter Phone Number" required>
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label class="exampleModalLabel">Area Name</label>
                                    <input class="form-control" name="area" id="area" placeholder="Enter Area" required>
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label class="exampleModalLabel">Pincode</label>
                                    <input class="form-control" name="pincode" id="pincode" placeholder="Enter pincode" oninput="validatePincode(this)" required>
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label class="exampleModalLabel">Email</label>
                                    <input type="email" class="form-control" id="email"  name="email" placeholder="Enter Email" required readonly>
                                    <small id="emailHelp" class="form-text text-muted">Please enter a valid email with the domain @example.com</small>
                                 </div>
                                 <!-- <div class="form-group col-sm-6">
                                    <label class="exampleModalLabel">Password</label>
                                    <input class="form-control" name="password" placeholder="Enter Password" >
                                 </div> -->
                              </div>
                             
                             
                              <div class="modal-footer">
                                 <button type="submit" name="submit" class="btn btn-primary ml-auto">Update</button>
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                     </form>
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
                     </div>
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
    function validateForm() {
        var countryValue = document.getElementById('country_0').value;
        var stateValue = document.getElementById('state_0').value;
        var typeValue = document.getElementById('type_0').value;

        if (countryValue == '0' || stateValue == '0' || typeValue == '0') {
            alert('Please select values for all required fields.');
            return false; // prevent form submission
        }

        // Additional validation logic if needed

        return true; // allow form submission
    }
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
        var phoneInput = document.querySelector('input[name="phone_number"]');

        phoneInput.addEventListener('input', function () {
            var value = phoneInput.value;

            // Remove non-numeric characters
            var numericValue = value.replace(/\D/g, '');

            // Limit to exactly 10 digits
            numericValue = numericValue.substring(0, 10);

            // Ensure the number starts with 7, 8, or 9
            if (/^[6789]/.test(numericValue)) {
                // Update the input value with the cleaned numeric value
                phoneInput.value = numericValue;
            } else {
                // Clear the input if it doesn't meet the criteria
                phoneInput.value = '';
                alert('Please enter a valid 10-digit phone number starting with 6,7, 8, or 9.');
            }
        });
    });
</script>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
   $(document).ready(function () {
    
   
     
       $("#addFranchise").on("click", function () {
           
         var id=$('#storeId').val();
        // alert(id);
         var increment_id=parseInt(id)+parseInt(1);
         
       
         var html= '<div id="franchise-details-section_'+increment_id+'">';
         html+= '<div class="row">';
         html+= '<div class="form-group col-sm-6">';
         html+= ' <label class="exampleModalLabel">Country</label>';
         html+= '<select name="country" class="form-control statefetchadd" data-order="'+increment_id+'" id="country_'+increment_id+'">';
         html+= '<option value="0">Select country</option>'
         @foreach ($con as $value)
       html += '<option value="{{ $value->id }}">{{ $value->country_name }}</option>';
   @endforeach
         html+= '</select>';
         html+= ' </div>';
         html+= '<div class="form-group col-sm-6" >';
         html+= ' <label class="exampleModalLabel">States</label>';
         html+= '<select name="states" class="form-control districtfetchadd" data-order="'+increment_id+'" id="state_'+increment_id+'">';
         html+= '<option value="0">Select state</option>';
         html+= '</select>';
         html+= '</div>';
         html+= ' <div class="form-group col-sm-6" >';
         html+= ' <label class="exampleModalLabel">Type</label>';
         html+= '<select name="type[]" class="form-control selecttype" data-order="'+increment_id+'" id="type_'+increment_id+'" required>';
         html+= ' <option value="0">Select Type</option>';
         html+= '<option value="1">Panchayath</option>';
         html+= '<option value="2">Muncipality</option>';
         html+= '<option value="3">Coperation</option>';
         html+= '<option value="4">District</option>';
         html+= ' </select>';
         html+= ' </div>';
         html+= '<div class="form-group col-sm-6">';
         html+= '<label class="exampleModalLabel">District</label>';
         html+= '<select name="district[]" class="form-control districtadd" data-order="'+increment_id+'" id="district_'+increment_id+'">';
         html+= '<option value="0">Select District</option>';
         html+= ' </select>';
         html+= '</div>';
        html+= '<div class="form-group col-sm-12" id="typediv_'+increment_id+'">';
        html+= '<label class="exampleModalLabel">Muncipality/Corporation/Panchayat/District</label>';
        html+= '<select name="place_id[]" id="place_id_'+increment_id+'" data-order="'+increment_id+'" class="form-control">';
        html+= ' <option value="0">Select District</option>';
        html+= '</select>';
        html+= ' </div>';
        html+= '</div>';
     
        html+= '<button type="button" class="btn btn-danger btn-sm removebutton" id="removeFranchise_'+increment_id+'" data-order="'+increment_id+'">Remove</button>';
        html+= '</div>';
        html+= '</div>';
   
        $('#franchiseDetailsContainer').append(html);
      
       // $('#addFranchise').data('row',increment_id);
        $("#storeId").val(increment_id);
       });
   
       $("#franchiseDetailsContainer").on("click",'.removebutton',function () {
         var id=$(this).data('order');
         var minusid=$("#storeId").val();
         var increment_id=parseInt(minusid)-parseInt(1);
         $("#storeId").val(increment_id);
        // alert(id);
         $('#franchise-details-section_'+id).remove();
         
          
       });
   
       // togglePlaceRow($("#franchiseDetailsContainer .franchise-details-section:first .selecttype"));
       // initializeNewSection($("#franchiseDetailsContainer .franchise-details-section:first"));
   });
</script>
@endsection