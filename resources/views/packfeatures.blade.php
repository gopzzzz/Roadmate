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
						<li class="breadcrumb-item active">Fetaures</li>
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
							<h3 class="card-title">Add Fetaures</h3>
							<p align="right">
						
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>id</th>
										<th>Package</th>
										<th>Fetaures</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>@php $i=1; @endphp @foreach($feature as $key4)
									<tr>
										<td>{{$i}}</td>
										<td>{{$key4->title}}</td>
										<td>{{$key4->featuredel}}</td>
										<td> <i class="fa fa-edit editfeature" aria-hidden="true" data-toggle="modal" data-id="{{$key4->id}}"></i>
											<i class="fa fa-eye viewfeature" aria-hidden="true" data-toggle="modal" data-id="{{$key4->id}}"></i>
										    <a href="{{url('packfeaturesdelete')}}/{{ $key4->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key4->id}}"></i></a>
										</td>
									</tr>@php $i++; @endphp @endforeach</tbody>
								<tfoot>
									<tr>
										<th>id</th>
										<th>Package</th>
										<th>Fetaures</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
							<div class="modal" id="editfeaturemodal" tabindex="-1" role="dialog">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Feature</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form method="POST" action="{{url('editpackfeatures')}}" enctype="multipart/form-data">@csrf
											<div class="modal-body row">
												<input type="hidden" name="id" class="form-control" id="id">
												<div class="form-group col-sm-12">
													<label class="exampleModalLabel">Package</label>
													<select name="packg" class="form-control" id="package1">
														<option value="0">select package</option>@foreach($com1 as $key2)
														<option value="{{$key2->id}}">{{$key2->title}}</option>@endforeach</select>
												</div>
												<div class="form-group col-sm-12">
													<label class="exampleModalLabel">Feature</label>
													<input type="text" name="feature" class="form-control" id="feature1">
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
							<div class="modal" id="viewfeaturemodal" tabindex="-1" role="dialog">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">View Feature</h5> 
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> 
											</button>
										</div>
										<div class="modal-body row">
											<div class="form-group col-sm-12">
												<input type="hidden" name="id" class="form-control" id="feat_id">
												<div class="form-group col-sm-12">
													<label class="exampleModalLabel">Package</label>
													<select name="packg" class="form-control" id="package_view">
														<option value="0">select package</option>@foreach($com1 as $key2)
														<option value="{{$key2->id}}">{{$key2->title}}</option>@endforeach</select>
												</div>
												<label class="exampleModalLabel">Feature</label>
												<input type="text" name="feature" class="form-control" id="feature_view">
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