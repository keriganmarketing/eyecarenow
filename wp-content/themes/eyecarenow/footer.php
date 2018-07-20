<?php

use Includes\Modules\Social\SocialSettingsPage;

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package EyeCareNow
 */
$facebook = get_field('facebook_link', '15');
$youtube  = get_field('youtube_link', '15');
?>

<div id="bot">
    <div class="container">
        <div id="footer-col1" class="col res-12 large-12 ph-1">
            <?php wp_nav_menu(['theme_location' => 'footer']); ?>

        </div>
        <div id="footer-col3" class="col res-14 large-34 ph-1 has-text-centered has-text-left-desktop">
            <h4 class="footer-label">24-Hour Phone</h4>
            <div id="footer-phones">
                <a href="tel:<?php echo get_field('main_phone_number',
                    15); ?>"><?php echo get_field('main_phone_number', 15); ?></a> <br>
                <a href="tel:<?php echo get_field('toll_free_phone', 15); ?>"><?php echo get_field('toll_free_phone',
                        15); ?><span class="small italic">(toll free)</span></a>
            </div>
        </div>
        <div id="footer-col4" class="col res-14 large-34 ph-1 has-text-centered has-text-right-desktop">
            <h4 class="footer-label">Connect with Us</h4>
            <div class="social has-text-centered has-text-right-desktop">
                <?php
                $social      = new SocialSettingsPage();
                $socialLinks = $social->getSocialLinks('svg', 'circle');
                if (is_array($socialLinks)) {
                    foreach ($socialLinks as $socialId => $socialLink) {
                        echo '<a class="' . $socialId . '" href="' . $socialLink[0] . '" target="_blank" >' . $socialLink[1] . '</a>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="back-to-top">
            <a href="#masthead">Back To Top</a>
        </div>
        <hr>
        <div class="info">
            <div class="info-wrap">
                <div id="copyright" class="col res-12 tab-12 wide-1 ph-1"><p>
                        &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> | <a
                                href="/patient-center/privacy-policy">Privacy Policy</a> | <a href="/sitemap_index.xml">Sitemap</a>
                    </p></div>
                <div id="siteby" class="col res-12 tab-12 wide-1 ph-1"><p><img
                                src="<?php echo get_template_directory_uri() ?>/images/kma.png"/> Site by <a
                                href="http://keriganmarketing.com">KMA</a>.</p></div>
            </div>
        </div>
    </div><!-- .container -->
</div><!-- #bot -->

</div><!-- #page -->
<div class="clear"></div>
</div><!-- #wrapper -->

<script>

    jQuery(function ($) {
        $('.lightbox').nivoLightbox({
            effect: 'fade',                             // The effect to use when showing the lightbox
            theme: 'default',                           // The lightbox theme to use
            keyboardNav: true,                          // Enable/Disable keyboard navigation (left/right/escape)
            clickOverlayToClose: true,                  // If false clicking the "close" button will be the only way to close the lightbox
            onInit: function () {
            },                       // Callback when lightbox has loaded
            beforeShowLightbox: function () {
            },           // Callback before the lightbox is shown
            afterShowLightbox: function (lightbox) {
            },    // Callback after the lightbox is shown
            beforeHideLightbox: function () {
            },           // Callback before the lightbox is hidden
            afterHideLightbox: function () {
            },            // Callback after the lightbox is hidden
            onPrev: function (element) {
            },                // Callback when the lightbox gallery goes to previous item
            onNext: function (element) {
            },                // Callback when the lightbox gallery goes to next item
            errorMessage: 'The requested content cannot be loaded. Please try again later.' // Error message when content can't be loaded
        });
    });
</script>

<?php wp_footer(); ?>

<?php if (is_single(207) || is_front_page()) { ?>
    <script async
            src="https://i.simpli.fi/dpx.js?cid=44672&action=100&segment=viameyecenterlal&m=1&sifi_tuid=22403"></script>
<?php } ?>
</body>
</html>

