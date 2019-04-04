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
$newscat        = get_field('news_category');
$sidebarbuttons = get_field('sidebar_buttons');
$header_photo   = get_field('header_photo');

get_header(); ?>
    <div id="primary" class="support-area">
        <div id="mid">
            <div class="container">

                <?php if ($header_photo) { ?>
                    <div id="featured-image" class="support">
                        <img src="<?php echo $header_photo['url']; ?>" alt="<?php echo $header_photo['alt']; ?>"/>
                    </div>
                <?php } ?>

                <div class="columns is-multiline">
                    <div id="content-left" class="column is-12">

                        <div class="content-area">
                            <main id="main" class="site-main" role="main">

                                <?php if (function_exists('yoast_breadcrumb')) {
                                    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                                } ?>

                                <?php while (have_posts()) : the_post(); ?>

                                    <?php get_template_part('content', 'page'); ?>

                                <?php endwhile; // end of the loop. ?>

                            </main><!-- #main -->
                        </div>
                    </div>
                    <div id="content-right" class="patient-buttons column is-12">
                        <div class="columns is-multiline">
                            <div id="button" class="tile column is-6-tablet is-3-desktop"
                                 style="min-height: inherit !important;">
                                <div class="feat-button">
                                    <a href="/patient-center/download-forms/">
                                        <p class="bluebar"><span class="name">Download Forms</span><span
                                                    class="arrow"></span></p>
                                        <div class="overlay"
                                             style="background-image:url('<?php echo get_template_directory_uri() ?>/images/forms.png');">
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div id="button" class="tile column is-6-tablet is-3-desktop"
                                 style="min-height: inherit !important;">
                                <div class="feat-button">
                                    <a href="/patient-center/financing-options/">
                                        <p class="bluebar"><span class="name">Financing Options</span><span
                                                    class="arrow"></span></p>
                                        <div class="overlay"
                                             style="background-image:url('<?php echo get_template_directory_uri() ?>/images/options.png');">
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div id="button" class="tile column is-6-tablet is-3-desktop"
                                 style="min-height: inherit !important;">
                                <div class="feat-button">
                                    <a href="/patient-center/accepted-health-plans/">
                                        <p class="bluebar"><span class="name">Accepted Health Plans</span><span
                                                    class="arrow"></span></p>
                                        <div class="overlay"
                                             style="background-image:url('<?php echo get_template_directory_uri() ?>/images/health-plans.png');">
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div id="button" class="tile column is-6-tablet is-3-desktop"
                                 style="min-height: inherit !important;">
                                <div class="feat-button">
                                    <a href="/patient-center/privacy-policy/">
                                        <p class="bluebar"><span class="name">Privacy Policy</span><span
                                                    class="arrow"></span></p>
                                        <div class="overlay"
                                             style="background-image:url('<?php echo get_template_directory_uri() ?>/images/privacy.png');">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php //include('services-bottom.php'); ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>