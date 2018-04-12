<?php
use Includes\Modules\KMAFacebook\FacebookController;

$facebook = new FacebookController();
$feed = $facebook->getFeed(3);

foreach ($feed->posts as $fbPost) {

    include(locate_template('template-parts/partials/mini-facebook-article.php'));

} ?>