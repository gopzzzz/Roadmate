@extends('layout.mainlayout') @section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6"></div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="home">Home</a>
						</li>
						<li class="breadcrumb-item active">Add Banner</li>
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
							<h3 class="card-title">Add Banner</h3>

							<form method="POST" action="{{url('imagecompress')}}" enctype="multipart/form-data">@csrf
									<input type="file" name="image[]" multiple>	<button type="submit" name="submit" class="btn btn-primary">Add</button>
</form>
							<p align="right">
								<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Banner</button>
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								
								
								
								<form method="POST" action="{{url('bannerinsert')}}" enctype="multipart/form-data">@csrf
										<div class="modal-dialog" role="document" style="width:80%;">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Add Banner</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="form-group col-sm-6">
													<label class="exampleModalLabel">Banner Type</label>
													<select name="type" class="form-control">
													    <option value="0">Select Type</option>
														<option value="1">Customer</option>
														<option value="2">Shop</option>
														<option value="3">Package</option>
														<option value="4">Store</option>
													</select>
												</div>
												<div class="modal-body row">
													<div class="form-group col-sm-6">
														<label class="exampleModalLabel">Image</label>
														<input type="file" name="bannerimage" accept="image/*" required>
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
										<th>Image</th>
										@if($role==1)
										<th>Action</th>
										@endif
									</tr>
								</thead>
								<tbody>@php $i=1; @endphp @foreach($banner as $key)
									<tr>
										<td>{{$i}}</td>
										<td>
										<img src="{{ asset('img/'.$key->banner_image) }}" alt="" width="200" height="100" />

											<!-- <img src="{{ asset('/uploads/banner/'.$key->banner_image) }}" alt="" width="50" /> -->
										</td>
										@if($role==1)<td> <i class="fa fa-edit edit_banner" aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
										<i class="fa fa-eye view_banner" aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
											<a href="{{url('bannerdelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>
										</td>@endif
									</tr>@php $i++; @endphp @endforeach</tbody>
								<tfoot>
									<tr>
										<th>id</th>
										<th>Image</th>
										@if($role==1)
										<th>Action</th>
										@endif
									</tr>
								</tfoot>
							</table>
							
							<div class="modal" id="editbanner_modal" tabindex="-1" role="dialog">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Banner</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form method="POST" action="{{url('banneredit')}}" enctype="multipart/form-data">@csrf
											<div class="modal-body row">
											<div class="form-group col-sm-6">
													<label class="exampleModalLabel">Banner Type</label>
													<select name="type1" class="form-control" id="bannertype">
													    <option value="0">Select Type</option>
														<option value="1">Customer</option>
														<option value="2">Shop</option>
														<option value="3">Package</option>
														<option value="4">Store</option>
													</select>
												</div>
												<div class="form-group col-sm-6">
													<input type="hidden" name="id" id="bannerid">
													<label class="exampleModalLabel">Image</label>
													<input type="file" name="bannerimage" accept="image/*" id="bannerimage" required>
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
							<div class="modal" id="viewbanner_modal" tabindex="-1" role="dialog">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">View Banner</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
											</button>
										</div>
										
											<div class="modal-body row">
											<div class="form-group col-sm-6">
													<label class="exampleModalLabel">Banner Type</label>
													<select name="type1" class="form-control" id="bannertype1">
													    <option value="0">Select Type</option>
														<option value="1">Customer</option>
														<option value="2">Shop</option>
														<option value="3">Package</option>
														<option value="4">Store</option>
													</select>
												</div>
												<div class="form-group col-sm-6">
													<input type="hidden" name="id" id="bannerid">
													<label class="exampleModalLabel">Image</label>
													<input type="file" name="bannerimage" accept="image/*" id="bannerimage1" required>
													<img src="" alt="" width="50" accept="image/*" id="bannerimage1"/>
												</div>
											</div>
											<div class="modal-footer">
	
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
										
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