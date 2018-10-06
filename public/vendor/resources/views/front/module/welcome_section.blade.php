<!--================= Page Wellcome Area ===================-->
    <div class="welcome-section style-two">
      <div class="container-fluid">
        <div class="row">
          <div id="js-main-slider" class="pogoSlider">
            @foreach ($banners as $key => $value)
                <div data-transition="shrinkReveal" data-duration="1000" style="background-image:url( public/admin/images/banner/top/{{$value['banner']}});" class="pogoSlider-slide">
                 <div class="col-md-7 tb">
                   <div class="welcome-text tb-cell">
                     <p data-in="expand" data-out="fade" data-duration="750" data-delay="500" class="pogoSlider-slide-element"><span>{{$value['heading_text_top_1']}}</span></p>
                     <h4 data-in="flipX" data-out="slideDown" data-duration="750" data-delay="500" class="title pogoSlider-slide-element">{{$value['heading_text_middle']}}</h4>
                     <h2 data-in="rollLeft" data-out="rollRight" data-duration="750" data-delay="500" class="headline pogoSlider-slide-element">{{$value['title']}}</h2>
                     <div data-in="slideUp" data-out="slideDown" data-duration="750" data-delay="500" class="welcome-btn pogoSlider-slide-element"><a href="<?php if(!empty($value['url_left'])) {echo $value['url_left'];} else echo("#");?>" class="btn btn-offer active"><?php if($value['link_text_left'] !='None' && $value['link_text_left'] !='') echo ($value['link_text_left']);?></a><a href="<?php if(!empty($value['url_right'])) {echo $value['url_right'];} else echo("#");?>" class="btn btn-offer"><span><?php if($value['link_text_right'] !='None' && $value['link_text_right'] !='') echo ($value['link_text_right']);?></span></a></div>
                   </div>
                 </div>
               </div>
           @endforeach
          </div><!-- .pogoSlider -->
        </div><!--/.row-->
      </div><!--/.container-fluid-->
    </div><!--/.welcome-section-->
