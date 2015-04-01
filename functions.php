<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/SketchBoard/includes/css/sketch-board.css' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/SketchBoard/includes/css/colorpicker.css' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/SketchBoard/includes/css/upsell.css' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/SketchBoard/css/sketch-admin.css' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/css/ie-style.css' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/css/superfish.css' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/css/font-awesome.css' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/css/skt-animation.css' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/css/font-awesome-ie7.css' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/css/bootstrap-responsive.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

// [year]
function year_func() { return date('Y'); }
add_shortcode('year', 'year_func');
