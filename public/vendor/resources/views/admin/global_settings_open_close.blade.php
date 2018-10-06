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
                <h1 class="page-title">Global Settings</h1>
            </div>

            <ol class="breadcrumb page-breadcrumb">
                <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('web88cms/dashboard') }}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
                <li>Global Settings &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
                <li class="active">Open or Close - Setup</li>
            </ol>
        </div>
        <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->

        <div class="page-content">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Open or Close <i class="fa fa-angle-right"></i> Setup</h2>
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
                    <div class="pull-left"> Last updated: <span class="text-blue">{{$last_update->day}} {{ $last_update->format('M') }}, {{ $last_update->year }} @ {{ $last_update->hour }}.{{ $last_update->minute }} {{$last_update->format('A')}}</span></div>
                    <div class="clearfix"></div>
                    <p></p>

                    <div class="portlet">
                        <div class="portlet-header">
                            <div class="caption">Open or Close Setup</div>
                            <div class="tools"><i class="fa fa-chevron-up"></i></div>
                        </div>
                        <div class="portlet-body">

                            <div class="row">
                                <div class="col-md-12">

                                    <form action="#" id="golbal-setting-form">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">eCommerce Operation <span
                                                    class="text-red">*</span></label>
                                        <div class="col-md-6">
                                            <div data-on="success" data-off="primary" class="make-switch1">
                                                <input type="checkbox" name="status" @if($setting->status) checked="checked" @endif/>
                                            </div>
                                            <div class="xs-margin"></div>
                                            <div class="text-12px text-blue">(When option chosen is "Close", user cannot
                                                add items to cart and checkout)
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="xs-margin"></div>
                                    <div class="form-group">
                                        <label for="inputFirstName" class="col-md-4 control-label">Who can see my pages
                                            when I am close? <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                            <div class="btn-group">
                                                <button type="button" id="who-btn" class="btn btn-blue">Public (Anyone)</button>
                                                <button type="button" data-toggle="dropdown"
                                                        class="btn btn-blue dropdown-toggle" style="display: block; height: 32px;"><span class="caret"></span><span
                                                            class="sr-only">Toggle Dropdown</span></button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li><a href="#" id="public">Public <span
                                                                    class="text-12px text-blue">(Anyone)</span></a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#" id="admin">Administrators <span class="text-12px text-blue">(This site administrators)</span></a>
                                                    </li>
                                                    <li><a href="#" id="only_me">Only Me <span
                                                                    class="text-12px text-blue">(Only Me)</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <input type="hidden" name="who" id="who" value="1">
                                            <div class="xs-margin"></div>
                                            <div class="text-12px text-blue">(If option chosen is "Administrators" or
                                                "Only Me", password is required in order to view the page from
                                                www.yourdomain.com)
                                            </div>
                                        </div>

                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="xs-margin"></div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Re-opens Date</label>
                                        <div class="col-md-3"><input type="text" name="reopendate" data-date-format="mm-dd-yyyy"
                                                                     placeholder="eg. 20th Nov, 2014"
                                                                     value="{{$setting->reopendate or ''}}"
                                                                     class="datepicker-default form-control"/></div>

                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="xs-margin"></div>

                                    <div class="form-group">
                                        <label for="password" class="control-label col-md-4">Password <span
                                                    class="text-red">*</span></label>
                                        <div class="col-md-6">
                                            <div class="input-icon"><i class="fa fa-key"></i> <input id="password"
                                                                                                     name="password"
                                                                                                     type="password"
                                                                                                     placeholder="Password"
                                                                                                     class="form-control"
                                                                                                     value=""/>
                                                {{--<a href="{{ url('/passwordreset') }}" class="text-12px">Request password reset</a>--}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="xs-margin"></div>

                                    <div class="form-group">
                                        <label for="inputFirstName" class="col-md-4 control-label">Notification message
                                            when you are closed </label>
                                        <div class="col-md-6">
                                            <textarea name="message" class="form-control" placeholder="Put your message here...">{{ $setting->message or '' }}</textarea>
                                            <div class="xs-margin"></div>
                                            <div class="text-12px text-blue">You can inform visitor to your website that
                                                you are close for an estimated number of days for maintenance or updates
                                                and will be re-open once it is done. This message will not appear in
                                                your website when yout site's status is "Open".
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="xs-margin"></div>


                                    <!-- end form -->


                                    <div class="clearfix"></div>
                                    <!-- end user account information -->
                                    <div class="lg-margin"></div>

                                    <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-7"><a href="#" onclick="saveGlobalSettings($(this))" class="btn btn-red">Save
                                                &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#"
                                                                                                  data-dismiss="modal"
                                                                                                  class="btn btn-green">Cancel
                                                &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a></div>
                                    </div>


                                        <input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input id="user_id" type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                     </form>
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
        <!--END CONTENT-->

        <!--BEGIN FOOTER-->
        <div class="page-footer">
            <div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom
                        Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom
                        Support</a>.</span>
                <div class="pull-right"><img src="{{asset('public/admin/images')}}/logo_webqom.png" alt="Webqom Technologies Sdn Bhd"></div>
            </div>
        </div>
        <!--END FOOTER-->

    <!--END PAGE WRAPPER-->


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

            @if($setting->who == 1)
                $("#public").click();
            @elseif($setting->who == 2)
                $("#admin").click();
            @elseif($setting->who == 3)
                $("#only_me").click();
            @endif
        });


        function saveGlobalSettings(obj) {
            $.ajax({
                url: "{{ url('/web88cms/globalsettings/save') }}",
                type: 'POST',
                data: $('#golbal-setting-form').serialize(),
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
