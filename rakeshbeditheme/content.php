<?php
/**
 * The default template for displaying content
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title">', '</h1>');
        else :
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;
        
        if ('post' === get_post_type()) :
            ?>
            <div class="entry-meta">
                <?php
                my_custom_theme_posted_on();
                my_custom_theme_posted_by();
                ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->
    
    <?php my_custom_theme_post_thumbnail(); ?>
    
    <div class="entry-content">
        <?php
        if (is_singular()) {
            the_content(sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'my-custom-theme'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ));
            
            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'my-custom-theme'),
                'after'  => '</div>',
            ));
        } else {
            the_excerpt();
        }
        ?>
    </div><!-- .entry-content -->
    
    <footer class="entry-footer">
        <?php my_custom_theme_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->