<div class="widget">
    <h3>Shop Categories</h3>
    <div class="list-group list-group-brand list-group-accordion">
    	<?php 
			foreach($categories as $cat){
				echo '<a href="'.url('/products/'.$cat['category_id'].'/new').'" class="list-group-item"><i class="filter-icon1 fa fa-'.$cat['iconKeyword'].'"></i>'.$cat['title'].'</a>';
			}
		?>
    </div>
</div>