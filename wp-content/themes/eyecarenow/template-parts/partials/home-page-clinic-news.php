<?php
use Includes\Modules\KMAFacebook\FacebookController;

$facebook = new FacebookController();
$feed = $facebook->getFbPosts(3);
$now     = time();

/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */

if(count($feed) > 0){ 
?>

<div class="container">
    <h2 class="is-semibold is-secondary line-right">News & Info</h2>

    <div class="article-container">
        <div class="columns is-multiline">
            <?php 
            foreach ($feed as $fbPost) {

                include(locate_template('template-parts/partials/mini-facebook-article.php'));

            }
            ?>
        </div>
    </div>
    <p class="has-text-centered"><a href="/news-community/" class="button is-primary is-caps" style="margin-bottom: 35px;">Read all news &nbsp;<i class="fa fa-play" aria-hidden="true"></i></a></p>
</div>
<?php }?>