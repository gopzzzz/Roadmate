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



                  <li class="breadcrumb-item active">District</li>



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



                     <h3 class="card-title">District</h3>



                     <p align="right">



                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add District</button>



                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



                        <form method="POST" action="{{url('districtinsert')}}" enctype="multipart/form-data">



                           @csrf



                           <div class="modal-dialog" role="document" style="width:80%;">



                              <div class="modal-content">



                                 <div class="modal-header">



                                    <h5 class="modal-title" id="exampleModalLabel">District</h5>



                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">



                                    <span aria-hidden="true">&times;</span>



                                    </button>



                                 </div>



                                 <div class="modal-body row">


                                 <div class="form-group col-sm-12">
    <label class="exampleModalLabel">Country</label>
    <select name="country" class="form-control statefetchadd" id="country">
        <option value="0">Select country</option>
        @foreach($con as $country)
            <option value="{{$country->id}}">{{$country->country_name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-12">
    <label class="exampleModalLabel">State</label>
    <select name="state" class="form-control" id="state">
        <option value="0">Select state</option>
    </select>
</div>
						<div class="form-group col-sm-12">      
                                     



                                    <label class="exampleModalLabel">District</label>

                                       <input type="text"  class="form-control" name="district_name" placeholder="Enter district name" required>



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

         <th>Deleted status</th>


        

         <th>Action</th>

       

      </tr>



   </thead>



   <tbody>



      @php 



      $i=1;



      @endphp



      @foreach($conde as $key)



      <tr>



         <td>{{$i}}</td>


         <td>{{$key->country_name}}</td>

         <td>{{$key->state_name}}</td>
         <td>{{$key->district_name}}</td>
       

         <td>

@if($key->deleted_status==0) Active @else Inactive @endif






 </td>



        <td>



            <i class="fa fa-edit edit_district"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>

           




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



         <th>Country</th>
         <th>State</th>
         <th>District</th>

         <th>Deleted status</th>


        

         <th>Action</th>

       

      </tr>



   </tfoot>



</table>


                


                     <div class="modal" id="editdistrict_modal" tabindex="-1" role="dialog">



                        <div class="modal-dialog" role="document">



                           <div class="modal-content">



                              <div class="modal-header">



                                 <h5 class="modal-title">Edit District</h5>



                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">



                                 <span aria-hidden="true">&times;</span>



                                 </button>



                              </div>



                              <form method="POST" action="{{url('districtedit')}}" enctype="multipart/form-data">



                                 @csrf



                                 <div class="modal-body row" id="countrylist">



                                    <div class="form-group col-sm-12">



                                       <input type="hidden" name="id" id="districtid">


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


                                       <label class="exampleModalLabel">Districts</label>



                                       <input type="text" class="form-control" name="district_name" id="district_name" required>
</div>

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