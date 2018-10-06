@extends('front/templateFront')
@section('content')

<!--================= Page Wellcome Area ===================-->
    
    <!--================= Content Area ===================-->
 
    <div class="room-single-area">
      <div class="container">
      	<div class="row">
          <div class="col-md-12 col-full-width">
            <div class="section-title-area text-center">
              <h2 class="section-title">Login</h2>
              <p class="section-title-dec">View your bookings and manage your details.</p>
            </div><!--/.section-title-area-->
          </div><!--/.col-md-8-->
        </div><!--/.row-->
        
        
        
        <div class="row">
        	<div class="col-md-6 col-sm-12 col-xs-12">
            
            	<div class="room-comments-area">
                  <div id="respond" class="comment-respond box-radius">
                    <div class="row">
                      <div class="col-md-12">
                        <h4 class="comment-reply-title">Returning Customers</h4><!--/.comment-reply-title--> 
                      </div><!--/.col-md-12-->
                    </div><!--/.row-->
                    <div class="row">
                      <div class="col-md-12">
                           <form action="login" id="login-form" method="post" name="login-form" enctype="multipart/form-data">
                          <div class="row">
                          	<div class="col-md-12">
                            	<div class="alert alert-danger">
                              		<i class="fa fa-exclamation-triangle"></i> &nbsp;<strong>We are sorry!</strong> Your account does not exist. If you don't have an account with us, please proceed to registration page.
                                </div>
                                <div class="alert alert-danger">
                                	<i class="fa fa-exclamation-triangle"></i> &nbsp;<strong>Oops!</strong> You have entered wrong User ID or Password. Please try again.
                                </div>
                            	<p>If you have an account with us, please log in.</p>
                            </div><!--/.col-md-12-->
                          	 <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                              <input type="hidden" name="redirect" value="dashboard" />
                                                   
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                       <input type="text"  id="email" name="email" required class="form-control input-lg" placeholder="Your Email">
                              </p>
                            </div><!--/.col-md-6-->
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                    <input type="password" name="password" id="password" required class="form-control input-lg" placeholder="Your Password">
                              </p>
                            </div><!--/.col-md-6-->
                            
                            <div class="pull-left">
           <input type="submit" name="submit" value="LOGIN"class="btn btn-default" />
         
                            </div>

                            
                          </div><!--/.row-->
                          
                          
                        </form><!--/#comment_form-->
                        
                        <div class="margin-top">
                     <a href="#" data-toggle="modal" data-target="#modal-forgot-password">Forgot your password?</a>

                        </div>
                        
                        
                        <!-- Modal Forgot Passwrod start -->
                                            <div class="modal fade" id="modal-forgot-password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                                                <form id="login-form-2" method="post" action="login/reset" name="login-form-2" enctype="multipart/form-data" >
                                                 <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <button type="button" onClick="$('.form-horizontal').trigger('reset');" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                        <h4 class="modal-title" id="myModalLabel2">Forgot Your Password?</h4>
                                                        </div><!-- End .modal-header -->
                                                        <div class="modal-body clearfix">
            
                                                            <p>Please enter your registered email address and we will help you to reset the password. The new generated password will be sent to the email address you entered below.</p>
                                                            <div class="xs-margin"></div>
                                                            <div class="col-md-9">
                                                                
                                                                <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i> <span class="input-text">Email &#42;</span></span>
                                                                    <input id="email"  name="email" type="text" required class="form-control input-lg" placeholder="Your Email">
                                                                </div>
                                                                
                                                                                                             
                                                        
                                                        </div>
            
                                                        </div><!-- End .modal-body -->
                                                        <div class="modal-footer">
                                                            <button name="reset" id="reset" onclick="document.getElementById('login-form-2').submit();" class="btn btn-custom-2">RESET PASSWORD</button>
                                                            <button type="button" class="btn btn-custom" data-dismiss="modal" onClick="$('.form-horizontal').trigger('reset');" >CLOSE</button>
                                                        </div><!-- End .modal-footer -->
                                                    </div><!-- End .modal-content -->
                                                </div><!-- End .modal-dialog -->
                                                </form>
                                            </div><!-- End .modal forgot password -->
 
                        
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
                        <h4 class="comment-reply-title">Don't Have An Account Yet?</h4><!--/.comment-reply-title--> 
                      </div><!--/.col-md-12-->
                    </div><!--/.row-->
                    <div class="row">
                      <div class="col-md-12">
                        <form action="#" method="post" id="comment_form" name="commentForm">
                          <div class="row">
                          	<div class="col-md-12">
                            	
                            	<p>By creating an account with us, you will be able to view your bookings in your account and more. </p>
                            </div><!--/.col-md-12-->
                          	
                            
                            <div class="pull-left">
								<a href="{{ url('create_account') }}" class="btn btn-default">Create an Account</a>
                            </div>
                            
                          </div><!--/.row-->
                          
                          
                        </form><!--/#comment_form-->
    
                        
                      </div><!--/.col-md-12-->
                    </div><!--/.row-->

                  </div><!--/.comment-respond--> 
                </div>
                
            </div><!--/.col-md-6-->                
                            
        </div><!--/.row-->
        
         <br/>
        
      </div><!--/.container-->
    </div><!--/.room-grid-area-->
    
    
    <section data-jarallax="{&quot;speed&quot;: 0.3, &quot;imgSrc&quot;: &quot;public/frontimages/parallax/bg_hotel_services.jpg&quot; }" class="hotel-service-section jarallax">
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
                      <img src="{{ asset('public/front/images/hotel_services/icon_tour_desk.png') }}" alt="Tour Desk">
                    </div>
                    <h5>Tour Desk</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->
                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                      <img src="{{ asset('public/front/images/hotel_services/icon_reception.png') }}" alt="24 hour Reception">
                    </div>
                    <h5>24 hour Reception</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->
                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                    	<img src="{{ asset('public/front/images/hotel_services/icon_wifi.png') }}" alt="WiFi">
                    </div>
                    <h5>WiFi Internet</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->
                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                    	<img src="{{ asset('public/front/images/hotel_services/icon_elevator.png') }}" alt="Lift/Elevator">
                    </div>
                    <h5>Lift / Elevator</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->
                
                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                    	<img src="{{ asset('public/front/images/hotel_services/icon_no-smoking.png') }}" alt="Non-Smoking Room">
                    </div>
                    <h5>Non-Smoking Rooms</h5>
                  </div><!--/.single-hospitality-->
                </div><!--/.item-->
                
                <div class="item">
                  <div class="single-hospitality box-radius">
                    <div class="icon">
                    	<img src="{{ asset('public/front/images/hotel_services/icon_laundry.png') }}" alt="Guest Laundry">
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
@endsection