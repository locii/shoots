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
						$slideshow = array_diff( $slideshow, array( '' ) );
						foreach( $slideshow as $slide ){
							
							if($slide !=="") {
								$title = $slide['title'];
								$description = $slide['description'];
								$link = $slide['url'];
								$image = $slide['image'];
						
								if($title && $description && $link && $image !=="") {
							?>
								<li>
									 <div class="col col-4 first">
									 	<a href="<?php echo $link;?>">
									 		<img class="border" src="<?php echo $image;?>" alt="<?php echo $title;?>" />
									 	</a>
									 </div>
									 
									<div class="col col-8">
										<h2><?php echo $title;?></h2>
										<p><?php echo $description;?></p>
									</div>
									
								</li>
							<?php }
							
							}
						}
					?>
					</ul>
						
						<div id="slideshow-nav"></div>
						
						<script src="<?php echo get_template_directory_uri(); ?>/library/js/responsiveSlides.min.js"></script>
						
						<script>
						  jQuery(function($) {
						    $(".rslides").responsiveSlides({
						    	pager: true,           // Boolean: Show pager, true or false
						    	nav: false,             // Boolean: Show navigation, true or false
						    	navContainer: "#slideshow-nav"       // Selector: Where controls should be appended to, default is after the 'ul'
						    });
						  });
						</script>
				</div>
			</div>

	