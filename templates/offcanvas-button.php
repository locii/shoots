<?php
/*
Off Canvas
*/
global $bamboo; ?>

<?php if ( has_nav_menu( 'offcanvas') ) { ?>
<!-- This is a button toggling the off-canvas sidebar -->
<button id="offcanvas-toggle" class="btn float-right" data-uk-offcanvas="{target:'#offcanvas'}"><span class="icon-menu"></span><?php echo $bamboo['offcanvas-trigger-text'];?></button>
<?php } ?>