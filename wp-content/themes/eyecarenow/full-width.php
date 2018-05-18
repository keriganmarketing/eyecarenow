<?php
/**
 * Template Name: Full Width Landing Page
 *
 * @package EyeCareNow
 */
$newsenabled    = get_field('show_news_feed');
$newscat        = 'news_category';
$sidebarbuttons = get_field('sidebar_buttons');
$slider         = get_field('header_slideshow');
$header_photo   = get_field('header_photo');

get_header(); ?>
    <div id="primary">
        <main id="main" class="site-main" role="main">
            <div id="mid">
                <div class="mast-container">
                    <img src="<?php echo $header_photo['url']; ?>" alt="<?php echo $header_photo['alt']; ?>"/>
                </div>
                <div id="content" class="section-wrapper site-content">
                    <div class="container support-page-text">
                                <h1 class="title is-primary"><?php the_title(); ?></h1>
                                <?php the_content(); ?>

                    </div>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php get_footer(); ?>