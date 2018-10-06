@extends('front/templateFront')
@section('content')

    <div class="loader-cover"></div>
    <style>
        .pignose-calendar-body .pignose-calendar-wrapper .pignose-calendar {
            padding: 15px 0 0 0;
        }
        .pignose-calendar-body .pignose-calendar.pignose-calendar-light:after {
            content: "Please choose your check-in date";
            display: block;
            position: absolute;
            top: 12px;
            margin: auto;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 18px;
        }
        .pignose-calendar-body .pignose-calendar-wrapper + .pignose-calendar-wrapper .pignose-calendar.pignose-calendar-light:after {
            content: "Please choose your check-out date";
            display: block;
            position: absolute;
            top: 12px;
            margin: auto;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 18px;
        }

    </style>

    <!--================= Content Area ===================-->
    <section class="online-book-section style-two">
        <div class="bg-grey">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 pd-left clearfix">
                        <div class="section-title-area">
                            <div class="title-box tb">
                                <div class="title-box-text tb-cell">
                                    <h2 class="section-title">For rate &amp; Availability</h2>
                                </div>
                                <div class="tb-cell box-inner">
                                    <div class="title-box-inner">
                                        <h3 class="section-name">Search<span>Room</span></h3><i
                                                class="fa fa-angle-right"></i>
                                    </div>
                                </div>
                            </div><!--/.site-header-->
                        </div><!--/.section-title-area-->
                    </div><!--/.col-md-12-->
                    <div class="col-md-9 form-content">
                        <form class="online-book-form" method="post">
                            <div class="row">
                                <div class="col-md-3 col-lg-3 padding-left">
                                    <label class="text-uppercase">Check-in Date</label>
                                    <div class="input box-radius"><i class="fa fa-calendar"></i>
                                        <input type="text" id="date-arrival" placeholder="Check-in Date"
                                               class=" form-controller"
                                               value="<?php echo empty($arrival) ? '' : $arrival ?>">
                                    </div><!--/.input-->
                                </div><!--/.col-md-3-->
                                <div class="col-md-3 col-lg-3 padding-left">
                                    <label class="text-uppercase">Check-out Date</label>
                                    <div class="input box-radius"><i class="fa fa-calendar"></i>
                                        <input type="text" id="date-departure" placeholder="Check-out Date"
                                               class=" form-controller"
                                               value="<?php echo empty($departure) ? '' : $departure ?>">
                                    </div><!--/.input-->
                                </div><!--/.col-md-3-->
                                <div class="col-md-2 col-lg-1 padding-left">
                                    <label class="text-uppercase">room</label>
                                    <div class="input box-radius"><i class="fa fa-caret-down"></i>
                                        <select name="room" id="room-avail"
                                                value="<?php echo empty($room) ? '' : $room ?>">
                                            <option value="1" <?php if (!empty($room) && $room == 1) echo "selected='selected'"; ?> >
                                                1
                                            </option>
                                            <option value="2" <?php if (!empty($room) && $room == 2) echo "selected='selected'"; ?> >
                                                2
                                            </option>
                                            <option value="3" <?php if (!empty($room) && $room == 3) echo "selected='selected'"; ?> >
                                                3
                                            </option>
                                            <option value="4" <?php if (!empty($room) && $room == 4) echo "selected='selected'"; ?> >
                                                4
                                            </option>
                                            <option value="5" <?php if (!empty($room) && $room == 5) echo "selected='selected'"; ?> >
                                                5
                                            </option>
                                            <option value="6" <?php if (!empty($room) && $room == 6) echo "selected='selected'"; ?> >
                                                6
                                            </option>
                                            <option value="7" <?php if (!empty($room) && $room == 7) echo "selected='selected'"; ?> >
                                                7
                                            </option>
                                            <option value="8" <?php if (!empty($room) && $room == 8) echo "selected='selected'"; ?> >
                                                8
                                            </option>
                                            <option value="9" <?php if (!empty($room) && $room == 9) echo "selected='selected'"; ?> >
                                                9
                                            </option>
                                            <option value="10" <?php if (!empty($room) && $room == 10) echo "selected='selected'"; ?>>
                                                10
                                            </option>
                                        </select>
                                    </div><!--/.input-->
                                </div><!--/.col-md-2-->
                                <div class="col-md-2 col-lg-1 padding-left">
                                    <label class="text-uppercase">Adult</label>
                                    <div class="input box-radius"><i class="fa fa-caret-down"></i>
                                        <select name="adult" id="adult-avail"
                                                value="<?php echo empty($adult) ? '' : $adult ?>">
                                            <option value="1" <?php if (!empty($adult) && $adult == 1) echo "selected='selected'"; ?> >
                                                1
                                            </option>
                                            <option value="2" <?php if (!empty($adult) && $adult == 2) echo "selected='selected'"; ?> >
                                                2
                                            </option>
                                            <option value="3" <?php if (!empty($adult) && $adult == 3) echo "selected='selected'"; ?> >
                                                3
                                            </option>
                                            <option value="4" <?php if (!empty($adult) && $adult == 4) echo "selected='selected'"; ?> >
                                                4
                                            </option>
                                            <option value="5" <?php if (!empty($adult) && $adult == 5) echo "selected='selected'"; ?> >
                                                5
                                            </option>
                                            <option value="6" <?php if (!empty($adult) && $adult == 6) echo "selected='selected'"; ?> >
                                                6
                                            </option>
                                            <option value="7" <?php if (!empty($adult) && $adult == 7) echo "selected='selected'"; ?> >
                                                7
                                            </option>
                                            <option value="8" <?php if (!empty($adult) && $adult == 8) echo "selected='selected'"; ?> >
                                                8
                                            </option>
                                            <option value="9" <?php if (!empty($adult) && $adult == 9) echo "selected='selected'"; ?> >
                                                9
                                            </option>
                                            <option value="10" <?php if (!empty($adult) && $adult == 10) echo "selected='selected'"; ?>>
                                                10
                                            </option>
                                        </select>
                                    </div><!--/.input-->
                                </div><!--/.col-md-2-->
                                <div class="col-md-2 col-lg-2 padding-left">
                                    <label class="text-uppercase">Children</label>
                                    <div class="input box-radius"><i class="fa fa-caret-down"></i>
                                        <select name="childrens" id="children-avail"
                                                value="<?php echo empty($childrens) ? '' : $childrens ?>">
                                            <option value="0" <?php if (empty($childrens) || $childrens == 0) echo "selected='selected'"; ?> >
                                                0
                                            </option>
                                            <option value="1" <?php if (!empty($childrens) && $childrens == 1) echo "selected='selected'"; ?> >
                                                1
                                            </option>
                                            <option value="2" <?php if (!empty($childrens) && $childrens == 2) echo "selected='selected'"; ?> >
                                                2
                                            </option>
                                            <option value="3" <?php if (!empty($childrens) && $childrens == 3) echo "selected='selected'"; ?> >
                                                3
                                            </option>
                                            <option value="4" <?php if (!empty($childrens) && $childrens == 4) echo "selected='selected'"; ?> >
                                                4
                                            </option>
                                            <option value="5" <?php if (!empty($childrens) && $childrens == 5) echo "selected='selected'"; ?> >
                                                5
                                            </option>
                                            <option value="6" <?php if (!empty($childrens) && $childrens == 6) echo "selected='selected'"; ?> >
                                                6
                                            </option>
                                            <option value="7" <?php if (!empty($childrens) && $childrens == 7) echo "selected='selected'"; ?> >
                                                7
                                            </option>
                                            <option value="8" <?php if (!empty($childrens) && $childrens == 8) echo "selected='selected'"; ?> >
                                                8
                                            </option>
                                            <option value="9" <?php if (!empty($childrens) && $childrens == 9) echo "selected='selected'"; ?> >
                                                9
                                            </option>
                                            <option value="10" <?php if (!empty($childrens) && $childrens == 10) echo "selected='selected'"; ?>>
                                                10
                                            </option>
                                        </select>
                                    </div><!--/.input-->
                                </div><!--/.col-md-2-->
                                <div class="col-md-3 padding-left button-booking">
                                    <a class="btn btn-default" onclick="checkAvail()">Check Availability</a>
                                </div>
                            </div><!--/.row-->
                        </form><!--/.online-book-form-->
                    </div><!--/.col-md-12-->
                </div><!--/.row-->
            </div><!--/.container-fluid-->
        </div>
    </section><!--/.online-book-section-->

    <div class="room-single-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-full-width">
                    <div class="section-title-area text-center">
                        <h2 class="section-title">Online Reservation</h2>
                        <p class="section-title-dec">Our varied choice of rooms has been designed to suit your needs, be
                            it for business travellers, family or group leisure.</p>
                    </div><!--/.section-title-area-->
                </div><!--/.col-md-8-->
            </div><!--/.row-->

            <div class="row" id="no-result">
                <div class="col-md-12 room-single-content">
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle"></i> &nbsp; No result found.
                    </div><!-- End .alert-danger -->
                </div>

                <form action="{{url('/check-availability/signup')}}" method="post" id="checkAvailSignupForm"
                      name="checkAvailSignupForm" action="">
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"/>
                    <input type="hidden" name="notify_product_id" id="notify_product_id"
                           value="<?php echo empty($pid) ? '' : $pid ?>"/>
                    <input type="hidden" name="notify_checkin_date" id="notify_checkin_date"
                           value="<?php echo empty($arrival) ? '' : $arrival ?>"/>
                    <input type="hidden" name="notify_checkout_date" id="notify_checkout_date"
                           value="<?php echo empty($departure) ? '' : $departure ?>"/>
                    <input type="hidden" name="notify_room" id="notify_room"
                           value="<?php echo empty($room) ? '' : $room ?>"/>
                    <input type="hidden" name="notify_adult" id="notify_adult"
                           value="<?php echo empty($adult) ? '' : $adult ?>"/>
                    <input type="hidden" name="notify_children" id="notify_children"
                           value="<?php echo empty($children) ? '' : $children ?>"/>
                    <div class="col-md-4">
                        <h4>Please sign up for the notification:</h4>
                        <div class="form-group">
                            <input type="text" name="email" id="email" aria-required="true" placeholder="Email *"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-default" type="submit">Submit</button>
                        </p>
                    </div>
                </form>
            </div>

            <div class="row result-container" style="display: none;">
                <div class="col-md-12 room-single-content">
                    <div class="single-room list mobile-extend">

                        <ul>
                            <li>Check-in: <span class="text-black info-checkin"><b>18th Jul, 2017</b></span></li>
                            <li>Check-out: <span class="text-black info-checkout"><b>19th Jul, 2017</b></span></li>
                            <li>Rooms: <span class="text-black info-rooms"><b>1</b></span></li>
                            <li>Adults: <span class="text-black info-adults"><b>1</b></span></li>
                            <li>Children: <span class="text-black info-children"><b>1</b></span></li>
                        </ul>

                        <div class="table-responsive margin-top">


                            <table class="table cart-table">
                                <thead>
                                <tr>
                                    <th class="table-title">Types</th>
                                    <th class="table-title">Room Code</th>
                                    <th class="table-title">Unit Price / night (nett)</th>
                                    <!-- <th class="table-title">Quantity</th> -->
                                    <th class="table-title">SubTotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="item-name-col">

                                        <figure>
                                            <a href="#room-details"><img src="public/front/images/rooms/img_deluxe.jpg"
                                                                         alt="Deluxe Room" class="img-responsive"></a>
                                        </figure>
                                        <header class="item-name">
                                            <a href="#room-details">Deluxe Room </a>
                                        </header>
                                        <ul>
                                            <li><i class="fa fa-bed"></i> <b>BED:</b> 1 King or 2 Singles</li>
                                            <li><i class="fa fa-user"></i> <b>GUEST:</b> Max. 2 guests</li>
                                            <li><i class="fa fa-cutlery"></i> <b>MEAL:</b> 2 breakfasts</li>
                                        </ul>
                                    </td>
                                    <td class="item-price-col">DR-XXXXX01</td>
                                    <td class="item-price-col"><span class="item-price-special">RM 145.<span
                                                    class="sub-prices">00</span></span></td>
                                    <td>
                                        <div class="custom-quantity-input">
                                            <input type="text" name="quantity" value="1"> <a href="#" onClick="return!1"
                                                                                             class="quantity-btn quantity-input-up"><i
                                                        class="fa fa-angle-up"></i></a> <a href="#" onClick="return!1"
                                                                                           class="quantity-btn quantity-input-down"><i
                                                        class="fa fa-angle-down"></i></a></div>
                                    </td>
                                    <td class="item-total-col"><span class="item-price-special">RM 145.<span
                                                    class="sub-prices">00</span></span>
                                        <a href="#" class="close-button add-tooltip" data-toggle="tooltip"
                                           data-placement="top" title="Remove item"></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="hidden-md hidden-lg text-center extend-btn"><span class="extend-icon"><i
                                    class="fa fa-angle-down"></i></span></div>
                </div><!--/.col-md-12-->

            </div><!--/.row-->

            <div class="row result-container" style="display: none;">
                <div class="col-md-7 col-sm-12 col-xs-12">
                    <div class="tab-container left clearfix">
                        <ul class="nav-tabs">
                            <li class="active"><a href="#discount" data-toggle="tab">Promo Code</a></li>
                            <li><a href="#gift" data-toggle="tab">Gift Voucher</a></li>
                        </ul>
                        <div class="tab-content clearfix">

                            <div class="tab-pane active" id="discount">
                                <p>Please enter your discount Promo code here.</p>
                                <form action="#" class="review-comment-form box-radius"
                                      onsubmit="checkDiscount(this, event)">
                                    <input type="hidden" name="promocode_id" value="">
                                    <div class="single-input">
                                        <p class="coupon-error text-danger"></p>
                                        <div class="input box-radius">
                                            <input autocomplete="off" type="text" onchange="activeDiscount(this)"
                                                   class="form-control input-discount" name="discount"
                                                   onkeyup="activeDiscount(this)">

                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <button type="submit" class="btn btn-submit btn-disc disabled">Apply Coupon</button>
                                </form>
                            </div>
                            <div class="tab-pane" id="gift">
                                <p>Enter your discount gift voucher number here.</p>
                                <form action="#" class="review-comment-form box-radius">

                                    <div class="single-input">
                                        <div class="input box-radius">
                                            <input type="text" class="form-control">

                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <button type="submit" class="btn btn-submit disabled">Apply Voucher</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12 col-xs-12">
                    <table class="table total-table">
                        <tbody>
                        <tr>
                            <td class="total-table-title">Subtotal:</td>
                            <td class="amount"><span id="ca-sub-total" class="alignright">RM 513</span></td>
                        </tr>
                        <tr>
                            <td class="total-table-title text-danger">Discount:</td>
                            <td class="amount text-danger"><span id="ca-discount" class="alignright">RM 0</span></td>
                        </tr>
                        <tr>
                            <td class="total-table-title gst-title">SST</td>
                            <td class="amount"><span class="gst alignright">RM 0</span></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>Total:</td>
                            <td class="amount-total"><span id="ca-total" class="alignright">RM 493</span></td>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="margin-top"></div>
                    <div class="pull-right">
                        <a onclick="prepareCart()" class="btn btn-default">Book Now</a>
                    </div>
                </div><!--/.row-->
                <form style="display: none;" id="checkout" action="{{url('checkout')}}"></form>
                <div class="row">
                    <div class="col-md-12">

                        <div class="single-room list mobile-extend">
                            <div class="room-info">

                                <div class="room-description margin-top clearfix">

                                    <h4 class="margin-top">Terms and Conditions</h4>

                                    <ul class="list-group-item">
                                        <li>- All rates listed are Nett rates inclusive of 10% service charge and 6%
                                            government tax.
                                        </li>
                                        <li>- All rates quoted include breakfast.</li>
                                        <li>- Check-in: 3:00 pm.</li>
                                        <li>- Check-out: 12:00 pm.</li>
                                        <li>- Rates are subject to change without prior notice.</li>
                                    </ul>
                                    <h4 class="margin-top">Cancellation Policy</h4>
                                    <p>One night's room charge shall be levied on guaranteed reservations, in the event
                                        of "no show" or if cancelled within/less than 48 hours before the day of
                                        arrival. Please cancel online or contact us at (05) 242-7777.</p>
                                    <p>For bookings made less than 2 working days before arrival date, the hotel
                                        reserves the right to charge your credit card upon confirmation.</p>
                                    <p>Cancellation policy for festive/peak season will supercede those stated here.
                                        Customers are deemed to have understood and agreed to the above before making
                                        this reservation.</p>

                                </div><!--/.room-description-->

                            </div><!--/.room-info-->
                        </div><!--/.room-single-content-->
                    </div><!--/.col-md-12-->
                </div><!--/.row-->

            </div><!--/.container-->
        </div><!--/.room-grid-area-->


        <section
                data-jarallax="{&quot;speed&quot;: 0.3, &quot;imgSrc&quot;: &quot;public/front/images/parallax/bg_hotel_services.jpg&quot; }"
                class="hotel-service-section jarallax">
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title-area text-center">
                                <h2 class="section-title">Hotel Services</h2>
                                <p class="section-title-dec">For your comfort and convenience.</p>
                            </div><!--/.section-title-area-->
                        </div><!--/.col-md-12-->
                    </div><!--/.row-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="aravira-hospitality owl-carousel">
                                <div class="item">
                                    <div class="single-hospitality box-radius">
                                        <div class="icon">
                                            <img src="public/front/images/hotel_services/icon_tour_desk.png"
                                                 alt="Tour Desk">
                                        </div>
                                        <h5>Tour Desk</h5>
                                    </div><!--/.single-hospitality-->
                                </div><!--/.item-->
                                <div class="item">
                                    <div class="single-hospitality box-radius">
                                        <div class="icon">
                                            <img src="public/front/images/hotel_services/icon_reception.png"
                                                 alt="24 hour Reception">
                                        </div>
                                        <h5>24 hour Reception</h5>
                                    </div><!--/.single-hospitality-->
                                </div><!--/.item-->
                                <div class="item">
                                    <div class="single-hospitality box-radius">
                                        <div class="icon">
                                            <img src="public/front/images/hotel_services/icon_wifi.png" alt="WiFi">
                                        </div>
                                        <h5>WiFi Internet</h5>
                                    </div><!--/.single-hospitality-->
                                </div><!--/.item-->
                                <div class="item">
                                    <div class="single-hospitality box-radius">
                                        <div class="icon">
                                            <img src="public/front/images/hotel_services/icon_elevator.png"
                                                 alt="Lift/Elevator">
                                        </div>
                                        <h5>Lift / Elevator</h5>
                                    </div><!--/.single-hospitality-->
                                </div><!--/.item-->

                                <div class="item">
                                    <div class="single-hospitality box-radius">
                                        <div class="icon">
                                            <img src="public/front/images/hotel_services/icon_no-smoking.png"
                                                 alt="Non-Smoking Room">
                                        </div>
                                        <h5>Non-Smoking Rooms</h5>
                                    </div><!--/.single-hospitality-->
                                </div><!--/.item-->

                                <div class="item">
                                    <div class="single-hospitality box-radius">
                                        <div class="icon">
                                            <img src="public/front/images/hotel_services/icon_laundry.png"
                                                 alt="Guest Laundry">
                                        </div>
                                        <h3>Guest Laundry</h3>
                                    </div><!--/.single-hospitality-->
                                </div><!--/.item-->


                            </div><!--/.end facilities-->

                        </div><!--/.col-md-12-->
                    </div><!--/.row-->
                </div><!--/.container-large-screen-->
            </div><!--/.container-fluid-->
        </section>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('body').addClass('pignose-calendar-body');
        });
    </script>
@endsection


<script type="text/javascript"> // Storage
    var rooms;
    var is_tax = 0;
    var gst_rate = 6;
</script>



<script type="text/javascript">
    function activeDiscount(elm) {
        if (jQuery(elm).val().length >= 4) {
            jQuery('.btn-disc').removeClass('disabled').removeAttr('disabled');
        } else {
            jQuery('.btn-disc').addClass('disabled').attr('disabled', 'disabled');
        }
    }

    function checkDiscount(elm, event) {
        event = event || window.event;
        event.preventDefault();
        event.stopPropagation();
        var pids = [];
        jQuery('.single-room tbody tr').each(function (i, e) {
            pids.push(jQuery(e).data('id'));
        });
        // remove error
        $('.coupon-error').text('');
        jQuery.ajax({
            url: '/check-availability/check-discount',
            data: {
                'code': jQuery('input[name=discount]').val(),
                'pids': pids
            }
        }).done(function (response) {

            if (response != 0) {
                var res = JSON.parse(response);
                if (res.error) {
                    $('.coupon-error').text(res.error);
                    return;
                }
                $('input[name=promocode_id]').val(res.id);

                if (jQuery('#ca-discount').hasClass('promo')) {
                    if (res.promo_code != jQuery("#ca-discount").data('data-promo'))
                        ;
                    {
                        jQuery('.total-table-title.text-danger').html('DISCOUNT: (' + res.promo_code + ')');
                        var total = Number(jQuery('#ca-total').html().replace('RM ', '')).toFixed(2);
                        var subtotal = Number(jQuery('#ca-sub-total').html().replace('RM ', '')).toFixed(2);
                        var gst = Number(jQuery('.amount .gst').html().replace('RM ', '')).toFixed(2);


                        if (res.discount_type != 'P') {
                            jQuery('#ca-discount').html('- RM ' + res.discount + '');
                            jQuery('#ca-discount').addClass('promo');
                            jQuery('#ca-discount').data('data-promo', res.discount);
                            jQuery('#ca-total').html('RM ' + (Number(subtotal) - res.discount + Number(gst)).toFixed(2) + '');

                        } else {
                            jQuery('#ca-discount').html('- RM ' + (Number(subtotal) * (Number(res.discount) / 100)).toFixed(2) + '');
                            jQuery('#ca-discount').addClass('promo');
                            jQuery('#ca-discount').data('data-promo', res.discount);
                            jQuery('#ca-total').html('RM ' + (Number(subtotal) + Number(gst) - (Number(subtotal) * (Number(res.discount) / 100))).toFixed(2) + '');
                        }
                    }
                } else {


                    jQuery('.total-table-title.text-danger').html('DISCOUNT: (' + res.promo_code + ')');
                    var total = Number(jQuery('#ca-total').html().replace('RM ', '')).toFixed(2);
                    var subtotal = Number(jQuery('#ca-sub-total').html().replace('RM ', '')).toFixed(2);
                    var gst = Number(jQuery('.amount .gst').html().replace('RM ', '')).toFixed(2);


                    if (res.discount_type != 'P') {
                        jQuery('#ca-discount').html('- RM ' + res.discount + '');
                        jQuery('#ca-discount').addClass('promo');
                        jQuery('#ca-discount').data('data-promo', res.discount);
                        jQuery('#ca-total').html('RM ' + (Number(subtotal) - res.discount + Number(gst)).toFixed(2) + '');

                    } else {
                        jQuery('#ca-discount').html('- RM ' + (Number(subtotal) * (Number(res.discount) / 100)).toFixed(2) + '');
                        jQuery('#ca-discount').addClass('promo');
                        jQuery('#ca-discount').data('data-promo', res.discount);
                        jQuery('#ca-total').html('RM ' + (Number(subtotal) + Number(gst) - (Number(subtotal) * (Number(res.discount) / 100))).toFixed(2) + '');
                    }


                    jQuery('.sub-price').remove();
                }                //   jQuery('#ca-total').html('RM '+(Number(total)-(Number(total)*(Number(res.discount)/100))).toFixed(2)+'');
            }
        });
    }
</script>

<script type="text/javascript">
    function prepareCart() {
        var order = [];
        var tr = jQuery('.cart-table tbody tr');
        jQuery.each(tr, function (index, value) {
            var id = jQuery(value).attr('data-id');
            var qty = jQuery(value).find('.custom-quantity-input input').val();
            // var rooms = jQuery(value).attr('data-rooms');
            var product = {
                product_id: id,
                qty: qty,
            };
            order.push(product);
        });
        var data = {
            _token: '{{ csrf_token() }}',
            order: order,
            rooms: jQuery("#room-avail").val(),
            adults: jQuery("#adult-avail").val(),
            children: jQuery("#children-avail").val(),
            arrival: jQuery('#date-arrival').val(),
            departure: jQuery('#date-departure').val(),
            promocode_id: $('input[name=promocode_id]').val()
        };
        jQuery.ajax({
            url: "{{ url('make-cart') }}",
            type: 'POST',
            data: data,
            dataType: 'json',
            async: false,
            cache: false,
            success: function (response) {
                jQuery('#checkout').submit();
            }
        });
    }

    function calculate_sub_total() {
        var row = jQuery('.cart-table tbody tr');
        var sub_total = 0;
        var discount = 0;
        var total = 0;

        jQuery.each(row, function (index, value) {
            //var qnt = jQuery(value).find('.custom-quantity-input input').val();
            //var qnt = 1; // for that now it fetches subtotal from db
            var qnt = parseInt(jQuery("#room-avail").val());
            var price = parseFloat(jQuery(value).attr('data-price'));
            var off = parseFloat(jQuery(value).attr('data-off'));
            var temp_total = qnt * price;
            discount += qnt * off;
            sub_total += temp_total;
        });

        if (is_tax == 1) {
//            total = sub_total - discount + (sub_total / 100 * 6);
//            jQuery('.amount .gst').html('RM ' + (sub_total / 100 * 6).toFixed(2));
//            jQuery('.gst-title').html('SST (6%)');
            total = sub_total - discount + (sub_total / 100 * gst_rate);
            jQuery('.amount .gst').html('RM ' + (sub_total / 100 * gst_rate).toFixed(2));
            jQuery('.gst-title').html('SST (' + gst_rate + '%)');
        } else {
            total = sub_total - discount;
            jQuery('.amount .gst').html('RM 0.00');
            jQuery('.gst-title').html('SST (0%)');
        }
        jQuery('#ca-sub-total').html('RM ' + sub_total.toFixed(2));
        jQuery('#ca-total').html('RM ' + total.toFixed(2));
        jQuery('#ca-discount').html('RM ' + discount.toFixed(2));


    }

    window.onload = function () {
        jQuery('.amount.text-danger').removeClass('promo');
        calculate_sub_total();
        @if (!empty($arrival))
        checkAvail();
        @endif

        jQuery(document).on('click', '.close-button', function () {
            jQuery(this).closest('tr').remove();
            if (jQuery('.cart-table tbody tr').length == 0) {
                jQuery('.result-container').hide();
                jQuery('#no-result').show();
            }
            calculate_sub_total();
        });
        jQuery(document).on('click', '.quantity-input-down', function () {
            return; // to disable
            console.log('down');
            var tr = jQuery(this).closest('tr');
            var qnt = jQuery(this).closest('.custom-quantity-input').find('input').val();
            if (qnt <= 1)
                return;
            var newQnt = parseInt(qnt) - 1;
            tr.find('.max-qnt').hide();
            var price = tr.attr('data-price');
            var newDate = moment(jQuery('.info-checkout').html(), "YYYY-MM-DD");
            console.log(jQuery('.info-checkout').html());
            newDate = newDate.subtract(1, 'd');
            jQuery('.info-checkout b').html(moment(newDate).format("YYYY-MM-DD").toString());
            jQuery('#date-departure').val(moment(newDate).format("YYYY-MM-DD").toString());
            console.log(price);
            var subPrice = price * newQnt;
            jQuery(this).closest('.custom-quantity-input').find('input').val(newQnt);
            tr.find('.item-price-special.s-b .mp').html('RM ' + subPrice.toFixed(2) + '');
            calculate_sub_total();

        });

        jQuery(document).on('click', '.quantity-input-up', function () {
            return; // to disable
            console.log('up');
            var tr = jQuery(this).closest('tr');
            var avail = parseInt(tr.attr('data-avail'));
            var qnt = jQuery(this).closest('.custom-quantity-input').find('input').val();
            var newQnt = parseInt(qnt) + 1;
            if (avail <= qnt) {
                tr.find('.max-qnt').show();
                return;
            }

            var newDate = moment(jQuery('.info-checkout').html(), "YYYY-MM-DD");
            console.log(jQuery('.info-checkout').html());
            newDate = newDate.add(1, 'd');
            jQuery('.info-checkout b').html(moment(newDate).format("YYYY-MM-DD").toString());
            jQuery('#date-departure').val(moment(newDate).format("YYYY-MM-DD").toString());
            var price = tr.attr('data-price');
            console.log(price);
            var subPrice = price * newQnt;
            jQuery(this).closest('.custom-quantity-input').find('input').val(newQnt);
            tr.find('.item-price-special.s-b .mp').html('RM ' + subPrice.toFixed(2) + '');
            calculate_sub_total();

        });
        jQuery('#date-arrival').pignoseCalendar({
            buttons: true,
            minDate: new Date(),
            select: function (date, context) {
            },
            apply: function (date, context) {
                console.log(date);
                var dd = moment(date);
                dd.set('date', dd.get('date') + 1);
                console.log("date ==", dd.format('YYYY-MM-DD'));
                if (jQuery('#date-departure').val() != '' && new Date(jQuery('#date-arrival').val()) >= new Date(jQuery('#date-departure').val())) {
                    jQuery('#date-departure').val(dd.format('YYYY-MM-DD'));
                }
                jQuery('#date-departure').pignoseCalendar('set', dd.format('YYYY-MM-DD'));
                jQuery('#date-departure').trigger("click");
            }
        });
        jQuery('#date-departure').pignoseCalendar({
            buttons: true,
            minDate: new Date(),
            select: function (dates, context) {
            },
            apply: function (date, context) {
                if (new Date(jQuery('#date-arrival').val()) >= new Date(date)) {
                    jQuery('#date-departure').val('');
                    alert('Please select departure date bigger than arrival date.');
                }
            }
        });
        calculate_sub_total();
    };

    function checkAvail() {
        var arrival = jQuery('#date-arrival').val();
        var departure = jQuery('#date-departure').val();
        var roomsAvail = jQuery("#room-avail").val();
        var adultsAvail = jQuery("#adult-avail").val();
        var childrenAvail = jQuery("#children-avail").val();

        //console.log(rooms);

        if (arrival == '' || departure == '') {
            alert('Please select arrival and departure date');
            return;
        }
        // $.LoadingOverlay("show");

        jQuery('#no-result').hide();

        var data = {
            _token: '{{ csrf_token() }}',
            checkin_date: arrival,
            checkout_date: departure,
            room: jQuery('#room-avail').val(),
            adult: jQuery('#adult-avail').val(),
            childrens: jQuery('#children-avail').val(),
            product_id: '<?php echo empty($pid) ? '' : $pid ?>'
        };
        jQuery.ajax({
            url: "{{ url('check-availability') }}",
            type: 'POST',
            data: data,
            dataType: 'json',
            async: false,
            cache: false,
            success: function (response) {
                if (response.status) {
                    console.log('success');
                    jQuery('.cart-table tbody').empty();

                    if (response.dates) {
                        var dateArray = response.dates.split(' ');
                        dateArray.pop();
                        var errorMessage = '';

                        if (dateArray.length == 1) {
                            alert("Date " + dateArray[0] + ' is not available. Please select different date(s).')
                        } else if (dateArray.length > 1) {
                            var errorMessage = '';

                            for (var i = 0; i < dateArray.length; i++) {
                                if (i == 0) {
                                    errorMessage += "Dates " + dateArray[i];
                                } else if (dateArray.length == i + 1) {
                                    errorMessage += " and " + dateArray[i] + " are not available. Please select different date(s)."
                                } else {
                                    errorMessage += ", " + dateArray[i];
                                }
                            }

                            alert(errorMessage);
                        }
                    } else if (response.avail.length) {
                        rooms = response.avail;
                        console.log("response.avail = ", response.avail);
                        jQuery.each(response.avail, function (index, value) {
                            jQuery('.cart-table tbody').append(template(value));
                            is_tax = value.is_tax;
                            if (value.gst_rate != null) {
                                gst_rate = value.gst_rate;
                            }

                        });
                        calculate_sub_total();
                        jQuery('.info-checkin b').html(arrival);
                        jQuery('.info-checkout b').html(departure);
                        jQuery('.info-adults b').html(adultsAvail);
                        jQuery('.info-children b').html(childrenAvail);
                        jQuery('.info-rooms b').html(roomsAvail);
                        var quantity = GetNightsFromDates() * roomsAvail;

                        jQuery('input[name="quantity"]').val(quantity);

                        jQuery('.result-container').show();
                        jQuery('#no-result').hide();
                    } else {
                        jQuery('.cart-table tbody').append('<tr><td colspan="5"> No Result </td></tr>');
                        jQuery('.result-container').hide();
                        jQuery('#no-result').show();
                    }
                } else {
                    console.log('fail nothing to do ... ');
                    jQuery('.result-container').hide();
                    jQuery('#no-result').show();

                }

                // $.LoadingOverlay("hide");
            }
        });
        calculate_sub_total();
    }

    function template(row) {
        var roomsAvail = jQuery("#room-avail").val();

        html = '<tr data-rooms="' + roomsAvail + '" data-id="' + row.id + '" data-off="' + row.discount + '" data-price="' + row.sale_price + '" data-avail="' + row.quantity_in_stock + '">';
        html += '<td class="item-name-col">';
        html += '<figure>';
        html += '<a href="#room-details"><img src="public/admin/products/medium/' + row.thumbnail_image_1 + '" alt="Deluxe Room" class="img-responsive"></a></figure>';
        html += '<header class="item-name">';
        html += '<a href="{{url("rooms-suites/show")}}/' + row.id + '" target="_blank">' + row.type + '</a>';
        html += '</header>';
        html += '<ul>';
        html += '<li><i class="fa fa-bed"></i> <b>BED:</b> ' + row.bed + ' </li>';
        html += '<li><i class="fa fa-user"></i> <b>GUEST:</b> ' + row.guest + '</li>';
        html += '<li><i class="fa fa-cutlery"></i> <b>MEAL:</b> ' + row.meal + '</li>';
        html += '</ul> ';
        html += '</td>';
        html += '<td class="item-price-col">' + row.room_code + '</td>';
        html += '<td>' + row.priceByDates + '</td>';
        html += '<td style="display: none; class="item-price-col"><span class="item-price-special">RM ' + row.sale_price.toFixed(2) + '<span class="sub-prices"></span></span></td>';
        html += '<td style="display: none;">';
        html += '<div class="custom-quantity-input">';
        html += '<input disabled type="text" name="quantity" value="' + GetNightsFromDates() + '"> <a class="quantity-btn quantity-input-up"><i class="fa fa-angle-up"></i></a> <a class="quantity-btn quantity-input-down"><i class="fa fa-angle-down"></i></a></div>';
        html += '<span class="max-qnt" style="color:red;display:none;">Max</span>';
        html += '</td>';
        html += '<td class="item-total-col"><span class="item-price-special s-b"><span class="mp">RM ' + (parseFloat(parseFloat(row.sale_price) * parseInt(/* GetNightsFromDates() * */ roomsAvail))).toFixed(2) + '</span><span class="sub-prices"></span></span>';
        html += '<a class="close-button add-tooltip" data-toggle="tooltip" data-placement="top" title="Remove item"></a></td>';
        html += '</tr>';
        return html;
    }

    function GetNightsFromDates() {
        var arrival = moment(jQuery('#date-arrival').val());
        var departure = moment(jQuery('#date-departure').val());

        return departure.diff(arrival, 'days');
    }

</script>
