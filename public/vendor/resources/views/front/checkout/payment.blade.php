<html>
	<head>
    	<title>Please Wait...</title>
    </head>
    
    <body>
        Please Wait...
        <form id="ePayment" name="ePayment" action="https://www.mobile88.com/epayment/entry.asp" method="post">
            <input type="hidden" name="MerchantCode" value="M07662" />
            <input type="hidden" name="PaymentId" value="" /><!--{{ $orderInfo->id }}-->
            <input type="hidden" name="RefNo" value="{{ $orderInfo->order_id }}" />
            <input type="hidden" name="Amount" value="{{ number_format($orderInfo->totalPrice, 2) }}" />
            <input type="hidden" name="Currency" value="MYR" />
            <input type="hidden" name="ProdDesc" value="Order ID {{ $orderInfo->order_id }}" />
            <input type="hidden" name="UserName" value="{{ $orderInfo->billing_first_name . ' ' . $orderInfo->billing_last_name }}" />
            <input type="hidden" name="UserEmail" value="{{ $orderInfo->billing_email }}" />
            <input type="hidden" name="UserContact" value="{{ $orderInfo->billing_telephone }}" />
            <input type="hidden" name="Remark" value="Order ID {{ $orderInfo->order_id }}" />
            <input type="hidden" name="Lang" value="UTF-8" />
            <input type="hidden" name="Signature" value="{{ $sign }}" />
            <input type="hidden" name="ResponseURL" value="{{ url('checkout/successPayment') }}" />
        </form>
        <script>
        setTimeout(function(){
            document.getElementById('ePayment').submit();
        }, 3000);
        </script>
	</body>
</html>