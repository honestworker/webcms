<!doctype html>
<html lang=ru>
<head>
  <!-- InstanceBeginEditable name="doctitle" -->
  <title>About Us:: Edit</title>
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
          <li class="active">About Us - Edit</li>
        </ol>
        <!-- InstanceEndEditable --></div>
      <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->
      <!-- InstanceBeginEditable name="EditRegion2" -->
      <div class="page-content">
        <div class="row">
          <div class="col-lg-12">
            <div class="support_content">
              <h2>About Us <i class="fa fa-angle-right"></i> Edit</h2>
              <div class="clearfix"></div>
              <div data="nview" class="alert alert-success alert-dismissable"
                   @if( Session::get('success') )
                   style="display: block;">
                <script>setTimeout(function(){$("body").animate({"scrollTop":0},100);},3000);</script>
                <? Session::forget('success') ?>
                @else
                  style="display: none;">
                @endif

                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                <p>The information has been saved/updated successfully.</p>
              </div>
              <div data="nview" class="alert alert-danger alert-dismissable"
                   @if( Session::get('fail') )
                   style="display: block;">
                <script>setTimeout(function(){$("body").animate({"scrollTop":0},100);},3000);</script>
                <? Session::forget('fail') ?>
                @else
                  style="display: none;">
                @endif

                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                <p>The information has not been saved/updated. Please correct the errors.</p>
              </div>
              <div class="pull-left"> Last updated: <span class="text-blue">{{ date('d M, Y @ g.iA', strtotime($times)) }}</span> </div>
              <div class="clearfix"></div>
              <p></p>
            </div>
            <div class="portlet">
              <div class="portlet-header">
                <div class="caption">Page Info</div>
                <br/>
                <span class="text-blue text-12px">You can edit the content by clicking the text section below.</span>
                <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
              </div>
              <div class="portlet-body">
                <div class="wbx_info" name="about[title]" contenteditable="true">
                  {{ $about['title'] }}
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
                <!-- message from MD start -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="hero-unit">
                      <div class="wbx_info" name="about[info-title]" contenteditable="true">
                        {{ $about['info-title'] }}
                      </div>
                      <span class="small-bottom-border big"></span>
                      <div class="wbx_info" name="about[info-name]" contenteditable="true">
                        {{ $about['info-name'] }}
                      </div>
                    </div>
                    <div class="md-margin2x"></div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="wbx_info" name="about[info-description]" contenteditable="true">
                          {{ $about['info-description'] }}
                        </div>
                        <div class="md-margin"></div>
                        <hr>
                      </div>
                      <!-- end col-12 -->
                    </div>
                    <!-- end row -->
                    <div class="xs-margin"></div>
                    <div class="row">
                      <div class="col-md-6 col-sm-3 col-xs-6 service-box-container">
                        <div class="services-box">
                          <div class="items"> <a href="#" data-placement="top" data-target="#modal-edit-vision-icon" data-toggle="modal" title="Edit">
                              <div id="wbm_icon1" class="circle"><i class="fa {{ $about['icon-img1'] }}"></i></div>
                            </a> </div>
                          Please fix the red bottom border missing issue due to inline editor when mouse-hover and edit the text.
                          <div  class="wbx_info" name="about[first-icon-title]" contenteditable="true">
                            {{ $about['first-icon-title'] }}
                          </div>
                          <div  class="wbx_info" name="about[first-icon-description]" contenteditable="true">
                            {{ $about['first-icon-description'] }}
                          </div>
                        </div>
                      </div>
                      <!--Modal edit vision icon start-->
                      <div id="modal-edit-vision-icon" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog modal-wide-width">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4 id="modal-login-label3" class="modal-title">Edit Icon</h4>
                            </div>
                            <div class="modal-body">
                              <div class="form">
                                <form id="inputContent1" class="form-horizontal">
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Icon <span class='require'>*</span></label>
                                    <div class="col-md-6">
                                      <input type="text" class="form-control" value="{{ $about['icon-img1'] }}">
                                      <div class="help-block">Please refer here for more <a href="icon" target="_blank">icon options.</a></div>
                                    </div>
                                  </div>
                                  <div class="form-actions">
                                    <div class="col-md-offset-5 col-md-8"> <a href="#" data-dismiss="modal"  class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--END MODAL edit vision icon -->
                      <!-- end col-md-6 -->
                      <div class="col-md-6 col-sm-3 col-xs-6 service-box-container">
                        <div class="services-box">
                          <div class="items"> <a href="#" data-placement="top" data-target="#modal-edit-mission-icon" data-toggle="modal" title="Edit">
                              <div id="wbm_icon2"  class="circle"><i class="fa {{ $about['icon-img2'] }}"></i></div>
                            </a> </div>
                          Please fix the red bottom border missing issue due to inline editor when mouse-hover and edit the text.
                          <div  class="wbx_info" name="about[second-icon-title]" contenteditable="true">
                            {{ $about['second-icon-title'] }}
                          </div>
                          <div  class="wbx_info" name="about[second-icon-description]" contenteditable="true">
                            {{ $about['second-icon-description'] }}
                          </div>
                        </div>
                      </div>
                      <!--Modal edit mission icon start-->
                      <div id="modal-edit-mission-icon" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog modal-wide-width">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4 id="modal-login-label3" class="modal-title">Edit Icon</h4>
                            </div>
                            <div class="modal-body">
                              <div class="form">
                                <form id="inputContent2" class="form-horizontal">
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Icon <span class='require'>*</span></label>
                                    <div class="col-md-6">
                                      <input type="text" class="form-control" value="{{ $about['icon-img2'] }}">
                                      <div class="help-block">Please refer here for more <a href="icon" target="_blank">icon options.</a></div>
                                    </div>
                                  </div>
                                  <div class="form-actions">
                                    <div class="col-md-offset-5 col-md-8"> <a href="#" data-dismiss="modal" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--END MODAL edit mission icon -->
                      <!-- end col-md-6 -->
                      <div class="lg-margin"></div>
                    </div>
                    <!-- end row vision & mission -->
                    <div class="xlg-margin"></div>
                  </div>
                  <!-- end col-md-12 -->
                </div>
                <!-- end message from MD -->
                <!-- our story start -->
                <div class="row">
                  <div class="col-md-12">
                    <!-- our story start -->
                    <div class="hero-unit">
                      <div class="wbx_info" name="about[content-title1]" contenteditable="true">
                        {{ $about['content-title1'] }}
                      </div>
                      <span class="small-bottom-border big"></span>
                      <div class="wbx_info" name="about[content-signature1]" contenteditable="true">
                        {{ $about['content-signature1'] }}
                      </div>
                    </div>
                    <div class="md-margin2x"></div>
                    <div class="wbx_info" name="about[content-text1]" contenteditable="true">
                      {{ $about['content-text1'] }}
                    </div>
                    <hr>
                    <div class="md-margin"></div>
                    <!-- end our story -->
                    <!-- our business strategy start -->
                    <div class="hero-unit">
                      <div class="wbx_info" name="about[content-title2]" contenteditable="true">
                        {{ $about['content-title2'] }}
                      </div>
                      <span class="small-bottom-border big"></span>
                      <div class="wbx_info" name="about[content-signature2]" contenteditable="true">
                        {{ $about['content-signature2'] }}
                      </div>
                    </div>
                    <div class="md-margin2x"></div>
                    <div class="wbx_info" name="about[content-text2]" contenteditable="true">
                      {{ $about['content-text2'] }}
                    </div>
                    <div class="xlg-margin"></div>
                    <!-- end our business strategy -->
                  </div>
                  <!-- end col-md-12 -->
                </div>
                <!-- end row -->
                <div class="row">
                  <!-- how to choose our logo concept start -->
                  <div class="col-md-6 col-sm-3 col-xs-6">
                    <div class="hero-unit">
                      <div class="wbx_info" name="about[content-title3]" contenteditable="true">
                        {{ $about['content-title3'] }}
                      </div>
                      <span class="small-bottom-border big"></span>
                      <div class="wbx_info" name="about[content-signature3]" contenteditable="true">
                        {{ $about['content-signature3'] }}
                      </div>
                    </div>
                    <div class="md-margin2x"></div>
                    <div class="wbx_info" name="about[content-text3]" contenteditable="true">
                      {{ $about['content-text3'] }}
                    </div>
                  </div>
                  <!-- end how to choose our logo concept -->
                  <!-- responses to the logo start -->
                  <div class="col-md-6 col-sm-3 col-xs-6">
                    <div class="hero-unit">
                      <div class="wbx_info" name="about[content-title4]" contenteditable="true">
                        {{ $about['content-title4'] }}
                      </div>
                      <span class="small-bottom-border big"></span>
                      <div class="wbx_info" name="about[content-signature4]" contenteditable="true">
                        {{ $about['content-signature4'] }}
                      </div>
                    </div>
                    <div class="md-margin2x"></div>
                    <div class="wbx_info" name="about[content-text4]" contenteditable="true">
                      {{ $about['content-text4'] }}
                    </div>
                  </div>
                  <div class="xlg-margin"></div>
                  <!-- end responses to the logo -->
                </div>
                <!-- end row -->
                <!-- end our story -->
              </div>
              <!-- End portlet body -->
              <!-- save button start -->
              <div class="form-actions none-bg"> <a data="preview" href="/" class="wbx_submit btn btn-red">Save &amp; Preview &nbsp;<i class="fa fa-search"></i></a>&nbsp; <a href="/" data="publish" class="wbx_submit btn btn-blue">Save &amp; Publish &nbsp;<i class="fa fa-globe"></i></a>&nbsp; <a href="/" id="wbx-cancel" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
              <!-- save button end -->
            </div>
            {{ Form::open( [ 'id' => 'wbx_change_info' ] ) }}
            <input type="hidden" id="wbm-icon-img1" name="about[icon-img1]" value="{{ $about['icon-img1'] }}" />
            <input type="hidden" id="wbm-icon-img2" name="about[icon-img2]" value="{{ $about['icon-img2'] }}" />
            {{Form::close()}}
            <div id="slider_edit">
              <h4 class="block-heading">Objective</h4>
              <ul id="myTab" class="nav nav-tabs">
                <li class=""><a href="#objectivetext" data-toggle="tab">Objective Text</a></li>
                <li class="active"><a href="#backgroundimage" data-toggle="tab">Background Image</a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div id="objectivetext" class="tab-pane fade">
                  <div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Objective</div>
                      <br>
                      <p class="margin-top-10px"></p>
                      <a href="#" data-target="#modal-add-objective" data-toggle="modal" class="btn btn-success">Add New Objective &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary">Delete</button>
                        <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                        <ul role="menu" class="dropdown-menu">
                          <li><a id="dellselobjabout" href="#">Delete selected item(s)</a></li>
                          <li class="divider"></li>
                          <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                        </ul>
                      </div>
                      &nbsp;
                      <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                      <!--Modal Add New Objective start-->
                      <div id="modal-add-objective" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog modal-wide-width">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                              <h4 id="modal-login-label3" class="modal-title">Add New Objective</h4>
                            </div>
                            <div class="modal-body">
                              <div class="form">
                                {{ Form::open( [ 'url' => 'admin/objtext', 'id' => 'add_obj_title', 'class' => 'form-horizontal' ] ) }}
                                <div class="form-group">
                                  <label class="col-md-3 control-label">Status</label>
                                  <div class="turnbox col-md-6"><div data-on="success" data-off="primary" class="make-switch"><input type="checkbox" name="active" value="1" checked="checked" /></div></div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label">Objective Text </label>
                                  <div class="col-md-6">
                                    {{Form::textarea('title', null, [ 'required' => 'required', 'class' => 'form-control'] )}}
                                    {{ Form::hidden('page', 'about') }}
                                  </div>
                                  <div class="col-md-3"> </div>
                                </div>
                                <div class="form-actions">
                                  <div class="col-md-offset-5 col-md-8"> <a href="#" data-dismiss="modal" id="add_ot" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" onclick="reloadPage()" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
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
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
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
                    {{ Form::open( [ 'url' => 'admin/deleteobj', 'class' => 'delete_text_objective form-horizontal' ] ) }}
                    {{ Form::hidden('page', 'about') }}
                    {{ Form::hidden('index', '') }}
                    {{ Form::close() }}
                    <!-- modal delete selected items end -->
                      <!--Modal delete all items start-->
                      <div id="modal-delete-all" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                            </div>
                            <div class="modal-body">
                              <div class="form-actions">
                                <div class="col-md-offset-4 col-md-8"> <a href="#" id="dellallobj" data-dismiss="modal" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal delete all items end -->
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
                            <th width="1%"><input type="checkbox"></th>
                            <th>#</th>
                            <th>Status</th>
                            <th>Title</th>
                            <th>Action</th>
                          </tr>
                          </thead>
                          <tbody>
                          @if(isset($data) && !empty($data))
                            @foreach($data as $index => $item)
                              <tr>
                                <td><input data="{{ $index }}" type="checkbox" class="mooncake-mod-checkbox"></td>
                                <td>{{ $index + 1 }}</td>
                                <td>

                                  @if($item['active'])
                                    <span class="label label-sm label-success">Active</span>
                                  @else
                                    <span class="label label-sm label-red">Inactive</span>
                                  @endif
                                </td>
                                <td>{{$item['title']}}</td>
                                <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-objective{{ $index }}" data-toggle="modal" title="" data-original-title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="" data-target="#modal-delete-{{ $index }}" data-toggle="modal" data-original-title="Delete"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                  <!--Modal Edit Objective start-->
                                  <div id="modal-edit-objective{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                    <div class="modal-dialog modal-wide-width">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                                          <h4 id="modal-login-label3" class="modal-title">Edit Objective</h4>
                                        </div>
                                        <div class="modal-body">
                                          <div class="form">
                                            {{ Form::open( [ 'url' => 'admin/editobj', 'data' => "$index", 'class' => 'edit_text_objective form-horizontal' ] ) }}
                                            <div class="form-group">
                                              <label class="col-md-3 control-label">Status</label>
                                              <div class="turnbox col-md-6"><div data-on="success" data-off="primary" class="make-switch">
                                                  <input type="checkbox" name="active" value="1" <? if($item['active']) echo 'checked="checked"'; ?> />
                                                </div></div>

                                            </div>
                                            {{ Form::hidden('page', 'about') }}
                                            {{ Form::hidden('index', $index) }}
                                            {{ Form::hidden('text', $item['title']) }}
                                            <div class="form-group">
                                              <label class="col-md-3 control-label">Objective Text </label>
                                              <div class="col-md-9">
                                                <div class="text-blue border-bottom">You can edit the content by clicking the text section below.</div>
                                                when edit the objective text, pls follow the css and display correctly in front end.
                                                <div id="new-txt-slobj{{ $index }}" contenteditable="true"><p>{{$item['title']}}</p></div>
                                              </div>
                                            </div>
                                            <div class="form-actions">
                                              <div class="col-md-offset-5 col-md-8"> <a href="#" data-dismiss="modal" class="edtxtslider btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                            </div>
                                            {{ Form::close() }}
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!--END MODAL Edit Montage-->
                                  <!--Modal delete start-->
                                  <div data="{{ $index }}" id="modal-delete-{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                                          <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this objective? </h4>
                                        </div>
                                        {{ Form::open(['url' => 'admin/deloneobj']) }}
                                        {{ Form::hidden('index', $index) }}
                                        {{ Form::hidden('page', 'about') }}

                                        <div class="modal-body">
                                          <p><strong>#{{ $index }}:</strong> {{ $item['title'] }}</p>
                                          <div class="form-actions">
                                            <div class="col-md-offset-4 col-md-8"> <a href="#" data-dismiss="modal" class="del-one-txtobj btn btn-red" >Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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

                        <div class="clearfix"></div>
                      </div>
                      <!-- end table responsiev -->
                    </div>
                  </div>
                  <!-- End porlet -->
                </div>
                <!-- end tab objective text -->
                <div id="backgroundimage" class="tab-pane fade active in">
                  <div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Edit Objective Background Image</div>
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
                            @if($bgimg['active'])
                              <span class="label label-sm label-success">Active</span>
                            @else
                              <span class="label label-sm label-red">Inactive</span>
                            @endif
                          </td>
                          <td>{{ $bgimg['title'] }}</td>
                          <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-objective-background" data-toggle="modal" title="" data-original-title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>
                            <!--Modal Edit Objective Background image start-->
                            <div id="modal-edit-objective-background" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade" style="display: none;">
                              <div class="modal-dialog modal-wide-width">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                                    <h4 id="modal-login-label3" class="modal-title">Edit Objective Background Image</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form" id="active-bg-image" data="{{ $bgimg['active'] }}">
                                      {{ Form::open( [ 'url' => 'admin/bgimage', 'files' => true, 'id' => 'upload_bgimage', 'class' => 'form-horizontal' ] ) }}
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Status</label>
                                        <div class="turnbox col-md-6"><div data-on="success" data-off="primary" class="make-switch">
                                            <input type="checkbox" name="active" value="1" <? if($bgimg['active'] === 1) echo 'checked="checked"' ?> />
                                          </div></div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Title </label>
                                        <div class="col-md-6">
                                          {{Form::text('title', ($bgimg['title'])? $bgimg['title'] : null, [ 'required' => 'required', 'placeholder' => 'Objective Background Image', 'id' => 'text', 'class' => 'form-control'] )}}

                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Upload Background Image <span class="require">*</span></label>
                                        <div class="col-md-9">
                                          <div id="new_bg_img" class="text-15px margin-top-10px"> <img src="<? if(isset( $bgimg['image'] )) echo $bgimg['image']; ?>" alt="Objective" class="img-responsive"><br>
                                            {{ Form::file('bgimage', ['id' => 'exampleInputFile2']) }}
                                            {{ Form::hidden('page', 'about') }}
                                            <br>
                                            <span class="help-block">(Image dimension: min. 1543 x 600 pixels, JPEG/GIF/PNG only, Max. 1MB) </span> </div>
                                        </div>
                                      </div>
                                      <div id="" class="form-actions">
                                        <div class="col-md-offset-5 col-md-8"> <a href="#" data-dismiss="modal" id="save-new-bg" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                      </div>
                                      {{Form::close()}}
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!--END MODAL Edit Objective background image -->
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
            </div>
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

<!--CORE JAVASCRIPT-->
<script src="js/main.js"></script>
<script src="js/holder.js"></script>
<script src="js/myscripts.js"></script>
<script src="js/jquery.dataTables.js"></script>

<script>
  $(document).ready(function() {
//	CKEDITOR.config.extraAllowedContent = 'div(*)';
//	CKEDITOR.editorConfig = function( config ) { config.extraAllowedContent = 'div(*)'; }
    CKEDITOR.config.allowedContent = true;

      $('#dellselobjabout').on('click', function(){

          if($('.mooncake-mod-checkbox:checked').length == 0){
              $("#modal-select-confirm").modal();
          } else {
              $("#modal-delete-selected").modal();

          }

      });

    $('#table-title-slider').DataTable({
      searching: false,
      ordering:  false
    });
    $('#myTab > li').click(function(){
      var tab = $('#myTab > li').index($(this));
      remember(tab);
    });
    function remember(item){
      var cookieName = 'tabSelected';
      var cookieOptions = {expires: 7, path: '/'};
      $.cookie(cookieName, item, cookieOptions);
    }
    //console.log($.cookie('tabSelected'));
    if($.cookie('tabSelected')){
      $('#myTab > li').removeClass('active');
      $('#myTab > li:eq(' + $.cookie('tabSelected') + ')').addClass('active');
      if($.cookie('tabSelected') == '1'){
        $('#backgroundimage').attr('class', 'tab-pane fade active in');
        $('#objectivetext').attr('class', 'tab-pane fade');
      }else{
        $('#objectivetext').attr('class', 'tab-pane fade active in');
        $('#backgroundimage').attr('class', 'tab-pane fade');
      }
    }
  });
</script>
</body>
</html>