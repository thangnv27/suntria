<?php
/* ----------------------------------------------------------------------------------- */
# Create post_type
/* ----------------------------------------------------------------------------------- */
add_action('init', 'create_product_post_type');

function create_product_post_type(){
    register_post_type('product', array(
        'labels' => array(
            'name' => __('Sản phẩm'),
            'singular_name' => __('Sản phẩm'),
            'add_new' => __('Add new'),
            'add_new_item' => __('Add new Product'),
            'new_item' => __('New Product'),
            'edit' => __('Edit'),
            'edit_item' => __('Edit Product'),
            'view' => __('View Product'),
            'view_item' => __('View Product'),
            'search_items' => __('Search Products'),
            'not_found' => __('No Product found'),
            'not_found_in_trash' => __('No Product found in trash'),
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
        'rewrite' => array('slug' => 'product', 'with_front' => false),
        'can_export' => true,
        'description' => __('Product description here.'),
        //'taxonomies' => array('post_tag'),
    ));
}
/* ----------------------------------------------------------------------------------- */
# Create taxonomy
/* ----------------------------------------------------------------------------------- */
add_action('init', 'create_product_taxonomies');

function create_product_taxonomies(){
    register_taxonomy('product_category', 'product', array(
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'labels' => array(
            'name' => __('Product Categories'),
            'singular_name' => __('Product Categories'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Category'),
            'new_item' => __('New Category'),
            'search_items' => __('Search Categories'),
        ),
    ));
}

if(function_exists("qtrans_modifyTermFormFor")){
    add_action('product_category_add_form', 'qtrans_modifyTermFormFor');
    add_action('product_category_edit_form', 'qtrans_modifyTermFormFor');
}

// Show filter
add_action('restrict_manage_posts','restrict_product_by_product_category');
function restrict_product_by_product_category() {
    global $wp_query, $typenow;
    if ($typenow=='product') {
        $taxonomies = array('product_category');
        foreach ($taxonomies as $taxonomy) {
            $category = get_taxonomy($taxonomy);
            wp_dropdown_categories(array(
                'show_option_all' =>  __("$category->label"),
                'taxonomy'        =>  $taxonomy,
                'name'            =>  $taxonomy,
                'orderby'         =>  'name',
                'selected'        =>  $wp_query->query['term'],
                'hierarchical'    =>  true,
                'depth'           =>  3,
                'show_count'      =>  true, // Show # listings in parens
                'hide_empty'      =>  true, // Don't show businesses w/o listings
            ));
        }
    }
}

// Get post where filter condition

add_filter( 'posts_where' , 'products_where' );
function products_where($where) {
    if (is_admin()) {
        global $wpdb;
        
        $wp_posts = $wpdb->posts;
        $term_relationships = $wpdb->term_relationships;
        $term_taxonomy = $wpdb->term_taxonomy;

        $product_category = intval(getRequest('product_category'));
        $product_factor = intval(getRequest('product_factor'));
        if ($product_category > 0 or $product_factor > 0) {
            $where .= " AND $wp_posts.ID IN (SELECT DISTINCT {$term_relationships}.object_id FROM {$term_relationships} 
                WHERE {$term_relationships}.term_taxonomy_id IN (
                    SELECT DISTINCT {$term_taxonomy}.term_taxonomy_id FROM {$term_taxonomy} ";
            
            if ($product_category > 0 and $product_factor > 0) {
                $where .= " WHERE {$term_taxonomy}.term_id IN ($product_category, $product_factor) 
                                AND {$term_taxonomy}.taxonomy IN ('product_category', 'product_factor' ) ) )";
            } elseif ($product_category > 0) {
                $where .= " WHERE {$term_taxonomy}.term_id = $product_category 
                                AND {$term_taxonomy}.taxonomy = 'product_category') )";
            } elseif ($product_factor > 0) {
                $where .= " WHERE {$term_taxonomy}.term_id = $product_factor 
                                AND {$term_taxonomy}.taxonomy = 'product_factor') )";
            }
                            
            $where = str_replace("AND 0 = 1", "", $where);
        }
    }
    return $where;
}
/* ----------------------------------------------------------------------------------- */
# Meta box
/* ----------------------------------------------------------------------------------- */
$product_meta_box = array(
    'id' => 'product-meta-box',
    'title' => 'Thông tin sản phẩm',
    'page' => 'product',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Sản phẩm nổi bật',
            'desc' => '',
            'id' => 'is_most',
            'type' => 'radio',
            'std' => '',
            'options' => array(
                '1' => 'Yes',
                '0' => 'No'
            )
        ),
));
$area_fields = array(
//    array(
//        "name" => "Giới thiệu",
//        "id" => "gioi_thieu",
//        'desc' => '',
//        'rows' => 8,
//    ),
);

// Add product meta box
if(is_admin()){
    add_action('admin_menu', 'product_add_box');
    add_action('save_post', 'product_add_box');
    add_action('save_post', 'product_save_data');
}

function product_add_box(){
    global $product_meta_box;
    add_meta_box($product_meta_box['id'], $product_meta_box['title'], 'product_show_box', $product_meta_box['page'], $product_meta_box['context'], $product_meta_box['priority']);
}
/**
 * Callback function to show fields in product meta box
 * @global array $product_meta_box
 * @global Object $post
 * @global array $area_fields
 */
function product_show_box() {
    global $product_meta_box, $post, $area_fields;
    custom_output_meta_box($product_meta_box, $post);
    
    echo <<<HTML
    <style type="text/css">
        .wp_themeSkin iframe{background: #FFFFFF;}
    </style>
HTML;
    echo '<table width="100%">';
    foreach ($area_fields as $field) :
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr><td>';
        echo "<h4><label for=\"{$field['id']}\">{$field['name']}</label></h4>";
        wp_editor($meta, $field['id'], array(
            'textarea_name' => $field['id'],
            "textarea_rows" => $field['rows'],
        ));
        echo '<br /><span class="description">' . $field['desc'] . '</span>';
        echo '<td></tr>';

    endforeach;
    echo '</table>';
}
/**
 * Save data from product meta box
 * @global array $product_meta_box
 * @global array $area_fields
 * @param Object $post_id
 * @return 
 */
function product_save_data($post_id) {
    global $product_meta_box, $area_fields;
    custom_save_meta_box($product_meta_box, $post_id);
    
    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    foreach ($area_fields as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if (isset($_POST[$field['id']]) && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
    
    return $post_id;
}