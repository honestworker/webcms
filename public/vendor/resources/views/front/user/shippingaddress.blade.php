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
                            <h2>Shipping Information</h2>
                            <span class="small-bottom-border big"></span>
                            <p>View &amp; edit your shipping information.</p>
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

                                <div class="sm-margin"></div>


                               	<form method="post" action="" id="billing_form" name="billing_form">
                                	<input type="hidden" name="userId" value="<?php echo $userDetail[0]->id;?>" />
                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                                	<!-- account info start -->
                                	<div class="row">
                                		<div class="col-md-12">
                                		<h3 class="checkout-title">Contact Information</h3>
                                        <div class="row">
                                              <div class="col-md-6 col-sm-6 col-xs-12">
													<div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i> <span class="input-text">First Name &#42;</span></span>
                                                    	<input name="shipping_first_name" type="text" class="form-control input-lg" value="<?php echo $userDetail[0]->shipping_first_name;?>" required placeholder="Your First Name">
                                                    </div>

                                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-phone"></i> <span class="input-text">Telephone &#42;</span></span>
                                                    	<input name="shipping_telephone" type="text" class="form-control input-lg" value="<?php echo $userDetail[0]->shipping_telephone;?>" required placeholder="Your Telephone">
                                                    </div>


                                                 </div>
                                                 <!-- end col-md-6 -->

                                                 <div class="col-md-6 col-sm-6 col-xs-12">
                                                     <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i> <span class="input-text">Last Name &#42;</span></span>
                                                          <input name="shipping_last_name" type="text" class="form-control input-lg" value="<?php echo $userDetail[0]->shipping_last_name;?>" required placeholder="Your Last Name">
                                                      </div>

                                                      <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i> <span class="input-text">Email &#42;</span></span>
                                                          <input name="shipping_email" type="text" class="form-control input-lg" value="<?php echo $userDetail[0]->shipping_email;?>" required placeholder="Your Email (Login ID)">
                                                       </div>


                                                    	<div class="clearfix"></div>



                                                    	</div>
                                                    	<!-- end col-md-6 -->

                                                    </div>
                                                    <!-- end your details -->


                                                    <h2 class="checkout-title">Address</h2>
													<div class="xs-margin"></div>
                                                         <div class="input-group"><span class="input-group-addon"><i class="fa fa-building-o"></i> <span class="input-text">Address &#42;</span></span>
                                                                <textarea name="shipping_address" id="contact-message" class="form-control" cols="30" rows="2" placeholder="Your Address"><?php echo $userDetail[0]->shipping_address;?></textarea>

                                                        </div>
                                                        <div class="row">
                                                        	<div class="col-md-6 col-sm-6 col-xs-12">

                                                            	<div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">City &#42;</span></span>
                                                                <input name="shipping_city" type="text" class="form-control input-lg" value="<?php echo $userDetail[0]->shipping_city;?>" required placeholder="Your City">
                                                            	</div>

                                                        	</div>

                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">Post Code &#42;</span></span>
                                                                    <input type="text" name="shipping_post_code" class="form-control input-lg" value="<?php echo $userDetail[0]->shipping_post_code;?>" required placeholder="Your Post Code">
                                                                </div>
                                                            </div>
                                                            <!-- end col-md-6 -->
                                                        </div>
                                                        <!-- end row -->

                                                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">State &#42;</span></span>
                                                                <div class="large-selectbox clearfix">
                                                                    <select id="shipping_state" name="shipping_state" style="height: 47px; width: 100%; border-color: #dcdcdc;" class="selectbox">
                                                                    	@foreach($states as $state)
                                                                            <option <?php if($userDetail[0]->shipping_state==$state->zone_id){?> selected="selected"<?php }?> value="{{ $state->zone_id }}">{{ $state->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                        </div>

                                                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-flag"></i> <span class="input-text">Country &#42;</span></span>
                                                                <div class="large-selectbox clearfix">
                                                                    <select id="shipping_country" name="shipping_country" style="height: 47px; width: 100%; border-color: #dcdcdc;">
                                                                        <option value="">Country</option>
                                                                        @foreach($countries as $country)
                                                                            <option <?php if($userDetail[0]->shipping_country==$country->country_id){?> selected="selected"<?php }?> value="{{ $country->country_id }}">{{ $country->name }}</option>

                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                        </div>

                                                    <!-- end your address -->

                                    </div>
                                    	<!-- end col-md-12 -->
                               		</div>
                               		<!-- end row -->

                                        <div class="md-margin"></div>
                                        <a href="javascript:window.history.back();" class="btn btn-custom"><i class="fa fa-angle-double-left"></i> BACK</a>
                                        <a onclick="javascript:billing_form.submit();" class="btn btn-custom">SAVE &nbsp;<i class="fa fa-floppy-o"></i></a>
                                 </form>
                                 <script>
$(function (){

    $('#shipping_country').selectbox({
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
                        $('#shipping_state').selectbox("detach");
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

                        $('#shipping_state').html(html);
                        $('#shipping_state').selectbox("attach");
                    }
                });
            }
            else{
                $('#shipping_state').html('<option value="">State</option>');
            }
        },
        effect: "fade"
    });
});
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
