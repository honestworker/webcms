@extends('front/templateFront')

@section('content')

        <section id="content">
        	<!--<div id="page-header-contact-us">

               <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3983.9908804872025!2d101.675496!3d3.0970830000000005!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4a0badb5cb31%3A0xc773e259de7932f1!2sTBM+-+Jalan+Klang+Lama+(Tan+Boon+Ming+Sdn+Bhd)!5e0!3m2!1sen!2smy!4v1419592415036" width="100%" height="360" frameborder="0" style="border:0"></iframe>

            </div>
            <div class="md-margin2x"></div>-->
            <div id="breadcrumb-container" class="light">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="file:///C|/Users/Webqom/AppData/Roaming/Skype/My Skype Received Files/index.html"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Contact Us</li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="row">
                	<div class="col-md-12">
                    	<div class="hero-unit">
                           {!! $data['header'] !!}
                            <span class="small-bottom-border big"></span>
                            {!! $data['title'] !!}
                        </div>
                        <div class="md-margin2x"></div>

                      <div class="col-md-6 col-sm-6 col-xs-12">
                        	{!! $data['lone'] !!}
                             <div class="xs-margin"></div>
                             {!! $data['ltwo'] !!}
                        </div>
                        <!-- col-md-6 -->

                        <div class="col-md-6 col-sm-6 col-xs-12">
                        	 {!! $data['rone'] !!}
                                      <div class="xs-margin"></div>
                              {!! $data['rtwo'] !!}
                        </div>
                        <!-- col-md-6 -->

						<div class="clearfix"></div>
                        <div class="xlg-margin"></div>
                        <hr>
                        <div class="md-margin"></div>
                        <!-- Message -->
						<div class="wbx-result alert alert-success alert-dismissable"
			  @if( Session::get('success') )
				style="display: block;" data="show">

			<? Session::forget('success') ?>
			@else
				style="display: none;">
			@endif
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                <p>The message has been send successfully.</p>
              </div>
              <div class="wbx-result alert alert-danger alert-dismissable"
			@if( Session::get('fail') )
				style="display: block;" data="show">
			<? Session::forget('fail') ?>
			@else
				style="display: none;">
			@endif
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                <p>The message has not been send. Please correct the errors.</p>
              </div>
                        <!-- Message -->
                        <div class="col-md-12">
                                {!! $data['footer'] !!}
                               <div class="row">
									<form method="POST" action="" accept-charset="UTF-8" id="contact-form">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i> <span class="input-text">Name &#42;</span></span>
                                                <input type="text" name="message[name]" id="contact-name" required class="form-control input-lg"
placeholder="Your Name">
                                            </div>

                                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-building"></i> <span class="input-text">Company Name &#42;</span></span>
                                                <input type="text" name="message[company]" id="contact-name" required class="form-control input-lg"
placeholder="Company Name">
                                            </div>
                                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-suitcase"></i> <span class="input-text">Occupation &#42;</span></span>
                                                <input type="text" name="message[occupation]" id="contact-subject" required class="form-control input-lg"  placeholder="Your Occupation">
                                            </div>
                                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-phone"></i> <span class="input-text">Telephone &#42;</span></span>
                                                <input type="text" name="message[phone]" id="contact-subject" required class="form-control input-lg"  placeholder="Your Telephone">
                                            </div>
                                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-fax"></i> <span class="input-text">Fax</span></span>
                                                <input type="text" name="message[fax]" id="contact-subject" required class="form-control input-lg"  placeholder="Your Fax">
                                            </div>

                                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i> <span class="input-text">Email &#42;</span></span>
                                                <input type="email" name="message[email]" id="contact-email" required class="form-control input-lg" placeholder="Your Email">
                                            </div>


                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">Address &#42;</span></span>
                                            <textarea name="message[address]" id="contact-message" class="form-control" cols="30" rows="3" placeholder="Your Address"></textarea>
                                            </div>
                                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">City &#42;</span></span>
                                                <input type="text" name="message[city]" required class="form-control input-lg" placeholder="Your City">
                                            </div>
                                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">Post Code &#42;</span></span>
                                               <input type="text" name="message[post-code]" required class="form-control input-lg" placeholder="Your Post Code">
                                            </div>
                                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">State &#42;</span></span>
                                                                        <div class="large-selectbox clearfix">
                                                                            <select id="country-3" name="message[state]" class="selectbox">
                                                                                <option value="Kuala Lumpur">Kuala Lumpur</option>
                                                                                <option value="Johor">Johor</option>
                                                                                <option value="Kedah">Kedah</option>
                                                                                <option value="Kelantan">Kelantan</option>
                                                                                <option value="Kuantan">Kuantan</option>
                                                                                <option value="Malacca">Malacca</option>
                                                                                <option value="Negeri Sembilan">Negeri Sembilan</option>
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

                                                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-flag"></i> <span class="input-text">Country &#42;</span></span>
                                                                        <div class="large-selectbox clearfix">
                                                                            <select id="country-3" name="message[country]" class="selectbox">

<option value='Abkhazia'>Abkhazia</option>

<option value='Afghanistan'>Afghanistan</option>

<option value='Aland Islands'>Aland Islands</option>

<option value='Albania'>Albania</option>

<option value='Algeria'>Algeria</option>

<option value='Andorra'>Andorra</option>

<option value='Angola'>Angola</option>

<option value='Anguilla'>Anguilla</option>

<option value='Argentina'>Argentina</option>

<option value='Armenia'>Armenia</option>

<option value='Aruba'>Aruba</option>

<option value='Australia'>Australia</option>

<option value='Austria'>Austria</option>

<option value='Azerbaijan'>Azerbaijan</option>

<option value='Bahamas'>Bahamas</option>

<option value='Bahrain'>Bahrain</option>

<option value='Bangladesh'>Bangladesh</option>

<option value='Barbados'>Barbados</option>

<option value='Belarus'>Belarus</option>

<option value='Belgium'>Belgium</option>

<option value='Belize'>Belize</option>

<option value='Benin'>Benin</option>

<option value='Bhutan'>Bhutan</option>

<option value='Bolivia'>Bolivia</option>

<option value='Bosnia & Herzegovina'>Bosnia & Herzegovina</option>

<option value='Botswana'>Botswana</option>

<option value='Brazil'>Brazil</option>

<option value='Brunei Darussalam'>Brunei Darussalam</option>

<option value='Bulgaria'>Bulgaria</option>

<option value='Burundi'>Burundi</option>

<option value='Cambodia'>Cambodia</option>

<option value='Cameroon'>Cameroon</option>

<option value='Canada'>Canada</option>

<option value='Chad'>Chad</option>

<option value='Chile'>Chile</option>

<option value='China'>China</option>

<option value='Colombia'>Colombia</option>

<option value='Costa Rica'>Costa Rica</option>

<option value='Cote d'Ivoire'>Cote d'Ivoire</option>

<option value='Croatia'>Croatia</option>

<option value='Cuba'>Cuba</option>

<option value='Cyprus'>Cyprus</option>

<option value='Czech Republic'>Czech Republic</option>

<option value='Denmark'>Denmark</option>

<option value='Dominica'>Dominica</option>

<option value='Dominican Republic'>Dominican Republic</option>

<option value='Ecuador'>Ecuador</option>

<option value='Egypt'>Egypt</option>

<option value='Eritrea'>Eritrea</option>

<option value='Estonia'>Estonia</option>

<option value='Ethiopia'>Ethiopia</option>

<option value='Fiji'>Fiji</option>

<option value='Finland'>Finland</option>

<option value='France'>France</option>

<option value='Gabon'>Gabon</option>

<option value='Gambia'>Gambia</option>

<option value='Georgia'>Georgia</option>

<option value='Germany'>Germany</option>

<option value='Ghana'>Ghana</option>

<option value='Gibraltar'>Gibraltar</option>

<option value='Greece'>Greece</option>

<option value='Greenland'>Greenland</option>

<option value='Grenada'>Grenada</option>

<option value='Guadeloupe'>Guadeloupe</option>

<option value='Guam'>Guam</option>

<option value='Guatemala'>Guatemala</option>

<option value='Guinea'>Guinea</option>

<option value='Guinea-Bissau'>Guinea-Bissau</option>

<option value='Haiti'>Haiti</option>

<option value='Honduras'>Honduras</option>

<option value='Hong Kong'>Hong Kong</option>

<option value='Hungary'>Hungary</option>

<option value='Iceland'>Iceland</option>

<option value='India'>India</option>

<option value='Indonesia'>Indonesia</option>

<option value='Iran'>Iran</option>

<option value='Iraq'>Iraq</option>

<option value='Ireland'>Ireland</option>

<option value='Israel'>Israel</option>

<option value='Italy'>Italy</option>

<option value='Jamaica'>Jamaica</option>

<option value='Japan'>Japan</option>

<option value='Jordan'>Jordan</option>

<option value='Kazakhstan'>Kazakhstan</option>

<option value='Kenya'>Kenya</option>

<option value='Kiribati'>Kiribati</option>

<option value='Korea'>Korea</option>

<option value='Korea, D.P.R.'>Korea, D.P.R.</option>

<option value='Kuwait'>Kuwait</option>

<option value='Kyrgyzstan'>Kyrgyzstan</option>

<option value='Lao P.D.R.'>Lao P.D.R.</option>

<option value='Latvia'>Latvia</option>

<option value='Lebanon'>Lebanon</option>

<option value='Lesotho'>Lesotho</option>

<option value='Liberia'>Liberia</option>

<option value='Libyan Arab Jamahiriya'>Libyan Arab Jamahiriya</option>

<option value='Liechtenstein'>Liechtenstein</option>

<option value='Lithuania'>Lithuania</option>

<option value='Luxembourg'>Luxembourg</option>

<option value='Macedonia'>Macedonia</option>

<option value='Madagascar'>Madagascar</option>

<option value='Malawi'>Malawi</option>

<option value='Malaysia'>Malaysia</option>

<option value='Maldives'>Maldives</option>

<option value='Mali'>Mali</option>

<option value='Malta'>Malta</option>

<option value='Mauritania'>Mauritania</option>

<option value='Mauritius'>Mauritius</option>

<option value='Mexico'>Mexico</option>

<option value='Micronesia'>Micronesia</option>

<option value='Moldova'>Moldova</option>

<option value='Monaco'>Monaco</option>

<option value='Mongolia'>Mongolia</option>

<option value='Montenegro'>Montenegro</option>

<option value='Morocco'>Morocco</option>

<option value='Mozambique'>Mozambique</option>

<option value='Namibia'>Namibia</option>

<option value='Nepal'>Nepal</option>

<option value='Netherlands'>Netherlands</option>

<option value='New Zealand'>New Zealand</option>

<option value='Nicaragua'>Nicaragua</option>

<option value='Niger'>Niger</option>

<option value='Nigeria'>Nigeria</option>

<option value='Norway'>Norway</option>

<option value='Oman'>Oman</option>

<option value='Pakistan'>Pakistan</option>

<option value='Panama'>Panama</option>

<option value='Paraguay'>Paraguay</option>

<option value='Peru'>Peru</option>

<option value='Philippines'>Philippines</option>

<option value='Poland'>Poland</option>

<option value='Portugal'>Portugal</option>

<option value='Qatar'>Qatar</option>

<option value='Romania'>Romania</option>

<option value='Russia'>Russia</option>

<option value='San Marino'>San Marino</option>

<option value='Saudi Arabia'>Saudi Arabia</option>

<option value='Senegal'>Senegal</option>

<option value='Serbia'>Serbia</option>

<option value='Singapore'>Singapore</option>

<option value='Slovakia'>Slovakia</option>

<option value='Slovenia'>Slovenia</option>

<option value='Somalia'>Somalia</option>

<option value='South Africa'>South Africa</option>

<option value='Spain'>Spain</option>

<option value='Sri Lanka'>Sri Lanka</option>

<option value='Sudan'>Sudan</option>

<option value='Sweden'>Sweden</option>

<option value='Switzerland'>Switzerland</option>

<option value='Syrian Arab Republic'>Syrian Arab Republic</option>

<option value='Tajikistan'>Tajikistan</option>

<option value='Tanzania'>Tanzania</option>

<option value='Thailand'>Thailand</option>

<option value='Timor, East'>Timor, East</option>

<option value='Togo'>Togo</option>

<option value='Tunisia'>Tunisia</option>

<option value='Turkey'>Turkey</option>

<option value='Turkmenistan'>Turkmenistan</option>

<option value='USA'>USA</option>

<option value='Uganda'>Uganda</option>

<option value='Ukraine'>Ukraine</option>

<option value='United Arab Emirates'>United Arab Emirates</option>

<option value='United Kingdom'>United Kingdom</option>

<option value='Uruguay'>Uruguay</option>

<option value='Uzbekistan'>Uzbekistan</option>

<option value='Vatican City'>Vatican City</option>

<option value='Venezuela'>Venezuela</option>

<option value='Viet Nam'>Viet Nam</option>

<option value='Western Sahara'>Western Sahara</option>

<option value='Yemen'>Yemen</option>

<option value='Zambia'>Zambia</option>

<option value='Zimbabwe'>Zimbabwe</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>




                                        </div>
                                        <!-- end col-md-6 -->

                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                        	<div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">Subject &#42;</span></span>
                                               <input type="text" name="message[subject]" required class="form-control input-lg" placeholder="Sales, Support, Customer Service, Repair, Enquiry, etc...">
                                            </div>

                                            <div class="input-group textarea-container"><span class="input-group-addon"><i class="fa fa-comments"></i> <span class="input-text">Your Comment / Enquiry</span></span>
                                                <textarea name="message[message]" id="contact-message" class="form-control" cols="30" rows="3" placeholder="Your Message"></textarea>
                                            </div>
                                            <p class="item-desc">Please enter the security code shown below:
                                            <div class="g-recaptcha" data-sitekey="6Lf05gUTAAAAAIU_lSk8rK0ZDqI4SfFB1mc5Vr_p"></div></p>

                                            <input type="submit" value="SUBMIT" class="btn btn-custom md-margin">

                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- end col-md-12 -->


                    </div>
                    <!-- end col-md-12 -->

            	</div>
                <!-- end row -->

    		</div>
            <!-- end container -->

    </section>

@endsection
