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

              <li class="breadcrumb-item active">Sale Order</li>

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

         
         


            <div class="card">

              <div class="card-header">

                <!-- <h3 class="card-title">HSN</h3> -->

                <p align="right">
               

                <form method="POST" action="{{ url('sale_orderinsert') }}" enctype="multipart/form-data">
    @csrf

    <div>
        <div>
            <h5 class="modal-title" id="exampleModalLabel">Sale Order</h5>
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> -->
        </div>
        <div class="modal-body row">
        @foreach($saleorder as $key)
            @endforeach
                                            
                                           
                                                <div>
                                                    <label class="exampleModalLabel">ORDER ID:</label>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                    <input class="form-control" name="orderId[]" value="{{ $key->order_id }}" required>
                                                </div>
                                                   
                                                <div>
                                                    <label class="exampleModalLabel">ORDER DATE:</label>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                    <input class="form-control" name="orderdate" value="{{ $key->order_date }}" required>
                                                </div>
                                                <div>
                                                    <label class="exampleModalLabel">BILL NUMBER</label>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                    <input class="form-control" name="bill" value="{{ $key->order_date }}" required>
                                                </div>
                                                <div>
                                                    <label class="exampleModalLabel">DELIVERY DATE:</label>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                    <input class="form-control" name="delivery_date" value="{{ $key->delivery_date }}" required>
                                                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <div>
                                                    <label class="exampleModalLabel">SHOP <br>NAME:</label>
                                                </div>
                                                <div class="form-group col-sm-2">
                                                    <textarea class="form-control" name="shopId[]" required>{{ $key->shopname }}</textarea>
                                                </div>
                                                <div>
                                                    <label class="exampleModalLabel">PHONE <br>NUMBER:</label>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                    <input class="form-control" name="phone" value="{{ $key->phone }}" required>
                                                </div>
                                                <div>
                                                    <label class="exampleModalLabel">ADDRESS:</label>
                                                </div>
                                                <div class="form-group col-sm-2">
                                                    <textarea class="form-control" name="address" placeholder="Enter igst" required>{{ $key->address }}</textarea>
                                                </div>
                                                <div>
                                                    <label class="exampleModalLabel">DELIVERY <br> ADDRESS:</label>
                                                </div>
                                                    <div class="form-group col-sm-2">
                                                    <textarea class="form-control" name="deliveryaddress" placeholder="Enter igst" required>Area : {{ $key->area }} ,  {{ $key->area1 }}<br>{{ $key->district }},{{ $key->state }} <br>{{ $key->country }},{{ $key->pincode }}</textarea>
                                                </div>
                                                <table class="table table-bordered table-striped" id="editableTable">
    <thead>
        <tr>
            <!-- <th>Id</th> -->
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>MRP</th>
            <th>Tax</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
    @foreach($saleorder as $key)
        <tr>
           
            <td contenteditable="true" name="product_name" data-field="product_name">{{$key->product_name}}</td>
            <td contenteditable="true" name="qty[]" data-field="qty">{{$key->qty}}</td>
            <td contenteditable="true" name="offer[]" data-field="unit_price">{{$key->offer_amount}}</td>
            <td contenteditable="true" name="mrp" data-field="mrp">0</td>
            <td contenteditable="true" name="tax" data-field="tax">0</td>
            <td contenteditable="true" name="total" data-field="total_amount">{{$key->total_amount}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div>
                                                    <label class="exampleModalLabel">DELIVERY CHARGE</label>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                    <input class="form-control" name="deliverycharge" value="{{ $key->shipping_charge }}" required>
                                                </div>

<div>
                                                    <label class="exampleModalLabel">DISCOUNT</label>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                    <input class="form-control" name="discount" value="{{ $key->discount }}" required>
                                                </div>

                                                <div>
                                                    <label class="exampleModalLabel">PAYMENT METHODE</label>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                    <input class="form-control" name="payment" value="{{ $key->payment_mode }}" required>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        
    </div>
</form>


</div>
              

                </p>

               

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
<script>
    $(document).ready(function () {
        $('#editableTable td[contenteditable=true]').on('input', function () {
            // You can handle the update logic here
            var newValue = $(this).text();
            var field = $(this).data('field');
            console.log('Field: ' + field + ', New Value: ' + newValue);
        });
    });
</script>

@endsection