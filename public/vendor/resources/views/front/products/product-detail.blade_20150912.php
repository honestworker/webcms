@extends('front/templateFront')

@section('content')
<section id="content">
    <div id="breadcrumb-container" class="light">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a></li>                              
                
                @foreach($breadcrumb as $row)
                <li><a href="{{ url('products/' . $row->id . '/new') }}">{{ $row->title }}</a></li>
                @endforeach
                <li class="active">{{ $productInfo->product_name }}</li>
            </ul>
        </div>
    </div>
    <div class="container" id="container-product">
                    
        <div class="row">
            <div class="col-md-12">
            
            	@if(session()->has('data'))
                    <div class="alert alert-success alert-dismissable">
                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                    <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                    <p>{{  session('data.success') }}</p>
                  </div>
                @endif
            
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 product-viewer clearfix">
                        @if($productImages)
                        <div id="product-image-carousel-container">
                            <ul id="product-carousel" class="celastislide-list">
                            	<li class="active-slide">
                                    	<a data-rel="prettyPhoto[product]" href="{{ asset('/public/admin/products/large/' . $productInfo->large_image) }}" data-image="{{ asset('/public/admin/products/large/' . $productInfo->large_image) }}" data-zoom-image="{{ asset('/public/admin/products/large/' . $productInfo->large_image) }}" class="product-gallery-item">
                                            <img src="{{ asset('/public/admin/products/medium/' . $productInfo->large_image) }}" alt="{{ $productInfo->product_name }}">
                                        </a>
                                    </li>
                            	@foreach($productImages as $productImage)
                                	<li class="active-slide">
                                    	<a data-rel="prettyPhoto[product]" href="{{ asset('/public/admin/products/large/' . $productImage->file_name) }}" data-image="{{ asset('/public/admin/products/large/' . $productImage->file_name) }}" data-zoom-image="{{ asset('/public/admin/products/large/' . $productImage->file_name) }}" class="product-gallery-item">
                                            <img src="{{ asset('/public/admin/products/medium/' . $productImage->file_name) }}" alt="{{ $productInfo->product_name }}">
                                        </a>
                                    </li>
                                @endforeach                                
                            </ul>
                        </div>
                        @endif

                        <div id="product-image-container">
                            <figure>
                                <img src="{{ asset('/public/admin/products/large/' . $productInfo->large_image) }}" data-zoom-image="{{ asset('/public/admin/products/large/' . $productInfo->large_image) }}" alt="Product Big image" id="product-image">
                                
                                @if($productInfo->list_price != $productInfo->sale_price)
                                	<figcaption class="item-price-container top-right">
                                         <span class="sale">SALE</span>
                                         <span class="discount">-{{ number_format(100 - (($productInfo->sale_price/($productInfo->list_price)*100)), 0) }}%</span>
                                    </figcaption>
                                @endif
                                
                               <?php if(preg_match('/new/',$productInfo->promo_behaviour)){ echo '<span class="new-circle top-left">New</span>'; } ?>
							   <?php if(preg_match('/hot/',$productInfo->promo_behaviour)){ echo '<span class="new-circle top-left">Hot</span>'; } ?>
                               <?php if(preg_match('/sale/',$productInfo->promo_behaviour)){ echo '<span class="new-circle top-left">Sale</span>'; } ?>
                               <?php if(preg_match('/pwp/',$productInfo->promo_behaviour)){ echo '<span class="new-circle top-left">pwp</span>'; } ?>
                                
                            </figure>
                            <hr>
                           
                            <ul class="product-list">
                            	@if($breadcrumb)
                                	<li><strong>Categories:</strong> 
		                                @foreach($breadcrumb as $row)
    	                                	<a href="{{ url('products/' . $row->id . '/new') }}">{{ $row->title }}</a>,
        		                        @endforeach
                                    </li>
                                @endif
                            </ul>
                            
                            

                            
                        </div>
                        
                    </div>

                    <div class="col-md-6 col-sm-12 col-xs-12 product">
                        <div class="lg-margin visible-sm visible-xs"></div>
                        <h1 class="product-name">{{ $productInfo->product_name }}</h1>
                        <div class="item-price-container inline">
                        	@if($productInfo->list_price != $productInfo->sale_price)
                            	<span class="old-price1">RM {{ number_format($productInfo->list_price, 2) }}<span class="sub-price"></span></span>
                                <span class="item-price">RM {{ number_format($productInfo->sale_price, 2) }} (SAVE {{ number_format(100 - (($productInfo->sale_price/($productInfo->list_price)*100)), 0) }}%)</span>
                            @else
                            	<span class="item-price">RM {{ number_format($productInfo->sale_price, 2) }}</span>
                            @endif
                            
                            
                        </div><!-- End .item-price-container -->
                        <ul class="product-list">
                            <li><span>Product code:</span> {{ $productInfo->product_code }}</li>
                            @if($productInfo->quantity_in_stock && $productInfo->quantity_in_stock < $productInfo->low_level_in_stock)
	                            <li><span>Availability:</span> <span class="text-warning">Limited Stock</span></li>
                            @elseif($productInfo->quantity_in_stock)
	                            <li><span>Availability:</span> <span class="text-success">In Stock</span></li>
                            @else
                            	<li><span>Availability:</span> <span class="text-red">Out of Stock</span></li>
                            @endif
                            
                            <li><span>Brand:</span> {{ $productInfo->brand_name }}</li>
                            @if($productInfo->free_shipping)
                            	<li><span>Shipping fee:</span> <span class="text-red"><strong>FREE</strong></span></li>
                            @elseif($productInfo->shipping_cost)
                            	<li><span>Shipping Cost:</span> <span class="text-red"><strong>RM {{ number_format($productInfo->shipping_cost,2) }}</strong></span></li>
                            @endif
                        </ul>
                        
                        @if($productColors)
                        <hr>
                        <div class="product-color-filter-container"><span>Select Color:</span>
                            <div class="xs-margin"></div>
                            <ul class="filter-color-list clearfix">
                                @foreach($productColors as $productColor)
                                	<li><a href="javascript:void(0)" data-bgcolor="{{ $productColor->hex_code }}" class="filter-color-box" title="{{ $productColor->color_name }}" color_id="{{ $productColor->color_id }}"></a><input type="radio" name="color_id" id="color-{{ $productColor->color_id }}" value="{{ $productColor->color_id }}" style="display:none;" /></li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                        <hr>
                        <div class="product-add clearfix">
                        	@if($productInfo->quantity_in_stock)
	                            <div class="custom-quantity-input">
                                    <input id="qut" type="text" name="quantity" value="1" />
                                    <input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input id="product_id" type="hidden" name="product_id" value="{{ $productInfo->id }}">
                                    <a href="javascript:void(0)" onClick="addQuantity('add', $('#qut'))" class="quantity-btn quantity-input-up"><i class="fa fa-angle-up"></i></a>
                                    <a href="javascript:void(0)" onClick="addQuantity('sub', $('#qut'))" class="quantity-btn quantity-input-down"><i class="fa fa-angle-down"></i></a>
                                </div>
                                <button id="add-to-cart" class="btn btn-custom-2">ADD TO CART</button>
                            @elseif($productInfo->out_of_stock_action == 'signup')
                            	<button class="btn btn-custom-4" data-toggle="modal" data-target="#notify-model">NOTIFY ME WHEN ITEMS ARE ARRIVED</button>
                                <div class="modal fade" id="notify-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            	<button type="button" class="close" data-dismiss="modal">
                                                	<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                                </button>
                                            	<h4 class="modal-title" id="myModalLabel2">Notify me when items are arrived</h4>
                                            </div>
                                            <div class="modal-body clearfix">
                                            	<div class="col-md-10">
                                                    <div class="form-group">
                                                    	<div class="input-group">
                                                        	<span class="input-group-addon">
                                                            	<i class="fa fa-list-alt"></i> <span class="input-text">Name</span>
                                                            </span>
                                                    		<input type="text" class="form-control input-lg" name="name" />
                                                    	</div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                    	<div class="input-group">
                                                        	<span class="input-group-addon">
                                                            	<i class="fa fa-list-alt"></i> <span class="input-text">Email</span>
                                                            </span>
                                                    		<input type="text" class="form-control input-lg" name="email" />
                                                    	</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            <button id="notify-me" type="submit" class="btn btn-custom-2">SAVE</button>
                                            <button type="button" class="btn btn-custom" data-dismiss="modal">CANCEL</button>
                                            </div>
                                        </div>
                                    </div>
								</div>
                            @endif
                        </div>
                        <div class="md-margin"></div>
                        <div class="product-extra clearfix">
                            <div class="product-extra-box-container clearfix">
                                <div class="item-action-inner">
                                    
                                    <?php 
										if(Session::has('userId'))
											echo '<a href="#" class="icon-button icon-like add-tooltip" data-toggle="modal" data-target="#wishlist_model" data-placement="top" title="Add to wishlist" onclick="$(\'#wishlist_model #wishlist_product_id\').val('.$productInfo->id.'); $(\'#wishlist_model img\').attr(\'src\',\''.asset('/public/admin/products/large/'.$productInfo->large_image).'\'); $(\'#wishlist_model #list_name\').val(\'\'); load_product_attr('.$productInfo->id.');">Favourite</a>';
										else
											echo '<a href="#" class="icon-button icon-like add-tooltip" data-toggle="modal" data-target="#login_model" data-placement="top" title="Add to wishlist">Favourite</a>';
									?>
                                    <!--<a href="#" class="icon-button icon-like add-tooltip" data-toggle="tooltip" data-placement="top" title="Add to wishlist">Favourite</a>-->
                                    
                                    
                                    <a href="javascript:void(0)" onclick="addToCompare({{ $productInfo->id }})" class="icon-button icon-compare add-tooltip" data-toggle="tooltip" data-placement="top" title="Add to compare">Compare</a>
                                </div>
                            </div>
                            <div class="md-margin visible-xs"></div>
                            <div class="share-button-group">
                                <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                                    <a class="addthis_button_facebook"></a>
                                    <a class="addthis_button_twitter"></a>
                                    <a class="addthis_button_email"></a>
                                    <a class="addthis_button_print"></a>
                                    <a class="addthis_button_compact"></a>
                                    <a class="addthis_counter addthis_bubble_style"></a>
                                </div>
                                <script type="text/javascript">
                                    var addthis_config = {
                                        data_track_addressbar: !0
                                    };
                                </script>
                                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52b2197865ea0183"></script>
                            </div>
                            <!-- end share button group -->
                            <div class="clearfix"></div>
                            <hr>
                            <ul class="product-list">
                                <li><span>Shipping option(s):</span> 
                                    <a href="#" class="label label-success" data-toggle="modal" data-target="#modal-poslaju">Poslaju National Courier</a> 
                                    <a href="#" class="label label-warning" data-toggle="modal" data-target="#modal-self-collection">Self Collection</a> 
                                </li>
                                <div class="xs-margin"></div>
                                <li><span>Payment option(s):</span> <a href="#" class="label label-danger" data-toggle="modal" data-target="#modal-paypal">iPay88</a> </li>
                            </ul>
                            <!-- Modal Poslaju start -->
                            <div class="modal fade" id="modal-poslaju" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title" id="myModalLabel3">Poslaju National Courier</h4>
                                        </div><!-- End .modal-header -->
                                        <div class="modal-body">

                                            <p class="text-red"><strong>Next business day delivery upon receipt of order before 12:00PM. For orders received after 12:00PM, delivery will be scheduled on the next business day. All orders received on Saturday, Sunday and Public Holidays will be processed on the next business day as well.</strong></p>
                                            <p>We will start packing products between 1:00PM - 3:00PM. Poslaju pick up service will be between 3:00PM - 6:00PM(depending on their schedule time of arrival). Please check the scheduled delivery date and time alongside your tracking number in your order history. We are using Poslaju Next day delivery, and under normal circumstances, you should be able to receive your order within 1-2 working days(Peninsular)/2-3 working days(East Malaysia) from the day you place your order and make payment. During festive seasons, customers awaiting deliveries should expect delay due to lack of manpower from us and courier provider sides. We reserve the right to change courier services during any unexpected inconvenience.</p>
                                            <p>We sincerely apologise on behalf of Poslaju for any inconvenience caused, if Poslaju is unable to deliver your order based on the normal timeframe due to unforseen circumstances on their part. Should such an unfortunate situation arise, please contact Poslaju at 1-300-300-300 with your order tracking number or call us at 03-7983 2020 (ext 151) during office hours. We thank you for your kind understanding.</p>
                                            <p>A gentle reminder to all our valued customers to ensure that there is someone present during the delivery time slot to receive the product, Tan Boon Ming Sdn. Bhd. (TBMonline) shall not be held responsible for any loss or damage items that are left outside after the delivery has been made.</p>

                                        </div><!-- End .modal-body -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-custom-2" data-dismiss="modal">Close</button>
                                        </div><!-- End .modal-footer -->
                                    </div><!-- End .modal-content -->
                                </div><!-- End .modal-dialog -->
                            </div>
                            <!-- End .modal Poslaju -->
                            
                            <!-- Modal self collection start -->
                            <div class="modal fade" id="modal-self-collection" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title" id="myModalLabel3">Self Collection</h4>
                                        </div><!-- End .modal-header -->
                                        <div class="modal-body">

                                            <p>Your order can be self-collected at our outlet after the payment has been cleared and verified by our side.</p>
                                            <p><strong>Please appoint the outlet and collection date you would like to collect in the "Message to Merchant"</strong> column (scheduled <strong>appointment have to be 2 days after the confirmation</strong> for us to process &amp; transfer the product from warehouse). <strong>If collection is not been made 3 days within the scheduled date, we will make a call and inform you to collect the product at our HQ Old Klang Road outlet.</strong> <span class="text-red"><strong>For all urgent collection, you have to make the collection at our HQ Old Klang Road outlet </strong></span> as well. We are sorry for any inconvenience, this process above is to ensure our stock accuracy between outlets to serve you better. <strong>By choosing to make self-collection, you have agree to our terms above.</strong></p>
                                            <div class="md-margin"></div>
                                            <h4><strong>Self Collection Instructions</strong></h4>
                                            <hr>
                                            <p><strong>Please bring the printed confirmation email letter for proof of purchase</strong> and we will use that as an evidence of collection has been made for that product.</p>
                                            
                                            <div class="md-margin"></div>
                                            <h4><strong>Self Collection Outlets</strong></h4>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12 table-responsive">
                                                    <table class="table cart-table">
                                                        
                                                        <thead>
                                                            <th class="table-title" colspan="2">Kuala Lumpur</th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="item-name-col">
                                                                    <header class="item-name">HQ Old Klang Road</header>
                                                                    <ul>
                                                                        <li>PS 4, 5, 6, 7, Taman Evergreen, Batu 4, Jalan Klang Lama, 58100 Kuala Lumpur.</li>
                                                                        <li>Tel: 603-7983 2020 (Hunting Lines)</li>
                                                                        <li>Fax: 603-7982 8141</li>
                                                                        <li>E-mail: <a href="mailto:info@tbm.com.my">info@tbm.com.my</a></li>
                                                                    </ul>
                                                                    <div class="xs-margin"></div>
                                                                    <header class="item-name">Business Hours</header>
                                                                    <ul>
                                                                        <li>Mon - Sat: 9.30am - 9.00pm</li>
                                                                        <li>Sun: 10.00am - 9.00pm</li>
                                                                    </ul>
                                                                </td>
                                                                <td class="item-name-col">
                                                                    <header class="item-name">Bangsar Village (Bangsar)</header>
                                                                    <ul>
                                                                        <li>Bangsar Village Shopping Centre, Unit No. LG-6, Lower Ground Floor, Jalan Ara / Jalan Telawi Satu, Bangsar Baru, 59100 Kuala Lumpur.</li>
                                                                        <li>Tel: 603-2287 4818 / 4819</li>
                                                                        <li>Fax: 603-2287 7313</li>
                                                                      
                                                                    </ul>
                                                                    <div class="xs-margin"></div>
                                                                    <header class="item-name">Business Hours</header>
                                                                    <ul>
                                                                        <li>Mon - Sun: 10.00am - 10.00pm</li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="item-name-col">
                                                                    <header class="item-name">Cheras Sentral (Cheras)</header>
                                                                    <ul>
                                                                        <li>Cheras Sentral, 700-2F-10B to 10C, 2nd Floor, Jalan 2/142A Off Jalan Cheras, KM10 Cheras, 56100 Kuala Lumpur.</li>
                                                                        <li>Tel: 603-9100 4288</li>
                                                                        <li>Fax: 603-9100 1729</li>
                                                                    </ul>
                                                                    <div class="xs-margin"></div>
                                                                    <header class="item-name">Business Hours</header>
                                                                    <ul>
                                                                        <li>Mon - Sun: 10.00am to 10.00pm</li>
                                                                    </ul>
                                                                </td>
                                                                <td class="item-name-col">
                                                                    <header class="item-name">KL Festival City (Setapak)</header>
                                                                    <ul>
                                                                        <li>KL Festival City, Lot No. F-27, First Floor, Jalan Taman Ibu Kota, Taman Danau Kota, Setapak, 53300 Kuala Lumpur.</li>
                                                                        <li>Tel: 603-4131 6263</li>
                                                                        <li>Fax: 603-4142 8020</li>
                                                                      
                                                                    </ul>
                                                                    <div class="xs-margin"></div>
                                                                    <header class="item-name">Business Hours</header>
                                                                    <ul>
                                                                        <li>Mon - Sun: 10.00am to 10.00pm</li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        
                                                        <thead>
                                                            <th class="table-title" colspan="2">Selangor</th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="item-name-col">
                                                                    <header class="item-name">Shah Alam</header>
                                                                    <ul>
                                                                        <li>37, 39, Jalan Mewah 25/63, Taman Sri Muda, 40400 Shah Alam,
Selangor D.E.</li>
                                                                        <li>Tel: 603-5121 4122</li>
                                                                        <li>Fax: 603-5121 4006</li>
                                                                      
                                                                    </ul>
                                                                    <div class="xs-margin"></div>
                                                                    <header class="item-name">Business Hours</header>
                                                                    <ul>
                                                                        <li>Mon - Fri: 9.30am - 9.00pm</li>
                                                                        <li>Sat: 9.00am - 9.00pm</li>
                                                                    </ul>
                                                                </td>
                                                                <td class="item-name-col">
                                                                    <header class="item-name">SS2 Mall (PJ SS2)</header>
                                                                    <ul>
                                                                        <li>SSTwo Mall, Unit No. L-16, First Floor, Jalan SS2/72, 
47400 Petaling Jaya, Selangor D.E.</li>
                                                                        <li>Tel: 603-7931 1413</li>
                                                                        <li>Fax: 603-7954 1312</li>
                                                                      
                                                                    </ul>
                                                                    <div class="xs-margin"></div>
                                                                    <header class="item-name">Business Hours</header>
                                                                    <ul>
                                                                        <li>Mon - Sun: 10.00am to 10.00pm</li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        
                                                        
                                                    </table>
                                                </div>
                                            </div>

                                        </div><!-- End .modal-body -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-custom-2" data-dismiss="modal">Close</button>
                                        </div><!-- End .modal-footer -->
                                    </div><!-- End .modal-content -->
                                </div><!-- End .modal-dialog -->
                            </div>
                            <!-- End .modal self collection -->
                            
                            <!-- Modal Paypal start -->
                            <div class="modal fade" id="modal-paypal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title" id="myModalLabel3">iPay88</h4>
                                        </div><!-- End .modal-header -->
                                        <div class="modal-body">

                                            <p>Description of payment option. </p>

                                        </div><!-- End .modal-body -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-custom-2" data-dismiss="modal">Close</button>
                                        </div><!-- End .modal-footer -->
                                    </div><!-- End .modal-content -->
                                </div><!-- End .modal-dialog -->
                            </div>
                            <!-- End .modal Paypal -->
                            
                        </div>
                        <!-- end product extra -->
                    </div>
                </div>
                <div class="lg-margin2x"></div>
                
                <div class="row">
                	<div class="col-md-12 col-sm-12 col-xs-12">
                    		<div id="flix-minisite"></div>
                            <div id="flix-inpage"></div>
                            
                            
                            <script type="text/javascript" src="http://media.flixfacts.com/js/loader.js"
                            data-flix-distributor="7191"
                            data-flix-language="b3"
                            data-flix-brand="LG"
 
                            data-flix-sku=""
                            data-flix-button="flix-minisite"
                            data-flix-inpage="flix-inpage"
                            data-flix-button-image=""
                            data-flix-fallback-language="en"
                            data-flix-price="">
                            </script>
                    </div>
                </div>
                <div class="lg-margin2x"></div>
                
                <div class="row">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                    	
                        <div class="tab-container clearfix">
                            <ul class="nav-tabs clearfix">
                            	@if($productInfo->description != '')
	                                <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
                                @endif
                                @if($productInfo->features_and_video != '')
	                                <li><a href="#features" data-toggle="tab">Features &amp; Video</a></li>
                                @endif
                                @if($productInfo->warranty_and_support != '')
	                                <li><a href="#warranty" data-toggle="tab">Warranty &amp; Support</a></li>
                                @endif
                                @if($productInfo->return_policy != '')
	                                <li><a href="#return-policy" data-toggle="tab">Return Policy</a></li>
                                @endif
                            </ul>
                            <div class="tab-content clearfix">                                
                            	@if($productInfo->description != '')
	                                <div class="tab-pane active" id="description"><?php echo $productInfo->description; ?></div>
                                @endif
                                @if($productInfo->features_and_video != '')
	                                <div class="tab-pane" id="features"><?php echo $productInfo->features_and_video; ?></div>
                                @endif
                                @if($productInfo->warranty_and_support != '')
	                                <div class="tab-pane" id="warranty"><?php echo $productInfo->warranty_and_support; ?></div>
                                @endif
                                @if($productInfo->return_policy != '')
	                                <div class="tab-pane" id="return-policy"><?php echo $productInfo->return_policy; ?></div>
                                @endif
                            </div>
                        </div>
                        <div class="lg-margin visible-xs"></div>
                    </div>
                    <div class="lg-margin2x visible-sm visible-xs"></div>
                    @if($relatedDiffBrandProducts)
                        <div class="col-md-3 col-sm-12 col-xs-12 sidebar">
                            <div class="widget related">
                                <h3>You May Also Like</h3>
                                <div class="related-slider flexslider sidebarslider">
                                    <ul class="related-list clearfix">
                                        <li>
                                        	<?php $count = 1; ?>
                                        	@foreach($relatedDiffBrandProducts as $product)
                                                <div class="related-product clearfix">
                                                    <figure>
                                                    
                                                    @if($product->thumbnail_image_1 != '')
                                                        <img src="{{ asset('/public/admin/products/medium/'.$product->thumbnail_image_1) }}" alt="{{ $product->product_name }}" class="item-image" width="100" />
                                                    @endif
                                                    
                                                    @if($product->thumbnail_image_1 == '')
                                                    	<img src="{{ asset('/public/admin/products/medium/' . $product->large_image) }}" alt="{{ $product->product_name }}" class="item-image" width="100">
                                                    @endif                                                        
                                                    </figure>
                                                    <h5><a href="{{ url('product/' . $product->id) }}">{{ $product->product_name }}</a></h5>
                                                    
                                                    <div class="related-price">RM {{ number_format($product->sale_price, 2) }}</div>
                                                </div>
                                                @if($count%4 == 0)
                                                    </li>
                                                    <li>
                                                @endif
                                                <?php $count++; ?>
                                            @endforeach
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end you may also like -->
                        </div>
                    @endif
                </div>
                @if($relatedBrandProducts)
                    <div class="lg-margin2x"></div>
                    <div class="purchased-items-container carousel-wrapper">
                        <header class="content-title">
                            <div class="title-bg">
                                <h2 class="title">Customers who bought this item are also interested in</h2>
                            </div>
                        </header>
                        <div class="carousel-controls">
                            <div id="purchased-items-slider-prev" class="carousel-btn carousel-btn-prev"></div>
                            <div id="purchased-items-slider-next" class="carousel-btn carousel-btn-next carousel-space"></div>
                        </div>
                        <div class="purchased-items-slider owl-carousel">
                            @foreach($relatedBrandProducts as $product)
                                <div class="item item-hover">
                                    <div class="item-image-wrapper">
                                        <figure class="item-image-container">
                                            <a href="{{ url('product/' . $product->id) }}">
                                            	
                                                @if($product->thumbnail_image_1 != '')
                                                <img src="{{ asset('/public/admin/products/medium/'.$product->thumbnail_image_1) }}" alt="{{ $product->product_name }}" class="item-image" width="153px" height="153px" />
                                                @endif
                                                
                                                @if($product->thumbnail_image_1 == '')
                                                <img src="{{ asset('/public/admin/products/medium/' . $product->large_image) }}" alt="{{ $product->product_name }}" class="item-image" width="153px" height="153px">
                                                @endif
                                                
                                                @if($product->thumbnail_image_1 == '' && $product->thumbnail_image_2 != '')
                                                <img src="{{ asset('/public/admin/products/medium/'.$product->thumbnail_image_2) }}" alt="{{ $product->product_name }}" class="item-image-hover" width="153px" height="153px" />
                                                @endif
                                                
                                                @if($product->thumbnail_image_2 == '')
                                                <img src="{{ asset('/public/admin/products/medium/' . $product->large_image) }}" alt="{{ $product->product_name }}" class="item-image-hover" width="153px" height="153px">
                                                @endif
                                            </a>
                                        </figure>
                                    	
                                        @if($product->promo_behaviour != '')
                                        	<?php
											$promo_behaviour = explode(',', $product->promo_behaviour);
											?>
                                            <span class="new-circle top-left">{{ $promo_behaviour[0] }}</span>
                                        @endif
                                        
                                        @if($product->list_price != $product->sale_price)
	                                        <span class="discount-circle top-right">-{{ number_format(100 - (($productInfo->sale_price/($productInfo->list_price)*100)), 0) }}%</span>
                                        @endif
                                    </div>
                                    <div class="item-meta-container">
                                        <div class="item-meta-inner-container clearfix">
        
                                            <div class="item-price-container inline">
                                            	@if($productInfo->list_price != $productInfo->sale_price)
                                                    <span class="old-price1">RM {{ number_format($productInfo->list_price, 2) }}<span class="sub-price"></span></span>
                                                @endif
                                                <span class="item-price">RM {{ number_format($productInfo->sale_price, 2) }}</span>
                                            </div>
                                        </div>
        
                                        <h3 class="item-name"><a href="{{ url('product/' . $product->id) }}">{{ $product->product_name }}</a></h3>
                                       
                                        <div class="item-action">
                                            <a href="{{ url('product/' . $product->id) }}" class="item-add-btn">
                                                <span class="icon-cart-text">Add to Cart</span>
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
                            @endforeach
                        </div>
                        <!-- end also purchase item -->
                    </div>
                @endif
            </div>
            <!-- end col-md-12 -->
            
        </div>
        <!-- end row -->
        
    </div>
    <!-- end container -->
</section>
    
<?= $brands_scroller; ?>

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
<script src="{{ asset('/public/front/js/jquery.elevateZoom.min.js') }}"></script>

<script>
$(function(){
	$('#add-to-cart').click(function(){
		@if($productColors)
			if(!$('input[name="color_id"]').is(':checked')) {
				alert("Select color!"); 
				return false;
			}
		@endif
		
		var quantity = $('input[name="quantity"]').val();
		if(quantity < 1){
			alert("Please select valid product quantity!"); 
			return false;
		}
		
		$.ajax({
			url: '{{ url("cart/addToCart") }}',
			type: 'POST',
			dataType: 'json',
			data: $('input[name="quantity"], input[name="color_id"]:checked, input[name="_token"], #product_id'),
			beforeSend: function(){
				
			},
			complete: function(){
				
			},
			success: function(response){
				if(response['success']){
					var html = '';
					html += '<div class="alert alert-success alert-dismissable">';
	                    html += '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>';
    	                html += '<i class="fa fa-check-circle"></i> <strong>Success!</strong>';
        	            html += '<p>' + response['success'] + '</p>';
                    html += '</div>';
					
					$('#container-product').prepend(html);
					
					$('.dropdown-cart-menu-container').load('{{ url("cart/cartHtml") }} .dropdown-cart-menu-container > *');
				}
			}
		});
	});
});

function addQuantity(val, obj){
	if(val == 'sub' && obj.val() > 0){
		obj.val(parseInt(obj.val()) - 1);
	}
	else if(val == 'add'){
		obj.val(parseInt(obj.val()) + 1);
	}
}

$(function(){
	$('#notify-me').click(function(){
		$.ajax({
			url: '{{ url("product/notifyMe") }}',
			type: 'POST',
			dataType: 'json',
			data: {product_id: {{ $productInfo->id }}, name: $('#notify-model input[name=name]').val(), email: $('#notify-model input[name=email]').val(), _token: '{{ csrf_token() }}'},
			beforeSend: function(){
				$('#notify-me').html('SAVING...');
				
				$('#notify-model .alert-success, #notify-model .alert-danger').remove();
			},
			complete: function(){
				$('#notify-me').html('SAVE');
			},
			success: function(response){
				var html = '';
				
				if(response['success']){
					html += '<div class="alert alert-success">';
        	            html += '<p><i class="fa fa-check-circle"></i> <strong>Success!</strong> ' + response['success'] + '</p>';
                    html += '</div>';
					
					$('#notify-model .modal-header').after(html);
				}
				
				if(response['error'])
				{
					 html += '<div class="alert alert-danger">';
						for(var i=0; i < response['error'].length; i++)
						{
							html += '<p><i class="fa fa-exclamation-triangle"></i> '+ response['error'][i] +'</p>';
						}
					html += '</div>';
					
					$('#notify-model .modal-header').after(html);
				}
			}
		});
	});
});

$(function(){
	$('.filter-color-box').click(function(){
		$('#color-alert').remove();
		
		var color_id = $(this).attr('color_id');
		
		$('#color-' + color_id).prop('checked', true);
		$('.selected-color').removeClass('selected-color');
		
		$(this).addClass('selected-color');
		
		$('ul.filter-color-list').after('<p id="color-alert" class="alert alert-success">' + $(this).attr('title') + ' color selected</p>');
	});
});
</script>
@endsection