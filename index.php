<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package avenue
 */
get_header();
?>

<div id="content" class="site-content row blogroll <?php echo of_get_option('sc_container_width'); ?>">
<<<<<<< HEAD
    <div class="col-md-9 site-content item-page <?php echo of_get_option('sc_blog_layout'); ?>">
=======
    <div class="col-md-9">
>>>>>>> 4ca6086ee6386f8a4e7674a64b2b2dac871d17d8
        <?php if (have_posts()) : ?>
            <?php /* Start the Loop */ ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="item-post col-md-12">
<<<<<<< HEAD
                    <?php if( 'on' == of_get_option('sc_blog_featured', 'on')) : ?>
                        <div class="post-thumb col-sm-4">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('large'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="col-sm-8 <?php echo 'on' == of_get_option('sc_blog_featured', 'on') ? '' : 'featured_none'; ?>">
=======
                    <div class="post-thumb col-md-4">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('large'); ?>
                        </a>
                    </div>
                    <div class="col-md-8">
>>>>>>> 4ca6086ee6386f8a4e7674a64b2b2dac871d17d8
                        <h2 class="post-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        <div class="post-content">
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="text-right">
                            <a class="btn btn-default btn-primary" href="<?php the_permalink(); ?>">Read More</a>
                        </div>                        
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <?php get_template_part('content', 'none'); ?>
        <?php endif; ?>
    </div>
<<<<<<< HEAD
    
    <?php if( 'col2r' == of_get_option('sc_blog_layout', 'col2r')) : ?>
        <div class="col-md-3 avenue-sidebar">
            <?php get_sidebar(); ?>
        </div>
    <?php endif; ?>
    
=======
    <div class="col-md-3">
        <?php get_sidebar(); ?>
    </div>
>>>>>>> 4ca6086ee6386f8a4e7674a64b2b2dac871d17d8
    <div class="col-md-12">
        <?php avenue_paging_nav(); ?>
    </div>

</div>

<?php get_footer(); ?>
