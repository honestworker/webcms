<div style="padding:0px; margin:0px;">
    <table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" style="padding:10px; background:#fff;">
        <tr>
            <td width="550" align="left" valign="top" style="border-bottom:1px solid #ccc;"><img src="{{ asset('/public/front/images/index/logo.jpg') }}" /></td>
            <td width="450" align="right" valign="top" style="border-bottom:1px solid #ccc; padding:10px 0 20px; text-align:right;">
                <strong>TAN BOON MING SDN BHD</strong> (494355-D) <br />
                PS 4,5,6 & 7, Taman Evergreen, Batu 4, <br />Jalan Klang Lama, 58100 Kuala Lumpur.<br />
                Tel: (603) 7983-2020 (Hunting Lines)<br />
                Fax: (603) 7982-8141<br />
                info@tbm.com.my<br />
                Business Hours:<br />
                Mon. - Sat.: 9.30am - 9.00pm<br />
                Sun.: 10.00am - 9.00pm<br />
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
        	<td align="right" valign="top" style="color:#646464; font-size:20px; padding:5px 0; margin:0px;"><strong>Shipped To:</strong></td>
        </tr>
        <tr>
        	<td align="left" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ $order->billing_first_name . ' ' . $order->billing_last_name }}</td>
        	<td align="right" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ $order->shipping_first_name . ' ' . $order->shipping_last_name }}</td>
        </tr>
        <tr>
        	<td align="left" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ $order->billing_address }},<br/> {{ $order->billing_post_code }} {{ $order->billing_city }}, <br/>{{ $order->billing_state_name }}, {{ $order->billing_country_name }}.</td>
        	<td align="right" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ $order->shipping_address }},<br/> {{ $order->shipping_post_code }} {{ $order->shipping_city }}, <br/>{{ $order->shipping_state_name }}, {{ $order->shipping_country_name }}.</td>
        </tr>
        <tr>
        	<td align="left" valign="top">&nbsp;</td>
        	<td align="right" valign="top">&nbsp;</td>
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
                //check pwp item
				$price = is_null($orderProduct->pwp_price) ? $orderProduct->quantity * $orderProduct->amount : $orderProduct->quantity * $orderProduct->pwp_price;
				$subtotal += $price;
				$shipping += $orderProduct->shipping_amount;

				$product = DB::table('products')->where('id', $orderProduct->product_id)->first();
				$tax = 0;
			   	if ($product and $product->is_tax) {
					$tax = round($price * 0.06, 2);
					$gst += $tax;
					$subtotal += $tax;
				}
			//	dd($orderProduct, $product);
			?>
			<tr>
				<td width="100" align="left" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding:5px 10px 0;">{{ $orderProduct->product_code }}</td>
				<td width="450" align="left" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding:5px 0 0;">{{ $orderProduct->product_name }}
                @if (!is_null($orderProduct->pwp_price))
                <span style="display: inline-block;background: #E84C3D;color: #fff;padding: 4px 8px;">PWP ITEM</span>
                @endif
                </td>
				<td width="75" align="right" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding:5px 0 0;">{{ $orderProduct->quantity }}</td>
				<td width="125" align="right" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding:5px 0 0;">
                @if (is_null($orderProduct->pwp_price))
                {{ number_format($orderProduct->amount, 2) }}
                @else
                {{ number_format($orderProduct->pwp_price, 2) }}
                @endif
                </td>
				<td width="125" align="right" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding:5px 0 0;">{{ number_format($tax, 2) }}</td>
				<td width="125" align="right" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding:5px 0 0;">{{ number_format($price + $tax, 2) }}</td>
			</tr>
            @if($orderProduct->color_name)
            	<tr>
                    <td>&nbsp;</td>
	                <td align="left" valign="top" style="color:#403e3d; font-size:15px; padding:5px 0 0;">Color: {{ $orderProduct->color_name }}</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            @endif
            @if($orderProduct->event_type)
                <tr>
                    <td>&nbsp;</td>
                    <td align="left" valign="top" style="color:#d72d1a ; font-size:15px; padding:5px 0 5px;"><strong><img src="{{ asset('/public/images/gift.png') }}" style="padding:3px 5px 0 0; float:left;" />For: {{ $orderProduct->event_type }}</strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            @endif
        @endforeach

		<tr>
			<td colspan="3">&nbsp;</td>
			<td valign="top" style="border-top:1px solid #ccc;">&nbsp;</td>
			<td align="right" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding: 5px 0 0 0;">{{ number_format($gst, 2) }}</td>
			<td align="right" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding: 5px 0 0 0;">{{ number_format($subtotal, 2) }}</td>
		</tr>
		<tr>
			<td colspan="3" align="right" valign="top" style="padding: 5px 0 0 0;">Shipping:</td>
			<td align="right" valign="top" style="color:#403e3d; font-size:15px; padding: 5px 0 0 0;">{{ number_format($order->shipping_charge, 2) }}</td>
			<td align="right" valign="top" style="color:#403e3d; font-size:15px; padding: 5px 0 0 0;">{{ number_format(0.06 * $order->shipping_charge, 2) }}</td>
			<td align="right" valign="top" style="color:#403e3d; font-size:15px; padding: 5px 0 0 0;">{{ number_format(1.06 * $order->shipping_charge, 2) }}</td>
		</tr>
        <tr>
			<td colspan="3" align="right" valign="top" style="color:d72d1a; padding: 5px 0 0 0;">Discount:</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
			<td align="right" valign="top" style="color:#d72d1a; font-size:15px; padding: 5px 0 0 0;">-{{ number_format($order->discount, 2) }}</td>
        </tr>
        <tr>
			<td colspan="3" align="right" valign="top" style="color:403e3d; padding: 5px 0 0 0;"><strong>Net Total:</strong></td>
			<td valign="top" style="border-top:1px solid #ccc;">&nbsp;</td>
			<td align="right" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding: 5px 0 0 0;">{{ number_format($gst + 0.06 * $order->shipping_charge, 2) }}</td>
			<td align="right" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding: 5px 0 0 0;">{{ number_format($subtotal + 1.06 * $order->shipping_charge - $order->discount, 2) }}</td>
        </tr>
        <tr>
			<td colspan="6">&nbsp;</td>
        </tr>
        <tr>
			<td colspan="6" align="center"><strong>Note: This document is computer generated and no signature is requied.</strong></td>
        </tr>

    </table>
    <div style="padding:0px; margin:0px;">
    <table width="550" border="0" align="center" cellpadding="0" cellspacing="0" style="padding:10px; background:#fff;">
        <tr>
            <td><strong>Shipment ID: </strong></td>
            <td>#0{{ $order->id}}</td>
        </tr>
        <tr>
            <td><strong>Shipment Date: </strong></td>
            <td>
                @if($order->shipment_date != '0000-00-00')
                    {{ date('d M, Y', strtotime($order->shipment_date)) }}
                @else
                    -
                @endif
            </td>
        </tr>
        <tr>
            <td><strong>Method: </strong></td>
            <td>{{ $order->shipping_method}}</td>
        </tr>
        <tr>
            <td><strong>Shipment tracking #: </strong></td>
            <td>#0{{ $order->tracking_number}}</td>
        </tr>
    </table>
    </div>
</div>