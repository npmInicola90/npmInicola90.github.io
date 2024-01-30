<?php
/**
 * Index Page
 *
 * @package tutor
 * @since 1.0
 *
 */
get_header();

// Banner img
$baner_img    = cs_get_option('bg_blog_banner');
$empty_banner = ( ! empty( $baner_img ) ) ? '' : 'empty-banner';

$witoutPluginClass = '';

if ( ! class_exists('tutor_Plugins') ) {
    $witoutPluginClass = 'no-plugin-lx';
}

// width blog
$blog_size      = cs_get_option('width_blog');
$blog_size_item = ( class_exists('tutor_Plugins') && isset( $blog_size ) && $blog_size == 'three_col' ) ? $blog_size : 'three_col';

if ( $blog_size_item == 'two_col' ) {
    $width_blog = "col-sm-6 col-xs-12";
} elseif ( $blog_size_item == 'three_col' ) {
    $width_blog = "no-padd-xs col-md-4 col-sm-6 col-xs-12";
} else {
    $width_blog = "col-xs-12";
}

// Style blog
$style_blog       = cs_get_option('style_blog');
$style_blog_wrapp = ( isset( $style_blog ) && $style_blog === 'tutor' ) ? 'post-page--tutor' : '';

$content_width_class = ( is_active_sidebar( 'sidebar' ) && !is_search() && (!function_exists('cs_framework_init') || cs_get_option('blog_sidebar')) ) ? 'col-sm-12 col-md-9' : 'col-sm-12'; ?>

<div class="blog posts-page <?php echo esc_attr( $style_blog_wrapp . ' ' . $empty_banner ); ?>">

    <?php if ( ! empty( $baner_img ) && cs_get_option('banner_blog')=='show' ) : ?>
        <?php get_template_part( 'template-parts/banner'); ?>
    <?php endif; ?>

    <div class="container blog-main-page simple-article-block <?php echo esc_attr($witoutPluginClass); echo (cs_get_option('banner_blog')=='hide')? 'no-banner' : ''; ?>">
        <div class="row">
            <div class="<?php echo esc_attr($content_width_class); ?>">
                <div class="lx-blog">
                    <?php if (have_posts()) : ?>
                    <?php 
                        $i = 0;
                        while (have_posts()) : the_post();

                    ?>
                        <div <?php post_class($width_blog); ?>>
                            <?php get_template_part( 'template-parts/content'); ?>
                        </div>
                    <?php 
                        $i++;
                        // for desktop
                        if($i%3==0) {
                            echo '<div class="clearfix hidden-sm hidden-xs"></div>';
                        } 
                        // for tablets
                        if($i%2==0) {
                            echo '<div class="clearfix visible-sm"></div>';
                        } 
                        endwhile; 
                    ?>
                    <div class="col-xs-12">
                        <?php
                        $paginate_links = paginate_links(array('prev_text' => '', 'next_text' => ''));
                        if ((!empty($paginate_links) && cs_get_option('pager') == "show") || !class_exists('CSFramework')) { ?>
                            <div id="pager text-center" class="pager">
                                <?php echo wp_kses_post($paginate_links); ?>
                            </div>
                        <?php } ?>
                        <?php else : ?>
                            <div id="empty-search-result">
                                <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'tutorpro'); ?></p>
                                <?php get_search_form(true); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if (cs_get_option('blog_sidebar') || !class_exists('CSFramework') && !is_search()) { 
                get_sidebar();
            } ?>
        </div>

    </div>

    <?php get_template_part( 'template-parts/form'); ?>
</div>

<?php get_footer();
