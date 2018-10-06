@extends('front/templateFront')

@section('content')

<?php
	$ordersModel = new App\Http\Models\Admin\Orders();
    $orderTax = $ordersModel->getOrderTax($userOrderDetails[0]->id);
// dd($orderTax);
?>
    <div class="room-single-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-full-width">
                    <div class="section-title-area text-center">
                        <h2 class="section-title">Booking Details</h2>
                        <p class="section-title-dec">View your booking details and track your booking.</p>
                    </div><!--/.section-title-area-->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 room-single-content">
                    <div class="single-room list mobile-extend">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <a href="javascript:window.print()" class="btn btn-default">PRINT THIS PAGE &nbsp;<i class="fa fa-print"></i></a> &nbsp;
                                    <button data-toggle="modal" data-target="#email-modal" class="btn btn-default">EMAIL &nbsp;<i class="fa fa-envelope"></i></button>
                                </div>
                                <div class="clearfix"></div>
                                <div class="alert alert-success alert-dismissable margin-top" id="email-success" style="display:none;">
                                   <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                   <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                                   <p></p>
                                </div>



                                <div class="table-responsive margin-top">
                                    <?php
                                        $gst = 0;
                                        foreach($orderProducts as $orderProduct) {
                                            $product = DB::table('products')->where('id', $orderProduct->product_id)->first();
                                            $price = $orderProduct->quantity * $orderProduct->amount;
                                            $tax = 0;
                                            if ($product and $product->is_tax) {
                                                $tax = round($price * 0.06, 2);
                                                $gst += $tax;
                                            }
                                        }
                                        //dd($userOrderDetails);
                                    ?>
                                    <table class="table cart-table" style="margin-bottom: 20px !important;">
                                        <thead>
                                            <tr>
                                                <th class="table-title">Booking ID</th>
                                                <th class="table-title">Payment Reference No.</th>
                                                <th class="table-title">Date</th>
                                                <th class="table-title">Order Total</th>
                                                <th class="table-title">Payment Method</th>
                                                <th class="table-title">Booking Status</th>
                                                <th class="table-title">Payment Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>#{{$userOrderDetails[0]->id}}</td>
                                                <td><?php echo $userOrderDetails[0]->order_id;?></td>
                                                <td><?php echo date('dS M, Y', strtotime($userOrderDetails[0]->modifydate));?></td>

                                                   <td>RM  {{ number_format($orderTax->subtotal - $orderTax->discount + ($orderTax->subtotal * 0.06),2) }}</td>

                                                </td>
                                                <td><?php echo $userOrderDetails[0]->payment_method;?></td>
                                                <td class="text-uppercase">
                                                    @if($userOrderDetails[0]->status == 'Processing')
                                                        <span class="highlight fourth-color text-12px">Processing</span>
                                                    @elseif($userOrderDetails[0]->status == 'New Order')
                                                        <span class="highlight orange-color text-12px">New Order</span>
                                                    @elseif($userOrderDetails[0]->status == 'Ready To Ship')
                                                        <span class="highlight fourth-color text-12px">Ready To Ship</span>
                                                    @elseif($userOrderDetails[0]->status == 'Shipped')
                                                        <span class="highlight blue-color text-12px">Shipped</span>
                                                    @elseif($userOrderDetails[0]->status == 'Completed')
                                                        <span class="highlight first-color text-12px">Completed</span>
                                                    @elseif($userOrderDetails[0]->status == 'Declined')
                                                        <span class="highlight third-color text-12px">Declined</span>
                                                    @elseif($userOrderDetails[0]->status == 'Cancelled')
                                                        <span class="highlight black-color text-12px">Cancelled</span>
                                                    @else
                                                        <span class="highlight black-color text-12px">New Order</span>
                                                    @endif
                                                </td>
                                                <td class="text-uppercase">
                                                    @if($userOrderDetails[0]->payment_status == 'Paid')
                                                        <span class="highlight first-color text-12px text-uppercase">Paid</span>
                                                    @elseif($userOrderDetails[0]->status == 'Processing')
                                                        <span class="highlight fourth-color text-12px text-uppercase">Processing</span>
                                                    @elseif($userOrderDetails[0]->payment_status == 'Payment Error')
                                                        <span class="highlight third-color text-12px">Payment Error</span>
                                                    @elseif($userOrderDetails[0]->payment_status == 'Cancelled')
                                                        <span class="highlight black-color text-12px text-uppercase">Cancelled</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="clearfix margin-top"></div>
                            </div>
                        </div>

                        <div class="row">
                            @if( ! empty($userOrderDetails[0]->check_date))
                            <div class="col-md-12">
                                Check-in: <span class="text-black"><b>{{ date('dS M, Y', strtotime($userOrderDetails[0]->check_date->date_checkin)) }}</b></span>
                            </div>
                            @endif
                            @if( ! empty($userOrderDetails[0]->check_date))
                            <div class="col-md-12">
                                Check-out: <span class="text-black"><b>{{ date('dS M, Y', strtotime($userOrderDetails[0]->check_date->date_checkout)) }}</b></span>
                            </div>
                            @endif
                        </div>

                        <hr>

                        <div class="room-info">
                            <div class="room-description clearfix">
                                <h4> Guest Details </h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul>
                                        <li><b>Guest Name:</b> <?php echo $userOrderDetails[0]->billing_first_name;?> <?php echo $userOrderDetails[0]->billing_last_name;?> </li>
                                        <li><b>Telephone:</b> <?php echo $userOrderDetails[0]->billing_telephone;?></li>
                                        <li><b>Address: </b><?php echo $userOrderDetails[0]->billing_address;?>, <?php echo $userOrderDetails[0]->billing_post_code;?> <?php echo $userOrderDetails[0]->billing_city;?>, <?php echo $userOrderDetails[0]->billing_state_name;?>, <?php echo $userOrderDetails[0]->billing_country_name;?>.</li>
                                        <!-- <li><b>Email:</b> <?php echo $userOrderDetails[0]->billing_email;?></li> -->
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul>
                                        <li><b>Passport/NRIC:</b> </li>
                                        <!-- <li><b>Ship to:</b> <?php echo $userOrderDetails[0]->shipping_first_name;?> <?php echo $userOrderDetails[0]->shipping_last_name;?> </li> -->
                                        <li><b>Email:</b> <?php echo $userOrderDetails[0]->shipping_email;?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="room-info">
                            <div class="room-description clearfix">
                                <h4>Your Reservation Details </h4>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table checkout-table table-responsive">
                                <thead>
                                    <tr>
                                        <!-- <th class="table-title">Product Id</th> -->
                                        <th class="table-title">Types</th>
                                        <th class="table-title">Room Code</th>
                                        <th class="table-title">Unit Price / Night (Nett)</th>
                                        <th class="table-title">Quantity</th>
                                        {{-- <th class="table-title" style="text-align: right;">GST (RM)</th> --}}
                                        <th class="table-title">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $gst = 0;
                                ?>
                                    @foreach($orderTax->products as $orderProduct)
                                        <tr>
                                            <!-- <td class="item-code">{{ $orderProduct->id }}</td> -->
                                            <td class="item-name-col">
                                                <figure><a href="{{ url('web88cms/products/editProduct/' . $orderProduct->product_id) }}">
                                                    <img src="{{ asset('/public/admin/products/medium/' . $orderProduct->thumbnail_image_1) }}" alt="{{ $orderProduct->type }}" class="img-responsive">
                                                </a></figure>
                                                <header class="item-name">
                                                    <a href="{{ url('web88cms/products/editProduct/' . $orderProduct->product_id) }}">{{ $orderProduct->type }}</a>
                                                </header>
                                                <ul>
                                                    <li><i class="fa fa-bed"></i> <b>BED:</b> {{ $orderProduct->bed }} </li>
                                                    <li><i class="fa fa-user"></i> <b>GUEST:</b> {{ $orderProduct->guest }}</li>
                                                    <li><i class="fa fa-cutlery"></i> <b>MEAL: {{ $orderProduct->meal }}</b> </li>
                                                </ul>
                                                <ul>
                                                  @if($orderProduct->color_name)
                                                      <li>Color: {{ $orderProduct->color_name }}</li>
                                                  @endif

                                                  @if($orderProduct->event_type)
                                                      <li><i class="fa fa-gift text-red"></i> <span class="text-red"><b>For: {{ $orderProduct->event_type }}</b></span></li>
                                                  @endif
                                                </ul>

                                                @if (!is_null($orderProduct->pwp_price))
                                                <span class="pwp-item">PWP ITEM</span>
                                                @endif
                                            </td>
                                            <td class="item-price-col text-center">{{ $orderProduct->room_code }}</td>
                                            <td class="item-price-col">
                                            @if (is_null($orderProduct->pwp_price))
                                            {{ number_format($orderProduct->amount, 2) }}
                                            @else
                                            {{ number_format($orderProduct->pwp_price, 2) }}
                                            @endif
                                            </td>
                                            <td class="item-price-col text-center">{{ $orderProduct->quantity }}</td>
                                          {{--   <td class="item-price-col" style="text-align:right;padding-right:10px">{{ number_format($orderProduct->tax, 2) }}</td> --}}
                                            <td class="item-price-col">{{ number_format($orderProduct->subtotal, 2) }}</td>
                                            <?php
                                                $gst += (($orderProduct->tax) * $orderProduct->quantity);
                                            ?>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td class="checkout-table-title text-right" colspan="2"></td>
                                        <td colspan="2" class="checkout-table-title text-black">
                                            <span class="alignleft">SUBTOTAL:</span>
                                        </td>
                                        <td style="text-align:right; padding-right: 10px" class="checkout-table-price text-black">RM {{ number_format($orderTax->subtotal, 2) }}</td>
                                    </tr>

                                    <tr>
                                        <td class="checkout-table-title text-right" colspan="2"></td>
                                        <td class="text-danger checkout-table-title" colspan="2">
                                            <span class="alignleft">DISCOUNT:</span>
                                        </td>
                                        <td style="text-align:right; padding-right: 10px;" class="text-danger checkout-table-title">- RM {{ number_format($orderTax->discount, 2) }}</td>
                                    </tr>

                                    <tr>
                                        <td class="checkout-table-title text-right" colspan="2"></td>
                                        <td class="checkout-table-title text-black" colspan="2">
                                            <span class="alignleft">GST(6%):</span>
                                        </td>
                                        <!-- <td style="border: none;"></td> -->
                                        <td style="text-align:right; padding-right: 10px" class="checkout-table-title text-black">RM {{ number_format($orderTax->subtotal * 0.06, 2) }}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="checkout-table-title text-right" colspan="2"></td>
                                        <td  colspan="2" class="checkout-table-title">
                                            <span class="alignleft">
                                                <b>TOTAL:</b>
                                            </span>
                                        </td>
                                        <!-- <td style="text-align:right;padding-right:10px"><b>{{ number_format($orderTax->tax + $orderTax->shipping_charge * 0.06, 2) }}</b></td> -->
                                        <td  style="text-align:right; padding-right: 10px" class="checkout-total-price cart-total"><b>RM {{ number_format($orderTax->subtotal - $orderTax->discount + ($orderTax->subtotal * 0.06),2) }}</b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="hidden-md hidden-lg text-center extend-btn"><span class="extend-icon"><i class="fa fa-angle-down"></i></span></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="single-room list mobile-extend">
                        <div class="room-info">
                            <div class="room-description clearfix">
                                <h4 class="text-uppercase">Terms and Conditions</h4>
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


                                <div class="clearfix"></div>

                                <hr>

                                <div class="text-center">
                                    <a href="/dashboard" class="btn btn-default btn-sm">Back</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="email-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title" style="clear:none">Enter Email Address</h4>
         </div>
         <div class="modal-body">
           Enter an email address you want to email the invoice to.
           <input type="email" placeholder="Email Address" class="form-control" id="email-address">
           <p class="text-danger" id="email-error" style="display: none; margin-bottom: 10px;"></p>
         </div>

         <div class="modal-footer" style="text-align: right;">
           <button type="button" class="btn btn-default" data-dismiss="modal" style="font-size: 12px; padding: 10px">Close</button>
           <button type="button" class="btn btn-default" style="font-size: 12px; padding: 10px;" id="btn-send-email">Send</button>
         </div>


       </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
    </div>

@endsection


@section('scripts')

 <script type="text/javascript">


    jQuery(document).on('click', '#email-modal #btn-send-email', function(){
      btn = jQuery(this);
      orderDetails = ({!! json_encode($userOrderDetails) !!});
      orderProducts = {!! json_encode($orderProducts) !!};
      if(jQuery("#email-modal #email-address").val() == ""){
        jQuery("#email-modal #email-error").css('display', 'block');
        jQuery("#email-modal #email-error").html("Please enter an email address.");
      }else{
        jQuery("#email-modal #email-error").css('display', 'none');
        jQuery(this).attr('disabled', true);

        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
          type: "POST",
          url: "/user/sendOrderEmail",
          data: {invoice: {orderDetail: orderDetails, orderProducts: orderProducts}, email: jQuery("#email-modal #email-address").val()},
          dataType: 'JSON',


          success: function(response){
            if(response.success){
              jQuery('#email-success').css('display', 'block');
              jQuery('#email-success p').html(response.success + " to " + jQuery('#email-modal #email-address').val());
            }
            console.log(response);
          },

          complete:function(){
            jQuery('#email-modal').modal('toggle');
            // jQuery("#email-modal #email-address").val("");
            btn.removeAttr('disabled');

          }
        });


      }
    });
  </script>
@endsection
