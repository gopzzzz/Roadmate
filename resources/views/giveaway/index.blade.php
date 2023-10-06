@extends('layout.mainlayout') @section('content')
@php
  $role=Auth::user()->user_type;
  @endphp
<div class="content-wrapper">

	<!-- Content Header (Page header) -->

	<section class="content-header">

		<div class="container-fluid">

			<div class="row mb-2">

				<div class="col-sm-6"></div>

				<div class="col-sm-6">

					<ol class="breadcrumb float-sm-right">

						<li class="breadcrumb-item"><a href="#">Home</a>

						</li>

						<li class="breadcrumb-item active">Add Giveaway Package</li>

					</ol>

				</div>

			</div>

		</div>

		<!-- /.container-fluid -->

	</section>@if(session('success'))

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

							<h3 class="card-title">Add Giveaway Package</h3>

							<p align="right">

								<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Giveaway Package</button>

								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

									<form method="POST" action="{{url('giveawaypackages')}}" enctype="multipart/form-data">@csrf

										<div class="modal-dialog" role="document" style="width:80%;">

											<div class="modal-content">

												<div class="modal-header">

													<h5 class="modal-title" id="exampleModalLabel">Add Giveaway Package</h5>

													<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>

													</button>

												</div>

                                                <div class="modal-body row">

                                                <div class="form-group col-sm-6">

													<label class="exampleModalLabel">Title</label>

												<input type="text" name="tilte" class="form-control" required>

												</div>

                                                <div class="form-group col-sm-6">

													<label class="exampleModalLabel">Give away Price</label>

												<input type="text" name="price" class="form-control" required>

												</div>

                                                <div class="form-group col-sm-6">

													<label class="exampleModalLabel">Normal Price</label>

												<input type="text" name="normal" class="form-control" required>

												</div>

                                                <div class="form-group col-sm-6">

													<label class="exampleModalLabel">Description</label>

												<textarea class="form-control" name="desc" required></textarea>

												</div>

                                                <div class="form-group col-sm-6">

													<label class="exampleModalLabel">Image</label>

                                                    <input type="file" name="image" class="form-control" required>

												</div>

												<div class="form-group col-sm-6">

													<label class="exampleModalLabel">Vehicle Type</label>

													<select name="type" class="form-control" required>

													    <option value="0">Select Type</option>

                                                        @foreach($veh as $veh)

														<option value="{{$veh->id}}">{{$veh->veh_type}}</option>

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

						<!-- /.card-header -->

						<div class="card-body">

							<table id="example1" class="table table-bordered table-striped">

								<thead>

									<tr>

										<th>id</th>

										<th>Title</th>

                                        <th>Give Away Price</th>

                                        <th>Normal Price</th>

                                        <th>Description</th>

                                        <th>Image</th>

                                        <th>Vehicle Type</th>

										<th>Deleted Status</th>

										@if($role==1)

										<th>Action</th>

										@endif


									</tr>

								</thead>

								<tbody>@php $i=1; @endphp @foreach($packages as $packages)

									<tr>

										<td>{{$i}}</td>

                                        <td>

										{{$packages->title}}

										</td>

                                        <td>

										{{$packages->price}}

										</td>

                                        <td>

										{{$packages->normal_price}}

										</td>

                                        <td>

										{{$packages->description}}

										</td>

                                       

										<td>

											<img src="{{ asset('/img/'.$packages->giveaway_image) }}" alt="" width="50" />

										</td>

                                        <td>

										{{$packages->veh_type}}

										</td>

										<td>

@if($packages->deleted_status==0) Active @else Inactive @endif


 </td>

 @if($role==1)

 <td>

  <i class="fa fa-edit editgiveway"  aria-hidden="true" data-toggle="modal" data-id="{{$packages->id}}"></i>

 </td>

 @endif

										

									</tr>@php $i++; @endphp @endforeach</tbody>

								<tfoot>

									<tr>

										<th>id</th>

										<th>Title</th>

                                        <th>Give Away Price</th>

                                        <th>Normal Price</th>

                                        <th>Description</th>

                                        <th>Image</th>

                                        <th>Vehicle Type</th>

										<th>Deleted Status</th>

										@if($role==1)

										<th>Action</th>

										@endif

									</tr>

								</tfoot>

							</table>

							
							<div class="modal" id="editgiveawaypackages" tabindex="-1" role="dialog">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Give Away Package Edit</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form method="POST" action="{{url('editgiveawaypackages')}}" enctype="multipart/form-data">@csrf
										
										
											<div class="modal-body row">

										
											<div class="form-group col-sm-6">

<label class="exampleModalLabel">Title</label>

<input type="hidden" name="package_id" class="form-control"  id="package_id" required>

<input type="text" name="tilte" class="form-control"  id="title" required>

</div>

<div class="form-group col-sm-6">

<label class="exampleModalLabel">Give away Price</label>

<input type="text" name="price" class="form-control" id="price" required>

</div>

<div class="form-group col-sm-6">

<label class="exampleModalLabel">Normal Price</label>

<input type="text" name="normal" class="form-control" id="normal" required>

</div>

<div class="form-group col-sm-6">

<label class="exampleModalLabel">Description</label>

<textarea class="form-control" name="desc" id="desc" required></textarea>

</div>

<div class="form-group col-sm-6">

<label class="exampleModalLabel">Image</label>

<input type="file" name="image" class="form-control" >

</div>

<div class="form-group col-sm-6">

<label class="exampleModalLabel">Vehicle Type</label>

<select name="type" class="form-control" id="type" required>

	<option value="0">Select Type</option>

	@foreach($veh1 as $veh1)

	<option value="{{$veh1->id}}">{{$veh1->veh_type}}</option>

	@endforeach



</select>

</div>

<div class="form-group col-sm-6">

<label class="exampleModalLabel">Status</label>

<select name="status" class="form-control"  required>

	<option value="0">Active</option>



	<option value="1">In Active</option>

	


</select>

</div>

											</div>
											<div class="modal-footer">
											<button type="submit" class="btn btn-primary" >Save Changes</button>
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

</div>@endsection