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

              <li class="breadcrumb-item active">Store queries</li>

            </ol>

          </div>

        </div>

      </div><!-- /.container-fluid -->

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

                <h3 class="card-title">Store queries</h3>

                <p align="right">

               

                </div>

              <!-- /.card-header -->

              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">

                  <thead>

                  <tr>
                  <th>id</th>

                  <th>Category</th>

                    <th>Queiry</th>

 
                    <th>Action</th>




                  </tr>

                  </thead>

                  <tbody>

                  @php 

                  $i=1;

                  @endphp

                  @foreach($queiry as $key)

                  <tr>

                    <td>{{$i}}</td>

                    <td>{{$key->cat_name}}</td>
                   
                    <td>{{$key->question}}</td>
                  
                    <td>
                    <i class="fa fa-edit editqu"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                    
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

                  <th>Category</th>

                  <th>Queiry</th>

                   
                  <th>Action</th>

                  </tr>

                  </tfoot>

                </table>
				
                <div class="modal" id="editquerymodal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Query</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('editquery')}}" >

@csrf
      <div class="modal-body row">

<input type="hidden" id="id" name="id">

<div class="form-group col-sm-12">



<label class="exampleModalLabel">Store Category</label>

<select name="category" class="form-control" id="category">

@foreach($scategory as $scategory)
<option value="{{$scategory->id}}">{{$scategory->cat_name}}</option>

@endforeach()

</select>



</div>

<div class="form-group col-sm-12">



<label class="exampleModalLabel">Query</label>

<input type="text" id="query" name="queryname" class="form-control">



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



        <!-- /.row -->

      </div>

      <!-- /.container-fluid -->

    </section>

    <!-- /.content -->

  </div>

  @endsection