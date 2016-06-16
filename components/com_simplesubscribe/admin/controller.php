<?php
/**
* @Copyright Copyright (C) 2010- Gary Teh Name1price.Com
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.controller' );

class SimpleSubscribeController extends JController
{

	/**
	 * Display the view
	 */
	function display()
	{
		SimpleSubscribeView::showConfigurations();
	}

	function saveconfigurations(){

		$db		=& JFactory::getDBO();

		$query = "	replace into
						jos_simplesub_options
					set
						field_name='paypal_id' ,
						field_value = '".$_REQUEST['paypal_id']."'
				";

		$db->setQuery($query);
		$db->query();

		$query = "	replace into
						jos_simplesub_options
					set
						field_name='subscription_amount' ,
						field_value = '".$_REQUEST['subscription_amount']."'
				";

		$db->setQuery($query);
		$db->query();

		$query = "	replace into
						jos_simplesub_options
					set
						field_name='currency' ,
						field_value = '".$_REQUEST['currency']."'
				";

		$db->setQuery($query);
		$db->query();



		SimpleSubscribeView::showConfigurations();
	}


}

?>