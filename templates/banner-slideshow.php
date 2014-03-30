<?php

// No direct Access
defined('ABSPATH') or die("Cannot access pages directly.");

	global $bamboo;
	/**
	 * Slideshow
	 */
	?>
	
	<div id="bamboo-slideshow" class="container">
		
			<div class="col col-12 first">
				<ul class="rslides">
	  
	
					<?php
						
						$slideshow = $bamboo['opt-slides'];
						
						foreach( $slideshow as $slide ){
						
							$title = $slide['title'];
							$description = $slide['description'];
							$link = $slide['url'];
							$image = $slide['image'];
					
						?>
							<li>
								<h2><?php echo $title;?></h2>
								<p><?php echo $description;?></p>
								
								<a href="<?php echo $link;?>">
									<img src="<?php echo $image;?>" alt="<?php echo $title;?>" />
								</a>
								
							</li>
						<?php }
					?>
					</ul>
						
						<div id="slideshow-nav"></div>
						
						<script src="<?php echo get_template_directory_uri(); ?>/library/js/responsiveSlides.min.js"></script>
						
						<script>
						  jQuery(function($) {
						    $(".rslides").responsiveSlides({
						    	pager: true,           // Boolean: Show pager, true or false
						    	nav: true,             // Boolean: Show navigation, true or false
						    	navContainer: "#slideshow-nav"       // Selector: Where controls should be appended to, default is after the 'ul'
						    });
						  });
						</script>
				</div>
			</div>

	