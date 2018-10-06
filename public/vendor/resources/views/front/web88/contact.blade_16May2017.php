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
                    <li><a href="file:///C|/Users/Webqom/AppData/Roaming/Skype/My Skype Received Files/index.html"><i
                                    class="fa fa-home"></i> Home</a></li>
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
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i> <span
                                                    class="input-text">Name &#42;</span></span>
                                        <input type="text" name="message[name]" id="contact-name" required
                                               class="form-control input-lg"
                                               placeholder="Your Name">
                                    </div>

                                    <div class="input-group"><span class="input-group-addon"><i
                                                    class="fa fa-building"></i> <span class="input-text">Company Name &#42;</span></span>
                                        <input type="text" name="message[company]" id="contact-name" required
                                               class="form-control input-lg"
                                               placeholder="Company Name">
                                    </div>
                                    <div class="input-group"><span class="input-group-addon"><i
                                                    class="fa fa-suitcase"></i> <span class="input-text">Occupation &#42;</span></span>
                                        <input type="text" name="message[occupation]" id="contact-subject" required
                                               class="form-control input-lg" placeholder="Your Occupation">
                                    </div>
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-phone"></i> <span
                                                    class="input-text">Telephone &#42;</span></span>
                                        <input type="text" name="message[phone]" id="contact-subject" required
                                               class="form-control input-lg" placeholder="Your Telephone">
                                    </div>
                                    <div class="input-group"><span class="input-group-addon"><i
                                                    class="fa fa-fax"></i> <span class="input-text">Fax</span></span>
                                        <input type="text" name="message[fax]" id="contact-subject" required
                                               class="form-control input-lg" placeholder="Your Fax">
                                    </div>

                                    <div class="input-group"><span class="input-group-addon"><i
                                                    class="fa fa-envelope"></i> <span
                                                    class="input-text">Email &#42;</span></span>
                                        <input type="email" name="message[email]" id="contact-email" required
                                               class="form-control input-lg" placeholder="Your Email">
                                    </div>


                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="input-group"><span class="input-group-addon"><i
                                                    class="fa fa-map-marker"></i> <span
                                                    class="input-text">Address &#42;</span></span>
                                        <textarea name="message[address]" id="contact-message" class="form-control"
                                                  cols="30" rows="3" placeholder="Your Address"></textarea>
                                    </div>
                                    <div class="input-group"><span class="input-group-addon"><i
                                                    class="fa fa-map-marker"></i> <span
                                                    class="input-text">City &#42;</span></span>
                                        <input type="text" name="message[city]" required class="form-control input-lg"
                                               placeholder="Your City">
                                    </div>
                                    <div class="input-group"><span class="input-group-addon"><i
                                                    class="fa fa-map-marker"></i> <span class="input-text">Post Code &#42;</span></span>
                                        <input type="text" name="message[post-code]" required
                                               class="form-control input-lg" placeholder="Your Post Code">
                                    </div>
                                    <div class="input-group"><span class="input-group-addon"><i
                                                    class="fa fa-map-marker"></i> <span
                                                    class="input-text">State &#42;</span></span>
                                        <div class="large-selectbox clearfix">
                                            <select id="state" name="message[state]" class="">
                                                <option value="-" disabled selected>Select state</option>
                                                @foreach($states as $state)
                                                    <option value="{{$state->name}}">{{$state->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-flag"></i> <span
                                                    class="input-text">Country &#42;</span></span>
                                        <div class="large-selectbox clearfix">
                                            <select id="country-3" name="message[country]" class="">
                                                @foreach($countries as $country)
                                                    <option value="{{$country->name}}" {{$country->name == 'Malaysia' ? 'selected' : ''}}>{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <!-- end col-md-6 -->

                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group"><span class="input-group-addon"><i
                                                    class="fa fa-map-marker"></i> <span
                                                    class="input-text">Subject &#42;</span></span>
                                        <input type="text" name="message[subject]" required
                                               class="form-control input-lg"
                                               placeholder="Sales, Support, Customer Service, Repair, Enquiry, etc...">
                                    </div>

                                    <div class="input-group textarea-container"><span class="input-group-addon"><i
                                                    class="fa fa-comments"></i> <span class="input-text">Your Comment / Enquiry</span></span>
                                        <textarea name="message[message]" id="contact-message" class="form-control"
                                                  cols="30" rows="3" placeholder="Your Message"></textarea>
                                    </div>
                                    <p class="item-desc">Please enter the security code shown below:
                                    <div class="g-recaptcha" data-sitekey="6Le2ZyYTAAAAABkne_lwXaxPWIrDaYX3KTJI7Fhl"></div>
                                    </p>

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
@section('javascript')
    <script>
        $(document).ready(function () {
            var selectCountry = $('#country-3').selectbox();
            var selectState = $('#state').selectbox();
            selectCountry.change(function () {
                loadStates($(this).val());
            });

            function loadStates(country_id) {
                $.getJSON('{{route('Contact.states')}}', {'country_name': country_id}, function (data) {
                    var selecter = $('#state');
                    selecter.selectbox('detach');
                    $('#state option').remove();
                    $.each(data, function (name, value) {
                        selecter.append('<option value="' + value.name + '">' + value.name + '</option>');
                    });
                    selecter.selectbox();
                })
            }
        });
    </script>
@endsection