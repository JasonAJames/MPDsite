<?php 
defined('_JEXEC') or die('Restricted access'); 


// Set the table directory
JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'tables');

require_once( JPATH_COMPONENT.DS.'controller.php' );

$controller = new GoogleController(); 
$controller->execute( JRequest::getVar( 'task' ) ); 
$controller->redirect(); 

?> 
