@extends('front/templateFront')

@section('content')
        <!--================= Content Area ===================-->
        <div id="room-single-area">
            <div class="container">
                <div class="row">
                	<div class="col-md-12 col-full-width">
						<div class="section-title-area text-center">
                            <h2 class="section-title">Edit Account Information</h2>
                            <p>View &amp; edit your personal information. Keep your profile up-to-date.</p>
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
                              @if(Session::has('success'))
                                 <div class="alert alert-success">
                                    <i class="fa fa-check"></i>
                                    <strong>Success!</strong>
                                    <p>{{ Session::get('success') }}</p>
                                 </div>
                             @endif

                                @if(Session::has('error'))
                                 <div class="alert alert-danger">
                                    <i class="fa fa-exclamation-triangle"></i>
                                    <strong>Oops!</strong>
                                    <p>{{ Session::get('error') }}</p>
                                     <p>
                                        @if (count($errors)>0)
                                        <ul>
                                            @foreach ($errors as $e)
                                            <li>{{ $e }}</li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </p>
                                 </div>
                                @endif




                                    <div class="room-description clearfix">
                                        <h4 class="pull-left">Account Information</h4>
                                    </div>

                                 <div class="clearfix"></div>

                              </div><!--/.col-md-12-->
                            </div><!--/.row-->


                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <div class="room-comments-area">
                              <div id="respond" class="comment-respond box-radius">
                                <div class="row">
                                  <div class="col-md-12">
                                    <h4 class="comment-reply-title">Guest Details</h4><!--/.comment-reply-title-->
                                  </div><!--/.col-md-12-->
                                </div><!--/.row-->
                                <div class="row">
                                  <div class="col-md-12">
                                    <form action="#" method="post" id="comment_form" name="commentForm">
                                        <input type="hidden" name="userId" value="<?php echo $userDetail[0]->id;?>" />
                                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />

                                      <div class="row">
                                        <div class="col-md-6 col-sm-6 padding-right">
                                          <p>
                                            <input type="text" name="billing_first_name" id="billing_first_name" aria-required="true" placeholder="First Name *" value="{{$userDetail[0]->billing_first_name}}" class="form-controllar">
                                          </p>
                                        </div><!--/.col-md-6-->
                                        <div class="col-md-6 col-sm-6 padding-right">
                                          <p>
                                            <input type="text" name="billing_last_name" id="billing_last_name" aria-required="true" placeholder="Last Name *" value="{{$userDetail[0]->billing_last_name}}" class="form-controllar">
                                          </p>
                                        </div><!--/.col-md-6-->
                                        <div class="col-md-6 col-sm-6 padding-right">
                                          <p>
                                            <input type="text" name="billing_telephone" id="billing_telephone" aria-required="true" placeholder="Telephone *" value="{{$userDetail[0]->billing_telephone}}" class="form-controllar">
                                          </p>
                                        </div><!--/.col-md-6-->

                                        <div class="col-md-6 col-sm-6 padding-right">
                                          <p>
                                            <input type="text" name="passport_nric" id="passport_nric" aria-required="true" placeholder="Passport/NRIC *" value="{{$userDetail[0]->telephone}}" class="form-controllar">
                                          </p>
                                        </div><!--/.col-md-6-->
                                        <div class="col-md-6 col-sm-6 padding-right">
                                          <p>
                                            <input type="text" name="billing_email" id="billing_email" aria-required="true" placeholder="Your Email (Login ID) *" value="{{$userDetail[0]->billing_email}}" class="form-controllar">
                                          </p>
                                        </div><!--/.col-md-6-->
                                        <div class="clearfix"></div>
                                        <div class="col-md-6 col-sm-6 padding-right">
                                          <p>
                                            <input type="password" name="current_password" id="current_password" aria-required="true" placeholder="Current Password *" class="form-controllar">
                                          </p>
                                        </div><!--/.col-md-6-->
                                        <div class="col-md-6 col-sm-6 padding-right">
                                          <p>
                                            <input type="password" name="password" id="password" aria-required="true" placeholder="New Password *" class="form-controllar">
                                          </p>
                                        </div><!--/.col-md-6-->

                                        <div class="col-md-6 col-sm-6 padding-right">
                                          <p>
                                            <input type="password" name="passconf" id="passconf" onkeyup="checkPass(); return false;"  aria-required="true" placeholder="Confirm New Password *" class="form-controllar">
                                             <span id="confirmMessage" class="confirmMessage"></span>
                                          </p>
                                        </div><!--/.col-md-6-->


                                        <div class="col-md-12">
                                          <p><div class="alert alert-info"><i class="fa fa-info-circle"></i> &nbsp;<strong>Note:</strong> Password length should be between 8-12 characters with combination of alphabet letters, digits and special characters (eg. *@$!+%~)</div></p>

                                        </div><!--/.col-md-12-->

                                      </div><!--/.row-->
                                   <!-- </form>/#comment_form-->
                                  </div><!--/.col-md-12-->
                                </div><!--/.row-->
                              </div><!--/.comment-respond-->
                            </div>

                        </div><!--/.col-md-12-->

                        <div class="col-md-12 col-sm-12 col-xs-12 margin-top">

                            <div class="room-comments-area">
                              <div id="respond" class="comment-respond box-radius">
                                <div class="row">
                                  <div class="col-md-12">
                                    <h4 class="comment-reply-title">Address</h4><!--/.comment-reply-title-->
                                  </div><!--/.col-md-12-->
                                </div><!--/.row-->
                                <div class="row">
                                  <div class="col-md-12">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <p>
                                            <textarea name="billing_address" id="billing_address" aria-required="true" rows="3" cols="45" placeholder="Address *" class="form-controllar">{{$userDetail[0]->billing_address}}</textarea>
                                          </p>
                                        </div><!--/.col-md-12-->

                                        <div class="col-md-6 col-sm-6 padding-right">
                                          <p>
                                            <input type="text" name="billing_city" id="billing_city" aria-required="true" placeholder="City *" value="{{$userDetail[0]->billing_city}}" class="form-controllar">
                                          </p>
                                        </div><!--/.col-md-6-->

                                        <div class="col-md-6 col-sm-6 padding-right">
                                          <p>
                                            <input type="text" name="billing_post_code" id="billing_post_code" aria-required="true" placeholder="Post Code *" value="{{$userDetail[0]->billing_post_code}}" class="form-controllar">
                                          </p>
                                        </div><!--/.col-md-6-->
                                        <div class="col-md-6 col-sm-6 padding-right">
                                          <p>
                                            <div class="input box-radius">
                                                <select name="billing_state">
                                                    <option value="Select State">- Select State -</option>
                                                  @foreach($states as $state)
                                                    <option <?php if($userDetail[0]->billing_state==$state->zone_id){?> selected="selected"<?php }?> value="{{ $state->zone_id }}">{{ $state->name }}</option>
                                                @endforeach

                                                </select>
                                              </div>
                                          </p>
                                        </div><!--/.col-md-6-->
                                        <div class="col-md-6 col-sm-6 padding-right">
                                          <p>
                                          <div class="input box-radius">
                                                <select name="billing_country">
                                                  <option value="Select Country">- Select Country -</option>
                                                  <option value="">Country</option>
                                                    @foreach($countries as $country)
                                                        <option <?php if($userDetail[0]->billing_country==$country->country_id){?> selected="selected"<?php }?> value="{{ $country->country_id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                              </div>
                                          </p>
                                        </div><!--/.col-md-6-->


                                      </div><!--/.row-->

                                    </form><!--/#comment_form-->

                                  </div><!--/.col-md-12-->
                                </div><!--/.row-->

                              </div><!--/.comment-respond-->


                            </div><!--/.room-comments-area-->

                            <div class="clearfix margin-top"></div>

                            <div class="text-center">
                               <a href="dashboard" class="btn btn-default btn-sm">Back</a>
                               <a onclick="javascript:comment_form.submit();" class="btn btn-default btn-sm">Save</a>
                            </div>

                        </div><!--/.col-md-12-->

                    </div><!--/.row-->
                    <!-- end form -->



                </div><!--/.single-room-list-->

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
    $(function (){
    	$('#billing_country').selectbox({
            onChange: function(val, inst){
                if(val != ''){
                    $.ajax({
                        url: "{{ url('checkout/getStates') }}",
                        type: 'POST',
                        data: {country_id:val, _token: '{{ csrf_token() }}'},
                        dataType: 'json',
                        async: false,
                        cache: false,
                        beforeSend:function (){
                            $('#billing_state').selectbox("detach");
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

                            $('#billing_state').html(html);
                            $('#billing_state').selectbox("attach");
                        }
                    });
                }
                else{
                    $('#billing_state').html('<option value="">State</option>');
                }
            },
            effect: "fade"
        });
    });
</script>

<script>
         function checkPass()
        {
            //Store the password field objects into variables ...
            var password = document.getElementById('password');
            var passconf = document.getElementById('passconf');
            //Store the Confimation Message Object ...
            var message = document.getElementById('confirmMessage');
            //Set the colors we will be using ...
            var goodColor = "#66cc66";
            var badColor = "#ff6666";
            //Compare the values in the password field
            //and the confirmation field
            if(password.value == passconf.value){
                //The passwords match.
                //Set the color to the good color and inform
                //the user that they have entered the correct password
                passconf.style.backgroundColor = goodColor;
                message.style.color = goodColor;
                message.innerHTML = "Passwords Match!"
            }else{
                //The passwords do not match.
                //Set the color to the bad color and
                //notify the user.
                passconf.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "Passwords Do Not Match!"
            }
        }

 </script>







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

<?php
	// Brands & Services are done in the templateFront.blade.php
	if(isset($brands_scroller)) unset($brands_scroller);
?>

@endsection
