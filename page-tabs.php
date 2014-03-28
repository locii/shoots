<?php 
/*
Template Name: Tabs
Description: A tabbed layout template
*/
global $bamboo;
	
	// Logic for sidebar widths
	if($bamboo['cpt_layout_toggle']) {
		$layout = $bamboo['page_layout'];
		$mainwidth = $bamboo['page-main-width'];
	} else {
		$layout = $bamboo['layout'];
		$mainwidth = $bamboo['main-width'];
	}

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
	
	get_header(); ?>

<?php
/**
 * Move the styles below into your stylesheet
 */
?>


<section id="main" class="<?php if($bamboo['breadcrumb']) {?>with-breadcrumb<?php } ?> page-tabs page">
	<div id="content" class="container <?php echo $layout_type; ?>">
		<div id="inner-content" class="container clearfix">
			<div id="breadcrumb">
				<?php the_breadcrumb(); ?>
			</div>
			
			<?php // Small compromise on not adding pull classes for three cols
				if($layout =="5") { 
					get_sidebar();
				} 
			?>
				
			<div id="midcol" class="col col-<?php echo $mainwidth; ?> first" role="main">
				<?php bamboo::display_widget('above-content') ?>
				
				<?php get_template_part('templates/content', 'tabs'); ?>
				
				<?php bamboo::display_widget('below-content') ?>
			</div>

			<?php if($layout > 0 && $layout < 5) { 
				get_sidebar();
			} ?>
				
			<?php if($layout > 2) { 
				get_sidebar('secondary');
			} ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>