<?php
	if(count($latest_arrivals) > 0)
	{
		$i=1;
		foreach($latest_arrivals as $category){
		?>
        <div>
		<header class="content-title">
			<h2 class="title"><?php echo $category['category']['title'];?></h2>	
    		<p class="title-desc">We are going to make you happy. Look what we have for you!</p>
		</header>
        <ul id="products-tabs-list" class="tab-style-1 clearfix">
		<?php
			$j=0;
			if(isset($category['tabs']))
			{
			foreach($category['tabs'] as $tabs){
			?>
				<li class=" <?php if($j==0){ echo 'active';}?>"><a href="#<?php if(isset($tabs['id'])){ echo $tabs['id'] ;}?>" data-toggle="tab"><?php if(isset($tabs['title'])){echo $tabs['title'];} ?></a></li>
    		<?php 				
				$j++;
			}}
		?>
		</ul>
        <div id="products-tabs-content" class="row tab-content">
                	 <?php
						$j=0;
						if(isset($category['tabs']))
			{
						foreach($category['tabs'] as $tabs){
					?>
                    <div class="tab-pane <?php if($j==0){ echo 'active';}?> tab-carousel-wrapper" id="<?php if(isset($tabs['id'])){ echo $tabs['id'] ;}?>">
                        <div class="carousel-controls">
                            <div id="latest-tab-slider-prev<?php echo $i;?><?php echo $j;?>" class="carousel-btn carousel-btn-prev"></div>
                            <div id="latest-tab-slider-next<?php echo $i;?><?php echo $j;?>" class="carousel-btn carousel-btn-next carousel-space"></div>
                        </div>
                        <div class="latest-tab-slider<?php echo $i;?><?php echo $j;?> owl-carousel">
                            
                                <?php 
                                    if(isset($tabs['productDetail']) ){echo count($tabs['productDetail']);
                                ?>
                                                          
                                        @foreach($tabs['productDetail'] as $product)
                                            <?php $urlProduct = url('product/'.$product->id); ?>
                                            <div class="owl-single-col">
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
                                                        <?php /*?>                                            
                                                          @if($product->thumbnail_image_2 == '')
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
                                                                                            
                                                    @if($product->list_price != $product->sale_price && $product->list_price!=0)
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
                                            </div>                    
                                            
                                        @endforeach
                                <?php }?> 
                            </div>
                        </div>
                        
                    <?php 				
						$j++;
					}}
					?>
        
        </div>
        <div style="clear:both;"></div>
        </div>
		<?php
			$i++;
		}
		?>
	<?php
	}
?>
