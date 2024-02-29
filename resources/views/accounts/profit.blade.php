@extends('layout.mainlayout')
@section('content')
<style>
    .table {
    width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
    border-collapse: collapse;
    font-size:15px;
}
.table th,
.table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
}
.table tbody + tbody {
    border-top: 2px solid #dee2e6;
}
.table-bordered {
    border: 1px solid #dee2e6;
}
.table-bordered th,
.table-bordered td {
    border: 1px solid #dee2e6;
}
.table-bordered thead th,
.table-bordered thead td {
    border-bottom-width: 2px;
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
                  <li class="breadcrumb-item active">Profit Calculation</li>
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
                     <h3 class="card-title">Profit Calculation</h3>
                     <p align="right">
                       <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Shop Packages</button>-->
                    
                  <!-- /.card-header -->
                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th>Category</th>
                                 <th>Amount</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>Expense</td>
                                 <td>{{$expense}}</td>
                              </tr>
                              <tr>
                                 <td>Revenue</td>
                                 <td>{{$totalRevenue}}</td>
                              </tr>
                              <tr>
                                 <td>Profit</td>
                                 <td>{{$totalRevenue-$expense}}</td>
                              </tr>
                           </tbody>
                        </table>
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
