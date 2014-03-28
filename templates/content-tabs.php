<?php
	/**
	 * Show page title and content
	 */
	?>
	
	<?php global $bamboo;?>
	
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<header class="entry-header">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</header>
			<div class="entry-content">
				<?php the_content('Read more ...'); ?>
			</div>
		<?php endwhile; ?>

		<div class="entry-content columns">

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
			$show_posts = $bamboo['tab-count']; // change this to how many posts you want to show

		?>
		
		<ul class="tab-list" data-uk-switcher="{connect:'#bamboo-tabs'}">
		    
		<?php $wp_query = new WP_Query( 'post_type=' . $post_type . '&posts_per_page=' . $show_posts . '&paged=' . $paged ); ?>
			<?php 
			$counter = 0;
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
			$counter++;
			
			?>
			
			<li>
				
				<h2 class="entry-title">
					<a class="btn" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s'),the_title_attribute('echo=0')); ?>"><?php the_title(); ?>
					</a>
				</h2>
				
			</li>
			<!-- .column -->
			<?php endwhile; ?>
			</ul>
			
		
		<!-- This is the subnav containing the toggling elements -->
		<ul id="bamboo-tabs" class="bamboo-tabs uk-switcher">
		<?php $wp_query = new WP_Query( 'post_type=' . $post_type . '&posts_per_page=' . $show_posts . '&paged=' . $paged ); ?>
			<?php 
			$counter = 0;
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
			$counter++;
			
			?>
			
			<li>
				<div class="item-<?php echo $counter;?> <?php if($counter == "1") { echo "first";} ?>">
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s'),the_title_attribute('echo=0')); ?>">
					<?php the_post_thumbnail('large'); ?></a>
							<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s'),the_title_attribute('echo=0')); ?>">
							<?php the_title(); ?>
						</a>
					</h2>
				
				<?php echo get_the_excerpt(); ?>
				</div>
			</li>
			<!-- .column -->
			<?php endwhile; ?>
		</ul>
		<?php wp_reset_postdata(); ?>
		</div><!-- .columns -->
		<div class="clearfix"></div>
		<?php //previous_posts_link(); ?>
		<?php //next_posts_link(); ?>

		<?php $wp_query = NULL; $wp_query = $temp; ?>

	<?php else : ?>

		<?php get_template_part('templates/content', 'notfound'); ?>

	<?php endif; ?>