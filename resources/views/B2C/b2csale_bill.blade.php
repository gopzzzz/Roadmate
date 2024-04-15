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
          width: 1100px;
          margin: 1px auto;
          padding: 15px;
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
      .invoice-details {
          display: flex;
          justify-content: space-between;
          margin-bottom: 5px;
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
  .highlight-back{
      background-color: #f0f0f0;
      display: inline-block;
      width: 200px;
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

      .invoice-items {
          width: 100%;
          border-collapse: collapse;
          margin-bottom: 15px;
          
          
      }

      .invoice-items th {
          border: 1px solid #000000;
          padding: 5px;
        
      }
       .invoice-items td {
          border: 1px solid #ffffff;
          border-left:1px solid #000000;
          border-right:1px solid #000000;
          
          padding: 5px;
          text-align: left;
          
      }
      .total-row td {
          border-top: 1px solid #000000;
          border-right: 1px solid #000000;
          border-bottom: 1px solid #000000;
          
      }
      .invoice-items th:first-child {
  border: 1px solid black; /* Adjust border style as needed */
}

     
     
  </style>
</head>

<body>
<button class="print-button" onclick="printPage()">Print Page</button>
    <div class="invoice">
  
<div class="invoice-header">
            <div> <p style="font-size:20px;"><b>Tax Invoice</div></b></p>
        </div>
       
            
           
@foreach($salebill as $key)
            @endforeach
            <table class="invoice-items" >

<thead>
    <tr><th colspan="3" rowspan="3" style="font-weight: normal;"><b>RoadMate</b><br>
4th Floor, Kinfra Hi-Tech Park<br>
South Kalamassery, Kalamassery,<br>Ernakulam<br>Kerala-683503, India<br>GSTIN/UIN: 32AAHCN5463A1ZU</br>State Name: Kerala, Code: 32</br>
E-Mail:<a href="mailto:info@roadmate.in" style="color: #3364FF; font-family: Arial; " target="_blank">info@roadmate.in</a></th><th  colspan="3" style="font-weight: normal;">Invoice No.<br><b>RM/{{$key->invoice_number}}/{{ date('y') }}</b></th>
<th colspan="3" style="font-weight: normal;">Dated<br><b>{{ date('j-M-Y', strtotime($key->order_date)) }}</b></th>
<tr>
<th colspan="3" style="font-weight: normal;">Delivery Note<br><br></th>
<th colspan="3" style="font-weight: normal;">Mode/Terms of Payment<br><br></th>
</tr>
   <tr><th colspan="3" style="font-weight: normal;">Reference No. & Date.<br><br></th>
   <th colspan="3" style="font-weight: normal;">Other References<br><br></th></tr>

    <tr><th colspan="3" rowspan="4"  style="font-weight: normal;">Consignee(Ship to)<br>
<b>{{ $key->name }}</b><br>
{{ $key->area }} {{ $key->area1 }} {{ $key->city }}<br>{{ $key->district }}, {{ $key->state }}<br>Mob: {{ $key->phone }}<br>{{ $key->state }} - {{ $key->pincode }},  {{ $key->country }}<br>State Name: {{ $key->state }}
</th></tr>
<tr><th colspan="3" style="font-weight: normal;">Buyers Order No.<br><br></th>
<th colspan="3" style="font-weight: normal;">Dated<br><br></th></tr>
<tr><th colspan="3" style="font-weight: normal;">Dispatch Doc No.<br><br></th>
<th colspan="3" style="font-weight: normal;">Delivery Note Date<br><br></th></tr>
<tr><th colspan="3" style="font-weight: normal;">Dispatched through.<br><br></th>
<th colspan="3" style="font-weight: normal; vertical-align: top;">Destination<br><br></th></tr>

<tr><th colspan="3" rowspan="1" style="font-weight: normal;">Buyer(Bill to)<br>
<b>{{ $key->name }}</b><br>
{{ $key->area }} {{ $key->area1 }} {{ $key->city }}<br>{{ $key->district }}, {{ $key->state }}<br>Mob: {{ $key->phone }}<br>{{ $key->state }} - {{ $key->pincode }},  {{ $key->country }}<br>State Name: {{ $key->state }}
</th><th colspan="6" style="font-weight: normal; text-align: left; vertical-align: top;">Terms of Delivery<br></th></tr>

<thead>
    <tr>
    <th style="  border: 2px solid #000000;">Sl No.</th>
        <th style=" border: 2px solid #000000;">Description</th>
        <th style=" border: 2px solid #000000;">Unit Price</th>
        <th style=" border: 2px solid #000000;">Quantity</th>
        <th style=" border: 2px solid #000000;  ">HSN Code</th>
        <th style=" border: 2px solid #000000;">Tax</th>
        <th style=" border: 2px solid #000000; ">Tax.Amt</th>

        <th style=" border: 2px solid #000000;" colspan="4">Amount</th>
    </tr>
</thead>
<tbody>
@php  
    $i = 1;
    $sum = 0;
    $taxableamount = 0;
    $subtotal = 0;
    $totalQuantity = 0;

@endphp  

@foreach($salebill as $key)
    @php 
        $unitprice = (($key->selling_rate) / (1 + (($key->tax) / 100)));
        $taxamount = ($unitprice * ($key->tax / 100));
        $unitprice = number_format($unitprice, 2, '.', '');
        $taxamount = number_format($taxamount, 2, '.', '');
        $totalQuantity += $key->qty;

    @endphp
  
    <tr> 
        <td style="border-right: 2px solid #000000;border-left: 2px solid #000000; ">{{$i}}</td>
        <td style=" border-right: 2px solid #000000;border-left: 2px solid #000000;">{{$key->product_name}}</td>
        <td style="text-align: right; border-right: 2px solid #000000;border-left: 2px solid #000000;">{{$unitprice}}</td>
        <td style="text-align: right; border-right: 2px solid #000000;border-left: 2px solid #000000;"><b>{{$key->qty}} NOS</b></td>
        <td style="text-align: right; border-right: 2px solid #000000;border-left: 2px solid #000000;">{{$key->hsncode}}  </td>

        <td style="text-align: right; border-right: 2px solid #000000;border-left: 2px solid #000000;">{{$key->tax}} %</td>
        <td style="text-align: right; border-right: 2px solid #000000;border-left: 2px solid #000000;" >{{$taxamount * $key->qty}}</td>
        <td style="text-align: right; border-right: 2px solid #000000;"> {{$key->qty*$key->selling_rate}}</td>

    </tr>
</tbody>
     @php 
                $sum += $key->qty*$key->selling_rate;
$taxableamount += $taxamount*$key->qty;
$subtotal+= $key->qty*$unitprice;
$i++;
$totalsubtotal= ($sum + $key->shipping_charge) ;
                @endphp
                @endforeach
                </tbody>
           
                <tr class="total-row">
                <td style="border-right: 2px solid #000000; border-bottom: 2px solid #000000;border-left: 2px solid #000000; "></td>
                    <td style="border: 2px solid #000000;">Total</td>
                    <td style="border: 2px solid #000000";></td>
                    <td style="border: 2px solid #000000; text-align: right;";><b>{{ $totalQuantity }} NOS</b></td>
                    <td style="border: 2px solid #000000";></td>

                    <td style="border: 2px solid #000000";></td>
                    <td style="border-right: 2px solid #000000; border-bottom: 2px solid #000000;" ></td>
                    <td style="border-bottom: 2px solid #000000; border-right: 2px solid #000000;"></td>
                    
                </tr>
         
         
          
                <tr  style="text-align: right;" colspan="4">
    <td  style="text-align: right;  border-right: none;" colspan="5"><strong><b>SUBTOTAL:</span></strong></td>
    <td  style="text-align: right; border-left: none;" colspan="4"><span class="highlight-back">₹{{ number_format($subtotal,2) }}</span></td>
  </tr>
  <tr  style="text-align: right;">
    <td  style="text-align: right;  border-right: none;" colspan="5"><strong><b>DELIVERY CHARGE:</b></strong></td>
    <td  style="text-align: right; border-left: none;" colspan="4"><span class="highlight-back">{{ $key->shipping_charge }}</span></td>
  </tr>
  <tr  style="text-align: right;" colspan="4">
    <td  style="text-align: right;  border-right: none;" colspan="5"><strong><b>(TAX RATE):</b></strong></td>
    <td  style="text-align: right; border-left: none;"  colspan="4"><span class="highlight-back">₹{{ number_format($taxableamount,2) }}</span></td>
  </tr>
  
  <tr  style="text-align: right;" colspan="4">
    <td  style="text-align: right; border-right: none;"  colspan="5" ><strong><b>TOTAL:</b></strong></td>
    <td  style="text-align: right; border-left: none;" colspan="4"><span class="highlight-back">₹{{ $totalsubtotal }}</span></td>
  </tr>

  </tbody>

                <tr>    <td style="border-left: 1px solid #000000; border-right: none; font-weight: normal; text-align: left;" colspan="5">Amount Chargeable (in words)</td>
    <td style="border-right:1px solid #000000; border-left: none; font-weight: normal; text-align: right;" colspan="4"><i>E. & O.E</i></td>
</tr>

    </tr>
    <tr>    <td style="font-weight: normal; text-align: left; font-size: 16px; "  colspan="9"><b>INR {{ numberToWords($totalsubtotal) }} Only</b></td> </tr>   
         
    <tr>
   
    <td style="text-align:left; border-bottom: none; border-right: 1px solid #000000;"  colspan="9">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Total%20Amount%3A%20{{ $totalsubtotal }}" alt="QR Code">
        
    </td>
   </tr>

              
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
