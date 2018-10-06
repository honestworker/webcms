<?php $footer = Page::getFooterinfo(); ?> 
    <footer id="footer" style="background-image: url('images/<?php echo $footer['image']['fg']; ?>')">

        <div id="inner-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-xs-12 widget">
                        <h3>Categories</h3>
                        <ul class="links">
                            <li><a href="#">Audio visual</a></li>
                            <li><a href="#">Home appliances</a></li>
                            <li><a href="#">Kitchen appliances</a></li>
                            <li><a href="#">Personal &amp; beauty care</a></li>
                            <li><a href="#">Office appliances</a></li>
                            <li><a href="#">Digital gadget</a></li>
                            <li><a href="#">Accessories &amp; others</a></li>
                        </ul>
                    </div>
              		<div class="col-md-3 col-sm-4 col-xs-12 widget">
                        <h3>About TBM</h3>
                        <ul class="links">
                            <li><a href="about">About us</a></li>
                            <li><a href="vacancy">Careers</a></li>
                            <li><a href="services">Our services</a></li>
                            <li><a href="stores">Our stores</a></li>
                            <li><a href="contact">Contact us</a></li>
                        </ul>
                    </div>
              		<div class="col-md-3 col-sm-4 col-xs-12 widget">
                        <h3>Contact Us</h3>
                        <ul class="contact-list">
                            <li><strong>TAN BOON MING SDN BHD</strong> (494355-D)</li>
                            <li>PS 4,5,6 &amp; 7, Taman Evergreen, Batu 4, Jalan Klang Lama, 58100 Kuala Lumpur.</li>
                            <li><i class="fa fa-phone"></i> Tel: (603) 7983-2020 (Hunting Lines)</li>
                            <li><i class="fa fa-fax"></i> Fax: (603) 7982-8141</li>
                            <li><i class="fa fa-envelope"></i> <a href="mailto:info@tbm.com.my">info@tbm.com.my</a></li>
                            <li><i class="fa fa-history"></i> Business Hours: </li>
                            <li>Mon. - Sat.: 9.30am - 9.00pm</li>
                            <li>Sun.: 10.00am - 9.00pm</li>
                        </ul>
                    </div>
                  <div class="clearfix visible-sm"></div>
                    <div class="col-md-3 col-sm-12 col-xs-12 widget">
                       <div class="md-margin"></div>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3983.986191765057!2d101.676021!3d3.098329!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4f927fdab737f312!2sTAN+BOON+MING+SDN+BHD!5e0!3m2!1sen!2s!4v1415724613461" width="100%" height="260" frameborder="0" style="border:0"></iframe>
                    </div>
              </div>
            </div>
        </div>
        <div id="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12 footer-social-links-container">
                        <ul class="social-links clearfix">
							<?php if(isset($footer['icon']) && !empty($footer['icon'])) :?>
							<?php foreach($footer['icon'] as $one) :?>
							<?php if($one['active']): ?>
                            <li><a href="<?php echo $one['link']; ?>" class="social-icon <?php echo $one['icon']; ?>"></a></li>
							<?php endif; ?>
							<?php endforeach; ?>
							<?php endif; ?>
                        </ul>
                    </div>
              		<div class="col-md-5 col-sm-7 col-xs-12 footer-text-container pull-left">
                        <p><?php echo $footer['copyright']['copyright']; ?><br/>Powered by: <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> </p>
                    </div>
              </div>
            </div>
        </div>
    </footer>