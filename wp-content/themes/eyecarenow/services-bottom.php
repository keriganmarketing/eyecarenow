<?php if ( ! is_page('services')): ?>
<div class="section-wrapper">
    <div class="container">
        <div id="featured-services columns is-multiline is-justified">
                <?php
                $fargs = [
                    'posts_per_page' => 6,
                    'offset'         => 3,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                    'post_type'      => 'button',
                    'post_status'    => 'publish'
                ];

                $featureds = get_posts($fargs);

                $u = 1;
                foreach ($featureds as $feature) {
                    $id    = $feature->ID;
                    $link  = get_field('page_link', $id);
                    $photo = get_field('photo', $id);
                    $info  = get_field('summary_text', $id);
                    //<img src="'.$headshot.'" alt="'.$realtor->post_title.'" class="headshot" />
                    //print_r($photo);

                    echo '<div id ="featured' . $u . '" class="featured column is-6-tablet is-4-desktop" >';
                    echo '<div class="feat-button" >';
                    echo '<a href="' . $link . '" >';
                    echo '<p class="greenbar"><span class="name" >' . $feature->post_title . '</span><span class="arrow"></span></p>';
                    echo '<div class="overlay" style="background-image:url(\'' . $photo['url'] . '\');">';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                    if ($info != '') {
                        echo $info;
                        echo '<p class="more"><a href="' . $link . '">MORE</a></p>';
                    }
                    echo '</div>';
                    $u++;
                }

                ?>

        </div>
    </div>
</div>
<?php endif; ?>