<?php
/**
* @version 
* @package 		GMaps
* @subpackage 	Classes
* @copyright 	(C) 2006-2007 Chris Strieter
* @license 		http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

/**
 * Change History:
 * ------------------------
 * 02/28/2007	cjs	Removed straggling ECHO statement
 * 				cjs	Added code to populate the icon properties necessary to render the marker
 * 03/15/2007	cjs	Added support for additional marker properties
 * 08/01/2007	cjs	Added check on the getMap function to make more secure
 * 
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
// Joomla 1.5 defined( '_JEXEC' ) or die( 'Restricted access' );

require_once ('gmap.class.php');
require_once ('icondao.class.php');
require_once ('marker.class.php');
require_once ('errorhandler.class.php');

global $mainframe;

class GMapDAO {
	
	function getMaps() {
		global $database; 		
		$query = 'select * from #__gmaps_maps order by title';
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		for ($y=0; $y<(sizeof($rows)); $y++) {
			$entry = $this->loadObject($rows[$y]);
			$points = $this->getMapMarkers($entry->getId(), 
				array($entry->getOverlay1(),$entry->getOverlay2(),$entry->getOverlay3(),$entry->getOverlay4(),$entry->getOverlay5()));
			$entry->setMarkers($points);
			$mapArray[$y] = $entry;
		}

    	return $mapArray;
	}
	
	function getMap($id) {
		global $database; 		
		if (!is_numeric($id)) {
			ErrorHandler::displayError("Invalid Map ID - possible hack attempt");
			exit();			
		}
		$query = 'select * from #__gmaps_maps where id = '.$id;
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		if (sizeof($rows) == 0) {
			return null;
		}
		$entry = $this->loadObject($rows[0]);
		$points = $this->getMapMarkers($entry->getId(), 
			array($entry->getOverlay1(),$entry->getOverlay2(),$entry->getOverlay3(),$entry->getOverlay4(),$entry->getOverlay5()));
			
		$entry->setMarkers($points);
		return $entry;			
	}
	
	/**
	 * this method returns the # of maps inside the map table.
	 * Used primarily for navigation within the component admin pages.
	 */
	function getMapCount() {
		global $database; 		
		$query = 'select * from #__gmaps_maps';
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		$cnt = sizeof($rows);
		return $cnt;
	}
	
	/**
	 */
	function getMarkerCount() {
		global $database; 		
		$query = 'select * from #__gmaps_markers';
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		$cnt = sizeof($rows);
		return $cnt;
	}
		
 	function getRecords($start, $stop) {
 		global $database;
		$query = 'SELECT * from #__gmaps_maps ORDER by title LIMIT ' . $start . ',' . $stop;
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		for ($y=0; $y<(sizeof($rows)); $y++) {		
			$entry = $this->loadObject($rows[$y]);
			$list[$y] = $entry;
		}
		return $list;			
 	} 	

 	function getMarkerRecords($start, $stop) {
 		global $database;
		$query = 'SELECT * from #__gmaps_markers ORDER by name LIMIT ' . $start . ',' . $stop;
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		for ($y=0; $y<(sizeof($rows)); $y++) {		
			$entry = $this->loadMarkerObjects($rows[$y]);
			$list[$y] = $entry;
		}
		return $list;			
 	} 
 		
	function getMapMarkers($id, $overlaymaps = null) {
		global $database; 		
		//var_dump($overlaymaps);
		$inclause = $id;
		$items = "";
		if ($overlaymaps != null ) {
			for ($y=0; $y < (sizeof($overlaymaps)); $y++) {
				if ($overlaymaps[$y]!=0) {
					$inclause.=','. $overlaymaps[$y];
//					$inclause = $overlaymaps[$y];
				} 
			}
			$query = 'select item.*, points.map_id from #__gmaps_markers item, '
				. ' #__gmaps_points points where item.id = points.item_id '
				. ' and points.map_id in ('.$inclause.') order by name';			
		} else {
			$query = 'select item.*, points.map_id from #__gmaps_markers item, '
				. ' #__gmaps_points points where item.id = points.item_id '
				. ' and points.map_id = '.$id.' order by name';
		}			
//		echo $inclause . '<BR>';
//		echo $query;
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		//echo "# of markers ... " . sizeof($rows);
		for ($y=0; $y<(sizeof($rows)); $y++) {		
			$items[$y] = $this->loadMarkerObjects($rows[$y]);
		}
		return $items;			
	}
	
	function getMarker($id) {
		global $database; 		
		$query = 'select * from #__gmaps_markers where id = ' . $id;
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		$entry = $this->loadMarkerObjects($rows[0]);
		return $entry;			
	}
	
	function getMapMarkersForSelectList() {
		global $database; 		
		$query = 'select id as value, name as text from #__gmaps_markers order by name';
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		return $rows;			
	}		
	function getAllMarkersForSelectList() {
		global $database; 		
		$query = 'select id as value, name as text from #__gmaps_markers order by name';
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		return $rows;			
	}	
	function insertMap($obj) {
		global $database; 		
		$query = 'insert into #__gmaps_maps (id, title, description, overlay1, overlay2, overlay3, overlay4, overlay5, properties) values (0,'
				. '"' . $obj->getTitle() .'",'
				. '"' . $obj->getDescription() .'",'				
				. '"' . $obj->getOverlay1() .'",'
				. '"' . $obj->getOverlay2() .'",'						
				. '"' . $obj->getOverlay3() .'",'
				. '"' . $obj->getOverlay4() .'",'
				. '"' . $obj->getOverlay5() .'",'
				. '"' . $obj->getProperties() . '"'												
				.')';				
		$database->setQuery($query);
		if (!$database->query()) {
			ErrorHandler::displayError($database->getErrorMsg());
			exit();
		} else {
			echo "<script>alert ('Record saved...')</script>";
			return true;
		}			
	}

	function updateMap($obj) {
		global $database; 		
		$query = 'update #__gmaps_maps set title = '
				.	'"' . $obj->getTitle() .'", '
				.	' description = "' . $obj->getDescription() .'", '				
				.	' overlay1 = "' . $obj->getOverlay1() .'", '				
				.	' overlay2 = "' . $obj->getOverlay2() .'", '
				.	' overlay3 = "' . $obj->getOverlay3() .'", '
				.	' overlay4 = "' . $obj->getOverlay4() .'", '
				.	' overlay5 = "' . $obj->getOverlay5() .'", '
				.   ' properties = "' . $obj->getProperties() . '"'
				. ' where id =' . $obj->getId();
	//	echo $query;
		$database->setQuery($query);
		if (!$database->query()) {
			ErrorHandler::displayError($database->getErrorMsg());
			exit();
		} else {
			echo "<script>alert ('Record udated ...')</script>";
			return true;
		}			
	}
		
	function deleteMap($obj) {
		global $database; 		
		if ($this->checkMapDefinedAsOverlay($obj->getId())) {
			 echo"<script> alert('Cannot delete a map defined as an overlay.  Remove overlay defintion first'); window.history.go(-1); </script>\n";
			 exit;
		}
		$query = 'delete from #__gmaps_maps where id =' . $obj->getId();
		$database->setQuery($query);
		if (!$database->query()) {
			ErrorHandler::displayError($database->getErrorMsg());
			exit();
		} else {
			$this->deleteMarkersFromMap($obj->getId());
			return true;
		}			 
	}


	function checkMapDefinedAsOverlay($id) {
		global $database; 		
		$query = 'select * from #__gmaps_maps where overlay1 = '. $id  
				. ' or overlay2 = ' . $id
				. ' or overlay3 = ' . $id
				. ' or overlay4 = ' . $id
				. ' or overlay5 = ' . $id;		
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		if (sizeof($rows) > 0 ) {
			return true;
		} else {
			return false;
		}		
	}
	
	function deleteMarkersFromMap($id) {
		global $database; 		
		$query = 'delete from #__gmaps_points where map_id = ' . $id;
		$database->setQuery($query);
		if (!$database->query()) {
			ErrorHandler::displayError($database->getErrorMsg());
			exit();
		} else {
			echo "<script>alert ('Record deleted...')</script>";
			return true;
		}			
	}
	
	function addMarkerToMap($mapid, $markerid) {
		global $database; 		
		$query = 'insert into #__gmaps_points (id, map_id, item_id) values (0,' . $mapid . ',' . $markerid . ')';
		$database->setQuery($query);
		if (!$database->query()) {
			ErrorHandler::displayError($database->getErrorMsg());
			exit();
		} else {
			echo "<script>alert ('Marker added to map...')</script>";
			return true;
		}		
	}

	function deleteMarkerFromMap($mapid, $markerid) {
		global $database; 		
		$query = 'delete from #__gmaps_points where map_id = ' . $mapid . ' and item_id =' . $markerid; 
		$database->setQuery($query);
		if (!$database->query()) {
			ErrorHandler::displayError($database->getErrorMsg());
			exit();
		} else {
			echo "<script>alert ('Marker deleted from map...')</script>";
			return true;
		}		
	}	

	function insertMarker($obj) {
		global $database; 		
		$query = 'insert into #__gmaps_markers (id, name, latitude, longitude, description, icon, properties) values (0,'
				. '"' . $obj->getName() .'",' 
				. '"' . $obj->getLatitude() .'",'
				. '"' . $obj->getLongitude() .'",'
				. '"' . $obj->getDescription() .'", '
				. '"' . $obj->getIcon() .'", '
				. '"' . $obj->getProperties() .'"'
				. ')';
		$database->setQuery($query);
		if (!$database->query()) {
			ErrorHandler::displayError($database->getErrorMsg());
			exit();
		} else {
			echo "<script>alert ('Record saved...')</script>";
			return true;
		}	
	}

	function updateMarker($obj) {
		global $database; 		
		$query = 'update #__gmaps_markers ' 
					. 'set name = "' . $obj->getName() . '",'
					. 'latitude = "' . $obj->getLatitude() . '",'
					. 'longitude = "' . $obj->getLongitude() . '",'
					. 'description = "' . $obj->getDescription() . '",' 
					. 'icon = "' . $obj->getIcon() . '",'
					. 'properties = "' . $obj->getProperties() . '"'
				. ' where id =' . $obj->getId();
		$database->setQuery($query);
		if (!$database->query()) {
			ErrorHandler::displayError($database->getErrorMsg());
			exit();
		} else {
			echo "<script>alert ('Record updated ...')</script>";
			return true;
		}						
	}
	
	function deleteMarker($obj) {
		global $database; 		
		$query = 'delete from #__gmaps_markers where id = ' . $obj->getId(); 
		$database->setQuery($query);
		if (!$database->query()) {
			ErrorHandler::displayError($database->getErrorMsg());
			exit();
		} else {
			$this->deleteMarkerFromMaps($obj->getId());
			echo "<script>alert ('Marker deleted ...')</script>";
			return true;
		}		
	}	
	
	function deleteMarkerFromMaps($markerid) {
		global $database; 		
		$query = 'delete from #__gmaps_points where item_id =' . $markerid; 
		$database->setQuery($query);
		if (!$database->query()) {
			ErrorHandler::displayError($database->getErrorMsg());
			exit();
		} else {
			echo "<script>alert ('Marker deleted from map...')</script>";
			return true;
		}		
	}
		
	function loadObject($row) {
		$g = new GMap();
		$g->setId($row->id);
		$g->setTitle($row->title);
		$g->setDescription($row->description);
		$g->setOverlay1($row->overlay1);		
		$g->setOverlay2($row->overlay2);
		$g->setOverlay3($row->overlay3);
		$g->setOverlay4($row->overlay4);
		$g->setOverlay5($row->overlay5);	
		$g->setProperties($row->properties);							
		return $g;
	}
	
	function loadMarkerObjects($row) {
		$p = new Marker();
		$p->setId($row->id);
		$p->setMapId($row->map_id);
		$p->setName($row->name);
		$p->setLatitude($row->latitude);
		$p->setLongitude($row->longitude);
		$p->setProperties($row->properties);
		$dao = new IconDAO();
		/* Set Icon Information */		
		if (strlen($row->icon) == 0) {
			$config = new GmapConfig();
			$defaulticon = $config->getDefaultIcon();
			$p->setIcon($defaulticon);
			$icon = $dao->getIconByName($defaulticon);
			$p->setHeight($icon->getHeight());
			$p->setWidth($icon->getWidth());
		} else {
			$p->setIcon($row->icon);
			$icon = $dao->getIconByName($row->icon);
			$p->setHeight($icon->getHeight());
			$p->setWidth($icon->getWidth());			
		}
		$p->setDescription($row->description);		
		return $p;
	}
}

?>