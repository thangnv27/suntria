<?php
include_once 'libs/bbit-compress.php';
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
        <title><?php wp_title('|', true, 'right'); ?></title>
        <meta name="keywords" content="<?php echo get_option('keywords_meta') ?>" />
        <meta name="author" content="ppo.vn" />
        <meta name="robots" content="index, follow" /> 
        <meta name="googlebot" content="index, follow" />
        <meta name="bingbot" content="index, follow" />
        <meta name="geo.region" content="VN" />
        <meta name="geo.position" content="14.058324;108.277199" />
        <meta name="ICBM" content="14.058324, 108.277199" />
        <meta property="fb:app_id" content="<?php echo get_option(SHORT_NAME . "_appFBID"); ?>" />
        <?php if(!is_singular('product')): ?>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <?php endif;?>

        <link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />        
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/common.css" />
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/wp-default.css" />
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/bootstrap-responsive.min.css" />
        <link href='http://fonts.googleapis.com/css?family=Roboto:500,100|Roboto+Condensed|Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic&subset=latin,vietnamese' rel='stylesheet' type='text/css'>

        <script>
            var siteUrl = "<?php bloginfo('siteurl'); ?>";
            var themeUrl = "<?php bloginfo('stylesheet_directory'); ?>";
            var no_image_src = themeUrl + "/images/no_image_available.jpg";
            var is_fixed_menu = <?php echo (get_option(SHORT_NAME . "_fixedMenu")) ? 'true' : 'false'; ?>;
            var is_home = <?php echo is_home() ? 'true' : 'false'; ?>;
            var is_single_product = <?php echo (is_single() and get_post_type() == "product") ? 'true' : 'false'; ?>;
            var ajaxurl = siteUrl + '/wp-admin/admin-ajax.php';
            var lang = "<?php echo getLocale(); ?>";
        </script>
        <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
        <![endif]-->

        <?php
        if (is_singular())
            wp_enqueue_script('comment-reply');

        wp_head();
        ?>
    </head>
    <body class="i18n">
        <!--BEGIN HEADER-->
        <div id="header">
            <?php if(is_home() or is_front_page()): ?>
            <h1 class="site-title" itemprop="headline">
                <a href="<?php echo home_url(); ?>"><?php bloginfo("name"); ?> - <?php bloginfo("description") ?></a>
            </h1>
            <?php endif; ?>
            <div class="container">
                <div class="row-fluid">
                    <!--Logo-->
                    <div class="span3 logo" itemtype="http://schema.org/Organization" itemscope="itemscope">
                        <a href="<?php bloginfo('siteurl'); ?>" title="<?php bloginfo('sitename'); ?>" rel="home" itemprop="url">
                            <img src="<?php echo get_option('sitelogo'); ?>" title="<?php bloginfo('sitename'); ?>" alt="<?php bloginfo('sitename'); ?>" itemprop="logo" />
                        </a>
                    </div>

                    <!--Navigation-->
                    <div class="span9 navtop">
                        <div class="topsearch clearfix">
                            <form action="<?php echo home_url(); ?>" method="get">
                                <?php
                                $hotline = get_option(SHORT_NAME . "_hotline");
                                if ($hotline != "") {
                                    echo '<span class="hotline">' . $hotline . '</span>';
                                }
                                ?>
                                <input type="text" data-i18n="[placeholder]input.search" class="search-box" name="s" value="" placeholder="Tìm kiếm..." />
                            </form>
                            <div class="flag">
                                <?php languages_list_flag(); ?>
                            </div>
                        </div>
                        <div id="mobile-menu">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_class' => '',
                                'container' => ''
                            ));
                            ?>
                        </div>
                        <div class="menutop">
                            <div class="iconmenu"></div>
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_class' => '',
                                'container' => ''
                            ));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bgr_repeat"></div>
        </div>
        <!--END HEADER-->
