<!--================= Page Wellcome Area ===================-->
    <div class="page-heading-area sub-banner5">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h2 class="page-heading">
            </h2><!--/.page-heading-->
          </div><!--/.col-md-12-->
        </div><!--/.row-->
      </div><!--/.container-->
    </div><!--/.welcome-section-->
    <!--================= Content Area ===================-->
    <div class="room-single-area">
      <div class="container">
        <div class="row" id="head">
          <div class="col-md-12 col-full-width">
            <div class="section-title-area text-center">
              <h2 class="section-title">Contact Us</h2>
              <p class="section-title-dec">We would like to hear from you.</p>
                    <?php if (Session::get('contact_us') == '1') { ?>
                        <div class="alert alert-success">
                            <strong>Thank You for Contacting Us!</strong> We will contact you shortly! .
                        </div>

                    <?php } elseif (Session::get('contact_us') == '0') { ?>
                        <div class="alert alert-danger">
                            <strong>Please Try Again!</strong> Error while saving contact us!.
                        </div>
                    <?php } ?>
            </div><!--/.section-title-area-->
          </div><!--/.col-md-8-->
        </div><!--/.row-->



        <div class="row">
        	<div class="col-md-6 col-sm-12 col-xs-12">

            <div class="room-comments-area">
               <div id="respond" class="comment-respond box-radius">
               	  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d63630.574883351765!2d101.087952!3d4.609963!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb64408481a66e0a!2sRitz+Garden+Hotel!5e0!3m2!1sen!2s!4v1492794773324" width="100%" height="355" frameborder="0" style="border:0" allowfullscreen></iframe>

               </div><!--/.comment-respond-->
            </div>

            <div class="contact-us-content">
              <div class="single-contact-info">
                <h2 class="title">Ritz Garden Hotel</h2>
                <div class="content">
                  <p>No. 86 &amp; 88, Jalan Yang Kalsom, 30250 Ipoh, Perak Darul Ridzuan, Malaysia.</p>
                  <p>Tel: (05) 242-7777</p>
                  <p>Fax: (05) 242-5845</p>
                  <p><a href="mailto:sales@ritzgardenhotel.com">sales@ritzgardenhotel.com</a> / <a href="mailto:lily@ritzgardenhotel.com">lily@ritzgardenhotel.com</a></p>
                </div>
              </div><!--/.single-contact-info-->

            </div><!--/.contact-us-content-->
          </div><!--/.col-md-6-->


            <div class="col-md-6 col-sm-12 col-xs-12">
            	<div class="room-comments-area">
                  <div id="respond" class="comment-respond box-radius">
                    <div class="row">
                      <div class="col-md-12">
                        <h4 class="comment-reply-title">General Details</h4><!--/.comment-reply-title-->
                      </div><!--/.col-md-12-->
                    </div><!--/.row-->
                        <form action="{{url('/contact-us/create')}}" method="post" id="comment_form" name="commentForm" action="">
                            <div class="row">
                                <div class="col-md-12">
                        <input type="hidden" name="_token"  id="_token" value="{{ csrf_token() }}" />
                          <div class="row">
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                                <input type="text" name="first_name" id="first_name" aria-required="true" placeholder="First Name *" class="form-controllar">
                              </p>
                            </div><!--/.col-md-6-->
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                                <input type="text" name="last_name" id="last_name" aria-required="true" placeholder="Last Name *" class="form-controllar">
                              </p>
                            </div><!--/.col-md-6-->
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                                <input type="text" name="company_name" id="company_name" aria-required="true" placeholder="Company Name" class="form-controllar">
                              </p>
                            </div><!--/.col-md-6-->

                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                                <input type="text" name="occupation" id="occupation" aria-required="true" placeholder="Occupation" class="form-controllar">
                              </p>
                            </div><!--/.col-md-6-->
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                                <input type="text" name="tel" id="tel" aria-required="true" placeholder="Telephone *" class="form-controllar">
                              </p>
                            </div><!--/.col-md-6-->
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                                <input type="text" name="fax" id="fax" aria-required="true" placeholder="Fax" class="form-controllar">
                              </p>
                            </div><!--/.col-md-6-->
                            <div class="clearfix"></div>
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                                <input type="text" name="email" id="email" aria-required="true" placeholder="Email *" class="form-controllar">
                              </p>
                            </div><!--/.col-md-6-->


                          </div><!--/.row-->

                      </div><!--/.col-md-12-->
                    </div><!--/.row-->

                    <div class="clearfix margin-top"></div>

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
                                <textarea name="Address" id="message" aria-required="true" rows="3" cols="45" placeholder="Address *" class="form-controllar"></textarea>
                              </p>
                            </div><!--/.col-md-12-->

                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                                <input type="text" name="city" id="city" aria-required="true" placeholder="City *" class="form-controllar">
                              </p>
                            </div><!--/.col-md-6-->

                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                                <input type="text" name="postcode" id="postcode" aria-required="true" placeholder="Post Code *" class="form-controllar">
                              </p>
                            </div><!--/.col-md-6-->
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                               <div class="input box-radius">
                                     <select id="billing_state" name="billing_state" class="selectbox">
                                         <option value="1971">Johor</option>
                                         <option value="1972">Kedah</option>
                                         <option value="1973">Kelantan</option>
                                         <option value="1985">Kuala Lumpur</option>
                                         <option value="1974">Labuan</option>
                                         <option value="1975">Melaka</option>
                                         <option value="1976">Negeri Sembilan</option>
                                         <option value="1977">Pahang</option>
                                         <option value="1978">Perak</option>
                                         <option value="1979">Perlis</option>
                                         <option value="1980">Pulau Pinang</option>
                                         <option value="4035">Putrajaya</option>
                                         <option value="1981">Sabah</option>
                                         <option value="1982">Sarawak</option>
                                         <option value="1983">Selangor</option>
                                         <option value="1984">Terengganu</option>
                                     </select>

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

                          <div class="clearfix margin-top"></div>

                          <div class="row">
                              <div class="col-md-12">
                                <h4 class="comment-reply-title">Comments</h4><!--/.comment-reply-title-->
                              </div><!--/.col-md-12-->
                            </div><!--/.row-->

                            <div class="row">
                              <div class="col-md-12">
                              <p>
                                <input type="text" name="subject" id="subject" aria-required="true" placeholder="Subject *" class="form-controllar">
                              </p>
                            </div><!--/.col-md-12-->
                              <div class="col-md-12">
                              <p>
                                <textarea name="comment_enquiry" id="message" aria-required="true" rows="3" cols="45" placeholder="Comment/Enquiry *" class="form-controllar"></textarea>
                              </p>

                              <p>Please enter the security code shown below: </p>
                              <p><div class="g-recaptcha" data-sitekey="6LdEyCkUAAAAADtYmoo4R4PWwM18_buEPaDja0sa"></div></p>
                            </div><!--/.col-md-12-->
                            </div><!--/.row-->


                            <div class="text-center">
                                <p><button class="btn btn-default" type="submit">Submit</button></p>
                            </div>

                        </form><!--/#comment_form-->
                      </div><!--/.col-md-12-->
                    </div><!--/.row-->

                  </div><!--/.comment-respond-->
                </div>

            </div><!--/.col-md-6-->

        </div><!--/.row-->
        <div class="clearfix margin-top"></div>

      </div><!--/.container-->
    </div><!--/.room-grid-area-->


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
