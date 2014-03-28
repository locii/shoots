

<?php global $bamboo ?>

	
	
	
	<footer class="footer" role="contentinfo">
		<div class="container">
		
			<?php dynamic_sidebar( 'footer' ); ?>
			
			<nav role="navigation">
				<?php wp_nav_menu(array(
					'container' => '',                              // remove nav container
					'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
					'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
					'theme_location' => 'footer-links',             // where it's located in the theme
					'before' => '',                                 // before the menu
					'after' => '',                                  // after the menu
					'link_before' => '',                            // before each link
					'link_after' => '',                             // after each link
					'depth' => 0,                                   // limit the depth of the nav
					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
				)); ?>
			</nav>
			<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p>
		</div>
	</footer>
	
	
	
	
	<?php get_template_part('templates/offcanvas', 'content');?>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>
		
		<?php echo bamboo::lazyload(
				$bamboo['lazyload'],
				$bamboo['lazyload-selector'],
				$bamboo['lazyload-not-selector']); 
		?>
		
		 <!-- Back To Top -->
				<?php echo bamboo::backtotop(
					$bamboo['backtotop'])
				?>
	
				<!-- Fonts -->
				<?php echo bamboo::fonts(); ?>

	</body>

</html>
