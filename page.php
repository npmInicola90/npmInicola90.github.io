<?php
/**
 * Custom Page Template
 *
 * @package tutor
 * @since 1.0
 *
 */

get_header();
$site_type      = cs_get_option( 'site_type' );
$hide_sidebar   = cs_get_option( 'show_sidebar');
$favorite_page  = apply_filters( 'tutor_favorite_page', cs_get_option( 'favorite_page' ) );

$page_id = get_the_ID();
$current_page = false;
if( ( is_array( $favorite_page ) && in_array( $page_id, $favorite_page ) ) || is_front_page() ) {
    $current_page = true;
}


// show/hide sidebar
$base_column = 'col-md-8';
if ( $hide_sidebar === true ) {
    $base_column = 'col-md-12';
}

if ( $site_type == 'onepage' && $current_page ) {

    $order_by = cs_get_option( 'order_by' );
    $order    = cs_get_option( 'order' );

    // for onepage
    if( ! count( $favorite_page ) ) {
        $favorite_page = array();
    } 
    $args = array(
        'post_type'      => 'page',
        'post__in'       => $favorite_page,
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'order'          => ( ! empty( $order ) ) ? $order : 'ASC',
        'orderby'        => ( ! empty( $order_by ) ) ? $order_by : 'menu_order'
    );

    $q = new WP_Query( $args );

    // Start the loop.
    if ( $q->have_posts() ) {

        while ( $q->have_posts() ) {

            $q->the_post();

            $content = get_the_content();

            if( stristr( $content, 'vc_' ) && class_exists( 'Vc_Manager' ) && class_exists( 'tutor_Plugins' ) ) { ?>

                <div id="<?php echo esc_attr( $post->post_name ); ?>" class="container">
                    <?php the_content(); ?>
                </div>

            <?php }
            // End the loop.
        } // end while;
    } // end if

} else {

    // for multipage
    // Start the loop.
    while ( have_posts() ) {
        the_post();
        
        $content = get_the_content(); 

        if ( stristr( $content, 'vc_' ) && class_exists( 'Vc_Manager' ) ) { ?>

            <div class="container page-container page-wrap">
                <?php the_content(); ?>
            </div>

        <?php } else { ?>
            <div class="wp-inner-content no_vc page-wrap"> 
                <div id="post-<?php echo esc_attr( $post->ID ); ?>" <?php post_class('container single-page'); ?>>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <?php the_title( '<h1 class="block-title">', '</h1>' ); ?>
                            </div>
                        </div>
                        <?php if ( has_post_thumbnail() ) { ?>
                            <!-- Page thumbnail -->
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="wrapper-image">
                                        <?php the_post_thumbnail( 'large', array( 'class' => 's-img-switch', 'data-s-hidden'=> '1' ) ); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Page thumbnail -->
                        <?php } ?>
                        <div class="row post-content">
                            <div class="content <?php echo esc_attr( $base_column ); ?>">
                                <?php

                                    // content
                                    the_content();

                                    wp_link_pages('link_before=<span class="pages">&link_after=</span>&before=<div class="post-nav"> <span>' . esc_html__( "Page:", 'tutorpro' ) . ' </span> &after=</div>'); ?>

                                    <div class="single-category">
                                        <?php the_category(''); ?>
                                    </div>

                                <?php

                                    // If comments are open or we have at least one comment, load up the comment template.
                                    if ( comments_open() || get_comments_number() ) :
                                        comments_template();
                                    endif;
                                    ?>
                            </div>
                            <?php if( ! $hide_sidebar ) { ?>
                                <div class="col-md-4">
                                    <?php get_sidebar(); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div><!-- .container -->
            </div>
            <?php
        } 
    } // End the loop.
}


get_footer();