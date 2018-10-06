@extends('front/templateFront')

@section('content')
<section id="content">
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
          <h2>Create Your Event</h2>
          <span class="small-bottom-border big"></span>
          <p>Invite your friends &amp; family members to join this event!</p>
        </div>
        <div class="md-margin2x"></div>
        <div class="row">
          <aside class="col-md-3 col-sm-4 col-xs-12 sidebar">
            <div class="widget">
              <div class="panel-group custom-accordion sm-accordion" id="category-filter">
                <div class="panel">
                  <div class="accordion-header">
                    <div class="accordion-title"><span>My Account</span> </div>
                    <a class="accordion-btn opened" data-toggle="collapse" data-target="#category-list-1"></a> </div>
                  <div id="category-list-1">
                    <div class="panel-body"> @include('front.user.userLeft') </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end widget --> 
            
          </aside>
          <div class="col-md-9 col-sm-9 col-xs-12"> @if(session()->has('data'))
            <div class="alert alert-success alert-dismissable">
              <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
              <i class="fa fa-check-circle"></i> <strong>Success!</strong>
              <p>{{  session('data.success') }}</p>
            </div>
            @endif
            
             <!-- validation errors -->
            @if($errors->has())
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                    <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                    @foreach ($errors->all() as $error)
                      <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
           
            <div class="row">
              <div class="col-md-12">
                <h3 class="checkout-title">Event Details</h3>
                <div class="row">
                  <form action="{{ url('/createEvent') }}" method="post">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-list-alt"></i> <span class="input-text">Event Type &#42;</span></span>
                          <input type="text" class="form-control input-lg" name="event_type" value="{{ old('event_type') }}" placeholder="eg. Jasmine's Birthday Party">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">Event Location</span></span>
                          <div class="large-selectbox clearfix">
                            <input class="form-control input-lg" type="text" name="event_location" value="{{ old('event_type') }}">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end col-md-6 -->
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar"></i> <span class="input-text">Event Date &#42;</span></span>
                          <input type="text" name="event_date" value="{{ old('event_type') }}" class="new_datepicker form-control input-lg" data-date-start-date="0d" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" readonly="readonly">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-users"></i> <span class="input-text">Estimated # of Guests</span></span>
                          <input type="text" name="guests" value="{{ old('event_type') }}" class="form-control input-lg">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <!-- end col-md-6 -->
                  
                  <div class="clearfix"></div>
                  <hr>
                </div>
                <!-- end row --> 
                <!-- end event details -->
                
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <h3 class="checkout-title">Registrant Contact Info</h3>
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i> <span class="input-text">First Name &#42;</span></span>
                          <input type="text" name="registrant_first_name" value="{{ old('event_type') }}" class="form-control input-lg" placeholder="Your First Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i> <span class="input-text">Last Name &#42;</span></span>
                          <input type="text" name="registrant_last_name" value="{{ old('event_type') }}" class="form-control input-lg" placeholder="Your Last Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-phone"></i> <span class="input-text">Telephone &#42;</span></span>
                          <input type="text" name="registrant_telephone" value="{{ old('event_type') }}" class="form-control input-lg" placeholder="Your Telephone">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar"></i> <span class="input-text">Birth Date &#42;</span></span>
                          <input type="text" name="registrant_birth_date" value="{{ old('event_type') }}" class="birth_day form-control input-lg" data-date-end-date="0d" placeholder="dd/mm/yyyy" readonly="readonly">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-building-o"></i> <span class="input-text">Address &#42;</span></span>
                          <textarea name="registrant_address" value="{{ old('event_type') }}" id="contact-message" class="form-control" cols="30" rows="2" placeholder="Your Address"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">City &#42;</span></span>
                          <input type="text" name="registrant_city" value="{{ old('event_type') }}" class="form-control input-lg" placeholder="Your City">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">Post Code &#42;</span></span>
                          <input type="text" name="registrant_post_code" value="{{ old('event_type') }}" class="form-control input-lg" placeholder="Your Post Code">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">State &#42;</span></span>
                          <div class="large-selectbox clearfix">
                            <select id="country-3" name="registrant_state" class="selectbox1">
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-flag"></i> <span class="input-text">Country &#42;</span></span>
                          <div class="large-selectbox clearfix">
                            <select id="country-3" name="registrant_country" class="selectbox1">
                              <option value="">Country</option>
                              @foreach($countries as $country)
                              <option value="{{ $country->country_id }}">{{ $country->name }}</option>
                              @endforeach                   
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end col-md-6 -->
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <h3 class="checkout-title">Co-registrant Contact Info</h3>
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i> <span class="input-text">First Name &#42;</span></span>
                          <input type="text" name="co_registrant_first_name" class="form-control input-lg" placeholder="Your First Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i> <span class="input-text">Last Name &#42;</span></span>
                          <input type="text" name="co_registrant_last_name" class="form-control input-lg" placeholder="Your Last Name">
                        </div>
                      </div>
                      <div class="input-group custom-checkbox">
                        <input type="checkbox" id="same_registrant_address" name="same_registrant_address">
                        <span class="checbox-container"><i class="fa fa-check"></i></span> Contact Information same as registrant.
                      </div>
                     
                      <div id="co_registrant_address_container">
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-phone"></i> <span class="input-text">Telephone &#42;</span></span>
                          <input type="text" name="co_registrant_telephone" class="form-control input-lg" placeholder="Your Telephone">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-building-o"></i> <span class="input-text">Address &#42;</span></span>
                          <textarea name="co_registrant_address" id="contact-message" class="form-control" cols="30" rows="2" placeholder="Your Address"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">City &#42;</span></span>
                          <input type="text" name="co_registrant_city" class="form-control input-lg" placeholder="Your City">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">Post Code &#42;</span></span>
                          <input type="text" name="co_registrant_post_code" class="form-control input-lg" placeholder="Your Post Code">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">State &#42;</span></span>
                          <div class="large-selectbox clearfix">
                            <select id="country-3" name="co_registrant_state" class="selectbox1">
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-flag"></i> <span class="input-text">Country &#42;</span></span>
                          <div class="large-selectbox clearfix">
                            <select id="country-3" name="co_registrant_country" class="selectbox1">
                              <option value="">Country</option>
                              
                                                                @foreach($countries as $country)
                                                                    
                              <option value="{{ $country->country_id }}">{{ $country->name }}</option>
                              
                                                                @endforeach
                                                            
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                     </div>
                      
                      
                    </div>
                    <!-- end col-md-6 -->
                  <div class="clearfix"></div>
                  <hr>
                </div>
                <!-- end row --> 
                <!-- end co-registrant contact info -->
                
                <h3 class="checkout-title">Shipping Address</h3>
                <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <h5 class="accordion-title">Where to send my gifts now</h5>
                    <div class="form-group">
                      <input type="radio" name="send_gift_to" value="registrant_address" checked="checked" onclick="$('#current_shipping_address').hide()">
                      Registrant address <br/>
                      <input type="radio" name="send_gift_to" value="co_registrant_address" onclick="$('#current_shipping_address').hide()">
                      Co-registrant address <br/>
                      <input type="radio" name="send_gift_to" value="other_address" onclick="$('#current_shipping_address').show()">
                      Other address <br/>
                    </div>                   
                    <div id="current_shipping_address" style="display:none">
                        <div class="form-group">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i> <span class="input-text">Attn To</span></span>
                            <input type="text" name="recipient_name" class="form-control input-lg" placeholder="Name">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-building-o"></i> <span class="input-text">Address &#42;</span></span>
                            <textarea name="recipient_address" id="contact-message" class="form-control" cols="30" rows="2" placeholder="Your Address"></textarea>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">City &#42;</span></span>
                            <input type="text" name="recipient_city" class="form-control input-lg" placeholder="Your City">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">Post Code &#42;</span></span>
                            <input type="text" name="recipient_post_code" class="form-control input-lg" placeholder="Your Post Code">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">State &#42;</span></span>
                            <div class="large-selectbox clearfix">
                              <select id="country-3" name="recipient_state" class="selectbox1">
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-flag"></i> <span class="input-text">Country &#42;</span></span>
                            <div class="large-selectbox clearfix">
                              <select id="country-3" name="recipient_country" class="selectbox1">
                                <option value="">Country</option>
                                
                                                                    @foreach($countries as $country)
                                                                        
                                <option value="{{ $country->country_id }}">{{ $country->name }}</option>
                                
                                                                    @endforeach
                                                            
                              </select>
                            </div>
                          </div>
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>
                  </div>
                  <!-- end col-md-6 -->
                  
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <h5 class="accordion-title">Where to send my gifts in the future</h5>
                    <div class="input-group custom-checkbox">
                      <input type="checkbox" name="use_future_shipping_address">
                      <span class="checbox-container"><i class="fa fa-check"></i></span> Future Shipping Address </div>
                    note to programmer: display the below form fields only if user selects "future shipping address". otherwise, hide it
                    <div class="form-group">
                      <div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar"></i> <span class="input-text">Starting On &#42;</span></span>
                        <input type="text" name="future_shipping_date" class="future_date form-control input-lg" data-date-start-date="+1d" placeholder="dd/mm/yyyy" readonly="readonly">
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="radio" name="future_shipping_address" value="registrant_address" onclick="$('#future_shipping_address').hide()">
                      Registrant address <br/>
                      <input type="radio" name="future_shipping_address" value="co_registrant_address" onclick="$('#future_shipping_address').hide()">
                      Co-registrant address <br/>
                      <input type="radio" name="future_shipping_address" value="other_address" onclick="$('#future_shipping_address').show()">
                      Other address <br/>
                    </div>
                    <div id="future_shipping_address" style="display:none">
                        <div class="form-group">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i> <span class="input-text">Attn To</span></span>
                            <input type="text" name="future_shipping_recipient_name" class="form-control input-lg" placeholder="Name">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-building-o"></i> <span class="input-text">Address &#42;</span></span>
                            <textarea name="future_shipping_recipient_address" id="contact-message" class="form-control" cols="30" rows="2" placeholder="Your Address"></textarea>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">City &#42;</span></span>
                            <input type="text" name="future_shipping_recipient_city" class="form-control input-lg" placeholder="Your City">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">Post Code &#42;</span></span>
                            <input type="text" name="future_shipping_recipient_post_code" class="form-control input-lg" placeholder="Your Post Code">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">State &#42;</span></span>
                            <div class="large-selectbox clearfix">
                              <select id="country-3" name="future_shipping_recipient_state" name="future_shipping_recipient_state" class="selectbox1">
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-flag"></i> <span class="input-text">Country &#42;</span></span>
                            <div class="large-selectbox clearfix">
                              <select id="country-3" name="future_shipping_recipient_country" class="selectbox1">
                                <option value="">Country</option>
                                
                                                                    @foreach($countries as $country)
                                                                        
                                <option value="{{ $country->country_id }}">{{ $country->name }}</option>
                                
                                                                    @endforeach
                                                            
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                  </div>
                  <!-- end col-md-6 -->
                  
                  <div class="clearfix"></div>
                  <hr>
                </div>
                <!-- end row --> 
                <!-- end shipping address -->
                
                <h3 class="checkout-title">Preferences</h3>
                <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <h5 class="accordion-title">View options</h5>
                    <div class="form-group">
                      <input type="radio" name="preference" value="public" checked="checked">
                      Public (viewable at tbm.com.my and searchable on internet) <br/>
                      <input type="radio" name="preference" value="private">
                      Private (only you can see your event) <br/>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <!-- end col-md-6 -->
                  
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <h5 class="accordion-title">Preferred store</h5>
                    <div class="form-group">
                      <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">State &#42;</span></span>
                        <div class="large-selectbox clearfix">
                          <select id="country-3" name="preferred_state" class="selectbox">
                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                            <option value="Johor">Johor</option>
                            <option value="Kedah">Kedah</option>
                            <option value="Kelantan">Kelantan</option>
                            <option value="Labuan">Labuan</option>
                            <option value="Labuan">Melacca</option>
                            <option value="Labuan">Negeri Sembilan</option>
                            <option value="Labuan">Labuan</option>
                            <option value="Pahang">Pahang</option>
                            <option value="Penang">Penang</option>
                            <option value="Perak">Perak</option>
                            <option value="Perlis">Perlis</option>
                            <option value="Putrajaya">Putrajaya</option>
                            <option value="Sabah">Sabah</option>
                            <option value="Sarawak">Sarawak</option>
                            <option value="Selangor">Selangor</option>
                            <option value="Terengganu">Terengganu</option>
                            <option value="-">-</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group"><span class="input-group-addon"><i class="fa fa-flag"></i> <span class="input-text">Select Store &#42;</span></span>
                        <div class="large-selectbox clearfix">
                          <select id="country-3" name="preferred_store" class="selectbox">
                            <option>List all stores here</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <!-- end col-md-6 -->
                  
                  <div class="clearfix"></div>
                  <hr>
                </div>
                <!-- end row --> 
                <!-- end preferences -->
                <div class="md-margin"></div>
                <a href="{{ url('special_list') }}" class="btn btn-custom"><i class="fa fa-angle-double-left"></i> BACK</a>
                <button type="submit" class="btn btn-custom-2">CREATE EVENT &nbsp;<i class="fa fa-plus"></i></button>
              	</form>
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
  
</section>

<!-- Brands STARTS
         ========================================================================= -->
<section id="clients">
  <div class="clients">
    <?php 
            use App\Http\Models\Front\Brands;
            $this->BrandsModel = new Brands();
            $brands = $this->BrandsModel->getBrands();
            $this->data['brands'] = $brands;
            foreach($brands as $brand){?>
    <div class="items"><img src="{{ asset('/public/admin/brands/'.$brand['image']) }}" alt="<?php echo $brand['title'];?>"></div>
    <?php }	?>
  </div>
</section>
<!-- /.brands --> 

<!-- Services STARTS
         ========================================================================= -->
<section id="facts">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-4 col-xs-12">
        <h1>Our Services</h1>
        <h2>Serving you well and making you happy is what we do best!</h2>
        <p class="line">&nbsp;</p>
      </div>
    </div>
    <div id="our-facts">
      <div class="items">
        <div class="circle"><i class="fa fa-truck"></i></div>
        <div class="heading-2">FREE</div>
        <div class="heading-1">Delivery</div>
      </div>
      <div class="items">
        <div class="circle"><i class="fa fa-gavel"></i></div>
        <div class="heading-2">Installation</div>
        <div class="heading-1">Services</div>
      </div>
      <div class="items">
        <div class="circle"><i class="fa fa-comments"></i></div>
        <div class="heading-2">FREE</div>
        <div class="heading-1">Teaching/Advice</div>
      </div>
      <div class="items">
        <div class="circle"><i class="fa fa-book"></i></div>
        <div class="heading-2">FREE</div>
        <div class="heading-1">Catalog/Brochures</div>
      </div>
      <div class="items">
        <div class="circle"><i class="fa fa-shield"></i></div>
        <div class="heading-2">Extended</div>
        <div class="heading-1">Warranty</div>
      </div>
      <div class="items">
        <div class="circle"><i class="fa fa-users"></i></div>
        <div class="heading-2">Earn/Redeem</div>
        <div class="heading-1">Points</div>
      </div>
      <div class="items">
        <div class="circle"><i class="fa fa-dollar"></i></div>
        <div class="heading-2">Interest</div>
        <div class="heading-1">FREE</div>
      </div>
      <div class="items">
        <div class="circle"><i class="fa fa-recycle"></i></div>
        <div class="heading-2">Product</div>
        <div class="heading-1">Recycling</div>
      </div>
      <div class="items">
        <div class="circle"><i class="fa fa-gift"></i></div>
        <div class="heading-2">FREE</div>
        <div class="heading-1">Gifts</div>
      </div>
      <div class="items">
        <div class="circle"><i class="fa fa-dropbox"></i></div>
        <div class="heading-2">FREE</div>
        <div class="heading-1">Wrapping</div>
      </div>
      <div class="items">
        <div class="circle"><i class="fa fa-wrench"></i></div>
        <div class="heading-2">Repair</div>
        <div class="heading-1">Services</div>
      </div>
      <div class="items">
        <div class="circle"><i class="fa fa-tasks"></i></div>
        <div class="heading-2">Spare</div>
        <div class="heading-1">Parts</div>
      </div>
    </div>
  </div>
  <div id="video">
    <video autoplay loop>
      <source src="" type="">
    </video>
  </div>
</section>
<!-- /.services --> 

<!-- page script -->

<link rel="stylesheet" href="{{ asset('/public/front/css/jquery.selectbox.css') }}">
<!-- shopping cart select --> 
<script src="{{ asset('/public/front/js/jquery.selectbox.min.js') }}"></script> 
<script src="{{ asset('/public/front/js/jquery.appear.js') }}"></script> 
<script src="{{ asset('/public/front/js/jquery.parallax-1.1.3.js') }}"></script>
<link type="text/css" rel="stylesheet" href="{{ asset('/public/front/bootstrap_datepicker/css/datepicker.css') }}">
<script src="{{ asset('/public/front/bootstrap_datepicker/js/bootstrap-datepicker.js') }}"></script> 
<!--<link type="text/css" rel="stylesheet" href="{{ asset('/public/front/bootstrap_datepicker/css/bootstrap.css') }}">--> 

<script>

$(document).ready(function () {                
	
	$('.new_datepicker').datepicker({format: 'dd M, yyyy', autoclose : true});
	$('.birth_day').datepicker({format: 'dd M, yyyy', autoclose : true});
	$('.future_date').datepicker({format: 'dd M, yyyy', autoclose : true});
	

});

</script> 
<script>

$(function (){
	$('select[name="registrant_country"]').change(function(){
				
		var country_id = $(this).val();
		if(country_id != ''){
			$.ajax({
				url: "{{ url('/checkout/getStates') }}",
				type: 'POST',
				data: {country_id:country_id, _token: '<?php echo csrf_token() ?>'},
				dataType: 'json',
				timeout : 5000,
				async: false,
				cache: false,
				beforeSend:function (){
					$('select[name="registrant_state"]').html('<option value="">Loading...</option>');
				},
				complete: function(){
					
				},
				success: function (response) {
					var html = '';
					html += '<option value="">States</option>';
					if(response['states']){
						for(var i = 0; i < response['states'].length; i++){
							html += '<option value="' + response['states'][i]['zone_id'] + '">' + response['states'][i]['name'] + '</option>';
						}
					}
					
					$('select[name="registrant_state"]').html(html);
				}
			});
		}
		else{
			$('select[name="registrant_state"]').html('<option value="">State</option>');
		}
	});
});

$(function (){
	$('select[name="co_registrant_country"]').change(function(){
		var country_id = $(this).val();
		if(country_id != ''){
			$.ajax({
				url: "{{ url('/checkout/getStates') }}",
				type: 'POST',
				data: {country_id:country_id, _token: '<?php echo csrf_token() ?>'},
				dataType: 'json',
				async: false,
				cache: false,
				beforeSend:function (){
					$('select[name="co_registrant_state"]').html('<option value="">Loading...</option>');
				},
				complete: function(){
					
				},
				success: function (response) {
					var html = '';
					html += '<option value="">States</option>';
					if(response['states']){
						for(var i = 0; i < response['states'].length; i++){
							html += '<option value="' + response['states'][i]['zone_id'] + '">' + response['states'][i]['name'] + '</option>';
						}
					}
					
					$('select[name="co_registrant_state"]').html(html);
				}
			});
		}
		else{
			$('select[name="co_registrant_state"]').html('<option value="">State</option>');
		}
	});
});

$(function (){
	$('select[name="recipient_country"]').change(function(){
		var country_id = $(this).val();
		if(country_id != ''){
			$.ajax({
				url: "{{ url('/checkout/getStates') }}",
				type: 'POST',
				data: {country_id:country_id, _token: '<?php echo csrf_token() ?>'},
				dataType: 'json',
				async: false,
				cache: false,
				beforeSend:function (){
					$('select[name="recipient_state"]').html('<option value="">Loading...</option>');
				},
				complete: function(){
					
				},
				success: function (response) {
					var html = '';
					html += '<option value="">States</option>';
					if(response['states']){
						for(var i = 0; i < response['states'].length; i++){
							html += '<option value="' + response['states'][i]['zone_id'] + '">' + response['states'][i]['name'] + '</option>';
						}
					}
					
					$('select[name="recipient_state"]').html(html);
				}
			});
		}
		else{
			$('select[name="recipient_state"]').html('<option value="">State</option>');
		}
	});
});


$(function (){
	$('select[name="future_shipping_recipient_country"]').change(function(){
		var country_id = $(this).val();
		if(country_id != ''){
			$.ajax({
				url: "{{ url('/checkout/getStates') }}",
				type: 'POST',
				data: {country_id:country_id, _token: '<?php echo csrf_token() ?>'},
				dataType: 'json',
				async: false,
				cache: false,
				beforeSend:function (){
					$('select[name="future_shipping_recipient_state"]').html('<option value="">Loading...</option>');
				},
				complete: function(){
					
				},
				success: function (response) {
					var html = '';
					html += '<option value="">States</option>';
					if(response['states']){
						for(var i = 0; i < response['states'].length; i++){
							html += '<option value="' + response['states'][i]['zone_id'] + '">' + response['states'][i]['name'] + '</option>';
						}
					}
					
					$('select[name="future_shipping_recipient_state"]').html(html);
				}
			});
		}
		else{
			$('select[name="future_shipping_recipient_state"]').html('<option value="">State</option>');
		}
	});
});

//Shipping address is the same as billing address
$(function(){
	$('#same_registrant_address').click(function(){
		if($(this).is(':checked')){
			
			$('input[name=co_registrant_telephone]').val($('input[name=registrant_telephone]').val());
			$('textarea[name=co_registrant_address]').val($('textarea[name=registrant_address]').val());
			$('input[name=co_registrant_city]').val($('input[name=registrant_city]').val());
			$('input[name=co_registrant_post_code]').val($('input[name=registrant_post_code]').val());
			
			$('select[name=co_registrant_state]').html($('select[name=registrant_state]').html());
			$('select[name=co_registrant_state]').val($('select[name=registrant_state]').val());
			
			$('select[name=co_registrant_country]').val($('select[name=registrant_country]').val());
			
			$('#co_registrant_address_container').hide();
		}
		else
		{
			$('input[name=co_registrant_telephone]').val('');
			$('textarea[name=co_registrant_address]').val('');
			$('input[name=co_registrant_city]').val('');
			$('input[name=co_registrant_post_code]').val('');
			$('select[name=co_registrant_state]').html('');
			$('select[name=co_registrant_country]').val('');
			
			$('#co_registrant_address_container').show();	
		}
	});
});
</script> 
@endsection 