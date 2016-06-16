<?php

/**
* @version 
* @package 		GMaps
* @subpackage 	Classes
* @copyright 	(C) 2006-2007 Chris Strieter
* @license 		http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


/**
 * Not sure I like this class.  Need to reevaluate how to handle error messages 
 */
class ErrorHandler {

    function ErrorHandler() {
    	
    }
    
    function displayError($message, $module=null, $function=null) {
		echo "<script> alert('".$message."'); window.history.go(-1); </script>\n";
		exit();    	
    }
    
    function handleError($module, $function, $message) {
    	global $mosConfig_live_site, $_QUERY_STRING;
    	echo $_QUERY_STRING;
    	echo '<div id="errorblock">';
    	echo '<h1>AN ERROR HAS OCCURED</h1>';
    	echo '<h3>Details<h3/>';
   		echo '<b>Module:</b>' . $module . '<br/>';
   		echo '<b>Function:</b>' . $function . '<br/>';   		
   		echo '<b>Message:</b>' . $message . '<br/>';
   		echo '<form><input type="button" name="continue" value="Continue" onClick="javascript:window.location="index.php?option=com_gmaps"></form>';
    	echo '</div>';
    }
    
}
?>