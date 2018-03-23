<?php

add_action('init', 'add_custom_js');

function add_custom_js() {
    // code to embed th  java script file that makes the Ajax request  
    //wp_enqueue_script('ajax.js', get_bloginfo('template_directory') . "/js/ajax.js", array('jquery'), false, true);
//    wp_enqueue_script('ajax.js', get_bloginfo('template_directory') . "/js/ajax.js");
    wp_enqueue_script('jquery.tooltip.js', get_bloginfo('template_directory') . "/js/jquery.tooltip.js");
    // code to declare the URL to the file handling the AJAX request 
    //wp_localize_script( 'ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) ); 
}

/* ----------------------------------------------------------------------------------- */
# Tooltip
/* ----------------------------------------------------------------------------------- */
function product_tooltip(){
    $product_id = getRequest('product_id');
    $response = array(
        'id' => $product_id,
        'title' => get_the_title($product_id),
        'content' => get_post($product_id)->post_content
    );
    
    Response(json_encode($response));
    
    exit();
}