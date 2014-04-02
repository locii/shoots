<?php 

// No direct Access
defined('ABSPATH') or die("Cannot access pages directly.");

global $bamboo;
	
if ( is_active_sidebar( 'sidebar-primary' ) ) : ?>
	
		<?php // Logic for sidebar widths
		
		if($bamboo['cpt_layout_toggle']) {
			if(is_page()) { 
				$sidebar1width = $bamboo['page-sidebar1-width'];
		
			} 	elseif(is_search()) {
					$sidebar1width = $bamboo['search-sidebar1-width'];
					
			}	elseif(is_single()) {
					$sidebar1width = $bamboo['single-sidebar1-width'];
			}	else {
				$sidebar1width = $bamboo['sidebar1-width'];
			}
		}	
		else {
			$sidebar1width = $bamboo['sidebar1-width'];
		}
		
		?>
	
	
	<div id="sidebar1" class="sidebar col col-<?php echo $sidebar1width; ?>" role="complementary">
	
		<?php wp_nav_menu(array(
				'container' => false,                           // remove nav container
				'container_class' => 'menu widget',           // class of container (should you choose to use it)
				'menu' => __( 'Sidebar', 'bonestheme' ),  // nav name
				'menu_class' => 'vertical sidebar',         // adding custom nav class
				'theme_location' => 'sidebar',                 // where it's located in the theme
				'before' => '',                                 // before the menu
				'after' => '',                                  // after the menu
				'link_before' => '<span>',                            // before each link
				'link_after' => '</span>',                              // after each link
				'depth' => 0,                                   // limit the depth of the nav
				'fallback_cb' => ''      // fallback function
			)); ?>
			
		<?php dynamic_sidebar( 'sidebar-primary' ); ?>
	</div>
<?php endif; ?>