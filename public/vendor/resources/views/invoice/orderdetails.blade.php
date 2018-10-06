@extends('front/templateFront')

@section('content')

        <section id="content">
        	<div id="page-header">
                <h1>Welcome Members!</h1>
                <div class="sm-margin"></div>
                <h2>Ritz Garden Hotel Online Hotel Booking Experience</h2>
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
                                            <td>RM <?php echo number_format($userOrderDetails[0]->totalPrice + $gst + $userOrderDetails[0]->shipping_charge * 1.06, 2);?></td>
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
                                        <table class="table checkout-table">
                                            <thead>
                                                <tr>
                                                    <th class="table-title">Product Id</th>
                                                    <th class="table-title">Product Name</th>
                                                    <th class="table-title">Quantity</th>
                                                    <th class="table-title">Unit Price</th>
                                                    <th class="table-title">GST</th>
                                                    <th class="table-title">SubTotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            	$subtotal = $shipping = $gst = 0;
                                            ?>
                                            @foreach($orderProducts as $orderProduct)
                                            <?php
												$product = DB::table('products')->where('id', $orderProduct->product_id)->first();
	                                       		$price = $orderProduct->quantity * $orderProduct->amount;
	                           					$tax = 0;
	                                           	if ($product and $product->is_tax) {
	                                 				$tax = round($price * 0.06, 2);
	                                   				$gst += $tax;
												}
                                    		//	dd($orderProduct, $product);
                                            ?>
                                                <tr>
                                                    <td class="item-code">{{ $orderProduct->product_code }}</td>
                                                    <td class="item-name-col">
	                                                    <figure><a href="{{ url('/product/' . $orderProduct->id) }}">
    	                                                <img src="{{ asset('/public/admin/products/medium/' . $orderProduct->thumbnail_image_2) }}" alt="{{ $orderProduct->product_name }}" class="img-responsive">
	                                                    </a></figure>
	                                                    <header class="item-name">
		                                                    <a href="{{ url('/product/' . $orderProduct->id) }}">{{ $orderProduct->product_name }}</a>
	                                                    </header>
	                                                    <ul>
    		                                                @if($orderProduct->color_name)
            			                                        <li>Color: {{ $orderProduct->color_name }}</li>
                        		                            @endif
                                                    <!--<li><i class="fa fa-gift text-red"></i> <span class="text-red"><b>For: Hock Lim &amp; Test Test</b></span></li>-->
                                	                    </ul>
                                                    </td>
                                                    <td>{{ $orderProduct->quantity }}</td>
                                                    <td class="item-price-col"><span class="item-price-special">RM <?php echo number_format($orderProduct->amount, 2);?></span></td>
                                                    <td class="item-price-col"><span class="item-price-special">RM <?php echo number_format($tax, 2);?></span></td>
                                                    <td class="item-total-col"><span class="item-price-special">RM <?php echo number_format($price, 2);?></span></td>
                                                </tr>
                                                <?php
                                                $subtotal += $orderProduct->quantity * $orderProduct->amount;
                                                $shipping += $orderProduct->shipping_amount;
                                                ?>
                                            @endforeach

                                            <tr>
                                            <td class="checkout-table-title" colspan="5">Subtotal:</td>
                                            <td class="checkout-table-price">RM <?php echo number_format($subtotal, 2);?></td>
                                            </tr>
                                            <tr>
                                            <td class="checkout-table-title" colspan="5">GST:</td>
                                            <td class="checkout-table-price">RM <?php echo number_format($gst, 2);?></td>
                                            </tr>
                                            <tr>
                                            <td class="checkout-table-title" colspan="5">Shipping:</td>
                                            <td class="checkout-table-price">RM <?php echo number_format($shipping, 2);?></td>
                                            </tr>
                                            <tr>
                                            <td class="checkout-table-title text-red" colspan="5">Discount:</td>
                                            <td class="checkout-table-price text-red">- RM <?php echo number_format($userOrderDetails[0]->discount, 2);?></td>
                                            </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="checkout-total-title" colspan="5"><b>TOTAL:</b></td>
                                                    <td class="checkout-total-price cart-total">RM <?php echo number_format($userOrderDetails[0]->totalPrice + $gst, 2);?></td>
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
