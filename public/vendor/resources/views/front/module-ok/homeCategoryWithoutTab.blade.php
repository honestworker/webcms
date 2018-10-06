                                        <!--Home Category Without Tabs Start-->            
         <?php if(count($homeCategoryWithoutTab) > 0){ //echo '<pre>'; print_r($homeCategoryWithoutTab);die;
		 $i=1;
		 ?>
         	@foreach($homeCategoryWithoutTab as $details)
            <div id="services-slider-container" class="carousel-wrapper">
            	<div class="withoutTab">
				<header class="content-title">
					<div class="title-bg">
						<h2 class="title">{{ $details['catName'] }}</h2>
					</div><!-- End .title-bg -->
					<p class="title-desc">Grab great deals from TBM this week and get extra points with any of your purchase.</p>
				</header>
                
                <div class="carousel-controls">
                                    <div id="hot-items-slider-prev<?php echo $i;?>" class="carousel-btn carousel-btn-prev">
                                    </div><!-- End .carousel-prev -->
                                    <div id="hot-items-slider-next<?php echo $i;?>" class="carousel-btn carousel-btn-next carousel-space">
                                    </div><!-- End .carousel-next -->
                                </div><!-- End .carousel-controls -->
        						<div class="hot-items-slider<?php echo $i;?> owl-carousel">

        			<!-- on sale item 1 start -->
					<?php
				  // if($i==1){
                   if(isset($details['productDetail'])){ ?>
                  
				 @foreach($details['productDetail'] as $product)
                    <?php $urlProduct = url('product/'.$product->id); ?>
                    	<div class="item item-hover">
                        	<div class="item-image-wrapper">
                            	<figure class="item-image-container">
                                	<a href="{{ $urlProduct }}">
                                    	@if($product->thumbnail_image_1 != '')
                                        <img src="{{ asset('/public/admin/products/medium/'.$product->thumbnail_image_1) }}" alt="{{ $product->product_name }}" class="item-image" width="153px" height="153px" />
                                        @endif
                                                                        
                                       @if($product->thumbnail_image_1 == '')
                                        <img src="{{ asset('/public/admin/products/no-image.jpg') }}" alt="{{ $product->product_name }}" class="item-image" width="153px" height="153px">
                                         @endif
                                                                        
                                        @if($product->thumbnail_image_2 != '')
                                        <img src="{{ asset('/public/admin/products/medium/'.$product->thumbnail_image_2) }}" alt="{{ $product->product_name }}" class="item-image-hover" width="153px" height="153px" />
                                        @endif
                                                                        
                                       <?php /*?> @if($product->thumbnail_image_2 == '')
                                        <img src="{{ asset('/public/admin/products/medium/' . $product->large_image) }}" alt="{{ $product->product_name }}" class="item-image-hover" width="153px" height="153px">
                                        @endif<?php */?>
                                    </a>
                                </figure>
								<?php if(preg_match('/new/',$product->promo_behaviour)){ 
	                            	echo '<span class="new-circle top-left">New</span>'; 
                                 } ?>
                                <?php if(preg_match('/hot/',$product->promo_behaviour)){ 
    	                            echo '<span class="new-circle top-left">Hot</span>'; 
                                 } ?>
                                 <?php if(preg_match('/sale/',$product->promo_behaviour)){ 
        	                     	echo '<span class="new-circle top-left">Sale</span>'; } 
                                 ?>
                                 <?php if(preg_match('/pwp/',$product->promo_behaviour)){ 
            	                 	echo '<span class="new-circle top-left">pwp</span>'; 
                                 } ?>
                                                                
                                 @if($product->list_price != $product->sale_price)
                                 	<span class="discount-circle top-right">-{{ number_format(100 - (($product->sale_price/($product->list_price)*100)), 0) }}%</span>
                                 @endif                
                             </div>
                             <div class="item-meta-container">
                             	<div class="item-meta-inner-container clearfix">
                                	<div class="item-price-container inline">
                                    	@if($product->list_price != $product->sale_price)
	                                    	<span class="old-price">RM {{ number_format($product->list_price, 2) }}</span>
                                        @endif
                                        <span class="item-price">RM {{ number_format($product->sale_price, 2) }}</span>
                                    </div>
                  
                                </div>     
                                <h3 class="item-name"><a href="{{ $urlProduct }}"><?php $pname= $product->product_name; echo strlen($pname)<=10 ? $pname : substr($pname,0,30).'...'; ?></a></h3>
                                <div class="item-action">
                                	<a href="{{ $urlProduct }}" class="item-add-btn">
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
                    
					<?php }//}
					$i++;
					?>
                   
                    <!-- End on sale item 1 -->
				</div><!--hot-items-slider -->
                </div>
             <div class="lg-margin"></div><!-- Space -->
        	</div>
             @endforeach
		 <?php } ?>