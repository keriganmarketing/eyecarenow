<?php

//use Includes\Modules\Videos\Videos;
use Includes\Modules\Leads\KmaLeads;
use Includes\Modules\Helpers\CleanWP;
//use Includes\Modules\Reviews\Reviews;
//use Includes\Modules\Layouts\Layouts;
//use Includes\Modules\Team\Physicians;
//use Includes\Modules\Slider\BulmaSlider;
//use Includes\Modules\Comments\CommentBox;
//use Includes\Modules\Locations\Locations;
use Includes\Modules\Social\SocialSettingsPage;
use Includes\Modules\KMAFacebook\FacebookController;
use Includes\Modules\Helpers\MailChimp;

require('vendor/autoload.php');

new CleanWP();

$socialLinks = new SocialSettingsPage();
if (is_admin()) {
    $socialLinks->createPage();
}

$facebook = new FacebookController();
$facebook->setupAdmin();

date_default_timezone_set('America/Chicago');
/**
 * EyeCareNow functions and definitions
 *
 * @package EyeCareNow
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset($content_width)) {
    $content_width = 640; /* pixels */
}

if ( ! function_exists('eyecarenow_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function eyecarenow_setup()
    {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on EyeCareNow, use a find and replace
         * to change 'eyecarenow' to the name of your theme in all the template files
         */
        load_theme_textdomain('eyecarenow', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails', ['post', 'doctor']);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus([
            'primary' => __('Primary Menu', 'eyecarenow'),
            'footer'  => __('Footer Menu', 'eyecarenow'),
        ]);

        register_post_type('contest', [
            'labels'             => [
                'name'               => _x('Contests', 'post type general name', 'cc'),
                'singular_name'      => _x('Contest', 'post type singular name', 'cc'),
                'menu_name'          => _x('Contests', 'admin menu', 'cc'),
                'name_admin_bar'     => _x('Contest', 'add new on admin bar', 'cc'),
                'add_new'            => _x('Add New', 'contest', 'cc'),
                'add_new_item'       => __('Add New Contest', 'cc'),
                'new_item'           => __('New Contest', 'cc'),
                'edit_item'          => __('Edit Contest', 'cc'),
                'view_item'          => __('View Contest', 'cc'),
                'all_items'          => __('All Contests', 'cc'),
                'search_items'       => __('Search Contests', 'cc'),
                'parent_item_colon'  => __('Parent Contests:', 'cc'),
                'not_found'          => __('No contests found.', 'cc'),
                'not_found_in_trash' => __('No contests found in Trash.', 'cc')
            ],
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => [
                'slug'       => 'contests',
                //string Customize the permalink structure slug. Defaults to the $post_type value. Should be translatable.
                'with_front' => false,
                //bool Should the permalink structure be prepended with the front base. <br>
                //(example: if your permalink structure is /blog/, then your links will be: false-> /news/, true->/blog/news/). Defaults to true
                'feeds'      => true,
                //bool Should a feed permalink structure be built for this post type. Defaults to has_archive value
                'pages'      => true
                //bool Should the permalink structure provide for pagination. Defaults to true
            ],
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => true,
            'menu_position'      => null,
            'supports'           => ['title', 'editor']
        ]);
        pti_set_post_type_icon('contest', 'check-square');

        register_post_type('button', [
            'labels'             => [
                'name'               => _x('Feature Buttons', 'post type general name', 'cc'),
                'singular_name'      => _x('Feature Button', 'post type singular name', 'cc'),
                'menu_name'          => _x('Feature Buttons', 'admin menu', 'cc'),
                'name_admin_bar'     => _x('Feature Button', 'add new on admin bar', 'cc'),
                'add_new'            => _x('Add New', 'button', 'cc'),
                'add_new_item'       => __('Add New Feature Button', 'cc'),
                'new_item'           => __('New Feature Button', 'cc'),
                'edit_item'          => __('Edit Feature Button', 'cc'),
                'view_item'          => __('View Feature Button', 'cc'),
                'all_items'          => __('All Feature Buttons', 'cc'),
                'search_items'       => __('Search Feature Buttons', 'cc'),
                'parent_item_colon'  => __('Parent Feature Buttons:', 'cc'),
                'not_found'          => __('No feature buttons found.', 'cc'),
                'not_found_in_trash' => __('No feature buttons in Trash.', 'cc')
            ],
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => [
                'slug'       => 'buttons',
                //string Customize the permalink structure slug. Defaults to the $post_type value. Should be translatable.
                'with_front' => false,
                //bool Should the permalink structure be prepended with the front base. <br>
                //(example: if your permalink structure is /blog/, then your links will be: false-> /news/, true->/blog/news/). Defaults to true
                'feeds'      => true,
                //bool Should a feed permalink structure be built for this post type. Defaults to has_archive value
                'pages'      => false
                //bool Should the permalink structure provide for pagination. Defaults to true
            ],
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => true,
            'menu_position'      => null,
            'supports'           => ['title', 'editor']
        ]);
        pti_set_post_type_icon('button', 'th-large');

        register_post_type('doctor', [
            'labels'             => [
                'name'               => _x('Doctors', 'post type general name', 'cc'),
                'singular_name'      => _x('Doctor', 'post type singular name', 'cc'),
                'menu_name'          => _x('Doctors', 'admin menu', 'cc'),
                'name_admin_bar'     => _x('Doctors', 'add new on admin bar', 'cc'),
                'add_new'            => _x('Add New', 'doctor', 'cc'),
                'add_new_item'       => __('Add New Doctor', 'cc'),
                'new_item'           => __('New Doctor', 'cc'),
                'edit_item'          => __('Edit Doctor', 'cc'),
                'view_item'          => __('View Doctor', 'cc'),
                'all_items'          => __('All Doctors', 'cc'),
                'search_items'       => __('Search Doctors', 'cc'),
                'parent_item_colon'  => __('Parent Doctor:', 'cc'),
                'not_found'          => __('No doctors found.', 'cc'),
                'not_found_in_trash' => __('No doctors found in Trash.', 'cc')
            ],
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => [
                'slug'       => 'doctors',
                //string Customize the permalink structure slug. Defaults to the $post_type value. Should be translatable.
                'with_front' => false,
                //bool Should the permalink structure be prepended with the front base. <br>
                //(example: if your permalink structure is /blog/, then your links will be: false-> /news/, true->/blog/news/). Defaults to true
                'feeds'      => true,
                //bool Should a feed permalink structure be built for this post type. Defaults to has_archive value
                'pages'      => true
                //bool Should the permalink structure provide for pagination. Defaults to true
            ],
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => null,
            'supports'           => ['title', 'editor', 'thumbnail']
        ]);
        pti_set_post_type_icon('doctor', 'user-md');

        register_post_type('location', [
            'labels'             => [
                'name'               => _x('Locations', 'post type general name', 'cc'),
                'singular_name'      => _x('Location', 'post type singular name', 'cc'),
                'menu_name'          => _x('Locations', 'admin menu', 'cc'),
                'name_admin_bar'     => _x('Locations', 'add new on admin bar', 'cc'),
                'add_new'            => _x('Add New', 'location', 'cc'),
                'add_new_item'       => __('Add New Location', 'cc'),
                'new_item'           => __('New Location', 'cc'),
                'edit_item'          => __('Edit Location', 'cc'),
                'view_item'          => __('View Location', 'cc'),
                'all_items'          => __('All Locations', 'cc'),
                'search_items'       => __('Search Locations', 'cc'),
                'parent_item_colon'  => __('Parent Location:', 'cc'),
                'not_found'          => __('No locations found.', 'cc'),
                'not_found_in_trash' => __('No locations found in Trash.', 'cc')
            ],
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => [
                'slug'       => 'locations',
                //string Customize the permalink structure slug. Defaults to the $post_type value. Should be translatable.
                'with_front' => false,
                //bool Should the permalink structure be prepended with the front base. <br>
                //(example: if your permalink structure is /blog/, then your links will be: false-> /news/, true->/blog/news/). Defaults to true
                'feeds'      => true,
                //bool Should a feed permalink structure be built for this post type. Defaults to has_archive value
                'pages'      => true
                //bool Should the permalink structure provide for pagination. Defaults to true
            ],
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => null,
            'supports'           => ['title', 'editor']
        ]);
        pti_set_post_type_icon('location', 'map-marker');

        register_post_type('testimonial', [
            'labels'             => [
                'name'               => _x('Testimonials', 'post type general name', 'cc'),
                'singular_name'      => _x('Testimonial', 'post type singular name', 'cc'),
                'menu_name'          => _x('Testimonials', 'admin menu', 'cc'),
                'name_admin_bar'     => _x('Testimonials', 'add new on admin bar', 'cc'),
                'add_new'            => _x('Add New', 'testimonial', 'cc'),
                'add_new_item'       => __('Add New Testimonial', 'cc'),
                'new_item'           => __('New Testimonial', 'cc'),
                'edit_item'          => __('Edit Testimonial', 'cc'),
                'view_item'          => __('View Testimonial', 'cc'),
                'all_items'          => __('All Testimonials', 'cc'),
                'search_items'       => __('Search Testimonials', 'cc'),
                'parent_item_colon'  => __('Parent Testimonial:', 'cc'),
                'not_found'          => __('No testimonials found.', 'cc'),
                'not_found_in_trash' => __('No testimonials found in Trash.', 'cc')
            ],
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => [
                'slug'       => 'testimonials',
                //string Customize the permalink structure slug. Defaults to the $post_type value. Should be translatable.
                'with_front' => false,
                //bool Should the permalink structure be prepended with the front base. <br>
                //(example: if your permalink structure is /blog/, then your links will be: false-> /news/, true->/blog/news/). Defaults to true
                'feeds'      => true,
                //bool Should a feed permalink structure be built for this post type. Defaults to has_archive value
                'pages'      => true
                //bool Should the permalink structure provide for pagination. Defaults to true
            ],
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => null,
            'supports'           => ['title', 'editor']
        ]);
        pti_set_post_type_icon('testimonial', 'quote-left');

        register_post_type('videos', [
            'labels'             => [
                'name'               => _x('Videos', 'post type general name', 'cc'),
                'singular_name'      => _x('Video', 'post type singular name', 'cc'),
                'menu_name'          => _x('Videos', 'admin menu', 'cc'),
                'name_admin_bar'     => _x('Videos', 'add new on admin bar', 'cc'),
                'add_new'            => _x('Add New', 'video', 'cc'),
                'add_new_item'       => __('Add New Videol', 'cc'),
                'new_item'           => __('New Video', 'cc'),
                'edit_item'          => __('Edit Video', 'cc'),
                'view_item'          => __('View Video', 'cc'),
                'all_items'          => __('All Videos', 'cc'),
                'search_items'       => __('Search Videos', 'cc'),
                'parent_item_colon'  => __('Parent Video:', 'cc'),
                'not_found'          => __('No videos found.', 'cc'),
                'not_found_in_trash' => __('No videos found in Trash.', 'cc')
            ],
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => [
                'slug'       => 'videos',
                //string Customize the permalink structure slug. Defaults to the $post_type value. Should be translatable.
                'with_front' => false,
                //bool Should the permalink structure be prepended with the front base. <br>
                //(example: if your permalink structure is /blog/, then your links will be: false-> /news/, true->/blog/news/). Defaults to true
                'feeds'      => true,
                //bool Should a feed permalink structure be built for this post type. Defaults to has_archive value
                'pages'      => true
                //bool Should the permalink structure provide for pagination. Defaults to true
            ],
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => null,
            'supports'           => ['title', 'editor']
        ]);
        pti_set_post_type_icon('videos', 'play-circle');

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ]);

        /*
         * Enable support for Post Formats.
         * See http://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', [
            'aside',
            'image',
            'video',
            'quote',
            'link',
        ]);

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('eyecarenow_custom_background_args', [
            'default-color' => 'ffffff',
            'default-image' => '',
        ]));
    }
endif; // eyecarenow_setup
add_action('after_setup_theme', 'eyecarenow_setup');

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function eyecarenow_widgets_init()
{
    register_sidebar([
        'name'          => __('Sidebar', 'eyecarenow'),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ]);
}

add_action('widgets_init', 'eyecarenow_widgets_init');

/**
 * Enqueue scripts and styles.
 */
add_action('wp_head', function () {
    ?>
    <style type="text/css">
    <?php echo file_get_contents(get_template_directory() . '/style.css'); ?>
    </style><?php
});
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('scripts', get_template_directory_uri() . '/app.js', [], null, true);
});

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

function myfeed_request($qv)
{
    if (isset($qv['feed'])) {
        $qv['post_type'] = get_post_types();
    }

    return $qv;
}

add_filter('request', 'myfeed_request');

add_shortcode('feature_boxes', function ($atts) {

    $sidebarbuttons = get_field('sidebar_buttons');
    $templateOutput = '<div class="section-wrapper support feature-boxes"><div class="columns is-multiline is-justified">';

    foreach($sidebarbuttons as $sidebar){ 
        $id = $sidebar->ID;
        $link = get_field('page_link',$id);
        $link = (strpos($link, 'anchor') !== false ? '#'.$sidebar->post_name : $link);
        $photo = get_field('photo',$id);
        $info = get_field('summary_text',$id);
    
        $templateOutput .= '<div class="column is-6 is-3-widescreen">
            <div class="card is-fullheight">
                <div class="card-image">
                    <div class="image is-4by3 is-background" style="background-image: url('.$photo['url'].');">
                    </div>
                </div>
                <div class="card-content small has-text-centered">
                    <div>
                        <h3 class="title is-semibold not-fancy">'.get_the_title($id).'</h3>
                        <p class="has-text-centered">'.$info.'</p>
                    </div>
                    <p class="has-text-centered" style="justify-self: flex-end;">
                        <a href="'.$link.'" class="button is-primary is-caps">Learn More &nbsp;<i class="fa fa-play" aria-hidden="true"></i></a>
                    </p>
                </div>
            </div>
        </div>';
        
    }

    $templateOutput .= '</div></div>';

    return $templateOutput;
});

add_shortcode('mailchimp_coupons', function ($atts) {

    $signupForm = '
    <form method="post">
        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="sec" tabindex="-1" value=""></div>
        <div class="columns is-multiline is-aligned">
            <div class="column is-12-mobile is-12-tablet is-6-desktop is-3-widescreen">
                <input type="email" value="" name="email_address" class="required email input" id="mce-EMAIL" placeholder="Email address">
            </div>
            <div class="column is-narrow">
                <button type="submit" name="subscribe" class="button is-primary is-caps" >Sign up</button>
            </div>
        </div>
    </form>
    <p>&nbsp;</p>';

    if(isset($_POST['sec']) && $_POST['sec'] == ''){
        $mailChimp = new MailChimp;

        $dataSubmitted = $_POST;

        //check to see what status of email address is in MailChimp
        $response = $mailChimp->handleSubscriber($dataSubmitted['email_address']);

        $output = '';
        $showCoupons = false;
        $showForm = false;

        $headers = [
            'User-Agent' => 'testing/1.0',
            'Accept'     => 'application/json'
        ];

        $details = [
            'email_address' => $dataSubmitted['email_address'],
            'status'        => 'subscribed'
        ];

        switch ($response) {
            case 'new':
                $message = 'Thanks for registering for Optical Shop offers from The Eye Center of North Florida! We\'ve included your coupons below. See you soon!';
                $showCoupons = true;
                $mailChimp->addSubscriber($dataSubmitted['email_address'], $options);
                break;
            case 'subscribed':
                $message = 'Thanks for registering, but you were already on our list. We\'ve included your coupons below. See you soon!';
                $showCoupons = true;
                $mailChimp->updateSubscriber($dataSubmitted['email_address'], $options);
                break;
            case 'unsubscribed':
                $message = 'Glad to see you back. Since you have activated your registration once more, we\'ve included your coupons below.';
                $showCoupons = true;
                $mailChimp->updateSubscriber($dataSubmitted['email_address'], $options);
                break;
            case 'cleaned':
                $message = 'Glad to see you back, but the provided email address has been purged from our records due to delivery issues. Consider using a different email address.';
                $showForm = true;
                break;
            case 'pending':
                $message = 'Your registration is still pending activation. Check your email for the verification link. While you wait, we\'ve included our coupons below.';
                $showCoupons = true;
                break;
            default:
                $mailChimp->updateSubscriber($dataSubmitted['email_address'], $options);
                $showCoupons = true;
                $message = 'Thanks for subscribing!';
            }

        $output .= '
        <div class="message">
            <div class="message-body">
                <p style="margin:0;">'.$message.'</p>
            </div>
        </div>
        ';

        if($showForm){
            $output .= $signupForm;
        }

        if($showCoupons){
            $output .= '
            <div class="columns is-multiline is-aligned">
                <div class="column is-6-tablet is-4-desktop"> 
                    <div class="card" >
                        <div class="card-image">
                            <figure class="image" style="margin:0">
                                <img src="https://www.eyecarenow.com/wp-content/uploads/EyeCenter_20-Off-Web-Coupon.jpg" alt="Use coupon code: MKT 20">
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="column is-6-tablet is-4-desktop"> 
                    <div class="card" >
                        <div class="card-image">
                            <figure class="image" style="margin:0">
                                <img src="https://www.eyecarenow.com/wp-content/uploads/EyeCenter_50d-Off-Web-Coupon.jpg" alt="Use coupon code: MKT 50">
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="column is-6-tablet is-4-desktop"> 
                    <div class="card" >
                        <div class="card-image">
                            <figure class="image" style="margin:0">
                                <img src="https://www.eyecarenow.com/wp-content/uploads/EyeCenter_BOGO-Web-Coupon.jpg" alt="Use coupon code: MKT BOGO">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <p>&nbsp;</p>
            ';
        }

    }else{
        $output = '<p>Sign up to receive our limited-time Optical Shop offers!</p>' . $signupForm;
    }

    return $output;
});