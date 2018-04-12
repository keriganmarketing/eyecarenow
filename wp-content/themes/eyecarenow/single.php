<?php
/**
 * The template for displaying all single posts.
 *
 * @package EyeCareNow
 */

$newsenabled    = 1;
$newscat        = get_field('news_category');
$sidebarbuttons = get_field('sidebar_buttons');
$slider         = get_field('header_slideshow');

get_header(); ?>
<div id="primary" class="support-area">
    <main id="main" class="site-main" role="main">
        <div id="mid">
            <div class="container">
                <div id="content-left" class="col res-34 tab-23 wide-1 ph-1">

                    <div id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">

                            <?php if (function_exists('yoast_breadcrumb')) {
                                yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                            } ?>

                            <?php while (have_posts()) : the_post(); ?>

                                <?php get_template_part('content', 'single'); ?>

                                <?php the_post_navigation(); ?>

                                <?php
                                // If comments are open or we have at least one comment, load up the comment template
                                if (comments_open() || get_comments_number()) :
                                    comments_template();
                                endif;
                                ?>

                            <?php endwhile; // end of the loop. ?>

                        </main><!-- #main -->
                    </div><!-- #primary -->

                </div>
                <div id="content-right" class="col res-14 tab-13 wide-1 ph-1">
                    <?php include('sidebar.php'); ?>
                    <div id="tag-cloud">
                        <h3>Tags:</h3>
                        <?php $targs = [
                            'smallest'                  => 10,
                            'largest'                   => 20,
                            'unit'                      => 'px',
                            'number'                    => 45,
                            'format'                    => 'flat',
                            'separator'                 => "\n",
                            'orderby'                   => 'count',
                            'order'                     => 'DESC',
                            'exclude'                   => null,
                            'include'                   => null,
                            'topic_count_text_callback' => default_topic_count_text,
                            'link'                      => 'view',
                            'taxonomy'                  => 'post_tag',
                            'echo'                      => true,
                            'child_of'                  => null, // see Note!
                        ];

                        wp_tag_cloud($targs);

                        ?>
                    </div>
                </div>
                <?php //include('services-bottom.php'); ?>
            </div>
        </div>
    </main>
</div>
<?php get_footer(); ?>
