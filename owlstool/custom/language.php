<?php 
/* languages customizations 
*/
	if ( !function_exists('reach_change_theme_text') ){
		function reach_change_theme_text( $translated_text, $text, $domain ) {
			 /* if ( is_singular() ) { */

			    switch ( $translated_text ) {
			    	 case 'Please continue to the checkout and enter your full address to see if there are any available shipping methods.' : // woocommerece 2.4.x
                        $translated_text = 'Please continue to the checkout and enter your full address to see shipping fee.';
                        break;
		            
		            /*case 'Type here...':
		            	$translated_text = __( 'Search...',  $domain  );
		            	break;
		            case 'BLOG CATEGORIES':
		            	$translated_text = __( 'Found in',  $domain  );
		            	break;
		            case 'Share this post:':
		            	$translated_text = __('Share', ' $domain );
		            	break; */
		        }
			     
			/* } */
	    	return $translated_text;
		}
		add_filter( 'gettext', 'reach_change_theme_text', 20, 3 );
	}

