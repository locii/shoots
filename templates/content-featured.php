<?php

// No direct Access
defined('ABSPATH') or die("Cannot access pages directly.");

	/**
	 * Show page title and content
	 */
	?>
	
	<?php global $bamboo;?>
	
	<?php if ( have_posts() ) : ?>
		
		<?php if($bamboo['featured-content']) {  
		
			while ( have_posts() ) : the_post(); ?>
				<header class="entry-header">
					<h1 class="page-title"><?php the_title(); ?></h1>
				</header>
				<div class="entry-content featured-block">
					<?php the_post_thumbnail( 'bones-thumb-900' ); ?>
					<?php the_content('Read more ...'); ?>
				</div>
				<div class="divider tight"></div>
			<?php endwhile; 
		} ?>
		

		<div class="entry-content">

		<?php
		/**
		 * Create a new WP_Query
		 * Set $wp_query object to temp
		 * Grab $paged variable so pagination works
		 */
		?>
		<?php
			global $wp_query; $post; $post_id = $post-> ID;
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			rewind_posts();
			$temp = $wp_query;
			$wp_query = NULL;
			$post_type = 'post'; // change this to the post type you want to show
			$show_posts = $bamboo['featured-count']; // change this to how many posts you want to show

		?>
		<?php $wp_query = new WP_Query( 'post_type=' . $post_type . '&posts_per_page=' . $show_posts . '&paged=' . $paged ); ?>
			<?php 
			$counter = 0;
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
			$counter++;
			
			?>
			
			<div class="item-<?php echo $counter;?> <?php if($counter == "1") { echo "first";} ?>">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s'),the_title_attribute('echo=0')); ?>"></a>
				
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s'),the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h2>
				
				<?php if ( has_post_thumbnail() ) {?>
				<div class="col col-4 first">
					<?php the_post_thumbnail( 'bones-thumb-square' ); ?>
				</div>
				
				<div class="col col-8">	
					<?php echo get_the_excerpt() ; ?>
				</div>
				<?php } else { ?>
					<div class="col col-12 first">	
						<?php echo get_the_excerpt() ; ?>
					</div>
				<?php } ?>
				<div class="clearfix"></div>
			</div><!-- .column -->
			<div class="divider tight"></div>
			<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
		</div>
		
		<div class="clearfix"></div>
		<?php //previous_posts_link(); ?>
		<?php //next_posts_link(); ?>

		<?php $wp_query = NULL; $wp_query = $temp; ?>

	<?php else : ?>

		<?php get_template_part('templates/content', 'notfound'); ?>

	<?php endif; ?>