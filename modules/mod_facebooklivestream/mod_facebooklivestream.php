<?php
/**
 * Joomla! 1.5 Egbzoom Facebook Live Stream
 *
 * @author EGBZOOM http://www.egbzoom.com
 * @package EGBZOOM 
 * @copyright Copyright 2010
 * GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html 
 * @link http://egbzoom.com
 * @version 1.5.0.1
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

class egbzoomface {

  function pagelistings($params,$keyvalues)
  {
    $keyvalues=trim($params->get('api_id'));
  	global $mainframe;
  	if ((!$keyvalues)) {
			$egbzoom = 'Please enter valid Profile ID.';
  	} else {
  		
				$egbzoom = '<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>';
			$egbzoom .= '<script type="text/javascript">FB.init("'.$keyvalues.'");</script>';
			$egbzoom .= '<fb:live-stream event_app_id="'.$keyvalues.'" stream="1"  width="'.trim( $params->get( 'widths' ) ).'" height="'.trim( $params->get( 'heights' ) ).'">';

		 $egbzoom .= '</fb:fan>';
		 
		 
		 if (trim( $params->get( 'poweredbyonoroff' ) )) {
		 $egbzoom .= '<div style="width:300px;">Powered By &nbsp;<a target="_blank" href="'.trim($params->get('poweredby')).'"> '.trim( $params->get( 'poweredby' ) ).'';
				 $egbzoom .= '</a></div>';
}
		 
}
	  return $egbzoom;
  }
}

$egbzoom = egbzoomface::pagelistings($params,$keyvalues);
require(JModuleHelper::getLayoutPath( 'mod_facebooklivestream'));
?>