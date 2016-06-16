<?php

/**
* @version 
* @package 		GMaps
* @subpackage 	Classes
* @copyright 	(C) 2006-2007 Chris Strieter
* @license 		http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

/**
 * CHANGE HISTORY:
 * 02/22/2007	Changed the DIV ID around the marker index to allow styling of the marker index title
 * 				(Requested by GreatJava!)
 * 02/24/2007	Removed the hardcode iconSize of 12,20 to let Google determine size automagically and
 * 				render appropriately.
 * 03/01/2007	Added support to pull the INDEXTITLE property from the map -- default to Index
 * 				Added support for default lat/long as defined on map page
 * 03/04/2007	Added support for enabling directions on the markers for a map
 * 03/06/2007	Resolved issue with the viewport/index issues
 * 03/12/2007	Added support for tab ordering, tab header definition and auto opening of a defined marker
 * 03/12/2007	Addes standard hover over the marker
 * 03/15/2007	Added support for images in the info window
 * 04/13/2007	Added variable initializations to remove PHP NOTICE warnings
 * 05/15/2007	Added markerList initialization aorund line # 166
 * 06/04/2007	Fixed issue with IE7 and the additional period in the width found in function 'getImageOnlyTab'
 * 08/01/2007	Change the setupmarkers function to be map specific by adding the map id to the function name
 * 11/07/2007	Made it compatible with Joomla15
 */


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class GoogleAPI {

    function GoogleAPI() {
    }
    
   function getMap($map) {
		global $mosConfig_absolute_path, $mosConfig_live_site,$mainframe;
		
		$props  = $map->getProperties();
		$properties = GoogleAPI::parmToArray($props);
		
		$latitude = '39.673370' ;
		$longitude ='-104.897461' ;

		// Initialize variables		
		$markerid=''; $id = ''; $zoom = ''; $height = ''; $width=''; $maptype=''; $key='';$zoomtype='';
		$showindex=''; $showmaptype='';$defaulticon='';$indexformat='';$indextitle='';
		$centerlatitude = ''; $centerlongitude = ''; $enabledirections = '';$tab1content = '';
		$tab1header = ''; $tab2content = ''; $tab2header = ''; $autoopenmarker = '';
		
		foreach ($properties as $arraykey => $value) {
			switch ($arraykey) {
				case 'id':
					$id = $value;
					break;
				case 'zoom':
					$zoom = $value;
					break;
				case 'height':
					$height = $value;
					break;
				case 'width':
					$width = $value;
					break;
				case 'maptype':
					$maptype = $value;
					break;															
				case 'key':
					$key = $value;
					break;	
				case 'zoomtype':
					$zoomtype = $value;
					break;
				case 'showindex':
					$showindex = $value;
					break;							
				case 'showmaptype':
					$showmaptype = $value;
					break;
				case 'defaulticon':
					$defaulticon = $value;
					break;
				case 'indexformat':
					$indexformat = $value;
					break;
				case 'indextitle':
					$indextitle = $value;
					break;
				case 'centerlatitude':
					$centerlatitude = $value;
					break;			
				case 'centerlongitude':
					$centerlongitude = $value;
					break;
				case 'markerid':
					$markerid = $value;
					break;
				case 'enabledirections':
					$enabledirections = $value;
					break;		
				case 'tab1content':
					$tab1content = $value;
					break;
				case 'tab1header':
					$tab1header = $value;
					break;
				case 'tab2content':
					$tab2content = $value;
					break;
				case 'tab2header':
					$tab2header = $value;
					break;
				case 'autoopenmarker':
					$autoopenmarker = $value;
					break;																
			}
		}

		// change made to fix JcalPro problem		
		require_once('writecustomheadtag.php');
		//$mainframe->addCustomHeadTag( "<script src=\"http://maps.google.com/maps?file=api&amp;v=2&amp;key=".$key."\" type=\"text/javascript\"></script>");
		

		if (is_numeric($width))
		{
			$width .= "px";
		}
		if (is_numeric($height))
		{
			$height .= "px";
		}

		// Initialize code string
		$code="";

		// Generate Index of Map ELements
		$code.= $this->generateMarkerIndex($map, $showindex, $indexformat, $indextitle, $markerid, ' | ');
		// TODO: Refactor this .. I don't like having this many arguments to the function
		$code .= $this->generateMap($id, $map, $height, $width, $maptype, $showmaptype, 
			$zoom, $zoomtype, $centerlatitude, $centerlongitude, $enabledirections,
			$tab1content, $tab1header, $tab2content, $tab2header, $autoopenmarker, 
			$markerid);
		return $code;		
 
    }    
    
	/**
	 * 	This function is responsible for generating the code necessary to render the
	 * 	Marker index. 
	 */
	function generateMarkerIndex($map, $showindex, $indexformat, $indextitle, $markerid, $divider = ' | ') {
		$code = '';
		$markerList = '';
		if ($showindex == 'Y') {
			if (strlen($indextitle)==0) {
				$code.="<DIV id=\"markerlistHeading\">Index</div>";
			} else {
				$code.="<DIV id=\"markerlistHeading\">".$indextitle."</div>";
			}
			$code.="<div id='markerList'>";
			for ($y=0; $y<(sizeof($map->getMarkers())); $y++) {
				$mp = $map->getMarker($y);
				$listEntry="<a href=\"javascript:openInfoWindow(" .$mp->getId().");\">" .$mp->name."</a>";
				// Indexformat 0 = vertical, 1 = horizontal
				if ($indexformat == 0) {
					$listEntry = '<li>' . $listEntry . '</li>';
				} else
					$listEntry .= $divider;				
				if (strlen($markerid)==0) {
					$markerList .= $listEntry;
				} else if ($markerid == $mp->getId()){
					$markerList .= $listEntry;
				}						
			}				
			if ($indexformat == 0) {			
				$code.="<ul>" . $markerList. "</ul>";
			} else
				$code .= $markerList;
				
			$code.="</div>";
		}
		return $code;
	}    

	/**
	 * 	This function is the core routine that drives the building the mapping code
	 */
	function generateMap($id, $map, $height, $width, $maptype, $showmaptype, $zoom, $zoomtype, 
				$centerlatitude,$centerlongitude,$enabledirections,
				$tab1content, $tab1header, $tab2content, $tab2header, $autoopenmarker, 
				$markerid=null) {
		// Generate the map position prior to any Google Scripts so that these can parse the code
		$code = '';

		$code.="<div id=\"googlemap_".$id."\" style=\"width:".$width."; height:".$height."\"></div>";
		$code.="<div id=\"componenttitle\">Powered by <a href='http://www.firestorm-technologies.com/' target='_blank'>GMaps</a> and Google</div>";
	
		$code.="<script type='text/javascript'>//<![CDATA[\n";
		$code .= "/* com_gmaps_firestorm - 2007 */";
		$code .= "	var Markers = new Array();	var MarkersInfo = new Array();";
		$code .= "  var map_". $id . "=null;";
		$code .= "  var mgr_". $id . "=null;";		

		$code .= 'function setupMap() {';
		
		$code .= '	if (GBrowserIsCompatible()) {';
	    $code .= ' 		map_'.$id.' = new GMap2(document.getElementById("googlemap_'.$id.'"));';
	    
	    //$code .= $this->setMaptype($id, $maptype);
	    if ($showmaptype == "Y") {
	    	$code.=	 '		map_'.$id.'.addControl(new GMapTypeControl());';
		}
	   	$code .= $this->setMapZoomtype($id, $zoomtype );
	   	$code .= '		map_'.$id.'.enableDoubleClickZoom();';
	    $code .= $this->writeMapCenter($map,$zoom, $centerlatitude, $centerlongitude);
		$code .= $this->setMaptype($id, $maptype);	    
	  	$code .= '   	window.setTimeout(setupMarkers'.$id.', 1200);';
	    $code .= '  }';
	    $code .= '}';

		$code .= 'function openInfoWindow(id) {';
		$code .= '  var enabledirections = "'.$enabledirections.'";';
		$code .= "  if (enabledirections == 'N') {"; 
		$code .= "     Markers[id].openInfoWindowHtml(MarkersInfo[id]); ";
		$code .= "  } else {";		
		$code .= "     Markers[id].openInfoWindowTabsHtml(MarkersInfo[id]); ";
		$code .= " }";
		$code .= "}";
		
		
     	$code .= 'function setupMarkers'.$id.'() {
      				//mgr_'.$id.' = new GMarkerManager(map_'.$id.');
      		';
      		
		for ($y=0; $y<(sizeof($map->getMarkers())); $y++) {		
				$mp = $map->getMarker($y);
				if (strlen($markerid)==0) {
					if (strlen($mp->getHeight()==0) || strlen($mp->getWidth()==0)) {
						return '<b>Error with height/width of icon associated with on marker ' . $mp->getName() . '</b>';
					}
					$code.= $this->writeIconCode($mp);
					$code .= $this->writeCreateMarkerCode($id, $mp);
					$code .= $this->writeCreateMarkerInfo($id, $mp,$tab1content, $tab1header, $tab2content, $tab2header,  $enabledirections);
					//$code .= "mgr_".$id.".addMarker(marker_".$mp->getId().",0);";
					$code .= "map_".$id.".addOverlay(marker_".$mp->getId().");";
				} else if ($markerid == $mp->getId()){
					if (strlen($mp->getHeight()==0) || strlen($mp->getWidth()==0)) {
						return '<b>Error with height/width of icon associated with on marker ' . $mp->getName() . '</b>';
					}
					$code.= $this->writeIconCode($mp);
					$code .= $this->writeCreateMarkerCode($id, $mp);
					$code .= $this->writeCreateMarkerInfo($id, $mp, $enabledirections);
					$code .= "map_".$id.".addOverlay(marker_".$mp->getId().");";
					//$code .= "mgr_".$id.".addMarker(marker_".$mp->getId().",0);";
				}
		}      					
      			  
		//$code .= '		//mgr_'.$id.'.refresh(); ';
		if ($autoopenmarker!=0) {
			$code .= '      openInfoWindow('.trim($autoopenmarker).');';
		}
		$code .= '}';
		//$code .= 'function openInfoWindow(id) {	Markers[id].openInfoWindowHtml(MarkersInfo[id]); }';		

		//open info window functionw was here
				
    	$code .= 'window.setTimeout(setupMap,1200);';	
 		
    	$code .= '//]]></script>';
		return $code;
	}	
	
	function writeMapCenter($map, $zoom, $centerlatitude, $centerlongitude) {
		$code ='';
		if ($centerlatitude!= null && $centerlongitude != null) {
			if (strlen($centerlatitude)==0 || strlen($centerlongitude)==0) {
				$code .= '		map_'.$map->getId().'.setCenter(new GLatLng(38.898765, -90.035856), '.$zoom.');';
				return $code;
			} else {
				$code .= '		map_'.$map->getId().'.setCenter(new GLatLng('.$centerlatitude.', '.$centerlongitude.'), '.$zoom.');';
				return $code;
			}
		}
		if (sizeof($map->getMarkers()) > 0) {
			$mp = $map->getMarker(0);
			$code.="map_".$map->getId().".setCenter(new GLatLng(".$mp->getLatitude().", ".$mp->getLongitude()."), ".$zoom.");";
		} else {
			$code .= '		map_'.$map->getId().'.setCenter(new GLatLng(38.898765, -90.035856), '.$zoom.');';
		}
		return $code;
	}

	/**
	 * This function will set the zoom type of the map based on the parameters retrieved from the
	 * map 
	 */
	function setMapZoomtype($id, $zoomtype) {
		$code = '';
		switch ($zoomtype) {
			case 'None':
				break;
			case 'Large':
				$code.="map_".$id.".addControl(new GLargeMapControl());";
				break;
			default:
				$code.="map_".$id.".addControl(new GSmallMapControl());";
				break;
		}
		return $code;
	}    
	
	
	/**
	 * 	This function will out the code necessary to set the maptype
	 */
	function setMaptype($id, $maptype) {
		$code = '';
		switch ($maptype) {
			case 'Satellite':
				$code.="map_".$id.".addMapType(G_SATELLITE_MAP);";
				$code.="map_".$id.".setMapType(G_SATELLITE_MAP);";
				break;
			case 'Hybrid':
				$code.="map_".$id.".addMapType(G_HYBRID_MAP);";			
				$code.="map_".$id.".setMapType(G_HYBRID_MAP);";
				break;
			default:
				$code.="map_".$id.".addMapType(G_NORMAL_MAP);";			
				$code.="map_".$id.".setMapType(G_NORMAL_MAP);";
				break;
		}
		return $code;		
	}
	
	
    /** 
     * This function outputs the Javascript code necessary create the icon 
     * 						//icon.iconSize = new GSize(12, 20);
	 *					//icon.shadowSize = new GSize(22, 20);
     */
    function writeIconCode($icon) {
    	$code = '';
    	global $mosConfig_live_site;
    	//$code.="var icon = new GIcon(null,\"" . $mosConfig_live_site . '/components/com_gmaps/icons/' . $icon."\");
				$code.="var icon = new GIcon();
						icon.image = \"" . $mosConfig_live_site . '/components/com_gmaps/icons/' . $icon->getIcon()."\";
						icon.shadow = \"" . $mosConfig_live_site . '/components/com_gmaps/icons/' . $icon->getIcon()."\";							
						icon.iconSize = new GSize(".$icon->getWidth().",".$icon->getHeight().");
						icon.shadowSize = new GSize(".$icon->getWidth().",".$icon->getHeight().");
						icon.iconAnchor = new GPoint(6, 20);
						icon.infoWindowAnchor = new GPoint(5, 1);";
				return $code;    	
    }	
    
    /**
     * This function outputs the code necessary to create the marker to render on the google map and adds
     * the Markers array that is used in rendering the index.
     */
    function writeCreateMarkerCode($mapid,$mp) {
    		$code = '';
		    	$code.="var point".$mp->getId()." = new GPoint( ".$mp->getLongitude().",".$mp->getLatitude().");
				var marker_".$mp->getId()." = new GMarker(point".$mp->getId().", {title:'".$mp->getName()."', icon: icon});" ;
		//		$code .= " map_".$mapid.".addOverlay(marker_".$mp->getId().");
				$code .= "
				Markers[" . $mp->getId() . "] = marker_" . $mp->getId() . ";
				";					
				return $code;
    }
    //var marker_".$mp->getId()." = new GMarker(point".$mp->getId().", {title:'".$mp->getName()."', icon: icon});" ;
    
    /**
     *  This function outputs the code to add the event listener to the appropriate marker and then 
     *	add the information to the MarkersInfo array that is used in generating the index table
     */
    function writeCreateMarkerInfo($mapid, $mp, $tab1content, $tab1header, $tab2content, $tab2header, $directions='N') {
    	$code = '';
    	if ($directions != "Y") {
    		if(trim($mp->getName())!='')
				{
					//$desc = htmlspecialchars_decode($mp->getDescription(), ENT_NOQUOTES);
					$desc = htmlspecialchars_decode($mp->getDescription());
					$code .= "MarkersInfo[" . $mp->getId() . "] = \"<div class='markerName'>".$mp->getName()."</div><div class='markerDescription'>".$desc."</div>\";";					
					$markerinfo = '<div class=\'markerName\'>'.$mp->getName() . '</div><div class=\'markerDescription\'>' . $desc . '</div>';
									
					$code.="GEvent.addListener(marker_".$mp->getId().", 'click', function() {
							marker_".$mp->getId().".openInfoWindowHtml(\"".$markerinfo."\");
							});
					";
			}
			return $code;
    	} else {

    		$desc = htmlspecialchars_decode($mp->getDescription());
			$markerinfo = '<div class=\'markerName\'>'.$mp->getName() . '</div><div class=\'markerDescription\'>' . $desc . '</div>';
			switch ($tab1content) {
				case 'DTL':
					$tab1code = $this->getMarkerDetailsTab($tab1header,$markerinfo);
					break;
				case 'DIR':
					$tab1code = $this->getMarkerDirectionsTab($tab1header, $mp);
					break;
				case 'IMG1':
					$tab1code = $this->getImageAndDetailTab($tab1header, $mp, $markerinfo);
					break;						
				case 'IMG2':
					$tab1code = $this->getImageOnlyTab($tab1header, $mp);
					break;						
				default:
					$tab1code = $this->getMarkerDetailsTab($tab1header,$markerinfo);
					break;
			}
			switch ($tab2content) {
				case 'DTL':
					$tab2code = $this->getMarkerDetailsTab($tab2header,$markerinfo);
					break;
				case 'DIR':
					$tab2code = $this->getMarkerDirectionsTab($tab2header, $mp);
					break;
				case 'IMG1':
					$tab2code = $this->getImageAndDetailTab($tab2header, $mp, $markerinfo);
					break;						
				case 'IMG2':
					$tab2code = $this->getImageOnlyTab($tab2header, $mp);
					break;					
				default:
					$tab2code = $this->getMarkerDirectionsTab($tab2header, $mp);
					break;
			}					
    		$code .= "var infoTabs_".$mp->getId()."= [ "
    			.	$tab1code.  ", " . $tab2code 
				.	"];";
			$infotab='infoTabs_'.$mp->getId();
			$code .= "MarkersInfo[" . $mp->getId() . "] = infoTabs_".$mp->getId().";";
			$code.="GEvent.addListener(marker_".$mp->getId().", 'click', function() {
						marker_".$mp->getId().".openInfoWindowTabsHtml(".$infotab.");
						});
				";	
			return $code;			
				
    	}
	}

				
	function getMarkerDetailsTab($header,$content) {
		return $code = "new GInfoWindowTab(\"".$header."\",\"" . $content ."\")";
	}   	
	
	function getMarkerDirectionsTab($header, $mp) {
		$code = "new GInfoWindowTab(\"".$header."\",\""
				.	"<div class='gmapsdirections'>"
				.	"<form action='http://maps.google.com/maps' method='get' target='_blank'>"
				.	"<div class='directionstitle'>Get directions to ".$mp->getName()."</div>"
				.	"<label for='saddr'>Starting Address:</label>"
				.	"<input name='saddr' id='saddr' size='30' type='text'/>"
				.	"<input value='Go' type='submit' />"
				.	"<input name='daddr' value='".$mp->getLatitude().",".$mp->getLongitude()."' type='hidden'/>"
				.	"<input name='hl' value='en' type='hidden'/>"
				.	"<address>Example: 1600 Pennsylvania Avenue NW, Washington, DC 20500</address>"
				.	"</form>"
				.	"</div>"
				. "\")"	;
		return $code;	
	}
	
	function getImageAndDetailTab($header, $mp, $markerinfo) {
		// NOT SURE I LIKE THIS HERE -- BINDS THIS CLASS TO JOOMLA
		$props = new mosParameters( $mp->getProperties());
		//$properties = $props->toArray();
		$properties = GoogleAPI::parmToArray($props);		
		$imageurl = $properties["imageurl"];
		list($imagewidth, $imageheight, $type, $attr) = getimagesize($imageurl);				
		if (strlen($imageurl) == 0) {
			return $this->getMarkerDetailsTab($header,$markerinfo);
		}
		$code = "new GInfoWindowTab(\"".$header."\",\""
				.	"<div class='gmapstab-image'><table><tr>"
				.	"<td><img src='". $imageurl."' width='".$imagewidth."' height='".$imageheight."'></td>"
				.   "<td>". $markerinfo . "</td>"
				.	"</tr></div>"				
				. "\")"	;
		return $code;	
	}
		
	function getImageOnlyTab($header, $mp) {
		// NOT SURE I LIKE THIS HERE -- BINDS THIS CLASS TO JOOMLA
		$props = new mosParameters( $mp->getProperties());
		//$properties = $props->toArray();
		$properties = GoogleAPI::parmToArray($props);
		$imageurl = $properties["imageurl"];
		list($width, $height, $type, $attr) = getimagesize($imageurl);
		$code = "new GInfoWindowTab(\"".$header."\",\""
				.	"<div class='gmapstab-image'>"
				.	"<img src='". $imageurl."' width='".$width."' height='".$height."'>"
				.	"</div>"
				. "\")"	;
		return $code;	
	}	
	    

	function getMarkerIndex($map, $indexformat, $divider = ' | ') {
		$code.="<div id='markerList'>";
		for ($y=0; $y<(sizeof($map->getMarkers())); $y++) {
			$mp = $map->getMarker($y);
			$listEntry="<a href=\"javascript:openInfoWindow(" .$mp->getId().");\">" .$mp->name."</a>";
			// Indexformat 0 = vertical, 1 = horizontal
			if ($indexformat == 0) {
				$listEntry = '<li>' . $listEntry . '</li>';
			} else {
				$listEntry .= $divider;
			}				
			$markerList .= $listEntry;
		}				
		if ($indexformat == 0) {			
			$code.="<ul>" . $markerList. "</ul>";
		} else
			$code .= $markerList;
		$code .= "</div>";		
		return $code;
	}    
	
	
/**
 * This is a helper function to support cross compatability between 1.0.x and 1.5
*/
function parmToArray($p_obj) {
	//For J15 compatibility 
	if (defined( '_JEXEC' )) {
		//$obj = ($props->_registry['_default']['data']);
		$ns = & $p_obj->_registry['_default']['data'];
		$array = array();
		foreach (get_object_vars( $ns ) as $k => $v) {
			$array[$k] = trim($v);
		}
		return $array;
	} else {
		return $p_obj->toArray();
	}
		


}
	


}
?>


