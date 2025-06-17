<?php
/**
 * Blabber Child Theme functions and definitions
 */

// Enqueue parent and child theme styles
function blabber_child_enqueue_styles() {
    wp_enqueue_style('blabber-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('blabber-child-style', get_stylesheet_directory_uri() . '/style.css', array('blabber-style'));
    
    // Enqueue the JavaScript for the toggle button
    wp_enqueue_script('blabber-child-ad-toggle', get_stylesheet_directory_uri() . '/js/ad-toggle.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'blabber_child_enqueue_styles');
