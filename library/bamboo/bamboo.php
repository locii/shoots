<?php

global $bamboo;
/**
 * Custom functions
 */

class bamboo {
	
		public function display_widget($position,$currentpage)
			{
						
				if ( is_active_sidebar( $position) ) : 
				
				
				
					global $bamboo;
				
					$display_banner = $bamboo[$position.'-widget-pages'];
					
					// If its just one page in the field check whether we should proceed
					if(!is_array($display_banner)) {
							
						if($display_banner !== $currentpage) {			
							return;	
							}
					}
					elseif(in_array("all", $display_banner)) {
							
						// proceed
							
					} elseif (!in_array($currentpage, $display_banner)) {
					
							return;
					}
						
					$count = 12/self::count_widgets($position);
							
					// In case 5 widgets are published
					if($count == "2.4") {
						$count="fifths";
					}
					
					ob_start();
					?>
						
					<!-- <?php echo $position; ?> Widget -->
					<section id="<?php echo $position; ?>wrap" class="clearfix widgets widgets-<?php echo $count;?> <?php echo $bamboo[''.$position.'-widget-align'];?>">
						<div class="container">
							<div id="<?php echo $position; ?>">
								<?php dynamic_sidebar( $position ); ?>
							</div>
						</div>
					</section>
						
					<?php 
					
						
						return ob_get_contents();
						
				endif;
	
			}


		public function display_extra($position,$currentpage)
			{
						
				global $bamboo;
				
				$display = 1;
				$display_banner = $bamboo[$position.'-pages'];
				
				
					// If its just one page in the field check whether we should proceed
					if(!is_array($display_banner)) {
								
						if($display_banner !== $currentpage) {			
							$display = 0;	
						}
					}
					elseif(in_array("all", $display_banner)) {
								
						$display = 1;
								
					} elseif (!in_array($currentpage, $display_banner)) {
						$display = 0;
					}
					
					elseif (!in_array($currentpage, $display_banner)) {
						
					}
				
				
				return $display;
	
			}
	
	


	/**
	 * 	Function to test the number of widgets published in a given position
	 *	And then determine the number of columns for that widget
	 * USed to count when there are more than one widgets in a row
	 * 	Returns integer
	 */
	 
	public function count_widgets($position) {
		
		$the_sidebars = wp_get_sidebars_widgets();
		return count( $the_sidebars[$position] );
	}
	
	
	
	/**
	 * 	Function to test the number of widgets published in a given row
	 *	And then determine the number of columns for that widget
	 * USed to count when there are more than one widgets in a row
	 * 	Returns integer
	 */
	 
	public function block_width(array $positions) {
		
		$count = 0;
		
		for ($i = 0; $i < count($positions); $i++) {
			if(bamboo::count_position($positions[$i])) {
				$count += intval(1);
			}
		}
	
		return 12/$count;	
	}
	
	
	
	/**
		 * Lazy Load
		 *
		 *
		 */
		public function lazyload($enabled,$llselector,$notllselector)
		{
	
			if ($enabled) {
	
			ob_start(); ?>
			
				<script type="text/javascript">
					jQuery(document).ready(function(){
						jQuery("<?php echo $llselector; ?>").not("<?php echo $notllselector; ?>").lazyload({
							effect : "fadeIn"
						});
					});
				</script>
				<?php
	
				return ob_get_clean();
			}
		}


/**
	 * Back to top
	 *
	 *
	 */
	public function backtotop($enabled)
	{
		if ($enabled) {

			ob_start();
			?>
			<div id="toTop" class="hidden-phone">
				<a id="toTopLink">
					<span class="icon-up-open-mini"></span>
				</a>
			</div>

			<script type="text/javascript">
				jQuery(document).ready(function(){

					jQuery(window).scroll(function () {

						if (jQuery(this).scrollTop() >200) {
							jQuery("#toTop").fadeIn();
						}
						else {
							jQuery("#toTop").fadeOut();
						}
					});

					jQuery("#toTop").click(function() {
						jQuery("html, body").animate({ scrollTop: 0 }, "slow");
						 return false;
					});
				});
			</script>
			<?php

			return ob_get_clean();
		}
	}




/**
	 * Fonts
	 *
	 * 
	 */
	 
	public function fonts() {
	
		global $bamboo;
		
		if(
			$bamboo['bodyfont'] == "Google" ||
			$bamboo['headingfont'] == "Google" ||
			$bamboo['navfont'] == "Google" ||
			$bamboo['logofont'] == "Google"
		) {
		
			// Font array
			$myfonts = array();
				
			
			// Check to see if the font should be added to the array
			if($bamboo['bodyfont'] == "Google") {
				$bodyFont = str_replace(" ", "+", $bamboo['body-google-font']);
				$myfonts[] = "'$bodyFont'";
			}
			
			if($bamboo['headingfont'] == "Google") {
				$bodyFont = str_replace(" ", "+", $bamboo['heading-google-font']);
				$myfonts[] = "'$bodyFont'";
			}
			
			if($bamboo['navfont'] == "Google") {
				$bodyFont = str_replace(" ", "+", $bamboo['nav-google-font']);
				$myfonts[] = "'$bodyFont'";
			}
			
			if($bamboo['logofont'] == "Google") {
				$bodyFont = str_replace(" ", "+", $bamboo['logo-google-font']);
				$myfonts[] = "'$bodyFont'";
			}
			
			

		
			// Remove Duplicates
			$myfonts = array_unique($myfonts);
			
			// Remove comma from last font
			$lastfont = end($myfonts);
			
		
			ob_start(); ?>
			
			<script type="text/javascript">
			      WebFontConfig = {
			      
			      google: {
			          families: [ 
			          	<?php foreach ($myfonts as $font) {echo $font; if (!($font == $lastfont)){echo ', ';}} ?>
			          ]}
			      };
			      
			      (function() {
			        var wf = document.createElement('script');
			        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
			            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
			        wf.type = 'text/javascript';
			        wf.async = 'true';
			        var s = document.getElementsByTagName('script')[0];
			        s.parentNode.insertBefore(wf, s);
			      })();
			</script>
			
			<?php return ob_get_clean();
			
			}
		
		}
	
	
		/**
		 * Clean Fonts
		 * Used to prepare font names in Fotn Loader
		 * 
		 */
		function cleanFonts($subject) {
			$font = explode(':', str_replace("+", " ", $subject));
			return $font[0];
		}

	
	
}