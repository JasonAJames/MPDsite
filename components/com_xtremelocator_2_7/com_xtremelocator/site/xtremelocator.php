<?php

defined('_JEXEC') or die('Restricted access');

// Require the com_content helper library
require_once(JPATH_COMPONENT.DS.'controller.php');


// Component Helper
jimport('joomla.application.component.helper');

// Create the controller
$controller = new XtremelocatorController();

// Perform the Request task
$controller->execute(JRequest::getVar('task', null, 'default', 'cmd'));
$controller->redirect();
