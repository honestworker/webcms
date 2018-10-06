<?php 
//use App\Http\Models\User;
//$user  = new User();
//echo '<pre>';print_r($user->getUser(2));

?>




                                        <?php
										
										if(!empty($banners)){
											echo '<div id="slider-rev-container">
                                    <div id="slider-rev">
                                        <ul>';
	foreach($banners as $ban){
		if(($ban['url']!='')&&($ban['pdf_link']=='')&&($ban['enlarge_banner']==''))
		{
		$bannerlink=$ban['url'];
		}
		elseif(($ban['url']=='')&&($ban['pdf_link']!='')&&($ban['enlarge_banner']==''))
		{
		$bannerlink="http://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/top/'.$ban['pdf_link'];
		}
		elseif(($ban['url']=='')&&($ban['pdf_link']=='')&&($ban['enlarge_banner']!=''))
		{
		$bannerlink="http://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/top/'.$ban['enlarge_banner'];
		}
		else{$bannerlink="#";}
		
			
?>

                                            <li data-transition="random" data-saveperformance="on" data-title="Easy to Customize">
                                            	<a href="<?php echo  $bannerlink ;?>" target="_blank">
                                                	<img src="{{ asset('/public/front/images/revslider/dummy.png') }}" alt="slidebg1" data-lazyload="<?php echo "http://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/top/',$ban['banner']?>" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
                                                </a>
                                            </li>
                                            
                                       <?php }?>     
                                       <?php echo' </ul>
                                    </div>
                                </div>								
								 <div class="md-margin"></div>'; }?>