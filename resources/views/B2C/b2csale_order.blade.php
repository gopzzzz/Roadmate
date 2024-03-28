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
               

                <form method="POST" action="{{ url('b2csale_orderinsert') }}" enctype="multipart/form-data">
    @csrf

    <div>
        <div>
            <h2 class="modal-title" id="exampleModalLabel">Sale Invoice</h2>
          
        </div>
        <div class="modal-body row">
        @foreach($saleorder as $order)
        @endforeach
                                            
        
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="exampleModalLabel">ORDER ID:</label>
                        <input class="form-control" name="orderId[]" value="{{ $order->order_id }}" required readonly>
                        <input type="hidden" class="form-control" name="idd" value="{{ $order->id }}" required readonly>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="exampleModalLabel">ORDER DATE:</label>
                        <input class="form-control" name="orderdate" value="{{ $order->order_date }}" required readonly>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="exampleModalLabel">E-way BILL NUMBER:</label>
                        <input class="form-control" name="billnumber" required autocomplete="off">
                        
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="exampleModalLabel">DELIVERY DATE:</label>
                        <input class="form-control" name="delivery_date" value="{{ $order->delivery_date }}" required readonly>
                    </div>
                </div>
            
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        
                        <label class="exampleModalLabel">CUSTOMER NAME:</label>
                        <input type="text" class="form-control" name="shopname" value="{{ $order->name }}" required readonly>
                        <input type="hidden" id="shopId" name="shop_id" value="{{ $order->shop_id }}" required readonly>

                 </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="exampleModalLabel">PHONE NUMBER:</label>
                        <input class="form-control" name="phone" value="{{ $order->phone }}" required readonly>
                    </div>
                </div>
              
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="exampleModalLabel">DELIVERY ADDRESS:</label>
                        <textarea class="form-control" name="deliveryaddress" placeholder="Enter igst" required readonly>Area : {{ $order->area }} ,  {{ $order->area1 }} {{ $order->district }},{{ $order->state }} {{ $order->country }},{{ $order->pincode }}</textarea>
                    </div>
                </div> <br><br><br><br><br><br><br>
                                                <!-- <input type="hidden" id="orderidd" name="order_status" value="1"> -->
                                                <table class="table table-bordered table-striped" id="editableTable">
                                                <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
           
            <th> MRP</th>
            <th>Selling Rate</th>
            <th>Tax </th>
            <th>Tax Amt</th>
            <th>Total Amount</th>
           
        </tr>
    </thead>
    <tbody>
        @foreach($saleorder as $index => $product)
         
        <tr>
        <input type="hidden" name="product_id[]" value="{{ $product->proid }}">
<td><input class="form-control product-name" name="product_name[]" value="{{ $product->product_name }}" required readonly></td>
<td><input class="form-control qty" name="qty[]" value="{{ $product->qty }}" required readonly></td>

<td><input class="form-control total-mrp" name="total_mrp" value="{{ $product->price }}" required readonly></td>
<td><input class="form-control offer-amount" name="selling_rate[]" value="{{ $product->selling_rate }}" required readonly></td>
<td><input class="form-control" name="tax" value="{{ $product->tax }} %" required readonly></td>
<td><input class="form-control tax" name="tax" value="{{ number_format(($product->selling_rate) / (1 + (($product->tax) / 100)) * ($product->tax / 100), 2) }}" required readonly></td>
<td><input class="form-control" name="total_amount" value="{{ $product->qty * $product->selling_rate }}"required readonly></td>

        </tr>
        @endforeach
    </tbody> 
                
                </table>
         </div>
        </div>
            <div class="row">
                    <div class="col-sm-4">
                    <div class="form-group">
                    <label class="exampleModalLabel">PAYMENT METHOD</label>
                    <input class="form-control" name="payment" value=" @if($order->payment_mode==0) Cash on Delivery @else Online @endif" required readonly>
                </div>
              
</div>
<div class="col-sm-4">
</div>
<div class="col-sm-4" >
<div class="form-group">
                    <label class="exampleModalLabel">SUB TOTAL AMOUNT</label>
                    <input class="form-control" name="price[]" value="{{ $order->total_amount  }}" required readonly>
                </div>
                
<div class="form-group">
                    <label class="exampleModalLabel">DELIVERY CHARGE</label>
                    <input class="form-control" name="shipping_charge" value="{{ $order->shipping_charge }}" required readonly>
                    <input type="hidden" class="form-control" name="discount" value="{{ $order->discount }}" required readonly>
                    <input type="hidden" class="form-control" name="walletamount" value="{{ $order->wallet_redeem_id }}" readonly>
                </div>
 
                <div class="form-group">
                    <label class="exampleModalLabel">GRANDTOTAL AMOUNT</label>
                    <input class="form-control" name="price[]" value="{{ $order->total_amount + $order->shipping_charge }}" required readonly>
                </div>
</div>

                </div>
                                       <div class="modal-footer">
<!--    
                                       <a href="{{ route('b2cancel-order', ['orderId' => $orderId]) }}" onclick="return confirmDelete('{{ $orderId }}')">
    <button type="button" class="btn btn-secondary">Cancel Order</button>
</a> -->
           
                                       <a href="{{ route('b2cancel-order', ['orderId' => $orderId]) }}" id="cancel-link">
        <button type="button" class="btn btn-secondary">Cancel Order</button>
    </a>

                                          <a href="{{url('b2corders')}}">
 
                                          <button type="submit" name="submit" class="btn btn-primary" id="submit-btn">Submit</button>
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

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            

            <script>
    document.getElementById('cancel-link').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default action of the link

        if (confirm('Are you sure you want to cancel this order?')) {
            window.location.href = this.getAttribute('href'); // Proceed with canceling the order
        }
    });
</script>


            <!-- <script>
  $(document).ready(function() {
    // Function to update total amount and total column
    function updateTotal(inputField) {
        var row = inputField.closest('tr');
        var qty = parseFloat(row.find('.qty').val());
        var offerAmount = parseFloat(row.find('.offer-amount').val());

        // Set total amount to 0 if quantity is 0
        var total = (qty === 0) ? 0 : (isNaN(qty) || isNaN(offerAmount)) ? 0 : qty * offerAmount;

        row.find('.total-amount').val(total.toFixed(2)); // Update the total amount input field
        row.find('.total-column').text(total.toFixed(2)); // Update the content of the "Total" column

        // Show or hide the total amount text area based on the presence of both quantity and offer amount
        if (!isNaN(qty) && !isNaN(offerAmount) && qty >= 0 && offerAmount >= 0) {
            row.find('.total-amount').show();
        } else {
            row.find('.total-amount').hide();
        }
    }

    // Trigger updateTotal function when the quantity input field changes
    $('input.qty').on('input', function() {
        updateTotal($(this));
    });

    // Trigger updateTotal function when the offer amount input field changes
    $('input.offer-amount').on('input', function() {
        updateTotal($(this));
    });

    // Initial calculation for each row
    $('input.qty, input.offer-amount').each(function() {
        updateTotal($(this));
    });

    // Make the total amount input fields readonly
    $('.total-amount').prop('readonly', true);
});
</script>









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
 -->

 

<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("cancelOrderLink").addEventListener("click", function(event) {
            if (!confirm('Are you sure you want to cancel this order?')) {
                event.preventDefault(); // Prevent the default behavior (following the link)
            }
        });
    });
</script> -->
<!-- <script>
    function confirmDelete(orderId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user clicks "Yes", proceed with the deletion
                window.location.href = "{{ route('b2cancel-order', ['orderId' => $orderId]) }}";
            }
        });

        // Return false to prevent the default behavior of the anchor tag
        return false;
    }
</script> -->
@endsection