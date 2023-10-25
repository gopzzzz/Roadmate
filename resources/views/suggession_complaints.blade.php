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

                  <li class="breadcrumb-item"><a href="home">Home</a></li>

                  <li class="breadcrumb-item active"> Complaints & Suggestions</li>

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

                     <h3 class="card-title">Complaints & Suggestions</h3>

                     <p align="right">

                        <!--<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Terms & Conditions</button>-->

                     

                  </div>

                  <!-- /.card-header -->

                  <div class="card-body">

                     <table id="example1" class="table table-bordered table-striped">

                        <thead>

                           <tr>

                              <th>id</th>
							  
							  <th>Shop</th>
							  
							  <th>Suggestion</th>

                              <th>Complaint</th>

                              @if($role==1)<th>Action</th>@endif

                           </tr>

                        </thead>

                        <tbody>

                           @php 

                           $i=1;

                           @endphp

                           @foreach($sugg as $key)

                           <tr>

                              <td>{{$i}}</td>

                              <td>{{$key->shopname}}</td>
							  <td>{{$key->suggestion	}}</td>
							  <td>{{$key->complaint}}</td>

                       @if($role==1)  <td>

                                 <!--<i class="fa fa-edit edit_tcdetails"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>-->
                                 <i class="fa fa-eye view_csdetails"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
								 <a href="{{url('suggcomplntdelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>
                                

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
							  
							  <th>Suggestion</th>

                              <th>Complaint</th>

                              @if($role==1) <th>Action</th>@endif

                           </tr>

                        </tfoot>

                     </table>

                     
					 
					 <div class="modal" id="viewcs_modal" tabindex="-1" role="dialog">

                        <div class="modal-dialog" role="document">

                           <div class="modal-content">

                              <div class="modal-header">

                                 <h5 class="modal-title">View Complaints & Suggestions</h5>

                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                 <span aria-hidden="true">&times;</span>

                                 </button>

                              </div>


                                 <div class="modal-body row">

                                    <div class="modal-body row">
									<input type="hidden" name="id" id="csview_id" class="form-control" >
      
									<div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Shop</label>
                                        <select name="shop" class="form-control" id="shop">
                                        <option value="0">select Shop</option>
                                        @foreach($shops as $key)
                                        <option value="{{$key->id}}">{{$key->shopname}}</option>
                                        @endforeach
                                        </select>
                                    </div>
									<div class="form-group col-sm-12">

                                       <label class="exampleModalLabel">Suggestions</label>

                                       <textarea  class="form-control" name="sug" id="sug_view" required></textarea>

                                    </div>
									<div class="form-group col-sm-12">

                                       <label class="exampleModalLabel">Complaints</label>

                                       <textarea  class="form-control" name="comp" id="comp_view" required></textarea>

                                    </div>

                                 </div>

                                 </div>

                                 <div class="modal-footer">

                                    

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

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

</div>

@endsection