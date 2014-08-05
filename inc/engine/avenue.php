<?php
/* 
 * Avenue Go
 */

function avenue_scripts() {
    wp_enqueue_style('avenue-style', get_stylesheet_uri());
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.css', array(), SC_AVENUE_VERSION);
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/inc/css/font-awesome.min.css', array(), SC_AVENUE_VERSION);
    wp_enqueue_style('avenue-main-style', get_template_directory_uri() . '/inc/css/style.css', array(), SC_AVENUE_VERSION);
    if('Source Sans Pro, sans-serif' == of_get_option('sc_font_family')) 
        wp_enqueue_style('avenue-font-sans', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600', array(), SC_AVENUE_VERSION);
    if('Lato, sans-serif' == of_get_option('sc_font_family')) 
        wp_enqueue_style('avenue-font-lato', 'http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,300italic,400italic', array(), SC_AVENUE_VERSION);
    
    wp_enqueue_style('avenue-template', get_template_directory_uri() . '/inc/css/temps/' . of_get_option('sc_theme_color', 'orange') . '.css', array(), SC_AVENUE_VERSION);
    wp_enqueue_style('avenue-slider-style', get_template_directory_uri() . '/inc/css/camera.css', array(), SC_AVENUE_VERSION);


    wp_enqueue_script('avenue-navigation', get_template_directory_uri() . '/js/navigation.js', array(), SC_AVENUE_VERSION, true);
    wp_enqueue_script('avenue-bootstrapjs', get_template_directory_uri() . '/inc/js/bootstrap.js', array(), SC_AVENUE_VERSION, true);
    wp_enqueue_script('avenue-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), SC_AVENUE_VERSION, true);

    wp_enqueue_script('avenue-easing', get_template_directory_uri() . '/inc/js/jquery.easing.1.3.js', array(), SC_AVENUE_VERSION, true);
    wp_enqueue_script('avenue-uslider', get_template_directory_uri() . '/inc/js/camera.js', array(), SC_AVENUE_VERSION, true);

    wp_enqueue_script('avenue-script', get_template_directory_uri() . '/inc/js/script.js', array('jquery', 'jquery-ui-core'), SC_AVENUE_VERSION);


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'avenue_scripts');


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function avenue_widgets_init() {

    register_sidebar(array(
        'name' => __('Header Right', 'avenue'),
        'id' => 'sidebar-header-right',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="' . of_get_option('sc_footer_columns') . ' widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="hidden">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Fullwidth Banner', 'avenue'),
        'id' => 'sidebar-banner',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Sidebar', 'avenue'),
        'id' => 'sidebar-1',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));

    register_sidebar(array(
        'name' => __('Homepage Sidebar', 'avenue'),
        'id' => 'sidebar-homepage',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));

    register_sidebar(array(
        'name' => __('Footer', 'avenue'),
        'id' => 'sidebar-footer',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="' . of_get_option('sc_footer_columns') . ' widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));
}
add_action('widgets_init', 'avenue_widgets_init');


add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>
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
        .sc-slider ul li{
            background-size: <?php echo of_get_option('sc_slider_style'); ?>;
            -webkit-background-size: <?php echo of_get_option('sc_slider_style'); ?>;
            -moz-background-size: <?php echo of_get_option('sc_slider_style'); ?>;
        }
    </style>
    <?php
}

class sc_recent_posts_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'sc_recent_posts_widget', __('Avenue Recent Articles', 'sc_recent_posts_widget_domain'), array('description' => __('Use this widget to display the Our Team anywhere on the site.', 'sc_recent_posts_widget_domain'),)
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];

        // This is where you run the code and display the output
//        include 'inc/widget.php';
        avenue_recent_posts();

    }

    // Widget Backend
    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Recent Articles', 'sc_recent_posts_widget_domain');
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />             
        </p>
        <?php
    }

    // Updating widget replacing old instances with new
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

}

// Class sc_recent_posts_widget ends here
// Register and load the widget
function sc_avenue_load_widget() {
    register_widget('sc_recent_posts_widget');
}

add_action('widgets_init', 'sc_avenue_load_widget');

function avenue_recent_posts() {
    $args = array(
        'numberposts' => '4',
        'post_status' => 'publish'
    );
    ?>
    <div id="sc_avenue_recent_posts">
        <?php $recent_posts = wp_get_recent_posts($args);
        foreach ($recent_posts as $post) { ?>
            <div class="col-sm-3">
                <div>
                    <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post['ID'])); ?>
                    <img src="<?php echo $url; ?> " title="<?php echo $post['post_title']; ?>"/>
                    <div class="overlay">
                        <a href="<?php echo get_permalink($post['ID']) ?>" class="title">
                            <?php echo $post['post_title']; ?>
                        </a>
                        <?php // $date = new DateTime($post['post_date']); ?>
                        <div class="date">
                            <i class="fa fa-calendar"></i>
                            <?php echo date('M d', strtotime($post['post_date'])); ?>
                        </div>
                        <div class="author">
                            <i class="fa fa-pencil"></i>
                            <?php echo get_userdata($post['post_author'])->user_login; ?>
                        </div>
                        
                    </div>
                </div>
            </div>
    <?php } ?>
    </div>
<?php
}
function sc_slider() { ?>
<script>
    jQuery(document).ready(function($){
        jQuery('#camera_wrap_1').camera({
            height: '400px',
            loader: 'pie',
            pagination: false,
            thumbnails: false,
            fx: 'simpleFade',
            time: 4000,
            overlayer: true,
        });            
    });

</script>
    <div class="sc-slider-wrapper">
	<div class="fluid_container">
        <div class="camera_wrap" id="camera_wrap_1">

                <?php if ('' != of_get_option('sc_slide1_image', get_template_directory_uri() . '/images/demo-orange.png')) { ?>
                    <div data-thumb="<?php echo of_get_option('sc_slide1_image', get_template_directory_uri() . '/images/demo-orange.png') ?>" data-src="<?php echo of_get_option('sc_slide1_image', get_template_directory_uri() . '/images/demo-orange.png') ?>">
                        <div class="camera_caption fadeFromBottom">
                            <?php echo of_get_option('sc_slide1_text','Clean & Modern Design');?>
                        </div>
                    </div>
                <?php } ?>            
            
                <?php if ('' != of_get_option('sc_slide2_image', get_template_directory_uri() . '/images/demo-orange.png')) { ?>
                      <div data-thumb="<?php echo of_get_option('sc_slide2_image', get_template_directory_uri() . '/images/demo-orange.png') ?>" data-src="<?php echo of_get_option('sc_slide2_image', get_template_directory_uri() . '/images/demo-orange.png') ?>">
                        <div class="camera_caption fadeFromBottom">
                            <?php echo of_get_option('sc_slide2_text','Clean & Modern Design');?>
                        </div>
                    </div>
                <?php } ?>   
            
                <?php if ('' != of_get_option('sc_slide3_image', get_template_directory_uri() . '/images/demo-orange.png')) { ?>     
                    <div data-thumb="<?php echo of_get_option('sc_slide3_image', get_template_directory_uri() . '/images/demo-orange.png') ?>" data-src="<?php echo of_get_option('sc_slide3_image', get_template_directory_uri() . '/images/demo-orange.png') ?>">
                        <div class="camera_caption fadeFromBottom">
                            <?php echo of_get_option('sc_slide3_text','Clean & Modern Design');?>
                        </div>
                    </div>
                <?php } ?>      
        </div><!-- #camera_wrap_1 -->
        </div>
    </div>
    <?php
}

function sc_ctas() {
    ?>
    <div id="site-cta" class="row <?php echo of_get_option('sc_container_width'); ?>"><!-- #CTA boxes -->
        <div class="col-md-12">
            <div class="col-md-4 site-cta">
                <div class="col-md-2">
                    <i class="<?php echo of_get_option('sc_cta1_icon', 'fa fa-desktop'); ?>"></i>
                </div>
                <div class="col-md-10">
                    <div>
                        <h3><?php echo of_get_option('sc_cta1_title', 'Box 1 Title') ?></h3>
                        <p>
                            <?php echo of_get_option('sc_cta1_text', 'Box 1 Text. Input anything you want here'); ?>
                        </p>
                        <p class="text-right">
                            <a href="<?php echo of_get_option('sc_cta1_url') ?>" class="btn btn-default btn-primary">Click Here</a>
                        </p>                                
                    </div>                            
                </div>
            </div>
            <div class="col-md-4 site-cta">
                <div class="col-md-2">
                    <i class="<?php echo of_get_option('sc_cta2_icon', 'fa fa-tachometer'); ?>"></i>
                </div>
                <div class="col-md-10">
                    <div>
                        <h3><?php echo of_get_option('sc_cta2_title', 'Box 2 Title') ?></h3>
                        <p>
                            <?php echo of_get_option('sc_cta2_text', 'Box 2 Text. Input anything you want here'); ?>
                        </p>
                        <p class="text-right">
                            <a href="<?php echo of_get_option('sc_cta2_url') ?>" class="btn btn-default btn-primary">Click Here</a>
                        </p>                                
                    </div>                            
                </div>
            </div>
            <div class="col-md-4 site-cta">
                <div class="col-md-2">
                    <i class="<?php echo of_get_option('sc_cta3_icon', 'fa fa-rocket'); ?>"></i>
                </div>
                <div class="col-md-10">
                    <div>
                        <h3><?php echo of_get_option('sc_cta3_title', 'Box 3 Title') ?></h3>
                        <p>
                            <?php echo of_get_option('sc_cta3_text', 'Box 3 Text. Input anything you want here') ?>
                        </p>
                        <p class="text-right">
                            <a href="<?php echo of_get_option('sc_cta3_url') ?>" class="btn btn-default btn-primary">Click Here</a>
                        </p>
                    </div>                            
                </div>
            </div>
        </div>
    </div><!-- #CTA boxes -->
    <div class="clear"></div>
    <?php
}

function sc_banner() {
    ?>
    <div id="top-banner" class="full-banner col-md-12">
        <div class="row <?php echo of_get_option('sc_container_width'); ?>">
            <div class="col-md-12 center">
                <div class="top-banner-text">
                    <?php get_sidebar('banner'); ?>
                    <!--<span class="primary-color"><?php echo of_get_option('sc_banner_text', 'Banner Call Out Text'); ?></span>-->
                </div>
<!--                <p>
                    <a href="<?php echo of_get_option('sc_banner_url'); ?>" class="btn btn-default btn-primary"><?php echo of_get_option('sc_banner_button_text', 'Learn More'); ?></a>
                </p>-->
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <?php
}

function sc_toolbar() {
    if ('no' != of_get_option('sc_headerbar_bool', 'yes')) {
        ?>
        <div id="site-toolbar">
            <div class="row <?php echo of_get_option('sc_container_width'); ?>">
                <div class="col-md-12">
                    <div class="col-xs-6 contact-bar">
                        <?php if ('' != of_get_option('sc_phone_url')) { ?>
                            <a href="tel:+<?php echo of_get_option('sc_phone_url'); ?>" class="icon-phone">
                                <i class="fa fa-phone"></i>
                                <span><?php echo of_get_option('sc_phone_url'); ?></span>
                            </a>
                        <?php } ?>

                        <?php if ('' != of_get_option('sc_address_url')) { ?>
                            <a href="#" class="icon-map">
                                <i class="fa fa-map-marker"></i>
                                <span><?php echo of_get_option('sc_address_url') ?></span>
                            </a>
                        <?php } ?>


                    </div>

                    <div class="col-xs-6 social-bar">

                        <?php if ('' != of_get_option('sc_facebook_url')) { ?>
                            <a href="<?php echo of_get_option('sc_facebook_url') ?>" target="_blank" class="icon-facebook">
                                <i class="fa fa-facebook"></i>
                            </a>
                        <?php } ?>

                        <?php if ('' != of_get_option('sc_twitter_url')) { ?>
                            <a href="<?php echo of_get_option('sc_twitter_url') ?>" target="_blank" class="icon-twitter">
                                <i class="fa fa-twitter"></i>                            
                            </a>
                        <?php } ?>


                        <?php if ('' != of_get_option('sc_linkedin_url')) { ?>
                            <a href="<?php echo of_get_option('sc_linkedin_url') ?>" target="_blank" class="icon-linkedin">
                                <i class="fa fa-linkedin"></i>                            
                            </a>
                        <?php } ?>


                        <?php if ('' != of_get_option('sc_gplus_url')) { ?>
                            <a href="<?php echo of_get_option('sc_gplus_url') ?>" target="_blank" class="icon-gplus">
                                <i class="fa fa-google-plus"></i>                            
                            </a>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

function sc_footer() {
    echo of_get_option('sc_footer_text');?>
    <br>
    <!-- Before you delete the link, please make a donation! Links & donations are the only way i get credit for the days it took to make this theme -->
    <a href="http://smartcatdesign.net/" rel="designer">Design by SmartCat</a>
<?php }