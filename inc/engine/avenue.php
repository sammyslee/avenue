<?php
/* 
 * Avenue Go
 */

function avenue_scripts() {
    wp_enqueue_style('avenue-style', get_stylesheet_uri());
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.css', array(), SC_AVENUE_VERSION);
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/inc/css/font-awesome.min.css', array(), SC_AVENUE_VERSION);
    wp_enqueue_style('avenue-main-style', get_template_directory_uri() . '/inc/css/style.css', array(), SC_AVENUE_VERSION);
    wp_enqueue_style('avenue-font', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600)', array(), SC_AVENUE_VERSION);
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
        'name' => __('Left Sidebar', 'avenue'),
        'id' => 'sidebar-left',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));

    register_sidebar(array(
        'name' => __('Right Sidebar', 'avenue'),
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
        //        echo $args['after_title'];
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
            
            <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of posts:'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>">
                <option value="<?php echo esc_attr($title); ?>" >4</option>
                <option>8</option>
                <option>12</option>
            </select>
             
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
        'numberposts' => '6',
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
