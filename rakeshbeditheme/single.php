<?php
get_header(); ?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) : the_post();
        
        if (class_exists('Elementor\Plugin') && \Elementor\Plugin::$instance->db->is_built_with_elementor(get_the_ID())) {
            the_content();
        } else {
            get_template_part('template-parts/content', 'single');
            
            // Post navigation
            the_post_navigation(array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'your-theme') . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'your-theme') . '</span> <span class="nav-title">%title</span>',
            ));
            
            // Comments
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
        }
        
    endwhile;
    ?>
</main>

<?php
get_footer();