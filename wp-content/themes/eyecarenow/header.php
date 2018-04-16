<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package CC
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&language=en&key=AIzaSyB8L8y5zfQIVoEQ-M1x74lRcygaONmlKUI"></script>

    <?php wp_head(); ?>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/inc/nivo-lightbox/nivo-lightbox.css"
          type="text/css"/>
    <link rel="stylesheet"
          href="<?php echo get_template_directory_uri() ?>/inc/nivo-lightbox/themes/default/default.css"
          type="text/css"/>
    <script src="<?php echo get_template_directory_uri() ?>/inc/nivo-lightbox/nivo-lightbox.js"></script>

    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-15421411-25']);
        _gaq.push(['_setDomainName', 'eyecarenow.com']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();

    </script>

</head>

<body <?php body_class(); ?>>
<div id="wrapper">
    <div id="page" class="hfeed site">
        <div id="top">
            <div class="container">
                <a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'cc'); ?></a>
                <header id="masthead" class="site-header" role="banner">
                    <div id="phone-button" class="col res-13 tab-12 ph-1 right ph-center">
                        <div id="searchbox"><?php get_search_form(); ?></div>
                        <a href="tel:<?php echo get_field('main_phone_number',
                            15); ?>"><?php echo get_field('main_phone_number', 15); ?></a>
                    </div>

                    <div id="contest-area" class="col res-13 tab-12 ph-1 right">
                        <?php

                        $cargs = [
                            'posts_per_page' => 1,
                            'offset'         => 0,
                            'meta_query'     => [
                                'relation' => 'AND',
                                [
                                    'key'     => 'enable_contest',
                                    'value'   => '1',
                                    'compare' => '=='
                                ]
                            ],
                            'post_type'      => 'contest',
                            'post_status'    => 'publish'
                        ];

                        $contests = get_posts($cargs);

                        $u = 0;
                        foreach ($contests as $contest) {
                            $id = $contest->ID;
                            echo '<a href="' . get_page_link($id) . '" ><span class="title">' . $contest->post_title . '</span><span class="action">Click to enter</span></a>';
                        }

                        ?>
                    </div>

                    <div id="logo" class="col res-13 tab-12 ph-1 ph-center">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <img src="<?php echo get_template_directory_uri() ?>/images/eye-center-logo.jpg"
                                 alt="<?php bloginfo('name'); ?>"/></a>
                    </div>
                </header><!-- #masthead -->
            </div>
        </div><!-- #top -->
        <div id="navbar">
            <div class="container">
                <div id="main-nav" class="col res-1">
                    <nav id="site-navigation" class="main-navigation" role="navigation">
                        <?php wp_nav_menu(['theme_location' => 'primary']); ?>
                    </nav><!-- #site-navigation -->
                </div>
            </div>
        </div> <!-- #navbar -->
