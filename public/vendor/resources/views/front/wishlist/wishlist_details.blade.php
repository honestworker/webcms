@extends('front/templateFront')

@section('content')
<?php
$wishlist_token = $wishlist_details->token;
?>             
        <section id="content">
        	<div id="page-header">
                <h1>Welcome Members!</h1>
                <div class="sm-margin"></div>
                <h2>The TBM Shopping Experience</h2>
                <p class="line">&nbsp;</p>

            </div>
            <div class="md-margin2x"></div>
            <div class="container">
                <div class="row">
                	<div class="col-md-12">
						<div class="hero-unit">
                            <h2>My Wishlist</h2>
                            <span class="small-bottom-border big"></span>
                            <p>View & share your wishlists to your family and friends!</p>
                        </div>
                        <div class="md-margin2x"></div>
                        
                        <div class="row">
                            
                             @if(session()->has('data.success'))                             	
                                <div class="alert alert-success alert-dismissable">
                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                                <p>{{  session('data.success') }}</p>
                              </div>
                            @endif
                            
                            <div id="ajax_response"></div>                        
                            <h2 class="checkout-title">{{ $wishlist_details->list_name }} ({{ $wishlist_details->quantity }})</h2>
                       		<div class="btn-group">
                                    <button type="button" class="btn btn-custom-2 dropdown-toggle" data-toggle="dropdown">Manage List &nbsp;<span class="caret"></span></button>

                                    <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" data-toggle="modal" data-target="#rename-list">Rename list</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#" data-toggle="modal" data-target="#delete-list" onclick="$('#delete_wishlist_id').val({{ $wishlist_details->id }})">Delete this list</a></li>
                                    </ul>
                                </div>
                                
                                <!--  Rename list modal start -->
                                <div class="modal fade" id="rename-list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                                          <form id="login-form-2" method="post" action="{{ url('/renameWishlist') }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                        <h4 class="modal-title" id="myModalLabel2">Rename List</h4>
                                                        </div><!-- End .modal-header -->
                                                        <div class="modal-body clearfix">
            
                                                            <div class="form-group">
                                                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-list-alt"></i> <span class="input-text">Name &#42;</span></span>
                                                                   <input type="text" name="list_name" class="form-control input-lg" value="{{ $wishlist_details->list_name }}" required="required">
                                                               </div>
                                                            </div>
                                                            <div class="input-group custom-checkbox">
                                                                <input type="checkbox" <?php if($wishlist_details->is_default == '1'){ echo 'checked="checked"'; } ?>> <span class="checbox-container"><i class="fa fa-check"></i></span> This is your default wishlist.
                                                            </div>
                        												
            
                                                        </div><!-- End .modal-body -->
                                                        <div class="modal-footer">
                                                        	<input type="hidden" name="wishlist_id" value="{{ $wishlist_details->id }}">
                                							<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <button type="submit" class="btn btn-custom-2">SAVE</button>
                                                            <button type="button" class="btn btn-custom" data-dismiss="modal">CLOSE</button>
                                                        </div><!-- End .modal-footer -->
                                                    </div><!-- End .modal-content -->
                                                </div><!-- End .modal-dialog -->
                                                </form>
                                            </div>
                                 <!-- End .modal rename list -->                                            
                        
                         
                         <div class="xs-margin"></div>
                       	 <?php if($wishlist_details->is_default == '1'){ echo '<p>This is your default wishlist.</p>'; } ?>
                        <div class="md-margin"></div>
                        
                        <?php 
						if(count($wishlist_items) > 0)
						{
						?>
                        <div class="table-responsive">
                        <form id="form_wishlist_items">
                            <table class="table cart-table">
                                <thead>
                                    <tr>
                                        <th class="table-title">Product Name</th>
                                        <th class="table-title">Product Code</th>
                                        <th class="table-title">Unit Price</th>
                                        <th class="table-title">Quantity</th>
                                        <th class="table-title"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
									foreach($wishlist_items as $item)
									{
										
										//dd($wishlist_items)
										
										$whole_price = floor(number_format($item->sale_price, 2));												
										$sub_price = str_replace('0.','',number_format($item->sale_price, 2) - $whole_price);										
										$sub_price = substr(number_format($sub_price,1,'',''),0,2);
										
								?>
                                    <tr>
                                        <td class="item-name-col">
                                            <figure><a href="{{ url('/product/'. $item->id) }}"><img src="{{ asset('/public/admin/products/large/'. $item->large_image) }}" alt="{{ $item->product_name }}" class="img-responsive"></a></figure>
                                            <header class="item-name">
                                                <a href="{{ url('/product/'. $item->id) }}">{{ $item->product_name }}</a>                                               
                                            </header>
                                            <ul>
                                              @if($item->color_title)<li>Color: {{ $item->color_title }}</li> @endif
                                              <li><span>Availability:</span> <span class="text-success">{{ ($item->is_available == '1') ? 'In Stock' : 'Out of Stock' }}</span></li>
                                              <li>
                                                <div class="col-md-9 col-sm-9 col-xs-12 pull-right">
                                                <div class="form-group">
                                                    <div class="normal-selectbox clearfix">                                                    	
                                                        <select name="priority[{{ $item->wishlist_item_id }}]" class="selectbox">
                                                            <option value="High priority" <?php if($item->priority == 'High priority'){ echo 'selected="selected"'; } ?>>High priority</option>
                                                            <option value="Medium priority" <?php if($item->priority == 'Medium priority'){ echo 'selected="selected"'; } ?>>Medium priority</option>
                                                            <option value="Low" <?php if($item->priority == 'Low'){ echo 'selected="selected"'; } ?>>Low priority</option>
                                                        </select>
                                                    </div>
                                                 </div>
                                                 </div>
                                              </li>
                                            </ul>                                          
                                        </td>
                                        <td class="item-code">{{ $item->product_code }}</td>
                                        <td class="item-price-col"><span class="item-price-special">RM {{ number_format($item->sale_price,2) }}</span></td>
                                        <td>
                                            <div class="custom-quantity-input">
                                                <input type="text" name="quantity" class="quantity_<?php echo $item->wishlist_item_id; ?>" value="1"> <a href="javascript:void(0)" onClick="increaseQuantity(<?php echo $item->wishlist_item_id; ?>)" class="quantity-btn quantity-input-up"><i class="fa fa-angle-up"></i></a>  <a href="javascript:void(0)" onClick="decreaseQuantity(<?php echo $item->wishlist_item_id; ?>)" class="quantity-btn quantity-input-down"><i class="fa fa-angle-down"></i></a>               
                                            </div>                                            
                                        </td>
                                        <td><a href="javascript:void(0)" onclick="add_to_cart(<?php echo $item->id; ?>,<?php echo $item->wishlist_item_id; ?>,<?php echo ($item->color_id) ? $item->color_id : 0; ?>)" class="btn-sm btn-custom-2 add_to_cart_link">ADD TO CART &nbsp;<i class="fa fa-shopping-cart"></i></a>
                                        <a href="#" class="btn-sm btn-custom add-tooltip" data-toggle="modal" data-target="#move" title="Move item" onclick="$('#move #wishlist_item_id').val({{ $item->wishlist_item_id }}); $('#move #wishlist_product_id').val({{ $item->id }}); $('#move img').attr('src','{{ asset('/public/admin/products/large/'.$item->large_image) }}'); $('#move #list_name').val('');"><i class="fa fa-arrow-up"></i></a>
                                        <a href="#" class="close-button add-tooltip" data-toggle="modal" data-target="#delete-list-item" data-placement="top" title="Remove item" onclick="$('#delete_wishlist_item_id').val({{ $item->wishlist_item_id }})"></a>
                                        
                                        <input class="cart_data" type="hidden" name="cart[<?php echo $item->wishlist_item_id; ?>][product_id]" value="<?php echo $item->id; ?>" />
                                        <input class="cart_data" type="hidden" name="cart[<?php echo $item->wishlist_item_id; ?>][color_id]" value="<?php echo $item->color_id; ?>" />
                                        <input class="cart_data" type="hidden" name="cart[<?php echo $item->wishlist_item_id; ?>][quantity]" value="1" class="quantity_<?php echo $item->wishlist_item_id; ?>" />
                                        
                                        </td>
                                    </tr>
                                <?php
									} // end foreach
									?>
                                </tbody>
                            </table>
                            
                           </form> 
                           
                        </div>
                        <?php
						} // end if(count($wishlist_items) > 0)
						?>
                        <!-- end table responsive -->
                                
                        <!--  move modal start -->
                        <div class="modal fade" id="move" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                                  <form id="login-form-2" method="post"  action="{{ url('/moveToWishlist') }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title" id="myModalLabel2">Select List to Move to:</h4>
                                                </div><!-- End .modal-header -->
                                                <div class="modal-body clearfix">
    
                                                    <div class="col-md-2">
                                                        <img src="images/digital_gadget/digital_imaging/panasonic_DMC-GX1WGC_big2.jpg" alt="Panasonic DMC-GX1WGC Camera Twin Lense (14MM F2.5 &amp; 14-42MM F3.5-5.6)" class="img-responsive"></a>
                                                    </div>
                                                    <div class="col-md-10">
                                                        
                                                        <?php
															//$user_id = Session::get('userId');
															//$list_wishlist = $this->WishlistModel->getWishlist($user_id);
															
															if(count($list_wishlist) > 0)
															{
															?>                                
																<p>Please select the following list to move this item to: </p>
																
																<?php
																foreach($list_wishlist as $wishlist_details)
																{
																?>
																
																<div class="custom-checkbox">
																	<input type="checkbox" class="wishlist_id" name="wishlist_id[]" required="required" value="{{ $wishlist_details->id }}" > <span class="checbox-container"><i class="fa fa-check"></i></span> {{ $wishlist_details->list_name }}
																</div>
																<?php
																} // end foreach
																?>
																<div class="sm-margin"></div>
																<p>Or add a new list to move this item to: </p>
															<?php
																$required = '';
															}
															else
															{
																echo '<p>Add a new list to add this item to: </p>';
																$required = 'required="required"';
															}
															
															?>
                                                        
                                                       
                                                       
                                                        <div class="form-group">
                                                       <div class="input-group"><span class="input-group-addon"><i class="fa fa-list-alt"></i> <span class="input-text">Name</span></span>
                                                           <input type="text" name="list_name" id="list_name" class="form-control input-lg" placeholder="Create a list..." <?php echo $required; ?>>
                                                       </div>
                                                    </div>
                                                    </div>			
    
                                                </div><!-- End .modal-body -->
                                                <div class="modal-footer">
                                                	<input type="hidden" name="wishlist_item_id" id="wishlist_item_id">
                                                    <input type="hidden" name="product_id" id="wishlist_product_id">
                               						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class="btn btn-custom-2" onClick="validate_wishlist_item()">SAVE</button>
                                                    <button type="button" class="btn btn-custom" data-dismiss="modal">CANCEL</button>
                                                </div><!-- End .modal-footer -->
                                            </div><!-- End .modal-content -->
                                        </div><!-- End .modal-dialog -->
                                        </form>
                                    </div>
                                    
						<script>
                            function validate_wishlist_item()
                            {
                                if($('#move #list_name').val() != '')
                                { 
                                    $('#move .wishlist_id').attr('required',false);
                                }
                                else
                                {
                                    if($('#move .wishlist_id').is(':checked'))
                                        $('#move .wishlist_id').attr('required',false);
                                    
                                }
                                
                            }
                            
                            function save_wishlist()
                            {
                                
								$.ajax({
										url: '<?php echo url('/updateWishlistItemsPriority') ?>',
											type:'post',
											dataType:'json',
											data: '_token=<?php echo csrf_token(); ?>&'+$('#form_wishlist_items').serialize(),
											success: function(response) {			
												
												if(response['success'])
												{
													var success = '<div class="alert alert-success alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>Changes saved successfully.</p></div>';
													$('#ajax_response').html(success);
												}																
												
											}	
									});
                            }
							
							
							function add_to_cart(product_id,wishlist_item_id,color_id)
							{
								quantity = $('.quantity_'+wishlist_item_id).val();
								
								if(isNaN(quantity) || quantity <= 0)
								{
									alert('Quantity should be atleast one.');
									return false;
								}
								//alert(product_id+ '~~~ '+quantity+'~~~'+color_id);
								
								$.ajax({
										url: '<?php echo url('/cart/addToCart') ?>',
											type:'post',
											dataType:'json',
											data: '_token=<?php echo csrf_token(); ?>&product_id='+product_id+'&quantity='+quantity+'&color_id='+color_id,
											success: function(response) {			
												
												if(response['success'])
												{
													var success = '<div class="alert alert-success alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>Added to cart.</p></div>';
													$('#ajax_response').html(success);
												}
												
												$('.dropdown-cart-menu-container').load('{{ url("cart/cartHtml") }} .dropdown-cart-menu-container > *');																
												
											}	
									});
								
							}
                        	
							function increaseQuantity(wishlist_item_id)
							{
								elm = $('.quantity_'+wishlist_item_id);
								if(isNaN(elm.val()) || elm.val() == '')
								{
									elm.val(0);
								}
								
								elm.val(Number(elm.val()) + 1 );
							}
							
							function decreaseQuantity(wishlist_item_id)
							{
								elm = $('.quantity_'+wishlist_item_id);
								
								if(isNaN(elm.val()) || elm.val() == '')
								{
									elm.val(0);
								}
								
								if(elm.val() > 0)
								{
									elm.val(Number(elm.val()) - 1 );
								}	
							}
							
							function add_all_to_cart()
							{
								/*$('.add_to_cart_link').each(function(){
									alert($(this).attr('onclick'));	
								});*/	
								
								$.ajax({
										url: '<?php echo url('/cart/addAllToCart') ?>',
											type:'post',
											dataType:'json',
											data: $('.cart_data'),
											success: function(response) {			
												
												if(response['success'])
												{
													var success = '<div class="alert alert-success alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>Added to cart.</p></div>';
													$('#ajax_response').html(success);
												}
												
												$('.dropdown-cart-menu-container').load('{{ url("cart/cartHtml") }} .dropdown-cart-menu-container > *');																
											}	
									});
								
							}
							
                        </script>
                                    
                        <!-- End .modal move -->
  
  						<div class="md-margin"></div>
                        
                        <a href="#" class="btn btn-custom" data-toggle="modal" data-target="#share-list">SHARE WISHLIST &nbsp;<i class="fa fa-users"></i></a>
                        <a href="javascript:void(0)" class="btn btn-custom" onclick="save_wishlist()">SAVE WISHLIST &nbsp;<i class="fa fa-floppy-o"></i></a>
                        <a href="javascript:void(0)" class="btn btn-custom-2" onclick="add_all_to_cart()">ADD ALL TO CART &nbsp;<i class="fa fa-shopping-cart"></i></a>
                        <input class="cart_data"  type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                        <div class="md-margin"></div>
                        <a href="{{ url('wishlist') }}" class="btn btn-custom"><i class="fa fa-angle-double-left"></i> BACK</a>
                        
                        
                        <!-- Share this list modal start -->
                        <div class="modal fade" id="share-list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                            <form id="form_share_wishlist" method="post" action="{{ url('/wishlist/share') }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel2">Share this List</h4>
                                    </div><!-- End .modal-header -->
                                    <div class="modal-body clearfix">

                                        <p>Copy your link and send it to your friends and family: </p>
                                        <p class="text-red" style="font-weight:bold" id="share_link">{{ url('/wishlist/view?token='.$wishlist_token) }}</p>
                                        <div class="xs-margin"></div>
                                        <a href="javascript:void(0)"><button type="button" class="btn btn-sm btn-custom" id="copyToClipboard">COPY TO THE CLIPBOARD</button></a>
                                        <span class="copied_msg"></span>
                                        <div class="md-margin"></div>                                      
                                        <hr>
                                        <div class="sm-margin"></div>  
                                        
                                        <div class="form-group">
                                           <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i> <span class="input-text">Email 1 &#42;</span></span>
                                                <input type="email" name="share_to_email[]" required class="form-control input-lg">
                                           </div>
                                         </div>
                                         
                                          <?php
											 for($i = 2; $i<=10; $i++)
											 {
											 ?>
											 <div class="form-group">
											   <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i> <span class="input-text">Email {{ $i }}</span></span>
													<input type="email" name="share_to_email[]" class="form-control input-lg">
											   </div>
											 </div>                                                             
											<?php
											}
											?>
                                                    

                                    </div><!-- End .modal-body -->
                                    <div class="modal-footer">
                                    	<input type="hidden" name="share_link_url" id="share_link_url" value="{{ url('/wishlist/view?token='.$wishlist_token) }}">
                                		<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-custom-2">SEND</button>
                                        <button type="button" class="btn btn-custom" data-dismiss="modal">CLOSE</button>
                                    </div><!-- End .modal-footer -->
                                </div><!-- End .modal-content -->
                            </div><!-- End .modal-dialog -->
                            </form>
                        </div>
                        <!-- End .modal share this list -->
                        
                        <!--  delete list item modal start -->
                        <div class="modal fade" id="delete-list-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                          <form id="login-form-2" method="post" action="{{ url('/deleteWishlistItem') }}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title" id="myModalLabel2">Delete Product from Wishlist</h4>
                                        </div><!-- End .modal-header -->
                                        <div class="modal-body clearfix">
                    
                                            <p>Delete product cannot be recovered. Are you sure you want to delete this product?</p>
                    
                                        </div><!-- End .modal-body -->
                                        <div class="modal-footer">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="delete_wishlist_id" id="delete_wishlist_item_id"  value="">
                                            <button type="submit" class="btn btn-custom-2">DELETE</button>
                                            <button type="button" class="btn btn-custom" data-dismiss="modal">CANCEL</button>
                                        </div><!-- End .modal-footer -->
                                    </div><!-- End .modal-content -->
                                </div><!-- End .modal-dialog -->
                                </form>
                            </div><!-- End .modal delete list item --> 
                            
                            
                        </div>
                        <!-- end row -->    
  
                        
                       
                    </div>
                    <!-- end col-md-12 -->
                    
            	</div>
                <!-- end row -->
                
    		</div>
            <!-- end container -->
            
            
    
    </section>
    
<?php
	// Brands & Services are done in the templateFront.blade.php
	if(isset($brands_scroller)) unset($brands_scroller);
?>
		
<!-- copy to clipboard -->
<script src="{{ asset('/public/front/js/zclip/jquery.zeroclipboard.js') }}"></script>		
<script>
jQuery(document).ready(function($) {
			
	$("#copyToClipboard")
        .on("copy", function(e) {
		  
		  copied_text = $('#share_link').text();
		  $('.copied_msg').html('Share link has been copied.');
		  
          e.clipboardData.clearData();
          e.clipboardData.setData("text/plain", copied_text);
         // e.clipboardData.setData("text/html", copied_text);
          e.preventDefault();
        });
		
});
</script>        
<!-- end copy to clipboard -->        
      
    
@endsection
