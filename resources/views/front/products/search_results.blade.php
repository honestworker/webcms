@extends('front/templateFront')

@section('content')

<?php
use App\Http\Models\Front\Product;
$this->ProductModel = new Product();
?>
	<section id="content">
    	<div class="md-margin2x"></div>
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
                                        
                                        <?php
										// get active filters list
										$filters = $this->ProductModel->getFilters();
										
										$filter_ids = array();
										foreach($filters as $filterDetails){
											array_push($filter_ids,$filterDetails->id);												
										}
											
										// check brand filter
										if(in_array(1,$filter_ids))
										{
																			
											$brandsFilters = $this->ProductModel->getAllBrandFilters(Input::get());
											//echo '<pre>'; print_r($brandsFilters); echo '</pre>';
											if(count($brandsFilters) > 0)
											{
											?>
											<div class="panel">
												<div class="accordion-header">
													<div class="accordion-title"><span>Filter by Brands</span>
													</div>
													<a class="accordion-btn opened" data-toggle="collapse" data-target="#category-list-1"></a>
												</div>
												<div id="category-list-1" class="collapse in">
													<div class="panel-body">
														<ul class="category-filter-list jscrollpane">
															<?php
															
															$arr_get = Input::get();
															unset($arr_get['page']);
																							
															foreach($brandsFilters as $product_brands)
															{
																$arr_get['brand'] = $product_brands->brand_id;														
																$query_string = http_build_query($arr_get);
																
																echo '<li><a href="?'.$query_string.'">'.$product_brands->brand_name.' ('.$product_brands->total_products.')</a></li>';	
															}
															?>
														</ul>
													</div>
												</div>
											</div>
											<?php
												} // end if(count($brandsFilters) > 0)
                                        
										} // end check
										
										// check price filter
										if(in_array(3,$filter_ids))
										{
                                        ?>
                                        <div class="panel">
                                            <div class="accordion-header">
                                                <div class="accordion-title"><span>Filter by Price</span>
                                                </div>
                                                <a class="accordion-btn opened" data-toggle="collapse" data-target="#category-list-2"></a>
                                            </div>
                                            <div id="category-list-2" class="collapse in">
                                                <div class="panel-body">
                                                  <script>
                                                    /*$(document).ready(function(){
                                                        $('#price-range .noUi-connect').css('left','5%');
                                                        $('#price-range .noUi-background').css('left','25%');
                                                    });*/
                                                    </script>
                                                    <div id="price-range"></div>													  
                                                    
                                                    <form action="" method="get">
                                                    <div id="price-range-details"><span class="sm-separator">From</span> 
                                                        <input type="text" id="price-range-low" name="price_from" class="separator" value="<?php echo (Input::get('price_from')) ? Input::get('price_from') : 0; ?>"> <span class="sm-separator">to</span> 
                                                        <input type="text" id="price-range-high" name="price_to" value="<?php echo (Input::get('price_to')) ? Input::get('price_to') : 99999; ?>">
                                                        
                                                        <?php
                                                            
                                                            $arr_get = Input::get();
                                                            unset($arr_get['page']);
                                                        
                                                            if(array_key_exists('price_from',$arr_get))
                                                                unset($arr_get['price_from']);
                                                            
                                                            if(array_key_exists('price_to',$arr_get))
                                                                unset($arr_get['price_to']);
                                                            
                                                            foreach ($arr_get as $key => $value) {
                                                                echo("<input type='hidden' name='$key' value='$value'/>");
                                                            }
                                                        ?>
                                                        
                                                    </div>
                                                    <div id="price-range-btns">
                                                        <input type="submit" class="btn btn-custom-2 btn-sm" value="OK">
                                                        <input type="reset"  class="btn btn-custom-2 btn-sm" value="Clear">
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end price filter -->
                                        
                                        <?php
										} // end price filter
											
                                        // check color filter
										if(in_array(2,$filter_ids))
										{
                                        // color filter
                                                                                    
											$colorsFilters = $this->ProductModel->getAllColorFilters();
											if(count($colorsFilters) > 0)
											{
                                        ?>
                                        
                                            <div class="panel">
                                                <div class="accordion-header">
                                                    <div class="accordion-title"><span>Filter by Color</span>
                                                    </div>
                                                    <a class="accordion-btn opened" data-toggle="collapse" data-target="#category-list-3"></a>
                                                </div>
                                                <div id="category-list-3" class="collapse in">
                                                    <div class="panel-body">
                                                        <ul class="filter-color-list clearfix">
                                                            <?php
                                                            
                                                            $arr_get = Input::get();
                                                            unset($arr_get['page']);
                                                            
                                                            $i = 1;
                                                            foreach($colorsFilters as $product_colors)
                                                            {
                                                                $arr_get['color'] = $product_colors->color_id;														
                                                                $query_string = http_build_query($arr_get);
                                                                
                                                                $last_class = ($i%5 == 0) ? 'class="last-lg"' : '';
                                                                echo '<li '.$last_class.'><a href="?'.$query_string.'" data-bgcolor="'.$product_colors->hex_code.'" class="filter-color-box"></a></li>';
                                                                $i++;
                                                            }
                                                            ?>                                                        
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- end color filter -->
                                         <?php
                                            } // end if(count($colorsFilters) > 0)
                                         } // end color filter
                                        ?>
                                    </div>
                                </div>
									
                            <?= $most_buy; ?>
                            <?= $latest_promo; ?>
                            <?= $banner_left_slider; ?>
                    	</aside>
                        
                        <div class="col-md-9 col-sm-8 col-xs-12 main-content">
                                                    
                               @if(session()->has('data'))
                                    <div class="alert alert-success alert-dismissable">
                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                    <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                                    <p>{{  session('data.success') }}</p>
                                  </div>
                                @endif
                                
                                @if(Input::get('keyword'))
                                	<p>You have searched keyword(s): <b>{{ Input::get('keyword') }}</b></p><hr />
                                 @endif
                                <div class="md-margin"></div>
                                <?php
									if(count($products)>0){	
									?>
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
                                                
                                                <?php
													$arr_get = Input::get();
												 	unset($arr_get['page']);
													$query_string = http_build_query($arr_get);
												?>
                                                
                                                    <li><a href="<?= url('search/priceAsc?'.$query_string); ?>">Price : Low - High</a></li>
                                                    <li><a href="<?= url('search/priceDesc?'.$query_string); ?>">Price : High - Low</a></li>
                                                    <li><a href="<?= url('search/a-z?'.$query_string); ?>">Product Name : A - Z</a></li>
                                                    <li><a href="<?= url('search/z-a?'.$query_string); ?>">Product Name : Z - A</a></li>
                                                    <li><a href="<?= url('search/date?'.$query_string); ?>">Date</a></li>
                                                    <li><a href="<?= url('search/brand?'.$query_string); ?>">Brand</a></li>
                                                    <li><a href="<?= url('search/new?'.$query_string); ?>">New Arrivals</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="view-box">
                                            <a href="{{ url('/viewType/image') }}" class="<?php if((Session::has('view_type') && Session('view_type') == 'image_view') || !Session::has('view_type')){ echo 'active '; } ?> icon-button icon-grid" title="Image View"><i class="fa fa-th-large"></i></a>  
                                            <a href="{{ url('/viewType/list') }}" class="<?php if(Session::has('view_type') && Session('view_type') == 'list_view'){ echo 'active '; } ?>icon-button icon-list" title="List View"><i class="fa fa-th-list"></i></a>
                                        </div>
                                    </div>
                                    
                                    <div class="toolbox-pagination clearfix">
                                    	
                                        <div class="pull-right">
                                            
                                            <?php
												$per_page = (Session::has('product.per_page')) ? Session::get('product.per_page') : 20;
												$current_page = (Input::get('page')) ? Input::get('page') : 1;
												//echo 'total_records = '.$total_records.'<br>per_page = '.$per_page.'<br>current_page = '.$current_page.'<br>';
												
												if($total_records > $per_page)
												{
													$total_page = ($total_records % $per_page == 0) ? ($total_records / $per_page) : ($total_records / $per_page)+1;
													
													echo '<ul class="pagination">';
													for($i=1; $i<= $total_page; $i++ )
													{
														
														$arr_get = Input::get();
														$arr_get['page'] = $i;
														$query_string = http_build_query($arr_get);
														
														$pagination_url = url(Request::path().'?'.$query_string);
														
														$class = ($i == $current_page) ? 'class="active"' : '';
														echo '<li '.$class.'><a href="'.$pagination_url.'">'.$i.'</a></li>';
													}
													echo '</ul>';
													
												}
											?>                                             
                                        
                                    </div>
                                        
                                        <div class="view-count-box"><span class="separator">View:</span>
                                            <div class="btn-group select-dropdown">
                                             <?php										
												 $arr_get = Input::get();
												 unset($arr_get['page']);
												 $query_string = http_build_query($arr_get);
											  ?>
                                            <script>
												function set_per_page(per_page,session_key,redirect_to,query_string)
												{	
													redirect_to = redirect_to.replace(/(\/)/g,'~');
													//alert(redirect_to); return false;
													qs = (query_string != '') ? '/'+query_string : '/no_qs';
													window.location.href = '<?php echo url('/products/setPerPage') ?>/'+per_page+'/'+session_key+'/'+redirect_to+qs;	
												}
											</script>
											
                                                <button type="button" class="btn select-btn">
                                                	<?php 
                                                        if(Session::has('product.per_page')){
                                                            echo Session('product.per_page').' items';
                                                        }else{
                                                            echo '20 items';
                                                        }
                                                    ?>
                                                </button>
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="javascript:void(0)" onclick="set_per_page(20,'product','{{ Request::path() }}','{{ $query_string }}')">20 items</a></li>
                                                    <li><a href="javascript:void(0)" onclick="set_per_page(40,'product','{{ Request::path() }}','{{ $query_string }}')">40 items</a></li>
                                                    <li><a href="javascript:void(0)" onclick="set_per_page(60,'product','{{ Request::path() }}','{{ $query_string }}')">60 items</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                      
                                    </div>
                                    
                                </div>
                                 <?php
									} // end count
									?>
                                <div class="xs-margin"></div>
                                <div class="category-item-container">
                                    <div class="row">
                                    	<?php 
											if(isset($products) and count($products)>0){ 
												$row_count = 1;
												foreach($products as $product){
													
												$url_product = url('product/'.$product->id);												
												
												
												$product_list_price = $product->list_price;
												$old_whole_price = floor($product_list_price);
												$old_sub_price = $product_list_price - $old_whole_price;												
												$old_sub_price = str_replace('0.','',number_format($old_sub_price,2));
												
												$product_sale_price = $product->sale_price;
												$whole_price = floor($product_sale_price);
												$sub_price = $product_sale_price - $whole_price;												
												$sub_price = str_replace('0.','',number_format($sub_price,2));
												
												//echo '<br>'.$whole_price.'----'.$sub_price;
												
																							
										?>
                                        <!-- item 1 start -->
                                        <?php if(Session::has('view_type') && Session('view_type') == 'list_view')
										{
										?>
                                        	<div class="item item-list clearfix">
                                           <div class="item-image-wrapper">
                                              <figure class="item-image-container">
                                                   <a href="{{ $url_product }}">
                                                                   @if($product->thumbnail_image_1 != '')
                                                                        <img src="{{ asset('/public/admin/products/medium/'.$product->thumbnail_image_1) }}" alt="{{ $product->product_name }}" class="item-image" />
                                                                    @endif
                                                                    
                                                                    @if($product->thumbnail_image_1 == '')
                                                                        <img src="{{ asset('/public/admin/products/medium/' . $product->large_image) }}" alt="{{ $product->product_name }}" class="item-image" >
                                                                    @endif
                                                                    
                                                                    @if($product->thumbnail_image_2 != '')
                                                                        <img src="{{ asset('/public/admin/products/medium/'.$product->thumbnail_image_2) }}" alt="{{ $product->product_name }}" class="item-image-hover" />
                                                                    @endif
                                                                    
                                                                    @if($product->thumbnail_image_2 == '')
                                                                        <img src="{{ asset('/public/admin/products/medium/' . $product->large_image) }}" alt="{{ $product->product_name }}" class="item-image-hover" >
                                                                    @endif
                                                                </a>
                                               	   <?php if(preg_match('/new/',$product->promo_behaviour)){ echo '<span class="new-circle top-left">New</span>'; } ?>
                                                   <?php if(preg_match('/hot/',$product->promo_behaviour)){ echo '<span class="new-circle top-left">Hot</span>'; } ?>
                                                   <?php if(preg_match('/sale/',$product->promo_behaviour)){ echo '<span class="new-circle top-left">Sale</span>'; } ?>
                                                   <?php if(preg_match('/pwp/',$product->promo_behaviour)){ echo '<span class="new-circle top-left">pwp</span>'; } ?>
                               		           		<!--<span class="discount-circle top-right">-50%</span>-->                                              
                                              </figure>
                                              <!-- End .item-image-container -->     					
                                           </div><!-- End .item-image-wrapper -->
                                           
                                           <div class="item-meta-container">
            							   		 <h3 class="item-name"><a href="{{ $url_product }}">{{ $product->product_name }}</a></h3>
                                                 <div class="item-price-container inline">                                                     
                                                     <span class="old-price"><?php if($product->list_price) echo 'RM '.number_format($product->list_price,2);?></span>
                                                     <span class="item-price">RM <?php echo number_format($product->sale_price,2);?></span>                                                </div>
                                     <!-- End .item-price-container -->
              									 <p><?php echo (strlen(strip_tags($product->description)) > 200) ? substr(strip_tags($product->description),0,195).'...' : strip_tags($product->description); ?></p>
                                                <div class="item-action">
                                                	<a href="{{ $url_product }}" class="item-add-btn"><span class="cart-icon-text">Add to Cart</span></a>
                                                	<div class="item-action-inner">
                                                    
                                                    <?php 
													// check if user is logged in
													if(Session::has('userId'))
														echo '<a href="#" class="icon-button icon-like add-tooltip" data-toggle="modal" data-target="#wishlist_model" data-placement="top" title="Add to wishlist" onclick="$(\'#wishlist_model #wishlist_product_id\').val('.$product->id.'); $(\'#wishlist_model img\').attr(\'src\',\''.asset('/public/admin/products/large/'.$product->large_image).'\'); $(\'#wishlist_model #list_name\').val(\'\'); load_product_attr('.$product->id.');">Favourite</a>';
													else
														echo '<a href="#" class="icon-button icon-like add-tooltip" data-toggle="modal" data-target="#login_model" data-placement="top" title="Add to wishlist">Favourite</a>';
                                                    ?>
                                                    
                                                    	<!--<a href="#" class="icon-button icon-like add-tooltip" data-toggle="tooltip" data-placement="top" title="Add to wishlist">Favourite</a>-->
                                                        <a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})" class="icon-button icon-compare add-tooltip" data-toggle="tooltip" data-placement="top" title="Add to compare">Compare</a>
                                                	</div>
                                            	</div>
                  
                                           </div><!-- End .item-meta-container --> 
                                        </div>
                                        <?php
											if($row_count < count($products)){ echo '<hr />'; }
										}
										else
										{
										?>
                                        	<div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="item item-hover">
                                                        <div class="item-image-wrapper">
                                                            <figure class="item-image-container">
                                                                <a href="{{ $url_product }}">
                                                                    @if($product->thumbnail_image_1 != '')
                                                                        <img src="{{ asset('/public/admin/products/medium/'.$product->thumbnail_image_1) }}" alt="{{ $product->product_name }}" class="item-image" />
                                                                    @endif
                                                                    
                                                                    @if($product->thumbnail_image_1 == '')
                                                                        <img src="{{ asset('/public/admin/products/medium/' . $product->large_image) }}" alt="{{ $product->product_name }}" class="item-image" >
                                                                    @endif
                                                                    
                                                                    @if($product->thumbnail_image_2 != '')
                                                                        <img src="{{ asset('/public/admin/products/medium/'.$product->thumbnail_image_2) }}" alt="{{ $product->product_name }}" class="item-image-hover" />
                                                                    @endif
                                                                    
                                                                    @if($product->thumbnail_image_2 == '')
                                                                        <img src="{{ asset('/public/admin/products/medium/' . $product->large_image) }}" alt="{{ $product->product_name }}" class="item-image-hover" >
                                                                    @endif
                                                                </a>
                                                                
                                                                <?php if(preg_match('/new/',$product->promo_behaviour)){ echo '<span class="new-circle top-left">New</span>'; } ?>
															   <?php if(preg_match('/hot/',$product->promo_behaviour)){ echo '<span class="new-circle top-left">Hot</span>'; } ?>
                                                               <?php if(preg_match('/sale/',$product->promo_behaviour)){ echo '<span class="new-circle top-left">Sale</span>'; } ?>
                                                               <?php if(preg_match('/pwp/',$product->promo_behaviour)){ echo '<span class="new-circle top-left">pwp</span>'; } ?>
                                                                
                                                            </figure>
                                                            <!-- End .item-image-container -->
                                                        </div><!-- End .item-image-wrapper -->
                                                        <div class="item-meta-container" style="position: relative;">
                                                            <div class="item-meta-inner-container clearfix">
            
                                                                <div class="item-price-container inline">
                                                                    <span class="old-price"><?php if($product->list_price) echo 'RM '.number_format($product->list_price,2);?></span>
                                                                    <span class="item-price">RM <?php echo number_format($product->sale_price,2); ?></span>
                                                                </div><!-- End .item-price-container -->
              
                                                            </div><!-- End .item-meta-inner-container -->
 
                                                            <h3 class="item-name"><a href="{{ $url_product }}"><?php echo strlen($product->product_name) > 25 ? substr($product->product_name,0,20).'...' : $product->product_name;?></a></h3>

                                                            <div class="item-action">
                                                                <a href="{{ $url_product }}" class="item-add-btn">
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
                                                                </div><!-- End .item-action-inner -->
                                                            </div><!-- End .item-action -->
                                                        </div><!-- End .item-meta-container --> 
                                                    </div>
                                        </div>
                                       <?php
										}
										?>
                                        
                                        <!-- end item 1 -->
                                        
                                        <!-- item 1 start -->
                                        
                                        <!-- end item 1 -->
                                        
                                        <?php 
											$row_count++;
											} // end foreach
											
										}else{?>
                                        	<h3>No Product Found.</h3>
                                        <?php } ?>
                                        
                                            <div class="clearfix"></div>
                                            
                                                    
                                                    
                                        
                                        
                                        
                                    </div>
                                    <!-- end row-->
                                </div>
                                 <?php
									if(count($products)>0){	
									?>
                                <div class="pagination-container clearfix">
                                    <div class="pull-right">
                                            
                                            <?php
												$per_page = (Session::has('product.per_page')) ? Session::get('product.per_page') : 20;
												$current_page = (Input::get('page')) ? Input::get('page') : 1;
												//echo 'total_records = '.$total_records.'<br>per_page = '.$per_page.'<br>current_page = '.$current_page.'<br>';
												
												if($total_records > $per_page)
												{
													$total_page = ($total_records % $per_page == 0) ? ($total_records / $per_page) : ($total_records / $per_page)+1;
													
													echo '<ul class="pagination">';
													for($i=1; $i<= $total_page; $i++ )
													{
														
														$arr_get = Input::get();
														$arr_get['page'] = $i;
														$query_string = http_build_query($arr_get);
														
														$pagination_url = url(Request::path().'?'.$query_string);
														
														$class = ($i == $current_page) ? 'class="active"' : '';
														echo '<li '.$class.'><a href="'.$pagination_url.'">'.$i.'</a></li>';
													}
													echo '</ul>';
													
												}
											?>                                             
                                        
                                    </div>
                                    <div class="pull-right view-count-box hidden-xs"><span class="separator">View:</span>
                                        <div class="btn-group select-dropdown">
                                            <button type="button" class="btn select-btn">
                                            	<?php 
												 if(Session::has('product.per_page')){
														echo Session('product.per_page').' items';
													}else{
														echo '20 items';
													}
                                                ?>
                                            </button>
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                            	 <li><a href="javascript:void(0)" onclick="set_per_page(20,'product','{{ Request::path() }}','{{ $query_string }}')">20 items</a></li>
                                                <li><a href="javascript:void(0)" onclick="set_per_page(40,'product','{{ Request::path() }}','{{ $query_string }}')">40 items</a></li>
                                                <li><a href="javascript:void(0)" onclick="set_per_page(60,'product','{{ Request::path() }}','{{ $query_string }}')">60 items</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php
								} // end count
								?>
                            </div>
                	</div>
                </div>
            </div>
    	</div>
    </section>
    
<?php
	// Brands & Services are done in the templateFront.blade.php
	if(isset($brands_scroller)) unset($brands_scroller);
?>

<script src="{{ asset('/public/front/js/jquery.nouislider.min.js') }}"></script>      
@endsection

