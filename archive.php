<?php
// No direct Access
defined('ABSPATH') or die("Cannot access pages directly.");


include(locate_template('layout-logic.php'));


get_header(); ?>
	
			<div id="midcol" class="col col-<?php echo $mainwidth; ?> first clearfix archive" role="main">
							
							<?php bamboo::display_widget('above-content') ?>
							
							<?php if (is_category()) { ?>
								<h1 class="archive-title h2">
									<span><?php _e( 'Posts Categorized:', 'bonestheme' ); ?></span> <?php single_cat_title(); ?>
								</h1>

							<?php } elseif (is_tag()) { ?>
								<h1 class="archive-title h2">
									<span><?php _e( 'Posts Tagged:', 'bonestheme' ); ?></span> <?php single_tag_title(); ?>
								</h1>

							<?php } elseif (is_author()) {
								global $post;
								$author_id = $post->post_author;
							?>
								<h1 class="archive-title h2">

									<span><?php _e( 'Posts By:', 'bonestheme' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>

								</h1>
							<?php } elseif (is_day()) { ?>
								<h1 class="archive-title h2">
									<span><?php _e( 'Daily Archives:', 'bonestheme' ); ?></span> <?php the_time('l, F j, Y'); ?>
								</h1>

							<?php } elseif (is_month()) { ?>
									<h1 class="archive-title h2">
										<span><?php _e( 'Monthly Archives:', 'bonestheme' ); ?></span> <?php the_time('F Y'); ?>
									</h1>

							<?php } elseif (is_year()) { ?>
									<h1 class="archive-title h2">
										<span><?php _e( 'Yearly Archives:', 'bonestheme' ); ?></span> <?php the_time('Y'); ?>
									</h1>
							<?php } ?>

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

									<?php if ( function_exists( 'bones_page_navi' ) ) { ?>
										<?php bones_page_navi(); ?>
									<?php } else { ?>
										<nav class="wp-prev-next">
											<ul class="clearfix">
												<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'bonestheme' )) ?></li>
												<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'bonestheme' )) ?></li>
											</ul>
										</nav>
									<?php } ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry clearfix">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the archive.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>
							
							
					<?php bamboo::display_widget('below-content') ?>
				</div>

			<?php get_footer(); ?>
