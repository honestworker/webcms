@extends('adminLayout')
@section('content')
      <div id="page-wrapper">
        
        <div class="page-header-breadcrumb">
          <div class="page-heading hidden-xs">
            <h1 class="page-title">Promotions</h1>
          </div>
          
          <ol class="breadcrumb page-breadcrumb">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('/web88cms/dashboard') }}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
            <li>Promotions &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li class="active">Global Discounts - Listing</li>
          </ol>
          
</div>
        <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <h2>Global Discounts <i class="fa fa-angle-right"></i> Listing</h2>
              <div class="clearfix"></div>
              @if ($success)
                    <div class="alert alert-success alert-dismissable">
                     <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                     <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                     <p>{{ $success }}</p>
                    </div>   
              @endif
              
              <div class="pull-left"> Last updated: <span class="text-blue"><?php echo date('d M, Y @ g:i A',strtotime($last_modified)); ?></span> </div>
              <div class="clearfix"></div>
              <p></p>
              <div class="clearfix"></div>
            </div>
                        <div class="col-lg-12">
              <div class="portlet">
                <div class="portlet-header">
                  <div class="caption">Global Discounts Listing</div>
                  <br/>
                  <p class="margin-top-10px"></p>
                  <a href="#" class="btn btn-success" data-target="#modal-add-discount" data-toggle="modal">Add New Discount &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary">Delete</button>
                    <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                    <ul role="menu" class="dropdown-menu">
                      <li><a href="#" data-target="#modal-delete-selected" data-toggle="modal">Delete selected item(s)</a></li>
                      <li class="divider"></li>
                      <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                    </ul>
                  </div>
                   
<div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                  <div id="modal-add-discount" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog modal-wide-width">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label3" class="modal-title">Add New Discount</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form">
                            <form class="form-horizontal" id="form_add_global_discount">
                              <div class="form-group">
                                <label class="col-md-3 control-label">Status <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                  <div data-on="success" data-off="primary" class="make-switch">
                                    <input type="checkbox" name="status" checked="checked"/>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputFirstName" class="col-md-3 control-label">From Amount <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                  <input type="text" class="form-control" name="from_amount" placeholder="Amount">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group">
                                <label for="inputFirstName" class="col-md-3 control-label">To Amount <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                  <input type="text" class="form-control" name="to_amount" placeholder="Amount">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group">
                                <label for="inputFirstName" class="col-md-3 control-label">Discount <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                  <input type="text" class="form-control" placeholder="Amount" name="discount">
                                  <div class="xs-margin"></div>
                                  <select name="discount_by" class="form-control">
                                    <option value="percentage">%</option>
                                    <option value="amount">RM</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputFirstName" class="col-md-3 control-label">Apply to Category</label>
                                <div class="col-md-6">
                                  <div class="xs-margin"></div>
                                  <select name="category_id" class="form-control" onchange="load_category_products(this.value)">
                                    <option value="">- Select Category -</option>
                                    <?php echo $categories; ?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group" id="apply_to_all" style="display:none;">
                                <label class="col-md-3 control-label">Apply to Products</label>
                                <div class="col-md-9">
                                  <input type="checkbox" id="select_products"> Apply discount to all products under this category.
                                  <div id="category_products"></div>
                                </div>
                              </div>
                              <div class="form-actions">
                                <div class="col-md-offset-5 col-md-8">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <a href="javascript:void(0)" class="btn btn-red" onclick="save_global_discount()">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green" onclick="$('#form_add_global_discount')[0].reset();">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                        </div>
                        <div class="modal-body">                         
                          <div class="form-actions">
                            <div class="col-md-offset-4 col-md-8"> <a href="javascript:void(0)" onclick="continue_delete_process_global_discounts()" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green" onclick="cancel_delete()">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                        </div>
                        <div class="modal-body">                          
                          <div class="form-actions">
                            <div class="col-md-offset-4 col-md-8"> <a href="javascript:void(0)" onclick="delete_selected('global_discounts')" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green" onclick="cancel_delete()">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                          <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-actions">
                            <div class="col-md-offset-4 col-md-8"> <a href="javascript:void(0)" onclick="delete_all('global_discounts')" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green" onclick="cancel_delete()">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="portlet-body">
                
                <?php					  
					  if(sizeof($global_discounts) > 0)
					  {
						 // echo http_build_query(Input::get());
						 
						 $arr_get = Input::get();
						 unset($arr_get['page']);
						 $query_string = http_build_query($arr_get);
						 
						 $per_page = (Session::has('global_discounts.per_page')) ? Session::get('global_discounts.per_page') : 30;
					  ?>
                
                      <div class="form-inline pull-left">
                        <div class="form-group">
                          <select name="select" class="form-control" onchange="set_per_page(this.value,'global_discounts','{{ Request::path() }}','{{ $query_string }}')">
                           	<option <?php if($per_page == 10){ echo 'selected="selected"'; } ?>>10</option>
                            <option <?php if($per_page == 20){ echo 'selected="selected"'; } ?>>20</option>
                            <option <?php if($per_page == 30){ echo 'selected="selected"'; } ?>>30</option>
                            <option <?php if($per_page == 50){ echo 'selected="selected"'; } ?>>50</option>
                            <option <?php if($per_page == 100){ echo 'selected="selected"'; } ?>>100</option>
                          </select>
                          &nbsp;
                          <label class="control-label">Records per page</label>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <br/>
                      <br/>
                      <div class="table-responsive mtl">
                      	
                      <input type="hidden" id="delete_item_ids" value="0" />
                      <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}" />
                      <input type="hidden" id="query_string" value="{{ $query_string }}" />
                      
                        <table id="example1" class="table table-hover table-striped">
                          <thead>
                            <tr>
                              <th width="1%"><input type="checkbox" id="select_items"/></th>
                              <th>#</th>
                              <th>ID</th>
                              <th><a href="#sort by Order Subtotal Range ">Order Subtotal Range</a></th>
                              <th><a href="#sort by Order Discount">Order Discount</a></th>
                              <th><a href="#sort by status">Status</a></th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          	<?php
								$i = 1;
								foreach($global_discounts as $details)
								{
									$status_class = ($details->status == '0') ? 'label-red' : 'label-success';
									$status = ($details->status == '0') ? 'In-active' : 'Active';
							?>
									<tr>
                                      <td><input type="checkbox" data-id="<?php echo $details->id; ?>" class="select_items"/></td>
                                      <td>{{ $i }}</td>
                                      <td>{{ ($details->id < 10) ? '0'.$details->id : $details->id }}</td>
                                      <td>From RM {{ $details->from_amount }} to RM {{ $details->to_amount  }}</td>
                                      <td>{{ ($details->discount_by == 'percentage') ? $details->discount.'%' : 'RM '.number_format($details->discount,2) }}</td>
                                      <td><span class="label label-sm <?php echo $status_class; ?>" id="brand-status-<?php echo $details->id; ?>"><?php echo $status; ?></span></td>
                                      <td><a href="#" data-hover="tooltip" data-placement="top" title="Edit" data-target="#modal-edit-discount" data-toggle="modal"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" onclick="delete_item(<?php echo $details->id; ?>)" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>                               
                                      </td>
                                    </tr>
                            <?php
								$i++;
								} // end foreach
							?>
                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan="7"></td>
                            </tr>
                          </tfoot>
                        </table>
                        <div class="tool-footer text-right">
                          <p class="pull-left"><?php echo $pagination_report; ?></p>
                          
                          <?php echo $global_discounts->setPath(Request::url())->appends(Input::get())->render(); ?>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                      
                      <?php
					  } // end if(sizeof($global_discounts) > 0)
					  ?>
					  
                      
                </div>
              </div>
            </div>
          </div>
        </div>
                    
  <div class="page-footer">
                <div class="copyright"><span class="text-15px">2015 &copy; <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
                	<div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png') }}" alt="Webqom Technologies Sdn Bhd"></div>
                </div>
        </div>
</div>

<script>

function load_category_products(category_id)
{
	$('#category_products').html('');
	$('#apply_to_all').hide();
	$.ajax({
			url: '{{ url("/web88cms/promotions/categoryProducts") }}',
			type: 'POST',
			dataType: 'json',
			data: '_token=<?php echo csrf_token() ?>&category_id='+category_id,
			beforeSend: function(){
				
			},
			complete: function(){
				
			},
			success: function(response){
				if(response['products'])
				{
					$('#apply_to_all').show();					
					var products = '<table class="table checkout-table table-responsive"><thead><tr><th width="1%">#</th><th class="table-title">Product Name</th><th class="table-title">Product Code</th><th class="table-title">Price</th><th class="table-title">Quantity</th></tr></thead><tbody>';
					for(var i=0; i < response['products'].length; i++)
					{
						elm = response['products'][i];
						products += '<tr><td><input type="checkbox" name="product_id[]" value="'+ elm.id +'" class="select_products"/></td><td class="item-name-col"><figure><a href="#link to product item"><img src="<?php echo asset('/public/admin/products/large') ?>/'+ elm.large_image +'" alt="'+ elm.product_name +'" class="img-responsive" width="100"></a></figure><header class="item-name"> <a href="#link to product item">'+ elm.product_name +'</a> </header></td><td class="item-code">'+ elm.product_code +'</td><td class="item-price-col"><span class="item-price-special">RM '+ parseFloat(elm.sale_price).toFixed(2) +'</span></td><td>'+ elm.quantity_in_stock +'</td></tr>';
						//products += '<p>'+ response['products'][i].product_name +'</p>';
						//alert(response['products'][i].product_name);
					}
					products += '</tbody></table>';
					$('#category_products').html(products);	
				}
			}
		});	
}

// select all checkboxes
$(document).ready(function(){
	$('#select_products').click(function(){
		//alert('asd');
		//if($('.select_items').length() > 0)
		if($('#select_products').is(':checked'))
		{
			$('.select_products').prop('checked',true);
		}
		else
			$('.select_products').prop('checked',false);
	});	
});

// select all checkboxes
$(document).ready(function(){
	$('#select_items').click(function(){
		//alert('asd');
		//if($('.select_items').length() > 0)
		if($('#select_items').is(':checked'))
		{
			$('.select_items').prop('checked',true);
		}
		else
			$('.select_items').prop('checked',false);
	});	
});

function save_global_discount()
{
	$.ajax({
			url: '{{ url("/web88cms/promotions/addGlobalDiscount") }}',
			type: 'POST',
			dataType: 'json',
			data: $('#form_add_global_discount').serialize(),
			beforeSend: function(){
				
			},
			complete: function(){
				
			},
			success: function(response){
				if(response['error'])
				{
					$('#errorElement').remove();
					$('#successElement').remove();
					var error = '<div id="errorElement" class="alert alert-danger"><i class="fa fa-times-circle"></i> <strong>Error!</strong>';
					for(var i=0; i < response['error'].length; i++)
					{
						error += '<p>'+ response['error'][i] +'</p>';
					}
					error += '</div>';
					$('#form_add_global_discount').before(error);	
				}
				
				if(response['success'])
				{
					$('#errorElement').remove();
					$('#successElement').remove();
					var success = '<div id="successElement" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The information has been saved/updated successfully.</p></div>';
					$('#form_add_global_discount').before(success);
					
					$('#apply_to_all').hide();
					$('#form_add_global_discount')[0].reset();
					
				}
			}
		});		
}

</script>



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

@endsection
