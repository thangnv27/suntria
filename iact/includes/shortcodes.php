<?php

// btn dk tuyen dung
add_shortcode('btntuyendung', 'shortcode_btntuyendung');

function shortcode_btntuyendung() {
    return '<p><a data-i18n="link.register" rel="nofollow" href="#td-reginfo" class="btn-tuyendung">Đăng ký</a></p>';
}

//////////////////////////////////////////////////////////////////
// Add buttons to tinyMCE
//////////////////////////////////////////////////////////////////
add_action('init', 'add_button');

function add_button() {
    if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
        add_filter('mce_external_plugins', 'add_plugin');
        add_filter('mce_buttons_3', 'register_button');
    }
}

function register_button($buttons) {
    array_push($buttons, "btntuyendung");
    return $buttons;
}

function add_plugin($plugin_array) {
    $plugin_array['btntuyendung'] = get_template_directory_uri() . '/tinymce/customcodes.js';
    return $plugin_array;
}