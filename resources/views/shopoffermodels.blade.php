@extends('layout.mainlayout')

@section('content')

<div class="content-wrapper">

   <section class="content-header">

      <div class="container-fluid">

         <div class="row mb-2">

            <div class="col-sm-6">

            </div>

            <div class="col-sm-6">

               <ol class="breadcrumb float-sm-right">

                  <li class="breadcrumb-item"><a href="home">Home</a></li>

                  <li class="breadcrumb-item active">Offer Models</li>

               </ol>

            </div>

         </div>

      </div>

   </section>

   @if(session('success'))

   <h3 style="margin-left: 19px;color: green;">{{session('success')}}</h3>

   @endif

   <section class="content">

      <div class="container-fluid">

         <div class="row">

            <div class="col-12">

               <div class="card">

                  <div class="card-header">

                     <h3 class="card-title">Offer Models</h3>

                     <p align="right">

                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Offer Models</button>
                        <!-- <a href="{{url('exportshopoffermodel')}}"><button type="button" class="btn btn-secondary btn-sm">Export</button></a> -->

                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <form method="POST" action="{{url('shopoffermodelsinsert')}}">

                           @csrf

                           <div class="modal-dialog" role="document" style="width:80%;">

                              <div class="modal-content">

                                 <div class="modal-header">

                                    <h5 class="modal-title" id="exampleModalLabel">Add Offer Models</h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                    <span aria-hidden="true">&times;</span>

                                    </button>

                                 </div>

                                 <div class="modal-body row">

                                    <div class="form-group col-sm-12">

                                        <label class="exampleModalLabel">Shop</label>

                                        <select name="shop" class="form-control">

                                        <option value="0">select Shop</option>

                                        @foreach($shops as $key)

                                        <option value="{{$key->id}}">{{$key->shopname}}</option>

                                        @endforeach

                                        </select>

                                    </div>

									<div class="form-group col-sm-12">

                                        <label class="exampleModalLabel">Vehicle Type</label>

                                       <select name="vehtyp" class="form-control">

                                       <option value="0">select vehicle type</option>

                                       @foreach($vehtype as $key2)

                                       <option value="{{$key2->id}}">{{$key2->veh_type}}</option>

                                       @endforeach

                                       </select>

                                    </div>

                                    <div class="form-group col-sm-12">

                                        <label class="exampleModalLabel">Brand</label>

                                       <select name="brand" class="form-control">                                  

									   <option value="0">Select Brand</option>                            

									   @foreach($brand as $key3)                             

									   <option value="{{$key3->id}}">{{$key3->brand}}</option>              

									   @endforeach
                                    </select>

                                    </div>								

									<div class="form-group col-sm-12">                            

									<label class="exampleModalLabel">Model</label>               

									<select name="model" class="form-control" >                      

									<option value="0">Select Model</option>                        

									@foreach($models as $key5)                                 

									<option value="{{$key5->id}}">{{$key5->brand_model}}</option>            

									@endforeach                               

									</select>                           

									</div>

                                    <div class="form-group col-sm-12">                            

									<label class="exampleModalLabel">Offers</label>               

									<select name="offr" class="form-control">
                                    <option value="0">Select Offers</option>
                                    @foreach($shopoffr as $key4)
                                        <option value="{{$key4->id}}">{{$key4->title}}</option>
                                    @endforeach
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
   
                  <div class="card-body">

                     <table id="example354" class="table table-bordered table-striped">

                        <thead>

                           <tr>

                              <th>id</th>

                              <th>Shop</th>	

                              <th>Vehicle Type</th>							  
							  <th>Brand</th>
                              <th>Model</th>

                              <th>Offer</th>
                              @if($role==1)
                              <th>Action</th>
                              @endif
                           </tr>

                        </thead>

                        <tbody>

                           @php 

                           $i=1;

                           @endphp

                           @foreach($offrmodl as $key)

                           <tr>

                              <td>{{$i}}</td>

							        <td>{{$key->shopname}}</td>

                             <td>{{$key->veh_type}}</td>

                              <td>{{$key->brand}}</td>

                               <td>{{$key->brand_model}}</td>

							   <td>{{$key->title}}</td>

                        @if($role==1) <td>

                                <i class="fa fa-edit editoffrmodel"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>

                                 <i class="fa fa-eye viewoffrmodel"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>

								  <a href="{{url('shopoffermodelsdelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>

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

                              <th>Shop</th>	

                              <th>Vehicle Type</th>							  

							  <th>Brand</th>

                              <th>Model</th>

                              <th>Offer</th>
                              @if($role==1)
                              <th>Action</th>
                              @endif
                           </tr>

                        </tfoot>

                     </table>
                     <div class="clearfix">
                     
    {!! $offrmodl->render( "pagination::bootstrap-4") !!}

</div>
                     <div class="modal" id="viewoffrmodl_modal" tabindex="-1" role="dialog">

                        <div class="modal-dialog" role="document">

                           <div class="modal-content">

                              <div class="modal-header">

                                 <h5 class="modal-title">View Offer Models</h5>

                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                 <span aria-hidden="true">&times;</span>

                                 </button>

                              </div>

                                 <div class="modal-body row">

                                 <input type="hidden" name="id" id="offrmdlview_id" class="form-control" >

								<div class="form-group col-sm-12">

                                        <label class="exampleModalLabel">Shop</label>

                                        <select name="shop" class="form-control" id="shop">

                                        <option value="0">select Shop</option>

                                        @foreach($shops as $key)

                                        <option value="{{$key->id}}">{{$key->shopname}}</option>

                                        @endforeach

                                        </select>

                                    </div>

								 <div class="form-group col-sm-12">

                                       <input type="hidden" name="id" id="vehid_edit">

                                       <label class="exampleModalLabel">Vehicle Type</label>

                                       <select name="vehtype" class="form-control" id="vehtype_view">

                                       <option value="0">select vehicle type</option>

                                       @foreach($vehtype as $key4)

                                       <option value="{{$key4->id}}">{{$key4->veh_type}}</option>

                                       @endforeach

                                       </select>

                                    </div>

                                 <div class="form-group col-sm-12">                

								 <label class="exampleModalLabel">Brand</label>             

								 <select name="brand_edit" class="form-control" id="brand">            

								 <option value="0">Select Brand</option>                        

								 @foreach($brand as $key)                           

								 <option value="{{$key->id}}">{{$key->brand}}</option>             

								 @endforeach                                                   

								 </select>                   

								 </div>						

								  <div class="form-group col-sm-12">                            

									<label class="exampleModalLabel">Model</label>               

									<select name="model" class="form-control" id="model">                      

									<option value="0">Select Model</option>                        

									@foreach($models as $key5)                                 

									<option value="{{$key5->id}}">{{$key5->brand_model}}</option>            

									@endforeach                               

									</select>                           

									</div>                

								 <div class="form-group col-sm-12">                  

								 <label class="exampleModalLabel">Offer</label>                

								 <select name="offr" class="form-control" id="offr">              

								 <option value="0">Select Offer</option>                    

								 @foreach($shopoffr as $fuel)                                

								 <option value="{{$fuel->id}}">{{$fuel->title}}</option>             

								 @endforeach                              

								 </select>                        

								 </div> 

                                 <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                 </div>
                           </div>

                        </div>

                     </div>

                  </div>

                  <div class="modal" id="editoffrmodl_modal" tabindex="-1" role="dialog">

                        <div class="modal-dialog" role="document">

                           <div class="modal-content">

                              <div class="modal-header">

                                 <h5 class="modal-title">Edit Offer Models</h5>

                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                 <span aria-hidden="true">&times;</span>

                                 </button>

                              </div>

                             <form method="POST" action="{{url('shopoffermodels_edit')}}" enctype="multipart/form-data">

                                 @csrf

                                 <div class="modal-body row">

                                 <input type="hidden" name="id" id="edit_id" class="form-control" >

								<div class="form-group col-sm-12">

                                        <label class="exampleModalLabel">Shop</label>

                                        <select name="shop" class="form-control" id="shop1">

                                        <option value="0">select Shop</option>

                                        @foreach($shops as $key)

                                        <option value="{{$key->id}}">{{$key->shopname}}</option>

                                        @endforeach

                                        </select>

                                    </div>

								 <div class="form-group col-sm-12">

                                       <label class="exampleModalLabel">Vehicle Type</label>

                                       <select name="vehtype" class="form-control" id="vehtype_view1">

                                       <option value="0">select vehicle type</option>

                                       @foreach($vehtype as $key4)

                                       <option value="{{$key4->id}}">{{$key4->veh_type}}</option>

                                       @endforeach

                                       </select>

                                    </div>

                                 <div class="form-group col-sm-12">                

								 <label class="exampleModalLabel">Brand</label>             

								 <select name="brand" class="form-control" id="brand1">            

								 <option value="0">Select Brand</option>                        

								 @foreach($brand as $key)                           

								 <option value="{{$key->id}}">{{$key->brand}}</option>             

								 @endforeach                                                   

								 </select>                   

								 </div>						

								  <div class="form-group col-sm-12">                            

									<label class="exampleModalLabel">Model</label>               

									<select name="model" class="form-control" id="model1">                      

									<option value="0">Select Model</option>                        

									@foreach($models as $key5)                                 

									<option value="{{$key5->id}}">{{$key5->brand_model}}</option>            

									@endforeach                               

									</select>                           

									</div>                

								 <div class="form-group col-sm-12">                  

								 <label class="exampleModalLabel">Offer</label>                

								 <select name="offr" class="form-control" id="offr1">              

								 <option value="0">Select Offer</option>                    

								 @foreach($shopoffr as $fuel)                                

								 <option value="{{$fuel->id}}">{{$fuel->title}}</option>             

								 @endforeach                              

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

               </div>

            </div>

         </div>

      </div>

   </section>

</div>

@endsection