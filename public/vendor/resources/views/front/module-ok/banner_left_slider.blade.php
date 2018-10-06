<?php 
//use App\Http\Models\User;
//$user  = new User();
//echo '<pre>';print_r($user->getUser(2));
?>
     <?php
		use App\Http\Models\Front\Banners;
		$this->BannersModel = new Banners();
		$bannersleft = $this->BannersModel->getLeftBanner();
		
		 
										
										if(!empty($bannersleft)){
											echo '<div class="widget banner-slider-container">
    <div class="banner-slider flexslider">
        <ul class="banner-slider-list clearfix">';
		foreach($bannersleft as $ban){
		if(($ban['url']!='')&&($ban['pdf_link']=='')&&($ban['enlarge_banner']==''))
		{
		$bannerlink=$ban['url'];
		}
		elseif(($ban['url']=='')&&($ban['pdf_link']!='')&&($ban['enlarge_banner']==''))
		{
		$bannerlink="http://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/left/'.$ban['pdf_link'];
		}
		elseif(($ban['url']=='')&&($ban['pdf_link']=='')&&($ban['enlarge_banner']!=''))
		{
		$bannerlink="http://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/left/'.$ban['enlarge_banner'];
		}
		else{$bannerlink="#";}
		?>
			
			
            <li><a href="<?php echo  $bannerlink ;?>" target="_blank"><img src="<?php echo "http://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/left/',$ban['banner']?>" alt="Banner 1"></a></li>
			
			<?php } ?>
          
                                       <?php echo' </ul>
                                    </div>
                                </div>'; }?>