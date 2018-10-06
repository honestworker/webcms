<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/cms_admin_global_setup.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Header:: Edit</title>
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
            <li class="active">Header - Edit</li>
          </ol>
          <!-- InstanceEndEditable --></div>
        <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->
        <!-- InstanceBeginEditable name="EditRegion2" -->
        <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <h2>Header <i class="fa fa-angle-right"></i> Edit</h2>
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
                <li class="active"><a href="#headertext" data-toggle="tab">Header Text</a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div id="headertext" class="tab-pane fade in active">
                  <div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Header Text</div>
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
                              <td>{{ $data['info'] }}</td>
                              <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-text" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-1" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                  <!--Modal Edit copyright start-->
                                  <div id="modal-edit-text" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                    <div class="modal-dialog modal-wide-width">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                          <h4 id="modal-login-label3" class="modal-title">Header Text Edit</h4>
                                        </div>
                                        <div class="modal-body">
                                          <div class="form">
											{{ Form::open( [ 'id' => 'wbx_change_info', 'class' => "form-horizontal" ] ) }}
                                              <div class="form-group">
                                                <label class="col-md-3 control-label">Header Text</label>
                                                <div class="col-md-9">
                                                  <div class="text-blue border-bottom">You can edit the content by clicking the text section below.</div>
                                                  <div class="wbx_info" name="header[info]" contenteditable="true">{{ $data['info'] }}</div>
                                                </div>
                                              </div>
                                              <div class="form-actions">
                                                <div class="col-md-offset-5 col-md-8"> <a href="#" data="header-setup" class="wbx_submit btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                              </div>
                                            {{Form::close()}}
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <!--END MODAL Edit copyright -->
                                  <!--Modal delete start-->
                                  <div id="modal-delete-1" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                          <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                                        </div>
                                        <div class="modal-body">
                                          <p><strong>#1:</strong> {{ $data['info'] }}</p>
                                          <div class="form-actions">
                                            <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <!-- modal delete end -->
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
                <!-- end tab header text -->
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


<!--CORE JAVASCRIPT-->
<script src="js/main.js"></script>
<script src="js/holder.js"></script>
</body>
<!-- InstanceEnd --></html>