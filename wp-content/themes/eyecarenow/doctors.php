<?php
/**
 * Template Name: Doctors
 *
 * @package EyeCareNow
 */

$newsenabled    = get_field('show_news_feed');
$newscat        = get_field('news_category');
$sidebarbuttons = get_field('sidebar_buttons');
$slider         = get_field('header_slideshow');

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
                <?php } ?>
                <div id="content-left" class="col res-1 tab-1 wide-1 ph-1">
                    <div id="primary" class="content-area">
                        <main id="blog" class="site-blog" role="blog">

                            <?php


                            $args = [
                                'post_type'      => 'doctor',
                                'posts_per_page' => -1,
                                'offset'         => 0,
                                'orderby'        => 'menu_order',
                                'order'          => 'ASC',
                                'post_status'    => 'publish'
                            ];

                            $doctors = get_posts($args);
                            foreach ($doctors as $doctor) {
                                $id           = $doctor->ID;
                                $headshot     = get_field('headshot', $id);
                                $post_content = $doctor->post_content; // get the content
                                $post_content = strip_tags($post_content); // remove HTML tags
                                $post_content = preg_replace('/\[(.*)\]/', '', $post_content);  // remove shortcodes

                                if (strlen($post_content) > 100) {
                                    $post_content = wordwrap($post_content, 100);
                                    $post_content = substr($post_content, 0, strpos($post_content, "\n")) . '...';
                                }

                                $thumbnail = get_the_post_thumbnail($id,'thumbnail');

                                //echo '<pre>',print_r($thumbnail),'</pre>';

                                echo '<div id="doctor' . $id . '" class="col res-12 wide-12 ph-1" >';
                                echo '<div class="post-thumbnail col res-13 wide-13 ph-1">';
                                echo $thumbnail;
                                //echo '<img src="' . $headshot['url'] . '" alt="' . $headshot['alt'] . '" />';
                                echo '</div><div class="post-text col res-23 wide-23 ph-1">';
                                echo '<h2><a href="' . get_page_link($id) . '">' . $doctor->post_title . '</a></h2>';
                                echo '<p>' . $post_content . ' <a href="' . get_page_link($id) . '" >Read more.</a></p><hr>';
                                echo '</div>';
                                echo '</div>';

                            }

                            ?>

                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>