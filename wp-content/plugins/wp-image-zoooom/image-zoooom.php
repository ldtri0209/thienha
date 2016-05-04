<?php
/**
 * Plugin Name: WP Image Zoom
 * Plugin URI: https://wordpress.org/plugins/wp-image-zoooom/
 * Description: Add zoom effect over the an image, whether it is an image in a post/page or the featured image of a product in a WooCommerce shop 
 * Version: 1.2.8
 * Author: Diana Burduja
 * Author URI: http://www.silkypress.com
 * License: GPL2
 *
 * Text Domain: zoooom
 * Domain Path: /languages/
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'ImageZoooom' ) ) :
/**
 * Main ImageZoooom Class
 *
 * @class ImageZoooom
 */
final class ImageZoooom {
    public $version = '1.2.8';
    public $testing = false;
    public $free = true;
    protected static $_instance = null; 


    /**
     * Main ImageZoooom Instance
     *
     * Ensures only one instance of ImageZoooom is loaded or can be loaded
     *
     * @static
     * @return ImageZoooom - Main instance
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
      * Cloning is forbidden.
      */
    public function __clone() {
         _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'zoooom' ), '1.0' );
    }

    /**
     * Unserializing instances of this class is forbidden.
     */
    public function __wakeup() {
        _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'zoooom' ), '1.0' );
    }

    /**
     * Image Zoooom Constructor
     * @access public
     * @return ImageZoooom
     */
    public function __construct() {
         if ( is_admin() ) {
            include_once( 'includes/image-zoom-admin.php' );
            include_once( 'includes/image-zoom-notices.php' );
         }
         add_action( 'template_redirect', array( $this, 'template_redirect' ) );
         add_action( 'vc_after_init', array( $this, 'js_composer' ) );
    }

    /**
     * Show the javascripts in the front-end
     * Hooked to template_redirect in $this->__construct()
     * @access public
     */
    public function template_redirect() {

        $general = $this->get_option_general();

        if ( isset($general['enable_mobile']) && empty($general['enable_mobile']) && wp_is_mobile() )
            return false;

        add_filter( 'woocommerce_single_product_image_html', array( $this, 'woocommerce_single_product_image_html' ) );
        add_filter( 'woocommerce_single_product_image_thumbnail_html', array( $this, 'woocommerce_single_product_image_thumbnail_html' ) );

        add_filter( 'woocommerce_single_product_image_html', array( $this, 'remove_prettyPhoto' ) );
        add_filter( 'woocommerce_single_product_image_thumbnail_html', array( $this, 'remove_prettyPhoto' ) );

        add_filter( 'the_content', array( $this, 'find_bigger_image' ), 40 );

        add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
        add_action( 'wp_head', array( $this, 'show_js_settings' ) );
    }

    /**
     * Add zoom option in the vc_single_image shortcode in Visual Composer
     */
    function js_composer() {
        if ( ! defined( 'WPB_VC_VERSION' ) ) return false;
        $param = WPBMap::getParam( 'vc_single_image', 'style' );
        $param['value'][__( 'WP Image Zoooom', 'zoooom' )] = 'zoooom';
        vc_update_shortcode_param( 'vc_single_image', $param );
    }

    /**
     * Add data-thumbnail-src to the main product image 
     */
    function woocommerce_single_product_image_html( $content ) {
        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'shop_thumbnail' );

        if ( ! isset( $thumbnail[0] ) ) return $content;

        $thumbnail_data = ' data-thumbnail-src="'.$thumbnail[0].'"';

        return str_replace( ' title="', $thumbnail_data . ' title="', $content );
    }

    /**
     * Force the WooCommerce to use the "src" attribute
     */
    function woocommerce_single_product_image_thumbnail_html( $content ) {
        return $content;
//        return preg_replace( '@ srcset="(.*?)"@', '', $content );
    }

    /**
     * Remove the lightbox
     */
    function remove_prettyPhoto( $content ) {
        $replace = array( 'data-rel="prettyPhoto"', 'data-rel="lightbox"', 'data-rel="prettyPhoto[product-gallery]"', 'data-rel="lightbox[product-gallery]"'); 

        return str_replace( $replace, 'data-rel="zoomImage"', $content );
    }


    /**
     * Find bigger image if class="zoooom" and there is no srcset
     *
     * Note: the srcset is not be set if for some reason 
     *      the _wp_attachment_metadata for the image is not present
     */
    function find_bigger_image( $content ) {
        if ( ! preg_match_all( '/<img [^>]+>/', $content, $matches ) ) {
            return $content;
        }

        foreach( $matches[0] as $image ) {
            // the image has to have the class "zoooom"
            if ( false === strpos( $image, 'zoooom' ) ) {
                continue;
            }
            // the image was tagged to skip this step
            if ( false !== strpos( $image, 'skip-data-zoom-image' ) ) {
                continue;
            }
            // the image does not have the srcset
            if ( false !== strpos( $image, ' srcset=' ) ) {
                continue;
            }
            // the image has an "-300x400.jpg" type ending
            if ( false === preg_match( '@(-[0-9]+x[0-9]+).(jpg|png|gif)@', $image) ) {
                continue;
            }

            // link the full-sized image to the data-zoom-image attribute
            $full_image = preg_replace( '@^(.*) src="(.*)(-[0-9]+x[0-9]+).(jpg|png|gif)"(.*)$@',   '$2.$4', $image );
            $full_image_attr = ' data-zoom-image="' . $full_image . '"'; 
            $full_image_img = str_replace(' src=', $full_image_attr. ' src=', $image);
            $content = str_replace( $image, $full_image_img, $content);
        }

        return $content;
    }




    /**
     * Call the jquery.image_zoom.js with the right options
     * Hooked to wp_head in $this->template_redirect
     * @access public
     */
    public function show_js_settings() {
        $options = get_option( 'zoooom_settings_js' );
        $general = $this->get_option_general();

        $with_woocommerce = true;
        if ( ! $this->woocommerce_is_active() )
            $with_woocommerce = false;

        if ( !function_exists( 'is_product' ) || !is_product() ) 
            $with_woocommerce = false;

        if ( isset($general['enable_woocommerce']) && empty($general['enable_woocommerce']))
            $with_woocommerce = false;

        $lazy_load = '';
        if ( isset($general['force_lazyload']) && $general['force_lazyload'] == 1 ) {
            $lazy_load = '
                if (typeof $.unveil === "function") { 
                    $("img.unveil").unveil(0, function() {
                        $(this).load(function() {
                            $("img.zoooom").image_zoom(options);
                            $(".zoooom img").image_zoom(options);
                        });
                    });
                }';
        }

        $woocommerce_categories = '';
        if ( isset( $general['woo_cat'] ) && $general['woo_cat'] == 1 ) {
            $woocommerce_categories = '$(".tax-product_cat .products img").image_zoom(options);';
        }

        ?>
        <script type="text/javascript">
            /* <![CDATA[ */
            jQuery(document).ready(function( $ ){
                var options = {<?php echo $options; ?>};
                $(".zoooom").image_zoom(options);
                $(".zoooom img").image_zoom(options);

                <?php echo $woocommerce_categories . $lazy_load; ?>

                $(window).bind('resize', function(e) {
                    window.resizeEvt;
                    $(window).resize(function() {
                        clearTimeout(window.resizeEvt);
                        window.resizeEvt = setTimeout(function() {
                            $(".zoomContainer").remove();
                            $(".zoooom").image_zoom(options);
                            $(".zoooom img").image_zoom(options);
                            $(".attachment-shop_single").image_zoom(options);
                        }, 500);
                    });
                });

                
                <?php if ( $with_woocommerce ) : ?>
                $(".attachment-shop_single").image_zoom(options);

                $("a[data-rel^='zoomImage']").each(function(index){
                    $(this).click(function(event){
                        // If there are more than one WooCommerce gallery, exchange the thumbnail with the closest .attachment-shop_single
                        var obj1 = $(".attachment-shop_single");
                        if ( obj1.length > 1 ) {
                            var obj1 = $(this).closest('.images').find( $(".attachment-shop_single") );
                        }
                        var obj2 = $(this).find("img");

                        event.preventDefault();

                        if ( obj2.hasClass('attachment-shop_single') === false ) {

                            // Remove the srcset and sizes
                            obj1.removeAttr('srcset').removeAttr('sizes');
                            obj2.removeAttr('srcset').removeAttr('sizes');

                            var thumb_src = obj2.attr('src');

                            // Exchange the attributes
                            $.each(['alt', 'title'], function(key,attr) {
                                var temp;
                                if ( obj1.attr( attr ) ) temp = obj1.attr( attr ); 
                                if ( obj2.attr( attr ) ) {
                                    obj1.attr(attr, obj2.attr(attr) );
                                } else {
                                    obj1.removeAttr( attr );
                                }
                                if ( temp && temp.length > 0 ) {
                                    obj2.attr(attr, temp);
                                } else {
                                    obj2.removeAttr( attr );
                                }
                            });

                            // Exchange the link sources
                            var temp;
                            temp = obj2.parent().attr('href');
                            obj2.parent().attr('href', obj1.parent().attr('href'));
                            obj1.parent().attr('href', temp );

                            // Set the obj1.src = the link source
                            obj1.attr('src', temp ); 

                            // Set the obj2.src = data-thumbnail-src
                            if ( obj1.data('thumbnail-src') ) {
                                obj2.attr( 'src', obj1.attr('data-thumbnail-src'));
                            }

                            // Set the obj1.data-thumbnail-src
                            obj1.attr('data-thumbnail-src', thumb_src ); 

                            // Remove the old zoom and reactive the new zoom
                            $(".zoomContainer").remove();
                            $(".attachment-shop_single").image_zoom(options);
                        }

                    });
                });

                <?php endif; ?>
            });
            /* ]]> */
        </script>
        <?php
    }

    /**
     * Enqueue the jquery.image_zoom.js
     * Hooked to wp_enqueue_scripts in $this->template_redirect
     * @access public
     */
    public function wp_enqueue_scripts() {
        if ( $this->testing == true ) {
            wp_register_script( 'image_zoooom', $this->plugins_url( '/assets/js/jquery.image_zoom.js' ), array( 'jquery' ), $this->version, false );
            wp_enqueue_script( 'image_zoooom' );
        } else {
            wp_register_script( 'image_zoooom', $this->plugins_url( '/assets/js/jquery.image_zoom.min.js' ), array( 'jquery' ), $this->version, false );
            wp_enqueue_script( 'image_zoooom' );
        }

        wp_dequeue_script( 'prettyPhoto' );
        wp_dequeue_script( 'prettyPhoto-init' );
    }



    /** Helper function ****************************************/

    public function plugins_url( $path  = '/' ) {
        return untrailingslashit( plugins_url( $path, __FILE__ ) );
    }

    public function plugin_dir_path() {
        return untrailingslashit( plugin_dir_path( __FILE__ ) );
    }

    /**
     * Check if WooCommerce is activated
     * @access public
     * @return bool
     */
    public function woocommerce_is_active() {
        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            return true;
        }
        return false;
    }

    public function get_option_general() {
        $general = get_option('zoooom_general');

        if (!isset($general['enable_woocommerce']))
            $general['enable_woocommerce'] = true;

        if ( !isset( $general['enable_mobile'] ) )
            $general['enable_mobile'] = false;

        $general['force_woocommerce'] = false;

        if ( !isset( $general['woo_cat'] ) )
            $general['woo_cat'] = false;

        if ( ! $this->woocommerce_is_active() ) {
            $general['woo_cat'] = false;
        } 

        if ( !isset( $general['force_lazyload'] ) )
            $general['force_lazyload'] = false;

       return $general; 
    }

}

endif; 

/**
 * Returns the main instance of ImageZoooom
 *
 * @return ImageZoooom
 */
function ImageZoooom() {
    return ImageZoooom::instance();
}

ImageZoooom();

/**
 *  * Plugin action link to Settings page
 *  */
function wp_image_zoooom_plugin_action_links( $links ) {

    $settings_link = '<a href="admin.php?page=zoooom_settings">' .
        esc_html( __('Settings' ) ) . '</a>';

    return array_merge( array( $settings_link), $links );

}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__),                                  'wp_image_zoooom_plugin_action_links' );

