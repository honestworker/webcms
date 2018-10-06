@extends('front/templateFront')

@section('content')
              
        <section id="content">
            <div class="container">
                <div class="row">
                	<div class="col-md-12">
                    <div class="section-title-area text-center">
                        <h2 class="section-title">Reset Password</h2>
                        <p class="section-title-dec">Let's get you logged back in.</p>
                    </div>
                        <div class="xs-margin"></div>
                        <div class="row">
                        	<div class="col-md-12">


                                            <div class="row row-resetpassword" style="border: 1px solid #e0e0e0; padding: 20px 20px;">
                                                
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <!-- <h2 class="checkout-title text-center">Reset Your Login Password</h2> -->
                                                    <h4 class="comment-reply-title" style="padding-bottom: 30px;"> Reset Your Login Password</h4>
                                                      	@if(Session::has('error'))
                                                    		<!-- <div class="alert alert-danger">
                                                            	<div class="alert-box success">
                                                                	<p>{{ Session::get('error') }}</p>
                                                            	</div>
                                               		 		</div> -->
                                                            <div class="alert alert-danger">
                                                                <i class="fa fa-exclamation-triangle"></i> &nbsp;<strong>We are sorry!</strong> {{ Session::get('error') }}. 
                                                            </div>
                                                		@endif
                                                
                                                		@if(Session::has('success'))
                                                            <div class="alert alert-success">
                                                                <i class="fa fa-thumbs-up"></i> &nbsp;<strong>Success!</strong>  {{ Session::get('success') }}.
                                                            </div>
                            							@endif
                                                    <div class="xs-margin"></div>
                                                    <form action="passwordreset" id="newpassword-form" method="post" name="newpassword-form" enctype="multipart/form-data" style="padding-top: 30px;">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                        <input type="hidden" name="redirect" value="dashboard" />
                                                        <input type="hidden" name="email" value="{{ Input::get('email') }}" />
                                                        <input type="hidden" name="code" value="{{ Input::get('code') }}" />
                                                        <div class="col-md-12 col-sm-12">
                                                            <p>Please type in the new password below.</p>
                                                        </div>
                                                        
                                                        <div class="col-md-6 col-sm-6 padding-right">
                                                            <p style="border-bottom: 1px solid #e0e0e0 !important;">
                                                                <input type="password" name="password" id="password"  required="required" aria-required="true" placeholder="Your Password *" class="form-controllar">
                                                            </p>
                                                        </div>

                                                        <div class="col-md-6 col-sm-6 padding-right" style="margin-bottom: 25px;">
                                                            <p style="border-bottom: 1px solid #e0e0e0 !important;">
                                                                <input min="8" max="12" type="password" name="password" id="password"  required="required" aria-required="true" placeholder="Verify New Password *" class="form-controllar">
                                                            </p>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12">
                                                        <div class="alert alert-info"><i class="fa fa-info-circle"></i> &nbsp;<strong>Note:</strong> Password length should be between 8-12 characters with combination of alphabet letters, digits &amp; special characters (eg. *@$!+%~)</div>
                                                        </div>
                                                        <!-- <div class="input-group xs-margin">
                                                            <span class="input-group-addon"><i class="fa fa-lock"></i>  
                                                            <span class="input-text">Password &#42;</span></span>
                                                            <input min="8" max="12" type="password" name="password" id="password"  required="required" class="form-control input-lg" placeholder="Your Password">                                                      
                                                        </div> -->
                                                    
                                                    <!-- <div class="input-group xs-margin">
                                                        <span class="input-group-addon"><i class="fa fa-lock"></i>  
                                                        <span class="input-text"> Confirm Password &#42;</span></span>
                                                        <input  min="8" max="12"  required="required" type="password" name="passconf" id="passconf" onkeyup="checkPass(); return false;" class="form-control input-lg" placeholder="Verify Password">
                                                        <span id="confirmMessage" class="confirmMessage"></span>
                                                    </div>
                                                    <div class="alert alert-info"><i class="fa fa-info-circle"></i> &nbsp;<strong>Note:</strong> Password length should be between 8-12 characters with combination of alphabet letters, digits &amp; special characters (eg. *@$!+%~)</div> -->
                                                           
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
                                                    
                                                  <!-- <span class="btn btn-custom pull-left "><input type="submit" name="submit" value="Reset"class="btn btn-custom pull-left myclass" /><i class="fa fa-sign-in"></i></span> -->
                                                   </form> 
                                                </div>
                                               
                                                
                                            </div>
                                            <!-- end col-md-12 -->
                                            
                                            <!-- Modal Forgot Passwrod start -->
                                            <div class="modal fade" id="modal-forgot-password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                                                <form id="login-form-2" method="post" action="passwordreset" name="login-form-2" enctype="multipart/form-data" >
                                                 <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                 <input type="hidden" name="email" value="{{ Input::get('email') }}" />
                                                <input type="hidden" name="code" value="{{ Input::get('code') }}" />
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


                                
    						</div>
                        </div>
                        <div class="lg-margin"></div>
                        <div class="text-center" style="margin: 20px 0;">
                            <button name="reset" id="reset" onclick="document.getElementById('newpassword-form').submit();" class="btn btn-default">Reset Password</button>
                        </div>
                        
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
