<?php
use App\Http\Models\Front\Product;
$this->ProductModel = new Product();
if(!isset($bestsellers)) {
	$bestsellers = $this->ProductModel->getBestsellers(12);
}


if(count($bestsellers) > 0)
{
?>
<div class="widget popular">
    <h3>Most Buy</h3>
    <!-- this recommend section is to random display the product section of Audio Visual -->
    <div class="related-slider flexslider sidebarslider">
        
       		<ul class="related-list clearfix">
        	<?php
			$i = 1;
			foreach($bestsellers as $product)
			{
				$urlProduct = url('product/'.$product->id);
				
				$product_sale_price = $product->sale_price;
				$whole_price = floor($product_sale_price);
				$sub_price = $product_sale_price - $whole_price;												
				$sub_price = str_replace('0.','',number_format($sub_price,2));
				
				if($i == 1)
				{
					echo '<li>';	
				}
				?>
					<div class="related-product clearfix">
						<figure>
				
							@if($product->thumbnail_image_1 != '')
								<img src="{{ asset('/public/admin/products/medium/'.$product->thumbnail_image_1) }}" alt="{{ $product->product_name }}" class="item-image" width="100" />
							@endif
                            @if($product->thumbnail_image_1 == '')
                                                                <img src="{{ asset('/public/admin/products/no-image.jpg') }}" alt="{{ $product->product_name }}" class="item-image" width="100" height="100px">
                                                            @endif
							
							<!--@if($product->thumbnail_image_1 == '')
								<img src="{{ asset('/public/admin/products/medium/' . $product->large_image) }}" alt="{{ $product->product_name }}" class="item-image" width="100">
							@endif-->
							
							<!--@if( $product->thumbnail_image_2 != '')
								<img src="{{ asset('/public/admin/products/medium/'.$product->thumbnail_image_2) }}" alt="{{ $product->product_name }}" class="item-image-hover" width="100" height="100px" />
							@endif-->
							
							<!--@if($product->thumbnail_image_2 == '')
								<img src="{{ asset('/public/admin/products/medium/' . $product->large_image) }}" alt="{{ $product->product_name }}" class="item-image-hover" width="100">
							@endif-->
				
                		</figure>
						<h5><a href="{{ $urlProduct }}"><?php echo (strlen($product->product_name) > 25) ? substr($product->product_name,0,20).'...' : $product->product_name; ?></a></h5>
						<div class="related-price">RM {{ number_format($product->sale_price,2) }}</div>
					</div>
				<?php
				if($i%4 == 0 && $i < count($bestsellers))
				{
					echo '</li><li>';	
				}
				
				if(count($bestsellers) == $i)
				{
					echo '</li>';	
				}
				
				$i++;
			} // end foreach
			?> 
           
        </ul>       
    </div>
</div>
<?php
}  // end if
?>