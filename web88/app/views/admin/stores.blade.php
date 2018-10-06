<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/cms_admin_about_us_edit.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Our Stores:: Edit</title>
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
                    <li>CMS Pages &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
                    <li class="active">Our Stores - Edit</li>
                </ol>
                <!-- InstanceEndEditable --></div>
            <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->
            <!-- InstanceBeginEditable name="EditRegion2" -->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Our Stores <i class="fa fa-angle-right"></i> Edit</h2>
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

                                <div class="hero-unit">
                                    <div class="wbx_info inline-edit" name="stores[title]" contenteditable="true">
                                        {{ $data['title'] }}
                                    </div>
                                    <span class="small-bottom-border big"></span>
                                    <div class="wbx_info inline-edit" name="stores[description]" contenteditable="true">
                                        {{ $data['description'] }}
                                    </div>
                                    <div class="md-margin2x"></div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        {{ Form::open( [ 'id' => 'wbx_change_info' ] ) }}
                        {{Form::close()}}
                        <div class="form-actions none-bg"> <a data="preview" href="/" class="wbx_submit btn btn-red">Save &amp; Preview &nbsp;<i class="fa fa-search"></i></a>&nbsp; <a data="publish" href="/" class="wbx_submit btn btn-blue">Save &amp; Publish &nbsp;<i class="fa fa-globe"></i></a>&nbsp; <a href="/" id="wbx-cancel" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                        <div class="portlet">
                            <div class="portlet-header">
                                <div class="caption">Stores Listing</div>
                                <br/>
                                <p class="margin-top-10px"></p>

                                <a href="#" data-target="#modal-add-store" data-toggle="modal" class="btn btn-success">Add New &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary">Delete</button>
                                    <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a href="#" id="dellselobjstore">Delete selected item(s)</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                                    </ul>
                                </div>
                                 
                                <div class="tools"> <i class="fa fa-chevron-up"></i> </div>

                                <!--Modal Add New start-->
                                <div id="modal-add-store" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                    <div class="modal-dialog modal-wide-width">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                <h4 id="modal-login-label2" class="modal-title">Add New Store</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form">
                                                    {{ Form::open( [ 'url' => 'admin/addstore', 'id' => 'wbx_add_store', 'class' => 'form-horizontal' ] ) }}
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Status</label>
                                                        <div class="col-md-9">
                                                            <div data-on="success" data-off="primary" class="make-switch">
                                                                <input type="checkbox" name="store[active]" value="1" checked="checked"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Store Name <span class='require'>*</span></label>
                                                        <div class="col-md-6">
                                                            <input type="text" name="store[name]" class="form-control" placeholder="eg. Old Klang Road">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">State/City <span class='require'>*</span></label>
                                                        <div class="col-md-6">
                                                            {{ Form::select('store[state]', Location::getLocations(), 0, [ 'id' => 'wbx_select_state', 'class' => 'form-control' ])}}
                                                            <div class="xs-margin"></div>
                                                            <input style="display:none" type="text" class="wbx_new_state form-control" name="store[new_state]">
                                                            <div class="xs-margin"></div>
                                                            <a href="#" class="wbx_add_new_state_button btn btn-warning">Add New State/City &nbsp;<i class="fa fa-plus"></i></a>                             		After user added the new state/city, the newly added state/city will appear on the list selection above.
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Address <span class='require'>*</span></label>
                                                        <div class="col-md-6">
                                                            <textarea name="store[address]" rows="2" class="wbx-address-map form-control" id="inputContent" placeholder="eg. PS-4, 5, 6, 7 & 8, Taman Evergreen, Batu 4, Jalan Klang Lama, 58100 Kuala Lumpur."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Google Map </label>
                                                        <div class="col-md-6">
                                                            <textarea name="store[map]" rows="2" class="wbx-map form-control" id="inputContent" placeholder="eg. PS-4, 5, 6, 7 & 8, Taman Evergreen, Batu 4, Jalan Klang Lama, 58100 Kuala Lumpur."></textarea>
                                                            <div class="margin-top-10px">
                                                                <a href="#" data="first" edit="false" id="wbx_find_point_map" class="wbx-get-map btn btn-dark">Search &nbsp;<i class="fa fa-map-marker"></i></a>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Preview Google Map </label>
                                                        <div class="col-md-6">
                                                            <div id="map_canvas" style="width:630px; height:200px"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputContent" class="col-md-3 control-label">Store Info </label>
                                                        <div class="col-md-9">
                                                            <p class="text-blue text-12px margin-top-15px border-bottom">You can edit the content by clicking the text section below.</p>
                                                            <div class="acc-body">
                                                                <div class="wbx_info2" name="store[info]" contenteditable="true">
                                                                    <ul class="contact-details-list fa-ul">
                                                                        <li><i class="fa-li fa fa-phone"></i> Telephone: </li>
                                                                        <li><i class="fa-li fa fa-fax"></i> Fax: </li>
                                                                        <li><i class="fa-li fa fa-car"></i> GPS: </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <!-- end acc body -->
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputContent" class="col-md-3 control-label">Business Hours</label>
                                                        <div class="col-md-9">
                                                            <p class="text-blue text-12px margin-top-15px border-bottom">You can edit the content by clicking the text section below.</p>
                                                            <div class="acc-body">
                                                                <div class="wbx_info2" name="store[time]" contenteditable="true">
                                                                    <ul>
                                                                        <li>Please enter Date/Time</li>
                                                                        <li>Please enter Date/Time</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <!-- end acc body -->
                                                        </div>
                                                    </div>


                                                    <div class="form-actions">
                                                        <div class="col-md-offset-5 col-md-8"> <a href="#" id="wbx_save_table" data="stores" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                    </div>
                                                    {{Form::close()}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--END MODAL Add New-->

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
                            {{ Form::open( [ 'url' => 'admin/deleteobj', 'class' => 'delete_text_objective form-horizontal' ] ) }}
                            {{ Form::hidden('page', 'stores') }}
                            {{ Form::hidden('index', '') }}
                            {{ Form::close() }}
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
                            </div>
                            <div class="portlet-body">

                                <div class="table-responsive mtl">
                                    <table id="table-title-slider" class="table table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th width="1%"><input type="checkbox"  /></th>
                                            <th>#</th>
                                            <th>Status</th>
                                            <th>Store Name</th>
                                            <th>Address</th>
                                            <th>State/City</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($stores) && !empty($stores))
                                            @foreach($stores as $key => $item)
                                                <tr>
                                                    <td><input data="{{ $key }}" type="checkbox" class="mooncake-mod-checkbox"/></td>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        @if(isset($item['active']) && $item['active'])
                                                            <span class="label label-sm label-success">Active</span>
                                                        @else
                                                            <span class="label label-sm label-red">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item['name'] }}</td>
                                                    <td>{{ $item['address'] }}</td>
                                                    <td>{{ $item['location'] }}</td>
                                                    <td><a href="#" data-hover="tooltip" class="tar-edit-map" data="{{ $key }}" data-placement="top" data-target="#modal-edit-store{{ $key }}" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-{{ $key }}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                                        <!--Modal edit store start-->
                                                        <div id="modal-edit-store{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                                            <div class="modal-dialog modal-wide-width">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                                        <h4 id="modal-login-label2" class="modal-title">Edit Store</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form">
                                                                            {{ Form::open( [ 'url' => 'admin/editstore', 'class' => 'bmw_edit_table form-horizontal' ] ) }}
                                                                            <div class="form-group">
                                                                                <label class="col-md-3 control-label">Status</label>
                                                                                <div class="col-md-9">
                                                                                    <div data-on="success" data-off="primary" class="make-switch">
                                                                                        @if(isset($item['active']) && $item['active'])
                                                                                            <input type="checkbox" name="store[active]" value="1" checked="checked"/>
                                                                                        @else
                                                                                            <input type="checkbox" name="store[active]" value="1" />
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="col-md-3 control-label">Store Name <span class='require'>*</span></label>
                                                                                <div class="col-md-6">
                                                                                    <input type="text" name="store[name]" class="form-control"  placeholder="eg. Old Klang Road" value="{{ $item['name'] }}">

                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="col-md-3 control-label">State/City <span class='require'>*</span></label>
                                                                                <div class="col-md-6">
                                                                                    {{ Form::select('store[state]', Location::getLocations(), $item['state'], [ 'id' => 'wbx_select_state', 'class' => 'form-control' ])}}
                                                                                    <div class="xs-margin"></div>
                                                                                    <input style="display:none" type="text" class="wbx_new_state form-control" name="store[new_state]">
                                                                                    <div class="xs-margin"></div>
                                                                                    <a href="#" class="wbx_add_new_state_button btn btn-warning">Add New State/City &nbsp;<i class="fa fa-plus"></i></a>                                				After user added the new state/city, the newly added state/city will appear on the list selection above.
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="col-md-3 control-label">Address <span class='require'>*</span></label>
                                                                                <div class="col-md-6">
                                                                                    <textarea name="store[address]" rows="2" class="wbx-address-map form-control" id="inputContent" placeholder="eg. PS-4, 5, 6, 7 & 8, Taman Evergreen, Batu 4, Jalan Klang Lama, 58100 Kuala Lumpur.">{{ $item['address'] }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="col-md-3 control-label">Google Map </label>
                                                                                <div class="col-md-6">
                                                                                    <textarea name="store[map]" rows="2" class="wbx-map form-control" id="inputContent" placeholder="eg. PS-4, 5, 6, 7 & 8, Taman Evergreen, Batu 4, Jalan Klang Lama, 58100 Kuala Lumpur.">{{ $item['map'] }}</textarea>
                                                                                    <div class="margin-top-10px">
                                                                                        <a href="#" edit="true" data="{{ $key }}" class="wbx-get-map btn btn-dark">Search &nbsp;<i class="fa fa-map-marker"></i></a>

                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="col-md-3 control-label">Preview Google Map </label>
                                                                                <div class="col-md-6">
                                                                                    <div id="map_canvas{{ $key }}" style="width:630px; height:200px"></div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="inputContent" class="col-md-3 control-label">Store Info </label>
                                                                                <div class="col-md-9">
                                                                                    <p class="text-blue text-12px margin-top-15px border-bottom">You can edit the content by clicking the text section below.</p>
                                                                                    <div class="acc-body">
                                                                                        <div class="wbx_info2" name="store[info]" contenteditable="true">
                                                                                            {{ $item['info']}}
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- end acc body -->
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="inputContent" class="col-md-3 control-label">Business Hours</label>
                                                                                <div class="col-md-9">
                                                                                    <p class="text-blue text-12px margin-top-15px border-bottom">You can edit the content by clicking the text section below.</p>
                                                                                    <div class="acc-body">
                                                                                        <div class="wbx_info2" name="store[time]" contenteditable="true">
                                                                                            {{ $item['time']}}
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- end acc body -->
                                                                                </div>
                                                                            </div>

                                                                            <input type="hidden" value="{{ $key }}" name="key" />
                                                                            <div class="form-actions">
                                                                                <div class="col-md-offset-5 col-md-8"> <a href="#" data="stores" class="bmw_edit_submit btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                                            </div>

                                                                            {{ Form::close() }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--END edit store -->
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
                                                                    {{ Form::hidden('page', 'stores') }}
                                                                    <div class="modal-body">
                                                                        <p><strong>#{{ $key }}:</strong> {{ $item['name']}} / {{ $item['address'] }}, {{ $item['location'] }}</p>
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
<style type="text/css">
    #map-canvas  .labels {
        color: white;
        font-family: "Roboto Condensed", Arial, sans-serif;
        font-size: 20px;
        font-weight:bold;
        text-align: center;
        width: 500px;
        white-space: nowrap;
    }
    .labels span{
        color:#A14040;
        font-size: 12px;
        font-weight:bold;
        position:relative;
        left:60px;
        bottom:3px;
        display: block;
        width: 280px;
    }
</style>
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCRrJ_VQvTCWM0bv_ZpLfm8j5TW-yUhX9E&v=3.exp&sensor=false&libraries=places"></script>
<script type="text/javascript" src="/web88/js/markerwithlabel.js"></script>
<script type="text/javascript">
    function initMap(lat, lng, address, addressLabel, i) {

        var homeLatLng = new google.maps.LatLng(lat, lng);

        var map = new google.maps.Map(document.getElementById('map_canvas' + i), {
            zoom: 15,
            center: homeLatLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var pictureLabel = document.createElement("span");
        pictureLabel.innerHTML = address;

        new MarkerWithLabel({
            position: homeLatLng,
            map: map,
            draggable: false,
            raiseOnDrag: true,
            labelContent: pictureLabel,
            labelAnchor: new google.maps.Point(50, 0),
            labelClass: "labels", // the CSS class for the label
            //labelStyle: {opacity: 0.50}
        });

    }

    $('.wbx-get-map').click(function(){
        var address = $(this).closest('form').find('.wbx-map').val();
        var addressLabel = address;
        var Obj = '';
        console.log(address)
        if($(this).attr('edit') === 'true'){
            Obj = $(this).attr('data');
        }
        $.ajax({
            url: 'http://maps.google.com/maps/api/geocode/json?address=' + address + '&sensor=false',
            success: function(data){
                var lat, lng;
                lat = data.results[0].geometry.location.lat;
                lng = data.results[0].geometry.location.lng;
                initMap(lat, lng, address, addressLabel, Obj);

            }
        });

    });


    // Edit map
    $('.tar-edit-map').click(function(){
        var target = $(this).attr('data-target');

        setTimeout(function(){ $(target).find('.wbx-get-map').click(); }, 2000);
        //$('.wbx-get-map')
        /*
         console.log("Map click");
         var target = $(this).attr('data-target');
         var address = $(target).find('.wbx-map').val();
         console.log(address);
         var addressLabel = address;
         var Obj = '';
         Obj = $(this).attr('data');
         $.ajax({
         url: 'http://maps.google.com/maps/api/geocode/json?address=' + address + '&sensor=false',
         success: function(data){
         var lat, lng;
         lat = data.results[0].geometry.location.lat;
         lng = data.results[0].geometry.location.lng;
         setTimeout(initMap(lat, lng, address, addressLabel, Obj), 2000);
         }
         });
         */
    });
</script>
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


<!--CORE JAVASCRIPT-->
<script src="js/main.js"></script>
<script src="js/holder.js"></script>
<script src="js/myscripts.js"></script>
<script src="js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function(){
        $('#table-title-slider').DataTable({
            searching: false,
            ordering:  false
        });
    });

</script>

<script type="text/javascript">
    /* Fix for bootstrap modal + ckeditor + chrome */
    CKEDITOR.disableAutoInline = true;

    $('.inline-edit').each(function (i) {
        if (this.id == '') {
            this.id = 'inline_edit_ckedit_'+i;
        }

        if(CKEDITOR.instances[this.id] === undefined) {
            CKEDITOR.inline(this.id);
        }
    });

    $('#dellselobjstore').on('click', function(){

        if($('.mooncake-mod-checkbox:checked').length == 0){
            $("#modal-select-confirm").modal();
        } else {
            $("#modal-delete-selected").modal();

        }

    });

    // $('.modal').on('shown.bs.modal', function () {
    // 	$(this).find('[contenteditable="true"]').each(function (i) {
    // 		if (this.id == '') {
    // 			this.id = 'ckedit_'+i;
    // 		}
    // 	//	alert(this.id);
    // 		if(CKEDITOR.instances[this.id] === undefined) {
    // 			CKEDITOR.inline(this.id);
    // 		}
    // 	});
    // });
</script>

</body>
<!-- InstanceEnd --></html>