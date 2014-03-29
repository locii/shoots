<?php

// No direct Access
defined('ABSPATH') or die("Cannot access pages directly.");

/*
Template Name: Featured
Description: A featured layout where the first item is full width and displays the full text and subsequent titles show the image plus excerpt.
*/



get_header(); ?>


				
				<div id="midcol" class="col col-<?php echo $mainwidth; ?> first" role="main">
						
						<?php bamboo::display_widget('above-content') ?>
						
						<?php get_template_part('templates/content', 'featured'); ?>
						
						<?php bamboo::display_widget('below-content') ?>				
				</div>
			
<?php get_footer(); ?>