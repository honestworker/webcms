<?php 
//use App\Http\Models\User;
//$user  = new User();
//echo '<pre>';print_r($user->getUser(2));

?>

                  
                   <?php
										
										if(!empty($bannerslmiddletop)){
											echo '<div class="row home-banners"> '; 
                                    
       foreach($bannerslmiddletop as $mymiddletop){
		   if(($mymiddletop['url']!='')&&($mymiddletop['pdf_link']=='')&&($mymiddletop['enlarge_banner']==''))
		{
		$bannerlink=$mymiddletop['url'];
		}
		elseif(($mymiddletop['url']=='')&&($mymiddletop['pdf_link']!='')&&($mymiddletop['enlarge_banner']==''))
		{
		$bannerlink="http://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/middletop/'.$mymiddletop['pdf_link'];
		}
		elseif(($mymiddletop['url']=='')&&($mymiddletop['pdf_link']=='')&&($mymiddletop['enlarge_banner']!=''))
		{
		$bannerlink="http://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/middletop/'.$mymiddletop['enlarge_banner'];
		}
		else{$bannerlink="#";}
		   
		   
      ?>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <a href="<?php echo  $bannerlink ;?>" target="_blank">
                                            <img src="<?php echo "http://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/middletop/'.$mymiddletop['banner'];?>" alt="<?php echo $mymiddletop['title']; ?>" class="img-responsive">                                       
                                             </a>                                    </div>
                                             
                                             
                                             
                                          <?php }?>  
                              <?php echo'</div>  <div class="md-margin"></div>'; }?>
                               
                             
                             
                             
                                    
                                    
                               