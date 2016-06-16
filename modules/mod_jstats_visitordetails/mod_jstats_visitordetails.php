<?php
/**
* @version		$Id: mod_jstats_visitordetails.php 2.5.0.226 dev 2009-03-03 00:57:00 Grinsekatze $
* @package		JoomlaStats Visitor Details Module
* @copyright	Copyright (C) 2004 - 2009 JoomlaStats Team.
* @license		GNU/GPL, see http://www.gnu.org/licenses/gpl-2.0.html
*/

// no direct access
defined('_JEXEC') or die ('Direct Access to this location is not allowed.');


//#######################

//  TODO: 
//     1) wrong address to module page in variable $this_js_extension*
//     2) wrong address in xml file

//#######################


//include JoomlaStats API
//to increase performance we include 'db.constants.php' instead of 'api.include.php'
//$js_PathToJSDBConst = JPATH_ADMINISTRATOR .DS. 'components' .DS. 'com_joomlastats' .DS. 'database' .DS. 'db.constants.php';
$js_PathToJoomlaStatsApi = JPATH_ADMINISTRATOR .DS. 'components' .DS. 'com_joomlastats' .DS. 'api' .DS. 'api.include.php';
if ( !is_readable($js_PathToJoomlaStatsApi) || !include_once($js_PathToJoomlaStatsApi) ) {
	$this_js_extension_homepage = 'http://www.joomlastats.org/index.php?option=com_content&amp;task=view&amp;id=118&amp;Itemid=38';//remeber to replace '&' by '&amp;'
	$this_js_extension_install_problem_text = '<div style="color: red;">It seams that <a href="'.$this_js_extension_homepage.'" target="_blank"><b>module Visitor Details (mod_jstats_visitordetails)</b></a> is not installed correctly. Please refer to <a href="http://www.joomlastats.org/entry/installation_noengine.php" target="_blank"><b>JoomlaStats extension installation problem</b></a> page.</div><br/><br/>';
	echo $this_js_extension_install_problem_text;
	return false; //this will end of this script //this also solve problem require_once (include_once now is enough and it generate only warning)
}




//
// GET USER DATA
//

$list_tld_images_dir         = $params->get('list_tld_images_dir');
$list_os_images_dir          = $params->get('list_os_images_dir');
$list_browser_images_dir     = $params->get('list_browser_images_dir');
$content_format              = $params->get('content_format');

$tld_translation_tool        = $params->get('tld_translation_tool');
$os_translation_tool         = $params->get('os_translation_tool');
$browser_translation_tool    = $params->get('browser_translation_tool');






//
// VALIDATE USER DATA
//
if (!function_exists('js_mvd_create_translation_arr')) {
	/** THIS FUNCTION SHOULD BE MOVED TO "api.modules.php" file (name should be "create_translation_arr") */
	/**
	 *   $translation_tool_str example format: "de=Deutschland; nl=Niederlande; us=Vereinigte Staaten" (semicolon is separator (not space))
	 */
	function js_mvd_create_translation_arr($translation_tool_str) {
		if (strlen($translation_tool_str) == 0)
			return array();

		$translation_arr = array();
		$trans_arr = explode(';', $translation_tool_str);
		foreach ($trans_arr as $trans) {
			$var_val_arr = explode('=', $trans);
			if ( !isset($var_val_arr[0]) || !isset($var_val_arr[1]) )
				continue;
			$var = trim($var_val_arr[0]);
			$val = trim($var_val_arr[1]);
			if ( (strlen($var_val_arr[0]) == 0) || (strlen($var_val_arr[1]) == 0) )
				continue;
			$translation_arr[$var] = $val;
		}

		return $translation_arr;
	}
}

//create translation arrays
$tld_translation_arr     = js_mvd_create_translation_arr($tld_translation_tool);
$os_translation_arr      = js_mvd_create_translation_arr($os_translation_tool);
$browser_translation_arr = js_mvd_create_translation_arr($browser_translation_tool);






//
// ENGINE
//

$JSApiGeneral = new js_JSApiGeneral();//this line is needed only to do not rise PHP notice in PHP4. All methods in JoomlaStats API are static
$JSApiGeneral->getVisitorDetails( $list_os_images_dir, $list_browser_images_dir, $list_tld_images_dir, $Visitor );


//debug code
//echo '<br/><br/><b>VisitorDetails</b><pre>'.print_r($Visitor, true).'</pre><br/><br/>';


$tld_name     = $Visitor->Tld->tld_name;
$os_name      = $Visitor->OS->os_name;
$browser_name = $Visitor->Browser->browser_name;

{//make translation using translation tool - replace JS strings by user defined names
	if ( isset($tld_translation_arr[$Visitor->Tld->tld]) )
		$tld_name = $tld_translation_arr[$Visitor->Tld->tld];
	if ( isset($os_translation_arr[$os_name]) )
		$os_name = $os_translation_arr[$os_name];
	if ( isset($browser_translation_arr[$browser_name]) )
		$browser_name = $browser_translation_arr[$browser_name];
}


$hash_trans_arr						= array();
$hash_trans_arr['#visitor_ip'] 		= $Visitor->visitor_ip;
$hash_trans_arr['#tld_name'] 		= $tld_name;
$hash_trans_arr['#tld_img_html']	= $Visitor->Tld->tld_img_html;
$hash_trans_arr['#os_name'] 		= $os_name;
$hash_trans_arr['#os_img_html']		= $Visitor->OS->os_img_html;
$hash_trans_arr['#browser_name'] 	= $browser_name;
$hash_trans_arr['#browser_img_html']= $Visitor->Browser->browser_img_html;



$content_format = str_replace("\n", '<br/>', $content_format); //on Windows line ending is also only "\n" (not "\n\r")


$content_str = strtr($content_format, $hash_trans_arr);









//
//
// TEMPLATES BELOW
//
//



$content = '';

$content .= $content_str;