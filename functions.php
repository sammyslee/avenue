<?php
/**
 * avenue functions and definitions
 *
 * @package avenue
 */

if (!function_exists('avenue_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function avenue_setup() {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on avenue, use a find and replace
         * to change 'avenue' to the name of your theme in all the template files
         */    
        if (!isset($content_width)) {
            global $content_width;
            $content_width = 1060;
        }

        define('SC_AVENUE_VERSION', '1.0.6');
        /**
         * Set the content width based on the theme's design and stylesheet.
         */
        load_theme_textdomain('avenue', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        //add_theme_support( 'post-thumbnails' );
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'avenue'),
        ));

        // Enable support for Post Formats.
        add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));

        // Setup the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('avenue_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Enable support for HTML5 markup.
        add_theme_support('html5', array(
            'comment-list',
            'search-form',
            'comment-form',
            'gallery',
            'caption',
        ));
    }

endif; // avenue_setup
add_action('after_setup_theme', 'avenue_setup');

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function avenue_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'avenue'),
        'id' => 'sidebar-1',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));
}

add_action('widgets_init', 'avenue_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function avenue_scripts() {
    wp_enqueue_style('avenue-style', get_stylesheet_uri());
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.css', array(), SC_AVENUE_VERSION);
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/inc/css/font-awesome.min.css', array(), SC_AVENUE_VERSION);
    wp_enqueue_style('avenue-main-style', get_template_directory_uri() . '/inc/css/style.css', array(), SC_AVENUE_VERSION);
    wp_enqueue_style('avenue-font', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600)', array(), SC_AVENUE_VERSION);
    wp_enqueue_style('avenue-template', get_template_directory_uri() . '/inc/css/temps/' . of_get_option('sc_theme_color','orange') . '.css', array(), SC_AVENUE_VERSION);



    wp_enqueue_script('avenue-navigation', get_template_directory_uri() . '/js/navigation.js', array(), SC_AVENUE_VERSION, true);
    wp_enqueue_script('avenue-bootstrapjs', get_template_directory_uri() . '/inc/js/bootstrap.js', array(), SC_AVENUE_VERSION, true);
    wp_enqueue_script('avenue-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), SC_AVENUE_VERSION, true);


    wp_enqueue_script('avenue-uslider', get_template_directory_uri() . '/inc/js/uslider.min.js', array(), SC_AVENUE_VERSION, true);

    wp_enqueue_script('avenue-script', get_template_directory_uri() . '/inc/js/script.js', array('jquery', 'jquery-ui-core'), SC_AVENUE_VERSION);


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'avenue_scripts');

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

define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/');
require_once dirname(__FILE__) . '/inc/options-framework.php';

/*
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 *
 * You can delete it if you not using that option
 */
add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() {
    ?>

    <script type="text/javascript">
        jQuery(document).ready(function() {

            jQuery('#example_showhidden').click(function() {
                jQuery('#section-example_text_hidden').fadeToggle(400);
            });

            if (jQuery('#example_showhidden:checked').val() !== undefined) {
                jQuery('#section-example_text_hidden').show();
            }

        });
    </script>

    <?php
}

add_action('wp_head', 'sc_avenue_css');

function sc_avenue_css() {
    ?>
    <style type="text/css">
        body{
            font-size: <?php echo of_get_option('sc_font_size'); ?>;
            font-family: <?php echo of_get_option('sc_font_family'); ?>;
        }
        .row{
            /*width: <?php echo of_get_option('sc_container_width'); ?>;*/
        }
    </style>
<?php
}

//add_action( 'admin_head', 'spacious_favicon' );
//add_action( 'wp_head', 'spacious_favicon' );
///**
// * Fav icon for the site
// */
//function spacious_favicon() {
//	if ( of_get_option( 'spacious_activate_favicon', '0' ) == '1' ) {
//		$spacious_favicon = of_get_option( 'spacious_favicon', '' );
//		$spacious_favicon_output = '';
//		if ( !empty( $spacious_favicon ) ) {
//			$spacious_favicon_output .= '<link rel="shortcut icon" href="'.esc_url( $spacious_favicon ).'" type="image/x-icon" />';
//		}
//		echo $spacious_favicon_output;
//	}
//}