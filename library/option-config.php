<?php

/**
	ReduxFramework Sample Config File
	For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
**/

if ( !class_exists( "ReduxFramework" ) ) {
	return;
} 

if ( !class_exists( "Redux_Framework_sample_config" ) ) {
	class Redux_Framework_sample_config {

		public $args = array();
		public $sections = array();
		public $theme;
		public $ReduxFramework;

		public function __construct( ) {

			// Just for demo purposes. Not needed per say.
			$this->theme = wp_get_theme();

			// Set the default arguments
			$this->setArguments();
			
			// Set a few help tabs so you can see how it's done
			$this->setHelpTabs();

			// Create the sections and fields
			$this->setSections();
			
			if ( !isset( $this->args['opt_name'] ) ) { // No errors please
				return;
			}
			
			$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
			

			// If Redux is running as a plugin, this will remove the demo notice and links
			//add_action( 'redux/plugin/hooks', array( $this, 'remove_demo' ) );
			
			// Function to test the compiler hook and demo CSS output.
			//add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2); 
			// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.

			// Change the arguments after they've been declared, but before the panel is created
			//add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
			
			// Change the default value of a field after it's been set, but before it's been used
			//add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

			// Dynamically add a section. Can be also used to modify sections/fields
			//add_filter('redux/options/'.$this->args['opt_name'].'/sections', array( $this, 'dynamic_section' ) );

		}


		/**

			This is a test function that will let you see when the compiler hook occurs. 
			It only runs if a field	set with compiler=>true is changed.

		**/
		
		function compiler_action($options, $css) {
			echo "<h1>The compiler hook has run!";
			//print_r($options); //Option values
			
			// print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
			
			// Demo of how to use the dynamic CSS and write your own static CSS file
		    $filename = dirname(__FILE__) . '/style' . '.css';
		    global $wp_filesystem;
		    if( empty( $wp_filesystem ) ) {
		        require_once( ABSPATH .'/wp-admin/includes/file.php' );
		        WP_Filesystem();
		    }

		    if( $wp_filesystem ) {
		        $wp_filesystem->put_contents(
		            $filename,
		            $css,
		            FS_CHMOD_FILE // predefined mode settings for WP files
		        );
		    }
			
		}



		/**
		 
		 	Custom function for filtering the sections array. Good for child themes to override or add to the sections.
		 	Simply include this function in the child themes functions.php file.
		 
		 	NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
		 	so you must use get_template_directory_uri() if you want to use any of the built in icons
		 
		 **/

		function dynamic_section($sections){
		   

		    return $sections;
		}
		
		
		/**

			Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

		**/
		
		function change_arguments($args){
		    //$args['dev_mode'] = true;
		    
		    return $args;
		}
		
		
				
		
		/**

			Filter hook for filtering the default value of any given field. Very useful in development mode.

		**/

		function change_defaults($defaults){
		    $defaults['str_replace'] = "Testing filter hook!";
		    
		    return $defaults;
		}


		// Remove the demo link and the notice of integrated demo from the redux-framework plugin
		function remove_demo() {
			
			// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
			if ( class_exists('ReduxFrameworkPlugin') ) {
				remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_meta_demo_mode_link'), null, 2 );
			}

			// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
			remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );	

		}


		public function setSections() {

			/**
			 	Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
			 **/


			// Hilite files
			 $files=glob(get_stylesheet_directory().'/less/presets/*.less');
			 
			 $styles = array();
			 foreach ($files as $file) {
			     $file = basename($file);
			     $file = str_replace('.less', '',$file);
			     $styles [$file]=$file;
			 }
			 
			 // From bamboo-framework
			 $post_types = get_post_types( array( 'public' => true ), 'names' );
			 
			
			 // Base fonts
			 
			$fonts = array(
				
					"Google" => "Google",
					"Cambria, Georgia, Times, Times New Roman, serif" => "Cambria, Georgia, Times, Times New Roman, serif",
					"Adobe Caslon Pro, Georgia, Garamond, Times, serif" => "Adobe Caslon Pro, Georgia, Garamond, Times, serif",
					"Courier new, Courier, Andale Mono" => "Courier new, Courier, Andale Mono",
					"Georgia, Times, ‘Times New Roman’, serif" => "Georgia, Times, ‘Times New Roman’, serif",
					"GillSans, Calibri, Trebuchet, arial sans-serif" => "GillSans, Calibri, Trebuchet, arial sans-serif",
					"sans-serif" => "sans-serif",
					"Lucida Grande, Geneva, Helvetica, sans-serif" => "Lucida Grande, Geneva, Helvetica, sans-serif",
					"Palatino, ‘Times New Roman’, serif" => "Palatino, ‘Times New Roman’, serif",
					"Tahoma, Verdana, Geneva" => "Tahoma, Verdana, Geneva",
					"Trebuchet ms, Tahoma, Arial, sans-serif" => "Trebuchet ms, Tahoma, Arial, sans-serif");
			 
			 
			

			// Background Patterns Reader
			$sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
			$sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
			$sample_patterns      = array();

			if ( is_dir( $sample_patterns_path ) ) :
				
			  if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
			  	$sample_patterns = array();

			    while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

			      if( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
			      	$name = explode(".", $sample_patterns_file);
			      	$name = str_replace('.'.end($name), '', $sample_patterns_file);
			      	$sample_patterns[] = array( 'alt'=>$name,'img' => $sample_patterns_url . $sample_patterns_file );
			      }
			    }
			  endif;
			endif;

			ob_start();

			$ct = wp_get_theme();
			$this->theme = $ct;
			$item_name = $this->theme->get('Name'); 
			$tags = $this->theme->Tags;
			$screenshot = $this->theme->get_screenshot();
			$class = $screenshot ? 'has-screenshot' : '';

			$customize_title = sprintf( __( 'Customize &#8220;%s&#8221;','bamboo-framework' ), $this->theme->display('Name') );

			?>
			<div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
				<?php if ( $screenshot ) : ?>
					<?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
					<a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr( $customize_title ); ?>">
						<img src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview' ); ?>" />
					</a>
					<?php endif; ?>
					<img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview' ); ?>" />
				<?php endif; ?>

				<h4>
					<?php echo $this->theme->display('Name'); ?>
				</h4>

				<div>
					<ul class="theme-info">
						<li><?php printf( __('By %s','bamboo-framework'), $this->theme->display('Author') ); ?></li>
						<li><?php printf( __('Version %s','bamboo-framework'), $this->theme->display('Version') ); ?></li>
						<li><?php echo '<strong>'.__('Tags', 'bamboo-framework').':</strong> '; ?><?php printf( $this->theme->display('Tags') ); ?></li>
					</ul>
					<p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
					<?php if ( $this->theme->parent() ) {
						printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.' ) . '</p>',
							__( 'http://codex.wordpress.org/Child_Themes','bamboo-framework' ),
							$this->theme->parent()->display( 'Name' ) );
					} ?>
					
				</div>

			</div>
			
			<!-- Code to control the hilite dropdown -->
			
			<?php 
				// Get theme variables from files
				
				$themepath = get_template_directory().'/less/presets/';
				$dh = opendir($themepath);
				
				// Array to store the presets found in the preset folder
				$themes = array();
				
				// Array we use to dynamically generate the settings for the theme appearance
				$appearance = simplexml_load_file(get_template_directory().'/parameters/appearance.xml');
				$appearance_variables = array();
			
				foreach ($appearance as $key => $option) {
				
					$title = $option->title;
					$type = $option->type;
					$required = $option->required;
					$compiler = $option->compiler;
					$id = $option->id;
					$desc = $option->desc;
					$default = $option->default;
					
					
					$appearance_variables[]= array(
					    "type" => "$type",
					    "compiler" => "1",
					    "title" => "$title",
					    "id" => "$id",
					    "default" => "$default",
					    'required' => array('appearance-advanced', '=' , "$required"),
					    "desc" => "$desc",
					    );
				}
				
				
				// Array we use to dynamically generate the settings for the theme appearance
					$offcanvas = simplexml_load_file(get_template_directory().'/parameters/offcanvas.xml');
					$offcanvas_variables = array();
				
					foreach ($offcanvas as $key => $option) {
					
						$title = $option->title;
						$type = $option->type;
						$required = $option->required;
						$compiler = $option->compiler;
						$id = $option->id;
						$desc = $option->desc;
						$default = $option->default;
						
						
						$offcanvas_variables[]= array(
						    "type" => "$type",
						    "compiler" => "1",
						    "title" => "$title",
						    "id" => "$id",
						    "default" => "$default",
						    'required' => array('appearance-advanced', '=' , "$required"),
						    "desc" => "$desc",
						    );
					}
				
				
				// Get themes from the theme folder
				while($file = readdir($dh)) {
				    $contents = file_get_contents($themepath . $file);
					
					${$file} = $contents;  
					
					if ($file != "." && $file != "..") {
						$themes[] = $file;
					}
				}
				
				
				// Get contents of each theme file
				foreach ($themes as $theme) {
					$variables = file_get_contents($themepath.$theme);
					$variables = str_replace("\n","",$variables);
					$variables = str_replace(" ","",$variables);
					$variables = str_replace('@', '',$variables);
					$theme = str_replace('.less','',$theme);
					
					echo '<p style="display:none" id="'.$theme.'">'.$variables.'</p>';
				}
			
			?>
			<script>
			jQuery(document).ready(function(){
				
				jQuery("#theme-select").on('change',function () {
					
					var theme = jQuery('#theme-select').find(':selected').val(); 
					var settings = jQuery('#' + theme).text();
					
					
					theme = settings.split(';');
					
					jQuery.each( theme, function( key, value ) {
						var rule = value.split(':');
						
					  jQuery("#bamboo-" + rule[0] + " a").css({"background-color": rule[1]});
					  jQuery('input[data-id="' + rule[0] + '"]').val(rule[1]);
					});

				});
	
			});
			</script>

			<?php
			$item_info = ob_get_contents();
			    
			ob_end_clean();

			$sampleHTML = '';
			if( file_exists( dirname(__FILE__).'/info-html.html' )) {
				/** @global WP_Filesystem_Direct $wp_filesystem  */
				global $wp_filesystem;
				if (empty($wp_filesystem)) {
					require_once(ABSPATH .'/wp-admin/includes/file.php');
					WP_Filesystem();
				}  		
				$sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__).'/info-html.html');
			}



			$this->sections[] = array(
				'icon' => 'el-icon-info-sign',
				'title' => __('Theme Information', 'bamboo-framework'),
				'desc' => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'bamboo-framework'),
				'fields' => array(
					array(
						'id'=>'raw_new_info',
						'type' => 'raw',
						'content' => $item_info,
						)
					),   
				);


			if(file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
			    $tabs['docs'] = array(
					'icon' => 'el-icon-book',
					    'title' => __('Documentation', 'bamboo-framework'),
			        'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
			    );
			}
			
			
		$this->sections[] = array(
				'icon' => 'el-icon-pencil',
				'title' => __('Appearance', 'bamboo-framework'),
				'desc' => __('Settings that control the appearance'),
				'fields' => array (
					
					array(        
					 	"type" => "select",
						"title" => __('Presets', 'bamboo-framework'), 
						"id" => "theme",
						"compiler"=> true,
						"options" => $styles,
						'default'  => 'red',					
						"desc" => "This drop down imports settings for the default themes that ship with this theme. Selecting an item from this list will remove any changes to the current theme you have made. The preset styles ar eimported from the less/presets folder.",
						"default" => "" ),
						
					array(
					  	'title'     => __( 'Advanced appearance', 'bamboo-framework' ),
					  	'desc'      => __( 'Enable this option if you want to fine tune the appearance attributes in your theme.', 'bamboo-framework' ),
					  	'id'        => 'appearance-advanced',
						'default'   => 1,
						'type'      => 'switch',
						'customizer'=> array(),
						
					),
							
					
					// Variables in the appearance-variables.xml get set appended here					
				));
					
					
					
					
					
				
				
				$this->sections[] = array(
					'icon' => 'el-icon-font',
					'title' => __('Logo and Tagline', 'bamboo-framework'),
					'customizer' => 'true',
					'desc' => __('Settings that control the appearance'),
					'fields' => array (
					
					 	
					// Body Fonts
					array(
					    "type" => "button_set",
					    "title" => "Logo type",
					    "id" => "logotype",
					    'customizer' => 'true',
					    'options' => array('text' => 'Text','image' => 'Image','none' => 'None'), //Must provide key => value pairs
					    'default' => 'text',
					    "desc" => "Select between using an image or webfont for your logo."),
					array(
					  	'id'=>'logo-align',
						'type' => 'button_set',
						'customizer' => 'true',
						'title' => __('<strong>Logo Alignment</strong>', 'bamboo-framework'), 
						'desc' => __('Select the position of the logo', 'bamboo-framework'),
						'options' => array('zenleft' => 'Left','zencenter' => 'Center','zenright' => 'Right'), //Must provide key => value pairs
						'default' => 'left'
					),
					array(
					    "type" => "text",
					    "title" => "Logo text",
					    'customizer' => 'true',
					    'required' => array('logotype', '=' , 'text'),
					    "id" => "logotext",
					    "desc" => "Enter the text you want to use for your logo.",
					    "default" => "Shoots"),
					
					array(
						'id'=>'logoimage',
						'type' => 'media', 
						'url'=> true,
						'required' => array('logotype', '=' , 'image'),
						'title' => __('Logo image', 'bamboo-framework'),
						//'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
						'desc'=> __('Upload your logo image.', 'bamboo-framework'),
						'default'=>array('url'=>'http://s.wordpress.org/style/images/codeispoetry.png'),
						),
					array(        
						"type" => "select",
						"title" => "<strong>Logo Font</strong>",
						"id" => "logofont",
						"compiler" => true,
						"options" => $fonts,				
						"desc" => "",
						"default" => "google" ),
					array(
					    "type" => "text",
					    'required' => array('logofont', '=' , 'Google'),
					    "compiler" => true,
					    "title" => "Google font family",
					    "id" => "logo-google-font",
					    
					    "desc" => "Enter the name of the font family you want to use here. eg Open+Sans:400,600,300:latin",
					    "default" => "Open+Sans:400,600,300:latin"),
						
						array(
						    "type" => "color",
						    'required' => array('logotype', '=' , 'text'),
						    "compiler" => true,
						    "title" => "Logo font color",
						    "id" => "logo-font-color",
						    "default" => "#333",
						    "desc" => "Select the color you want to use for the logo for your theme.",
						    ),
						array(
						    "type" => "color",
						    'required' => array('logotype', '=' , 'text'),
						    "compiler" => true,
						    "title" => "Logo font color hover",
						    "id" => "logo-font-color-hover",
						    "default" => "#999",
						    "desc" => "Select the hover color you want to use for the logo for your theme.",
						    ),
						
						array(
						    "type" => "text",
						    "title" => "Logo font weight",
						    "id" => "logo-weight",
						    'required' => array('logotype', '=' , 'text'),
						    "default" => "300",
						    "compiler" => true,
						    "desc" => "Set the weight of the font to use for your body copy. eg 300, 500 normal, bold.",
						    "placeholder" => "normal"),
						    
						array(
						    "type" => "text",
						    "compiler" => true,
						    "title" => "Logo font size",
						    'required' => array('logotype', '=' , 'text'),
						    "compiler" => true,
						    "id" => "logo-font-size",
						    "desc" => "Set the size of the logo font.",
						    "placeholder" => "2.4em",
						    "default" => "2.4em"),
						    
						
						array(
						     "type" => "divide",
						     "id" =>"divide3",
						 ),
						array(
						    "type" => "text",
						    "title" => "Tagline",
						    "id" => "tagline",
						    "default"=>"Schlitz forage tousled roof party meggings",
						    "desc" => "Enter the text you want to use for your tagline."),
						
						array(
						    "type" => "color",
						    "compiler" => true,
						    "title" => "Tagline color",
						    "id" => "tagline-color",
						    "default" => "#999",
						    "desc" => "Select the color for your tagline.",
						    ),
						array(
							'id'=>'tagline-spacing',
							'type' => 'spacing',
							'output' => array('#tagline span'), // An array of CSS selectors to apply this font style to
							'mode'=>'margin', // absolute, padding, margin, defaults to padding
							'right'=>false,
							'bottom'=>false, // Disable the top
							//'right' => false, // Disable the right
							//'bottom' => false, // Disable the bottom
							//'left' => false, // Disable the left
							//'all' => true, // Have one field that applies to all
							//'units' => 'em', // You can specify a unit value. Possible: px, em, %
							//'units_extended' => 'true', // Allow users to select any type of unit
							//'display_units' => 'false', // Set to false to hide the units if the units are specified
							'title' => __('Tagline position', 'bamboo-framework'),
							'subtitle' => __('', 'bamboo-framework'),
							'desc' => __('Set the left and top offset for the tagline.', 'bamboo-framework'),
							'default' => '0'
							),	
						
				),
			);
			
			$this->sections[] = array(
				'icon' => 'el-icon-fontsize',
				'title' => __('Fonts', 'bamboo-framework'),
				'desc' => __('Settings to control the fonts'),
				'fields' => array (
					array(
				    "type" => "text",
				    "title" => "Base font size",
				    "id" => "base-font-size",
				    "compiler" => true,
				    "desc" => "Set the base font of your theme either in px, em or %.",
				    "default" => "80%"),
				    
				   	
				    	
				    // Body Fonts
					array(        
					"type" => "select",
					"title" => "<strong>Body Font</strong>",
					"id" => "bodyfont",
					"compiler" => true,
					"options" => $fonts,					
					"desc" => "",
					"default" => "Google" ),
				
					array(
					    "type" => "text",
					    'required' => array('bodyfont', '=' , 'Google'),
					    "compiler" => true,
					    "title" => "Google font family",
					    "id" => "body-google-font",
					    "desc" => "Enter the name of the font family you want to use here. eg Open+Sans:400,600,300:latin",
					    "default" => "Open+Sans:400,600,300:latin"),
					
					
					array(
					    "type" => "text",
					    "title" => "Body font weight",
					    "id" => "body-font-weight",
					    "compiler" => true,
					    "default" => "300",
					    "desc" => "Set the weight of the font to use for your body copy. eg 300, 500 normal, bold.",
					    "placeholder" => "normal"),
				
					array(
					     "type" => "divide",
					     "id" =>"divide3",
					 ),
					// Heading Fonts
						array(        
						"type" => "select",
						"title" => "<strong>Heading Font</strong>",
						"id" => "headingfont",
						"compiler" => true,
						"options" => $fonts,					
						"desc" => "",
						"default" => "Google" ),
					
						array(
						     "type" => "text",
						     'required' => array('headingfont', '=' , 'Google'),
						     "compiler" => true,
						    "title" => "Google font family",
						    "id" => "heading-google-font",
						    "desc" => "Enter the name of the font family you want to use here. eg Open+Sans:400,600,300:latin",
						    "default" => "Open+Sans:400,600,300:latin"),
						
						
						array(
						    "type" => "text",
						    "title" => "Heading font weight",
						    "id" => "heading-font-weight",
						    "compiler" => true,
						    "default" => "300",
						    "desc" => "Set the weight of the font to use for your body copy. eg 300, 500 normal, bold.",
						    "placeholder" => "normal"),
					
					array(
					     "type" => "divide",
					     "id" =>"divide2",
					 ),
					 
						// Nav Fonts
							array(        
							"type" => "select",
							"title" => "<strong>Nav Font</strong>",
							"id" => "navfont",
							"compiler" => true,
							"options" => $fonts,					
							"desc" => "",
							"default" => "Google" ),
						array(
							"type" => "text",
							'required' => array('navfont', '=' , 'Google'),
							"compiler" => true,
							"title" => "Google font family",
							"id" => "nav-google-font",
							"desc" => "Enter the name of the font family you want to use here. eg Open+Sans:400,600,300:latin",
							"default" => "Open+Sans:400,600,300:latin"),
						array(
							    "type" => "text",
							    "title" => "Nav font weight",
							    "id" => "nav-font-weight",
							    "compiler" => true,
							    "default" => "300",
							    "desc" => "Set the weight of the font to use for your body copy. eg 300, 500 normal, bold.",
							    "placeholder" => "normal"),
					
				),
			);
			
			$this->sections[] = array(
				'icon' => 'el-icon-website',
				'title' => __('Layout', 'bamboo-framework'),
				'desc' => __('General layout settings'),
				'fields' => array (
				
					array (
							'id' => 'twidth',
							'type' => 'text',
							'title' => __('Template width', 'bamboo-framework'),
							'desc' => __('Sets the width of the main content container. Set a px or % width here.', 'bamboo-framework'),
							'default' => "960px",
							'compiler' => true,
						),
				
					array( 
					    'title'     => __( 'Layout', 'bamboo-framework' ),
					    'desc'      => __( 'Select main content and sidebar arrangement. Choose between 1, 2 or 3 column layout.', 'bamboo-framework' ),
					    'id'        => 'layout',
					    'default'   => 1,
					    'type'      => 'image_select',
					    'customizer'=> array(),
					    'options'   => array( 
					      0         => ReduxFramework::$_url . '/assets/img/1c.png',
					      1         => ReduxFramework::$_url . '/assets/img/2cr.png',
					      2         => ReduxFramework::$_url . '/assets/img/2cl.png',
					      3         => ReduxFramework::$_url . '/assets/img/3cl.png',
					      4         => ReduxFramework::$_url . '/assets/img/3cr.png',
					      5         => ReduxFramework::$_url . '/assets/img/3cm.png',
					    )
					  ),
					  
					  
					  array(
							'id'=>'main-width',
							'type' => 'slider', 
							'required' => array('layout', '>' , '0'),
							'title' => __('Main Width', 'bamboo-framework'),
							'desc'=> __('Set the relative width for the maincontent.', 'bamboo-framework'),
							"default" 		=> "8",
							"min" 		=> "1",
							"step"		=> "1",
							"max" 		=> "12",
							),	
							
							array(
								'id'=>'sidebar1-width',
								'type' => 'slider', 
								'required' => array('layout', '>' , '0'),
								'title' => __('Sidebar1 Width', 'bamboo-framework'),
								'desc'=> __('Set the relative width for the sidebar1.', 'bamboo-framework'),
								"default" 		=> "4",
								"min" 		=> "1",
								"step"		=> "1",
								"max" 		=> "12",
								),
								
								
						array(
							'id'=>'sidebar2-width',
							'type' => 'slider', 
							'required' => array('layout', '>' , '2'),
							
							'title' => __('Sidebar2 Width', 'bamboo-framework'),
							'desc'=> __('Set the relative width for the sidebar2.', 'bamboo-framework'),
							"default" 		=> "4",
							"min" 		=> "1",
							"step"		=> "1",
							"max" 		=> "12",
							),
					  	
					  	
					
					  array(
					    'title'     => __( 'Custom Layouts per Page Type', 'bamboo-framework' ),
					    'desc'      => __( 'Set a default layout for each post type on your site.', 'bamboo-framework' ),
					    'id'        => 'cpt_layout_toggle',
					    'default'   => 0,
					    'type'      => 'switch',
					    'customizer'=> array(),
					  ),
					  
					  
					 					  
					  
					  array( 
					      'title'     => __( 'Page Layout', 'bamboo-framework' ),
					      'desc'      => __( 'Select main content and sidebar arrangement. Choose between 1, 2 or 3 column layout.', 'bamboo-framework' ),
					      'id'        => 'page_layout',
					      'required' => array('cpt_layout_toggle', '=' , '1'),
					      'default'   => 1,
					      'type'      => 'image_select',
					      'customizer'=> array(),
					      'options'   => array( 
					        0         => ReduxFramework::$_url . '/assets/img/1c.png',
					        1         => ReduxFramework::$_url . '/assets/img/2cr.png',
					        2         => ReduxFramework::$_url . '/assets/img/2cl.png',
					        3         => ReduxFramework::$_url . '/assets/img/3cl.png',
					        4         => ReduxFramework::$_url . '/assets/img/3cr.png',
					        5         => ReduxFramework::$_url . '/assets/img/3cm.png',
					      )
					    ),
					    
					    
					    array(
					  		'id'=>'page-main-width',
					  		'type' => 'slider', 
					  		'required' => array('page_layout', '>' , '0'),
					  		'title' => __('Page Main Width', 'bamboo-framework'),
					  		'desc'=> __('Set the relative width for the maincontent.', 'bamboo-framework'),
					  		"default" 		=> "8",
					  		"min" 		=> "1",
					  		"step"		=> "1",
					  		"max" 		=> "12",
					  		),	
					  		
					  		array(
					  			'id'=>'page-sidebar1-width',
					  			'type' => 'slider', 
					  			'required' => array('page_layout', '>' , '0'),
					  			'title' => __('Page Sidebar1 Width', 'bamboo-framework'),
					  			'desc'=> __('Set the relative width for the sidebar1.', 'bamboo-framework'),
					  			"default" 		=> "4",
					  			"min" 		=> "1",
					  			"step"		=> "1",
					  			"max" 		=> "12",
					  			),
					  			
					  			
					  	array(
					  		'id'=>'page-sidebar2-width',
					  		'type' => 'slider', 
					  		'required' => array('page_layout', '>' , '2'),
					  		
					  		'title' => __('Page Sidebar2 Width', 'bamboo-framework'),
					  		'desc'=> __('Set the relative width for the sidebar2.', 'bamboo-framework'),
					  		"default" 		=> "4",
					  		"min" 		=> "1",
					  		"step"		=> "1",
					  		"max" 		=> "12",
					  		),
					
					array( 
					    'title'     => __( 'Single Layout', 'bamboo-framework' ),
					    'desc'      => __( 'Select main content and sidebar arrangement. Choose between 1, 2 or 3 column layout.', 'bamboo-framework' ),
					    'id'        => 'single_layout',
					    'required' => array('cpt_layout_toggle', '=' , '1'),
					    'default'   => 1,
					    'type'      => 'image_select',
					    'customizer'=> array(),
					    'options'   => array( 
					      0         => ReduxFramework::$_url . '/assets/img/1c.png',
					      1         => ReduxFramework::$_url . '/assets/img/2cr.png',
					      2         => ReduxFramework::$_url . '/assets/img/2cl.png',
					      3         => ReduxFramework::$_url . '/assets/img/3cl.png',
					      4         => ReduxFramework::$_url . '/assets/img/3cr.png',
					      5         => ReduxFramework::$_url . '/assets/img/3cm.png',
					    )
					  ),
					  
					  
					  array(
							'id'=>'single-main-width',
							'type' => 'slider', 
							'required' => array('single_layout', '>' , '0'),
							'title' => __('Single Main Width', 'bamboo-framework'),
							'desc'=> __('Set the relative width for the maincontent.', 'bamboo-framework'),
							"default" 		=> "8",
							"min" 		=> "1",
							"step"		=> "1",
							"max" 		=> "12",
							),	
							
							array(
								'id'=>'single-sidebar1-width',
								'type' => 'slider', 
								'required' => array('single_layout', '>' , '0'),
								'title' => __('Single Sidebar1 Width', 'bamboo-framework'),
								'desc'=> __('Set the relative width for the sidebar1.', 'bamboo-framework'),
								"default" 		=> "4",
								"min" 		=> "1",
								"step"		=> "1",
								"max" 		=> "12",
								),
								
								
						array(
							'id'=>'single-sidebar2-width',
							'type' => 'slider', 
							'required' => array('single_layout', '>' , '2'),
							
							'title' => __('Single Sidebar2 Width', 'bamboo-framework'),
							'desc'=> __('Set the relative width for the sidebar2.', 'bamboo-framework'),
							"default" 		=> "4",
							"min" 		=> "1",
							"step"		=> "1",
							"max" 		=> "12",
							),
					
					
					array( 
					    'title'     => __( 'Search Layout', 'bamboo-framework' ),
					    'desc'      => __( 'Select main content and sidebar arrangement. Choose between 1, 2 or 3 column layout.', 'bamboo-framework' ),
					    'id'        => 'search_layout',
					    'required' => array('cpt_layout_toggle', '=' , '1'),
					    'default'   => 1,
					    'type'      => 'image_select',
					    'customizer'=> array(),
					    'options'   => array( 
					      0         => ReduxFramework::$_url . '/assets/img/1c.png',
					      1         => ReduxFramework::$_url . '/assets/img/2cr.png',
					      2         => ReduxFramework::$_url . '/assets/img/2cl.png',
					      3         => ReduxFramework::$_url . '/assets/img/3cl.png',
					      4         => ReduxFramework::$_url . '/assets/img/3cr.png',
					      5         => ReduxFramework::$_url . '/assets/img/3cm.png',
					    )
					  ),
					  
					  
					  array(
							'id'=>'search-main-width',
							'type' => 'slider', 
							'required' => array('search_layout', '>' , '0'),
							'title' => __('Search Main Width', 'bamboo-framework'),
							'desc'=> __('Set the relative width for the maincontent.', 'bamboo-framework'),
							"default" 		=> "8",
							"min" 		=> "1",
							"step"		=> "1",
							"max" 		=> "12",
							),	
							
							array(
								'id'=>'search-sidebar1-width',
								'type' => 'slider', 
								'required' => array('search_layout', '>' , '0'),
								'title' => __('Search Sidebar1 Width', 'bamboo-framework'),
								'desc'=> __('Set the relative width for the sidebar1.', 'bamboo-framework'),
								"default" 		=> "4",
								"min" 		=> "1",
								"step"		=> "1",
								"max" 		=> "12",
								),
								
								
						array(
							'id'=>'search-sidebar2-width',
							'type' => 'slider', 
							'required' => array('search_layout', '>' , '2'),
							
							'title' => __('Search Sidebar2 Width', 'bamboo-framework'),
							'desc'=> __('Set the relative width for the sidebar2.', 'bamboo-framework'),
							"default" 		=> "4",
							"min" 		=> "1",
							"step"		=> "1",
							"max" 		=> "12",
							),
							
							
						array( 
						    'title'     => __( 'Archive Layout', 'bamboo-framework' ),
						    'desc'      => __( 'Select main content and sidebar arrangement. Choose between 1, 2 or 3 column layout.', 'bamboo-framework' ),
						    'id'        => 'archive_layout',
						    'required' => array('cpt_layout_toggle', '=' , '1'),
						    'default'   => 1,
						    'type'      => 'image_select',
						    'customizer'=> array(),
						    'options'   => array( 
						      0         => ReduxFramework::$_url . '/assets/img/1c.png',
						      1         => ReduxFramework::$_url . '/assets/img/2cr.png',
						      2         => ReduxFramework::$_url . '/assets/img/2cl.png',
						      3         => ReduxFramework::$_url . '/assets/img/3cl.png',
						      4         => ReduxFramework::$_url . '/assets/img/3cr.png',
						      5         => ReduxFramework::$_url . '/assets/img/3cm.png',
						    )
						  ),
						  
						  
						  array(
								'id'=>'archive-main-width',
								'type' => 'slider', 
								'required' => array('archive_layout', '>' , '0'),
								'title' => __('Archive Main Width', 'bamboo-framework'),
								'desc'=> __('Set the relative width for the maincontent.', 'bamboo-framework'),
								"default" 		=> "8",
								"min" 		=> "1",
								"step"		=> "1",
								"max" 		=> "12",
								),	
								
								array(
									'id'=>'archive-sidebar1-width',
									'type' => 'slider', 
									'required' => array('archive_layout', '>' , '0'),
									'title' => __('Archive Sidebar1 Width', 'bamboo-framework'),
									'desc'=> __('Set the relative width for the sidebar1.', 'bamboo-framework'),
									"default" 		=> "4",
									"min" 		=> "1",
									"step"		=> "1",
									"max" 		=> "12",
									),
									
									
							array(
								'id'=>'archive-sidebar2-width',
								'type' => 'slider', 
								'required' => array('archive_layout', '>' , '2'),
								
								'title' => __('Archive Sidebar2 Width', 'bamboo-framework'),
								'desc'=> __('Set the relative width for the sidebar2.', 'bamboo-framework'),
								"default" 		=> "4",
								"min" 		=> "1",
								"step"		=> "1",
								"max" 		=> "12",
								),
						
					
				
					),
				
				);
			
			
			$this->sections[] = array(
				'icon' => 'el-icon-th',
				'title' => __('Widgets', 'bamboo-framework'),
				'desc' => __('Settings that control the display of widgets.'),
				'fields' => array (
				
					
					array(
					  	'id'=>'banner-widget-align',
						'type' => 'button_set',
						'title' => __('<strong>Banner widget alignment</strong>', 'bamboo-framework'), 
						'desc' => __('Sets the behaviour of widgets when more than one widget is published to a position.', 'bamboo-framework'),
						'options' => array('stacked' => 'Stacked Vertical','side' => 'Stacked Horizontally','doublefirst' => 'Double First','doublelast' => 'Double Last'), //Must provide key => value pairs
						'default' => 'side',
					),
					
					array(
					  	'id'=>'above-content-widget-align',
						'type' => 'button_set',
						'title' => __('<strong>Above content widget alignment</strong>', 'bamboo-framework'), 
						'desc' => __('Sets the behaviour of widgets when more than one widget is published to a position.', 'bamboo-framework'),
						'options' => array('stacked' => 'Stacked Vertical','side' => 'Stacked Horizontally','doublefirst' => 'Double First','doublelast' => 'Double Last'), //Must provide key => value pairs
						'default' => 'side',
					),
					
					array(
					  	'id'=>'below-content-widget-align',
						'type' => 'button_set',
						'title' => __('<strong>Below content widget alignment</strong>', 'bamboo-framework'), 
						'desc' => __('Sets the behaviour of widgets when more than one widget is published to a position.', 'bamboo-framework'),
						'options' => array('stacked' => 'Stacked Vertical','side' => 'Stacked Horizontally','doublefirst' => 'Double First','doublelast' => 'Double Last'), //Must provide key => value pairs
						'default' => 'side',
					),
					
					array(
					  	'id'=>'bottom-widget-align',
						'type' => 'button_set',
						'title' => __('<strong>Bottom widget alignment</strong>', 'bamboo-framework'), 
						'desc' => __('Sets the behaviour of widgets when more than one widget is published to a position.', 'bamboo-framework'),
						'options' => array('stacked' => 'Stacked Vertical','side' => 'Stacked Horizontally','doublefirst' => 'Double First','doublelast' => 'Double Last'), //Must provide key => value pairs
						'default' => 'side',
					),
					
					
				
			));	
			
			
			$this->sections[] = array(
			'icon' => 'el-icon-laptop',
			'title' => __('Responsive', 'bamboo-framework'),
			'desc' => __('Controls the responsive behaviour of the site.'),
			'fields' => array (

				array(
				  	'id'=>'mobile-menu',
					'type' => 'button_set',
					'title' => __('<strong>Mobile Menu type</strong>', 'bamboo-framework'), 
					'desc' => __('Select how the menu should behave on smaller screens.'),
					'options' => array('collapse-menu' => 'Collapse Menu','hide-menu' => 'Hide Menu','no-change' => 'No Change'), //Must provide key => value pairs
					'default' => 'collapse-menu'
				),
				array(
				    "type" => "text",
				   	"title" => "<strong>Mobile Menu Text</strong>",
				    "id" => "mobile-menu-text",
				    'default' => 'Menu',
				    'required' => array('mobile-menu', '=' , 'collapse-menu'),
				    "desc" => "Sets the text to be used when the mobile menu trigger appears",
				    "default" => "Menu"),	    
				array(
				     "type" => "text",
				    "title" => "<strong>Menu collapse width</strong>",
				    "id" => "menu-collapse",
				    'required' => array('mobile-menu', '!=' , 'no-change'),
				    "compiler" => true,
				    "desc" => "The pixel width of the browser when the standard desktop menu should be changed to the mobile menu. eg 767px.",
				    "default" => "768px"),
				
				array(
				     "type" => "text",
				    "title" => "<strong>Grid collapse width</strong>",
				    "id" => "grid-collapse",
				    "compiler" => true,
				    "desc" => "The pixel width of the browser when the mobile layout should be triggered.",
				    "default" => "768px"),
				array(
				     "type" => "divide",
				     "id" =>"divide3",
				 ),
				array(
				    "type" => "text",
				   	"title" => "<strong>Offcanvas Trigger text</strong>",
				    "id" => "offcanvas-trigger-text",
				    "desc" => "Sets the text to be used to trigger the off canvas panel.",
				    "default" => "More"),
				),
			);
			
			$this->sections[] = array(
				'icon' => 'el-icon-pencil',
				'title' => __('Menu', 'bamboo-framework'),
				'desc' => __('Settings that control the menu display.'),
				'fields' => array (
				
					
					array(
					  	'id'=>'menu-align',
						'type' => 'button_set',
						'title' => __('<strong>Menu Alignment</strong>', 'bamboo-framework'), 
						'desc' => __('Select the position of the logo', 'bamboo-framework'),
						'options' => array('zenleft' => 'Left','zencenter' => 'Center','zenright' => 'Right'), //Must provide key => value pairs
						'default' => 'zenleft',
					),
					
					array(
					  	'id'=>'menu-position',
						'type' => 'button_set',
						'title' => __('<strong>Menu Position</strong>', 'bamboo-framework'), 
						'desc' => __('Select the position of the logo', 'bamboo-framework'),
						'options' => array('1' => 'Above Logo','2' => 'Below Logo'), //Must provide key => value pairs
						'default' => '2',
					),
				
			));	
				
			$this->sections[] = array(
				'icon' => 'el-icon-folder',
				'title' => __('Content Settings', 'bamboo-framework'),
				'desc' => __('Choose how certain content is displayed'),
				'fields' => array (
					array (
						'id' => 'breadcrumb',
						'type' => 'switch',
						'title' => __('Breadcrumbs', 'bamboo-framework'),
						'desc' => __('Turn breadcrumbs on or off (site-wide)', 'bamboo-framework'),
						'default' => 1,
					),
					array(
					  'id'=>'breadcrumb-sep',
					  'required' => array('breadcrumb', '=' , '1'),
					  'type' => 'text', 
						'title' => __('Breadcrumb Separator', 'bamboo-framework'),
						'subtitle'=> __('Enter a character to use for the breadcrumb separator', 'bamboo-framework'),
						"default" 		=> '/',
						),	
					array (						
						'id' => 'author_profile',
						'type' => 'switch',
						'title' => __('Author Profiles', 'bamboo-framework'),
						'desc' => 'Display an author profile after a post',
						'default' => 0,
					),
					
					array (						
						'id' => 'tab-count',
						'type' => 'text',
						'title' => __('Tab Count', 'bamboo-framework'),
						'desc' => 'The number of posts to show in the tabbed layout template',
						'default' => 3,
					),
					array (						
						'id' => 'featured-count',
						'type' => 'text',
						'title' => __('Featured Count', 'bamboo-framework'),
						'desc' => 'The number of posts to show in the featured layout template',
						'default' => 3,
					),
					
					array (						
						'id' => 'grid-count',
						'type' => 'text',
						'title' => __('Grid Count', 'bamboo-framework'),
						'desc' => 'The number of posts to show in the slideshow layout template',
						'default' => 3,
					),
					array (						
						'id' => 'grid-columns',
						'type' => 'text',
						'title' => __('Columns for grid layout', 'bamboo-framework'),
						'desc' => 'The number of columns to use in the grid layout',
						'default' => 3,
					),
				),
			);
			
			
			$this->sections[] = array(
				'icon' => 'el-icon-fire',
				'title' => __('Effects', 'bamboo-framework'),
				'desc' => __(''),
				'fields' => array (
					array (
						'id' => 'lazyload',
						'type' => 'switch',
						'title' => __('Lazyload', 'bamboo-framework'),
						'desc' => __('Enables lazyload', 'bamboo-framework'),
						'default' => 0,
					),
					
					array(
					  'id'=>'lazyload-selector',
					  'required' => array('lazyload', '=' , '1'),
					  'type' => 'text', 
						'title' => __('Lazyload selector', 'bamboo-framework'),
						'subtitle'=> __('Enter a selector here that you want to apply the lazyload effect to.', 'bamboo-framework'),
						"default" 		=> 'img',
						),	
				
				array(
				  'id'=>'lazyload-not-selector',
				  'required' => array('lazyload', '=' , '1'),
				  'type' => 'text', 
					'title' => __('Lazyload not selector', 'bamboo-framework'),
					'subtitle'=> __('Enter a selector here that you do <strong>not</strong> want to apply the lazyload effect to.', 'bamboo-framework'),
					"default" 		=> 'notimg',
					),	
					 
					array (						
						'id' => 'stickynav',
						'type' => 'switch',
						'title' => __('Sticky Nav', 'bamboo-framework'),
						'desc' => 'When enabled the navigation gets stuck to the top of the browser window after the user scrolls down.',
						'default' => 1,
					),
					
								
					array (
						'id'=>'backtotop',
						'type' => 'switch',
						'title' => __('Back to Top', 'bamboo-framework'), 
						'desc' => __('When enabled a button appears at the bottom of the page when the user scrolls down. When clicked this button will automatically scroll the viewport to the top of the page.', 'bamboo-framework'),
						'default' => 1,
					),
				),
			);

			
			// ACTUAL DECLARATION OF SECTIONS
			
			$this->sections[] = array(
				'icon' => 'el-icon-wrench',
				'title' => __('Extra code & Analytics', 'bamboo-framework'),
				'fields' => array (
					array (
						'id'=>'analytics',
						'type' => 'textarea',
						//'required' => array('layout','equals','1'),	
						'title' => __('Tracking Code', 'bamboo-framework'), 
						'subtitle' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'bamboo-framework'),
						'validate' => 'js',
						'desc' => '',
					),

				),
			);
						
					
					
		//
		foreach ($appearance_variables as $key => $option) {
				array_push($this->sections[1]['fields'], $appearance_variables[$key]);
		}
		
		foreach ($offcanvas_variables as $key => $option) {
				array_push($this->sections[6]['fields'], $offcanvas_variables[$key]);
		}
		
		
	//print_r($this->sections);




			

		}	

		public function setHelpTabs() {

			// Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
			$this->args['help_tabs'][] = array(
			    'id' => 'redux-opts-1',
			    'title' => __('Theme Information 1', 'bamboo-framework'),
			    'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'bamboo-framework')
			);

			$this->args['help_tabs'][] = array(
			    'id' => 'redux-opts-2',
			    'title' => __('Theme Information 2', 'bamboo-framework'),
			    'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'bamboo-framework')
			);

			// Set the help sidebar
			$this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'bamboo-framework');

		}


		/**
			
			All the possible arguments for Redux.
			For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

		 **/
		public function setArguments() {
			
			$theme = wp_get_theme(); // For use with some settings. Not necessary.

			$this->args = array(
	            
	            // TYPICAL -> Change these values as you need/desire
				'opt_name'          	=> 'bamboo', // This is where your data is stored in the database and also becomes your global variable name.
				'display_name'			=> 'Shoots', // $theme->get('Name'), // Name that appears at the top of your panel
				'display_version'		=> '1.0', //$theme->get('Version'), // Version that appears at the top of your panel
				'menu_type'          	=> 'submenu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'     	=> false, // Show the sections below the admin menu item or not
				'menu_title'			=> __( 'Shoots Theme', 'bamboo' ),
	            'page'		 	 		=> __( 'Shoots Theme', 'bamboo' ),
	            'google_api_key'   	 	=> '', // Must be defined to add google fonts to the typography module
	            'global_variable'    	=> '', // Set a different name for your global variable other than the opt_name
	            'dev_mode'           	=> false, // Show the time the page took to load, etc
	            'customizer'         	=> false, // Enable basic customizer support

	            // OPTIONAL -> Give you extra features
	            'page_priority'      	=> null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	            'page_parent'        	=> 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	            'page_permissions'   	=> 'manage_options', // Permissions needed to access the options panel.
	            'menu_icon'          	=> '', // Specify a custom URL to an icon
	            'last_tab'           	=> '', // Force your panel to always open to a specific tab (by id)
	            'page_icon'          	=> 'icon-themes', // Icon displayed in the admin panel next to your menu_title
	            'page_slug'          	=> '_options', // Page slug used to denote the panel
	            'save_defaults'      	=> true, // On load save the defaults to DB before user clicks save or not
	            'default_show'       	=> true, // If true, shows the default value next to each field that is not the default value.
	            'default_mark'       	=> '*', // What to print by the field's title if the value shown is default. Suggested: *


	            // CAREFUL -> These options are for advanced use only
	            'transient_time' 	 	=> 60 * MINUTE_IN_SECONDS,
	            'output'            	=> true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	            'output_tab'            => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	            //'domain'             	=> 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
	            'footer_credit'      	=> ' ', // Disable the footer credit of Redux. Please leave if you can help it.
	            

	            // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	            'database'           	=> '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	            
	        
	            'show_import_export' 	=> true, // REMOVE
	            'system_info'        	=> false, // REMOVE
	            
	            'help_tabs'          	=> array(),
	            'help_sidebar'       	=> '', // __( '', $this->args['domain'] );            
				);


			// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.		
			$this->args['share_icons'][] = array(
			    'url' => 'https://github.com/slightlyoffbeat',
			    'title' => 'My GitHub', 
			    'icon' => 'el-icon-github'
			    // 'img' => '', // You can use icon OR img. IMG needs to be a full URL.
			);		
			$this->args['share_icons'][] = array(
			    'url' => 'http://twitter.com/slightlyoffbeat',
			    'title' => 'Follow me on Twitter', 
			    'icon' => 'el-icon-twitter'
			);

			
	 
			// Panel Intro text -> before the form
			
				$this->args['intro_text'] = __('<p>Welcome to the Bamboo framework. Bamboo is built on Bones and the Redux options panel.</p>', 'bamboo-framework');
			

			// Add content after the form.
			$this->args['footer_text'] = __('', 'bamboo-framework');

		}
	}
	new Redux_Framework_sample_config();

}


/** 

	Custom function for the callback referenced above

 */
if ( !function_exists( 'redux_my_custom_field' ) ):
	function redux_my_custom_field($field, $value) {
	    print_r($field);
	    print_r($value);
	}
endif;

/**
 
	Custom function for the callback validation referenced above

**/
if ( !function_exists( 'redux_validate_callback_function' ) ):
	function redux_validate_callback_function($field, $value, $existing_value) {
	    $error = false;
	    $value =  'just testing';
	    /*
	    do your validation
	    
	    if(something) {
	        $value = $value;
	    } elseif(something else) {
	        $error = true;
	        $value = $existing_value;
	        $field['msg'] = 'your custom error message';
	    }
	    */
	    
	    $return['value'] = $value;
	    if($error == true) {
	        $return['error'] = $field;
	    }
	    return $return;
	}
endif;



function less_variables() {
	
	global $bamboo;
	
	// Get all variables as compiler true
	// in the fields array
	
	// Array we use to dynamically generate the settings for the theme appearance
	$variable_list = simplexml_load_file(get_template_directory().'/parameters/appearance.xml');
	
	$variables = '';
	
	foreach ($variable_list as $key => $variable) {
		
		$id = $variable->id;

		if($bamboo[''.$id.''] !=="") {
			$variables .= 	'@'.$id.':' . $bamboo[''.$id.''].";\n";	
		}
		
	}
	
	
	// Array we use to dynamically generate the settings for the theme appearance
	$offcanvas_variables = simplexml_load_file(get_template_directory().'/parameters/offcanvas.xml');
	
	foreach ($offcanvas_variables as $key => $variable) {
		
		$id = $variable->id;
		
		if($bamboo[''.$id.''] !=="") {
			$variables .= 	'@'.$id.':' . $bamboo[''.$id.''].";\n";	
		}
			
	}
	
	
	
	
	// Logo Params
	if($bamboo['logo-font-color'] !=="") {
		$variables .= 	"@logo-font-color:" . $bamboo['logo-font-color'].";\n";
	}
	
	if($bamboo['logo-font-color-hover'] !=="") {
		$variables .= 	"@logo-font-color-hover:" . $bamboo['logo-font-color-hover'].";\n";
	}
	
	if($bamboo['logo-font-size'] !=="") {
		$variables .=	"@logo-font-size:" .	$bamboo['logo-font-size'] . ";\n";
	}

	// Tagline Params
	$tagline_left = $bamboo['tagline-spacing']['margin-left'];
	$tagline_top = $bamboo['tagline-spacing']['margin-top'];
	
	if($bamboo['tagline-color'] !=="") {
		$variables .= 	"@tagline-color:" . $bamboo['tagline-color'].";\n";
	}
	
	if($tagline_left !=="") {
		$variables .= 	"@tagline-left:" . $tagline_left.";\n";
	}
	if($tagline_top !=="") {
		$variables .= 	"@tagline-top:" . $tagline_top.";\n";
	}
	// Scaffolding: phone, tablet, desktop, wide, Menu and grid collapse
	if($bamboo['twidth'] !=="") {
		$variables .= 	"@base-width:" .	$bamboo['twidth'] . ";\n";
	}
	if($bamboo['menu-collapse'] !=="") {
		$variables .= 	"@menu-collapse:" . $bamboo['menu-collapse'].";\n";
	}
	if($bamboo['grid-collapse'] !=="") {
		$variables .= 	"@grid-collapse:" . $bamboo['grid-collapse'].";\n";
	}
	// Fonts
	if($bamboo['base-font-size'] !=="") {
		$variables .=	"@base-font-size:" .	$bamboo['base-font-size'] . ";\n";
	}
	if($bamboo['body-font-weight'] !=="") {
		$variables .=	"@body-font-weight:" .	$bamboo['body-font-weight'] . ";\n";
	}
	if($bamboo['heading-font-weight'] !=="") {
		$variables .=	"@heading-font-weight:" .	$bamboo["heading-font-weight"] . ";\n";
	}
	if($bamboo['logo-weight'] !=="") {
		$variables .=	'@logo-font-weight:~"' .	$bamboo["logo-weight"] . '";';
	}
	if($bamboo['nav-font-weight'] !=="") {
		$variables .=	'@nav-font-weight:~"' .	$bamboo["nav-font-weight"] . '";';
	}
	
	if($bamboo['logofont'] == "Google") {
		$logofont= $bamboo['logo-google-font'];
		$logofont= '~"' .$logofont.'"';
	} else {
		$logofont= $bamboo['logofont'];
	}
	
	if($logofont !=="") {
		$variables .=	"@logo-font-family:" .	$logofont . ";\n";
	}
	
	if($bamboo['bodyfont'] !=="") {
		if($bamboo['bodyfont'] == "Google") {
			$bodyfont = bamboo::cleanFonts($bamboo['body-google-font']);
			$bodyfont= '~"' .$bodyfont.'"';
		} else {
			$bodyfont= '~"' .$bamboo['bodyfont'].'"';
		}
		
		if($bodyfont !=="") {
			$variables .=	'@body-font-family:' .	$bodyfont . ";\n";
		}
	}
	
	if($bamboo['headingfont'] !=="") {
		if($bamboo['headingfont'] == "Google") {
			$headingfont = bamboo::cleanFonts($bamboo['heading-google-font']);
			$headingfont= '~"' .$headingfont.'"';
		} else {
			$headingfont= '~"' .$bamboo['headingfont'].'"';
		}
		
		if($headingfont !=="") {
			$variables .=	"@heading-font-family:" .	$headingfont . ";\n";
		}
	}
	
	if($bamboo['navfont'] !=="") {
		if($bamboo['navfont'] == "Google") {
			$navfont = bamboo::cleanFonts($bamboo['nav-google-font']);
			$navfont= '~"' .$navfont.'"';
		} else {
			$navfont= '~"' .$bamboo['navfont'].'"';
		}
		
		if($navfont !=="") {
			$variables .=	"@nav-font-family:" .	$headingfont . ";\n";
		}
	}
	
	// Store new template variables
	file_put_contents(get_template_directory().'/less/variables-template.less', $variables);
	
	// Save new preset
	file_put_contents(get_template_directory().'/less/presets/custom.less', $variables);
}


function compile_less() {

	global $bamboo;
	 // include lessc.inc
	 
	less_variables();
	 
	require_once( get_template_directory().'/library/includes/lessc.inc.php' );
 	
 	$less = new lessc;
	
	$less->compileFile(get_template_directory().'/less/style.less', get_template_directory().'/css/style.css');
}

add_action('redux-compiler-bamboo', 'compile_less');
// This hook assumes your opt_name is redux_demo. Replace with your own.
