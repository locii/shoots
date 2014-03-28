<?php

global $bamboo;
/**
 * Custom functions
 */

class zen {
	
	/**
		 * The framework instance
		 *
		 * @since  3.0.0
		 */
		protected static $instance;
	
		/**
		 * The application instance
		 *
		 * @since  3.0.0
		 */
		public $app;
	
		/**
		 * The document instance
		 *
		 * @since  3.0.0
		 */
		public $doc;
	
		/**
		 * The params instance
		 *
		 * @since  3.0.0
		 */
		public $params;
		
		
	/**
		 * Returns a refernce to the global Zen object, only creating it if it doesn't already exist.
		 *
		 * This method must be invoked as: $zen = bamboo::getInstance();
		 *
		 * @return  ZenGrid
		 *
		 * @since   2.0.0
		 */
		public static function getInstance()
		{
			// Only create the object if it doesn't exist.
			if (empty(self::$instance))
			{
				self::$instance = new self();
			}
	
			return self::$instance;
		}
	
	
	
	public function widget_positions() {
	
			$positions = array('top','banner','grid1','grid2','grid3','sidebar-1','sidebar-2','above','below','grid4','grid5','grid6','bottom','footer','search');	
			
			return $positions;			
	}
	
	
	

	/**
	 * 	Function to test if a widget i spublished
	 *
	 * 	Returns true if published
	 */
	 
	public function count_position($position) {
	
		$widgets = get_option('sidebars_widgets');
		
		if(isset($widgets[$position])) {
			$count = count($widgets[$position]);
			
			if($count > 0) return 12/$count;
		}
		
	}
	
	
	/**
	 * 	Function to test the number of widgets published in a given position
	 *	And then determine the number of columns for that widget
	 * USed to count when there are more than one widgets in a row
	 * 	Returns integer
	 */
	 
	public function count_widgets($position) {
		
		$the_sidebars = wp_get_sidebars_widgets();
		return 12/(count( $the_sidebars[$position] ));
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