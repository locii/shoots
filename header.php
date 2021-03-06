<?php
// File Security Check
defined('ABSPATH') or die("Cannot access pages directly.");


global $bamboo;
?>
<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // Google Chrome Frame for IE ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	
		<?php wp_head(); ?>
		
		<?php echo $bamboo['analytics'];?>
	</head>

	<body <?php body_class(); ?>>
		<?php if($bamboo['menu-position'] == "1") { ?>
		
			<?php get_template_part('templates/nav', 'main'); ?>
			
		<?php } ?>
		
		<?php if($bamboo['logotype'] !== "none") { ?>
		<header id="headerwrap" class="clearfix" role="banner">
			<div class="container">
				<div id="logo" class="<?php echo $bamboo['logo-align'];?> col col-6 first">
					
					<?php if($bamboo['logotype'] == "text") { 
					
						get_template_part('templates/logo', 'text'); 
					
					} else {
					
						get_template_part('templates/logo', 'image');
					} 
					
						if(isset($bamboo['tagline'])) {
					
							get_template_part('templates/logo', 'tagline');
						}
					?>
					
				</div>
				<?php if ( is_active_sidebar('search') ) { ?>
					<div id="search" class="col col-6">
						<?php dynamic_sidebar( 'search' ); ?>
					</div>	
				<?php } ?>
			</div>
		</header>
		<?php } ?>

		<?php if($bamboo['menu-position'] == "2") { ?>
			<?php get_template_part('templates/nav', 'main'); ?>
		<?php } ?>
		
		
		<?php bamboo::display_widget('banner',$post->ID); ?>
		
		
		
		<section id="main" class="<?php if($bamboo['breadcrumb']  && !is_home()) {?>with-breadcrumb<?php } ?>">
		
		<?php 
			if(bamboo::display_extra('slideshow', $post->ID)) {
				
				get_template_part('templates/banner', 'slideshow');
				
			}
		?>