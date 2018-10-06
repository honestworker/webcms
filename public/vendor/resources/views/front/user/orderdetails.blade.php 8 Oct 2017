@extends('front/templateFront')

@section('content')

<?php
	$ordersModel = new App\Http\Models\Admin\Orders();
	$orderTax = $ordersModel->getOrderTax($userOrderDetails[0]->id);
//dd($order, $orderTax);
?>
        <section id="content">
        	<div id="page-header">
                <h1>Welcome Members!</h1>
                <div class="sm-margin"></div>
                <h2>The TBM Shopping Experience</h2>
                <p class="line">&nbsp;</p>

            </div>
            <div class="md-margin2x"></div>
            <div class="container">
                <div class="row">
                	<div class="col-md-12">
						<div class="hero-unit">
                            <h2>Order Details</h2>
                            <span class="small-bottom-border big"></span>
                            <p>View your order details &amp; track your order.</p>
                        </div>
                        <div class="md-margin2x"></div>

	                        <?php
	                           	$gst = 0;
	                            foreach($orderProducts as $orderProduct) {
									$product = DB::table('products')->where('id', $orderProduct->product_id)->first();
	                           		$price = $orderProduct->quantity * $orderProduct->amount;
	               					$tax = 0;
	                               	if ($product and $product->is_tax) {
	                     				$tax = round($price * 0.06, 2);
	                       				$gst += $tax;
									}
								}
	                    		//	dd($orderProduct, $product);
	                        ?>

                                <table class="table cart-table">
                                    <thead>
                                        <tr>
                                            <th class="table-title">Order ID</th>
                                            <th class="table-title">Date</th>
                                            <th class="table-title">Order Total</th>
                                            <th class="table-title">Payment Method</th>
                                            <th class="table-title">Shipping Method</th>
                                            <th class="table-title">Order Status</th>
                                            <th class="table-title">Payment Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $userOrderDetails[0]->order_id;?></td>
                                            <td><?php echo date('dS M, Y', strtotime($userOrderDetails[0]->modifydate));?></td>
                                            <td>RM <?php echo number_format($orderTax->total + $orderTax->shipping_charge * 1.06, 2);?></td>
                                            <td><?php echo $userOrderDetails[0]->payment_method;?></td>
                                            <td><?php echo $userOrderDetails[0]->shipping_method;?></td>
                                            <td>
                                            	@if($userOrderDetails[0]->status == 'Processing')
                                                    <span class="highlight fourth-color text-12px">Processing</span>
                                                @elseif($userOrderDetails[0]->status == 'New Order')
                                                    <span class="highlight orange-color text-12px">New Order</span>
                                                @elseif($userOrderDetails[0]->status == 'Ready To Ship')
                                                    <span class="highlight fourth-color text-12px">Ready To Ship</span>
                                                @elseif($userOrderDetails[0]->status == 'Shipped')
                                                    <span class="highlight blue-color text-12px">Shipped</span>
                                                @elseif($userOrderDetails[0]->status == 'Completed')
                                                    <span class="highlight first-color text-12px">Completed</span>
                                                @elseif($userOrderDetails[0]->status == 'Declined')
                                                    <span class="highlight third-color text-12px">Declined</span>
                                                @elseif($userOrderDetails[0]->status == 'Cancelled')
                                                    <span class="highlight black-color text-12px">Cancelled</span>
                                                @endif
                                            </td>
                                            <td>
                                            	@if($userOrderDetails[0]->payment_status == 'Paid')
                                                    <span class="highlight first-color text-12px">Paid</span>
                                                @elseif($userOrderDetails[0]->status == 'Processing')
                                                    <span class="highlight fourth-color text-12px">Processing</span>
                                                @elseif($userOrderDetails[0]->payment_status == 'Payment Error')
                                                    <span class="highlight third-color text-12px">Payment Error</span>
                                                @elseif($userOrderDetails[0]->payment_status == 'Cancelled')
                                                    <span class="highlight black-color text-12px">Cancelled</span>
                                                @endif
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                                <div class="md-margin"></div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <h2 class="checkout-title">Billing Details</h2>
                                        <ul>
                                            <li><b>Bill to:</b> <?php echo $userOrderDetails[0]->billing_first_name;?> <?php echo $userOrderDetails[0]->billing_last_name;?> </li>
                                            <li><b>Email:</b> <?php echo $userOrderDetails[0]->billing_email;?></li>
                                            <li><b>Telephone:</b> <?php echo $userOrderDetails[0]->billing_telephone;?></li>
                                            <li><b>Address: </b><?php echo $userOrderDetails[0]->billing_address;?>, <?php echo $userOrderDetails[0]->billing_post_code;?> <?php echo $userOrderDetails[0]->billing_city;?>, <?php echo $userOrderDetails[0]->billing_state_name;?>, <?php echo $userOrderDetails[0]->billing_country_name;?>.</li>
                                        </ul>

                                        <div class="sm-margin"></div>

                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <h2 class="checkout-title">Shipping Details</h2>
                                        <ul>
                                            <li><b>Ship to:</b> <?php echo $userOrderDetails[0]->shipping_first_name;?> <?php echo $userOrderDetails[0]->shipping_last_name;?> </li>
                                            <li><b>Email:</b> <?php echo $userOrderDetails[0]->shipping_email;?></li>
                                            <li><b>Telephone:</b> <?php echo $userOrderDetails[0]->shipping_telephone;?></li>
                                            <li><b>Address: </b><?php echo $userOrderDetails[0]->shipping_address;?>, <?php echo $userOrderDetails[0]->shipping_post_code;?> <?php echo $userOrderDetails[0]->shipping_city;?>, <?php echo $userOrderDetails[0]->shipping_state_name;?>, <?php echo $userOrderDetails[0]->shipping_country_name;?>.</li>
                                        </ul>

                                    </div>
                                 </div>

                                <div class="lg-margin"></div>
								<div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                    	<h2 class="checkout-title">Your Order Details</h2>

                                <table class="table checkout-table table-responsive">
                                    <thead>
                                        <tr>
                                            <th class="table-title">Product Id</th>
                                            <th class="table-title">Product Name</th>
                                            <th class="table-title" style="text-align: right;">Qty</th>
                                            <th class="table-title" style="text-align: right;">Unit Price (RM)</th>
                                            <th class="table-title" style="text-align: right;">GST (RM)</th>
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
                                                    </header>
                                                    <ul>
                                                      @if($orderProduct->color_name)
	                                                      <li>Color: {{ $orderProduct->color_name }}</li>
                                                      @endif

                                                      @if($orderProduct->event_type)
                                                          <li><i class="fa fa-gift text-red"></i> <span class="text-red"><b>For: {{ $orderProduct->event_type }}</b></span></li>
                                                      @endif
                                                    </ul>

                                                    @if (!is_null($orderProduct->pwp_price))
                                                    <span class="pwp-item">PWP ITEM</span>
                                                    @endif
                                                </td>
                                                <td class="item-price-col" style="text-align:right;padding-right:10px">{{ $orderProduct->quantity }}</td>
                                                <td class="item-price-col" style="text-align:right;padding-right:10px">
                                                @if (is_null($orderProduct->pwp_price))
                                                {{ number_format($orderProduct->amount, 2) }}
                                                @else
                                                {{ number_format($orderProduct->pwp_price, 2) }}
                                                @endif
                                                </td>
                                                <td class="item-price-col" style="text-align:right;padding-right:10px">{{ number_format($orderProduct->tax, 2) }}</td>
                                                <td class="item-price-col" style="text-align:right;padding-right:10px">{{ number_format($orderProduct->subtotal + $orderProduct->tax, 2) }}</td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td style="border: none; text-align: right;" colspan="3">Total:</td>
                                            <td></td>
                                            <td style="text-align:right;padding-right:10px">{{ number_format($orderTax->tax, 2) }}</td>
                                            <td style="text-align:right;padding-right:10px">{{ number_format($orderTax->subtotal + $orderTax->tax, 2) }}</td>
                                        </tr>
<!--
                                        <tr>
                                            <td class="checkout-table-title" colspan="5">GST:</td>
                                            <td class="checkout-table-price" align="center">RM {{ number_format($orderTax->tax, 2) }}</td>
                                        </tr>
-->
                                        <tr>
                                            <td style="border: none; text-align: right;" colspan="3">Shipping:</td>
                                            <td style="border: none;text-align:right;padding-right:10px">{{ number_format($orderTax->shipping_charge, 2) }}</td>
                                            <td style="border: none;text-align:right;padding-right:10px">{{ number_format($orderTax->shipping_charge * 0.06, 2) }}</td>
                                            <td style="border: none;text-align:right;padding-right:10px">{{ number_format($orderTax->shipping_charge * 1.06, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td style="border: none; text-align: right;" class="text-red" colspan="3">Discount:</td>
                                            <td style="border: none;"></td>
                                            <td style="border: none;"></td>
                                            <td style="border: none;text-align:right;padding-right:10px" class="text-red">-{{ number_format($orderTax->discount, 2) }}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td style="border: none; text-transform: none; text-align: right;" colspan="3"><b>Net Total:</b></td>
                                            <td></td>
                                            <td style="text-align:right;padding-right:10px"><b>{{ number_format($orderTax->tax + $orderTax->shipping_charge * 0.06, 2) }}</b></td>
                                            <td style="text-align:right;padding-right:10px"><b>{{ number_format($orderTax->total + $orderTax->shipping_charge * 1.06, 2) }}</b></td>
                                        </tr>
                                    </tfoot>
                                </table>

	                                    <div class="md-margin"></div>
                                    </div>
                                </div>
                                <div class="md-margin"></div>
                                <a href="javascript:window.history.back();" class="btn btn-custom"><i class="fa fa-angle-double-left"></i> BACK</a>
                    </div>
            	</div>
    		</div>

    </section>

<?php
	// Brands & Services are done in the templateFront.blade.php
	if(isset($brands_scroller)) unset($brands_scroller);
?>

@endsection
