<?php
/**
 *
 * The Header for our theme
 * @since 1.0.0
 * @version 1.0.0
 *
 */

$header_data = get_post_meta( get_the_ID(), '_custom_page_options', true );
if(cs_get_option('favicon')) {
    $favicon = wp_get_attachment_image_url( cs_get_option('favicon'), 'full'); 
} 
else {
    $favicon = LX_URI.'/assets/images/favicon.png';
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no" />
    <link rel="shortcut icon" href="<?php echo esc_attr( $favicon ); ?>" >
    <?php wp_head(); ?>
</head>
<?php
    $width_header = (cs_get_option('width_header')=='full') ? 'container-fluid' : 'container';

    $witoutPluginClass = '';
    if ( !class_exists('tutor_Plugins') ) {
        $witoutPluginClass = 'no-plugin-lx-post';
    }
?>

<body <?php body_class(); ?>>
<!--==========HEADER============-->

<?php if(cs_get_option('preloader')=="show") { ?>
    <div class="lx-preloader"></div>
<?php }

    if(cs_get_option('header_blog') && is_home()) {
        $header_blog=cs_get_option('header_blog');
    } else {
        $header_blog="";
    }
?>

<header class="lx-header <?php echo esc_attr( $header_blog . ' ' . $witoutPluginClass ); echo (!has_nav_menu( 'primary-menu' ))? ' no-register-menu': '';  ?>">
    <?php do_action('tutor_before_header'); ?>
    <div class="<?php echo esc_attr($width_header) ?> no-padd-h">
            <?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
                <div class="lx-btn-menu hidden-md hidden-lg">
                    <i class="burger-button"></i>
                </div>
            <?php } ?>
            <div class="lx-logo">
                <a href="<?php echo home_url( '/' );?>">
                    <?php tutor_logo(); ?>
                </a>
            </div>
            <nav class="lx-main-menu">
                <?php tutor_custom_menu(); ?>
            </nav>
        </div>
</header>
<?php do_action('tutor_after_header'); ?>
