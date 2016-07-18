<?php

/**
* @version 
* @package 		GMaps
* @subpackage 	Administration
* @copyright 	(C) 2006-2007 Chris Strieter
* @license 		http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

/**
 * CHANGE HISTORY:
 * 02/28/2007	cjs	Added support to manage icons
 * 
 */
 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
// Joomla 1.5 defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( $mainframe->getPath( 'toolbar_html' ) );

switch ($task) {
	
	case 'editConfig':
		TOOLBAR_GMaps::_EDITCONFIG();
		break;
		
	case 'listMaps':
		TOOLBAR_GMaps::_LISTMAPS();	
		break;
		
	case 'editMap':
		TOOLBAR_GMaps::_EDITMAP();	
		break;

	case 'newMap':
		TOOLBAR_GMaps::_NEWMAP();	
		break;

	case 'listMarkers':
		TOOLBAR_GMaps::_LISTMARKERS();	
		break;
				
	case 'editMarker':
		TOOLBAR_GMaps::_EDITMARKER();	
		break;

	case 'newMarker':
		TOOLBAR_GMaps::_NEWMARKER();	
		break;

	case 'editcss':
		TOOLBAR_GMaps::_EDITCSS();	
		break;	
		
	case 'viewReadme':
		TOOLBAR_GMaps::_VIEWREADME();	
		break;	
						
						

	case 'listIcons':
		TOOLBAR_GMaps::_LISTICONS();	
		break;
				
	case 'editIcon':
		TOOLBAR_GMaps::_EDITICON();	
		break;

	case 'newIcon':
		TOOLBAR_GMaps::_NEWICON();	
		break;
		
	default:
		TOOLBAR_default::_DEFAULT();
		break;
}
 
?>
