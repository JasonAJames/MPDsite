<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

class readmessage extends xiptAclRules
{

	function __construct($debugMode)
	{
		parent::__construct(__CLASS__, $debugMode);
	}
	
	public function checkAclViolatingRule($data)
	{
		return true;
	}
	
	function checkAclAccesibility(&$data)
	{
		if('com_community' == $data['option'] && 'inbox' == $data['view'] )
		    	if($data['task'] === 'read')
			return true;
			
		return false;
	}
	
	
}