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

require_once('errorhandler.class.php');

class GmapConfigDAO {

    function GmapConfigDAO() {
    }
    
    function getConfigData() {
 		global $database; 		
		$query = 'SELECT * from #__gmaps_config ';
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		return $rows[0];
		    	
    }

    
    function update($obj) {
 		global $database; 		
		$sql = 'update #__gmaps_config set ' 
		.	'googlekey = "' . $obj->getGoogleKey() .'",'
		.	'maptype = "' . $obj->getMaptype() . '",'
		.	'mapwidth = "' . $obj->getWidth() . '",'
		.	'mapheight = "' . $obj->getHeight() . '",'
		.	'defaulticon = "' . $obj->getDefaultIcon() . '",'		
		.	'zoomtype = "' . $obj->getZoomtype() . '",'		
		.	'zoom = "' . $obj->getZoom() . '"';

 		$database->setQuery($sql);
		if (!$database->query()) {
			echo $database->stderr();
			return $database->getErrorNum();
		}
		return 0;	
    }

    function insert($obj) {
 		global $database; 		
		$sql = 'insert into #__gmaps_config (googlekey, maptype,mapheight, mapwidth, defaulticon, zoomtype, zoom) '
		.   ' values ("' . $obj->getGoogleKey() .'",'
		.	'"' . $obj->getMaptype() . '",'
		.	'"' . $obj->getHeight() . '",'
		.	'"' . $obj->getWidth() . '",'
		.	'"' . $obj->getDefaultIcon() . '",'
		.	'"' . $obj->getZoomtype() . '",'
		.	'"' . $obj->getZoom() . '")';

 		$database->setQuery($sql);
		if (!$database->query()) {
			ErrorHandler::handleError('GmapConfigDAO','insert',$database->stderr());
		}
		return 0;	
    }

	function getRowCount() {
 		global $database; 		
		$query = 'SELECT * from #__gmaps_config ';
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		return sizeof($rows);	
	}

}
?>