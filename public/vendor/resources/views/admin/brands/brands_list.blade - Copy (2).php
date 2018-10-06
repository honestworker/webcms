@extends('adminLayout')

@section('content')
<div id="page-wrapper"><!--BEGIN PAGE HEADER & BREADCRUMB -->
        
        <div class="page-header-breadcrumb">
          <div class="page-heading hidden-xs">
            <h1 class="page-title">Products</h1>
          </div>
          
          <!-- InstanceBeginEditable name="EditRegion1" -->
          <ol class="breadcrumb page-breadcrumb">
            <li><i class="fa fa-home"></i>&nbsp;<a href="dashboard.html">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
            <li>Products &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li class="active">Brands - Listing</li>
          </ol>
          <!-- InstanceEndEditable --></div>
        <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->
        <!-- InstanceBeginEditable name="EditRegion2" -->
        <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <h2>Brands <i class="fa fa-angle-right"></i> Listing</h2>
              <div class="clearfix"></div>
              
              @if ($success)
                    <div class="alert alert-success alert-dismissable">
                     <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                     <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                     <p>{{ $success }}</p>
                    </div>   
                @endif
              
              <div class="clearfix"></div>
              <p></p>
              <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a href="#brand-image" data-toggle="tab">Brands Listing</a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                
                <div id="brand-image" class="tab-pane fade in active">
                  <div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Brands Listing</div>
                      <br/>
                      <p class="margin-top-10px"></p>
                      <a href="#" data-target="#modal-add-new" data-toggle="modal" class="btn btn-success">Add New Brand &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
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
                      
                      <!--Modal Add New brand start-->
                      <div id="modal-add-new" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog modal-wide-width">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4 id="modal-login-label3" class="modal-title">Add New Brand</h4>
                            </div>
                            <div class="modal-body">
                              <div class="form">
                                <form class="form-horizontal" id="addBrand">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-6">
                                      <div data-on="success" data-off="primary" class="make-switch">
                                        <input type="checkbox" name="status" checked="checked"/>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Title</label>
                                    <div class="col-md-6">
                                      <input type="text" name="title" class="form-control" placeholder="dyson">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                              <label class="col-md-3 control-label">Upload Brand Image <span class='require'>*</span></label>
                                              <div class="col-md-9">
                                                <div class="text-15px margin-top-10px"> 
                                                    <input id="exampleInputFile2" type="file" name="brandImage"/>
                                                    <br/>
                                                    <span class="help-block">(Image dimension: 160 x 60 pixels, PNG only, Max. 1MB) </span> </div>
                                              </div>
                                            </div>
                                  <div class="form-actions">
                                    <div class="col-md-offset-5 col-md-8"> <a href="javascript:void(0)" class="btn btn-red"  onclick="addBrand()">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--END MODAL Add New brand-->
                      <!--Modal delete selected items start-->
                      <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                            </div>
                            <div class="modal-body">
                              <!--<p><strong>#1:</strong> dyson</p>-->
                              <div class="form-actions">
                                <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red" onclick="delete_selected()">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green" onclick="cancel_delete()">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                            </div>
                            <div class="modal-body">
                              <div class="form-actions">
                                <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red" onclick="delete_all()" >Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green" onclick="cancel_delete()">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- modal delete all items end -->
                    </div>
                    <div class="portlet-body">
                      <div class="table-responsive mtl">
                      <?php //echo Session::get('response'); ?>
                      <input type="hidden" id="delete_item_ids" value="0" />
                      <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}" />
                      	
                        <?php
						if(sizeof($brands) > 0)
						{
						?>
                          <table class="table table-hover table-striped">
                            <thead>
                              <tr>
                                <th width="1%"><input type="checkbox" id="select_items"/></th>
                                <th>#</th>
                                <th>Status</th>
                                <th>Title</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              
                              <?php
							 	//echo '<pre>'; print_r($brands); echo '</pre>';
							 
							 	$i = 1;
								foreach($brands as $details)
								{
									$status_class = ($details->status == '0') ? 'label-red' : 'label-success';
									$status = ($details->status == '0') ? 'In-active' : 'Active';
								?>
                                  <tr>
                                    <td><input type="checkbox" data-id="<?php echo $details->id; ?>" class="select_items"/></td>
                                    <td><?php echo $i; ?></td>
                                    <td><span class="label label-sm <?php echo $status_class; ?>" id="brand-status-<?php echo $details->id; ?>"><?php echo $status; ?></span></td>
                                    <td id="updated_title_<?php echo $details->id; ?>"><?php echo $details->title; ?></td>
                                    <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-brand" data-toggle="modal" id="edit_link_<?php echo $details->id; ?>" title="Edit" onclick='set_brand_details(<?php echo $details->id.',"'.htmlspecialchars($details->title,ENT_QUOTES).'",'.$details->status; ?>)'><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" onclick="delete_item(<?php echo $details->id; ?>)" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-2" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                       
                                      
                                    </td>
                                  </tr>
								<?php
									$i++;
                                } // end foreach
                                ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="5"></td>
                              </tr>
                            </tfoot>
                          </table>
                        <?php
						} // end if
						?>
                          
                    <script>
					function set_brand_details(id,title,status)
					{
						$('#modal-edit-brand #brand_id').val(id);
						
						$('#modal-edit-brand #brand_title').val(title);
						
						if(status == 0)
						{
							$('#modal-edit-brand #brand_status').parent().removeClass('switch-on');
							$('#modal-edit-brand #brand_status').parent().addClass('switch-off');
							//$('#modal-edit-brand #brand_status').prop('checked',false);
							$('#modal-edit-brand #brand_status').removeAttr('checked');
						}
						else
						{
							$('#modal-edit-brand #brand_status').parent().removeClass('switch-off');
							$('#modal-edit-brand #brand_status').parent().addClass('switch-on');
							$('#modal-edit-brand #brand_status').attr('checked','checked');
							//$('#modal-edit-brand #brand_status').prop('checked',true);							
						}
					}
					
					/*// set brand id(in hidden text box) to delete
					function set_item_to_delete(brand_id)
					{
						obj = $('#delete_item_ids');
						if(obj.val() == 0)
							obj.val(brand_id);
						else
							obj.val(obj.val()+'~'+brand_id);
					}*/
					
					
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
					
					
					</script>      
                           <!--Modal Edit brand image start-->
                            <div id="modal-edit-brand" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                              <div class="modal-dialog modal-wide-width">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                    <h4 id="modal-login-label3" class="modal-title">Brand Image Edit</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form">
                                      <form class="form-horizontal" id="editBrand">
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                      <input type="hidden" name="id" id="brand_id" />
                                        <div class="form-group">
                                          <label class="col-md-3 control-label">Status</label>
                                          <div class="col-md-6">
                                            <div data-on="success" data-off="primary" class="make-switch">
                                              <input type="checkbox" name="status" id="brand_status"/>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="col-md-3 control-label">Title </label>
                                          <div class="col-md-6">
                                            <input type="text" class="form-control" name="title" id="brand_title" placeholder="dyson" value="">
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="col-md-3 control-label">Upload Brand Image <span class='require'>*</span></label>
                                          <div class="col-md-9">
                                            <div class="text-15px margin-top-10px"> <!--<img src="../images/brands/logo_dyson.png" alt="dyson" class="img-responsive"><br/>-->
                                                <input id="exampleInputFile2" type="file" name="brandImage" />
                                                <br/>
                                                <span class="help-block">(Image dimension: 160 x 60 pixels, PNG only, Max. 1MB) </span> </div>
                                          </div>
                                        </div>
                                        <div class="form-actions">
                                          <div class="col-md-offset-5 col-md-8"> <a href="javascript:void(0)" class="btn btn-red" onclick="saveBrand()">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                          <!--END MODAL Edit brand image -->
                          <!--Modal delete start-->
                            <div id="modal-delete-2" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                    <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                                  </div>
                                  <div class="modal-body">
                                    <!--<p><strong>#1:</strong> dyson</p>-->
                                    <div class="form-actions">
                                      <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red" onclick="continue_delete_process_brands()">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green" onclick="cancel_delete()">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                          <!-- modal delete end -->
                          
                          
                          <div class="clearfix"></div>
                        </div>
                        <!-- end table responsive -->
                    </div>
                  </div>
                </div>
                
                
              </div>
              <!-- end tab content -->
              <div class="clearfix"></div>
            </div>
            <!-- end col-lg-12 -->
          </div>
          <!-- end row -->
        </div>
        <!-- InstanceEndEditable -->
        <!--END CONTENT-->
            
            <!--BEGIN FOOTER-->
  <div class="page-footer">
                <div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
                	<div class="pull-right"><img src="images/logo_webqom.png" alt="Webqom Technologies Sdn Bhd"></div>
                </div>
        </div>
    <!--END FOOTER--></div>
<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
<input id="_category_post" type="hidden" name="_category_post" value="{{ url('admin/categories/listAjax') }}">

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

<script src="{{ asset('/public/admin/vendors/jquery-nestable/jquery.nestable.js') }}"></script>
<script src="{{ asset('/public/admin/js/ui-nestable-list.js') }}"></script>

<!--CORE JAVASCRIPT-->
<script src="{{ asset('/public/admin/js/main.js') }}"></script>
<script src="{{ asset('/public/admin/js/holder.js') }}"></script>

@endsection
