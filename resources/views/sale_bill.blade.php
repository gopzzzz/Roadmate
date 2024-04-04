@extends('layout.mainlayout')
@section('content')

<div class="content-wrapper">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
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
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2; 
            font-size: 15px; 
        }

        .invoice {
            width: 1000px;
            margin: 1px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            height: auto;
            
        }

        .invoice-header {
            text-align: center;
           
        }

        .invoice-title {
            font-size: 23px;
            
            font-weight: bold;
            color: #808080;
        }

        .company-logo {
            text-align: center;
            margin-top: 10px;

        }

        .company-logo img {
       
            max-width: 250px; /* Adjust the size of the logo */
            height: 85px;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .left-details,
        .right-details {
            width: 50%;
        }
       
    .right-details {
        padding: 2px;
        border-radius: 8px;
        max-width: 500px;
        line-height: 1.5;
    }

    .right-details p {
    margin: 2px 0; /* Adjust the top and bottom margin as needed */
}
    .details-label {
        font-size: 19px;    
        color: #000000;
        margin-bottom: 10px; /* Adjust spacing here */
        text-align: left;
    }

    .details-item {
        margin-bottom: 1px; 

        text-align:left;/* Adjust spacing here */
    }


    .highlight-background {
        background-color: #D3D3D3;
        padding: 2px;
        border-radius: 1px;
        display: inline-block;
        width: 250px;
        text-align:right;
    }

    .highlight-back{
        background-color: #f0f0f0;
        padding: 2px;
        border-radius: 2px;
        display: inline-block;
        width: 250px;
        text-align:right;
    }

    .highlight {
        background-color: #ffffff;
       
        border-radius: 1px;
        display: inline-block;
        width: 250px;
        text-align:right;
    }
   
    strong {
        display: inline-block;
        width: 150px;
        font-weight: normal;
        color: #333;
    }
    .invoice-detailss {
    display: flex;
    flex-wrap: wrap;
}

.box {
    background-color: #D3D3D3;
    padding: 1px;
    border: 2px solid #000000;
    box-sizing: border-box;
    width: 85%;
    height: 30px; 
}

.content {
    padding: 10px;
    box-sizing: border-box;
    width: 90%;
}

.left-container, .right-container {
    width: 50%;
}

        .billed-to p.details-label,
        .ship-to p.details-label {
            margin-bottom: 0;
        }

        .invoice-items {
            width: 92%;
            border-collapse: collapse;
            margin-bottom: 20px;
            
            
        }

        .invoice-items th {
            border: 2px solid #000000;
            padding: 12px;
            text-align: center;
          
        }
         .invoice-items td {
            border: 1px solid #ffffff;
            border-left:2px solid #000000;
            border-right:2px solid #000000;
            
            padding: 12px;
            text-align: left;
            
        }

        .invoice-items th {
            background-color: #D3D3D3;
            color: #000000;
        }
        .invoice-items td {
            background-color: #E9E9E4;
            color: #000000;
        }

        .total-row td {
            border-top: 1px solid #000000;
            border-right: 2px solid #000000;
            border-bottom: 2px solid #000000;
            background-color: #f0f0f0;
            
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
            margin-bottom: 2px;
        }

        .special-notes {
            width: 98%;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f8f9fa;
           
            margin-bottom: 5px; 
            height: 160px; /* Adjust the height as needed */
        }

        .special-notess {
            width: 98%;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #FCF55F;
            margin-top: 12px;
            height: 35px; /* Adjust the height as needed */
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
            
            font-size: 15px;
            margin-top: 10px;
        }
        

        .company-details {
            text-align: center;
            margin-top: 20px;
            width: 92%;
            padding: 10px;
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
<button class="print-button" onclick="printPage()">Print Page</button>
    <div class="invoice">
    <div class="company-logo" style="float: left">
    <img src="{{ asset('market/RoadMateLogo.png') }}" alt="Company Logo">
</div> <br><br>
<div class="invoice-header">
            <div class="invoice-title">Sale Bill</div>
        </div>
<br>

         

        <div class="invoice-details">
            <div class="left-details">
                <p class="details-label"></p>
                <p style="font-size:20px;"><b>NEXTWAVE ACCESS PRIVATE LIMITED</b></p>
                <p>Kinfra Hi-tech Park &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9995723014<br>
                HMT Colony PO,Kalamassery,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:info@roadmate.in" style="color: #3364FF; font-family: Arial; text-decoration: underline;" target="_blank">info@roadmate.in</a>

                North Kalamassery, Kochi, Kerala &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.RoadMate.in" target="_blank" style="color: #3364FF; font-family: Arial; text-decoration: underline;">www.RoadMate.in</a>

                683503 <br>
                32AAHCN5463A1ZU</p>
                
            </div>
            
              <!-- <div>9995723014<br><p style="color:#007bff">info@roadmate.in <br>www.RoadMate.in</p></div> -->
           
@foreach($salebill as $key)
            @endforeach
            <div class="right-details">
            
    <p class="details-label"></p><br><br>   
    <div class="details-item"><strong>Date:</strong> <span class="highlight-background">{{ $key->order_date }}</span></div>
    <div class="details-item"><strong>Invoice Number:</strong> <span class="highlight-background">RM/{{$key->invoice_number}}/{{ date('y') }}</span></div>
    <div class="details-item"><strong>Sales Order No:</strong> <span class="highlight-background">RM/SO/{{$key->invoice_number}}/{{ date('y') }}</span></div>
    <div class="details-item"><strong>E-way Bill No:</strong> <span class="highlight-background">0000{{$key->bill_number}}</span></div>
    <div class="details-item"><strong>Payment Due By:</strong> <span class="highlight-background">{{ $key->order_date }}</span></div>

</div>
        </div><br>
        <div class="invoice-detailss">
    <div class="left-container">
        <div class="box">
            <p class="details-label"><b>Billed to</b></p>
        </div>
        <div class="content left-content">
        <p>{{ $key->area }} {{ $key->area1 }} {{ $key->city }} <br>{{ $key->district }} {{ $key->state }}<br> {{ $key->country }} {{ $key->pincode }}</p>

        </div>
    </div>

    <div class="right-container">
        <div class="box">
            <p class="details-label"><b>Ship to</b></p>
        </div>
        <div class="content">
            <p>{{ $key->area }} {{ $key->area1 }} {{ $key->city }} <br>{{ $key->district }} {{ $key->state }}<br> {{ $key->country }} {{ $key->pincode }}</p>
        </div>
    </div>
</div>
<br><br>


        <table class="invoice-items">
            <thead>
                <tr>
                <th>#</th>
                    <th>Description</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>HSN Code</th>

                    <th>TAX</th>
                    <th>TAX.Amount</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
            @php  
$i=1;
$sum=0;   
$taxableamount=0;
$subtotal=0;
@endphp
            @foreach($salebill as $key)
            @php 
            $unitprice=(($key->offer_amount)/(1+(($key->tax)/100)));
            $taxamount=($unitprice*($key->tax/100));

$unitprice = number_format($unitprice, 2, '.', '');
$taxamount = number_format($taxamount, 2, '.', '');
            @endphp
                <tr> 
                <td>{{$i}}</td>

                    <td>{{$key->product_name}}</td>
                    <td>{{$unitprice}}</td>
                    <td>{{$key->qty}} </td>
                    <td>{{$key->hsncode}} </td>

                    <td>{{$key->tax}} %</td>
                    <td>{{($key->qty*$taxamount)}} </td>
                    <td>{{$key->qty*$key->offer_amount}}</td>
                   
                </tr>
                @php 
                $sum += $key->qty*$key->offer_amount;
$taxableamount += $taxamount*$key->qty;
$subtotal+= $key->qty*$unitprice;
$i++;

                @endphp
                @endforeach
                <!-- Add more rows as needed -->
            </tbody>
             <tfoot>
                <tr class="total-row">
                <td></td>
                    <td style="border: 2px solid #000000;">Total</td>
                    <td style="border: 2px solid #000000";></td>
                    <td style="border: 2px solid #000000";></td>
                    <td style="border: 2px solid #000000";></td>
                    <td style="border: 2px solid #000000";></td>
                    <td></td>
                    <td></td>
                </tr>
</tfoot>
        </table>  
        
<div class="invoice-details">
<div class="left-details">
<p class="details-label"></p>
<div class="special-notess box">
<p class="details-label" style="font-size:15px;"><b>Special Notes and Instructions</b></p>
</div>
<div class="special-notes box" style="background: #f0f0f0">

    </div>
    </div>
    <div class="right-details">
    
    <p><strong><span style="color: grey;"><b>SUBTOTAL:</b></span></strong><span class="highlight-back">₹{{ $subtotal }}</span></p>
            <p><strong><span style="color: grey;"><b>DELIVERY CHARGE:</b></span></strong><span class="highlight-back" >{{ $key->shipping_charge }}</span></p>
            <p><strong><span style="color: grey;"><b>(TAX RATE):</b></span></strong><span class="highlight-back">₹{{$taxableamount}}</span></p>
            <!-- <p><strong><span style="color: grey;"><b>TAX:</b></span></strong><span class="highlight-back"></span></p> -->
            <!-- <br><br> -->
            <p><strong><span style="color: grey;"><b>TOTAL:</b></span></strong><span class="highlight-back">₹{{ $sum +$key->shipping_charge }}</span></p>
        
    </div>
         
</div>
        <div style="color: grey;">Make all cheques payable to my company name</div>

    <div class="invoice-details">
        <div class="left-details">
    <p class="details-label"></p>  
    <div class="thank-you">
                <p style="color: grey; text-align:center; font-size:25px;"><b>Thank you for your business!</b></p>
                <p style="color: grey; font-size:14px;">Should you have any enquiries concerning this invoice,please contact us.</p>
                <!-- Add more thank-you notes as needed -->
            </div>
        </div> 

    <div class="right-details">
    <p class="details-label"></p>
        
            <p class="details-label" style="color: grey; font-size: 15px;"><b>BANK ACCOUNT DETAILS</b></p>
            <p><strong>Account holder:</strong><span class="highlight"> Nextwave Access Private Limited</span></p>
            <p><strong>Account Number: </strong><span class="highlight">116105000951</span></p>
            <p><strong>IFSC code: </strong><span class="highlight">ICIC0001161</span></p>
        
     </div>
</div>    

        <div class="company-details">
            <p class="details-label"></p>
            <p style="color: grey;">Kinfra Hi-tech Park, HMT Colony PO, Kalamassery,<br>
               North Kalamassery, Kochi ,Kerala - 683503 <br>
               Mob : +91 9947928331

</p>
           
            <!-- Add more company details as needed -->
        </div>
        
        <script>
        function printPage() {
            window.print();
        }
    </script>
    </div>
    
</body>
</div>

@endsection
