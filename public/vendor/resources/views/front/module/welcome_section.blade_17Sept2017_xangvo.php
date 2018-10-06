<!--================= Page Wellcome Area ===================-->
    <div class="welcome-section style-two">
      <div class="container-fluid">
        <div class="row">
          <div id="js-main-slider" class="pogoSlider">
            <?php if(empty($banners)){ ?>
            <div data-transition="shrinkReveal" data-duration="1000" style="background-image:url(public/front/images/index/banner1.jpg);" class="pogoSlider-slide">
              <div class="col-md-7 tb">
                <div class="welcome-text tb-cell">
                  <p data-in="expand" data-out="fade" data-duration="750" data-delay="500" class="pogoSlider-slide-element"><span>Special Offer</span></p>
                  <h4 data-in="flipX" data-out="slideDown" data-duration="750" data-delay="500" class="title pogoSlider-slide-element">Always Warm &amp; Welcoming</h4>
                  <h2 data-in="rollLeft" data-out="rollRight" data-duration="750" data-delay="500" class="headline pogoSlider-slide-element">Premier Room</h2>
                  <div data-in="slideUp" data-out="slideDown" data-duration="750" data-delay="500" class="welcome-btn pogoSlider-slide-element"><a href="#" class="btn btn-offer active">Special Offer</a><a href="#" class="btn btn-offer"><span>45% Off</span> - 10Days</a></div><!--/.welcome-btn -->
                </div><!--/.welcome-text-->
              </div><!--/.col-md-7-->
            </div>
            <div data-transition="shrinkReveal" data-duration="1000" style="background-image:url(public/front/images/index/banner2.jpg);" class="pogoSlider-slide">
              <div class="col-md-7 tb">
                <div class="welcome-text tb-cell">
                  <p data-in="expand" data-out="fade" data-duration="750" data-delay="500" class="pogoSlider-slide-element"><span>Special Offer</span></p>
                  <h4 data-in="flipX" data-out="slideDown" data-duration="750" data-delay="500" class="title pogoSlider-slide-element">A preferred venue for any occasion</h4>
                  <h2 data-in="slideDown" data-out="slideUp" data-duration="750" data-delay="500" class="headline pogoSlider-slide-element">Wedding Package</h2>
                  <div data-in="slideUp" data-out="slideDown" data-duration="750" data-delay="500" class="welcome-btn pogoSlider-slide-element"><a href="#" class="btn btn-offer active">Plan Your Wedding</a><a href="#" class="btn btn-offer"><span>25% Off</span> - Grand Ballroom</a></div><!--/.welcome-btn -->
                </div><!--/.welcome-text-->
              </div><!--/.col-md-7-->
            </div>
            <div data-transition="shrinkReveal" data-duration="1000" style="background-image:url(public/front/images/index/banner3.jpg);" class="pogoSlider-slide">
              <div class="col-md-7 tb">
                <div class="welcome-text tb-cell">
                  <p data-in="expand" data-out="fade" data-duration="750" data-delay="500" class="pogoSlider-slide-element"><span>Lunch Promo</span></p>
                  <h4 data-in="flipX" data-out="slideDown" data-duration="750" data-delay="500" class="title pogoSlider-slide-element">For your dining pleasure</h4>
                  <h2 data-in="flipY" data-out="flipX" data-duration="750" data-delay="500" class="headline pogoSlider-slide-element">Chill out &amp; Relax</h2>
                  <div data-in="slideUp" data-out="slideDown" data-duration="750" data-delay="500" class="welcome-btn pogoSlider-slide-element"><a href="#" class="btn btn-offer active">Learn more</a><a href="#" class="btn btn-offer"><span>15% Off</span> - Western Set Lunch</a></div><!--/.welcome-btn -->
                </div><!--/.welcome-text-->
              </div><!--/.col-md-7-->
            </div>
            <?php }else{
              foreach ($banners as $key => $value) {
              ?>
              <div data-transition="shrinkReveal" data-duration="1000" style="background-image:url(public/admin/images/banner/top/<?php echo $value['banner'] ?>);" class="pogoSlider-slide">
              <div class="col-md-7 tb">
                <div class="welcome-text tb-cell">
                  <p data-in="expand" data-out="fade" data-duration="750" data-delay="500" class="pogoSlider-slide-element"><span>{{$value['heading_text_top_1']}}</span></p>
                  <h4 data-in="flipX" data-out="slideDown" data-duration="750" data-delay="500" class="title pogoSlider-slide-element">{{$value['heading_text_middle']}}</h4>
                  <h2 data-in="flipY" data-out="flipX" data-duration="750" data-delay="500" class="headline pogoSlider-slide-element">{{$value['title']}}</h2>
                 <div data-in="slideUp" data-out="slideDown" data-duration="750" data-delay="500" class="welcome-btn pogoSlider-slide-element"><a href="{{$value['url_left']}}" class="btn btn-offer active"><?php if($value['link_text_left'] !='None' && $value['link_text_left'] !='') echo ($value['link_text_left']);?></a><a href="{{$value['url_right']}}" class="btn btn-offer"><span><?php if($value['link_text_right'] !='None' && $value['link_text_right'] !='') echo ($value['link_text_right']);?></span></a></div>
              </div><!--/.col-md-7-->
            </div>
            <?php }
            } ?>
          </div><!-- .pogoSlider -->
        </div><!--/.row-->
      </div><!--/.container-fluid-->
    </div><!--/.welcome-section-->
