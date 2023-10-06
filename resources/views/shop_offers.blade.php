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
                  <li class="breadcrumb-item active">Shop Offers</li>
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
                     <h3 class="card-title">Shop Offers</h3>
                     <p align="right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Shop Offers</button>
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="POST" action="{{url('shop_offersinsert')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="modal-dialog" role="document" style="width:80%;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Shop Offers</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body row">
                                
                                  <input type="hidden" value="1" name="package_id" id="id"> 
								  <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop</label>
                                        <select name="shop" class="form-control">
                                        <option value="0">select Shop</option>
                                        @foreach($shops as $key)
                                        <option value="{{$key->id}}">{{$key->shopname}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop Category</label>
                                        <select name="cat" class="form-control">
                                        <option value="0">select Shop Category</option>
                                       @foreach($shop_cat as $key1)
                                        <option value="{{$key1->id}}">{{$key1->category}}</option>
                                        @endforeach
                                        </select>
                                    </div>
								  <div class="form-group col-sm-6">

                                           <label class="exampleModalLabel">Offer Type</label>

                                                    <select name="otype" class="form-control">

                                                     <option value="0">Select Type</option>
                                                     <option value="1">Service</option>
                                                     <option value="2">Product</option>
                                                   </select>

                                    </div>
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Vehicle Type</label>
                                       <select name="vetyp" class="form-control">
                                       <option value="0">select vehicle type</option>
                                       @foreach($vehtype as $key2)
                                       <option value="{{$key2->id}}">{{$key2->veh_type}}</option>
                                       @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Brand</label>
                                       <select name="brand" class="form-control">                                  
									   <option value="0">Select Brand</option>                            
									   @foreach($brand as $key3)                             
									   <option value="{{$key3->id}}">{{$key3->brand}}</option>              
									   @endforeach
                                      
                                       </select>
                                    </div>	
                                    <div class="form-group col-sm-6">                            
									<label class="exampleModalLabel">Model</label>               
									<select name="model" class="form-control" >                      
									<option value="0">Select Model</option>                        
									@foreach($models as $key5)                                 
									<option value="{{$key5->id}}">{{$key5->brand_model}}</option>            
									@endforeach                               
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
                                        <label class="exampleModalLabel">Image</label>
                                      <input type="file" name="image" class="form-control"  >
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Normal Amount</label>
                                      <input type="text" name="norm_amunt" class="form-control"  Placeholder="Enter Normal Amount">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Offer Amount</label>
                                      <input type="text" name="dis_amunt" class="form-control"  Placeholder="Enter Offer Amount">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">End Date</label>
                                      <input type="date" name="edate" class="form-control"  >
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
							  <th>Shop</th>
                              <th>Title</th>
                              <th>Description</th>
                             
                              <th>Normal Amount</th>
                              <th>Offer Amount</th>
                              <th>End Date</th>
                              <th>Image</th>
                              @if($role==1)
                               <th>Action</th>
                               
                              @endif
                           </tr>
                        </thead>
                        <tbody>
                           @php 
                           $i=1;
                           @endphp
                           @foreach($shopoffr as $key)
                           <tr>
                              <td>{{$i}}</td>
							  <td>{{$key->shopname}}</td>
                              <td>{{$key->title}}</td>
                              <td>{{$key->small_desc}}</td>
                              <td>{{$key->normal_amount}}</td>
                              <td>{{$key->offer_amount}}</td>
                              <td>{{$key->offer_end_date}}</td>
                              <td><img src="{{ asset('/img/'.$key->pic) }}" alt="" width="50"/></td>
                             
                              @if($role==1) <td>
                                <i class="fa fa-edit editshptoffr"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                                 <i class="fa fa-eye viewshptoffr"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                                <a href="{{url('shop_offersdelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>
                              </td>
@endif
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
                              @if($role==1)
                              <th>Action</th>
                              @endif
                           </tr>
                        </tfoot>
                     </table>
                    <div class="modal" id="viewshopoffrmodal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">View Shop Offers</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              
                                 <div class="modal-body row">
                                <input type="hidden" id="id" name="id">
								 <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop</label>
                                        <select name="shop" class="form-control" id="shop">
                                        <option value="0">select Shop</option>
                                        @foreach($shops as $key)
                                        <option value="{{$key->id}}">{{$key->shopname}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop Category</label>
                                        <select name="cat" class="form-control" id="cat">
                                        <option value="0">select Shop Category</option>
                                       @foreach($shop_cat as $key1)
                                        <option value="{{$key1->id}}">{{$key1->category}}</option>
                                        @endforeach
                                        </select>
                                    </div>
								  <div class="form-group col-sm-6">

                                           <label class="exampleModalLabel">Offer Type</label>

                                                    <select name="otype" id="otype" class="form-control">

                                                     <option value="0">Select Type</option>
                                                     <option value="1">Service</option>
                                                     <option value="2">Product</option>
                                                   </select>

                                    </div>
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Vehicle Type</label>
                                       <select name="vetyp" class="form-control" id="vetyp">
                                       <option value="0">select vehicle type</option>
                                       @foreach($vehtype as $key2)
                                       <option value="{{$key2->id}}">{{$key2->veh_type}}</option>
                                       @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Brand</label>
                                       <select name="brand" class="form-control" id="brand">                                  
									   <option value="0">Select Brand</option>                            
									   @foreach($brand as $key3)                             
									   <option value="{{$key3->id}}">{{$key3->brand}}</option>              
									   @endforeach
                                      
                                       </select>
                                    </div>	
                                    <div class="form-group col-sm-6">                            
									<label class="exampleModalLabel">Model</label>               
									<select name="model" class="form-control" id="model">                      
									<option value="0">Select Model</option>                        
									@foreach($models as $key5)                                 
									<option value="{{$key5->id}}">{{$key5->brand_model}}</option>            
									@endforeach                               
									</select>                           
									</div>				

                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Title</label>
                                      <input type="text" name="title" class="form-control" id="title" Placeholder="Enter Title" >
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Description</label>
                                      <textarea  name="desc" class="form-control" Placeholder="Enter Description" id="desc"></textarea>
                                    </div>
                                
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Normal Amount</label>
                                      <input type="text" name="norm_amunt" class="form-control"  id="norm_amunt">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Discount Amount</label>
                                      <input type="text" name="dis_amunt" class="form-control"  id="dis_amunt">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">End Date</label>
                                      <input type="date" name="edate" class="form-control" id="edate" >
                                    </div>
                                 <div class="modal-footer">
                                   
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 </div>
                             
                           </div>
                        </div>
                     </div>
                  </div>
				  <div class="modal" id="editshopoffrmodal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Edit Shop Offers</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                             <form method="POST" action="{{url('shop_offersedit')}}" enctype="multipart/form-data">
                                 @csrf
                                 <div class="modal-body row">
                                 <input type="hidden" name="id" id="edit_id" class="form-control" >
								 <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop</label>
                                        <select name="shop" class="form-control" id="shop1">
                                        <option value="0">select Shop</option>
                                        @foreach($shops as $key)
                                        <option value="{{$key->id}}">{{$key->shopname}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Shop Category</label>
                                        <select name="cat" class="form-control" id="cat1">
                                        <option value="0">select Shop Category</option>
                                       @foreach($shop_cat as $key1)
                                        <option value="{{$key1->id}}">{{$key1->category}}</option>
                                        @endforeach
                                        </select>
                                    </div>
								  <div class="form-group col-sm-6">

                                           <label class="exampleModalLabel">Offer Type</label>

                                                    <select name="otype" id="otype1" class="form-control">

                                                     <option value="0">Select Type</option>
                                                     <option value="1">Service</option>
                                                     <option value="2">Product</option>
                                                   </select>

                                    </div>
									<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Vehicle Type</label>
                                       <select name="vetyp" class="form-control" id="vetyp1">
                                       <option value="0">select vehicle type</option>
                                       @foreach($vehtype as $key2)
                                       <option value="{{$key2->id}}">{{$key2->veh_type}}</option>
                                       @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Brand</label>
                                       <select name="brand" class="form-control" id="brand1">                                  
									   <option value="0">Select Brand</option>                            
									   @foreach($brand as $key3)                             
									   <option value="{{$key3->id}}">{{$key3->brand}}</option>              
									   @endforeach
                                      
                                       </select>
                                    </div>	
                                    <div class="form-group col-sm-6">                            
									<label class="exampleModalLabel">Model</label>               
									<select name="model" class="form-control" id="model1">                      
									<option value="0">Select Model</option>                        
									@foreach($models as $key5)                                 
									<option value="{{$key5->id}}">{{$key5->brand_model}}</option>            
									@endforeach                               
									</select>                           
									</div>				

                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Title</label>
                                      <input type="text" name="title" class="form-control" id="title1" Placeholder="Enter Title" >
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Description</label>
                                      <textarea  name="desc" class="form-control" Placeholder="Enter Description" id="desc1"></textarea>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Image</label>
                                      <input type="file" name="image" class="form-control"  >
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Normal Amount</label>
                                      <input type="text" name="norm_amunt" class="form-control"  id="norm_amunt1">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Discount Amount</label>
                                      <input type="text" name="dis_amunt" class="form-control"  id="dis_amunt1">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">End Date</label>
                                      <input type="date" name="edate" class="form-control" id="edate1" >
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