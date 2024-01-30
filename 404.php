<?php
/**
 * 404 Page
 *
 * @package tutor
 * @since 1.0
 *
 */
$title = cs_get_option('error_title');
$subtitle = cs_get_option('error_subtitle');
$button = cs_get_option('error_btn_text');
$image = cs_get_option('404_image');

$img_bg = cs_get_option('404_image')? cs_get_option('404_image') : get_template_directory_uri().'/assets/images/404.jpg';

get_header();?>
	<div class="error-page simple-article-block" style="background-image: url(<?php echo esc_attr( $img_bg ); ?>)">
		<div class="not-found-title">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="wrap">
							<div class="wrap-cell text-center">
								<?php if(!empty($title)){ ?>
									<h1 class="title"><?php echo wp_kses_post( $title ); ?></h1>
								<?php }else{ ?>
									<h1 class="title"><span><?php esc_html_e('404', 'tutorpro'); ?></span><?php esc_html_e(' ERROR', 'tutorpro'); ?></h1>
								<?php }
								if (!empty($subtitle)){ ?>
									<div class="subtitle"><?php echo wp_kses_post( $subtitle ); ?></div>
								<?php }
								if(!empty($button)){ ?>
									<a href="<?php echo home_url( '/' ); ?>" class="button"><?php echo esc_html( $button ); ?></a>
								<?php }else{ ?>
									<a href="<?php echo home_url( '/' ); ?>" class="button"><?php  esc_html_e( 'GO BACK', 'tutorpro' ); ?></a>
								<?php }?>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
<?php get_footer();

