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



                  <li class="breadcrumb-item active">Place</li>



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



                     <h3 class="card-title">Place</h3>



                     <p align="right">



                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Place</button>



                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



                        <form method="POST" action="{{url('placeinsert')}}" enctype="multipart/form-data">



                           @csrf



                           <div class="modal-dialog" role="document" style="width:80%;">



                              <div class="modal-content">



                                 <div class="modal-header">



                                    <h5 class="modal-title" id="exampleModalLabel">Place</h5>



                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">



                                    <span aria-hidden="true">&times;</span>



                                    </button>



                                 </div>


                                 <div class="container">
        @csrf
        <div class="modal-body row">
            <div class="form-group col-sm-12">
                <label for="country">Country</label>
                <select name="country" class="form-control statefetchadd" id="country">
                    <option value="0">Select country</option>
                    @foreach($con as $country)
                        <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-sm-12">
                <label for="state">State</label>
                <select name="state" class="form-control districtfetchadd" id="state">
                    <option value="0">Select state</option>
                </select>
            </div>

            <div class="form-group col-sm-12">
                <label for="district">District</label>
                <select name="district" class="form-control" id="district">
                    <option value="0">Select district</option>
                </select>
            </div>         
                                                                     
                                    <div class="form-group col-sm-12">

<label class="exampleModalLabel">Type</label>

<select name="type" class="form-control"  required>
<option value="0">Select Type</option>
	<option value="1">Panchayath</option>



	<option value="2">Muncipality</option>

	<option value="3">Coperatiion</option>
	


</select>

</div>									
                                    	<div class="form-group col-sm-12">      
                                     


                                        <label class="exampleModalLabel">Place</label>


                                       <input type="text"  class="form-control" name="place_name" placeholder="Enter place name" required>



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



         <th>Country</th>
         <th>State</th>
         <th>District</th>
         <th>Place</th>

         <th>Type</th>


         <th>Deleted status</th>


         @if($role==1)

         <th>Action</th>

         @endif

      </tr>



   </thead>



   <tbody>



      @php 



      $i=1;



      @endphp



      @foreach($plac as $key)



      <tr>



         <td>{{$i}}</td>

         <td>{{$key->country_name}}</td>

         <td>{{$key->state_name}}</td>

         <td>{{$key->district_name}}</td>
         <td>{{$key->place_name}}</td>
         <td>
    @if ($key->type == 1)
        Panchayath
    @elseif ($key->type == 2)
        Muncipality
    @elseif ($key->type == 3)
        Cooperation
    @else
        <!-- Handle other cases or display a default value if needed -->
    @endif
</td>







         <td>

@if($key->deleted_status==0) Active @else Inactive @endif


 </td>




         @if($role==1) <td>



            <i class="fa fa-edit edit_place"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>

           




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



         <th>Country</th>
         <th>State</th>
         <th>District</th>
         <th>Place</th>
         <th>Type</th>

         <th>Deleted status</th>


         @if($role==1)

         <th>Action</th>

         @endif

      </tr>



   </tfoot>



</table>


                


                     <div class="modal" id="editplace_modal" tabindex="-1" role="dialog">



                        <div class="modal-dialog" role="document">



                           <div class="modal-content">



                              <div class="modal-header">



                                 <h5 class="modal-title">Edit Place</h5>



                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">



                                 <span aria-hidden="true">&times;</span>



                                 </button>



                              </div>



                              <form method="POST" action="{{url('placeedit')}}" enctype="multipart/form-data">



                                 @csrf



                                 <div class="modal-body row" id="countrylist">



                                    <div class="form-group col-sm-12" >



                                       <input type="hidden" name="id" id="placeid">

                                       <div class="form-group col-sm-12">
    <label class="exampleModalLabel">Country</label>
    <select name="country" id="country_name" class="form-control countrylist">
        <option value="0">Select Country</option>
        @foreach($con as $country)
            <option value="{{ $country->id }}">{{ $country->country_name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-sm-12">
    <label class="exampleModalLabel">State</label>
    <select name="state" id="state_name" class="form-control districtfetchadd">
        <option value="0">Select State</option>
        @foreach($cond as $state)
            <option value="{{ $state->id }}">{{ $state->state_name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-sm-12">
    <label class="exampleModalLabel">District</label>
    <select name="district" id="district_name" class="form-control">
        <option value="0">Select District</option>
        @foreach($dis as $district)
            <option value="{{ $district->id }}">{{ $district->district_name }}</option>
        @endforeach
    </select>
</div>
                                        
<div class="form-group col-sm-12">

<label class="exampleModalLabel">Type</label>

<select name="type" id="type" class="form-control"  required>
<option value="0">Select Type</option>
	<option value="1">Panchayath</option>



	<option value="2">Muncipality</option>

	<option value="3">Coperatiion</option>
	


</select>

</div>				


<div>
                                       <label class="exampleModalLabel">place</label>



                                       <input type="text" class="form-control" name="place_name" id="place_name" required>


                                       <div class="form-group col-sm-12">

<label class="exampleModalLabel">Status</label>

<select name="status" id="status" class="form-control"  required>

	<option value="0">Active</option>



	<option value="1">In Active</option>

	


</select>

</div>

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