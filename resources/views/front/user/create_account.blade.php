@extends('front/templateFront')

@section('content')
    
    
  <div class="room-single-area">
      <div class="container">
      	<div class="row">
          <div class="col-md-12 col-full-width">
            <div class="section-title-area text-center">
              <h2 class="section-title">Create An Account</h2>
              <p class="section-title-dec">View and track your bookings in your account and more.</p>
            </div><!--/.section-title-area-->
          </div><!--/.col-md-8-->
        </div><!--/.row-->
        
        
        
        <div class="row">
        	<div class="col-md-6 col-sm-12 col-xs-12">
            
            	<div class="room-comments-area">
                  <div id="respond" class="comment-respond box-radius">
                    <div class="row">
                      <div class="col-md-12">
                        <h4 class="comment-reply-title">Your Details</h4><!--/.comment-reply-title--> 
                      </div><!--/.col-md-12-->
                    </div><!--/.row-->
                    
                    
                    
                    
                    
                     @if(Session::has('error'))
                                    	<div class="alert alert-danger">
                                        	<div class="alert-box success">
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
                                        </div>
                                    @endif
                                     
                                     
                
                                    @if(Session::has('success'))
                                   		<div class="alert alert-success">
                                            <div class="alert-box success">
                                                <p>{{ Session::get('success') }}</p>
                                            </div>
                                        </div>
                                    @endif
                    
                    
                    
                    
                    
                    
                    
                    <div class="row">
                      <div class="col-md-12">
          <form action="create_account" id="billing-form" method="post" enctype="multipart/form-data" name="registration-form">
                                                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                                  <div class="row">
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                              
                           <input type="text" name="billing_first_name" id="first_name" aria-required="true" placeholder="First Name *" class="form-controllar" value="{{ old('billing_first_name') }}">
                              </p>
                            </div><!--/.col-md-6-->
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                          
                                                          
                                <input type="text" name="billing_last_name" id="last_name" aria-required="true" placeholder="Last Name *" value="{{ old('billing_last_name') }}" class="form-controllar">
                              </p>
                            </div><!--/.col-md-6-->
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>

                                <input type="text" name="billing_telephone" id="tel" aria-required="true" placeholder="Telephone *" value="{{ old('billing_telephone') }}"   class="form-controllar">
                              </p>
                            </div><!--/.col-md-6-->
                            
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                              
                              
                                <input type="text" name="birth_date" id="passport_nric" aria-required="true" data-date-format="d/mm/yyyy" placeholder="dd/mm/yyyy *" value="{{ old('birth_date') }}"class="datepicker-default form-controllar">
                              </p>
                            </div><!--/.col-md-6-->
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                                                        
                                <input type="text" name="billing_email" id="email" aria-required="true" placeholder="Your Email (Login ID) *" value="{{ old('billing_email') }}" class="form-controllar">
                              </p>
                            </div><!--/.col-md-6-->
                            <div class="clearfix"></div>
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                                <input type="password" name="password" id="password" aria-required="true" placeholder="Your Password *" class="form-controllar">
                              </p>
                            </div><!--/.col-md-6-->
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                              
                                <input type="password" name="passconf" id="passconf" onkeyup="checkPass(); return false;" aria-required="true" placeholder="Verify Password *" class="form-controllar">
                            <span id="confirmMessage" class="confirmMessage"></span>    
                              </p>
                            </div><!--/.col-md-6-->
                           
                           
                           
                           
                           
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
}   </script>
                           
                           
                           
                           
                           
                           
                           
                           
                           
                           
                            
                            
                            <div class="col-md-12">
                              <p><div class="alert alert-info"><i class="fa fa-info-circle"></i> &nbsp;<strong>Note:</strong> Password length should be between 8-12 characters</div></p>
                               
                            </div><!--/.col-md-12-->
                           
                          </div><!--/.row-->
                        <!--/#comment_form-->
                      </div><!--/.col-md-12-->
                    </div><!--/.row-->
                  </div><!--/.comment-respond--> 
                </div>
                
            </div><!--/.col-md-6-->
            
            <div class="col-md-6 col-sm-12 col-xs-12">
            
            	<div class="room-comments-area">
                  <div id="respond" class="comment-respond box-radius">
                    <div class="row">
                      <div class="col-md-12">
                        <h4 class="comment-reply-title">Address</h4><!--/.comment-reply-title--> 
                      </div><!--/.col-md-12-->
                    </div><!--/.row-->
                    <div class="row">
                      <div class="col-md-12">
                        
                        
                       <?php /*?> <form action="create_account" id="comment_form" method="post" enctype="multipart/form-data" name="registration-form">
                                                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
        
                       <?php */?> 
                        
                          <div class="row">
                            <div class="col-md-12">
                              <p>
                              
                                <textarea name="billing_address" id="message" aria-required="true" rows="3" cols="45" placeholder="Address *" class="form-controllar">{{ old('billing_address') }}</textarea>
                              </p>
                            </div><!--/.col-md-12-->
                            
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>

                                <input type="text" name="billing_city" id="city" aria-required="true" placeholder="City *" class="form-controllar" value="{{ old('billing_city') }}">
                              </p>
                            </div><!--/.col-md-6-->
                            
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>

                                                          
             <input type="text" name="billing_post_code" id="postcode" aria-required="true" placeholder="Post Code *" class="form-controllar"value="{{ old('billing_post_code') }}">
                              </p>
                            </div><!--/.col-md-6-->
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                                <div class="input box-radius">
                                     <select id="billing_state" name="billing_state" class="selectbox"><!--<option value="">States</option>--><option value="1971">Johor</option><option value="1972">Kedah</option><option value="1973">Kelantan</option><option value="1985">Kuala Lumpur</option><option value="1974">Labuan</option><option value="1975">Melaka</option><option value="1976">Negeri Sembilan</option><option value="1977">Pahang</option><option value="1978">Perak</option><option value="1979">Perlis</option><option value="1980">Pulau Pinang</option><option value="4035">Putrajaya</option><option value="1981">Sabah</option><option value="1982">Sarawak</option><option value="1983">Selangor</option><option value="1984">Terengganu</option></select>
                                                                
                                  </div>
                              </p>
                            </div><!--/.col-md-6-->
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                              <div class="input box-radius">
                                     <select id="billing_country" name="billing_country" class="selectbox">
                                                                        <option value="">Country</option>
                                                        @foreach($countries as $country)
                                                            <option <?php if($country->country_id==129){ echo "selected=selected";} ?> value="{{ $country->country_id }}">{{ $country->name }}</option>
                                                        @endforeach
                                                                    </select>
                                  </div>
                              </p>
                            </div><!--/.col-md-6-->
                                                       
                                                       
                          </div><!--/.row-->
                          
                        <!--/#comment_form-->
                      </div><!--/.col-md-12-->
                    </div><!--/.row-->

                  </div><!--/.comment-respond--> 
                </div>
                
            </div><!--/.col-md-6-->                
                            
        </div><!--/.row-->
        
         <div class="row">
         	<div class="col-md-12">
            
            	<p><div class="input-group custom-checkbox">
           
                                 <input type="checkbox" checked="checked" name="newsletter_subscription" id="newsletter_subscription" value="1"> Yes! I would like to subscribe to Ritz Garden Hotel's newsletter to receive latest offers, promotions, discounts and FREE gifts.
                                </div></p>
                                
                              <p><div class="input-group custom-checkbox">
                                   						
                                 <input required="required" type="checkbox" checked="checked"  name="agree" id="agree" value="1"> I agree Ritz Garden Hotel's <a href="#">terms &amp; conditions</a>, <a href="#">privacy policy</a>
                                </div></p>
                              <p>Please enter the security code shown below: </p>
                              <p><div class="g-recaptcha" data-sitekey="6LdEyCkUAAAAADtYmoo4R4PWwM18_buEPaDja0sa"></div></p>
                        <div class="md-margin"></div>
            	<div class="pull-left">
            <input type="submit" name="submit" value="Create an Account Now" class="btn btn-default" style="margin-bottom:10px;" />
                </div>
                </form>              
            </div><!--/.col-md-12-->
                    
      	</div><!--/.row-->
        
      </div><!--/.container-->
    </div><!--/.room-grid-area-->
      
 <!-- Modal Forgot Passwrod start -->
    <div class="modal fade" id="modal-forgot-password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <form id="login-form-2" method="get" action="#">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel2">Forgot Your Password?</h4>
                </div><!-- End .modal-header -->
                <div class="modal-body clearfix">

                    <p>Please enter your registered email address and we will help you to reset the password. The new generated password will be sent to the email address you entered below.</p>
                    <div class="xs-margin"></div>
                    <div class="col-md-9">
                        
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i> <span class="input-text">Email &#42;</span></span>
                            <input type="text" required class="form-control input-lg" placeholder="Your Email">
                        </div>
                        
                                                                     
                
                </div>

                </div><!-- End .modal-body -->
                <div class="modal-footer">
                    <button class="btn btn-custom-2">RESET PASSWORD</button>
                    <button type="button" class="btn btn-custom" data-dismiss="modal">CLOSE</button>
                </div><!-- End .modal-footer -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
        </form>
    </div>
 <!-- End .modal forgot password -->
    
       
    
    
     <section data-jarallax="{&quot;speed&quot;: 0.3, &quot;imgSrc&quot;: &quot;public/front/images/parallax/bg_hotel_services.jpg&quot; }" class="hotel-service-section jarallax">
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
                      <img src="images/hotel_services/icon_tour_desk.png" alt="Tour Desk">
                    </div>
                    <h5>Tour Desk</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->
                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                      <img src="images/hotel_services/icon_reception.png" alt="24 hour Reception">
                    </div>
                    <h5>24 hour Reception</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->
                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                    	<img src="images/hotel_services/icon_wifi.png" alt="WiFi">
                    </div>
                    <h5>WiFi Internet</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->
                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                    	<img src="images/hotel_services/icon_elevator.png" alt="Lift/Elevator">
                    </div>
                    <h5>Lift / Elevator</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->
                
                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                    	<img src="images/hotel_services/icon_no-smoking.png" alt="Non-Smoking Room">
                    </div>
                    <h5>Non-Smoking Rooms</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->
                
                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                    	<img src="images/hotel_services/icon_laundry.png" alt="Guest Laundry">
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
    
    
    
    
    
    
    
    
    
    
    
    
    
    

<!--LOADING SCRIPTS FOR PAGE-->
<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/vendors/bootstrap-datepicker/css/datepicker.css') }}">
<script src="{{ asset('/public/admin/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/moment/moment.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-clockface/js/clockface.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/jquery-maskedinput/jquery-maskedinput.js') }}"></script>
<script src="{{ asset('/public/admin/js/form-components.js') }}"></script>
<!--LOADING SCRIPTS FOR PAGE-->
	
   <script>
$(function (){
	$('select[name="billing_country"]').change(function(){
		var country_id = $(this).val();
		if(country_id != ''){
			$.ajax({
				url: "{{ url('users/getStates') }}",
				type: 'POST',
				data: {country_id:country_id, _token: $('#_token').val()},
				dataType: 'json',
				async: false,
				cache: false,
				beforeSend:function (){
					$('select[name="billing_state"]').html('<option value="">Loading...</option>');
				},
				complete: function(){
					
				},
				success: function (response) {
					var html = '';
					//html += '<option value="">States</option>';
					if(response['states']){
						for(var i = 0; i < response['states'].length; i++){
							html += '<option value="' + response['states'][i]['zone_id'] + '">' + response['states'][i]['name'] + '</option>';
						}
					}
					
					$('select[name="billing_state"]').html(html);
				}
			});
		}
		else{
			$('select[name="billing_state"]').html('<option value="">State</option>');
		}
	});
});
</script>   
    
@endsection
