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

              <li class="breadcrumb-item active">Wallets</li>

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

                <h3 class="card-title">Wallets</h3>

                <p align="right">

               

                <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Brands</button> -->

              
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



                <form method="POST" action="{{url('marketproductinsert')}}" enctype="multipart/form-data">



                @csrf



                <div class="modal-dialog" role="document" style="width:80%;">



                <div class="modal-content">



                <div class="modal-header">



                <h5 class="modal-title" id="exampleModalLabel">Add Brands</h5>



                <button type="button" class="close" data-dismiss="modal" aria-label="Close">



                <span aria-hidden="true">&times;</span>



                </button>



                </div>
                <div class="modal-body row">




<div class="form-group col-sm-6">
    <label class="exampleModalLabel">Sub Category</label>
    <select name="subcategory" id="subcategory" class="form-control">
        <option value="0">Select Subcategory</option>
    </select>
</div>


<div class="form-group col-sm-12">



<label class="exampleModalLabel">Brand Name</label>



<input class="form-control" name="brand_name" placeholder="Enter Product Name" required>


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
              <form>
                   <div class="col-md-4">
                      <div class="form-group">
                        <input type="text" name="search_shop" class="form-control" id="search_shop" placeholder="Search" value="">
                      </div>
                    </div>
                </form>

                <a href="{{url('exportmarket')}}"><button type="button" class="btn btn-secondary btn-sm">Export</button></a>

                <table  class="table table-bordered table-striped" id="example354">

                  <thead>

                  <tr>

                    <th>id</th>


                    <th>Shop</th>
                    <th>Wallet Amount</th>


                    




                  </tr>

                  </thead>

                  <tbody id="non-searchshoplist">

                  @php 

                    $i=1;

                    @endphp

                    @foreach($wallet as $key)

                 

                  <tr>

                  <td>{{$i}}</td>
                    

                  <td>{{$key->shopname}}</td>

                    <td>{{$key->wallet_amount}}</td>
                  
       



</tr>



@php 



$i++;



@endphp



@endforeach



</tbody>



<tfoot>



<tr>



<th>id</th>


                    <th>Shop</th>
                    <th>Wallet Amount</th>




</tr>



</tfoot>



</table>


    


    
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
