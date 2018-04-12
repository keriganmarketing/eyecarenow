<?php
/**
 * Template Name: Videos
 *
 * @package EyeCareNow
 */

get_header(); ?>
    <div id="primary" class="support-area">
        <div id="mid">
            <div class="container">
                <div id="content-left" class="col res-1 tab-1 wide-1 ph-1">
                    <div id="primary" class="content-area">
                        <main id="blog" class="site-blog" role="blog">
                            <?php

                            $args = [
                                'post_type'      => 'videos',
                                'posts_per_page' => -1,
                                'offset'         => 0,
                                'orderby'        => 'menu_order',
                                'order'          => 'ASC',
                                'post_status'    => 'publish'
                            ];

                            $videos = get_posts($args);
                            foreach ($videos as $video) {
                                $id         = $video->ID;
                                $video_type = get_field('type_of_content', $id);

                                $video_url   = get_field('video_url', $id);
                                $video_image = get_field('video_image', $id);
                                $video_embed = get_field('video_embed', $id);

                                $youtube_code = get_field('youtube_code', $id);
                                $vimeo_code   = get_field('vimeo_code', $id);


                                if ($video_type == 'embed') {
                                    echo '<div id="video' . $id . '" class="col res-13 wide-12 ph-1 video" style="padding:20px;" >';
                                    echo '<a class="lightbox" data-lightbox-type="iframe" href=' . $video_embed . '&output=embed"><img src="' . $video_image . '" alt="' . $video->post_title . '" /></a>';
                                    echo '<h2><a class="fancybox" data-lightbox-type="iframe" href=' . $video_embed . '&output=embed">' . $video->post_title . '</a></h2>';
                                    echo '</div>';
                                }
                                if ($video_type == 'external') {
                                    echo '<div id="video' . $id . '" class="col res-13 wide-12 ph-1 video" style="padding:20px;" >';
                                    echo '<a href=' . $video_url . '" target="_blank" ><img src="' . $video_image . '" alt="' . $video->post_title . '" /></a>';
                                    echo '<h2><a href=' . $video_link . '">' . $video->post_title . '</a></h2>';
                                    echo '</div>';
                                }
                                if ($video_type == 'youtube') {

                                    $youtube_image = 'http://i.ytimg.com/vi/' . $youtube_code . '/0.jpg';

                                    echo '<div id="video' . $id . '" class="col res-13 wide-12 ph-1 video" style="padding:20px;" >';
                                    echo '<a class="lightbox" data-lightbox-type="iframe" href="https://www.youtube.com/watch?v=' . $youtube_code . '?fs=1&autoplay=1" ><img src="' . $youtube_image . '" alt="' . $video->post_title . '" /></a>';
                                    echo '<h2><a class="lightbox" data-lightbox-type="iframe" href="https://www.youtube.com/watch?v=' . $youtube_code . '?fs=1&autoplay=1" >' . $video->post_title . '</a></h2>';
                                    echo '</div>';
                                }
                                if ($video_type == 'vimeo') {

                                    $hash       = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
                                    $vimeoimage = $hash[0]['thumbnail_medium'];

                                    $url        = 'http://www.vimeo.com/api/v2/video/' . $vimeo_code . '.php';
                                    $contents   = @file_get_contents($url);
                                    $vimeoimage = @unserialize(trim($contents));

                                    echo '<div id="video' . $id . '" class="col res-13 wide-12 ph-1 video" style="padding:20px;" >';
                                    echo '<a class="lightbox" data-lightbox-type="iframe" href="https://player.vimeo.com/' . $vimeo_code . '?autoplay=1&title=0&byline=0" ><img src="' . $vimeoimage[0]['thumbnail_large'] . '"  alt="' . $video->post_title . '" /></a>';
                                    echo '<h2><a class="lightbox" data-lightbox-type="iframe" href="https://player.vimeo.com/' . $vimeo_code . '?autoplay=1&title=0&byline=0" >' . $video->post_title . '</a></h2>';
                                    echo '</div>';
                                }
                            }

                            ?>
                            <div class="clear"></div>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>