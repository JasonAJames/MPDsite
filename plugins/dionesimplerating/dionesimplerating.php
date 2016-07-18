<?php

/**
 * DioneSoft Company
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the DioneSoft EULA that is bundled with
 * this package in the file GPL.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/copyleft/gpl.html
 *
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@dionesoft.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade the extension
 * to newer versions in the future. If you wish to customize the extension
 * for your needs please refer to http://www.dionesoft.com/ for more information
 * or send an email to sales@dionesoft.com
 *
 * @category   DioneSoft
 * @package    Dione Simple Rating
* @copyright Copyright (C) 2010 DioneSoft Company (http://www.dionesoft.com)
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );
 
class plgContentDioneSimpleRating extends JPlugin
{
	function onPrepareContent( &$article, &$params, $page=0)
	{
		global $mainframe;
		
		// A database connection is created
        $db = JFactory::getDBO();		
		$view  = JRequest::getCmd('view');
		
		if(!$page) {
			$page = 0;
		}		
		
		// get current document
		$document =& JFactory::getDocument();		
		
		// Get Plugin info
		$plugin			=& JPluginHelper::getPlugin('content', 'dionesimplerating');
		$pluginParams	= new JParameter( $plugin->params );
		
		// simple performance check to determine whether bot should process further
		if ( JString::strpos( $article->text, 'dionesimplerating' ) === false ) {
			return true;
		}
		
		$plugin_block_regex = '/({dionesimplerating.*?}.*?{\/dionesimplerating})/s';
		
		$begin_block_regex = '/{dionesimplerating\s+id="([^"]+)?"\s+parameters="([^"]+)?"}/'; # pattern match the regex like {dionesimplerating id="..." parameters="..."}
		$end_block_regex = '/{\/dionesimplerating}/';
		
		if ( !$pluginParams->get( 'enabled', 1 ) ) {
			$article->text = preg_replace( $plugin_block_regex, '<br />', $article->text );
			return true;
		}		
		
		$plugin_text_matches = array();
		
		preg_match_all( $plugin_block_regex, $article->text, $plugin_text_matches );
		
		// Number of plugins
		$count = count( $plugin_text_matches[0] );				
			
		if ( $count ) {
			# parameters from the Back-End
			$targeturl = $this->params->get('targeturl');
			$curvalue = $this->params->get('curvalue');
			$maxvalue = $this->params->get('maxvalue');
			
			# add the declaration for the JQuery Library and Library
			$document->addScript("plugins/content/dionesimplerating/js/jquery.js");
			$document->addScript("plugins/content/dionesimplerating/js/rating.js");
			
			# add the declaration for the CSS files
			$document->addStyleSheet("plugins/content/dionesimplerating/css/rating.css");
			
			# begin of the JS-code's defenition
			$script = '$(document).ready(function(){';
			
			for ( $i = 0; $i < $count; $i++ ){
				$plugin_id = -1;
				$plugin_text = $plugin_text_matches[0][$i];
				
				if (preg_match( $begin_block_regex, $plugin_text)){
					$head_matches = array();
					preg_match( $begin_block_regex, $plugin_text, $head_matches);
					
					$plugin_tag = $head_matches[0];
					$plugin_id = $head_matches[1];
					
					$plugin_params = "";
					if (isset($head_matches[2])){
						$plugin_params = $head_matches[2];
					}
					
					if ($plugin_params != ""){
						// Parse of input params from the template
						$params_matches = preg_split( "/,/", $plugin_params);
						
						for ( $j = 0; $j < count( $params_matches); $j++ ){
							$params_parts_matches = preg_split( "/:/", $params_matches[$j]);
							
							$param_name = $params_parts_matches[0];
							$param_value = $params_parts_matches[1];
							
							$param_name = trim($param_name);
							$param_value = trim($param_value);
							
							if ($param_name == "targeturl"){
								$param_value = str_replace("'", "", $param_value);
								$targeturl = $param_value;
							}
							
							if ($param_name == "curvalue"){
								$param_value = str_replace("'", "", $param_value);
								$curvalue = $param_value;
							}
							
							if ($param_name == "maxvalue"){
								$param_value = str_replace("'", "", $param_value);
								$maxvalue = $param_value;
							}							
						}
					}
				}
				
				if (preg_match( $end_block_regex, $plugin_text)){
					$replaced_text = "<div id='dionesimplerating_".$plugin_id."' class='rating'>&nbsp;</div>";
					
					if ($targeturl != ""){
						$script .= 'jQuery("#dionesimplerating_'.$plugin_id.'").rating(';
						
						if ($maxvalue != "" || $curvalue != ""){
							$script .= '	\''.$targeturl.'\',';
							
							if ($maxvalue != "" && $curvalue != ""){
								$script .= '	{maxvalue: '.$maxvalue.', curvalue: '.$curvalue.'}';
							}
							elseif($maxvalue != ""){
								$script .= '	{maxvalue: '.$maxvalue.'}';
							}
							elseif ($curvalue != ""){
								$script .= '	{curvalue: '.$curvalue.'}';
							}
						}
						else{
							$script .= '	\''.$targeturl.'\'';
						}
						
						$script .= ');';
					}					
					
					$article->text = str_replace( $plugin_text, $replaced_text, $article->text );
				}
			}
			
			# end of the JS-code's defenition
			$script .= '});';
			$document->addScriptDeclaration($script);			
		}
		
		return true;
	}
}