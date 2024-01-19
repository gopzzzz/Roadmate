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
               <li class="breadcrumb-item active">Add Vendor</li>
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
                    <h3 class="card-title">Vendors</h3>
  ,                    <p align="right">
                         <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Vendor</button>
                           <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <form method="POST" action="{{url('vendorinsert')}}" enctype="multipart/form-data">
                                @csrf
                                  <div class="modal-dialog" role="document" style="width:80%;">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Vendor</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                              </button>
                                    </div>
<div class="modal-body row">
  <div class="form-group col-sm-6">
    <label class="exampleModalLabel">Name</label>
      <input class="form-control" name="venname" placeholder="Enter Name" required>
</div>
<div class="form-group col-sm-6">
  <label class="exampleModalLabel">Address</label>
   <textarea class="form-control" name="address" placeholder="Enter Address" required></textarea>
</div>
<div class="form-group col-sm-6">
  <label class="exampleModalLabel">Phone Number</label>
    <input class="form-control" name="phonenumber" placeholder="Enter Phone Number" required>
</div>
<div class="form-group col-sm-6">
  <label class="exampleModalLabel">Email</label>
    <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
      <small id="emailHelp" class="form-text text-muted">Please enter a valid email with the domain @example.com.</small>
</div>
<div class="form-group col-sm-6">
 <label class="exampleModalLabel">Shipping Address</label>
  <textarea class="form-control" name="shipaddress" placeholder="Enter Shipping Address" required></textarea>
</div>
<div class="form-group col-sm-6">
 <label class="exampleModalLabel">GST Number</label>
  <input class="form-control" name="gstnumber" placeholder="Enter GST Number" required>
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
    <th>Address</th>
    <th>Phone Number</th>
    <th>Email</th>
    <th>Shipping Address</th>
    <th>GST Number</th>
    <th>Status</th>
    @if($role==1)
    <th>Action</th>
    @endif
     </tr>
     </thead>
     <tbody>
     @php 
     $i=1;
     @endphp
     @foreach($vendor as $key)
     <tr>
     <td>{{$i}}</td>
     <td>{{$key->vendor_name}}
     </td>
	 <td>{{$key->address}}</td>
     <td>{{$key->phone_number}}</td>
     <td>{{$key->email}}</td>
	 <td>{{$key->shipping_address}}</td>
     <td>{{$key->Gst_number}}</td>
     <td>@if($key->status==0) Active @else Inactive @endif</td>
    @if($role==1)
    <td><i class="fa fa-edit edit_vendor"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
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
                     <th>Address</th>
                       <th>Phone Number</th>
                        <th>Email</th>
                          <th>Shipping Address</th>
                           <th>GST Number</th>
                             <th>Status</th>
         @if($role==1)
                              <th>Action</th>
        @endif
    </tr>
    </tfoot>
    </table>
<div class="modal" id="editvendor_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Vendor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form method="POST" action="{{ route('vendoredit') }}" enctype="multipart/form-data" name="exeedit">
@csrf
<div class="modal-body row">
 <div class="form-group col-sm-6">
    <input type="hidden" name="id" id="vendorid">
     <label class="exampleModalLabel">Name</label>
    <input class="form-control" name="venname" id="venname" placeholder="Enter Name" required>
</div>
<div class="form-group col-sm-6">
 <label class="exampleModalLabel">Address</label>
  <textarea class="form-control" name="address" id="address" placeholder="Enter Address" required></textarea>
</div>
<div class="form-group col-sm-6">
 <label class="exampleModalLabel">Phone Number</label>
  <input class="form-control" name="phonenumber" id="phonenumber" placeholder="Enter Phone Number" required>
</div>
<div class="form-group col-sm-6">
  <label class="exampleModalLabel">Email</label>
    <input type="email" class="form-control" name="email"  id="email" placeholder="Enter Email" required>
     <small id="emailHelp" class="form-text text-muted">Please enter a valid email with the domain @example.com.</small>
</div>
<div class="form-group col-sm-6">
 <label class="exampleModalLabel">Shipping Address</label>
   <textarea class="form-control" name="shipaddress" id="shipaddress" placeholder="Enter Shipping Address" required></textarea>
</div>
<div class="form-group col-sm-6">
  <label class="exampleModalLabel">GST Number</label>
   <input class="form-control" name="gstnumber" id="gstnumber" placeholder="Enter GST Number" required>
</div>
<div class="form-group col-sm-12">
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


  @endsection