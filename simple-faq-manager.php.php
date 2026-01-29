<?php
/**
 * Plugin Name: Simple FAQ Manager
 * Description: A beginner WordPress plugin to manage FAQs.
 * Version: 1.0
 * Author: Divya Dhiman
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


function sfm_register_faq_post_type() {

    $args = array(
        'label' => 'FAQs',
        'public' => true,
        'menu_icon' => 'dashicons-editor-help',
        'supports' => array( 'title', 'editor' ),
        'show_in_rest' => true,
    );

    register_post_type( 'sfm_faq', $args );
}

add_action( 'init', 'sfm_register_faq_post_type' );


function sfm_faq_shortcode() {

    $args = array(
        'post_type' => 'sfm_faq',
        'posts_per_page' => -1,
    );

    $query = new WP_Query( $args );

    $output = '<div class="sfm-faq-wrapper">';

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();

            $output .= '<h3>' . get_the_title() . '</h3>';
            $output .= '<p>' . get_the_content() . '</p>';
        }
    }

    wp_reset_postdata();

    $output .= '</div>';

    return $output;
}

add_shortcode( 'simple_faq', 'sfm_faq_shortcode' );


