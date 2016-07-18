<?php
/**
* @Copyright Copyright (C) 2010- Gary Teh Name1price.Com
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
**/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.controller');

/**
 * User Component Controller
 *
 * @package		Joomla
 * @subpackage	Weblinks
 * @since 1.5
 */
class SimpleSubscribeController extends JController
{
	/**
	 * Method to display a view
	 *
	 * @access	public
	 * @since	1.5
	 */
	function display()
	{
		parent::display();
	}


	/**
	 * Save user registration and notify users and admins if required
	 * @return void
	 */
	function register_save()
	{
		global $mainframe;

		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		// Get required system objects
		$user 		= clone(JFactory::getUser());
		$pathway 	=& $mainframe->getPathway();
		$config		=& JFactory::getConfig();
		$authorize	=& JFactory::getACL();
		$document   =& JFactory::getDocument();

		// If user registration is not allowed, show 403 not authorized.
		$usersConfig = &JComponentHelper::getParams( 'com_users' );
		if ($usersConfig->get('allowUserRegistration') == '0') {
			JError::raiseError( 403, JText::_( 'Access Forbidden' ));
			return;
		}

		// Initialize new usertype setting
		$newUsertype = $usersConfig->get( 'new_usertype' );
		if (!$newUsertype) {
			$newUsertype = 'Registered';
		}

		// Bind the post array to the user object
		if (!$user->bind( JRequest::get('post'), 'usertype' )) {
			JError::raiseError( 500, $user->getError());
		}

		// Set some initial user values
		$user->set('id', 0);
		$user->set('usertype', $newUsertype);
		$user->set('gid', $authorize->get_group_id( '', $newUsertype, 'ARO' ));

		$date =& JFactory::getDate();
		$user->set('registerDate', $date->toMySQL());

		// If user activation is turned on, we need to set the activation information
		$useractivation = $usersConfig->get( 'useractivation' );
		if ($useractivation == '1')
		{
			jimport('joomla.user.helper');
			$user->set('activation', JUtility::getHash( JUserHelper::genRandomPassword()) );
			$user->set('block', '1');
		}

		// If there was an error with registration, set the message and display form
		if ( !$user->save() )
		{
			JError::raiseWarning('', JText::_( $user->getError()));
			//$this->register();
			return false;
		}

		// Send registration confirmation mail
		$password = JRequest::getString('password', '', 'post', JREQUEST_ALLOWRAW);
		$password = preg_replace('/[\x00-\x1F\x7F]/', '', $password); //Disallow control chars in the email
		SimpleSubscribeController::_sendMail($user, $password);

		// Everything went fine, set relevant message depending upon user activation state and display message
		if ( $useractivation == 1 ) {
			$message  = JText::_( 'REG_COMPLETE_ACTIVATE' );
		} else {
			$message = JText::_( 'REG_COMPLETE' );
		}

		SimpleSubscribeController::_sendToPaypal($user);
		//$this->setRedirect('index.php', $message);
	}

	function _sendToPaypal(&$user){

		global $mainframe;

		$db		=& JFactory::getDBO();
		$query = "select * from jos_simplesub_options";
		$db->setQuery($query);

		$rows = $db->loadAssocList();

		$results = array();
		foreach($rows	as $row){

			$results[$row['field_name']] = $row['field_value'];
		}




		$location = "";

		$location .= "Location: https://www.paypal.com/cgi-bin/webscr?business=".$results['paypal_id']."&";
		$location .= "return=".urlencode(JURI::base()."?option=com_simplesubscribe&task=activate")."&";
		$location .= "cancel_return=".urlencode(JURI::base()."?option=com_simplesubscribe&task=cancel")."&";
		$location .= "notify_url=".urlencode(JURI::base()."?option=com_simplesubscribe&task=notify")."&";

		$location .= "rm=2&";
		$location .= "currency_code=".$results['currency']."&";
		$location .= "lc=".$results['currency']."&";
		$location .= "bn=wp_e-commerce&";
		$location .= "no_shipping=0&";
		$location .= "no_note=1&";

		$location .= "item_name_1=".urlencode($mainframe->getCfg('sitename'))."&";


		$location .= "amount_1=".$results['subscription_amount']."&";
		$location .= "tax_1=0.00&";
		$location .= "quantity_1=1&";
		$location .= "item_number_1=".mysql_insert_id()."&";
		$location .= "shipping_1=0.00&";
		$location .= "shipping2_1=0.00&";
		$location .= "handling_1=&";


		$location .= "tax=&";

		/*Shipping cost*/
		$location .= "handling_cart=0.00&";

		$location .= "custom=&";

		/*Gary : Our Invoice number -> for some weird reason activation key when put in any other places results in field going missing*/
		$location .= "invoice=".$user->get('activation')."&";


		foreach($_REQUEST as $key =>$value){
			$location .= urlencode("$key=$value")."&";
		}

		/*Sets the user activation key*/
		$usersConfig 	= &JComponentHelper::getParams( 'com_users' );
		$sitename 		= $mainframe->getCfg( 'sitename' );
		$useractivation = $usersConfig->get( 'useractivation' );



		$location .= "upload=1&";
		$location .= "cmd=_ext-enter&";
		$location .= "redirect_cmd=_cart";

		header($location);
		echo $location;
		return;

		//$view =& $this->getView('register');
		$view =& $this->getView('register', 'html', 'SimplesubscribeView');
		//$view->assignRef( 'rows', $rows );
		$view->setLayout('done');
		$view->display();


	}

	function notify()
	{


	}

	function activate()
	{
		global $mainframe;

		// Initialize some variables
		$db			=& JFactory::getDBO();
		$user 		=& JFactory::getUser();
		$document   =& JFactory::getDocument();
		$pathway 	=& $mainframe->getPathWay();

		$usersConfig = &JComponentHelper::getParams( 'com_users' );
		$userActivation			= $usersConfig->get('useractivation');
		$allowUserRegistration	= $usersConfig->get('allowUserRegistration');

		// Check to see if they're logged in, because they don't need activating!
		if ($user->get('id')) {
			// They're already logged in, so redirect them to the home page
			$mainframe->redirect( 'index.php' );
		}

		if ($allowUserRegistration == '0' || $userActivation == '0') {
			JError::raiseError( 403, JText::_( 'Access Forbidden' ));
			return;
		}



		$message = new stdClass();
			//print_r($_REQUEST);
		// Do we even have an activation string?
		$activation = JRequest::getVar('invoice', '', '', 'alnum' );
		$activation = $db->getEscaped( $activation );

		if (empty( $activation ))
		{
			// Page Title
			$document->setTitle( JText::_( 'REG_ACTIVATE_NOT_FOUND_TITLE' ) );
			// Breadcrumb
			$pathway->addItem( JText::_( 'REG_ACTIVATE_NOT_FOUND_TITLE' ));

			$message->title = JText::_( 'REG_ACTIVATE_NOT_FOUND_TITLE' );
			$message->text = JText::_( 'REG_ACTIVATE_NOT_FOUND' );


			$view =& $this->getView('register', 'html', 'SimplesubscribeView');
			//$view->assignRef( 'rows', $rows );
			$view->assign('message', $message);
			$view->setLayout('done');


			return;
		}

		// Lets activate this user
		jimport('joomla.user.helper');
		if (JUserHelper::activateUser($activation))
		{
			// Page Title
			$document->setTitle( JText::_( 'REG_ACTIVATE_COMPLETE_TITLE' ) );
			// Breadcrumb
			$pathway->addItem( JText::_( 'REG_ACTIVATE_COMPLETE_TITLE' ));

			$message->title = JText::_( 'REG_ACTIVATE_COMPLETE_TITLE' );
			$message->text = JText::_( 'REG_ACTIVATE_COMPLETE' );
		}
		else
		{
			// Page Title
			$document->setTitle( JText::_( 'REG_ACTIVATE_NOT_FOUND_TITLE' ) );
			// Breadcrumb
			$pathway->addItem( JText::_( 'REG_ACTIVATE_NOT_FOUND_TITLE' ));

			$message->title = JText::_( 'REG_ACTIVATE_NOT_FOUND_TITLE' );
			$message->text = JText::_( 'REG_ACTIVATE_NOT_FOUND' );
		}

		//$view =& $this->getView('register');
		$view =& $this->getView('register', 'html', 'SimplesubscribeView');
		//$view->assignRef( 'rows', $rows );
		$view->setLayout('done');
		$view->display();
	}



	function _sendMail(&$user, $password)
	{
		global $mainframe;

		$db		=& JFactory::getDBO();

		$name 		= $user->get('name');
		$email 		= $user->get('email');
		$username 	= $user->get('username');

		$usersConfig 	= &JComponentHelper::getParams( 'com_users' );
		$sitename 		= $mainframe->getCfg( 'sitename' );
		$useractivation = $usersConfig->get( 'useractivation' );
		$mailfrom 		= $mainframe->getCfg( 'mailfrom' );
		$fromname 		= $mainframe->getCfg( 'fromname' );
		$siteURL		= JURI::base();

		$subject 	= sprintf ( JText::_( 'Account details for' ), $name, $sitename);
		$subject 	= html_entity_decode($subject, ENT_QUOTES);

		if ( $useractivation == 1 ){
			$message = sprintf ( JText::_( 'SEND_MSG_ACTIVATE' ), $name, $sitename, $siteURL."index.php?option=com_user&task=activate&activation=".$user->get('activation'), $siteURL, $username, $password);
		} else {
			$message = sprintf ( JText::_( 'SEND_MSG' ), $name, $sitename, $siteURL);
		}

		$message = html_entity_decode($message, ENT_QUOTES);

		//get all super administrator
		$query = 'SELECT name, email, sendEmail' .
				' FROM #__users' .
				' WHERE LOWER( usertype ) = "super administrator"';
		$db->setQuery( $query );
		$rows = $db->loadObjectList();

		// Send email to user
		if ( ! $mailfrom  || ! $fromname ) {
			$fromname = $rows[0]->name;
			$mailfrom = $rows[0]->email;
		}

		JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);

		// Send notification to all administrators
		$subject2 = sprintf ( JText::_( 'Account details for' ), $name, $sitename);
		$subject2 = html_entity_decode($subject2, ENT_QUOTES);

		// get superadministrators id
		foreach ( $rows as $row )
		{
			if ($row->sendEmail)
			{
				$message2 = sprintf ( JText::_( 'SEND_MSG_ADMIN' ), $row->name, $sitename, $name, $email, $username);
				$message2 = html_entity_decode($message2, ENT_QUOTES);
				JUtility::sendMail($mailfrom, $fromname, $row->email, $subject2, $message2);
			}
		}
	}

}
?>
