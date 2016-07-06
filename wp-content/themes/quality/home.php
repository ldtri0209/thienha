<?php 
		if('page' == get_option('show_on_front')){ get_template_part('index');}
		else {get_header();
		$quality_pro_options=theme_data_setup(); 
		$current_options = wp_parse_args(  get_option( 'quality_pro_options', array() ), $quality_pro_options );
		//****** get index static banner  ********
//		get_template_part('index', 'static');

			//echo do_shortcode( '[metaslider id=64]' );		
		//****** get index service  *********/
		if (  $current_options['service_enable'] == true ) {
		get_template_part('index', 'service');
		}
		//****** get index Projects  *********/
		if (  $current_options['home_projects_enabled'] == true ) {
		get_template_part('index', 'projects');
		}
		//****** get index Blog  *********/
		?>
		<div class="container" style="    padding-bottom: 50px;">
			<div class="qua_port_title">
				<h1 style="color: #121212;">GALERIES</h1>
				<div class="qua-separator" id=""></div>
			</div>
		<?php 
		echo do_shortcode( '[foogallery id="100"]' );?>
		</div><?php		
		get_footer();
		}
?>