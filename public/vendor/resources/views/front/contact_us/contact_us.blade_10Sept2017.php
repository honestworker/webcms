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
      	<div class="row">
          <div class="col-md-12 col-full-width">
            <div class="section-title-area text-center">
              <h2 class="section-title">Contact Us</h2>
              <p class="section-title-dec">We would like to hear from you.</p>
              <span><?php if(Session::get('contact_us') == '1'){ ?> We contact you shortly! <?php }else{ ?>Error while saving contact us!<?php } ?></span>
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
                    <div class="row">
                      <div class="col-md-12">
                        <form method="post" id="comment_form" name="commentForm">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
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
                                    <select name="room">
                                      <option value="Select State">- Select State -</option>
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
                              </p>
                            </div><!--/.col-md-6-->
                            <div class="col-md-6 col-sm-6 padding-right">
                              <p>
                              <div class="input box-radius">
                                    <select name="room">
                                      <option value="Select Country">- Select Country -</option>
                                      <option data-calling-code="93" data-eu-tax="unknown" value="AF">Afghanistan</option>
                                        <option data-calling-code="358" data-eu-tax="unknown" value="AX">Åland Islands</option>
                                        <option data-calling-code="355" data-eu-tax="unknown" value="AL">Albania</option>
                                        <option data-calling-code="213" data-eu-tax="unknown" value="DZ">Algeria</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="AS">American Samoa</option>
                                        <option data-calling-code="376" data-eu-tax="unknown" value="AD">Andorra</option>
                                        <option data-calling-code="244" data-eu-tax="unknown" value="AO">Angola</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="AI">Anguilla</option>
                                        <option data-calling-code="672" data-eu-tax="unknown" value="AQ">Antarctica</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="AG">Antigua and Barbuda</option>
                                        <option data-calling-code="54" data-eu-tax="unknown" value="AR">Argentina</option>
                                        <option data-calling-code="374" data-eu-tax="unknown" value="AM">Armenia</option>
                                        <option data-calling-code="297" data-eu-tax="unknown" value="AW">Aruba</option>
                                        <option data-calling-code="61" data-eu-tax="unknown" value="AU">Australia</option>
                                        <option data-calling-code="43" data-eu-tax="yes" value="AT">Austria</option>
                                        <option data-calling-code="994" data-eu-tax="unknown" value="AZ">Azerbaijan</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="BS">Bahamas</option>
                                        <option data-calling-code="973" data-eu-tax="unknown" value="BH">Bahrain</option>
                                        <option data-calling-code="880" data-eu-tax="unknown" value="BD">Bangladesh</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="BB">Barbados</option>
                                        <option data-calling-code="375" data-eu-tax="unknown" value="BY">Belarus</option>
                                        <option data-calling-code="32" data-eu-tax="yes" value="BE">Belgium</option>
                                        <option data-calling-code="501" data-eu-tax="unknown" value="BZ">Belize</option>
                                        <option data-calling-code="229" data-eu-tax="unknown" value="BJ">Benin</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="BM">Bermuda</option>
                                        <option data-calling-code="975" data-eu-tax="unknown" value="BT">Bhutan</option>
                                        <option data-calling-code="591" data-eu-tax="unknown" value="BO">Bolivia, Plurinational State of</option>
                                        <option data-calling-code="387" data-eu-tax="unknown" value="BA">Bosnia and Herzegovina</option>
                                        <option data-calling-code="267" data-eu-tax="unknown" value="BW">Botswana</option>
                                        <option data-calling-code="55" data-eu-tax="unknown" value="BR">Brazil</option>
                                        <option data-calling-code="246" data-eu-tax="unknown" value="IO">British Indian Ocean Territory</option>
                                        <option data-calling-code="673" data-eu-tax="unknown" value="BN">Brunei Darussalam</option>
                                        <option data-calling-code="359" data-eu-tax="yes" value="BG">Bulgaria</option>
                                        <option data-calling-code="226" data-eu-tax="unknown" value="BF">Burkina Faso</option>
                                        <option data-calling-code="257" data-eu-tax="unknown" value="BI">Burundi</option>
                                        <option data-calling-code="855" data-eu-tax="unknown" value="KH">Cambodia</option>
                                        <option data-calling-code="237" data-eu-tax="unknown" value="CM">Cameroon</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="CA">Canada</option>
                                        <option data-calling-code="238" data-eu-tax="unknown" value="CV">Cape Verde</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="KY">Cayman Islands</option>
                                        <option data-calling-code="236" data-eu-tax="unknown" value="CF">Central African Republic</option>
                                        <option data-calling-code="235" data-eu-tax="unknown" value="TD">Chad</option>
                                        <option data-calling-code="56" data-eu-tax="unknown" value="CL">Chile</option>
                                        <option data-calling-code="86" data-eu-tax="unknown" value="CN">China</option>
                                        <option data-calling-code="61" data-eu-tax="unknown" value="CX">Christmas Island</option>
                                        <option data-calling-code="61" data-eu-tax="unknown" value="CC">Cocos (Keeling) Islands</option>
                                        <option data-calling-code="57" data-eu-tax="unknown" value="CO">Colombia</option>
                                        <option data-calling-code="269" data-eu-tax="unknown" value="KM">Comoros</option>
                                        <option data-calling-code="242" data-eu-tax="unknown" value="CG">Congo</option>
                                        <option data-calling-code="243" data-eu-tax="unknown" value="CD">Congo, the Democratic Republic of the</option>
                                        <option data-calling-code="682" data-eu-tax="unknown" value="CK">Cook Islands</option>
                                        <option data-calling-code="506" data-eu-tax="unknown" value="CR">Costa Rica</option>
                                        <option data-calling-code="225" data-eu-tax="unknown" value="CI">Côte d'Ivoire</option>
                                        <option data-calling-code="385" data-eu-tax="yes" value="HR">Croatia</option>
                                        <option data-calling-code="53" data-eu-tax="unknown" value="CU">Cuba</option>
                                        <option data-calling-code="357" data-eu-tax="yes" value="CY">Cyprus</option>
                                        <option data-calling-code="420" data-eu-tax="yes" value="CZ">Czech Republic</option>
                                        <option data-calling-code="45" data-eu-tax="yes" value="DK">Denmark</option>
                                        <option data-calling-code="253" data-eu-tax="unknown" value="DJ">Djibouti</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="DM">Dominica</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="DO">Dominican Republic</option>
                                        <option data-calling-code="593" data-eu-tax="unknown" value="EC">Ecuador</option>
                                        <option data-calling-code="20" data-eu-tax="unknown" value="EG">Egypt</option>
                                        <option data-calling-code="503" data-eu-tax="unknown" value="SV">El Salvador</option>
                                        <option data-calling-code="240" data-eu-tax="unknown" value="GQ">Equatorial Guinea</option>
                                        <option data-calling-code="291" data-eu-tax="unknown" value="ER">Eritrea</option>
                                        <option data-calling-code="372" data-eu-tax="yes" value="EE">Estonia</option>
                                        <option data-calling-code="251" data-eu-tax="unknown" value="ET">Ethiopia</option>
                                        <option data-calling-code="500" data-eu-tax="unknown" value="FK">Falkland Islands (Malvinas)</option>
                                        <option data-calling-code="298" data-eu-tax="unknown" value="FO">Faroe Islands</option>
                                        <option data-calling-code="679" data-eu-tax="unknown" value="FJ">Fiji</option>
                                        <option data-calling-code="358" data-eu-tax="yes" value="FI">Finland</option>
                                        <option data-calling-code="33" data-eu-tax="yes" value="FR">France</option>
                                        <option data-calling-code="594" data-eu-tax="unknown" value="GF">French Guiana</option>
                                        <option data-calling-code="689" data-eu-tax="unknown" value="PF">French Polynesia</option>
                                        <option data-calling-code="262" data-eu-tax="unknown" value="TF">French Southern Territories</option>
                                        <option data-calling-code="241" data-eu-tax="unknown" value="GA">Gabon</option>
                                        <option data-calling-code="220" data-eu-tax="unknown" value="GM">Gambia</option>
                                        <option data-calling-code="995" data-eu-tax="unknown" value="GE">Georgia</option>
                                        <option data-calling-code="49" data-eu-tax="yes" value="DE">Germany</option>
                                        <option data-calling-code="233" data-eu-tax="unknown" value="GH">Ghana</option>
                                        <option data-calling-code="350" data-eu-tax="unknown" value="GI">Gibraltar</option>
                                        <option data-calling-code="30" data-eu-tax="yes" value="GR">Greece</option>
                                        <option data-calling-code="299" data-eu-tax="unknown" value="GL">Greenland</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="GD">Grenada</option>
                                        <option data-calling-code="590" data-eu-tax="unknown" value="GP">Guadeloupe</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="GU">Guam</option>
                                        <option data-calling-code="502" data-eu-tax="unknown" value="GT">Guatemala</option>
                                        <option data-calling-code="44" data-eu-tax="unknown" value="GG">Guernsey</option>
                                        <option data-calling-code="224" data-eu-tax="unknown" value="GN">Guinea</option>
                                        <option data-calling-code="245" data-eu-tax="unknown" value="GW">Guinea-Bissau</option>
                                        <option data-calling-code="592" data-eu-tax="unknown" value="GY">Guyana</option>
                                        <option data-calling-code="509" data-eu-tax="unknown" value="HT">Haiti</option>
                                        <option data-calling-code="3906" data-eu-tax="unknown" value="VA">Holy See (Vatican City State)</option>
                                        <option data-calling-code="504" data-eu-tax="unknown" value="HN">Honduras</option>
                                        <option data-calling-code="852" data-eu-tax="unknown" value="HK">Hong Kong</option>
                                        <option data-calling-code="36" data-eu-tax="yes" value="HU">Hungary</option>
                                        <option data-calling-code="354" data-eu-tax="unknown" value="IS">Iceland</option>
                                        <option data-calling-code="91" data-eu-tax="unknown" value="IN">India</option>
                                        <option data-calling-code="62" data-eu-tax="unknown" value="ID">Indonesia</option>
                                        <option data-calling-code="98" data-eu-tax="unknown" value="IR">Iran, Islamic Republic of</option>
                                        <option data-calling-code="964" data-eu-tax="unknown" value="IQ">Iraq</option>
                                        <option data-calling-code="353" data-eu-tax="yes" value="IE">Ireland</option>
                                        <option data-calling-code="44" data-eu-tax="yes" value="IM">Isle of Man</option>
                                        <option data-calling-code="972" data-eu-tax="unknown" value="IL">Israel</option>
                                        <option data-calling-code="39" data-eu-tax="yes" value="IT">Italy</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="JM">Jamaica</option>
                                        <option data-calling-code="81" data-eu-tax="unknown" value="JP">Japan</option>
                                        <option data-calling-code="44" data-eu-tax="unknown" value="JE">Jersey</option>
                                        <option data-calling-code="962" data-eu-tax="unknown" value="JO">Jordan</option>
                                        <option data-calling-code="7" data-eu-tax="unknown" value="KZ">Kazakhstan</option>
                                        <option data-calling-code="254" data-eu-tax="unknown" value="KE">Kenya</option>
                                        <option data-calling-code="686" data-eu-tax="unknown" value="KI">Kiribati</option>
                                        <option data-calling-code="850" data-eu-tax="unknown" value="KP">Korea, Democratic People's Republic of</option>
                                        <option data-calling-code="82" data-eu-tax="unknown" value="KR">Korea, Republic of</option>
                                        <option data-calling-code="965" data-eu-tax="unknown" value="KW">Kuwait</option>
                                        <option data-calling-code="996" data-eu-tax="unknown" value="KG">Kyrgyzstan</option>
                                        <option data-calling-code="856" data-eu-tax="unknown" value="LA">Lao People's Democratic Republic</option>
                                        <option data-calling-code="371" data-eu-tax="yes" value="LV">Latvia</option>
                                        <option data-calling-code="961" data-eu-tax="unknown" value="LB">Lebanon</option>
                                        <option data-calling-code="266" data-eu-tax="unknown" value="LS">Lesotho</option>
                                        <option data-calling-code="231" data-eu-tax="unknown" value="LR">Liberia</option>
                                        <option data-calling-code="218" data-eu-tax="unknown" value="LY">Libyan Arab Jamahiriya</option>
                                        <option data-calling-code="423" data-eu-tax="unknown" value="LI">Liechtenstein</option>
                                        <option data-calling-code="370" data-eu-tax="yes" value="LT">Lithuania</option>
                                        <option data-calling-code="352" data-eu-tax="yes" value="LU">Luxembourg</option>
                                        <option data-calling-code="853" data-eu-tax="unknown" value="MO">Macao</option>
                                        <option data-calling-code="389" data-eu-tax="unknown" value="MK">Macedonia, the former Yugoslav Republic of</option>
                                        <option data-calling-code="261" data-eu-tax="unknown" value="MG">Madagascar</option>
                                        <option data-calling-code="265" data-eu-tax="unknown" value="MW">Malawi</option>
                                        <option data-calling-code="60" data-eu-tax="unknown" value="MY" selected="selected">Malaysia</option>
                                        <option data-calling-code="960" data-eu-tax="unknown" value="MV">Maldives</option>
                                        <option data-calling-code="223" data-eu-tax="unknown" value="ML">Mali</option>
                                        <option data-calling-code="356" data-eu-tax="yes" value="MT">Malta</option>
                                        <option data-calling-code="692" data-eu-tax="unknown" value="MH">Marshall Islands</option>
                                        <option data-calling-code="596" data-eu-tax="unknown" value="MQ">Martinique</option>
                                        <option data-calling-code="222" data-eu-tax="unknown" value="MR">Mauritania</option>
                                        <option data-calling-code="230" data-eu-tax="unknown" value="MU">Mauritius</option>
                                        <option data-calling-code="262" data-eu-tax="unknown" value="YT">Mayotte</option>
                                        <option data-calling-code="52" data-eu-tax="unknown" value="MX">Mexico</option>
                                        <option data-calling-code="691" data-eu-tax="unknown" value="FM">Micronesia, Federated States of</option>
                                        <option data-calling-code="373" data-eu-tax="unknown" value="MD">Moldova, Republic of</option>
                                        <option data-calling-code="377" data-eu-tax="yes" value="MC">Monaco</option>
                                        <option data-calling-code="976" data-eu-tax="unknown" value="MN">Mongolia</option>
                                        <option data-calling-code="382" data-eu-tax="unknown" value="ME">Montenegro</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="MS">Montserrat</option>
                                        <option data-calling-code="212" data-eu-tax="unknown" value="MA">Morocco</option>
                                        <option data-calling-code="258" data-eu-tax="unknown" value="MZ">Mozambique</option>
                                        <option data-calling-code="94" data-eu-tax="unknown" value="MM">Myanmar</option>
                                        <option data-calling-code="264" data-eu-tax="unknown" value="NA">Namibia</option>
                                        <option data-calling-code="674" data-eu-tax="unknown" value="NR">Nauru</option>
                                        <option data-calling-code="977" data-eu-tax="unknown" value="NP">Nepal</option>
                                        <option data-calling-code="31" data-eu-tax="yes" value="NL">Netherlands</option>
                                        <option data-calling-code="599" data-eu-tax="unknown" value="AN">Netherlands Antilles</option>
                                        <option data-calling-code="687" data-eu-tax="unknown" value="NC">New Caledonia</option>
                                        <option data-calling-code="64" data-eu-tax="unknown" value="NZ">New Zealand</option>
                                        <option data-calling-code="505" data-eu-tax="unknown" value="NI">Nicaragua</option>
                                        <option data-calling-code="227" data-eu-tax="unknown" value="NE">Niger</option>
                                        <option data-calling-code="234" data-eu-tax="unknown" value="NG">Nigeria</option>
                                        <option data-calling-code="683" data-eu-tax="unknown" value="NU">Niue</option>
                                        <option data-calling-code="672" data-eu-tax="unknown" value="NF">Norfolk Island</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="MP">Northern Mariana Islands</option>
                                        <option data-calling-code="47" data-eu-tax="unknown" value="NO">Norway</option>
                                        <option data-calling-code="968" data-eu-tax="unknown" value="OM">Oman</option>
                                        <option data-calling-code="92" data-eu-tax="unknown" value="PK">Pakistan</option>
                                        <option data-calling-code="680" data-eu-tax="unknown" value="PW">Palau</option>
                                        <option data-calling-code="970" data-eu-tax="unknown" value="PS">Palestinian Territory, Occupied</option>
                                        <option data-calling-code="507" data-eu-tax="unknown" value="PA">Panama</option>
                                        <option data-calling-code="675" data-eu-tax="unknown" value="PG">Papua New Guinea</option>
                                        <option data-calling-code="595" data-eu-tax="unknown" value="PY">Paraguay</option>
                                        <option data-calling-code="51" data-eu-tax="unknown" value="PE">Peru</option>
                                        <option data-calling-code="63" data-eu-tax="unknown" value="PH">Philippines</option>
                                        <option data-calling-code="649" data-eu-tax="unknown" value="PN">Pitcairn</option>
                                        <option data-calling-code="48" data-eu-tax="yes" value="PL">Poland</option>
                                        <option data-calling-code="351" data-eu-tax="yes" value="PT">Portugal</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="PR">Puerto Rico</option>
                                        <option data-calling-code="974" data-eu-tax="unknown" value="QA">Qatar</option>
                                        <option data-calling-code="262" data-eu-tax="unknown" value="RE">Réunion</option>
                                        <option data-calling-code="40" data-eu-tax="yes" value="RO">Romania</option>
                                        <option data-calling-code="7" data-eu-tax="unknown" value="RU">Russian Federation</option>
                                        <option data-calling-code="250" data-eu-tax="unknown" value="RW">Rwanda</option>
                                        <option data-calling-code="590" data-eu-tax="unknown" value="BL">Saint Barthélemy</option>
                                        <option data-calling-code="290" data-eu-tax="unknown" value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="KN">Saint Kitts and Nevis</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="LC">Saint Lucia</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="MF">Saint Martin (French part)</option>
                                        <option data-calling-code="508" data-eu-tax="unknown" value="PM">Saint Pierre and Miquelon</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="VC">Saint Vincent and the Grenadines</option>
                                        <option data-calling-code="685" data-eu-tax="unknown" value="WS">Samoa</option>
                                        <option data-calling-code="378" data-eu-tax="unknown" value="SM">San Marino</option>
                                        <option data-calling-code="239" data-eu-tax="unknown" value="ST">Sao Tome and Principe</option>
                                        <option data-calling-code="966" data-eu-tax="unknown" value="SA">Saudi Arabia</option>
                                        <option data-calling-code="221" data-eu-tax="unknown" value="SN">Senegal</option>
                                        <option data-calling-code="382" data-eu-tax="unknown" value="RS">Serbia</option>
                                        <option data-calling-code="248" data-eu-tax="unknown" value="SC">Seychelles</option>
                                        <option data-calling-code="232" data-eu-tax="unknown" value="SL">Sierra Leone</option>
                                        <option data-calling-code="65" data-eu-tax="unknown" value="SG">Singapore</option>
                                        <option data-calling-code="421" data-eu-tax="yes" value="SK">Slovakia</option>
                                        <option data-calling-code="386" data-eu-tax="yes" value="SI">Slovenia</option>
                                        <option data-calling-code="677" data-eu-tax="unknown" value="SB">Solomon Islands</option>
                                        <option data-calling-code="252" data-eu-tax="unknown" value="SO">Somalia</option>
                                        <option data-calling-code="27" data-eu-tax="unknown" value="ZA">South Africa</option>
                                        <option data-calling-code="34" data-eu-tax="yes" value="ES">Spain</option>
                                        <option data-calling-code="94" data-eu-tax="unknown" value="LK">Sri Lanka</option>
                                        <option data-calling-code="249" data-eu-tax="unknown" value="SD">Sudan</option>
                                        <option data-calling-code="597" data-eu-tax="unknown" value="SR">Suriname</option>
                                        <option data-calling-code="" data-eu-tax="unknown" value="SJ">Svalbard and Jan Mayen</option>
                                        <option data-calling-code="268" data-eu-tax="unknown" value="SZ">Swaziland</option>
                                        <option data-calling-code="46" data-eu-tax="yes" value="SE">Sweden</option>
                                        <option data-calling-code="41" data-eu-tax="unknown" value="CH">Switzerland</option>
                                        <option data-calling-code="963" data-eu-tax="unknown" value="SY">Syrian Arab Republic</option>
                                        <option data-calling-code="886" data-eu-tax="unknown" value="TW">Taiwan</option>
                                        <option data-calling-code="992" data-eu-tax="unknown" value="TJ">Tajikistan</option>
                                        <option data-calling-code="255" data-eu-tax="unknown" value="TZ">Tanzania, United Republic of</option>
                                        <option data-calling-code="66" data-eu-tax="unknown" value="TH">Thailand</option>
                                        <option data-calling-code="670" data-eu-tax="unknown" value="TL">Timor-Leste</option>
                                        <option data-calling-code="228" data-eu-tax="unknown" value="TG">Togo</option>
                                        <option data-calling-code="690" data-eu-tax="unknown" value="TK">Tokelau</option>
                                        <option data-calling-code="676" data-eu-tax="unknown" value="TO">Tonga</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="TT">Trinidad and Tobago</option>
                                        <option data-calling-code="216" data-eu-tax="unknown" value="TN">Tunisia</option>
                                        <option data-calling-code="90" data-eu-tax="unknown" value="TR">Turkey</option>
                                        <option data-calling-code="993" data-eu-tax="unknown" value="TM">Turkmenistan</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="TC">Turks and Caicos Islands</option>
                                        <option data-calling-code="688" data-eu-tax="unknown" value="TV">Tuvalu</option>
                                        <option data-calling-code="256" data-eu-tax="unknown" value="UG">Uganda</option>
                                        <option data-calling-code="380" data-eu-tax="unknown" value="UA">Ukraine</option>
                                        <option data-calling-code="971" data-eu-tax="unknown" value="AE">United Arab Emirates</option>
                                        <option data-calling-code="44" data-eu-tax="yes" value="GB">United Kingdom</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="US">United States</option>
                                        <option data-calling-code="598" data-eu-tax="unknown" value="UY">Uruguay</option>
                                        <option data-calling-code="998" data-eu-tax="unknown" value="UZ">Uzbekistan</option>
                                        <option data-calling-code="678" data-eu-tax="unknown" value="VU">Vanuatu</option>
                                        <option data-calling-code="58" data-eu-tax="unknown" value="VE">Venezuela, Bolivarian Republic of</option>
                                        <option data-calling-code="84" data-eu-tax="unknown" value="VN">Viet Nam</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="VG">Virgin Islands, British</option>
                                        <option data-calling-code="1" data-eu-tax="unknown" value="VI">Virgin Islands, U.S.</option>
                                        <option data-calling-code="681" data-eu-tax="unknown" value="WF">Wallis and Futuna</option>
                                        <option data-calling-code="" data-eu-tax="unknown" value="EH">Western Sahara</option>
                                        <option data-calling-code="967" data-eu-tax="unknown" value="YE">Yemen</option>
                                        <option data-calling-code="260" data-eu-tax="unknown" value="ZM">Zambia</option>
                                        <option data-calling-code="263" data-eu-tax="unknown" value="ZW">Zimbabwe</option>
                                      
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