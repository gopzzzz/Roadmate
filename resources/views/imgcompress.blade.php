@extends('layout.mainlayout')
@section('content')
<style>
   
    input[type="checkbox"] {
        appearance: none; /* Remove default appearance */
        -webkit-appearance: none;
        -moz-appearance: none;
        width: 16px;
        height: 16px;
        border: 2px solid #3498db; /* Border color */
        border-radius: 4px; /* Border radius for rounded corners */
        outline: none; /* Remove default focus style */
        transition: background-color 0.3s; /* Smooth transition for background color */
        margin-right: 5px; /* Add some space to the right of the checkbox */
    }

    /* Style for checked state */
    input[type="checkbox"]:checked {
        background-color: red; /* Background color when checked */
        border: 2px solid #3498db; /* Border color when checked */
    }

    /* Style for the image container */
    .image-container {
        border: 1px solid #ddd;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    /* Style for the image name */
    .image-name {
        font-weight: bold;
        margin-bottom: 10px;
    }
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    /* Style for the modal content */
    .modal-content {
        margin: 5% auto; /* 5% from the top and centered */
        display: block;
        max-width: 800px;
    }

    /* Style for the close button */
  /* Style for the close button */
.close {
    color: #fff;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    position: absolute;
    top: 10px;
    right: 20px;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
}


    /* Style for the image inside the modal */
    .modal-content img {
        width: 100%;
        height: auto;
    }

    /* Style for the close button */


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
                        <li class="breadcrumb-item active">Add Images</li>
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
    <div class="modal" id="imageModal" onclick="closeModal()">
    <div class="modal-content">
        <div class="image-buttons">
            <span aria-hidden="true" class="close" onclick="closeModal()">&#215;</span>
            <span aria-hidden="true" style="position: absolute; top: 10px; right: 20px; font-size: 28px; cursor: pointer;" onclick="closeModal()">&#215;</span>
            <img id="modalImage" src="#" alt="Enlarged Image" onclick="closeModal()">
        </div>
    </div>
</div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Image</h3>
                            <form method="POST" action="{{ url('imagecompressinsert') }}" enctype="multipart/form-data" >
                                @csrf
                                <input class="form-control" type="file"  name="image[]" accept="image/*" multiple>
                                <div class="modal-footer">
                                    <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        </section>
                        <div class="card-body">
                            @if(!empty($images))
                            <form method="POST" action="{{ url('deleteImages') }}">
                                    @csrf
                                    <div class="text-right"> <!-- Align to the right -->
                                        <button type="submit" class="btn btn-danger">Delete Selected</button>
                                    </div>
                                <h4 style="color: red;">STORED IMAGES</h4><br>
                               
                                    <div class="row">
                                        @foreach($images as $image)
                                            <div class="col-3">
                                                <div class="image-container">
                                                    <div class="image-info-box">
                                                        <p class="image-name">{{ $image->getFilename() }}</p>
                                                    </div>
                                                    <img src="{{ asset('Amith/' . $image->getFilename()) }}" class="img-thumbnail" alt="{{ $image->getFilename() }}" style="width: 150px; height: auto;">
                                                    <div class="image-buttons">
                                                    <br>
    <input type="checkbox" name="images[]" value="{{ $image->getFilename() }}"> Delete
    <button type="button" class="btn btn-success" style="margin-left: 10px;" onclick="openModal('{{ asset('Amith/' . $image->getFilename()) }}')">View</button>
</div>       </div>




                                            </div>
                                        @endforeach
                                    </div>  
                                </form>
                            @else
                                <p>No images found.</p>
                            @endif
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
   
    <!-- /.content -->
</div>
<script>
        function openModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('imageModal').style.display = 'none';
        }
    </script>
@endsection
