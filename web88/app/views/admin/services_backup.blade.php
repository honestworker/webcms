<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/cms_admin_about_us_edit.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Services:: Edit</title>
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
        
        <!--BEGIN SIDEBAR MENU-->
@include('backend.menu')
        <!--END SIDEBAR MENU--><!--BEGIN PAGE WRAPPER-->
      <div id="page-wrapper"><!--BEGIN PAGE HEADER & BREADCRUMB-->
        
        <div class="page-header-breadcrumb">
          <div class="page-heading hidden-xs">
            <h1 class="page-title">CMS Pages</h1>
          </div>
          
          <!-- InstanceBeginEditable name="EditRegion1" -->
          <ol class="breadcrumb page-breadcrumb">
            <li><i class="fa fa-home"></i>&nbsp;<a href="dashboard.html">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
            <li>CMS Pages &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li class="active">Services - Edit</li>
          </ol>
          <!-- InstanceEndEditable --></div>
        <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->
        <!-- InstanceBeginEditable name="EditRegion2" -->
        <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <h2>Services <i class="fa fa-angle-right"></i> Edit</h2>
              <div class="clearfix"></div>
              <div class="alert alert-success alert-dismissable"
			  @if( Session::get('success') )
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
			@if( Session::get('fail') )
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
              
              <div class="portlet">
                <div class="portlet-header">
                  <div class="caption">Page Info</div>
                  <br/>
                  <span class="text-blue text-12px">You can edit the content by clicking the text section below.</span>
                  <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                </div>
                <div class="portlet-body">
                  <div class="wbx_info" name="header" contenteditable="true">
					{{ $data['header'] }}
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
 
              <div class="portlet">
                <div class="portlet-header">
                  <div class="caption">Page Content</div>
                  <br/>
                  <span class="text-blue text-12px">You can edit the content by clicking the text section below.</span>
                  <div class="tools"><i class="fa fa-chevron-up"></i></div>
                </div>
                <div class="portlet-body">
               		Please fix the red bottom border missing issue due to inline editor 
    				<!-- our services start -->
                    <div id="wbx_edit_icons" class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12 service-box-container small-services">
                                <div class="services-box">
                                    <div name="icon[0][img]" class="items wbx_info">
									{{ $data['icon'][0]['img'] }}
                                    </div>
                                    <div class="wbx_info" name="icon[0][title]" contenteditable="true">
                                    	{{ $data['icon'][0]['title'] }}
                                    </div>
                                    <div class="wbx_info" name="icon[0][sm-descr]" contenteditable="true">
                                    	{{ $data['icon'][0]['sm-descr'] }}
                                    </div>
                                    <a href="#" class="label label-primary" data-toggle="modal" data-target="#modal-delivery-installation">Edit Terms &amp; Conditions</a> 
                                    <div class="sm-margin"></div>
                                </div>
                        	</div>
                            <!-- end delivery & installation -->
                            <!--Modal edit icon start-->
                                  <div id="modal-edit-icon" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                    <div class="modal-dialog modal-wide-width">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                          <h4 id="modal-login-label2" class="modal-title">Edit Icon</h4>
                                        </div>
                                        <div class="modal-body">
                                          <div class="form">
                                            <form class="form-horizontal">
                                              
                                              <div class="form-group">
                                                <label class="col-md-3 control-label">Icon <span class='require'>*</span></label>
                                                <div class="col-md-6">
                                                  <input type="text" class="form-control" id="inputContent" value="truck">
                                                  <div class="help-block">Please refer here for more <a href="icon" target="_blank">icon options.</a></div>
                                                </div>
                                              </div>
    
                                              <div class="form-actions">
                                                <div class="col-md-offset-5 col-md-8"> <a href="#" id="wbx_save_icon" data-dismiss="modal" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                              </div>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!--END MODAL edit icon -->
                            
                            <div class="col-md-4 col-sm-4 col-xs-12 service-box-container small-services">
                                <div class="services-box">
                                    <div name="icon[1][img]" class="items wbx_info">
                                        {{ $data['icon'][1]['img'] }}
                                    </div>
                                    <div class="wbx_info" name="icon[1][title]" contenteditable="true">
                                    	{{ $data['icon'][1]['title'] }}
                                    </div>
                                    <div class="wbx_info" name="icon[1][sm-descr]" contenteditable="true">
                                    	{{ $data['icon'][1]['sm-descr'] }}
                                    </div>
                                    <a href="#" class="label label-primary" data-toggle="modal" data-target="#modal-product-reservation">Edit Terms &amp; Conditions</a> 
                                    <div class="sm-margin"></div>
                                </div>
                            </div>
                            <!-- end product reservation -->
                            
                            <div class="col-md-4 col-sm-4 col-xs-12 service-box-container small-services">
                                <div class="services-box">
                                    <div name="icon[2][img]" class="items wbx_info">
                                        {{ $data['icon'][2]['img'] }}
                                    </div>
                                    <div class="wbx_info" name="icon[2][title]" contenteditable="true">
                                    	{{ $data['icon'][2]['title'] }}
                                    </div>
                                    <div class="wbx_info" name="icon[2][sm-descr]" contenteditable="true">
                                    	{{ $data['icon'][2]['sm-descr'] }}
                                    </div>
                                    <a href="#" class="label label-primary" data-toggle="modal" data-target="#modal-credit-card">Edit Terms &amp; Conditions</a> 
                                    <div class="sm-margin"></div>
                                </div>
                            </div>
                            <!-- end credit card point redemption -->
                            <div class="md-margin clearfix"></div>
                            
                            
                            <div class="col-md-4 col-sm-4 col-xs-12 service-box-container small-services">
                                <div class="services-box">
                                    <div name="icon[3][img]" class="items wbx_info">
                                        {{ $data['icon'][3]['img'] }}
                                    </div>
                                    <div class="wbx_info" name="icon[3][title]" contenteditable="true">
                                    	{{ $data['icon'][3]['title'] }}
                                    </div>
                                    <div class="wbx_info" name="icon[3][sm-descr]" contenteditable="true">
                                    	{{ $data['icon'][3]['sm-descr'] }}
                                    </div>
                                    <a href="#" class="label label-primary" data-toggle="modal" data-target="#modal-instalment-plan">Edit Terms &amp; Conditions</a> 
                                    <div class="sm-margin"></div>
                                </div>
                        	</div>
                            <!-- end instalment plans -->
                            
                            <div class="col-md-4 col-sm-4 col-xs-12 service-box-container small-services">
                                <div class="services-box">
                                    <div name="icon[4][img]" class="items wbx_info">
                                        {{ $data['icon'][4]['img'] }}
                                    </div>
                                    <div class="wbx_info" name="icon[4][title]" contenteditable="true">
                                    	{{ $data['icon'][4]['title'] }}
                                    </div>
                                    <div class="wbx_info" name="icon[4][sm-descr]" contenteditable="true">
                                    	{{ $data['icon'][4]['sm-descr'] }}
                                    </div>
                                    <a href="#" class="label label-primary" data-toggle="modal" data-target="#modal-extended-warranty">Edit Terms &amp; Conditions</a> 
                                    <div class="sm-margin"></div>
                                </div>
                        	</div>
                            <!-- end extended warranty -->
                            
                            <div class="col-md-4 col-sm-4 col-xs-12 service-box-container small-services">
                                <div class="services-box">
                                    <div name="icon[5][img]" class="items wbx_info">
                                        {{ $data['icon'][5]['img'] }}
                                    </div>
                                    <div class="wbx_info" name="icon[5][title]" contenteditable="true">
                                    	{{ $data['icon'][5]['title'] }}
                                    </div>
                                    <div class="wbx_info" name="icon[5][sm-descr]" contenteditable="true">
                                    	{{ $data['icon'][5]['sm-descr'] }}
                                    </div>
                                    <a href="#" class="label label-primary" data-toggle="modal" data-target="#modal-product-exchange">Edit Terms &amp; Conditions</a> 
                                    <div class="sm-margin"></div>
                                </div>
                        	</div>
                            <!-- end product exchange -->
                            <div class="md-margin clearfix"></div>
                            
                            <div class="col-md-4 col-sm-4 col-xs-12 service-box-container small-services">
                                <div class="services-box">
                                    <div name="icon[6][img]" class="items wbx_info">
                                        {{ $data['icon'][6]['img'] }}
                                    </div>
                                    <div class="wbx_info" name="icon[6][title]" contenteditable="true">
                                    	{{ $data['icon'][6]['title'] }}
                                    </div>
                                    <div class="wbx_info" name="icon[6][sm-descr]" contenteditable="true">
                                    	{{ $data['icon'][6]['sm-descr'] }}
                                    </div>
                                    <a href="#" class="label label-primary" data-toggle="modal" data-target="#modal-accessories-spare-parts">Edit Terms &amp; Conditions</a> 
                                    <div class="sm-margin"></div>
                                </div>
                        	</div>
                            <!-- end accessories & spare parts -->
                            
                        </div>
                    <!-- end our services --> 
                    
                    <!--Modal edit delivery installation start-->
                          <div id="modal-delivery-installation" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog modal-wide-width">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                  <h4 id="modal-login-label2" class="modal-title">Edit Terms &amp; Conditions</h4>
                                </div>
                                <div class="modal-body">
                                	<div class="wbx_info" name="icon[0][descr]" contenteditable="true">
                                        {{ $data['icon'][0]['descr'] }}
                                     </div>
                                     <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--END MODAL edit delivery installation-->
                          
                          <!--Modal edit product reservation start-->
                          <div id="modal-product-reservation" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog modal-wide-width">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                  <h4 id="modal-login-label2" class="modal-title">Edit Terms &amp; Conditions</h4>
                                </div>
                                <div class="modal-body">
                                	<div class="wbx_info" name="icon[1][descr]" contenteditable="true">
                                    	{{ $data['icon'][1]['descr'] }}
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--END MODAL edit product reservation-->  
                          
                          <!--Modal edit credit card start-->
                          <div id="modal-credit-card" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog modal-wide-width">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                  <h4 id="modal-login-label2" class="modal-title">Edit Terms &amp; Conditions</h4>
                                </div>
                                <div class="modal-body">
                                	<div class="wbx_info" name="icon[2][descr]" contenteditable="true">
                                    	{{ $data['icon'][2]['descr'] }}
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--END MODAL edit credit card-->  
                          
                          <!--Modal edit instalment plans start-->
                          <div id="modal-instalment-plan" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog modal-wide-width">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                  <h4 id="modal-login-label2" class="modal-title">Edit Terms &amp; Conditions</h4>
                                </div>
                                <div class="modal-body">
                                	<div class="wbx_info" name="icon[3][descr]" contenteditable="true">
                                    	{{ $data['icon'][3]['descr'] }}
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--END MODAL edit instalment plans--> 
                          
                          <!--Modal edit extended warranty start-->
                          <div id="modal-extended-warranty" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog modal-wide-width">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                  <h4 id="modal-login-label2" class="modal-title">Edit Terms &amp; Conditions</h4>
                                </div>
                                <div class="modal-body">
                                	<div class="wbx_info" name="icon[4][descr]" contenteditable="true">
                                    	{{ $data['icon'][4]['descr'] }}
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--END MODAL edit extended warranty-->  
                          
                          <!--Modal edit product exchange start-->
                          <div id="modal-product-exchange" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog modal-wide-width">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                  <h4 id="modal-login-label2" class="modal-title">Edit Terms &amp; Conditions</h4>
                                </div>
                                <div class="modal-body">
                                	<div class="wbx_info" name="icon[5][descr]" contenteditable="true">
                                    	{{ $data['icon'][5]['descr'] }}
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--END MODAL edit product exchange-->
                          
                          <!--Modal edit accessories & spare parts start-->
                          <div id="modal-accessories-spare-parts" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog modal-wide-width">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                  <h4 id="modal-login-label2" class="modal-title">Edit Terms &amp; Conditions</h4>
                                </div>
                                <div class="modal-body">
                                	<div  class="wbx_info" name="icon[6][descr]" contenteditable="true">
                                    	{{ $data['icon'][6]['descr'] }}
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--END MODAL edit accessories & spare parts -->
                        {{ Form::open( [ 'id' => 'wbx_change_info' ] ) }}
						{{Form::close()}}
		                	
                </div>
                <!-- End portlet body -->
              </div>
              <!-- End portlet -->
              
              <div class="form-actions none-bg"> <a data="preview" href="#preview in browser/not yet published" class="wbx_submit btn btn-red">Save &amp; Preview &nbsp;<i class="fa fa-search"></i></a>&nbsp; <a data="publish" href="#publish online" class="wbx_submit btn btn-blue">Save &amp; Publish &nbsp;<i class="fa fa-globe"></i></a>&nbsp; <a href="#" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
            </div>
          </div>
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
<!-- InstanceEndEditable -->
<script type="text/javascript">

    $('.wbx_info').click(function() {
            var mainObject = $(this);
            var name;
            for(name in CKEDITOR.instances) {
                var instance = CKEDITOR.instances[name];
                instance.on('focus', function () {
                    instance.setReadOnly(false);
                });
                if(this && this == instance.element.$) {
                    return;
                }
            }
            $(this).attr('contenteditable', true);
            mainObject.blur();
            mainObject.click();
            CKEDITOR.inline(this);

        });

</script>

<!--CORE JAVASCRIPT-->
<script src="js/main.js"></script>
<script src="js/holder.js"></script>
<script src="js/myscripts.js"></script>
</body>
<!-- InstanceEnd --></html>