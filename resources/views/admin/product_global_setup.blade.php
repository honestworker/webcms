@extends('adminLayout')

<style>

    #ui-datepicker-div{
        z-index: 300 !important;
    }
</style>
@section('content')
    <div id="page-wrapper"><!--BEGIN PAGE HEADER & BREADCRUMB-->

        <div class="page-header-breadcrumb">
            <div class="page-heading hidden-xs">
                <h1 class="page-title">Products</h1>
            </div>

            <!-- InstanceBeginEditable name="EditRegion1" -->
            <ol class="breadcrumb page-breadcrumb">
                <li><i class="fa fa-home"></i>&nbsp;<a href="dashboard.html">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
                <li>Products &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
                <li class="active">Product Global Settings - Setup</li>
            </ol>
            <!-- InstanceEndEditable --></div>
        <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->
        <!-- InstanceBeginEditable name="EditRegion2" -->
        <div class="page-content">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Product Global Settings <i class="fa fa-angle-right"></i> Setup</h2>
                    <div class="clearfix"></div>
                    @if($success)
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                            <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                            <p>{{ $success }}</p>
                        </div>
                    @endif

                    @if($warning)
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                            <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                            <p>{{ $warning }}</p>
                        </div>
                    @endif
                    <div class="pull-left"> Last updated: <span class="text-blue">{{$last_update->day}} {{ $last_update->format('M') }}, {{ $last_update->year }} @ {{ $last_update->hour }}.{{ $last_update->minute }} {{$last_update->format('A')}}</span></div>
                    <div class="clearfix"></div>
                    <p></p>

                    <div class="portlet">
                        <div class="portlet-header">
                            <div class="caption">Product Global Setup</div>
                            <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                        </div>
                        <div class="portlet-body">

                            <div class="row">
                                <div class="col-md-12">

                                    <form id="global-product-form" enctype='multipart/form-data' action="{{url('/web88cms/prdouctglobalsetup')}}" method="post">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Import Products Data in Bulk (CSV format) <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                            <input id="exampleInputFile1" name="datafile" type="file"/>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="xs-margin"></div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Change Product Display Status <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                            <div data-on="success"  data-off="primary" class="make-switch1">
                                                <input type="checkbox" id="status" @if($old_status) checked="checked" @endif name="status" />
                                            </div>
                                            <div class="xs-margin"></div>
                                            <div class="text-12px text-blue">(All products will be affected) </div>
                                        </div>
                                    </div>

                                        <input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input id="change_status" type="hidden" name="change_status" value="1">
                                    </form>
                                    <div class="clearfix"></div>
                                    <div class="xs-margin"></div>


                                    <!-- end form -->


                                    <div class="clearfix"></div>
                                    <!-- end user account information -->
                                    <div class="lg-margin"></div>

                                    <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-7"> <a href="#" class="btn btn-red" onclick="saveGlobalProduct($(this))">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                    </div>



                                </div>
                                <!-- end col-md-12 -->


                            </div>

                        </div><!-- end portlet body -->
                    </div><!-- End porlet -->



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
                <div class="pull-right"><img src="{{asset('public/admin/images')}}/logo_webqom.png" alt="Webqom Technologies Sdn Bhd"></div>
            </div>
        </div>
        <!--END FOOTER--></div>
    <!--END PAGE WRAPPER--></div>

    <!--LOADING SCRIPTS FOR PAGE-->
    <script src="{{ asset('/public/admin/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('/public/admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('/public/admin/vendors/moment/moment.js') }}"></script>
    <script src="{{ asset('/public/admin/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('/public/admin/vendors/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('/public/admin/vendors/bootstrap-clockface/js/clockface.js') }}"></script>
    <script src="{{ asset('/public/admin/vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
    <script src="{{ asset('/public/admin/vendors/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('/public/admin/vendors/jquery-maskedinput/jquery-maskedinput.js') }}"></script>
    <script src="{{ asset('/public/admin/js/form-components.js') }}"></script>
    <!--LOADING SCRIPTS FOR PAGE-->


    <script>

        $(document).ready(function(){

            $(".make-switch1").bootstrapSwitch();

            $("#public").click(function(e){
                e.preventDefault();
                $("#who-btn").text('Public (Anyone)');
                $("#who").val('1');
            });

            $("#admin").click(function(e){
                e.preventDefault();
                $("#who-btn").text('Administrators (This site administrators)');
                $("#who").val('2');
            });

            $("#only_me").click(function(e){
                e.preventDefault();
                $("#who-btn").text('Only Me (Only Me)');
                $("#who").val('3');
            });


        });


        function saveGlobalProduct(obj) {
            $('#global-product-form').submit();
            return;
            console.log($('#global-product-form').serialize());
            return;
            $.ajax({
                url: "{{ url('/web88cms/globalsettings/save') }}",
                type: 'POST',
                data: $('#global-product-form').serialize(),
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

                    if (response['error']) {
                        html += '<div id="warning-box" class="alert alert-danger alert-dismissable">';
                        html += '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>';
                        html += '<i class="fa fa-times-circle"></i> <strong>Error!</strong>';

                        for (var i = 0; i < response['error'].length; i++) {
                            html += '<p>' + response['error'][i] + '</p>';
                        }

                        html += '</div>';
                        $('#golbal-setting-form').before(html);
                    }

                    if (response['success']) {
                        window.location.reload();
                    }
                }
            });
        }


    </script>
@endsection
