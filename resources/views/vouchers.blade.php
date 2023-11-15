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

              <li class="breadcrumb-item active">Vouchers</li>

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

                <h3 class="card-title">Vouchers</h3>

                <p align="right">

               

                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Vouchers</button>

              
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



<form method="POST" action="{{url('voucherinsert')}}" enctype="multipart/form-data">



@csrf



<div class="modal-dialog" role="document" style="width:80%;">



<div class="modal-content">



<div class="modal-header">



<h5 class="modal-title" id="exampleModalLabel">Add Vouchers</h5>



<button type="button" class="close" data-dismiss="modal" aria-label="Close">



<span aria-hidden="true">&times;</span>



</button>



</div>



<div class="modal-body row">


<div class="form-group col-sm-6">


<label class="exampleModalLabel">Shop Name</label>



<select name="shopname" class="form-control">
  <option value="0">Select Shop Name</option>
  @foreach($vouch1 as $key)

<option value="{{$key->id}}">{{$key->shopname}}</option>
@endforeach
</select>


</div>



<div class="form-group col-sm-6">



<label class="exampleModalLabel">Coupen Code</label>



<input class="form-control" name="coupencode" placeholder="Enter Coupen Code" required>


</div>



<!-- <div class="form-group col-sm-6">



<label class="exampleModalLabel">Discount</label>



<input class="form-control" name="discount" placeholder="Enter discount" required>


</div> -->

<div class="form-group col-sm-6">
    <label class="exampleModalLabel">Discount</label>
    <div class="input-group">
        <input type="text" class="form-control" name="discount" placeholder="Enter discount" required pattern="\d+(\.\d{1,2})?" title="Enter a valid percentage (e.g., 10 or 10.5)">
        <!-- <div class="input-group-append">
            <span class="input-group-text">%</span>
        </div> -->
    </div>
    <small id="discountHelp" class="form-text text-muted">Enter a valid percentage (e.g., 10 or 10.5) with % symbol.</small>
</div>




<div class="form-group col-sm-6">



<label class="exampleModalLabel">Description</label>



<textarea class="form-control" name="description" placeholder="Enter Description" required></textarea>


</div>



<div class="form-group col-sm-6">

<label class="exampleModalLabel">Status</label>

<select name="status" class="form-control"  required>

<option value="0">Active</option>



<option value="1">In Active</option>




</select>

</div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Expiry Status</label>



<select name="expiry_status" class="form-control"  required>
<option value="0">Yes</option>

<option value="1">NO</option>




</select>


</div>


<div class="form-group col-sm-6">
  <label class="exampleModalLabel">Expiry Date</label>
  <input class="form-control" type="date" name="expiry_date" required min="{{ date('Y-m-d') }}">
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
                    <th>Shop Name</th>
                    <th>Coupen Code</th>

                    <th>Discount</th>
                    <th>Description</th>
                    <th>Status</th>
                    <!-- <th>Muncipality/Corporation</th> -->
                    <th>Expiry Status</th>
                    <th>Expiry Date</th> 
                    <!-- <th></th>

                    <th></th> -->
                 

					<th>Action</th>
       

                  </tr>

                  </thead>

                  <tbody>
                  @php
                  $i = 1;
                  @endphp

                  @foreach($vouch as $key)
    <tr>
    <td>{{ $i }}</td>
    <td>{{$key->shopname}}</td>
        <td>{{ $key->coupencode }}</td>
        <td>{{ $key->discount }}</td>
        <td>{{ $key->description }}</td>
        <td>@if($key->status==0) Active @else Inactive @endif</td>
        <td>@if($key->expiry_status==0) Yes @else No @endif</td>

        <td>{{ $key->expiry_date }}</td>

      
        <td>
            <i class="fa fa-edit edit_voucher" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>
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
                  <th>Shop Name</th>
                  <th>Coupen Code</th>

<th>Discount</th>
<th>Description</th>
<th>Status</th>
<!-- <th>Muncipality/Corporation</th> -->
<th>Expiry Status</th>
<th>Expiry Date</th> 
                    <!-- <th></th>  -->
                  

					<th>Action</th>
      
                  </tr>

                  </tfoot>

                </table>
				




                <div class="modal" id="editvoucher_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Vouchers</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('voucheredit')}}" enctype="multipart/form-data" name="exeedit">

@csrf
      <div class="modal-body row">


      <div class="form-group col-sm-12">
<input type="hidden" name="id" id="voucher_id">
<div class="form-group col-sm-12">


<label class="exampleModalLabel">Shop Name</label>



<select name="shopname" class="form-control" id="shopname" required>
<option value="0">Select Shop Name</option>
  @foreach($vouch1 as $key)

<option value="{{$key->id}}">{{$key->shopname}}</option>
@endforeach
</select>


</div>
</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">Coupen Code</label>



<input class="form-control" name="coupencode" id="coupencode" required>


</div>






<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Discount</label>
                                        <input class="form-control" name="discount" id="discount" required>
                                      <!-- <textarea  name="discount" class="form-control" id="discount" ></textarea> -->
                                    </div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Description</label>



<input class="form-control" name="description" id="description" required>


</div>





<div class="form-group col-sm-6">

<label class="exampleModalLabel">Status</label>

<select name="status" id="status1" class="form-control"  required>

<option value="0">Active</option>

<option value="1">In Active</option>

</select>

</div>



<div class="form-group col-sm-6">

<label class="exampleModalLabel">Expiry Status</label>

<select name="expiry_status" id="expiry_status1" class="form-control"  required>

<option value="0">Yes</option>

<option value="1">No</option>

</select>

</div>




<div class="form-group col-sm-6">
  <label class="exampleModalLabel">Expiry Date</label>
  <input type="text" class="form-control" type="date" id="expiry_date" name="expiry_date" required>
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
        var discountInput = document.querySelector('input[name="discount"]');
        var discountHelp = document.getElementById('discountHelp');

        discountInput.addEventListener('input', function () {
            // Check if the discount is in percentage format
            if (!/^(\d+(\.\d{1,2})?)?$/.test(discountInput.value) && discountInput.value !== '') {
                discountInput.setCustomValidity('Enter a valid percentage (e.g., 10 or 10.5)');
                discountHelp.style.color = 'red';
            } else {
                discountInput.setCustomValidity('');
                discountHelp.style.color = 'inherit';
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var dateInput = document.querySelector('input[name="date"]');

        // Update the min attribute to allow the current date
        dateInput.min = new Date().toISOString().split('T')[0];
    });
</script>

  @endsection