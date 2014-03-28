<?php

global $bamboo;

 if (have_posts()) : while (have_posts()) : the_post(); 
 
 $classes = array(
     'class1',
     'class2',
     'class3'
   );
   
   ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?> role="article">

		<header class="article-header">

			<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
			<p class="byline vcard">
				<?php printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
			</p>

		</header>

		<section class="entry-content cf">
			<?php the_post_thumbnail( 'bones-thumb-900' ); ?>
			
			<?php the_content('Read more ...'); ?>
		</section>

		<footer class="article-footer cf">
			<p class="footer-comment-count">
				<?php comments_number( __( '<span>No</span> Comments', 'bonestheme' ), __( '<span>One</span> Comment', 'bonestheme' ), _n( '<span>%</span> Comments', '<span>%</span> Comments', get_comments_number(), 'bonestheme' ) );?>
			</p>

			<?php printf( __( '<p class="footer-category">Filed under: %1$s</p>', 'bonestheme' ), get_the_category_list(', ') ); ?>

            <?php the_tags( '<div class="tags"><h3 class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</h3> ', ' ', '</div>' ); ?>
            
      

		</footer>

	</article>
				<?php endwhile; ?>
				
	<?php bones_page_navi(); ?>

	<?php else : ?>

			<article id="post-not-found" class="hentry cf">
					<header class="article-header">
						<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
				</header>
					<section class="entry-content">
						<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
				</section>
				<footer class="article-footer">
						<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
				</footer>
			</article>

	<?php endif; ?>					