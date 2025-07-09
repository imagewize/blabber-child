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

// Fix parent theme's avatar function by overriding the filter with a safe version
function blabber_child_safe_avatar($avatar, $id_or_email, $size = 96, $default = '', $alt = '') {
    // Get user ID from various input types
    if (is_numeric($id_or_email)) {
        $user_id = (int) $id_or_email;
    } elseif (is_string($id_or_email) && is_email($id_or_email)) {
        $user = get_user_by('email', $id_or_email);
        $user_id = $user ? $user->ID : 0;
    } elseif (is_object($id_or_email) && !empty($id_or_email->user_id)) {
        $user_id = (int) $id_or_email->user_id;
    } else {
        return $avatar; // Return original avatar if we can't determine user ID
    }

    if ($user_id && function_exists('get_field')) {
        $custom_avatar = get_field('avatar', 'user_' . $user_id);
        
        if ($custom_avatar && is_array($custom_avatar)) {
            $avatar_url = isset($custom_avatar['url']) ? $custom_avatar['url'] : '';
            $avatar_alt = isset($custom_avatar['alt']) ? $custom_avatar['alt'] : $alt;
            
            if ($avatar_url) {
                return '<img alt="' . esc_attr($avatar_alt) . '" src="' . esc_url($avatar_url) . '" class="avatar avatar-' . esc_attr($size) . ' photo" height="' . esc_attr($size) . '" width="' . esc_attr($size) . '" />';
            }
        } elseif ($custom_avatar && is_string($custom_avatar)) {
            // Handle case where custom_avatar is a URL string
            return '<img alt="' . esc_attr($alt) . '" src="' . esc_url($custom_avatar) . '" class="avatar avatar-' . esc_attr($size) . ' photo" height="' . esc_attr($size) . '" width="' . esc_attr($size) . '" />';
        }
    }
    
    return $avatar; // Return original avatar if no custom avatar found
}

// Override the parent theme's problematic avatar function
function blabber_child_override_avatar_function() {
    // Remove the parent theme's filter that causes the error
    remove_filter('get_avatar', 'custom_author_acf_avatar', 10, 5);
    // Add our safe version instead
    add_filter('get_avatar', 'blabber_child_safe_avatar', 10, 5);
}
add_action('init', 'blabber_child_override_avatar_function', 1);

/**
 * Prevent Blabber theme from resizing banner container iframes - IMPROVED VERSION
 * Uses the theme's built-in exclusion system and CSS priority enforcement
 * This approach is more reliable than the timeout-based JavaScript solution
 */
function blabber_child_prevent_banner_iframe_resizing() {
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        // Mark banner iframes to be excluded from theme resizing using the theme's built-in exclusion classes
        // The Blabber theme checks for these classes in its blabber_resize_video() function
        $('.iwz-footer-banner iframe, .iwz-head-banner iframe, .iwz-content-banner iframe, .iwz-sidebar-banner iframe, .iwz-menu-banner iframe, .iwz-blabber-footer-banner iframe, .iwz-blabber-header-banner iframe')
            .addClass('blabber_noresize trx_addons_noresize');
        
        // Preserve original dimensions for banner iframes by setting them with !important priority
        // This ensures they override any inline styles set by the theme's JavaScript
        $('.iwz-footer-banner iframe, .iwz-head-banner iframe, .iwz-content-banner iframe, .iwz-sidebar-banner iframe, .iwz-menu-banner iframe, .iwz-blabber-footer-banner iframe, .iwz-blabber-header-banner iframe').each(function() {
            var $iframe = $(this);
            var originalWidth = $iframe.attr('width');
            var originalHeight = $iframe.attr('height');
            
            // Only proceed if both width and height attributes exist
            if (originalWidth && originalHeight) {
                // Store original dimensions as data attributes for reference
                $iframe.data('original-width', originalWidth);
                $iframe.data('original-height', originalHeight);
                
                // Set dimensions as inline styles with !important flag to override theme's JavaScript
                // Using setProperty with 'important' flag ensures highest CSS priority
                this.style.setProperty('width', originalWidth + 'px', 'important');
                this.style.setProperty('height', originalHeight + 'px', 'important');
                
                // Set margin and padding - use auto margins for centering blabber footer banners
                if ($iframe.closest('.iwz-blabber-footer-banner').length > 0) {
                    this.style.setProperty('margin', '0 auto', 'important');
                } else {
                    this.style.setProperty('margin', '0', 'important');
                }
                this.style.setProperty('padding', '0', 'important');
                this.style.setProperty('display', 'block', 'important');
                this.style.setProperty('vertical-align', 'top', 'important');
            }
        });
    });
    </script>
    <?php
}
// Use early priority (1) to ensure this runs before the theme's resize function
add_action('wp_footer', 'blabber_child_prevent_banner_iframe_resizing', 1);
