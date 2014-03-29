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
		<?php dynamic_sidebar( 'sidebar-primary' ); ?>
	</div>
<?php endif; ?>