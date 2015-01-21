<?php
/**
 * The Template for displaying all single posts.
 *
 * @package avenue
 */
get_header();
?>

<div id="content" class="site-content">
    <?php while (have_posts()) : the_post(); ?>
        <div class="col-md-12">
            <div class="page-title single-title">
                <div class="row text-left <?php echo of_get_option('sc_container_width'); ?>">
                    <?php the_title(); ?>
                </div>
            </div>
            <div class="page-content row <?php echo of_get_option('sc_container_width'); ?>">
<<<<<<< HEAD
                <div class="col-md-9 item-page <?php echo of_get_option('sc_single_layout'); ?>">
                    <?php
                    'on' == of_get_option('sc_single_featured', 'on') ? the_post_thumbnail('medium') : '';
                    the_content();
                    echo 'on' == of_get_option('sc_single_date', 'on') ? 'Posted on: ' .  esc_html( get_the_date() ) : '';
                    echo 'on' == of_get_option('sc_single_author', 'on') ? ', by : ' . esc_attr(get_the_author() ) : '';                    
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . __('Pages:', 'avenue'),
                        'after' => '</div>',
                    ));
                    // If comments are open or we have at least one comment, load up the comment template
                    if (comments_open() || '0' != get_comments_number()) :
                        comments_template();
                    endif;
                    ?>
                </div>
                <?php if( 'col2r' == of_get_option('sc_single_layout', 'col2r')) : ?>
                <div class="col-md-3 avenue-sidebar">
                    <?php get_sidebar(); ?>
                </div>
                <?php endif; ?>
=======
                <div class="col-md-12">
                    <div class="col-md-9">
                        <?php
                        the_post_thumbnail('medium');
                        the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'avenue' ),
				'after'  => '</div>',
			) );                        
                        // If comments are open or we have at least one comment, load up the comment template
                        if (comments_open() || '0' != get_comments_number()) :
                            comments_template();
                        endif;
                        ?>
                    </div>
                    <div class="col-md-3 avenue-sidebar">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
>>>>>>> 4ca6086ee6386f8a4e7674a64b2b2dac871d17d8
            </div>
        </div>
    <?php endwhile; // end of the loop. ?>

</div><!-- #primary -->
<<<<<<< HEAD
=======

<?php get_sidebar(); ?>
>>>>>>> 4ca6086ee6386f8a4e7674a64b2b2dac871d17d8
<?php get_footer(); ?>