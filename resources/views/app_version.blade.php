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



                  <li class="breadcrumb-item active">App Version</li>



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



                     <h3 class="card-title">App Version</h3>



                     <p align="right">






                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">






                           @csrf



                           <div class="modal-dialog" role="document" style="width:80%;">



                              <div class="modal-content">



                                



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



		 <th>Version Code</th>
										<th>version Name</th>
                              <th>Phone Number</th>
                              <th>IOS Code</th>
                              <th>Security Code</th>
                                       <th> App Type</th>	
                                        <th>Status</th>

		

		 <th>Action</th>

		

	  </tr>



   </thead>
 



<tbody>@php $i=1; @endphp @foreach($app as $key)
                                 <tr>
                                     <td>{{$i}}</td>
                                     <td>{{$key->version_code}}</td>

                                     <td>{{$key->version_name}}</td>
                                     <td>{{$key->phone_number}}</td>
                                     <td>{{$key->ios_code}}</td>
                                     <td>{{$key->security_code}}</td>
                                     <td>@if($key->app_type==1)Customer
                                       @elseif($key->app_type==2)Partner
                                       @else Executive
                                     @endif
                                     </td>


                                     <td>

@if($key->app_status==0) Active @else Inactive @endif

<td> <i class="fa fa-edit edit_appversion" aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
</td>
                                 </tr>@php $i++; @endphp @endforeach</tbody>
                             <tfoot>



 
									<tr>
										<th>id</th>
                                        <th>Version Code</th>
										<th>version Name</th>
                              <th>Phone Number</th>                             
                              <th>IOS Code</th>
                              <th>Security Code</th>
                                       <th> App Type</th>	
                                        <th>Status</th>
									
										<th>Action</th>
										
									</tr>
								</tfoot>
							</table>
									






<div class="modal" id="editappversion_modal" tabindex="-1" role="dialog">



   <div class="modal-dialog" role="document">



	  <div class="modal-content">



		 <div class="modal-header">



			<h5 class="modal-title">Edit App Version</h5>



			<button type="button" class="close" data-dismiss="modal" aria-label="Close">



			<span aria-hidden="true">&times;</span>



			</button>



		 </div>



		 <form method="POST" action="{{url('appversionedit')}}" enctype="multipart/form-data">



			@csrf



			<div class="modal-body row">



			   <div class="form-group col-sm-12">



				  <input type="hidden" name="id" id="appid">


				  <div class="form-group col-sm-12">

				  <label class="exampleModalLabel">Version Code</label>



				  <input type="text" class="form-control" name="version_code" id="version_code" required>
				  </div>
				  <div class="form-group col-sm-12">
				  <label class="exampleModalLabel">Version Name</label>
                  <input type="text" class="form-control" name="version_name" id="version_name" required>

												</div>

                                    <div class="form-group col-sm-12">
				  <label class="exampleModalLabel">Phone Number</label>
                  <input type="text" class="form-control" name="phone_number" id="phone_number" required>

												</div>
                                    <div class="form-group col-sm-12">
				  <label class="exampleModalLabel">IOS Code</label>
                  <input type="text" class="form-control" name="ios_code" id="ios_code" required>

												</div>
                                    <div class="form-group col-sm-12">
				  <label class="exampleModalLabel">Security Code</label>
                  <input type="text" class="form-control" name="security_code" id="security_code" required>

												</div>
                                                <div class="form-group col-sm-12">
				  <label class="exampleModalLabel">App Type</label>
                  <input type="text" class="form-control" name="app_type" id="app_type" required>

												</div>

				  <div class="form-group col-sm-12">

<label class="exampleModalLabel">Status</label>

<select name="status" id="status" class="form-control" required>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function() {
    $('input[name="version_code"],input[name="app_type"]').on('keyup change', function() {
      var value = $(this).val();
      if (isNaN(value) && value !== '') {
        alert('Please enter a valid number.');
        $(this).val(''); // Clear the input if not a number
      }
    });
  });
</script>


@endsection










