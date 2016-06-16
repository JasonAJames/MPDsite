<?php

/*
// Pixel Point Creative "Simple Spotlight" Module for Joomla! 1.5.x - Version 1.0
// License: http://www.gnu.org/copyleft/gpl.html
// Copyright (c) 2010 Pixel Point Creative LLC.
// More info at http://www.pixelpointcreative.com
// Developer: Daniel Riefstahl
// ***Last update: March 20th, 2010***
*/




defined('_JEXEC') or die('Restricted access');
//Parameters for Simple Spotlight

$spotlightImage = $params->get('spotlightImage');
$spotlightImage2 = $params->get('spotlightImage2');
$spotlightImage3 = $params->get('spotlightImage3');
$spotlightImage4 = $params->get('spotlightImage4');
$spotlightImage5 = $params->get('spotlightImage5');
$spotlightImage6 = $params->get('spotlightImage6');
$spotlightImage7 = $params->get('spotlightImage7');
$spotlightImage8 = $params->get('spotlightImage8');
$spotlightImage9 = $params->get('spotlightImage9');
$spotlightImage10 = $params->get('spotlightImage10');

$link = $params->get('link');
$link2 = $params->get('link2');
$link3 = $params->get('link3');
$link4 = $params->get('link4');
$link5 = $params->get('link5');
$link6 = $params->get('link6');
$link7 = $params->get('link7');
$link8 = $params->get('link8');
$link9 = $params->get('link9');
$link10 = $params->get('link10');
$width = $params->get('width');
$height = $params->get('height');
$auto = $params->get('auto');
$window = $params->get('window');
$easing = $params->get('easing');
$speed = $params->get('speed');


JHTML::script('adon.js','modules/mod_ppc_simple_spotlight/js/',false );
JHTML::script('slide.js','modules/mod_ppc_simple_spotlight/js/',false );
JHTML::script('jquery.easing.1.1.js','modules/mod_ppc_simple_spotlight/js/',false ); 
JHTML::stylesheet('style.css','modules/mod_ppc_simple_spotlight/css/',false ); 

?>

<div style="float:left;background:transparent;margin:0px;clear:both;width:100%;" >
<div class="slideshow" style="width:<?php echo ($width) ?>px; height:<?php echo $height; ?>px;">
<div class="slidediv">
<ul style="background:none; margin:0px;padding:0px;">

<?php if ($spotlightImage) { ?> <li style="background:none;margin:0px;padding:0px"><a href="<?php echo $link; ?>" target="<?php echo $window; ?>"><img src="<?php echo JURI::base().$spotlightImage ;?>" width="<?php echo $width; ?>px" height="<?php echo $height; ?>px" border="0" alt="" /> </a></li><?php } ?>

<?php if ($spotlightImage2) { ?> <li style="background:none;margin:0px;padding:0px"><a href="<?php echo $link2; ?>" target="<?php echo $window; ?>"><img src="<?php echo JURI::base().$spotlightImage2 ;?>" width="<?php echo $width; ?>px" height="<?php echo $height; ?>px" border="0" alt="" /></a></li><?php } ?>

<?php if ($spotlightImage3) { ?> <li style="background:none;margin:0px;padding:0px"><a href="<?php echo $link3; ?>" target="<?php echo $window; ?>"><img src="<?php echo JURI::base().$spotlightImage3 ;?>" width="<?php echo $width; ?>px" height="<?php echo $height; ?>px" border="0" alt="" /></a></li><?php } ?>

<?php if ($spotlightImage4) { ?> <li style="background:none;margin:0px;padding:0px"><a href="<?php echo $link4; ?>" target="<?php echo $window; ?>"><img src="<?php echo JURI::base().$spotlightImage4 ;?>" width="<?php echo $width; ?>px" height="<?php echo $height; ?>px" border="0" alt="" /></a></li><?php } ?>

<?php if ($spotlightImage5) { ?> <li style="background:none;margin:0px;padding:0px"><a href="<?php echo $link5; ?>" target="<?php echo $window; ?>"><img src="<?php echo JURI::base().$spotlightImage5 ;?>" width="<?php echo $width; ?>px" height="<?php echo $height; ?>px" border="0" alt="" /></a></li><?php } ?>

<?php if ($spotlightImage6) { ?> <li style="background:none;margin:0px;padding:0px"><a href="<?php echo $link6; ?>" target="<?php echo $window; ?>"><img src="<?php echo JURI::base().$spotlightImage6 ;?>" width="<?php echo $width; ?>px" height="<?php echo $height; ?>px" border="0" alt="" /></a></li><?php } ?>

<?php if ($spotlightImage7) { ?> <li style="background:none;margin:0px;padding:0px"><a href="<?php echo $link7; ?>" target="<?php echo $window; ?>"><img src="<?php echo JURI::base().$spotlightImage7 ;?>" width="<?php echo $width; ?>px" height="<?php echo $height; ?>px" border="0" alt="" /></a></li><?php } ?>

<?php if ($spotlightImage8) { ?> <li style="background:none;margin:0px;padding:0px"><a href="<?php echo $link8; ?>" target="<?php echo $window; ?>"><img src="<?php echo JURI::base().$spotlightImage8 ;?>" width="<?php echo $width; ?>px" height="<?php echo $height; ?>px" border="0" alt="" /></a></li><?php } ?>

<?php if ($spotlightImage9) { ?> <li style="background:none;margin:0px;padding:0px"><a href="<?php echo $link9; ?>" target="<?php echo $window; ?>"><img src="<?php echo JURI::base().$spotlightImage9 ;?>" width="<?php echo $width; ?>px" height="<?php echo $height; ?>px" border="0" alt="" /></a></li><?php } ?>

<?php if ($spotlightImage10) { ?> <li style="background:none;margin:0px;padding:0px"><a href="<?php echo $link10; ?>" target="<?php echo $window; ?>"><img src="<?php echo JURI::base().$spotlightImage10 ;?>" width="<?php echo $width; ?>px" height="<?php echo $height; ?>px" border="0" alt="" /></a></li><?php } ?>

</ul>
</div>
</div>

<?php if ($params->get('nav')) : ?>
<div class="ssbutton" style="width:<?php echo ($width) ?>px;>">
<a href="#" class="prev"><img src="modules/mod_ppc_simple_spotlight/img/button-prev.png" title="Previous" alt="Previous" /></a> 
<a href="#" class="next"><img src="modules/mod_ppc_simple_spotlight/img/button-next.png" title="Next" alt="Next" /></a> 
</div>
<?php endif; ?>
</div>


<script type="text/javascript">
 var $j = jQuery.noConflict();
		$j(function() {
    $j(".slidediv").jCarouselLite({
        btnNext: ".next",
        btnPrev: ".prev",
        easing: "<?php echo $easing; ?>",
        speed:<?php echo $speed; ?>,
        auto:<?php echo $auto; ?>
	
			
    });

});

</script>


