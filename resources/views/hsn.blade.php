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

              <li class="breadcrumb-item active">HSN</li>

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

                <h3 class="card-title">HSN</h3>

                <p align="right">

               

                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add HSN</button>

              
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



<form method="POST" action="{{url('hsninsert')}}" enctype="multipart/form-data">



@csrf



<div class="modal-dialog" role="document" style="width:80%;">



<div class="modal-content">



<div class="modal-header">



<h5 class="modal-title" id="exampleModalLabel">Add HSN</h5>



<button type="button" class="close" data-dismiss="modal" aria-label="Close">



<span aria-hidden="true">&times;</span>



</button>



</div>



<div class="modal-body row">


<div class="form-group col-sm-6">


<label class="exampleModalLabel">HSN Code</label>

<input class="form-control" name="hsncode" placeholder="Enter HSN Code" required>




</div>



<div class="form-group col-sm-6">



<label class="exampleModalLabel">Tax</label>



<input class="form-control" name="tax" placeholder="Enter tax" required>


</div>



<div class="form-group col-sm-6">


<label class="exampleModalLabel">CGST</label>



<input class="form-control" name="cgst" placeholder="Enter cgst" required>


</div>






<div class="form-group col-sm-6">



<label class="exampleModalLabel">IGST</label>




<input class="form-control" name="igst" placeholder="Enter igst" required>

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
                    <th>HSN Code</th>
                    <th>Tax</th>

                    <th>CGST</th>
                    <th>IGST</th>
                    <!-- <th>Status</th> -->
                    

					<th>Action</th>
       

                  </tr>

                  </thead>

                 
                  <tbody>
                  @php
                  $i = 1;
                  @endphp

                  @foreach($hs as $key)
    <tr>
    <td>{{ $i }}</td>
    <td>{{$key->hsncode}}</td>
        <td>{{ $key->tax }}</td>
        <td>{{ $key->cgst }}</td>
        <td>{{ $key->igst }}</td>
       

      
        <td>
            <i class="fa fa-edit edit_hsn" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>
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
                    <th>HSN Code</th>
                    <th>Tax</th>

                    <th>CGST</th>
                    <th>IGST</th>
                    <!-- <th>Status</th> -->
                  

					<th>Action</th>
      
                  </tr>

                  </tfoot>

                </table>
				




                <div class="modal" id="edithsn_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit HSN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('hsnedit')}}" enctype="multipart/form-data" name="exeedit">

@csrf
      <div class="modal-body row">


      
<input type="hidden" name="id" id="hsn_id">
<div class="form-group col-sm-6">


<label class="exampleModalLabel">HSN Code</label>

<input class="form-control" name="hsncode" id="hsncode" required>




</div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">Tax</label>



<input class="form-control" name="tax" id="tax" required>


</div>






<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">CGST</label>
                                        <input class="form-control" name="cgst" id="cgst" required>
                                     
                                    </div>


<div class="form-group col-sm-6">


<label class="exampleModalLabel">IGST</label>


<input class="form-control" name="igst" id="igst" required>


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