@extends('adminBannerLayout')
@section('title', 'Checking In/Checking Out:: Listing')
@section('content')
<div id="page-wrapper"><!--BEGIN PAGE HEADER & BREADCRUMB-->

    <div class="page-header-breadcrumb">
        <div class="page-heading hidden-xs">
            <h1 class="page-title">Dashboard</h1>
        </div>
        <ol class="breadcrumb page-breadcrumb">
            <li><i class="fa fa-home"></i>&nbsp;<a href="dashboard">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
            <li>Bookings &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li class="active">Checking In / Checking Out - Listing</li>
        </ol>
    </div>
    <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->

    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <h2>Checking In / Checking Out <i class="fa fa-angle-right"></i> Listing</h2>
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
                @if (false)
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
                        <div class="caption">Checking In / Checking Out Listing</div>
                        <br/>
                        <p class="margin-top-10px"></p>
                        @if(false)
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Delete</button>
                            <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="#" data-target="#modal-delete-selected" data-toggle="modal">Delete selected item(s)</a></li>
                                <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                            </ul>
                        </div>
                        @endif
                        <a href="{{ $csv_url }}" class="btn btn-blue">Export to CSV &nbsp;<i class="fa fa-share"></i></a>
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
                                        <p><strong>#1:</strong> RGH-0000000001 / Hock Lim</p>
                                        <div class="form-actions">
                                            <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                                            <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                                <select name="select_per_page" class="form-control">
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
                        <br/>
                        <div class="col-md-6">
                            <div class="portlet portlet-blue">
                                <div class="portlet-header">
                                    <div class="caption text-white">Search Checking In By Date</div>
                                </div>
                                <div class="portlet-body border-bottom">
                                    <form method="get" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Checking In</label>
                                            <div class="col-md-8">
                                                <div class="input-group input-daterange">
                                                    <input type="text" name="checkin_from" class="form-control" required data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="{{ Input::get('checkin_from') }}"/>
                                                    <span class="input-group-addon">to</span>
                                                    <input type="text" name="checkin_to" class="form-control" required data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="{{ Input::get('checkin_to') }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="checkout_from" value="{{ Input::get('checkout_from') }}"/>
                                        <input type="hidden" name="checkout_to" value="{{ Input::get('checkout_to') }}"/>
                                        <!-- save button start -->
                                        <div class="form-actions text-center"> <button type="submit" class="btn btn-red">Search &nbsp;<i class="fa fa-search"></i></button> </div>
                                        <!-- save button end -->
                                    </form>
                                </div>
                                <!-- end portlet-body -->
                            </div>
                            <div class="clearfix"></div>

                            <div class="table-responsive mtl">
                                <div class="pull-left"><a href="{{ route('checkInOut', ['checkin_date' => $checkin_previous_date,'checkout_date' => app('request')->input('checkout_date')] ) }}"><i class="fa fa-angle-double-left"></i> previous day</a></div>
                                <div class="pull-right"><a href="{{ route('checkInOut', ['checkin_date' => $checkin_next_date,'checkout_date' => app('request')->input('checkout_date')]) }}">next day <i class="fa fa-angle-double-right"></i></a></div>
                                <div class="clearfix"></div><br/>
                                <h5 class="text-center">Checking In: <span class="text-blue">{{ $current_date_chackin }}</span></h5>

                                <table id="example1" class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><a href="#sort by booking id">Booking ID</a></th>
                                            <th><a href="#sort by date">Date</a></th>
                                            <th><a href="#sort by customer name">Customer Name</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($checkins as $key=>$checkin)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><a href="{{ URL::to('web88cms/orders/detail/'.$checkin->order_id) }}">{{ $checkin->order_id }}</a></td>
                                            <td>{{ $checkin->date_checkin }}</td>
                                            <td><a href="{{ URL::to('/web88cms/customers/view/'.$checkin->order->customer->id) }}">{{ $checkin->order->customer->first_name." ".$checkin->order->customer->last_name }}</a></td> 
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4"></td>
                                        </tr>
                                    </tfoot>
                                </table>


                            </div>
                        </div><!-- col-md-6 -->

                        <div class="col-md-6">
                            <div class="portlet portlet-blue">
                                <div class="portlet-header">
                                    <div class="caption text-white">Search Checking Out By Date</div>
                                </div>
                                <div class="portlet-body border-bottom">
                                    <form method="get" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Checking Out</label>
                                            <div class="col-md-8">
                                                <div class="input-group input-daterange">
                                                    <input type="text" name="checkout_from" class="form-control" required data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="{{ Input::get('checkout_from') }}"/>
                                                    <span class="input-group-addon">to</span>
                                                    <input type="text" name="checkout_to" class="form-control" required data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="{{ Input::get('checkout_to') }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="checkin_from" value="{{ Input::get('checkin_from') }}"/>
                                        <input type="hidden" name="checkin_to" value="{{ Input::get('checkin_to') }}"/>
                                        <!-- save button start -->
                                        <div class="form-actions text-center"> <button type="submit" class="btn btn-red">Search &nbsp;<i class="fa fa-search"></i></button> </div>
                                        <!-- save button end -->
                                    </form>
                                </div>
                                <!-- end portlet-body -->
                            </div>
                            <div class="clearfix"></div>

                            <div class="table-responsive mtl">
                                <div class="pull-left"><a href="{{ route('checkInOut', ['checkout_date' => $checkout_previous_date,'checkin_date' => app('request')->input('checkin_date')]) }}"><i class="fa fa-angle-double-left"></i> previous day</a></div>
                                <div class="pull-right"><a href="{{ route('checkInOut', ['checkout_date' => $checkout_next_date,'checkin_date' => app('request')->input('checkin_date')]) }}">next day <i class="fa fa-angle-double-right"></i></a></div>
                                <div class="clearfix"></div><br/>
                                <h5 class="text-center">Checking Out: <span class="text-blue">{{ $current_date_chackout }}</span></h5>

                                <table id="example1" class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><a href="#sort by booking id">Booking ID</a></th>
                                            <th><a href="#sort by date">Date</a></th>
                                            <th><a href="#sort by customer name">Customer Name</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($checkouts as $key=>$checkout)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><a href="{{ URL::to('/web88cms/orders/detail/'.$checkout->order_id) }}">{{ $checkout->order_id }}</a></td>
                                            <td>{{ $checkout->date_checkout }}</td>
                                            <td><a href="{{ URL::to('/web88cms/customers/view/'.$checkout->order->customer->id) }}">{{ $checkout->order->customer->first_name." ".$checkout->order->customer->last_name }}</a></td> 
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4"></td>
                                        </tr>
                                    </tfoot>
                                </table>


                            </div>
                        </div><!-- col-md-6 -->

                        <!--                        <div class="tool-footer text-right">
                                                    <p class="pull-left">Showing 1 to 10 of 57 entries</p>
                                                    
                                                    <ul class="pagination pagination mtm mbm">
                                                        <li class="disabled"><a href="#">&laquo;</a></li>
                                                        <li class="active"><a href="#">1</a></li>
                                                        <li><a href="#">2</a></li>
                                                        <li><a href="#">3</a></li>
                                                        <li><a href="#">4</a></li>
                                                        <li><a href="#">5</a></li>
                                                        <li><a href="#">&raquo;</a></li>
                                                    </ul>
                                                </div>-->

                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- end porlet -->
            </div>
            <!-- end col-lg-12 -->
        </div>
        <!-- end row -->
    </div>
    <!--END CONTENT-->

    <!--BEGIN FOOTER-->
    <div class="page-footer">
        <div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
            <div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png') }}" alt="Webqom Technologies"></div>
        </div>
    </div>
    <!--END FOOTER--></div>
<script src="{{ asset('/public/admin/js/jquery-1.9.1.js') }}"></script>
<script src="{{ asset('/public/admin/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ asset('/public/admin/js/jquery-ui.js') }}"></script>
<!--loading bootstrap js-->
<script src="{{ asset('/public/admin/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js') }}"></script>
<script src="{{ asset('/public/admin/js/html5shiv.js') }}"></script>
<script src="{{ asset('/public/admin/js/respond.min.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/slimScroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/jquery-cookie/jquery.cookie.js') }}"></script>
<script src="{{ asset('/public/admin/js/jquery.menu.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/jquery-pace/pace.min.js') }}"></script>

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

<script src="{{ asset('/public/admin/vendors/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('/public/admin/js/ui-tabs-accordions-navs.js') }}"></script>

<!--CORE JAVASCRIPT-->
<script src="{{ asset('/public/admin/js/main.js') }}"></script>
<script src="{{ asset('/public/admin/js/holder.js') }}"></script>

<script>
$(function () {
    $('select[name="select_per_page"]').change(function () {
<?php if ($_SERVER['QUERY_STRING']) { ?>
            window.location = '<?= url("web88cms/checkInOut"); ?>/' + $(this).val() + "?<?= $_SERVER['QUERY_STRING']; ?>";
<?php } else { ?>
            window.location = '<?= url("web88cms/checkInOut"); ?>/' + $(this).val();
<?php } ?>
    });
})
</script>
@endsection


