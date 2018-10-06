@extends('adminBannerLayout')
@section('content')
<div id="page-wrapper">
	<div class="page-header-breadcrumb">
		<div class="page-heading hidden-xs">
			<h1 class="page-title">Orders</h1>
		</div>

        <ol class="breadcrumb page-breadcrumb">
    	    <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('web88cms/dashboard') }}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
        	<li>Orders &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
        	<li class="active">View All Shipments - Listing</li>
        </ol>
	</div>

    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
	            <h2>View All Shipments <i class="fa fa-angle-right"></i> Listing</h2>
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
	                            <label class="col-md-4 control-label">Shipment Date</label>
                                <div class="col-md-8">
                                	<div class="input-group input-daterange">
	        	                        <input type="text" name="shipment_from" class="form-control" required data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="{{ Input::get('shipment_from') }}" />
	    	                            <span class="input-group-addon">to</span>
		                                <input type="text" name="shipment_to" class="form-control" required data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="{{ Input::get('shipment_to') }}" />
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
                            	<label class="col-md-4 control-label">Shipment Status </label>
	                            <div class="col-md-8">
    		                        <select name="status" class="form-control">
            			                <option <?= (Input::get('status') == 'Ready To Ship' ? 'selected="selected"' :'') ?>>Ready To Ship</option>
                                        <option <?= (Input::get('status') == 'Shipped' ? 'selected="selected"' :'') ?>>Shipped</option>                                    </select>
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
                    	<div class="caption">Shipments Listing</div>
	                    <br/>
    	                <p class="margin-top-10px"></p>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Bulk Actions</button>
                            <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="javascript:void(0)">Inovice bulk print</a></li>
                                <li><a href="javascript:void(0)">Packing slip bulk print</a></li>
                                <li><a href="#link to products page">View purchased products</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript:void(0)" onclick="deleteSelected()">Delete selected item(s)</a></li>
                                <li><a href="javascript:void(0)" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                            </ul>
                        </div>
                      	<a href="javascript:void(0)" class="btn btn-blue">Export to CSV &nbsp;<i class="fa fa-share"></i></a>  
                    
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
                                                <a href="javascript:void(0)" onclick="deleteOrders($(this), 'selected')" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp;
                                                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a>
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
                                            	<a href="javascript:void(0)" onclick="deleteOrders($(this), 'all')" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp;
                                                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> 
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
                            <table id="example1" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th width="1%"><input type="checkbox" onclick="$('input[type=checkbox]').prop('checked', $(this).is(':checked'))" /></th>
                                        <th>#</th>
                                        @if ($sort_by == 'id' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=id&sort=DESC'; ?>">Shipment ID</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=id&sort=ASC'; ?>">Shipment ID</a></th>
                                        @endif
                                        
                                        @if ($sort_by == 'order_id' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=order_id&sort=DESC'; ?>">Order ID</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=order_id&sort=ASC'; ?>">Order ID</a></th>
                                        @endif
                                        
                                        @if ($sort_by == 'shipment_date' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=shipment_date&sort=DESC'; ?>">Shipment Date</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=shipment_date&sort=ASC'; ?>">Shipment Date</a></th>
                                        @endif
                                        
                                        @if ($sort_by == 'createdate' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=createdate&sort=DESC'; ?>">Order Date</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=createdate&sort=ASC'; ?>">Order Date</a></th>
                                        @endif
                                        
                                        @if ($sort_by == 'name' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=name&sort=DESC'; ?>">Customer Name</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=name&sort=ASC'; ?>">Customer Name</a></th>
                                        @endif
                                        
                                        @if ($sort_by == 'status' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=status&sort=DESC'; ?>">Shipment Status</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=status&sort=ASC'; ?>">Shipment Status</a></th>
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
                                                <td><a href="{{ url('web88cms/orders/shipmentDetail/' . $order->id) }}">0{{ $order->id }}</a></td>
                                                <td><a href="{{ url('web88cms/orders/shipmentDetail/' . $order->id) }}">{{ $order->order_id }}</a></td>
                                                <td>
                                                	@if($order->shipment_date != '0000-00-00')
                                                	    {{ date('dS M, Y', strtotime($order->shipment_date)) }}
                                                    @endif
                                                </td>
                                                <td>{{ date('dS M, Y', strtotime($order->createdate)) }}</td>
                                                <td>{{ $order->billing_first_name }} {{ $order->billing_last_name }}</td>
                                                
                                                <td align="center">
                                                    @if($order->status == 'Ready To Ship')
        	                                            <span class="label label-sm label-info">Ready To Ship</span>
                                                    @elseif($order->status == 'Shipped')
            	                                        <span class="label label-sm label-blue">Shipped</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('web88cms/orders/shipmentDetail/' . $order->id) }}" data-hover="tooltip" data-placement="top" title="View Details"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>
                                                    <a href="javascript:void(0)" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-{{ $order->id }}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                                    
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
			                                                                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> 
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
			window.location = '<?= url("web88cms/orders/shipmentsList"); ?>/' + $(this).val() + "?<?= $_SERVER['QUERY_STRING']; ?>";
		<?php }else{ ?>
			window.location = '<?= url("web88cms/orders/shipmentsList"); ?>/' + $(this).val();
		<?php } ?>		
	});
})
function deleteSelected(){
	values = $('.chk-order:checked');
	if (values.length==0){
		alert('Please select at least one order before delete.');	
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
	if(total > 0){
		$.ajax({
			url: "{{ url('web88cms/orders/deleteAllOrder') }}",
			type: 'POST',
			data: values,
			dataType: 'json',
			async: false,
			cache: false,
			beforeSend:function (){
				obj.html('Saving... <i class="fa fa-floppy-o"></i>');
			},
			complete: function(){
				obj.html('Save <i class="fa fa-floppy-o"></i>');
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
<style>
.modal{
	z-index: 10000;
}                                      
</style>
@endsection
