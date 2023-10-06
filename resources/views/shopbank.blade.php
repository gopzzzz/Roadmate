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

                  <li class="breadcrumb-item active"> Shop Bank</li>

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

                     <h3 class="card-title">Shop Bank</h3>

                     <p align="right">

                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Shop Bank</button>

                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <form method="POST" action="{{url('shopbankinsert')}}" enctype="multipart/form-data">

                           @csrf

                           <div class="modal-dialog" role="document" style="width:80%;">

                              <div class="modal-content">

                                 <div class="modal-header">

                                    <h5 class="modal-title" id="exampleModalLabel">Shop Bank</h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                    <span aria-hidden="true">&times;</span>

                                    </button>

                                 </div>

                                 <div class="modal-body row">

                                    <div class="form-group col-sm-12">

                                       <label class="exampleModalLabel">Shop</label>

                                       <input type="hidden" class="form-control" id="shopid" name="shopid">
                                            <input type="text" class="form-control shopname home-text-box" name="shopname" id="shopname" placeholder="Search Shop" aria-describedby="basic-addon1" required>
                                            <div id="shoplist" class="shoplist"></div>

                                    </div>
                                    <div class="form-group col-sm-12">
                                    
                                    <label class="exampleModalLabel">Bank</label>

<input type="text"  class="form-control" name="bank" placeholder="Enter fuel type" required>

</div>


<div class="form-group col-sm-12">
<label class="exampleModalLabel">Branch</label>

<input type="text"  class="form-control" name="branch" placeholder="Enter Branch" required>

</div>

<div class="form-group col-sm-12">
<label class="exampleModalLabel">IFSC</label>

<input type="text"  class="form-control" name="ifsc" placeholder="Enter IFSC" required>

</div>

<div class="form-group col-sm-12">
<label class="exampleModalLabel">Bank Account</label>

<input type="text"  class="form-control" name="bankaccount" placeholder="Enter Bank Account" required>

</div>

<div class="form-group col-sm-12">
<label class="exampleModalLabel">Bank Holder Name</label>

<input type="text"  class="form-control" name="bankholdername" placeholder="Bank Holder Name" required>

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

                              <th>Shop</th>

                              <th>Account Holder Name</th>

                              <th>Bank</th>

                              <th>Branch</th>

                              <th>IFSC</th>

                              <th>Bank Account</th>

                              @if($role==1)<th>Action</th>@endif

                           </tr>

                        </thead>

                        <tbody>

                           @php 

                           $i=1;

                           @endphp

                           @foreach($shobank as $key)

                           <tr>

                              <td>{{$i}}</td>

                              <td>{{$key->shop_id}}</td>

                              <td>{{$key->account_holdername}}</td>

                              <td>{{$key->bank}}</td>

                              <td>{{$key->branch}}</td>

                              <td>{{$key->ifsc}}</td>

                              <td>{{$key->bankaccount}}</td>

                              

                              <td>

                              @if($role==1) <i class="fa fa-edit editshopbank"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                                
                                <a href="{{url('featuredelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>

                              </td>@endif

                           </tr>

                           @php 

                           $i++;

                           @endphp

                           @endforeach

                        </tbody>

                        <tfoot>

                           <tr>

                           <th>id</th>

<th>Shop</th>

<th>Account Holder Name</th>

<th>Bank</th>

<th>Branch</th>

<th>IFSC</th>

<th>Bank Account</th>

@if($role==1)<th>Action</th>@endif

                           </tr>

                        </tfoot>

                     </table>

                     <div class="modal" id="editshopbankmodal" tabindex="-1" role="dialog">

                        <div class="modal-dialog" role="document">

                           <div class="modal-content">

                              <div class="modal-header">

                                 <h5 class="modal-title">Edit Shop bank</h5>

                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                 <span aria-hidden="true">&times;</span>

                                 </button>

                              </div>

                              <form method="POST" action="{{url('editshopbank')}}" enctype="multipart/form-data">

                                 @csrf

                                 <div class="modal-body row">

                                 <div class="form-group col-sm-12">
                                 <input type="hidden" class="form-control" id="id" name="id">
<label class="exampleModalLabel">Shop</label>

<input type="hidden" class="form-control" id="shopidedit" name="shopid">
     <input type="text" class="form-control shopnamedit home-text-box" name="shopname" id="shopnameedit" placeholder="Search Shop" aria-describedby="basic-addon1" required>
     <div id="shopnamelist" class="shopnamelist"></div>

</div>
<div class="form-group col-sm-12">

<label class="exampleModalLabel">Bank</label>

<input type="text"  class="form-control" name="bank" id="bank" placeholder="Enter fuel type" required>

</div>


<div class="form-group col-sm-12">
<label class="exampleModalLabel">Branch</label>

<input type="text"  class="form-control" name="branch" id="branch" placeholder="Enter Branch" required>

</div>

<div class="form-group col-sm-12">
<label class="exampleModalLabel">IFSC</label>

<input type="text"  class="form-control" name="ifsc" id="ifsc" placeholder="Enter IFSC" required>

</div>

<div class="form-group col-sm-12">
<label class="exampleModalLabel">Bank Account</label>

<input type="text"  class="form-control" name="bankaccount" id="bankaccount" placeholder="Enter Bank Account" required>

</div>

<div class="form-group col-sm-12">
<label class="exampleModalLabel">Bank Holder Name</label>

<input type="text"  class="form-control" name="bankholdername" id="bankholdername" placeholder="Bank Holder Name" required>

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