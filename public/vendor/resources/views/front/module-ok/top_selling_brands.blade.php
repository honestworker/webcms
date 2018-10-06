<div class="widget">
    <h3>Top Selling Brands</h3>
    <div class="list-group list-group-brand">
        
        <?php
		
		if(count($topSellingBrands) > 0)
		{
			foreach($topSellingBrands as $brandDetails)
			{
				echo '<a href="'.url('/products/0/new?brand='.$brandDetails->id).'" class="list-group-item">'.$brandDetails->title.'</a>';		
			}
		}
		?>
                          
    </div>
</div>