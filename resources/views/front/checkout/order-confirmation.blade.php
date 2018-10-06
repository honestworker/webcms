@extends('front/templateFront')

@section('content')

   <div class="room-single-area">
     <div class="container">
       <div class="row">
         <div class="col-md-12 col-full-width">
           <div class="section-title-area text-center">
             <h2 class="section-title">Reservation Successful</h2>
             <p class="section-title-dec">Thank you for your payment.</p>
           </div><!--/.section-title-area-->
         </div><!--/.col-md-8-->
       </div><!--/.row-->

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

                   <div class="alert alert-success margin-top">
                     <i class="fa fa-smile-o"></i> <strong>Thank you!</strong> Your order has been received.
                   </div><!-- End .alert-danger -->
                   <p>Please keep your <strong>Booking Reference ID</strong> as the reference for tracking purpose. Please also print out a copy of this order confirmation as a purchase proof. If you have any query for the rooms, please contact us at <span class="text-red">(05) 242-7777</strong></span> or Email to <strong><a href="mailto:sales@ritzgardenhotel.com">sales@ritzgardenhotel.com</a></strong></p>
                   <div class="margin-top"></div>
               </div><!--/.col-md-12-->
           </div><!--/.row-->


           <div class="row">
                 <div class="col-md-6">
                     Check-in: <span class="text-black"><b>{{ date('jS M Y',strtotime($cart['arrival'])) }}</b></span><br/>
                       Check-out: <span class="text-black"><b>{{ date('jS M Y',strtotime($cart['departure'])) }}</b></span><br/>
                   Rooms: <span class="text-black"><b><?= $cart['rooms']?></b></span><br/>
                   Adults: <span class="text-black"><b><?= $cart['adults']?></b></span><br/>
                   Children: <span class="text-black"><b><?= $cart['children']?></b></span><br/>
                   </div><!--/.col-md-6-->

                   <div class="col-md-6">
                     Booking Reference ID: <span class="text-black"><b>#{{$invoice['booking_reference_id']}}</b></span><br/>
                       Booking Date:
                       <span class="text-black"><b>
                         <!-- 13th Jul, 2017 -->
                         {{ date('jS M Y',strtotime($invoice['orderInfo']['createdate'])) }}

                       </b></span>
                   </div><!--/.col-md-6-->
               </div><!--/.row-->

           <hr>

           <div class="room-info">
             <div class="room-description clearfix">
               <h4>Guest Details</h4>
               </div>


               <div class="row">
                 <div class="col-md-6">
                       <span class="text-black"><b>Guest Name:</b></span> {{ $invoice['orderInfo']['billing_last_name'] }} {{ $invoice['orderInfo']['billing_first_name']}}<br/>
                       <span class="text-black"><b>Telephone: </b></span> {{ $invoice['orderInfo']['shipping_telephone'] }}<br/>
                       <span class="text-black"><b>Address: </b></span>
                       {{$invoice['orderInfo']['billing_address']}}, {{ $invoice['orderInfo']['billing_post_code'] }} {{ $invoice['orderInfo']['billing_city'] }},  {{$invoice['orderInfo']['state'][0]->name }},
                       {{ $invoice['orderInfo']['country'][0]->name }}.<br/>
                   </div><!--/.col-md-6-->

                   <div class="col-md-6">
                       <span class="text-black"><b>Passport/NRIC: </b></span><br/>
                       <span class="text-black"><b>Email: </b></span> {{ $invoice['orderInfo']['shipping_email'] }}
                   </div><!--/.col-md-6-->
               </div><!--/.row-->

           </div>



           <div class="room-info">
             <div class="room-description clearfix">
               <h4>Your Reservation Details</h4>
               </div>
           </div>


           <div class="table-responsive">


                               <table class="table checkout-table">
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
                                     <?php
                                      // cart info
                                      $total_amount = 0;
                                      foreach ($cart['product'] as $key => $value) {
                                          $total_amount += $value['sale_price']; // * $value['qty'];
                                          ?>
                                          <tr>
                                              <td class="item-name-col">

                                                  <figure>
                                                      <a href="#room-details"><img src="/public/admin/products/medium/<?= $value['thumbnail_image_1'] ?>" alt="Deluxe Room" class="img-responsive"></a></figure>
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
                                              <td>{!! $value['priceByDates'] !!}</td>
                                              <!-- <td class="item-price-col"><span class="item-price-special">RM <?= number_format((float)$value['sale_price'], 2, '.', '') ?><span class="sub-price"></span></span></td> -->
                                              <!-- <td><?= $value['qty'] ?></td> -->
                                              <td class="item-total-col"><span class="item-price-special">RM <?= number_format((float)($value['sale_price']*$cart['rooms']), 2, '.', '') ?><span class="sub-price"></span></span>
                                              </td>
                                          </tr>
                                      <?php } 
                                      $total_amount *= $cart['rooms'];
                                      ?>
                                       <tr>
                                           <td class="checkout-table-title text-right" colspan="2"></td>
                                           <td class="checkout-table-title text-black"><span class="alignleft">Subtotal</span></td>
                                           <td class="checkout-table-price text-black">RM <?= number_format((float)$total_amount, 2, '.', '') ?><span class="sub-price"></span></span></td>
                                       </tr>
                                       <tr>
                                           <td class="checkout-table-title text-right" colspan="2"></td>
                                           <td class="checkout-table-title text-danger"><span class="alignleft" style="text-align: start;">Discount @if(isset($promo->promo_code)) ({{$promo->promo_code}}) @endif<span class="text-12px"></span></span></span> </td>
                                           <?php
                                           
                                            $finalAmount = ($total_amount - $cart['discount_amount']) + $cart['tax_amount'];
                                            ?> 
                                           <td class="checkout-table-price text-danger">- RM {{ number_format($cart['discount_amount'],2) }}<span class="sub-price"></span></td>
                                       </tr>

                                       <tr>
                                           <td class="checkout-table-title text-right" colspan="2"></td>
                                           <td class="checkout-table-title text-black"><span class="alignleft">SST ({{ $cart['tax_rate'] }}%)</span></td>
                                           <td class="checkout-table-price text-black"><span >RM {{ number_format($cart['tax_amount'],2) }}<span class="sub-price"></span></span></td>
                                       </tr>
                                   </tbody>
                                   <tfoot>
                                     <tr>
                                          <td class="checkout-table-title text-right" colspan="2"></td>
                                          <td class="checkout-total-title"><span class="alignleft"><b>TOTAL</b></span></td>
                                          <td class="checkout-total-price cart-total"><b>RM <?= number_format($finalAmount, 2) ?><span class="sub-price"></span></b></td>
                                       </tr>
                                   </tfoot>
                               </table>
                           </div><!-- end table responsive -->


     </div>


           <div class="hidden-md hidden-lg text-center extend-btn"><span class="extend-icon"><i class="fa fa-angle-down"></i></span></div>
         </div><!--/.col-md-12-->

       </div><!--/.row-->


       <div class="row">

           <div class="col-md-12">

             <div class="single-room list mobile-extend">
                 <div class="room-info">

                   <div class="room-description clearfix">

                   <h4>Terms and Conditions</h4>

                   <ul class="list-group-item">
                   	  <li>- All rates are inclusive of breakfast.</li>
                      <li>- Connecting Room is available upon request and subject to availability. </li>
                      <li>- Extra bed at RM55 Nett per night inclusive of 1 breakfast.</li>
                      <li>- Late check-out, day use rate will apply. </li>
                      <li>- Full day rate will apply, if check out time exceeds 6pm. </li>
                      <li>- Long term, group and corporate rate available upon request. </li>
                      <li>- All major credit cards accepted. </li>
                      <li>- Rates are subject to change without prior notice. </li>
                      <li>- Check-in time: 3:00 pm.</li>
                      <li>- Check-out time: 12:00 noon.</li>
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
   </div><!--/.room-grid-area-->

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
      invoice = ({!! json_encode($invoice) !!});
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
          url: "/checkout/sendEmail",
          data: {invoice: invoice, email: jQuery("#email-modal #email-address").val()},
          dataType: 'JSON',


          success: function(response){
            if(response.success){
              jQuery('#email-success').css('display', 'block');
              jQuery('#email-success p').html(response.success + " to " + jQuery('#email-modal #email-address').val());
            }
          },

          complete:function(){
            jQuery('#email-modal').modal('toggle');
            jQuery("#email-modal #email-address").val("");
            btn.removeAttr('disabled');

          }
        });


      }
    });
  </script>
@endsection
