<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package EyeCareNow
 */

get_header(); ?>
<div id="primary" class="support-area">
    <div id="mid">
        <div class="container">
            <div id="content-left">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">

                        <section class="error-404 not-found">
                            <header class="page-header">
                                <h1 class="page-title"><?php _e('Oops! That page can&rsquo;t be found.',
                                        'eyecarenow'); ?></h1>
                            </header><!-- .page-header -->

                            <div class="page-content">
                                <p><?php _e('It looks like nothing was found at this location. Maybe try one of the links below or a search?',
                                        'eyecarenow'); ?></p>

                                <div id="searchbox"><?php get_search_form(); ?></div>

                                <div id="recent-news"><?php the_widget('WP_Widget_Recent_Posts'); ?></div>

                                <?php if (eyecarenow_categorized_blog()) : // Only show the widget if site has multiple categories. ?>
                                    <div class="widget widget_categories">
                                        <h2 class="widget-title"><?php _e('Most Used Categories',
                                                'eyecarenow'); ?></h2>
                                        <ul>
                                            <?php
                                            wp_list_categories([
                                                'orderby'    => 'count',
                                                'order'      => 'DESC',
                                                'show_count' => 1,
                                                'title_li'   => '',
                                                'number'     => 10,
                                            ]);
                                            ?>
                                        </ul>
                                    </div><!-- .widget -->
                                <?php endif; ?>

                                <?php
                                /* translators: %1$s: smiley */
                                $archive_content = '<p>' . sprintf(__('Try looking in the monthly archives. %1$s',
                                        'eyecarenow'), convert_smilies(':)')) . '</p>';
                                the_widget('WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content");
                                ?>

                                <?php the_widget('WP_Widget_Tag_Cloud'); ?>

                            </div><!-- .page-content -->
                        </section><!-- .error-404 -->

                    </main><!-- #main -->
                </div><!-- #primary -->
            </div>
            <?php include('services-bottom.php'); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
