<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package avenue
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php wp_title('|', true, 'right'); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <div id="page" class="hfeed site">
            <header id="masthead" class="site-header" role="banner">
                <?php sc_toolbar(); ?>
                <div class="site-branding">
<<<<<<< HEAD
                    <div class="row <?php echo of_get_option('sc_container_width'); ?>"> 
                        <div class="col-xs-6">
                            <h1 class="site-title">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php if (of_get_option('sc_logo_image') != '') { ?>
                                        <img src="<?php echo of_get_option('sc_logo_image'); ?>" alt="" id="sc_logo"/>
                                        <?php
                                    } else {
                                        bloginfo('name');
                                    }
                                    ?>                                        
                                </a>
                            </h1>
                            <?php if (of_get_option('sc_logo_image') == '') { ?>
                                <h2 class="site-description"><?php bloginfo('description'); ?></h2>
                            <?php } ?>

                        </div>
                        <div class="col-xs-6 search-bar">
                            <!-- header right -->
                            <?php get_sidebar('header-right'); ?>
=======
                    <div class="row <?php echo of_get_option('sc_container_width'); ?>">
                        <div class="col-md-12">
                            <div class="col-xs-6">
                                <h1 class="site-title">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                        <?php if (of_get_option('sc_logo_image') != '') { ?>
                                            <img src="<?php echo of_get_option('sc_logo_image'); ?>" alt="" id="sc_logo"/>
                                        <?php
                                        } else {
                                            bloginfo('name');
                                        }
                                        ?>                                        
                                    </a>
                                </h1>
                                <?php if (of_get_option('sc_logo_image') == '') { ?>
                                    <h2 class="site-description"><?php bloginfo('description'); ?></h2>
                                <?php } ?>

                            </div>
                            <div class="col-xs-6 search-bar">
                                <!-- header right -->
                                <?php get_sidebar('header-right'); ?>
                            </div>
>>>>>>> 4ca6086ee6386f8a4e7674a64b2b2dac871d17d8
                        </div>
                    </div>
                </div>
                <nav id="site-navigation" class="main-navigation" role="navigation">
                    <div class="row <?php echo of_get_option('sc_container_width'); ?>">
<<<<<<< HEAD
                        <button class="menu-toggle"><?php _e('Primary Menu', 'avenue'); ?></button>
                        <a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'avenue'); ?></a>
                        <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
=======
                        <div class="col-md-12">
                            <button class="menu-toggle"><?php _e('Primary Menu', 'avenue'); ?></button>
                            <a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'avenue'); ?></a>
                            <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
                        </div>
>>>>>>> 4ca6086ee6386f8a4e7674a64b2b2dac871d17d8
                    </div>
                </nav><!-- #site-navigation -->
            </header><!-- #masthead -->


