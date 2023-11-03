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
                  <li class="breadcrumb-item active">Packages</li>
               </ol>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <style>
      @media (min-width: 576px){
      .modal-dialog {
      max-width: 1000px;
      margin: 1.75rem auto;
      }
      }
      .modal-dialog{
      width:80%;
      }
   </style>
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
                     <h3 class="card-title">Packages</h3>
                     <p align="right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Packages</button>
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="POST" action="{{url('compackageinsert')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="modal-dialog" role="document" style="width:80%;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Packages</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body row">
                                    <input type="hidden" value="1" name="package_id" id="id"> 
                                    <div class="form-group col-sm-6">
                                       <label class="exampleModalLabel">Package Type</label>
                                       <select name="package_type" class="form-control">
                                          <option value="0">Select Type</option>
                                          <option value="1">Common</option>
                                          <option value="2">Exclusive</option>
                                       </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label class="exampleModalLabel">Title</label>
                                       <input type="text" name="title" class="form-control" Placeholder="Enter Title" >
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label class="exampleModalLabel">Description</label>
                                       <textarea  name="desc" class="form-control" Placeholder="Enter Description" ></textarea>
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label class="exampleModalLabel">Fuel Type</label>
                                       <select name="fueltype" class="form-control">
                                          <option value="0">select fuel type</option>
                                          @foreach($fueltype as $fueltype)
                                          <option value="{{$fueltype->id}}">{{$fueltype->fuel_type}}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label class="exampleModalLabel">Vehicle Type</label>
                                       <select name="vehtype" class="form-control selectvehicle">
                                          <option value="0">select vehicle type</option>
                                          @foreach($vehtype as $vehtype)
                                          <option value="{{$vehtype->id}}">{{$vehtype->veh_type}}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label class="exampleModalLabel">Brand</label>
                                       <select name="vehtype" class="form-control brandmodelfetch" id="brandlist">
                                       </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label class="exampleModalLabel">Vehicle Model</label>
                                       <select name="vehmodel" class="form-control" id="modellist">
                                       </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label class="exampleModalLabel">Image</label>
                                       <input type="file" name="image" class="form-control"  >
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label class="exampleModalLabel">Amount</label>
                                       <input type="text" name="amount" class="form-control"  >
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label class="exampleModalLabel">Shop Amount</label>
                                       <input type="text" name="shopamount" class="form-control"  >
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label class="exampleModalLabel">Offer Amount</label>
                                       <input type="text" name="offeramount" class="form-control"  >
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label class="exampleModalLabel">Status</label>
                                       <select name="status" class="form-control">
                                          <option value="2">Select Status</option>
                                          <option value="1">Active</option>
                                          <option value="0">Inactive</option>
                                       </select>
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
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                     <table id="example1" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th>id</th>
                              <th>Title</th>
                              <th>Description</th>
                              <th>Vehicle Type</th>
                              <th>Fuel Type</th>
                              <th>Amount</th>
                              <th>Image</th>
                              <th>Offer Amount</th>
                              <th></th>
                              @if($role==1)<th>Action</th>@endif
                           </tr>
                        </thead>
                        <tbody>
                           @php 
                           $i=1;
                           @endphp
                           @foreach($packages as $key)
                           <tr>
                              <td>{{$i}}</td>
                              <td>{{$key->title}}</td>
                              <td>{{$key->description}}</td>
                              <td>{{$key->veh_type}}</td>
                              <td>{{$key->fuel_type}}</td>
                              <td>{{$key->amount}}</td>
                              <td>{{$key->image}}</td>
                              <td>{{$key->offer_amount}}</td>
                              <td style="width:200px;"><button type="button" class="btn btn-success btn-sm add_vehicle" data-id="{{$key->id}}">Vehicle</button>
                                 <button type="button" class="btn btn-success btn-sm addfeatures" data-id="{{$key->id}}">Features</button>
                              </td>
                              @if($role==1) <td>
                                 <!--<i class="fa fa-edit editcompackage"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>-->
                                 <i class="fa fa-edit viewcompackage"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                                 <i class="fa fa-eye editcompackage"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                                 <a href="{{url('packagedelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>
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
                              <th>Title</th>
                              <th>Description</th>
                              <th>Vehicle Type</th>
                              <th>Fuel Type</th>
                              <th>Amount</th>
                              <th>Image</th>
                              <th>Offer Amount</th>
                              <th></th>
                              @if($role==1)<th>Action</th>@endif
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
                     <div class="modal fade" id="packagefeaturemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="POST" action="{{url('packfeaturesinsert')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="modal-dialog" role="document" style="width:80%;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Fetaures</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body row">
                                    <input type="hidden"  name="packg" class="form-control" id="packagefeatureid">
                                    <div class="form-group col-sm-12">
                                       <label class="exampleModalLabel">Feature</label>
                                       <select name="feature" class="form-control">
                                          <option value="0">select Feature</option>
                                          @foreach($ftre as $key3)
                                          <option value="{{$key3->id}}">{{$key3->feature}}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                    <div class="col-sm-12">
                                    <table class="table table-bordered">
   <thead>
   <th>id</th>
   <th>Feature</th>
   @if($role==1)<th>Action</th>@endif

   </thead>
   @if($role==1) <tbody id="featurelistedit">
 
   </tbody>@endif
   </table>
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
   <div class="modal fade" id="addvehicle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <form method="POST" action="{{url('packagevehicleinsert')}}" enctype="multipart/form-data">
   @csrf
   <div class="modal-dialog" role="document" >
   <div class="modal-content">
   <div class="modal-header">
   <h5 class="modal-title" id="exampleModalLabel">Add Packages for vehicles</h5>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
   </div>
   <div class="modal-body row">
   <input type="hidden" class="form-control" name="package_type" id="packagevehid">
   <div class="form-group col-sm-3">
   <label class="exampleModalLabel">Fuel Type</label>
   <select name="fueltype" class="form-control">
   <option value="0">select fuel type</option>
   @foreach($fueltype2 as $fueltype2)
   <option value="{{$fueltype2->id}}">{{$fueltype2->fuel_type}}</option>
   @endforeach
   </select>
   </div>
   <div class="form-group col-sm-3">
   <label class="exampleModalLabel">Vehicle Type</label>
   <select name="vehtype" class="form-control selectvehicleadd" >
   <option value="0">select vehicle type</option>
   @foreach($vehtype2 as $vehtype2)
   <option value="{{$vehtype2->id}}">{{$vehtype2->veh_type}}</option>
   @endforeach
   </select>
   </div>
   <div class="form-group col-sm-3">
   <label class="exampleModalLabel">Brand</label>
   <select name="vehtype" class="form-control brandmodelfetchadd" id="brandlistadd">
   </select>
   </div>
   <div class="form-group col-sm-3">
   <label class="exampleModalLabel">Vehicle Model</label>
   <select name="vehmodel" class="form-control" id="modellistadd">
   </select>
   </div>
   <div class="col-sm-12">
   <table class="table table-bordered">
   <thead>
   <th>id</th>
   <th>Vehicle Type</th>
   <th>Model</th>
   <th>Fuel Type</th>
   @if($role==1)<th>Action</th>@endif
   </thead>
   @if($role==1)<tbody id="vehiclelist_edit">
 
   </tbody>@endif
   </table>
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
   </div>
   <!-- /.content -->
</div>
@endsection