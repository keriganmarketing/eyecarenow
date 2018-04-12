<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package EyeCareNow
 */
$newsenabled    = get_field('show_news_feed');
$newscat        = 'news_category';
$sidebarbuttons = get_field('sidebar_buttons');
$slider         = get_field('header_slideshow');
$header_photo   = get_field('header_photo');

get_header(); ?>
<div id="primary" class="support-area">
    <div id="mid">
        <div class="container">
            <?php if ($slider) { ?>
                <div id="featured-image" class="support">

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
                    <main id="main" class="site-main" role="main">

                        <?php if (function_exists('yoast_breadcrumb')) {
                            yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                        } ?>

                        <?php while (have_posts()) : the_post(); ?>

                            <?php get_template_part('content', 'page'); ?>

                        <?php endwhile; // end of the loop. ?>

                    </main><!-- #main -->
                </div><!-- #primary -->
            </div>
            <div id="content-right" class="col res-14 tab-13 wide-1 ph-1">
                <?php include('sidebar.php'); ?>
            </div>

        </div>
        <?php //include('services-bottom.php'); ?>
    </div>
</div>
<?php get_footer(); ?>
