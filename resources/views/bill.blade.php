@extends('layout.mainlayout')
@section('content')

<div class="content-wrapper">

<head>
    <style>
        
   
          /* Style the button for both screen and print media */
          .print-button {
            background: linear-gradient(45deg, #007bff, #00ff00); /* Use a gradient background with a mix of two colors */
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
    background: linear-gradient(45deg, #8e44ad, #e67e22);
    color: #000; /* Black text color for readability */
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

<body>
    <div class="invoice" style= "border: 2px solid #000; ">
        <!-- <div class="invoice-header">
            <div class="invoice-title">Invoice</div>
        </div> -->
        <div class="invoice-details" >
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
        <table style= "border: 2px solid black;">

<div style="display: flex; flex-direction: column; align-items: center;">
    <div style="display: flex; align-items: center;">

        <img src="{{ asset('/market/RoadMateLogo.png') }}" alt="" width="200" height="100" style="margin-right: 10px;" />
        <span style="font-family: 'Times New Roman', Times, serif; font-size: 25px; font-weight: bold; margin-right: 10px;">NEXTWAVE ACCESS PRIVATE LIMITED</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span style="font-family: 'Times New Roman', Times, serif; font-size: 34px; font-weight: bold;">PURCHASE ORDER</span>
    </div>
    </div>

<div style="margin-left: 740px; display: flex; flex-direction: column;  ">
    <span style="font-family: 'Montserrat', sans-serif; font-size: 13px; font-weight: bold; ">DATE: <span style="background-color: #ffffcc; padding: 5px;">22/01/2024</span></span>
    <span style="font-family: 'Montserrat', sans-serif; font-size: 13px; font-weight: bold; margin-top: 10px;">PURCHASE ORDER NUMBER: <span style="background-color: #ffffcc; padding: 5px;">RM/PO/001/24</span></span>
</div>

<div style="display: flex; flex-direction: column;">
    <span style="font-family: 'Montserrat', sans-serif; font-size: 15px;  margin-top: 10px;">[Company Address]</span></span>
    <span style="font-family: 'Montserrat', sans-serif; font-size: 15px;  margin-top: 10px;">[Street name, City,  ZIP]</span></span>
    <span style="font-family: 'Montserrat', sans-serif; font-size: 15px;  margin-top: 10px;">Phone: [000-000-0000]</span></span>
    <span style="font-family: 'Montserrat', sans-serif; font-size: 15px;  margin-top: 10px;">Fax: [000-000-0000]</span></span>
</div>



<div style="display: flex; flex-direction: row; margin-top: 40px;">

    <!-- Vendor Name Details -->
    <div style="margin-right: 350px; display: flex; flex-direction: column;">
        <span style="font-family: 'Montserrat', sans-serif; font-size: 15px; font-weight: bold; margin-top: 10px;"><span style="background-color: #f2f2f2; padding: 10px; display: inline-block; margin-right: -30px;">VENDOR NAME</span></span>
        <span style="font-family: 'Montserrat', sans-serif; font-size: 15px; margin-top: 10px;">[Name]</span>
        <span style="font-family: 'Montserrat', sans-serif; font-size: 15px; margin-top: 10px;">[Company Name]</span>
        <span style="font-family: 'Montserrat', sans-serif; font-size: 15px; margin-top: 10px;">[Address]</span>
        <span style="font-family: 'Montserrat', sans-serif; font-size: 15px; margin-top: 10px;">[City, ST ZIP]</span>
        <span style="font-family: 'Montserrat', sans-serif; font-size: 15px; margin-top: 10px;">[Phone & Email]</span>
    </div>

    <!-- Shipping Address Details -->
    <div style="margin-right: 30px; display: flex; flex-direction: column;">
        <span style="font-family: 'Montserrat', sans-serif; font-size: 15px; font-weight: bold; margin-top: 10px;"><span style="background-color: #f2f2f2; padding: 10px; display: inline-block; margin-right: -30px;">SHIPPING ADDRESS</span></span>
        <span style="font-family: 'Montserrat', sans-serif; font-size: 15px; margin-top: 10px;">[Name]</span>
        <span style="font-family: 'Montserrat', sans-serif; font-size: 15px; margin-top: 10px;">[Company Name]</span>
        <span style="font-family: 'Montserrat', sans-serif; font-size: 15px; margin-top: 10px;">[Address]</span>
        <span style="font-family: 'Montserrat', sans-serif; font-size: 15px; margin-top: 10px;">[City, ST ZIP]</span>
        <span style="font-family: 'Montserrat', sans-serif; font-size: 15px; margin-top: 10px;">[Phone & Email]</span>
    </div>

</div>
<table style="margin-top: 50px;">
   
           
            <tr>
                    <th style="text-align: center;">REQUISITIONER</th>
                    <th style="text-align: center;">SHIP VIA</th>
                    <th style="text-align: center;">F.O.B.</th>
                    <th style="text-align: center;">SHIPPING TERMS</th>

                  
                </tr>
                
                <tr  style="border: 1px solid grey;">
                <td style="border: 2px solid #f2f2f2;">1</td>
                <td style="border: 2px solid #f2f2f2;"></td>
                <td style="border: 2px solid #f2f2f2;"></td>          
                <td style="border: 2px solid #f2f2f2;"></td>                </tr>    
            </table>

            <table style="margin-top: 50px; border-collapse: collapse; width: 100%;">
   
           
            <tr>
    <th style="text-align: center; width: 15%;">ITEM #</th>
    <th style="text-align: center; width: 40%;">DESCRIPTION</th>
    <th style="text-align: center; width: 10%;">QTY</th>
    <th style="text-align: center; width: 20%;">UNIT PRICE (Including GST)</th>
    <th style="text-align: center; width: 20%;">TOTAL</th>
</tr>
       
       <tr  style="border: 1px solid grey;">
           <td style="border: 2px solid #f2f2f2;;">[123456]</td>
           <td style="border: 2px solid #f2f2f2;">Product A</td>
           <td style="border: 2px solid #f2f2f2; text-align: center;">0</td>
           <td style="border: 2px solid #f2f2f2; text-align: right;">₹0.00</td>
           <td style="border: 2px solid #f2f2f2; background-color: #FFDAB9; text-align: right;">₹0.00</td>
       </tr> 
       <tr  style="border: 1px solid grey;">
           <td style="border: 2px solid #f2f2f2;">[121212]</td>
           <td style="border: 2px solid #f2f2f2;">Product B</td>
           <td style="border: 2px solid #f2f2f2; text-align: center;">0</td>
           <td style="border: 2px solid #f2f2f2; text-align: right;">₹0.00</td>
           <td style="border: 2px solid #f2f2f2; background-color: #FFDAB9; text-align: right;">₹0.00</td>
       </tr>   <tr  style="border: 1px solid grey;">
           <td style="border: 2px solid #f2f2f2;">[131313]</td>
           <td style="border: 2px solid #f2f2f2;">Product C</td>
           <td style="border: 2px solid #f2f2f2; text-align: center;">0</td>
           <td style="border: 2px solid #f2f2f2; text-align: right;">₹0.00</td>
           <td style="border: 2px solid #f2f2f2; background-color: #FFDAB9; text-align: right;">₹0.00</td>
       </tr>   <tr  style="border: 1px solid grey;">
           <td style="border: 2px solid #f2f2f2;;">[141414]</td>
           <td style="border: 2px solid #f2f2f2;">Product D</td>
           <td style="border: 2px solid #f2f2f2; text-align: center; ">0</td>
           <td style="border: 2px solid #f2f2f2; text-align: right;">₹0.00</td>
           <td style="border: 2px solid #f2f2f2; background-color: #FFDAB9; text-align: right;">₹0.00</td>
       </tr> 
       <tr  style="border: 1px solid grey;">
           <td style="border: 2px solid #f2f2f2;">[151515]</td>
           <td style="border: 2px solid #f2f2f2;">Product E</td>
           <td style="border: 2px solid #f2f2f2; text-align: center;">0</td>
           <td style="border: 2px solid #f2f2f2; text-align: right;">₹0.00</td>
           <td style="border: 2px solid #f2f2f2; background-color: #FFDAB9; text-align: right;">₹0.00</td>
       </tr> 
       <tr  style="border: 1px solid grey;">
           <td style="border: 2px solid #f2f2f2;"></td>
           <td style="border: 2px solid #f2f2f2;"></td>
           <td style="border: 2px solid #f2f2f2; text-align: center;"></td>
           <td style="border: 2px solid #f2f2f2; text-align: right;"></td>
           <td style="border: 2px solid #f2f2f2; background-color: #FFDAB9; text-align: right;">₹0.00</td>
       </tr>    <tr  style="border: 1px solid grey;">
       <td style="border: 2px solid #f2f2f2;"></td>
           <td style="border: 2px solid #f2f2f2;"></td>
           <td style="border: 2px solid #f2f2f2; text-align: center;"></td>
           <td style="border: 2px solid #f2f2f2; text-align: right;"></td>
           <td style="border: 2px solid #f2f2f2; background-color: #FFDAB9; text-align: right;">₹0.00</td>
       </tr>    <tr  style="border: 1px solid grey;">
       <td style="border: 2px solid #f2f2f2;"></td>
           <td style="border: 2px solid #f2f2f2;"></td>
           <td style="border: 2px solid #f2f2f2; text-align: center;"></td>
           <td style="border: 2px solid #f2f2f2; text-align: right;"></td>
           <td style="border: 2px solid #f2f2f2; background-color: #FFDAB9; text-align: right;">₹0.00</td>
       </tr>    <tr  style="border: 1px solid grey;">
       <td style="border: 2px solid #f2f2f2;"></td>
           <td style="border: 2px solid #f2f2f2;"></td>
           <td style="border: 2px solid #f2f2f2; text-align: center;"></td>
           <td style="border: 2px solid #f2f2f2; text-align: right;"></td>
           <td style="border: 2px solid #f2f2f2; background-color: #FFDAB9; text-align: right;">₹0.00</td>
       </tr>    <tr  style="border: 1px solid grey;">
       <td style="border: 2px solid #f2f2f2;"></td>
           <td style="border: 2px solid #f2f2f2;"></td>
           <td style="border: 2px solid #f2f2f2; text-align: center;"></td>
           <td style="border: 2px solid #f2f2f2; text-align: right;"></td>
           <td style="border: 2px solid #f2f2f2; background-color: #FFDAB9; text-align: right;">₹0.00</td>
       </tr>    <tr  style="border: 1px solid grey;">
       <td style="border: 2px solid #f2f2f2;"></td>
           <td style="border: 2px solid #f2f2f2;"></td>
           <td style="border: 2px solid #f2f2f2; text-align: center;"></td>
           <td style="border: 2px solid #f2f2f2; text-align: right;"></td>
           <td style="border: 2px solid #f2f2f2; background-color: #FFDAB9; text-align: right;">₹0.00</td>
       </tr> 
       <div style="margin-top: 20px;">

<!-- Tax Analysis Table -->
<table style="border-collapse: collapse; width: 55%; float: left;">
    <tr>
        <th style="text-align: center; background-color: grey;" colspan="4">TAX ANALYSIS</th>
    </tr>
    <tr>
        <th style="text-align: center; background-color: white; border: 1px solid black; font-weight: normal;">SI NO</th>
        <th style="text-align: center; background-color: white; border: 1px solid black; font-weight: normal;">HSN CODE</th>
        <th style="text-align: center; background-color: white; border: 1px solid black; font-weight: normal;">SGST</th>
        <th style="text-align: center; background-color: white; border: 1px solid black; font-weight: normal;">CGST</th>
    </tr>
    <tr style="border: 1px solid grey;">
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
    </tr>
    <tr style="border: 1px solid grey;">
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
    </tr>
    <tr style="border: 1px solid grey;">
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
    </tr>
</table>

<!-- Subtotal Table -->
<table style="border-collapse: collapse; width: 35%; float: right;">
    <tr>
        <th style="text-align: left; background-color: white; font-weight: normal;">SUBTOTAL</th>
        <th style="text-align: right; background-color: white; width: 15%; font-weight: normal;">₹0.00</th>
    </tr>
    <tr>
        <th style="text-align: left; background-color: white; font-weight: normal;">TAX RATE</th>
        <th style="text-align: right; background-color: white; width: 15%; font-weight: normal;">₹0.00</th>
    </tr>
    <tr>
        <th style="text-align: left; background-color: white; font-weight: normal;">TAX</th>
        <th style="text-align: right; background-color: white; width: 15%; font-weight: normal;">₹0.00</th>
    </tr>
    <tr>
        <th style="text-align: left; background-color: white; font-weight: normal;">S & H</th>
        <th style="text-align: right; background-color: white; width: 15%; font-weight: normal;">₹0.00</th>
    </tr>
    <tr>
        <th style="text-align: left; background-color: white; font-weight: normal;">Miscellaneous</th>
        <th style="text-align: right; background-color: white; width: 15%; font-weight: normal;">₹0.00</th>
    </tr>
    <tr>
        <th style="text-align: left; border: 2px solid black;">TOTAL</th>
        <th style="text-align: right; border: 2px solid black;">₹0.00</th>
    </tr>
</table>
<div style="clear: both;"></div>

</div>

  
    <hr style="border: 1px solid black;">
    <div style="display: flex; flex-direction: row;">
    <span style="font-family: 'Montserrat', sans-serif; font-size: 18px;  margin-left: 80px; margin-right: 250px; margin-bottom: 100px;">Approved By</span>
    <span style="font-family: 'Montserrat', sans-serif; font-size: 18px; margin-right: 250px; margin-bottom: 100px;">Authorized by:</span>
    <span style="font-family: 'Montserrat', sans-serif; font-size: 18px; margin-right: 20px; margin-bottom: 100px;">Checked By</span>
</div>











    
       
     

    </div>

</body>

</div>

@endsection