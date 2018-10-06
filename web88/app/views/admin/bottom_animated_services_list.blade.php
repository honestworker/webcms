<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/cms_admin_global_setup.dwt" codeOutsideHTMLIsLocked="false" -->
<head>

<!-- InstanceBeginEditable name="doctitle" -->
<title>Bottom Animated Services Items:: Listing</title>
<!-- InstanceEndEditable -->
<!-- OCK front end icons css --> 
<link type="text/css" rel="stylesheet" href="icons/font-awesome.min.css"> 

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="images/icons/favicon.ico" rel="shortcut icon">
   
    <link href="//fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic%7CPT+Gudea:400,700,400italic%7CPT+Oswald:400,700,300" rel="stylesheet" id="googlefont">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,300,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
    
 <!--Loading bootstrap css-->
<link type="text/css" rel="stylesheet" href="vendors/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css">
<link type="text/css" rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
<link type="text/css" rel="stylesheet" href="vendors/bootstrap/css/bootstrap.min.css">
    
<!--LOADING SCRIPTS FOR PAGE-->
<link type="text/css" rel="stylesheet" href="vendors/bootstrap-datepicker/css/datepicker.css">
<link type="text/css" rel="stylesheet" href="vendors/bootstrap-switch/css/bootstrap-switch.css">
    
    <!--Loading style vendors-->
<link type="text/css" rel="stylesheet" href="vendors/animate.css/animate.css">
<link type="text/css" rel="stylesheet" href="vendors/jquery-pace/pace.css">

<!--Loading style-->
<link type="text/css" rel="stylesheet" href="css/style.css">  
<!--<link type="text/css" rel="stylesheet" href="css/style.css">-->
<link type="text/css" rel="stylesheet" href="css/style-mango.css" id="theme-style">
<link type="text/css" rel="stylesheet" href="css/vendors.css">
<link type="text/css" rel="stylesheet" href="css/themes/grey.css" id="color-style">
<link type="text/css" rel="stylesheet" href="css/style-responsive.css">

    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>
<body>
<div>
<!--BEGIN TO TOP--><a id="totop" href="#"><i class="fa fa-angle-up"></i></a><!--END BACK TO TOP-->
  <div id="wrapper"><!--BEGIN TOPBAR-->
	@include('backend.topbar')
	@include('backend.menu')
  <!--BEGIN PAGE WRAPPER-->
      <div id="page-wrapper"><!--BEGIN PAGE HEADER & BREADCRUMB-->
        
        <div class="page-header-breadcrumb">
          <div class="page-heading hidden-xs">
            <h1 class="page-title">Global Settings</h1>
          </div>
          
          <!-- InstanceBeginEditable name="EditRegion1" -->
          <ol class="breadcrumb page-breadcrumb">
            <li><i class="fa fa-home"></i>&nbsp;<a href="dashboard.html">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
            <li>Global Settings &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li class="active">Animated Services Icons - Listing</li>
          </ol>
          <!-- InstanceEndEditable --></div>
        <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->
        <!-- InstanceBeginEditable name="EditRegion2" -->
        <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <h2>Animated Services Icons <i class="fa fa-angle-right"></i> Listing</h2>
              <div class="clearfix"></div>
              <div class="alert alert-success alert-dismissable"
        @if( Session::has('success') )
        style="display: block;">
      <script>setTimeout(function(){$("body").animate({"scrollTop":0},100);},3000);</script>
      <?php Session::forget('success') ?>
      @else
        style="display: none;">
      @endif
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                <p>The information has been saved/updated successfully.</p>
              </div>
              <div class="alert alert-danger alert-dismissable"
      @if( Session::has('fail') )
        style="display: block;">
      <script>setTimeout(function(){$("body").animate({"scrollTop":0},100);},3000);</script>
      <?php Session::forget('fail') ?>
      @else
        style="display: none;">
      @endif
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                <p>The information has not been saved/updated. Please correct the errors.</p>
              </div>
              <div class="pull-left"> Last updated: <span class="text-blue">{{ date('d M, Y @ g.iA', strtotime($data['updated_at'])) }}</span> </div>
              <div class="clearfix"></div>
              <p></p>
              
              <div class="portlet">
                <div class="portlet-header">
                  <div class="caption">Page Info</div>
                  <br/>
                  <span class="text-blue text-12px">You can edit the content by clicking the text section below.</span>
                  <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                </div>
                <div class="portlet-body">
                  
					<section id="facts">
					<div class="container">
					<div class="row">
					<div class="col-md-12 col-sm-4 col-xs-12">
					<div class="wbx_info" name="animated[title]"  contenteditable="true">
					{{ $data['title'] }}
					</div>
					<p class="line"><br></p>
					</div>
					</div>
					<div id="our-facts"><br></div>
					</div><div id="video">
					<video autoplay="" loop="">
					<source data-cke-saved-src="" src="" type=""></video>
					</div>
					</section>
				                      
                    
                  
                </div>
				{{ Form::open( [ 'id' => 'wbx_change_info' ] ) }}
				{{Form::close()}}
                <!-- end portlet body -->
                <!-- save button start -->
                <div class="form-actions none-bg"> <a data="preview" href="/" class="wbx_submit btn btn-red">Save &amp; Preview &nbsp;<i class="fa fa-search"></i></a>&nbsp; <a href="/" data="publish" class="wbx_submit btn btn-blue">Save &amp; Publish &nbsp;<i class="fa fa-globe"></i></a>&nbsp; <a href="/" id="wbx-cancel" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                <!-- save button end -->
                
              </div>
              <!-- end porlet -->
              
              <h4 class="block-heading">Animated Services Icons &amp; Background Image</h4>
              <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a href="#services-icons" data-toggle="tab">Animated Services Icons</a></li>
                <li><a href="#backgroundimage" data-toggle="tab">Background Image</a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div id="services-icons" class="tab-pane fade in active">
                  <div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Animated Services Icons Listing</div>
                      <br/>
                      <p class="margin-top-10px"></p>
                      <a href="#" data-target="#modal-add-social-link" data-toggle="modal" class="btn btn-success">Add New &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary">Delete</button>
                        <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                        <ul role="menu" class="dropdown-menu">
                          <li><a href="#" id="dellselobjfoot" data-target="#modal-delete-selected" data-toggle="modal">Delete selected item(s)</a></li>
                          <li class="divider"></li>
                          <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                        </ul>
                      </div>
                      
                      <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                      <!--Modal Add New Social Link start-->
                      <div id="modal-add-social-link" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog modal-wide-width">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4 id="modal-login-label3" class="modal-title">Add New</h4>
                            </div>
                            <div class="modal-body">
                              <div class="form">
                                {{ Form::open(['class'=>'form-horizontal', 'url' => 'admin/addanimicon']) }}
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-6">
                                      <div data-on="success" data-off="primary" class="make-switch">
                                        <input type="checkbox" name="animated[active]" value="1" checked="checked"/>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Line 1 Text</label>
                                    <div class="col-md-6">
                                      <input type="text" name="animated[text1]" class="form-control" placeholder="Free">
                                    </div>
                                  </div>
								  <input type="hidden" name="type" value="icon" />
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Line 2 Text</label>
                                    <div class="col-md-6">
                                      <input type="text" name="animated[text2]" class="form-control" placeholder="Delivery">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Icon <span class='require'>*</span></label>
                                    <div class="col-md-6">
                                      <input type="text" name="animated[icon]" class="form-control" id="inputContent" placeholder="fa-truck">
                                      <div class="help-block">Please refer here for more <a href="icon" target="_blank">icon options.</a></div>
                                    </div>
                                  </div>
                                  
                                  <div class="form-actions">
                                    <div class="col-md-offset-5 col-md-8"> <a href="#" class="ft_save btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                  </div>
                                {{ Form::close() }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--END MODAL Add New Objective-->
                      <!--Modal delete selected items start-->
                      <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                            </div>
                            <div class="modal-body">
							  <div id="wbx_who_delete"></div>
                              <div class="form-actions">
                                <div class="col-md-offset-4 col-md-8"> <a href="/" id="dellselobj" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                                <div class="col-md-offset-4 col-md-8"> <a href="/" id="dellallobj" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- modal delete all items end -->
                      {{ Form::open( [ 'url' => 'admin/deleteobj', 'class' => 'delete_text_objective form-horizontal' ] ) }}
            {{ Form::hidden('page', 'animated_list') }}
            {{ Form::hidden('index', '') }}
            {{ Form::hidden('type', 'icons') }}
            {{ Form::close() }}
                    </div>
                    <div class="portlet-body">
                      <div class="table-responsive mtl">
                          <table id="table-title-slider" class="table table-hover table-striped">
                            <thead>
                              <tr>
                                <th width="1%"><input type="checkbox"/></th>
                                <th>#</th>
                                <th>Title</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
							@if(isset($animated['icons']) && !empty($animated['icons']))
							@foreach($animated['icons'] as $key => $value)
                              <tr>
                                <td><input data="{{ $key }}" type="checkbox"/></td>
                                <td>{{ $key }}</td>
                                <td>{{ $value['text1'] }} {{ $value['text2'] }}</td>
                                <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-text{{ $key }}" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-{{ $key }}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                    <!--Modal Edit text start-->
                                    <div id="modal-edit-text{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                      <div class="modal-dialog modal-wide-width">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                            <h4 id="modal-login-label3" class="modal-title">Animated Service Icon Edit </h4>
                                          </div>
                                          <div class="modal-body">
                                            <div class="form">
                                              {{ Form::open(['class'=>'form-horizontal', 'url' => 'admin/addanimicon']) }}
                                                <div class="form-group">
                                                  <label class="col-md-3 control-label">Status</label>
                                                  <div class="col-md-6">
                                                    <div data-on="success" data-off="primary" class="make-switch">
                                                      @if(isset($value['active']) && $value['active'])
                                                  <input type="checkbox" name="animated[active]" value="1" checked="checked"/>
                                               @else
                                                  <input type="checkbox" name="animated[active]" value="1" />
                                               @endif
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label class="col-md-3 control-label">Line 1 Text </label>
                                                  <div class="col-md-6">
                                                    <input id="text" name="animated[text1]" type="text" class="form-control" placeholder="Free" value="{{ $value['text1'] }}">
                                                  </div>
                                                </div>
												<input type="hidden" name="animated[edit-icon]" value="{{ $key }}" />
												<input type="hidden" name="type" value="icon" />
                                                <div class="form-group">
                                                  <label class="col-md-3 control-label">Line 2 Text </label>
                                                  <div class="col-md-6">
                                                    <input id="text" name="animated[text2]" type="text" class="form-control" placeholder="Delivery" value="{{ $value['text2'] }}">
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Icon <span class='require'>*</span></label>
                                                    <div class="col-md-6">
                                                      <input type="text" name="animated[icon]" class="form-control" id="inputContent" placeholder="fa-truck" value="{{ $value['icon'] }}">
                                                      <div class="help-block">Please refer here for more <a href="icon" target="_blank">icon options.</a></div>
                                                    </div>
                                                  </div>
                                                <div class="form-actions">
                                                  <div class="col-md-offset-5 col-md-8"> <a href="#" class="ft_save btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                </div>
                                              {{ Form::close() }}
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                  <!--END MODAL Edit service icon -->
                                    <!--Modal delete start-->
                                    <div id="modal-delete-{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                            <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                                          </div>
										  {{ Form::open(['url' => 'admin/deloneobj']) }}
                                      {{ Form::hidden('index', $key) }}
									  {{ Form::hidden('type', 'icons') }}
                                     {{ Form::hidden('page', 'animated_list') }}
                                          <div class="modal-body">
                                            <p><strong>#{{ $key }}:</strong> {{ $value['text1'] }} {{ $value['text2'] }}</p>
                                            <div class="form-actions">
                                              <div class="col-md-offset-4 col-md-8"> <a href="#" class="del-one-txtobj btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                            </div>
                                          </div>
										  {{ Form::close() }}
                                        </div>
                                      </div>
                                  </div>
                                  <!-- modal delete end -->
                                </td>
                              </tr>
							@endforeach
							@endif
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="4"></td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                        <!-- end table responsive -->
                    </div>
                    <!-- end portlet body -->
                  </div>
                  <!-- End porlet -->
                </div>
                <!-- end tab copyright text -->
                <div id="backgroundimage" class="tab-pane fade">
                  <div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Background Image Edit</div>
                      <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                    </div>
                    <div class="portlet-body">
                      <table class="table table-hover table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Status</th>
                            <th>Title</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>
                                @if(isset($animated['image']['active']) && $animated['image']['active'])
							<span class="label label-sm label-success">Active</span>
								@else
							<span class="label label-sm label-red">Inactive</span>
								@endif</td>
                            <td>{{ $animated['image']['title'] }}</td>
                            <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-footer-background" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>
                                <!--Modal Edit footer Background image start-->
                                <div id="modal-edit-footer-background" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                  <div class="modal-dialog modal-wide-width">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                        <h4 id="modal-login-label3" class="modal-title">Background Image Edit</h4>
                                      </div>
                                      <div class="modal-body">
                                        <div class="form">
                                          {{ Form::open([ 'files' => true, 'class'=>'form-horizontal', 'url' => 'admin/addanimicon']) }}
                                            <div class="form-group">
                                              <label class="col-md-3 control-label">Status</label>
                                              <div class="col-md-6">
                                                <div data-on="success" data-off="primary" class="make-switch" id="statusSwitch">
                                                  @if(isset($animated['image']['active']) && $animated['image']['active'])
                                                  <input type="checkbox" name="image[active]" value="1" checked="checked"/>
                                               @else
                                                  <input type="checkbox" name="image[active]" value="1" />
                                               @endif
                                                </div>
                                              </div>
                                            </div>
											<input type="hidden" name="type" value="image" />
											<input type="hidden" name="image[activeStatus]" id="animatedActiveStatus" value="" />
                                            <div class="form-group">
                                              <label class="col-md-3 control-label">Title </label>
                                              <div class="col-md-6">
                                                <input id="text" name="image[title]" type="text" class="form-control" placeholder="Background Image" value="{{ $animated['image']['title'] }}">
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="col-md-3 control-label">Upload Background Image <span class='require'>*</span></label> 
                                              <div class="col-md-9">
                                                <div class="text-15px margin-top-10px"> <img src= "http://www.tbm.com.my/web88/images/{{ $animated['image']['img'] }}"alt="Footer" class="img-responsive"><br/>
                                                    <input id="exampleInputFile2" name="img" type="file"/>
                                                    <br/>
                                                    <span class="help-block">(Image dimension: 1450 x 550 pixels, JPEG/GIF/PNG only, Max. 1MB) </span> </div>
                                              </div>
                                            </div>
                                            <div class="form-actions">
                                              <div class="col-md-offset-5 col-md-8"> <a href="#" class="ft_save btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                            </div>
                                          {{ Form::close() }}
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              <!--END MODAL Edit footer background image -->
                            </td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="4"></td>
                          </tr>
                        </tfoot>
                      </table>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
                <!-- end background image -->
                
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
                <div class="copyright"><span class="text-15px">2015 � <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
                	<div class="pull-right"><img src="images/logo_webqom.png" alt="Webqom Technologies Sdn Bhd"></div>
                </div>
        </div>
    <!--END FOOTER--></div>
  <!--END PAGE WRAPPER--></div>
</div>
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<!--loading bootstrap js-->
<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<script src="vendors/metisMenu/jquery.metisMenu.js"></script>
<script src="vendors/slimScroll/jquery.slimscroll.js"></script>
<script src="vendors/jquery-cookie/jquery.cookie.js"></script>
<script src="js/jquery.menu.js"></script>
<script src="vendors/jquery-pace/pace.min.js"></script>

<!--LOADING SCRIPTS FOR PAGE-->
<script src="vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="vendors/moment/moment.js"></script>
<script src="vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="vendors/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script src="vendors/bootstrap-clockface/js/clockface.js"></script>
<script src="vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="vendors/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="vendors/jquery-maskedinput/jquery-maskedinput.js"></script>
<script src="js/form-components.js"></script>
<!--LOADING SCRIPTS FOR PAGE-->

<!-- InstanceBeginEditable name="EditRegion4" -->
<script src="vendors/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="vendors/ckeditor/ckeditor.js"></script>
<script src="js/ui-tabs-accordions-navs.js"></script>
<script src="js/myscripts.js"></script>
<!-- InstanceEndEditable -->
<script>
function remember(item){
		var cookieName = 'tabSelected';
		var cookieOptions = {expires: 7, path: '/'};
			$.cookie(cookieName, item, cookieOptions);
	}
	$('#myTab > li').click(function(){
		var tab = $('#myTab > li').index($(this));
		remember(tab);
	});
	if($.cookie('tabSelected')){
		console.log($.cookie('tabSelected'));
		$('#myTab > li').removeClass('active');
		$('#myTab > li:eq(' + $.cookie('tabSelected') + ')').addClass('active');
		if($.cookie('tabSelected') == '1'){
			$('#backgroundimage').attr('class', 'tab-pane fade active in');
			$('#services-icons').attr('class', 'tab-pane fade');
		}else{
			$('#services-icons').attr('class', 'tab-pane fade active in');
			$('#backgroundimage').attr('class', 'tab-pane fade');
		}
	}

</script>

<!--CORE JAVASCRIPT-->
<script src="js/main.js"></script>
<script src="js/holder.js"></script>
</body>
<!-- InstanceEnd --></html>