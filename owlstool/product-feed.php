<?php

/** 
 * RSS2 Feed Template for displaying RSS2 Posts feed. 
 * 
 * @package WordPress 
 */  
   
header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);  
$more = 1;  
   
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'; 

?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:slash="http://purl.org/rss/1.0/modules/slash/" xmlns:g="http://base.google.com/ns/1.0" <?php do_action('rss2_ns'); ?>  >  
   
<channel>    
	<link><?php bloginfo_rss('url') ?></link>
	<description>Owl Furniture Store</description>  
	<lastbuilddate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastbuilddate>  
	<language><?php bloginfo_rss( 'language' ); ?></language>  
	<sy:updateperiod><?php echo apply_filters( 'rss_update_period', 'hourly' ); ?></sy:updateperiod>  
	<sy:updatefrequency><?php echo apply_filters( 'rss_update_frequency', '1' ); ?></sy:updatefrequency>  
	<?php do_action('rss2_head'); ?>  
	<?php  
	$args = array( 'post_type' => 'product', 'posts_per_page' => 999 );  
	$loop = new WP_Query( $args );  

	while ( $loop->have_posts() ) : $loop->the_post(); 
	global $product;  
	$shipping_class = $product->get_shipping_class();
	switch ($shipping_class) {
	case "twentyclass" :
		$shipcost = "20.00";
		break;
	case "onenintyclass" :
		$shipcost = "190.00";
		break;
	case "ninetyclass" :
		$shipcost = "90.00";
		break;
	default:
		$shipcost = "40.00";
	}

	?>  
	<item> 
		<link><?php the_permalink_rss() ?></link>
		<g:title><?php echo urlencode($product->get_title()); ?></g:title>  
		<g:image_link><?php echo wp_get_attachment_url( get_post_thumbnail_id() ) ?></g:image_link>  
		<g:price><?php echo $product->price ?></g:price>  
		<g:condition>new</g:condition>  
		<g:id><?php echo $id; ?></g:id>  
		<g:availability><?php echo $product->is_in_stock() ? 'in stock' : 'out of stock'; ?></g:availability>  
		<g:brand>Owl Furniture</g:brand>  
   		<g:google_product_category>Furniture &gt; Chairs</g:google_product_category>
   		<g:product_type>Furniture &gt; Chairs</g:product_type>
   		<g:shipping>
 		  <g:country>US</g:country>
 		  <g:service>Ground</g:service>
  		 <g:price><?php echo $shipcost ?></g:price>
		</g:shipping>
		<g:mpn><?php echo $product->get_sku(); ?></g:mpn>  
		<?php if (get_option('rss_use_excerpt')) : ?>  
				<description><?php the_excerpt_rss() ?></description>  
		<?php else : ?>  
				<description><?php the_excerpt_rss() ?></description>  
		<?php endif; ?>  
		<?php rss_enclosure(); ?>  
	<?php do_action('rss2_item'); ?>  
	</item>  
	<?php endwhile; ?>  
</channel>  
</rss>