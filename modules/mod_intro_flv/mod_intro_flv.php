<?php
/**
* @version		$Id: mod_intro_flv.php 7692 2010-03-22 20:41:29Z tcp $
* @Copyright Copyright (C) 2010 - studiosaccheyyi.com
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$document = &JFactory::getDocument();
$livesite			= JURI::Base();
$folder 			= 'modules/mod_intro_flv';
$width 				= $params->get('width');
$height				= $params->get( 'height' );
//$lightcolor		= $params->get( 'lightcolor' );
//$frontcolor 		= $params->get( 'frontcolor' );
//$backcolor 		= $params->get( 'backcolor' );
//$autostart 		= $params->get('autostart','1');
//$repeat 			= $params->get('repeat','1');
//$shownavigation 	= $params->get('shownavigation','1');
$filename			= $folder .'/'.$params->get( 'filename' );
$description		= $params->get( 'description' );
$showlink			= $params->get( 'showlink' );
$linkname			= $params->get( 'linkname' );

/*/if ($shownavigation=="1")
$shownavigation='true';
else {$shownavigation='false';}

if ($autostart=="1")
$autostart='true';
else {
$autostart='false';}

if ($repeat=="1")
$repeat='true';
if ($repeat=="2")
$repeat='false';
if ($repeat=="3")
$repeat='list';
*/

JHTML::script('videobox.js','modules/mod_intro_flv/js/', 'mootools' ); 
JHTML::script('swfobject.js','modules/mod_intro_flv/js/');
JHTML::stylesheet('videobox.css','modules/mod_intro_flv/css/',array('media'=>'all'));

?> 

<script language="javascript" type="text/javascript">
window.addEvent('domready',function(){
Videobox.open('<?php echo $filename?>', '<?php echo $description ?>', 'vidbox <?php echo $width . " " . $height?>');
})
</script>
<?php
if ($showlink=="1") 
echo '<a href="' . $filename .'" rel="vidbox" title="'.$description.'">'.$linkname.'</a>';

?>

