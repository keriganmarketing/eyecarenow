<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package EyeCareNow
 */
get_header(); ?>
    <div id="primary">
        <main id="main" class="site-main" role="main">
            <div id="mid">
                <div class="mast-container">
                    <img src="<?php echo get_template_directory_uri() . '/images/mast0819.png'; ?>" alt="See what we can do for you with our services and eyeglass center">
                </div>
                <div id="content" class="section-wrapper site-content">
                    <div class="container home-page-text">
                        <div class="columns is-multiline is-justified is-aligned">
                            <div class="column is-9">
                                <h1 class="title is-primary"><?php the_title(); ?></h1>
                                <?php the_content(); ?>
                            </div>
                            <div class="column is-3">
                                <p><a href="/our-doctors/" class="button is-primary is-fullwidth has-shadow">OUR DOCTORS &nbsp;<i class="fa fa-play" aria-hidden="true"></i></a></p>
                                <p><a href="/contact-locations/" class="button is-secondary is-fullwidth has-shadow">CONTACT US &nbsp;<i class="fa fa-play" aria-hidden="true"></i></a></p>
                            </div>
                        </div>
                    </div>
                    <div class="section-wrapper feature-boxes">
                        <div class="container">
                            <div class="columns is-multiline is-justified">
                                <div class="column is-6-desktop">
                                    <?php
                                        $id = 24;
                                        $link = get_field('page_link', $id);
                                        $photo = get_field('photo', $id);
                                        $info = get_field('summary_text', $id);
                                    ?>
                                    <div class="card is-fullheight">
                                        <div class="card-image">
                                            <img src="<?php echo $photo['url']; ?>" alt="<?php echo $photo['alt']; ?>">
                                        </div>
                                        <div class="card-content">
                                            <h3 class="title is-semibold fancy"><?php echo get_the_title($id); ?></h3>
                                            <p class="has-text-centered"><?php echo $info; ?></p>
                                            <p class="has-text-centered"><a href="<?php echo $link; ?>" class="button is-primary is-caps">Learn More &nbsp;<i class="fa fa-play" aria-hidden="true"></i></a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="column is-6-desktop">
                                    <?php
                                    $id = 87;
                                    $link = get_field('page_link', $id);
                                    $photo = get_field('photo', $id);
                                    $info = get_field('summary_text', $id);
                                    ?>
                                    <div class="card is-fullheight">
                                        <div class="card-image">
                                            <img src="<?php echo $photo['url']; ?>" alt="<?php echo $photo['alt']; ?>">
                                        </div>
                                        <div class="card-content">
                                            <h3 class="title is-semibold fancy"><?php echo get_the_title($id); ?></h3>
                                            <p class="has-text-centered"><?php echo $info; ?></p>
                                            <p class="has-text-centered"><a href="<?php echo $link; ?>" class="button is-primary is-caps">Learn More &nbsp;<i class="fa fa-play" aria-hidden="true"></i></a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-wrapper specialties-area">
                        <?php include(locate_template('template-parts/partials/home-page-specialties.php')); ?>
                    </div>
                    <div class="section-wrapper clinic-news">
                        <?php include(locate_template('template-parts/partials/home-page-clinic-news.php')); ?>
                    </div>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php get_footer(); ?>