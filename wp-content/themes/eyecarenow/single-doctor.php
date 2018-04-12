<?php
/**
 * The template for displaying all single doctors.
 *
 * @package EyeCareNow
 */
$newsenabled    = get_field('show_news_feed');
$newscat        = get_field('news_category');
$sidebarbuttons = get_field('sidebar_buttons');
$slider         = get_field('header_slideshow');
$headshot       = get_field('headshot');
$author_id      = get_field('blog_author_link');

get_header(); ?>
<div id="primary" class="support-area">
    <div id="mid">
        <div class="container">
            <div class="doc-photo col res-13 tab-13 wide-12 ph-1" style="padding-left:40px;">
                <?php echo '<img src="' . $headshot['url'] . '" alt="' . $headshot['alt'] . '" style="border:1px solid rgba(0,0,0,.1);" />'; ?>

                <?php if ($newsenabled) {

                    $args = [
                        'author'         => $author_id['ID'],
                        'posts_per_page' => -1,
                        'offset'         => 0,
                        'orderby'        => 'post_date',
                        'order'          => 'DESC',
                        'post_status'    => 'publish'
                    ];

                    $docarticles = get_posts($args); ?>

                    <?php //print_r( $author_id ); ?>

                    <?php if (count($docarticles) > 0) { ?>
                        <div id="recent-news">
                            <h3>Recently Posted</h3>
                            <ul>
                                <?php foreach ($docarticles as $post) : setup_postdata($post); ?>

                                    <li><?php the_date('m/d/y', '<span class="dateposted">', '</span>'); ?>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

                                <?php endforeach;
                                wp_reset_postdata(); ?>
                            </ul>
                            <p class="more"><a href="/news-community">MORE ARTICLES</a></p>
                        </div>
                    <?php } ?>
                <?php } ?>

            </div>
            <div id="content-left" class="col res-23 tab-23 wide-12 ph-1" style="padding-right:35px;">

                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">

                        <?php if (have_posts()) : ?>

                            <?php /* Start the Loop */ ?>
                            <?php while (have_posts()) : the_post(); ?>

                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <header class="entry-header">

                                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

                                    </header><!-- .entry-header -->

                                    <div class="entry-content">
                                        <?php the_content(); ?>
                                    </div><!-- .entry-content -->

                                    <footer class="entry-footer">
                                        <?php eyecarenow_entry_footer(); ?>
                                    </footer><!-- .entry-footer -->
                                </article><!-- #post-## -->

                            <?php endwhile; ?>

                            <?php the_posts_navigation(); ?>

                        <?php else : ?>

                            <?php get_template_part('content', 'none'); ?>

                        <?php endif; ?>

                    </main><!-- #main -->
                </div><!-- #primary -->
            </div>
            <?php //include('services-bottom.php'); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
