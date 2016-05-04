<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
//if ( empty( $woocommerce_loop['columns'] ) ) {
//	$woocommerce_loop['columns'] = 2;
//}

//Custom column
$woocommerce_loop['columns'] = 2;

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
?>

<!--<div class="col-md-6 col-sm-6 qua_col_padding single-product" style="padding: 5px;">-->
<!---->
<!--	--><?php
//	/**
//	 * woocommerce_before_shop_loop_item hook.
//	 *
//	 * @hooked woocommerce_template_loop_product_link_open - 10
//	 */
//	do_action( 'woocommerce_before_shop_loop_item' );
//
//	/**
//	 * woocommerce_before_shop_loop_item_title hook.
//	 *
//	 * @hooked woocommerce_show_product_loop_sale_flash - 10
//	 * @hooked woocommerce_template_loop_product_thumbnail - 10
//	 */
//	do_action( 'woocommerce_before_shop_loop_item_title' );
//
//	/**
//	 * woocommerce_shop_loop_item_title hook.
//	 *
//	 * @hooked woocommerce_template_loop_product_title - 10
//	 */
//	do_action( 'woocommerce_shop_loop_item_title' );
//
//	/**
//	 * woocommerce_after_shop_loop_item_title hook.
//	 *
//	 * @hooked woocommerce_template_loop_rating - 5
//	 * @hooked woocommerce_template_loop_price - 10
//	 */
//	do_action( 'woocommerce_after_shop_loop_item_title' );
//
//	/**
//	 * woocommerce_after_shop_loop_item hook.
//	 *
//	 * @hooked woocommerce_template_loop_product_link_close - 5
//	 * @hooked woocommerce_template_loop_add_to_cart - 10
//	 */
//	do_action( 'woocommerce_after_shop_loop_item' );
//	?>
<!---->
<!--</div>-->

<div class="col-md-12 col-sm-12 qua_col_padding">
	<div class="qua_portfolio_image">
		<?php echo $product->get_image(1) ?>
		<div class="qua_home_portfolio_showcase_overlay">
			<div class="qua_home_portfolio_showcase_overlay_inner">
				<div class="qua_home_portfolio_showcase_icons">
					<a href="http://thienha.890m.com/wp-content/uploads/2016/04/Poly-rattan-furniture.jpg" data-lightbox="image" title="Time to raise your voice" class="hover_thumb"><i class="fa fa-plus"></i></a>
				</div>
			</div>
		</div>
	</div>
	<div class="qua_home_portfolio_caption">
		<a href="<?php echo $product->add_to_cart_url() ?>"><?php echo $product->get_title() ?></a>
		<span style="float: right;font-weight: 600;">View Detail</span>
	</div>
</div>