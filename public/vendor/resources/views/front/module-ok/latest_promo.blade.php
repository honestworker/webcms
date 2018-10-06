
        
         <?php  
		 use App\Http\Models\Front\Banners;
		 $this->BannersModel = new Banners();
		 $bannerslatestpromo = $this->BannersModel->getLatestPromoLeftBanner(); 
		 
		
										
										if(!empty($bannerslatestpromo)){
											echo '<div class="widget latest-posts">
     										<h3>Latest Promo</h3>
   											 <div class="latest-posts-slider flexslider sidebarslider">
        									<ul class="latest-posts-list clearfix">'; 
      	 foreach($bannerslatestpromo as $promo){
			 
			 if(($promo['url']!='')&&($promo['pdf_link']=='')&&($promo['enlarge_banner']==''))
		{
		$bannerlink=$promo['url'];
		}
		elseif(($promo['url']=='')&&($promo['pdf_link']!='')&&($promo['enlarge_banner']==''))
		{
		$bannerlink="http://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/leftpromotion/'.$promo['pdf_link'];
		}
		elseif(($promo['url']=='')&&($promo['pdf_link']=='')&&($promo['enlarge_banner']!=''))
		{
		$bannerlink="http://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/leftpromotion/'.$promo['enlarge_banner'];
		}
		else{$bannerlink="#";}
      ?>
        <li>
                <a href="<?php echo $bannerlink ;?>" target="_blank">
                    <figure class="latest-posts-media-container">
                        <img class="img-responsive" src="<?php echo "http://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/leftpromotion/',$promo['banner']?>" alt="<?php echo $promo['title']; ?>">                                                    </figure>
                </a>
                <h4><a href="<?php echo $bannerlink ;?>" target="_blank"><?php echo $promo['title']; ?></a></h4>
                <p> <?php   
	  $short=$promo['short_description'];
	   echo strlen($short)<=10 ? $short : substr($short,0,80).'...'; ?>
				<?php // echo $promo['short_description']; ?></p>
                
            </li>
          <?php }?>   
             <?php echo'  </ul>
			</div>
		</div>'; }?>
			 
            
       