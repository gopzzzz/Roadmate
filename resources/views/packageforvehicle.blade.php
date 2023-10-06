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

                  <li class="breadcrumb-item"><a href="#">Home</a></li>

                  <li class="breadcrumb-item active">Packages for vehicles</li>

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

                     <h3 class="card-title">Packages for vehicles</h3>

                     <p align="right">

                     
                     

                  <!-- /.card-header -->

                  <div class="card-body">

                     <table id="example1" class="table table-bordered table-striped">

                        <thead>

                           <tr>

                              <th>id</th>

                              <th>Package</th>

                              <th>Vehicle Type</th>

                              <th>Model</th>

                              <th>Fuel Type</th>


                              <th>Action</th>

                           </tr>

                        </thead>

                        <tbody>

                           @php 

                           $i=1;

                           @endphp

                           @foreach($packageveh as $key)

                           <tr>

                              <td>{{$i}}</td>

                              <td>{{$key->title}}</td>

                              <td>{{$key->veh_type}}</td>

                              <td>{{$key->brand_model}}</td>

                              <td>{{$key->fuel_type}}</td>

                            

                              

                              <td>

                                 <!--<i class="fa fa-edit editcompackage"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>-->

								 <i class="fa fa-edit "  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>

                                 <i class="fa fa-eye "  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>

								 

                                <a href="{{url('packagedelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>

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

                              <th>Package</th>

                              <th>Vehicle Type</th>

                              <th>Model</th>

                              <th>Fuel Type</th>

                              

                              <th>Action</th>

                           </tr>

                        </tfoot>

                     </table>

                     <div class="modal" id="editcompackagemodal" tabindex="-1" role="dialog">

                        <div class="modal-dialog" role="document">

                           <div class="modal-content">

                              <div class="modal-header">

                                 <h5 class="modal-title">View Package</h5>

                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                 <span aria-hidden="true">&times;</span>

                                 </button>

                              </div>

                              

                                 <div class="modal-body row">

                                <input type="hidden" id="id" name="id">

								 <div class="form-group col-sm-6">







                                           <label class="exampleModalLabel">Package Type</label>







                                                    <select name="package_type" class="form-control" id="pack_type">



                                                     <option value="0">Select Type</option>

                                                     <option value="1">Common</option>

                                                     <option value="2">Exclusive</option>

                                                   </select>





                                    </div>

                                 <div class="form-group col-sm-6">

                                        <label class="exampleModalLabel">Title</label>

                                      <input type="text" name="title" class="form-control" id="title" >

                                    </div>

                                    <div class="form-group col-sm-6">

                                        <label class="exampleModalLabel">Description</label>

                                      <textarea  name="desc" class="form-control" id="description" ></textarea>

                                    </div>

                                    <div class="form-group col-sm-6">

                                        <label class="exampleModalLabel">Fuel Type</label>

                                        <select name="fueltype" id="fuelid" class="form-control">

                                        <option value="0">select fuel type</option>

                                        @foreach($fueltype1 as $key4)

                                        <option value="{{$key4->id}}">{{$key4->fuel_type}}</option>

                                        @endforeach

                                        </select>

                                    </div>

                                    <div class="form-group col-sm-6">

                                        <label class="exampleModalLabel">Vehicle Type</label>

                                        <select name="vehtype" id="vehid" class="form-control">

                                        <option value="0">select vehicle type</option>

                                        @foreach($vehtype1 as $key5)

                                        <option value="{{$key5->id}}">{{$key5->veh_type}}</option>

                                        @endforeach

                                        </select>

                                    </div>

									<div class="form-group col-sm-6">

                                        <label class="exampleModalLabel">Vehicle Model</label>

                                        <select name="vehmodel" class="form-control" id="vehmodel1">

                                        <option value="0">select vehicle model</option>

                                        @foreach($vehmodel as $key1)

                                        <option value="{{$key1->id}}">{{$key1->brand_model}}</option>

                                        @endforeach

                                        </select>

                                    </div>

                                    <div class="form-group col-sm-6">

                                        <label class="exampleModalLabel">Image</label>

                                      <input type="file" name="image" class="form-control"  >

                                    </div>

                                    <div class="form-group col-sm-6">

                                        <label class="exampleModalLabel">Amount</label>

                                      <input type="text" id="amount" name="amount" class="form-control"  >

                                    </div>

                                    <div class="form-group col-sm-6">

                                        <label class="exampleModalLabel">Shop Amount</label>

                                      <input type="text" id="shopamount" name="shopamount" class="form-control"  >

                                    </div>

                                    <div class="form-group col-sm-6">

                                        <label class="exampleModalLabel">Offer Amount</label>

                                      <input type="text" id="offeramount" name="offeramount" class="form-control"  >

                                    </div>

									<div class="form-group col-sm-6">







                                           <label class="exampleModalLabel">Status</label>







                                                    <select name="status" id="status" class="form-control">



                                                     <option value="2">Select Status</option>

                                                     <option value="1">Active</option>

                                                     <option value="0">Inactive</option>

                                                   </select>





                                    </div>

                                 <div class="modal-footer">

                                    

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                 </div>

                              

                           </div>

                        </div>

                     </div>

                  </div>

				  <div class="modal" id="viewcompackagemodal" tabindex="-1" role="dialog">

                        <div class="modal-dialog" role="document">

                           <div class="modal-content">

                              <div class="modal-header">

                                 <h5 class="modal-title">Edit Package</h5>

                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                 <span aria-hidden="true">&times;</span>

                                 </button>

                              </div>

                              <form method="POST" action="{{url('editcompackage')}}" enctype="multipart/form-data">



                                 @csrf

                                 <div class="modal-body row">

                                <input type="hidden" id="edit_id" name="id">

								 <div class="form-group col-sm-6">







                                           <label class="exampleModalLabel">Package Type</label>







                                                    <select name="package_type" class="form-control" id="pack_type1">



                                                     <option value="0">Select Type</option>

                                                     <option value="1">Common</option>

                                                     <option value="2">Exclusive</option>

                                                   </select>





                                    </div>

                                 <div class="form-group col-sm-6">

                                        <label class="exampleModalLabel">Title</label>

                                      <input type="text" name="title" class="form-control" id="title1" >

                                    </div>

                                    <div class="form-group col-sm-6">

                                        <label class="exampleModalLabel">Description</label>

                                      <textarea  name="desc" class="form-control" id="description1" ></textarea>

                                    </div>

                                    <div class="form-group col-sm-6">

                                        <label class="exampleModalLabel">Fuel Type</label>

                                        <select name="fueltype" id="fuelid1" class="form-control">

                                        <option value="0">select fuel type</option>

                                        @foreach($fueltype1 as $key4)

                                        <option value="{{$key4->id}}">{{$key4->fuel_type}}</option>

                                        @endforeach

                                        </select>

                                    </div>

                                    <div class="form-group col-sm-6">

                                        <label class="exampleModalLabel">Vehicle Type</label>

                                        <select name="vehtype" id="vehid1" class="form-control">

                                        <option value="0">select vehicle type</option>

                                        @foreach($vehtype1 as $key5)

                                        <option value="{{$key5->id}}">{{$key5->veh_type}}</option>

                                        @endforeach

                                        </select>

                                    </div>

									<div class="form-group col-sm-6">

                                        <label class="exampleModalLabel">Vehicle Model</label>

                                        <select name="vehmodel" class="form-control" id="vehmodel2">

                                        <option value="0">select vehicle model</option>

                                        @foreach($vehmodel as $key1)

                                        <option value="{{$key1->id}}">{{$key1->brand_model}}</option>

                                        @endforeach

                                        </select>

                                    </div>

                                    <div class="form-group col-sm-6">

                                        <label class="exampleModalLabel">Image</label>

                                      <input type="file" name="image" class="form-control"  >

                                    </div>

                                    <div class="form-group col-sm-6">

                                        <label class="exampleModalLabel">Amount</label>

                                      <input type="text" id="amount1" name="amount" class="form-control"  >

                                    </div>

                                    <div class="form-group col-sm-6">

                                        <label class="exampleModalLabel">Shop Amount</label>

                                      <input type="text" id="shopamount1" name="shopamount" class="form-control"  >

                                    </div>

                                    <div class="form-group col-sm-6">

                                        <label class="exampleModalLabel">Offer Amount</label>

                                      <input type="text" id="offeramount1" name="offeramount" class="form-control"  >

                                    </div>

									<div class="form-group col-sm-6">







                                           <label class="exampleModalLabel">Status</label>







                                                    <select name="status" id="status1" class="form-control">



                                                     <option value="2">Select Status</option>

                                                     <option value="1">Active</option>

                                                     <option value="0">Inactive</option>

                                                   </select>





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