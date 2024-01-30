<?php
/**
* Single post
*
* @package tutor
* @since 1.0
*
*/
get_header();

$content_width_class = !function_exists( 'cs_framework_init' )  || cs_get_option('single_sidebar') ? 'col-sm-12 col-md-9' : 'col-sm-12';
$sidebar_width_class = !function_exists( 'cs_framework_init' )  || cs_get_option('single_sidebar') ? 'col-sm-12 col-md-3' : '';


if ( !class_exists('tutor_Plugins') ) {
    $witoutPluginClass = 'no-plugin-lx-post';
}

?>

<?php while ( have_posts() ) : the_post(); ?>


    <?php get_template_part( 'template-parts/banner-single'); ?>

    <div class="container single-posts <?php  echo esc_attr(tutorpro_without_plugin()); ?>">
    	<div class="row">
        	<div class="post-block-article posts-wrapper <?php echo esc_attr( $content_width_class ); ?>">
                <?php 
                get_template_part( 'template-parts/content-single'); 

                if ( comments_open() || get_comments_number()) { ?>
                    <div class="comment-widget">
                        <?php if( comments_open( $post->ID )  || get_comments_number()) { ?>
                            <?php echo comments_template(); ?>
                        <?php } ?>
                    </div>

                <?php } ?>
                <?php if( !function_exists( 'cs_framework_init' ) || cs_get_option('post_navigation') ) { ?>
                    <div class="single-post-navigation clearfix">
                        <?php
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();

                        if ( ! empty( $prev_post ) ) : ?>
                            <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="prev">
                                <i class="fa fa-angle-left" aria-hidden="true"></i><?php esc_html_e('Prev', 'tutorpro'); ?>
                            </a>
                        <?php endif;

                        if ( ! empty( $next_post ) ) : ?>
                            <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="next">
                                <?php esc_html_e('Next', 'tutorpro'); ?><i class="fa fa-angle-right" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php } ?>
            </div>
            <?php if(!function_exists( 'cs_framework_init' ) || cs_get_option('single_sidebar')=='yes' ) { 
                get_sidebar();
            } ?>
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer();