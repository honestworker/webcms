        <!DOCTYPE html>
<!--[if IE 8]>
<html class="ie8"><![endif]-->
<!--[if IE 9]>
<html class="ie9"><![endif]-->
<!--[if !IE]><!-->
<html>
<!--<![endif]--><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--================= Specific Meta ===================-->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--================= Page Title ======================-->
    <title>Cozy / Comfort / Affordable | Ritz Garden Hotel</title>
    <!--================= Favicons ========================-->
    <!--================= Favicons ========================-->
    <link rel="shortcut icon" href="{{ asset('/public/front/images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('/public/front/images/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/public/front/images/apple-touch-icon_72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/public/front/images/apple-touch-icon_114x114.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/public/front/images/apple-touch-icon_144x144.png') }}">

    <!--================= Custom Font =====================-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7cPlayfair+Display:400,700,900" rel="stylesheet">

    <!--====== Custom CSS  =======-->
    <link href="{{ asset('/public/front/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/front/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/front/colors/color-schemer.css') }}" rel="stylesheet">

  <!--================= Modernize =======================-->
    <script src="{{ asset('/public/front/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{ asset('/public/admin/js/jquery-1.9.1.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.5.4/src/loadingoverlay.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.5.4/extras/loadingoverlay_progress/loadingoverlay_progress.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>

  <script type="text/javascript" src="{{ asset('/public/front/fancybox/jquery.mousewheel-3.0.4.pack.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/public/front/fancybox/jquery.fancybox-1.3.4.pack.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('/public/front/fancybox/jquery.fancybox-1.3.4.css') }}" type="text/css" media="screen" />

  @yield('styles')
</head>



<style>
  /* for loader which works on each page load */
  .no-js #loader { display: none;  }
  .js #loader { display: block; position: absolute; left: 100px; top: 0; }
  .se-pre-con {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('{{ asset('/public/loader/Preloader_4.gif') }}') center no-repeat #fff;
  }
</style>

<body>
@if($popup->status)
<a class="hidden" data-fancybox  id="onload" href="{{url($popup->image)}}"> </a>
@endif
<!--================= Header ==========================-->
{{--<div class="se-pre-con"></div>--}}
    <header id="masthead" class="site-header">
      <div class="header-top">
        <div class="container">
          <div class="row">
            <div class="col-md-7 hidden-xs">
              <div class="addresses">
                <div class="block-time"><i class="fa fa-clock-o"></i>
                  <p>Book Time - <span>10am to 11pm</span></p>
                </div>
                <div class="phone"><i class="fa fa-phone"></i>
                  <p>Reservation - <span>(05) 242-7777</span></p>
                </div>
                <div class="email"><i class="fa fa-envelope"></i>
                  <p>sales@ritzgardenhotel.com</p>
                </div>
              </div><!--/.addresses-->
            </div><!--/.col-md-7-->
            <div class="col-md-5">
              <div class="social-links pull-right">
              @if(Session::get('userId')!='' and Session::get('userEmail')!='')
              <a href="{{ url('dashboard') }}">Dashboard</a> | Welcome, &nbsp;{{ Session::get('userFirstName') }} {{ Session::get('userLastName') }}! <a href="{{ url('/logout')}}">Logout</a>

                @else
              	<a href="{{ url('login') }}">Login</a> or <a href="{{ url('create_account') }}">Create an Account</a>

                @endif
         <a href="https://www.facebook.com/RitzGardenHotelIpoh/" target="_blank"><i class="fa fa-facebook"></i></a></div><!--/.social-links-->

              <div class="mobile-search-area hidden-sm hidden-md hidden-lg">
                <!--i.fa.fa-search-->
                <div class="header-search">
                  <div class="search default">
                    <form action="#" method="get" class="searchform">
                      <div class="input-group">
                        <input type="search" name="s" placeholder="Search here..." class="form-controller"><span class="input-group-btn">
                          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button></span>
                      </div>
                    </form>
                  </div>
                </div>
              </div><!--/.search-area-->
            </div><!--/.col-md-5-->
          </div><!--/.row-->
        </div><!--/.container-->
      </div><!--/.header-top-->
      <!--Header Bottom-->
      <div class="header-bottom">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="menu-wrapper clearfix">
                <div class="navbar-header pull-left">
				<div class="logo-block"><a href="{{url('/')}}" class="site-logo"><img src="{{ asset('/public/front/images/index/logo.png') }}" alt="Ritz Garden Hotel" class="logo"></a><!--/.site-logo--></div>
                </div><!--/.navbar-header-->
                <div class="collapse navbar-collapse pull-right">
                  <div class="navigation hidden-sm hidden-xs">
                    <ul class="nav navbar-nav mainmenu">
                      <li><a href="{{ url('/') }}">Home</a></li>
                      <?php foreach ($categories_name as $key => $value) {
                          if(!$value['status']) continue;
                      ?>

                        <li><a href="<?php echo empty($value['code'])?'#':url($value['code']) ?>"><?php echo $value['title'] ?></a>

                          <?php   if(!empty($value['sub_categories'])){ ?>

                          <ul class="sub-menu">
                            <?php   foreach ($value['sub_categories'] as $keySub => $valueSub) {
                                if(!$valueSub['status']) continue;
                              ?>

                              <li><a href="{{ url($valueSub['code']) }}/{{$valueSub['category_id']}}"><?= $valueSub['title'] ?></a></li>

                            <?php } ?>

                          </ul>
                          <?php } ?>

                        </li>

                        <?php
                      }
                      ?>
                      <!-- <li> -->
                      <!-- <a href="#">Rooms</a>
                        <ul class="sub-menu">
                          <li><a href="{{ url('rooms-suites') }}">Rooms &amp; Suites</a></li>
                          <li><a href="{{ url('apartments') }}">Apartments</a></li>
                        </ul>
                      </li>
                      <li><a href="{{ url('promotions') }}">Promotions</a></li>
                      <li><a href="{{ url('dining') }}">Dining</a></li>
                      <li><a href="{{ url('facilities') }}">Facilities</a></li>
                      <li><a href="#">Events &amp; Meetings</a>
                      	 <ul class="sub-menu">
                          <li><a href="{{ url('weddings') }}">Weddings</a></li>
                          <li><a href="{{ url('events-meetings') }}">Events &amp; Meetings</a></li>
                        </ul>
                      </li>
                      <li><a href="#">About</a>
                      	<ul class="sub-menu">
                          <li><a href="{{ url('about-us') }}">About Ritz Garden Hotel</a></li>
                          <li><a href="{{ url('gallery') }}">Gallery</a></li>
                        </ul>
                      </li>
                      <li><a href="{{ url('contact-us') }}">Contact</a></li> -->
                    </ul><!--/.mainmenu-->
                  </div><!--/.navigation-->
                  <!--Mobile Main Menu-->
                  <div class="mobile-menu-main hidden-md hidden-lg">
                    <div class="menucontent overlaybg"> </div>
                    <div class="menuexpandermain slideRight"><a id="navtoggole-main" class="animated-arrow slideLeft menuclose"><span></span></a><span id="menu-marker"></span></div><!--/.menuexpandermain-->
                    <div id="mobile-main-nav" class="main-navigation slideLeft">
                      <div class="menu-wrapper">
                        <div id="main-mobile-container" class="menu-content clearfix"></div>
                      </div>
                    </div><!--/#mobile-main-nav-->
                  </div><!--/.mobile-menu-main-->
                </div><!--/.navbar-collapse-->
              </div><!--/.menu-wrapper-->
            </div><!--/.col-md-12-->
          </div><!--/.row-->
        </div><!--/.container-->
      </div><!--/.header-bottom-->
    </header><!--/.site-header-->


@yield('content')
<!--================= Site Footer ===================-->
    <div id="footer-top-section" style="background-image:url('/public/front/images/footer-top-bg.jpg')" class="bg-image">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-title-area text-center">
              <h2 class="section-title">We Are Available<br>For You 24/7</h2>
              <p class="section-title-dec">Reach us anytime at your convenience</p>
            </div><!--/.section-title-area-->
          </div><!--/.col-md-12-->
        </div><!--/.row-->
        <div class="row">
          <div class="col-sm-6 col-md-3">
            <div class="widget-area footer-sidebar-top-1">
              <aside class="widget clearfix widget_address">
                <div class="widget-title-area">
                  <h4 class="widget-title">address</h4>
                </div><!--/.widget-title-area-->
                <div class="widget-content">
                  <p>No.86 &amp; 88, Jalan Yang Kalsom, 30250 Ipoh, Perak, Malaysia</p>
                </div>
              </aside><!--/.widget_address-->
            </div><!--/.footer-sidebar-top-1-->
          </div><!--/.col-md-3-->
          <div class="col-sm-6 col-md-3">
            <div class="widget-area footer-sidebar-top-2">
              <aside class="widget clearfix widget_call_us">
                <div class="widget-title-area">
                  <h4 class="widget-title">call</h4>
                </div><!--/.widget-title-area-->
                <div class="widget-content">
                  <p>Tel: (05) 242-7777</p>
                  <p>Fax: (05) 242-5845</p>
                </div>
              </aside><!--/.widget_call_us-->
            </div><!--/.footer-sidebar-top-2-->
          </div><!--/.col-md-3-->
          <div class="col-sm-6 col-md-3">
            <div class="widget-area footer-sidebar-top-3">
              <aside class="widget clearfix widget_mail_us">
                <div class="widget-title-area">
                  <h4 class="widget-title">E-mail</h4>
                </div><!--/.widget-title-area-->
                <div class="widget-content">
                  <p><a href="mailto:sales@ritzgardenhotel.com">sales@ritzgardenhotel.com</a></p>
                  <p><a hrer="mailto:lily@ritzgardenhotel.com">lily@ritzgardenhotel.com</a></p>
                </div>
              </aside><!--/.widget_mail_us-->
            </div><!--/.footer-sidebar-top-3-->
          </div><!--/.col-md-3-->
          <div class="col-sm-6 col-md-3">
            <div class="widget-area footer-sidebar-top-4">
              <aside class="widget clearfix widget_social_media">
                <div class="widget-title-area">
                  <h4 class="widget-title">social Account</h4>
                </div><!--/.widget-title-area-->
                <div class="widget-social"><a href="https://www.facebook.com/RitzGardenHotelIpoh/"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-google-plus"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div><!--/.widget-social-->
              </aside><!--/.widget_social_media-->
            </div><!--/.footer-sidebar-top-4-->
          </div><!--/.col-md-3-->
        </div><!--/.row-->
      </div><!--/.container-fluid-->
    </div><!--/#footer-top-section-->
    <footer id="colophon" class="site-footer">
      <!-- Footer Bottom Section-->
      <div id="footer-bottom-section">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-md-4">
              <div class="widget-area footer-sidebar-1">
                <aside class="widget clearfix widget_about-us">
                  <div class="widget-title-area">
                    <h4 class="widget-title">About Ritz Garden</h4>
                  </div><!--/.widget-title-area-->
                  <div class="widget-content">
                    <p>Ritz Garden Hotel and You – while in Ipoh, we offer cosy comfort at affordable price. All different categories of rooms are thoughtfully designed to cater to traveller's needs and wants. Get to know our different categories and make a choice suitable for you and your family &amp; friends.</p><a href="{{ url('/about-us/12') }}" class="btn btn-default">more</a>                  </div>
                </aside><!--/.widget-about-us-->
              </div><!--/.footer-sidebar-1-->
            </div><!--/.col-md-4-->
            <div class="col-sm-6 col-md-4">
              <div class="widget-area footer-sidebar-2">
                <aside class="widget clearfix widget_instafeed">
                  <div class="widget-title-area">
                    <h4 class="widget-title">Locate us</h4>
                  </div><!--/.widget-title-area-->
                  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d63630.574883351765!2d101.087952!3d4.609963!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb64408481a66e0a!2sRitz+Garden+Hotel!5e0!3m2!1sen!2s!4v1492794773324" width="100%" height="255" frameborder="0" style="border:0" allowfullscreen></iframe>
                </aside><!--/.widget-categories-->
              </div><!--/.footer-sidebar-2-->
            </div><!--/.col-md-4-->
            <div class="col-sm-6 col-md-4">
              <div class="widget-area footer-sidebar-3">
                <aside class="widget clearfix widget_newsletter">
                  <div class="widget-title-area">
                    <h4 class="widget-title">newsletter</h4>
                  </div><!--/.widget-title-area-->
                  <div class="newsletter-area text-center">
                    <p>Join our malling list to receive news and promotions</p>
                    <form action="#" method="post" name="form-newsletter" id="form-newsletter">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                      <input type="hidden" name="status" value="1">
                      <input value="" placeholder="" aria-required="true" id="email_1" name="email" type="email" class="form-controller">
                      <button id="mc-embedded-subscribe" value="Subscribe" type="submit" class="mail-chip-button">Subscribe</button>
                    </form><!--/.form-newsletter-->
                  </div><!--/.newsletter-area-->
                </aside><!--/.widget_newsletter-->
              </div><!--/.footer-sidebar-3-->
            </div><!--/.col-md-4-->
          </div><!--/.row-->
          <div class="row">
            <div class="col-md-12">
              <div class="payment-method text-center">We accept <img src="{{ asset('/public/front/images/card/card-1.png') }}" alt="Visa">&nbsp;<img src="{{ asset('/public/front/images/card/card-2.png') }}" alt="Mastercard"></div><!--/.payment-method-->
            </div><!--/.copyright-->
            <div class="col-md-12">
              <div class="copyright text-center">
                <p>Copyright 2017 Ritz Garden Hotel. All Rights Reserved. <a href="http://www.webqom.com/web_design.html" target="_blank">Web Design Malaysia</a> &amp; <a href="http://www.webqom.com/web_hosting.html" target="_blank">Web Hosting Malaysia</a></p>
              </div><!--/.copyright-->
            </div><!--/.copyright-->
          </div><!--/.row-->
        </div><!--/.container-->
      </div><!--/#footer-bottom-section-->
    </footer><!--/.site-footer-->
    <!--********************* JS FILE DECLARATION *****************************  -->
    <script src="{{ asset('/public/front/js/vendor/jquery-1.12.4.min.js') }}"></script><!--Jquery-->
    <script src="{{ asset('/public/front/js/vendor/jQuery-Migrate.min.js') }}"></script><!--jQuery-Migrate-->
    <script src="{{ asset('/public/front/js/plugins.js') }}"></script><!--plugins js-->

    <script src="{{ asset('/public/front/js/aravira.js') }}"></script><!--aravira-app-->
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

    <script type="text/javascript">
      // Wait for window load
      $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");
      });
      jQuery('#form-newsletter').submit(function() {
            var form_data = new window.FormData(jQuery('#form-newsletter')[0]);

                  jQuery.ajax({
                    url: '/newsletter/addSubscriber',
                    type:'post',
                    dataType:'json',
                    data: form_data,
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                      if(response['error'])
                      {
                        alert(response['error']);
                        }

                        if(response['success'])
                        {
                          alert('Newsletter is subscribed!');
                          jQuery('#email_1').val('');
                        }
                      }
                    });
                  return false;
        });
    </script>

    @yield('scripts')
  </body>

</html>


