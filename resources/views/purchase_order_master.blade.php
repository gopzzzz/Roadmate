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

              <li class="breadcrumb-item active">Purchase Order</li>

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
      
                <form method="POST" action="{{ url('purchase_orderinsert') }}" enctype="multipart/form-data">
    @csrf

    <div>
        <div>
            <h2 class="modal-title" id="exampleModalLabel">Purchase Invoice</h2>
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> -->
        </div>
        @foreach($godown as $key)
   
    <input type="hidden" class="form-control" name="godown" value="{{ $key->name ?? 'kalamassery' }}" required readonly>
@endforeach



        <div class="modal-body row">
        @foreach($purchase as $order)
        @endforeach  
                                            
        
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="exampleModalLabel">BILL NUMBER:</label>
                        <input class="form-control" name="billnum" value="{{ $order->bill_num }}" required readonly>
                        <input type="hidden" class="form-control" name="idd" value="{{ $order->id }}" required readonly>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="exampleModalLabel">VENDOR NAME:</label>
                        <input class="form-control" name="vendor" value="{{ $order->vendor_name }}" required readonly>
                    </div>
                </div>
               
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="exampleModalLabel">REQUISITIONER:</label>
                        <input class="form-control" name="requestby" value="{{ $order->name}}" required readonly>
                    </div>
                </div>
            
            
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="hidden" id="shopId" name="id">
                        <label class="exampleModalLabel">ORDER DATE:</label>
                        <input type="text" class="form-control" name="orderdate" value="{{ $order->order_date }}" required readonly>
                    </div>
               
               
              
                </div> <br><br><br><br><br><br><br>
                                                <!-- <input type="hidden" id="orderidd" name="order_status" value="1"> -->
                                                <table class="table table-bordered table-striped" id="editableTable">
                                                <thead>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
           
            <th>Amount</th>
            <th>Unit Price</th>
            <th>Tax</th>
            <th>Tax Amount</th>
            <th>Total</th>
           
        </tr>
    </thead>
    <tbody>
    @php  
$i=1;
$sum=0;
$taxableamount=0;
$subtotal=0;
@endphp
        @foreach($purchaseOrder as $index => $product)
        @php 
$unitprice=($product->amount)/(1+(($product->tax)/100));
$taxamount=$unitprice*($product->tax/100);

$unitprice = number_format($unitprice, 2, '.', '');
$taxamount = number_format($taxamount, 2, '.', '');


@endphp
        <tr>
        <input type="hidden" id="productId" name="id">
<td><input class="form-control product-name" name="product_name[]" value="{{ $product->product_name }}" required readonly></td>
<td><input class="form-control qty" name="qty[]" value="{{ $product->qty }}" required readonly></td>

<td><input class="form-control amount" name="amount[]" value="{{ $product->amount }}" required readonly></td>
<td><input class="form-control unitprice" name="unitprice" value="₹{{ $unitprice }}" required readonly></td>

<td><input class="form-control tax" name="tax[]" value="{{ $product->tax }}%" required readonly></td>

<td><input class="form-control" name="taxableamount" value="₹{{ $taxamount * $product->qty}}"required readonly></td>
<td><input class="form-control total" name="total[]" value="₹{{ $unitprice*$product->qty }}" required readonly></td>
<td><input type="hidden" name="orderd[]" value="{{ $product->order_date }}" required readonly></td>

        </tr>
        @php 

$sum += $product->qty*$product->amount;
$taxableamount += ($taxamount)*$product->qty;
$subtotal+= $product->qty*$unitprice;





  

@endphp
        @endforeach
    </tbody> 
                
                </table>

              
              
              
                
            </div>

            
           
                       
            </div>
            <div class="row">
                    <div class="col-sm-4">
                    <div class="form-group">
                </div>
              
</div>
<div class="col-sm-4">
</div>
<div class="col-sm-4" >
<div class="form-group">
                    <label class="exampleModalLabel">SUB TOTAL</label>
                    <input class="form-control" name="price[]" value="₹{{$subtotal}}" required readonly>
                </div>
                
<div class="form-group">
                    <label class="exampleModalLabel">TAX RATE</label>
                    <input class="form-control" name="taxrate" value="₹{{$taxableamount}}" required readonly>
                </div>
                <!-- <div class="form-group">
                    <label class="exampleModalLabel">DISCOUNT</label>
                 
                </div> -->
                
             
               
                <div class="form-group">
                    <label class="exampleModalLabel">GRANDTOTAL AMOUNT</label>
                    <input class="form-control" name="gtotal[]" value="₹{{$sum}}" required readonly>
                </div>
</div>

                </div>
                                       <div class="modal-footer">
                                     


 
                                          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
<!-- Add this section to display flash messages -->


<!-- The rest of your view content -->



@endsection