<?php
/**
 * Blabber Child Theme functions and definitions
 */

// Enqueue parent and child theme styles
function blabber_child_enqueue_styles() {
    // Enqueue parent theme styles (if not already done by parent)
    wp_enqueue_style('blabber-style', get_template_directory_uri() . '/style.css');

    // Enqueue child theme stylesheet, dependent on parent
    wp_enqueue_style('blabber-child-style',
        get_stylesheet_uri(),
        array('blabber-style'),
        wp_get_theme()->get('Version')
    );

    // Enqueue the JavaScript for the toggle button
    wp_enqueue_script('blabber-child-ad-toggle', get_stylesheet_directory_uri() . '/js/ad-toggle.js', array('jquery'), '1.0', true);

    // Add inline CSS for utility classes
    $inline_css = "\n    .d-none {\n        display: none !important;\n    }\n    .overflow-hidden {\n        overflow: hidden;\n    }";
    wp_add_inline_style('blabber-child-style', $inline_css);
}
add_action('wp_enqueue_scripts', 'blabber_child_enqueue_styles', 1600); // Adjusted priority to ensure child styles load last

// Enqueue additional parent theme styles
function blabber_child_enqueue_parent_styles() {
    wp_enqueue_style('blabber-fontello-icons', get_template_directory_uri() . '/css/font-icons/css/fontello.css', array(), null);
    wp_enqueue_style('blabber-plugins', get_template_directory_uri() . '/css/__plugins.css', array(), null);
    wp_enqueue_style('blabber-custom', get_template_directory_uri() . '/css/__custom.css', array(), null);
    wp_enqueue_style('blabber-responsive', get_template_directory_uri() . '/css/__responsive.css', array(), null);
}
add_action('wp_enqueue_scripts', 'blabber_child_enqueue_parent_styles', 10);

// Debug inline styles added by the parent theme
function blabber_debug_inline_styles() {
    // Check if inline styles are being added by the parent theme
    $inline_styles = wp_styles()->get_data('blabber-inline-styles', 'after');
    if (!empty($inline_styles)) {
        error_log('Parent theme inline styles: ' . print_r($inline_styles, true));
    }
}
add_action('wp_enqueue_scripts', 'blabber_debug_inline_styles', 5);

// Register widgets area (sidebar)
function blabber_child_widgets_init() {
    // Register sidebar for the child theme
    register_sidebar(array(
        'name'          => __('Main Sidebar', 'blabber-child'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'blabber-child'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget_title">',
        'after_title'   => '</h5>',
    ));
}
add_action('widgets_init', 'blabber_child_widgets_init');
