<?php
/**
* @version 
* @package 		GMaps
* @subpackage 	Classes
* @copyright 	(C) 2006-2007 Chris Strieter
* @license 		http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//require_once($_CONF['path'] . 'plugins/leaguemgr/config.php');
require_once('icon.class.php');
require_once ('errorhandler.class.php');

class IconDAO  {

  function getIconById($id) {
 	global $database; 		
	$query = 'SELECT * from #__gmaps_icons where id = '.$id;
	$database->setQuery($query);
	$rows = $database->loadObjectList();
	$icon = $this->loadObject($rows[0]);
	return $icon; 
  }

  function getIconByName($name) {
 	global $database; 		
	$query = 'SELECT * from #__gmaps_icons where icon = "'.$name.'"';
	$database->setQuery($query);
	$rows = $database->loadObjectList();
	$icon = $this->loadObject($rows[0]);
	return $icon; 
  }
  
  function getIcons() {
	global $database;

	$icons = array();
	$query = "SELECT * from #__gmaps_icons"; 
	$database->setQuery($query);
	$rows = $database->loadObjectList();
	for ($y=0; $y<(sizeof($rows)); $y++) {		
		$icons[$y] = $this->loadObject($rows[$y]);
	}
    return $icons;
  }


/**
 * This function inserts an record into the icons table
*/
function insert($obj) {
	global $database; 		
	$query = 'insert into #__gmaps_icons (id, icon, icon_height, icon_width) values (0,'
			. '"' . $obj->getIcon() .'",'
			. '"' . $obj->getHeight() .'",'				
			. '"' . $obj->getWidth() . '"'												
			.')';				
	$database->setQuery($query);
	if (!$database->query()) {
		ErrorHandler::displayError($database->getErrorMsg());
		exit();
	} else {
		//echo "<script>alert ('Record saved...')</script>";
		return true;
	}	
	return mysql_insert_id();	
}

/**
 * THis method will update the icon information
*/
function update($obj) {
 	global $database;     
  	$query = 'UPDATE #__gmaps_icons '
  		. 'set icon = "' . $obj->getIcon() . '", ' 
  		. 	' icon_height = ' . $obj->getHeight() . ', '
  		.	' icon_width = "' . $obj->getWidth() . '" ' 
  		. ' where id = ' . $obj->getId();		
	$database->setQuery($query);
	if (!$database->query()) {
		ErrorHandler::displayError($database->getErrorMsg());
		exit();
	} else {
		echo "<script>alert ('Record saved...')</script>";
		return true;
	}	
}
	
/**
 * This method will delete the icon
*/
function delete($obj) {
		global $database; 		
		if ($this->checkMarkers($obj->getIcon())) {
			 echo"<script> alert('Cannot delete this icon.  It is assigned to a marker. Delete the marker defintion first'); window.history.go(-1); </script>\n";
			 exit;
		}
		$query = 'delete from #__gmaps_icons where id =' . $obj->getId();
		$database->setQuery($query);
		if (!$database->query()) {
			ErrorHandler::displayError($database->getErrorMsg());
			exit();
		} else {
			return true;
		}	
}

	function checkMarkers($name) {
		global $database; 		
		$query = 'select * from #__gmaps_markers where icon = '. $name;  
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		if (sizeof($rows) > 0 ) {
			return true;
		} else {
			return false;
		}		
	}
	
  function getRowCount() {
 	global $database; 		
	$query = 'SELECT * from #__gmaps_icons ';
	$database->setQuery($query);
	$rows = $database->loadObjectList();
	return sizeof($rows); 
  }

 	function getRecords($start, $stop) {
 		global $database;
		$query = 'SELECT * from #__gmaps_icons ORDER by icon LIMIT ' . $start . ',' . $stop;
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		for ($y=0; $y<(sizeof($rows)); $y++) {		
			$entry = $this->loadObject($rows[$y]);
			$list[$y] = $entry;
		}
		return $list;			
 	} 
 	
 
  function loadObject ($row)  {
	$icon = new Icon();
	$icon->setId($row->id);
	$icon->setIcon($row->icon);
	$icon->setHeight($row->icon_height);
	$icon->setWidth($row->icon_width);
	return $icon;
  }

}

?>
