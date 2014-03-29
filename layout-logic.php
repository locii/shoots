<?php

// No direct Access
defined('ABSPATH') or die("Cannot access pages directly.");

	global $bamboo;
	

	
	// Logic for sidebar widths
		if($bamboo['cpt_layout_toggle']) {
			if(is_page()) { 
				$sidebar2width = $bamboo['page-sidebar2-width'];
		
			} 	elseif(is_search()) {
					$sidebar2width = $bamboo['search-sidebar2-width'];
			}	elseif(is_single()) {
					$sidebar2width = $bamboo['single-sidebar2-width'];
			}else {
				$sidebar2width = $bamboo['sidebar2-width'];
			}
		}
		else {
			$sidebar2width = $bamboo['sidebar2-width'];
		}
		
		
		
		// Logic for sidebar widths
		
		if($bamboo['cpt_layout_toggle']) {
			if(is_page()) { 
				$sidebar1width = $bamboo['page-sidebar1-width'];
		
			} 	elseif(is_search()) {
					$sidebar1width = $bamboo['search-sidebar1-width'];
					
			}	elseif(is_single()) {
					$sidebar1width = $bamboo['single-sidebar1-width'];
			}	else {
				$sidebar1width = $bamboo['sidebar1-width'];
			}
		}	
		else {
			$sidebar1width = $bamboo['sidebar1-width'];
		}
		
		
	$bodyfont = $bamboo['bodyfont'];
	$logofont = $bamboo['logofont'];
	$navfont = $bamboo['navfont'];
	$headingfont = $bamboo['headingfont']; 
	$logofontsize = $bamboo['logo-font-size'];
	$basesize = $bamboo['base-font-size'];
?>