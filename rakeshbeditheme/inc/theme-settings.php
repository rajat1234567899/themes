<?php
/**
 * Theme settings page
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Add theme options page
function my_custom_theme_options_page() {
    add_theme_page(
        __('Theme Settings', 'my-custom-theme'),
        __('Theme Settings', 'my-custom-theme'),
        'manage_options',
        'my-custom-theme-settings',
        'my_custom_theme_settings_page'
    );
}
add_action('admin_menu', 'my_custom_theme_options_page');

// Register settings
function my_custom_theme_register_settings() {
    register_setting('my_custom_theme_options', 'my_custom_theme_options');
    
    // General section
    add_settings_section(
        'general',
        __('General Settings', 'my-custom-theme'),
        'my_custom_theme_section_general',
        'my-custom-theme-settings'
    );
    
    // Color section
    add_settings_section(
        'colors',
        __('Color Settings', 'my-custom-theme'),
        'my_custom_theme_section_colors',
        'my-custom-theme-settings'
    );
    
    // Add fields to sections
    add_settings_field(
        'logo',
        __('Custom Logo', 'my-custom-theme'),
        'my_custom_theme_field_logo',
        'my-custom-theme-settings',
        'general'
    );
    
    add_settings_field(
        'primary_color',
        __('Primary Color', 'my-custom-theme'),
        'my_custom_theme_field_primary_color',
        'my-custom-theme-settings',
        'colors'
    );
    
    add_settings_field(
        'secondary_color',
        __('Secondary Color', 'my-custom-theme'),
        'my_custom_theme_field_secondary_color',
        'my-custom-theme-settings',
        'colors'
    );
}
add_action('admin_init', 'my_custom_theme_register_settings');

// Section callbacks
function my_custom_theme_section_general() {
    echo '<p>' . __('General theme settings.', 'my-custom-theme') . '</p>';
}

function my_custom_theme_section_colors() {
    echo '<p>' . __('Customize the theme colors.', 'my-custom-theme') . '</p>';
}

// Field callbacks
function my_custom_theme_field_logo() {
    $options = get_option('my_custom_theme_options');
    ?>
    <input type="text" name="my_custom_theme_options[logo]" value="<?php echo esc_attr($options['logo']); ?>" class="regular-text" />
    <button class="button upload-logo"><?php _e('Upload Logo', 'my-custom-theme'); ?></button>
    <?php
}

function my_custom_theme_field_primary_color() {
    $options = get_option('my_custom_theme_options');
    ?>
    <input type="text" name="my_custom_theme_options[primary_color]" value="<?php echo esc_attr($options['primary_color']); ?>" class="color-picker" data-default-color="#0274be" />
    <?php
}

function my_custom_theme_field_secondary_color() {
    $options = get_option('my_custom_theme_options');
    ?>
    <input type="text" name="my_custom_theme_options[secondary_color]" value="<?php echo esc_attr($options['secondary_color']); ?>" class="color-picker" data-default-color="#f7c331" />
    <?php
}

// Settings page
function my_custom_theme_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Theme Settings', 'my-custom-theme'); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('my_custom_theme_options');
            do_settings_sections('my-custom-theme-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Enqueue admin scripts
function my_custom_theme_admin_scripts($hook) {
    if ('appearance_page_my-custom-theme-settings' !== $hook) {
        return;
    }
    
    wp_enqueue_media();
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('my-custom-theme-admin', get_template_directory_uri() . '/js/admin.js', array('jquery', 'wp-color-picker'), '1.0', true);
}
add_action('admin_enqueue_scripts', 'my_custom_theme_admin_scripts');