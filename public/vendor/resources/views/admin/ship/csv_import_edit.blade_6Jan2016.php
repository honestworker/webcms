@extends('adminLayout')

@section('content')

<div id="page-wrapper"><!--BEGIN PAGE HEADER & BREADCRUMB-->

    <div class="page-header-breadcrumb">
      <div class="page-heading hidden-xs">
        <h1 class="page-title">Shipping Setup</h1>
      </div>

      <!-- InstanceBeginEditable name="EditRegion1" -->
      <ol class="breadcrumb page-breadcrumb">
        <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('web88cms/dashboard')}}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
        <li>Shipping Setup &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
        <li><a href="{{route('ship.index', 'csv')}}">CSV Import Listing</a> &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
        <li class="active">{{$ship->title}} - Edit</li>
      </ol>
      <!-- InstanceEndEditable --></div>
    <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->
    <!-- InstanceBeginEditable name="EditRegion2" -->
    <div class="page-content">
      <div class="row">
        <div class="col-lg-12">
          <h2>{{$ship->title}} <i class="fa fa-angle-right"></i> Edit</h2>
          <div class="clearfix"></div>
          @if (Session::has('success'))
	      <div class="alert alert-success alert-dismissable">
	        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
	        <i class="fa fa-check-circle"></i> <strong>Success!</strong>
	        <p>{{Session::get('success')}}</p>
	      </div>
	      @elseif (Session::has('error'))
	      <div class="alert alert-danger alert-dismissable">
	        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
	        <i class="fa fa-times-circle"></i> <strong>Error!</strong>
	        <p>{{Session::get('error')}}</p>
	      </div>
	      @endif
          <div class="pull-left"> Last updated: <span class="text-blue">15 Sept, 2014 @ 12.00PM</span> </div>
          <div class="clearfix"></div>
          <p></p>

          <div class="portlet">
          	 <div class="portlet-header">
                  <div class="caption">Shipping Method</div>
                  <div class="tools"> <i class="fa fa-chevron-up"></i> </div>


                </div>
                <!-- end portlet header -->

                    <div class="portlet-body">

                    <form class="form-horizontal" id="edit-shipping" method="post" enctype="multipart/form-data" action="{{route('ship.setup')}}">
		                <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
		                <input type="hidden" name="type" value="{{config('ship.csv')}}">
                    <input type="hidden" name="id" value="{{$ship->id}}">
		                <input type="hidden" name="edit" value="1">
		                @if (count($errors) > 0)
		                <div class="alert alert-danger alert-dismissable">
					        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
					        <i class="fa fa-times-circle"></i> <strong>Error!</strong>
					        @foreach ($errors->all() as $error)
					        <p>{{$error}}</p>
					        @endforeach
					     </div>
		                @endif
                            <div class="form-group">
                                <label class="col-md-3 control-label">Status <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                  <div data-on="success" data-off="primary" class="make-switch">
                                    <input type="checkbox" name="status" value="1" <?php if ($ship->status == '1') echo 'checked="checked"'; ?>/>
                                  </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputFirstName" class="col-md-3 control-label">Title</label>
                                <div class="col-md-6">
                                	<input type="text" name="title" class="form-control" value="{{$ship->title}}">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                    <label class="col-md-3 control-label">Import CSV</label>
                                    <div class="col-md-9">
                                      <div class="text-15px margin-top-10px">
                                      @if (file_exists(base_path().config('ship.csv_path').'/'.$ship->csv_file))
                                      	<a href="{{url(config('ship.csv_path').'/'.$ship->csv_file)}}">{{$ship->csv_file}}</a>
                                        <div class="xss-margin"></div>
                                        <a href="{{route('ship.delete.file', $ship->csv_file)}}" data-hover="tooltip" data-placement="top" title="Remove"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                      @endif
                                    	<div class="xss-margin"></div>
                                        <input id="exampleInputFile2" type="file" name="csv" />

                                        <span class="help-block">(CSV only) </span> </div>
                                    </div>
                            </div>

                            <div class="form-actions">
			                    <div class="col-md-offset-5 col-md-8"> <a href="#" id="save-shipping" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>
			                 </div>

                          </form>


                   </div>
                   <!-- end porlet-body -->
                   <div class="clearfix"></div>


              </div>
              <!-- end portlet -->

              <div class="portlet">
                <div class="portlet-header">
                  <div class="caption">Courier Charges</div>
                  <br/>
                  <p class="margin-top-10px"></p>
                  <a href="#" data-target="#modal-add-shipping" data-toggle="modal" class="btn btn-success">Add New Row &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary">Delete</button>
                    <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                    <ul role="menu" class="dropdown-menu">
                      <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                    </ul>
                  </div>

                  <div class="tools"> <i class="fa fa-chevron-up"></i> </div>

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
                            <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- modal delete all items end -->
                </div>
                <div class="portlet-body">

                  <p class="text-danger">Note: If you set courier charges to <strong>"RM 0.00"</strong>, it indicates that is <strong>"FREE Shipping"</strong>.</p>

                  <div class="table-responsive mtl">
                  		<form id="edit-table" class="form-horizontal" method="post">
                  		<input type="hidden" name="_token" id="token" value="{{csrf_token()}}" />
                  		<input type="hidden" name="id" value="{{$ship->id}}" />
                        <table id="example1" class="table table-striped table-bordered table-hover">
                            <thead>
                            @foreach ($csv_content['head'] as $key1 => $head)
                            <tr>
                            	@foreach ($head as $th)
                            	<th>
                            	{{$th}}
                            	<input type="hidden" name="head_row[{{$key1}}][]" value="{{$th}}" />
                            	</th>
                            	@endforeach
                            	@if ($key1 == 0)
                            	<th colspan="2">Action</th>
                            	@else
                            	<th></th>
                            	<th></th>
                            	@endif
                            </tr>
                            @endforeach
                            </thead>
                            <tbody>
                            @foreach ($csv_content['body'] as $key2 => $body)
                            <?php $class = (($key2+1)%2 == 0) ? 'even' : 'odd'; ?>
                            <tr class="{{$class}}}">
                            	@foreach ($body as $td)
                            		<td>
                            		<span class="row_view">{{$td}}</span>
                            		<input type="text" size="10" class="row_edit" name="body_row[{{$key2}}][]" value="{{$td}}" />
                            		</td>
                            	@endforeach
                            	<td><a href="javascript:void(0);" class="edit" data-hover="tooltip" data-placement="top" title="View/Edit" ><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a></td>

                                <td>
                                <a href="javascript:void(0);" class="delete" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-{{$key2}}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>

                                <!--Modal delete start-->
		                        <div id="modal-delete-{{$key2}}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
		                              <div class="modal-dialog">
		                                <div class="modal-content">
		                                  <div class="modal-header">
		                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
		                                    <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
		                                  </div>
		                                  <div class="modal-body">
		                                    <p><strong>Are you sure you want to delete this row?</p>
		                                    <div class="form-actions">
		                                      <div class="col-md-offset-4 col-md-8"> <a href="javascript:void(0);" onclick="deleteRow($(this))" rel="#modal-delete-{{$key2}}" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
		                                    </div>
		                                  </div>
		                                </div>
		                              </div>
		                          </div>
		                          <!-- modal delete end -->

                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

						<!--Modal Add New shipping start-->
					      <div id="modal-add-shipping" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
					        <div class="modal-dialog modal-wide-width">
					          <div class="modal-content">
					            <div class="modal-header">
					              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
					              <h4 id="modal-login-label3" class="modal-title">Add New Row</h4>
					            </div>
					            <div class="modal-body">
					              <div class="form">
					              @foreach ($csv_content['head'][$key1] as $label)
					              	<div class="form-group">
					                    <label class="col-md-3 control-label">{{$label}}</label>
					                    <div class="col-md-6">
					                      <input type="text" size="10" name="body_row[{{$key2+1}}][]" class="form-control">
					                    </div>
					                </div>
					                <div class="clearfix"></div>
					              @endforeach
					                  <div class="form-actions">
					                    <div class="col-md-offset-5 col-md-8"> <a href="javascript:void(0);" id="add-new-row" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
					                  </div>
					              </div>
					            </div>
					          </div>
					        </div>
					      </div>
					      <!--END MODAL Add New shipping method-->

                        </form>
                    </div>
                  <!-- end table responsive -->
                </div>
                <!-- end portlet body -->

                <!-- save button start -->
              <div class="form-actions none-bg">
                 <a href="{{route('ship.index', 'csv')}}" class="btn btn-blue">Back &nbsp;<i class="fa fa-reply"></i></a>&nbsp;
              </div>
          	  <!-- save button end -->

              </div>
              <!-- end portlet -->

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
            <div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
            	<div class="pull-right"><img src="images/logo_webqom.png" alt="Webqom Technologies Sdn Bhd"></div>
            </div>
    </div>
<!--END FOOTER--></div>
<!--END PAGE WRAPPER-->
<script type="text/javascript">
var clickable = true;
$(document).ready(function() {
	$('#save-shipping').click(function() {
		$('#edit-shipping').submit();
		return false;
	});

	//edit row
	$('.row_edit').hide();

	$('.edit').live('click', function () {
		var $obj = $(this);
		$obj.parent().parent().find('.row_edit').show();
		$obj.parent().parent().find('.row_view').hide();

		$obj.parent().next().find('.delete').after('<a class="cancel" href="javascript:void(0)" title="Cancel"><span class="label label-sm label-green"><i class="fa fa-times-circle"></i></span></a>');
		$obj.parent().next().find('.delete').remove();

		$obj.parent().html('<a class="save" href="javascript:void(0);" title="Save"><span class="label label-sm label-red"><i class="fa fa-save"></i>  </span></a>');
	});

	$('.cancel').live('click', function () {
		var $obj = $(this);
		$obj.parent().parent().find('.row_edit').hide();
		$obj.parent().parent().find('.row_view').show();

		$obj.parent().prev().html('<a href="javascript:void(0);" class="edit" data-hover="tooltip" data-placement="top" title="View/Edit" ><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>');

		var del_target = $obj.parent().find('.modal').attr('id');

		$obj.after('<a href="javascript:void(0);" class="delete" data-hover="tooltip" data-placement="top" title="Delete" data-target="#'+del_target+'" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>');
		$obj.remove();
	});

	$('.save, #add-new-row').live('click', function () {
		if (!clickable) {
			return false;
		}

		if ($(this).hasClass('save')) {
			//remove the add new row
			$('#modal-add-shipping').find('input[type=text]').remove();
		}

		saveTable();
	});


});//end document ready

function deleteRow(obj) {
	//remove selected row
	$(obj.attr('rel')).parent().parent().find('.row_edit').remove();
	//remove the add new row
	$('#modal-add-shipping').find('input[type=text]').remove();
	saveTable();
}

function saveTable() {
	var data = new FormData(document.getElementById('edit-table'));
	clickable = false;
	$.ajax({
		url: '{{route('ship.update.csv')}}',
		data: data,
		type: 'post',
		dataType: 'json',
		processData: false,
		contentType: false,
		success: function (response) {
			clickable = true;
			window.location.reload();
		}
	});
}
</script>

@stop