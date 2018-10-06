<div style="padding:0px; margin:0px;">
    <table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" style="padding:10px; background:#fff;">
        <tr>
            <td width="550" align="left" valign="top" style="border-bottom:1px solid #ccc;"><img src="{{ asset('/public/front/images/index/logo.png') }}" /></td>
            <td width="450" align="right" valign="top" style="border-bottom:1px solid #ccc; padding:10px 0 20px; text-align:right;">
                <strong>RITZ GARDEN HOTEL</strong> (494355-D) <br />
                No.86 & 88,<br />Jalan Yang Kalsom, 30250 Ipoh, Perak, Malaysia.<br />
                Tel: (605) 242-7777<br />
                Fax: (605) 242-5845<br />
                sales@ritzgardenhotel.com<br />
            </td>
        </tr>

        <tr>
            <td width="550" align="left" valign="top" style="border-bottom:1px solid #ccc; padding:10px 0 20px;"><h2 style="padding:0px; margin:0px; color:#444645; font-size:32px;">Order Confirmation</h2></td>
            <td width="450" align="right" valign="top" style="border-bottom:1px solid #ccc; padding:10px 0 20px;"><h2 style="padding:0px; margin:0px; color:#444645; font-size:32px;">Order #{{ $order->order_id }}</h2></td>
        </tr>
        <tr>
        	<td colspan="2" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
        	<td align="left" valign="top" style="color:#646464; font-size:20px; padding:5px 0; margin:0px;"><strong>Billed To:</strong></td>
        	<!-- <td align="right" valign="top" style="color:#646464; font-size:20px; padding:5px 0; margin:0px;"><strong>Shipped To:</strong></td> -->
        </tr>
        <tr>
        	<td align="left" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ $order->billing_first_name . ' ' . $order->billing_last_name }}</td>
        	<!-- <td align="right" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ $order->shipping_first_name . ' ' . $order->shipping_last_name }}</td> -->
        </tr>
        <tr>
        	<td align="left" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ $order->billing_address }},<br/> {{ $order->billing_post_code }} {{ $order->billing_city }}, <br/>{{ $order->billing_state_name }}, {{ $order->billing_country_name }}.</td>
        	<!-- <td align="right" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ $order->shipping_address }},<br/> {{ $order->shipping_post_code }} {{ $order->shipping_city }}, <br/>{{ $order->shipping_state_name }}, {{ $order->shipping_country_name }}.</td> -->
        </tr>
        <tr>
        	<td align="left" valign="top">&nbsp;</td>
        	<!-- <td align="right" valign="top">&nbsp;</td> -->
        </tr>
        <tr>
        	<td align="left" valign="top" style="color:#646464; font-size:20px; padding:5px 0; margin:0px;"><strong>Payment Status:</strong></td>
        	<td align="right" valign="top" style="color:#646464; font-size:20px; padding:5px 0; margin:0px;"><strong>Order Status:</strong></td>
        </tr>
        <tr>
        	<td align="left" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ $order->status }}</td>
        	<td align="right" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ $order->payment_status }}</td>
        </tr>

        <tr>
        	<td align="left" valign="top" style="color:#646464; font-size:20px; padding:5px 0; margin:0px;"><strong>Payment Method:</strong></td>
        	<td align="right" valign="top" style="color:#646464; font-size:20px; padding:5px 0; margin:0px;"><strong>Order Date:</strong></td>
        </tr>
        <tr>
        	<td align="left" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ $order->payment_method }}</td>
        	<td align="right" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ date('dS M, Y', strtotime($order->createdate)) }}</td>
        </tr>
        <tr>
        	<td align="left" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ $order->billing_email }}</td>
        	<td align="right" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">&nbsp;</td>
        </tr>
        <tr>
        	<td colspan="2" align="left" valign="top" style=" padding:0px 0 0; margin:0 0 0px;"><h2 style="padding:10px 0; margin:0px; color:#444645; font-size:22px;">Order summary</h2></td>
        </tr>

<div style="padding:0px; margin:0px;">
	<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" style="padding:10px 0; border-top:1px solid #ccc; background:#fff;">
		<tr>
			<td width="100" align="center" valign="top" style="color:#403e3d; font-size:16px; padding:0 0 10px;"><strong>ProductID</strong></td>
			<td width="450" align="center" valign="top" style="color:#403e3d; font-size:16px; padding:0 0 10px;"><strong>Product Description</strong></td>
			<td width="75" align="right" valign="top" style="color:#403e3d; font-size:16px;"><strong>Qty</strong></td>
			<td width="125" align="right" valign="top" style="color:#403e3d; font-size:16px;"><strong>Unit Price (RM)</strong></td>
			<td width="125" align="right" valign="top" style="color:#403e3d; font-size:16px;"><strong>GST (RM)</strong></td>
			<td width="125" align="right" valign="top" style="color:#403e3d; font-size:16px;"><strong>Total (RM)</strong></td>
		</tr>

		 <?php
			$subtotal = $shipping = $gst = 0;
		?>
        @foreach($order_to_products as $orderProduct)
            <?php
//            echo "<pre>";
//        print_r($order);
//        exit;
				$price = $orderProduct->quantity * $orderProduct->amount;
				$subtotal += $price;
			?>
			<tr>
				<td width="100" align="left" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding:5px 10px 0;">{{ $orderProduct->product_code }}</td>
				<td width="450" align="left" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding:5px 0 0;">{{ $orderProduct->product_name }} </td>
				<td width="75" align="right" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding:5px 0 0;">{{ $orderProduct->quantity }}</td>
				<td width="125" align="right" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding:5px 0 0;">{{ number_format($orderProduct->amount, 2) }}</td>
			</tr>
        @endforeach

		<tr>
			<td colspan="3">&nbsp;</td>
			<td valign="top" style="border-top:1px solid #ccc;">&nbsp;</td>
			<!--<td align="right" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding: 5px 0 0 0;">{{ number_format($gst, 2) }}</td>-->
			<td align="right" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding: 5px 0 0 0;">{{ number_format($subtotal, 2) }}</td>
		</tr>

        <tr>
			<td colspan="6">&nbsp;</td>
        </tr>
        <tr>
			<td colspan="6" align="center"><strong>Note: This document is computer generated and no signature is requied.</strong></td>
        </tr>

    </table>
</div>
