<?php 

// No direct Access
defined('ABSPATH') or die("Cannot access pages directly.");


include(locate_template('layout-logic.php'));

?>
	
	<div id="sidebar2" class="sidebar col col-<?php echo $sidebar2width; ?>" role="complementary">

	<?php if ( is_active_sidebar( 'sidebar-secondary' ) ) : ?>

		<?php dynamic_sidebar( 'sidebar-secondary' ); ?>

	<?php endif; ?>

</div>