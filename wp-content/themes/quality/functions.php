<?php
  /**Theme Name	: Quality
   * Theme Core Functions and Codes
  */	
  	/**Includes reqired resources here**/
  	define('QUALITY_TEMPLATE_DIR_URI',get_template_directory_uri());	
  	define('QUALITY_TEMPLATE_DIR',get_template_directory());
  	define('QUALITY_THEME_FUNCTIONS_PATH',QUALITY_TEMPLATE_DIR.'/functions');	
  	define('QUALITY_THEME_OPTIONS_PATH',QUALITY_TEMPLATE_DIR_URI.'/functions/theme_options');
  
	require( QUALITY_THEME_FUNCTIONS_PATH . '/menu/new_Walker.php'); //NEW Walker Class Added.  		
  	require_once( QUALITY_THEME_FUNCTIONS_PATH . '/scripts/scripts.php');     //Theme Scripts And Styles	
  	require( QUALITY_THEME_FUNCTIONS_PATH . '/resize_image/resize_image.php'); //Image Resizing 	
  	require( QUALITY_THEME_FUNCTIONS_PATH . '/commentbox/comment-function.php'); //Comment Handling
  	require( QUALITY_THEME_FUNCTIONS_PATH . '/widget/custom-sidebar.php'); //Sidebar Registration
	
	
	//Customizer 
	require( QUALITY_THEME_FUNCTIONS_PATH . '/customizer/customizer-service.php');
	require( QUALITY_THEME_FUNCTIONS_PATH . '/customizer/customizer-slider.php');
	require( QUALITY_THEME_FUNCTIONS_PATH . '/customizer/customizer-copyright.php');
	require( QUALITY_THEME_FUNCTIONS_PATH . '/customizer/customizer-home.php');
	require( QUALITY_THEME_FUNCTIONS_PATH . '/customizer/customizer-project.php');
	require( QUALITY_THEME_FUNCTIONS_PATH . '/customizer/customizer-blog.php');
	require( QUALITY_THEME_FUNCTIONS_PATH . '/customizer/customizer-client.php');
	require( QUALITY_THEME_FUNCTIONS_PATH . '/customizer/customizer-testimonial.php');
	require( QUALITY_THEME_FUNCTIONS_PATH . '/customizer/customizer-template.php');
	require( QUALITY_THEME_FUNCTIONS_PATH . '/customizer/customizer-pro.php');
	require( QUALITY_THEME_FUNCTIONS_PATH . '/customizer/customizer-front-page-parallex.php');
	require( QUALITY_THEME_FUNCTIONS_PATH . '/font/font.php');
	
	//wp title tag starts here
  	function quality_head( $title, $sep )
  	{	global $paged, $page;		
  		if ( is_feed() )
  			return $title;
  		// Add the site name.
  		$title .= get_bloginfo( 'name' );
  		// Add the site description for the home/front page.
  		$site_description = get_bloginfo( 'description' );
  		if ( $site_description && ( is_home() || is_front_page() ) )
  			$title = "$title $sep $site_description";
  		// Add a page number if necessary.
  		if ( $paged >= 2 || $page >= 2 )
  			$title = "$title $sep " . sprintf( _e( 'Page', 'quality' ), max( $paged, $page ) );
  		return $title;
  	}	
  	add_filter( 'wp_title', 'quality_head', 10, 2);
  	
  	add_action( 'after_setup_theme', 'quality_setup' ); 	
  	function quality_setup()
  	{	
		//content width
		if ( ! isset( $content_width ) ) $content_width = 700;//In PX
		// Load text domain for translation-ready
  		load_theme_textdomain( 'quality', QUALITY_THEME_FUNCTIONS_PATH . '/lang' );
  		add_theme_support( 'post-thumbnails' ); //supports featured image
  		// This theme uses wp_nav_menu() in one location.
  		register_nav_menu( 'primary', __( 'Primary Menu', 'quality' ) ); //Navigation
  		// theme support 	
  		add_theme_support( 'automatic-feed-links');
  		
  		require_once('theme_setup_data.php');
  		// setup admin pannel defual data for index page		
  		$quality_pro_options=theme_data_setup();		
  	}
  	// Read more tag to formatting in blog page 
  	function quality_new_content_more($more)
	{  global $post;
		return '<div class="blog-btn-col"><a href="' . get_permalink() . "#more-{$post->ID}\" class=\"qua_blog_btn\">Read More<i class='fa fa-long-arrow-right'></i></a></div>";
	}   
	add_filter( 'the_content_more_link', 'quality_new_content_more' );
	
	
	
	add_filter( "the_excerpt", "quality_add_class_to_excerpt" );
	function quality_add_class_to_excerpt( $excerpt ) {
    return str_replace('<p', '<p class="qua-blog-post-description"', $excerpt);
	}
	
	
	add_action('admin_menu', 'quality_admin_menu_pannel');  
	function quality_admin_menu_pannel()
	{	
	add_theme_page( __('Option panel','quality'), __('Option panel','quality'), 'edit_theme_options', 'option_panel', 'quality_option_page' );
	}
	function quality_option_page ()
	{require_once('option-panel.php');}

	//Custom widget
	if (function_exists('register_sidebar')) {

		register_sidebar(array(
			'name' => 'Footer 1',
			'id'   => 'footer-1',
			'description'   => 'This is the widgetized footer 1.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4><div class="qua-separator-small spacer"></div>'
		));
		register_sidebar(array(
			'name' => 'Footer 2',
			'id'   => 'footer-2',
			'description'   => 'This is the widgetized footer 2.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4><div class="qua-separator-small spacer"></div>'
		));
		register_sidebar(array(
			'name' => 'Footer 3',
			'id'   => 'footer-3',
			'description'   => 'This is the widgetized footer 3.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4><div class="qua-separator-small spacer"></div>'
		));

	}
	
	function remove_menus(){  

	  //remove_menu_page( 'index.php' );                  //Dashboard  
	  remove_menu_page( 'edit.php' );                   //Posts  
	  //remove_menu_page( 'upload.php' );                 //Media  
	  //remove_menu_page( 'edit.php?post_type=page' );    //Pages  
	  remove_menu_page( 'edit-comments.php' );          //Comments  
	  remove_menu_page( 'themes.php' );                 //Appearance  
	  remove_menu_page( 'plugins.php' );                //Plugins  
	  //remove_menu_page( 'users.php' );                  //Users  
	  remove_menu_page( 'tools.php' );                  //Tools  
	  //remove_menu_page( 'options-general.php' );        //Settings  



	  remove_menu_page( 'admin.php?page=galleries_bwg' );    //Pages  

	  remove_menu_page( 'admin.php?page=addons_bwg' );    //Pages  

	  remove_menu_page( 'admin.php?page=zoooom_settings' );    //Pages  

	  remove_menu_page( 'admin.php?page=wpgs_option' );    //Pages  

	}  
	add_action( 'admin_menu', 'remove_menus' );  