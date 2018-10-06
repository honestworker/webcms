@extends('front/templateFront')

@section('content')
<section id="content">
    <div id="breadcrumb-container" class="light">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">My Shopping Cart</li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <header class="content-title">
                    <div class="title-bg">
                        <h2 class="title">My Shopping Cart</h2>
                    </div>
                    <p class="title-desc">Having Discount Coupon? Check out how much you can SAVE.</p>
                </header>
                <div class="xs-margin"></div>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        @if(!$cartProducts['products'])
	                        <div class="alert alert-danger">
    	                        <i class="fa fa-shopping-cart"></i> &nbsp; Your cart is currently empty.
        	                </div>
            	            <a href="{{ url('/') }}" class="btn btn-custom-2">CONTINUE SHOPPING &nbsp;<i class="fa fa-shopping-cart"></i></a>
                        @endif
                        
                        @if($success)
	                        <div class="alert alert-success alert-dismissable">
		                    	<button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
        		            	<p><i class="fa fa-check-circle"></i> {{ $success }}</p>
                	    	</div>
                        @endif
                        <div class="md-margin"></div>
                        <form method="post" id="cart-form">
                            <table class="table cart-table">
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
                                	<?php $discount = 0; ?>
                                    @foreach($cartProducts['products'] as $cartProduct)
                                       	<?php $discount += ($cartProduct->cart['quantityDiscount'] * $cartProduct->cart['quantity']) + $cartProduct->cart['globalDiscount'] + $cartProduct->cart['promocodeDiscount'];
										//dd($cartProduct);
										 ?>
                                        <tr>
                                            <td class="item-name-col">
                                                <figure>
                                                    <a href="{{ url('/product/' . $cartProduct->id) }}">
                                                        <img src="{{ asset('/public/admin/products/medium/' . ($cartProduct->thumbnail_image_2 ? $cartProduct->thumbnail_image_2 : $cartProduct->thumbnail_image_1)) }}" alt="{{ $cartProduct->product_name }}" class="img-responsive">
                                                    </a>
                                                </figure>
                                                
                                                <header class="item-name">
                                                    <a href="{{ url('/product/' . $cartProduct->id) }}">{{ $cartProduct->product_name }}</a>
                                                </header>
        
                                                <ul>
                                                    @if($cartProduct->cart['colorName'])
                                                        <li>Color: {{ $cartProduct->cart['colorName'] }}</li>
                                                    @endif
                                                    
                                                    @if($cartProduct->cart['eventName'])
                                                    	<li><i class="fa fa-gift text-red"></i> <span class="text-red"><b>For: {{ $cartProduct->cart['eventName'] }}</b></span></li>
                                                    @endif
                                                </ul> 
                                                @if($cartProduct->cart['eventToken'])
	                                                <a href="{{ url('event/view') . '?token=' . $cartProduct->cart['eventToken'] }}" class="btn btn-custom btn-xs"><i class="fa fa-angle-double-left"></i>&nbsp; BACK TO SPECIAL LIST</a>
                                                @endif
                                            </td>
                                            <td class="item-code">{{ $cartProduct->product_code }}</td>
                                            <td class="item-price-col"><span class="item-price-special">RM {{ number_format($cartProduct->sale_price, 2) }}</span></td>
                                            <td>
                                                <div class="custom-quantity-input">
                                                    <input type="text" id="qut-{{ $cartProduct->cart['key'] }}" name="quantity[{{ $cartProduct->cart['key'] }}]" value="{{ $cartProduct->cart['quantity'] }}">
                                                    <a href="javascript:void(0)" onClick="addQuantity('add', $('#qut-{{ $cartProduct->cart['key'] }}'))" class="quantity-btn quantity-input-up"><i class="fa fa-angle-up"></i></a>
                                                    <a href="javascript:void(0)" onClick="addQuantity('sub', $('#qut-{{ $cartProduct->cart['key'] }}'))" class="quantity-btn quantity-input-down"><i class="fa fa-angle-down"></i></a>
                                                </div>
                                            </td>
                                            <td class="item-total-col">
                                                <span class="item-price-special">RM {{ number_format(($cartProduct->cart['quantity'] * $cartProduct->sale_price), 2) }}</span> 
                                                <a href="{{ url('cart/removeItem/' . $cartProduct->cart['key']) }}" class="close-button add-tooltip" data-toggle="tooltip" data-placement="top" title="Remove item"></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                    @if($cartProducts['products'])
                                    <tr>
                                        <td class="item-name-col" colspan="4"></td>
                                        <td class="item-total-col">
                                        	<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                                            <input type="submit" class="btn btn-custom-2" value="Update Cart" />
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="lg-margin"></div>
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-xs-12 lg-margin">
                        <div class="tab-container left clearfix">
                            <ul class="nav-tabs">
                                <li class="active"><a href="#shipping" data-toggle="tab">Shipping</a></li>
                                <li><a href="#discount" data-toggle="tab">Promo Codes</a></li>
                                <!--<li><a href="#gift" data-toggle="tab">Gift Voucher</a></li>-->
                            </ul>
                            <div class="tab-content clearfix">
                                <div class="tab-pane active" id="shipping">
                                    <form action="#" id="shipping-form">
                                        <p class="shipping-desc">Enter your destination to get a shipping estimate.</p>
                                        <hr>
                                        <div class="form-group">
                                            <label for="select-country" class="control-label">Country <span class="text-red">&#42;</span></label>
                                            <div class="input-container normal-selectbox">
                                                <select id="select-country" name="country" class="selectbox" style="width:80%;">
                                                    <option value="">Country</option>
                                                    @foreach ($countries as $country)
                                                    	@if($shipping_estimate_country == $country->country_id)
                                                        	<option selected="selected" value="{{ $country->country_id }}">{{ $country->name }}</option>
                                                        @else
                                                        	<option value="{{ $country->country_id }}">{{ $country->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="xss-margin"></div>
                                        <div class="form-group">
                                            <label for="select-state" class="control-label">State <span class="text-red">&#42;</span></label>
                                            <div class="input-container normal-selectbox">
                                                <select id="select-state" name="state" class="selectbox">
                                                    <option value="">States</option>
                                                    @foreach ($states as $states)
                                                    	@if($shipping_estimate_state == $states->zone_id)
                                                        	<option selected="selected" value="{{ $states->zone_id }}">{{ $states->name }}</option>
                                                        @else
                                                        	<option value="{{ $states->zone_id }}">{{ $states->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="xss-margin"></div>
                                        <div class="form-group">
                                            <label for="select-country" class="control-label">Shipping Options <span class="text-red">&#42;</span></label>
                                            <div class="input-container normal-selectbox">
                                                <select name="shipping_method" class="selectbox">
                                                    <option <?= ($shipping_method == 'Poslaju National Courier' ? 'selected="selected"' : '') ?> value="Poslaju National Courier">Poslaju National Courier</option>
                                                    <option <?= ($shipping_method == 'Self Collection' ? 'selected="selected"' : '') ?> value="Self Collection">Self Collection</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="xss-margin"></div>
                                        <p class="text-right">
                                            <a href="javascript:void(0)" id="estimate-shipping" class="btn btn-custom-2">Estimate Shipping &nbsp;<i class="fa fa-truck"></i></a>
                                        </p>
                                    </form>
                                </div>
                                <div class="tab-pane" id="discount">
                                    <p>Enter your promo codes here.</p>
                                    <form onsubmit="applyDiscountCoupon();return false;">
                                        <div class="input-group">
                                            <input type="text" name="promo_code" required class="form-control" placeholder="Coupon code">
                                        </div>
                                        <input type="submit" class="btn btn-custom-2" id="apply-coupon-code" value="APPLY COUPON">
                                    </form>
                                </div>
                                <!--<div class="tab-pane" id="gift">
                                    <p>Enter your discount gift voucher number here.</p>
                                    <form action="#">
                                        <div class="input-group">
                                            <input type="text" required class="form-control" placeholder="Gift voucher number">
                                        </div>
                                        <input type="submit" class="btn btn-custom-2" value="APPLY VOUCHER">
                                    </form>
                                    
                                </div>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <table class="table total-table">
                            <tbody>
                                <tr>
                                    <td class="total-table-title">Subtotal:</td>
                                    <td class="amount">RM {{ number_format($cartProducts['totalPrice'], 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="total-table-title">Shipping:</td>
                                    <td class="amount">RM {{ number_format($cartProducts['shippingTotal'], 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="total-table-title text-red">Discount:</td>
                                    <td class="amount text-red">- RM {{ number_format($discount, 2) }}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Total:</td>
                                    <td class="amount-total">RM {{ number_format((($cartProducts['totalPrice'] + $cartProducts['shippingTotal']) - $discount), 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="md-margin"></div>
                        <div class="pull-right">
                            <a href="{{ url('/') }}" class="btn btn-custom-2">CONTINUE SHOPPING &nbsp;<i class="fa fa-shopping-cart"></i></a>  
                            <a href="{{ url('/checkout') }}" class="btn btn-custom">CHECKOUT &nbsp;<i class="fa fa-sign-out"></i></a>
                        </div>
                    </div>
                </div>
                <div class="md-margin2x"></div>
                @if($recentViewProducts)
                    <div class="similiar-items-container carousel-wrapper">
                        <header class="content-title">
                            <div class="title-bg">
                                <h2 class="title">Recently Viewed Products</h2>
                            </div>
                        </header>
                        <div class="carousel-controls">
                            <div id="similiar-items-slider-prev" class="carousel-btn carousel-btn-prev"></div>
                            <div id="similiar-items-slider-next" class="carousel-btn carousel-btn-next carousel-space"></div>
                        </div>
                        <div class="similiar-items-slider owl-carousel">
                            @foreach($recentViewProducts as $product)
                                <div class="item item-hover">
                                    <div class="item-image-wrapper">
                                        <figure class="item-image-container">
                                            <a href="{{ url('product/' . $product->id) }}">
                                                <img src="{{ asset('/public/admin/products/medium/' . $product->thumbnail_image_1) }}" alt="{{ $product->product_name }}" class="item-image">
                                                <img src="{{ asset('/public/admin/products/medium/' . $product->thumbnail_image_2) }}" alt="{{ $product->product_name }}" class="item-image-hover">
                                            </a>
                                        </figure>
										<?php if(preg_match('/new/',$product->promo_behaviour)){ echo '<span class="new-circle top-left">New</span>'; } ?>
                                        <?php if(preg_match('/hot/',$product->promo_behaviour)){ echo '<span class="new-circle top-left">Hot</span>'; } ?>
                                        <?php if(preg_match('/sale/',$product->promo_behaviour)){ echo '<span class="new-circle top-left">Sale</span>'; } ?>
                                        <?php if(preg_match('/pwp/',$product->promo_behaviour)){ echo '<span class="new-circle top-left">pwp</span>'; } ?>
                                        
                                        @if($product->list_price != $product->sale_price)
                                        	<span class="discount-circle top-right">-{{ number_format(100 - (($product->sale_price/($product->list_price)*100)), 0) }}%</span>
                                        @endif
        
                                    </div><!-- End .item-image-wrapper -->
                                    <div class="item-meta-container">
                                        <div class="item-meta-inner-container clearfix">
        
                                            <div class="item-price-container inline">
                                            	@if($product->list_price != $product->sale_price)
                                                    <span class="old-price1">RM {{ number_format($product->list_price, 2) }}<span class="sub-price"></span></span>
                                                @endif
                                                <span class="item-price">RM {{ number_format($product->sale_price, 2) }}</span>
                                            </div>
                                        </div>
                                        <h3 class="item-name"><a href="{{ url('product/' . $product->id) }}"><?php echo (strlen($product->product_name) > 25) ? substr($product->product_name,0,20).'...' : $product->product_name; ?></a></h3>
                                       
                                        <div class="item-action">
                                            <a href="{{ url('product/' . $product->id) }}" class="item-add-btn">
                                                <span class="cart-icon-text">Add to Cart</span>
                                            </a>
                                            <div class="item-action-inner">
                                                <?php 
													if(Session::has('userId'))
														echo '<a href="#" class="icon-button icon-like add-tooltip" data-toggle="modal" data-target="#wishlist_model" data-placement="top" title="Add to wishlist" onclick="$(\'#wishlist_model #wishlist_product_id\').val('.$product->id.'); $(\'#wishlist_model img\').attr(\'src\',\''.asset('/public/admin/products/large/'.$product->large_image).'\'); $(\'#wishlist_model #list_name\').val(\'\'); load_product_attr('.$product->id.');">Favourite</a>';
													else
														echo '<a href="#" class="icon-button icon-like add-tooltip" data-toggle="modal" data-target="#login_model" data-placement="top" title="Add to wishlist">Favourite</a>';
												?>
                                                <a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})" class="icon-button icon-compare add-tooltip" data-toggle="tooltip" data-placement="top" title="Add to compare">Compare</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<?php
	// Brands & Services are done in the templateFront.blade.php
	if(isset($brands_scroller)) unset($brands_scroller);
?>

<script>
function addQuantity(val, obj){
	if(val == 'sub' && obj.val() > 0){
		obj.val(parseInt(obj.val()) - 1);
	}
	else if(val == 'add'){
		obj.val(parseInt(obj.val()) + 1);
	}
}

function applyDiscountCoupon(){
	$('#alert-danger').remove()
	$.ajax({
		url: "{{ url('cart/applyCouponCode') }}",
		type: 'POST',
		data: $('input[name="promo_code"], #_token'),
		dataType: 'json',
		async: false,
		cache: false,
		beforeSend:function (){
			$('#apply-coupon-code').val('Processing...');
		},
		complete: function(){
			$('#apply-coupon-code').val('APPLY COUPON');
		},
		success: function (response) {
			if(response && response['success'])
			{	
				window.location.reload();
			}
			
			if(response && response['warning'])
			{
				var html = '<p class="text-red" id="alert-danger">' + response['warning'] + '</p>';
				$('input[name="promo_code"]').after(html);
			}
		}
	});
}

$(function (){
	$('select[name="country"]').change(function(){
		var country_id = $(this).val();
		if(country_id != ''){
			$.ajax({
				url: "{{ url('checkout/getStates') }}",
				type: 'POST',
				data: {country_id:country_id, _token: '{{ csrf_token() }}'},
				dataType: 'json',
				async: false,
				cache: false,
				beforeSend:function (){
					$('select[name="state"]').html('<option value="">Loading...</option>');
				},
				complete: function(){
					
				},
				success: function (response) {
					var html = '';
					html += '<option value="">States</option>';
					if(response['states']){
						for(var i = 0; i < response['states'].length; i++){
							html += '<option value="' + response['states'][i]['zone_id'] + '">' + response['states'][i]['name'] + '</option>';
						}
					}
					
					$('select[name="state"]').html(html);
				}
			});
		}
		else{
			$('select[name="state"]').html('<option value="">State</option>');
		}
	});
});

$(function(){
	$('#estimate-shipping').click(function(){
		$('#alert-danger').remove();
		$('#alert-success').remove();
					
		var country = $('select[name="country"]').val();
		var state = $('select[name="state"]').val();
		var shipping_method = $('select[name="shipping_method"]').val();
		
		$.ajax({
			url: "{{ url('cart/applyEstimateShipping') }}",
			type: 'POST',
			data: {country: country, state: state, shipping_method: shipping_method, _token: '{{ csrf_token() }}'},
			dataType: 'json',
			async: false,
			cache: false,
			beforeSend:function (){
				$('#estimate-shipping').html('Please wait &nbsp;<i class="fa fa-truck"></i>');
			},
			complete: function(){
				$('#estimate-shipping').html('Estimate Shipping &nbsp;<i class="fa fa-truck"></i>');
			},
			success: function (response) {
				if(response['success'])
				{	
					window.location.reload();
				}
				
				if(response['error'])
				{
					var html = '';
					html += '<div id="alert-danger" class="alert alert-danger">';
					html += '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>';
					
					for(var i=0; i < response['error'].length; i++)
					{
						html += '<p><i class="fa fa-exclamation-triangle"></i> '+ response['error'][i] +'</p>';
					}
					
					html += '</div>';
					$('.table-responsive').before(html);
					$('html, body').animate({scrollTop: 0}, 'fast');
				}
			}
		});
	});
});
</script>
@endsection