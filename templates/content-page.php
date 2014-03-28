<?php 
	
	// Define options
	global $bamboo; 

	if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

			<header class="article-header">
			
				<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
			
				<p class="byline vcard">
					<?php printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
				</p>
			
			</header>

			<?php the_post_thumbnail( 'bones-thumb-900' ); ?>

			<section class="entry-content clearfix" itemprop="articleBody">
				<?php the_content('Read more ...'); ?>
			</section>

			<footer class="article-footer">
				<?php the_tags( '<div class="tags"><h3 class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</h3> ', ' ', '</div>' ); ?>
			
				<?php if($bamboo['author_profile']) { get_template_part('templates/author', 'profile');} ?>
			</footer>

			<?php comments_template(); ?>

		</article>

		<?php endwhile; else : ?>

			<?php get_template_part('templates/content', 'notfound'); ?>

	<?php endif; ?>