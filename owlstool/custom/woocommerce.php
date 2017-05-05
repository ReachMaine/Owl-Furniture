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
	// pro 4 leg pro stools(6053), bar stools (5679), 4 Leg classic stool(32)
	$ineligible = array( '46', '48', '165', '6361', '6053', '5679', '32' );

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
