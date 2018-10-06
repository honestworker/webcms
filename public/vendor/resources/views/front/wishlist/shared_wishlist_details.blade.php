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
                                              <li>Priority : {{ $item->priority }}</li>
                                            </ul>                                          
                                        </td>
                                        <td class="item-code">{{ $item->product_code }}</td>
                                        <td class="item-price-col"><span class="item-price-special">RM {{ number_format($item->sale_price, 2) }}</span></td>
                                        <td>1</td>
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
                                
                        
  						<div class="md-margin"></div>
                        
                        <a href="#" class="btn btn-custom" data-toggle="modal" data-target="#share-list">SHARE WISHLIST &nbsp;<i class="fa fa-users"></i></a> 
                        <input class="cart_data"  type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                        <div class="md-margin"></div>
                        
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
