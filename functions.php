<?php

function my_theme_setup(){
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'my_theme_setup');

// Enqueue Scripts
function enqueue_theme_scripts() {
    // Enqueue Slick CSS and JS
    wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
    wp_enqueue_style('slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css');
    wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true);

    // Enqueue custom script
    wp_enqueue_script('ajax-filter', get_template_directory_uri() . '/js/custom.js', array('jquery', 'slick-js'), null, true);

    // Pass AJAX URL to JS
    wp_localize_script('ajax-filter', 'ajax_data', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_theme_scripts');


function custom_theme_setup() {
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'your-theme-textdomain' ),
    ) );
}
add_action( 'after_setup_theme', 'custom_theme_setup' );

function custom_theme_scripts() {
    wp_enqueue_style( 'main-style', get_stylesheet_uri(), array(), filemtime( get_template_directory() . '/style.css' ) );
}

add_action( 'wp_enqueue_scripts', 'custom_theme_scripts' );



/**
 * Custom ACF Block Init.
 */
require get_template_directory() . '/inc/block-init.php';

/**
 * Custom shortcode.
 */
require get_template_directory() . '/inc/shortcode.php';

/**
 * Custom Ajax filter.
 */
require get_template_directory() . '/inc/ajax-filter.php';

/**
 * Custom post type and taxonomy.
 */
require get_template_directory() . '/inc/cpt.php';

/**
 * Custom svg+icon.
 */
require get_template_directory() . '/inc/icon.php';