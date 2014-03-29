<?php

// No direct Access
defined('ABSPATH') or die("Cannot access pages directly.");

	/**
	 * Slideshow
	 */
	?>
	
	
	<ul class="rslides">
	  
	
<?php
	$args = array( 'numberposts' => '5' );
	$recent_posts = wp_get_recent_posts($args);
	
	foreach( $recent_posts as $recent ){?>
		<li>
			<h2>
		 		<a href="<?php echo get_permalink($recent["ID"]);?>" title="Look <?php echo esc_attr($recent["post_title"]);?>">
		 		<?php echo $recent["post_title"];?></a>
		 	</h2>
		 	<p>
		 		<?php if ( has_post_thumbnail() ) {
		 			the_post_thumbnail();
		 		} ;?>
		 		<?php echo $recent["post_excerpt"];?>
		 		
		 	</p>
		</li>
	<?php }
?>
</ul>
	
	<div id="slideshow-nav"></div>
	
	<script src="<?php echo get_template_directory_uri(); ?>/js/responsiveslides.min.js"></script>
	
	<script>
	  jQuery(function($) {
	    $(".rslides").responsiveSlides({
	    	pager: true,           // Boolean: Show pager, true or false
	    	nav: true,             // Boolean: Show navigation, true or false
	    	navContainer: "#slideshow-nav"       // Selector: Where controls should be appended to, default is after the 'ul'
	    });
	  });
	</script>
	