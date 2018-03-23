<?php

/**
 * Products Children Menu Page
 */
# Custom productchild post type
add_action('init', 'create_productchild_post_type');

function create_productchild_post_type() {
    register_post_type('productchild', array(
        'labels' => array(
            'name' => __('Sản phẩm con'),
            'singular_name' => __('Sản phẩm con'),
            'add_new' => __('Add new'),
            'add_new_item' => __('Add new Product Children'),
            'new_item' => __('New Product Children'),
            'edit' => __('Edit'),
            'edit_item' => __('Edit Product Children'),
            'view' => __('View Product Children'),
            'view_item' => __('View Product Children'),
            'search_items' => __('Search Products Children'),
            'not_found' => __('No Product Children found'),
            'not_found_in_trash' => __('No Product Children found in trash'),
        ),
        'public' => true,
        'show_ui' => true,
        'publicy_queryable' => true,
        'exclude_from_search' => false,
        'menu_position' => 5,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array(
            'title', 'editor', 'thumbnail',
        //'custom-fields', 'comments', 'excerpt', 'author', 
        ),
        'rewrite' => array('slug' => 'productchild', 'with_front' => false),
        'can_export' => true,
        'description' => __('Product Children description here.')
    ));
}

function product_parent() {
    $arr = array();
    $products = new WP_Query(
    array(
        'post_type' => 'product',
        'posts_per_page' => -1
        ));
    while ($products->have_posts()) : $products->the_post();
        $arr[get_the_ID()] = get_the_title();
    endwhile;
    wp_reset_query();
    return $arr;
}

# productchild meta box
$productchild_meta_box = array(
    'id' => 'productchild-meta-box',
    'title' => 'Thông tin',
    'page' => 'productchild',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Chọn sản phẩm chính',
            'desc' => '',
            'id' => 'product_parent',
            'type' => 'select',
            'std' => '',
            'options' => product_parent(),
        ),
    )
);

// Add productchild meta box
add_action('admin_menu', 'productchild_add_box');
add_action('save_post', 'productchild_add_box');

function productchild_add_box() {
    global $productchild_meta_box;
    add_meta_box($productchild_meta_box['id'], $productchild_meta_box['title'], 'productchild_show_box', $productchild_meta_box['page'], $productchild_meta_box['context'], $productchild_meta_box['priority']);
}

// Callback function to show fields in productchild meta box
function productchild_show_box() {
    // Use nonce for verification
    global $productchild_meta_box, $post;

    custom_output_meta_box($productchild_meta_box, $post);
}

add_action('save_post', 'productchild_save_data');

// Save data from productchild meta box
function productchild_save_data($post_id) {
    global $productchild_meta_box;

    custom_save_meta_box($productchild_meta_box, $post_id);
}