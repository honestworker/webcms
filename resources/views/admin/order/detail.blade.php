@extends('adminLayout')
@section('content')

<?php
$ordersModel = new App\Http\Models\Admin\Orders();
$orderTax = $ordersModel->getOrderTax($order->id);
//dd($order, $orderTax);
?>
<div id="page-wrapper">

    <div class="page-header-breadcrumb">
        <div class="page-heading hidden-xs">
            <h1 class="page-title">Orders</h1>
        </div>

        <ol class="breadcrumb page-breadcrumb">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('web88cms/dashboard') }}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
            <li>Orders &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li><a href="{{ url('web88cms/orders') }}">Orders Listing</a> &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li class="active">View Order - Details</li>
        </ol>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <h2>View Order <i class="fa fa-angle-right"></i> Details</h2>
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


                <h4 class="block-heading pull-right"><B style"color:#2EFE2E;"><font color="green">Booking ID:</font></B> <span class="text-red">{{$bookid}}</span></h4>


                <div class="pull-left"> Last updated: <span class="text-blue">{{ date('d M, Y @ h:iA', strtotime($order->modifydate)) }}</span> </div>
                <div class="clearfix"></div>
                <p></p>

                <h3 class="block-heading pull-left">Order ID: #{{ $order->order_id}}</h3>
                <h5 class="block-heading pull-right">Total: <span class="text-red">RM {{ number_format($order->totalPrice,2) }}</span></h5>
                <div class="clearfix"></div>
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#overview" data-toggle="tab">Overview</a></li>
                    <li><a href="#item-details" data-toggle="tab">Item Details</a></li>
                    <li><a href="#customer-info" data-toggle="tab">Customer Information</a></li>
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div id="overview" class="tab-pane fade in active">
                        <div class="portlet">
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <!-- order information start -->
                                        <h4 class="block-heading"><i class="fa fa-shopping-cart"></i> Order Information</h4>
                                        <div class="md-margin-2x"></div>
                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Order ID: </label>
                                            <div class="col-md-8"><p><strong>#{{ $order->order_id }}</strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Order Date: </label>
                                            <div class="col-md-8"><p><strong>{{ date('dS M, Y', strtotime($order->createdate)) }}</strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Delivery Date: </label>
                                            <div class="col-md-8"><p><strong>
                                                        @if($order->delivery_date == '0000-00-00')
                                                        -
                                                        @else
                                                        {{ date('dS M, Y', strtotime($order->delivery_date)) }}
                                                        @endif
                                                    </strong></p></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Customer Name:</label>
                                            <div class="col-md-8">
                                                <p><a href="{{ url('web88cms/customers/view/' . $customer->id) }}"><strong>{{ $customer->first_name . ' ' . $customer->last_name}}</strong></a>,<br/>
                                                    <a href="{{ url('web88cms/customers/view/' . $customer->id) }}"><strong>{{ $customer->email }}</strong></a></p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">IP Address: </label>
                                            <div class="col-md-8"><p><strong>{{ $order->ip_address }}</strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Total Amount: </label>
                                            <div class="col-md-8"><p class="text-red"><strong>RM {{ number_format($order->totalPrice,2) }}</strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Item Number(s): </label>
                                            <div class="col-md-8"><p><strong>{{ $totalOrderItems }}</strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="lg-margin"></div>

                                        <h4 class="block-heading"><i class="fa fa-truck"></i> Shipping Address</h4>
                                        <div class="md-margin-2x"></div>
                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Ship To: </label>
                                            <div class="col-md-8"><p><strong>{{ $order->shipping_address }}, {{ $order->shipping_post_code }} {{ $order->shipping_city }}, {{ $order->shipping_state_name }}, {{ $order->shipping_country_name }}</strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Email: </label>
                                            <div class="col-md-8"><p><strong>{{ $order->shipping_email }}</strong></p></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Telephone: </label>
                                            <div class="col-md-8"><p><strong>{{ $order->shipping_telephone }}</strong></p></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Address: </label>
                                            <div class="col-md-8"><p><strong>{{ $order->shipping_address }}, {{ $order->shipping_post_code }} {{ $order->shipping_city }}, {{ $order->shipping_state_name }}, {{ $order->shipping_country_name }}</strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-actions text-center">
                                            <a class="btn btn-success" data-target="#modal-edit-shipping" data-toggle="modal">Edit &nbsp;<i class="fa fa-pencil"></i></a>&nbsp;
                                        </div>
                                        <!--Modal Edit shipping address start-->
                                        <div id="modal-edit-shipping" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                            <div class="modal-dialog modal-wide-width">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                        <h4 id="modal-login-label2" class="modal-title">Edit Shipping Address</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form">
                                                            <form class="form-horizontal" id="edit-shipping-address">
                                                                <div class="form-group">
                                                                    <label for="inputFirstName" class="col-md-4 control-label">Ship To First Name </label>
                                                                    <div class="col-md-6">
                                                                        <input type="text" class="form-control" name="shipping_first_name" value="{{ $order->shipping_first_name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>

                                                                <div class="form-group">
                                                                    <label for="inputFirstName" class="col-md-4 control-label">Ship To Last Name </label>
                                                                    <div class="col-md-6">
                                                                        <input type="text" class="form-control" name="shipping_last_name" value="{{ $order->shipping_last_name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>

                                                                <div class="form-group">
                                                                    <label for="inputFirstName" class="col-md-4 control-label">Email </label>
                                                                    <div class="col-md-6">
                                                                        <input type="text" class="form-control" name="shipping_email" value="{{ $order->shipping_email }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputFirstName" class="col-md-4 control-label">Telephone </label>
                                                                    <div class="col-md-6">
                                                                        <input type="text" class="form-control" name="shipping_telephone" value="{{ $order->shipping_telephone }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputFirstName" class="col-md-4 control-label">Address </label>
                                                                    <div class="col-md-6">
                                                                        <textarea name="shipping_address" class="form-control">{{ $order->shipping_address }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-actions">
                                                                    <div class="col-md-offset-5 col-md-8">
                                                                        <a href="javascript:void(0)" id="save-shipping-address" class="btn btn-red">
                                                                            Save &nbsp;<i class="fa fa-floppy-o"></i>
                                                                        </a>&nbsp;
                                                                        <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">
                                                                            Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lg-margin"></div>

                                        <!-- billing address start -->
                                        <h4 class="block-heading"><i class="fa fa-tag"></i> Billing Address</h4>
                                        <div class="md-margin-2x"></div>
                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Bill To: </label>
                                            <div class="col-md-8"><p><strong>{{ $order->billing_first_name . ' ' . $order->billing_last_name }}</strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Email: </label>
                                            <div class="col-md-8"><p><strong>{{ $order->billing_email }}</strong></p></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Telephone: </label>
                                            <div class="col-md-8"><p><strong>{{ $order->billing_telephone }}</strong></p></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Address: </label>
                                            <div class="col-md-8"><p><strong>{{ $order->billing_address }}, {{ $order->billing_post_code }} {{ $order->billing_city }}, {{ $order->billing_state_name }}, {{ $order->billing_country_name }}</strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-actions text-center">
                                            <a class="btn btn-success" data-target="#modal-edit-billing" data-toggle="modal">Edit &nbsp;<i class="fa fa-pencil"></i></a>&nbsp;
                                        </div>
                                        <!--Modal Edit billing address start-->
                                        <div id="modal-edit-billing" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                            <div class="modal-dialog modal-wide-width">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                        <h4 id="modal-login-label2" class="modal-title">Edit Billing Address</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form">
                                                            <form class="form-horizontal" id="edit-billing-address">
                                                                <div class="form-group">
                                                                    <label for="inputFirstName" class="col-md-4 control-label">Bill To First Name </label>
                                                                    <div class="col-md-6">
                                                                        <input type="text" class="form-control" name="billing_first_name" value="{{ $order->billing_first_name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>

                                                                <div class="form-group">
                                                                    <label for="inputFirstName" class="col-md-4 control-label">Bill To Last Name </label>
                                                                    <div class="col-md-6">
                                                                        <input type="text" class="form-control" name="billing_last_name" value="{{ $order->billing_last_name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>

                                                                <div class="form-group">
                                                                    <label for="inputFirstName" class="col-md-4 control-label">Email </label>
                                                                    <div class="col-md-6">
                                                                        <input type="text" class="form-control" name="billing_email" value="{{ $order->billing_email }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputFirstName" class="col-md-4 control-label">Telephone </label>
                                                                    <div class="col-md-6">
                                                                        <input type="text" class="form-control" name="billing_telephone" value="{{ $order->billing_telephone }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputFirstName" class="col-md-4 control-label">Address </label>
                                                                    <div class="col-md-6">
                                                                        <textarea name="billing_address" class="form-control">{{ $order->billing_address }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-actions">
                                                                    <div class="col-md-offset-5 col-md-8">
                                                                        <a href="javascript:void(0)" id="save-billing-address" class="btn btn-red">
                                                                            Save &nbsp;<i class="fa fa-floppy-o"></i>
                                                                        </a>&nbsp;
                                                                        <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">
                                                                            Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--END MODAL Edit billing address -->

                                        <!-- end billing address -->
                                        <div class="lg-margin"></div>

                                        <!-- notes start -->
                                        <h4 class="block-heading"><i class="fa fa-pencil"></i> Notes</h4>
                                        <div class="md-margin-2x"></div>
                                        <form id="frm-notes">
                                            <div class="form-group">
                                                <label for="inputFirstName" class="col-md-4 control-label">Customer Notes </label>
                                                <div class="col-md-8"> <textarea name="customer_notes" rows="3" class="form-control" id="customer_notes">{{ $order->customer_notes}}</textarea></div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="xs-margin"></div>
                                            <div class="form-group">
                                                <label for="inputFirstName" class="col-md-4 control-label">Staff Notes </label>
                                                <div class="col-md-8"> <textarea name="staff_notes" rows="3" class="form-control" id="staff_notes">{{ $order->staff_notes}}</textarea></div>
                                            </div>
                                        </form>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">Order Status</div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label for="inputFirstName" class="col-md-4 control-label"><strong>Status:</strong> </label>
                                                    <div class="col-md-8">
                                                        <?php
                                                        $class = "";
                                                        $text = "";
                                                        ?>
                                                        <div class="btn-group">
                                                            @if($order->status == 'Processing')
                                                            <?php
                                                            $class = "btn-info";
                                                            $text = "Processing";
                                                            ?>
                                                            @elseif($order->status == 'New Order')
                                                            <?php
                                                            $class = "btn-warning";
                                                            $text = "New Order";
                                                            ?>
                                                            @elseif($order->status == 'Ready To Ship')
                                                            <?php
                                                            $class = "btn-info";
                                                            $text = "Ready To Ship";
                                                            ?>
                                                            @elseif($order->status == 'Shipped')
                                                            <?php
                                                            $class = "btn-blue";
                                                            $text = "Shipped";
                                                            ?>
                                                            @elseif($order->status == 'Completed')
                                                            <?php
                                                            $class = "btn-success";
                                                            $text = "Completed";
                                                            ?>
                                                            @elseif($order->status == 'Declined')
                                                            <?php
                                                            $class = "btn-red";
                                                            $text = "Declined";
                                                            ?>
                                                            @elseif($order->status == 'Cancelled')
                                                            <?php
                                                            $class = "btn-primary";
                                                            $text = "Cancelled";
                                                            ?>
                                                            @endif

                                                            <button id="order-status" type="button" class="btn {{ $class }}">{{ $text }}</button>
                                                            <button type="button" data-toggle="dropdown" class="btn {{ $class }} dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                                                            <ul role="menu" class="dropdown-menu">
                                                                @foreach($orderStatus as $status)
                                                                @if($order->status != $status)
                                                                <li><a href="javascript:void(0)" data-status="{{ $status }}" class="order-status">{{ $status }}</a></li>
                                                                @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="xs-margin"></div>
                                                <div style="padding-left: 15px;">
                                                    <input name="notify_customer_order_status" type="checkbox" value="on" checked="checked"> Notify customer of the order status.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-primary">
                                            <div class="panel-heading">Payment Status</div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <h6 class="block-heading">Payment Information</h6>
                                                    <div class="form-group">
                                                        <label for="inputFirstName" class="col-md-4 control-label"><strong>Method: </strong></label>
                                                        <div class="col-md-8">{{ $order->payment_method }}</div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <hr>

                                                    <label for="inputFirstName" class="col-md-4 control-label"><strong>Status:</strong> </label>
                                                    <div class="col-md-8">
                                                        <div class="btn-group">
                                                            @if($order->payment_status == 'Processing')
                                                            <?php
                                                            $class = "btn-info";
                                                            $text = "Processing";
                                                            ?>
                                                            @elseif($order->payment_status == 'Paid')
                                                            <?php
                                                            $class = "btn-success";
                                                            $text = "Paid";
                                                            ?>
                                                            @elseif($order->payment_status == 'Payment Error')
                                                            <?php
                                                            $class = "btn-red";
                                                            $text = "Payment Error";
                                                            ?>
                                                            @elseif($order->payment_status == 'Cancelled')
                                                            <?php
                                                            $class = "btn-primary";
                                                            $text = "Cancelled";
                                                            ?>
                                                            @endif
                                                            <button type="button" id="payment-status" class="btn {{ $class }}">{{ $text }}</button>
                                                            <button type="button" data-toggle="dropdown" class="btn {{ $class }} dropdown-toggle">
                                                                <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <ul role="menu" class="dropdown-menu">
                                                                @foreach($paymentStatus as $status)
                                                                @if($order->payment_status != $status)
                                                                <li><a href="javascript:void(0)" class="payment-status" data-status="{{ $status }}">{{ $status }}</a></li>
                                                                @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="xs-margin"></div>
                                                <div style="padding-left: 15px;">
                                                    <input name="notify_customer_payment_status" type="checkbox" value="on" checked="checked">
                                                    Notify customer of the payment status.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-primary">
                                            <div class="panel-heading">Shipment</div>
                                            <div class="panel-body">

                                                <h6 class="block-heading">Shipping Information</h6>
                                                <div class="form-group">
                                                    <label for="inputFirstName" class="col-md-4 control-label"><strong>Method: </strong></label>
                                                    <div class="col-md-8">{{ $order->shipping_method }}</div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="xs-margin"></div>
                                                <?php
                                                $shipments = 0;
                                                if ($order->status == 'Ready To Ship' || $order->status == 'Shipped') {
                                                    $shipments = 1;
                                                }
                                                ?>
                                                <div style="padding-left: 15px;" class="pull-right"><a href="{{ url('web88cms/orders/shipmentDetail/' . $order->id) }}">View shipments ({{ $shipments }})</a></div>
                                                <div class="clearfix"></div>
                                                <div class="sm-margin"></div>

                                                <div class="form-actions text-center">
                                                    <a href="javascript:void(0)" data-target="#modal-add-shipment" data-toggle="modal" class="btn btn-success">Add New Shipment &nbsp;<i class="fa fa-truck"></i></a>&nbsp;
                                                </div>

                                                <div id="modal-add-shipment" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                                    <div class="modal-dialog modal-wide-width">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                                <h4 id="modal-login-label2" class="modal-title">Add New Shipment</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form">
                                                                    <form class="form-horizontal" id="new-shipment">
                                                                        <div class="form-group">
                                                                            <label for="inputFirstName" class="col-md-4 control-label">Shipping Method </label>
                                                                            <div class="col-md-6">
                                                                                <select class="form-control" name="shipping_method">
                                                                                    <option value="">- Select option -</option>
                                                                                    @foreach ($shipping_options as $ship)
                                                                                    <?php $selected = ($order->shipping_method == $ship['csv']->title) ? 'selected="selected"' : ''; ?>
                                                                                    <option value="{{$ship['csv']->id}}" {{$selected}}>{{$ship['csv']->title}}</option>
                                                                                    @endforeach
                                                                                    <option <?php $order->shipping_method == 'Self Collection' ? 'selected="selected"' : '' ?>value="0">Self Collection</option>
                                                                                </select>
                                                                                <input type="hidden" name="shipping_state" value="{{$order->shipping_state}}">
                                                                                <input type="hidden" name="total_weight" value="{{$order->total_weight}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                        <div class="form-group">
                                                                            <label for="inputFirstName" class="col-md-4 control-label">Tracking Number </label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control" name="tracking_number" value="{{ $order->tracking_number }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="inputFirstName" class="col-md-4 control-label">Comments </label>
                                                                            <div class="col-md-6">
                                                                                <textarea class="form-control" name="comments">{{ $order->comments }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="inputFirstName" class="col-md-4 control-label">Order Status </label>
                                                                            <div class="col-md-6">
                                                                                <select class="form-control" name="status">
                                                                                    <option value="">Do not change</option>
                                                                                    @foreach($orderStatus as $status)
                                                                                    <option value="{{ $status }}">{{ $status }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                <div class="help-block">Please note that the notification of changing the status will be sent depending on the settings of this status </div>
                                                                                <input type="checkbox" name="send_shipment_notification" value="on"> Send shipment notification to customer
                                                                            </div>

                                                                        </div>
                                                                        <div class="form-actions">
                                                                            <div class="col-md-offset-5 col-md-8">
                                                                                <a id="add-new-shipment" href="javascript:void(0)" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp;
                                                                                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-primary">
                                            <div class="panel-heading">Invoice</div>
                                            <div class="panel-body">
                                                <div class="form-actions text-center">
                                                    <a href="{{ url('web88cms/orders/invoice/' . $order->id) }}" class="btn btn-warning">
                                                        View Invoice &nbsp;<i class="fa fa-search"></i>
                                                    </a>&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="md-margin"></div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="form-actions text-center">
                                <a href="javascript:void(0)" id="save-note" class="btn btn-red">Save &nbsp;<i class="fa fa-search"></i></a>&nbsp;
                                <a href="javascript:void(0)" onclick="$('#frm-notes')[0].reset()" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a>
                            </div>

                        </div>
                    </div>

                    <div id="item-details" class="tab-pane fade">
                        <div class="portlet">
                            <div class="portlet-body">
                                <table class="table checkout-table table-responsive">
                                    <thead>
                                        <tr>
                                            <th class="table-title">Room Code</th>
                                            <th class="table-title">Room Type</th>
                                            <!-- <th class="table-title" style="text-align: right;">Qty</th> -->
                                            <th class="table-title" style="text-align: right;" colspan="2">Unit Price (RM)</th>
                                            <th class="table-title" style="text-align: right;">SST (RM)</th>
                                            <th class="table-title" style="text-align: right;">Total (RM)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $tax = 0; ?>
                                        @foreach($orderTax->products as $orderProduct)
                                        <?php
                                        $tax = $tax + $orderProduct->gst;

                                        $checkAvailModel = new App\Http\Models\Front\CheckAvail();
                                        $roomDates = $checkAvailModel->getPriceByDates($orderProduct->id, $booking_date->date_checkin, $booking_date->date_checkout);

                                        $priceByDates = "";
                                        foreach ($roomDates as $pd) {
                                            $priceByDates .= "<span>" . date('l', strtotime($pd->date)) . ", " . date('d/M/Y', strtotime($pd->date)) . " MYR " . number_format($pd->sale_price, 2) . " </span><br/>";
                                        }
                                        ?>
                                        <tr>
                                            <td class="item-code">{{ $orderProduct->room_code }}</td>
                                            <td class="item-name-col">
                                                <figure><a href="{{ url('web88cms/products/editProduct/' . $orderProduct->product_id) }}">
                                                        <img src="{{ asset('/public/admin/products/medium/' . $orderProduct->thumbnail_image_1) }}" alt="{{ $orderProduct->type }}" class="img-responsive">
                                                    </a></figure>
                                                <header class="item-name">
                                                    <a href="{{ url('web88cms/products/editProduct/' . $orderProduct->product_id) }}">{{ $orderProduct->type }}</a>
                                                    @if (!is_null($orderProduct->pwp_price))
                                                    <span class="pwp-item">PWP ITEM</span>
                                                    @endif
                                                </header>
                                                <ul>
                                                    @if($orderProduct->color_name)
                                                    <li>Color: {{ $orderProduct->color_name }}</li>
                                                    @endif

                                                    @if($orderProduct->event_type)
                                                    <li><i class="fa fa-gift text-red"></i> <span class="text-red"><b>For: {{ $orderProduct->event_type }}</b></span></li>
                                                    @endif
                                                </ul>
                                            </td>
                                            <td colspan="2">
                                                {!! $priceByDates !!}
                                                <div>
                                                    @if( ! empty($orderTax->check_date))
                                                    <div >
                                                        Check-in: <span class="text-black"><b>{{ date('dS M, Y', strtotime($orderTax->check_date->date_checkin)) }}</b></span>
                                                    </div>
                                                    @endif
                                                    @if( ! empty($orderTax->check_date))
                                                    <div >
                                                        Check-out: <span class="text-black"><b>{{ date('dS M, Y', strtotime($orderTax->check_date->date_checkout)) }}</b></span>
                                                    </div>
                                                    @endif
                                                    <div >
                                                        Rooms: <span class="text-black"><b>{{ $orderTax->rooms }}</b></span>
                                                    </div>
                                                    <div >
                                                        Adults: <span class="text-black"><b>{{ $orderTax->adults }}</b></span>
                                                    </div>
                                                    <div >
                                                        Children: <span class="text-black"><b>{{ $orderTax->children }}</b></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- <td align="right">{{ $orderProduct->quantity }}</td>
                                            <td class="item-price-col" align="right"><span class="item-price-special">
                                            @if (is_null($orderProduct->pwp_price))
                                            {{ number_format($orderProduct->amount, 2) }}
                                            @else
                                            {{ number_format($orderProduct->pwp_price, 2) }}
                                            @endif
                                            </span></td> -->
                                            <td class="item-total-col" align="right"><span class="item-price-special">{{ number_format($orderProduct->gst, 2) }}</span></td>
                                            <td class="item-total-col" align="right"><span class="item-price-special">{{ number_format($orderProduct->subtotal*$orderTax->rooms + $tax, 2) }}</span></td>
                                        </tr>
                                        @endforeach

                                        <tr>
                                            <td style="border: none; text-align: right;" colspan="3">Total:</td>
                                            <td></td>
                                            <td align="right">{{ number_format($tax, 2) }}</td>
                                            <td align="right">{{ number_format($orderTax->subtotal*$orderTax->rooms + $tax, 2) }}</td>
                                            <!-- <td align="right">{{ number_format($orderTax->tax, 2) }}</td> -->
                                            <!-- <td align="right">{{ number_format($orderTax->subtotal + $orderTax->tax, 2) }}</td> -->
                                        </tr>
                                        <!--
                                                                                <tr>
                                                                                    <td class="checkout-table-title" colspan="5">GST:</td>
                                                                                    <td class="checkout-table-price" align="center">RM {{ number_format($orderTax->tax, 2) }}</td>
                                                                                </tr>
                                        -->
                                                                                <!-- <tr>
                                                                                    <td style="border: none; text-align: right;" colspan="3">Shipping:</td>
                                                                                    <td style="border: none;" align="right">{{ number_format($order->shipping_charge, 2) }}</td>
                                                                                    <td style="border: none;" align="right">{{ number_format($order->shipping_charge * 0.06, 2) }}</td>
                                                                                    <td style="border: none;" align="right">{{ number_format($order->shipping_charge * 1.06, 2) }}</td>
                                                                                </tr> -->
                                        <tr>
                                            <td style="border: none; text-align: right;" class="text-red" colspan="3">Discount:</td>
                                            <td style="border: none;"></td>
                                            <td style="border: none;"></td>
                                            <td style="border: none;" class="text-red" align="right">-{{ number_format($orderTax->discount, 2) }}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td style="border: none; text-transform: none; text-align: right;" colspan="3"><b>Net Total:</b></td>
                                            <td></td>
                                            <td align="right"><b>{{ number_format($tax + $order->shipping_charge * 0.06, 2) }}</b></td>
                                            <td align="right"><b>{{ number_format(($orderTax->subtotal*$orderTax->rooms + $tax + $order->shipping_charge * 1.06) - $orderTax->discount, 2) }}</b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div id="customer-info" class="tab-pane fade">
                        <div class="portlet">
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- customer information start -->
                                        <h4 class="block-heading"><i class="fa fa-user"></i> Customer Information</h4>
                                        <div class="md-margin-2x"></div>
                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Customer Name:</label>
                                            <div class="col-md-8">
                                                <p><a href="{{ url('web88cms/customers/view/' . $customer->id)}}"><strong>{{ $customer->first_name . ' ' . $customer->last_name}}</strong></a></p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Email: </label>
                                            <div class="col-md-8"><p><strong>{{ $customer->email }}</strong></p></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Telephone: </label>
                                            <div class="col-md-8"><p><strong>{{ $customer->telephone }}</strong></p></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Birth Date: </label>
                                            <div class="col-md-8"><p><strong>{{ date('dS F, Y', strtotime($customer->birth_date)) }}</strong></p></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Address: </label>
                                            <div class="col-md-8"><p><strong>{{ $customer->billing_address }}, {{ $customer->billing_post_code }} {{ $customer->billing_city }}, {{ $customer->billing_state_name }}, {{ $customer->billing_country_name }}</strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Past Orders: </label>
                                            <div class="col-md-8"><p><strong><span class="badge badge-red">{{ ($customerTotalOrders - 1) }}</span></strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-actions text-center">
                                            <a href="{{ url('web88cms/customers/view/' . $customer->id)}}" class="btn btn-success">View / Edit &nbsp;<i class="fa fa-pencil"></i></a>&nbsp;
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="lg-margin"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="block-heading"><i class="fa fa-truck"></i> Shipping Information (Default)</h4>
                                        <div class="md-margin-2x"></div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Delivery Address Name:</label>
                                            <div class="col-md-8">
                                                <p><a href="{{ url('web88cms/customers/view/' . $customer->id)}}"><strong>{{ $customer->shipping_first_name . ' ' . $customer->shipping_last_name}}</strong></a></p>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Email: </label>
                                            <div class="col-md-8"><p><strong>{{ $customer->shipping_email }}</strong></p></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Telephone: </label>
                                            <div class="col-md-8"><p><strong>{{ $customer->shipping_telephone }}</strong></p></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Address: </label>
                                            <div class="col-md-8"><p><strong>{{ $customer->shipping_address }}, {{ $customer->shipping_post_code }} {{ $customer->shipping_city }}, {{ $customer->shipping_state_name }}, {{ $customer->shipping_country_name }}</strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-actions text-center">
                                            <a href="{{ url('web88cms/customers/view/' . $customer->id)}}" class="btn btn-success">View / Edit &nbsp;<i class="fa fa-pencil"></i></a>&nbsp;
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="col-md-6">
                                        <h4 class="block-heading"><i class="fa fa-tag"></i> Billing Information (Default)</h4>
                                        <div class="md-margin-2x"></div>
                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Billing Name:</label>
                                            <div class="col-md-8">
                                                <p><a href="{{ url('web88cms/customers/view/' . $customer->id)}}"><strong>{{ $customer->billing_first_name . ' ' . $customer->billing_last_name}}</strong></a></p>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Email: </label>
                                            <div class="col-md-8"><p><strong>{{ $customer->billing_email }}</strong></p></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Telephone: </label>
                                            <div class="col-md-8"><p><strong>{{ $customer->billing_telephone }}</strong></p></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputFirstName" class="col-md-4 control-label">Address: </label>
                                            <div class="col-md-8"><p><strong>
                                                        {{ $customer->billing_address }}, {{ $customer->billing_post_code }} {{ $customer->billing_city }}, {{ $customer->billing_state_name }}, {{ $customer->billing_country_name }}
                                                    </strong></p></div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-actions text-center">
                                            <a href="{{ url('web88cms/customers/view/' . $customer->id)}}" class="btn btn-success">View / Edit &nbsp;<i class="fa fa-pencil"></i></a>&nbsp;
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-footer">
        <div class="copyright">
            <span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
            <div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png') }}" alt="Webqom Technologies Sdn Bhd"></div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#save-shipping-address').click(function () {
            var obj = $(this);
            $.ajax({
                url: "{{ url('web88cms/orders/saveShippingAddress/' . $order->id) }}",
                type: 'POST',
                dataType: 'json',
                data: $('#edit-shipping-address').serialize(),
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
                        $('#edit-shipping-address').before(html);
                    }

                    if (response['success'])
                    {
                        window.location.reload();
                    }
                }
            });
        });
    });

    $(function () {
        $('#save-billing-address').click(function () {
            var obj = $(this);
            $.ajax({
                url: "{{ url('web88cms/orders/saveBillingAddress/' . $order->id) }}",
                type: 'POST',
                dataType: 'json',
                data: $('#edit-billing-address').serialize(),
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
                        $('#edit-billing-address').before(html);
                    }

                    if (response['success'])
                    {
                        window.location.reload();
                    }
                }
            });
        });
    });

    $(function () {
        $('.order-status').click(function () {
            var obj = $(this);
            var status = obj.attr('data-status');
            var notify = $('input[name=notify_customer_order_status]:checked').val();

            $.ajax({
                url: "{{ url('web88cms/orders/updateOrderStatus/' . $order->id) }}",
                type: 'POST',
                dataType: 'json',
                data: {status: status, notify: notify, _token: '{{ csrf_token() }}'},
                beforeSend: function () {
                    $('#order-status').html('Saving... ');
                },
                complete: function () {
                    $('#order-status').html('{{ $order->status }}');
                },
                success: function (response) {
                    if (response['success'])
                    {
                        window.location.reload();
                    }
                }
            });
        });
    });

    $(function () {
        $('.payment-status').click(function () {
            var obj = $(this);
            var status = obj.attr('data-status');
            var notify = $('input[name=notify_customer_payment_status]:checked').val();

            $.ajax({
                url: "{{ url('web88cms/orders/updatePaymentStatus/' . $order->id) }}",
                type: 'POST',
                dataType: 'json',
                data: {status: status, notify: notify, _token: '{{ csrf_token() }}'},
                beforeSend: function () {
                    $('#payment-status').html('Saving... ');
                },
                complete: function () {
                    $('#payment-status').html('{{ $order->payment_status }}');
                },
                success: function (response) {
                    if (response['success'])
                    {
                        window.location.reload();
                    }
                }
            });
        });
    });

    $(function () {
        $('#add-new-shipment').click(function () {
            var obj = $(this);
            $('#warning-box').remove();

            $.ajax({
                url: "{{ url('web88cms/orders/addNewShipment/' . $order->id) }}",
                type: 'POST',
                dataType: 'json',
                data: $('#new-shipment').serialize(),
                beforeSend: function () {
                    $('#add-new-shipment').html('Saving... ');
                },
                complete: function () {
                    $('#add-new-shipment').html('Save &nbsp;<i class="fa fa-floppy-o"></i>');
                },
                success: function (response) {
                    if (response['error'])
                    {
                        var html = '';
                        html += '<div id="warning-box" class="alert alert-danger alert-dismissable">';
                        html += '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>';
                        html += '<i class="fa fa-times-circle"></i> <strong>Error!</strong>';

                        for (var i = 0; i < response['error'].length; i++)
                        {
                            html += '<p>' + response['error'][i] + '</p>';
                        }

                        html += '</div>';
                        $('#new-shipment').before(html);
                    }

                    if (response['success'])
                    {
                        window.location.reload();
                    }
                }
            });
        });
    });

    $(function () {
        $('#save-note').click(function () {
            $('#success-box').remove();

            $.ajax({
                url: "{{ url('web88cms/orders/editNote/' . $order->id) }}",
                type: 'POST',
                dataType: 'json',
                data: {customer_notes: $('#customer_notes').val(), staff_notes: $('#staff_notes').val(), _token: '{{ csrf_token() }}'},
                beforeSend: function () {
                    $('#save-note').html('Saving... ');
                },
                complete: function () {
                    $('#save-note').html('Save &nbsp;<i class="fa fa-search"></i>');
                },
                success: function (response) {
                    if (response['success'])
                    {
                        var html = '';
                        html += '<div class="alert alert-success alert-dismissable">';
                        html += '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>';
                        html += '<i class="fa fa-check-circle"></i> <strong>Success!</strong>';
                        html += '<p>' + response['success'] + '</p>';
                        html += '</div> ';

                        $('#myTab').before(html);
                        $('html, body').animate({scrollTop: 0}, 'fast');
                    }
                }
            });
        });
    });
</script>
@endsection
