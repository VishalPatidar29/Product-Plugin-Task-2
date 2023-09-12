<?php

defined( 'ABSPATH' ) || exit;

// Register custom post Product
function custom_product_post_type() {
    $labels = array(
        'name'               => 'Products',
        'singular_name'      => 'Product',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Product',
        'edit_item'          => 'Edit Product',
        'new_item'           => 'New Product',
        'view_item'          => 'View Product',
        'search_items'       => 'Search Products',
        'not_found'          => 'No products found',
        'not_found_in_trash' => 'No products found in Trash',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'query_var'           => true,
        'rewrite'             => array( 'slug' => 'product' ),
        'capability_type'     => 'post',
        'menu_icon'           => 'dashicons-cart',
        'supports'            => array( 'title', 'editor', 'thumbnail', ),
    );

    register_post_type( 'product', $args );


    register_taxonomy_for_object_type('category','product');

}


// Plugin activate create the Product Page if the page is already Exist not create the other one.
function create_product_page()
{
    $page_title = 'Product';
    $page_content = '[products_page]';
    $page_check = get_page_by_title($page_title);

    if (!$page_check) {
        $page = array(
            'post_type' => 'page',
            'post_title' => $page_title,
            'post_name' => 'product-item',
            'post_content' => $page_content,
            'post_status' => 'publish',
            'post_author' => 1,
        );

        wp_insert_post($page);
    }
}

?>