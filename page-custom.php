<?php

// No direct Access
defined('ABSPATH') or die("Cannot access pages directly.");

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
	
/*
Template Name: Custom Page Example
*/

?>

<?php get_header(); ?>

						
<div id="content" class="container <?php echo $layout_type; ?>">
	<div id="inner-content" class="container clearfix">
		
		<div id="breadcrumb">
			<?php the_breadcrumb(); ?>
		</div>
		
		<?php // Small compromise on not adding pull classes for three cols
			if($layout =="5") { 
				get_sidebar();
			} ?>
			
			<div id="midcol" class="eightcol first clearfix" role="main">
	
	<?php bamboo::display_widget('above-content',$post->ID) ?>
								
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

		<header class="article-header">

			<h1 class="page-title"><?php the_title(); ?></h1>
			<p class="byline vcard"><?php
				printf(__( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> <span class="amp">&</span> filed under %4$s.', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(__( 'F jS, Y', 'bonestheme' )), get_author_posts_url( get_the_author_meta( 'ID' ) ), get_the_category_list(', '));
			?></p>
			


		</header>

		<section class="entry-content clearfix" itemprop="articleBody">
			<?php the_content('Read more ...'); ?>
		</section>

		<footer class="article-footer">
			<?php the_tags( '<div class="tags"><h3 class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</h3> ', ' ', '</div>' ); ?>

		</footer>

		<?php comments_template(); ?>

	</article>

	<?php endwhile; else : ?>

			<article id="post-not-found" class="hentry clearfix">
					<header class="article-header">
						<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
				</header>
					<section class="entry-content">
						<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
				</section>
				<footer class="article-footer">
						<p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
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
