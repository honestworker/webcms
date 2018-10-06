<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/cms_admin_about_us_edit.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Contact Us:: Edit</title>
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
	{{HTML::style('admin/css/jquery.dataTables.css')}}
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
            <li class="active">Contact Us - Edit</li>
          </ol>
          <!-- InstanceEndEditable --></div>
        <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->
        <!-- InstanceBeginEditable name="EditRegion2" -->
        <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <h2>Contact Us <i class="fa fa-angle-right"></i> Edit</h2>
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
                  
                  	<div class="hero-unit">
                    	<div class="wbx_info" name="contacts[header]" contenteditable="true">
                        	{{ $data['header'] }}
                        </div>
                        <span class="small-bottom-border big"></span>
                        <div class="wbx_info" name="contacts[title]" contenteditable="true">
                        	{{ $data['title'] }}
                        </div>
                        <div class="md-margin2x"></div>
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
					
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="wbx_info" name="contacts[lone]" contenteditable="true">	
                            {{ $data['lone'] }}
                       </div>
                       <div class="xs-margin"></div>  
                       <div class="wbx_info" name="contacts[ltwo]" contenteditable="true">       
                             {{ $data['ltwo'] }}
                         </div>
                 	 </div>
                  	 <!-- col-md-6 -->
                        
                     <div class="col-md-6 col-sm-6 col-xs-12">
                     	<div class="wbx_info" name="contacts[rone]" contenteditable="true">   	
                            {{ $data['rone'] }}
                       </div>     
                       <div class="xs-margin"></div>
                       <div class="wbx_info" name="contacts[rtwo]" contenteditable="true">
                            {{ $data['rtwo'] }}
                       </div>
                	</div>
                    <!-- col-md-6 -->
                        
					<div class="clearfix"></div>
                    <div class="xlg-margin"></div>
                    <hr>
                    <div class="md-margin"></div>
                     
                    <div class="wbx_info" name="contacts[footer]" contenteditable="true">    
                        {{ $data['footer'] }}
                    </div>
                    
                    <!-- end contact us -->
               
 
                </div>
                <!-- End portlet body -->
                 {{ Form::open( [ 'id' => 'wbx_change_info' ] ) }}
				 {{Form::close()}}
                <!-- save button start -->
              <div class="form-actions none-bg"> <a data="preview" href="#preview in browser/not yet published" class="wbx_submit btn btn-red">Save &amp; Preview &nbsp;<i class="fa fa-search"></i></a>&nbsp; <a data="publish" href="#publish online" class="wbx_submit btn btn-blue">Save &amp; Publish &nbsp;<i class="fa fa-globe"></i></a>&nbsp; <a href="#" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
              <!-- save button end -->
                
              </div>
              <!-- End portlet -->
              
			  <div class="portlet">
                <div class="portlet-header">
                  <div class="caption">Online Feedback Listing</div>
                  <br/>
                  <p class="margin-top-10px"></p>
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary">Delete</button>
                    <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                    <ul role="menu" class="dropdown-menu">
                      <li><a href="#" id="dellselobjcont" data-target="#modal-delete-selected" data-toggle="modal">Delete selected item(s)</a></li>
                      <li class="divider"></li>
                      <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                    </ul>
                  </div>
                   
<div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                  <!--Modal delete selected items start-->
                  <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                        </div>
                        <div class="modal-body">
						<div id="wbx_who_delete"></div>
                          <div class="form-actions">
                            <div class="col-md-offset-4 col-md-8"> <a href="#" id="dellselobj" data-dismiss="modal" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                            <div class="col-md-offset-4 col-md-8"> <a href="#" data-dismiss="modal" id="dellallobj" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- modal delete all items end -->
                </div>
                <div class="portlet-body">
                  
                  <div class="table-responsive mtl">
                      <table id="table-title-slider" class="table table-hover table-striped">
                        <thead>
                          <tr>
                            <th width="1%"><input type="checkbox"/></th>
                            <th>#</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
						@if(isset($feedback) && !empty($feedback))
						@foreach($feedback as $key => $item)
                          <tr>
                            <td><input data="{{ $key }}" type="checkbox"/></td>
                            <td>{{ $key }}</td>
                            <td><span class="label label-sm label-success">Active</span></td>
                            <td>{{ date("jS D, Y", $item['time']) }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-view-details{{ $key }}" data-toggle="modal" title="View Details"><span class="label label-sm label-yellow"><i class="fa fa-search"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-{{ $key }}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                <!--Modal view details start-->
                                <div id="modal-view-details{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                  <div class="modal-dialog modal-wide-width">
                                    <div class="modal-content" id="printingDiv">
                                      <div class="modal-header">
                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                        <h4 id="modal-login-label3" class="modal-title">View Details</h4>
                                      </div>
                                      <div class="modal-body">
                                        <form action="#" class="form-horizontal">
                                          <div class="form-body pal">
                                            <h3 class="block-heading">General</h3>
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputFirstName" class="col-md-4 control-label">Name:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">{{ $item['name'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputPhone" class="col-md-4 control-label">Telephone:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">{{ $item['phone'] }}</p>
                                                  </div>
                                                </div>  
                                              </div>
                                              
                                            </div>
                                            <!-- end row -->
                                            
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputLastName" class="col-md-4 control-label">Company Name:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">{{ $item['company'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                              
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputLastName" class="col-md-4 control-label">Occupation:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">{{ $item['occupation'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                              
                                              
                                              
                                            </div>
                                            <!-- end row -->
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputEmail" class="col-md-4 control-label">Email:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static"><a href="mailto:hock@webqom.com">{{ $item['email'] }}</a></p>
                                                  </div>
                                                </div>
                                              </div>
                                                
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputPhone" class="col-md-4 control-label">Fax:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">@if(isset($item['fax'])) {{ $item['fax'] }} @endif</p>
                                                  </div>
                                                </div>
                                              </div>
                                              
                                            </div>
                                            <!-- end row -->
                                            
                                            
                                            <h3 class="block-heading">Address</h3>
                                            <div class="row">
                                              
                                            </div>
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputAddress1" class="col-md-4 control-label">Address:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">{{ $item['address'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputAddress2" class="col-md-4 control-label">City:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">{{ $item['city'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputStates" class="col-md-4 control-label">State:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">{{ $item['state'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputCity" class="col-md-4 control-label">Post Code:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">{{ $item['post-code'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputPostCode" class="col-md-4 control-label">Country:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">{{ $item['country'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- End company info -->
                                            <h3 class="block-heading">Feedback / Comments / Enquiries</h3>
                                            <div class="row">
                                              <div class="col-md-12">
                                                <div class="form-group">
                                                  <label for="inputPostCode" class="col-md-2 control-label">Subject:</label>
                                                  <div class="col-md-10">
                                                    <p class="form-control-static">{{ $item['subject'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-md-12">
                                                <div class="form-group">
                                                  <label for="inputPostCode" class="col-md-2 control-label">Your Comment / Enquiry :</label>
                                                  <div class="col-md-10">
                                                    <p class="form-control-static">{{ $item['message'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="form-actions">
                                            <div class="col-md-offset-5 col-md-8"> <a href="#" data-dismiss="modal" class="btn btn-green">Close &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> <a href="javascript:void(0)" onClick="myprint({{ $key }});" class="btn btn-green">Print</a> </div>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              
								<!--END MODAL view details-->
                                <!--Modal delete start-->
                                <div id="modal-delete-{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                        <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this feedback? </h4>
                                      </div>
									  {{ Form::open(['url' => 'admin/deloneobj']) }}
										  {{ Form::hidden('index', $key) }}
										  {{ Form::hidden('page', 'contact') }}
                                      <div class="modal-body">
                                        <p><strong>#{{ $key }}:</strong> {{ date("jS D, Y", $item['time']) }} - {{ $item['name'] }}</p>
                                        <div class="form-actions">
                                          <div class="col-md-offset-4 col-md-8"> <a href="#" id="dellselobj" data-dismiss="modal" class="del-one-txtobj btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                            <td colspan="6"></td>
                          </tr>
                        </tfoot>
                      </table>
                      <div class="clearfix"></div>
                    </div>
					{{ Form::open( [ 'url' => 'admin/deleteobj', 'class' => 'delete_text_objective form-horizontal' ] ) }}
					  {{ Form::hidden('page', 'contact') }}
					  {{ Form::hidden('index', '') }}
					  {{ Form::close() }}
					  
                    <!-- end table responsive -->
                </div>
              </div>
              <!-- end portlet -->
              
              
              
              
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



















<div id="printingDivFullContent">
@if(isset($feedback) && !empty($feedback))
@foreach($feedback as $key => $item)
	<div class="form-body pal printingDiv" id="printingDiv{{ $key }}"> 
                          
                                      <div class="modal-body">
                                        <form action="#" class="form-horizontal">
                                          <div class="form-body pal">
                                            <h3 class="block-heading">General</h3>
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputFirstName" class="col-md-4 control-label">Name:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">{{ $item['name'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputPhone" class="col-md-4 control-label">Telephone:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">{{ $item['phone'] }}</p>
                                                  </div>
                                                </div>  
                                              </div>
                                              
                                            </div>
                                            <!-- end row -->
                                            
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputLastName" class="col-md-4 control-label">Company Name:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">{{ $item['company'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                              
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputLastName" class="col-md-4 control-label">Occupation:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">{{ $item['occupation'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                              
                                              
                                              
                                            </div>
                                            <!-- end row -->
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputEmail" class="col-md-4 control-label">Email:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static"><a href="mailto:hock@webqom.com">{{ $item['email'] }}</a></p>
                                                  </div>
                                                </div>
                                              </div>
                                                
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputPhone" class="col-md-4 control-label">Fax:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">@if(isset($item['fax'])) {{ $item['fax'] }} @endif</p>
                                                  </div>
                                                </div>
                                              </div>
                                              
                                            </div>
                                            <!-- end row -->
                                            
                                            
                                            <h3 class="block-heading">Address</h3>
                                            <div class="row">
                                              
                                            </div>
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputAddress1" class="col-md-4 control-label">Address:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">{{ $item['address'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputAddress2" class="col-md-4 control-label">City:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">{{ $item['city'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputStates" class="col-md-4 control-label">State:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">{{ $item['state'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputCity" class="col-md-4 control-label">Post Code:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">{{ $item['post-code'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="inputPostCode" class="col-md-4 control-label">Country:</label>
                                                  <div class="col-md-8">
                                                    <p class="form-control-static">{{ $item['country'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- End company info -->
                                            <h3 class="block-heading">Feedback / Comments / Enquiries</h3>
                                            <div class="row">
                                              <div class="col-md-12">
                                                <div class="form-group">
                                                  <label for="inputPostCode" class="col-md-2 control-label">Subject:</label>
                                                  <div class="col-md-10">
                                                    <p class="form-control-static">{{ $item['subject'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-md-12">
                                                <div class="form-group">
                                                  <label for="inputPostCode" class="col-md-2 control-label">Your Comment / Enquiry :</label>
                                                  <div class="col-md-10">
                                                    <p class="form-control-static">{{ $item['message'] }}</p>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="form-actions">
                                            <div class="col-md-offset-5 col-md-8"> <a href="#" data-dismiss="modal" class="btn btn-green">Close &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> <a href="javascript:void(0)" onClick="window.print();" class="btn btn-green">Print</a> </div>
                                          </div>
                                        </form>
                                      </div>
                                    
	</div>						  

@endforeach
@endif
</div>
<script>
function myprint(e1){
	document.getElementById('printingDiv'+e1).style.display='block';
	window.print();
	document.getElementById('printingDiv'+e1).style.display='none';
}
</script>
<!-- InstanceEndEditable -->


<!--CORE JAVASCRIPT-->
<script src="js/main.js"></script>
<script src="js/holder.js"></script>
<script src="js/myscripts.js"></script>
<script src="js/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
    $('#table-title-slider').DataTable({
    searching: false,
    ordering:  false
} );
} );
</script>
</body>
<!-- InstanceEnd -->
<style type="text/css">
#printingDivFullContent { display:none; }
#printingDivFullContent .printingDiv { display:none; }

@media print
{
body #wrapper { display:none;}
#printingDivFullContent { display:block !important; }
}
</style></html>