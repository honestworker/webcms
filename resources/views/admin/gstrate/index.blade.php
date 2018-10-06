@extends('adminLayout')
@section('title', 'GST Rate')
@section('content')
<div id="page-wrapper">
    <div class="page-header-breadcrumb">
        <div class="page-heading hidden-xs">
            <h1 class="page-title">GST Rate</h1>
        </div>

        <ol class="breadcrumb page-breadcrumb">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('web88cms/dashboard') }}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
            <li>Global Setup &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li class="active">GST Rate - Listing</li>
        </ol>
    </div>

    <!--BEGIN CONTENT-->

    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <h2>GST Rate <i class="fa fa-angle-right"></i> Listing</h2>
                <div class="clearfix"></div>
                @if ($success)
                <div class="alert alert-success alert-dismissable">
                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                    <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                    <p>{{ $success }}</p>
                </div>
                @endif
                @if ($warning)
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                    <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                    <p>{{ $warning }}</p>
                </div>
                @endif
                @if ($last_updated)
                <div class="pull-left"> Last updated: <span class="text-blue">{{ $last_updated }}</span> </div>
                <div class="clearfix"></div>
                <p></p>
                @endif
                <div class="clearfix"></div>
            </div>
            <!-- end col-lg-12 -->
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-header">
                        <div class="caption">GST Rate Listing</div>
                        <div class="clearfix"></div>
                        <p class="margin-top-10px"></p>
                        <a href="#" class="btn btn-success" data-target="#modal-add-rate" data-toggle="modal">Add New Rate &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Delete</button>
                            <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="#" onclick="deleteSelected()">Delete selected item(s)</a></li>
                                <li class="divider"></li>
                                <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                            </ul>
                        </div>

                        <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                        <!--Modal add new rate start-->
                        <div id="modal-add-rate" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog modal-wide-width">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                        <h4 id="modal-login-label3" class="modal-title">Add New Rate</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form">
                                            <form id="add-new-gstrate-form" class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Status <span class="text-red">*</span></label>
                                                    <div class="col-md-6">
                                                        <div data-on="success" data-off="primary" class="make-switch">
                                                            <input type="checkbox" name="status" value="1" checked="checked"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Name <span class="text-red">*</span></label>
                                                    <div class="col-md-6">
                                                        <input type="text"  class="form-control" name="name" placeholder="eg. GST Rate">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputFirstName" class="col-md-3 control-label">Rate <span class="text-red">*</span></label>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="rate" placeholder="">
                                                        <div class="xs-margin"></div>
                                                        <select name="select"  class="form-control">
                                                            <option value="%">%</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="col-md-offset-5 col-md-8"> 
                                                        <a href="javascript:void(0)" onclick="saveGstrate($(this))" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; 
                                                        <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> 
                                                    </div>
                                                </div>
                                                <input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--END MODAL add new discount -->
                        <!--modal delete selected  at least one items start-->
                        <div id="modal-selected-least-one" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                        <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger" role="alert">
                                            Please select at least one element for delete.
                                        </div> 
                                        <div class="form-actions">  
                                            <div class="col-md-offset-4 col-md-8">
                                                <a href="javascript:void(0)" data-dismiss="modal" onclick="cancel_delete()" class="btn btn-green">OK &nbsp;<i class="fa fa-times-circle"></i>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <!--Modal delete selected items start-->
                        <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                        <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-actions">
                                            <div class="col-md-offset-4 col-md-8"> <a href="javascript:void(0)" onclick="deleteGstrates($(this), 'selected')" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                                            <div class="col-md-offset-4 col-md-8"> <a href="javascript:void(0)" onclick="deleteGstrates($(this), 'all')"  class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal delete all items end -->
                    </div>
                    <div class="portlet-body">
                        <div class="form-inline pull-left">
                            <div class="form-group">
                                <select name="select" class="form-control">
                                    <option <?= ($limit == 10 ? 'selected="selected"' : ''); ?> value="10">10</option>
                                    <option <?= ($limit == 20 ? 'selected="selected"' : ''); ?> value="20">20</option>
                                    <option <?= ($limit == 30 ? 'selected="selected"' : ''); ?> value="30">30</option>
                                    <option <?= ($limit == 50 ? 'selected="selected"' : ''); ?> value="50">50</option>
                                    <option <?= ($limit == 100 ? 'selected="selected"' : ''); ?> value="100">100</option>
                                </select>
                                &nbsp;
                                <label class="control-label">Records per page</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="table-responsive mtl">
                            <table id="example1" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th width="1%"><input type="checkbox" onclick="$('input[type=checkbox]').prop('checked', $(this).is(':checked'))" /></th>
                                        <th>#</th>
                                        @if ($sort_by == 'id' && $sort == 'ASC')
                                        <th><a href="<?php echo $sorting_url . '&sort_by=id&sort=DESC'; ?>">ID</a></th>
                                        @else
                                        <th><a href="<?php echo $sorting_url . '&sort_by=id&sort=ASC'; ?>">ID</a></th>
                                        @endif
                                        @if ($sort_by == 'name' && $sort == 'ASC')
                                        <th><a href="<?php echo $sorting_url . '&sort_by=name&sort=DESC'; ?>">Name</a></th>
                                        @else
                                        <th><a href="<?php echo $sorting_url . '&sort_by=name&sort=ASC'; ?>">Name</a></th>
                                        @endif
                                        @if ($sort_by == 'rate' && $sort == 'ASC')
                                        <th><a href="<?php echo $sorting_url . '&sort_by=rate&sort=DESC'; ?>">Rate (%)</a></th>
                                        @else
                                        <th><a href="<?php echo $sorting_url . '&sort_by=rate&sort=ASC'; ?>">Rate (%)</a></th>
                                        @endif
                                        @if ($sort_by == 'status' && $sort == 'ASC')
                                        <th><a href="<?php echo $sorting_url . '&sort_by=status&sort=DESC'; ?>">Status</a></th>
                                        @else
                                        <th><a href="<?php echo $sorting_url . '&sort_by=status&sort=ASC'; ?>">Status</a></th>
                                        @endif
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    @foreach ($gstrates as $gstrate)
                                    <tr>
                                        <td><input type="checkbox" class="chk-gstrate" name="gstrates[]" value="{{ $gstrate->id }}"/></td>
                                        <td>{{ $count }}</td>
                                        <td>{{ $gstrate->id }}</td>
                                        <td>{{ $gstrate->name }}</td>
                                        <td>{{ $gstrate->rate }}%</td>
                                        @if ($gstrate->status == '1')
                                        <td><span class="label label-sm label-success">Active</span></td>
                                        @else
                                        <td><span class="label label-sm label-red">Inactive</span></td>
                                        @endif
                                        <td>
                                            <a href="#" data-hover="tooltip" data-placement="top" title="Edit" data-target="#modal-edit-rate-{{ $gstrate->id }}" data-toggle="modal" onclick="loadStates({{ $gstrate->id }})"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> 
                                            <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-{{ $gstrate->id }}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                            <!--Modal edit rate start-->
                                            <div id="modal-edit-rate-{{ $gstrate->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                                <div class="modal-dialog modal-wide-width">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                            <h4 id="modal-login-label3" class="modal-title">Edit Rate</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form">
                                                                <form class="form-horizontal">
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label">Status <span class="text-red">*</span></label>
                                                                        <div class="col-md-6">
                                                                            <div data-on="success" data-off="primary" class="make-switch">
                                                                                @if ($gstrate->status == '1')
                                                                                <input type="checkbox" name="status" value="1" checked="checked" />
                                                                                @else
                                                                                <input type="checkbox" name="status" value="0" />
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label">Name <span class="text-red">*</span></label>
                                                                        <div class="col-md-6">
                                                                            <input type="text" class="form-control" name="name" placeholder="" value="{{ $gstrate->name }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="inputFirstName" class="col-md-3 control-label">Rate <span class="text-red">*</span></label>
                                                                        <div class="col-md-6">
                                                                            <input type="text" class="form-control" name="rate" value="{{ $gstrate->rate }}">
                                                                            <div class="xs-margin"></div>
                                                                            <select name="select" class="form-control">
                                                                                <option value="%" selected="selected">%</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-actions">
                                                                        <div class="col-md-offset-5 col-md-8"> 
                                                                            <a href="javascript:void(0)" onclick="updateGstrate($(this), {{ $gstrate->id }})" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; 
                                                                            <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                                    </div>
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--END MODAL edit rate -->
                                            <!--Modal delete start-->
                                            <div id="modal-delete-{{ $gstrate->id }}" tabindex="{{ $gstrate->id }}" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                            <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this item? </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>#{{ $gstrate->id }}:</strong> {{ $gstrate->name }} - {{ $gstrate->rate }}%</p>
                                                            <div class="form-actions">
                                                                <div class="col-md-offset-4 col-md-8"> 
                                                                    <a href="{{ url('web88cms/gstrates/delete/' . $gstrate->id) }}?redirect=<?php echo urlencode($curr_url); ?>" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; 
                                                                    <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- modal delete end -->                          
                                        </td>
                                    </tr>
                                    <?php $count++; ?>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7"></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="tool-footer text-right">
                                <p class="pull-left"><?= $paginate_msg; ?></p>
                                <?php echo $gstrates->appends($_GET)->render() ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end portlet -->
            </div>
            <!-- end col-lg-12 -->
        </div>
        <!-- end row -->
    </div>
    <!--END CONTENT-->


    <div class="page-footer">
        <div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
            <div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png') }}" alt="Webqom Technologies Sdn Bhd"></div>
        </div>
    </div>

    <input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
</div>

<!--LOADING SCRIPTS FOR PAGE-->
<script src="{{ asset('/public/admin/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/moment/moment.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-clockface/js/clockface.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/jquery-maskedinput/jquery-maskedinput.js') }}"></script>
<script src="{{ asset('/public/admin/js/form-components.js') }}"></script>
<!--LOADING SCRIPTS FOR PAGE-->


<script>
//Create new GST Rate
                                                                                function saveGstrate(obj) {
                                                                                $.ajax({
                                                                                url: "{{ url('web88cms/gstrates/newGstrate') }}",
                                                                                        type: 'POST',
                                                                                        data: $('#add-new-gstrate-form').serialize(),
                                                                                        dataType: 'json',
                                                                                        async: false,
                                                                                        cache: false,
                                                                                        beforeSend: function () {
                                                                                        obj.html('Saving... <i class="fa fa-floppy-o"></i>');
                                                                                        },
                                                                                        complete: function () {
                                                                                        obj.html('Save <i class="fa fa-floppy-o"></i>');
                                                                                        },
                                                                                        success: function (response) {
                                                                                        var html = '';
                                                                                        $('#warning-box').remove();
                                                                                        $('#success-box').remove();
                                                                                        if (response['error'])
                                                                                        {
                                                                                        html += '<div id="warning-box" class="alert alert-danger alert-dismissable">';
                                                                                        html += '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>';
                                                                                        html += '<i class="fa fa-times-circle"></i> <strong>Error!</strong>';
                                                                                        for (var i = 0; i < response['error'].length; i++)
                                                                                        {
                                                                                        html += '<p>' + response['error'][i] + '</p>';
                                                                                        }

                                                                                        html += '</div>';
                                                                                        $('#add-new-gstrate-form').before(html);
                                                                                        }

                                                                                        if (response['success'])
                                                                                        {
                                                                                        window.location.reload();
                                                                                        }
                                                                                        }
                                                                                });
                                                                                }

//Create new user
                                                                                function updateGstrate(obj, id) {
                                                                                $.ajax({
                                                                                url: "{{ url('web88cms/gstrates/editGstrate') }}/" + id,
                                                                                        type: 'POST',
                                                                                        data: $('#modal-edit-rate-' + id + ' .form-horizontal').serialize(),
                                                                                        dataType: 'json',
                                                                                        async: false,
                                                                                        cache: false,
                                                                                        beforeSend: function () {
                                                                                        obj.html('Saving... <i class="fa fa-floppy-o"></i>');
                                                                                        },
                                                                                        complete: function () {
                                                                                        obj.html('Save <i class="fa fa-floppy-o"></i>');
                                                                                        },
                                                                                        success: function (response) {
                                                                                        var html = '';
                                                                                        $('#warning-box').remove();
                                                                                        $('#success-box').remove();
                                                                                        if (response['error'])
                                                                                        {
                                                                                        html += '<div id="warning-box" class="alert alert-danger alert-dismissable">';
                                                                                        html += '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>';
                                                                                        html += '<i class="fa fa-times-circle"></i> <strong>Error!</strong>';
                                                                                        for (var i = 0; i < response['error'].length; i++)
                                                                                        {
                                                                                        html += '<p>' + response['error'][i] + '</p>';
                                                                                        }

                                                                                        html += '</div>';
                                                                                        $('#modal-edit-rate-' + id + ' .form-horizontal').before(html);
                                                                                        }

                                                                                        if (response['success'])
                                                                                        {
                                                                                        html += '<div class="alert alert-success alert-dismissable">';
                                                                                        html += '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>';
                                                                                        html += '<i class="fa fa-check-circle"></i> <strong>Success!</strong>';
                                                                                        html += '<p>' + response['success'] + '</p>';
                                                                                        html += '</div>';
                                                                                        $('#modal-edit-rate-' + id + ' .form-horizontal').before(html);
                                                                                        window.location.reload();
                                                                                        }
                                                                                        }
                                                                                });
                                                                                }

//Delete
                                                                                function deleteGstrates(obj, type) {
                                                                                if (type == 'selected') {
                                                                                values = $('.chk-gstrate:checked, #_token');
                                                                                } else {
                                                                                values = $('.chk-gstrate, #_token');
                                                                                }

                                                                                var total = values.length;
                                                                                console.log("values ",values);
                                                                                if (total > 0) {
                                                                                $.ajax({
                                                                                url: "{{ url('web88cms/gstrates/deleteAllGstrate') }}",
                                                                                        type: 'POST',
                                                                                        data: values,
                                                                                        dataType: 'json',
                                                                                        async: false,
                                                                                        cache: false,
                                                                                        beforeSend: function () {
                                                                                        obj.html('Saving... <i class="fa fa-floppy-o"></i>');
                                                                                        },
                                                                                        complete: function () {
                                                                                        obj.html('Save <i class="fa fa-floppy-o"></i>');
                                                                                        },
                                                                                        success: function (response) {
                                                                                        if (response['success'])
                                                                                        {
                                                                                        window.location.reload();
                                                                                        }
                                                                                        }
                                                                                });
                                                                                } else {
                                                                                alert('Please select at least one GST Rate before delete.');
                                                                                }
                                                                                }

//
                                                                                function loadStates(id) {

                                                                                }

//Set Limit
                                                                                $(function () {
                                                                                $('select[name="select_per_page"]').change(function () {
<?php if ($_SERVER['QUERY_STRING']) { ?>
                                                                                    window.location = '<?= url("web88cms/gstrates"); ?>/' + $(this).val() + "?<?= $_SERVER['QUERY_STRING']; ?>";
<?php } else { ?>
                                                                                    window.location = '<?= url("web88cms/gstrates"); ?>/' + $(this).val();
<?php } ?>
                                                                                });
                                                                                });
                                                                                function deleteSelected() {
                                                                                values = $('.chk-gstrate:checked');
                                                                                if (values.length == 0) {
                                                                                $('#modal-selected-least-one').modal('show');
                                                                                return false;
                                                                                }
                                                                                $('#modal-delete-selected').modal('show');
                                                                                }
</script>
@endsection
