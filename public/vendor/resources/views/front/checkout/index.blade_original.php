@extends('front/templateFront')

@section('content')
<div class="room-single-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-full-width">
                <div class="section-title-area text-center">
                    <h2 class="section-title">Checkout</h2>
                    <p class="section-title-dec">Review your booking and pay.</p>
                </div><!--/.section-title-area-->
            </div><!--/.col-md-8-->
        </div><!--/.row-->

        <div class="row">
            <div class="col-md-12 room-single-content">
                <div class="single-room list mobile-extend">


                    <ul>
                        <li>Check-in: <span class="text-black"><b><?= $cart['arrival'] ?></b></span></li>
                        <li>Check-out: <span class="text-black"><b><?= $cart['departure'] ?></b></span></li>
                    </ul>

                    <div class="table-responsive margin-top">


                        <table class="table cart-table">
                            <thead>
                                <tr>
                                    <th class="table-title">Types</th>
                                    <th class="table-title">Room Code</th>
                                    <th class="table-title">Unit Price / night (nett)</th>
                                    <th class="table-title">Quantity</th>
                                    <th class="table-title">SubTotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // cart info
                                $total_amount = 0;
                                foreach ($cart['product'] as $key => $value) {
                                    $total_amount += $value['sale_price'] * $value['qty'];
                                    ?>
                                    <tr>
                                        <td class="item-name-col">

                                            <figure>
                                                <a href="#room-details"><img src="public/admin/products/medium/<?= $value['thumbnail_image_1'] ?>" alt="Deluxe Room" class="img-responsive"></a></figure>
                                            <header class="item-name">
                                                <a href="{{url('rooms-suites/show')}}/<?= $value['product_id'] ?>" target="_blank"><?= $value['type'] ?></a>
                                            </header>
                                            <ul>
                                                <li><i class="fa fa-bed"></i> <b>BED:</b> <?= $value['bed'] ?> </li>
                                                <li><i class="fa fa-user"></i> <b>GUEST:</b> <?= $value['guest'] ?></li>
                                                <li><i class="fa fa-cutlery"></i> <b>MEAL:</b> <?= $value['meal'] ?></li>
                                            </ul>
                                        </td>
                                        <td class="item-price-col"><?= $value['room_code'] ?></td>
                                        <td class="item-price-col"><span class="item-price-special">RM <?= $value['sale_price'] ?>.<span class="sub-price">00</span></span></td>
                                        <td><?= $value['qty'] ?></td>
                                        <td class="item-total-col"><span class="item-price-special">RM <?= $value['sale_price'] * $value['qty'] ?>.<span class="sub-price">00</span></span>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div><!-- end table responsive -->

                </div>


                <div class="hidden-md hidden-lg text-center extend-btn"><span class="extend-icon"><i class="fa fa-angle-down"></i></span></div>
            </div><!--/.col-md-12-->

        </div><!--/.row-->

        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">

                <div class="room-comments-area" style="/* display: none; */">
                    @if(!$isUserLogin)
                    <div id="respond" class="comment-respond box-radius">
                        <div class="row">
                            <div class="col-md-12">

                                <h4 class="comment-reply-title">Returning Customers</h4><!--/.comment-reply-title-->
                            </div><!--/.col-md-12-->
                        </div><!--/.row-->
                        <div class="row">
                            @if(Session::has('error'))
                            <div class="alert alert-danger" style="margin-top: 15px;">
                                <i class="fa fa-exclamation-triangle"></i> &nbsp; {{ Session::get('error') }}
                            </div>
                            @else
                            <div class="alert alert-danger" style="margin-top: 15px;">
                                <i class="fa fa-exclamation-triangle"></i> &nbsp; <span>Please sign in or sign up to place order and payment.</span>
                            </div>
                            @endif

                            <div class="col-md-12">
                                <form action="{{ url('login') }}" method="post" id="comment_form" name="commentForm">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="redirect" value="checkout">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 padding-right">
                                            <p>
                                                <input type="text" name="email" id="email" aria-required="true" placeholder="Email *" class="form-controllar" required="true">
                                            </p>
                                        </div><!--/.col-md-6-->
                                        <div class="col-md-6 col-sm-6 padding-right">
                                            <p>
                                                <input type="password" name="password" id="email" aria-required="true" placeholder="Password *" class="form-controllar" required="true">
                                            </p>
                                        </div><!--/.col-md-6-->

                                        <div class="pull-left">
                                            <button type="submit" class="btn btn-default">Continue</button>
                                        </div>

                                        <div class="pull-right">
                                            <a href="{{ url('create_account') }}" class="btn btn-default">Create an Account</a>
                                        </div>

                                    </div><!--/.row-->


                                </form><!--/#comment_form-->

                                <div class="margin-top">
                                    <a href="#" data-toggle="modal" data-target="#modal-forgot-password">Forgot Password?</a>
                                </div>
                                <!-- Modal Forgot Passwrod start -->
                                <div class="modal fade" id="modal-forgot-password" tabindex="-1" role="dialog" aria-labelledby="login-modal" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Forgot Your Password?</h4>
                                            </div><!-- End .modal-header -->
                                            <form id="login-form-2" method="post" action="login/reset" name="login-form-2" enctype="multipart/form-data" >
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <div class="modal-body clearfix">
                                              <!-- <form action="#" method="post" id="comment_form" name="commentForm"> -->
                                                <p>Please enter your registered email address and we will help you to reset the password. The new generated password will be sent to the email address you entered below.</p>


                                                <div class="input-group"><span class="input-group-addon input-group-addon-new"><i class="fa fa-envelope"></i> <span class="input-text">Email &#42;</span></span>
                                                        <input  id="email"  name="email" type="text" required class="form-control mail-forget" placeholder="Your Email">
                                                 </div>
                                                 <div class="clearfix margin-top"></div>

                                               <!-- </form> -->
                                            </div><!-- End .modal-body -->
                                            <div class="modal-footer">
                                                <button class="btn btn-default btn-sm" name="reset" id="reset" onclick="document.getElementById('login-form-2').submit();">RESET PASSWORD</button>
                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">CLOSE</button>
                                            </div><!-- End .modal-footer -->
                                            </form>
                                        </div><!-- End .modal-content -->
                                    </div><!-- End .modal-dialog -->

                                </div><!-- End .modal forgot password -->


                            </div><!--/.col-md-12-->

                        </div><!--/.row-->
                    </div><!--/.comment-respond-->
                    @endif
                </div>

            </div><!--/.col-md-6-->


            <div class="col-md-6 col-sm-12 col-xs-12 pull-right">

                <table class="table total-table table-responsive">
                    <tbody>
                        <tr>
                            <td class="total-table-title"><span class="alignleft">Subtotal</span></td>
                            <td class="amount"><span class="alignright">RM <?= $total_amount ?><span class="sub-price">.00</span></span></td>
                        </tr>
                        <tr>
                            <td class="total-table-title text-danger"><span class="alignleft">Discount @if(isset($promo->promo_code)) ({{$promo->promo_code}}) @endif<span class="text-12px"></span></span> </td>
                            <?php
                            $discount_price = $discount;
                            $promo_d = isset($promo->discount) ? ($total_amount - $discount_price - (($total_amount - $discount_price) / 100 * $promo->discount)) : $total_amount - $discount_price;
                            $p_disc = isset($promo->discount) ? $promo->discount : 0;
                            ?>
                            <td class="amount text-danger"><span class="alignright">- RM <?= (($total_amount - $discount_price) / 100 * $p_disc) ?><span class="sub-price">.00</span></span></td>
                        </tr>
                        <tr>
                            <td class="total-table-title"><span class="alignleft">GST (6%)</span></td>
                            <td class="amount"><span class="alignright">RM {{ number_format($total_amount/100*6,2) }}<span class="sub-price"></span></span></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><span class="alignleft">Total</span></td>
                            <td class="amount-total"><span class="alignright">RM <?= number_format($promo_d + ($total_amount / 100 * 6), 2) ?><span class="sub-price"></span>
                                </span></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="margin-top"></div>

                @if(Session::get('userId') != '')

                <strong>Please select the payment option and proceed.</strong>
                <div class="input-group custom-checkbox">
                    <input type="checkbox" checked="true"> <span class="checbox-container"></span> PayPal
                    <img src="images/checkout/img_payment.png" alt="PayPal">
                </div>
                <hr>
                <div class="pull-right">
                    <!--									<form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('addmoney.paypal') !!}" >
                                                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                                                                    <input type="hidden" name="discount" value="{{ $discount_price }}" />
                                                                                                    <input type="hidden" name="amount" value="{{ ($promo_d+(floor($total_amount/100*6))) }}" />
                                                                                                    <button type="submit" class="btn btn-default"> Place order &amp; Pay </button>
                                                                                            </form>-->
                    <div id="paypal-button"></div>
                    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                    <script>
                    paypal.Button.render({

                        env: 'sandbox', // Or 'sandbox'

                        client: {
                            sandbox: 'AdJBPGNCfzPpaMFZ4SoGvJ8hr4tZpIQDkWMQA5dZ_db4keNRW9S1Ub1o6BFjUwqoGwFuodh9eykC5SoQ',
                            production: 'ATd4Ypl-uEcq8TyWxf2yzkxCn2-Bo14eM1_KShitd0gjC7ntnmKrYD0LO2WEvBt-ErQTb9GFquzIXMKr'
                        },

                        commit: true, // Show a 'Pay Now' button

                        payment: function (data, actions) {
                            return actions.payment.create({
                                payment: {
                                    transactions: [
                                        {
                                            amount: {total: '{{ ($promo_d+($total_amount/100*6)) }}', currency: 'MYR'}
                                        }
                                    ]
                                }
                            });
                        },

                        onAuthorize: function (data, actions) {
							window.location = "{{url('paypal')}}" + '?PaymentID=' + data.paymentID + '&PayerID=' + data.payerID + '&paymentToken=' + data.paymentToken;
                        },

                        style: {
                            size: 'medium',
                            color: 'blue',
                            label: 'pay'
                        }

                    }, '#paypal-button');
                    </script>
                    <!-- <script>
                    paypal.Button.render({

                        env: 'production', // Or 'sandbox'

                        client: {
                            sandbox: 'AdJBPGNCfzPpaMFZ4SoGvJ8hr4tZpIQDkWMQA5dZ_db4keNRW9S1Ub1o6BFjUwqoGwFuodh9eykC5SoQ',
                            production: 'ATd4Ypl-uEcq8TyWxf2yzkxCn2-Bo14eM1_KShitd0gjC7ntnmKrYD0LO2WEvBt-ErQTb9GFquzIXMKr'
                        },

                        commit: true, // Show a 'Pay Now' button

                        payment: function (data, actions) {
                            return actions.payment.create({
                                payment: {
                                    transactions: [
                                        {
                                            amount: {total: '768.5', currency: 'MYR'}
                                        }
                                    ]
                                }
                            });
                        },

                        onAuthorize: function(data) {

                            window.location = "{{url('paypal')}}" + '?PaymentID=' + data.paymentID + '&PayerID=' + data.payerID + '&paymentToken=' + data.paymentToken;
                        },

                        style: {
                            size: 'medium',
                            color: 'blue',
                            label: 'pay'
                        }

                    }, '#paypal-button');
                    </script> -->
                </div>

                @endif

            </div>
        </div><!--/.row-->

        <div class="row">

            <div class="col-md-12">

                <div class="single-room list mobile-extend ">
                    <div class="room-info">

                        <div class="room-description clearfix">

                            <h4 class="margin-top">Terms and Conditions</h4>

                            <ul class="list-group-item">
                                <li>- All rates listed are Nett rates inclusive of 10% service charge and 6% government tax.</li>
                                <li>- All rates quoted include breakfast.</li>
                                <li>- Check-in: 3:00 pm.</li>
                                <li>- Check-out: 12:00 pm.</li>
                                <li>- Rates are subject to change without prior notice.</li>
                            </ul>
                            <h4 class="margin-top">Cancellation Policy</h4>
                            <p>One night's room charge shall be levied on guaranteed reservations, in the event of "no show" or if cancelled within/less than 48 hours before the day of arrival. Please cancel online or contact us at (05) 242-7777.</p>
                            <p>For bookings made less than 2 working days before arrival date, the hotel reserves the right to charge your credit card upon confirmation.</p>
                            <p>Cancellation policy for festive/peak season will supercede those stated here. Customers are deemed to have understood and agreed to the above before making this reservation.</p>

                        </div><!--/.room-description-->

                    </div><!--/.room-info-->
                </div><!--/.room-single-content-->
            </div><!--/. col-md-12-->
        </div><!--/.row-->

    </div><!--/.container-->
</div>
@endsection
