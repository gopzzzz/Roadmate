@extends('layout.mainlayout')
@section('content')
<style>
  .checkboxes label {
    display: inline-block;
    padding-right: 10px;
    white-space: nowrap;
  }
  .checkboxes input {
    vertical-align: middle;
  }
  .checkboxes label span {
    vertical-align: middle;
  }
</style>
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
      <li class="breadcrumb-item active">Notification</li>
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
       <h3 class="card-title">Notification</h3>
       <p align="right">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Notification</button>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <form method="POST" action="{{url('notificationinsert')}}" enctype="multipart/form-data">
           @csrf
           <div class="modal-dialog" role="document" style="width:80%;">
            <div class="modal-content">
             <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Notification</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body row">
     
               <div class="form-group col-sm-12">
        <label class="exampleModalLabel">Title</label>
        <input type="text" name="title"id="title_id" class="form-control">
      </div>


              <div class="form-group col-sm-12">
                <label class="exampleModalLabel">Customer Type</label>
                <select name="customertype_id" class="form-control" id="customer_types">
                  <option>Select Customer Type</option>
                  @foreach($role as $key1)
                  <option value="{{$key1->id}}">{{$key1->name}}</option>
                  @endforeach
                </select>
              </div>


              <div class="form-group col-sm-12">
                <label class="exampleModalLabel">Message</label>
                <textarea type="textarea"class="form-control form-control-lg form-control-solid" name="message" id="message_id" ></textarea>
              </div>
            </div>






            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" name="submit" id="submitnotification" class="btn btn-primary">Add</button>
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
      <th>Id</th>
      <th>Title</th>
      <th>Customer Type</th>
      <th>Message</th>

     
    </tr>
  </thead>
  <tbody>
    @php
    $i=1;
    @endphp
    @foreach($notification as $key)
    <tr>
      
      <td>{{$i}}</td>
      <td>{{$key->notification_title }}</td>
      <td>@if($key->user_type==1) Shop @elseif($key->user_type==2) Customer @else Executive @endif</td>
      <td>{{$key->notification_message}}</td>


     
   </tr>
   @php
   $i++;
   @endphp
   @endforeach
 </tbody>
 <tfoot>
   <tr>
    <th>Id</th>
        <th>Title</th>
    <th>Customer Type</th>
    <th>Message</th>

   
  </tr>
</tfoot>
</table>
<!--- edit modal-->

<!--- end--->








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