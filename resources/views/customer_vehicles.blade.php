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
                  <li class="breadcrumb-item active">Customers Vehicle</li>
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
                     <h3 class="card-title">Customers Vehicles</h3>
                     <p align="right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Customers Vehicle</button>
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="POST" action="{{url('uservehcleinsert')}}">
                           @csrf
                           <div class="modal-dialog" role="document" style="width:80%;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Customers Vehicles</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body row">
                                    <div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Customer</label>
                                        <select name="cust" class="form-control">
                                        <option value="0">select Customer</option>
                                        @foreach($custmr1 as $key1)
                                        <option value="{{$key1->id}}">{{$key1->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									<div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Vehicle Type</label>
                                       <select name="vehtype" class="form-control">
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
									<label class="exampleModalLabel">Fuel Type</label>               
									<select name="fuel" class="form-control" >                      
									<option value="0">Select Fuel type</option>                        
									@foreach($fuel as $key4)                                 
									<option value="{{$key4->id}}">{{$key4->fuel_type}}</option>            
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
                                        <label class="exampleModalLabel">Vehicle Number</label>
                                      <input type="text" name="vehnum" class="form-control" >
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
                              <th>Customer</th>	
                              <th>Vehicle Type</th>							  
                              <th>Fuel Type</th>
							  <th>Brand</th>
                              <th>Model</th>
                              <th>Vehicle No.</th>
                              @if($role==1)<th>Action</th>
@endif
                           </tr>
                        </thead>
                        <tbody>
                           @php 
                           $i=1;
                           @endphp
                           @foreach($usrvehcl as $key)
                           <tr>
                              <td>{{$i}}</td>
							  <td>{{$key->name}}</td>
							  <td>{{$key->veh_type}}</td>
							  <td>{{$key->fuel_type}}</td>
                              <td>{{$key->brand}}</td>
                               <td>{{$key->brand_model}}</td>
							   <td>{{$key->vehicle_number}}</td>
                        @if($role==1)<td>
                                <i class="fa fa-edit editcustvehcl"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                                 <i class="fa fa-eye viewcustvehcl"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
								 <a href="{{url('uservehcledelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>
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
                              <th>Customer</th>	
                              <th>Vehicle Type</th>							  
                              <th>Fuel Type</th>
							  <th>Brand</th>
                              <th>Model</th>
                              <th>Vehicle No.</th>
                              @if($role==1)<th>Action</th>@endif
                           </tr>
                        </tfoot>
                     </table>
                     <div class="modal" id="editcustvehl_modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Edit Customers Vehicle</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                             <form method="POST" action="{{url('uservehcleedit')}}" enctype="multipart/form-data">
                                 @csrf
                                 <div class="modal-body row">
                                 <input type="hidden" name="id" id="custvehedit_id" class="form-control" >
								 <div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Customer</label>
                                        <select name="cust" class="form-control" id="cust1">
                                        <option value="0">select Customer</option>
                                        @foreach($custmr1 as $key3)
                                        <option value="{{$key3->id}}">{{$key3->name}}</option>
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
								 <label class="exampleModalLabel">Fuel Type</label>                
								 <select name="fuel_edit" class="form-control" id="fuel_type1">              
								 <option value="0">Select Fuel type</option>                    
								 @foreach($fuel as $key9)                                
								 <option value="{{$key9->id}}">{{$key9->fuel_type}}</option>             
								 @endforeach                              
								 </select>                        
								 </div>    
                                 <div class="form-group col-sm-12">                
								 <label class="exampleModalLabel">Brand</label>             
								 <select name="brand_edit" class="form-control" id="brand1">            
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
								 <label class="exampleModalLabel">Vehicle Number</label>                     
								 <input type="text" name="veh_num" class="form-control" id="veh_num1">       
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
                 <div class="modal" id="viewcustvehl_modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">View Customers Vehicle</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                             
                                 <div class="modal-body row">
                                 <input type="hidden" name="id" id="custvehview_id" class="form-control" >
								 <div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Customer</label>
                                        <select name="cust" class="form-control" id="cust">
                                        <option value="0">select Customer</option>
                                        @foreach($custmr1 as $key3)
                                        <option value="{{$key3->id}}">{{$key3->name}}</option>
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
								 <label class="exampleModalLabel">Fuel Type</label>                
								 <select name="fuel_edit" class="form-control" id="fuel_type">              
								 <option value="0">Select Fuel type</option>                    
								 @foreach($fuel as $key9)                                
								 <option value="{{$key9->id}}">{{$key9->fuel_type}}</option>             
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
								 <label class="exampleModalLabel">Vehicle Number</label>                     
								 <input type="text" name="model_edit" class="form-control" id="veh_num">       
								 </div>
                                 <div class="modal-footer">
                                   
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