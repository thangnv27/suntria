<?php

/**
 * Recruitment Menu Page
 */

# Custom recruitment post type
add_action('init', 'create_recruitment_post_type');

function create_recruitment_post_type(){
    register_post_type('recruitment', array(
        'labels' => array(
            'name' => __('Tuyển dụng'),
            'singular_name' => __('Tuyển dụng'),
            'add_new' => __('Add new'),
            'add_new_item' => __('Add new Recruitment'),
            'new_item' => __('New Recruitment'),
            'edit' => __('Edit'),
            'edit_item' => __('Edit Recruitment'),
            'view' => __('View Recruitment'),
            'view_item' => __('View Recruitment'),
            'search_items' => __('Search Recruitment'),
            'not_found' => __('No Recruitment found'),
            'not_found_in_trash' => __('No Recruitment found in trash'),
        ),
        'public' => true,
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
        'rewrite' => array('slug' => 'recruitment', 'with_front' => false),
        'can_export' => true,
        'description' => __('Recruitment description here.')
    ));
}

# Custom recruitment taxonomies
/*add_action('init', 'create_recruitment_taxonomies');

function create_recruitment_taxonomies(){
    register_taxonomy('recruitment_category', 'recruitment', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => __('Recruitment Categories'),
            'singular_name' => __('Recruitment Categories'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Category'),
            'new_item' => __('New Category'),
            'search_items' => __('Search Categories'),
        ),
    ));
}*/

# recruitment meta box
$recruitment_meta_box = array(
    'id' => 'recruitment-meta-box',
    'title' => 'Thông tin chung',
    'page' => 'recruitment',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Banner',
            'desc' => 'Có thể dán URL ảnh vào đây hoặc bấm nút Upload để chọn ảnh từ thư viện. Kích thước: 820x*px',
            'id' => 'post_banner',
            'type' => 'text',
            'std' => '',
            'btn' => true,
        ),
        array(
            'name' => 'Đơn đăng ký mẫu',
            'desc' => 'Có thể dán URL file vào đây hoặc bấm nút Upload để chọn file từ thư viện.',
            'id' => 'post_td_example',
            'type' => 'text',
            'std' => '',
            'btn' => true,
        ),
        array(
            'name' => 'Đăng ký',
            'desc' => 'Các hình thức đăng ký',
            'id' => 'method_register',
            'type' => 'textarea',
            'std' => '',
            'editor' => array(
                "wyswig" => true,
                "rows" => 10,
            ),
        ),
));

// Add recruitment meta box
if(is_admin()){
    add_action('admin_menu', 'recruitment_add_box');
    add_action('save_post', 'recruitment_add_box');
    add_action('save_post', 'recruitment_save_data');
}

function recruitment_add_box(){
    global $recruitment_meta_box;
    add_meta_box($recruitment_meta_box['id'], $recruitment_meta_box['title'], 'recruitment_show_box', $recruitment_meta_box['page'], $recruitment_meta_box['context'], $recruitment_meta_box['priority']);
}

// Callback function to show fields in recruitment meta box
function recruitment_show_box() {
    // Use nonce for verification
    global $recruitment_meta_box, $post;

    custom_output_meta_box($recruitment_meta_box, $post);
}

// Save data from recruitment meta box
function recruitment_save_data($post_id) {
    global $recruitment_meta_box;
    custom_save_meta_box($recruitment_meta_box, $post_id);
}
