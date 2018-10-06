@extends('adminBannerLayout')
@section('title', 'View All Bookings')
@section('content')
<div id="page-wrapper">
	<div class="page-header-breadcrumb">
		<div class="page-heading hidden-xs">
			<h1 class="page-title">Orders</h1>
		</div>

        <ol class="breadcrumb page-breadcrumb">
    	    <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('web88cms/dashboard') }}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
        	<li>Orders &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
        	<li class="active">View All Orders - Listing</li>
        </ol>
	</div>

    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
	            <h2>View All Orders <i class="fa fa-angle-right"></i> Listing</h2>
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

                @if ($last_updated)
	                <div class="pull-left"> Last updated: <span class="text-blue">{{ $last_updated }}</span> </div>
    	            <div class="clearfix"></div>
        	        <p></p>
                @endif

                <div class="clearfix"></div>
            </div>

            <div class="col-md-6">
                <div class="portlet portlet-blue">
                    <div class="portlet-header">
                    	<div class="caption text-white">Search Orders By Date</div>
                    </div>

                    <div class="portlet-body">
                        <form class="form-horizontal">
                            <div class="form-group">
	                            <label class="col-md-4 control-label">Order Date</label>
                                <div class="col-md-8">
                                	<div class="input-group input-daterange">
	        	                        <input type="text" name="order_from" class="form-control" required data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="{{ Input::get('order_from') }}" />
	    	                            <span class="input-group-addon">to</span>
		                                <input type="text" name="order_to" class="form-control" required data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="{{ Input::get('order_to') }}" />
	                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                            	<label class="col-md-4 control-label">Customer Name </label>
	                            <div class="col-md-8">
    		                        <input type="text" name="customer_name" value="{{ Input::get('customer_name') }}" class="form-control">
            	                </div>
                            </div>

                            <div class="form-group">
                            	<label class="col-md-4 control-label">Order Status </label>
	                            <div class="col-md-8">
    		                        <select name="status" class="form-control">
            			                <option <?= (Input::get('status') == 'New Order' ? 'selected="selected"' :'') ?>>New Order</option>
                                        <option <?= (Input::get('status') == 'Ready To Ship' ? 'selected="selected"' :'') ?>>Ready To Ship</option>
                                        <option <?= (Input::get('status') == 'Shipped' ? 'selected="selected"' :'') ?>>Shipped</option>
                                        <option <?= (Input::get('status') == 'Cancelled' ? 'selected="selected"' :'') ?>>Cancelled</option>
                                        <option <?= (Input::get('status') == 'Declined' ? 'selected="selected"' :'') ?>>Declined</option>
                                        <option <?= (Input::get('status') == 'Completed' ? 'selected="selected"' :'') ?>>Completed</option>
                                    </select>
                            	</div>
                            </div>

                            <div class="form-group">
                            	<label class="col-md-4 control-label">Payment Status </label>
	                            <div class="col-md-8">
    		                        <select name="payment_status" class="form-control">
			                            <option <?= (Input::get('payment_status') == 'Paid' ? 'selected="selected"' :'') ?>>Paid</option>
                                        <option <?= (Input::get('payment_status') == 'Payment Error' ? 'selected="selected"' :'') ?>>Payment Error</option>
                                        <option <?= (Input::get('payment_status') == 'Cancelled' ? 'selected="selected"' :'') ?>>Cancelled</option>
                                    </select>
	                            </div>
                            </div>
                            <div class="form-actions text-center">
                            	<button type="submit" class="btn btn-red">Search &nbsp;<i class="fa fa-search"></i></button>
                           </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="portlet portlet-blue">
                    <div class="portlet-header">
                    	<div class="caption text-white">Search Orders By Order ID</div>
                    </div>
	                <div class="portlet-body">
    	            <form class="form-horizontal">
        		        <div class="form-group">
            		    	<label class="col-md-4 control-label">Order ID </label>
                			<div class="col-md-8">
				                <input type="text" required name="order_id" value="{{ Input::get('order_id') }}" class="form-control">
			                </div>
            		    </div>
		                <div class="form-actions text-center">
                        	<button type="submit" class="btn btn-red">Search &nbsp;<i class="fa fa-search"></i></button>
                        </div>
        	        </form>
                </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-header">
                    	<div class="caption">Orders Listing</div>
	                    <br/>
    	                <p class="margin-top-10px"></p>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Bulk Actions</button>
                            <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="#" onclick="print_inivoice()">Invoice bulk print</a></li>
                                {{--<li><a href="#">Packing slip bulk print</a></li>--}}
                                <li><a href="#" onclick="view_purchased_services()">View purchased services</a></li>
                                <li class="divider"></li>
                                <li><a href="#" onclick="deleteSelected()">Delete selected item(s)</a></li>
                                <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                            </ul>
                        </div>
                      	<a href="{{ url('web88cms/orders/csv') }}" class="btn btn-blue">Export to CSV &nbsp;<i class="fa fa-share"></i></a>  

                    	<div class="tools"> <i class="fa fa-chevron-up"></i> </div>

                        <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    	<button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
	                                    <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                                    </div>
	                                <div class="modal-body">
                                        <div class="form-actions">
                                            <div class="col-md-offset-4 col-md-8">
                                                <a href="#" onclick="deleteOrders($(this), 'selected')" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp;
                                                <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a>
                                            </div>
                                        </div>
                                	</div>
                                </div>
                            </div>
                        </div>
                        <div id="modal-delete-not-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    	<button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
	                                    <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                                    </div>
	                                <div class="modal-body">
                                        <div class="alert alert-danger">
                                            Please select at least one order for delete.
                                        </div>
                                        <div class="form-actions">
                                            <div class="col-md-offset-4 col-md-8">
                                                <a href="#" data-dismiss="modal" class="btn btn-green">OK &nbsp;<i class="fa fa-times-circle"></i></a>
                                            </div>
                                        </div>
                                	</div>
                                </div>
                            </div>
                        </div>

                        <div id="modal-delete-all" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    	<button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                    	<h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                                    </div>

                                    <div class="modal-body">
		                                <div class="form-actions">
        			                        <div class="col-md-offset-4 col-md-8">
                                            	<a href="#" onclick="deleteOrders($(this), 'all')" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp;
                                                <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a>
                                            </div>
		                                </div>
        	                        </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="portlet-body">
                        <div class="form-inline pull-left">
                            <div class="form-group">
                                <select name="select_per_page" class="form-control">
                                    <option <?= ($limit == 10 ? 'selected="selected"' : ''); ?> value="10">10</option>
                                    <option <?= ($limit == 20 ? 'selected="selected"' : ''); ?> value="20">20</option>
                                    <option <?= ($limit == 30 ? 'selected="selected"' : ''); ?> value="30">30</option>
                                    <option <?= ($limit == 50 ? 'selected="selected"' : ''); ?> value="50">50</option>
                                    <option <?= ($limit == 100 ? 'selected="selected"' : ''); ?> value="100">100</option>
                                </select>
                                &nbsp;
                                <label class="control-label">Records per page</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <br/>

                        <div class="table-responsive mtl">
													<form action="" method="post" id="multi-data">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <table id="example1" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th width="1%"><input type="checkbox" onclick="$('input[type=checkbox]').prop('checked', $(this).is(':checked'))" /></th>
                                        <th>#</th>
                                        @if ($sort_by == 'order_id' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=order_id&sort=DESC'; ?>">Order ID</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=order_id&sort=ASC'; ?>">Order ID</a></th>
                                        @endif

                                        @if ($sort_by == 'createdate' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=createdate&sort=DESC'; ?>">Order Date</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=createdate&sort=ASC'; ?>">Order Date</a></th>
                                        @endif

                                        @if ($sort_by == 'billing_email' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=billing_email&sort=DESC'; ?>">Login/E-mail</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=billing_email&sort=ASC'; ?>">Login/E-mail</a></th>
                                        @endif

                                        @if ($sort_by == 'name' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=name&sort=DESC'; ?>">Customer Name</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=name&sort=ASC'; ?>">Customer Name</a></th>
                                        @endif

                                        @if ($sort_by == 'totalPrice' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=totalPrice&sort=DESC'; ?>">Amount</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=totalPrice&sort=ASC'; ?>">Amount</a></th>
                                        @endif

                                        @if ($sort_by == 'status' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=status&sort=DESC'; ?>">Order Status</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=status&sort=ASC'; ?>">Order Status</a></th>
                                        @endif

                                        @if ($sort_by == 'payment_status' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=payment_status&sort=DESC'; ?>">Payment Status</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=payment_status&sort=ASC'; ?>">Payment Status</a></th>
                                        @endif

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@if($orders)
                                      	@foreach($orders as $order)
                                            <tr>
                                                <td><input name="order_id[]" class="chk-order" value="{{ $order->id }}" type="checkbox"/></td>
                                                <td>{{ $order->id }}</td>
                                                <td><a href="{{ url('web88cms/orders/detail/' . $order->id) }}">{{ (strlen($order->order_id) > 17)?substr($order->order_id , 0 , 17).'...':$order->order_id }}</a></td>
                                                <td>{{ date('dS M, Y', strtotime($order->createdate)) }}</td>
                                                <td><a href="{{ url('web88cms/orders/detail/' . $order->id) }}">{{ $order->billing_email }}</a></td>
                                                <td>{{ $order->billing_first_name }} {{ $order->billing_last_name }}</td>
<?php
	$ordersModel = new App\Http\Models\Admin\Orders();
	$orderTax = $ordersModel->getOrderTax($order->id);
//dd($order, $orderTax);
?>
                                                <td>RM RM {{ number_format($order->totalPrice,2) }}</td>

                                                <td align="center">
                                                    @if($order->status == 'Processing')
	                                                    <span class="label label-sm label-info">Processing</span>
                                                    @elseif($order->status == 'New Order')
    	                                                <span class="label label-sm label-warning"><i class="fa fa-star"></i>&nbsp; New Order</span>
                                                    @elseif($order->status == 'Ready To Ship')
        	                                            <span class="label label-sm label-info">Ready To Ship</span>
                                                    @elseif($order->status == 'Shipped')
            	                                        <span class="label label-sm label-blue">Shipped</span>
                                                    @elseif($order->status == 'Completed')
                	                                    <span class="label label-sm label-success">Completed</span>
                                                    @elseif($order->status == 'Declined')
                    	                                <span class="label label-sm label-red">Declined</span>
                                                    @elseif($order->status == 'Cancelled')
                        	                            <span class="label label-sm label-primary">Cancelled</span>
                                                    @endif
                                                </td>

                                                <td align="center">
                                                    @if($order->payment_status == 'Paid')
	                                                    <span class="label label-sm label-success">Paid</span>
                                                    @elseif($order->status == 'Processing')
    	                                                <span class="label label-sm label-info">Processing</span>
                                                    @elseif($order->payment_status == 'Payment Error')
        	                                            <span class="label label-sm label-red">Payment Error</span>
                                                    @elseif($order->payment_status == 'Cancelled')
            	                                        <span class="label label-sm label-primary">Cancelled</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('web88cms/orders/detail/' . $order->id) }}" data-hover="tooltip" data-placement="top" title="View Details"><span class="label label-sm label-yellow"><i class="fa fa-search"></i></span></a>
                                                    <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-{{ $order->id }}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>

                                                    <!--Modal delete start-->
                                                    <div id="modal-delete-{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                	<button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                                	<h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this order? </h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                	<p><strong>#{{ $order->id }}:</strong> {{ $order->order_id }} / {{ $order->billing_first_name }} {{ $order->billing_last_name }}</p>
	                                                                <div class="form-actions">
    		                                                            <div class="col-md-offset-4 col-md-8">
			                                                                <a href="{{ url('web88cms/orders/deleteOrder/' . $order->id) }}?redirect=<?php echo urlencode($curr_url); ?>" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp;
			                                                                <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a>
                                                                        </div>
		                                                            </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- modal delete end -->
                                                </td>
                                            </tr>
                                        @endforeach
                                      @else
                                      	<tr>
                                        	<td colspan="10">No records availabel</td>
                                        </tr>
                                      @endif
                                </tbody>
                                <tfoot>
                                    <tr>
	                                    <td colspan="10"></td>
                                    </tr>
                                </tfoot>
                            </table>
													</form>
                            <div class="tool-footer text-right">
                                <p class="pull-left"><?= $paginate_msg; ?></p>
	                            <?php echo $orders->appends($_GET)->render() ?>
                            </div>
                        	<div class="clearfix"></div>
                        </div>
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

<script>
$(function(){
	$('select[name="select_per_page"]').change(function(){
		<?php if($_SERVER['QUERY_STRING']){ ?>
			window.location = '<?= url("web88cms/orders"); ?>/' + $(this).val() + "?<?= $_SERVER['QUERY_STRING']; ?>";
		<?php }else{ ?>
			window.location = '<?= url("web88cms/orders"); ?>/' + $(this).val();
		<?php } ?>
	});
})
function view_purchased_services()
{
	$('#multi-data').attr("action", "{{ url('web88cms/orders/viewPurchasedService') }}");
	$('#multi-data').submit();
	// $.ajax({
	// 	url: "{{ url('web88cms/orders/viewPurchasedService') }}",
	// 	type: 'POST',
	// 	data:  $('#multi-data').serialize(),
	// 	dataType: 'json',
	// 	async: false,
	// 	cache: false,
	// 	beforeSend:function (){
	//
	// 	},
	// 	complete: function(){
	//
	// 	},
	// 	success: function (response) {
	// 		if(response['success'])
	// 		{
	// 			//window.location.reload();
	// 			console.log('success');
	// 		}
	// 	}
	// });
}
function print_inivoice()
{
	$("input:checked").each(function() {
      //var label = $(this).next();
			//console.log($(this).val());
			var url = "{{ url('web88cms/orders/invoice/') }}" + "/" + $(this).val();
			console.log(url);
			window.open( url, '_blank');
		});
}
function deleteSelected(){
	values = $('.chk-order:checked');
	if (values.length==0){
        $('#modal-delete-not-selected').modal('show');
		return false;
	}
	$('#modal-delete-selected').modal('show');
}
function deleteOrders(obj, type){
	if(type == 'selected'){
		values = $('.chk-order:checked, #_token');
	}
	else{
		values = $('.chk-order, #_token');
	}

	var total = values.length;
	if(total > 1){
		$.ajax({
			url: "{{ url('web88cms/orders/deleteAllOrder') }}",
			type: 'POST',
			data: values,
			dataType: 'json',
			async: false,
			cache: false,
			beforeSend:function (){
				obj.html('Deleting... <i class="fa fa-check"></i>');
			},
			complete: function(){
				obj.html('Yes <i class="fa fa-check"></i>');
			},
			success: function (response) {
				if(response['success'])
				{
					window.location.reload();
				}
			}
		});
	}
	else{
		alert('Please select at least one order before delete.');
	}
}
</script>
@endsection
