<?php
/**
 * Ad Toggle Widget
 * 
 * Widget for hiding/showing gambling ads
 */

class Ad_Toggle_Widget extends WP_Widget {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct(
            'ad_toggle_widget', // Base ID
            __('Ad Toggle', 'blabber-child'), // Name
            array(
                'description' => __('Toggle button to hide/show gambling ads', 'blabber-child'),
                'classname' => 'ad-toggle-widget'
            )
        );
    }

    /**
     * Front-end display of widget
     */
    public function widget($args, $instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $button_text = !empty($instance['button_text']) ? $instance['button_text'] : 'Verberg gokreclames';
        $alignment = !empty($instance['alignment']) ? $instance['alignment'] : 'right';
        
        echo $args['before_widget'];
        
        if (!empty($title)) {
            echo $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];
        }
        
        // Widget content
        ?>
        <div class="ad-toggle-widget-content" style="text-align: <?php echo esc_attr($alignment); ?>;">
            <div class="ad-toggle-container">
                <input type="checkbox" id="toggle_inputAds_widget" class="ad-toggle-input">
                <label for="toggle_inputAds_widget" class="ad-toggle-label">
                    <span class="ad-toggle-text"><?php echo esc_html($button_text); ?></span>
                    <div class="ad-toggle-switch">
                        <div class="ad-toggle-circle"></div>
                    </div>
                </label>
            </div>
        </div>
        
        <style>
        .ad-toggle-widget-content {
            margin: 0;
            padding: 0;
        }
        
        .ad-toggle-container {
            display: inline-block;
        }
        
        .ad-toggle-input {
            opacity: 0;
            width: 0;
            height: 0;
            position: absolute;
        }
        
        .ad-toggle-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 14px;
            color: inherit; /* Use parent color instead of fixed #666 */
            user-select: none;
        }
        
        .ad-toggle-switch {
            position: relative;
            width: 36px;
            height: 20px;
            background-color: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .ad-toggle-circle {
            position: absolute;
            top: 1px;
            left: 1px;
            width: 16px;
            height: 16px;
            background-color: #747474;
            border-radius: 50%;
            transition: transform 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .ad-toggle-input:checked + .ad-toggle-label .ad-toggle-switch {
            background-color: rgba(255, 255, 255, 0.4);
            border-color: rgba(255, 255, 255, 0.4);
        }
        
        .ad-toggle-input:checked + .ad-toggle-label .ad-toggle-circle {
            transform: translateX(16px);
            background-color: white;
        }
        
        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .ad-toggle-widget-content[style*="right"] {
                text-align: center !important;
            }
        }
        </style>
        
        <script>
        jQuery(document).ready(function($) {
            // Initialize widget toggle functionality
            var $widgetToggle = $('#toggle_inputAds_widget');
            
            if ($widgetToggle.length > 0) {
                // Cookie functions
                function setCookie(name, value, days) {
                    var expires = '';
                    if (days) {
                        var date = new Date();
                        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
                        expires = '; expires=' + date.toUTCString();
                    }
                    document.cookie = name + '=' + (value || '') + expires + '; path=/';
                }

                function getCookie(name) {
                    var match = document.cookie.match(new RegExp('(^|;\\s*)(' + name + ')=([^;]*)'));
                    return match ? match[3] : null;
                }

                // Ad visibility functions
                function hideCasinoHighlightBlocks() {
                    $('.code-block').addClass('d-none');
                }

                function displayCasinoHighlightBlocks() {
                    $('.code-block').removeClass('d-none');
                }
                
                // Toggle functionality
                $widgetToggle.on('change', function(e) {
                    // Prevent scroll jump
                    e.preventDefault();
                    var currentScrollTop = $(window).scrollTop();
                    
                    if (this.checked) {
                        setCookie('canSeeAds', 'false', 365);
                        hideCasinoHighlightBlocks();
                    } else {
                        setCookie('canSeeAds', 'true', 365);
                        displayCasinoHighlightBlocks();
                    }
                    
                    // Restore scroll position
                    setTimeout(function() {
                        $(window).scrollTop(currentScrollTop);
                    }, 10);
                });

                // Initialize state based on cookie
                var cookieValue = getCookie('canSeeAds');
                if (cookieValue === 'true') {
                    displayCasinoHighlightBlocks();
                    $widgetToggle.prop('checked', false);
                } else {
                    hideCasinoHighlightBlocks();
                    $widgetToggle.prop('checked', true);
                }
            }
        });
        </script>
        <?php
        
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $button_text = !empty($instance['button_text']) ? $instance['button_text'] : 'Verberg gokreclames';
        $alignment = !empty($instance['alignment']) ? $instance['alignment'] : 'right';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'blabber-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('button_text')); ?>"><?php _e('Button Text:', 'blabber-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('button_text')); ?>" name="<?php echo esc_attr($this->get_field_name('button_text')); ?>" type="text" value="<?php echo esc_attr($button_text); ?>">
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('alignment')); ?>"><?php _e('Alignment:', 'blabber-child'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('alignment')); ?>" name="<?php echo esc_attr($this->get_field_name('alignment')); ?>">
                <option value="left" <?php selected($alignment, 'left'); ?>><?php _e('Left', 'blabber-child'); ?></option>
                <option value="center" <?php selected($alignment, 'center'); ?>><?php _e('Center', 'blabber-child'); ?></option>
                <option value="right" <?php selected($alignment, 'right'); ?>><?php _e('Right', 'blabber-child'); ?></option>
            </select>
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['button_text'] = (!empty($new_instance['button_text'])) ? sanitize_text_field($new_instance['button_text']) : 'Verberg gokreclames';
        $instance['alignment'] = (!empty($new_instance['alignment'])) ? sanitize_text_field($new_instance['alignment']) : 'right';

        return $instance;
    }
}
