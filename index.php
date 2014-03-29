<?php 

// No direct Access
defined('ABSPATH') or die("Cannot access pages directly.");

	get_header(); 	
?>
					
	<div id="midcol" class="col col-<?php echo $mainwidth; ?> first" role="main">
				
			<?php bamboo::display_widget('above-content') ?>
			
			<?php get_template_part('templates/content', 'index'); ?>
			
			<?php bamboo::display_widget('below-content') ?>
	
			</div>

	<?php get_footer(); ?>