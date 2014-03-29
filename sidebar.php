<?php 

// No direct Access
defined('ABSPATH') or die("Cannot access pages directly.");


	
	if ( is_active_sidebar( 'sidebar-primary' ) ) : 
	
	//include(locate_template('layout-logic.php'));
	
	?>

	
	<div id="sidebar1" class="sidebar col col-<?php echo $sidebar1width; ?>" role="complementary">
		<?php dynamic_sidebar( 'sidebar-primary' ); ?>
	</div>
<?php endif; ?>