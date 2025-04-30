<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();
        
        get_template_part('template-parts/content', 'single');
        
        // If comments are open or we have at least one comment, load up the comment template
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        
        // Previous/next post navigation
        the_post_navigation(array(
            'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__('Next', 'my-custom-theme') . '</span> ' .
                '<span class="screen-reader-text">' . esc_html__('Next post:', 'my-custom-theme') . '</span> ' .
                '<span class="post-title">%title</span>',
            'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__('Previous', 'my-custom-theme') . '</span> ' .
                '<span class="screen-reader-text">' . esc_html__('Previous post:', 'my-custom-theme') . '</span> ' .
                '<span class="post-title">%title</span>',
        ));
        
    endwhile; // End of the loop.
    ?>
</main><!-- #primary -->

<?php
get_sidebar();
get_footer();