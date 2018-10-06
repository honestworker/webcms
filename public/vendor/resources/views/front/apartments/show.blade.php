@extends('front/templateFront')

@section('content')

<div class="page-heading-area sub-banner9">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h2 class="page-heading">
            </h2><!--/.page-heading-->
          </div><!--/.col-md-12-->
        </div><!--/.row-->
      </div><!--/.container-->
    </div><!--/.page-heading-area-->
    <!--================= Content Area ===================-->
    <div class="room-single-area">
      <div class="container">
      	<div class="row">
          <div class="col-md-8 col-full-width">
            <div class="section-title-area text-center">
              <h2 class="section-title">Rooms &amp; Suites</h2>
              <p class="section-title-dec">Our varied choice of rooms has been designed to suit your needs, be it for business travellers, family or group leisure.</p>
            </div><!--/.section-title-area-->
          </div><!--/.col-md-8-->
        </div><!--/.row-->

        <div class="row">
          <div class="col-md-8 room-single-content">
            <div class="room-single-thumb">
              <div class="room-thumb-full owl-carousel">
              @foreach($images as $image)
                <div class="item"><img src="{{ asset('public/admin/products/medium/'.$image->file_name) }}" alt="premier room"></div>
			        @endforeach
              </div>

              <div class="room-thumb-list owl-carousel">
              @foreach($images as $image)
                <div class="item"><img src="{{ asset('public/admin/products/medium/'.$image->file_name) }}" alt="premier room"></div>
              @endforeach
				              </div>
            </div><!--/.room-single-thumb-->
            <div class="single-room list mobile-extend">
              <div class="room-info">
                <div class="room-title-area clearfix">
                  <div class="pull-left">
                    <h3 class="room-title"> {{$product->type}}</h3>

                    <ul class="clearfix margin-top">
                    	<li><i class="fa fa-bed"></i> <b>BED: </b> {{$product->bed}} </li>
                        <li><i class="fa fa-user"></i> <b>GUEST: </b> {{$product->guest}}</li>
                        <li><i class="fa fa-cutlery"></i> <b>MEAL: </b> {{$product->meal}}</li>
                    </ul>
                  </div>
                  <div class="pull-right">
                    <h5>RM {{$product->sale_price}} nett / Night</h5>
                  </div>
                </div><!--/.room-title-area-->
                <div class="room-description clearfix margin-top">
                  <h4>Room Overview</h4>
                  <p>{{$product->description}}.</p>

                  <h4>Room Amenities</h4>
                  <?php
                    $amenities = json_decode($product->amenities, true);;
                  //  dd($amenities);
                  ?>
                <div class="room-service-area clearfix">
                  <ul class="room-services list-unstyled">
                    @if(isset($amenities['r_size']))
                      <li><i class="fa fa-home"></i>Room Size {{$amenities['r_size_ft'] or ''}} FT<sup>2</sup></li>
                    @endif
                    @if(isset($amenities['computer']))
                    <li><i class="fa fa-laptop"></i>Computer</li>
                    @endif
                      @if(isset($amenities['awesome']))
                    <li><i class="fa fa-eye"></i>Awesome View</li>
                      @endif
                      @if(isset($amenities['wifi']))
                    <li><i class="fa fa-wifi"></i>WIFI</li>
                      @endif
                      @if(isset($amenities['tv']))
                    <li><i class="fa fa-television"></i>Flat Screen TV</li>
                      @endif
                      @if(isset($amenities['air']))
                    <li><i class="fa fa-spinner"></i>Air Conditioning</li>
                      @endif
                      @if(isset($amenities['lock']))
                    <li><i class="fa fa-key"></i>Double Locking Doors</li>
                      @endif
                      @if(isset($amenities['coffee']))
                    <li><i class="fa fa-coffee"></i>Tea/Coffee Making Facilities</li>
                      @endif
                      @if(isset($amenities['service']))
                    <li><i class="fa fa-user-plus"></i>Room Service</li>
                      @endif
                      @if(isset($amenities['pickup']))
                    <li><i class="fa fa-plane"></i>Airport Pickup</li>
                      @endif
                  </ul>
                </div><!--/.room-service-area-->

                <h4>Terms and Conditions</h4>

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
            <div class="hidden-md hidden-lg text-center extend-btn"><span class="extend-icon"><i class="fa fa-angle-down"></i></span></div>
          </div><!--/.col-md-8-->
          <div class="col-md-4 room-single-sidebar">
            <form action="{{url('check-availability')}}" class="review-comment-form box-radius">
            <input type="hidden" name="pid" value="{{$product->id}}">
              <p>Your reservation</p>
              <div class="single-input">
                <label class="text-uppercase">Check-in Date</label>
                <div class="input box-radius"><i class="fa fa-calendar"></i>
                  <input type="text" id="date-arrival" placeholder="Check-in Date" name="arrival" class="form-controller">
                </div>
              </div>
              <div class="single-input">
                <label class="text-uppercase">Check-out Date</label>
                <div class="input box-radius"><i class="fa fa-calendar"></i>
                  <input type="text" id="date-departure" placeholder="Check-out Date" name="departure" class="form-controller">
                </div>
              </div>

              <div class="single-input">
                <label class="text-uppercase">Rooms</label>
                <div class="input box-radius"><i class="fa fa-caret-down"></i>
                    <select name="room">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                    </select>
                  </div>
              </div>
              <div class="single-input">
                <div class="row">
                  <div class="col-xs-6">
                    <label class="text-uppercase">Adult</label>
                    <div class="input box-radius"><i class="fa fa-caret-down"></i>
                      <select name="adult">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>

                      </select>
                    </div>
                  </div>
                  <div class="col-xs-6">
                    <label class="text-uppercase">Children</label>
                    <div class="input box-radius"><i class="fa fa-caret-down"></i>
                      <select name="children">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-submit">Check Availability   </button>
            </form><!--/.review-comment-form-->
          </div><!--/.col-md-4-->
        </div><!--/.row-->

      </div><!--/.container-->
    </div>
    <script type="text/javascript">
      window.onload = function(){
        jQuery('#date-arrival').pignoseCalendar({
          buttons: true,
          minDate: new Date(),
          select: function(date, context) {
          },
          apply: function(date, context) {
            console.log(date);
          }
        });
        jQuery('#date-departure').pignoseCalendar({
          buttons: true,
          minDate: new Date(),
          select: function(dates, context) {
          },
          apply: function(date, context) {
            if(new Date(jQuery('#date-arrival').val()) >= new Date(date)){
              jQuery('#date-departure').val('');
              alert('Please select departure date bigger than arrival date.');
            }
          }
        });
      };
    </script>

@endsection
