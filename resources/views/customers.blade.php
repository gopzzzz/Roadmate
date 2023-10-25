@extends('layout.mainlayout') @section('content') <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="home">Home</a>
            </li>
            <li class="breadcrumb-item active">Customers</li>
          </ol>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section> @if(session('success')) <h3 style="margin-left: 19px;color: green;">{{session('success')}}</h3> @endif
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Customers</h3>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="col-md-4 mx-auto">
                  <div class="input-group input-group-sm">
                    <select name="status" class="form-control" id="status">
                      <option value="">Choose One</option>
                      <option value="0">In Active</option>
                      <option value="1">Active</option>
                    </select>
                  </div>
                </div>
                <!-- SEARCH FORM -->
                <!-- 
                  <form class="form-inline ml-3">

                     @csrf

                     <div class="input-group input-group-sm"><input class="form-control" name="customer_search" id="customer_search" type="text" placeholder="Search"><div class="input-group-append"><button class="btn btn-navbar" type="button" id="search"><i class="fas fa-search"></i></button></div></div></form> -->
                <div id="customer_table1">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Sex</th>
                        <th>OTP</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody> @php $i=1; @endphp @foreach($customers as $key) <tr>
                        <td>{{$i}}</td>
                        <td>{{$key->name}}</td>
                        <td>{{$key->phnum}}</td>
                        <td>@if($key->sex==1) Male @elseif($key->sex==2) Female @endif</td>
                        <td>{{$key->otp}}</td>
                        <td> @if($key->status==1) <i class="fa fa-check text-success" aria-hidden="true"></i> @else <i class="fa fa-times text-danger" aria-hidden="true"></i> @endif </td>
                      </tr> @php $i++; @endphp @endforeach </tbody>
                    <tfoot>
                      <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Sex</th>
                        <th>OTP</th>
                        <th>Status</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <div id="customer_table2"></div>
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
</div> @endsection