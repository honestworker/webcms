@extends('adminLayout')
@section('content')
<div id="page-wrapper">
    <div class="page-header-breadcrumb">
    	<div class="page-heading hidden-xs">
		    <h1 class="page-title">Customers</h1>
	    </div>
    
        <ol class="breadcrumb page-breadcrumb">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('web88cms/dashboard') }}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
            <li><a href="{{ url('web88cms/customers') }}">Customers Listing</a> &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li><a href="{{ url('web88cms/customers/view/' . $wishlist->user_id) }}">Wishlist Listing</a> &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li class="active">View Wishlist - Details</li>
        </ol>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
            	<h2>View Wishlist <i class="fa fa-angle-right"></i> Details</h2>
            	<div class="clearfix"></div>
            	@if ($success)
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                        <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                        <p>{{ $success }}</p>
                    </div>  	
                @endif
                
                @if ($warning)
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                        <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                        <p>{{ $warning }}</p>
                    </div>
                @endif
                
                <div class="pull-left"> Last updated: <span class="text-blue">{{ date('d M, Y @ h:iA', strtotime($wishlist->last_modified))}}</span> </div>
                <div class="clearfix"></div>
                <p></p>
                <div class="clearfix"></div>
                
                <ul id="myTab" class="nav nav-tabs">
	                <li class="active"><a href="#wishlist-details" data-toggle="tab">Wishlist Details</a></li>
                </ul>
            
                <div id="myTabContent" class="tab-content">
                    <div id="wishlist-details" class="tab-pane fade in active">
                        <div class="portlet">
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="table-responsive mtl"> 
                                        <table class="table checkout-table table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Product Code</th>
                                                    <th>Unit Price</th>
                                                    <th>Quantity</th>
                                                    <th>SubTotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($products as $product)
                                                    <tr>
                                                        <td class="item-name-col">
                                                            <figure><a href="{{ url('web88cms/products/editProduct/' . $product->product_id) }}">
                                                                <img src="{{ asset('/public/admin/products/medium/' . $product->thumbnail_image_1) }}" alt="{{ $product->product_name }}" class="img-responsive">
                                                            </a></figure>
                                                            <header class="item-name">
                                                                <a href="{{ url('web88cms/products/editProduct/' . $product->product_id) }}">{{ $product->product_name }}</a>
                                                            </header>
                                                            <ul>
                                                                @if($product->color_name)
                                                                	<li>Color: {{ $product->color_name }}</li>
                                                                @endif
                                                                @if($product->quantity_in_stock)
                                                                	<li>Availability: <span class="green-title">In Stock</span></li>
                                                                @else
                                                                	<li>Availability: <span class="red-title">Out of Stock</span></li>
                                                                @endif
                                                                @if($product->priority)
                                                                	<li>Color: {{ $product->priority }}</li>
                                                                @endif
                                                            </ul>
                                                        </td>
                                                        <td class="item-code">{{ $product->product_code }}</td>
                                                        <td class="item-price-col"><span class="item-price-special">RM {{ number_format($product->sale_price, 2) }}</span></td>
                                                        <td>1</td>
                                                        <td class="item-total-col"><span class="item-price-special">RM {{ number_format($product->sale_price, 2) }}</span></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
	                            <div class="md-margin"></div>    
                            </div>
                        	<div class="clearfix"></div>
	                        <div class="form-actions text-center"> 
		                        <a href="{{ url('web88cms/customers/view/' . $wishlist->user_id) }}" class="btn btn-dark"><i class="fa fa-angle-double-left"></i> &nbsp;Back</a>
	                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-footer">
	    <div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
	    <div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png') }}" alt="Webqom Technologies Sdn Bhd"></div>
    </div>
    </div>
</div>
@endsection
