<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

class addapplication extends xiptAclRules
{

	function __construct($debugMode)
	{
		parent::__construct(__CLASS__, $debugMode);
	}
	
	public function checkAclViolatingRule($data)
	{
		return true;
	}
	
	 function aclAjaxBlock($msg)
	  {
		$objResponse   	= new JAXResponse();
		$title		= JText::_('CC PROFILE VIDEO');
		$objResponse->addScriptCall('cWindowShow', '', $title, 430, 80);
		return parent::aclAjaxBlock($msg, $objResponse);
	  }  
	  
	function checkAclAccesibility(&$data)
	{
		if('com_community' == $data['option'] && 'apps' == $data['view'] )
		    	if($data['task'] == 'ajaxadd' || $data['task'] == 'ajaxaddapp')
			return true;
			
		return false;
	}
	
	
}
