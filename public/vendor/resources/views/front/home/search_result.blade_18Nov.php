@extends('front/templateFront')

@section('content')
<section id="content">
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
								<h2 class="title">Search Results</h2>
							</div><!-- End .title-bg -->
						</header>
                        <div class="row">
                        	<aside class="col-md-3 col-sm-4 col-xs-12 sidebar">
                            	
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
                                <!-- Recommend sidebar start -->
                                <div class="widget popular">
                                    <h3>Most Buy</h3>
                                    <!-- this recommend section is to random display the product section of Audio Visual -->
                                    <div class="related-slider flexslider sidebarslider">
                                        <ul class="related-list clearfix">
                                            <li>
                                                <div class="related-product clearfix">
                                                    <figure>
                                                        <img src="images/index/recommend/item3.jpg" alt="Panasonic DMC-TZ30 Silver">                                                    </figure>
                                                    <h5><a href="#">Panasonic DMC-TZ30 Silver</a></h5>
                                                    
                                                    <div class="related-price">RM 649<span class="sub-price">.50</span></div>
                                                </div>
                                                <div class="related-product clearfix">
                                                    <figure>
                                                        <img src="images/index/recommend/item4.jpg" alt="Samsung UA78HU9000 78 inch TV">                                                    </figure>
                                                    <h5><a href="#">Samsung UA78HU9000 78" TV</a></h5>
                                                    <div class="related-price">RM 17,630<span class="sub-price">.00</span></div>
                                                </div>
                                                <div class="related-product clearfix">
                                                    <figure>
                                                        <img src="images/index/recommend/item5.jpg" alt="Panasonic KX-TG6811MLB">                                                    </figure>
                                                    <h5><a href="#">Panasonic KX-TG6811MLB </a></h5>
                                                    <div class="related-price">RM 180<span class="sub-price">.00</span></div>
                                                </div>
                                                <div class="related-product clearfix">
                                                    <figure>
                                                        <img src="images/index/recommend/item1.jpg" alt="Samsung G900F Galaxy S5">                                                    </figure>
                                                    <h5><a href="#">Samsung G900F Galaxy S5</a></h5>
                                                    <div class="related-price">RM 1,850<span class="sub-price">.00</span></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="related-product clearfix">
                                                    <figure>
                                                        <img src="images/index/recommend/item1.jpg" alt="Samsung G900F Galaxy S5">                                                    </figure>
                                                    <h5><a href="#">Samsung G900F Galaxy S5</a></h5>
                                                    <div class="related-price">RM 1,850<span class="sub-price">.00</span></div>
                                                </div>
                                                <div class="related-product clearfix">
                                                    <figure>
                                                        <img src="images/index/recommend/item3.jpg" alt="Panasonic DMC-TZ30 Silver">                                                    </figure>
                                                    <h5><a href="#">Panasonic DMC-TZ30 Silver</a></h5>
                                                    
                                                    <div class="related-price">RM 649<span class="sub-price">.50</span></div>
                                                </div>
                                                <div class="related-product clearfix">
                                                    <figure>
                                                        <img src="images/index/recommend/item4.jpg" alt="Samsung UA78HU9000 78 inch TV">                                                    </figure>
                                                    <h5><a href="#">Samsung UA78HU9000 78" TV</a></h5>
                                                    <div class="related-price">RM 17,630<span class="sub-price">.00</span></div>
                                                </div>
                                                <div class="related-product clearfix">
                                                    <figure>
                                                        <img src="images/index/recommend/item5.jpg" alt="Panasonic KX-TG6811MLB">                                                    </figure>
                                                    <h5><a href="#">Panasonic KX-TG6811MLB </a></h5>
                                                    <div class="related-price">RM 180<span class="sub-price">.00</span></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Recommend sidebar -->
                                <!-- Latest Promo start sidebar -->
                                <div class="widget latest-posts">
                                    <h3>Latest Promo</h3>
                                    <div class="latest-posts-slider flexslider sidebarslider">
                                        <ul class="latest-posts-list clearfix">
                                            <li>
                                                <a href="#">
                                                    <figure class="latest-posts-media-container">
                                                        <img class="img-responsive" src="images/index/news1.jpg" alt="Hot Selling">                                                    </figure>
                                                </a>
                                                <h4><a href="#">Hot Selling</a></h4>
                                                <p>Special edition Hello Kitty LG pocket printer, while stock last.</p>
                                                
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <figure class="latest-posts-media-container">
                                                        <img class="img-responsive" src="images/index/news2.jpg" alt="50% Extreme Camera Sales!">                                                    </figure>
                                                </a>
                                                <h4><a href="#">50% Extreme Camera Sales!</a></h4>
                                                <p>Please place the promotion description here.</p>
                                               
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <figure class="latest-posts-media-container">
                                                        <img class="img-responsive" src="images/index/news3.jpg" alt="KICKSTART Promotion!">                                                    </figure>
                                                </a>
                                                <h4><a href="#">KICKSTART Promotion!</a></h4>
                                                <p>Up to 40% OFF kitchen cabinets. 50% OFF Panasonic SHI-MA-U accessories.</p>
                                                
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Latest Promo sidebar -->
                                
                                <div class="widget banner-slider-container">
                                    <div class="banner-slider flexslider">
                                        <ul class="banner-slider-list clearfix">
                                            <li>
                                                <a href="#">
                                                    <img src="images/banner1.jpg" alt="Banner 1">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="images/banner2.jpg" alt="Banner 2">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="images/banner3.jpg" alt="Banner 3">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </aside>
                        
                            <div class="col-md-9 col-sm-8 col-xs-12 main-content">
                                
								<p>You have searched keyword(s): <b><?php echo $keyword; ?></b></p>
                                <hr>
                                <div class="md-margin"></div>
                                <div class="category-toolbar clearfix">
                                    <div class="toolbox-filter clearfix">
                                        <div class="sort-box"><span class="separator">Sort by:</span>
                                            <div class="btn-group select-dropdown">
                                                <button type="button" class="btn select-btn">--</button>
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#">Price : Low - High</a></li>
                                                    <li><a href="#">Price : High - Low</a></li>
                                                    <li><a href="#">Product Name : A - Z</a></li>
                                                    <li><a href="#">Product Name : Z - A</a></li>
                                                    <li><a href="#">Date</a></li>
                                                    <li><a href="#">Brand</a></li>
                                                    <li><a href="#">New Arrivals</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="view-box">
                                            <a href="#" class="active icon-button icon-grid" title="Image View"><i class="fa fa-th-large"></i></a>  
                                            <a href="#" class="icon-button icon-list" title="List View"><i class="fa fa-th-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="toolbox-pagination clearfix">
                                        <ul class="pagination">
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#">5</a></li>
                                            <li><a href="#">...</a></li>
                                            <li><a href="#"><i class="fa fa-angle-right"></i></a>
                                            </li>
                                        </ul>
                                        <div class="view-count-box"><span class="separator">View:</span>
                                            <div class="btn-group select-dropdown">
                                                <button type="button" class="btn select-btn">20 items</button>
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#">20 items</a></li>
                                                    <li><a href="#">40 items</a></li>
                                                    <li><a href="#">60 items</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="xs-margin"></div>
                                <div class="category-item-container">
                                    <div class="row">
                                        <!-- item 1 start -->
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="item item-hover">
                                                        <div class="item-image-wrapper">
                                                            <figure class="item-image-container">
                                                                <a href="#">
                                                                    <img src="images/category_audio_visual/LG_NB2540.jpg" alt="LG NB2540 Sound Bar 2.1CH 120W with Subwoofer" class="item-image">
                                                                <img src="images/category_audio_visual/LG_NB2540-hover.jpg" alt="LG NB2540 Sound Bar 2.1CH 120W with Subwoofer" class="item-image-hover">                                                                 </a>                                                            </figure>
                                                            <!-- End .item-image-container -->
            
                                                        </div><!-- End .item-image-wrapper -->
                                                        <div class="item-meta-container">
                                                            <div class="item-meta-inner-container clearfix">
            
                                                                <div class="item-price-container inline">
                                                                    <span class="old-price"></span>
                                                                    <span class="item-price">RM 670<span class="sub-price">.00</span></span>
                                                                </div><!-- End .item-price-container -->
              
                                                            </div><!-- End .item-meta-inner-container -->
 
                                                            <h3 class="item-name"><a href="#">LG NB2540 Sound Bar 2.1CH 120W</a></h3>

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
                                        <!-- item 2 start -->
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="item item-hover">
                                                        <div class="item-image-wrapper">
                                                            <figure class="item-image-container">
                                                                <a href="#">
                                                                    <img src="images/category_audio_visual/SAMSUNG_HT-E350K.jpg" alt="Samsung HT-E350K Satellite HTS 330W" class="item-image">
                                                                    <img src="images/category_audio_visual/SAMSUNG_HT-E350K-hover.jpg" alt="Samsung HT-E350K Satellite HTS 330W" class="item-image-hover">                                                                 </a>                                                           </figure>
                                                        <!-- End .item-image-container -->
            
                                                        </div><!-- End .item-image-wrapper -->
                                                        <div class="item-meta-container">
                                                            <div class="item-meta-inner-container clearfix">
            
                                                                <div class="item-price-container inline">
                                                                    <span class="old-price"></span>
                                                                    <span class="item-price">RM 450<span class="sub-price">.00</span></span>
                                                                </div><!-- End .item-price-container -->
              
                                                            </div><!-- End .item-meta-inner-container -->
 
                                                            <h3 class="item-name"><a href="#">Samsung HT-E350K Satellite HTS 330W</a></h3>
                                                            
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
                                        <!-- end item 2 -->
                                        <!-- item 3 start -->
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="item item-hover">
                                                        <div class="item-image-wrapper">
                                                            <figure class="item-image-container">
                                                                <a href="#">
                                                                    <img src="images/category_audio_visual/LG_55LB6500.jpg" alt="LG 55LB6500 55 inch LCD LED TV FHD Smart 3HDMI Cinema 3D" class="item-image">
                                                                    <img src="images/category_audio_visual/LG_55LB6500-hover.jpg" alt="LG 55LB6500 55 inch LCD LED TV FHD Smart 3HDMI Cinema 3D" class="item-image-hover">                                                                </a>                                                           </figure>
                                                        <!-- End .item-image-container -->
            
                                                        </div><!-- End .item-image-wrapper -->
                                                        <div class="item-meta-container">
                                                            <div class="item-meta-inner-container clearfix">
            
                                                                <div class="item-price-container inline">
                                                                    <span class="old-price"></span>
                                                                    <span class="item-price">RM 3,790<span class="sub-price">.00</span></span>
                                                                </div><!-- End .item-price-container -->
              
                                                            </div><!-- End .item-meta-inner-container -->
 
                                                            <h3 class="item-name"><a href="#">LG 55LB6500 55 inch LCD LED TV</a></h3>
                                                            
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
                                        <!-- end item 3 -->
                                        <!-- item 4 start -->
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="item item-hover">
                                                        <div class="item-image-wrapper">
                                                            <figure class="item-image-container">
                                                                <a href="#">
                                                                    <img src="images/category_audio_visual/LG_BP325.jpg" alt="LG BP325 3D Blu-ray Disc Player" class="item-image">
                                                                    <img src="images/category_audio_visual/LG_BP325-hover.jpg" alt="LG BP325 3D Blu-ray Disc Player" class="item-image-hover">                      </a>                                                            </figure>
                                                        <!-- End .item-image-container -->
            
                                                        </div><!-- End .item-image-wrapper -->
                                                        <div class="item-meta-container">
                                                            <div class="item-meta-inner-container clearfix">
            
                                                                <div class="item-price-container inline">
                                                                    <span class="old-price"></span>
                                                                    <span class="item-price">RM 399<span class="sub-price">.00</span></span>
                                                                </div><!-- End .item-price-container -->
              
                                                            </div><!-- End .item-meta-inner-container -->
 
                                                            <h3 class="item-name"><a href="#">LG BP325 3D Blu-ray Disc Player</a></h3>
                                                            
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
                                            <!-- end item 4 -->
                                            <div class="clearfix"></div>
                                            <!-- item 5 start -->
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                            <div class="item-image-wrapper">
                                                                <figure class="item-image-container">
                                                                    <a href="#">
                                                                        <img src="images/category_audio_visual/LG_BH9540TW.jpg" alt="LG BH9540TW 3D Blu Ray HTS 1460W Wireless Rear Spk" class="item-image">
                                                                    <img src="images/category_audio_visual/LG_BH9540TW-hover.jpg" alt="LG BH9540TW 3D Blu Ray HTS 1460W Wireless Rear Spk" class="item-image-hover">                                                                     </a>                                                                </figure>
                                                                <!-- End .item-image-container -->
                
                                                            </div><!-- End .item-image-wrapper -->
                                                            <div class="item-meta-container">
                                                                <div class="item-meta-inner-container clearfix">
                
                                                                    <div class="item-price-container inline">
                                                                        <span class="old-price"></span>
                                                                        <span class="item-price">RM 2,459<span class="sub-price">.00</span></span>
                                                                    </div><!-- End .item-price-container -->
                  
                                                                </div><!-- End .item-meta-inner-container -->
     
                                                                <h3 class="item-name"><a href="#">LG BH9540TW 3D Blu Ray HTS 1460W</a></h3>
                                                                
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
                                            <!-- end item 5 -->
                                            <!-- item 6 start -->
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                            <div class="item-image-wrapper">
                                                                <figure class="item-image-container">
                                                                    <a href="#">
                                                                        <img src="images/category_audio_visual/SAMSUNG_UA40H5008.jpg" alt="Samsung UA40H5008 40 inch LCD LED TV FHD USB" class="item-image">
                                                                        <img src="images/category_audio_visual/SAMSUNG_UA40H5008-hover.jpg" alt="Samsung UA40H5008 40 inch LCD LED TV FHD USB" class="item-image-hover">                                                                     </a>                                                               </figure>
                                                            <!-- End .item-image-container -->
                
                                                            </div><!-- End .item-image-wrapper -->
                                                            <div class="item-meta-container">
                                                                <div class="item-meta-inner-container clearfix">
                
                                                                    <div class="item-price-container inline">
                                                                        <span class="old-price"></span>
                                                                        <span class="item-price">RM 1,299<span class="sub-price">.00</span></span>
                                                                    </div><!-- End .item-price-container -->
                  
                                                                </div><!-- End .item-meta-inner-container -->
     
                                                                <h3 class="item-name"><a href="#">Samsung UA40H5008 40" LCD</a></h3>
                                                                
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
                                            <!-- end item 6 -->
                                            <!-- item 7 start -->
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                            <div class="item-image-wrapper">
                                                                <figure class="item-image-container">
                                                                    <a href="#">
                                                                        <img src="images/category_audio_visual/SONY_MDR-EX110AP.jpg" alt="Sony MDR-EX110AP Headphones Black" class="item-image">
                                                                        <img src="images/category_audio_visual/SONY_MDR-EX110AP-hover.jpg" alt="Sony MDR-EX110AP Headphones Black" class="item-image-hover">                                                                    </a>                                                               </figure>
                                                            <!-- End .item-image-container -->
                
                                                            </div><!-- End .item-image-wrapper -->
                                                            <div class="item-meta-container">
                                                                <div class="item-meta-inner-container clearfix">
                
                                                                    <div class="item-price-container inline">
                                                                        <span class="old-price"></span>
                                                                        <span class="item-price">RM 98<span class="sub-price">.00</span></span>
                                                                    </div><!-- End .item-price-container -->
                  
                                                                </div><!-- End .item-meta-inner-container -->
     
                                                                <h3 class="item-name"><a href="#">Sony MDR-EX110AP Headphones Black</a></h3>
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
                                            <!-- end item 7 -->
                                            <!-- item 8 start -->
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="item item-hover">
                                                            <div class="item-image-wrapper">
                                                                <figure class="item-image-container">
                                                                    <a href="#">
                                                                        <img src="images/category_audio_visual/SAMSUNG_PA51H5000.jpg" alt="Samsung PA51H5000 51 Inch Plasma TV" class="item-image">
                                                                        <img src="images/category_audio_visual/SAMSUNG_PA51H5000-hover.jpg" alt="Samsung PA51H5000 51 Inch Plasma TV" class="item-image-hover">                      </a>                                                                </figure>
                                                            <!-- End .item-image-container -->
                
                                                            </div><!-- End .item-image-wrapper -->
                                                            <div class="item-meta-container">
                                                                <div class="item-meta-inner-container clearfix">
                
                                                                    <div class="item-price-container inline">
                                                                        <span class="old-price"></span>
                                                                        <span class="item-price">RM 2,580<span class="sub-price">.00</span></span>
                                                                    </div><!-- End .item-price-container -->
                  
                                                                </div><!-- End .item-meta-inner-container -->
     
                                                                <h3 class="item-name"><a href="#">Samsung PA51H5000 51 Inch Plasma TV</a></h3> 
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
                                                <!-- end item 8 -->
                                                <div class="clearfix"></div>
                                                <!-- item 9 start -->
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="item item-hover">
                                                                <div class="item-image-wrapper">
                                                                    <figure class="item-image-container">
                                                                        <a href="#">
                                                                            <img src="images/category_audio_visual/LG_NB2540.jpg" alt="LG NB2540 Sound Bar 2.1CH 120W with Subwoofer" class="item-image">
                                                                        <img src="images/category_audio_visual/LG_NB2540-hover.jpg" alt="LG NB2540 Sound Bar 2.1CH 120W with Subwoofer" class="item-image-hover">                                                                         </a>                                                                    </figure>
                                                                    <!-- End .item-image-container -->
                    
                                                                </div><!-- End .item-image-wrapper -->
                                                                <div class="item-meta-container">
                                                                    <div class="item-meta-inner-container clearfix">
                    
                                                                        <div class="item-price-container inline">
                                                                            <span class="old-price"></span>
                                                                            <span class="item-price">RM 670<span class="sub-price">.00</span></span>
                                                                        </div><!-- End .item-price-container -->
                      
                                                                    </div><!-- End .item-meta-inner-container -->
         
                                                                    <h3 class="item-name"><a href="#">LG NB2540 Sound Bar 2.1CH 120W</a></h3>
        
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
                                                <!-- end item 9 -->
                                                <!-- item 10 start -->
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="item item-hover">
                                                                <div class="item-image-wrapper">
                                                                    <figure class="item-image-container">
                                                                        <a href="#">
                                                                            <img src="images/category_audio_visual/SAMSUNG_HT-E350K.jpg" alt="Samsung HT-E350K Satellite HTS 330W" class="item-image">
                                                                            <img src="images/category_audio_visual/SAMSUNG_HT-E350K-hover.jpg" alt="Samsung HT-E350K Satellite HTS 330W" class="item-image-hover">                                                                         </a>                                                                   </figure>
                                                                <!-- End .item-image-container -->
                    
                                                                </div><!-- End .item-image-wrapper -->
                                                                <div class="item-meta-container">
                                                                    <div class="item-meta-inner-container clearfix">
                    
                                                                        <div class="item-price-container inline">
                                                                            <span class="old-price"></span>
                                                                            <span class="item-price">RM 450<span class="sub-price">.00</span></span>
                                                                        </div><!-- End .item-price-container -->
                      
                                                                    </div><!-- End .item-meta-inner-container -->
         
                                                                    <h3 class="item-name"><a href="#">Samsung HT-E350K Satellite HTS 330W</a></h3>
                                                                    
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
                                                <!-- end item 10 -->
                                                <!-- item 11 start -->
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="item item-hover">
                                                                <div class="item-image-wrapper">
                                                                    <figure class="item-image-container">
                                                                        <a href="#">
                                                                            <img src="images/category_audio_visual/LG_55LB6500.jpg" alt="LG 55LB6500 55 inch LCD LED TV FHD Smart 3HDMI Cinema 3D" class="item-image">
                                                                            <img src="images/category_audio_visual/LG_55LB6500-hover.jpg" alt="LG 55LB6500 55 inch LCD LED TV FHD Smart 3HDMI Cinema 3D" class="item-image-hover">                                                                        </a>                                                                   </figure>
                                                                <!-- End .item-image-container -->
                    
                                                                </div><!-- End .item-image-wrapper -->
                                                                <div class="item-meta-container">
                                                                    <div class="item-meta-inner-container clearfix">
                    
                                                                        <div class="item-price-container inline">
                                                                            <span class="old-price"></span>
                                                                            <span class="item-price">RM 3,790<span class="sub-price">.00</span></span>
                                                                        </div><!-- End .item-price-container -->
                      
                                                                    </div><!-- End .item-meta-inner-container -->
         
                                                                    <h3 class="item-name"><a href="#">LG 55LB6500 55 inch LCD LED TV</a></h3>
                                                                    
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
                                                <!-- end item 11 -->
                                                <!-- item 12 start -->
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="item item-hover">
                                                                <div class="item-image-wrapper">
                                                                    <figure class="item-image-container">
                                                                        <a href="#">
                                                                            <img src="images/category_audio_visual/LG_BP325.jpg" alt="LG BP325 3D Blu-ray Disc Player" class="item-image">
                                                                            <img src="images/category_audio_visual/LG_BP325-hover.jpg" alt="LG BP325 3D Blu-ray Disc Player" class="item-image-hover">                      </a>                                                                    </figure>
                                                                <!-- End .item-image-container -->
                    
                                                                </div><!-- End .item-image-wrapper -->
                                                                <div class="item-meta-container">
                                                                    <div class="item-meta-inner-container clearfix">
                    
                                                                        <div class="item-price-container inline">
                                                                            <span class="old-price"></span>
                                                                            <span class="item-price">RM 399<span class="sub-price">.00</span></span>
                                                                        </div><!-- End .item-price-container -->
                      
                                                                    </div><!-- End .item-meta-inner-container -->
         
                                                                    <h3 class="item-name"><a href="#">LG BP325 3D Blu-ray Disc Player</a></h3>
                                                                    
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
                                                    <!-- end item 12 -->
                                                <div class="clearfix"></div>
                                                <!-- item 13 start -->
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="item item-hover">
                                                                <div class="item-image-wrapper">
                                                                    <figure class="item-image-container">
                                                                        <a href="#">
                                                                            <img src="images/category_audio_visual/LG_BH9540TW.jpg" alt="LG BH9540TW 3D Blu Ray HTS 1460W Wireless Rear Spk" class="item-image">
                                                                        <img src="images/category_audio_visual/LG_BH9540TW-hover.jpg" alt="LG BH9540TW 3D Blu Ray HTS 1460W Wireless Rear Spk" class="item-image-hover">                                                                         </a>                                                                    </figure>
                                                                    <!-- End .item-image-container -->
                    
                                                                </div><!-- End .item-image-wrapper -->
                                                                <div class="item-meta-container">
                                                                    <div class="item-meta-inner-container clearfix">
                    
                                                                        <div class="item-price-container inline">
                                                                            <span class="old-price"></span>
                                                                            <span class="item-price">RM 2,459<span class="sub-price">.00</span></span>
                                                                        </div><!-- End .item-price-container -->
                      
                                                                    </div><!-- End .item-meta-inner-container -->
         
                                                                    <h3 class="item-name"><a href="#">LG BH9540TW 3D Blu Ray HTS 1460W</a></h3>
                                                                    
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
                                                <!-- end item 13 -->
                                                <!-- item 14 start -->
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="item item-hover">
                                                                <div class="item-image-wrapper">
                                                                    <figure class="item-image-container">
                                                                        <a href="#">
                                                                            <img src="images/category_audio_visual/SAMSUNG_UA40H5008.jpg" alt="Samsung UA40H5008 40 inch LCD LED TV FHD USB" class="item-image">
                                                                            <img src="images/category_audio_visual/SAMSUNG_UA40H5008-hover.jpg" alt="Samsung UA40H5008 40 inch LCD LED TV FHD USB" class="item-image-hover">                                                                         </a>                                                                   </figure>
                                                                <!-- End .item-image-container -->
                    
                                                                </div><!-- End .item-image-wrapper -->
                                                                <div class="item-meta-container">
                                                                    <div class="item-meta-inner-container clearfix">
                    
                                                                        <div class="item-price-container inline">
                                                                            <span class="old-price"></span>
                                                                            <span class="item-price">RM 1,299<span class="sub-price">.00</span></span>
                                                                        </div><!-- End .item-price-container -->
                      
                                                                    </div><!-- End .item-meta-inner-container -->
         
                                                                    <h3 class="item-name"><a href="#">Samsung UA40H5008 40" LCD</a></h3>
                                                                    
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
                                                <!-- end item 14 -->
                                                <!-- item 15 start -->
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="item item-hover">
                                                                <div class="item-image-wrapper">
                                                                    <figure class="item-image-container">
                                                                        <a href="#">
                                                                            <img src="images/category_audio_visual/SONY_MDR-EX110AP.jpg" alt="Sony MDR-EX110AP Headphones Black" class="item-image">
                                                                            <img src="images/category_audio_visual/SONY_MDR-EX110AP-hover.jpg" alt="Sony MDR-EX110AP Headphones Black" class="item-image-hover">                                                                        </a>                                                                   </figure>
                                                                <!-- End .item-image-container -->
                    
                                                                </div><!-- End .item-image-wrapper -->
                                                                <div class="item-meta-container">
                                                                    <div class="item-meta-inner-container clearfix">
                    
                                                                        <div class="item-price-container inline">
                                                                            <span class="old-price"></span>
                                                                            <span class="item-price">RM 98<span class="sub-price">.00</span></span>
                                                                        </div><!-- End .item-price-container -->
                      
                                                                    </div><!-- End .item-meta-inner-container -->
         
                                                                    <h3 class="item-name"><a href="#">Sony MDR-EX110AP Headphones Black</a></h3>
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
                                                <!-- end item 15 -->
                                                <!-- item 16 start -->
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="item item-hover">
                                                                <div class="item-image-wrapper">
                                                                    <figure class="item-image-container">
                                                                        <a href="#">
                                                                            <img src="images/category_audio_visual/SAMSUNG_PA51H5000.jpg" alt="Samsung PA51H5000 51 Inch Plasma TV" class="item-image">
                                                                            <img src="images/category_audio_visual/SAMSUNG_PA51H5000-hover.jpg" alt="Samsung PA51H5000 51 Inch Plasma TV" class="item-image-hover">                      </a>                                                                    </figure>
                                                                <!-- End .item-image-container -->
                    
                                                                </div><!-- End .item-image-wrapper -->
                                                                <div class="item-meta-container">
                                                                    <div class="item-meta-inner-container clearfix">
                    
                                                                        <div class="item-price-container inline">
                                                                            <span class="old-price"></span>
                                                                            <span class="item-price">RM 2,580<span class="sub-price">.00</span></span>
                                                                        </div><!-- End .item-price-container -->
                      
                                                                    </div><!-- End .item-meta-inner-container -->
         
                                                                    <h3 class="item-name"><a href="#">Samsung PA51H5000 51 Inch Plasma TV</a></h3> 
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
                                                    <!-- end item 16 -->
                                                    
                                                    
                                        
                                        
                                        
                                    </div>
                                    <!-- end row-->
                                </div>
                                <div class="pagination-container clearfix">
                                    <div class="pull-right">
                                        <ul class="pagination">
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#">5</a></li>
                                            <li><a href="#">...</a></li>
                                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="pull-right view-count-box hidden-xs"><span class="separator">View:</span>
                                        <div class="btn-group select-dropdown">
                                            <button type="button" class="btn select-btn">20 items</button>
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">20 items</a></li>
                                                <li><a href="#">40 items</a></li>
                                                <li><a href="#">60 items</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col-9 -->
                            
                        </div>
                    </div>
            </div>
    </div>

    
    </section>

    
   
    
    <!-- Brands STARTS
         ========================================================================= -->
       <?php /*?>  <?= $brands_scroller; ?><?php */?>
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
