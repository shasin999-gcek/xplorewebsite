
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Xplore'19 Ticket</title>
    
    <style>

    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
        background: linear-gradient(rgba(3, 3, 3, 0.04), rgba(9, 9, 9, 0.04));
        background-repeat: no-repeat;
        background-position: center;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box >.top {
        padding-bottom: 20px;
    }
    
    .invoice-box .top .title {
        font-size: 45px;
        
        color: #333;
    }

    .invoice-box .top .title .data {
        font-size: 16px;
        float:right;
    }


    .invoice-box .information .details {
        padding-bottom: 40px;
    }

    .invoice-box .information .details .to {
       float:left;
       padding:25px;
       font-weight: 600;
    }
    .invoice-box .information .details .from {
       float:right;
       padding:25px;
       font-weight:600;
    }

    .invoice-box .bank {
    	padding: 28px;
    	font-size: 10px;
    	text-align: center;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="top">
    		<div class="title">
    			<img src="{{ public_path('img/logo.png') }}" style="width:100%; max-width:150px;">
    			<div class="data">
	    			Invoice #: {{ $orderId }}<br>
	                Created: {{ now()->toDayDateTimeString() }}<br>
	    		</div>    	
    		</div>
    		
        </div>
        <div class="information">
    		<div class="details">
    			<div class="to">
                                {{ $name }} <br>
                                {{ $email }}<br>
                                {{ $mobileNumber }}
    			</div>
    			<div class="from">
                                Chairman & Convenor, Finance<br>
                                Committee<br>
                                Xplore 19
    			</div>
    		</div>
    	</div>
        <table cellpadding="0" cellspacing="0">    
            <tr class="heading">
                <td>
                    Event/Workshop
                </td>
                
                <td>
                    Reg fee
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    {{ $event }}
                </td>
                
                <td>
                    {{ $paid }}
                </td>
            </tr>
            
            <tr class="total">
                <td></td>
                
                <td>
                   Total: {{ $paid }}
                </td>
            </tr>
        </table>
        <div class="bank">
        	<b>PROCESSED PAYMENT</b>: Transaction id: {{ $transId  }}, Bank : {{ $bankName  }},
        	Transaction Date: {{ $transDate->toDayDateTimeString() }}
        </div>
    </div>
</body>
</html>
