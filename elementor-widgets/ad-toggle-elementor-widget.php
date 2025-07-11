<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Ad_Toggle_Elementor_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ad_toggle';
    }

    public function get_title() {
        return __('Ad Toggle', 'blabber-child');
    }

    public function get_icon() {
        return 'eicon-toggle';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_keywords() {
        return ['toggle', 'ads', 'hide', 'show', 'gambling'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'blabber-child'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'blabber-child'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Verberg gokreclames', 'blabber-child'),
                'placeholder' => __('Enter button text', 'blabber-child'),
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label' => __('Alignment', 'blabber-child'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'blabber-child'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'blabber-child'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'blabber-child'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'right',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .ad-toggle-elementor-widget' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'blabber-child'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __('Text Color', 'blabber-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666',
                'selectors' => [
                    '{{WRAPPER}} .ad-toggle-label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __('Background Color', 'blabber-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .ad-toggle-label' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_active_bg_color',
            [
                'label' => __('Active Background Color', 'blabber-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .ad-toggle-checkbox:checked + .ad-toggle-label' => 'background-color: {{VALUE}} !important; color: inherit !important;',
                ],
            ]
        );

        $this->add_control(
            'button_padding',
            [
                'label' => __('Padding', 'blabber-child'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => 5,
                    'right' => 10,
                    'bottom' => 5,
                    'left' => 10,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ad-toggle-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'blabber-child'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 4,
                    'right' => 4,
                    'bottom' => 4,
                    'left' => 4,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ad-toggle-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_bg_color',
            [
                'label' => __('Toggle Background Color', 'blabber-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ad-toggle-label:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'toggle_circle_color',
            [
                'label' => __('Toggle Circle Color', 'blabber-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#747474',
                'selectors' => [
                    '{{WRAPPER}} .ad-toggle-label:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'toggle_size',
            [
                'label' => __('Toggle Size', 'blabber-child'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 60,
                        'step' => 2,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 36,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ad-toggle-label:before' => 'width: {{SIZE}}{{UNIT}}; height: calc({{SIZE}}{{UNIT}} * 0.55);',
                    '{{WRAPPER}} .ad-toggle-label:after' => 'width: calc({{SIZE}}{{UNIT}} * 0.44); height: calc({{SIZE}}{{UNIT}} * 0.44);',
                ],
            ]
        );

        $this->end_controls_section();

        // Widget Container Spacing Section
        $this->start_controls_section(
            'container_spacing_section',
            [
                'label' => __('Container Spacing', 'blabber-child'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'container_margin',
            [
                'label' => __('Margin', 'blabber-child'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => __('Padding', 'blabber-child'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $button_text = !empty($settings['button_text']) ? $settings['button_text'] : 'Verberg gokreclames';
        $alignment = !empty($settings['alignment']) ? $settings['alignment'] : 'right';
        $widget_id = uniqid('toggle_ads_');
        ?>
        <div class="ad-toggle-elementor-widget">
            <div class="ad-toggle-form-group">
                <input type="checkbox" class="ad-toggle-checkbox" name="toggle_ads" id="<?php echo esc_attr($widget_id); ?>" style="display: none;">
                <label class="ad-toggle-label" for="<?php echo esc_attr($widget_id); ?>" style="cursor: pointer; font-size: 14px; user-select: none; display: inline-flex; align-items: center; gap: 10px; position: relative;">
                    <?php echo esc_html($button_text); ?>
                </label>
            </div>
        </div>
        
        <style>
        /* Toggle slider styles for Elementor widget - specific to this widget instance */
        #<?php echo esc_attr($widget_id); ?> + .ad-toggle-label {
            color: white !important; /* Make text white */
        }
        
        #<?php echo esc_attr($widget_id); ?> + .ad-toggle-label:before {
            content: '';
            display: inline-block;
            width: 36px;
            height: 20px;
            background-color: #ffffff;
            border-radius: 50px;
            position: relative;
            transition: all 0.3s ease;
            order: -1; /* Place toggle before text */
        }
        
        #<?php echo esc_attr($widget_id); ?> + .ad-toggle-label:after {
            content: '';
            position: absolute;
            top: 60%;
            left: 10px;
            width: 16px;
            height: 16px;
            background-color: #747474;
            border-radius: 50px;
            transition: all ease-in 0.2s;
            transform: translateY(-50%);
            z-index: 2; /* Ensure circle is above the pill background */
        }
        
        #<?php echo esc_attr($widget_id); ?>:checked + .ad-toggle-label:before {
            background-color: #ffffff !important;
        }
        
        #<?php echo esc_attr($widget_id); ?>:checked + .ad-toggle-label:after {
            transform: translateY(-50%) translateX(16px) !important;
            background-color: #747474 !important;
        }
        
        /* Override any background color changes on the label itself */
        #<?php echo esc_attr($widget_id); ?>:checked + .ad-toggle-label {
            background-color: transparent !important;
            color: white !important;
        }
        
        @media (max-width: 768px) {
            #<?php echo esc_attr($widget_id); ?> + .ad-toggle-label {
                font-size: 13px !important;
                color: white !important;
            }
        }
        </style>
        
        <script>
        jQuery(document).ready(function($) {
            // Initialize toggle functionality for Elementor widget
            $('#<?php echo esc_js($widget_id); ?>').on('change', function(e) {
                // Prevent any default scrolling behavior
                e.preventDefault();
                
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

                // Ad visibility functions with scroll prevention
                function hideCasinoHighlightBlocks() {
                    var currentScrollPosition = $(window).scrollTop();
                    $('.code-block').addClass('d-none');
                    // Restore scroll position to prevent jumping
                    $(window).scrollTop(currentScrollPosition);
                    console.log('Hiding ads');
                }

                function displayCasinoHighlightBlocks() {
                    var currentScrollPosition = $(window).scrollTop();
                    $('.code-block').removeClass('d-none');
                    // Restore scroll position to prevent jumping
                    $(window).scrollTop(currentScrollPosition);
                    console.log('Showing ads');
                }
                
                if ($(this).is(':checked')) {
                    setCookie('canSeeAds', 'false', 365);
                    hideCasinoHighlightBlocks();
                } else {
                    setCookie('canSeeAds', 'true', 365);
                    displayCasinoHighlightBlocks();
                }
            });
            
            // Initialize state based on cookie
            function getCookie(name) {
                var match = document.cookie.match(new RegExp('(^|;\\s*)(' + name + ')=([^;]*)'));
                return match ? match[3] : null;
            }
            
            function hideCasinoHighlightBlocks() {
                var currentScrollPosition = $(window).scrollTop();
                $('.code-block').addClass('d-none');
                $(window).scrollTop(currentScrollPosition);
            }

            function displayCasinoHighlightBlocks() {
                var currentScrollPosition = $(window).scrollTop();
                $('.code-block').removeClass('d-none');
                $(window).scrollTop(currentScrollPosition);
            }
            
            var cookieValue = getCookie('canSeeAds');
            if (cookieValue === 'true') {
                displayCasinoHighlightBlocks();
                $('#<?php echo esc_js($widget_id); ?>').prop('checked', false);
            } else {
                hideCasinoHighlightBlocks();
                $('#<?php echo esc_js($widget_id); ?>').prop('checked', true);
            }
        });
        </script>
        <?php
    }

    protected function content_template() {
        ?>
        <#
        var button_text = settings.button_text || 'Verberg gokreclames';
        var alignment = settings.alignment || 'right';
        var widget_id = 'toggle_ads_' + Math.random().toString(36).substr(2, 9);
        #>
        <div class="ad-toggle-elementor-widget">
            <div class="ad-toggle-form-group">
                <input type="checkbox" class="ad-toggle-checkbox" name="toggle_ads" id="{{{ widget_id }}}" style="display: none;">
                <label class="ad-toggle-label" for="{{{ widget_id }}}" style="cursor: pointer; font-size: 14px; user-select: none; display: inline-flex; align-items: center; gap: 10px; position: relative;">
                    {{{ button_text }}}
                </label>
            </div>
        </div>
        
        <style>
        /* Editor preview styles for toggle */
        #{{{ widget_id }}} + .ad-toggle-label {
            color: white !important;
        }
        
        #{{{ widget_id }}} + .ad-toggle-label:before {
            content: '';
            display: inline-block;
            width: 36px;
            height: 20px;
            background-color: #ffffff;
            border-radius: 50px;
            position: relative;
            transition: all 0.3s ease;
            order: -1;
        }
        
        #{{{ widget_id }}} + .ad-toggle-label:after {
            content: '';
            position: absolute;
            top: 60%;
            left: 10px;
            width: 16px;
            height: 16px;
            background-color: #747474;
            border-radius: 50px;
            transition: all ease-in 0.2s;
            transform: translateY(-50%);
            z-index: 2;
        }
        
        #{{{ widget_id }}}:checked + .ad-toggle-label:before {
            background-color: #ffffff !important;
        }
        
        #{{{ widget_id }}}:checked + .ad-toggle-label:after {
            transform: translateY(-50%) translateX(16px) !important;
            background-color: #747474 !important;
        }
        
        #{{{ widget_id }}}:checked + .ad-toggle-label {
            background-color: transparent !important;
            color: white !important;
        }
        </style>
        <?php
    }
}
