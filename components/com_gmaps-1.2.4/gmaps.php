<?php

/**
* @version 
* @package 		GMaps
* @subpackage 	Component
* @copyright 	(C) 2006-2007 Chris Strieter
* @license 		http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
// Joomla 1.5 defined( '_JEXEC' ) or die( 'Restricted access' );
// for Joomla 1.5
if (defined('_JEXEC')) {
	define( '_GMAPS_PATTEMPLATE_DIR', $mosConfig_absolute_path . '/libraries/patTemplate/');
} else {
	define( '_GMAPS_PATTEMPLATE_DIR', $mosConfig_absolute_path . '/includes/patTemplate/');
	require_once( _GMAPS_PATTEMPLATE_DIR . 'patTemplate.php' );
}

/*****                STILL UNDER DEVELOPMENT **********************/

// load the html drawing class
//require_once( $mainframe->getPath( 'front_html' ) );
require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
//require_once( $mosConfig_absolute_path . '/includes/patTemplate/patTemplate.php' );
require_once( $mosConfig_absolute_path.'/components/com_gmaps/classes/frontend.class.php' );

global $database, $my, $mosConfig_live_site;

/*
 * Add StyleSheet to the document header 
 */
$mainframe->addCustomHeadTag("<link rel='StyleSheet' href='$mosConfig_live_site/components/com_gmaps/css/gmaps.css' type='text/css' />"); 

 
// handle the task
$mapId = mosGetParam( $_REQUEST, 'mapId', '' );
$task = mosGetParam( $_REQUEST, 'task', '' );
$id = mosGetParam( $_REQUEST, 'id', '' );
$itemid = mosGetParam( $_REQUEST, 'Itemid', '' );
$option = mosGetParam( $_REQUEST, 'option', '' );

switch ($task) {

	case 'viewmaps':
		Frontend::viewmaps();
		break;
		
	case 'viewmap':
		Frontend::viewMap($mapId);
		break;	

	default:
		Frontend::viewmaps();
		break;
}


?>
