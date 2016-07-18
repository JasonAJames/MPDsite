<?php 
defined( '_JEXEC' ) or die( 'Restricted access' ); 

jimport( 'joomla.application.component.controller' ); 

class GoogleController extends JController 
{
	function display() 
	{ 
		$document =& JFactory::getDocument(); 
		$viewName = JRequest::getVar('view', 'google'); 
		$viewType = $document->getType(); 
		$view = &$this->getView($viewName, $viewType, 'View'); 
		$model =& $this->getModel( $viewName, 'ModelGoogle' ); 

		if (!JError::isError( $model )) { 
			$view->setModel( $model, true ); 
		}

		$view->setLayout('default'); 
		$view->display(); 
	}
	
} 
?>