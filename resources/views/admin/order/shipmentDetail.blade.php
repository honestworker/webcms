@extends('adminLayout')
@section('content')
<?php
    $ordersModel = new App\Http\Models\Admin\Orders();
    $orderTax = $ordersModel->getOrderTax($order->id);
//dd($order, $orderTax);
?>
<div id="page-wrapper">
	<div class="page-header-breadcrumb">
		<div class="page-heading hidden-xs">
			<h1 class="page-title">Orders</h1>
		</div>

        <ol class="breadcrumb page-breadcrumb">
        	<li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('web88cms/dashboard') }}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
            <li>Orders &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <!--<li><a href="{{ url('web88cms/orders') }}">Orders Listing</a> &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>-->
            <li class="active">View Shipment - Details</li>
        </ol>
	</div>

    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
            	<h2>View Shipment <i class="fa fa-angle-right"></i> Details</h2>
	            <div class="clearfix"></div>
                <div class="pull-left"> Last updated: <span class="text-blue">{{ date('d M, Y @ h:iA', strtotime($order->modifydate)) }}</span> </div>
	            <div class="clearfix"></div>
	            <p></p>

	            <h3 class="block-heading pull-left">Shipment ID: #0{{ $order->id}}</h3>
	            <div class="clearfix"></div>
                <ul id="myTab" class="nav nav-tabs">
                	<li class="active"><a href="#overview" data-toggle="tab">Shipment Details</a></li>
                	<li><a href="#item-details" data-toggle="tab">Item Details</a></li>
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div id="overview" class="tab-pane fade in active">
                        <div class="portlet">
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-8">
                                    <!-- order information start -->
                                    	<h4 class="block-heading"><i class="fa fa-shopping-cart"></i> Order Information</h4>
                                    	<div class="md-margin-2x"></div>
                                        <div class="form-group">
                                        	<label for="inputFirstName" class="col-md-4 control-label">Order ID: </label>
	                                        <div class="col-md-8"><p><strong>#{{ $order->order_id }}</strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                        	<label for="inputFirstName" class="col-md-4 control-label">Order Date: </label>
                                        	<div class="col-md-8"><p><strong>{{ date('dS M, Y', strtotime($order->createdate)) }}</strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                        	<label for="inputFirstName" class="col-md-4 control-label">Customer Name:</label>
	                                        <div class="col-md-8">
                                            	<p><a href="{{ url('web88cms/customers/view/' . $customer->id) }}"><strong>{{ $customer->first_name . ' ' . $customer->last_name}}</strong></a>,<br/>
                                                <a href="{{ url('web88cms/customers/view/' . $customer->id) }}"><strong>{{ $customer->email }}</strong></a></p>
	                                        </div>
                                        </div>

                                        <div class="form-group">
                                        	<label for="inputFirstName" class="col-md-4 control-label">IP Address: </label>
                                        	<div class="col-md-8"><p><strong>{{ $order->ip_address }}</strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                        	<label for="inputFirstName" class="col-md-4 control-label">Total Amount: </label>
                                        	<div class="col-md-8"><p class="text-red"><strong>RM {{ number_format($orderTax->total + $order->shipping_charge * 1.06, 2) }}</strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                        	<label for="inputFirstName" class="col-md-4 control-label">Item Number(s): </label>
                                        	<div class="col-md-8"><p><strong>{{ $totalOrderItems }}</strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="lg-margin"></div>

                                        <h4 class="block-heading"><i class="fa fa-truck"></i> Shipping Address</h4>
                                        <div class="md-margin-2x"></div>
                                        <div class="form-group">
                                        	<label for="inputFirstName" class="col-md-4 control-label">Ship To: </label>
	                                        <div class="col-md-8"><p><strong>{{ $order->shipping_first_name . ' ' . $order->shipping_last_name }}</strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-group">
	                                        <label for="inputFirstName" class="col-md-4 control-label">Email: </label>
    	                                    <div class="col-md-8"><p><strong>{{ $order->shipping_email }}</strong></p></div>
                                        </div>

                                        <div class="form-group">
                                        	<label for="inputFirstName" class="col-md-4 control-label">Telephone: </label>
                                        	<div class="col-md-8"><p><strong>{{ $order->shipping_telephone }}</strong></p></div>
                                        </div>

                                        <div class="form-group">
                                        	<label for="inputFirstName" class="col-md-4 control-label">Address: </label>
                                        	<div class="col-md-8"><p><strong>{{ $order->shipping_address }}, {{ $order->shipping_post_code }} {{ $order->shipping_city }}, {{ $order->shipping_state_name }}, {{ $order->shipping_country_name }}</strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="lg-margin"></div>

                                        <!-- billing address start -->
                                        <h4 class="block-heading"><i class="fa fa-tag"></i> Billing Address</h4>
                                        <div class="md-margin-2x"></div>
                                        <div class="form-group">
                                        <label for="inputFirstName" class="col-md-4 control-label">Bill To: </label>
                                        <div class="col-md-8"><p><strong>{{ $order->billing_first_name . ' ' . $order->billing_last_name }}</strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-group">
	                                        <label for="inputFirstName" class="col-md-4 control-label">Email: </label>
    	                                    <div class="col-md-8"><p><strong>{{ $order->billing_email }}</strong></p></div>
                                        </div>

                                        <div class="form-group">
                                        	<label for="inputFirstName" class="col-md-4 control-label">Telephone: </label>
                                        	<div class="col-md-8"><p><strong>{{ $order->billing_telephone }}</strong></p></div>
                                        </div>

                                        <div class="form-group">
                                        	<label for="inputFirstName" class="col-md-4 control-label">Address: </label>
                                        	<div class="col-md-8"><p><strong>{{ $order->billing_address }}, {{ $order->billing_post_code }} {{ $order->billing_city }}, {{ $order->billing_state_name }}, {{ $order->billing_country_name }}</strong></p></div>
                                        </div>
                                        <!-- end billing address -->
                                        <div class="lg-margin"></div>

                                        <!-- notes start -->
                                        <h4 class="block-heading"><i class="fa fa-pencil"></i> Notes</h4>
                                        <div class="md-margin-2x"></div>
                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Comments</label>
                                            <div class="col-md-8"> <textarea name="comments" rows="3" class="form-control">{{ $order->comments }}</textarea></div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="panel panel-primary">
                                           <div class="panel-heading">Shipment Information</div>
                                            <div class="md-margin"></div>
                                            <div class="form-group">
                                                <label class="col-md-5 control-label"><strong>Shipment ID: </strong></label>
                                                <div class="col-md-7">#0{{ $order->id}}</div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="form-group">
                                                <label class="col-md-5 control-label"><strong>Date: </strong></label>
                                                <div class="col-md-7">
                                                	@if($order->shipment_date != '0000-00-00')
                                                		{{ date('d M, Y', strtotime($order->shipment_date)) }}
                                                    @else
                                                    	-
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="form-group">
                                                <label class="col-md-5 control-label"><strong>Method: </strong></label>
                                                <div class="col-md-7">{{ $order->shipping_method}}</div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="form-group">
                                                <label class="col-md-5 control-label"><strong>Tracking #: </strong></label>
                                                <div class="col-md-7">#{{ $order->tracking_number}}</div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="md-margin"></div>
                                        </div>
                                    </div>
                                </div>
	                            <div class="md-margin"></div>

                            </div>
	                        <div class="clearfix"></div>
                        </div>
                    </div>

                    <div id="item-details" class="tab-pane fade">
                        <div class="portlet">
                            <div class="portlet-body">
                                <table class="table checkout-table table-responsive">
                                    <thead>
                                        <tr>
                                            <th class="table-title">Product Id</th>
                                            <th class="table-title">Product Name</th>
                                            <th class="table-title" style="text-align: right;">Qty</th>
                                            <th class="table-title" style="text-align: right;">Unit Price (RM)</th>
                                            <th class="table-title" style="text-align: right;">SST (RM)</th>
                                            <th class="table-title" style="text-align: right;">Total (RM)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orderTax->products as $orderProduct)
                                            <tr>
                                                <td class="item-code">{{ $orderProduct->product_code }}</td>
                                                <td class="item-name-col">
                                                    <figure><a href="{{ url('web88cms/products/editProduct/' . $orderProduct->product_id) }}">
                                                        <img src="{{ asset('/public/admin/products/medium/' . $orderProduct->thumbnail_image_1) }}" alt="{{ $orderProduct->product_name }}" class="img-responsive">
                                                    </a></figure>
                                                    <header class="item-name">
                                                        <a href="{{ url('web88cms/products/editProduct/' . $orderProduct->product_id) }}">{{ $orderProduct->product_name }}</a>
                                                        @if (!is_null($orderProduct->pwp_price))
                                                        <span class="pwp-item">PWP ITEM</span>
                                                        @endif
                                                    </header>
                                                    <ul>
                                                      @if($orderProduct->color_name)
                                                          <li>Color: {{ $orderProduct->color_name }}</li>
                                                      @endif

                                                      @if($orderProduct->event_type)
                                                          <li><i class="fa fa-gift text-red"></i> <span class="text-red"><b>For: {{ $orderProduct->event_type }}</b></span></li>
                                                      @endif
                                                    </ul>
                                                </td>
                                                <td align="right">{{ $orderProduct->quantity }}</td>
                                                <td class="item-price-col" align="right"><span class="item-price-special">
                                                @if (is_null($orderProduct->pwp_price))
                                                {{ number_format($orderProduct->amount, 2) }}
                                                @else
                                                {{ number_format($orderProduct->pwp_price, 2) }}
                                                @endif
                                                </span></td>
                                                <td class="item-total-col" align="right"><span class="item-price-special">{{ number_format($orderProduct->tax, 2) }}</span></td>
                                                <td class="item-total-col" align="right"><span class="item-price-special">{{ number_format($orderProduct->subtotal + $orderProduct->tax, 2) }}</span></td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td style="border: none; text-align: right;" colspan="3">Total:</td>
                                            <td></td>
                                            <td align="right">{{ number_format($orderTax->tax, 2) }}</td>
                                            <td align="right">{{ number_format($orderTax->subtotal + $orderTax->tax, 2) }}</td>
                                        </tr>
<!--
                                        <tr>
                                            <td class="checkout-table-title" colspan="5">GST:</td>
                                            <td class="checkout-table-price" align="center">RM {{ number_format($orderTax->tax, 2) }}</td>
                                        </tr>
-->
                                        <tr>
                                            <td style="border: none; text-align: right;" colspan="3">Shipping:</td>
                                            <td style="border: none;" align="right">{{ number_format($order->shipping_charge, 2) }}</td>
                                            <td style="border: none;" align="right">{{ number_format($order->shipping_charge * 0.06, 2) }}</td>
                                            <td style="border: none;" align="right">{{ number_format($order->shipping_charge * 1.06, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td style="border: none; text-align: right;" class="text-red" colspan="3">Discount:</td>
                                            <td style="border: none;"></td>
                                            <td style="border: none;"></td>
                                            <td style="border: none;" class="text-red" align="right">-{{ number_format($orderTax->discount, 2) }}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td style="border: none; text-transform: none; text-align: right;" colspan="3"><b>Net Total:</b></td>
                                            <td></td>
                                            <td align="right"><b>{{ number_format($orderTax->tax + $order->shipping_charge * 0.06, 2) }}</b></td>
                                            <td align="right"><b>{{ number_format($orderTax->total + $order->shipping_charge * 1.06, 2) }}</b></td>
                                        </tr>
                                    </tfoot>
                                </table>
	                            <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<div class="page-footer">
    	<div class="copyright">
        	<span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
		    <div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png') }}" alt="Webqom Technologies Sdn Bhd"></div>
	    </div>
    </div>
</div>
@endsection