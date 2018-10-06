<!DOCTYPE html>
<html lang="en">
<head>
 <title>@yield('title')</title>
<title>
<?php if(!isset($page_title))
		echo 'Mooncakes Admin';
	else
    	echo $page_title;
?>
</title>

<?php
use App\Http\Models\Admin\Orders;
$orderModel = new Orders();
$newOrders = $orderModel->getTotalOrderByStatus('New Order');

use Illuminate\Support\Facades\Route;
$current_route = Route::getCurrentRoute()->getActionName();
?>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link type="text/css" rel="stylesheet" href="{{ asset('/public/icons/font-awesome.min.css') }}">
<link href="{{ asset('/public/admin/images/icons/favicon.ico') }}" rel="shortcut icon">
    <!-- <link href="//fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic%7CPT+Gudea:400,700,400italic%7CPT+Oswald:400,700,300" rel="stylesheet" id="googlefont">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,300,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'> -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7cPlayfair+Display:400,700,900" rel="stylesheet">
 <!--Loading bootstrap css-->
<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/vendors/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/vendors/font-awesome/css/font-awesome.min.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/vendors/bootstrap/css/bootstrap.min.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/vendors/fullcalendar/fullcalendar.css') }}">

<!--LOADING SCRIPTS FOR PAGE-->
<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/vendors/bootstrap-datepicker/css/datepicker.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/vendors/bootstrap-switch/css/bootstrap-switch.css') }}">

    <!--Loading style vendors-->
<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/vendors/animate.css/animate.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/vendors/jquery-pace/pace.css') }}">

<!--Loading style-->
<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/css/style.css') }}">
<!--<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/css/style.css') }}">-->
<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/css/style-mango.css') }}" id="theme-style">
<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/css/vendors.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/css/themes/grey.css') }}" id="color-style">
<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/css/style-responsive.css') }}">

@stack('styles')
<script src="{{ asset('/public/admin/js/jquery-1.9.1.js') }}"></script>

</head>

<style>
    /* for loader which works on each page load */
    .no-js #loader { display: none;  }
    .js #loader { display: block; position: absolute; left: 100px; top: 0; }
    .se-pre-con {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('{{ asset('/public/loader/Preloader_4.gif') }}') center no-repeat #fff;
    }
</style>

<body>
<div class="se-pre-con"></div>
<div class="main-container-custom">
<!--BEGIN TO TOP--><a id="totop" href="#"><i class="fa fa-angle-up"></i></a><!--END BACK TO TOP-->
  <div id="wrapper"><!--BEGIN TOPBAR-->
        <nav id="topbar" role="navigation" style="margin-bottom: 0;" class="navbar navbar-default navbar-static-top">
          <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            <a id="logo" href="http://www.webqom.com/web88.html" target="_blank" class="navbar-brand"><img src="{{ asset('/public/admin/images/logo_web88.png') }}"></a>          </div>

            	<div class="topbar-main">
                	<a id="logo" href="#" class="navbar-brand"><img src="{{ asset('/public/admin/images/logo.jpg') }}"></a>
                    <a id="menu-toggle" href="#" class="btn hidden-xs"><i class="fa fa-bars"></i></a>

                <form id="topbar-search" action="{{ url('/web88cms/searchSite') }}" method="post" class="hidden-sm hidden-xs">
                	<input type="hidden" name="_token" value="{{ csrf_token() }}" >
                    <div class="input-icon right"><a href="javascript:void(0)" onClick="if($('#topbar-search-keyword').val() != ''){ $('#topbar-search').submit() }" ><i class="fa fa-search"></i></a><input type="text" name="keyword" id="topbar-search-keyword" placeholder="Search here..." class="form-control"/></div>
                </form>
                <ul class="nav navbar-top-links navbar-right">
                    <li><a href="{{ url('web88cms/orders') }}?status=New Order" class="dropdown-toggle"><i class="fa fa-shopping-cart fa-fw"></i>
                        <?= ($newOrders ? '<span class="badge badge-blue">' . $newOrders . '</span>' : '<span class="badge badge-blue">0</span>') ?>
                    </a></li>
                    <li class="dropdown"><a data-toggle="dropdown" href="#" class="dropdown-toggle"><img src="<?php echo (Auth::user()->image !='') ? asset("/public/admin/avtar/". Auth::user()->image) : asset("/public/admin/images/profile/image_hock.jpg"); ?>" alt="" class="img-responsive img-circle uploadedAvtar"/>&nbsp;
                        <?php echo Auth::user()->name; ?>
                        &nbsp;<span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-user pull-right animated bounceInLeft">
                            <li>
                                <div class="navbar-content">
                                    <div class="row">
                                        <div class="col-md-5 col-xs-5"><img src="<?php echo (Auth::user()->image !='') ? asset("/public/admin/avtar/". Auth::user()->image) : asset("/public/admin/images/profile/image_hock.jpg"); ?>" alt="" class="img-responsive img-circle uploadedAvtar"/>

                                            <p class="text-center mtm">
                                            	<a href="#" data-target="#modal-change-avatar" data-toggle="modal" class="change-avatar">
                                                <small>Change Avatar</small>                                                </a></p>
                                      </div>
                                        <div class="col-md-7 col-xs-5"><span><?php echo Auth::user()->name; ?></span>

                                            <p class="text-muted small"><?php echo Auth::user()->email; ?></p>

                                            <div class="divider"></div>
                                            <!--<a href="#" class="btn btn-primary btn-sm">View Profile</a>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="navbar-footer">
                                    <div class="navbar-footer-content">
                                        <div class="row">
                                            <div class="col-md-6 col-xs-6"><a href="#" class="btn btn-default btn-sm" data-target="#modal-change-password" data-toggle="modal">Change Password</a></div>
                                            <div class="col-md-6 col-xs-6"><a href="{{ url('/web88cms/logout') }}" class="btn btn-default btn-sm pull-right">Sign Out</a></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                      </ul>
                  </li>
                </ul>
          </div>
        </nav>
        <!--Modal Change Avatar start-->
                            <div id="modal-change-avatar" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                    <h4 id="modal-login-label2" class="modal-title">Change Avatar</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form">
                                      <form class="form-horizontal" id="updateAvtar" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group">
                                          <label class="col-md-4 control-label">Upload Avatar Image </label>
                                          <div class="col-md-8">
                                            <div class="text-15px margin-top-10px">
                                            	<img src="<?php echo (Auth::user()->image !='') ? asset("/public/admin/avtar/". Auth::user()->image) : asset("/public/admin/images/profile/image_hock.jpg"); ?>" alt="Avatar" class="img-responsive uploadedAvtar"><br/>
                                                <input id="exampleInputFile1" type="file" name="avtarImage"/>
                                              <br/>
                                                <span class="help-block">(Image dimension: 100 x 100 pixels, JPEG/GIF/PNG only, Max. 2MB) </span> </div>
                                          </div>
                                        </div>

                                        <div class="form-actions">
                                          <div class="col-md-offset-4 col-md-8"> <a href="#" onClick="updateAvtar(<?php echo Auth::user()->id; ?>)" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                          <!--END MODAL Change Avatar-->

        <!--Modal Change Password start-->
                <div id="modal-change-password" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                <h4 id="modal-login-label" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Change Password</h4></div>
                            <div class="modal-body">
                                <div class="form">
                                    <form class="form-horizontal" id="updatePassword" >
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group">
                                        	<label for="password" class="control-label col-md-4">New Password</label>

                                            <div class="col-md-8">
                                            	<div class="input-icon"><i class="fa fa-key"></i> <input id="password" type="password" name="password" placeholder="New Password" class="form-control"/><span class="text-10px">(Password length should be between 6-12 characters)</span>                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                        	<label for="password" class="control-label col-md-4">Confirm New Password</label>

                                            <div class="col-md-8">
                                            	<div class="input-icon"><i class="fa fa-key"></i> <input id="password" type="password" name="password_confirmation" placeholder="Confirm New Password" class="form-control"/><span class="text-10px">(Password length should be between 6-12 characters)</span>                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="col-md-offset-4 col-md-8">
                                               <a href="#" onClick="updatePassword(<?php echo Auth::user()->id; ?>)" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp;
                                              <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a>                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <!--END MODAL CHANGE PASSWORD-->
        <!--END TOPBAR-->

        <!--BEGIN SIDEBAR MENU-->
        <!--<nav id="sidebar" role="navigation" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
                    <li class="clock"><strong id="get-date"></strong>

                        <div class="digital-clock">
                            <div id="getHours" class="get-time"></div>
                            <span>:</span>

                            <div id="getMinutes" class="get-time"></div>
                            <span>:</span>

                            <div id="getSeconds" class="get-time"></div>
                        </div>
                    </li>
                    <li class="sidebar-heading"><h4>CMS Pages</h4></li>
                    <li><a href="dashboard.html"><i class="fa fa-laptop fa-fw"></i><span class="menu-title">Dashboard</span></a></li>

                  <li><a href="{{ url('/about_us_edit') }}"><i class="fa fa-user fa-fw"></i><span class="menu-title">About Us</span></a> </li>
                  <li><a href="#"><i class="fa fa-briefcase fa-fw"></i><span class="menu-title">Careers</span><span class="fa arrow"></span></a>
                      <ul class="nav nav-second-level">
                          <li><a href="careers_job_vacancy_list.html">Vacancies Listing</a></li>
                          <li><a href="careers_online_applicants_list.html">Online Applicants Listing</a></li>
                      </ul>
                  </li>
                  <li><a href="services_edit.html"><i class="fa fa-tags fa-fw"></i><span class="menu-title">Our Services</span></a> </li>
                  <li><a href="our_stores_edit.html"><i class="fa fa-map-marker fa-fw"></i><span class="menu-title">Our Stores</span></a> </li>
                  <li><a href="contact_us_edit.html"><i class="fa fa-phone fa-fw"></i><span class="menu-title">Contact Us &amp; Feedback</span></a> </li>
                  <li><a href="newsletter_subscription_list.html"><i class="fa fa-envelope fa-fw"></i><span class="menu-title">Newsletter Subscription</span></a> </li>
                    <li class="sidebar-heading"><h4>Orders</h4></li>
                    <li><a href="#"><i class="fa fa-shopping-cart fa-fw"></i><span class="menu-title">Orders</span><span class="fa arrow"></span><span class="badge badge-blue">3</span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="orders_list.html">View All Orders</a></li>
							<li><a href="shipments_list.html">View All Shipments</a></li>
                        </ul>
                  </li>
                    <li class="sidebar-heading"><h4>Customers</h4></li>
                    <li><a href="administrators_list.html"><i class="fa fa-cog fa-fw"></i><span class="menu-title">Administrators</span></a> </li>
					<li><a href="customers_list.html"><i class="fa fa-user fa-fw"></i><span class="menu-title">Customers</span></a></li>
                    <li><a href="user_groups_list.html"><i class="fa fa-users fa-fw"></i><span class="menu-title">User Groups</span></a></li>

                    <li class="sidebar-heading"><h4>Products</h4></li>
                    <li><a href="categories_list.html"><i class="fa fa-cog fa-fw"></i><span class="menu-title">Categories</span></a> </li>
					<li><a href="products_list.html"><i class="fa fa-user fa-fw"></i><span class="menu-title">Products</span></a></li>
                    <li><a href="filters_list.html"><i class="fa fa-user fa-fw"></i><span class="menu-title">Filters</span></a></li>

                    <li class="sidebar-heading"><h4>Promotions</h4></li>
                    <li><a href="global_discounts_list.html"><i class="fa fa-cog fa-fw"></i><span class="menu-title">Global Discounts</span></a> </li>
					<li><a href="promo_codes_list.html"><i class="fa fa-user fa-fw"></i><span class="menu-title">Promo Codes / Global Coupons</span></a></li>

                    <li class="sidebar-heading"><h4>Banners</h4></li>
                    <li><a href="#"><i class="fa fa-check-circle fa-fw"></i><span class="menu-title">Index Banners</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="index_banner_top_list.html">Top Banner</a></li>
							<li><a href="index_middle_top_list.html">Middle Top Banner</a></li>
                            <li class="active"><a href="index_middle_bottom_list.html">Middle Bottom Banner</a></li>
                        </ul>
                    </li>
                    <li><a href="left_banner_list.html"><i class="fa fa-check-circle fa-fw"></i><span class="menu-title">Left Banners</span></a></li>
					<li><a href="left_promotion_banner_list.html"><i class="fa fa-check-circle fa-fw"></i><span class="menu-title">Left Promotion Banners</span></a></li>
                    <li><a href="product_banner_list.html"><i class="fa fa-check-circle fa-fw"></i><span class="menu-title">Product Banners</span></a></li>

                    <li class="sidebar-heading"><h4>Global Settings</h4></li>
                    <li><a href="header_setup.html"><i class="fa fa-check-circle fa-fw"></i><span class="menu-title">Header Setup</span></a></li>
                    <li><a href="footer_setup.html"><i class="fa fa-check-circle fa-fw"></i><span class="menu-title">Footer Setup</span></a></li>
                    <li><a href="bottom_animated_services_list.html"><i class="fa fa-cogs fa-fw"></i><span class="menu-title">Animated Services Icons</span></a></li>
              </ul>
          </div>
    </nav>-->
    	<nav id="sidebar" role="navigation" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
                    <li class="clock"><strong id="get-date"></strong>

                        <div class="digital-clock">
                            <div id="getHours" class="get-time"></div>
                            <span>:</span>

                            <div id="getMinutes" class="get-time"></div>
                            <span>:</span>

                            <div id="getSeconds" class="get-time"></div>
                        </div>
                    </li>
                    <li @if(Request::path() == 'web88cms/dashboard') class="active" @endif><a href="{{ url('/web88cms/dashboard/') }}"><i class="fa fa-laptop fa-fw"></i><span class="menu-title">Dashboard</span></a></li>

                    <li class="sidebar-heading"><h4>Bookings</h4></li>
                    <li @if(Request::path() == 'web88cms/orders/shipmentsList' || Request::path() == 'web88cms/orders' ) class="active" @endif ><a href="#"><i class="fa fa-shopping-cart fa-fw"></i><span class="menu-title">Bookings</span>
                    		<span class="fa arrow"></span>
                        	<?= ($newOrders ? '<span class="badge badge-blue" onClick="window.open(\'/web88cms/orders?status=New Order\',\'_self\')">' . $newOrders . '</span>' : '<span class="badge badge-blue" onClick="window.open(\'/web88cms/orders?status=New Order\',\'_self\')">0</span>') ?>
                        </a>

                        <ul @if(Request::path() == 'web88cms/orders/shipmentsList' || Request::path() == 'web88cms/orders' || Request::path() == 'web88cms/checkInOut') class="nav nav-second-level collapse in" style="height: auto;" @else class="nav nav-second-level collapse" @endif>
                            <li @if(Request::path() == 'web88cms/orders') class="active" @endif><a href="{{ url('web88cms/orders') }}">View All Bookings</a></li>
                            <li @if(Request::path() == 'web88cms/checkInOut' ) class="active" @endif ><a href="{{ url('web88cms/checkInOut') }}">Checking In/Out Listing</a></li>
							<!-- <li @if(Request::path() == 'web88cms/orders/shipmentsList') class="active" @endif><a href="{{ url('web88cms/orders/shipmentsList') }}">View All Shipments</a></li> -->
                        </ul>
                  </li>
                    <li class="sidebar-heading"><h4>Customers</h4></li>
                    <li @if(Request::path() == 'web88cms/administrators') class="active" @endif><a href="{{ url('web88cms/administrators/?0=&page=1') }}"><i class="fa fa-cog fa-fw"></i><span class="menu-title">Administrators</span></a> </li>
					<li @if(Request::path() == 'web88cms/customers') class="active" @endif><a href="{{ url('web88cms/customers') }}"><i class="fa fa-user fa-fw"></i><span class="menu-title">Customers</span></a></li>
                    <li @if(Request::path() == 'web88cms/usergroups') class="active" @endif><a href="{{ url('/web88cms/usergroups') }}"><i class="fa fa-users fa-fw"></i><span class="menu-title">User Groups</span></a></li>

                    <li class="sidebar-heading"><h4>Services</h4></li>
                    <li @if(Request::path() == 'web88cms/categories/list'|| Request::path() == 'web88cms/categories/category_home_products_list'|| preg_match('/categoryhomelist/',$current_route)) class="active" @endif> <a href="{{ url('/web88cms/categories/list/') }}"><i class="fa fa-cog fa-fw"></i><span class="menu-title">Categories</span></a> </li>
					<li @if(preg_match('/ProductsController/',$current_route)) class="active" @endif><a href="{{ url('/web88cms/products/list/') }}"><i class="fa fa-wrench fa-fw"></i><span class="menu-title">Services</span></a></li>
                    <!-- <li @if(preg_match('/FiltersController/',$current_route)) class="active" @endif><a href="{{ url('/web88cms/filters/list/') }}"><i class="fa fa-filter fa-fw"></i><span class="menu-title">Filters</span></a></li>
                    <li @if(preg_match('/BrandsController/',$current_route)) class="active" @endif><a href="{{ url('/web88cms/brands/list/') }}"><i class="fa fa-list fa-fw"></i><span class="menu-title">Brands Setup</span></a></li>
                    <li @if(preg_match('/ColorsController/',$current_route)) class="active" @endif><a href="{{ url('/web88cms/colors/list/') }}"><i class="fa fa-pencil fa-fw"></i><span class="menu-title">Colors Setup</span></a></li>
					
			
                    <li @if(Request::path() == 'web88cms/prdouctglobalsetup') class="active" @endif ><a href="{{ url('/web88cms/prdouctglobalsetup') }}"><i class="fa fa-pencil fa-fw"></i><span class="menu-title">Product Global Setup</span></a></li>
					
                    <li @if(preg_match('/NotifyController/',$current_route)) class="active" @endif><a href="{{ url('/web88cms/notify') }}"><i class="fa fa-info-circle fa-fw"></i><span class="menu-title">Notification Requests</span></a></li> -->

					<!-- <li class="sidebar-heading"><h4>Shipping Setup</h4></li>
					<li @if(Request::path() == 'web88cms/shipping_method/csv') class="active" @endif><a href="{{ route('ship.index', 'csv') }}"><i class="fa fa-truck fa-fw"></i><span class="menu-title">CSV Import</span></a></li>
					<li @if(Request::path() == 'web88cms/shipping_method/category') class="active" @endif><a href="{{ route('ship.index', 'category') }}"><i class="fa fa-bars fa-fw"></i><span class="menu-title">By Product Category</span></a></li>
					<li @if(Request::path() == 'web88cms/shipping_method/weight') class="active" @endif><a href="{{ route('ship.index', 'weight') }}"><i class="fa fa-cube fa-fw"></i><span class="menu-title">By Total Weight of Products</span></a></li>
					<li @if(Request::path() == 'web88cms/shipping_method/amount') class="active" @endif><a href="{{ route('ship.index', 'amount') }}"><i class="fa fa-dollar fa-fw"></i><span class="menu-title">By Total Order Amount</span></a></li> -->

                    <li class="sidebar-heading"><h4>Promotions</h4></li>
                   	<li @if(Request::path() == 'web88cms/promotions/globalDiscounts') class="active" @endif><a href="{{ url('/web88cms/promotions/globalDiscounts') }}"><i class="fa fa-cog fa-fw"></i><span class="menu-title"> Global Discounts</span></a></li>
					<li @if(Request::path() == 'web88cms/promocodes') class="active" @endif><a href="{{ url('/web88cms/promocodes/?0=&page=1') }}"><i class="fa fa-qrcode fa-fw"></i><span class="menu-title">Promo Codes</span></a></li>
	                <li @if(Request::path() == 'web88cms/newsletter') class="active" @endif><a href="{{ url('/web88cms/newsletter') }}"><i class="fa fa-envelope fa-fw"></i><span class="menu-title">Newsletter Subscription</span></a> </li>

                    <li class="sidebar-heading"><h4>Banners</h4></li>
                    <li @if(Request::path() == 'web88cms/index_banner_top_list') class="active" @endif  <?php if(Request::path() == 'web88cms/categories/list'){ ?> onClick="if(document.getElementById('child').style.display=='none'){document.getElementById('child').style.display='block'}else{document.getElementById('child').style.display='none';}" <?php }?>>
                    	<a style="cursor:pointer;"><i class="fa fa-check-circle fa-fw"></i><span class="menu-title">Index Banners</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level" id="child" <?php if(Request::path() == 'web88cms/categories/list'){ echo 'style=display:none';}?>>
                            <li @if(Request::path() == 'web88cms/index_banner_top_list') class="active" @endif><a href="{{ url('/web88cms/index_banner_top_list') }}">Top Banner</a></li>
							<!-- <li @if(Request::path() == 'web88cms/index_middle_top_list') class="active" @endif><a href="{{ url('/web88cms/index_middle_top_list') }}">Middle Top Banner</a></li>
                            <li @if(Request::path() == 'web88cms/index_middle_bottom_list') class="active" @endif><a href="{{ url('/web88cms/index_middle_bottom_list') }}">Middle Bottom Banner</a></li> -->
                        </ul>
                    </li>
                    <li @if(Request::path() == 'web88cms/left_banner_list') class="active" @endif><a href="{{ url('/web88cms/left_banner_list') }}"><i class="fa fa-check-circle fa-fw"></i><span class="menu-title">Sub Page Banners</span></a></li>
                    <!-- <li @if(Request::path() == 'web88cms/left_banner_list') class="active" @endif><a href="{{ url('/web88cms/left_banner_list') }}"><i class="fa fa-check-circle fa-fw"></i><span class="menu-title">Left Banners</span></a></li>
					<li @if(Request::path() == 'web88cms/left_promotion_banner_list') class="active" @endif><a href="{{ url('/web88cms/left_promotion_banner_list') }}"><i class="fa fa-check-circle fa-fw"></i><span class="menu-title">Left Promotion Banners</span></a></li>
                    <li @if(Request::path() == 'web88cms/product_banner_list') class="active" @endif><a href="{{ url('/web88cms/product_banner_list') }}"><i class="fa fa-check-circle fa-fw"></i><span class="menu-title">Product Banners</span></a></li>

                    <li class="sidebar-heading"><h4>Global Settings</h4></li>
                    <li @if(Request::path() == 'web88cms/globalsettings') class="active" @endif><a href="{{ url('/web88cms/globalsettings') }}"><i class="fa fa-caret-square-o-down fa-fw"></i><span class="menu-title">Open or Close</span></a></li> -->
                    <li class="sidebar-heading"><h4>Inquiries</h4></li>
                    <li @if(preg_match('/NotifyController/',$current_route)) class="active" @endif><a href="{{ url('/web88cms/notify') }}"><i class="fa fa-pencil-square fa-fw"></i><span class="menu-title">Notification Requests</span></a></li>
                    
                    <li class="sidebar-heading"><h4>Global Setup</h4></li>
                    <li><a href="{{ url('/web88cms/indexPopup') }}"><i class="fa fa-check-circle"></i><span class="menu-title">Index Pop Up</span></a></li>
                    <li><a href="{{ url('/web88cms/onScreenMessages') }}"><i class="fa fa-check-circle"></i><span class="menu-title">On-Screen Messages</span></a></li>
                    <li @if(preg_match('/GstratesController/',$current_route)) class="active" @endif><a href="{{ url('/web88cms/gstrates') }}"><i class="fa fa-cog fa-fw"></i><span class="menu-title">GST Rate</span></a></li>
              </ul>
          </div>
    </nav>
        <!--END SIDEBAR MENU-->

		<!--BEGIN PAGE WRAPPER-->

        @yield('content')

 		<!--END PAGE WRAPPER-->
	</div>
</div>

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
<script src="{{ asset('/public/admin/vendors/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

<!--<script src="{{ URL::asset('public/admin/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/moment/moment.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/bootstrap-clockface/js/clockface.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/jquery-maskedinput/jquery-maskedinput.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/form-components.js') }}"></script>

<script src="{{ URL::asset('public/admin/vendors/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/ckeditor/ckeditor.js') }}"></script>

<script src="{{ URL::asset('public/admin/js/ui-tabs-accordions-navs.js') }}"></script>-->
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

<!-- InstanceBeginEditable name="EditRegion4" -->
{{-- <script src="{{ asset('/public/admin/vendors/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{ asset('/public/admin/vendors/datatables/js/dataTables.bootstrap.js')}}"></script>
<script src="{{ asset('/public/admin/vendors/datatables/js/jquery.jeditable.js')}}"></script>
<script src="{{ asset('/public/admin/js/table-editable.js')}}"></script> --}}
<!-- InstanceEndEditable -->

<!--CORE JAVASCRIPT-->

<script src="{{ asset('/public/admin/js/main.js') }}"></script>
<script src="{{ asset('/public/admin/js/holder.js') }}"></script>
<script src="{{ asset('/public/admin/js/functions.js') }}"></script>
<script type="text/javascript">
    // Wait for window load
    $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
    });
</script>
@stack('scripts')
</body>
</html>