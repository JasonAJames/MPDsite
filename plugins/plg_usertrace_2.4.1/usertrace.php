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

// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );

jimport ( 'joomla.plugin.plugin' );

class plgUsertrace extends JPlugin {
	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @param	object		$subject The object to observe
	 * @param 	array  		$config  An array that holds the plugin configuration
	 * @since	1.0
	 */
	function plgUsertrace(& $subject, $config) {
		parent::__construct ( $subject, $config );
	}
	
	function onAfterInitialise() {
		$maxdays = ereg_replace("[^0-9]", "", $this->params->get ( 'maxdays', 0 ));
		if($maxdays == "") $maxdays = 0; // Only numbers
		
		$usertype = $this->params->get ( 'usertype' );
		
		$db = & JFactory::getDBO ();
		$query = "SELECT u.id AS uid, a.id AS aid FROM #__users AS u LEFT JOIN #__core_acl_aro AS a ON a.value = u.id WHERE DATE_ADD(u.registerDate, INTERVAL $days DAY) < NOW() AND block = 1 AND WHERE u.usertype='$usertype'";
		$db->setQuery ( $query );
		$rows = $db->loadObjectList ();
		if(!empty($rows)) {
			foreach ($rows as $row){
				$uid = $row->uid;
				$aid = $row->aid;
				
				$query = "DELETE FROM #__users WHERE id = $uid";
				$db->setQuery ( $query );
				$db->query ();
				
				$query = "DELETE FROM #__core_acl_aro WHERE id = $aid";
				$db->setQuery ( $query );
				$db->query ();
				
				$query = "DELETE FROM #__core_acl_groups_aro_map WHERE aro_id = $aid";
				$db->setQuery ( $query );
				$db->query ();
			}
		}
	}
}
