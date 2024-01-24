@extends('layout.mainlayout')
@section('content')

<div class="content-wrapper">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .invoice {
            width: 900px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f8f9fa;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            height: auto;
            overflow: auto;
        }

        .invoice-header {
            text-align: center;
           
        }

        .invoice-title {
            font-size: 23px;
            text-transform: uppercase;
            font-weight: bold;
            color: #007bff;
        }

        .company-logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .company-logo img {
            max-width: 150px; /* Adjust the size of the logo */
            height: auto;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .left-details,
        .right-details {
            width: 48%;
        }

        .right-details {
            text-align: left;
        }

        .details-label {
            font-weight: bold;
            color: #495057;
            margin-bottom: 5px;
        }

        .box {
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f8f9fa;
            width: 48%;
            box-sizing: border-box;
        }

        .billed-to p.details-label,
        .ship-to p.details-label {
            margin-bottom: 0;
        }

        .invoice-items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-items th, .invoice-items td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: left;
        }

        .invoice-items th {
            background-color: #007bff;
            color: #ffffff;
        }

        .total-row td {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .invoice-total {
            float: right;
            text-align: left;
            margin-top: 10px;
        }

        .notes {
            margin-top: 20px;
        }

        .notes p {
            margin: 0;
            margin-bottom: 5px;
        }

        .special-notes {
            width: 100%;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f8f9fa;
            margin-top: 20px;
            height: 150px; /* Adjust the height as needed */
        }

       
        .bank-details {
            width: 48%;
            border-top: 1px solid #ccc;
            padding-top: 20px;
            
            margin-top: 20px;
        }

        .bank-details p {
            margin: 0;
            margin-bottom: 5px;
        }
        .thank-you {
            
            margin-top: 10px;
        }

        .company-details {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            border-top: 1px solid #ccc;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="invoice">
    <div class="company-logo" style="float: left">
    <img src="{{ asset('img/RMLOGO.png') }}" alt="Company Logo">
</div> <br>
<div class="invoice-header">
            <div class="invoice-title">Invoice</div>
        </div>
<br><br><br>

        

        <div class="invoice-details">
            <div class="left-details">
                <p class="details-label"></p>
                <p><b>NEXTWAVE ACCESS PRIVATE LIMITED</b></p>
                <p>Kinfra Hi-tech Park <br>
                HMT Colony PO, Kalamassery,<br>
                North Kalamassery, Kochi, Kerala <br>
                683503 <br>
                32AAHCN5463A1ZU</p>
            </div>
            

           
@foreach($invoice as $key)
            @endforeach

            <div class="right-details">
                <p class="details-label"></p>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::now()->format('Y-m-d') }}</p>
                <p><strong>Invoice Number:</strong>RM/{{ str_pad($key->order_id, STR_PAD_LEFT) }}/{{ date('y') }}</p>
                <p><strong>Sales Order No:</strong>RM/SO/{{ str_pad($key->order_id, 2, '0', STR_PAD_LEFT) }}/{{ date('y') }}</p>

                <p><strong>E-way Bill No:</strong></p>
                <p><strong>Payment Due By:</strong> {{$key->delivery_date }}</p>
            </div>
        </div>

        <div class="invoice-details">
            <div class="billed-to box">
                <p class="details-label">Billed To:</p>
                <p>{{$key->shopname}}<br>
                {{$key->address}}
                </p>
            </div>
           

            <div class="ship-to box">
                <p class="details-label">Ship To:</p>
                <p>{{ $key->area }}, {{ $key->area1 }}, {{ $key->city }}, {{ $key->district }}, {{ $key->state }}, {{ $key->country }}</p>
            </div>
        </div>

       

        <table class="invoice-items">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>SGST</th>
                    <th>CGST</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
            @foreach($invoice as $key)
                <tr>
              
                    <td>{{$key->product_name}}</td>
                    <td>{{$key->offer_amount}}</td>
                    <td>{{$key->qty}}</td>
                    <td>0</td>
                    <td>0</td>
                    <td>{{$key->offer_amount}}</td>
                   
                </tr>
                @endforeach
                <!-- Add more rows as needed -->
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td>Total</td>
                    <td></td>
                    <td></td>
                    <td>Total SGST</td>
                    <td>Total CGST</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        
<div class="invoice-details">
<div class="left-details">
<p class="details-label"></p>
<div class="special-notes box">
        <p class="details-label" style="background: #e4cf23">Special Notes and Instructions:</p>
            
    </div>
    </div>

    <div class="right-details">
    <p class="details-label"></p>
            <p><strong>SUBTOTAL:</strong>{{ $key->total_amount }}</p>
            <p><strong>DISCOUNT:</strong>{{ $key->discount }}</p>
            <p><strong>(TAX RATE):</strong>0</p>
            <p><strong>TAX:</strong>0</p>
            <p><strong>TOTAL:</strong>{{ $key->total_amount }}</p>
        
    </div>
         
</div>
        <div>Make all cheques payable to my company name</div><br>

<div class="invoice-details">
      <div class="left-details">
<p class="details-label"></p>  
<div class="thank-you">
            <p class="details-label"><center><b>Thank you for your business!</b></center></p>
            <p>Should you have any enquiries concerning this invoice, <br> please contact us.</p>
            <!-- Add more thank-you notes as needed -->
        </div>
    </div> 

    <div class="right-details">
    <p class="details-label"></p>
        
            <p class="details-label">BANK ACCOUNT DETAILS</p>
            <p>Account holder: Nextwave Access Private Limited</p>
            <p>Account Number: 116105000951</p>
            <p>IFSC code: ICIC0001161</p>
            <!-- Add more bank details as needed -->
        
     </div>
</div>    

        <div class="company-details">
            <p class="details-label"></p>
            <p>Kinfra Hi-tech Park, HMT Colony PO, Kalamassery,<br>
               North Kalamassery, Kochi ,Kerala - 683503 <br>
               Mob : +91 9947928331

</p>
           
            <!-- Add more company details as needed -->
        </div>
    </div>
</body>

</div>
@endsection
