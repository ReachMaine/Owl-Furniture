<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * The default template for displaying content
 */

	global $woo_options;

/**
 * The Variables
 *
 * Setup default variables, overriding them if the "Theme Options" have been saved.
 */

 	$settings = array(
					'thumb_w' => 787,
					'thumb_h' => 300,
					'thumb_align' => 'aligncenter'
					);

	$settings = woo_get_dynamic_values( $settings );

?>

	<article <?php post_class(); ?>>
		<aside class="meta">
			<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">
				<?php echo get_avatar( get_the_author_meta('email'), '128' ); ?>
			</a>
			<span class="month"><?php the_time( 'M' ); ?></span>
			<span class="day"><?php the_time( 'd' ); ?></span>
			<span class="year"><?php the_time( 'o' ); ?></span>
		</aside>

		<section class="post-content">
		    <?php
		    	if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] != 'content' ) {
		    		woo_image( 'width=' . $settings['thumb_w'] . '&height=' . $settings['thumb_h'] . '&class=thumbnail ' . $settings['thumb_align'] );
		    	}
		    ?>

			<header>
				<h1><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
				<?php woo_post_meta(); ?>
			</header>

			<section class="entry zzzz<?php echo $woo_options['woo_post_content']; ?> ">
			<?php /*if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'content' ) { the_content( 'Continue Reading &rarr;' ); } else { the_excerpt(); }*/
                the_content( 'Continue Reading &rarr;' );
                global $post;
                echo '<div class="view-full-post"><a class="button" href="'. get_permalink($post->ID) . '" class="view-full-post-btn">View Full Post</a></div>';
            ?>
			</section>


		</section><!--/.post-content -->

	</article><!-- /.post -->
