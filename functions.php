<?php
/**
 * The template includes necessary functions for theme.
 *
 * @package tutor
 * @since 1.0.0
 */

if ( ! isset( $content_width ) ) {
    $content_width = 1200; /* pixels */
}

defined( 'LX_URI' )  or define( 'LX_URI',  get_template_directory_uri() );
defined( 'T_PATH' ) or define( 'T_PATH', get_template_directory() );
defined( 'F_PATH' ) or define( 'F_PATH', T_PATH . '/inc' ); 


// Framework integration
// ----------------------------------------------------------------------------------------------------
require_once F_PATH . '/custom/actions-config.php';
require_once F_PATH . '/customizer.php';
require_once F_PATH . '/custom-header.php';
require_once F_PATH . '/custom/helper-functions.php';
require_once F_PATH . '/plugins/class-tgm-plugin-activation.php';

require T_PATH . '/vendor/autoload.php';



/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function appsero_init_tracker_tutorpro() {

	if ( ! class_exists( 'Appsero\Client' ) ) {
		require_once T_PATH . '/vendor/appsero/client/src/Client.php';
	}

	$client = new \Appsero\Client( '79b27688-afb0-460d-8b15-f87e1d90c1e3', 'TutorPro', __FILE__ );

	// Active insights
	$client->insights()->init();

	// Active automatic updater
	$client->updater();

}

appsero_init_tracker_tutorpro();



if ( ! function_exists('tutor_after_setup' ) ) {
    function tutor_after_setup() {

        load_theme_textdomain( 'tutorpro', get_template_directory() . '/languages' );

        register_nav_menus( 
            array( 
                'primary-menu'  => esc_html__( 'Primary menu', 'tutorpro' ),
                'footer-menu'  => esc_html__( 'Footer menu', 'tutorpro' ),
            )
        );
        
        add_theme_support( 'post-formats', array('video', 'gallery', 'audio', 'quote'));
        add_theme_support( 'custom-header' );
        add_theme_support( 'custom-background' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );
    }
}
add_action( 'after_setup_theme', 'tutor_after_setup' );

add_filter( 'use_widgets_block_editor', '__return_false' );

function tutorpro_set_script( $scripts, $handle, $src, $deps = array(), $ver = false, $in_footer = false ) {
	$script = $scripts->query( $handle, 'registered' );

	if ( $script ) {
		// If already added
		$script->src  = $src;
		$script->deps = $deps;
		$script->ver  = $ver;
		$script->args = $in_footer;

		unset( $script->extra['group'] );

		if ( $in_footer ) {
			$script->add_data( 'group', 1 );
		}
	} else {
		// Add the script
		if ( $in_footer ) {
			$scripts->add( $handle, $src, $deps, $ver, 1 );
		} else {
			$scripts->add( $handle, $src, $deps, $ver );
		}
	}
}



function tutorpro_replace_scripts( $scripts ) {
	$assets_url = LX_URI . '/assets/js/';

	tutorpro_set_script( $scripts, 'jquery-migrate', $assets_url . 'jquery-migrate.min.js', array(), '1.4.1-wp' );
	tutorpro_set_script( $scripts, 'jquery', false, array( 'jquery-core', 'jquery-migrate' ), '1.12.4-wp' );
}

add_action( 'wp_default_scripts', 'tutorpro_replace_scripts' );

/*global varaible*/
function tutorpro_without_plugin() {
  global $witoutPluginClass;
  return $witoutPluginClass;
}
function sample_admin_notice__success() {
   
	if (is_plugin_active( 'booked/booked.php' ) ) { ?>
    <div data-dismissible="disable-done-notice-forever" class="updated notice notice-success is-dismissible">
        <p><?php _e( '<b>Booked plugin has been deprecated since version 2.4.3</b>, instead of using Booked plugin you can use <a  href="https://import.foxthemes.me/plugins/premium-plugins/scheduled.zip" target="_blank">Scheduled Plugin.</a>. Please make sure to take a backup before replacing plugin.'); ?></p> 
    </div>
    <?php 
	}
}
add_action( 'admin_notices', 'sample_admin_notice__success' );