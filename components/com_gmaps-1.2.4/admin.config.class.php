<?php
/**
* @version 
* @package 		GMaps
* @subpackage 	Administration
* @copyright 	(C) 2006-2007 Chris Strieter
* @license 		http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
// Joomla 1.5 defined( '_JEXEC' ) or die( 'Restricted access' );

class Config {

    function Config() {
    }
    
function readCSS() {
			
		global $mosConfig_absolute_path;
		$cssfile = $mosConfig_absolute_path."/components/com_jdirectory/css/jdirectory.css";
		if ($fp = fopen( $cssfile, "r" )){
			$css = fread( $fp, filesize( $cssfile ) );
			$css = htmlspecialchars( $css );
		}
			else mosRedirect( "index2.php?option=com_jdirectory", "Error opening ".$cssfile );
		return $css;		
}

   function saveCSS() {
		global $mosConfig_absolute_path;
		$option = "com_jdirectory";
		$csscontent = mosGetParam( $_POST, 'csscontent', '', _MOS_ALLOWHTML );	
		$enable_write = mosGetParam($_POST,'enable_write',null);
		$disable_write = mosGetParam($_POST,'disable_write',null);

		$cssfile = $mosConfig_absolute_path."/components/com_jdirectory/css/jdirectory.css";
		$perms = fileperms($cssfile);
		if (!$csscontent ){
			$redirect_url =  "index2.php?option=$option";
			$redirect_msg = "Operation failed: no content";
			mosRedirect( $redirect_url, $redirect_msg );	
		}
		if ($enable_write) 
			@chmod($cssfile, 0777);
				
		if (is_writable( $cssfile ) == false){
			$redirect_url =  "index2.php?option=$option&task=editcss";
			$redirect_msg = "Operation failed: file is unwritable";
			mosRedirect( $redirect_url, $redirect_msg );
		}
		if ($fileopen = fopen ($cssfile, "w")) {
			fputs( $fileopen, stripslashes( $csscontent ) );
			fclose( $fileopen );
			$redirect_msg = "Changes saved";
			$redirect_url =  "index2.php?option=$option&task=editcss";
			mosRedirect( $redirect_url, $redirect_msg );
		}
		if ($disable_write)
			@chmod($cssfile, 0440);    	
    }
    
    
    
}
?>