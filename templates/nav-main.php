<?php 

// No direct Access
defined('ABSPATH') or die("Cannot access pages directly.");

global $bamboo;?>

<nav role="navigation" data-uk-sticky id="navwrap" class="<?php echo $bamboo['menu-align'];?> <?php echo $bamboo['mobile-menu']; ?>">	
	<div class="container">
		<div class="inner">
			<!-- This is a button toggling the collapsed menu -->
				<button class="btn float-left toggle-menu"><span class="icon-menu"></span><?php echo $bamboo['mobile-menu-text'];?></button>
				
				<?php wp_nav_menu(array(
						'container' => false,                           // remove nav container
						'container_class' => 'menu cf',                 // class of container (should you 	choose to use it)
						'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
						'menu_class' => 'nav top-nav cf',               // adding custom nav class
						'theme_location' => 'main-nav',                 // where it's located in the theme
						'before' => '',                                 // before the menu
						'after' => '',                                  // after the menu
						'link_before' => '',                            // before each link
						'link_after' => '',                             // after each link
						'depth' => 0,                                   // limit the depth of the nav
						'fallback_cb' => ''                             // fallback function (if there is one)
					)); ?>
				
				<?php get_template_part('templates/offcanvas', 'button');?>
		</div>
	</div>
</nav>