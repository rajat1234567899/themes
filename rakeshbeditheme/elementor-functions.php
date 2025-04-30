<?php
/**
 * Elementor compatibility functions
 */

// Check if Elementor is installed and activated
if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

if (is_plugin_active('elementor/elementor.php')) {
    // Register Elementor locations
    function my_custom_theme_register_elementor_locations($elementor_theme_manager) {
        $elementor_theme_manager->register_location('header');
        $elementor_theme_manager->register_location('footer');
        $elementor_theme_manager->register_location('single');
        $elementor_theme_manager->register_location('archive');
    }
    add_action('elementor/theme/register_locations', 'my_custom_theme_register_elementor_locations');
    
    // Add support for Elementor Pro features
    function my_custom_theme_elementor_pro_support() {
        if (is_plugin_active('elementor-pro/elementor-pro.php')) {
            // Add support for Elementor Pro theme builder
            add_theme_support('elementor-pro-theme-builder');
            
            // Add support for Elementor Pro custom headers and footers
            add_theme_support('elementor-pro-headers-footers');
        }
    }
    add_action('after_setup_theme', 'my_custom_theme_elementor_pro_support');
    
    // Disable default colors and fonts if Elementor is active
    function my_custom_theme_disable_default_colors_fonts() {
        // Disable default colors
        add_filter('elementor/schemes/enabled_schemes', function($schemes) {
            unset($schemes['color']);
            return $schemes;
        });
        
        // Disable default typography
        add_filter('elementor/schemes/enabled_schemes', function($schemes) {
            unset($schemes['typography']);
            return $schemes;
        });
    }
    add_action('init', 'my_custom_theme_disable_default_colors_fonts');
    
    // Add theme settings for Elementor
    function my_custom_theme_elementor_settings($settings) {
        // Container width
        $settings['container_width']['unit'] = 'px';
        $settings['container_width']['size'] = 1200;
        
        // Space between widgets
        $settings['space_between_widgets']['unit'] = 'px';
        $settings['space_between_widgets']['size'] = 20;
        
        // Default generic fonts
        $settings['default_generic_fonts'] = 'Sans-serif';
        
        return $settings;
    }
    add_filter('elementor/editor/localize_settings', 'my_custom_theme_elementor_settings');
}