<?php
/**
 *
 * Footer
 * @since 1.0.0
 * @version 1.0.0
 *
 */

$witoutPluginClass = '';
if ( !class_exists('tutor_Plugins') ) {
    $witoutPluginClass = 'no-plugin-lx-post';
}
$footer_social = cs_get_option('footer_social');
?>

<!-- FOOTER -->
<footer class="lx-footer <?php echo esc_attr($witoutPluginClass); ?>">
    <div class="container">
        <div class="row">
            <div class="<?php echo (class_exists('tutor_Plugins'))? 'col-md-3' : 'col-sm-12 center-logo text-center'; ?>">
                <div class="lx-logo footer">
                    <a href="<?php echo home_url(); ?>"><?php tutor_logo('footer'); ?></a>
                </div>
            </div>
            <div class="<?php echo (!is_array($footer_social) || !class_exists('CSFramework'))? 'col-md-9 text-right' : 'col-md-7'; ?>">
                <?php tutor_footer_menu(); ?>
            </div>
            <?php 
                if( is_array($footer_social) && class_exists('CSFramework')) { ?>
                <div class="col-md-2">
                    <div class="social-icons footer">
                        <?php foreach ( cs_get_option('footer_social') as $social_item ) { ?>
                            <a class="btn" href="<?php echo  esc_html($social_item['footer_social_link']); ?>"><i class="<?php echo esc_attr($social_item['footer_social_icon']); ?>"></i></a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="footer-wrap bottom">
            <div class="row">
                <div class="col-md-6">
                    <?php if(cs_get_option('footer_text')) { ?>
                        <div class="footer-content">
                            <?php echo cs_get_option('footer_text'); ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-6">
                    <div class="contact-info">
                        <?php if(cs_get_option('footer_contact')) { ?>
                            <div class="footer-content">
                                <?php echo cs_get_option('footer_contact'); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>  
            <?php if(!class_exists('CSFramework')) { ?>
                <div class="footer-content text-center"><?php esc_html_e( '&copy; Tutor WordPress theme', 'tutorpro' ); ?></div>
            <?php } ?>
        </div>
        
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>