<?php

//woocommerce theme support
add_theme_support('woocommerce');

// Add custom column header
function eventmanage_product_column_header( $columns ) {
    // Add a new column with the key 'custom_column'
    $columns['eventmanage_column'] = 'Type';
    return $columns;
}
add_filter( 'manage_edit-product_columns', 'eventmanage_product_column_header' );

// Add content to the custom column
function eventmanage_product_column_content( $column, $post_id ) {
    global $post;

    switch($column) {
        case 'eventmanage_column':
            $type = get_field('type', $post_id);
            if(!empty($type)) {
                echo ucfirst($type) ;
            } else {
                echo '-';
            }
            break;
    }
}
add_action( 'manage_product_posts_custom_column', 'eventmanage_product_column_content', 10, 2 );

// Remove related products output
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// remove prodcuts tab in single page
add_filter( 'woocommerce_product_tabs', 'remove_product_tabs', 98 );

function remove_product_tabs( $tabs ) {
    unset($tabs['description']);
    unset($tabs['reviews']);
    unset($tabs['additional_information']);

    return $tabs;
}

// remove breadcrumb

add_action('init', 'event_woo_breadcrumb_remove');

function event_woo_breadcrumb_remove() {
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 ,0);
}

//woocommerce single page wrapper start
add_action( 'woocommerce_before_main_content', 'eventmanage_wrapper_start', 5 );
function eventmanage_wrapper_start() {
    // Your code here
    echo '<div class="overflow-hidden w-2/3 my-20 mx-auto">';
}

//woocommerce single page wrapper end
add_action( 'woocommerce_after_main_content', 'eventmanage_wrapper_end', 5 );
function eventmanage_wrapper_end() {
    echo '</div>';
}