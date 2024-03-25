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

              <li class="breadcrumb-item active">Sales Return</li>

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

                <h3 class="card-title">Sales Return</h3>

                <p align="right">

               


              
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">






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
         
                    <th>Sl</th>
                    <th>Order Id</th>
                    <th>Item</th>

                    <th>Quantity</th>
                    <th>Comment</th>
                    <th>Selling Rate</th>
                    <th>MRP</th>
          <th>Payment Status</th>
					<th>Payment Return Status</th>
					<th>Update Status</th>


                  </tr>
                  </thead>
        <tbody>
        @php 
           
           $i = 1;
            
       @endphp
       @foreach($sales as $key)
       <tr>
           <td>{{ $i}}</td>
           <td>{{ $key->order_id }}</td>
           <td>{{ $key->product_name }}</td>
          
           <td>{{ $key->qty }}</td>
           <td>{{ $key->comment }}</td>
           <td>{{ $key->offer_amount }}</td>
           <td>{{ $key->price }}</td>
           
           <td>      @if($key->payment_status==0) Unpaid @else Paid @endif
           </td>
           <td>  @if($key->pay_returnstatus==0) Unpaid @else Paid @endif     
           </td>
           <td> 
    <button class="btn btn-primary edit_b2creturn" data-toggle="modal" data-id="{{ $key->id }}"
            style="background: linear-gradient(45deg, #28a745, #28a745); color: #fff;">
            Update 
    </button>
</td>


</tr>
@php 
$i++;
@endphp
@endforeach

                  </tbody>

                
                  <tfoot>

                  <tr>

                  <th>Sl</th>
                    <th>Order Id</th>
                    <th>Item</th>

                    <th>Quantity</th>
                    <th>Selling Rate</th>
                    

					<th>MRP</th>
          <th>Payment Status</th>
					<th>Payment Return Status</th>
					<th>Update Status</th>

      
                  </tr>

                  </tfoot>

                </table>
				




                <div class="modal" id="editreturn_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Payment B2C Return Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('returneditb2c')}}" enctype="multipart/form-data" name="exeedit">

@csrf
      <div class="modal-body row">


      
<input type="hidden" name="id" id="return_id">

<div class="form-group col-sm-12">
                        <label class="exampleModalLabel">Payment Return Status</label>
                        <select name="return" id="return" class="form-control" required>
                      
                            <option value="0">Not Paid</option>
                            <option value="1">Paid</option>
                            
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

 






  @endsection