<?php
// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

require_once( JPATH_COMPONENT.DS.'controller.php' );

class UTAdminViewConf extends JView {
	function display($tpl = null) {
		parent::display($tpl);
	}
}