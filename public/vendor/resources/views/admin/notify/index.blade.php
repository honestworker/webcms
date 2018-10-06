@extends('adminBannerLayout')
@section('content')
<div id="page-wrapper">
    <div class="page-header-breadcrumb">
        <div class="page-heading hidden-xs">
        	<h1 class="page-title">Notification Requests</h1>
        </div>
        
	    <ol class="breadcrumb page-breadcrumb">
    		<li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('web88cms/dashboard') }}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
            <li>Notification Requests &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li>Listing Notification Requests &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li class="active">Listing</li>
	    </ol>
    </div>
        
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
            	<h2>Notification Requests <i class="fa fa-angle-right"></i> Listing Notification Requests <i class="fa fa-angle-right"></i> Listing</h2>
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
            
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-header">
                    	<div class="caption">Notification Requests Listing</div><br/>
	                    <p class="margin-top-10px"></p>
                        <div class="btn-group">
	                        <button type="button" class="btn btn-primary">Delete</button>
    	                    <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
        	                <ul role="menu" class="dropdown-menu">
            		            <li><a href="#" onclick="deleteSelected()">Delete selected item(s)</a></li>
                		        <li class="divider"></li>
                    		    <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                        	</ul>
                        </div>&nbsp;
	                    
                        <a href="{{ url('web88cms/notify/csv') }}" class="btn btn-blue">Export to CSV &nbsp;<i class="fa fa-share"></i></a>
                        <div class="tools"> <i class="fa fa-chevron-up"></i> </div>

                        <!--Modal delete selected items start-->
                        <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                   		<button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
	                                    <h4 id="modal-login-label3" class="modal-title"><a href="#"><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                                    </div>
	                                <div class="modal-body">
    		                            <div class="form-actions">
                    			            <div class="col-md-offset-4 col-md-8"> <a href="#" onclick="deleteNotifys($(this), 'selected')" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
		                                </div>
         	                       </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal delete selected items end -->
                        <!--Modal delete all items start-->
                        <div id="modal-delete-all" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    	<button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
	                                    <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                                    </div>
                                    <div class="modal-body">
                                    	<div class="form-actions">
		                                    <div class="col-md-offset-4 col-md-8"> <a href="#" onclick="deleteNotifys($(this), 'all')" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
	                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal delete all items end -->
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
                            <table id="notify" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th width="1%"><input type="checkbox" onclick="$('input[type=checkbox]').prop('checked', $(this).is(':checked'))" /></th>
                                        <th>#</th>

                                        @if ($sort_by == 'name' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=name&sort=DESC'; ?>">Name</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=name&sort=ASC'; ?>">Name</a></th>
                                        @endif
                                        
                                        @if ($sort_by == 'email' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=email&sort=DESC'; ?>">Email</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=email&sort=ASC'; ?>">Email</a></th>
                                        @endif
                                        
                                        <th><a href="#">Product</a></th>
                                        <th><a href="#">Image</a></th>
                                        
                                        @if ($sort_by == 'createdate' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=createdate&sort=DESC'; ?>">Created Date</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=createdate&sort=ASC'; ?>">Created Date</a></th>
                                        @endif
                                        
                                        @if ($sort_by == 'mail_send' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=mail_send&sort=DESC'; ?>">Notify User</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=mail_send&sort=ASC'; ?>">Notify User</a></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    @foreach ($notifys as $notify)
                                        <tr>
                                            <td><input class="chk-notify" name="notify[]" value="{{ $notify->id }}" type="checkbox"/></td>
                                            <td>{{ $count }}</td>
                                            <td>{{ $notify->name }}</td>
                                            <td><a href="mailto:{{ $notify->email }}">{{ $notify->email }}</a></td>
                                            <td><a href="{{ url('web88cms/products/editProduct/' . $notify->product_id) }}">{{ $notify->product_name }}</a></td>
                                            @if($notify->thumbnail_image_1)
                                            <td><img src="{{ asset('/public/admin/products/medium/' . $notify->thumbnail_image_1) }}" alt="{{ $notify->product_name }}" class="img-responsive" width="100px"></td>
                                            @else
                                                <td><img src="{{ asset('/public/admin/products/no-image.jpg') }}" alt="{{ $notify->product_name }}" class="img-responsive" width="100px"></td>
                                            @endif
                                            <td>{{ date('dS M, Y H:i', strtotime($notify->createdate)) }}</td>
                                            @if ($notify->mail_send == '1')
                                                <td><span class="label label-sm label-success">Yes</span></td>
                                            @else
                                                <td><span class="label label-sm label-red">No</span></td>
                                            @endif
                                        </tr>
                                        <?php $count++; ?>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="9"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        <div class="tool-footer text-right">
                            <p class="pull-left"><?= $paginate_msg; ?></p>
                            <?php echo $notifys->appends($_GET)->render() ?>
                        </div>
                        <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <!-- end row -->
    </div>
            
    <div class="page-footer">
        <div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
        <div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png') }}" alt="Webqom Technologies Sdn Bhd"></div>
        </div>
    </div>

	<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
</div>

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
function deleteSelected(){
	values = $('.chk-notify:checked');
	if (values.length==0){
		alert('Please select at least one notify before delete.');	
		return false;
	}
	$('#modal-delete-selected').modal('show');
}
function deleteNotifys(obj, type){
	if(type == 'selected'){
		values = $('.chk-notify:checked, #_token');
	}
	else{
		values = $('.chk-notify, #_token');
	}
	
	var total = values.length;
	var url = "{{ url('web88cms/notify/deleteAllNotify') }}"
	if(total > 1){
		$.ajax({
			url: url,
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
		alert('Please select at least one notify before delete.');
	}
}

$(function(){
	$('select[name="select_per_page"]').change(function(){
		<?php if($_SERVER['QUERY_STRING']){ ?>
			window.location = '<?= url("web88cms/notify"); ?>/' + $(this).val() + "?<?= $_SERVER['QUERY_STRING']; ?>";
		<?php }else{ ?>
			window.location = '<?= url("web88cms/notify"); ?>/' + $(this).val();
		<?php } ?>		
	});
})
</script>
@endsection
