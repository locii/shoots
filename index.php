<?php 

// No direct Access
defined('ABSPATH') or die("Cannot access pages directly.");

	global $bamboo;
		
		// Logic for sidebar widths	
		$layout = $bamboo['layout'];
		$mainwidth = $bamboo['main-width'];
	
		if($layout == 0) {
			$mainwidth = "12";
			$layout_type = "full-width";
		}
		
		if($layout == 1) {
			$layout_type = "main-left two-col";
		} elseif ($layout == 2) {
			$layout_type = "main-right two-col";
		} elseif ($layout == 3) {
			$layout_type = "main-right three-col";
		} elseif ($layout == 4) {
			$layout_type = "main-left three-col";
		} elseif ($layout == 5) {
			$layout_type = "left-mid-right three-col";
		}
		
		get_header(); 	
?>
					
	<div id="midcol" class="col col-<?php echo $mainwidth; ?> first" role="main">
				
			<?php bamboo::display_widget('above-content',$post->ID) ?>
			
			<?php get_template_part('templates/content', 'index'); ?>
			
			<?php bamboo::display_widget('below-content',$post->ID) ?>
	
			</div>

	<?php get_footer(); ?>