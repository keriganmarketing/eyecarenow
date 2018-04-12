<div id="secondary" class="widget-area" role="complementary">
    <?php

    if (is_array($newscat)) {
        $newscat = implode(",", $newscat);
    }

    if ($newsenabled) {
        $args = [
            'category'       => $newscat,
            'posts_per_page' => 3,
            'offset'         => 0,
            'orderby'        => 'post_date',
            'order'          => 'DESC',
            'post_status'    => 'publish'
        ];

        $myposts = get_posts($args); ?>
        <div id="recent-news">
            <h3>Recently Posted</h3>
            <ul>
                <?php foreach ($myposts as $post) : setup_postdata($post); ?>

                    <li><?php the_date('m/d/y', '<span class="dateposted">', '</span>'); ?>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

                <?php endforeach;
                wp_reset_postdata(); ?>
            </ul>
            <p class="more"><a href="/news-community">MORE NEWS</a></p>
        </div>
    <?php }

    if ($sidebarbuttons) {
        $b = 1;
        foreach ($sidebarbuttons as $button) {
            $id    = $button->ID;
            $link  = get_field('page_link', $id);
            $photo = get_field('photo', $id);

            echo '<div id ="button' . $b . '" class="tile col res-1" style="min-height: inherit !important;" >';
            echo '<div class="feat-button is-fullwidth" >';
            echo '<a href="' . $link . '" >';
            echo '<p class="bluebar"><span class="name" >' . $button->post_title . '</span><span class="arrow"></span></p>';
            echo '<div class="overlay" style="background-image:url(\'' . $photo['url'] . '\');">';
            echo '</div>';
            echo '</a>';
            echo '</div>';
            echo '</div>';
            $b++;
        }
    }


    ?>
</div><!-- #secondary -->
