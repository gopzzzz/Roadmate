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
               <li class="breadcrumb-item active">Add Product Priority</li>
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
                    <h3 class="card-title">Product Priority</h3>
                     <p align="right">
                         <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Product Priority</button>
                           <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                @csrf
                                  <div class="modal-dialog" role="document" style="width:80%;">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Product Priority</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                              </button>
                                    </div>
                                    <div class="modal-body row">
                <form method="POST" action="{{ url('update_Priority') }}" enctype="multipart/form-data">
    <div class="col-md-100">
        <div class="form-group">
            <input type="text" name="search_product" class="form-control" id="search_product" placeholder="Search Product" value="" style="width: 450px;">
        </div>
    </div>

    <div id="searchproductlist"></div>

    <!-- Hidden input field to store selected product IDs -->
    <input type="hidden" name="selected_product_ids" id="selected_product_ids">

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="submitBtn btn btn-primary">Add</button>
    </div>
</form>

</div>
</p>
</div>
<!-- /.card-header -->

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
    document.addEventListener('DOMContentLoaded', function () {
        var emailInput = document.querySelector('input[name="email"]');
        var emailHelp = document.getElementById('emailHelp');

        emailInput.addEventListener('input', function () {
            var emailValue = emailInput.value.toLowerCase();
            
            // Check if the email has a valid format
            if (!/^[\w.%+-]+@[\w.-]+\.[a-zA-Z]{2,}$/.test(emailValue) && emailValue !== '') {
                emailInput.setCustomValidity('Please enter a valid email address.');
                emailHelp.style.color = 'red';
            } else {
                emailInput.setCustomValidity('');
                emailHelp.style.color = 'inherit';
            }
        });
    });
</script>




<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>




  @endsection