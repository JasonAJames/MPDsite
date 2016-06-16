<?php

defined('_JEXEC') or die();

jimport('joomla.application.component.controller');

class XtremelocatorController extends JController{
	
	function display()
	{
		JHTML::_('behavior.caption');
                    
		// Set a default view if none exists
		if ( ! JRequest::getCmd( 'view' ) ) {			
			JRequest::setVar('view', 'search' );
		}
        parent::display(true);
	}
}
