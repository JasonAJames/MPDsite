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

class GMap {
	var $id = null;
	var $title = null;
	var $description = null;
	var $overlay1 = null;
	var $overlay2 = null;
	var $overlay3 = null;
	var $overlay4 = null;
	var $overlay5 = null;
	var $properties = null;
	var $markers = null;   //array
	
 	function setId($inParm) {
 		$this->id = $inParm;
 	}
 	function getId() {
 		return $this->id;
 	}
 	function setTitle($inParm) {
 		$this->title = $inParm;
 	}
 	function getTitle() {
 		return $this->title;
 	} 	
 	function setDescription($inParm) {
 		$this->description = $inParm;
 	}
 	function getDescription() {
 		return $this->description;
 	}  	
 	function setMarkers($inParm) {
 		$this->markers = $inParm;
 	}
 	function getMarkers() {
 		return $this->markers;
 	}
 	function getMarker($idx) {
 		$marker = $this->markers[$idx];
 		return $marker;
 	}
 	function setOverlay1($inParm) {
 		$this->overlay1 = $inParm;
 	}
 	function setOverlay2($inParm) {
 		$this->overlay2 = $inParm;
 	}
 	function setOverlay3($inParm) {
 		$this->overlay3 = $inParm;
 	}
 	function setOverlay4($inParm) {
 		$this->overlay4 = $inParm;
 	}
 	function setOverlay5($inParm) {
 		$this->overlay5 = $inParm;
 	} 	 	 	 	
 	function getOverlay1() {
 		return $this->overlay1;
 	}
 	function getOverlay2() {
 		return $this->overlay2;
 	}
 	function getOverlay3() {
 		return $this->overlay3;
 	}
 	function getOverlay4() {
 		return $this->overlay4;
 	}
 	function getOverlay5() {
 		return $this->overlay5;
 	}
 	function setProperties($inParm) {
 		$this->properties = $inParm;
 	}
 	function getProperties() {
 		return $this->properties;
 	}
  		 	 	 	 	
}
?>