<?php
function quality_front_page_parallex_customizer( $wp_customize ) {
class WP_Perallex_Customize_Control extends WP_Customize_Control {
    public $type = 'new_menu';
    /**
    * Render the control's content.
    */
    public function render_content() {
    ?>
     <div class="pro-box">
       <a href="<?php echo esc_url( __('http://webriti.com/quality/', 'quality'));?>" target="_blank" class="upgrade_pro" id="review_pro"><?php _e( 'To Add Parallax Template Upgrade To Pro ','quality' ); ?></a>	
	</div>
    <?php
    }
}

class WP_Perallex_demo_Customize_Control extends WP_Customize_Control {
    public $type = 'new_menu';
    /**
    * Render the control's content.
    */
    public function render_content() {
    ?>
     <div class="pro-box">
       <a href="<?php echo esc_url( __('http://webriti.com/demo/wp/quality-parallax/', 'quality'));?>" target="_blank" class="parallax" id="review_pro"><?php _e( 'View Parallax Demo','quality' ); ?></a>	
	</div>
    <?php
    }
}

	/* front page parallex Section */
	$wp_customize->add_section( 'front_page_parallex_options' , array(
			'title'      => __('Parallax Template Settings', 'quality'),
			'priority'       => 1000,
		) );	
	 	

$wp_customize->add_setting(
    'perallax_pro',
    array(
        'default' => __('','quality'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
    )	
);
$wp_customize->add_control( new WP_Perallex_Customize_Control( $wp_customize, 'perallax_pro', array(
		'label' => __('Discover quality Pro','quality'),
        'section' => 'front_page_parallex_options',
		'setting' => 'perallax_pro',
    ))
);


$wp_customize->add_setting(
    'perallax_demo',
    array(
        'default' => __('','quality'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
    )	
);
$wp_customize->add_control( new WP_Perallex_demo_Customize_Control( $wp_customize, 'perallax_demo', array(
		'label' => __('Discover quality Pro','quality'),
        'section' => 'front_page_parallex_options',
		'setting' => 'perallax_demo',
    ))
);

		
			
			
}
add_action( 'customize_register', 'quality_front_page_parallex_customizer' );