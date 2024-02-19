@extends('layout.mainlayout')
@section('content')

<head>

<!-- <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-N2Lp0O1trMbsN01NJZSdZlPz53LW3fmBkSo2B1bFOcJOYc6sjvI4xkgUEQ8Hf/AClQQ5Np0UV5z/vlj+B6qSRg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

<style>


</style>
</head>

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
 <li class="breadcrumb-item active">Purchase Order</li>
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



                     <h3 class="card-title">Purchase Order</h3>



                
                  </div>



                  <!-- /.card-header -->
                  <div class="card-body">
<table id="example1" class="table table-bordered table-striped">
   <thead>
    <tr>
   <th>id</th>
   <th>Vendor Name </th>
         <th>PO Number</th>
         <th>Requested BY</th>
         <th></th>

         <th></th>
  
</tr>
   </thead>
   <tbody id="non-searchshoplist">

@php 

  $i=1;

  @endphp

 
              

            @foreach($ordersQuery as $key)
                <tr>
                <td>{{$i}}</td>
                    <td>{{ $key->vendor_name }}</td>
                    <td>{{ $key->bill_num }}</td>
                    <td>{{ $key->name }}</td>
                    <td><i class="fa fa-edit edit_purchaseorder"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
	</td>
                    <td>
                    <a href="{{url('bill/'.$key->id)}}" target="_blank"><button type="button" class="btn btn-success btn-sm" >PO print</button></a>
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
 
 <th>Vendor Name </th>
         <th>PO Number</th>
         <th>Requested BY</th>
      
         <th></th>

         <th></th>
 @if($role==1)
 @endif
 </tr>
</tfoot>
</table><div class="modal" id="editpurcaseorder_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Purchase Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form method="POST" action="{{ route('purchaseorderedit') }}" enctype="multipart/form-data" name="exeedit">
@csrf
<div class="modal-body row">
 <div class="form-group col-sm-12">
    <input type="hidden" name="id" id="purchaseid">
    <select name="venname" id="venname" class="form-control" required>
                    <option value="" disabled selected>Select vendor name</option>
                    @foreach($vendor as $key)
                        <option value="{{ $key->id }}">{{ $key->vendor_name }}</option>
                    @endforeach
                </select>
</div>
<div class="form-group col-sm-12">
 <label class="exampleModalLabel">PO Number</label>
  <textarea class="form-control" name="ponumber" id="ponumber" placeholder="Enter PO Number" required></textarea>
</div>
<div class="form-group col-sm-12">
 <label class="exampleModalLabel">Requested By</label>
  <select name="requestby" id="requestby" class="form-control" required>
                    <option value="" disabled selected>Select Requested By</option>
                    @foreach($user as $key)
                        <option value="{{ $key->id }}">{{ $key->name }}</option>
                    @endforeach
                </select>
</div>
</div>
<div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
<!-- /.card-body -->
 </div>  <!-- /.card -->
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
