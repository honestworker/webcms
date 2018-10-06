@extends('front/templateFront')

@section('content')

           <!--================= Content Area ===================-->
        <div class="room-single-area">
          <div class="container">
        	<div class="row">
              <div class="col-md-12 col-full-width">
                <div class="section-title-area text-center">
                  <h2 class="section-title">My Booking History</h2>
                  <p class="section-title-dec">Here are the bookings you've made since your account was created.</p>
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
                            <li><i class="fa fa-check-circle"></i> <a href="oard</a></li>
                            <li><i class="fa fa-check-circle"></i> <a href="{{route('dashboard')}}">Account Dashboard</a></li>
                            <li><i class="fa fa-check-circle"></i> <a href="{{route('accountedit')}}">Account Information</a></li>
                            <li><i class="fa fa-check-circle"></i> <a href="{{route('orderhistory')}}">My Bookings</a></li>
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
                        <!--Paginations-->
                        <div class="pull-left view-count-box hidden-xs">

                             <div class="input box-radius">
                                <select name="bookings" onchange="bookings_select()" id="bookings_select">
                                  <option>- View Bookings -</option>
                                  <option value="<?= url('orderhistory/7days/'.$page, $parameters = [], $secure = null); ?>">Last 7 days</option>
                                  <option value="<?= url('orderhistory/3months/'.$page, $parameters = [], $secure = null); ?>">Last 3 months</option>
                                  <option value="<?= url('orderhistory/6months/'.$page, $parameters = [], $secure = null); ?>">Last 6 months</option>
                                  <option value="<?= url('orderhistory/1year/'.$page, $parameters = [], $secure = null); ?>">Last 1 year</option>
                                  <option value="<?= url('orderhistory/all/'.$page, $parameters = [], $secure = null); ?>">All</option>
                                </select>
                            </div>

                        </div>


                      </div><!--/.col-md-12-->
                    </div><!--/.row-->


                    <div class="row">
                      <div class="col-md-12">



                         <div class="table-responsive margin-top">
                         @if(count($userOrders)>0)
                             <table class="table cart-table">
                                <thead>
                                    <tr>
                                        <th class="table-title">Booking ID</th>
                                        <th class="table-title">Payment Reference No.</th>
                                        <th class="table-title">Booking Date</th>
                                        <th class="table-title">Total</th>
                                        <th class="table-title">Payment</th>
                                        <th class="table-title">Booking Status</a></th>
                                        <th class="table-title">Payment Status</th>
                                        <th class="table-title">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($userOrders as $order)
                                        
                                          
                                        <tr>
                                          <td><a href="orderdetails/{{$order->id}}">#{{$order->id}}</a></td>
                                           <td><a href="orderdetails/{{$order->id}}">{{$order->order_id}}</a></td>
                                           <td><?php echo date('dS M, Y', strtotime($order->modifydate));?></td>
                                           <?php
                                            $ordersModel = new App\Http\Models\Admin\Orders();
                                            $orderTax = $ordersModel->getOrderTax($order->id);
                                        ?>
                                           <td>RM <?php echo str_replace('.', '.<span class="sub-price">', number_format($orderTax->total + $orderTax->shipping_charge*1.06, 2)) . '</span>';?></td>
                                           <td>{{$order->payment_method}}</td>
                                           <td>
                                                @if($order->status == 'Processing')
                                                    <span class="highlight fourth-color text-12px">Processing</span>
                                                @elseif($order->status == 'New Order')
                                                    <span class="highlight orange-color text-12px">New Order</span>
                                                @elseif($order->status == 'Ready To Ship')
                                                    <span class="highlight fourth-color text-12px">Ready To Ship</span>
                                                @elseif($order->status == 'Shipped')
                                                    <span class="highlight blue-color text-12px">Shipped</span>
                                                @elseif($order->status == 'Completed')
                                                    <span class="highlight first-color text-12px">Completed</span>
                                                @elseif($order->status == 'Declined')
                                                    <span class="highlight third-color text-12px">Declined</span>
                                                @elseif($order->status == 'Cancelled')
                                                    <span class="highlight black-color text-12px">Cancelled</span>
                                                @else
                                                        <span class="highlight black-color text-12px">New Order</span>
                                                @endif
                                            </td>
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

                                           <td><a href="/orderdetails/{{$order->id}}"><button type="button" class="btn btn-danger btn-xs">DETAILS <i class="fa fa-search"></i></button></a></td>
                                       </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <p align="center"><strong> No Order Found.</strong></p>
                        @endif
                       </div><!--/.table responsive-->
                       <!-- end recent orders -->

                       <div class="clearfix"></div>

                       <nav class="paginations pull-right">
                           <?php
                                if(isset($countOrders) and $countOrders!=''){
                                    $totalPage = ceil($countOrders/$item);
                                }else{
                                    $totalPage=0;
                                }

                                $howMany = 2;

                            ?>

                              <div class="post-pagination paging-navigation">
                                     <ul class="nav-links">
                                        <?php if($page>1 and $totalPage>1){?>
                                            <li><a href="<?= url('orderhistory/'.$sort.'/'.($page-1), $parameters = [], $secure = null); ?>"><i class="fa fa-angle-left"></i></a></li>
                                        <?php }?>

                                        <?php if ($page > $howMany + 1): ?>
                                            <li><a href="<?= url('orderhistory/'.$sort.'/'.($page-1), $parameters = [], $secure = null); ?>">...</a></li>
                                        <?php endif; ?>

                                        <?php for ($pageIndex = $page - $howMany; $pageIndex <= $page + $howMany; $pageIndex++):  if($pageIndex==$page){ $active='active';}else{ $active='';}?>
                                            <?php if ($pageIndex >= 1 && $pageIndex <= $totalPage): ?>
                                                <li class="<?php echo $active;?>">
                                                    <a href="<?= url('orderhistory/'.$sort.'/'.$pageIndex, $parameters = [], $secure = null); ?>"><?php echo $pageIndex?></a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endfor; ?>

                                        <?php if ($page < $totalPage - $howMany): ?>
                                            <li><a href="<?= url('orderhistory/'.$sort.'/'.($page+1), $parameters = [], $secure = null); ?>">...</a></li>
                                        <?php endif; ?>

                                        <?php if($totalPage>1 and $page<$totalPage){?>
                                            <li><a href="<?= url('orderhistory/' .$sort.'/'.($page+1), $parameters = [], $secure = null); ?>"><i class="fa fa-angle-right"></i></a></li>
                                        <?php }?>
                                    </ul>
                              </div><!--/.post-pagination-->
                        </nav><!--/.pagination-->

                        <div class="clearfix"></div>

                        <hr>

                         <div class="text-center">
                          <a href="javascript:window.history.back();" class="btn btn-default btn-sm">Back</a>
                       </div>




                      </div><!--/.col-md-12-->
                    </div><!--/.row-->

                </div>

            </div><!--/.col-md-6-->

        </div><!--/.row-->

         <br/>

      </div><!--/.container-->
    </div><!--/.room-grid-area-->
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
                      <img src="{{ asset('/public/front/images/hotel_services/icon_tour_desk.png') }}"  alt="Tour Desk">
                    </div>
                    <h5>Tour Desk</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->
                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                      <img src="{{ asset('/public/front/images/hotel_services/icon_reception.png') }}"  alt="24 hour Reception">
                    </div>
                    <h5>24 hour Reception</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->
                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                        <img src="{{ asset('/public/front/images/hotel_services/icon_wifi.png') }}" alt="WiFi">
                    </div>
                    <h5>WiFi Internet</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->
                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                        <img src="{{ asset('/public/front/images/hotel_services/icon_elevator.png') }}" alt="Lift/Elevator">
                    </div>
                    <h5>Lift / Elevator</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->

                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                        <img src="{{ asset('/public/front/images/hotel_services/icon_no-smoking.png') }}" alt="Non-Smoking Room">
                    </div>
                    <h5>Non-Smoking Rooms</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->

                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                        <img src="{{ asset('/public/front/images/hotel_services/icon_laundry.png') }}" alt="Guest Laundry">
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
<script>

    function bookings_select(){
         var url = document.getElementById("bookings_select").value;
         if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
    }
</script>

<?php
	// Brands & Services are done in the templateFront.blade.php
	if(isset($brands_scroller)) unset($brands_scroller);
?>

@endsection
