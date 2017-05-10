<?php
/* woocommerce customizations
*/
// to remove sku from everywhere....
///add_filter( 'wc_product_sku_enabled', '__return_false' );

/**
 * Disable free shipping for select products
 *
 * @param bool $is_available
 */
function my_free_shipping( $is_available ) {
	global $woocommerce;

	// set the product ids that are ineligible for free shipping
	//Owl chair(46), peanut desk(48), stonington chair(165), standing desk(6361),
	//bar stools (5679), 4 Leg classic stool(32)
	$ineligible = array( '46', '48', '165', '6361', '5679' );

	// get cart contents
	$cart_items = $woocommerce->cart->get_cart();


	// loop through the items looking for one in the ineligible array
	foreach ( $cart_items as $key => $item ) {
		if( in_array( $item['product_id'], $ineligible ) ) {
			 $is_available =  false;
		}
	}

	$excluded_states = array( 'AK','HI','GU','PR' );
	if( in_array( $woocommerce->customer->get_shipping_state(), $excluded_states ) ) {
		// Empty the $available_methods array
		$is_available =  false;
	}

	// nothing found return the default value
	return $is_available;
}
add_filter( 'woocommerce_shipping_free_shipping_is_available', 'my_free_shipping', 20 );

// to remove sku from everywhere....
add_filter( 'wc_product_sku_enabled', '__return_false' );
//
/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
function my_hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );
//

add_action('woocommerce_before_add_to_cart_form', 'display_free_shipping_text');
function display_free_shipping_text() {
	// set the product ids that are ineligible for free shipping
	//Owl chair(46), peanut desk(48), stonington chair(165), standing desk(6361),
	// bar stools (5679)
	$ineligible = array( '46', '48', '165', '6361', '5679' );
	echo "<!-- ~zig~ -->";
	if ( !in_array( get_the_ID(), $ineligible ) ) {
		echo "<!-- yep ".get_the_ID()."-->";
		$out_html = "";
		$out_html .= '<div class="owl-free-shipping-text"><h3>Free Shipping</h3>';
		$out_html .= "<p>This product ships for free anywhere in the Continental U.S.</p>";
		$out_html .= "</div>";
		echo $out_html;
	} else {
		echo "<!-- nope ".get_the_ID()."-->";
	}
} // end function display_free_shipping_text;
