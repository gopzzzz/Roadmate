@extends('layout.mainlayout')
@section('content')
<head>
   <!-- Include SweetAlert CSS and JS files -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>

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
               <li class="breadcrumb-item"><a href="home">Home</a></li>
               <li class="breadcrumb-item active">Expenses</li>
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
                  <h3 class="card-title">Expenses</h3>
                  <p align="right">
                     <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Expenses</button>
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <form method="POST" action="{{url('expenseinsert')}}">
    @csrf
    <div class="modal-dialog modal-lg" role="document" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Expenses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <div class="form-group col-sm-6">
                    <label class="exampleModalLabel">Ledger</label>
                    <select name="ledger" class="form-control" required>
                        <option value="" selected>Select Ledger</option>
                        @foreach($ledger as $item)                                   
                            <option value="{{$item->id}}">{{$item->ledger_name}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label class="exampleModalLabel">Amount</label>
                    <input type="text" name="amount" placeholder="Enter Amount" class="form-control" required>
                </div>


                <div class="form-group col-sm-6">
                    <label class="exampleModalLabel">Staff</label>                      
                    <select name="staff" class="form-control" required>
                        <option value=""selected>Select staff</option>
                        @foreach($staff as $item)                                 
                            <option value="{{$item->id}}">{{$item->crm_name}}</option>
                        @endforeach 
                         
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label class="exampleModalLabel">Remark</label>
                    <textarea class="form-control" name="remark" placeholder="Enter remark" required></textarea>
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
                           <th>Ledger</th>
                           <th>Amount</th>
                           <th>Staff</th>
                           <th>Remark</th>
                           @if($role==1) <th>Action</th>@endif
                        </tr>
                     </thead>
                     <tbody>
                        @php 
                        $i=1;
                        @endphp
                        @foreach($expense as $key)
                        <tr>
                           <td>{{$i}}</td>
                           <td>{{$key->ledger_name}}</td>
                           <td>{{$key->amount}}</td>
                           <td>{{$key->crm_name}}</td>
                           <td>{{$key->remark}}</td>
                           @if($role==1) <td>
                             <i class="fa fa-edit edit_expense"  aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
                             
                             <a href="#" onclick="confirmDelete('{{ $key->id }}')">
                                <i class="fa fa-trash delete_expense text-danger" aria-hidden="true" data-id="{{ $key->id }}"></i>
                            </a>
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
                           <th>Ledger</th>
                           <th>Amount</th>
                           <th>Staff</th>
                           <th>Remark</th>
                           @if($role==1) <th>Action</th>@endif
                        </tr>
                     </tfoot>
                  </table>
                  <div class="modal" id="editexpense_modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Edit Expenses</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <form method="POST" action="{{url('expensedit')}}">
                                 @csrf
                                 <div class="modal-body row">
                                                                  													
										<input type="hidden" name="id" id="expense_id" class="form-control" >
									 <div class="form-group col-sm-6">            
									 <label class="exampleModalLabel">Ledger</label>                     
									 <select name="ledger" class="form-control" id="ledger">                   
									 <option value="0">Select Ledger</option>                        
                                     @foreach($ledger as $item)                                   
                                        <option value="{{$item->id}}">{{$item->ledger_name}}</option>
                                    @endforeach                                                 
									 </select>                         
									 </div>		
                                     <div class="form-group col-sm-6">          
									 <label class="exampleModalLabel">Amount</label>                    
									 <input type="text" name="amount" class="form-control" id="amount">        
									 </div>

									 <div class="form-group col-sm-6">           
									 <label class="exampleModalLabel">Staff</label>                   
									 <select name="staff" class="form-control" id="staff">                
									 <option value="0">Select Staff</option>                   
									 @foreach($staff as $item)                                 
                                        <option value="{{$item->id}}">{{$item->crm_name}}</option>
                                    @endforeach                           
									 </select>                              
									 </div>                            
									 <div class="form-group col-sm-6">          
									 <label class="exampleModalLabel">Remark</label>                    
                                     <textarea class="form-control" name="remark" id="remark" placeholder="Enter remark" required></textarea>
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

<script>
    function confirmDelete(Id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user clicks "Yes", proceed with the deletion
                window.location.href = "{{ url('expensedelete') }}/" + Id;
            }
        });
    }
</script>

@endsection