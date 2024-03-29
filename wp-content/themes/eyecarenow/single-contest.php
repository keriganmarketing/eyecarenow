<?php
/**
 * The template for displaying all single contests.
 *
 * @package EyeCareNow
 */
$newsenabled    = get_field('show_news_feed');
$newscat        = 'news_category';
$sidebarbuttons = get_field('sidebar_buttons');
$header_photo   = get_field('header_photo');

get_header(); ?>
<div id="primary" class="support-area">
    <div id="mid">
        <div class="container">
            <?php if ($header_photo) { ?>
                <div id="featured-image" class="support">
                    <div class="flexslider">
                        <?php echo '<img src="' . $header_photo['url'] . '" alt="' . $header_photo['alt'] . '" />'; ?>
                    </div>
                </div>
            <?php } ?>
                
            <div id="content-left" class="col res-34 tab-23 wide-1 ph-1">

                <div class="content-area">
                    <main id="main" class="site-main" role="main">

                        <?php if (have_posts()) : ?>

                            <?php /* Start the Loop */ ?>
                            <?php while (have_posts()) : the_post(); ?>

                                <?php
                                /* Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part('content', get_post_format());
                                ?>

                            <?php endwhile; ?>

                            <?php the_posts_navigation(); ?>

                        <?php else : ?>

                            <?php get_template_part('content', 'none'); ?>

                        <?php endif; ?>

                    </main><!-- #main -->
                </div><!-- #primary -->
            </div>
            <div id="content-right" class="col res-14 tab-13 wide-1 ph-1">
                <?php //include('sidebar.php'); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
