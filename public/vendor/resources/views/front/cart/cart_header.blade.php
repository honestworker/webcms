<?php
use App\Http\Models\Front\Product;

$ProductModel = new Product();
$cartProducts = $ProductModel->getCartProducts(Session::get('cart'));

?>
<div class="dropdown-cart-menu-container pull-right">
    <div class="btn-group dropdown-cart">
        <div class="dropdown-menu dropdown-cart-menu pull-right clearfix" role="menu">
            <p class="dropdown-cart-description">Recently added item(s).</p>
            <ul class="dropdown-cart-product-list">
                <?php
                    $discount = 0;
                    $gst = $shipping_charge*0.06;   // total gst applied to all cart products
                ?>
            	@foreach($cartProducts['products'] as $cartProduct)
                <?php
                    $discount += ($cartProduct->cart['quantityDiscount'] * $cartProduct->cart['quantity']) + $cartProduct->cart['globalDiscount'] + $cartProduct->cart['promocodeDiscount'];
                    $price = isset($cartProduct->pwp_price) ? $cartProduct->pwp_price : $cartProduct->sale_price;
                    $price = $cartProduct->cart['quantity'] * $price;
                    $tax = 0;
                    if ($cartProduct->is_tax) {
                        $tax = round($price * 0.06, 2);
                        $gst += $tax;
                    }
                 ?>
                	<li class="item clearfix">
                        <a href="javascript:void(0)" title="Delete item" data-id="{{ $cartProduct->cart['key'] }}" class="delete-cart-item delete-item"><i class="fa fa-times"></i></a>
                        <a href="{{ url('/cart') }}" title="Edit item" class="edit-item"><i class="fa fa-pencil"></i></a>
                        <figure>
                            <a href="{{ url('/product/' . $cartProduct->id) }}">
                            	<img src="{{ asset('/public/admin/products/medium/' . $cartProduct->thumbnail_image_2) }}" alt="{{ $cartProduct->product_name }}">
                            </a>
                        </figure>
                        <div class="dropdown-cart-details">
                            <p class="item-name"><a href="{{ url('/product/' . $cartProduct->id) }}">{{ $cartProduct->product_name }}
                            @if($cartProduct->cart['colorName'])
	                            <br />({{ $cartProduct->cart['colorName'] }})
                            @endif
                            </a></p>
                            <?php $product_price = isset($cartProduct->pwp_price) ? $cartProduct->pwp_price : $cartProduct->sale_price; ?>
                            <p>{{ $cartProduct->cart['quantity'] }}x <span class="item-price">RM {{ number_format(($cartProduct->cart['quantity'] * $product_price), 2) }}</span></p>
                            @if (isset($cartProduct->pwp_price))
                            <span class="pwp-item">PWP ITEM</span>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
            <ul class="dropdown-cart-total">
                <li><span class="dropdown-cart-total-title">Shipping:</span>RM {{ number_format($shipping_charge, 2) }}</li>
                <li><span class="dropdown-cart-total-title">GST:</span>RM {{ number_format($gst, 2) }}</li>
                <li><span class="dropdown-cart-total-title">Total:</span>RM {{ number_format($cartProducts['totalPrice'] + $gst + $shipping_charge, 2) }}</li>
            </ul>
            <div class="dropdown-cart-action">
                <p><a href="{{ url('/cart') }}" class="btn btn-custom-2 btn-block">Cart</a></p>
                <p><a href="{{ url('/checkout') }}" class="btn btn-custom btn-block">Checkout</a></p>
            </div>
        </div>

        <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-shopping-cart"></span> {{ count($cartProducts['products']) }} item(s) <span class="drop-price">- RM {{ number_format($cartProducts['totalPrice'] + $gst + $shipping_charge, 2) }}</span>
        </button>

    </div>
</div>

<script>
$(function(){
	$(document).on('click', '.delete-cart-item', function(){
		var cartKey = $(this).attr('data-id');

		$.ajax({
			url: '{{ url("cart/deleteToCart") }}',
			type: 'POST',
			dataType: 'json',
			data: {cartKey: cartKey, _token: '{{ csrf_token() }}' },
			beforeSend: function(){

			},
			complete: function(){

			},
			success: function(response){
				if(response['success']){
					$('.dropdown-cart-menu-container').load('{{ url("cart/cartHtml") }} .dropdown-cart-menu-container > *');
				}
			}
		});
	});
});
</script>