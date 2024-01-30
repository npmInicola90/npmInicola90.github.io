<?php
    if ( ! is_active_sidebar( 'sidebar' ) ) {
        return;
    }
    $sidebar_width_class = '';
    if(is_single()) {
       $sidebar_width_class = (is_active_sidebar( 'sidebar' ) && (!function_exists( 'cs_framework_init' )  || cs_get_option('single_sidebar')=='yes')) ? 'col-sm-12 col-md-3' : ''; 
    }
    if(is_home()) {
        $sidebar_width_class = !function_exists('cs_framework_init') || cs_get_option('blog_sidebar') ? 'col-sm-12 col-md-3' : '';
    }
?>

<aside class="<?php echo esc_attr( $sidebar_width_class ); ?> sidebar">
    <?php dynamic_sidebar( 'sidebar' ); ?>
</aside><!-- #secondary -->