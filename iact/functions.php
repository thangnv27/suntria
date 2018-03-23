<?php
/* ----------------------------------------------------------------------------------- */
# adds the plugin initalization scripts that add styles and functions
/* ----------------------------------------------------------------------------------- */
if(!current_theme_supports('deactivate_layerslider')) require_once( "config-layerslider/config.php" );//layerslider plugin

######## BLOCK CODE NAY LUON O TREN VA KHONG DUOC XOA ##########################
include 'includes/config.php';
include 'libs/HttpFoundation/Request.php';
include 'libs/HttpFoundation/Response.php';
include 'libs/HttpFoundation/Session.php';
include 'libs/custom.php';
include 'libs/common-scripts.php';
include 'libs/meta-box.php';
include 'libs/theme_functions.php';
include 'libs/theme_settings.php';
######## END: BLOCK CODE NAY LUON O TREN VA KHONG DUOC XOA ##########################
include 'includes/product.php';
include 'includes/home.php';
include 'includes/product-children.php';
include 'includes/partner.php';
include 'includes/recruitment.php';
include 'includes/shortcodes.php';
include 'ajax.php';
if(is_admin()){
    $basename_excludes = array('plugins.php', 'plugin-install.php', 'plugin-editor.php', 'themes.php', 'theme-editor.php', 
        'tools.php', 'import.php', 'export.php');
    if (in_array($basename, $basename_excludes)) {
//        wp_redirect(admin_url());
    }
    
//    include 'libs/ppofeedback.php';

    add_action('admin_menu', 'custom_remove_menu_pages');
    add_action('admin_menu', 'remove_menu_editor', 102);
}
/**
 * Remove admin menu
 */
function custom_remove_menu_pages() {
    remove_menu_page('edit-comments.php');
    remove_menu_page('plugins.php');
    remove_menu_page('tools.php');
}

function remove_menu_editor() {
    remove_submenu_page('themes.php', 'themes.php');
    remove_submenu_page('themes.php', 'theme-editor.php');
    remove_submenu_page('plugins.php', 'plugin-editor.php');
    remove_submenu_page('options-general.php', 'options-writing.php');
    remove_submenu_page('options-general.php', 'options-discussion.php');
    remove_submenu_page('options-general.php', 'options-media.php');
}

/* ----------------------------------------------------------------------------------- */
# Setup Theme
/* ----------------------------------------------------------------------------------- */
if(!function_exists("ppo_theme_setup")){
    function ppo_theme_setup(){
        ## Enable Links Manager (WP 3.5 or higher)
        //add_filter( 'pre_option_link_manager_enabled', '__return_true' );
        
        ## Post Thumbnails
        if (function_exists('add_theme_support')){
            add_theme_support('post-thumbnails');
        }
        /*if (function_exists('add_image_size')) {
            add_image_size('thumbnail176', 176, 176, FALSE);
        }*/

        ## Register menu location
        register_nav_menus(array(
            'primary' => 'Primary Location',
            'menucat' => 'Danh mục sản phẩm',
            'footermenu' => 'Footer Menu',
        ));
    }
}

add_action( 'after_setup_theme', 'ppo_theme_setup' );
/* ----------------------------------------------------------------------------------- */
# Widgets init
/* ----------------------------------------------------------------------------------- */
if(!function_exists("ppo_widgets_init")){
    function ppo_widgets_init(){
        // Register Sidebar
        register_sidebar(array(
            'id' => __('sidebar'),
            'name' => __('Sidebar'),
            'before_widget' => '<div id="%1$s" class="widget-container rbox %2$s">',
            'after_widget' => '</div></div>',
            'before_title' => '<div class="widget-title rbox-title">',
            'after_title' => '</div><div class="rbox-content">',
        ));
        register_sidebar(array(
            'id' => __('sidebar_single'),
            'name' => __('Sidebar single'),
            'before_widget' => '<div id="%1$s" class="widget-container rbox %2$s">',
            'after_widget' => '</div></div>',
            'before_title' => '<div class="widget-title rbox-title">',
            'after_title' => '</div><div class="rbox-content">',
        ));
    }
}

add_action( 'widgets_init', 'ppo_widgets_init' );

/* ----------------------------------------------------------------------------------- */
# Unset size of post thumbnails
/* ----------------------------------------------------------------------------------- */
function ppo_filter_image_sizes($sizes){
    unset($sizes['thumbnail']);
    unset($sizes['medium']);
    unset($sizes['large']);

    return $sizes;
}

add_filter('intermediate_image_sizes_advanced', 'ppo_filter_image_sizes');
/*
function ppo_custom_image_sizes($sizes){
    $myimgsizes = array(
        "image-in-post" => __("Image in Post"),
        "full" => __("Original size")
    );

    return $myimgsizes;
}

add_filter('image_size_names_choose', 'ppo_custom_image_sizes');
*/
/* ----------------------------------------------------------------------------------- */
# User login
/* ----------------------------------------------------------------------------------- */
add_action('init', 'redirect_after_logout');

function redirect_after_logout(){
    if (preg_match('#(wp-login.php)?(loggedout=true)#', $_SERVER['REQUEST_URI']))
        wp_redirect(get_option('siteurl'));
}

function get_history_order(){
    global $wpdb, $current_user;
    get_currentuserinfo();
    $records = array();
    if (is_user_logged_in()){
        $tblOrders = $wpdb->prefix . 'orders';
        $query = "SELECT $tblOrders.*, $wpdb->users.display_name, $wpdb->users.user_email FROM $tblOrders 
            JOIN $wpdb->users ON $wpdb->users.ID = $tblOrders.customer_id 
            WHERE $tblOrders.customer_id = $current_user->ID ORDER BY $tblOrders.ID DESC";
        $records = $wpdb->get_results($query);
    }
    return $records;
}

//PPO Feed all post type

function ppo_feed_request($qv) {
	if (isset($qv['feed']))
		$qv['post_type'] = get_post_types();
	return $qv;
}
add_filter('request', 'ppo_feed_request');

function getLocale() {
    $locale = "vn";
    if (get_query_var("lang") != null) {
        $locale = get_query_var("lang");
    } else if (function_exists("qtrans_getLanguage")) {
        $locale = qtrans_getLanguage();
    } else if (defined('ICL_LANGUAGE_CODE')) {
        $locale = ICL_LANGUAGE_CODE;
    }
    if ($locale == "vi") {
        $locale = "vn";
    }
    return $locale;
}

function languages_list_flag(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    if(!empty($languages)){
        foreach($languages as $l){
            if(!$l['active']) echo '<a href="'.$l['url'].'">';
            echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
            if(!$l['active']) echo '</a>';
        }
    }
}

/* ----------------------------------------------------------------------------------- */
# Register menu location
/* ----------------------------------------------------------------------------------- */
function admin_add_custom_js(){
    ?>
    <script type="text/javascript">/* <![CDATA[ */
        jQuery(function($){
            var area = new Array();

            $.each(area, function(index, id){
                //tinyMCE.execCommand('mceAddControl', false, id);
                tinyMCE.init({
                    selector: "textarea#" + id,
                    height: 400
                });
                $("#newmeta-submit").click(function(){
                    tinyMCE.triggerSave();
                });
            });

            $(".submit input[type='submit']").click(function(){
                if(typeof tinyMCE != 'undefined'){
                    tinyMCE.triggerSave();
                }
            });
        });
        /* ]]> */
    </script>
<?php
}
add_action('admin_print_footer_scripts', 'admin_add_custom_js', 99);

function pre_get_image_url($url, $show = true){
    if(trim($url) == "")
        $url = get_template_directory_uri() . "/images/no_image_available.jpg";
    if($show)
        echo $url;
    else
        return $url;
}
/* ----------------------------------------------------------------------------------- */
# Custom search
/* ----------------------------------------------------------------------------------- */
add_action('pre_get_posts','custom_search_filter');

function custom_search_filter($query){
    if (!is_admin() && $query->is_main_query()){
        if($query->is_archive and is_taxonomy('product_category')){
            $products_per_page = intval(get_option(SHORT_NAME . "_product_pager"));
            if ($products_per_page == 0) {
                $products_per_page = 6;
            }
            $query->set('posts_per_page', $products_per_page);
        }
    }
    return $query;
}
/*
add_filter('posts_where', 'title_like_posts_where');

function title_like_posts_where($where){
    global $wpdb, $wp_query;
    if($wp_query->is_search){
        $where = str_replace("AND ((ppo_postmeta.meta_key =", "OR ((ppo_postmeta.meta_key =", $where);
    }
    return $where;
}
*/
/* ----------------------------------------------------------------------------------- */
# Custom style
/* ----------------------------------------------------------------------------------- */
add_action('wp_head', 'ppo_theme_front_styling');

function ppo_theme_front_styling(){
    $primaryColor = get_option(SHORT_NAME . "_primaryColor");
    $linkColor = get_option(SHORT_NAME . "_linkColor");
    $linkHVColor = get_option(SHORT_NAME . "_linkHVColor");
    
    $primaryBigColor = get_option(SHORT_NAME . "_primaryBigColor");
    $primaryBigBgColor = get_option(SHORT_NAME . "_primaryBigBgColor");
    
    $bgColor = get_option(SHORT_NAME . "_bgColor");
    $bgImage = get_option(SHORT_NAME . "_bgImage");
    $bgNoRepeat = get_option(SHORT_NAME . "bgNoRepeat");
    
    $bgMenu = get_option(SHORT_NAME . "_bgMenu");
    $bgMenurp = get_option(SHORT_NAME . "_bgMenurp");
    
    $linkMenu = get_option(SHORT_NAME . "_linkMenu");
    $linkHVMenu = get_option(SHORT_NAME . "_linkHVMenu");
    
    $footerColor = get_option(SHORT_NAME . "_footerColor");
    $footerBgColor = get_option(SHORT_NAME . "_footerBgColor");
    
    
    $themeurl = get_bloginfo('stylesheet_directory');
    
    $style = '<style type="text/css">';
    
    if(in_array(strlen($bgColor), array(3, 6)) or strlen($bgImage) > 0){
        if($bgNoRepeat){
            $style .= <<<HTML
body{background:url("{$bgImage}") no-repeat #{$bgColor}!important;}
HTML;
        }else{
            $style .= <<<HTML
body{background:url("{$bgImage}") repeat #{$bgColor}!important;}
HTML;
        }
    }

        if(strlen($primaryBigColor) == 3 or strlen($primaryBigColor) == 6){
        $style .= <<<HTML
.banner-archive .heading h1, .banner-archive .heading h2 {
    border-bottom: 1px solid #{$primaryBigColor};
    color: #{$primaryBigColor};}
.breadcrumbs { color: #{$primaryBigBgColor};}
.daily { color: #{$primaryBigColor}; background: #{$primaryBigBgColor};}
    
.rbox-title {border-color: #{$primaryBigBgColor}; color: #{$primaryBigBgColor};}
.popular-news .rbox-content ul li {  border-color: #{$primaryBigBgColor};}
.pp-date { color: #{$primaryBigBgColor};}

.box-left {
  background-color: #{$primaryBigBgColor};
  color: #{$primaryBigColor};
}
.box-left .box-left-title { border-color: #{$primaryBigColor}; }
.box-left ul li a { color: #{$primaryBigColor}; }
.cat-title h2 { background-color: #{$primaryBigBgColor};color: #{$primaryBigColor};}

.cat-item-title {
  background-color: #{$primaryBigBgColor};
  color: #{$primaryBigColor};
}
.cat-item-title a, .cat-item-title a:hover {
  color: #{$primaryBigColor};
}
.cat-item {
  border-color:#{$primaryBigBgColor};
}
.product-title h2 {
  border-color: #{$primaryBigBgColor};
  color: #{$primaryBigBgColor};
}
.hotline {
    color: #{$primaryBigBgColor};
}
.pitem-meta span, .pitem-category a {
  color: #{$primaryBigBgColor};
}
.btn-tuyendung {
  color: #{$primaryBigColor};
background-color: #{$primaryBigBgColor};
}
.post-td-tab {
    background-color: #{$primaryBigBgColor};
}
.post-td-tab li a {
  color: #{$primaryBigColor};
}
.block-title h3 {
  border-bottom: 1px solid #{$primaryBigBgColor};
  color: #{$primaryBigBgColor};
}
.search-box {
  border-color: #{$primaryBigBgColor}!important;
}
HTML;
    }
    
    if(strlen($linkColor) == 3 or strlen($linkColor) == 6){
        $style .= <<<HTML
strong, b {
  color: #{$linkColor};
}
.partner-title {
    color: #{$linkColor};
}
.pitem-excerpt a, .pitem-details a {
  color: #{$linkColor};
}

HTML;
    }
    if(strlen($primaryColor) == 3 or strlen($primaryColor) == 6){
        $style .= <<<HTML
html, body{ color: #{$primaryColor}!important;}
a, a span{color: #{$linkColor};}
a:hover, a span:hover {color: #{$linkHVColor};}

@media(max-width:767px){
    #navigation ul.nav-menu{background: #{$primaryColor}}
}
HTML;
    }

    if(strlen($linkMenu) == 3 or strlen($linkMenu) == 6){
        $style .= <<<HTML

.menutop ul li a{color: #{$linkMenu};}
.menutop ul li a{color: #{$linkMenu};}
.menutop ul li a:hover, .menutop ul li.current-menu-ancestor > a{border-color: #{$linkHVMenu};color:#{$linkHVMenu};}
.menutop ul li.current-menu-item > a{border-color: #{$linkHVMenu};color:#{$linkHVMenu};}
HTML;
    }
    if(strlen($bgMenu) > 0){
        $style .= <<<HTML
.menutop {
  background: url("{$bgMenu}") no-repeat scroll left center;
}
HTML;
    }
    if(strlen($bgMenurp) > 0){
        $style .= <<<HTML
.bgr_repeat {
  background: url("$bgMenurp") repeat-x right bottom #FFFFFF;
}
HTML;
    }
    
    if(strlen($footerColor) == 3 or strlen($footerColor) == 6){
        $style .= <<<HTML
#footer { background: #{$footerBgColor};}
.footerinfo a, .footerinfo a:hover { color: #{$footerColor};}
.ftitle { border-bottom: 1px solid #{$footerColor};  color: #{$footerColor};}
.footerinfo li{color:#{$footerColor};}
.footerintro li, .footerintro li a {color: #{$footerColor};}
.ft-ct h3 { color: #{$footerColor};}

HTML;
    }
    
    $style .= '</style>';
    echo $style;
}