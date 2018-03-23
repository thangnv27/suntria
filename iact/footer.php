<div id="footer">
    <div class="container">
        <div class="row-fluid ft-inner">
            <div class="span4 footerinfo">
                <div class="ftitle" data-i18n="footer.contact">Liên hệ</div>
                <ul>
                    <li class="icons-home">
                        <?php
                        if (getLocale() == 'en') {
                            echo get_option('info_addressen');
                        } else {

                            echo get_option('info_address');
                        }
                        ?>
                    </li>
                    <li class="icons-mail"><a href="mailto:<?php echo get_option('info_email'); ?>"><?php echo get_option('info_email'); ?></a></li>
                    <li class="icons-call"><?php echo get_option('info_tel'); ?></li>
                </ul>
            </div>
            <div class="span4 footerintro">
                <div class="ftitle" data-i18n="footer.intro">Giới thiệu</div>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footermenu',
                    'menu_class' => '',
                    'container' => ''
                ));
                ?>
            </div>
            <div class="span4 footersocial">
                <div class="ftitle" data-i18n="footer.follow">Follow Us</div>
                <div class="ft-ct clearfix">
                    <h3>Action To The Future</h3>
                </div>
                <div class="social">
                    <a rel="nofollow" class="ico-facebook" title="Follow on Facebook" target="_blank" href="<?php echo get_option(SHORT_NAME . '_fbURL'); ?>"></a>
                    <a rel="nofollow" class="ico-twitter" title="Follow on Twitter" target="_blank" href="<?php echo get_option(SHORT_NAME . '_twitterURL'); ?>"></a>
                    <a rel="nofollow" class="ico-linkin" title="Follow on Linked In" target="_blank" href="<?php echo get_option(SHORT_NAME . '_linkedInURL'); ?>"></a>
                    <a rel="nofollow" class="ico-gplus" title="Follow on Google+" target="_blank" href="<?php echo get_option(SHORT_NAME . '_googlePlusURL'); ?>"></a>
                    <a rel="nofollow" class="ico-rss" title="RSS+" target="_blank" href="<?php bloginfo('rss2_url'); ?>"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="ppo">
    <div class="container">
        <div class="row-fluid">
            Copyright &COPY; <?php echo get_option("unit_owner"); ?>. All Right Reserved. Powered by <a href="http://web5s.com" target="_blank" title="Thiết kế web chuyên nghiệp">WEB5S.COM</a>
        </div>
    </div>
</div>


<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.expander.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.hoverIntent.minified.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.carouFredSel-6.2.1-packed.js"></script>

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/helper-plugins/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/helper-plugins/jquery.touchSwipe.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/helper-plugins/jquery.transit.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/helper-plugins/jquery.ba-throttle-debounce.min.js"></script>

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/wz_tooltip.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.tooltip.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/i18next-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/app.js"></script>
<?php wp_footer(); ?>
</body>
</html>