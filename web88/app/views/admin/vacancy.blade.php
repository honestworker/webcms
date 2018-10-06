<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/cms_admin_about_us_edit.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Job Vacancies:: Listing</title>
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
{{HTML::style('admin/css/jquery.dataTables.css')}}
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
    <style type="text/css">
        .cke_source {
            white-space: pre-wrap !important;
        }
    </style>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>
<body>
<div>
    <!--BEGIN TO TOP--><a id="totop" href="#"><i class="fa fa-angle-up"></i></a><!--END BACK TO TOP-->
    <div id="wrapper"><!--BEGIN TOPBAR-->
    @include('backend.topbar')
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
                    <li>CMS Pages&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
                    <li>Careers&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
                    <li class="active">Job Vacancies - Listing</li>
                </ol>
                <!-- InstanceEndEditable --></div>
            <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->
            <!-- InstanceBeginEditable name="EditRegion2" -->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Job Vacancies <i class="fa fa-angle-right"></i> Listing</h2>
                        <div class="clearfix"></div>
                        <div class="alert alert-success alert-dismissable"
                             @if( Session::has('success') )
                             style="display: block;">
                            <script>setTimeout(function(){$("body").animate({"scrollTop":0},100);},3000);</script>
                            <?php Session::forget('success'); ?>
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
                            <?php Session::forget('fail'); ?>
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
                                <div id="page-header" class="wbx_info" name="vacancy[bg-title]" contenteditable="true">
                                    {{ $data['bg-title'] }}
                                </div>
                            </div>
                        </div>

                        <div class="portlet">
                            <div class="portlet-header">
                                <div class="caption">Page Content</div>
                                <br/>
                                <span class="text-blue text-12px">You can edit the content by clicking the text section below.</span>
                                <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                            </div>
                            <div class="portlet-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="hero-unit">
                                            <div class="wbx_info" name="vacancy[title]" contenteditable="true">
                                                {{ $data['title'] }}
                                            </div>
                                            <span class="small-bottom-border big"></span>
                                            <div class="wbx_info" name="vacancy[description]" contenteditable="true">
                                                {{ $data['description'] }}
                                            </div>
                                        </div>
                                        <div class="md-margin2x"></div>

                                    </div>
                                    <!-- end col-md-12 -->

                                </div>
                                <!-- end row -->

                            </div>
                            <!-- end portlet-body -->
                        {{ Form::open( [ 'id' => 'wbx_change_info' ] ) }}
                        {{Form::close()}}
                        <!-- save button start -->
                            <div class="form-actions none-bg"> <a data="preview" href="/" class="wbx_submit btn btn-red">Save &amp; Preview &nbsp;<i class="fa fa-search"></i></a>&nbsp; <a href="/" data="publish" class="wbx_submit btn btn-blue">Save &amp; Publish &nbsp;<i class="fa fa-globe"></i></a>&nbsp; <a href="/" id="wbx-cancel" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                            <!-- save button end -->

                        </div>
                        <!-- end portlet -->

                        <div class="portlet">
                            <div class="portlet-header">
                                <div class="caption">Job Vacancies Listing</div>
                                <br/>
                                <p class="margin-top-10px"></p>
                                <a href="#" data-target="#modal-add-vacancy" data-toggle="modal" class="btn btn-success">Add New &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary">Delete</button>
                                    <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a href="#" id="dellselobjvacancy">Delete selected item(s)</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                                    </ul>
                                </div>
                                 
                                <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                                <!--Modal Add New start-->
                                <div id="modal-add-vacancy" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                    <div class="modal-dialog modal-wide-width">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                <h4 id="modal-login-label2" class="modal-title">Add New Vacancy</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form">
                                                    {{ Form::open( [ 'url' => 'admin/addvacancy', 'method' => 'POST', 'id' => 'wbx_add_store3', 'class' => 'form-horizontal' ] ) }}
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Status</label>
                                                        <div class="col-md-9">
                                                            <div data-on="success" data-off="primary" class="make-switch">
                                                                <input type="checkbox" name="vacancy[active]" value="1" checked="checked"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Job Title <span class='require'>*</span></label>
                                                        <div class="col-md-9">
                                                            <textarea name="vacancy[title]" rows="2" class="form-control" id="inputContent" placeholder="eg. Sale Executive"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Job Location <span class='require'>*</span></label>
                                                        <div class="col-md-9">
                                                            <textarea name="vacancy[location]" rows="2" class="form-control" id="inputContent" placeholder="eg. Jalan Klang Lama, KL Festival City (Wangsa Maju)"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Date</label>
                                                        <div class="col-md-5">
                                                            <div class="input-group">
                                                                <input type="text" name="vacancy[date]" class="datepicker-default form-control" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy"/>
                                                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputContent" class="col-md-3 control-label">Minimum Requirement <span class='require'>*</span></label>
                                                        <div class="col-md-9">
                                                            <p class="text-blue text-12px margin-top-15px border-bottom">You can edit the content by clicking the text section below.</p>
                                                            <div class="acc-body">
                                                                <div class="wbx_info3" rows="5" name="vacancy[requirement]" contenteditable="true">
                                                                     <ul class="contact-details-list fa-ul">
                                                                        <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                                                        <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                                                        <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <!-- end acc body -->
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputContent" class="col-md-3 control-label">Preferred <span class='require'>*</span></label>
                                                        <div class="col-md-9">
                                                            <p class="text-blue text-12px margin-top-15px border-bottom">You can edit the content by clicking the text section below.</p>
                                                            <div class="acc-body">
                                                                <div class="wbx_info3" rows="5" name="vacancy[preferred]" contenteditable="true">
                                                                     <p>check</p>
                                                                </div>
                                                            </div>
                                                            <!-- end acc body -->
                                                        </div>
                                                    </div>

                                                    <div class="form-actions">
                                                        <div class="col-md-offset-5 col-md-8"> <a href="#" id="wbx_save_table3" data="vacancy"  class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                    </div>
                                                    {{Form::close()}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--END MODAL Add New-->
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
                                                <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-actions">
                                                    <div class="col-md-offset-4 col-md-8"> <a href="#" id="dellallobj" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal delete all items end -->

                                {{ Form::open( [ 'url' => 'admin/deleteobj', 'class' => 'delete_text_objective form-horizontal' ] ) }}
                                {{ Form::hidden('page', 'vacancy') }}
                                {{ Form::hidden('index', '') }}
                                {{ Form::close() }}
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
                                            <th>Job Title</th>
                                            <th>Job Location</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <?php static $idx = 0; ?>
                                        <tbody>
                                        @if(isset($vacancy) && !empty($vacancy))
                                            @foreach($vacancy as $key => $item)
                                                <tr>
                                                    <td><input data="{{ $key }}" type="checkbox" class="mooncake-mod-checkbox"/></td>
                                                    <td><?php echo $idx + 1; ?></td>
                                                    <td>@if(isset($item['active']) && $item['active'])
                                                            <span class="label label-sm label-success">Active</span>
                                                        @else
                                                            <span class="label label-sm label-red">Inactive</span>
                                                        @endif</td>
                                                    <td>{{ date('d/m/Y', strtotime($item['date'])) }}</td>
                                                    <td>{{ $item['title'] }}</td>
                                                    <td>{{ $item['location'] }}</td>
                                                    <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-vacancy{{ $key }}" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-{{ $key }}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                                        <!--Modal Edit vacancy start-->
                                                        <div id="modal-edit-vacancy{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                                            <div class="modal-dialog modal-wide-width">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                                        <h4 id="modal-login-label2" class="modal-title">Edit Vacancy</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form">
                                                                            {{ Form::open( [ 'url' => 'admin/editvacancy', 'class' => 'bmw_edit_table form-horizontal' ] ) }}
                                                                            <div class="form-group">
                                                                                <label class="col-md-3 control-label">Status</label>
                                                                                <div class="col-md-9">
                                                                                    <div data-on="success" data-off="primary" class="make-switch">
                                                                                        @if(isset($item['active']) && $item['active'])
                                                                                            <input type="checkbox" name="vacancy[active]" value="1" checked="checked"/>
                                                                                        @else
                                                                                            <input type="checkbox" name="vacancy[active]" value="1" />
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="col-md-3 control-label">Job Title <span class='require'>*</span></label>
                                                                                <div class="col-md-9">
                                                                                    <textarea name="vacancy[title]" rows="2" class="form-control" id="inputContent" placeholder="eg. Sale Executive">{{ $item['title'] }}</textarea>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="col-md-3 control-label">Job Location <span class='require'>*</span></label>
                                                                                <div class="col-md-9">
                                                                                    <textarea name="vacancy[location]" rows="2" class="form-control" id="inputContent" placeholder="eg. Jalan Klang Lama, KL Festival City (Wangsa Maju)">{{ $item['location'] }}</textarea>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="col-md-3 control-label">Date <span class='require'>*</span></label>
                                                                                <div class="col-md-5">
                                                                                    <div class="input-group">
                                                                                        <input type="text" class="datepicker-default form-control" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" name="vacancy[date]" value="{{ date('d/m/Y', strtotime($item['date'])) }}"/>
                                                                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="inputContent" class="col-md-3 control-label">Minimum Requirement <span class='require'>*</span></label>
                                                                                <div class="col-md-9">
                                                                                    <p class="text-blue text-12px margin-top-15px border-bottom">You can edit the content by clicking the text section below.</p>
                                                                                    <div class="acc-body">
                                                                                        <div class="wbx_info2" name="vacancy[requirement]" contenteditable="true">
                                                                                            {{ isset($item['requirement']) ? $item['requirement']: '' }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- end acc body -->
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="inputContent" class="col-md-3 control-label">Preferred <span class='require'>*</span></label>
                                                                                <div class="col-md-9">
                                                                                    <p class="text-blue text-12px margin-top-15px border-bottom">You can edit the content by clicking the text section below.</p>
                                                                                    <div class="acc-body">
                                                                                        <div class="wbx_info2" name="vacancy[preferred]" contenteditable="true">
                                                                                            {{ isset($item['preferred']) ? $item['preferred']: '' }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- end acc body -->
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                            <input type="hidden" value="{{ $key }}" name="key" />
                                                                            <div class="form-actions">
                                                                                <div class="col-md-offset-5 col-md-8"> <a href="#" data="vacancy" class="bmw_edit_submit btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                                            </div>
                                                                            {{ Form::close() }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--END MODAL Edit vacancy-->
                                                        <!--Modal delete start-->
                                                        <div id="modal-delete-{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                                        <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this vacancy? </h4>
                                                                    </div>
                                                                    {{ Form::open(['url' => 'admin/deloneobj']) }}
                                                                    {{ Form::hidden('index', $key) }}
                                                                    {{ Form::hidden('page', 'vacancy') }}
                                                                    <div class="modal-body">
                                                                        <p><strong>#<?php echo $idx; $idx++; ?>:</strong> {{ $item['title']}} / {{ $item['location']}}</p>
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
                                            <td colspan="7"></td>
                                        </tr>
                                        </tfoot>
                                    </table>
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
<script src="js/jquery.dataTables.js"></script>
<script>
    $('#table-title-slider').DataTable({
        searching: false,
        ordering:  false
    });
    $('#dellselobjvacancy').on('click', function(){

        if($('.mooncake-mod-checkbox:checked').length == 0){
            $("#modal-select-confirm").modal();
        } else {
            $("#modal-delete-selected").modal();

        }

    });
    // $('.wbx_info3, .wbx_info2').each(function() {
    //     var mainObject = $(this);
    //     var name;
    //     for(name in CKEDITOR.instances) {
    //         var instance = CKEDITOR.instances[name];
    //         instance.on('focus', function () {
    //             instance.setReadOnly(false);
    //         });
    //         if(this && this == instance.element.$) {
    //             return;
    //         }
    //     }
    //     $(this).attr('contenteditable', true);
    //     mainObject.blur();
    //     mainObject.click();
    //     CKEDITOR.inline(this.id);

    // });

    // if (CKEDITOR.status == 'loaded') {
    // } else {
    //   CKEDITOR.on( 'instanceReady', function( event ) {
    //       event.editor.on( 'key', function(e) {
    //           console.log(e.data.keyCode);
    //           if(e.data.keyCode==13){
    //               var content  = this.getData();
    //               var new_content = wrapContent(content);
    //               this.setData(new_content.replace('<p>&nbsp;</p>',''));
    //               var range = this.createRange();
    //               range.moveToPosition( range.root, CKEDITOR.POSITION_BEFORE_END );
    //               this.getSelection().selectRanges( [ range ] );
    //               this.execCommand( 'bulletedlist' );
    //               return false;
    //           }
    //       });

    //   });
    // }

</script>
<!-- InstanceEndEditable -->


<!--CORE JAVASCRIPT-->
<script src="../js/bootstrap-datepicker-vacancy-customized.js"></script>
<script src="js/main.js"></script>
<script src="js/holder.js"></script>

<script type="text/javascript">

    function wrapContent(content) {
        var new_content_1 = content.replace(/<li><i class="fa-li fa fa-check-square-o"><\/i>/gi, '<li>');
        var new_content_2 = new_content_1.replace(/<li>/gi, '<li><i class="fa-li fa fa-check-square-o"></i>');
        var new_content = new_content_2.replace(/<ul>/, '<ul class="fa-ul">');

        return new_content;

    }

    /* Fix for bootstrap modal + ckeditor + chrome */
    CKEDITOR.disableAutoInline = true;

    $(document).ready(function(){

        $('.wbx_info').each(function (i) {
            if (this.id == '') {
                this.id = 'inline_edit_ckedit_'+i;
            }

            if(CKEDITOR.instances[this.id] === undefined) {
                CKEDITOR.inline(this.id);
            }
        });

        $('.wbx_info3, .wbx_info2').each(function(i) {
            if (this.id == '') {
                this.id = $(this).attr('class') + 'inline_edit_ckedit_'+i;
            }

            if(CKEDITOR.instances[this.id] === undefined) {
                CKEDITOR.inline(this.id);
            }

            var instance = CKEDITOR.instances[this.id];

            instance.on('focus', function () {
                instance.setReadOnly(false);
            });

            //Wrap ckeditor content for the first
            var html_content = $(this).html();
            instance.on('instanceReady', function() {
                var id = instance.name;
                $('#'+id).html(html_content);
            });

            //Wrap ckeditor content each time it change
            instance.on('blur', function() {
                var content  = instance.getData();
                var new_content = wrapContent(content);
                var id = instance.name;
                $('#'+id).html(new_content.replace('<p>&nbsp;</p>',''));
            });

        });

    });

    // $('.modal').on('shown.bs.modal', function () {
    // 	$(this).find('[contenteditable="true"]').each(function (i) {
    // 		if (this.id == '') {
    // 			this.id = 'ckedit_'+i;
    // 		}
    // 		// alert(this.id);
    // 		if(CKEDITOR.instances[this.id] === undefined) {
    // 			CKEDITOR.inline(this.id);
    // 		}
    // 	});
    // });
</script>

</body>
<!-- InstanceEnd --></html>