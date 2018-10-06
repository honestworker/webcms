@extends('adminLayout')
@section('content')
<div id="page-wrapper">
    <div class="page-header-breadcrumb">
    	<div class="page-heading hidden-xs">
		    <h1 class="page-title">Promotions</h1>
	    </div>
    
        <ol class="breadcrumb page-breadcrumb">
        	<li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('web88cms/dashboard') }}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
	        <li>Promotions &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
	        <li class="active">Promo Codes - Listing</li>
        </ol>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
            	<h2>Promo Codes <i class="fa fa-angle-right"></i> Listing</h2>
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
                    	<div class="caption">Promo Codes Listing</div>
	                    <br/>
    	                <p class="margin-top-10px"></p>
        	            <a href="{{ url('web88cms/promocodes/addNew') }}" class="btn btn-success">Add Promo Code &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                        <div class="btn-group">
                        	<button type="button" class="btn btn-primary">Delete</button>
	                        <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
            	            <ul role="menu" class="dropdown-menu">
    		                    <li><a href="#" onclick="deleteSelected()">Delete selected item(s)</a></li>
                		        <li class="divider"></li>
                    		    <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                        	</ul>
                        </div>                              
                    	<div class="tools"> <i class="fa fa-chevron-up"></i> </div>

                        <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                        <h4 id="modal-login-label3" class="modal-title"><a href="#"><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                                    </div>

                                    <div class="modal-body">
                                    	<div class="form-actions">
    		                                <div class="col-md-offset-4 col-md-8"> 
                                            	<a href="#" onclick="deletePromocodes($(this), 'selected')" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; 
                                                <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                                    	<h4 id="modal-login-label3" class="modal-title"><a href="#"><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                                    </div>
                                    <div class="modal-body">
	                                    <div class="form-actions">
    		                                <div class="col-md-offset-4 col-md-8"> 
                                            	<a href="#" onclick="deletePromocodes($(this), 'all')" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; 
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
                            <table id="example1" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th width="1%"><input type="checkbox" onclick="$('input[type=checkbox]').prop('checked', $(this).is(':checked'))" /></th>
                                        <th>#</th>
                                        @if ($sort_by == 'id' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=id&sort=DESC'; ?>">ID</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=id&sort=ASC'; ?>">ID</a></th>
                                        @endif
                                        
                                        @if ($sort_by == 'campaign_name' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=campaign_name&sort=DESC'; ?>">Campaign Name</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=campaign_name&sort=ASC'; ?>">Campaign Name</a></th>
                                        @endif
                                        
                                        @if ($sort_by == 'promo_code' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=promo_code&sort=DESC'; ?>">Promo Code</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=promo_code&sort=ASC'; ?>">Promo Code</a></th>
                                        @endif
                                        
                                        @if ($sort_by == 'global_discounts' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=global_discounts&sort=DESC'; ?>">Global Discounts</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=global_discounts&sort=ASC'; ?>">Global Discounts</a></th>
                                        @endif
                                        
                                        @if ($sort_by == 'cat_prod' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=cat_prod&sort=DESC'; ?>">Cat/Prod</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=cat_prod&sort=ASC'; ?>">Cat/Prod</a></th>
                                        @endif
                                        
                                        @if ($sort_by == 'min_subtotal' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=min_subtotal&sort=DESC'; ?>">Min Subtotal</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=min_subtotal&sort=ASC'; ?>">Min Subtotal</a></th>
                                        @endif
                                        
                                        @if ($sort_by == 'discount' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=discount&sort=DESC'; ?>">Discount</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=discount&sort=ASC'; ?>">Discount</a></th>
                                        @endif
                                        
                                        @if ($sort_by == 'start_date' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=start_date&sort=DESC'; ?>">Start/Expire</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=start_date&sort=ASC'; ?>">Start/Expire</a></th>
                                        @endif
                                        
                                        @if ($sort_by == 'times_to_use' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=times_to_use&sort=DESC'; ?>">Time Used</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=times_to_use&sort=ASC'; ?>">Time Used</a></th>
                                        @endif
                                        
                                        @if ($sort_by == 'status' && $sort == 'ASC')
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=status&sort=DESC'; ?>">Status</a></th>
                                        @else
                                        	<th><a href="<?php echo $sorting_url . '&sort_by=status&sort=ASC'; ?>">Status</a></th>
                                        @endif
                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                	<?php $count = 1; ?>
                                    @foreach ($promocodes as $promocode)
	                                    <tr>
    	                                    <td><input class="chk-promocode" name="promocode[]" value="{{ $promocode->id }}" type="checkbox"/></td>
        	                                <td>{{ $count }}</td>
                                            <td>{{ $promocode->id }}</td>
                                            <td>{{ $promocode->campaign_name }}</td>
                                            <td>{{ $promocode->promo_code }}</td>
                                            <td>{{ $promocode->global_discounts }}</td>
                                            <td>#</td>
                                            <td>RM {{ $promocode->min_subtotal }}</td>
                                            <td>
                                            	@if($promocode->discount_type == 'P')
	                                            	{{ $promocode->discount }}%
                                                @else
                                                	RM {{ $promocode->discount }}
                                                @endif
                                            </td>
                                            <td>{{ date('dS M, Y', strtotime($promocode->start_date)) }} / {{ date('dS M, Y', strtotime($promocode->end_date)) }}</td>
                                            <td>{{ (int)$promocode->timeOfUse }}/{{ $promocode->times_to_use }}</td>
                                            
                                            <td>
                                                @if ($promocode->status == '1')
                                                    <span class="label label-sm label-success">Active</span>
                                                @else
                                                    <span class="label label-sm label-red">Inactive</span>
                                                @endif
                                            </td>
                                            
	                                        <td>
                                            	<a href="{{ url('web88cms/promocodes/editPromoCode/' . $promocode->id) }}" data-hover="tooltip" data-placement="top" title="Edit">
                                                	<span class="label label-sm label-success"><i class="fa fa-pencil"></i></span>
                                                </a>
                                                <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-{{ $promocode->id }}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                        
                                                <div id="modal-delete-{{ $promocode->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            	<button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
	                                                            <h4 id="modal-login-label3" class="modal-title">
                                                                	<a href="#"><i class="fa fa-exclamation-triangle"></i></a>
                                                                    Are you sure you want to delete this item?
                                                                </h4>
                                                            </div>
	                                                        <div class="modal-body">
    		                                                    <p><strong>#1:</strong> {{ $promocode->campaign_name }}</p>
            		                                            <div class="form-actions">
                    			                                    <div class="col-md-offset-4 col-md-8">
                                                                    	<a href="{{ url('web88cms/promocodes/delete/' . $promocode->id) }}?redirect=<?php echo urlencode($curr_url); ?>" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; 
                                                                        <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> 
                                                                    </div>
		                                                        </div>
        	                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        	</td>
	                                    </tr>
                                        <?php $count++; ?>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                	<tr>
                                		<td colspan="13"></td>
	                                </tr>
                                </tfoot>
                            </table>

                            <div class="tool-footer text-right">
                                <p class="pull-left"><?= $paginate_msg; ?></p>
                                <?php echo $promocodes->appends($_GET)->render() ?>
                            </div>
	                        <div class="clearfix"></div>
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

<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
<script>
$(function(){
	$('select[name="select_per_page"]').change(function(){
		<?php if($_SERVER['QUERY_STRING']){ ?>
			window.location = '<?= url("web88cms/promocodes"); ?>/' + $(this).val() + "?<?= $_SERVER['QUERY_STRING']; ?>";
		<?php }else{ ?>
			window.location = '<?= url("web88cms/promocodes"); ?>/' + $(this).val();
		<?php } ?>		
	});
})
function deleteSelected(){
	values = $('.chk-promocode:checked');
	if (values.length==0){
		alert('Please select at least one promocode before delete.');	
		return false;
	}
	$('#modal-delete-selected').modal('show');
}
function deletePromocodes(obj, type){
	if(type == 'selected'){
		values = $('.chk-promocode:checked, #_token');
	}
	else{
		values = $('.chk-promocode, #_token');
	}

	var total = values.length;
	if(total > 1){
		$.ajax({
			url: "{{ url('web88cms/promocodes/deleteAllPromocode') }}",
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
		alert('Please select at least one promocode before delete.');
	}
}
</script>
@endsection
