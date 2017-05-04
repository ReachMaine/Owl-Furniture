<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * Footer Template
 *
 * Here we setup all logic and XHTML that is required for the footer section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
	global $woo_options;

	echo '<div style="clear:both">&nbsp;</div>';
	echo '<div class="footer-wrap">';

	$total = 2;
	if ( isset( $woo_options['woo_footer_sidebars'] ) && ( $woo_options['woo_footer_sidebars'] != '' ) ) {
		$total = $woo_options['woo_footer_sidebars'];
	}

	if ( ( woo_active_sidebar( 'footer-1' ) ||
		   woo_active_sidebar( 'footer-2' ) ||
		   woo_active_sidebar( 'footer-3' ) ||
		   woo_active_sidebar( 'footer-4' ) ) && $total > 0 ) {

?>
	<?php woo_footer_before(); ?>

		<section id="footer-widgets" class="col-full col-<?php echo $total; ?> fix">
			<a name="socfoot"></a>
			<?php $i = 0; while ( $i < $total ) { $i++; ?>
				<?php if ( woo_active_sidebar( 'footer-' . $i ) ) { ?>

			<div class="block footer-widget-<?php echo $i; ?>">
	        	<?php woo_sidebar( 'footer-' . $i ); ?>
			</div>

		        <?php } ?>
			<?php } // End WHILE Loop ?>

		</section><!-- /#footer-widgets  -->
	<?php } // End IF Statement ?>
  <section id="bottom-footer-widgets" class="col-full col-3-set fix">
      <?php if (is_active_sidebar('bottom-footer-left')) {
    		echo '<div id="bottom-footer-left" class="col-3">';
    			dynamic_sidebar( 'bottom-footer-left');
    		echo '</div>';
  	  }
      if (is_active_sidebar('bottom-footer-center')) {
        echo '<div id="bottom-footer-center"  class="col-3">';
          dynamic_sidebar( 'bottom-footer-center');
        echo '</div>';
      }
      if (is_active_sidebar('bottom-footer-right')) {
    		echo '<div id="bottom-footer-right" class="col-3">';
    			dynamic_sidebar( 'bottom-footer-right');
    		echo '</div>';
  	  } ?>
  </section>
		<footer id="footer" class="col-full">

			<div id="copyright" class="col-left">
			<?php if( isset( $woo_options['woo_footer_left'] ) && $woo_options['woo_footer_left'] == 'true' ) {

					echo stripslashes( $woo_options['woo_footer_left_text'] );
					/* echo "<p><img src=\"".get_stylesheet_directory_uri()."/images/creditcardlogos.png\" alt=\"credit-card-logos\" style=\"clear: both; height: 24px;\"/></p>"; */

			} else { ?>
				<div><?php bloginfo(); ?> &copy; <?php echo date( 'Y' ); ?>. <?php _e( 'All Rights Reserved.', 'woothemes' ); ?></div>
			<?php } ?>
			</div>
			<!--div id="credit" class="col-right">
			</div-->
		</footer><!-- /#footer  -->

	</div><!-- / footer-wrap -->

</div><!-- /#wrapper -->
<?php wp_footer(); ?>
<?php woo_foot(); ?>
<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 968441847;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/968441847/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
</body>
</html>
