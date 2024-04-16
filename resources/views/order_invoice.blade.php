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
       
            max-width: 210px; /* Adjust the size of the logo */
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
    border: 1px solid #000000;
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
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            
            
        }

        .invoice-items th {
            border: 1px solid #000000;
            padding: 12px;
          
        }
         .invoice-items td {
            border: 1px solid #ffffff;
            border-left:1px solid #000000;
            border-right:1px solid #000000;
            
            padding: 12px;
            text-align: left;
            
        }

      

        .total-row td {
            border-top: 1px solid #000000;
            border-right: 1px solid #000000;
            border-bottom: 1px solid #000000;
            
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

        .invoice-items th:first-child {
    border: 1px solid black; /* Adjust border style as needed */
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
  
<div class="invoice-header">
            <div> <p style="font-size:20px;"><b>Tax Invoice</div></b></p>
        </div>
        <div id="qrcode"></div>
<br>


      
           
@foreach($invoice as $key)
            @endforeach
        <table class="invoice-items" >

            <thead>
                <tr><th colspan="3" rowspan="3" style="font-weight: normal;"><b>RoadMate</b><br>
            4th Floor, Kinfra Hi-Tech Park<br>
        South Kalamassery, Kalamassery,<br>Ernakulam<br>Kerala-683503, India<br>GSTIN/UIN: 32AAHCN5463A1ZU</br>State Name: Kerala, Code: 32</br>
    E-Mail: info@roadmate.in</th><th  colspan="3" style="font-weight: normal;">Invoice No.<br><b>RM/{{$key->order_id}}/{{ date('y') }}</b></th>
    <th  colspan="3" style="font-weight: normal;">Dated<br><b>{{ $key->order_date }}</b></th></tr>
    <tr>
    <th colspan="3" style="font-weight: normal;">Delivery Note<br><br></th>
    <th colspan="3" style="font-weight: normal;">Mode/Terms of Payment<br><br></th>
</tr>
               <tr><th colspan="3" style="font-weight: normal;">Reference No. & Date.<br><br></th>
               <th colspan="3" style="font-weight: normal;">Other References<br><br></th></tr>

                <tr><th colspan="3" rowspan="4"  style="font-weight: normal;">Consignee(Ship to)<br>
           <b>{{ $key->shopname }}</b><br>
           {{ $key->area }} {{ $key->area1 }} {{ $key->city }}<br>{{ $key->district }}, {{ $key->state }}<br>Mob: {{ $key->phone }}<br>{{ $key->state }} - {{ $key->pincode }},  {{ $key->country }}<br>State Name: {{ $key->state }}
   </th></tr>
   <tr><th colspan="3" style="font-weight: normal;">Buyers Order No.<br><br></th>
   <th colspan="3" style="font-weight: normal;">Dated<br><br></th></tr>
   <tr><th colspan="3" style="font-weight: normal;">Dispatch Doc No.<br><br></th>
   <th colspan="3" style="font-weight: normal;">Delivery Note Date<br><br></th></tr>
   <tr><th colspan="3" style="font-weight: normal;">Dispatched through.<br><br></th>
   <th colspan="3" style="font-weight: normal; vertical-align: top;">Destination<br><br></th></tr>

   <tr><th colspan="3" rowspan="1" style="font-weight: normal;">Buyer(Bill to)<br>
           <b>{{ $key->shopname }}</b><br>
           {{ $key->area }} {{ $key->area1 }} {{ $key->city }}<br>{{ $key->district }}, {{ $key->state }}<br>Mob: {{ $key->phone }}<br>{{ $key->state }} - {{ $key->pincode }},  {{ $key->country }}<br>State Name: {{ $key->state }}
   </th><th colspan="6" style="font-weight: normal; text-align: left; vertical-align: top;">Terms of Delivery<br></th></tr>


   <thead>
    <tr>
        <th style="font-weight: normal;">Sl<br>No.</th>
        <th style="font-weight: normal;">Description of Goods</th>
        <th style="font-weight: normal;">HSN/SAC</th>
        <th style="font-weight: normal;">GST Rate</th>
        <th style="font-weight: normal;  width: 5%;">Quantity</th>
        <th style="font-weight: normal;">Rate</th>
        <th style="font-weight: normal; width: 5%;">Per</th>
        <th style="font-weight: normal;" colspan="2">Amount</th>
    </tr>
</thead>
<tbody>
@php  
    $i = 1;
    $sum = 0;
    $taxableamount = 0;
    $subtotal = 0;
    $totalQuantity = 0;
    $totalSum = 0;
    $totalcgst=0;
    $totalsgst=0;
    $totalsubtotal=0;
    $totaltaxamount=0;
@endphp  

@foreach($invoice as $key)
    @php 
        $unitprice = (($key->offer_amount) / (1 + (($key->tax) / 100)));
        $taxamount = ($unitprice * ($key->tax / 100));
        $unitprice = number_format($unitprice, 2, '.', '');
        $taxamount = number_format($taxamount, 2, '.', '');
        $totalQuantity += $key->qty;
        $totalSum += $key->qty * $key->offer_amount+ $key->shipping_charge;
        $totalcgst=($totalSum * ($key->igst / 100));
        $totalsgst=($totalSum * ($key->cgst / 100));
        $totalsubtotal=($totalSum + $totalcgst + $totalsgst);
        $totaltaxamount=($totalcgst + $totalsgst);
    @endphp
    <tr> 
        <td>{{$i++}}</td>
        <td><b>{{$key->product_name}}</b></td>
        <td></td>
        <td style="text-align: right;">{{$key->tax}} % </td>
        <td style="text-align: right;"><b>{{$key->qty}} NOS</b></td>
        <td style="text-align: right;">{{$key->offer_amount}}</td>
        <td style="text-align: right;">NOS</td>
        <td style="text-align: right;" colspan="2"><b>{{$key->qty * $key->offer_amount+ $key->shipping_charge}}</b></td>
    </tr>
@endforeach

<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td style="border-top: 2px solid #000000; text-align: right;" colspan="2">{{$totalSum}}</td>
</tr>
</tbody>

         
                <tr>
    <td style="font-weight: normal;">&nbsp;</td>
    <td style="font-weight: normal; text-align: right;"><b>SGST</b></td>
    <td style="font-weight: normal;">&nbsp;</td>
    <td style="font-weight: normal;">&nbsp;</td>
    <td style="font-weight: normal;">&nbsp;</td>
    <td style="font-weight: normal; text-align: right;">{{$key->cgst}}</td>
    <td style="font-weight: normal; text-align: left;"> %</td>
    <td style="font-weight: normal; text-align: right;" colspan="2"><b>{{$totalsgst}}</b></td>
</tr>
<tr>
    <td style="font-weight: normal;">&nbsp;</td>
    <td style="font-weight: normal; text-align: right;"><b>CGST</b></td>
    <td style="font-weight: normal;">&nbsp;</td>
    <td style="font-weight: normal;">&nbsp;</td>
    <td style="font-weight: normal;">&nbsp;</td>
    <td style="font-weight: normal; text-align: right;">{{$key->igst}}</td>
    <td style="font-weight: normal; text-align: left;"> %</td>
    <td style="font-weight: normal; text-align: right;" colspan="2"><b>{{$totalcgst}}</b></td>
</tr>
<tr> 
        <td style="text-align: right;"></td>
        
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;" colspan="2"></td>
    </tr>
    <tr> 
        <td style="text-align: right;" ></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;" colspan="2"></td>
    </tr>
                @php 
                $sum += $key->qty*$key->offer_amount;
$taxableamount += $taxamount*$key->qty;
$subtotal+= $key->qty*$unitprice;
$i++;

                @endphp
                
               
                <!-- Add more rows as needed -->
            </tbody>
          
           
                <tr class="total-row">
                <td style="border: 2px solid #000000;"></td>
                    <td style="border: 2px solid #000000; text-align: right;">Total</td>
                    <td style="border: 2px solid #000000";></td>
                    <td style="border: 2px solid #000000";></td>
                    <td style="border: 2px solid #000000; font-size: 15px; text-align: right;"><b>{{$totalQuantity}} NOS</b></td>

                    <td style="border: 2px solid #000000";></td>
                    <td style="border: 2px solid #000000";></td>
                    <td style="border: 2px solid #000000; font-size: 20px; text-align: right;" colspan="2"><b>₹ {{ $totalsubtotal}}</b> </td>
                    
                </tr>
                <tr>    <td style="border-left: 1px solid #000000; border-right: none; font-weight: normal; text-align: left;" colspan="5">Amount Chargeable (in words)</td>
    <td style="border-right:1px solid #000000; border-left: none; font-weight: normal; text-align: right;" colspan="4"><i>E. & O.E</i></td>
</tr>

    </tr>
    <tr>    <td style="font-weight: normal; text-align: left; font-size: 16px; border-bottom: 1px solid #000000;"  colspan="9"><b>INR {{ numberToWords($totalsubtotal) }} Only</b></td> </tr>   
         
    <tr>
    <!-- QR code image on the right side -->
    <th style="text-align: right;"  rowspan="6">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Total%20Amount%3A%20{{ $totalsubtotal }}" alt="QR Code">
    </th>
    <!-- Table on the left side -->
  
            <!-- Table rows -->
      
                <th style="font-weight: normal; text-align: right;" colspan="2" rowspan="2">Taxable<br> Value</th>
                <th style="font-weight: normal;" colspan="2">CGST</th>
                <th style="font-weight: normal;" colspan="2">SGST/UTGST</th>
                <th style="font-weight: normal;" colspan="2" rowspan="2">Total Tax Amount</th>
    </tr>
            <tr>
              
             

                <th style="font-weight: normal;">Rate</th>
                <th style="font-weight: normal;">Amount</th>
                <th style="font-weight: normal;">Rate</th>
                <th style="font-weight: normal;">Amount</th>
            </tr>
            <tr> 

            <td style="text-align: right;" colspan="2">{{$totalSum}}</td>
                <td style="text-align: right;">{{$key->igst}} %</td>
                <td style="text-align: right;">{{$totalcgst}}</td>
                <td style="text-align: right;">{{$key->cgst}} %</td>
                <td style="text-align: right;">{{$totalsgst}}</td>
                <td style="text-align: right;">{{ $totaltaxamount}}</td>
            </tr>
            <!-- More table rows can be added here -->
       
    </td>
</tr>
</tr>
    <tr> 
        
        <td style="text-align: right;"  colspan="2"></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
    </tr>
    <tr> 
        <td style="text-align: right;"  colspan="2"></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
    </tr>
   
    <tr class="total-row">
    <td style="border: 2px solid #000000; text-align: right; " colspan="2"><b>Total:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        {{$totalSum}}</b></td>
                    <td style="border: 2px solid #000000; text-align: right;"><b></b></td>
                    <td style="border: 2px solid #000000; text-align: right;"><b>{{$totalcgst}}</b></td>
                    <td style="border: 2px solid #000000; text-align: right;"><b></b></td>
                    <td style="border: 2px solid #000000; font-size: 15px; text-align: right;"><b>{{$totalsgst}}</b></td>

                    <td style="border: 2px solid #000000; text-align: right;"><b>{{ $totaltaxamount}}</b></td>
                   
                    
                </tr>
    </div>

              
                <tr>    <td style="font-weight: normal; text-align: left; font-size: 16px;"  colspan="9">Tax Amount(in words) : <b>INR {{ numberToWords($totaltaxamount) }} Only</b></td> </tr>   
                <tr>    <td style="font-weight: normal; text-align: left;"  colspan="9"><u>Declaration</u></td> </tr>   
                <tr>    <td style="font-weight: normal; text-align: left; border-bottom: 1px solid #000000;"  colspan="9">We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.</td> </tr>   

                <tr>    <td style="border-left: 1px solid #000000; border-bottom: 1px solid #000000; border-right: none; font-weight: normal; text-align: left;" colspan="3">Customer's Seal and Signature<br><br><br></td>
    <td style="border-right:1px solid #000000; border-bottom: 1px solid #000000; font-weight: normal; text-align: right;" colspan="6"><b>for RoadMate</b><br><br><br>Authorised Signatory</td>
</tr>
        </table>
       <center>  This is a Computer Generated Invoice</center>

    
    </table>
   
        <script>
        function printPage() {
            window.print();
        }
    </script>
 <?php
function numberToWords($number) {
    // Define arrays for words
    $ones = array(
        0 => 'Zero', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen', 19 => 'Nineteen'
    );
    $tens = array(
        0 => '', 1 => '', 2 => 'Twenty', 3 => 'Thirty', 4 => 'Forty', 5 => 'Fifty', 6 => 'Sixty', 7 => 'Seventy', 8 => 'Eighty', 9 => 'Ninety'
    );
    $hundreds = array(
        '', 'One Hundred', 'Two Hundred', 'Three Hundred', 'Four Hundred', 'Five Hundred', 'Six Hundred', 'Seven Hundred', 'Eight Hundred', 'Nine Hundred'
    );

    // Split the number into integer and fractional parts
    $parts = explode('.', $number);
    $integerPart = $parts[0];
    $fractionalPart = isset($parts[1]) ? $parts[1] : '';

    $num = abs((int)$integerPart);
    $words = '';

    if ($num >= 1000) {
        $words .= numberToWords(floor($num / 1000)) . ' Thousand ';
        $num %= 1000;
    }

    if ($num >= 100) {
        $words .= $hundreds[floor($num / 100)] . ' ';
        $num %= 100;
    }

    if ($num >= 20) {
        $words .= $tens[floor($num / 10)] . ' ';
        $num %= 10;
    }

    if ($num > 0) {
        $words .= $ones[$num] . ' ';
    }

    // Add "and" after the point if there's anything left
    if ($fractionalPart != '') {
        $words .= 'and ';
    }

    // Convert the fractional part if it exists
    if ($fractionalPart != '') {
        $words .= numberToWords($fractionalPart) . ' Paise';
    }

    return $words;
}


?>
         
        
    </div>
    
</body>
</div>

@endsection
