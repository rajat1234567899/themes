<?php
/**
 * The template for displaying all pages
 * 
 * @package your-theme-name
 */

get_header(); ?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) : the_post();
        
        // Essential for Elementor:
        if (class_exists('Elementor\Plugin') && \Elementor\Plugin::$instance->db->is_built_with_elementor(get_the_ID())) {
            // Elementor content
            the_content();
        } else {
            // Regular WordPress content
            get_template_part('template-parts/content', 'page');
            
            // If comments are open or we have at least one comment
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
        }
        
    endwhile; // End of the loop.
    ?>
</main><!-- #primary -->

<?php
get_sidebar(); // Remove if you don't need sidebar
get_footer();