<?php
/**
 * Elementor hooks for theme customization
 */

// Add theme support for Elementor
add_theme_support('elementor');

// Enable full-width templates in Elementor
function my_custom_theme_elementor_page_templates($page_templates) {
    $page_templates['elementor_header_footer'] = __('Elementor Full Width', 'my-custom-theme');
    $page_templates['elementor_canvas'] = __('Elementor Canvas', 'my-custom-theme');
    return $page_templates;
}
add_filter('theme_page_templates', 'my_custom_theme_elementor_page_templates');

// Add theme colors to Elementor
function my_custom_theme_add_elementor_colors() {
    $primary_color = get_theme_mod('primary_color', '#0274be');
    $secondary_color = get_theme_mod('secondary_color', '#f7c331');
    $text_color = get_theme_mod('text_color', '#333333');
    $accent_color = get_theme_mod('accent_color', '#e74c3c');
    
    return [
        'primary' => $primary_color,
        'secondary' => $secondary_color,
        'text' => $text_color,
        'accent' => $accent_color,
    ];
}
add_filter('elementor/editor/localize_settings', function($config) {
    $config['schemes']['items']['color']['items'] = [
        '1' => __('Primary', 'my-custom-theme'),
        '2' => __('Secondary', 'my-custom-theme'),
        '3' => __('Text', 'my-custom-theme'),
        '4' => __('Accent', 'my-custom-theme'),
    ];
    
    $config['default_schemes']['color']['items'] = [
        '1' => '#0274be',
        '2' => '#f7c331',
        '3' => '#333333',
        '4' => '#e74c3c',
    ];
    
    return $config;
});

// Add theme fonts to Elementor
function my_custom_theme_add_elementor_fonts($fonts) {
    $theme_fonts = [
        'primary' => [
            'font_family' => 'Roboto',
            'font_weight' => '400',
        ],
        'secondary' => [
            'font_family' => 'Montserrat',
            'font_weight' => '700',
        ],
        'text' => [
            'font_family' => 'Open Sans',
            'font_weight' => '400',
        ],
        'accent' => [
            'font_family' => 'Open Sans',
            'font_weight' => '600',
        ],
    ];
    
    return array_merge($fonts, $theme_fonts);
}
add_filter('elementor/fonts/additional_fonts', 'my_custom_theme_add_elementor_fonts');