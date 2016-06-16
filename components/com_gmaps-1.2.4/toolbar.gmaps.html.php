<?php

/**
* @version 
* @package 		GMaps
* @subpackage 	Adminstration
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

class TOOLBAR_default {
	function _DEFAULT() {
		mosMenuBar::startTable();
		mosMenuBar::endTable();
	}
	
	
}
/**
* @package Mambo
* @subpackage Banners
*/
class TOOLBAR_GMaps {
	/**
	* Draws the menu for to Edit a banner
	*/
	function _EDITCONFIG() {
		if (defined('_JEXEC')) {
			JToolBarHelper::title( JText::_( 'GMaps - Edit Configuration' ), 'generic.png' );
		}	
		mosMenuBar::startTable();
		mosMenuBar::save( 'saveConfig');
		mosMenuBar::spacer();
		mosMenuBar::cancel( 'cancel','Close' );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}	
	
	function _EDITMAP() {
		if (defined('_JEXEC')) {
			JToolBarHelper::title( JText::_( 'GMaps - Edit Map' ), 'generic.png' );
		}			
		mosMenuBar::startTable();
		mosMenuBar::save( 'saveMap');
		mosMenuBar::spacer();
		mosMenuBar::apply( 'applyMap','Apply' );		
		mosMenuBar::spacer();
		mosMenuBar::cancel( 'cancelMap','Cancel' );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _NEWMAP() {
		if (defined('_JEXEC')) {
			JToolBarHelper::title( JText::_( 'GMaps - New Map' ), 'generic.png' );
		}					
		mosMenuBar::startTable();
		mosMenuBar::save( 'saveMap');
		mosMenuBar::spacer();
		mosMenuBar::apply( 'applyMap','Apply' );		
		mosMenuBar::spacer();
		mosMenuBar::cancel( 'cancelMap','Cancel' );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
		
	function _LISTMAPS() {
		if (defined('_JEXEC')) {
			JToolBarHelper::title( JText::_( 'GMaps - Map List' ), 'generic.png' );
		}				
		mosMenuBar::startTable();
		mosMenuBar::addNew('newMap');
		mosMenuBar::editList('editMap');
		mosMenuBar::deleteList('', 'deleteMap');
		mosMenuBar::endTable();
	}

	function _EDITMARKER() {
		if (defined('_JEXEC')) {
			JToolBarHelper::title( JText::_( 'GMaps - Edit Marker' ), 'generic.png' );
		}						
		mosMenuBar::startTable();
		mosMenuBar::save( 'saveMarker');
		mosMenuBar::spacer();
		mosMenuBar::cancel( 'cancelMarker','Cancel' );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _NEWMARKER() {
		if (defined('_JEXEC')) {
			JToolBarHelper::title( JText::_( 'GMaps - Create Marker' ), 'generic.png' );
		}								
		mosMenuBar::startTable();
		mosMenuBar::save( 'saveMarker');
		mosMenuBar::spacer();
		mosMenuBar::cancel( 'cancelMarker','Cancel' );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
		
	function _LISTMARKERS() {
		if (defined('_JEXEC')) {
			JToolBarHelper::title( JText::_( 'GMaps - List Markers' ), 'generic.png' );
		}							
		mosMenuBar::startTable();
		mosMenuBar::addNew('newMarker');
		mosMenuBar::editList('editMarker');
		mosMenuBar::deleteList('', 'deleteMarker');
		mosMenuBar::endTable();
	}
		
	function _EDITCSS() {
		if (defined('_JEXEC')) {
			JToolBarHelper::title( JText::_( 'GMaps - Edit CSS' ), 'generic.png' );
		}						
		mosMenuBar::startTable();
		mosMenuBar::save( 'savecss');
		mosMenuBar::spacer();
		mosMenuBar::cancel( 'cancel','Close' );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _VIEWREADME() {
		if (defined('_JEXEC')) {
			JToolBarHelper::title( JText::_( 'GMaps - View Read Me' ), 'generic.png' );
		}								
		mosMenuBar::startTable();
		mosMenuBar::cancel( 'cancelReadme','Close' );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
	
	
	function _EDITICON() {
		if (defined('_JEXEC')) {
			JToolBarHelper::title( JText::_( 'GMaps - Edit Icon' ), 'generic.png' );
		}								
		mosMenuBar::startTable();
		mosMenuBar::save( 'saveIcon');
		mosMenuBar::spacer();
		mosMenuBar::cancel( 'cancelIcon','Cancel' );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _NEWICON() {
		if (defined('_JEXEC')) {
			JToolBarHelper::title( JText::_( 'GMaps - Define New Icon' ), 'generic.png' );
		}								
		mosMenuBar::startTable();
		mosMenuBar::save( 'saveIcon');
		mosMenuBar::spacer();
		mosMenuBar::cancel( 'cancelIcon','Cancel' );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
		
	function _LISTICONS() {
		if (defined('_JEXEC')) {
			JToolBarHelper::title( JText::_( 'GMaps - List Icons' ), 'generic.png' );
		}							
		mosMenuBar::startTable();
		mosMenuBar::addNew('newIcon');
		mosMenuBar::editList('editIcon');
		mosMenuBar::deleteList('', 'deleteIcon');
		mosMenuBar::endTable();
	}	
	
}
	


?>
