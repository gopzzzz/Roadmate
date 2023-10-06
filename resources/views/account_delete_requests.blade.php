@extends('layout.mainlayout') @section('content') <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item active"> Account Delete Requests</li>
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
              <h3 class="card-title">Account Delete Requests</h3>
              <p align="right">
               
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Mobile Number</th>
                     <th>Action</th>
                  </tr>
                </thead>
                <tbody> @php $i=1; @endphp @foreach($accdelete_requests as $key) <tr>
                    <td>{{$i}}</td>
                    <td>{{$key->phnum}}</td>
                      <td><a href="{{url('accountdelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a></td>
                  </tr> @php $i++; @endphp @endforeach </tbody>
                <tfoot>
                  <tr>
                    <th>id</th>
                    <th>Mobile Number</th>
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
</div> @endsection