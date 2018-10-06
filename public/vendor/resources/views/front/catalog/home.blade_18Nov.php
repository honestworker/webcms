@extends('front/templateFront')

@section('content')
	<section id="content">
    	<div id="breadcrumb-container" class="light">
        	<div class="container">
            	<ul class="breadcrumb">
                	<li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
                    <li class="active">Audio Visual</li>
                </ul>
            </div>
        </div>
    	<div class="container">
        	<div class="row">
            	<div class="col-md-12">
                	<header class="content-title">
						<div class="title-bg">
							<h2 class="title"><?php echo $category[0]['title'];?></h2>
						</div><!-- End .title-bg -->
						<p class="title-desc"><?php echo $category[0]['short_description'];?></p>
					</header>
                    <div class="row">
                    	<aside class="col-md-3 col-sm-4 col-xs-12 sidebar">
                        	<?= $sub_categories; ?>
                            <div class="widget">
                                    <div class="panel-group custom-accordion sm-accordion" id="category-filter">
   										
                                        <div class="panel">
                                            <div class="accordion-header">
                                                <div class="accordion-title"><span>Filter by Brands</span>
                                                </div>
                                                <a class="accordion-btn opened" data-toggle="collapse" data-target="#category-list-1"></a>
                                            </div>
                                            <div id="category-list-1" class="collapse in">
                                                <div class="panel-body">
                                                    <ul class="category-filter-list jscrollpane">
                                                        <li><a href="#filter">Beats (1)</a></li>
                                                        <li><a href="#filter">Belkin (1)</a></li>
                                                        <li><a href="#filter">Hitachi (1)</a></li>
                                                        <li><a href="#filter">LG (33)</a></li>
                                                        <li><a href="#filter">Panasonic (5)</a></li>
                                                        <li><a href="#filter">Philips (2)</a></li>
                                                        <li><a href="#filter">Pioneer (1)</a></li>
                                                        <li><a href="#filter">Samsung (70)</a></li>
                                                        <li><a href="#filter">Sharp (2)</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel">
                                            <div class="accordion-header">
                                                <div class="accordion-title"><span>Filter by Price</span>
                                                </div>
                                                <a class="accordion-btn opened" data-toggle="collapse" data-target="#category-list-2"></a>
                                            </div>
                                            <div id="category-list-2" class="collapse in">
                                                <div class="panel-body">
                                                    <div id="price-range"></div>
                                                    <div id="price-range-details"><span class="sm-separator">From</span> 
                                                        <input type="text" id="price-range-low" class="separator"> <span class="sm-separator">to</span> 
                                                        <input type="text" id="price-range-high">
                                                    </div>
                                                    <div id="price-range-btns"><a href="#" class="btn btn-custom-2 btn-sm">Ok</a>  <a href="#" class="btn btn-custom-2 btn-sm">Clear</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end price filter -->
                                        
                                        <div class="panel">
                                            <div class="accordion-header">
                                                <div class="accordion-title"><span>Filter by Color</span>
                                                </div>
                                                <a class="accordion-btn opened" data-toggle="collapse" data-target="#category-list-3"></a>
                                            </div>
                                            <div id="category-list-3" class="collapse in">
                                                <div class="panel-body">
                                                    <ul class="filter-color-list clearfix">
                                                        <li><a href="#" data-bgcolor="#fff" class="filter-color-box"></a></li>
                                                        <li><a href="#" data-bgcolor="#ffff33" class="filter-color-box"></a></li>
                                                        <li><a href="#" data-bgcolor="#ff9900" class="filter-color-box"></a></li>
                                                        <li class="last-md"><a href="#" data-bgcolor="#ff9999" class="filter-color-box"></a></li>
                                                        <li class="last-lg"><a href="#" data-bgcolor="#99cc33" class="filter-color-box"></a></li>
                                                        <li><a href="#" data-bgcolor="#339933" class="filter-color-box"></a></li>
                                                        <li><a href="#" data-bgcolor="#ff0000" class="filter-color-box"></a></li>
                                                        <li class="last-md"><a href="#" data-bgcolor="#ff3366" class="filter-color-box"></a></li>
                                                        <li><a href="#" data-bgcolor="#cc33ff" class="filter-color-box"></a></li>
                                                        <li class="last-lg"><a href="#" data-bgcolor="#9966cc" class="filter-color-box"></a></li>
                                                        <li><a href="#" data-bgcolor="#99ccff" class="filter-color-box"></a></li>
                                                        <li class="last-md"><a href="#" data-bgcolor="#3333cc" class="filter-color-box"></a></li>
                                                        <li><a href="#" data-bgcolor="#999999" class="filter-color-box"></a></li>
                                                        <li><a href="#" data-bgcolor="#663300" class="filter-color-box"></a></li>
                                                        <li class="last-lg"><a href="#" data-bgcolor="#000" class="filter-color-box"></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end color filter -->
                                        
                                    </div>
                                </div>
                            <?= $most_buy; ?>
                            <?= $latest_promo; ?>
                            <?= $banner_left_slider; ?>
                    	</aside>
                        
                        <div class="col-md-9 col-sm-8 col-xs-12 main-content">
                                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                <?php $i=1;foreach($productBanners as $productBanner){ if($i==1){ $active='active';}else{ $active='';}?>
                                	<div class="item <?php echo $active;?>">
                                        <img src="<?php echo "http://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/product/',$productBanner['banner'];?>" class="img-responsive" alt="<?php echo $productBanner['title'];?>">
                                    </div>
                                <?php $i++;} ?>
                                </div><!-- End .carousel-inner -->

                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                                </div>

                                <div class="md-margin"></div>
                                <div class="category-toolbar clearfix">
                                    <div class="toolbox-filter clearfix">
                                        <div class="sort-box"><span class="separator">Sort by:</span>
                                            <div class="btn-group select-dropdown">
                                                <button type="button" class="btn select-btn">
													<?php 
                                                        if($sort == 'priceAsc'){
                                                            echo 'Price : Low - High';
                                                        }else if($sort == 'priceDesc'){
                                                            echo 'Price : High - Low';
                                                        }else if($sort == 'a-z'){
                                                            echo 'Product Name : A - Z';
                                                        }else if($sort == 'z-a'){
                                                            echo 'Product Name : Z - A';
                                                        }else if($sort == 'date'){
                                                            echo 'Date';
                                                        }else if($sort == 'brand'){
                                                            echo 'Brand';
                                                        }else{
                                                            echo 'New Arrivals';
                                                        }
                                                    ?>
                                                </button>
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="<?= url('category/' . $id.'/priceAsc/'.$item.'/'.$page, $parameters = [], $secure = null); ?>">Price : Low - High</a></li>
                                                    <li><a href="<?= url('category/' . $id.'/priceDesc/'.$item.'/'.$page, $parameters = [], $secure = null); ?>">Price : High - Low</a></li>
                                                    <li><a href="<?= url('category/' . $id.'/a-z/'.$item.'/'.$page, $parameters = [], $secure = null); ?>">Product Name : A - Z</a></li>
                                                    <li><a href="<?= url('category/' . $id.'/z-a/'.$item.'/'.$page, $parameters = [], $secure = null); ?>">Product Name : Z - A</a></li>
                                                    <li><a href="<?= url('category/' . $id.'/date/'.$item.'/'.$page, $parameters = [], $secure = null); ?>">Date</a></li>
                                                    <li><a href="<?= url('category/' . $id.'/brand/'.$item.'/'.$page, $parameters = [], $secure = null); ?>">Brand</a></li>
                                                    <li><a href="<?= url('category/' . $id.'/new/'.$item.'/'.$page, $parameters = [], $secure = null); ?>">New Arrivals</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="view-box">
                                            <a href="#" class="active icon-button icon-grid" title="Image View"><i class="fa fa-th-large"></i></a>  
                                            <a href="#" class="icon-button icon-list" title="List View"><i class="fa fa-th-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="toolbox-pagination clearfix">
                                    	<?php 
											if(isset($products) and count($products)>0){ 
												$totalPage = ceil($products[0]['totalProducts']/$item);
											}else{
												$totalPage=0;	
											}
										?>
                                        <ul class="pagination">
                                        	<?php if($page>1 and $totalPage>1){?>
                                        		<li><a href="<?= url('category/' . $id.'/'.$sort.'/'.$item.'/'.($page-1), $parameters = [], $secure = null); ?>"><i class="fa fa-angle-left"></i></a></li>
                                            <?php }?>
                                        	<?php for($i=1; $i<=$totalPage; $i++){ if($i==$page){ $active='active';}else{ $active='';}?> 
                                            	<li class="<?php echo $active;?>"><a href="<?= url('category/' . $id.'/'.$sort.'/'.$item.'/'.$i, $parameters = [], $secure = null); ?>"><?php echo $i;?></a></li>
                                            <?php }?>
                                            <?php if($totalPage>1 and $page<$totalPage){?>
                                        		<li><a href="<?= url('category/' . $id.'/'.$sort.'/'.$item.'/'.($page+1), $parameters = [], $secure = null); ?>"><i class="fa fa-angle-right"></i></a></li>
                                            <?php }?>
                                        </ul>
                                        <div class="view-count-box"><span class="separator">View:</span>
                                            <div class="btn-group select-dropdown">
                                                <button type="button" class="btn select-btn">
                                                	<?php 
                                                        if($item == 60){
                                                            echo '60 items';
                                                        }else if($item == 40){
                                                            echo '40 items';
                                                        }else{
                                                            echo '20 items';
                                                        }
                                                    ?>
                                                </button>
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="<?= url('category/' . $id.'/'.$sort.'/20/'.$page, $parameters = [], $secure = null); ?>">20 items</a></li>
                                                    <li><a href="<?= url('category/' . $id.'/'.$sort.'/40/'.$page, $parameters = [], $secure = null); ?>">40 items</a></li>
                                                    <li><a href="<?= url('category/' . $id.'/'.$sort.'/60/'.$page, $parameters = [], $secure = null); ?>">60 items</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="xs-margin"></div>
                                <div class="category-item-container">
                                    <div class="row">
                                    	<?php 
											if(isset($products) and count($products)>0){ 
												foreach($products as $product){
										?>
                                        <!-- item 1 start -->
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="item item-hover">
                                                        <div class="item-image-wrapper">
                                                            <figure class="item-image-container">
                                                                <a href="#">
                                                                    <img src="<?php echo "http://".$_SERVER['HTTP_HOST']. '/public/admin/products/large/',$product['large_image'];?>" width="70%" alt="LG NB2540 Sound Bar 2.1CH 120W with Subwoofer" class="item-image">
                                                                	<img src="<?php echo "http://".$_SERVER['HTTP_HOST']. '/public/admin/products/large/',$product['large_image'];?>" width="70%" alt="LG NB2540 Sound Bar 2.1CH 120W with Subwoofer" class="item-image-hover">
                                                                </a>
                                                            </figure>
                                                            <!-- End .item-image-container -->
                                                        </div><!-- End .item-image-wrapper -->
                                                        <div class="item-meta-container">
                                                            <div class="item-meta-inner-container clearfix">
            
                                                                <div class="item-price-container inline">
                                                                    <span class="old-price"></span>
                                                                    <span class="item-price">RM <?php echo $product['list_price'];?><span class="sub-price">.00</span></span>
                                                                </div><!-- End .item-price-container -->
              
                                                            </div><!-- End .item-meta-inner-container -->
 
                                                            <h3 class="item-name"><a href="#"><?php echo $product['product_name'];?></a></h3>

                                                            <div class="item-action">
                                                                <a href="#" class="item-add-btn">
                                                                    <span class="cart-icon-text">Add to Cart</span>
                                                                </a>
                                                                <div class="item-action-inner">
                                                                    <a href="#" class="icon-button icon-like add-tooltip" data-toggle="tooltip" data-placement="top" title="Add to wishlist">Favourite</a>
                                                                    <a href="#" class="icon-button icon-compare add-tooltip" data-toggle="tooltip" data-placement="top" title="Add to compare">Compare</a>
                                                                </div><!-- End .item-action-inner -->
                                                            </div><!-- End .item-action -->
                                                        </div><!-- End .item-meta-container --> 
                                                    </div>
                                        </div>
                                        <!-- end item 1 -->
                                        <?php }}else{?>
                                        	<h3>No Product Found in This Category.</h3>
                                        <?php } ?>
                                        
                                            <div class="clearfix"></div>
                                            
                                                    
                                                    
                                        
                                        
                                        
                                    </div>
                                    <!-- end row-->
                                </div>
                                <div class="pagination-container clearfix">
                                    <div class="pull-right">
                                        <ul class="pagination">
                                        	<?php if($page>1 and $totalPage>1){?>
                                        		<li><a href="<?= url('category/' . $id.'/'.$sort.'/'.$item.'/'.($page-1), $parameters = [], $secure = null); ?>"><i class="fa fa-angle-left"></i></a></li>
                                            <?php }?>
                                        	<?php for($i=1; $i<=$totalPage; $i++){ if($i==$page){ $active='active';}else{ $active='';}?> 
                                            	<li class="<?php echo $active;?>"><a href="<?= url('category/' . $id.'/'.$sort.'/'.$item.'/'.$i, $parameters = [], $secure = null); ?>"><?php echo $i;?></a></li>
                                            <?php }?>
                                            <?php if($totalPage>1 and $page<$totalPage){?>
                                        		<li><a href="<?= url('category/' . $id.'/'.$sort.'/'.$item.'/'.($page+1), $parameters = [], $secure = null); ?>"><i class="fa fa-angle-right"></i></a></li>
                                            <?php }?>
                                        </ul>
                                    </div>
                                    <div class="pull-right view-count-box hidden-xs"><span class="separator">View:</span>
                                        <div class="btn-group select-dropdown">
                                            <button type="button" class="btn select-btn">
                                            	<?php 
                                                	if($item == 60){
                                                    	echo '60 items';
                                                    }else if($item == 40){
                                                        echo '40 items';
                                                    }else{
                                                        echo '20 items';
                                                    }
                                                ?>
                                            </button>
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                            	<li><a href="<?= url('category/' . $id.'/'.$sort.'/20/'.$page, $parameters = [], $secure = null); ?>">20 items</a></li>
                                                <li><a href="<?= url('category/' . $id.'/'.$sort.'/40/'.$page, $parameters = [], $secure = null); ?>">40 items</a></li>
                                                <li><a href="<?= url('category/' . $id.'/'.$sort.'/60/'.$page, $parameters = [], $secure = null); ?>">60 items</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                	</div>
                </div>
            </div>
    	</div>
    </section>
    
    <!-- Brands STARTS
         ========================================================================= -->
         <?= $brands_scroller; ?>
    <!-- /.brands --> 
    
    <!-- Services STARTS
         ========================================================================= -->
    <section id="facts">
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-sm-4 col-xs-12">
                  <h1>Our Services</h1>
                  <h2>Serving you well and making you happy is what we do best!</h2>
                  <p class="line">&nbsp;</p>
               </div>
            </div>
            <div id="our-facts">
               <div class="items">
                  <div class="circle"><i class="fa fa-truck"></i></div>
                  <div class="heading-2">FREE</div>
                  <div class="heading-1">Delivery</div>
               </div>
               <div class="items">
                  <div class="circle"><i class="fa fa-gavel"></i></div>
                  <div class="heading-2">Installation</div>
                  <div class="heading-1">Services</div>
               </div>
               <div class="items">
                  <div class="circle"><i class="fa fa-comments"></i></div>
                  <div class="heading-2">FREE</div>
                  <div class="heading-1">Teaching/Advice</div>
               </div>
               <div class="items">
                  <div class="circle"><i class="fa fa-book"></i></div>
                  <div class="heading-2">FREE</div>
                  <div class="heading-1">Catalog/Brochures</div>
               </div>
               <div class="items">
                  <div class="circle"><i class="fa fa-shield"></i></div>
                  <div class="heading-2">Extended</div>
                  <div class="heading-1">Warranty</div>
               </div>
               <div class="items">
                  <div class="circle"><i class="fa fa-users"></i></div>
                  <div class="heading-2">Earn/Redeem</div>
                  <div class="heading-1">Points</div>
               </div>
               <div class="items">
                  <div class="circle"><i class="fa fa-dollar"></i></div>
                  <div class="heading-2">Interest</div>
                  <div class="heading-1">FREE</div>
               </div>
               <div class="items">
                  <div class="circle"><i class="fa fa-recycle"></i></div>
                  <div class="heading-2">Product</div>
                  <div class="heading-1">Recycling</div>
               </div>
               <div class="items">
                  <div class="circle"><i class="fa fa-gift"></i></div>
                  <div class="heading-2">FREE</div>
                  <div class="heading-1">Gifts</div>
               </div>
               <div class="items">
                  <div class="circle"><i class="fa fa-dropbox"></i></div>
                  <div class="heading-2">FREE</div>
                  <div class="heading-1">Wrapping</div>
               </div>
               <div class="items">
                  <div class="circle"><i class="fa fa-wrench"></i></div>
                  <div class="heading-2">Repair</div>
                  <div class="heading-1">Services</div>
               </div>
               <div class="items">
                  <div class="circle"><i class="fa fa-tasks"></i></div>
                  <div class="heading-2">Spare</div>
                  <div class="heading-1">Parts</div>
               </div>
            </div>
         </div>
<div id="video">
            <video autoplay loop>
               <source src="" type="">
            </video>
         </div>
      </section>
    <!-- /.services -->
      
@endsection
