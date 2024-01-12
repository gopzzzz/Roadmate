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

                  <li class="breadcrumb-item active">Services</li>

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

                     <h3 class="card-title">Shop Services</h3>

                     <p align="right">

                        <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Services</button> -->

                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                        
                           @csrf

                           <div class="modal-dialog" role="document" style="width:80%;">

                              <div class="modal-content">

                                 <div class="modal-header">

                                    <h5 class="modal-title" id="exampleModalLabel">Add Services</h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                    <span aria-hidden="true">&times;</span>

                                    </button>

                                 </div>

                                 <div class="modal-body row">


                                    

									

                                    			

                                 </div>

                                 

                              </div>

                           </div>

                        </form>

                     </div>

                  </div>

                  <!-- /.card-header -->

                  <div class="card-body">
                     <!-- <form>
                     <div class="col-md-4">
                        <div class="form-group">
                           <input type="text" name="search_shop_service" class="form-control" id="search_shop_service" placeholder="Search" value="">
                        </div>
                     </div>
                  </form> -->

                 <!-- Display shop services with pagination -->
<!-- Display shop services with pagination -->
<div class="shop-services">
    <h2></h2>
    <table class="table table-bordered table-striped" id="example1">
        <thead>
            <tr>
                <th>id</th>
                <th>Shop</th>
                <th>Contact Number</th>
                <th>Vehicles</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach($uniqueShops as $shop)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{ $shop->shopname }}</td>
                    <td>{{ $shop->phone_number }}</td>
                    
                  
<td>
    <a href="{{ url('/shop_vehicle', ['Id' => $shop->id]) }}" class="btn btn-success btn-sm shop_vehicle">Vehicle</a>
</td>




                </tr>
                @php $i++; @endphp
            @endforeach
            
        </tbody>
    </table>
</div>


<tbody id="searchshopservice">

</tbody>

<tfoot>

   <tr>

      <!-- <th>id</th>

      

      <th>Shop</th>	

      
      <th>Contact Number</th> -->
      @if($role==1)
      <!-- <th>Action</th> -->
      @endif

   </tr>

</tfoot>

</table>




    <tbody id="searchshopservice">
        <!-- Add content for search results if needed -->
    </tbody>
    <tfoot>
        <tr>
            <!-- <th>id</th>
            <th>Shop</th>
            <th>Contact Number</th>
            <th>Vehicle</th>
            <th>Service</th> -->
        </tr>
    </tfoot>
</table>

                  <!-- <div id="shopservice_pagination">
                     {!! $shopserv->render() !!} -->
                  </div>
                  <div id="shopservice_pagination1">
                    
                  </div>


                     
                              

                           </div>

                        </div>

                     </div>

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

@endsection