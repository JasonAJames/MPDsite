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

require_once( 'configdao.class.php' );

class GmapConfig {
	
	var $google_key = null;
	var $maptype = null;
	var $zoomtype = null;	
	var $zoom  = null;
	var $height = null;
	var $width = null;
	var $configFound = false;
	var $defaulticon = null;
	
	
    function GmapConfig() {
    	$dao = new GmapConfigDAO();
    	$row = $dao->getConfigData();
    	if (sizeof($row) > 0)
    		$configFound = true;
    	$this->loadObject($row);
    }
    
    function update() {
    	$dao = new GmapConfigDAO();
    	$dao->update();
    }
    
    function insert() {
    	$dao = new GmapConfigDAO();
    	$dao->insert();
    }
        
    function loadObject($row) {
 		$this->setGoogleKey($row->googlekey);
		$this->setMaptype($row->maptype);
		$this->setZoom($row->zoom); 		
		$this->setHeight($row->mapheight);
		$this->setWidth($row->mapwidth);
		$this->setZoomtype($row->zoomtype);	
		$this->setDefaultIcon($row->defaulticon);	
	}     
	
    function setGoogleKey($inParm) {
    	$this->google_key = $inParm;
    }
    
    function getGoogleKey() {
    	return $this->google_key;
    }
    function setZoom($inParm) {
    	$this->zoom = $inParm;
    }
    function getZoom() {
    	return $this->zoom;
    }    
    function setMaptype($inParm) {
    	$this->maptype = $inParm;
    }
    function getMaptype() {
    	return $this->maptype;
    }
    function getZoomtype() {
    	return $this->zoomtype;
    }            
    function setZoomtype($inParm) {
    	$this->zoomtype = $inParm;
    }
    function getHeight() {
    	return $this->height;
    }
    function setHeight($inParm) {
    	$this->height = $inParm;
    }    
    function setWidth($inParm) {
    	$this->width = $inParm;
    }
    function getWidth() {
    	return $this->width;
    }    
    function setDefaultIcon($inParm) {
    	$this->defaulticon = $inParm;
    }
    function getDefaultIcon() {
    	return $this->defaulticon;
    }    
    function isConfigured() {
    	return $this->configFound;
    }
}
?>