<?php
/**
* @Copyright Ready Bytes Software Labs Pvt. Ltd. (C) 2010- author-Team Joomlaxi
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
**/
// no direct access
defined('_JEXEC') or die('Restricted access');

class addasfriends extends xiptAclRules
{

	function __construct($debugMode)
	{
		parent::__construct(__CLASS__, $debugMode);
	}
	

	public function checkAclViolatingRule($data)
	{	
		$otherptype = $this->aclparams->get('other_profiletype',-1);
		$otherpid	= XiPTLibraryProfiletypes::getUserData($data['args'][0],'PROFILETYPE');
		$selfptype = $this->coreparams->get('core_profiletype',-1);
		
		$count = $this->getFeatureCounts($data['userid'], $otherptype, $selfptype);
		$maxmimunCount = $this->aclparams->get('friends_limit',0);
		if(($count >= $maxmimunCount))
			return true;
			
		return false;
	}
	
	function getFeatureCounts($userid, $otherptype, $selfptype)
	{
		$db		= JFactory::getDBO();
		$query	= 'SELECT DISTINCT(a.connect_to) AS id  FROM ' . $db->nameQuote('#__community_connection') . ' AS a '
				. 'INNER JOIN ' . $db->nameQuote( '#__users' ) . ' AS b '
				. 'ON a.connect_from=' . $db->Quote( $userid ) . ' '
				. 'AND a.connect_to=b.id '
				. ' LEFT JOIN #__xipt_users as ptfrom ON a.`connect_to`=ptfrom.`userid`'
				. ' AND ptfrom .`profiletype`=' . $db->Quote($selfptype)
				. ' LEFT JOIN #__xipt_users as ptto ON a.`connect_to`=ptto.`userid`'
				. ' AND ptto .`profiletype`=' . $db->Quote($otherptype);
		$db->setQuery( $query );
		$count		= $db->loadResultArray();
		return count($count);
	}	
	
	function checkAclAccesibility(&$data)
	{
		if('com_community' != $data['option'] && 'community' != $data['option'])
			return false;
			
		if('friends' != $data['view'])
			return false;
			
		if($data['args'][0] != 0 && $data['task'] === 'ajaxconnect')
				return true;
				
		return false;
	}
	
}