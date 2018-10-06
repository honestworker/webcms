@extends('front/templateFront')

@section('content')                
<?php
use App\Http\Models\Front\SpecialList;
$SpecialListModel = new SpecialList();
?>
        <section id="content">
        	<div class="xs-margin"></div>
            <div class="xs-margin"></div>
            <div id="breadcrumb-container" class="light">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">My Special List</li>
                    </ul>
                </div>
            </div>
            
            
            <div class="container">
                <div class="row">
                	<div class="col-md-12">
						
                        <header class="content-title">
                            <div class="title-bg">
								<h2 class="title">Special List</h2>
							</div><!-- End .title-bg -->
                            <p class="title-desc">Looking for a gift for your friend's event? We have got great deals and offers.</p>
                        </header>
                        
                        <div class="xs-margin"></div>
                        
                        @if(session()->has('data.success'))                             	
                                <div class="alert alert-success alert-dismissable">
                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                                <p>{{  session('data.success') }}</p>
                              </div>
                            @endif
                        
                        <div class="row">
                            
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <!--<h3 class="checkout-title">For Hock Lim &amp; Test Test, </h3>-->
                                <p>Event Type: {{ $event_details->event_type }}</p>
                                <p>Event Date: {{ date('dS M, Y',strtotime($event_details->event_date)) }}</p>
                                <p>Event ID: {{ $event_details->id }}</p>
                                
                            </div>                            
                            
                        <div class="md-margin"></div>
                        <div class="clearfix"></div>
                        <?php 
						if(count($event_items) > 0)
						{
						?>
                        <div class="table-responsive">
                        <form id="form_event_items">
                            <table class="table cart-table">
                                <thead>
                                    <tr>
                                        <th class="table-title">Product Name</th>
                                        <th class="table-title">Product Code</th>
                                        <th class="table-title">Unit Price</th>
                                        <th class="table-title">Would Love</th>
                                        <th class="table-title">Still Need</th>
                                        <th class="table-title">Purchase</th>
                                        <th class="table-title"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
									foreach($event_items as $item)
									{
										//dd($event_items)										
										$price = str_replace('.','.<span class="sub-price">',number_format($item->sale_price, 2)).'</span>';
										
										$total_order = $SpecialListModel->totalOrdered($item->product_id,$item->event_id,$item->color_id);
										
										$total_order = ($total_order) ? $total_order : 0;
										
										$still_need = ($total_order < $item->still_need) ? ($item->still_need - $total_order) : '<i class="fa fa-check-circle text-red"></i> Completed';
								?>
                                    <tr>
                                        <td class="item-name-col">
                                            <figure><a href="{{ url('/product/'. $item->id) }}"><img src="{{ asset('/public/admin/products/large/'. $item->large_image) }}" alt="{{ $item->product_name }}" class="img-responsive"></a></figure>
                                            <header class="item-name">
                                                <a href="{{ url('/product/'. $item->id) }}">{{ $item->product_name }}</a>                                               
                                            </header>
                                            <ul>
                                              @if($item->color_title)<li>Color: {{ $item->color_title }}</li> @endif
                                              <li><span>Availability:</span> <span class="text-success">{{ ($item->is_available == '1') ? 'In Stock' : 'Out of Stock' }}</span></li>
                                              
                                            </ul>                                          
                                        </td>
                                        <td class="item-code">{{ $item->product_code }}</td>
                                        <td class="item-price-col"><span class="item-price-special">RM <?php echo number_format($item->sale_price, 2); ?></span></td>
                                        <td><?php echo $item->would_love; ?></td>
                                        <td><?php echo $still_need; ?></td> 
                                        <td>
                                            <div class="custom-quantity-input">
                                                <input type="text" name="quantity" class="quantity_<?php echo $item->event_item_id; ?>" value="1"> <a href="javascript:void(0)" onClick="increaseQuantity(<?php echo $item->event_item_id; ?>)" class="quantity-btn quantity-input-up"><i class="fa fa-angle-up"></i></a>  <a href="javascript:void(0)" onClick="decreaseQuantity(<?php echo $item->event_item_id; ?>)" class="quantity-btn quantity-input-down"><i class="fa fa-angle-down"></i></a>
                                                
                                                <input class="cart_data" type="hidden" name="cart[<?php echo $item->event_item_id; ?>][product_id]" value="<?php echo $item->id; ?>" />
                                        		<input class="cart_data" type="hidden" name="cart[<?php echo $item->event_item_id; ?>][color_id]" value="<?php echo $item->color_id; ?>" />
                                        		<input class="cart_data quantity_<?php echo $item->event_item_id; ?>" type="hidden" name="cart[<?php echo $item->event_item_id; ?>][quantity]" value="1" />
                                                <input class="cart_data" type="hidden" name="cart[<?php echo $item->event_item_id; ?>][special_event_id]" value="<?php echo $event_details->id; ?>" />
                                                              
                                            </div>                                            
                                        </td>
                                        <td><a href="#" class="close-button add-tooltip" data-toggle="modal" data-target="#delete-special-list-item" data-placement="top" title="Remove" onclick="$('#delete_event_item_id').val({{ $item->event_item_id }})"></a></td>
                                    </tr>
                                <?php
									} // end foreach
									?>
                                </tbody>
                            </table>
                            
                           </form> 
                          
                        </div>
                        
                        <div class="md-margin"></div> 
                        <input class="cart_data"  type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                        <a onclick="add_all_to_cart()" href="javascript:void(0)" class="btn btn-custom-2">ADD TO CART &nbsp;<i class="fa fa-shopping-cart"></i></a>
                        <div class="md-margin"></div>
                        
                        <?php
						} // end if(count($event_items) > 0)
						?>
                        <!-- end table responsive -->
                            
                        <script>
                        	
							function increaseQuantity(wishlist_item_id)
							{
								elm = $('.quantity_'+wishlist_item_id);
								if(isNaN(elm.val()) || elm.val() == '')
								{
									elm.val(0);
								}
								
								elm.val(Number(elm.val()) + 1 );
							}
							
							function decreaseQuantity(wishlist_item_id)
							{
								elm = $('.quantity_'+wishlist_item_id);
								
								if(isNaN(elm.val()) || elm.val() == '')
								{
									elm.val(0);
								}
								
								if(elm.val() > 0)
								{
									elm.val(Number(elm.val()) - 1 );
								}	
							}
							
							function add_all_to_cart()
							{
								/*$('.add_to_cart_link').each(function(){
									alert($(this).attr('onclick'));	
								});*/	
								
								$.ajax({
										url: '<?php echo url('/cart/addAllToCart') ?>',
											type:'post',
											dataType:'json',
											data: $('.cart_data'),
											success: function(response) {			
												
												if(response['success'])
												{
													var success = '<div class="alert alert-success alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>Added to cart.</p></div>';
													$('#ajax_response').html(success);
												}
												
												$('.dropdown-cart-menu-container').load('{{ url("cart/cartHtml") }} .dropdown-cart-menu-container > *');																
											}	
									});
								
							}
							
                        </script>   
                        
                        <!--  delete list item modal start -->
                        <div class="modal fade" id="delete-special-list-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                          <form id="login-form-2" method="post" action="{{ url('/deleteEventItem') }}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title" id="myModalLabel2">Delete Product from Wishlist</h4>
                                        </div><!-- End .modal-header -->
                                        <div class="modal-body clearfix">
                    
                                            <p>Delete product cannot be recovered. Are you sure you want to delete this product?</p>
                    
                                        </div><!-- End .modal-body -->
                                        <div class="modal-footer">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="delete_event_item_id" id="delete_event_item_id"  value="">
                                            <button type="submit" class="btn btn-custom-2">DELETE</button>
                                            <button type="button" class="btn btn-custom" data-dismiss="modal">CANCEL</button>
                                        </div><!-- End .modal-footer -->
                                    </div><!-- End .modal-content -->
                                </div><!-- End .modal-dialog -->
                                </form>
                            </div>
                        <!-- End .modal delete list item -->      
                        
  						<div class="md-margin"></div>                        
                        
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
                                            
                                            	@if($product->thumbnail_image_1 != '')
                                                <img src="{{ asset('/public/admin/products/medium/'.$product->thumbnail_image_1) }}" alt="{{ $product->product_name }}" class="item-image" width="153px" height="153px" />
                                                @endif
                                                
                                                @if($product->thumbnail_image_1 == '')
                                                <img src="{{ asset('/public/admin/products/medium/' . $product->large_image) }}" alt="{{ $product->product_name }}" class="item-image" width="153px" height="153px">
                                                @endif
                                                
                                                @if($product->thumbnail_image_2 != '')
                                                <img src="{{ asset('/public/admin/products/medium/'.$product->thumbnail_image_2) }}" alt="{{ $product->product_name }}" class="item-image-hover" width="153px" height="153px" />
                                                @endif
                                                
                                                @if($product->thumbnail_image_2 == '')
                                                    <img src="{{ asset('/public/admin/products/medium/' . $product->large_image) }}" alt="{{ $product->product_name }}" class="item-image-hover" width="153px" height="153px">
                                                @endif
                                               
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
                                        <h3 class="item-name"><a href="{{ url('product/' . $product->id) }}">{{ $product->product_name }}</a></h3>
                                       
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
                        <!-- end row -->    
  
                        
                       
                    </div>
                    <!-- end col-md-12 -->
                    
            	</div>
                <!-- end row -->
                
    		</div>
            <!-- end container -->
            
            
    
    </section>
    
<?php
	// Brands & Services are done in the templateFront.blade.php
	if(isset($brands_scroller)) unset($brands_scroller);
?>
        
<!-- copy to clipboard -->
<script src="{{ asset('/public/front/js/zclip/jquery.zeroclipboard.js') }}"></script>		
<script>
jQuery(document).ready(function($) {
			
	$("#copyToClipboard")
        .on("copy", function(e) {
		  
		  copied_text = $('#share_link').text();
		  $('.copied_msg').html('Share link has been copied.');
		  
          e.clipboardData.clearData();
          e.clipboardData.setData("text/plain", copied_text);
         // e.clipboardData.setData("text/html", copied_text);
          e.preventDefault();
        });
		
});
</script>        
<!-- end copy to clipboard -->        
      
    
@endsection
