@extends('adminLayout')
@section('title', 'Dashboard')
@section('content')
<div id="page-wrapper"><!--BEGIN PAGE HEADER & BREADCRUMB-->

    <div class="page-header-breadcrumb">
        <div class="page-heading hidden-xs">
            <h1 class="page-title">Dashboard</h1>
        </div>
        <ol class="breadcrumb page-breadcrumb">
            <li><i class="fa fa-home"></i>&nbsp;<a href="dashboard.html">Dashboard</a>&nbsp;</li>

        </ol>
    </div>
    <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->

    <div class="page-content">
        <div id="tab-shopping">
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Bookings</div>
                        <div class="panel-body">
                            <div class="checkin-out-summary">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ route('checkInOut') }}">
                                            <div class="revenue-total"><span >{{ $data['checkins_count'] }}</span></div>
                                            <div class="revenue-title">CHECKING IN TODAY</div>
                                            <div class="">({{ $data['today_date'] }})</div>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('checkInOut') }}">
                                            <div class="tax-total"><span>{{ $data['checkouts_count'] }}</span></div>
                                            <div class="tax-title">CHECKING OUT TODAY</div>
                                            <div class="">({{ $data['today_date'] }})</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div id="sp-chart-orders" style="width: 100%; height:300px"></div>
                            <div class="order-detail">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="revenue-total">RM<span id='revenue-number'>0</span></div>
                                        <div class="revenue-title">Sales Total, Today</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="tax-total">RM<span id='tax-number'>0</span></div>
                                        <div class="tax-title">Tax</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="shipping-total">RM<span id='shipping-number'>0</span></div>
                                        <div class="shipping-title">Shipping</div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="panel panel-primary">
                        <div class="panel-heading">New Customers / Returning Customers</div>
                        <div class="panel-body">
                            <div id="area-chart-spline" style="width: 100%; height:300px"></div>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab-bestsellers" data-toggle="tab">Bestsellers</a></li>
                                <li><a href="#tab-most-viewed-products" data-toggle="tab">Most Viewed Services</a></li>
                                <li><a href="#tab-new-customers" data-toggle="tab">New Customers</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-bestsellers" class="tab-pane fade in active">
                                    <table class="table table-hover table-striped mbn">
                                        <thead>
                                            <tr>
                                                <th>Services Name</th>
                                                <th class="text-right">Price</th>
                                                <th class="text-right">Quantity Ordered</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($data['bestsellers'] as $bestsellerdatas) {
                                                ?>
                                                <tr>
                                                    <td><a href="products/editProduct/<?php echo $bestsellerdatas->product_id; ?>"><?php echo $bestsellerdatas->type; ?></a></td>
                                                    <td class="text-right">RM<?php echo number_format($bestsellerdatas->sale_price, 2); ?></td>
                                                    <td class="text-right"><?php echo $bestsellerdatas->quantityordered; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="tab-most-viewed-products" class="tab-pane fade">
                                    <table class="table table-hover table-striped mbn">
                                        <thead>
                                            <tr>
                                                <th>Services Name</th>
                                                <th class="text-right">Price</th>
                                                <th class="text-right">Quantity Viewed</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($data['mostViwedProducts'] as $mostViwedProduct) {
                                                ?>
                                                <tr>
                                                    <td><a href="products/editProduct/<?php echo $mostViwedProduct->product_id; ?>"><?php echo $mostViwedProduct->type; ?></a></td>
                                                    <td class="text-right">RM<?php echo number_format($mostViwedProduct->sale_price, 2); ?></td>
                                                    <td class="text-right"><?php echo $mostViwedProduct->views_count; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </div>
                                <!-- end tab most viewed products -->

                                <div id="tab-new-customers" class="tab-pane fade">
                                    <table id="example1" class="table table-hover table-striped">
                                        <thead>


                                            <tr>
                                                <th><a href="#sort by customer name">Customer Name</a></th>
                                                <th><a href="#sort by email">Email</a></th>
                                                <th><a href="#sort by registered date">Registered</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($data['newcustomers'] as $bestsellerdatas) {
                                                ?>
                                                <tr>
                                                    <td><a href="customers/view/<?php echo $bestsellerdatas->id ?>"><?php echo $bestsellerdatas->first_name ?></a></td>
                                                    <td><?php echo $bestsellerdatas->email ?></td>
                                                    <td><?php echo date("d M, Y \n H.i A", strtotime($bestsellerdatas->createdate)); ?></td>
                                                </tr>
                                            <?php }
                                            ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3"></td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                                <!-- end tab new customers -->

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="lifetime-sales">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <div class="ls-chart"><input type="text" rel="75" value="0" data-width="75" data-height="75" data-readOnly="true" data-min="0" data-max="100" class="dial"/></div>
                                    </div>
                                    <div class="col-md-8 mts">
                                        <div class="ls-total">RM<span id='ls-number'>0</span></div>
                                        <div class="ls-title">Lifetime Sales</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-body">
                            <div class="average-orders">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <div class="ao-chart"><input type="text" rel="35" value="0" data-width="75" data-height="75" data-readOnly="true" data-min="0" data-max="100" class="dial"/></div>
                                    </div>
                                    <div class="col-md-8 mts">
                                        <div class="ao-total">RM<span id='ao-number'>0</span></div>
                                        <div class="ao-title">Average Bookings</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">Last 5 Bookings</div>
                        <div class="panel-body">
                            <table class="table table-border-dashed table-hover mbn">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th class="text-right">Items</th>
                                        <th class="text-right">Total (RM)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['last5Orders'] as $last5Order)
                                 <!-- {{ print_r($last5Order) }} -->
                                    <tr>
                                        <td><a href="{{ url('web88cms/orders/detail/'.$last5Order->id) }}">{{ $last5Order->billing_first_name }} {{ $last5Order->billing_last_name }}</a></td>
                                        <td class="text-right">{{ $last5Order->items }}</td>
                                        <td class="text-right"> {{ number_format($last5Order->totalPrice, 2) }}
                                        <!-- {{ number_format($last5Order->total + $last5Order->shipping_charge*1.06, 2) }} --></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php
                    if (count($data['search_terms']) > 0) {
                        ?>
                        <div class="panel panel-primary">
                            <div class="panel-heading">Last 5 Search Terms</div>
                            <div class="panel-body">
                                <table class="table table-border-dashed table-hover mbn">
                                    <thead>
                                        <tr>
                                            <th>Search Term</th>
                                            <th class="text-right">Results</th>
                                           <!--  <th class="text-right">Number Uses</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach ($data['search_terms'] as $searchTerm) {
                                            //dd($data['search_terms']);
                                            echo '<tr>
													<td><a href="#">' . $searchTerm->keyword . '</a></td>
													<td class="text-right">' . $searchTerm->results . '</td>													
												</tr>';
                                        }
                                        /* <td class="text-right">'.$searchTerm->number_uses.'</td> */
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!--END CONTENT-->

    <!--BEGIN FOOTER-->
    <div class="page-footer">
        <div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
            <div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png') }}" alt="Webqom Technologies"></div>
        </div>
    </div>
    <!--END FOOTER--></div>
<!--LOADING SCRIPTS FOR PAGE-->
<script src="{{ asset('/public/admin/vendors/jquery-knob/jquery.knob.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/jquery-animateNumber/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/flot-chart/jquery.flot.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/flot-chart/jquery.flot.categories.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/flot-chart/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/flot-chart/jquery.flot.tooltip.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/flot-chart/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/flot-chart/jquery.flot.fillbetween.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/flot-chart/jquery.flot.stack.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/flot-chart/jquery.flot.spline.js') }}"></script>
<script>
$(function () {



var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')



        /***********************************/

        /********* TAB SHOPPING ************/



        //BEGIN JQUERY FLOT CHART
<?php
$totalSale = '';
foreach ($data['graphOrders'] as $graphOrder) {
    switch ($graphOrder->month) {
        case "1":
            $jan = ($graphOrder->totalPrice != '') ? $graphOrder->totalPrice : 0;
            $totalSale = $totalSale + $jan;
            break;
        case "2":
            $feb = ($graphOrder->totalPrice != '') ? $graphOrder->totalPrice : 0;
            $totalSale = $totalSale + $feb;
            break;
        case "3":
            $mar = ($graphOrder->totalPrice != '') ? $graphOrder->totalPrice : 0;
            $totalSale = $totalSale + $mar;
            break;
        case "4":
            $apr = ($graphOrder->totalPrice != '') ? $graphOrder->totalPrice : 0;
            $totalSale = $totalSale + $apr;
            break;
        case "5":
            $may = ($graphOrder->totalPrice != '') ? $graphOrder->totalPrice : 0;
            $totalSale = $totalSale + $may;
            break;
        case "6":
            $jun = ($graphOrder->totalPrice != '') ? $graphOrder->totalPrice : 0;
            $totalSale = $totalSale + $jun;
            break;
        case "7":
            $jul = ($graphOrder->totalPrice != '') ? $graphOrder->totalPrice : 0;
            $totalSale = $totalSale + $jul;
            break;
        case "8":
            $aug = ($graphOrder->totalPrice != '') ? $graphOrder->totalPrice : 0;
            $totalSale = $totalSale + $aug;
            break;
        case "9":
            $sep = ($graphOrder->totalPrice != '') ? $graphOrder->totalPrice : 0;
            $totalSale = $totalSale + $sep;
            break;
        case "10":
            $oct = ($graphOrder->totalPrice != '') ? $graphOrder->totalPrice : 0;
            $totalSale = $totalSale + $oct;
            break;
        case "11":
            $nov = ($graphOrder->totalPrice != '') ? $graphOrder->totalPrice : 0;
            $totalSale = $totalSale + $nov;
            break;
        case "12":
            $dec = ($graphOrder->totalPrice != '') ? $graphOrder->totalPrice : 0;
            $totalSale = $totalSale + $dec;
            break;
    }
}
?>
var d1 = [
        ["Jan", <?php if (isset($jan))
    echo $jan;
else
    echo 0;
?>],
        ["Feb", <?php if (isset($feb))
    echo $feb;
else
    echo 0;
?>],
        ["Mar", <?php if (isset($mar))
    echo $mar;
else
    echo 0;
?>],
        ["Apr", <?php if (isset($apr))
    echo $apr;
else
    echo 0;
?>],
        ["May", <?php if (isset($may))
    echo $may;
else
    echo 0;
?>],
        ["Jun", <?php if (isset($jun))
    echo $jun;
else
    echo 0;
?>],
        ["Jul", <?php if (isset($jul))
    echo $jul;
else
    echo 0;
?>],
        ["Aug", <?php if (isset($aug))
    echo $aug;
else
    echo 0;
?>],
        ["Sep", <?php if (isset($sep))
    echo $sep;
else
    echo 0;
?>],
        ["Oct", <?php if (isset($oct))
    echo $oct;
else
    echo 0;
?>],
        ["Nov", <?php if (isset($nov))
    echo $nov;
else
    echo 0;
?>],
        ["Dec", <?php if (isset($dec))
    echo $dec;
else
    echo 0;
?>]
        ];
$.plot("#sp-chart-orders", [

        {

        data: d1,
                color: "#5cb85c"

                }

], {

series: {

lines: {

show: !0,
        fill: true,
        fillColor: {

        colors: [

        {

        opacity: 0.0

        },
        {

        opacity: 0.6

        }

        ]

        }

},
        points: {

        show: !0,
                radius: 4

        }

},
        grid: {

        borderColor: "#fafafa",
                borderWidth: 1,
                hoverable: !0

        },
        tooltip: !0,
        tooltipOpts: {

        content: "%x : %y",
                defaultTheme: false

        },
        xaxis: {

        tickColor: "#fafafa",
                mode: "categories"

        },
        yaxis: {

        tickColor: "#fafafa"

        },
        shadowSize: 0

        });
//END JQUERY FLOT CHART



//BEGIN JQUERY KNOB

$(".dial").knob({

'draw': function () {

$(this.i).val(this.cv + '%')

        },
        'fgColor': '#B8BEC8'

        });
$({value: 0}).animate({value: $('.ls-chart input').attr("rel")}, {

duration: 5000,
        easing: 'swing',
        step: function () {

        $('.ls-chart input').val(Math.ceil(this.value)).trigger('change');
        }

})

        $({value: 0}).animate({value: $('.ao-chart input').attr("rel")}, {

duration: 5000,
        easing: 'swing',
        step: function () {

        $('.ao-chart input').val(Math.ceil(this.value)).trigger('change');
        }

})

        //END JQUERY KNOB



        //BEGIN JQUERY ANIMATE NUMBER

        $('#revenue-number').animateNumber({

number: <?php if (isset($data['todaySale'][0]->totalPrice))
    echo $data['todaySale'][0]->totalPrice;
else
    echo 0;
?>,
        numberStep: comma_separator_number_step

        }, 5000);
$('#tax-number').animateNumber({

number: <?php if (isset($data['todaySale'][0]->totalPrice))
    echo $data['todaySale'][0]->totalPrice * 0.06 + $data['todaySale'][0]->shipping_charge * 0.06;
else
    echo 0;
?>,
        numberStep: comma_separator_number_step

        }, 5000);
$('#shipping-number').animateNumber({

number: <?php if (isset($data['todaySale'][0]->shipping_charge))
    echo $data['todaySale'][0]->shipping_charge;
else
    echo 0;
?>,
        numberStep: comma_separator_number_step

        }, 5000);
$('#quantity-number').animateNumber({

number: 14,
        numberStep: comma_separator_number_step

        }, 5000);
$('#ls-number').animateNumber({

<?php
foreach ($data['lifetimesales'] as $lifetimesales) {
    $listdata = $lifetimesales->totalsale * 1.06 + $lifetimesales->shipping_charge * 1.06;
}
?>

number: <?php echo $listdata; ?>,
        numberStep: comma_separator_number_step

        }, 5000);
$('#ao-number').animateNumber({
<?php
foreach ($data['totalorder'] as $totalorder) {
    $avg = $totalorder->average;
}
?>
number: <?php echo $avg; ?>,
        numberStep: comma_separator_number_step

        }, 5000);
//END JQUERY ANIMATE NUMBER



/********* TAB SHOPPING ***********/

/*********************************/









//BEGIN AREA CHART SPLINE
<?php
foreach ($data['newCustomers'] as $newCustomer) {
    switch ($newCustomer->month) {
        case "1":
            $newjan = ($newCustomer->countCustomers != '') ? $newCustomer->countCustomers : 0;
            break;
        case "2":
            $newfeb = ($newCustomer->countCustomers != '') ? $newCustomer->countCustomers : 0;
            break;
        case "3":
            $newmar = ($newCustomer->countCustomers != '') ? $newCustomer->countCustomers : 0;
            break;
        case "4":
            $newapr = ($newCustomer->countCustomers != '') ? $newCustomer->countCustomers : 0;
            break;
        case "5":
            $newmay = ($newCustomer->countCustomers != '') ? $newCustomer->countCustomers : 0;
            break;
        case "6":
            $newjun = ($newCustomer->countCustomers != '') ? $newCustomer->countCustomers : 0;
            break;
        case "7":
            $newjul = ($newCustomer->countCustomers != '') ? $newCustomer->countCustomers : 0;
            break;
        case "8":
            $newaug = ($newCustomer->countCustomers != '') ? $newCustomer->countCustomers : 0;
            break;
        case "9":
            $newsep = ($newCustomer->countCustomers != '') ? $newCustomer->countCustomers : 0;
            break;
        case "10":
            $newoct = ($newCustomer->countCustomers != '') ? $newCustomer->countCustomers : 0;
            break;
        case "11":
            $newnov = ($newCustomer->countCustomers != '') ? $newCustomer->countCustomers : 0;
            break;
        case "12":
            $newdec = ($newCustomer->countCustomers != '') ? $newCustomer->countCustomers : 0;
            break;
    }
}
?>
var d6_1 = [

        ["Jan", <?php if (isset($jan))
    echo $jan;
else
    echo 0;
?>],
        ["Feb", <?php if (isset($newfeb))
    echo $newfeb;
else
    echo 0;
?>],
        ["Mar", <?php if (isset($newmar))
    echo $newmar;
else
    echo 0;
?>],
        ["Apr", <?php if (isset($newapr))
    echo $newapr;
else
    echo 0;
?>],
        ["May", <?php if (isset($newmay))
    echo $newmay;
else
    echo 0;
?>],
        ["Jun", <?php if (isset($newjun))
    echo $newjun;
else
    echo 0;
?>],
        ["Jul", <?php if (isset($newjul))
    echo $newjul;
else
    echo 0;
?>],
        ["Aug", <?php if (isset($newaug))
    echo $newaug;
else
    echo 0;
?>],
        ["Sep", <?php if (isset($newsep))
    echo $newsep;
else
    echo 0;
?>],
        ["Oct", <?php if (isset($newoct))
    echo $newoct;
else
    echo 0;
?>],
        ["Nov", <?php if (isset($newnov))
    echo $newnov;
else
    echo 0;
?>],
        ["Dec", <?php if (isset($newdec))
    echo $newdec;
else
    echo 0;
?>]
        ];
<?php
///////////// RETURN CUSTOMERS
foreach ($data['returnCustomers'] as $returnCustomer) {
    switch ($returnCustomer->month) {
        case "1":
            $returnjan = ($returnCustomer->countCustomers != '') ? $returnCustomer->countCustomers : 0;
            break;
        case "2":
            $returnfeb = ($returnCustomer->countCustomers != '') ? $returnCustomer->countCustomers : 0;
            break;
        case "3":
            $returnmar = ($returnCustomer->countCustomers != '') ? $returnCustomer->countCustomers : 0;
            break;
        case "4":
            $returnapr = ($returnCustomer->countCustomers != '') ? $returnCustomer->countCustomers : 0;
            break;
        case "5":
            $returnmay = ($returnCustomer->countCustomers != '') ? $returnCustomer->countCustomers : 0;
            break;
        case "6":
            $returnjun = ($returnCustomer->countCustomers != '') ? $returnCustomer->countCustomers : 0;
            break;
        case "7":
            $returnjul = ($returnCustomer->countCustomers != '') ? $returnCustomer->countCustomers : 0;
            break;
        case "8":
            $returnaug = ($returnCustomer->countCustomers != '') ? $returnCustomer->countCustomers : 0;
            break;
        case "9":
            $returnsep = ($returnCustomer->countCustomers != '') ? $returnCustomer->countCustomers : 0;
            break;
        case "10":
            $returnoct = ($returnCustomer->countCustomers != '') ? $returnCustomer->countCustomers : 0;
            break;
        case "11":
            $nreturnnov = ($returnCustomer->countCustomers != '') ? $returnCustomer->countCustomers : 0;
            break;
        case "12":
            $returndec = ($returnCustomer->countCustomers != '') ? $returnCustomer->countCustomers : 0;
            break;
    }
}
?>
var d6_2 = [

        ["Jan", <?php if (isset($returnjan))
    echo $returnjan;
else
    echo 0;
?>],
        ["Feb", <?php if (isset($returnfeb))
    echo $returnfeb;
else
    echo 0;
?>],
        ["Mar", <?php if (isset($returnmar))
    echo $returnmar;
else
    echo 0;
?>],
        ["Apr", <?php if (isset($returnapr))
    echo $returnapr;
else
    echo 0;
?>],
        ["May", <?php if (isset($returnmay))
    echo $returnmay;
else
    echo 0;
?>],
        ["Jun", <?php if (isset($returnjun))
    echo $returnjun;
else
    echo 0;
?>],
        ["Jul", <?php if (isset($returnjul))
    echo $returnjul;
else
    echo 0;
?>],
        ["Aug", <?php if (isset($returnaug))
    echo $returnaug;
else
    echo 0;
?>],
        ["Sep", <?php if (isset($returnsep))
    echo $returnsep;
else
    echo 0;
?>],
        ["Oct", <?php if (isset($returnoct))
    echo $returnoct;
else
    echo 0;
?>],
        ["Nov", <?php if (isset($returnnov))
    echo $returnnov;
else
    echo 0;
?>],
        ["Dec", <?php if (isset($returndec))
    echo $returndec;
else
    echo 0;
?>]

        ];
$.plot("#area-chart-spline", [

        {

        data: d6_1,
                label: "New Visitor",
                color: "#a01518"

                },
        {

        data: d6_2,
                label: "Returning Visitor",
                color: "#01b6ad"

                }

], {

series: {

lines: {

show: !1

        },
        splines: {

        show: !0,
                tension: .4,
                lineWidth: 2,
                fill: .8

        },
        points: {

        show: !0,
                radius: 4

        }

},
        grid: {

        borderColor: "#fafafa",
                borderWidth: 1,
                hoverable: !0

        },
        tooltip: !0,
        tooltipOpts: {

        content: "%x : %y",
                defaultTheme: false

        },
        xaxis: {

        tickColor: "#fafafa",
                mode: "categories"

        },
        yaxis: {

        tickColor: "#fafafa"

        },
        shadowSize: 0

        });
//END AREA CHART SPLINE



});




</script>
@endsection


