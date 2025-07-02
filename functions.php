<?php
/**
 * Blabber Child Theme functions and definitions
 */

// Let parent theme handle all its own style loading (including skin styles)
// Then add child theme styles afterward
function blabber_child_enqueue_styles() {
    // Don't manually enqueue parent styles - let the parent theme do it
    
    // Enqueue child theme stylesheet AFTER all parent theme styles
    wp_enqueue_style('blabber-child-style',
        get_stylesheet_uri(),
        array(), // Remove dependency to let it load after parent theme styles
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
// Load at priority 20 to ensure it runs AFTER parent theme's style loading
add_action('wp_enqueue_scripts', 'blabber_child_enqueue_styles', 20);

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
add_action('wp_enqueue_scripts', 'blabber_child_add_customizer_css', 25);

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

// Include and register Ad Toggle Widget
require_once get_stylesheet_directory() . '/widgets/class-ad-toggle-widget.php';

function blabber_child_register_ad_toggle_widget() {
    register_widget('Ad_Toggle_Widget');
}
add_action('widgets_init', 'blabber_child_register_ad_toggle_widget');

// Register Elementor Ad Toggle Widget
function blabber_child_register_elementor_widgets($widgets_manager) {
    // Check if Elementor is active
    if (!class_exists('\Elementor\Widget_Base')) {
        return;
    }

    // Include the widget file
    require_once get_stylesheet_directory() . '/elementor-widgets/ad-toggle-elementor-widget.php';

    // Register the widget
    $widgets_manager->register(new \Ad_Toggle_Elementor_Widget());
}
add_action('elementor/widgets/register', 'blabber_child_register_elementor_widgets');

// Register Elementor widget category (optional)
function blabber_child_add_elementor_widget_categories($elements_manager) {
    $elements_manager->add_category(
        'blabber-child',
        [
            'title' => __('Blabber Child', 'blabber-child'),
            'icon' => 'fa fa-plug',
        ]
    );
}
add_action('elementor/elements/categories_registered', 'blabber_child_add_elementor_widget_categories');
