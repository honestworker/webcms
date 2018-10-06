<?php 
//use App\Http\Models\User;
//$user  = new User();
//echo '<pre>';print_r($user->getUser(2));

?>
 <?php
										
										if(!empty($bannersbottom)){
											echo '<div class="banner-hero">
                                  
                                        <ul>';   
       foreach($bannersbottom as $mymiddlebottom){
		   
		if(( $mymiddlebottom['url']!='')&&( $mymiddlebottom['pdf_link']=='')&&( $mymiddlebottom['enlarge_banner']==''))
		{
		$bannerlink= $mymiddlebottom['url'];
		}
		elseif(( $mymiddlebottom['url']=='')&&( $mymiddlebottom['pdf_link']!='')&&( $mymiddlebottom['enlarge_banner']==''))
		{
		$bannerlink= "http://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/middlebottom/'.$mymiddlebottom['pdf_link'];
		}
		elseif(( $mymiddlebottom['url']=='')&&( $mymiddlebottom['pdf_link']=='')&&( $mymiddlebottom['enlarge_banner']!=''))
		{
		$bannerlink= "http://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/middlebottom/'.$mymiddlebottom['enlarge_banner'];
		}
		else{$bannerlink="#";}   
      ?>
<!--<img src="{{ asset('/public/front//images/index/homebanner.jpg') }}" alt="">-->

 <li data-transition="random" data-saveperformance="on" data-title="Easy to Customize">
<a href="<?php echo  $bannerlink ;?>" target="_blank"><img src="<?php echo "http://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/middlebottom/',$mymiddlebottom['banner'];?>" alt="<?php echo $mymiddlebottom['title'];?> "></a>
 </li>

<?php  }?>  

<?php echo' </ul>
                                  
                                </div>'; }?>


                      
                                    
                               