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

							<h3 class="card-title">Giveaway Shops</h3>

							<p align="right">

								<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Giveaway Shops</button>

								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

									<form method="POST" action="{{url('giveshopinsert')}}" enctype="multipart/form-data">@csrf

										<div class="modal-dialog" role="document" style="width:80%;">

											<div class="modal-content">

												<div class="modal-header">

													<h5 class="modal-title" id="exampleModalLabel">Giveaway Shops</h5>

													<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>

													</button>

												</div>

                                                <div class="modal-body row">

												<div class="form-group col-sm-12">

<label class="exampleModalLabel">Packages</label>

<select name="packages" class="form-control" required>

	<option value="0">Select shop</option>

	@foreach($packages as $packages)

	<option value="{{$packages->id}}">{{$packages->title}}</option>

	@endforeach



</select>

</div>



												<div class="form-group col-sm-12">

													<label class="exampleModalLabel">Shops</label>

													<!-- <select name="shop" class="form-control" required>

													    <option value="0">Select shop</option>

                                                        @foreach($shoplist as $shoplist)

														<option value="{{$shoplist->id}}">{{$shoplist->shopname}}</option>

                                                        @endforeach

													

													</select> -->
													<input type="hidden" class="form-control" name="shop" id="shopid">

													<input type="text" class="form-control searchshops" id="shopname">

													<div id="shoplist"></div>

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

										<th>Shops</th>

										<th>Packages</th>

										@if($role==1)

										<th>Action</th>

										@endif


									</tr>

								</thead>

								<tbody>@php $i=1; @endphp @foreach($shops as $shops)

									<tr>

										<td>{{$i}}</td>

                                        <td>

										{{$shops->shopname}}

										</td>
										<td>

{{$shops->title}}

</td>
@if($role==1)

<td>
<a href="{{url('deletegiveawayshops')}}/{{$shops->id}}"><i class="fa fa-trash"></i></a>

</td>

										@endif


                                       
                                     

										

									</tr>@php $i++; @endphp @endforeach</tbody>

								<tfoot>

									<tr>

										<th>id</th>

										<th>Shops</th>

										<th>Packages</th>

										@if($role==1)

										<th>Action</th>

										@endif

                                      

									</tr>

								</tfoot>

							</table>

							

							

							

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