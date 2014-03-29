<?php 

// No direct Access
defined('ABSPATH') or die("Cannot access pages directly.");


	global $bamboo;
	
	// Logic for sidebar widths
	if($bamboo['cpt_layout_toggle']) {
		if(is_page()) { 
			$sidebar2width = $bamboo['page-sidebar2-width'];
	
		} 	elseif(is_search()) {
				$sidebar2width = $bamboo['search-sidebar2-width'];
		}	elseif(is_single()) {
				$sidebar2width = $bamboo['single-sidebar2-width'];
		}else {
			$sidebar2width = $bamboo['sidebar2-width'];
		}
	}
	else {
		$sidebar2width = $bamboo['sidebar2-width'];
	}?>
	
	<div id="sidebar2" class="sidebar col col-<?php echo $sidebar2width; ?>" role="complementary">

	<?php if ( is_active_sidebar( 'sidebar-secondary' ) ) : ?>

		<?php dynamic_sidebar( 'sidebar-secondary' ); ?>

	<?php endif; ?>

</div>