<?php

/**
 * Partners Menu Page
 */

# Custom partner post type
add_action('init', 'create_partner_post_type');

function create_partner_post_type(){
    register_post_type('partner', array(
        'labels' => array(
            'name' => __('Đối tác'),
            'singular_name' => __('Đối tác'),
            'add_new' => __('Add new'),
            'add_new_item' => __('Add new Partner'),
            'new_item' => __('New Partner'),
            'edit' => __('Edit'),
            'edit_item' => __('Edit Partner'),
            'view' => __('View Partner'),
            'view_item' => __('View Partner'),
            'search_items' => __('Search Partners'),
            'not_found' => __('No Partner found'),
            'not_found_in_trash' => __('No Partner found in trash'),
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
        'rewrite' => array('slug' => 'partner', 'with_front' => false),
        'can_export' => true,
        'description' => __('Partner description here.')
    ));
}

# Custom partner taxonomies
add_action('init', 'create_partner_taxonomies');

function create_partner_taxonomies(){
    register_taxonomy('partner_category', 'partner', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => __('Partner Categories'),
            'singular_name' => __('Partner Categories'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Category'),
            'new_item' => __('New Category'),
            'search_items' => __('Search Categories'),
        ),
    ));
}

# partner meta box
$partner_meta_box = array(
    'id' => 'partner-meta-box',
    'title' => 'Thông tin',
    'page' => 'partner',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Sắp xếp (Integer)',
            'desc' => '',
            'id' => 'partner_order',
            'type' => 'text',
            'std' => '1',
        ),
));

// Add partner meta box
add_action('admin_menu', 'partner_add_box');
add_action('save_post', 'partner_add_box');

function partner_add_box(){
    global $partner_meta_box;
    add_meta_box($partner_meta_box['id'], $partner_meta_box['title'], 'partner_show_box', $partner_meta_box['page'], $partner_meta_box['context'], $partner_meta_box['priority']);
}

// Callback function to show fields in partner meta box
function partner_show_box() {
    // Use nonce for verification
    global $partner_meta_box, $post;

    custom_output_meta_box($partner_meta_box, $post);
}

add_action('save_post', 'partner_save_data');

// Save data from partner meta box
function partner_save_data($post_id) {
    global $partner_meta_box;
    
    custom_save_meta_box($partner_meta_box, $post_id);
}

// ADD NEW COLUMN  
function partner_columns_head($defaults) {
    $defaults['partner_order'] = 'Order';
    return $defaults;
}

// SHOW THE COLUMN
function partner_columns_content($column_name, $post_id) {
    if ($column_name == 'partner_order') {
        $partner_order = get_post_meta( $post_id, 'partner_order', true );
        if ($partner_order) {
            echo $partner_order;
        }
    }
}

add_filter('manage_partner_posts_columns', 'partner_columns_head');  
add_action('manage_partner_posts_custom_column', 'partner_columns_content', 10, 2);  