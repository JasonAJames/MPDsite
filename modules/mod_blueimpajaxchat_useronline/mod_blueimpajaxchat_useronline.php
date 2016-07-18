<?php
/**
* @version $Id: mod_holidaygreetings.php 5203 2006-09-27 02:45:14Z Danr $
* @package Joomla
* @copyright Copyright (C) 2007 Dan Rahmel. All rights reserved.
* @license GNU/GPL
* This is a module to display a holiday greeting on the proper day.
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<div><small>
<?php
?>
</small></div>
<?php
     $boldSetting = $params->get('boldy', 0);
     $chaturl = $params->get('urlchat');
     $fontca = $params->get('fontcoloradmin');
     $fontcu = $params->get('fontcoloruser');
     $message = $params->get('message');
     if ($boldy == 1) {
          $bb = "<b>";
          $be = "</b>";
     } else {
          $bb = "";
          $be = "";
     }
     $db =& JFactory::getDBO();
     $query = "SELECT * FROM ajax_chat_online";
     $db->setQuery($query);
     $rows = $db->loadObjectList();
     $i		= 0;
	  $lists	= array();
	  echo JText::_( 'Utenti in Chat:');  
		foreach ( $rows as $row )     
     {
     $lists[$i]->userName = $row->userName;
     if ($row->userRole =='3'){
     echo JText::_( '<font color="'.$fontca.'">' . $bb .$lists[$i]->userName . $be . '</font>  ');  
     }
     else{
     echo JText::_( '<font color="'.$fontcu.'">' . $bb .$lists[$i]->userName . $be . '</font>  ');
	  }
		  
	  $i++;
     }
     $content ="<p align=\"center\"><a href=".$chaturl." onclick=\"window.open(this.href,'Chat','resizable=yes,location=no,menubar=yes,scrollbars=yes,status=yes,toolbar=yes,fullscreen=no,dependent=no,width=700,height=500,left=30,top=40,status'); return false\"><img src=\"../modules/mod_blueimpajaxchat_useronline/images/chat.png\" align=\"middle\"></a><a href=".$chaturl." onclick=\"window.open(this.href,'Chat','resizable=yes,location=no,menubar=yes,scrollbars=yes,status=yes,toolbar=yes,fullscreen=no,dependent=no,width=700,height=500,left=30,top=40,status'); return false\">".$message."</a></p>";
     return $lists;

?>


