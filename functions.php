<?php
/**
 * Blabber Child Theme functions and definitions
 */

// Simplified and optimized style loading based on original theme approach
function blabber_child_enqueue_styles() {
    // Get parent theme version for cache busting
    $parent_theme = wp_get_theme(get_template());
    $parent_version = $parent_theme->get('Version');
    
    // Enqueue parent theme main stylesheet first (like original)
    wp_enqueue_style('blabber-parent-style', 
        get_template_directory_uri() . '/style.css', 
        array(), 
        $parent_version
    );

    // Enqueue child theme stylesheet with parent as dependency
    wp_enqueue_style('blabber-child-style',
        get_stylesheet_uri(),
        array('blabber-parent-style'), // Depend on parent style
        wp_get_theme()->get('Version')
    );

    // Enqueue custom JavaScript for toggle functionality
    wp_enqueue_script('blabber-child-ad-toggle', 
        get_stylesheet_directory_uri() . '/js/ad-toggle.js', 
        array('jquery'), 
        wp_get_theme()->get('Version'), 
        true
    );

    // Add utility CSS classes for theme functionality
    $inline_css = "
    .d-none {
        display: none !important;
    }
    .overflow-hidden {
        overflow: hidden;
    }";
    wp_add_inline_style('blabber-child-style', $inline_css);
}
add_action('wp_enqueue_scripts', 'blabber_child_enqueue_styles', 15); // Load after parent theme styles

// Let parent theme handle its own style loading (like original approach)
// Only add essential customizer CSS if needed
function blabber_child_add_customizer_css() {
    // Only add customizer CSS if parent theme functions are available
    if (function_exists('blabber_customizer_get_css')) {
        $custom_css = blabber_customizer_get_css();
        
        // Add the dynamic CSS as inline styles only if not empty
        if (!empty($custom_css)) {
            wp_add_inline_style('blabber-child-style', $custom_css);
        }
    }
}
add_action('wp_enqueue_scripts', 'blabber_child_add_customizer_css', 20);

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
