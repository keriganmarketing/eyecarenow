<?php
$isVideo  = ($fbPost->type == 'video');
$hasImage = ($fbPost->full_image_url != '' && $isVideo == false);
$date     = date('M j',strtotime($fbPost->post_date)) . ' at ' . date('g:i a',strtotime($fbPost->post_date));
$words    = wp_trim_words($fbPost->post_content, 51, '...');
?>
<div class="column is-6-tablet is-4-desktop">
    <div class="card social-module facebook has-text-centered <?= ($hasImage == true ? 'has-image' : 'no-image'); ?>">
        <?php if ($hasImage == true) { ?>
            <div class="card-image">
                <img src="<?= $fbPost->full_image_url; ?>">
            </div>
        <?php } ?>
        <?php if ($isVideo == true) { ?>
            <div class="card-video">
                <iframe
                    src="<?= $fbPost->video_url; ?>"
                    style="border:none;overflow:hidden"
                    scrolling="no"
                    frameborder="0"
                    allowTransparency="true"
                    allowFullScreen="true"
                    width="100%"
                    height="225">
                </iframe>
            </div>
        <?php } ?>
        <div class="card-content has-text-centered">
            <p class="posted-on is-bold">Posted <?= $date; ?></p>
            <p class="post-text"><?= $words; ?></p>
            <a class="facebook cta-link is-bold is-caps" target="_blank" href="<?= $fbPost->permalink_url; ?>">Read more on Facebook</a>
        </div>
    </div>
</div>