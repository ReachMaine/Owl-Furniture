<?php
//require_once(get_stylesheet_directory().'/custom/language.php');
require_once(get_stylesheet_directory().'/custom/woocommerce.php');
require_once(get_stylesheet_directory().'/custom/custom.php'); 

$preview = get_stylesheet_directory() . '/woocommerce/emails/woo-preview-emails.php';
if(file_exists($preview)) {
    require $preview;
}

// remove additional product tab.
    add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
    function woo_remove_product_tabs( $tabs ) {
        unset( $tabs['additional_information'] );   // Remove the additional information tab
        return $tabs;
    }
// filter for no shipping
add_filter( 'woocommerce_cart_no_shipping_available_html', 'change_no_shipping_text' ); // Alters message on Cart page
add_filter( 'woocommerce_no_shipping_available_html', 'change_no_shipping_text' ); // Alters message on Checkout page
function change_no_shipping_text() {

    return "Please call us to receive a shipping quote and complete your order: (207) 367-6555";
}
/*
add_filter( 'woocommerce_get_availability', 'custom_get_availability', 1, 2);

// Our hooked in function $availablity is passed via the filter!
function custom_get_availability( $availability, $_product ) {
if ( !$_product->is_in_stock() ) $availability['availability'] = __('Coming Soon!', 'woocommerce');
return $availability;
}

*/



//Define the product feed php page
function products_feed_rss2() {
    $rss_template = get_stylesheet_directory() . '/product-feed.php';
    load_template ( $rss_template );
}

//Add the product feed RSS
add_action('do_feed_products', 'products_feed_rss2', 10, 1);

//Update the Rerewrite rules
add_action('init', 'my_add_product_feed');

//function to add the rewrite rules
function my_rewrite_product_rules( $wp_rewrite ) {
    $new_rules = array(
    'feed/(.+)' => 'index.php?feed='.$wp_rewrite->preg_index(1)
    );
    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}

//add the rewrite rule
function my_add_product_feed( ) {
    global $wp_rewrite;
    add_action('generate_rewrite_rules', 'my_rewrite_product_rules');
    $wp_rewrite->flush_rules();
}



 /**
 * add the Where did you hear about us field to checkout
 */
add_action( 'woocommerce_after_order_notes', 'my_custom_checkout_field' );

function my_custom_checkout_field( $checkout ) {

    echo '<div id="source_checkout_field"><h3>' . __('Where did you hear about us?') . '</h3>';

    woocommerce_form_field( 'source', array(
        'type'          => 'text',
        'class'         => array('source-field-class form-row-wide'),
        'label'         => __(''),
        'placeholder'   => __('Web site, Social Media, Google Search, etc.'),
        ), $checkout->get_value( 'source' ));

    echo '</div>';

}

/**
 * Update the order meta with source field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'source_checkout_field_update_order_meta' );

function source_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['source'] ) ) {
        update_post_meta( $order_id, 'Source', sanitize_text_field( $_POST['source'] ) );
    }
}

/**
 * Update the order screen with source field value
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'source_field_display_admin_order_meta', 10, 1 );

function source_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('Source').':</strong> ' . get_post_meta( $order->id, 'Source', true ) . '</p>';
}

/* To use:
1. Add this snippet to your theme's functions.php file
2. Change the meta key names in the snippet
3. Create a custom field in the order post - e.g. key = "Tracking Code" value = abcdefg
4. When next updating the status, or during any other event which emails the user, they will see this field in their email
*/
add_filter('woocommerce_email_order_meta_keys', 'source_field_order_meta_keys');

function source_field_order_meta_keys( $keys ) {
     $keys[] = 'Source'; // This will look for a custom field called 'Source' and add it to emails
     return $keys;
}

    /*****  change the login screen logo ****/
    function my_login_logo() { ?>
        <style type="text/css">
            body.login div#login h1 a {
                background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/admin-img.png);
                padding-bottom: 30px;
                background-size: contain;
                margin-left: 0px;
                margin-bottom: 0px;
                margin-right: 0px;
                height: 60px;
                width: 100%;
            }
        </style>
    <?php }
    add_action( 'login_enqueue_scripts', 'my_login_logo' );
