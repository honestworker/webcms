@extends('adminLayout')
@section('title', 'On-Screen Messages')
@section('styles')
    <link href="https://unpkg.com/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet">
    <style>
        .footer-position {
            position: absolute !important;
            bottom: 0 !important;
            height: 62px !important;
        }
    </style>
@endsection
@section('content')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <div id="page-wrapper"><!--BEGIN PAGE HEADER & BREADCRUMB-->

        <div class="page-header-breadcrumb">
            <div class="page-heading hidden-xs">
                <h1 class="page-title">On-Screen Messages</h1>
            </div>
            <ol class="breadcrumb page-breadcrumb">
                <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('web88cms/dashboard') }}">Dashboard</a>&nbsp<i
                            class="fa fa-angle-right"></i>&nbsp;
                </li>
                <li>Global Setup <i class="fa fa-angle-right"></i>&nbsp;
                </li>
                <li class="active">On-Screen Messages - Listing</li>
            </ol>
        </div>
        <div class="page-content">
            <div class="row">
                <div class="col-lg-12">
                    <h2>On-Screen Messages - Listing </h2>
                    <div class="clearfix" id="flash_message"></div>
                    <p>
                    @if (Session::has('flash_message'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" data-dismiss="alert" aria-hidden="true"
                                    onClick="$('.form-horizontal').trigger('reset');" class="close">&times;
                            </button>
                            <i class="fa fa-check-circle"></i>
                            <strong>Success!</strong> {{ Session::get('flash_message') }}
                        </div>
                        @endif
                        </p>

                    <!-- {{ $error = Session::get('error') }}
                        {{ Session::get('error') }}-->
                        @if($error)
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" data-dismiss="alert" aria-hidden="true"
                                        onClick="$('.form-horizontal').trigger('reset');" class="close">&times;
                                </button>
                                <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                                <p>{{ $error }}</p>
                            </div>
                        @endif

                        <div class="clearfix"></div>
                        <p></p>
                        <div class="clearfix"></div>
                        <div class="portlet">
                            <div class="portlet-header">
                                <div class="caption">On-Screen Messages</div>
                                <br/>
                                <p class="margin-top-10px"></p>
                                <a href="#" data-target="#modal-create-booking" data-toggle="modal"
                                   class="btn btn-success">Add New On-Screen Message &nbsp;<i
                                            class="fa fa-plus"></i></a>
                                <div class="row">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($book as $index=>$b)
                                            <tr>
                                                <td>{{$index+1}}</td>
                                                <td>{{$b->description}}</td>
                                                <td>
                                                    @if($b->status)
                                                        <span class="label label-sm label-success">Active</span>
                                                    @else
                                                        <span class="label label-sm label-danger">Deactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="editModal" data-id="{{$b->id}}"
                                                       data-status="{{$b->status}}"
                                                       data-description="{{$b->description}}" data-hover="tooltip"
                                                       data-placement="top"
                                                       data-original-title="Edit"><span
                                                                class="label label-sm label-success"><i
                                                                    class="fa fa-pencil"></i></span></a>
                                                    <a href="javascript:void(0)" class="deleteModal"
                                                       data-ids="{{$index+1}}" data-id="{{$b->id}}"  data-description="{{$b->description}}" data-hover="tooltip"
                                                       data-placement="top" title="" data-original-title="Delete"><span
                                                                class="label label-sm label-red"><i
                                                                    class="fa fa-trash-o"></i></span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- delete individual item -->
                                <div id="modal-delete" tabindex="-1" role="dialog"
                                     aria-hidden="true" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" data-dismiss="modal" aria-hidden="true"
                                                        class="close">
                                                    &times;
                                                </button>
                                                <h4 id="modal-login-label4" class="modal-title"><a href=""><i
                                                                class="fa fa-exclamation-triangle"></i></a> Are you sure
                                                    you
                                                    want to delete this? </h4>
                                            </div>
                                            <div class="modal-body">
                                                <span id="textMessage"></span>
                                                <div class="form-actions">
                                                    <div class="col-md-offset-4 col-md-8">
                                                        <form id="popUpForm" class="form-horizontal" method="post"
                                                              action="{{ url('/web88cms/booking/delete') }}">
                                                            <input type="hidden" name="_token"
                                                                   value="<?php echo csrf_token(); ?>">
                                                            <input type="hidden" name="booking_id" id="deleteBookingId">
                                                            <div class="row">
                                                            <button type="submit" href="javascript:void(0)"
                                                                    class="btn btn-red">Yes&nbsp;<i
                                                                        class="fa fa-check"></i></button>&nbsp;
                                                            <a href="javascript:void(0)" type="button" data-dismiss="modal"
                                                               class="btn btn-green">No &nbsp;<i
                                                                        class="fa fa-times-circle"></i></a>
                                                            </div>
                                                        </form>
                                                      </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="modal-edit-booking" tabindex="-1" role="dialog"
                                     aria-labelledby="modal-login-label" aria-hidden="false" class="modal fade in">
                                    <div class="modal-dialog modal-wide-width">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" data-dismiss="modal" aria-hidden="true"
                                                        class="close">×
                                                </button>
                                                <h4 id="modal-login-label3" class="modal-title">Edit On-Screen
                                                    Message</h4>
                                            </div>

                                            <div class="modal-body">
                                                <div class="form">
                                                    <form id="popUpForm" class="form-horizontal" method="post"
                                                          action="{{ url('/web88cms/onScreenMessages') }}">
                                                        <input type="hidden" name="_token"
                                                               value="<?php echo csrf_token(); ?>">

                                                        <input type="hidden" name="booking_id" id="editModalId">
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Status</label>
                                                            <div class="col-md-6">
                                                                <input type="checkbox" name="status" id="status"
                                                                       data-on-color="danger" data-on-text="ACTIVE"
                                                                       data-off-text="INACTIVE" checked
                                                                       class="switch_status">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Description <span
                                                                        class="require">*</span></label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" id="description"
                                                                       name="description">
                                                            </div>

                                                        </div>
                                                        <div class="form-actions">
                                                            <div class="col-md-offset-5 col-md-8">
                                                                <button class="btn btn-red">Save &nbsp;<i
                                                                            class="fa fa-floppy-o"></i></button>&nbsp;
                                                                <a href="#" data-dismiss="modal"
                                                                   class="btn btn-green">Cancel &nbsp;<i
                                                                            class="glyphicon glyphicon-ban-circle"></i></a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="modal-create-booking" tabindex="-1" role="dialog"
                                     aria-labelledby="modal-login-label" aria-hidden="false" class="modal fade in">
                                    <div class="modal-dialog modal-wide-width">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" data-dismiss="modal" aria-hidden="true"
                                                        class="close">×
                                                </button>
                                                <h4 id="modal-login-label3" class="modal-title">Add On-Screen
                                                    Message</h4>
                                            </div>

                                            <div class="modal-body">
                                                <div class="form">
                                                    <form id="addOnScreenMessageForm" class="form-horizontal"
                                                          method="post"
                                                          action="{{ url('/web88cms/add_on_screen_message') }}">
                                                        <input type="hidden" name="_token"
                                                               value="<?php echo csrf_token(); ?>">

                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Status</label>
                                                            <div class="col-md-6">
                                                                <input type="checkbox" name="status"
                                                                       data-on-color="danger" data-on-text="ACTIVE"
                                                                       data-off-text="INACTIVE"
                                                                       class="switch_status">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Description <span
                                                                        class="require">*</span></label>
                                                            <div class="col-md-6">
                                                                <input id="text" type="text" class="form-control"
                                                                       value="" name="description">
                                                            </div>

                                                        </div>
                                                        <div class="form-actions">
                                                            <div class="col-md-offset-5 col-md-8">
                                                                <button class="btn btn-red">Save &nbsp;<i
                                                                            class="fa fa-floppy-o"></i></button>&nbsp;
                                                                <a href="#" data-dismiss="modal"
                                                                   class="btn btn-green">Cancel &nbsp;<i
                                                                            class="glyphicon glyphicon-ban-circle"></i></a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
        <!--BEGIN FOOTER-->
        <div class="page-footer footer-position">
            <div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a
                            href="mailto:support@webqom.com">Webqom Support</a>.</span>
                <div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png')}}"
                                             alt="Webqom Technologies Sdn Bhd"></div>
            </div>
        </div>
        <!--END FOOTER-->
    </div>




    <script src="{{ URL::asset('public/admin/js/jquery-1.9.1.js') }}"></script>
    <script src="{{ URL::asset('public/admin/js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script src="{{ URL::asset('public/admin/js/jquery-ui.js') }}"></script>
    <script src="{{ URL::asset('public/admin/js/jquery.validate.min.js') }}"></script>

    <script src="{{ URL::asset('public/admin/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('public/admin/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js') }}"></script>
    <script src="{{ URL::asset('public/admin/js/html5shiv.js') }}"></script>
    <script src="{{ URL::asset('public/admin/js/respond.min.js') }}"></script>
    <script src="{{ URL::asset('public/admin/vendors/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ URL::asset('public/admin/vendors/slimScroll/jquery.slimscroll.js') }}"></script>
    <script src="{{ URL::asset('public/admin/vendors/jquery-cookie/jquery.cookie.js') }}"></script>
    <script src="{{ URL::asset('public/admin/js/jquery.menu.js') }}"></script>
    <script src="{{ URL::asset('public/admin/vendors/jquery-pace/pace.min.js') }}"></script>


    <script src="{{ URL::asset('public/admin/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ URL::asset('public/admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ URL::asset('public/admin/vendors/moment/moment.js') }}"></script>
    <script src="{{ URL::asset('public/admin/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ URL::asset('public/admin/vendors/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
    <script src="{{ URL::asset('public/admin/vendors/bootstrap-clockface/js/clockface.js') }}"></script>
    <script src="{{ URL::asset('public/admin/vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
    {{--    <script src="{{ URL::asset('public/admin/vendors/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>--}}
    <script src="https://unpkg.com/bootstrap-switch"></script>

    <script src="{{ URL::asset('public/admin/vendors/jquery-maskedinput/jquery-maskedinput.js') }}"></script>
    <script src="{{ URL::asset('public/admin/js/form-components.js') }}"></script>


    <script src="{{ URL::asset('public/admin/vendors/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('public/admin/vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ URL::asset('public/admin/js/ui-tabs-accordions-navs.js') }}"></script>


    <script src="{{ URL::asset('public/admin/js/main.js') }}"></script>
    <script src="{{ URL::asset('public/admin/js/holder.js') }}"></script>
    <script type="text/javascript">
        $("[name='status']").bootstrapSwitch();
        $(document).on('click', '.editModal', function () {
            var id = $(this).data('id');
            var description = $(this).data('description');
            var status = $(this).data('status');
            $('#editModalId').val(id);
            $('#modal-edit-booking #description').val(description);
            if (status === 1) {
                $(".switch_status").bootstrapSwitch({
                    checked: true,
                });
            }
            $('#modal-edit-booking').modal('show');


        });
        $(document).on('click', '.deleteModal', function () {
            var id = $(this).data('id');
            var ids = $(this).data('ids');
            var description = $(this).data('description');

            $('#modal-delete #deleteBookingId').val(id);
            $('#modal-delete').find("#textMessage").html('#'+ids+': '+description);
            $('#modal-delete').modal('show');
        });
        $('#addOnScreenMessageForm').validate({
            rules: {
                Description: "required",
            },
            errorPlacement: function (error, element) {
                var elem = $(element);
                if (elem.hasClass("select")) {
                    error.appendTo(element.parent());
                } else {
                    error.insertAfter(element);
                }

                error.css('color', 'red');
            }
            , submitHandler: function (form) {
                form.submit();
            }
        });


    </script>
@endsection



