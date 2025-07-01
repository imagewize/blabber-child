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
                'default' => '#f9f9f9',
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
                'default' => '#007cba',
                'selectors' => [
                    '{{WRAPPER}} .ad-toggle-checkbox:checked + .ad-toggle-label' => 'background-color: {{VALUE}} !important; color: white !important;',
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

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $button_text = !empty($settings['button_text']) ? $settings['button_text'] : 'Verberg gokreclames';
        $alignment = !empty($settings['alignment']) ? $settings['alignment'] : 'right';
        $widget_id = uniqid('toggle_ads_');
        ?>
        <div class="ad-toggle-elementor-widget" style="text-align: <?php echo esc_attr($alignment); ?>; margin-bottom: 15px;">
            <div class="ad-toggle-form-group" style="display: inline-block;">
                <input type="checkbox" class="ad-toggle-checkbox" name="toggle_ads" id="<?php echo esc_attr($widget_id); ?>" style="display: none;">
                <label class="ad-toggle-label" for="<?php echo esc_attr($widget_id); ?>" style="cursor: pointer; font-size: 14px; user-select: none; padding: 5px 10px; border: 1px solid #ddd; border-radius: 4px; background-color: #f9f9f9; transition: all 0.3s ease; display: inline-block;">
                    <?php echo esc_html($button_text); ?>
                </label>
            </div>
        </div>
        
        <style>
        .ad-toggle-label:hover {
            background-color: #e9e9e9 !important;
            border-color: #ccc !important;
        }
        
        .ad-toggle-checkbox:checked + .ad-toggle-label {
            background-color: #007cba !important;
            color: white !important;
            border-color: #007cba !important;
        }
        
        @media (max-width: 768px) {
            .ad-toggle-elementor-widget {
                text-align: center !important;
                margin-bottom: 20px !important;
            }
            
            .ad-toggle-label {
                font-size: 13px !important;
                padding: 8px 12px !important;
            }
        }
        </style>
        
        <script>
        jQuery(document).ready(function($) {
            // Initialize toggle functionality for Elementor widget
            $('#<?php echo esc_js($widget_id); ?>').on('change', function() {
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
                    console.log('Hiding ads');
                }

                function displayCasinoHighlightBlocks() {
                    $('.code-block').removeClass('d-none');
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
                $('.code-block').addClass('d-none');
            }

            function displayCasinoHighlightBlocks() {
                $('.code-block').removeClass('d-none');
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
        <div class="ad-toggle-elementor-widget" style="text-align: {{{ alignment }}}; margin-bottom: 15px;">
            <div class="ad-toggle-form-group" style="display: inline-block;">
                <input type="checkbox" class="ad-toggle-checkbox" name="toggle_ads" id="{{{ widget_id }}}" style="display: none;">
                <label class="ad-toggle-label" for="{{{ widget_id }}}" style="cursor: pointer; font-size: 14px; user-select: none; padding: 5px 10px; border: 1px solid #ddd; border-radius: 4px; background-color: #f9f9f9; transition: all 0.3s ease; display: inline-block;">
                    {{{ button_text }}}
                </label>
            </div>
        </div>
        <?php
    }
}
