<!-- Services STARTS
     ========================================================================= -->

<?php
$animate = App\Http\Models\Front\Page::getFooteranimate();
//echo '<pre>'; var_dump($animate); echo '</pre>'; exit;
?>
	 
<!--<section id="facts">-->
<section id="facts" style="background:url(/public/front/images/{{ $animate[1]['image']['img'] }}) 50% 0 repeat-y fixed;">
     <div class="container">
        <div class="row">
           <div class="col-md-12 col-sm-4 col-xs-12">
		   <?php echo $animate[0]['title'] ?>
              
              <p class="line">&nbsp;</p>
           </div>
        </div>
        <div id="our-facts">
		<?php if(isset($animate[1]['icons']) && !empty($animate[1]['icons'])) :?>
		<?php foreach($animate[1]['icons'] as $anim) :?>
		<?php if($anim['active']): ?>
           <div class="items">
              <div class="circle"><i class="fa <?php echo $anim['icon'] ?>"></i></div>
              <div class="heading-2"><?php echo $anim['text1'] ?></div>
              <div class="heading-1"><?php echo $anim['text2'] ?></div>
           </div>
		<?php endif; ?>
		<?php endforeach; ?>
		<?php endif; ?>
        </div>
     </div>
	<div id="video">
        <video autoplay loop>
           <source src="" type="">
        </video>
     </div>
</section>
  <!-- /.services -->