<?php
/**
 * Template Name: Blog
 *
 * @package EyeCareNow
 */

$newsenabled    = get_field('show_news_feed');
$newscat        = get_field('news_category');
$sidebarbuttons = get_field('sidebar_buttons');
$slider         = get_field('header_slideshow');
$header_photo   = get_field('header_photo');

get_header(); ?>
    <div id="primary" class="support-area">
        <div id="mid">
            <div class="container">
                <?php if ($slider) { ?>
                    <div id="featured-image" class="support">
                        <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/inc/flexslider/flexslidermin.css" type="text/css">
                        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
                        <script src="<?php echo get_template_directory_uri() ?>/inc/flexslider/jquery.flexslider-min.js"></script>
                        <div class="flexslider">
                            <ul class="slides">
                                <?php
                                $p = 1;
                                foreach ($slider[0] as $ph) {
                                    echo '<li>';
                                    echo '<img src="' . $ph['imageURL'] . '" alt="' . $ph['alttext'] . '" />';
                                    echo '</li>';
                                    $p++;
                                }
                                ?>
                            </ul>
                        </div>

                        <script type="text/javascript" charset="utf-8">
                            $(window).load(function () {
                                $('.flexslider').flexslider({
                                    controlNav: true,                //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
                                    directionNav: false,             //Boolean: Create navigation for previous/next navigation? (true/false)
                                    prevText: "<",           		 //String: Set the text for the "previous" directionNav item
                                    nextText: ">"               	 //String: Set the text for the "next" directionNav item
                                });
                            });
                        </script>

                    </div>
                <?php }
                if ($header_photo) { ?>
                    <div id="featured-image" class="support">
                        <img src="<?php echo $header_photo['url']; ?>" alt="<?php echo $header_photo['alt']; ?>"/>
                    </div>
                <?php } ?>

                <div id="content-left" class="col res-34 tab-23 wide-1 ph-1">
                    <div id="primary" class="content-area">
                        <main id="blog" class="site-blog" role="blog">
                            <?php if (function_exists('yoast_breadcrumb')) {
                                yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                            } ?>
                            <?php while (have_posts()) : the_post(); ?>

                                <?php get_template_part('content', 'page'); ?>

                            <?php endwhile; // end of the loop. ?>
                            <?php

                            $args = [
                                'category'       => 'news',
                                'posts_per_page' => -1,
                                'offset'         => 0,
                                'orderby'        => 'post_date',
                                'order'          => 'DESC',
                                'post_status'    => 'publish'
                            ];

                            $myposts = get_posts($args);
                            foreach ($myposts

                            as $post) :
                            setup_postdata($post); ?>

                            <?php if (has_post_thumbnail()) { ?>
                            <div class="post-thumbnail col res-14 wide-12 ph-1">
                                <?php the_post_thumbnail();
                                } else { ?>
                                <div class="post-thumbnail col res-14 wide-12 ph-1">
                                    <img src="<?php echo get_template_directory_uri() ?>/images/news.jpg"/>
                                    <?php } ?>
                                </div>
                                <div class="post-text col res-34 wide-12 ph-1">
                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <div class="entry-meta">
                                        <?php eyecarenow_posted_on(); ?>
                                    </div><!-- .entry-meta -->
                                    <p><?php the_excerpt(); ?></p>
                                    <p class="more"><a class="more" href="<?php the_permalink(); ?>">MORE</a></p>
                                </div>
                                <hr>
                                <?php endforeach;
                                wp_reset_postdata(); ?>

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

                <script type="text/javascript" charset="utf-8">
                    $(window).load(function () {
                        $('.flexslider').flexslider({
                            controlNav: true,                //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
                            directionNav: false,             //Boolean: Create navigation for previous/next navigation? (true/false)
                            prevText: "<",           		 //String: Set the text for the "previous" directionNav item
                            nextText: ">"               	 //String: Set the text for the "next" directionNav item
                        });
                    });
                </script>
            </div>
        </div>
    </div>
<?php get_footer(); ?>