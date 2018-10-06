@extends('front/templateFront')

@section('content')                        
<section id="content">
    <div id="breadcrumb-container" class="light">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="{{ url('/cart') }}">My Shopping Cart</a></li>
                <li><a href="{{ url('/checkout') }}">Checkout</a></li>
                <li class="active">Order Confirmation</li>
            </ul>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <header class="content-title">
                    <div class="title-bg">
                        <h2 class="title">Order Confirmation</h2>
                    </div>
                    <div class="pull-right">
               			<a href="javascript:window.print()" class="btn btn-custom-2">PRINT THIS PAGE &nbsp;<i class="fa fa-print"></i></a> &nbsp;
                    	<a href="#" class="btn btn-custom">EMAIL &nbsp;<i class="fa fa-envelope"></i></a>
                    </div>
                </header>
                <div class="md-margin"></div>
                
                <div class="row">
                    <div class="col-lg-12">                        
                        @if($success)
                        <div class="alert alert-success">
                                <i class="fa fa-smile-o"></i> <?= $success ?>
                        </div>
                        @endif
                        
                        @if($warning)
                        <div class="alert alert-danger">
                                <i class="fa fa-exclamation-triangle"></i> &nbsp;<?= $warning ?>
                        </div>
                        @endif
                        
                        <p>Please keep your <strong>Order ID</strong> as the reference for tracking purpose. Please also print out a copy of this order confirmation as a purchase proof. If you need any support on the installation or any query for the goods, please contact our <strong>Customer Service Hotline</strong> at <span class="text-red"><strong>+(603) 7983-2020</strong></span> or Email to <strong><a href="mailto:ebiz@tbm.com.my">ebiz@tbm.com.my</a></strong></p>
                        <div class="md-margin"></div>
                        
                        <ul>
                            <li>Your Order ID: <b>#{{ $orderInfo->order_id }}</b> </li>
                            <li>Order Date: <b>{{ date('dS F, Y', strtotime($orderInfo->createdate)) }}</b></li>
                            <li>Total Amount: <span class="text-red"><b>RM {{ $orderInfo->totalPrice }}</b></span></li>
                            <li>Shipping Method: <b>Poslaju National Courier</b></li>
                        </ul>
                        <hr>
                        
                        <div class="md-margin"></div>                    
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <h2 class="checkout-title">Billing Details</h2>
                                <ul>
                                    <li><b>Bill to:</b> {{ $orderInfo->billing_first_name }} {{ $orderInfo->billing_last_name }} </li>
                                    <li><b>Email:</b> {{ $orderInfo->billing_email }}</li>
                                    <li><b>Telephone:</b> {{ $orderInfo->billing_telephone }}</li>
                                    <li><b>Address: </b>{{ $orderInfo->billing_address }}</li>
                                </ul> 
                                
                                <div class="sm-margin"></div>

                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <h2 class="checkout-title">Shipping Details</h2>
                                <ul>
                                    <li><b>Ship to:</b> {{ $orderInfo->shipping_first_name }} {{ $orderInfo->shipping_last_name }} </li>
                                    <li><b>Email:</b> {{ $orderInfo->shipping_email }}</li>
                                    <li><b>Telephone:</b> {{ $orderInfo->shipping_telephone }}</li>
                                    <li><b>Address: </b>{{ $orderInfo->shipping_address }}</li>
                                </ul>                                 
                            </div>
						</div>
                    </div>
                </div>
                <div class="lg-margin"></div>
                <div class="row">
                    
                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                        <h2 class="checkout-title">Your Order Details</h2>
                        <table class="table checkout-table">
                            <thead>
                                <tr>
                                    <th class="table-title">Product Name</th>
                                    <th class="table-title">Product Code</th>
                                    <th class="table-title">Unit Price</th>
                                    <th class="table-title">Quantity</th>
                                    <th class="table-title">SubTotal</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php 
								$subtotal = 0;
								$shipping = 0;
								?>
                            	@foreach($orderProducts as $orderProduct)
                                <tr>
                                    <td class="item-name-col">
                                        <figure><a href="{{ url('/product/' . $orderProduct->id) }}">
                                        	<img src="{{ asset('/public/admin/products/medium/' . $orderProduct->thumbnail_image_2) }}" alt="{{ $orderProduct->product_name }}" class="img-responsive">
                                        </a></figure>
                                        <header class="item-name">
                                            <a href="{{ url('/product/' . $orderProduct->id) }}">{{ $orderProduct->product_name }}</a>
                                        </header>
                                        <ul>
                                          <li>Color: Silver</li>
                                          <!--<li><i class="fa fa-gift text-red"></i> <span class="text-red"><b>For: Hock Lim &amp; Test Test</b></span></li>-->
                                        </ul>                                          
                                    </td>
                                    <td class="item-code">{{ $orderProduct->product_code }}</td>
                                    <td class="item-price-col"><span class="item-price-special">RM {{ $orderProduct->amount }}</span></td>
                                    <td>{{ $orderProduct->quantity }}</td>
                                    <td class="item-total-col"><span class="item-price-special">RM {{ $orderProduct->quantity * $orderProduct->amount }}</span></td>
                                </tr>
                                <?php
									$subtotal += $orderProduct->quantity * $orderProduct->amount;
									$shipping += $orderProduct->shipping_amount;
								?>
                                @endforeach
                                
                                <tr>
                                    <td class="checkout-table-title" colspan="4">Subtotal:</td>
                                    <td class="checkout-table-price">RM {{ $subtotal }}</td>
                                </tr>
                                <tr>
                                    <td class="checkout-table-title" colspan="4">Shipping:</td>
                                    <td class="checkout-table-price">RM {{ $shipping }}</td>
                                </tr>
                                <tr>
                                    <td class="checkout-table-title text-red" colspan="4">Discount:</td>
                                    <td class="checkout-table-price text-red">- RM {{ $orderInfo->discount }}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="checkout-total-title" colspan="4"><b>TOTAL:</b></td>
                                    <td class="checkout-total-price cart-total">RM {{ $orderInfo->totalPrice }}</td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="md-margin"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
<?php
	// Brands & Services are done in the templateFront.blade.php
	if(isset($brands_scroller)) unset($brands_scroller);
?>

@endsection