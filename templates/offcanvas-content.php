<?php

// No direct Access
defined('ABSPATH') or die("Cannot access pages directly.");


/*
Off Canvas
*/
?>

<!-- This is the off-canvas sidebar -->
<div id="offcanvas" class="uk-offcanvas">
    <div class="uk-offcanvas-bar uk-offcanvas-bar-flip padding">
    
    	<?php dynamic_sidebar( 'offcanvas-above' ); ?>
    	
    	<?php wp_nav_menu(array(
	    		'container' => false,                           // remove nav container
	    		'container_class' => 'menu',           // class of container (should you choose to use it)
	    		'menu' => __( 'Offcanvas', 'bonestheme' ),  // nav name
	    		'menu_class' => 'vertical offcanvas',         // adding custom nav class
	    		'theme_location' => 'offcanvas',                 // where it's located in the theme
	    		'before' => '',                                 // before the menu
	    		'after' => '',                                  // after the menu
	    		'link_before' => '<span>',                            // before each link
	    		'link_after' => '</span>',                              // after each link
	    		'depth' => 0,                                   // limit the depth of the nav
	    		'fallback_cb' => ''      // fallback function
	    	)); ?> 
    	
    	<?php dynamic_sidebar( 'offcanvas-below' ); ?>
    	
    </div>
</div>