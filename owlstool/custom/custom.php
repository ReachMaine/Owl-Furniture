<?php /* add widget areas for the theme */
function reach_widgets_init() {
  register_sidebar(
        array(
         'name' => __( 'Bottom Footer Left', 'reach-themes' ),
         'id'   => 'bottom-footer-left',
         'description'   => __( 'Left Bottom Footer Widget', 'reach-themes' ),
         'before_widget' => '<div id="%1$s" class="widget %2$s">',
         'after_widget'  => '</div>',
         'before_title'  => '<h3>',
         'after_title'   => '</h3>',
      )
  );
  register_sidebar(
        array(
         'name' => __( 'Bottom Footer Center', 'reach-themes' ),
         'id'   => 'bottom-footer-center',
         'description'   => __( 'Center Bottom Footer Widget', 'reach-themes' ),
         'before_widget' => '<div id="%1$s" class="widget %2$s">',
         'after_widget'  => '</div>',
         'before_title'  => '<h3>',
         'after_title'   => '</h3>',
      )
  );
  register_sidebar(
        array(
         'name' => __( 'Bottom Footer Right', 'reach-themes' ),
         'id'   => 'bottom-footer-right',
         'description'   => __( 'Right Bottom Footer Widget', 'reach-themes' ),
         'before_widget' => '<div id="%1$s" class="widget %2$s">',
         'after_widget'  => '</div>',
         'before_title'  => '<h3>',
         'after_title'   => '</h3>',
      )
  );

}
add_action( 'widgets_init', 'reach_widgets_init' );
