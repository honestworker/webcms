@extends('front/templateFront')

@section('content')

        <section id="content">
            <div id="page-header-contact-us">
                
               <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3983.990112960235!2d101.675495!3d3.0972869999999997!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4a3857291199%3A0xfce2fa6b2a9dc61c!2sTBM+-+Service+Centre+(TBM+Air+Cond+%26+Electrical+Sdn+Bhd)!5e0!3m2!1sen!2smy!4v1419611689431" width="100%" height="360" frameborder="0" style="border:0"></iframe>

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
                        
                        <ul id="products-tabs-list" class="tab-style-2 clearfix">

								<?php if(isset($names) && !empty($names)): ?>
								<?php foreach($names as $key => $name): ?>
                           <li class=""><a href="#klang-valley<?php echo $key++; ?>" data-toggle="tab"><?php echo $name; ?></a></li>
								<?php endforeach; ?>
								<?php endif; ?>

                        </ul>
                        
                        <div id="products-tabs-content" class="tab-content">
						<?php
						function test_alter($item, $key, $town)
						{
							static $id = 0;
							$item['info'] = isset($item['info']) ? $item['info'] : '';
						if($town == $item['location'] ){
//if($number%3 === 0 && $number != 0)
	//echo '<div data="'.$number.'" class="clearfix" ></div><div class="xlg-margin"></div>';
echo <<<EOT
<div address="{$item['address']}" data-num="{$id}" data="{$item['map']}" class="wbx-map col-md-4 col-sm-4 col-xs-6">
<div id="map_canvas{$id}" style="width:350px; height:200px"></div>

                                      <div class="sm-margin"></div>    
                                      <h3> {$item['name']} </h3>
                                      <p> {$item['address']} </p>
                                       {$item['info']}
                                      <div class="xs-margin"></div>
                                      <h4>Business Hours</h4>
                                       {$item['time']} 
        
  </div>                              

EOT;

						}
						//$number++;
							$id++;
						}	
						?>
							<?php $iter=1; if(isset($names) && !empty($names)): ?>
							<?php foreach($names as $key => $town_name): ?>	
								
                           <div class="wbs-map tab-pane" id="klang-valley<?php echo $key++; ?>">
						      <?php array_walk($stores, 'test_alter', $town_name); ?>
							</div>
							
							<?php endforeach; ?>
							<?php endif; ?>
                        
                        <!--<div class="tab-pane" id="selangor">
                            
                                <div class="clearfix"></div>
                                <div class="xlg-margin"></div>
                            
                            
                        </div>-->
                        <!-- end tab pane selangor -->
                        
                        
                    </div>
                    <!-- end product tab content -->
                        
                    </div>
                    <!-- end col-md-12 -->
                </div>
                <!-- end row -->
                
            </div>
            <!-- end container -->

    </section>
@endsection

@section('stores_maps')
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script src="{{ asset('/public/front/js/markerwithlabel.js') }}"></script>
<script type="text/javascript">
 // Cookie
 function remember(item){
		var cookieName = 'tabStore';
		var cookieOptions = {expires: 7, path: '/'};
		$.cookie(cookieName, item, cookieOptions);
	}
function initMap(lat, lng, address, i) {
     //var latLng = new google.maps.LatLng(49.47805, -123.84716);
     var homeLatLng = new google.maps.LatLng(lat, lng);

     var map = new google.maps.Map(document.getElementById('map_canvas' + i), {
       zoom: 15,
       center: homeLatLng,
       mapTypeId: google.maps.MapTypeId.ROADMAP
     });
     
     var pictureLabel = document.createElement("span");
     pictureLabel.innerHTML = address;

     new MarkerWithLabel({
       position: homeLatLng,
       map: map,
       draggable: false,
       raiseOnDrag: true,
       labelContent: pictureLabel,
       labelAnchor: new google.maps.Point(50, 0),
       labelClass: "labels", // the CSS class for the label
       //labelStyle: {opacity: 0.50}
     });

   }
$('#products-tabs-list > li').click(function(){
	var ind = $(this).index("#products-tabs-list > li");
	//console.log(ind);
	remember(ind);
$("#products-tabs-content > div:eq("+ind+")").find('.wbx-map').each(function(i, e){
   var address = $(e).attr('address');
    var addressLabel = $(e).attr('data');
	var num = $(e).attr('data-num');
    $.ajax({
  url: 'http://maps.google.com/maps/api/geocode/json?address=' + addressLabel + '&sensor=false',
  success: function($data){
	 console.log($data);
   var lat = $data.results[0].geometry.location.lat;
   var lng = $data.results[0].geometry.location.lng;

initMap(lat, lng, address, num);

  }
});
 });
 
 });
 
 if($.cookie('tabStore')){
		var tab = $.cookie('tabStore');
		console.log(tab);
		$('#products-tabs-list > li:eq(' + tab + ') > a').click();
	}else{
		$('#products-tabs-list > li:eq(0) > a').click();
	}
$(document).ready(function(){
	$('.wbs-map > div:nth-child(3n)').after('<div class="clearfix" ></div><div class="xlg-margin"></div>');
});
 </script>

@endsection
