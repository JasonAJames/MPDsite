<?php
// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

require_once( JPATH_COMPONENT.DS.'controller.php' );

class UsertraceViewShowSec extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;
		
		$document =& JFactory::getDocument();
		$params	= &$mainframe->getParams();
	 	// Page Title
		$menus	= &JSite::getMenu();
		$menu	= $menus->getActive();
		// because the application sets a default page title, we need to get it
		// right from the menu item itself
		if (is_object( $menu )) {
			$menu_params = new JParameter( $menu->params );
			if (!$menu_params->get( 'page_title')) {
				$params->set('page_title',	JText::_( 'User trace - Sections' ));
			}
		} else {
			$params->set('page_title',	JText::_( 'User trace - Sections' ));
		}
		$document->setTitle( $params->get( 'page_title' ) );
		
		parent::display($tpl);
	}
}