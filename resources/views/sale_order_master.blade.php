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
            <h2 class="modal-title" id="exampleModalLabel">Sale Invoice</h2>
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> -->
        </div>
        <div class="modal-body row">
        @foreach($saleorder as $order)
        @endforeach
                                            
                                          
                                                <div>
                                                    <label class="exampleModalLabel">ORDER ID:</label>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                    <input class="form-control" name="orderId[]" value="{{ $order->order_id }}" required readonly>
                                                </div>
                                                   
                                                <div>
                                                    <label class="exampleModalLabel">ORDER DATE:</label>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                    <input class="form-control" name="orderdate" value="{{ $order->order_date }}" required readonly>
                                                </div>
                                                <div>
                                                    <label class="exampleModalLabel">BILL NUMBER</label>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                    <input class="form-control" name="bill" value="{{ $order->order_id }}" required>
                                                </div>
                                                <div>
                                                    <label class="exampleModalLabel">DELIVERY DATE:</label>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                    <input class="form-control" name="delivery_date" value="{{ $order->delivery_date }}" required readonly>
                                                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <div>
                                                <input type="hidden" id="shopId" name="id">
                                                    <label class="exampleModalLabel">SHOP <br>NAME:</label>
                                                </div>
                                                <div class="form-group col-sm-3">
                                                <input type="text" class="form-control" name="shopname" value="{{ $order->shopname }}" required readonly>

                                                    
                                                </div>
                                                <div>
                                                    <label class="exampleModalLabel">PHONE <br>NUMBER:</label>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                    <input class="form-control" name="phone" value="{{ $order->phone }}" required readonly>
                                                </div>
                                                <div>
                                                    <label class="exampleModalLabel">ADDRESS:</label>
                                                </div>
                                                <div class="form-group col-sm-2">
                                                    <textarea class="form-control" name="address" placeholder="Enter igst" required readonly>{{ $order->address }}</textarea>
                                                </div>
                                                <div>
                                                    <label class="exampleModalLabel">DELIVERY <br> ADDRESS:</label>
                                                </div>
                                                    <div class="form-group col-sm-2">
                                                    <textarea class="form-control" name="deliveryaddress" placeholder="Enter igst" required readonly>Area : {{ $order->area }} ,  {{ $order->area1 }} {{ $order->district }},{{ $order->state }} {{ $order->country }},{{ $order->pincode }}</textarea>
                                                </div><br><br><br><br><br><br><br>
                                                
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
    @foreach($saleorder as $index => $product)
    
        <tr>
        <input type="hidden" id="productId" name="id">
            <!-- <td contenteditable="true" name="productId[]" data-field="product_name">{{$order->product_name}}</td> -->
            <td><input class="form-control" name="product_name[]" value="{{ $product->product_name }}" required readonly    ></td>
            <!-- <td contenteditable="true" name="qty" data-field="qty">{{$order->qty}}</td> -->
            <td><input class="form-control" name="qty[]" value="{{ $product->qty }}" required></td>
            <!-- <td contenteditable="true" name="offer" data-field="offer_amount">{{$order->offer_amount}}</td> -->
            <td><input class="form-control" name="offer_amount[]" value="{{ $product->offer_amount }}" required></td>
            <!-- <td contenteditable="true" name="mrp" data-field="mrp">0</td> -->
            <td><input class="form-control" name="total_mrp" value="{{ $product->total_mrp }}" required></td>
            <!-- <td contenteditable="true" name="tax" data-field="tax">0</td> -->
            <td><input class="form-control" name="tax" value="0" required></td>

            <!-- <td contenteditable="true" name="total" data-field="total_amount">{{$order->total_amount}}</td> -->
            <td><input class="form-control" name="total_amount" value="{{ $product->total_amount }}" required></td>
        </tr>
        @endforeach
        
    </tbody>
</table>

                    <div>
                                                    <label class="exampleModalLabel">DELIVERY CHARGE</label>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                    <input class="form-control" name="deliverycharge" value="{{ $order->shipping_charge }}" required>
                                                </div>

<div>
                                                    <label class="exampleModalLabel">DISCOUNT</label>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                    <input class="form-control" name="discount" value="{{ $order->discount }}" required>
                                                </div>

                                                <div>
                                                    <label class="exampleModalLabel">PAYMENT METHOD</label>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                    <input class="form-control" name="payment" value="{{ $order->payment_mode }}" required>
                                                </div>
                                                <div>
                                                    <label class="exampleModalLabel">TOTAL AMOUNT</label>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                    <input class="form-control" name="price[]" value="{{ $order->price }}" required>
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