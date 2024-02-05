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



                  <li class="breadcrumb-item active"> Country</li>



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



                     <h3 class="card-title">Country</h3>



                     <p align="right">



                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Country</button>



                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



                        <form method="POST" action="{{url('countryinsert')}}" enctype="multipart/form-data">



                           @csrf



                           <div class="modal-dialog" role="document" style="width:80%;">



                              <div class="modal-content">



                                 <div class="modal-header">



                                    <h5 class="modal-title" id="exampleModalLabel">Country</h5>



                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">



                                    <span aria-hidden="true">&times;</span>



                                    </button>



                                 </div>



                                 <div class="modal-body row">



                                    <div class="form-group col-sm-12">



                                       <label class="exampleModalLabel">Country</label>



                                       <input type="text" class="form-control" name="country_name" placeholder="Enter country name" autocomplete="off" required>



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



                              <th>Countrys</th>

                            
                              <th>Deleted status</th>

                              <th>Action</th>

                             

                           </tr>



                        </thead>



                        <tbody>



                           @php 



                           $i=1;



                           @endphp



                           @foreach($empl as $key)



                           <tr>



                              <td>{{$i}}</td>

  

                              <td>{{$key->country_name}}</td>

                              <td>

@if($key->deleted_status==0) Active @else Inactive @endif


 </td>


                            <td>



                                 <i class="fa fa-edit edit_country"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>

                                

                                <!-- <a href="{{url('featuredelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a> -->



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



                              <th>Countrys</th>

                            
                              <th>Deletes status</th>

                              <th>Action</th>

                             

                           </tr>



                        </tfoot>



                     </table>



                     <div class="modal" id="editcountry_modal" tabindex="-1" role="dialog">



                        <div class="modal-dialog" role="document">



                           <div class="modal-content">



                              <div class="modal-header">



                                 <h5 class="modal-title">Edit Countrys</h5>



                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">



                                 <span aria-hidden="true">&times;</span>



                                 </button>



                              </div>



                              <form method="POST" action="{{url('countryedit')}}" enctype="multipart/form-data">



                                 @csrf



                                 <div class="modal-body row">



                                    <div class="form-group col-sm-12">



                                       <input type="hidden" name="id" id="countryid">



                                       <label class="exampleModalLabel">Countrys</label>



                                       <input type="text" class="form-control" name="country_name" id="country_name" required>

                                       <div class="form-group col-sm-12">

<label class="exampleModalLabel">Status</label>

<select name="status" id="status" class="form-control"  required>

	<option value="0">Active</option>



	<option value="1">In Active</option>

	


</select>

</div>

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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Add the script for text validation -->
<script>
    $(document).ready(function() {
        $('input[name="country_name"]').on('input', function() {
            var value = $(this).val();
            if (!/^[a-zA-Z\s]+$/.test(value) && value !== '') {
                alert('Please enter only text.');
                $(this).val(''); // Clear the input if not text
            }
        });
    });
</script>

@endsection