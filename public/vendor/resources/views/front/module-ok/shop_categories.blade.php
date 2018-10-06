<div class="widget">
    <h3>Shop Categories</h3>
    <div class="list-group list-group-brand">
    	<?php 
			foreach($categories as $cat){
				echo '<a href="'.url('/products/'.$cat['category_id'].'/new').'" class="list-group-item">'.$cat['title'].'</a>';
			}
		?>
    </div>
</div>