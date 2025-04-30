<?php
/**
 * My Custom Theme functions and definitions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Theme setup
function my_custom_theme_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');
    
    // Let WordPress manage the document title
    add_theme_support('title-tag');
    
    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    
    // Register menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'my-custom-theme'),
        'footer' => esc_html__('Footer Menu', 'my-custom-theme'),
    ));
    
    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');
    
    // Add support for core custom logo
    add_theme_support('custom-logo', array(
        'height' => 100,
        'width' => 400,
        'flex-width' => true,
        'flex-height' => true,
    ));
    
    // Add support for WooCommerce if needed
    if (class_exists('WooCommerce')) {
        add_theme_support('woocommerce');
    }
    
    // Add support for Elementor
    add_theme_support('elementor');
}
add_action('after_setup_theme', 'my_custom_theme_setup');

// Enqueue scripts and styles
function my_custom_theme_scripts() {
    // Main stylesheet
    wp_enqueue_style('my-custom-theme-style', get_stylesheet_uri());
    
    // Main JavaScript file
    wp_enqueue_script('my-custom-theme-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0', true);
    
    // Comments reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'my_custom_theme_scripts');

// Register widget areas
function my_custom_theme_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'my-custom-theme'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'my-custom-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Footer Widget Area 1', 'my-custom-theme'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here to appear in your footer.', 'my-custom-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    // Add more widget areas as needed
}
add_action('widgets_init', 'my_custom_theme_widgets_init');

// Elementor compatibility
function my_custom_theme_add_elementor_support() {
    // Add support for Elementor headers and footers
    add_theme_support('elementor-templates');
    
    // Add support for Elementor page settings
    add_theme_support('elementor-page-settings');
}
add_action('elementor/init', 'my_custom_theme_add_elementor_support');

// Add theme settings page
require get_template_directory() . '/inc/theme-settings.php';

// Custom template tags
require get_template_directory() . '/inc/template-tags.php';

// Custom functions that act independently of the theme templates
require get_template_directory() . '/inc/extras.php';

// Customizer additions
require get_template_directory() . '/inc/customizer.php';