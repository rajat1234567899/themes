<?php
/**
 * Theme Customizer functionality
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function rakeshbeditheme_customize_register($wp_customize) {
    // Add your customizer settings here
    
    // Example: Add a section
    $wp_customize->add_section('rakeshbeditheme_options', array(
        'title'    => __('Theme Options', 'rakeshbeditheme'),
        'priority' => 120,
    ));
    
    // Example: Add a setting
    $wp_customize->add_setting('primary_color', array(
        'default'   => '#0274be',
        'transport' => 'refresh',
    ));
    
    // Example: Add a control
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'primary_color',
        array(
            'label'    => __('Primary Color', 'rakeshbeditheme'),
            'section'  => 'rakeshbeditheme_options',
            'settings' => 'primary_color',
        )
    ));
}
add_action('customize_register', 'rakeshbeditheme_customize_register');

// Output customizer CSS
function rakeshbeditheme_customizer_css() {
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo get_theme_mod('primary_color', '#0274be'); ?>;
        }
        a, .site-title a {
            color: <?php echo get_theme_mod('primary_color', '#0274be'); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'rakeshbeditheme_customizer_css');