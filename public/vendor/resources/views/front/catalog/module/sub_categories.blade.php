<div class="widget category-accordion">
	<h3>Categories</h3>
    <div class="panel-group" id="accordion">
    	<?php 
			foreach($subCategories as $cat){
				echo '<div class="panel panel-custom">
						<div class="panel-heading">
							<h4 class="panel-title">'.$cat['title'].' <a data-toggle="collapse" href="#collapseTwo"><!--<span class="icon-box">&minus;</span>--></a></h4>
						</div>
					</div>';
			}
		?>
    	<?php /*?><div class="panel panel-custom">
        	<div class="panel-heading">
            	<h4 class="panel-title">HOME ENTERTAINMENT (30) <a data-toggle="collapse" href="#collapseOne"><span class="icon-box">&minus;</span></a></h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
            	<div class="panel-body">
                	<ul class="category-accordion-list">
                    	<li><a href="category_disc_player.html">Disc Player (8)</a></li>
                        <li><a href="#">Mini HiFi (3)</a></li>
                        <li><a href="#">Micro HiFi (2)</a></li>
                        <li><a href="#">Sound Bar (4)</a></li>
                        <li><a href="#">Home Theatre System (5)</a></li>
                        <li><a href="#">AV Component (8)</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel panel-custom">
        	<div class="panel-heading">
            	<h4 class="panel-title">TV (22) <a data-toggle="collapse" href="#collapseTwo"><!--<span class="icon-box">&minus;</span>--></a></h4>
            </div>
        </div><?php */?>
        <!-- end panel custom -->
	</div>
</div>
