<?php
/*
Author profile partial
*/

?>

<div class="author-block">
<h3>Author Information</h3>
	<div id="author-profile-avatar" class="col col-3 first">
		<?php echo get_avatar( $post->post_author );?>
	</div>
	
	<div id="author-profile" class="col col-9">
		<?php if(get_the_author_meta('description') !=="") { ?>
			<p><?php the_author_meta('description')  ?></p>
			
		<?php } 
			// If author has more than one post
			$min_posts = 2;
			if( count_user_posts( $post->post_author ) >= $min_posts ) { ?>
				<h3>More posts by <?php the_author_posts_link(); ?></h3>
			   <?php echo my_get_display_author_posts();
			} else { ?>
				<p>Written by <?php the_author_posts_link(); ?></p>
			<?php }
		?>
	</div>
</div>