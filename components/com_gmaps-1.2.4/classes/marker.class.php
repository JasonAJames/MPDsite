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
 * 02/28/2007	Added height and width attributes for the marker
 * 03/15/2007	Added support for images
 */
 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
// Joomla 1.5 defined( '_JEXEC' ) or die( 'Restricted access' );

class Marker {
	var $id = null;
	var $mapid = null;
	var $name = null;
	var $latitude = null;
	var $longitude = null;
	var $icon = null;
	var $description = null;
	var $height = null;
	var $width = null;
	var $properties = null;
	
 	function setId($inParm) {
 		$this->id = $inParm;
 	}
 	function getId() {
 		return $this->id;
 	}
 	function setMapId($inParm) {
 		$this->mapid = $inParm;
 	}
 	function getMapId() {
 		return $this->mapid;
 	}
 	function setName($inParm) {
 		$this->name = $inParm;
 	}
 	function getName() {
 		return $this->name;
 	} 	
 	function setLatitude($inParm) {
 		$this->latitude = $inParm;
 	}
 	function getLatitude() {
 		return $this->latitude;
 	}
 	function setLongitude($inParm) {
 		$this->longitude = $inParm;
 	}
 	function getLongitude() {
 		return $this->longitude;
 	} 
 	function setIcon($inParm) {
 		$this->icon = $inParm;
 	}
 	function getIcon() {
 		return $this->icon;
 	} 	 
  	function setDescription($inParm)  {
  		// Remove all the \r \n characters
		$order  = array("\r\n", "\n", "\r");
		$replace = '<br/>';
		// 	Processes \r\n's first so they aren't converted twice.
		$newstr = str_replace($order, $replace, $inParm);
		$newstr = str_replace('"',"'",$newstr);
		$this->description = $newstr;
 	}
 	function getDescription() {
 		return $this->description;
 		//return html_entity_decode($this->description);
 	} 
 	function getWidth() {
 		return $this->width;
 	}
 	function getHeight() {
 		return $this->height;
 	}  	
 	function setWidth($inParm) {
 		$this->width = $inParm;
 	}
 	function setHeight($inParm) {
 		$this->height = $inParm;
 	}
 	function setProperties($inParm) {
 		$this->properties = $inParm;
 	}
 	function getProperties() {
 		return $this->properties;
 	} 	  	 	  	
}
?>