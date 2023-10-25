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



                  <li class="breadcrumb-item active"> Features</li>



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



                     <h3 class="card-title">Features</h3>



                     <p align="right">



                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Features</button>



                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



                        <form method="POST" action="{{url('featureinsert')}}" enctype="multipart/form-data">



                           @csrf



                           <div class="modal-dialog" role="document" style="width:80%;">



                              <div class="modal-content">



                                 <div class="modal-header">



                                    <h5 class="modal-title" id="exampleModalLabel">Features</h5>



                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">



                                    <span aria-hidden="true">&times;</span>



                                    </button>



                                 </div>



                                 <div class="modal-body row">



                                    <div class="form-group col-sm-12">



                                       <label class="exampleModalLabel">Features</label>



                                       <input type="text"  class="form-control" name="feature" placeholder="Enter fuel type" required>



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



                              <th>Features</th>

                              @if($role==1)

                              <th>Action</th>

                              @endif

                           </tr>



                        </thead>



                        <tbody>



                           @php 



                           $i=1;



                           @endphp



                           @foreach($feature as $key)



                           <tr>



                              <td>{{$i}}</td>



                              <td>{{$key->feature}}</td>



                              @if($role==1) <td>



                                 <i class="fa fa-edit edit_feature"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>

                                

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



                              <th>Features</th>

                              @if($role==1)

                              <th>Action</th>

                              @endif

                           </tr>



                        </tfoot>



                     </table>



                     <div class="modal" id="editfuel_modal" tabindex="-1" role="dialog">



                        <div class="modal-dialog" role="document">



                           <div class="modal-content">



                              <div class="modal-header">



                                 <h5 class="modal-title">Edit Features</h5>



                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">



                                 <span aria-hidden="true">&times;</span>



                                 </button>



                              </div>



                              <form method="POST" action="{{url('editfeature')}}" enctype="multipart/form-data">



                                 @csrf



                                 <div class="modal-body row">



                                    <div class="form-group col-sm-12">



                                       <input type="hidden" name="id" id="featureid">



                                       <label class="exampleModalLabel">Features</label>



                                       <input type="text" class="form-control" name="feature" id="feature" required>



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

					 

					 <div class="modal" id="viewfuel_modal" tabindex="-1" role="dialog">



                        <div class="modal-dialog" role="document">



                           <div class="modal-content">



                              <div class="modal-header">



                                 <h5 class="modal-title">View Fuel Type</h5>



                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">



                                 <span aria-hidden="true">&times;</span>



                                 </button>



                              </div>



                              



                                 <div class="modal-body row">



                                    <div class="form-group col-sm-12">



                                       <input type="hidden" name="id" id="fuelid_view">



                                       <label class="exampleModalLabel">Fuel Type</label>



                                       <input type="text" class="form-control" name="fueltype" id="fueltype_view" required>



                                    </div>



                                 </div>



                                 <div class="modal-footer">



                                    



                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>



                                 </div>



                              </form>



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