@extends('front/templateFront')

@section('content')
<?php
use App\Http\Models\Front\SpecialList;
$SpecialListModel = new SpecialList();

$event_token = $event_details->token;
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
                            <h2>My Special List</h2>
                            <span class="small-bottom-border big"></span>
                            <p>Make sure you have enough gifts for your events!</p>
                        </div>
                        <div class="md-margin2x"></div>
                        
                        <div class="row">
                            
                            <div class="col-md-6 col-sm-6 col-xs-12">
                               <!-- <h3 class="checkout-title">For Hock Lim &amp; Test Test, </h3>-->
                                <p>Event Type: {{ $event_details->event_type }}</p>
                                <p>Event Date: {{ date('dS M, Y',strtotime($event_details->event_date)) }}</p>
                                <p>Event ID: {{ $event_details->id }}</p>
                                
                            </div>
                            <!-- end col-md-6 --> 
                            
                            <?php
								$date_1 = $event_details->event_date;
								$curr_date =  date('Y-m-d');
                            	$difference = date_diff(date_create($date_1),date_create($curr_date)); 
								//print_r($difference); exit;
								//echo $difference->d;
								
								if(strtotime($date_1) > strtotime($curr_date))
									$day_type = 'left';
								else if(strtotime($date_1) == strtotime($curr_date))
									$day_type = 'today';
								else
									$day_type = 'ago';
								
							?>
                            
                            
                            <div class="col-md-6 col-sm-6 col-xs-12">          
                            	<article class="article pull-right">
                                	<div class="article-meta-date">
                                    	
                                        @if($day_type != 'today')
	                                        <span>{{ $difference->days }}</span> day(s) {{ $day_type }}
                                        @endif
                                        
                                         @if($day_type == 'today')
	                                        <span>Today</span>
                                        @endif
                                        
                                   	</div>
                                </article>
                            </div>
                             <div class="clearfix"></div>
                            <!-- end col-md-6 --> 
                            
                            
                             @if(session()->has('data.success'))                             	
                                <div class="alert alert-success alert-dismissable">
                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                                <p>{{  session('data.success') }}</p>
                              </div>
                            @endif
                           
                        <div class="clearfix"></div>
                        <hr>
                        <a href="{{ url('/editEvent/'. $event_details->id) }}"><button type="button" class="btn btn-danger">EDIT EVENT &nbsp;<i class="fa fa-pencil"></i></button></a>
                        
                        <div class="sm-margin"></div>
                        
                        <?php 
						if(count($event_items)  == 0)
						{
						?>
                        
                        <div class="alert alert-danger">
                        	<i class="fa fa-shopping-cart"></i> &nbsp; Your special list is currently empty.
                        </div><!-- End .alert-danger -->
                        <?php
						}
						?>                        
                         
                        <a href="javascript:void(0)" class="btn btn-custom-2" title="add gift" data-target="#modal-add-gifts" data-toggle="modal" data-placement="top" >ADD GIFTS &nbsp;<i class="fa fa-gift"></i></a> 
                        <div class="md-margin"></div>
                        
                        <?php 
						if(count($event_items) > 0)
						{
						?>
                        <p>Right now, you have {{ count($event_items) }} gifts on your list. We recommend having about two times more gifts than guests. Make sure you have enough to go around!</p>
                        <div class="table-responsive">
                        <form id="form_event_items">
                            <table class="table cart-table">
                                <thead>
                                    <tr>
                                        <th class="table-title">Product Name</th>
                                        <th class="table-title">Product Code</th>
                                        <th class="table-title">Unit Price</th>
                                        <th class="table-title">Would Love</th>
                                        <th class="table-title">Still Need</th>
                                        <th class="table-title">Purchase</th>
                                        <th class="table-title"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
									foreach($event_items as $item)
									{
										
										//dd($event_items)
										
										$price = str_replace('.','.<span class="sub-price">',number_format($item->sale_price, 2)).'</span>';
										
										$total_order = $SpecialListModel->totalOrdered($item->product_id,$item->event_id,$item->color_id);
										
										$total_order = ($total_order) ? $total_order : 0;
										
										$still_need = ($total_order < $item->still_need) ? '<div class="custom-quantity-input"><input type="text" value="'.($item->still_need - $total_order).'"> <a class="quantity-btn quantity-input-up" onclick="return!1" href="#"><i class="fa fa-angle-up"></i></a>  <a class="quantity-btn quantity-input-down" onclick="return!1" href="#"><i class="fa fa-angle-down"></i></a></div>' : '<i class="fa fa-check-circle text-red"></i> Completed';
										
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
                                            </ul>                                          
                                        </td>
                                        <td class="item-code">{{ $item->product_code }}</td>
                                        <td class="item-price-col"><span class="item-price-special">RM <?php echo number_format($item->sale_price, 2); ?></span></td>
                                        
                                        <td>
                                        <?php
										if($total_order < $item->still_need)
										{
                                           echo '<div class="custom-quantity-input">
                                                <input type="text" value="'.$item->would_love.'"> <a class="quantity-btn quantity-input-up" onclick="return!1" href="#"><i class="fa fa-angle-up"></i></a>  <a class="quantity-btn quantity-input-down" onclick="return!1" href="#"><i class="fa fa-angle-down"></i></a>               
                                            </div>';
										}
										else
											echo $item->would_love;
										?>
										
                                        </td>
                                       
                                       <td><?php echo $still_need; ?></td> 
                                        
                                        <td>
                                            <div class="custom-quantity-input">
                                                <input type="text" name="quantity" class="quantity_<?php echo $item->event_item_id; ?>" value="1"> <a href="javascript:void(0)" onClick="increaseQuantity('quantity_<?php echo $item->event_item_id; ?>')" class="quantity-btn quantity-input-up"><i class="fa fa-angle-up"></i></a>  <a href="javascript:void(0)" onClick="decreaseQuantity('quantity_<?php echo $item->event_item_id; ?>')" class="quantity-btn quantity-input-down"><i class="fa fa-angle-down"></i></a>               
                                            </div>                                            
                                        </td>
                                        <td>
                                        <!--<a href="javascript:void(0)" onclick="add_to_cart(<?php echo $item->id; ?>,<?php echo $item->event_item_id; ?>,<?php echo ($item->color_id) ? $item->color_id : 0; ?>,<?php echo $event_details->id; ?>)" class="btn-sm btn-custom-2 add_to_cart_link">ADD TO CART &nbsp;<i class="fa fa-shopping-cart"></i></a>-->
                                        <a href="#" class="close-button add-tooltip" data-toggle="modal" data-target="#delete-special-list-item" data-placement="top" title="Remove item" onclick="$('#delete_event_item_id').val({{ $item->event_item_id }})" style="margin-top:7px;"></a>
                                        
                                        <input class="cart_data" type="hidden" name="cart[<?php echo $item->event_item_id; ?>][product_id]" value="<?php echo $item->id; ?>" />
                                        <input class="cart_data" type="hidden" name="cart[<?php echo $item->event_item_id; ?>][color_id]" value="<?php echo $item->color_id; ?>" />
                                        <input class="cart_data quantity_<?php echo $item->event_item_id; ?>" type="hidden" name="cart[<?php echo $item->event_item_id; ?>][quantity]" value="1" />
                                        <input class="cart_data" type="hidden" name="cart[<?php echo $item->event_item_id; ?>][special_event_id]" value="<?php echo $event_details->id; ?>" />
                                        
                                        </td>
                                    </tr>
                                <?php
									} // end foreach
									?>
                                </tbody>
                            </table>
                            
                           </form> 
                           
                        </div>
                        
                        <div class="md-margin"></div>
                        
                        <a href="#" class="btn btn-custom" data-toggle="modal" data-target="#share-list">SHARE SPECIAL LIST &nbsp;<i class="fa fa-users"></i></a>
                       <!-- <a href="javascript:void(0)" class="btn btn-custom">SAVE SPECIAL LIST &nbsp;<i class="fa fa-floppy-o"></i></a>-->
                        <a href="javascript:void(0)" class="btn btn-custom-2" onclick="add_all_to_cart()">ADD ALL TO CART &nbsp;<i class="fa fa-shopping-cart"></i></a>
                        <input class="cart_data"  type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                        <div class="md-margin"></div>
                        
                        <?php
						} // end if(count($event_items) > 0)
						?>
                        <!-- end table responsive -->
                                
                                    
						<script>
                            						
							
							function add_to_cart(product_id,event_item_id,color_id,special_event_id)
							{
								quantity = $('.quantity_'+event_item_id).val();
								
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
											data: '_token=<?php echo csrf_token(); ?>&product_id='+product_id+'&quantity='+quantity+'&color_id='+color_id+'&special_event_id='+special_event_id,
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
                        	
							function increaseQuantity(selector)
							{
								elm = $('.'+selector);
								if(isNaN(elm.val()) || elm.val() == '')
								{
									elm.val(0);
								}
								
								elm.val(Number(elm.val()) + 1 );
							}
							
							function decreaseQuantity(selector)
							{
								elm = $('.'+selector);
								
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
                       
                        <a href="{{ url('/events') }}" class="btn btn-custom"><i class="fa fa-angle-double-left"></i> BACK</a>
                        
                        
                        <!-- Share this list modal start -->
                        <div class="modal fade" id="share-list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                            <form id="form_share_wishlist" method="post" action="{{ url('/event/share') }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel2">Share this List</h4>
                                    </div><!-- End .modal-header -->
                                    <div class="modal-body clearfix">

                                        <p>Copy your link and send it to your friends and family: </p>
                                        <p class="text-red" style="font-weight:bold" id="share_link">{{ url('/event/view?token='.$event_token) }}</p>
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
                                    	<input type="hidden" name="share_link_url" id="share_link_url" value="{{ url('/event/view?token='.$event_token) }}">
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
                        <div class="modal fade" id="delete-special-list-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                          <form id="login-form-2" method="post" action="{{ url('/deleteEventItem') }}">
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
                                            <input type="hidden" name="delete_event_item_id" id="delete_event_item_id"  value="">
                                            <button type="submit" class="btn btn-custom-2">DELETE</button>
                                            <button type="button" class="btn btn-custom" data-dismiss="modal">CANCEL</button>
                                        </div><!-- End .modal-footer -->
                                    </div><!-- End .modal-content -->
                                </div><!-- End .modal-dialog -->
                                </form>
                            </div>
                        <!-- End .modal delete list item --> 
                        
                        <!--  add gift item modal start -->                        
                        <div id="modal-add-gifts" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog modal-wide-width" style="width: 70%;">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close" onclick="window.location.href='{{ url('/eventDetails/'. Request::segment(2)) }}'">&times;</button>
                                  <h4 id="modal-login-label3" class="modal-title">Add Gifts</h4>
                                </div>
                                <div class="modal-body">
                                  <div class="form">
                                    <form class="form-horizontal" id="form_add_gift">                                     
                                      <div class="form-group">
                                        <label for="inputFirstName" class="col-md-3 control-label">Select Category</label>
                                        <div class="col-md-6">
                                          <div class="xs-margin"></div>
                                          <select name="category_id" class="form-control" onchange="load_category_products('modal-add-gifts',this.value)">
                                            <option value="">- Select Category -</option>
                                            <?php echo $categories; ?>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group" id="apply_to_all" style="display:none;">
                                        
                                        <div class="col-md-12">                                         
                                          <div id="category_products"></div>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <!--  end add gift item modal -->    
                            
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
$(document).ready(function() {
			
	$("#copyToClipboard").on("copy", function(e) {
		  
		  copied_text = $('#share_link').text();
		  $('.copied_msg').html('Share link has been copied.');
		  
          e.clipboardData.clearData();
          e.clipboardData.setData("text/plain", copied_text);
         // e.clipboardData.setData("text/html", copied_text);
          e.preventDefault();
        });
		
});

function load_category_products(model_id,category_id)
{
	$('#'+model_id+' #category_products').html('');
	$('#'+model_id+' #apply_to_all').hide();
	$.ajax({
			url: '{{ url("/event/categoryProducts") }}',
			type: 'POST',
			dataType: 'json',
			data: '_token=<?php echo csrf_token() ?>&category_id='+category_id,
			beforeSend: function(){
				
			},
			complete: function(){
				
			},
			success: function(response){
				
				if(response['products'])
				{
					$('#'+model_id+' #apply_to_all').show();					
					var products = '<table class="table checkout-table table-responsive"><thead><tr><th class="table-title">Product Name</th><th class="table-title">Product Code</th><th class="table-title">Price</th><th class="table-title">Quantity</th><th class="table-title">Would Love</th><th class="table-title">Action</th></tr></thead><tbody>';
					for(var i=0; i < response['products'].length; i++)
					{
						elm = response['products'][i];
						products += '<tr><td class="item-name-col"><figure><a href="<?php echo url('/product/') ?>/'+ elm.id +'" target="_blank"><img src="<?php echo asset('/public/admin/products/large') ?>/'+ elm.large_image +'" alt="'+ elm.product_name +'" class="img-responsive" width="100"></a></figure><header class="item-name"> <a href="#link to product item">'+ elm.product_name +'</a> </header></td><td class="item-code">'+ elm.product_code +'</td><td class="item-price-col"><span class="item-price-special">RM '+ parseFloat(elm.sale_price).toFixed(2) +'</span></td><td>'+ elm.quantity_in_stock +'</td><td><div class="custom-quantity-input"><input type="text" name="quantity" class="gift_quantity_'+ elm.id +'" value="1"> <a href="javascript:void(0)" onClick="increaseQuantity(\'gift_quantity_'+ elm.id +'\')" class="quantity-btn quantity-input-up"><i class="fa fa-angle-up"></i></a>  <a href="javascript:void(0)" onClick="decreaseQuantity(\'gift_quantity_'+ elm.id +'\')" class="quantity-btn quantity-input-down"><i class="fa fa-angle-down"></i></a></div></td><td>';
						
						// get product colors by product id
						colors = get_product_colors(elm.id);
						//colors = '';
						products += '<span id="product_color_'+ elm.id +'"></span><br><a href="javascript:void(0)" class="btn btn-custom-2" onclick="add_to_gift('+ elm.id +')">Add Gift</a>';
						//<a href="">Add Gift</a>
						products += '</td></tr>';
						//products += '<p>'+ response['products'][i].product_name +'</p>';
						//alert(response['products'][i].product_name);
					}
					products += '</tbody></table>';
					$('#'+model_id+' #category_products').html(products);	
				}				
			}
		});	
}


function get_product_colors(product_id)
{
	$.ajax({
			url: '{{ url("/event/productColors") }}',
			type: 'POST',
			dataType: 'json',
			data: '_token=<?php echo csrf_token() ?>&product_id='+product_id,
			beforeSend: function(){
				
			},
			complete: function(){
				
			},
			success: function(response){
				colors = '';
				//alert(response['product_colors']);
				for(var i=0; i < response['product_colors'].length; i++)
				{
					new_elm = response['product_colors'][i];
					colors += '<span style="background:'+ new_elm.hex_code +'" class="product_color_box"> </span><input type="radio" class="product_radio" required="required" value="'+ new_elm.id +'" name="color_id">';
				}
				
				if(response['product_colors'] == 'no_color')
				{
					colors = '<input type="radio" class="product_radio" required="required" value="0" name="color_id" checked="checked">';
				}
				
				$('#product_color_'+product_id).html(colors);
			}
		});	
}

function add_to_gift(product_id)
{
	if($('#product_color_'+product_id+' input[type=radio]').is(':checked'))
	{
		//alert('add');
		checked_color_id = $('#product_color_'+product_id+' input[type=radio]:checked').val();
		would_love = (isNaN($('.gift_quantity_'+product_id).val())) ? 1 : $('.gift_quantity_'+product_id).val();
		$.ajax({
			url: '{{ url("/event/addGift") }}',
			type: 'POST',
			dataType: 'json',
			data: '_token=<?php echo csrf_token() ?>&product_id='+product_id+'&color_id='+checked_color_id+'&event_id=<?php echo Request::segment(2); ?>&would_love='+would_love,			
			success: function(response){
				
				$('#errorElement').remove();
				$('#successElement').remove();
				
				var success = '<div id="successElement" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>Gift has been added successfully.</p></div>';
				$('#form_add_gift').before(success);
			}
		});	
	
	}
	else
	{
		$('#errorElement').remove();
		$('#successElement').remove();
				
		var error = '<div id="errorElement" class="alert alert-danger"><i class="fa fa-times-circle"></i> <strong>Error!</strong><p>Please select product color.</p></div>';
		$('#form_add_gift').before(error);
		
	}
}

$(document).ready(function(){
	$('#apply_to_all').on('click','span.product_color_box',function(){
	//$('.product_color_box').on('click',function(){
		//$(this).next('input[type=radio]').attr('checked',true);
		
		//$('#apply_to_all input:radio').attr('checked',false);
		
		//$('#apply_to_all span').css('box-shadow','none');
		$(this).parent().children('span').css('box-shadow','none');
		$(this).css('box-shadow','0 0 2px #999');
		
		
		$(this).parent().children('input:radio').attr('checked',false);
		
		$(this).next('input:radio').prop('checked',true);
		$(this).next('input:radio').attr('checked','checked');
		//alert(1231);
	});
	//$('.product_color_box').on('click','.product_color_box',(function(){
		//$(this).next('input[type=radio]').attr('checked',true);	
	//	alert(1231);
	//});
});
</script>        
<!-- end copy to clipboard -->        
<style>
/*.product_radio{left: -20px; position: relative; z-index: -1;}*/
#apply_to_all .btn{margin: 8px 0 0;padding: 3px 7px;}

.product_color_box {	
    border: 1px solid #ddd;
    cursor: pointer;
    float: left;
    height: 24px !important;
    margin: 1px;
    width: 24px !important;	
	padding:1px 10px;
	cursor:pointer;
}

.product_radio{ display:none;}
</style>      
    
@endsection
