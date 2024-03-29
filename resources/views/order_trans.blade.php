@extends('layout.mainlayout')
@section('content')

<div class="content-wrapper">

<head>
    <style>
        
   
          /* Style the button for both screen and print media */
          .print-button {
            background: linear-gradient(45deg, #d22d2d, #d22d2d); /* Use a gradient background with a mix of two colors */
            color: #fff;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            float: right; /* Align the button to the right */
        }
     
        /* Style the button for print media */
        @media print {
            .print-button {
                display: none;
            }
        }
     
        /* Define your CSS styles for the invoice here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .invoice {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .invoice-header {
    background: linear-gradient(45deg, #f2f20d, #f2f20d);
    color: #ff0000; /* Black text color for readability */
    padding: 20px;
    text-align: center;
}    
.invoice-title {
    font-size: 30px;
    text-transform: uppercase;
    font-weight: bold; /* Add bold font weight */
    text-align: center; /* Center-align the title */
    margin-bottom: 10px; /* Add margin at the bottom for spacing */
}

        .invoice-details {
            margin: 20px;
        }
        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-details th, .invoice-details td {
            padding: 10px;
            text-align: left;
        }
        .invoice-details th {
            background-color: #f2f2f2;
        }
        .invoice-table {
            margin: 20px;
        }
        .invoice-table table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-table th, .invoice-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .invoice-total {
            text-align: right;
            margin: 20px;
        }
        .invoice-total p {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<button class="print-button" onclick="printPage()">Print Page</button>

<body>

    <div class="invoice">
        <div class="invoice-header">
            <div class="invoice-title">Invoice</div>
        </div>
        <div class="invoice-details">
            <table>
            @foreach($order as $key)
            @endforeach
            <tr>
                    <th>Order ID</th>
                    <td>{{$key->order_id}}</td>
                </tr>
                
                <tr>
                    <th>Shop Name</th>
                    <td>{{$key->shopname}}</td>
                </tr>
                
                <!-- <tr>
                <th>Shop Address</th>
                <td>{{$key->address}}</td>
                </tr> -->
                <tr>
    <th>Shop Address</th>
    <td colspan="6">
        {{ $key->area }}, {{ $key->area1 }}, {{ $key->city }}, {{ $key->district }}, {{ $key->state }}, {{ $key->country }}
    </td>
</tr>

                
                <tr>
                <th>Total MRP</th>
                <td>{{$key->total_mrp}}</td>
                </tr>
                <tr>
                <th>Discount</th>
                <td>{{$key->discount}}</td>

                </tr>
                <tr>
                <th>Shipping Charge</th>
                <td>{{$key->shipping_charge}}</td>
                </tr>
                <tr>
                <th>Total Amount</th>
                <td>{{$key->total_amount}}</td>
                </tr>
            </table>
        </div>
        <div class="invoice-table">
        <div class="invoice-header">
            <div class="invoice-title">Product details</div>
        </div>
            <table>
                <tr>
                <th>Product Name</th>
                              <th>Quantity</th>
                              <th>Offer Amount</th>
                              <th>MRP</th>
                              <th>Taxable Amount</th>
                              <th>Total Amount</th>

                </tr>
                <!-- Loop through your invoice items and populate the first table rows -->
                <tr>
                @foreach($order as $key)
                           <tr>
                              <td>{{$key->product_name}}</td>
                              <td>{{$key->qty}}</td>
                              <td>{{$key->offer_amount}}</td>
                              <td>{{$key->price}}</td>
                              <td>{{$key->taxable_amount}}</td>
                              <td>{{ $key->qty * $key->offer_amount }}</td>

                           </tr>
                           @endforeach
                </tr>
                
                <!-- Loop through your invoice items and populate the second table rows -->
               
            </table>

            <script>
        function printPage() {
            window.print();
        }
    </script>
        </div>

    </div>

</body>

</div>

@endsection