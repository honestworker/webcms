<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/cms_admin_global_setup.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Footer:: Edit</title>
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
@include('backend.topbar')
        
@include('backend.menu')
        
      <div id="page-wrapper"><!--BEGIN PAGE HEADER & BREADCRUMB-->
        
        <div class="page-header-breadcrumb">
          <div class="page-heading hidden-xs">
            <h1 class="page-title">Global Settings</h1>
          </div>
          
          <!-- InstanceBeginEditable name="EditRegion1" -->
          <ol class="breadcrumb page-breadcrumb">
            <li><i class="fa fa-home"></i>&nbsp;<a href="dashboard.html">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
            <li>Global Settings &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li class="active">Footer - Edit</li>
          </ol>
          <!-- InstanceEndEditable --></div>
        <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->
        <!-- InstanceBeginEditable name="EditRegion2" -->
        <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <h2>Footer <i class="fa fa-angle-right"></i> Edit</h2>
              <div class="clearfix"></div>
              <div class="alert alert-success alert-dismissable"
        @if( Session::has('success') )
        style="display: block;">
      <script>setTimeout(function(){$("body").animate({"scrollTop":0},100);},3000);</script>
      <? Session::forget('success') ?>
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
      <? Session::forget('fail') ?>
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
              <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a href="#copyrighttext" data-toggle="tab">Copyright Text</a></li>
                <li><a href="#footerimage" data-toggle="tab">Footer Image</a></li>
                <li><a href="#social-link" data-toggle="tab">Social Links</a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div id="copyrighttext" class="tab-pane fade in active">
                  <div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Copyright Text</div>
                      <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                    </div>
                    <div class="portlet-body">
                    	<div class="table-responsive mtl">
                          <table class="table table-hover table-striped">
                            <thead>
                              <tr>
                                <th width="1%"><input type="checkbox"/></th>
                                <th>#</th>
                                <th>Title</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><input type="checkbox"/></td>
                                <td>1</td>
                                <td>{{ $info['copyright']['copyright'] }}</td>
                                <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-text" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> 
                                    <!--Modal Edit copyright start-->
                                    <div id="modal-edit-text" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                      <div class="modal-dialog modal-wide-width">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                            <h4 id="modal-login-label3" class="modal-title">Copyright Text Edit</h4>
                                          </div>
                                          <div class="modal-body">
										   <div class="form">
                                            {{ Form::open( [ 'id' => 'wbx_change_info', 'class' => "form-horizontal" ] ) }}
                                                <div class="form-group">
                                                  <label class="col-md-3 control-label">Copyright Text</label>
                                                  <div class="col-md-9">
                                                    <div class="text-blue border-bottom">You can edit the content by clicking the text section below.</div>
                                                    <div class="wbx_info empty-height" name="footer[copyright]" contenteditable="true">{{ $info['copyright']['copyright'] }}</div>
                                                  </div>
                                                </div>
												<input name="footer[type]"  value="copyright" type="hidden"/>
                                                <div class="form-actions">
                                                  <div class="col-md-offset-5 col-md-8"> <a href="#" data="copy" class="wbx_submit btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                </div>
                                              {{Form::close()}}
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                  <!--END MODAL Edit copyright -->
                                </td>
                              </tr>
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
                <div id="footerimage" class="tab-pane fade">
                  <div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Footer Image Edit</div>
                      <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                    </div>
                    <div class="portlet-body">
                      <div class="table-responsive mtl">
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
                                <td>@if(isset($info['image']['active']) && $info['image']['active'])
							<span class="label label-sm label-success">Active</span>
								@else
							<span class="label label-sm label-red">Inactive</span>
								@endif</td>
                                <td>{{ $info['image']['title'] }}</td>
                                <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-footer-background" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>
                                    <!--Modal Edit footer Background image start-->
                                    <div id="modal-edit-footer-background" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                      <div class="modal-dialog modal-wide-width">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                            <h4 id="modal-login-label3" class="modal-title">Footer Background Image Edit</h4>
                                          </div>
                                          <div class="modal-body">
                                            <div class="form">
                                              {{ Form::open( [ 'files' => true, 'class' => "form-horizontal" ] ) }}
                                                <div class="form-group">
                                                  <label class="col-md-3 control-label">Status</label>
                                                  <div class="col-md-6">
                                                    <div data-on="success" data-off="primary" class="make-switch">
                                                      @if(isset($info['image']['active']) && $info['image']['active'])
                                                  <input type="checkbox" name="footer[active]" value="1" checked="checked"/>
                                               @else
                                                  <input type="checkbox" name="footer[active]" value="1" />
                                               @endif
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label class="col-md-3 control-label">Title </label>
                                                  <div class="col-md-6">
                                                    <input id="text" name="footer[title]" type="text" class="form-control" placeholder="Footer Background Image" value="{{ $info['image']['title'] }}">
                                                  </div>
                                                </div>
												<input type="hidden" value="image" name="footer[type]"/>
                                                <div class="form-group">
                                                  <label class="col-md-3 control-label">Upload Background Image <span class='require'>*</span></label>
                                                  <div class="col-md-9">
                                                    <div class="text-15px margin-top-10px"> <img src="../images/{{ $info['image']['fg'] }}" alt="Footer" class="img-responsive"><br/>
                                                        <input id="exampleInputFile2" type="file" name="fg"/>
                                                        <br/>
                                                        <span class="help-block">(Image dimension: 1920 x 175 pixels, JPEG/GIF/PNG only, Max. 1MB) </span> </div>
                                                  </div>
                                                </div>
                                                <div class="form-actions">
                                                  <div class="col-md-offset-5 col-md-8"> <a href="#" class="ft_save btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                </div>
                                              {{Form::close()}}
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
                      </div>
                      <!-- end table responsive -->
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
                <!-- end background image -->
                <div id="social-link" class="tab-pane fade">
                  <div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Social Links</div>
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
                               {{ Form::open(['class'=>'form-horizontal']) }}
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-6">
                                      <div data-on="success" data-off="primary" class="make-switch">
                                        <input type="checkbox" name="footer[active]" value="1" checked="checked"/>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Title</label>
                                    <div class="col-md-6">
                                      <input type="text" name="footer[title]" class="form-control" placeholder="Facebook">
                                    </div>
                                    <div class="col-md-3"> </div>
                                  </div>
								  <input type="hidden" value="icon" name="footer[type]"/>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Icon <span class='require'>*</span></label>
                                    <div class="col-md-6">
                                      <input type="text" name="footer[icon]" class="form-control" id="inputContent" placeholder="icon-facebook">
                                      <div class="help-block">Please refer here for more <a href="icon" target="_blank">icon options.</a></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Website URL</label>
                                    <div class="col-md-6">
                                      <div class="input-icon"><i class="fa fa-link"></i>
                                          <input type="text" name="footer[link]" placeholder="http://" class="form-control"/>
                                      </div>
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
                                <div class="col-md-offset-4 col-md-8"> <a href="#" id="dellselobj" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                                <div class="col-md-offset-4 col-md-8"> <a href="#" id="dellallobj" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
					  {{ Form::open( [ 'url' => 'admin/deleteobj', 'class' => 'delete_text_objective form-horizontal' ] ) }}
            {{ Form::hidden('page', 'footer_setup') }}
            {{ Form::hidden('index', '') }}
            {{ Form::hidden('type', 'icon') }}
            {{ Form::close() }}
                      <!-- modal delete all items end -->
                    </div>
                    <div class="portlet-body">
                      <div class="table-responsive mtl">
                          <table id="table-title-slider" class="table table-hover table-striped">
                            <thead>
                              <tr>
                                <th width="1%"><input type="checkbox"/></th>
                                <th>#</th>
                                <th>Title</th>
                                <th>URL</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
							@if(isset($info['icon']) && !empty($info['icon']))
							@foreach($info['icon'] as $key => $value)
                              <tr>
                                <td><input data="{{ $key }}" type="checkbox"/></td>
                                <td>{{ $key }}</td>
                                <td>{{ $value['title'] }}</td>
                                <td>{{ $value['link'] }}</td>
                                <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-link{{ $key }}" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-{{ $key }}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                    <!--Modal Edit social links start-->
                                    <div id="modal-edit-link{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                      <div class="modal-dialog modal-wide-width">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                            <h4 id="modal-login-label3" class="modal-title">Social Links Edit</h4>
                                          </div>
                                          <div class="modal-body">
                                            <div class="form">
                                              {{ Form::open(['class'=>'form-horizontal']) }}
                                                <div class="form-group">
                                                  <label class="col-md-3 control-label">Status</label>
                                                  <div class="col-md-6">
                                                    <div data-on="success" data-off="primary" class="make-switch">
                                               @if(isset($value['active']) && $value['active'])
                                                  <input type="checkbox" name="footer[active]" value="1" checked="checked"/>
                                               @else
                                                  <input type="checkbox" name="footer[active]" value="1" />
                                               @endif
                                                    </div>
                                                  </div>
                                                </div>
												<input type="hidden" name="footer[edit-icon]" value="{{ $key }}" />
                                                <div class="form-group">
                                                  <label class="col-md-3 control-label">Title </label>
                                                  <div class="col-md-6">
                                                    <input id="text" name="footer[title]" type="text" class="form-control" placeholder="Facebook" value="{{ $value['title'] }}">
                                                  </div>
                                                </div>
												<input type="hidden" name="footer[type]" value="icon" />
                                                <div class="form-group">
                                                  <label class="col-md-3 control-label">Icon <span class='require'>*</span></label>
                                                  <div class="col-md-6">
                                                    <input type="text" name="footer[icon]" class="form-control" id="inputContent" placeholder="icon-facebook" value="{{ $value['icon'] }}">
                                                    <div class="help-block">Please refer here for more <a href="icon" target="_blank">icon options.</a></div>
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label class="col-md-3 control-label">Website URL</label>
                                                  <div class="col-md-6">
                                                    <div class="input-icon"><i class="fa fa-link"></i>
                                                        <input type="text" name="footer[link]" placeholder="http://" class="form-control" value="{{ $value['link'] }}"/>
                                                    </div>
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
                                  <!--END MODAL Edit social links -->
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
									  {{ Form::hidden('type', 'icon') }}
                                     {{ Form::hidden('page', 'footer_setup') }}
                                          <div class="modal-body">
                                            <p><strong>#{{ $key }}:</strong> {{ $value['title'] }}.</p>
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
                                <td colspan="5"></td>
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
                <!-- end tab social links -->
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
<div class="page-footer" style="width: 100%;">
                <div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
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
		console.log($.cookie('tabSelected'));
	});
	
if($.cookie('tabSelected')){
		$('#myTab > li').removeClass('active');
		$('#myTab > li:eq(' + $.cookie('tabSelected') + ')').addClass('active');
		if($.cookie('tabSelected') == '0'){
			$('#copyrighttext').attr('class', 'tab-pane fade active in');
			$('#footerimage').attr('class', 'tab-pane fade');
			$('#social-link').attr('class', 'tab-pane fade');
		}else if($.cookie('tabSelected') == '1'){
			$('#copyrighttext').attr('class', 'tab-pane fade');
			$('#footerimage').attr('class', 'tab-pane fade active in');
			$('#social-link').attr('class', 'tab-pane fade');
		}else if($.cookie('tabSelected') == '2'){
			$('#copyrighttext').attr('class', 'tab-pane fade');
			$('#footerimage').attr('class', 'tab-pane fade');
			$('#social-link').attr('class', 'tab-pane fade active in');
		}
	}
</script>

<!--CORE JAVASCRIPT-->
<script src="js/main.js"></script>
<script src="js/holder.js"></script>

<script type="text/javascript">
/* Fix for bootstrap modal + ckeditor + chrome */
CKEDITOR.disableAutoInline = true;

$('.modal').on('shown.bs.modal', function () {
	$(this).find('[contenteditable="true"]').each(function (i) {
		if (this.id == '') {
			this.id = 'ckedit_'+i;
		}
	//	alert(this.id);
		if(CKEDITOR.instances[this.id] === undefined) {
			CKEDITOR.inline(this.id);
		}
	});
});
</script>

</body>
<!-- InstanceEnd --></html>