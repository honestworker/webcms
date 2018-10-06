@extends('front/templateFront')

@section('content')
              
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
                        	
                            <aside class="col-md-3 col-sm-4 col-xs-12 sidebar">
                            	<div class="widget">
                                    <div class="panel-group custom-accordion sm-accordion" id="category-filter">
   										
                                        <div class="panel">
                                            <div class="accordion-header">
                                                <div class="accordion-title"><span>My Account</span>
                                                </div>
                                                <a class="accordion-btn opened" data-toggle="collapse" data-target="#category-list-1"></a>
                                            </div>
                                            <div id="category-list-1">
                                                <div class="panel-body">
                                                	@include('front.user.userLeft')
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                <!-- end widget -->
  
                            </aside>
                            
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            
                             @if(session()->has('data'))
                                    <div class="alert alert-success alert-dismissable">
                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                    <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                                    <p>{{  session('data.success') }}</p>
                                  </div>
                                @endif
                            
                            	<h3 class="checkout-title">New Wishlist</h3>
                                <form action="{{ url('/addWishlist') }}" method="post" id="billing-form">
                                	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                	<div class="form-group">
                                       <div class="input-group"><span class="input-group-addon"><i class="fa fa-list-alt"></i> <span class="input-text">Name &#42;</span></span>
                                           <input type="text" name="list_name" class="form-control input-lg" required="required">
                                       </div>
                                    </div>
                                    <div class="input-group custom-checkbox">
                                        <input type="checkbox" name="is_default"> <span class="checbox-container"><i class="fa fa-check"></i></span> Set as default wishlist.
                                	</div>
                                    <button type="submit" class="btn btn-custom">SAVE &nbsp;<i class="fa fa-floppy-o"></i></button>
                                </form>        
   								
                                <div class="md-margin"></div>
                                <hr>
                                <div class="md-margin"></div>
                                
                                <?php
								if(count($list_wishlist) > 0)
								{
								?>
                                
                                <div class="table-responsive">
                                    <table class="table cart-table">
                                        <thead>
                                            <tr>
                                                <th class="table-title"><a href="#sort by name" title="Sort by name">Name</a></th>
                                                <th class="table-title"><a href="#sort by created date" title="Sort by created date">Created Date</a></th>
                                                <th class="table-title"><a href="#sort by quantity" title="Sort by Qty">Qty</a></th>
                                                <th class="table-title">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	
                                            <?php
											foreach($list_wishlist as $wishlist)
											{
												echo '<tr>
														<td><a href="'.url('/wishlistDetails/'.$wishlist->id).'">'.$wishlist->list_name.'</a></td>
														<td>'.date('dS M, Y',strtotime($wishlist->last_modified)).'</td>
														<td>'.$wishlist->quantity.'</td>
														<td>
															<div class="btn-group">
																<a href="#" class="add-tooltip" data-toggle="modal" data-placement="top" title="Share this list" data-target="#share-list"><button type="button" class="btn btn-info btn-xs" onclick="$(\'#form_share_wishlist #share_link span\').text(\''.$wishlist->token.'\'); $(\'#form_share_wishlist #share_link_url\').val($(\'#form_share_wishlist #share_link\').text());"><i class="fa fa-users"></i></button></a>  
																<a href="'.url('/wishlistDetails/'.$wishlist->id).'" class="add-tooltip" data-toggle="tooltip" data-placement="top" title="View list"><button type="button" class="btn btn-custom btn-xs"><i class="fa fa-search"></i></button></a> 
																<a href="#" data-toggle="modal" data-target="#delete-list" data-placement="top" title="Delete" onclick="$(\'#delete_wishlist_id\').val('.$wishlist->id.')"><button type="button" class="btn btn-custom-2 btn-xs"><i class="fa fa-times"></i></button></a>
															</div>
														</td>
													</tr>';
											}
											?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
								} // end if(count($list_wishlist) > 0)
								?>
                                <!-- end table responsive -->
                                <div class="md-margin"></div>
                                <!-- end wishlist -->
                                
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
                                                            <p class="text-red" style="font-weight:bold" id="share_link">{{ url('/wishlist/view?token=') }}<span></span></p>
                                                            <div class="xs-margin"></div>
                                                            <a href="javascript:void(0)"><button type="button" class="btn btn-sm btn-custom" id="copyToClipboard">COPY TO THE CLIPBOARD</button></a> <span class="copied_msg"></span>
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
                                                        	<input type="hidden" name="share_link_url" id="share_link_url" value="">
                                							<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <button type="submit" class="btn btn-custom-2">SEND</button>
                                                            <button type="button" class="btn btn-custom" data-dismiss="modal">CLOSE</button>
                                                        </div><!-- End .modal-footer -->
                                                    </div><!-- End .modal-content -->
                                                </div><!-- End .modal-dialog -->
                                                </form>
                                            </div><!-- End .modal share this list -->
                                
                                
                                <div class="md-margin"></div>
                                
                                <a href="{{ url('dashboard') }}" class="btn btn-custom"><i class="fa fa-angle-double-left"></i> BACK</a>
                                
                                
                            </div>
                            
                            
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
