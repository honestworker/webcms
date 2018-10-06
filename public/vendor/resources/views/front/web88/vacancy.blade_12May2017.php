@extends('front/templateFront')

@section('content')

	<section id="content">
		<div id="page-header" class="parallax">
			{!! $data['bg-title'] !!}
		</div>
		<div class="md-margin2x"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="hero-unit">
						{!! $data['title'] !!}
						<span class="small-bottom-border big"></span>
						{!! $data['description'] !!}
					</div>
					<div class="md-margin2x"></div>

				</div>
				<!-- end col-md-12 -->

			</div>
			<!-- end row -->

			<div class="row">
				<div class="col-md-12">
					<h3>Filter Vacancies</h3>
				</div>

				<form method="POST" action="" accept-charset="UTF-8">

					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="col-md-6">
						<div class="form-group">
							<div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i> <span
											class="input-text">Job Vacancy</span></span>

								<div class="large-selectbox clearfix">
									<select id="country-3" name="title" id="flt-title" class="selectbox">
										<option value="all">All</option>
										{!! $list_title !!}
									</select>
								</div>
							</div>
						</div>
					</div>
					<!-- end col-md-6 -->

					<div class="col-md-6">
						<div class="form-group">
							<div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span
											class="input-text">Job Location</span></span>

								<div class="large-selectbox clearfix">
									<select id="country-3" name="location" class="selectbox">
										<option value="all">All</option>
										{!! $list_location !!}
									</select>
								</div>
							</div>
						</div>

					</div>
					<!-- end col-md-6 -->

					<div class="col-md-12">
						<a href="#" id="flt-submit" class="btn btn-custom">FILTER &nbsp; <i class="fa fa-angle-double-right"></i></a>
					</div>
				</form>

			</div>
			<!-- end row -->

			<div class="md-margin"></div>

			<div class="row">
				<div class="col-md-12">
					<div class="panel-group custom-accordion" id="accordion">

						<?php $i = 0; ?>
						@if(isset($vacancy) && !empty($vacancy))
							@foreach($vacancy as $key => $item)
								@if(array_key_exists('active', $item))
									<?php $i++ ?>
									<div class="panel">
										<div class="accordion-header">
											<div class="wt-title" class="accordion-title">{!! $item['title'] !!}</div>
											<!-- End .accordion-title -->
											<a class="accordion-btn opened" data-toggle="collapse" data-target="#accordion-<?php echo $i ?>"
											   data-parent="#accordion"></a>
										</div>
										<!-- End .accordion-header -->

										<div id="accordion-<?php echo $i ?>" class="collapse">
											<div class="panel-body">

												<article class="article">

													<div class="article-meta-date"><span>{!! date('j M', strtotime($item['date'])) !!}</span> {!! date('Y',
	                    strtotime($item['date'])) !!}
													</div>


													<h4>Location</h4>

													<p class="wt-location">{!! $item['location'] !!}</p>

													<div class="row">
														<div class="col-md-6">
															<h4>Minimum Requirement</h4>
															{!! isset($item['requirement']) ? $item['requirement']: '' !!}
														</div>
														<div class="col-md-6">
															<h4>Preferred</h4>
															{!! isset($item['preferred']) ? $item['preferred']: '' !!}
														</div>
													</div>
													<!-- end row -->
													<hr>
													<a href="#" class="wbx_apply_job wt-button btn btn-custom-2" data-toggle="modal"
													   data-target="#modal-apply">APPLY THIS JOB &nbsp; <i class="fa fa-angle-double-right"></i></a>
												</article>


											</div>
											<!-- End .panel-body -->
										</div>
										<!-- End .collapse -->
									</div>
									<!-- End .panel -->
								@endif
							@endforeach
						@else
							<div class="alert alert-danger">
								<span>No vacancy found!</span>
							</div>
					@endif

					<!-- Modal apply job start -->
						<div class="modal fade" id="modal-apply" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">

							<form method="POST" action="{{url('admin/addapplicant')}}" accept-charset="UTF-8" id="login-form" class="form-horizontal" enctype="multipart/form-data">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">

								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
														class="sr-only">Close</span></button>
											<h4 class="modal-title" id="myModalLabel2">Job Application</h4>
										</div>
										<!-- End .modal-header -->
										<div class="modal-body clearfix">

											<h4 id="wt-title">Job Position Applied: </h4>
											<h4 id="wt-location">Location: </h4>
											{!! $info['info'] !!}
											<div class="xs-margin"></div>
											<div class="col-md-9">

												<div class="alert alert-danger" style="display: none">
													<i class="fa fa-exclamation-triangle"></i>
													&nbsp;<strong>Error!</strong>
													<span id="errorSpan">Please correct the errors in below form.</span>
												</div>

												<?php if (Session::has('success')): ?>
												<div class="alert alert-success">
													<i class="fa fa-smile-o"></i> &nbsp;<strong>Thank you for your application!</strong>
												</div>
												<?php endif;
												Session::forget('success'); ?>

												<?php if (Session::has('fail')): ?>
												<div class="alert alert-danger">
													<i class="fa fa-exclamation-triangle"></i> &nbsp;<strong>Error!</strong> Please correct the errors in below form.
												</div>
												<?php endif;
												Session::forget('fail'); ?>

												<?php if (Session::has('size') && Session::get('size') === 'size'): ?>
												<div class="alert alert-danger">
													<i class="fa fa-exclamation-triangle"></i> &nbsp;<strong>Error!</strong> Your CV file size is over 2MB. Please re-attach your CV.
												</div>
												<?php endif;
												Session::forget('size'); ?>

												<?php if (Session::has('ext') && Session::get('ext') === 'ext'): ?>
												<div class="alert alert-danger">
													<i class="fa fa-exclamation-triangle"></i> &nbsp;<strong>Error!</strong> This is not the valid document format.
													Please re-attach your CV.
												</div>
												<?php endif;
												Session::forget('ext'); ?>

												<div class="form-group">
													<div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i> <span class="input-text">Your Name &#42;</span></span>
														<input type="text" required name="name" class="form-control input-lg" placeholder="Your Name">
													</div>
												</div>

												<div class="form-group">
													<div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar"></i> <span class="input-text">Date of Birth &#42;</span></span>
														<input type="text" id="datepickers" name="birth" class="input-lg" placeholder="DD/MM/YYYY">
													</div>
												</div>

												<div class="form-group">
													<div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i> <span class="input-text">Email &#42;</span></span>
														<input type="email" required name="email" id="candidateEmail" class="form-control input-lg"
															   placeholder="Your Email">
													</div>
												</div>

												<div class="form-group">
													<div class="input-group"><span class="input-group-addon"><i class="fa fa-phone"></i> <span class="input-text">Telephone &#42;</span></span>
														<input type="text" required name="phone" class="form-control input-lg" placeholder="Your Telephone">
													</div>
												</div>

												<div class="form-group">
													<div class="input-group"><span class="input-group-addon"><i class="fa fa-building-o"></i> <span class="input-text">Address &#42;</span></span>
														<textarea name="address" id="contact-message" class="form-control" cols="30" rows="2"
																  placeholder="Your Address"></textarea>
													</div>
												</div>

												<div class="form-group">
													<div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">City &#42;</span></span>
														<input type="text" required name="city" class="form-control input-lg" placeholder="Your City">
													</div>
												</div>

												<div class="form-group">
													<div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">Post Code &#42;</span></span>
														<input type="text" required name="postcode" class="form-control input-lg" placeholder="Your Post Code">
													</div>
												</div>

												<div class="form-group">
													<div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i> <span class="input-text">State &#42;</span></span>

														<div class="large-selectbox clearfix">
																<select id="state" name="state" class="form-control input-lg">
																</select>
																{{--<option value="Kuala Lumpur">Kuala Lumpur</option>--}}
																{{--<option value="Johor">Johor</option>--}}
																{{--<option value="Kedah">Kedah</option>--}}
																{{--<option value="Kelantan">Kelantan</option>--}}
																{{--<option value="Kuantan">Kuantan</option>--}}
																{{--<option value="Melacca">Malacca</option>--}}
																{{--<option value="Negeri Sembilan">Negeri Sembilan</option>--}}
																{{--<option value="Labuan">Labuan</option>--}}
																{{--<option value="Pahang">Pahang</option>--}}
																{{--<option value="Penang">Penang</option>--}}
																{{--<option value="Perak">Perak</option>--}}
																{{--<option value="Perlis">Perlis</option>--}}
																{{--<option value="Putrajaya">Putrajaya</option>--}}
																{{--<option value="Sabah">Sabah</option>--}}
																{{--<option value="Sarawak">Sarawak</option>--}}
																{{--<option value="Selangor">Selangor</option>--}}
																{{--<option value="Terengganu">Terengganu</option>--}}
																{{--<option value="-">-</option>--}}
														</div>
													</div>
												</div>

												<div class="form-group">
													<div class="input-group"><span class="input-group-addon"><i class="fa fa-flag"></i> <span class="input-text">Country &#42;</span></span>

														<div class="large-selectbox clearfix">
															{{--<select id="country-3" name="country" class="selectbox">--}}
																{{--<option value='Abkhazia'>Abkhazia</option>--}}

																{{--<option value='Afghanistan'>Afghanistan</option>--}}

																{{--<option value='Aland Islands'>Aland Islands</option>--}}

																{{--<option value='Albania'>Albania</option>--}}

																{{--<option value='Algeria'>Algeria</option>--}}

																{{--<option value='Andorra'>Andorra</option>--}}

																{{--<option value='Angola'>Angola</option>--}}

																{{--<option value='Anguilla'>Anguilla</option>--}}

																{{--<option value='Argentina'>Argentina</option>--}}

																{{--<option value='Armenia'>Armenia</option>--}}

																{{--<option value='Aruba'>Aruba</option>--}}

																{{--<option value='Australia'>Australia</option>--}}

																{{--<option value='Austria'>Austria</option>--}}

																{{--<option value='Azerbaijan'>Azerbaijan</option>--}}

																{{--<option value='Bahamas'>Bahamas</option>--}}

																{{--<option value='Bahrain'>Bahrain</option>--}}

																{{--<option value='Bangladesh'>Bangladesh</option>--}}

																{{--<option value='Barbados'>Barbados</option>--}}

																{{--<option value='Belarus'>Belarus</option>--}}

																{{--<option value='Belgium'>Belgium</option>--}}

																{{--<option value='Belize'>Belize</option>--}}

																{{--<option value='Benin'>Benin</option>--}}

																{{--<option value='Bhutan'>Bhutan</option>--}}

																{{--<option value='Bolivia'>Bolivia</option>--}}

																{{--<option value='Bosnia & Herzegovina'>Bosnia & Herzegovina</option>--}}

																{{--<option value='Botswana'>Botswana</option>--}}

																{{--<option value='Brazil'>Brazil</option>--}}

																{{--<option value='Brunei Darussalam'>Brunei Darussalam</option>--}}

																{{--<option value='Bulgaria'>Bulgaria</option>--}}

																{{--<option value='Burundi'>Burundi</option>--}}

																{{--<option value='Cambodia'>Cambodia</option>--}}

																{{--<option value='Cameroon'>Cameroon</option>--}}

																{{--<option value='Canada'>Canada</option>--}}

																{{--<option value='Chad'>Chad</option>--}}

																{{--<option value='Chile'>Chile</option>--}}

																{{--<option value='China'>China</option>--}}

																{{--<option value='Colombia'>Colombia</option>--}}

																{{--<option value='Costa Rica'>Costa Rica</option>--}}

																{{--<option value='Cote d`Ivoire'>Cote d'Ivoire</option>--}}

																{{--<option value='Croatia'>Croatia</option>--}}

																{{--<option value='Cuba'>Cuba</option>--}}

																{{--<option value='Cyprus'>Cyprus</option>--}}

																{{--<option value='Czech Republic'>Czech Republic</option>--}}

																{{--<option value='Denmark'>Denmark</option>--}}

																{{--<option value='Dominica'>Dominica</option>--}}

																{{--<option value='Dominican Republic'>Dominican Republic</option>--}}

																{{--<option value='Ecuador'>Ecuador</option>--}}

																{{--<option value='Egypt'>Egypt</option>--}}

																{{--<option value='Eritrea'>Eritrea</option>--}}

																{{--<option value='Estonia'>Estonia</option>--}}

																{{--<option value='Ethiopia'>Ethiopia</option>--}}

																{{--<option value='Fiji'>Fiji</option>--}}

																{{--<option value='Finland'>Finland</option>--}}

																{{--<option value='France'>France</option>--}}

																{{--<option value='Gabon'>Gabon</option>--}}

																{{--<option value='Gambia'>Gambia</option>--}}

																{{--<option value='Georgia'>Georgia</option>--}}

																{{--<option value='Germany'>Germany</option>--}}

																{{--<option value='Ghana'>Ghana</option>--}}

																{{--<option value='Gibraltar'>Gibraltar</option>--}}

																{{--<option value='Greece'>Greece</option>--}}

																{{--<option value='Greenland'>Greenland</option>--}}

																{{--<option value='Grenada'>Grenada</option>--}}

																{{--<option value='Guadeloupe'>Guadeloupe</option>--}}

																{{--<option value='Guam'>Guam</option>--}}

																{{--<option value='Guatemala'>Guatemala</option>--}}

																{{--<option value='Guinea'>Guinea</option>--}}

																{{--<option value='Guinea-Bissau'>Guinea-Bissau</option>--}}

																{{--<option value='Haiti'>Haiti</option>--}}

																{{--<option value='Honduras'>Honduras</option>--}}

																{{--<option value='Hong Kong'>Hong Kong</option>--}}

																{{--<option value='Hungary'>Hungary</option>--}}

																{{--<option value='Iceland'>Iceland</option>--}}

																{{--<option value='India'>India</option>--}}

																{{--<option value='Indonesia'>Indonesia</option>--}}

																{{--<option value='Iran'>Iran</option>--}}

																{{--<option value='Iraq'>Iraq</option>--}}

																{{--<option value='Ireland'>Ireland</option>--}}

																{{--<option value='Israel'>Israel</option>--}}

																{{--<option value='Italy'>Italy</option>--}}

																{{--<option value='Jamaica'>Jamaica</option>--}}

																{{--<option value='Japan'>Japan</option>--}}

																{{--<option value='Jordan'>Jordan</option>--}}

																{{--<option value='Kazakhstan'>Kazakhstan</option>--}}

																{{--<option value='Kenya'>Kenya</option>--}}

																{{--<option value='Kiribati'>Kiribati</option>--}}

																{{--<option value='Korea'>Korea</option>--}}

																{{--<option value='Korea, D.P.R.'>Korea, D.P.R.</option>--}}

																{{--<option value='Kuwait'>Kuwait</option>--}}

																{{--<option value='Kyrgyzstan'>Kyrgyzstan</option>--}}

																{{--<option value='Lao P.D.R.'>Lao P.D.R.</option>--}}

																{{--<option value='Latvia'>Latvia</option>--}}

																{{--<option value='Lebanon'>Lebanon</option>--}}

																{{--<option value='Lesotho'>Lesotho</option>--}}

																{{--<option value='Liberia'>Liberia</option>--}}

																{{--<option value='Libyan Arab Jamahiriya'>Libyan Arab Jamahiriya</option>--}}

																{{--<option value='Liechtenstein'>Liechtenstein</option>--}}

																{{--<option value='Lithuania'>Lithuania</option>--}}

																{{--<option value='Luxembourg'>Luxembourg</option>--}}

																{{--<option value='Macedonia'>Macedonia</option>--}}

																{{--<option value='Madagascar'>Madagascar</option>--}}

																{{--<option value='Malawi'>Malawi</option>--}}

																{{--<option value='Malaysia'>Malaysia</option>--}}

																{{--<option value='Maldives'>Maldives</option>--}}

																{{--<option value='Mali'>Mali</option>--}}

																{{--<option value='Malta'>Malta</option>--}}

																{{--<option value='Mauritania'>Mauritania</option>--}}

																{{--<option value='Mauritius'>Mauritius</option>--}}

																{{--<option value='Mexico'>Mexico</option>--}}

																{{--<option value='Micronesia'>Micronesia</option>--}}

																{{--<option value='Moldova'>Moldova</option>--}}

																{{--<option value='Monaco'>Monaco</option>--}}

																{{--<option value='Mongolia'>Mongolia</option>--}}

																{{--<option value='Montenegro'>Montenegro</option>--}}

																{{--<option value='Morocco'>Morocco</option>--}}

																{{--<option value='Mozambique'>Mozambique</option>--}}

																{{--<option value='Namibia'>Namibia</option>--}}

																{{--<option value='Nepal'>Nepal</option>--}}

																{{--<option value='Netherlands'>Netherlands</option>--}}

																{{--<option value='New Zealand'>New Zealand</option>--}}

																{{--<option value='Nicaragua'>Nicaragua</option>--}}

																{{--<option value='Niger'>Niger</option>--}}

																{{--<option value='Nigeria'>Nigeria</option>--}}

																{{--<option value='Norway'>Norway</option>--}}

																{{--<option value='Oman'>Oman</option>--}}

																{{--<option value='Pakistan'>Pakistan</option>--}}

																{{--<option value='Panama'>Panama</option>--}}

																{{--<option value='Paraguay'>Paraguay</option>--}}

																{{--<option value='Peru'>Peru</option>--}}

																{{--<option value='Philippines'>Philippines</option>--}}

																{{--<option value='Poland'>Poland</option>--}}

																{{--<option value='Portugal'>Portugal</option>--}}

																{{--<option value='Qatar'>Qatar</option>--}}

																{{--<option value='Romania'>Romania</option>--}}

																{{--<option value='Russia'>Russia</option>--}}

																{{--<option value='San Marino'>San Marino</option>--}}

																{{--<option value='Saudi Arabia'>Saudi Arabia</option>--}}

																{{--<option value='Senegal'>Senegal</option>--}}

																{{--<option value='Serbia'>Serbia</option>--}}

																{{--<option value='Singapore'>Singapore</option>--}}

																{{--<option value='Slovakia'>Slovakia</option>--}}

																{{--<option value='Slovenia'>Slovenia</option>--}}

																{{--<option value='Somalia'>Somalia</option>--}}

																{{--<option value='South Africa'>South Africa</option>--}}

																{{--<option value='Spain'>Spain</option>--}}

																{{--<option value='Sri Lanka'>Sri Lanka</option>--}}

																{{--<option value='Sudan'>Sudan</option>--}}

																{{--<option value='Sweden'>Sweden</option>--}}

																{{--<option value='Switzerland'>Switzerland</option>--}}

																{{--<option value='Syrian Arab Republic'>Syrian Arab Republic</option>--}}

																{{--<option value='Tajikistan'>Tajikistan</option>--}}

																{{--<option value='Tanzania'>Tanzania</option>--}}

																{{--<option value='Thailand'>Thailand</option>--}}

																{{--<option value='Timor, East'>Timor, East</option>--}}

																{{--<option value='Togo'>Togo</option>--}}

																{{--<option value='Tunisia'>Tunisia</option>--}}

																{{--<option value='Turkey'>Turkey</option>--}}

																{{--<option value='Turkmenistan'>Turkmenistan</option>--}}

																{{--<option value='USA'>USA</option>--}}

																{{--<option value='Uganda'>Uganda</option>--}}

																{{--<option value='Ukraine'>Ukraine</option>--}}

																{{--<option value='United Arab Emirates'>United Arab Emirates</option>--}}

																{{--<option value='United Kingdom'>United Kingdom</option>--}}

																{{--<option value='Uruguay'>Uruguay</option>--}}

																{{--<option value='Uzbekistan'>Uzbekistan</option>--}}

																{{--<option value='Vatican City'>Vatican City</option>--}}

																{{--<option value='Venezuela'>Venezuela</option>--}}

																{{--<option value='Viet Nam'>Viet Nam</option>--}}

																{{--<option value='Western Sahara'>Western Sahara</option>--}}

																{{--<option value='Yemen'>Yemen</option>--}}

																{{--<option value='Zambia'>Zambia</option>--}}

																{{--<option value='Zimbabwe'>Zimbabwe</option>--}}
                                                            <select onchange="mooncake_print_state('state', this.selectedIndex)" id="country" name="country" class="form-control input-lg"></select>

                                                            <script language="javascript">print_country('country');</script>
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="input-group"><span class="input-group-addon"><i class="fa fa-graduation-cap"></i> <span
																	class="input-text">Education Level &#42;</span></span>

														<div class="large-selectbox clearfix">
															<select id="country-2" name="level" class="selectbox">
																<option value="">-- Select --</option>
																<option value="Higher secondary / STPM / &quot;A&quot; Level / Pre-U">Higher secondary / STPM / &quot;A&quot;
																	Level / Pre-U
																</option>
																<option value="Diploma / Advanced Higher / Graduate Diploma">Diploma / Advanced Higher / Graduate
																	Diploma
																</option>
																<option value=">Professional Certificated / Degree / Master">Professional Certificated / Degree /
																	Master
																</option>
															</select>
														</div>
													</div>
												</div>

												<p><strong>Attach Your CV <span class="text-red">&#42;</span></strong></p>

												<div class="alert alert-info alert-dismissable">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<i class="fa fa-info-circle"></i> &nbsp; Click "Browse" button to attach your CV (PDF, RTF, MS Word or JPEG file).
													Max file size: 2MB
												</div>

												<p><input name="cv" type="file"></p>
												<hr>

												<p class="item-desc">Please enter the security code shown below:
												<div class="g-recaptcha" data-sitekey="6Le2ZyYTAAAAABkne_lwXaxPWIrDaYX3KTJI7Fhl"></div>
												</p>


											</div>

										</div>
										<!-- End .modal-body -->
										<div class="modal-footer">
											<button id="ctn_apply" class="btn btn-custom-2">APPLY</button>
											<button type="button" class="btn btn-custom" data-dismiss="modal">CLOSE</button>
										</div>
										<!-- End .modal-footer -->
									</div>
									<!-- End .modal-content -->
								</div>
								<!-- End .modal-dialog -->
								<input id="hd-title" type="hidden" name="position" value="">
								<input id="hd-location" type="hidden" name="location" value="">

							</form>

						</div>
						<!-- End .modal apply job -->


					</div>
					<!-- end accordion -->


					<div class="clearfix"></div>
					<div class="lg-margin"></div>

				</div>
				<!-- end row -->

			</div>
		</div>
		<!-- end container -->

	</section>

	<script type="text/javascript">


		function isValidEmailAddress(emailAddress) {
			var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
			return pattern.test(emailAddress);
		}

		function isValidNumber(number) {
			var pattern = new RegExp(/[0-9 -()+]+$/);
			return pattern.test(number);

		}
		function validateFormValues() {
			var error = [];
			var email = $('#candidateEmail').val();
			var number = $('[name="phone"]').val();
			if (!isValidEmailAddress(email)) {
				error.push("Please enter valid email.")
				return error;
			}
			if (!isValidNumber(number)) {
				error.push("Please enter valid Telephone.")
				return error;
			}
			return error;

		}
		$(document).ready(function(){
			//datepicker
			$('#datepickers').datepicker({
				format: "dd/mm/yyyy"
			});
			$('#datepickers').addClass('datepickerCustom');

			$('#modal-apply').scroll(function () {
				$('#datepickers').datepicker('hide');
			});

			//$('.wbx_apply_job:eq(0)').click();
			// Cookie
			if ($.cookie('showform') == 'true') {
				// console.log($.cookie('showform'));
				var idx = ($.cookie('index')) ? $.cookie('index') : 0;
				console.log($.cookie('index'));
				$('.wbx_apply_job:eq(' + idx + ')').trigger('click');
				var Obj = $('.panel-group > .panel:eq(' + idx + ')');
				var title = Obj.find('.wt-title').text();
				var location = Obj.find('.wt-location').text();
				$('#wt-title').text("Job Position Applied: " + title);
				$('#wt-location').text("Location: " + location);
				$('#hd-title').val(title);
				$('#hd-location').val(location);
				$.cookie('showform', 'false');
			}

			$('#ctn_apply').click(function (e) {
				e.preventDefault();
				$('#errorSpan').parent('div').css('display', 'none');
				var errors = validateFormValues();

				if (errors.length) {
					$('#errorSpan').html(errors[0]);
					$('#errorSpan').parent('div').css('display', 'block');

					$("#modal-apply").animate({ scrollTop: 0}, 500);
					return false;
				}


				// Send form applicant
				$.cookie('showform', 'true');
				//console.log($.cookie('showform'));
				$(this).closest('form').submit();
			});


			//Filter
			$("#flt-submit").click(function (e) {
				e.preventDefault();
				$(this).closest("form").submit();
			});
			// Modal window
			$(".wt-button").click(function () {
				var title = $(this).closest('.panel').find('.wt-title').text();
				var location = $(this).closest('.panel').find('.wt-location').text();
				$('#wt-title').text("Job Position Applied: " + title);
				$('#wt-location').text("Location: " + location);
				$('#hd-title').val(title);
				$('#hd-location').val(location);
				var index = $(this).closest('.panel').index('.panel-group > div');
				//console.log(index);
				$.cookie('index', index);
			});

		});
	</script>

@endsection
