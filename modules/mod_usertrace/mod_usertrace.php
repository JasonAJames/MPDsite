<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$enablesectionlink = $params->get( 'enablesectionlink' );
if($enablesectionlink) {
	$user =& JFactory::getUser();
	$id = $user->get('id');
	if($id > 0) {
		echo '<a href="'.JRoute::_( 'index.php?option=com_usertrace&task=showsec' ).'">See all Sections</a>';
	} else {
		echo 'Please log in.';
	}
}

// Get object database
$db =& JFactory::getDBO();

// Get Data
	// Get userid
		$user =& JFactory::getUser();
		$userid = $user->get('id');
		$varname = "userid"; if($$varname == "") { $$varname = "NULL"; } else { $$varname = "'".$$varname."'"; }
	// Get username
		$username = $user->get('username');
		$varname = "username"; if($$varname == "") { $$varname = "NULL"; } else { $$varname = "'".$$varname."'"; }
	// Get ip
		$varname = "ip"; $$varname = "";
		if(isset($_SERVER["REMOTE_ADDR"])) { $$varname = $_SERVER["REMOTE_ADDR"]; }
		if($$varname == "") { $$varname = "NULL"; } else { $$varname = "'".$$varname."'"; }
	// Get agent
		$varname = "agent"; $$varname = "";
		if(isset($_SERVER["HTTP_USER_AGENT"])) { $$varname = $_SERVER["HTTP_USER_AGENT"]; }
		if($$varname == "") { $$varname = "NULL"; } else { $$varname = "'".$$varname."'"; }
	// Get url
		$varname = "url"; $$varname = "";
		if(isset($_SERVER["REQUEST_URI"])) { $$varname = $_SERVER["REQUEST_URI"]; }
		if($$varname == "") { $$varname = "NULL"; } else { $$varname = "'".$$varname."'"; }
	// Get ref
		$varname = "ref"; $$varname = "";
		if(isset($_SERVER["HTTP_REFERER"])) { $$varname = $_SERVER["HTTP_REFERER"]; }
		if($$varname == "") { $$varname = "NULL"; } else { $$varname = "'".$$varname."'"; }
	// Get time
		$date =& JFactory::getDate();
		$time = $date->toMySQL();
		$varname = "time"; if($$varname == "") { $$varname = "NULL"; } else { $$varname = "'".$$varname."'"; }
// Log Data
	// Write data
	$query = "INSERT INTO #__usertrace (id, userid, username, ip, agent, url, ref, time) VALUES (NULL, $userid, $username, $ip, $agent, $url, $ref, $time);";
	$db->setQuery($query);
	if( !$db->query() ) { echo 'Module error'; }
	

