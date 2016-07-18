<?php
/**
* @version $Id: usertrace.php $ 
* @package usertrace
* @copyright (C) 2007 D'Abronzo Vincenzo
* @license GNU / GPL
* @author D'Abronzo Vincenzo
* Usertrace is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*/

// No direct access
defined('_JEXEC') or die('Restricted access');

// Require the base controller
require_once (JPATH_COMPONENT.DS.'controller.php');

// Create the controller
$controller = new UserTraceController();

// Perform the Request task
$controller->execute( JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();