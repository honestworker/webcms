@extends('adminBannerLayout')
@section('title', 'View All Bookings')
@section('content')
<?php
	$ordersModel = new App\Http\Models\Admin\Orders();

//dd($order, $orderTax);
?>
<div id="page-wrapper">
	<div class="page-header-breadcrumb">
		<div class="page-heading hidden-xs">
			<h1 class="page-title">Orders</h1>
		</div>

        <ol class="breadcrumb page-breadcrumb">
    	    <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('web88cms/dashboard') }}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
        	<li>Orders &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li><a href="{{ url('web88cms/orders') }}">Orders Listing</a> &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
        	<li class="active">View Selected Orders</li>
        </ol>
	</div>

    <div class="page-content">
      <div class="row">
          <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-body">
                        <table class="table checkout-table table-responsive">
                            <thead>
                                <tr>
                                    <th class="table-title">Order Id</th>
                                    <th class="table-title">Login/E-mail</th>
                                    <th class="table-title">Customer Name</th>
                                    <th class="table-title">Product Id</th>
                                    <th class="table-title">Product Name</th>
                                    <th class="table-title" style="text-align: right;">Qty</th>
                                    <th class="table-title" style="text-align: right;">Unit Price (RM)</th>
                                    <th class="table-title" style="text-align: right;">SST (RM)</th>
                                    <th class="table-title" style="text-align: right;">Total (RM)</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($orders as $orderProduct)
                                    <tr>
                                        <td class="item-code">{{ $orderProduct->id }}</td>
                                        <td class="item-code">{{ $orderProduct->tax->billing_email }}</td>
                                        <td class="item-code">{{ $orderProduct->tax->billing_last_name }} {{ $orderProduct->tax->billing_first_name }}</td>
                                        <td class="item-code">{{ $orderProduct->room_code }}</td>
                                        <td class="item-name-col">
                                            <figure><a href="{{ url('web88cms/products/editProduct/' . $orderProduct->product_id) }}">
                                              <img src="{{ asset('/public/admin/products/medium/' . $orderProduct->thumbnail_image_1) }}" alt="{{ $orderProduct->type }}" class="img-responsive">
                                            </a></figure>
                                            <header class="item-name">
                                                <a href="{{ url('web88cms/products/editProduct/' . $orderProduct->product_id) }}">{{ $orderProduct->type }}</a>
                                                @if (!is_null($orderProduct->pwp_price))
                                                <span class="pwp-item">PWP ITEM</span>
                                                @endif
                                            </header>
                                            <ul>
                                              @if($orderProduct->color_name)
                                                <li>Color: {{ $orderProduct->color_name }}</li>
                                              @endif

                                              @if($orderProduct->event_type)
                                                  <li><i class="fa fa-gift text-red"></i> <span class="text-red"><b>For: {{ $orderProduct->event_type }}</b></span></li>
                                              @endif
                                            </ul>
                                        </td>
                                        <td align="right">{{ $orderProduct->quantity }}</td>
                                        <td class="item-price-col" align="right"><span class="item-price-special">
                                        @if (is_null($orderProduct->pwp_price))
                                        {{ number_format($orderProduct->amount, 2) }}
                                        @else
                                        {{ number_format($orderProduct->pwp_price, 2) }}
                                        @endif
                                        </span></td>
                                        <td class="item-total-col" align="right"><span class="item-price-special">{{ number_format($orderProduct->tax->tax, 2) }}</span></td>
                                        <td class="item-total-col" align="right"><span class="item-price-special">{{ number_format($orderProduct->tax->subtotal + $orderProduct->tax->tax, 2) }}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="border: none; text-align: right;" colspan="6">Total:</td>
                                        <td></td>
                                        <td align="right">{{ number_format($orderProduct->tax->tax, 2) }}</td>
                                        <td align="right">{{ number_format($orderProduct->tax->subtotal + $orderProduct->tax->tax, 2) }}</td>
                                    </tr>
                                @endforeach


                            </tbody>

                        </table>
                      <div class="clearfix"></div>
                    </div>
                </div>
          </div>
        </div>
    </div>



	<div class="page-footer">
		<div class="copyright">
        	<span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
			<div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png') }}" alt="Webqom Technologies Sdn Bhd"></div>
		</div>
	</div>
</div>
<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">

<script src="{{ asset('/public/admin/js/jquery-1.9.1.js') }}"></script>
<script src="{{ asset('/public/admin/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ asset('/public/admin/js/jquery-ui.js') }}"></script>
<!--loading bootstrap js-->
<script src="{{ asset('/public/admin/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js') }}"></script>
<script src="{{ asset('/public/admin/js/html5shiv.js') }}"></script>
<script src="{{ asset('/public/admin/js/respond.min.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/slimScroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/jquery-cookie/jquery.cookie.js') }}"></script>
<script src="{{ asset('/public/admin/js/jquery.menu.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/jquery-pace/pace.min.js') }}"></script>

<!--LOADING SCRIPTS FOR PAGE-->
<script src="{{ asset('/public/admin/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/moment/moment.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-clockface/js/clockface.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/jquery-maskedinput/jquery-maskedinput.js') }}"></script>
<script src="{{ asset('/public/admin/js/form-components.js') }}"></script>
<!--LOADING SCRIPTS FOR PAGE-->

<script src="{{ asset('/public/admin/vendors/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('/public/admin/js/ui-tabs-accordions-navs.js') }}"></script>

<!--CORE JAVASCRIPT-->
<script src="{{ asset('/public/admin/js/main.js') }}"></script>
<script src="{{ asset('/public/admin/js/holder.js') }}"></script>



@endsection
