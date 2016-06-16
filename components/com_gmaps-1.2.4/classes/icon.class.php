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

class Icon {
	var $id = null;
	var $icon = null;  // Filename
	var $height = null;
	var $width = null;
	
 	function setId($inParm) {
 		$this->id = $inParm;
 	}
 	function getId() {
 		return $this->id;
 	}
 	function setIcon($inParm) {
 		$this->icon = $inParm;
 	}
 	function getIcon() {
 		return $this->icon;
 	} 	
 	function setHeight($inParm) {
 		$this->height = $inParm;
 	}
 	function getHeight() {
 		return $this->height;
 	}
 	function setWidth($inParm) {
 		$this->width = $inParm;
 	}
 	function getWidth() {
 		return $this->width;
 	}
 	 	  	
}
?>