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
            <div class="toggle-input-block">
                <div class="form-group">
                    <input type="checkbox" class="d-none" name="" id="toggle_inputAds_widget">
                    <label id="labelToggleWidget" for="toggle_inputAds_widget"><?php echo esc_html($button_text); ?></label>
                </div>
            </div>
        </div>
        
        <style>
        .ad-toggle-widget-content .toggle-input-block {
            margin-bottom: 0;
        }
        
        .ad-toggle-widget-content .toggle-input-block .form-group {
            display: inline-block;
        }
        
        .ad-toggle-widget-content .toggle-input-block label {
            cursor: pointer;
            font-size: 14px;
            color: #666;
            user-select: none;
            padding: 5px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .ad-toggle-widget-content .toggle-input-block label:hover {
            background-color: #e9e9e9;
            border-color: #ccc;
        }
        
        .ad-toggle-widget-content .toggle-input-block input[type="checkbox"]:checked + label {
            background-color: #007cba;
            color: white;
            border-color: #007cba;
        }
        
        .ad-toggle-widget-content .toggle-input-block input[type=checkbox] {
            opacity: 0;
            width: 0;
            height: 0;
            margin: 0;
            padding: 0;
        }
        
        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .ad-toggle-widget-content[style*="right"] {
                text-align: center !important;
            }
            
            .ad-toggle-widget-content .toggle-input-block label {
                font-size: 13px;
                padding: 8px 12px;
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
                $widgetToggle.on('change', function() {
                    if (this.checked) {
                        setCookie('canSeeAds', 'false', 365);
                        hideCasinoHighlightBlocks();
                    } else {
                        setCookie('canSeeAds', 'true', 365);
                        displayCasinoHighlightBlocks();
                    }
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
