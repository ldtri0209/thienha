<?php $quality_pro_options=theme_data_setup(); 
$current_options = wp_parse_args(  get_option( 'quality_pro_options', array() ), $quality_pro_options ); ?>
<div id="custom-widget">

    <div class="container">
        <div id="widgetized-contact" class="col-md-4 col-sm-4 qua_col_padding">

            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('footer-1')) : else : ?>

                <div class="pre-widget">
                    <p><strong>Widgetized Header</strong></p>
                    <p>This panel is active and ready for you to add some widgets via the WP Admin</p>
                </div>

            <?php endif; ?>

        </div>
        <div id="widgetized-about-us" class="col-md-4 col-sm-4 qua_col_padding">

            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('footer-2')) : else : ?>

                <div class="pre-widget">
                    <p><strong>Widgetized Sidebar</strong></p>
                    <p>This panel is active and ready for you to add some widgets via the WP Admin</p>
                </div>

            <?php endif; ?>

        </div>
        <div id="widgetized-google-map" class="col-md-4 col-sm-4 qua_col_padding">

            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('footer-3')) : else : ?>

                <div class="pre-widget">
                    <p><strong>Widgetized Footer</strong></p>
                    <p>This panel is active and ready for you to add some widgets via the WP Admin</p>
                </div>

            <?php endif; ?>

        </div>
    </div>
</div>
<div class="qua_footer_area">
  <div class="container">
    <div class="col-md-12">
			<?php if($current_options['footer_copyright_text']!='') { ?>
			<?php echo $current_options['footer_copyright_text']; } ?>
		</div>	
  </div>
</div>
<!-- /Footer Widget Secton -->
<?php wp_footer(); ?>
</body>
</html>