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
                  <li class="breadcrumb-item active">Common Packages</li>
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
                     <h3 class="card-title">Exclusive Packages</h3>
                     <p align="right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Exclusive Packages</button>
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="POST" action="{{url('exclusiveinsert')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="modal-dialog" role="document" style="width:80%;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Common Packages</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body row">
                                
                                  <input type="hidden" value="2" name="package_type"> 
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
                                        <label class="exampleModalLabel">Vehicle Model</label>
                                        <select name="model" class="form-control">
                                        <option value="0">select vehicle type</option>
                                        @foreach($vehmodel as $vehmodel)
                                        <option value="{{$vehmodel->id}}">{{$vehmodel->brand_model}}</option>
                                        @endforeach
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
                             
                             
                              <th>Fuel Type</th>
                              <th>Vehicle Model</th>
                              <th>Amount</th>
                              <th>Image</th>
                              <th>Offer Amount</th>
                              <th>Action</th>
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
                              
                              <td>{{$key->fuel_type}}</td>
                              <td>{{$key->brand_model}}</td>
                              <td>{{$key->amount}}</td>
                              <td>{{$key->image}}</td>
                              <td>{{$key->offer_amount}}</td>
                              
                              <td>
                                 <i class="fa fa-edit editcompackage"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                               
                                
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
                              <th>Title</th>
                              <th>Description</th>
                             
                             
                              <th>Fuel Type</th>
                              <th>Vehicle Model</th>
                              <th>Amount</th>
                              <th>Image</th>
                              <th>Offer Amount</th>
                              <th>Action</th>
                           </tr>
                        </tfoot>
                     </table>
                     <div class="modal" id="editcompackagemodal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Edit Common Package</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <form method="POST" action="{{url('editexclusive')}}" enctype="multipart/form-data">
                                 @csrf
                                 <div class="modal-body row">
                                <input type="hidden" id="id" name="id">
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
                                        @foreach($fueltype1 as $fueltype1)
                                        <option value="{{$fueltype1->id}}">{{$fueltype1->fuel_type}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Vehicle Model</label>
                                        <select name="model" class="form-control" id="vehmodel1">
                                        <option value="0">select vehicle type</option>
                                        @foreach($vehmodel1 as $vehmodel1)
                                        <option value="{{$vehmodel1->id}}">{{$vehmodel1->brand_model}}</option>
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