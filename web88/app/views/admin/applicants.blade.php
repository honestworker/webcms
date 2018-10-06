<!DOCTYPE html>
<html lang="en">
<!-- InstanceBegin template="/Templates/cms_admin_about_us_edit.dwt" codeOutsideHTMLIsLocked="false" -->

<head>
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Online Job Applicants:: Listing
    </title>
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

    <link type="text/css" rel="stylesheet" href="vendors/bootstrap/css/bootstrap.min.css">{{HTML::style('admin/css/jquery.dataTables.css')}}
<!--LOADING SCRIPTS FOR PAGE-->

    <link type="text/css" rel="stylesheet" href="vendors/bootstrap-datepicker/css/datepicker.css">

    <link type="text/css" rel="stylesheet" href="vendors/bootstrap-switch/css/bootstrap-switch.css">
    <!--Loading style vendors-->

    <link type="text/css" rel="stylesheet" href="vendors/animate.css/animate.css">

    <link type="text/css" rel="stylesheet" href="vendors/jquery-pace/pace.css">
    <!--Loading style-->

    <link type="text/css" rel="stylesheet" href="css/style.css">
    <!--

    <link type="text/css" rel="stylesheet" href="css/style.css">-->

    <link type="text/css" rel="stylesheet" href="css/style-mango.css" id="theme-style">

    <link type="text/css" rel="stylesheet" href="css/vendors.css">

    <link type="text/css" rel="stylesheet" href="css/themes/grey.css" id="color-style">

    <link type="text/css" rel="stylesheet" href="css/style-responsive.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>

<body>

<div>
    <!--BEGIN TO TOP--><a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
    <!--END BACK TO TOP-->

    <div id="wrapper">
    @include('backend.topbar')
    <!--BEGIN SIDEBAR MENU-->        @include('backend.menu')
    <!--END SIDEBAR MENU-->
        <!--BEGIN PAGE WRAPPER-->

        <div id="page-wrapper">
            <!--BEGIN PAGE HEADER & BREADCRUMB-->

            <div class="page-header-breadcrumb">

                <div class="page-heading hidden-xs">            <h1 class="page-title">CMS Pages</h1>
                </div>
                <!-- InstanceBeginEditable name="EditRegion1" -->

                <ol class="breadcrumb page-breadcrumb">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="dashboard.html">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
                    <li>CMS Pages &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
                    <li>Careers&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
                    <li class="active">Online Job Applicants - Listing</li>
                </ol>
                <!-- InstanceEndEditable -->
            </div>
            <!--END PAGE HEADER & BREADCRUMB-->
            <!--BEGIN CONTENT-->
            <!-- InstanceBeginEditable name="EditRegion2" -->

            <div class="page-content">

                <div class="row">

                    <div class="col-lg-12">              <h2>Online Job Applicants <i class="fa fa-angle-right"></i> Listing</h2>

                        <div class="clearfix">
                        </div>

                        <div class="alert alert-success alert-dismissable"        @if( Session::has('success') )        style="display: block;">
                            <script>setTimeout(function(){$("body").animate({"scrollTop":0},100);},3000);
                            </script>      <? Session::forget('success') ?>      @else        style="display: none;">      @endif                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>                <i class="fa fa-check-circle"></i> <strong>Success!</strong>

                            <p>The information has been saved/updated successfully.</p>
                        </div>

                        <div class="alert alert-danger alert-dismissable"       @if( Session::has('fail') )        style="display: block;">
                            <script>setTimeout(function(){$("body").animate({"scrollTop":0},100);},3000);
                            </script>      <? Session::forget('fail') ?>      @else        style="display: none;">      @endif                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>                <i class="fa fa-times-circle"></i> <strong>Error!</strong>

                            <p>The information has not been saved/updated. Please correct the errors.</p>
                        </div>

                        <div class="pull-left"> Last updated:

                            <span class="text-blue">{{ date('d M, Y @ g.iA', strtotime($data['updated_at'])) }}
</span>
                        </div>

                        <div class="clearfix">
                        </div>

                        <p></p>

                        <div class="portlet">

                            <div class="portlet-header">

                                <div class="caption">Page Content
                                </div>                  <br/>

                                <span class="text-blue text-12px">You can edit the content by clicking the text section below.
</span>

                                <div class="tools"> <i class="fa fa-chevron-up"></i>
                                </div>
                            </div>

                            <div class="portlet-body">

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="wbx_info" name="applicants[info]" contenteditable="true">                            	{{ $data['info'] }}
                                        </div>
                                    </div>
                                    <!-- end col-md-12 -->
                                </div>
                                <!-- end row -->
                            </div>
                            <!-- end portlet-body -->                {{ Form::open( [ 'id' => 'wbx_change_info' ] ) }}				{{Form::close()}}
                        <!-- save button start -->

                            <div class="form-actions none-bg"> <a data="preview" href="#preview in browser/not yet published" class="wbx_submit btn btn-red">Save &amp; Preview &nbsp;<i class="fa fa-search"></i></a>&nbsp; <a href="#publish online" data="publish" class="wbx_submit btn btn-blue">Save &amp; Publish &nbsp;<i class="fa fa-globe"></i></a>&nbsp; <a href="#" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a>
                            </div>
                            <!-- save button end -->
                        </div>
                        <!-- end portlet -->

                        <div class="portlet">

                            <div class="portlet-header">

                                <div class="caption">Online Job Applicants Listing
                                </div>                  <br/>

                                <p class="margin-top-10px"></p>

                                <div class="btn-group">                    <button type="button" class="btn btn-primary">Delete</button>                    <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle">

<span class="caret">
</span>

                                        <span class="sr-only">Toggle Dropdown
</span></button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a href="#" id="dellselobjapp">Delete selected item(s)</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                                    </ul>
                                </div>                   

                                <div class="tools"> <i class="fa fa-chevron-up"></i>
                                </div>

                                <div id="modal-select-confirm" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                                                <h4 class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Please Select at least one item.</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- modal select confirm -->
                                <!--Modal delete selected items start-->



                                <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">

                                    <div class="modal-dialog modal-wide-width">

                                        <div class="modal-content">

                                            <div class="modal-header">                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>                          <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                                            </div>

                                            <div class="modal-body">

                                                <div id="wbx_who_delete">
                                                </div>

                                                <div class="form-actions">

                                                    <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a>
                                                    </div>
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

                                            <div class="modal-header">                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>                          <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                                            </div>

                                            <div class="modal-body">

                                                <div class="form-actions">

                                                    <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal delete all items end -->				  {{ Form::open( [ 'url' => 'admin/deleteobj', 'class' => 'delete_text_objective form-horizontal' ] ) }}            {{ Form::hidden('page', 'applicants') }}            {{ Form::hidden('index', '') }}            {{ Form::close() }}
                            </div>

                            <div class="portlet-body">

                                <div class="table-responsive mtl">
                                    <table id="table-title-slider" class="table table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th width="1%">
                                                <input type="checkbox"/>
                                            </th>
                                            <th>#
                                            </th>
                                            <th>Status
                                            </th>
                                            <th>Date Applied
                                            </th>
                                            <th>Applicant Name
                                            </th>
                                            <th>Position Applied
                                            </th>
                                            <th>Job Location
                                            </th>
                                            <th>Action
                                            </th>
                                        </tr>                        </thead>                        <tbody><?php static $idx = 0; ?>

                                        @if(isset($applicants) && !empty($applicants))						@foreach($applicants as $key => $item)
                                            <tr>
                                                <td>
                                                    <input data="{{ $key }}" type="checkbox" class="mooncake-mod-checkbox" />
                                                </td>
                                                <td><?php echo $idx + 1 ; ?>
                                                </td>
                                                <td>

<span class="label label-sm label-success">Active
</span>
                                                </td>
                                                <td>{{ date('d M, Y', $item['date']) }}
                                                </td>
                                                <td>{{ $item['name'] }}
                                                </td>
                                                <td>{{ $item['position'] }}
                                                </td>
                                                <td>{{ $item['location'] }}
                                                </td>
                                                <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-view-details{{ $key }}" data-toggle="modal" title="View Details">

<span class="label label-sm label-yellow"><i class="fa fa-search"></i>
</span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-{{ $key }}" data-toggle="modal">

<span class="label label-sm label-red"><i class="fa fa-trash-o"></i>
</span></a>
                                                    <!--Modal view details start-->

                                                    <div id="modal-view-details{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">

                                                        <div class="modal-dialog modal-wide-width">

                                                            <div class="modal-content">

                                                                <div class="modal-header">                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>                                        <h4 id="modal-login-label2" class="modal-title">View Applicant Details</h4>
                                                                </div>

                                                                <div class="modal-body">

                                                                    <form action="#" class="form-horizontal">

                                                                        <div class="form-body pal">                                                            <h3 class="block-heading">Personal</h3>

                                                                            <div class="row">

                                                                                <div class="col-md-6">

                                                                                    <div class="form-group">
                                                                                        <label for="inputFirstName" class="col-md-4 control-label">Name:
                                                                                        </label>

                                                                                        <div class="col-md-8">

                                                                                            <p class="form-control-static">{{ $item['name'] }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">

                                                                                <div class="col-md-6">

                                                                                    <div class="form-group">
                                                                                        <label for="inputEmail" class="col-md-4 control-label">Email:
                                                                                        </label>

                                                                                        <div class="col-md-8">

                                                                                            <p class="form-control-static"><a href="mailto:hock@webqom.com">{{ $item['email'] }}</a></p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">

                                                                                    <div class="form-group">
                                                                                        <label for="selGender" class="col-md-4 control-label">Contact Number:
                                                                                        </label>

                                                                                        <div class="col-md-8">

                                                                                            <p class="form-control-static">{{ $item['phone'] }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">

                                                                                <div class="col-md-6">

                                                                                    <div class="form-group">
                                                                                        <label for="inputBirthday" class="col-md-4 control-label">Date of Birth:
                                                                                        </label>

                                                                                        <div class="col-md-8">

                                                                                            <p class="form-control-static">{{ $item['birth'] }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>                                                            <h3 class="block-heading">Address</h3>

                                                                            <div class="row">

                                                                                <div class="col-md-6">

                                                                                    <div class="form-group">
                                                                                        <label for="inputAddress1" class="col-md-4 control-label">Address:
                                                                                        </label>

                                                                                        <div class="col-md-8">

                                                                                            <p class="form-control-static">{{ $item['address'] }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">

                                                                                    <div class="form-group">
                                                                                        <label for="inputAddress2" class="col-md-4 control-label">City:
                                                                                        </label>

                                                                                        <div class="col-md-8">

                                                                                            <p class="form-control-static">{{ $item['city'] }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">

                                                                                <div class="col-md-6">

                                                                                    <div class="form-group">
                                                                                        <label for="inputStates" class="col-md-4 control-label">State:
                                                                                        </label>

                                                                                        <div class="col-md-8">

                                                                                            <p class="form-control-static">{{ $item['state'] }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">

                                                                                    <div class="form-group">
                                                                                        <label for="inputCity" class="col-md-4 control-label">Post Code:
                                                                                        </label>

                                                                                        <div class="col-md-8">

                                                                                            <p class="form-control-static">{{ $item['postcode'] }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">

                                                                                <div class="col-md-6">

                                                                                    <div class="form-group">
                                                                                        <label for="inputPostCode" class="col-md-4 control-label">Country:
                                                                                        </label>

                                                                                        <div class="col-md-8">

                                                                                            <p class="form-control-static">{{ $item['country'] }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- education background start -->                                                            <h3 class="block-heading">Education Background</h3>

                                                                            <div class="row">

                                                                                <div class="col-md-6">

                                                                                    <div class="form-group">
                                                                                        <label for="inputPostCode" class="col-md-4 control-label">Education Level:
                                                                                        </label>

                                                                                        <div class="col-md-8">

                                                                                            <p class="form-control-static">{{ $item['level'] }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- end education background-->
                                                                            <!-- CV start -->                                                            <h3 class="block-heading">Attached CV</h3>

                                                                            <div class="row">

                                                                                <div class="col-md-6">

                                                                                    <div class="form-group">
                                                                                        <label for="inputPostCode" class="col-md-4 control-label">Applicant CV:
                                                                                        </label>

                                                                                        <div class="col-md-8">

                                                                                            <p class="form-control-static"><a href="/images/{{ $item['cv'] }}" target="_blank">use the uploaded cv file name</a></p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- end CV-->
                                                                        </div>

                                                                        <div class="form-actions">

                                                                            <div class="col-md-offset-5 col-md-8"><a href="#" data-dismiss="modal" class="btn btn-green">Close &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a>

                                                                                <a href="javascript:void(0)" onClick="myprint({{ $key }});" class="btn btn-green">Print</a>
                                                                            </div>
                                                                        </div>

                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--END MODAL view details-->
                                                    <!--Modal delete start-->

                                                    <div id="modal-delete-{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">

                                                        <div class="modal-dialog modal-wide-width">

                                                            <div class="modal-content">

                                                                <div class="modal-header">                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>                                        <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this applicant? </h4>
                                                                </div>									  {{ Form::open(['url' => 'admin/deloneobj']) }}                                      {{ Form::hidden('index', $key) }}                                     {{ Form::hidden('page', 'applicants') }}

                                                                <div class="modal-body">

                                                                    <p><strong>#<?php echo $idx; $idx++; ?>:</strong> Position Applied: {{ $item['position']}} / {{ $item['location']}}<br/>                                                                Applicant Name: {{ $item['name']}}                                    </p>

                                                                    <div class="form-actions">

                                                                        <div class="col-md-offset-4 col-md-8"> <a href="#" class="del-one-txtobj btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>									  {{ Form::close() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- modal delete end -->
                                                </td>
                                            </tr>						  @endforeach						  @endif                        </tbody>                        <tfoot>
                                        <tr>
                                            <td colspan="8">
                                            </td>
                                        </tr>                        </tfoot>
                                    </table>

                                    <div class="clearfix">
                                    </div>
                                </div>
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

                <div class="copyright">

<span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.
</span>

                    <div class="pull-right"><img src="images/logo_webqom.png" alt="Webqom Technologies Sdn Bhd">
                    </div>
                </div>
            </div>
            <!--END FOOTER-->
        </div>
        <!--END PAGE WRAPPER-->
    </div>
</div>
<script src="js/jquery-1.9.1.js">
</script>
<script src="js/jquery-migrate-1.2.1.min.js">
</script>
<script src="js/jquery-ui.js">
</script>
<!--loading bootstrap js-->
<script src="vendors/bootstrap/js/bootstrap.min.js">
</script>
<script src="vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js">
</script>
<script src="js/html5shiv.js">
</script>
<script src="js/respond.min.js">
</script>
<script src="vendors/metisMenu/jquery.metisMenu.js">
</script>
<script src="vendors/slimScroll/jquery.slimscroll.js">
</script>
<script src="vendors/jquery-cookie/jquery.cookie.js">
</script>
<script src="js/jquery.menu.js">
</script>
<script src="vendors/jquery-pace/pace.min.js">
</script>
<!--LOADING SCRIPTS FOR PAGE-->
<script src="vendors/bootstrap-datepicker/js/bootstrap-datepicker.js">
</script>
<script src="vendors/bootstrap-daterangepicker/daterangepicker.js">
</script>
<script src="vendors/moment/moment.js">
</script>
<script src="vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js">
</script>
<script src="vendors/bootstrap-timepicker/js/bootstrap-timepicker.js">
</script>
<script src="vendors/bootstrap-clockface/js/clockface.js">
</script>
<script src="vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.js">
</script>
<script src="vendors/bootstrap-switch/js/bootstrap-switch.min.js">
</script>
<script src="vendors/jquery-maskedinput/jquery-maskedinput.js">
</script>
<script src="js/form-components.js">
</script>
<!--LOADING SCRIPTS FOR PAGE-->
<!-- InstanceBeginEditable name="EditRegion4" -->
<script src="vendors/tinymce/js/tinymce/tinymce.min.js">
</script>
<script src="vendors/ckeditor/ckeditor.js">
</script>
<script src="js/ui-tabs-accordions-navs.js">
</script>













<div id="printingDivFullContent">
@if(isset($applicants) && !empty($applicants))						@foreach($applicants as $key => $item)

    <!--Modal view details start-->


        <div class="form-body pal printingDiv" id="printingDiv{{ $key }}">                                                            <h3 class="block-heading">Personal</h3>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputFirstName" class="col-md-4 control-label">Name:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static">{{ $item['name'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputEmail" class="col-md-4 control-label">Email:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static"><a href="mailto:hock@webqom.com">{{ $item['email'] }}</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="selGender" class="col-md-4 control-label">Contact Number:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static">{{ $item['phone'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputBirthday" class="col-md-4 control-label">Date of Birth:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static">{{ $item['birth'] }}</p>
                        </div>
                    </div>
                </div>
            </div>                                                            <h3 class="block-heading">Address</h3>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputAddress1" class="col-md-4 control-label">Address:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static">{{ $item['address'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputAddress2" class="col-md-4 control-label">City:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static">{{ $item['city'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputStates" class="col-md-4 control-label">State:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static">{{ $item['state'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputCity" class="col-md-4 control-label">Post Code:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static">{{ $item['postcode'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputPostCode" class="col-md-4 control-label">Country:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static">{{ $item['country'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- education background start -->                                                            <h3 class="block-heading">Education Background</h3>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputPostCode" class="col-md-4 control-label">Education Level:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static">{{ $item['level'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end education background-->
            <!-- CV start -->                                                            <h3 class="block-heading">Attached CV</h3>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputPostCode" class="col-md-4 control-label">Applicant CV:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static"><a href="{{ $item['cv'] }}" target="_blank">use the uploaded cv file name</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end CV-->
        </div>

        <!--END MODAL view details-->
    @endforeach						  @endif
</div>




<script>
    function myprint(e1){
        document.getElementById('printingDiv'+e1).style.display='block';
        window.print();
        document.getElementById('printingDiv'+e1).style.display='none';
    }
</script>


<!-- InstanceEndEditable -->
<script src="js/myscripts.js">
</script>
<script src="js/jquery.dataTables.js">
</script>
<script>    $('#table-title-slider').DataTable({    searching: false,    ordering:  false});
</script>
<!--CORE JAVASCRIPT-->
<script src="js/main.js">
</script>
<script src="js/holder.js">
</script>
<script>
    $('#dellselobjapp').on('click', function(){

        if($('.mooncake-mod-checkbox:checked').length == 0){
            $("#modal-select-confirm").modal();
        } else {
            $("#modal-delete-selected").modal();

        }

    });
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
</style>
</html>