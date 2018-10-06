<div style="padding:0px; margin:0px;">
    <table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" style="padding:10px; background:#fff;">
        <tr>
            <td width="550" align="left" valign="top" style="border-bottom:1px solid #ccc;"><img src="{{ asset('/public/front/images/index/logo.jpg') }}" /></td>
            <td width="450" align="right" valign="top" style="border-bottom:1px solid #ccc; padding:10px 0 20px; text-align:right;">
                <strong>RITZ GARDEN HOTEL</strong> <br />
                No.86 & 88,<br />Jalan Yang Kalsom, 30250 Ipoh, Perak, Malaysia.<br />
                Tel: (605) 242-7777<br />
                Fax: (605) 242-5845<br />
                sales@ritzgardenhotel.com<br />
            </td>
        </tr>
        <tr>
            <td width="550" align="left" valign="top" style="border-bottom:1px solid #ccc; padding:10px 0 20px;"><h2 style="padding:0px; margin:0px; color:#444645; font-size:32px;">Order Confirmation</h2></td>
            <td width="450" align="right" valign="top" style="border-bottom:1px solid #ccc; padding:10px 0 20px;"><h2 style="padding:0px; margin:0px; color:#444645; font-size:32px;">Order #{{ $order->order_id }}</h2></td>
        </tr>
        <tr>
        	<td colspan="2" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
        	<td align="left" valign="top" style="color:#646464; font-size:20px; padding:5px 0; margin:0px;"><strong>Billed To:</strong></td>
        	<!-- <td align="right" valign="top" style="color:#646464; font-size:20px; padding:5px 0; margin:0px;"><strong>Shipped To:</strong></td> -->
                <td align="right" valign="top" style="color:#646464; font-size:20px; padding:5px 0; margin:0px;"><h4 class="block-heading pull-right"><B style"color:#2EFE2E;"><font color="green">Booking ID:</font></B> <span class="text-red">{{$bookid}}</span></h4></td>
        </tr>
        <tr>
        	<td align="left" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ $order->billing_first_name . ' ' . $order->billing_last_name }}</td>
        	<!-- <td align="right" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">$order->shipping_first_name . ' ' . $order->shipping_last_name</td> -->
        </tr>
        <tr>
        	<td align="left" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ $order->billing_address }},<br/> {{ $order->billing_post_code }} {{ $order->billing_city }}, <br/>{{ $order->billing_state_name }}, {{ $order->billing_country_name }}.</td>
        	<!-- <td align="right" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;"> $order->shipping_address ,<br/>  $order->shipping_post_code   $order->shipping_city , <br/> $order->shipping_state_name ,  $order->shipping_country_name .</td> -->
        </tr>
        <tr>
        	<td align="left" valign="top">&nbsp;</td>
        	<td align="right" valign="top">&nbsp;</td>
        </tr>
        <tr>
        	<td align="left" valign="top" style="color:#646464; font-size:20px; padding:5px 0; margin:0px;"><strong>Order Status:</strong></td>
        	<td align="right" valign="top" style="color:#646464; font-size:20px; padding:5px 0; margin:0px;"><strong>Payment Status:</strong></td>
        </tr>
        <tr>
        	<td align="left" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ $order->status }}</td>
        	<td align="right" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ $order->payment_status }}</td>
        </tr>

        <tr>
        	<td align="left" valign="top" style="color:#646464; font-size:20px; padding:5px 0; margin:0px;"><strong>Payment Method:</strong></td>
        	<td align="right" valign="top" style="color:#646464; font-size:20px; padding:5px 0; margin:0px;"><strong>Order Date:</strong></td>
        </tr>
        <tr>
        	<td align="left" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ $order->payment_method }}</td>
        	<td align="right" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ date('dS M, Y', strtotime($order->createdate)) }}</td>
        </tr>
        <tr>
        	<td align="left" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">{{ $order->billing_email }}</td>
        	<td align="right" valign="top" style="color:#646464; font-size:14px; padding:3px 0; margin:0px;">&nbsp;</td>
        </tr>
        <tr>
        	<td colspan="2" align="left" valign="top" style=" padding:0px 0 0; margin:0 0 0px;"><h2 style="padding:10px 0; margin:0px; color:#444645; font-size:22px;">Order summary</h2></td>
        </tr>

<div style="padding:0px; margin:0px;">
  <table class="table checkout-table" style='border: 1px solid #e0e0e0;margin-bottom: 0;width: 100%;max-width: 100%;margin: 0 0 1.5em;background-color: transparent;border-spacing: 0;border-collapse: collapse;display: table;background-color: white; font-family: "Poppins", sans-serif;font-size: 15px;font-weight: 400;line-height: 1.45em;color: #787878;-webkit-font-smoothing: antialiased;'>
      <thead>
          <tr>
              <th class="table-title" style='font: 700 16px/22px "Montserrat", sans-serif;color: #4d4d4d;font-weight: 700;text-transform: uppercase;padding: 15px;border-color: transparent;border-right: 1px solid #e0e0e0;background: #fafafa; border-bottom: 1px solid #e0e0e0;text-align: center;vertical-align: bottom;border-collapse: collapse;'>Types</th>
              <th class="table-title" style='font: 700 16px/22px "Montserrat", sans-serif;color: #4d4d4d;font-weight: 700;text-transform: uppercase;padding: 15px;border-color: transparent;border-right: 1px solid #e0e0e0;background: #fafafa; border-bottom: 1px solid #e0e0e0;text-align: center;vertical-align: bottom;border-collapse: collapse;'>Room Code</th>
              <th class="table-title" style='font: 700 16px/22px "Montserrat", sans-serif;color: #4d4d4d;font-weight: 700;text-transform: uppercase;padding: 15px;border-color: transparent;border-right: 1px solid #e0e0e0;background: #fafafa; border-bottom: 1px solid #e0e0e0;text-align: center;vertical-align: bottom;border-collapse: collapse;'>Unit Price / night (nett)</th>
              <th class="table-title" style='font: 700 16px/22px "Montserrat", sans-serif;color: #4d4d4d;font-weight: 700;text-transform: uppercase;padding: 15px;border-color: transparent;border-right: 1px solid #e0e0e0;background: #fafafa; border-bottom: 1px solid #e0e0e0;text-align: center;vertical-align: bottom;border-collapse: collapse;'>Quantity</th>
              <th class="table-title" style='font: 700 16px/22px "Montserrat", sans-serif;color: #4d4d4d;font-weight: 700;text-transform: uppercase;padding: 15px;border-color: transparent;border-right: 1px solid #e0e0e0;background: #fafafa; border-bottom: 1px solid #e0e0e0;text-align: center;vertical-align: bottom;border-collapse: collapse;'>SubTotal</th>
          </tr>
      </thead>
      <tbody>
        <?php
         // cart info
         $total_amount = 0;
         echo '<pre>';
         print_r($order_to_products);
         
         foreach ($order_to_products as $key => $value) {

             // $total_amount += $value->sale_price * $value->quantity;
             $total_amount += $value->amount;
             $img = asset('/public/admin/products/medium/'.$value->thumbnail_image_1);
             ?>
             <tr>
                 <td class="item-name-col" style='text-transform: uppercase;padding: 5px;border-top: 1px solid #e0e0e0!important; border-right: 1px solid #e0e0e0!important;vertical-align: top;width: 390px;'>
                  <div style="float:left">
                     <figure>
                         <a href="#room-details"><img src="{{ $img }}" alt="Deluxe Room" class="img-responsive" style="display: inline-block; max-width: 100%; height: auto; width: 100px;height:87px; margin: auto; vertical-align: middle; border: 0;"></a>
                     </figure>
                   </div>
                     <div style="float:left; margin-left: 10px; margin-top: -5px;">
                     <header style='font-size: 18px;color: #333;line-height: 18px;font-weight: 600;margin-bottom: 15px;text-align: left;'>
                         <a href="{{url('rooms-suites/show')}}/<?= $value->product_id ?>" target="_blank" style="color: #78A994;"><?= $value->type ?></a>
                     </header>
                     <ul style="font-size:15px; margin-top:0px;  margin-left:-20px;">
                         <li><b>BED:</b> <span style="text-transform: lowercase;"><?= $value->bed ?> </span></li>
                         <li><b>GUEST:</b> <span style="text-transform: lowercase;"><?= $value->guest ?></span></li>
                         <li><b>MEAL:</b> <span style="text-transform: lowercase;"><?= $value->meal ?></span></li>
                     </ul>
                    </div>
                 </td>

                 <td class="item-price-col" style='font: 500 18px/20px "Poppins", sans-serif;text-transform: uppercase;padding: 5px;border-top: 1px solid #e0e0e0!important; border-right: 1px solid #e0e0e0!important;vertical-align: top; font-size:15px; text-align:center;'><?= $value->room_code ?></td>
                 <td class="item-price-col" style='font: 500 18px/20px "Poppins", sans-serif;text-transform: uppercase;padding: 5px;border-top: 1px solid #e0e0e0!important; border-right: 1px solid #e0e0e0!important;vertical-align: top; font-size:15px; text-align:center;'><span class="item-price-special">RM <?= /*$value->sale_price*/ number_format((float)$value->amount, 2, '.', '') ?><span class="sub-price"></span></span></td>
                 <td style='font: 500 18px/20px "Poppins", sans-serif;text-transform: uppercase;padding: 5px;border-top: 1px solid #e0e0e0!important; border-right: 1px solid #e0e0e0!important;vertical-align: top; font-size:15px; text-align:center;'><?= $value->quantity ?></td>
                 <td class="item-total-col" style='font: 500 18px/20px "Poppins", sans-serif;text-transform: uppercase;padding: 5px;border-top: 1px solid #e0e0e0!important; border-right: 1px solid #e0e0e0!important;vertical-align: top; font-size:15px; text-align:center;'><span class="item-price-special">RM <?= /*$value->sale_price * $value->quantity*/ number_format((float)$value->amount, 2, '.', '') ?><span class="sub-price"></span></span>
                 </td>
             </tr>
         <?php } ?>
          <tr>
              <td class="checkout-table-title text-right" colspan="3" style='font: 500 18px/20px "Poppins", sans-serif;text-transform: uppercase;padding: 5px;border-top: 1px solid #e0e0e0!important; border-right: 1px solid #e0e0e0!important;vertical-align: top;'></td>
              <td class="checkout-table-title text-black" style='font: 500 18px/20px "Poppins", sans-serif;text-transform: uppercase;padding: 5px;border-top: 1px solid #e0e0e0!important; border-right: 1px solid #e0e0e0!important;vertical-align: top;'><span class="alignleft">Subtotal</span></td>
              <td class="checkout-table-price text-black" style='font: 500 18px/20px "Poppins", sans-serif;text-transform: uppercase;padding: 5px;border-top: 1px solid #e0e0e0!important; border-right: 1px solid #e0e0e0!important;vertical-align: top;'>RM <?= number_format((float)$total_amount, 2, '.', '') ?><span class="sub-price"></span></span></td>
          </tr>
          <tr>
              <td class="checkout-table-title text-right" colspan="3" style='font: 500 18px/20px "Poppins", sans-serif;text-transform: uppercase;padding: 5px;border-top: 1px solid #e0e0e0!important; border-right: 1px solid #e0e0e0!important;vertical-align: top;'></td>
              <td class="checkout-table-title text-danger" style='font: 500 18px/20px "Poppins", sans-serif;text-transform: uppercase;padding: 5px;border-top: 1px solid #e0e0e0!important; border-right: 1px solid #e0e0e0!important;vertical-align: top;'><span class="alignleft" style="color:#a94442;">Discount @if(isset($promo->promo_code)) ({{$promo->promo_code}}) @endif<span class="text-12px" style="color:#a94442;"></span></span></span> </td>
              <?php
              $discount_price = $discount;
              $promo_d = isset($promo->discount) ? ($total_amount - $discount_price - (($total_amount - $discount_price) / 100 * $promo->discount)) : $total_amount - $discount_price;
              $p_disc = isset($promo->discount) ? $promo->discount : 0;
              ?>
              <td class="checkout-table-price text-danger" style='font: 500 18px/20px "Poppins", sans-serif;text-transform: uppercase;padding: 5px;border-top: 1px solid #e0e0e0!important; border-right: 1px solid #e0e0e0!important;vertical-align: top; color:#a94442;"'>- RM <?= (($total_amount - $discount_price) / 100 * $p_disc) ?><span class="sub-price" style="color:#a94442;">.00</span></td>
          </tr>

          <tr>
              <td class="checkout-table-title text-right" colspan="3" style='font: 500 18px/20px "Poppins", sans-serif;text-transform: uppercase;padding: 5px;border-top: 1px solid #e0e0e0!important; border-right: 1px solid #e0e0e0!important;vertical-align: top;'></td>
              <td class="checkout-table-title text-black" style='font: 500 18px/20px "Poppins", sans-serif;text-transform: uppercase;padding: 5px;border-top: 1px solid #e0e0e0!important; border-right: 1px solid #e0e0e0!important;vertical-align: top;'><span class="alignleft">SST (6%)</span></td>
              <td class="checkout-table-price text-black" style='font: 500 18px/20px "Poppins", sans-serif;text-transform: uppercase;padding: 5px;border-top: 1px solid #e0e0e0!important; border-right: 1px solid #e0e0e0!important;vertical-align: top;'><span >RM {{ number_format($total_amount/100*6,2) }}<span class="sub-price"></span></span></td>
          </tr>
      </tbody>
      <tfoot>
        <tr>
             <td class="checkout-table-title text-right" colspan=" 3"style='font: 500 18px/20px "Poppins", sans-serif;text-transform: uppercase;padding: 5px;border-top: 1px solid #e0e0e0!important; border-right: 1px solid #e0e0e0!important;vertical-align: top;'></td>
             <td class="checkout-total-title" style='font: 500 18px/20px "Poppins", sans-serif;text-transform: uppercase;padding: 5px;border-top: 1px solid #e0e0e0!important; border-right: 1px solid #e0e0e0!important;vertical-align: top;'><span class="alignleft"><b>TOTAL</b></span></td>
             <td class="checkout-total-price cart-total" style='font: 500 18px/20px "Poppins", sans-serif;text-transform: uppercase;padding: 5px;border-top: 1px solid #e0e0e0!important; border-right: 1px solid #e0e0e0!important;vertical-align: top; color: #78A994;'><b>RM <?= number_format($promo_d + ($total_amount / 100 * 6), 2) ?><span class="sub-price"></span></b></td>
          </tr>
      </tfoot>
  </table>


</div>
