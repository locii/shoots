<?php 

// No direct Access
defined('ABSPATH') or die("Cannot access pages directly.");

	global $bamboo;
		
	// Logic for sidebar widths
	if($bamboo['cpt_layout_toggle']) {
		$layout = $bamboo['single_layout'];
		$mainwidth = $bamboo['single-main-width'];
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
	
		<div id="content" class="container <?php echo $layout_type; ?>">
			<div id="inner-content" class="container clearfix">
				
				<div id="breadcrumb">
					<?php the_breadcrumb(); ?>
				</div>
				
				<?php // Small compromise on not adding pull classes for three cols
					if($layout =="5") { 
						get_sidebar();
					} ?>
					<div id="midcol" class="col col-<?php echo $mainwidth; ?> first" role="main">
					
						<?php bamboo::display_widget('above-content',$post->ID) ?>
						
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
									<?php
										/*
										 * Ah, post formats. Nature's greatest mystery (aside from the sloth).
										 *
										 * So this function will bting in the needed template file depending on what the post
										 * format is. The different post formats are located in the post-formats folder.
										 *
										 *
										 * REMEMBER TO ALWAYS HAVE A DEFAULT ONE NAMED "format.php" FOR POSTS THAT AREN'T
										 * A SPECIFIC POST FORMAT.
										 *
										 * If you want to remove post formats, just delete the post-formats folder and
										 * replace the function below with the contents of the "format.php" file.
										*/
										get_template_part( 'post-formats/format', get_post_format() );
									?>
		
								<?php endwhile; ?>
						
							
								<?php else : ?>
								
								<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>
						
						<?php bamboo::display_widget('below-content',$post->ID) ?>
						</div>
						
						<?php if($layout > 0 && $layout < 5) { 
									get_sidebar();
								} ?>
									
								<?php if($layout > 2) { 
									get_sidebar('secondary');
								} ?>
								
						
								</div>
							</div>

<?php get_footer(); ?>
