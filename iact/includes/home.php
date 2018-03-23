<?php

/**
 * Home Menu Page
 */
# Custom home post type
add_action('init', 'create_home_post_type');

function create_home_post_type() {
    register_post_type('home', array(
        'labels' => array(
            'name' => __('Home'),
            'singular_name' => __('Home'),
            'add_new' => __('Add new'),
            'add_new_item' => __('Add new Home'),
            'new_item' => __('New Home'),
            'edit' => __('Edit'),
            'edit_item' => __('Edit Home'),
            'view' => __('View Home'),
            'view_item' => __('View Home'),
            'search_items' => __('Search Home'),
            'not_found' => __('No Home found'),
            'not_found_in_trash' => __('No Home found in trash'),
        ),
        'public' => false,
        'show_ui' => true,
        'publicy_queryable' => true,
        'exclude_from_search' => false,
        'menu_position' => 5,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array(
            'title', 'editor', 'author', 'thumbnail',
        //'custom-fields', 'excerpt', 'comments', 
        ),
        'rewrite' => array('slug' => 'home', 'with_front' => false),
        'can_export' => true,
        'description' => __('Home description here.')
    ));
}

# Custom home taxonomies
/* add_action('init', 'create_home_taxonomies');

  function create_home_taxonomies(){
  register_taxonomy('home_category', 'home', array(
  'hierarchical' => true,
  'labels' => array(
  'name' => __('Home Categories'),
  'singular_name' => __('Home Categories'),
  'add_new' => __('Add New'),
  'add_new_item' => __('Add New Category'),
  'new_item' => __('New Category'),
  'search_items' => __('Search Categories'),
  ),
  ));
  } */

# home meta box
$home_meta_box = array(
    'id' => 'home-meta-box',
    'title' => 'Thông tin chung',
    'page' => 'home',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Hình ảnh',
            'desc' => 'Có thể dán URL ảnh vào đây hoặc bấm nút Upload để chọn ảnh từ thư viện. Kích thước: 400x265px',
            'id' => 'home_banner',
            'type' => 'text',
            'std' => '',
            'btn' => true,
        ),
        array(
            'name' => 'Đường dẫn',
            'desc' => 'Đường dẫn khi nhấn vào link.',
            'id' => 'home_link',
            'type' => 'text',
            'std' => '',
        ),
        array(
            'name' => 'Sắp xếp',
            'desc' => 'Thứ tự sắp xếp.',
            'id' => 'home_order',
            'type' => 'text',
            'std' => '1',
        ),
        ));

// Add home meta box
if (is_admin()) {
    add_action('admin_menu', 'home_add_box');
    add_action('save_post', 'home_add_box');
    add_action('save_post', 'home_save_data');
}

function home_add_box() {
    global $home_meta_box;
    add_meta_box($home_meta_box['id'], $home_meta_box['title'], 'home_show_box', $home_meta_box['page'], $home_meta_box['context'], $home_meta_box['priority']);
}

// Callback function to show fields in home meta box
function home_show_box() {
    // Use nonce for verification
    global $home_meta_box, $post;

    custom_output_meta_box($home_meta_box, $post);
}

// Save data from home meta box
function home_save_data($post_id) {
    global $home_meta_box;
    custom_save_meta_box($home_meta_box, $post_id);
}
