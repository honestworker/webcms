@extends('front/templateFront')

@section('content')
<section id="content">
    <div id="breadcrumb-container" class="light">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">Compare Products</li>
            </ul>
        </div>
    </div>
    <div class="container">    	
        @if(!$compareProducts)
        <div class="alert alert-danger">
            <i class="fa fa-exclamation-triangle"></i> &nbsp; Compare list is empty.
        </div>
        @endif
        
        @if($success)
        <div class="alert alert-success">
            <i class="fa fa-exclamation-triangle"></i> &nbsp; {{ $success }}
        </div>
        @endif
        
        <div class="row">
            <div class="col-md-12">
                <header class="content-title">
                    <div class="title-bg">
                        <h2 class="title">Compare Products</h2>
                    </div>
                    
                </header>
                <div class="md-margin"></div>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                    	@if($compareProducts)
                        	<?php $count = count($compareProducts); ?>
                            <table class="table table-striped compare-item-table">
                                <tr>
                                    <td class="table-title">PRODUCT NAME</td>
                                    @for($i = 0; $i < $count; $i++)
                                        <td>
                                            <figure>
                                                <a href="{{ url('product/' . $compareProducts[$i]->id) }}">
                                                    <img src="{{ asset('/public/admin/products/medium/' . $compareProducts[$i]->thumbnail_image_1) }}" alt="{{ $compareProducts[$i]->product_name }}" class="img-responsive">
                                                </a>
                                            </figure>
                                            <p class="item-name"><a href="{{ url('product/' . $compareProducts[$i]->id) }}">{{ $compareProducts[$i]->product_name }}</a></p>
                                        </td>
                                    @endFor
                                </tr>
                                <tr>
                                    <td class="table-title">PRICE</td>
                                    @for($i = 0; $i < $count; $i++)
                                        <td>
                                        	<div class="item-price-container inline">
                                            	@if($compareProducts[$i]->list_price != $compareProducts[$i]->sale_price)
		                                            <span class="old-price">RM {{ number_format($compareProducts[$i]->list_price, 2) }}</span>
                                                @endif
	                                            <span class="item-price">RM {{ number_format($compareProducts[$i]->sale_price, 2) }}</span>
                                            </div>
                                        </td>
                                    @endFor
                                </tr>
                                <tr class="item-brand-col">
                                    <td class="table-title">BRAND</td>
                                    @for($i = 0; $i < $count; $i++)
	                                    <td>{{ $compareProducts[$i]->brandName }}</td>
                                    @endfor
                                </tr>
                                <tr>
                                    <td class="table-title">AVAILABILITY</td>
                                    @for($i = 0; $i < $count; $i++)
                                    	<td>
                                        @if($compareProducts[$i]->quantity_in_stock)
                                        	<span class="text-success">In Stock</span>
                                        @else
	                                        <span class="text-red">Out of Stock</span>
                                        @endif
                                    	</td>
                                    @endfor
                                </tr>
                                <tr>
                                    <td class="table-title">Product Description</td>
                                    @for($i = 0; $i < $count; $i++)
	                                    <td><?php echo $compareProducts[$i]->description ?></td>
                                    @endfor
                                </tr>
                                <tr>
                                    <td class="table-title">Features</td>
                                    @for($i = 0; $i < $count; $i++)
                                    	<td><?php echo $compareProducts[$i]->features_and_video ?></td>
                                    @endfor
                                </tr>
                                <tr>
                                    <td class="table-title">Weight</td>
                                    @for($i = 0; $i < $count; $i++)
                                    <td>
										@if($compareProducts[$i]->weight)
											<?php echo number_format($compareProducts[$i]->weight, 2) ?> Kg
                                        @endif
                                    </td>
                                    @endfor
                                </tr>
                                <tr>
                                    <td class="table-title">Color(s)</td>
                                    @for($i = 0; $i < $count; $i++)
                                    <td>
                                    	 @if($compareProducts[$i]->colors)
                                        	<?php $colors = array(); ?>
											@foreach($compareProducts[$i]->colors as $color)
                                            	<?php $colors[] = $color->color_name ?>
                                            @endforeach
                                            {{ implode(' / ', $colors)}}
                                        @endif
                                    </td>
                                   	@endfor
                                </tr>
                                <tr>
                                    <td class="table-title">Warranty</td>
                                    @for($i = 0; $i < $count; $i++)
                                    	<td><?php echo $compareProducts[$i]->warranty_and_support ?></td>
                                    @endfor
                                </tr>
                                <tr>
                                    <td class="table-title"></td>
                                    @for($i = 0; $i < $count; $i++)
                                    <td><a href="{{ url('product/' . $compareProducts[$i]->id) }}" class="btn btn-custom-2">ADD TO CART &nbsp;<i class="fa fa-shopping-cart"></i></a>
                                        <div class="xs-margin"></div>
                                        @if(Session::has('userId'))
	                                        <a href="javascript:void(0)" class="btn btn-custom" data-toggle="modal" data-target="#wishlist_model" data-placement="top" onclick="$('#wishlist_model #wishlist_product_id').val({{ $compareProducts[$i]->id }}); 
$('#wishlist_model img').attr('src','{{ asset('/public/admin/products/large/' . $compareProducts[$i]->large_image) }}'); 
$('#wishlist_model #list_name').val(''); load_product_attr({{ $compareProducts[$i]->id }});">ADD TO WISHLIST &nbsp;<i class="fa fa-heart"></i></a>
                                        @else
                                        	<a href="javascript:void(0)" class="btn btn-custom" data-toggle="modal" data-target="#login_model" data-placement="top" >ADD TO WISHLIST &nbsp;<i class="fa fa-heart"></i></a>
                                        @endif
                                        <div class="sm-margin"></div>
                                        <a href="{{ url('compare/deleteToCompare/' . $compareProducts[$i]->id) }}" class="close-button"></a>
                                    </td>
                                    @endfor
                                </tr>
                            </table>
                        @endif
                    </div>
                </div>
                <div class="lg-margin"></div>
            </div>
        </div>
    </div>
</section>

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
				
			}
		}
	});
}
</script>
@endsection