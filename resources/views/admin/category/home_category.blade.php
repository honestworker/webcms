@extends('adminBannerLayout')

@section('content')
<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/vendors/jquery-nestable/nestable.css') }}" />

<div id="page-wrapper">
	<!--BEGIN PAGE HEADER & BREADCRUMB-->
    <div class="page-header-breadcrumb">
        <div class="page-heading hidden-xs">
        	<h1 class="page-title">Products</h1>
        </div>
    
        <ol class="breadcrumb page-breadcrumb">
        	<li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('/web88cms/dashboard') }}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
        	<li>Products &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li><a href="{{ url('/web88cms/categories/list') }}">All Categories Listing</a> &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li class="active">Home Categories - Listing</li>
        </ol>
    </div>
	<!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->

    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
            	<h2>Home Categories <i class="fa fa-angle-right"></i> Listing</h2>
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
                <div class="clearfix"></div>
                
                @if ($last_modified)
	                <div class="pull-left"> Last updated: <span class="text-blue"><?php echo date('d M, Y @ g:i A',strtotime($last_modified)); ?></span> </div>
    	          	<div class="clearfix"></div>
                    <p></p>
                    <div class="clearfix"></div>
                @endif
            </div>

            <div class="col-lg-12">  
                <ul id="myTab" class="nav nav-tabs">
                	<li class="active"><a href="#brand-image" data-toggle="tab">Home Categories Listing</a></li>
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div id="brand-image" class="tab-pane fade in active">
                        <div class="portlet">
                            <div class="portlet-header">
                            <div class="caption">Home Categories Listing</div>
                            <br/>
                            <p class="margin-top-10px"></p>
                            <a href="javascript:void(0)" data-target="#modal-add-new" data-toggle="modal" class="btn btn-success">Add New Category &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                            <div class="btn-group">
                            <button type="button" class="btn btn-primary">Delete</button>
                            <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                            <ul role="menu" class="dropdown-menu">
                            <li><a href="javascript:void(0)" data-target="#modal-delete-selected" data-toggle="modal">Delete selected item(s)</a></li>
                            <li class="divider"></li>
                            <li><a href="javascript:void(0)" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                            </ul>
                            </div>
                            
                            <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                            
                            <!--Modal Add New start-->
                            <div id="modal-add-new" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog modal-wide-width">
                            <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                            <h4 id="modal-login-label3" class="modal-title">Add New Category</h4>
                            </div>
                            <div class="modal-body">
                            <div class="form">
                            <form class="form-horizontal">
                            <div class="form-group">
                            <label class="col-md-3 control-label">Status</label>
                            <div class="col-md-6">
                            <div data-on="success" data-off="primary" class="make-switch">
                            <input type="checkbox" checked="checked"/>
                            </div>
                            </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-3 control-label">Title</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control">
                            </div>
                            </div>
                            <div class="form-group border-bottom">
                            <label class="col-md-3 control-label">Enable Tab(s)</label>
                            <div class="col-md-6">
                            <div class="radio-list margin-top-10px">
                            <label><input type="radio" value="option1" checked="checked"/>&nbsp; Yes</label>
                            <label><input type="radio" value="option2"/>&nbsp; No</label>
                            </div>
                            </div>
                            </div>
                            note to prorgammer: if enable tabs is selected, display the table below. if selects no, hide the below entire tab section.
                            
                            <div class="portlet">
                            <div class="portlet-header">
                            <div class="caption">Tabs Listing</div>
                            <br/>
                            <p class="margin-top-10px"></p>
                            <a href="javascript:void(0)" data-target="#modal-add-tab" data-toggle="modal" class="btn btn-success">Add New Tab &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                            <div class="btn-group">
                            <button type="button" class="btn btn-primary">Delete</button>
                            <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                            <ul role="menu" class="dropdown-menu">
                            <li><a href="javascript:void(0)" data-target="#modal-delete-selected" data-toggle="modal">Delete selected item(s)</a></li>
                            <li class="divider"></li>
                            <li><a href="javascript:void(0)" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                            </ul>
                            </div>
                            <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                            
                            <!--Modal Add New tab start-->
                            <div id="modal-add-tab" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog modal-wide-width">
                            <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                            <h4 id="modal-login-label3" class="modal-title">Add New Tab</h4>
                            </div>
                            <div class="modal-body">
                            <div class="form">
                            
                              <div class="form-group">
                                <label class="col-md-3 control-label">Status</label>
                                <div class="col-md-6">
                                  <div data-on="success" data-off="primary" class="make-switch">
                                    <input type="checkbox" checked="checked"/>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-3 control-label">Title</label>
                                <div class="col-md-6">
                                  <input type="text" class="form-control" placeholder="">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-3 control-label">Display Order</label>
                                <div class="col-md-6">
                                  <input type="text" class="form-control" placeholder="">
                                </div>
                              </div>
                              <div class="form-actions">
                                <div class="col-md-offset-4 col-md-8"> <a href="javascript:void(0)" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                              </div>
                            
                            
                            </div>
                            <!-- end form -->
                            </div>
                            </div>
                            </div>
                            </div>
                            <!--END MODAL Add New tab-->
                            </div>
                            <!-- end portlet header -->
                            <div class="portlet-body">
                            <div class="pull-right"> <a href="javascript:void(0)" class="btn btn-danger">Update Display Order &nbsp;<i class="fa fa-refresh"></i></a> </div>
                            <div class="clearfix"></div>
                            <div class="table-responsive mtl">
                            <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                            <th width="1%"><input type="checkbox"/></th>
                            <th>#</th>
                            <th>Status</th>
                            <th>Title</th>
                            <th width="12%">Display Order</th>
                            <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            <td><input type="checkbox"/></td>
                            <td>2</td>
                            <td><span class="label label-sm label-success">Active</span></td>
                            <td>New Arrivals (8)</td>
                            <td><input type="text" class="form-control" value="1"></td>
                            <td><a href="category_home_products_list.html" data-hover="tooltip" data-placement="top" title="View/Edit Products"><span class="label label-sm label-yellow"><i class="fa fa-search"></i></span></a> <a href="javascript:void(0)" data-hover="tooltip" data-placement="top" data-target="#modal-edit-tab" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="javascript:void(0)" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-2" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a> 
                                    
                              <!--Modal edit tab start-->
                              <div id="modal-edit-tab" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                <div class="modal-dialog modal-wide-width">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                      <h4 id="modal-login-label3" class="modal-title">Edit Tab</h4>
                                    </div>
                                    <div class="modal-body">
                                      <div class="form">
                              
                                          <div class="form-group">
                                            <label class="col-md-3 control-label">Status</label>
                                            <div class="col-md-6">
                                              <div data-on="success" data-off="primary" class="make-switch">
                                                <input type="checkbox" checked="checked"/>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-md-3 control-label">Title</label>
                                            <div class="col-md-6">
                                              <input type="text" class="form-control" placeholder="" value="New Arrivals">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-md-3 control-label">Display Order</label>
                                            <div class="col-md-6">
                                              <input type="text" class="form-control" placeholder="" value="1">
                                            </div>
                                          </div>
                                          <div class="form-actions">
                                            <div class="col-md-offset-5 col-md-8"> <a href="javascript:void(0)" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                          </div>
                                
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!--END MODAL edit tab-->                                        </td>
                            </tr>
                            <tr>
                            <td><input type="checkbox"/></td>
                            <td>1</td>
                            <td><span class="label label-sm label-success">Active</span></td>
                            <td>Ladiesweek (8)</td>
                            <td><input type="text" class="form-control" value="2"></td>
                            <td><a href="category_home_products_list.html" data-hover="tooltip" data-placement="top" title="View/Edit Products"><span class="label label-sm label-yellow"><i class="fa fa-search"></i></span></a> <a href="javascript:void(0)" data-hover="tooltip" data-placement="top" data-target="#modal-edit-tab" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="javascript:void(0)" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-2" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a></td>
                            </tr>   
                            </tbody>
                            <tfoot>
                            <tr>
                            <td colspan="6"></td>
                            </tr>
                            </tfoot>
                            </table>
                            <div class="clearfix"></div>
                            </div>
                            <!-- end table responsive -->
                            </div>
                            <!-- end portlet-body -->
                            </div>
                            <!-- end portlet -->
                            <div class="form-actions">
                            <div class="col-md-offset-5 col-md-8"> <a href="javascript:void(0)" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                            </div>
                            </form>
                            </div>
                            <!-- end form -->
                            </div>
                            </div>
                            </div>
                            </div>
                            <!--END MODAL Add New -->
                            <!--Modal delete selected items start-->
                            <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                            <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                            </div>
                            <div class="modal-body">
                            <p><strong>#1:</strong> Latest Offers</p>
                            <div class="form-actions">
                            <div class="col-md-offset-4 col-md-8"> <a href="javascript:void(0)" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                            <div class="col-md-offset-4 col-md-8"> <a href="javascript:void(0)" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                                
                                <div class="table-responsive mtl">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th width="1%"><input type="checkbox"/></th>
                                                <th>#</th>
                                                <th>Status</th>
                                                <th>Title</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        	<?php $count = 1; ?>
                                        	@foreach ($categories as $category)
                                            <tr>
                                                <td><input class="chk-category" name="categories[]" value="{{ $category->id }}" type="checkbox"/></td>
                                                <td>{{ $category->id }}</td>
                                                <td>
                                                    @if ($category->status == '1')
                                                        <span class="label label-sm label-success">Active</span>
                                                    @else
                                                        <span class="label label-sm label-red">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>{{ $category->title . '(' . $category->totalProduct . ')'}}</td>
                                                <td>
                                                	@if ($category->enable_tab == 'no')
                                                		<a href="{{ url('web88cms/categories/homeCategoryToProduct') }}" data-hover="tooltip" data-placement="top" title="" data-original-title="View/Edit Products"><span class="label label-sm label-yellow"><i class="fa fa-search"></i></span></a>
                                                    @endif
                                                	<a href="javascript:void(0)" data-hover="tooltip" data-placement="top" data-target="#modal-edit-category-{{ $category->id }}" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>
                                                    <a href="javascript:void(0)" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-{{ $category->id }}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>

                                                    <div id="modal-edit-category-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                                        <div class="modal-dialog modal-wide-width">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                	<button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
	                                                                <h4 id="modal-login-label3" class="modal-title">Category Edit</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form">
                                                                        <form class="form-horizontal">
                                                                            <div class="form-group">
	                                                                            <label class="col-md-3 control-label">Status</label>
    	                                                                        <div class="col-md-6">
        		                                                                    <div data-on="success" data-off="primary" class="make-switch">
                		        	                                                    <input type="checkbox" checked="checked"/>
                        		                                                    </div>
                                    	                                        </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                            	<label class="col-md-3 control-label">Title </label>
	                                                                            <div class="col-md-6">
    		                                                                        <input id="text" type="text" class="form-control" value="Latest Offers">
            	                                                                </div>
                                                                            </div>
                                                                                
                                                                            <div class="form-actions">
                                                                            	<div class="col-md-offset-5 col-md-8"> <a href="javascript:void(0)" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="modal-delete-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                	<button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
	                                                                <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                	<p><strong>#{{ $category->id }}:</strong> {{ $category->title }}</p>
	                                                                <div class="form-actions">
		                                                                <div class="col-md-offset-4 col-md-8"> <a href="javascript:void(0)" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
	                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        
                                        <tfoot>
                                            <tr>
                                            	<td colspan="5"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="tool-footer text-right">
                                        <p class="pull-left"><?= $paginate_msg; ?></p>
                                        <?php echo $categories->render() ?>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
	            <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="page-footer">
        <div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
        <div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png')}}" alt="Webqom Technologies Sdn Bhd"></div>
        </div>
    </div>
	<!--END FOOTER-->
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

<script type="text/javascript">
$(function(){
	$('select[name="select_per_page"]').change(function(){
		window.location = '{{ url("web88cms/categories/homeList") }}/' + $(this).val();
	});
})
</script>
@endsection