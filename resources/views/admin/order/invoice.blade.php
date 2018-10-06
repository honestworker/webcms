@extends('adminLayout')
@section('content')
 <!--Loading bootstrap css-->



<div id="page-wrapper">
    <div class="page-header-breadcrumb">
    	<div class="page-heading hidden-xs">
		    <h1 class="page-title">Orders</h1>
	    </div>

        <ol class="breadcrumb page-breadcrumb">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('web88cms/dashboard') }}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
            <li>Orders &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li><a href="{{ url('web88cms/orders') }}">Orders Listing</a> &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li><a href="{{ url('web88cms/orders/detail/' . $order->id) }}">Order Details</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
            <li class="active">Order Confirmation</li>
        </ol>
        <div class="pull-right"><a onClick="javascript:CallPrint('print-content');" class="btn btn-default" style="margin-right:10px;margin-top:10px;" title="Распечатать проект">Распечатать</a></div>

        <script language="javascript">
        function CallPrint(strid)
        {
        	var prtContent = document.getElementById(strid);
          console.log(prtContent);
        	var prtCSS = '<link type="text/css" rel="stylesheet" href="/public/admin/vendors/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css">' +
                       '<link type="text/css" rel="stylesheet" href="/public/admin/vendors/bootstrap/css/bootstrap.min.css">';
        	var WinPrint = window.open('','','left=50,top=50,width=800,height=640,toolbar=0,scrollbars=1,status=0');
        	WinPrint.document.write('<div id="print" class="contentpane">');
        	WinPrint.document.write(prtCSS);
        	WinPrint.document.write(prtContent.innerHTML);
        	 WinPrint.document.write('</div>');
        	WinPrint.document.close();
        	WinPrint.focus();//
           //WinPrint.print();
        	//WinPrint.close();
        	prtContent.innerHTML=strOldOne;
        }
        </script>

        <div class="page-content">
          <div id = "print-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="invoice-title">
                            	<h2>Order Confirmation</h2>
	                            <h3 class="pull-right">Order #{{ $order->order_id }}</h3>
                            </div>
                        	<hr/>
                            <div class="row">
                            	<div class="col-md-6">
		                            <address><strong>Billed To:</strong><br/>{{ $order->billing_first_name . ' ' . $order->billing_last_name }}<br/>{{ $order->billing_address }},<br/> {{ $order->billing_post_code }} {{ $order->billing_city }}, <br/>{{ $order->billing_state_name }}, {{ $order->billing_country_name }}.</address>
	                            </div>
	                            <div class="col-md-6 text-right">
		                            <address><strong>Shipped To:</strong><br/>{{ $order->shipping_first_name . ' ' . $order->shipping_last_name }}<br/>{{ $order->shipping_address }},<br/> {{ $order->shipping_post_code }} {{ $order->shipping_city }}, <br/>{{ $order->shipping_state_name }}, {{ $order->shipping_country_name }}.</address>
	                            </div>
                            </div>
                            <div class="row">
	                            <div class="col-md-6">
		                            <address><strong>Payment Method:</strong><br/>{{ $order->payment_method }}<br/>{{ $order->billing_email }}</address>
	                            </div>
    	                        <div class="col-md-6 text-right">
        		                    <address><strong>Order Date:</strong><br/>{{ date('dS M, Y', strtotime($order->createdate)) }}<br/><br/></address>
                	            </div>
                            </div>

                            <h4 class="block-heading">Order summary-</h4>


<div style="padding:0px; margin:0px;">
	<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" style="padding:10px 0; border-top:1px solid #ccc; background:#fff;">
		<tr>
			<td width="100" align="center" valign="top" style="color:#403e3d; font-size:16px; padding:0 0 10px;"><strong>ProductID</strong></td>
			<td width="450" align="center" valign="top" style="color:#403e3d; font-size:16px; padding:0 0 10px;"><strong>Product Description</strong></td>
			<td width="75" align="right" valign="top" style="color:#403e3d; font-size:16px;"><strong>Qty</strong></td>
			<td width="125" align="right" valign="top" style="color:#403e3d; font-size:16px;"><strong>Unit Price (RM)</strong></td>
			<td width="125" align="right" valign="top" style="color:#403e3d; font-size:16px;"><strong>SST (RM)</strong></td>
			<td width="125" align="right" valign="top" style="color:#403e3d; font-size:16px;"><strong>Total (RM)</strong></td>
		</tr>

		 <?php
			$subtotal = $shipping = $gst = 0;
		?>
        @foreach($order_to_products as $orderProduct)
            <?php
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
				<td width="100" align="left" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding:5px 10px 0;">{{ $orderProduct->room_code }}</td>
				<td width="450" align="left" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding:5px 0 0;">
                {{ $orderProduct->type }}
                @if (!is_null($orderProduct->pwp_price))
                <span class="pwp-item">PWP ITEM</span>
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
			<td align="right" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding: 5px 0 0 0;"><strong>{{ number_format($gst + 0.06 * $order->shipping_charge, 2) }}</strong></td>
			<td align="right" valign="top" style="color:#403e3d; font-size:15px; border-top:1px solid #ccc; padding: 5px 0 0 0;"><strong>{{ number_format($subtotal + 1.06 * $order->shipping_charge - $order->discount, 2) }}</strong></td>
        </tr>
        <tr>
			<td colspan="6">&nbsp;</td>
        </tr>
<!--
        <tr>
			<td colspan="6" align="center"><strong>Note: This document is computer generated and no signature is requied.</strong></td>
        </tr>
-->
    </table>
</div>


                        </div>
                    </div>
                </div>
            </div>
          </div>
            <div class="row">
              <div class="clearfix"></div>
              <div class="form-actions text-center">
                <a href="{{ url('web88cms/orders/detail/' . $order->id) }}" class="btn btn-dark"><i class="fa fa-angle-double-left"></i> &nbsp;Back</a>
              </div>
            </div>
        </div>


        <div class="page-footer">
        <div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
        <div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png') }}" alt="Webqom Technologies Sdn Bhd"></div>
        </div>
        </div>
	</div>
</div>
@endsection
