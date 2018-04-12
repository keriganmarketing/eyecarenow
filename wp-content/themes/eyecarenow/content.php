<?php
/**
 * @package EyeCareNow
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        <?php if ('post' == get_post_type()) : ?>
            <div class="entry-meta">
                <?php eyecarenow_posted_on(); ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        /* translators: %s: Name of current post */
        the_content(sprintf(
            __('Continue reading %s <span class="meta-nav">&rarr;</span>', 'eyecarenow'),
            the_title('<span class="screen-reader-text">"', '"</span>', false)
        ));
        ?>

        <?php
        /*wp_link_pages( array(
            'before' => '<div class="page-links">' . __( 'Pages:', 'eyecarenow' ),
            'after'  => '</div>',
        ) );*/
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php eyecarenow_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->