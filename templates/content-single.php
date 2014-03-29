<?php 

// No direct Access
defined('ABSPATH') or die("Cannot access pages directly.");

global $bamboo;

if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

		<header class="article-header">
			
			<?php the_post_thumbnail( 'bones-thumb-900' ); ?>
			
			<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
			<p class="byline vcard"><?php
				printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> <span class="amp">&amp;</span> filed under %4$s.', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( get_option('date_format')), bones_get_the_author_posts_link(), get_the_category_list(', ') );
			?></p>

		</header>

		<section class="entry-content clearfix" itemprop="articleBody">
			<?php the_content('Read more ...'); ?>
		</section>

		<footer class="article-footer">
			<?php the_tags( '<div class="tags"><h3 class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</h3> ', ' ', '</div>' ); ?>
			<?php if($bamboo['author_profile']) { get_template_part('templates/author', 'profile');} ?>
		</footer>

		<?php comments_template(); ?>

	</article>

<?php endwhile; ?>

<?php else : ?>

	<?php get_template_part('templates/content', 'notfound'); ?>

<?php endif; ?>