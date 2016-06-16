<?php
/**
* @version 
* @package 		GMaps
* @subpackage 	Classes
* @copyright 	(C) 2006-2007 Chris Strieter
* @license 		http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
// Joomla 1.5 defined( '_JEXEC' ) or die( 'Restricted access' );

/* The new few lines of code is for PHP4 compatibility */
if ( !function_exists('htmlspecialchars_decode') ) {
	function htmlspecialchars_decode ($str, $quote_style = ENT_COMPAT) {
   		return strtr($str, array_flip(get_html_translation_table(HTML_SPECIALCHARS, $quote_style)));
	}
}

class GmapHelper {

    function GmapHelper() {
    }
    
    function getMap($map) {
   		$class = $this->getClassInstance('GoogleAPI','googleapi.class.php');
	//  $class = $this->getClassInstance('GmapEZ','gmapez.class.php');    	
    //	return GoogleAPI::getMap($id, $maptype, $zoom,  $width, $height, $key, $zoomtype, $showindex, $showmaptype,$showoverview);
		return $class->getMap($map);    
   }
   
   
   function getMarkerIndex($map, $fmt) {
   		$class = $this->getClassInstance('GoogleAPI','googleapi.class.php');   	
   		return $class->getMarkerIndex($map, $fmt);
   }
      
   function getClassInstance($classname, $classfile) {
   		require_once ($classfile);
   		return new $classname;
   }
}
?>
