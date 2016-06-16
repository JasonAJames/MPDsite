<?php

/**
* @version 
* @package 		GMaps
* @subpackage 	Classes
* @copyright 	(C) 2006-2007 Chris Strieter
* @license 		http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

/**
 * CHANGE HISTORY:
 * 02/28/2007	cjs	Added icon select list and an iconfileselectlist
 * 					The icon file select list reads the icons directory
 * 03/12/2007	cjs	Added the getMarkerTabSelectList function to return a selectlist
 * 					of available tabs used in the infobox of the markers
 * 03/15/2007	cjs	Added support for additional tab types
 * 11/15/2007	cjs add trim to the $default_value parameter on the selectList call to resolve comp. issue with J1.5
 * 
 */
 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
// Joomla 1.5 defined( '_JEXEC' ) or die( 'Restricted access' );


class HtmlHelper {

    function HtmlHelper() {
    }

     function getMarkerTabSelectList($element_name, $default_value) {
   		$list[0] = mosHTML::makeOption('DTL','Detail');
   		$list[1] = mosHTML::makeOption('DIR','Driving Directions');
   		$list[2] = mosHTML::makeOption('IMG1','Detail with Image');
   		$list[3] = mosHTML::makeOption('IMG2','Image with Title Only');
   		return mosHTML::selectList($list, $element_name,'class="inputbox"','value','text', trim($default_value));
   }
   
     function getIndexFormatList($element_name, $default_value) {
   		$list[0] = mosHTML::makeOption('0','Vertical');
   		$list[1] = mosHTML::makeOption('1','Horizontal');
   		return mosHTML::selectList($list, $element_name,'class="inputbox"','value','text', trim($default_value));
   }	

     function getYesNoSelectList($element_name, $default_value) {
   		$list[0] = mosHTML::makeOption('N','No');
   		$list[1] = mosHTML::makeOption('Y','Yes');
   		return mosHTML::selectList($list, $element_name,'class="inputbox"','value','text', trim($default_value));
   }	
          
     function getMaptypeList($element_name, $default_value) {
   		$list[0] = mosHTML::makeOption('Normal','Normal ');
   		$list[1] = mosHTML::makeOption('Satellite','Satellite ');
		$list[2] = mosHTML::makeOption('Hybrid','Hybrid     ');   		
   		return mosHTML::selectList($list, $element_name,'class="inputbox"','value','text', trim($default_value));
   }	
   
     function getZoomtypeList($element_name, $default_value) {
   		$list[0] = mosHTML::makeOption('None','None ');
   		$list[1] = mosHTML::makeOption('Small','Small ');
		$list[2] = mosHTML::makeOption('Large','Large     ');   		
   		return mosHTML::selectList($list, $element_name,'class="inputbox"','value','text', trim($default_value));
   }	   
   
     function getZoomList($element_name, $default_value) {
   		$list[0] = mosHTML::makeOption('1','1');
   		$list[1] = mosHTML::makeOption('2','2');
   		$list[2] = mosHTML::makeOption('3','3');
   		$list[3] = mosHTML::makeOption('4','4');
   		$list[4] = mosHTML::makeOption('5','5');
   		$list[5] = mosHTML::makeOption('6','6');
   		$list[6] = mosHTML::makeOption('7','7');
   		$list[7] = mosHTML::makeOption('8','8');
   		$list[8] = mosHTML::makeOption('9','9');   		   		   		   		   		   		   		   		
   		$list[9] = mosHTML::makeOption('10','10');
  		$list[10] = mosHTML::makeOption('11','11');
   		$list[11] = mosHTML::makeOption('12','12');   		
   		$list[12] = mosHTML::makeOption('13','13');
   		$list[13] = mosHTML::makeOption('14','14');
   		$list[14] = mosHTML::makeOption('15','15');
   		$list[15] = mosHTML::makeOption('16','16');
   		$list[16] = mosHTML::makeOption('17','17');   		   		   		   		  		
		
   		return mosHTML::selectList($list, $element_name,'class="inputbox"','value','text', trim($default_value));
   }	       
 
   function getMapSelectList($element_name, $default_value, $excludeid = null) {
  		global $database;
  		if ($excludeid == null) 
			$database->setQuery("select id as value, title as text from #__gmaps_maps order by title");
		else
			$database->setQuery("select id as value, title as text from #__gmaps_maps where id <> " . $excludeid . " order by title");
		if (!$database->query()) {
			echo $database->stderr();
			die;
		}	
		$rows = $database->loadObjectList();
		
		// Create an empty list option
		$maplist[] = mosHTML::makeOption( '', '-- Select Map --       ' );
		// merge this list with the list of values retrieved from the db.
		$result = array_merge( $maplist, $rows );
	
		$sellist = mosHTML::selectList( $result, $element_name, 'class="inputbox" ','value', 'text', trim($default_value));
		return $sellist;
  }    
  

   function getIconSelectList($element_name, $default_value) {
  		global $database;
		$database->setQuery("select icon as value, icon as text from #__gmaps_icons order by icon");
		if (!$database->query()) {
			echo $database->stderr();
			die;
		}	
		$rows = $database->loadObjectList();
		// Create an empty list option
		$maplist[] = mosHTML::makeOption( '', '-- Select Icon --       ' );
		$result = array_merge( $maplist, $rows );
		$sellist = mosHTML::selectList( $result, $element_name, 'class="inputbox" ','value', 'text', trim($default_value));
		return $sellist;
  } 
    
	function getIconFilesSelectList($inDir,$elementName, $default_value = null) {
		//Open images directory
		//TODO:  Need to filter this to limit only *jpg, *gif or *png files
		$dirname = $inDir;
		$data[0] = mosHTML::makeOption( "","-- SELECT ICON -- ");
		if (file_exists($dirname)) {
			$dir = opendir($dirname);
			$y=0;
			while (($file = readdir($dir)) !== false)
			{
				if ($file != "." && $file != ".."){
					$data[$y+1] = mosHTML::makeOption( $file, $file);
					$y++;		
				}		
		  	}
			closedir($dir);		
		} else {
			$data[0]= mosHTML::makeOption('No Images available','No Images available');
		}
		$html = mosHTML::selectList( $data, $elementName, 'class="inputbox" ','value', 'text', trim($default_value));
		return $html;		
}
  
}
?>