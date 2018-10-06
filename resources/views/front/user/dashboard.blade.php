@extends('front/templateFront')

@section('content')

<div class="room-single-area">
      <div class="container">
      	<div class="row">
          <div class="col-md-12 col-full-width">
            <div class="section-title-area text-center">
              <h2 class="section-title">Dashboard</h2>
              <p class="section-title-dec">View &amp; edit your account information and track of your past bookings.</p>
            </div><!--/.section-title-area-->
          </div><!--/.col-md-8-->
        </div><!--/.row-->



        <div class="row">
        	<div class="col-md-3 col-sm-12 col-xs-12">

            	<div class="room-comments-area">
                  <div id="respond" class="comment-respond box-radius">
                    <div class="row">
                      <div class="col-md-12">
                        <h4 class="comment-reply-title">My Account</h4><!--/.comment-reply-title-->
                      </div><!--/.col-md-12-->
                    </div><!--/.row-->

                   <div class="row">
                      <div class="col-md-12">

                         <ul class="margin-top">
                            <li><i class="fa fa-check-circle"></i> <a href="dashboard">Account Dashboard</a></li>
                            <li><i class="fa fa-check-circle"></i> <a href="accountedit">Account Information</a></li>
                            <li><i class="fa fa-check-circle"></i> <a href="orderhistory">My Bookings</a></li>
                         </ul>

                      </div><!--/.col-md-12-->
                    </div><!--/.row-->
                  </div><!--/.comment-respond-->
                </div>

            </div><!--/.col-md-6-->

            <div class="room-single-content col-md-9 col-sm-12 col-xs-12">

            	<div class="single-room list mobile-extend">

                    <div class="row">
                      <div class="col-md-12">
                         <div class="alert alert-success">
                         	 <strong>Hello
                                    {{ Session::get('userFirstName') }} {{ Session::get('userLastName') }}! </strong>
                                    <p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. You can view your booking history or edit your information.</p>


                               @if(Session::has('success'))
                                		<div class="alert-box success">
                                    		<p>{{ Session::get('success') }}</p>
                                		</div>
                            		@endif

                                    </div>









                            <div class="room-description clearfix">
                                <h4 class="pull-left">Recent Bookings</h4>

   <a href="{{ url('orderhistory') }}" class="pull-right"><button type="button" class="btn btn-default btn-xs">VIEW ALL <i class="fa fa-list"></i></button></a>
                               <?php /*?> <a href="{{ url('orderhistory') }}" class="pull-right"><button type="button" class="btn btn-custom btn-xs">VIEW ALL <i class="fa fa-list"></i></button></a><?php */?>
                            </div>


                         <div class="clearfix"></div>
    					 <div class="table">



                         @if(count($userOrders)>0)
                                    <table class="table cart-table">
                                        <thead>
                                            <tr>
                                               <th class="table-title">Booking ID</th> 
                                                <th class="table-title">Payment Reference No.</th>
                                                <th class="table-title">Date</th>
                                                <th class="table-title">Order Total</th>
                                                <th class="table-title">Payment</th>
                                                <th class="table-title">Status</th>
                                                <th class="table-title">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($userOrders as $order){?>
                                            
                                           
                                            <?php }?>
                                            @foreach($userOrders as $order)
                                                <?php
                                                    $ordersModel = new App\Http\Models\Admin\Orders();
                                                    $orderTax = $ordersModel->getOrderTax($order->id);
                                                ?>


                                                <tr>
                                                  <td><a href="orderdetails/{{$order->id}}">#{{$order->id}}</a></td>
                                                    <td><a href="orderdetails/{{ $order->id}}">{{ $order->order_id}}</a></td>
                                                    <td>{{ date('dS M, Y', strtotime($order->modifydate))}}</td>
                                                    <td> RM {{ number_format($order->totalPrice,2) }}</td>
                                                   <!--  <td> RM {{ number_format($orderTax->subtotal - $orderTax->discount + ($orderTax->subtotal * 0.06),2) }}</td> -->
                                                    <td>{{ $order->payment_method}}</td>
                                                    <td>
                                                         @if($order->payment_status == 'Paid')
                                                            <span class="highlight first-color text-12px">Paid</span>
                                                        @elseif($order->status == 'Processing')
                                                            <span class="highlight fourth-color text-12px">Processing</span>
                                                        @elseif($order->payment_status == 'Payment Error')
                                                            <span class="highlight third-color text-12px">Payment Error</span>
                                                        @elseif($order->payment_status == 'Cancelled')
                                                            <span class="highlight black-color text-12px">Cancelled</span>
                                                        @endif
                                                     </td>
                                                    <td><a href="orderdetails/{{ $order->id}}"><button type="button" class="btn btn-danger btn-xs">DETAILS <i class="fa fa-search"></i></button></a></td>
                                                </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    	<p align="center"><strong> No Order Found.</strong></p>
                                    @endif
                               </div><!--/.table responsive-->
                               <!-- end recent orders -->

                               <div class="clearfix margin-top"></div>

                               <!-- account info start -->
                                <div class="row">
                                	<div class="col-md-12">
                                       <div class="room-description clearfix">
                                           <h4 class="pull-left">Account Information</h4>
                                       </div>

                                        <div class="row">
                                        	<div class="col-md-6">
                                            	<div class="room-description clearfix">
                                                	<h4 class="pull-left">My Personal Information</h4>
                                            	</div>
                                               <p>{{ Session::get('userFirstName') }} {{ Session::get('userLastName') }} <br/>
                                                {{ Session::get('userEmail') }}</p>
                                                <a href="{{ url('accountedit') }}"><button type="button" class="btn btn-danger btn-xs">EDIT &nbsp;<i class="fa fa-pencil"></i></button></a>
                                                <a href="{{ url('accountedit') }}"><button type="button" class="btn btn-info btn-xs">CHANGE PASSWORD &nbsp;<i class="fa fa-lock"></i></button></a>


                                            </div>
                                            <!-- end col-md-6 -->

                                            <div class="col-md-6">
                                                <div class="room-description clearfix">
                                                   <h4 class="pull-left">Newsletter Subscription</h4>
                                                </div>
                                                 @if($newsletterStatus==1)
                                                	<p>You are currently subscribed to Ritz Garden Hotel's newsletter.</p>
                                                @else
                                                	<p>You are not subscribed to Ritz Garden Hotel's newsletter.</p>
                                                @endif
                                                <a href="#" data-toggle="modal" data-target="#modal-newsletter-subscription"><button type="button" class="btn btn-danger btn-xs">EDIT &nbsp;<i class="fa fa-pencil"></i></button></a>


                                            </div>
                                            <!-- end col-md-6 -->


                                            <!-- Modal newsletter subscription start -->
                                            <div class="modal fade" id="modal-newsletter-subscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                                                <form id="login-form-2" name="newsletter" method="post" action="newsletter">
                                                    <input type="hidden" name="userEmail" value="{{ $userDetail[0]->email}}" />
                                                    <input type="hidden" name="userName" value="{{ $userDetail[0]->first_name}} {{ $userDetail[0]->last_name}}" />
                                        			<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                                                	<div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                            <h4 class="modal-title" id="myModalLabel2">Newsletter Subscription</h4>
                                                            </div><!-- End .modal-header -->
                                                            <div class="modal-body clearfix">
                                                                <div class="input-group custom-checkbox">
                                                                    <input type="radio" name="nwslttr" value="subscribe" @if($newsletterStatus==0) 'checked="checked"' @endif> <span class="radio-container"><i class="fa fa-radio"></i></span>Yes, I would like to subscribe to Ritz Garden Hotel's newsletter.</div>
                                                                <div class="input-group custom-checkbox">
                                                                    <input type="radio" name="nwslttr" value="unsubscribe" @if($newsletterStatus==1) checked="checked" @endif> <span class="radio-container"><i class="fa fa-radio"></i></span>Please unsubscribe me.</div>


                                                            </div><!-- End .modal-body -->
                                                            <div class="modal-footer">
                                                                <button class="btn btn-custom-2" onclick="newsletter.submit();">SAVE</button>
                                                                <button type="button" class="btn btn-custom" data-dismiss="modal">CLOSE</button>
                                                            </div><!-- End .modal-footer -->
                                                        </div><!-- End .modal-content -->
                                                    </div><!-- End .modal-dialog -->
                                                </form>
                                            </div><!-- End .modal newsletter subscription -->
                                        </div>
                                        <!-- end row -->


                                    </div>
                                    <!-- end col-md-12 -->
                                </div>
                                <!-- end row -->
                                 <div class="clearfix margin-top"></div>


                               <!--billing account info start -->
                            {{-- div class="row">
                            	<div class="col-md-12">
                                   <div class="room-description clearfix">
                                       <h4 class="pull-left">Billing &amp; Shipping Address</h4>
                                   </div>

                                    <div class="row">
                                    	<div class="col-md-6">
                                        	<div class="room-description clearfix">
                                            	<h4 class="pull-left">Default Billing Address</h4>
                                            </div>
                                           <p><strong>{{$userDetail[0]->billing_first_name}} {{ $userDetail[0]->billing_last_name}}</strong></p>
                                            <p>{{ $userDetail[0]->billing_address}} <br/>{{ $userDetail[0]->billing_post_code}} {{ $userDetail[0]->billing_city}}, {{ $userDetail[0]->billing_state_name}}, <br/>{{ $userDetail[0]->billing_country_name}}.</p>
                                            <p><strong>Email:</strong> {{ $userDetail[0]->billing_email}}</p>
                                            <p><strong>Telephone:</strong> {{ $userDetail[0]->billing_telephone}}</p>
                                            <a href="{{ url('billingaddress') }}"><button type="button" class="btn btn-danger btn-xs">EDIT &nbsp;<i class="fa fa-pencil"></i></button></a>
                                        </div>

                                        <!-- end col-md-6 -->

                                        <div class="col-md-6">
                                            <div class="room-description clearfix">
                                               <h4 class="pull-left">Default Shipping Address</h4>
                                            </div>
                                             <p><strong>{{ $userDetail[0]->shipping_first_name}} {{ $userDetail[0]->shipping_last_name}}</strong></p>
                                            <p>{{ $userDetail[0]->shipping_address}} <br/>{{ $userDetail[0]->shipping_post_code}} {{ $userDetail[0]->shipping_city}}, {{ $userDetail[0]->shipping_state_name}}, <br/>{{ $userDetail[0]->shipping_country_name}}.</p>
                                            <p><strong>Email:</strong> {{ $userDetail[0]->shipping_email}}</p>
                                            <p><strong>Telephone:</strong> {{ $userDetail[0]->shipping_telephone}}</p>
                                            <a href="{{ url('shippingaddress') }}"><button type="button" class="btn btn-danger btn-xs">EDIT &nbsp;<i class="fa fa-pencil"></i></button></a>
                                        </div>
                                        <!-- end col-md-6 -->
                                    </div>
                                    <!-- end row -->

                                </div>
                                    <!-- end col-md-12 -->
                             </div> --}}
                                <!-- end row -->


                                <!-- end account info -->


                      </div><!--/.col-md-12-->
                    </div><!--/.row-->

                </div>

            </div><!--/.col-md-6-->

        </div><!--/.row-->

         <br/>

      </div><!--/.container-->
    </div>


<section data-jarallax="{&quot;speed&quot;: 0.3, &quot;imgSrc&quot;: &quot;{{ asset('/public/front/images/parallax/bg_hotel_services.jpg')}}&quot;}" class="hotel-service-section jarallax">
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
                      <img src="{{asset('/public/front/images/hotel_services/icon_tour_desk.png')}}" alt="Tour Desk">
                    </div>
                    <h5>Tour Desk</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->
                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                      <img src="{{asset('/public/front/images/hotel_services/icon_reception.png')}}" alt="24 hour Reception">
                    </div>
                    <h5>24 hour Reception</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->
                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                    	<img src="{{asset('/public/front/images/hotel_services/icon_wifi.png')}}" alt="WiFi">
                    </div>
                    <h5>WiFi Internet</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->
                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                    	<img src="{{asset('/public/front/images/hotel_services/icon_elevator.png')}}" alt="Lift/Elevator">
                    </div>
                    <h5>Lift / Elevator</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->

                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                    	<img src="{{asset('/public/front/images/hotel_services/icon_no-smoking.png')}}" alt="Non-Smoking Room">
                    </div>
                    <h5>Non-Smoking Rooms</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->

                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                    	<img src="{{asset('/public/front/images/hotel_services/icon_laundry.png')}}" alt="Guest Laundry">
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










        <?php /*?><section id="content">
        	<div id="page-header">
                <h1>Welcome Members!</h1>
                <div class="sm-margin"></div>
                <h2>The TBM Shopping Experience</h2>
                <p class="line">&nbsp;</p>

            </div>
            <div class="md-margin2x"></div>
            <div class="container">
                <div class="row">
                	<div class="col-md-12">
						<div class="hero-unit">
                            <h2>My Dashboard</h2>
                            <span class="small-bottom-border big"></span>
                            <p>View &amp; edit your account information and track of your past orders.</p>
                        </div>
                        <div class="md-margin2x"></div>

                        <div class="row">

                            <aside class="col-md-3 col-sm-4 col-xs-12 sidebar">
                            	<div class="widget">
                                    <div class="panel-group custom-accordion sm-accordion" id="category-filter">

                                        <div class="panel">
                                            <div class="accordion-header">
                                                <div class="accordion-title"><span>My Account</span>
                                                </div>
                                                <a class="accordion-btn opened" data-toggle="collapse" data-target="#category-list-1"></a>
                                            </div>
                                            <div id="category-list-1">
                                                <div class="panel-body">
                                                	<?= $user_left; ?>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <!-- end widget -->

                            </aside>

                            <div class="col-md-9 col-sm-9 col-xs-12">
                            	<div class="alert alert-success">
                                    <strong>Hello
                                    {{ Session::get('userFirstName') }} {{ Session::get('userLastName') }},
                                    </strong>
                                   	<!-- <p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. You can view your order history or edit your information.</p>
                               		-->
                               		@if(Session::has('success'))
                                		<div class="alert-box success">
                                    		<p>{{ Session::get('success') }}</p>
                                		</div>
                            		@endif
                                </div>
                                <div class="sm-margin"></div>


                                <!-- recent orders start -->
                                <header class="content-title">
                                     <div class="title-bg">
                                         <h3 class="title">Recent Orders</h3>
                                     </div><!-- End .title-bg -->
                                </header>
 <a href="{{ url('orderhistory') }}" class="pull-right"><button type="button" class="btn btn-default btn-xs">VIEW ALL <i class="fa fa-list"></i></button></a>


                                <div class="md-margin2x"></div>
                                	<?php  if(count($userOrders)>0){?>
                                    <table class="table cart-table">
                                        <thead>
                                            <tr>
                                                <th class="table-title">Order #</th>
                                                <th class="table-title">Date</th>
                                                <th class="table-title">Order Total</th>
                                                <th class="table-title">Payment</th>
                                                <th class="table-title">Status</th>
                                                <th class="table-title">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($userOrders as $order){?>
                                            <?php
                                                $ordersModel = new App\Http\Models\Admin\Orders();
                                                $orderTax = $ordersModel->getOrderTax($order->id);
                                            //dd($order, $orderTax);
                                            ?>
                                            <tr>
                                                <td><a href="orderdetails/<?php echo $order->id;?>"><?php echo $order->order_id;?></a></td>
                                                <td><?php echo date('dS M, Y', strtotime($order->modifydate));?></td>
                                                <td>RM <?php echo str_replace('.', '.<span class="sub-price">', number_format($orderTax->total + $orderTax->shipping_charge * 1.06, 2)) . '</span>';?></td>
                                                <td><?php echo $order->payment_method;?></td>
                                                <td>
                                                	 @if($order->payment_status == 'Paid')
	                                                    <span class="highlight first-color text-12px">Paid</span>
                                                    @elseif($order->status == 'Processing')
    	                                                <span class="highlight fourth-color text-12px">Processing</span>
                                                    @elseif($order->payment_status == 'Payment Error')
        	                                            <span class="highlight third-color text-12px">Payment Error</span>
                                                    @elseif($order->payment_status == 'Cancelled')
            	                                        <span class="highlight black-color text-12px">Cancelled</span>
                                                    @endif
                                                 </td>
                                                <td><a href="orderdetails/<?php echo $order->id;?>"><button type="button" class="btn btn-danger btn-xs">DETAILS <i class="fa fa-search"></i></button></a></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                    <?php }else{?>
                                    	<p align="center"><strong> No Order Found.</strong></p>
                                    <?php }?>
                                <div class="md-margin"></div>
                                <!-- end recent orders -->

                                <!-- account info start -->
                                <div class="row">
                                	<div class="col-md-12">
                                		<header class="content-title">
                                            <div class="title-bg">
                                                <h3 class="title">Account Information</h3>
                                            </div><!-- End .title-bg -->
                                        </header>
                                        <div class="row">
                                        	<div class="col-md-6">
                                            	<h3 class="checkout-title">My Personal Information</h3>
                                                <p>{{ Session::get('userFirstName') }} {{ Session::get('userLastName') }} <br/>
                                                {{ Session::get('userEmail') }}</p>
                                                <a href="{{ url('accountedit') }}"><button type="button" class="btn btn-danger btn-xs">EDIT &nbsp;<i class="fa fa-pencil"></i></button></a>
                                                <a href="{{ url('accountedit') }}"><button type="button" class="btn btn-custom btn-xs">CHANGE PASSWORD &nbsp;<i class="fa fa-lock"></i></button></a>

                                            </div>
                                            <!-- end col-md-6 -->

                                            <div class="col-md-6">
                                                <h3 class="checkout-title">Newsletter Subscription</h3>
                                                <?php if($newsletterStatus==1){?>
                                                	<p>You are currently subscribed to TBM's newsletter.</p>
                                                <?php }else{?>
                                                	<p>You are not subscribed to TBM's newsletter.</p>
                                                <?php }?>
                                                <a href="#" data-toggle="modal" data-target="#modal-newsletter-subscription"><button type="button" class="btn btn-danger btn-xs">EDIT &nbsp;<i class="fa fa-pencil"></i></button></a>

                                            </div>
                                            <!-- end col-md-6 -->


                                            <!-- Modal newsletter subscription start -->
                                            <div class="modal fade" id="modal-newsletter-subscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                                                <form id="login-form-2" name="newsletter" method="post" action="newsletter">
                                                    <input type="hidden" name="userEmail" value="<?php echo $userDetail[0]->email;?>" />
                                                    <input type="hidden" name="userName" value="<?php echo $userDetail[0]->first_name;?> <?php echo $userDetail[0]->last_name;?>" />
                                        			<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                                                	<div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                            <h4 class="modal-title" id="myModalLabel2">Newsletter Subscription</h4>
                                                            </div><!-- End .modal-header -->
                                                            <div class="modal-body clearfix">
                                                                <div class="input-group custom-checkbox">
                                                                    <input type="radio" name="nwslttr" value="subscribe" <?php if($newsletterStatus==0){ echo 'checked="checked"';}?>> <span class="radio-container"><i class="fa fa-radio"></i></span>Yes, I would like to subscribe to TBM's newsletter.</div>
                                                                <div class="input-group custom-checkbox">
                                                                    <input type="radio" name="nwslttr" value="unsubscribe" <?php if($newsletterStatus==1){ echo 'checked="checked"';}?>> <span class="radio-container"><i class="fa fa-radio"></i></span>Please unsubscribe me.</div>


                                                            </div><!-- End .modal-body -->
                                                            <div class="modal-footer">
                                                                <button class="btn btn-custom-2" onclick="newsletter.submit();">SAVE</button>
                                                                <button type="button" class="btn btn-custom" data-dismiss="modal">CLOSE</button>
                                                            </div><!-- End .modal-footer -->
                                                        </div><!-- End .modal-content -->
                                                    </div><!-- End .modal-dialog -->
                                                </form>
                                            </div><!-- End .modal forgot password -->
                                        </div>
                                        <!-- end row -->
                                        <div class="md-margin"></div>


                                        <!-- billing & shipping address start -->
                                        <header class="content-title">
                                            <div class="title-bg">
                                                <h3 class="title">Billing &amp; Shipping Address</h3>
                                            </div><!-- End .title-bg -->
                                        </header>
                                        <div class="row">
                                        	<div class="col-md-6">
                                                <h3 class="checkout-title">Default Billing Address</h3>

                                                <p><strong><?php echo $userDetail[0]->billing_first_name;?> <?php echo $userDetail[0]->billing_last_name;?></strong></p>
                                                <p><?php echo $userDetail[0]->billing_address;?> <br/><?php echo $userDetail[0]->billing_post_code;?> <?php echo $userDetail[0]->billing_city;?>, <?php echo $userDetail[0]->billing_state_name;?>, <br/><?php echo $userDetail[0]->billing_country_name;?>.</p>
                                                <p><strong>Email:</strong> <?php echo $userDetail[0]->billing_email;?></p>
                                                <p><strong>Telephone:</strong> <?php echo $userDetail[0]->billing_telephone;?></p>
                                                <a href="{{ url('billingaddress') }}"><button type="button" class="btn btn-danger btn-xs">EDIT &nbsp;<i class="fa fa-pencil"></i></button></a>

                                            </div>
                                            <!-- end col-md-6 -->

                                            <div class="col-md-6">
                                                <h3 class="checkout-title">Default Shipping Address</h3>

                                                <p><strong><?php echo $userDetail[0]->shipping_first_name;?> <?php echo $userDetail[0]->shipping_last_name;?></strong></p>
                                                <p><?php echo $userDetail[0]->shipping_address;?> <br/><?php echo $userDetail[0]->shipping_post_code;?> <?php echo $userDetail[0]->shipping_city;?>, <?php echo $userDetail[0]->shipping_state_name;?>, <br/><?php echo $userDetail[0]->shipping_country_name;?>.</p>
                                                <p><strong>Email:</strong> <?php echo $userDetail[0]->shipping_email;?></p>
                                                <p><strong>Telephone:</strong> <?php echo $userDetail[0]->shipping_telephone;?></p>
                                                <a href="{{ url('shippingaddress') }}"><button type="button" class="btn btn-danger btn-xs">EDIT &nbsp;<i class="fa fa-pencil"></i></button></a>

                                            </div>
                                            <!-- end col-md-6 -->
                                        </div>
                                        <!-- end row -->
                                        <!-- end billing & shipping address -->

                                    </div>
                                    <!-- end col-md-12 -->
                                </div>
                                <!-- end row -->

                                <!-- end account info -->

                            </div>

                        </div>
                        <!-- end row -->



                    </div>
                    <!-- end col-md-12 -->

            	</div>
                <!-- end row -->

    		</div>
            <!-- end container -->



    </section><?php */?>

<?php
	// Brands & Services are done in the templateFront.blade.php
	if(isset($brands_scroller)) unset($brands_scroller);
?>

@endsection
