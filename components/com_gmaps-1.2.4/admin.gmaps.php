<?php
/**
* @version 
* @package 		GMaps
* @subpackage 	Administration
* @copyright 	(C) 2006-2007 Chris Strieter
* @license 		http://www.gnu.org/copyleft/gpl.html GNU/GPL
* 
*/

/**
 * CHANGE HISTORY:
 * 02/28/2007	cjs	Added support to manage icons
 * 				cjs	Addes support for SHOWMAPTYPE in the saveMap method
 * 03/04/2007	cjs	Added support for enabling directions on all markers for 
 * 					a map (in tabbed format)
 * 03/12/2007	cjs	Added support for ordering tabs, defining the tab header
 * 					and a default marker to open upon rendering
 * 03/15/2007	cjs	Added support for an image within the info window
 * 11/07/2007	cjs Made changes to make J15 compatible
 * 
 */


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
// Joomla 1.5 defined( '_JEXEC' ) or die( 'Restricted access' );
// for Joomla 1.5
if (defined('_JEXEC')) {
	define( '_GMAPS_PATTEMPLATE_DIR', $mosConfig_absolute_path . '/libraries/patTemplate/');
} else {
	define( '_GMAPS_PATTEMPLATE_DIR', $mosConfig_absolute_path . '/includes/patTemplate/');
}

// include support libraries
require_once( $mainframe->getPath( 'admin_html' ) );
require_once( 'classes/gmapdao.class.php' );
require_once( 'classes/gmap.class.php' );
require_once( 'classes/marker.class.php' );
 
// handle the task
$task = mosGetParam( $_REQUEST, 'task', '' );
$cid = mosGetParam( $_REQUEST, 'cid', '' );	


switch ($task) {
	case 'listMaps': 
		GMapAdminScreens::listMaps();
		break;

	case 'listMarkers': 
		GMapAdminScreens::listMarkers();
		break;

	case 'newMap': 
		GMapAdminScreens::editMap(0);
		break;
		
	case 'editMap': 
		$cid = mosGetParam( $_REQUEST, 'cid', '' );	
		GMapAdminScreens::editMap($cid[0]);
		break;

	case 'cancelMap': 
		mosRedirect('index2.php?option=com_gmaps&task=listMaps');
		break;

	case 'applyMap':
		saveMap(true);
		break;	
		
	case 'saveMap':
		saveMap();
		break;		

	case 'deleteMap':
		deleteMap($cid[0]);
		break;	

	case 'newMarker':
		GMapAdminScreens::editMarker(0);	
		break;
		
	case 'editMarker':
		GMapAdminScreens::editMarker($cid[0] );	
		break;

	case 'saveConfig':
		saveConfig();
		break;
		
	case 'editConfig':
		GMapAdminScreens::editConfig();
		break;
		
	case 'removeMarker':
		$mapid = mosGetParam( $_REQUEST, 'map_id', '' );
		$markerid = mosGetParam( $_REQUEST, 'marker_id', '' );	
		$dao = new GMapDAO();
		$dao->deleteMarkerFromMap($mapid, $markerid);
		mosRedirect('index2.php?option=com_gmaps&task=editMap&cid[]=' . $mapid);		
		break;	
				
	case 'deleteMarker':
		deleteMarker($cid[0]);	
		break;
		
	case 'cancelMarker':
		mosRedirect('index2.php?option=com_gmaps&task=listMarkers');	
		break;
		
	case 'saveMarker':
		saveMarker();
		break;
		
	case 'addMarker':
		$mapid = mosGetParam( $_REQUEST, 'map_id', '' );
		$markerid = mosGetParam( $_REQUEST, 'marker_id', '' );
		$dao = new GMapDAO();
		$dao->addMarkerToMap($mapid, $markerid);
		mosRedirect('index2.php?option=com_gmaps&task=editMap&cid[]=' . $mapid);		
		break;		

	case 'editcss':
		editCSS();		
		break;

	case 'savecss':
		saveCSS();		
		break;

	case 'listIcons': 
		GMapAdminScreens::listIcons();
		break;
		
	case 'newIcon': 
		GMapAdminScreens::editIcon(0);
		break;
		
	case 'editIcon': 
		$cid = mosGetParam( $_REQUEST, 'cid', '' );	
		GMapAdminScreens::editIcon($cid[0]);
		break;

	case 'deleteIcon': 
		deleteIcon($cid[0]);
		break;
		
	case 'cancelIcon': 
		mosRedirect('index2.php?option=com_gmaps&task=listIcons');
		break;

	case 'saveIcon':
		saveIcon();
		break;	
		
	case 'viewReadme':
		viewReadme();		
		break;
				
	case 'cancelReadme':
		mosRedirect('index2.php?option=com_gmaps');	
		break;
								
    default:
        showCpanel();
        break;
}

function showCpanel() {
	global $option, $mosConfig_absolute_path;
	//require_once( $mosConfig_absolute_path . '/includes/patTemplate/patTemplate.php' );

	if (!class_exists('patTemplate') ) {
		require_once( _GMAPS_PATTEMPLATE_DIR . 'patTemplate.php' );
	} 		
	$tmpl = new patTemplate;	
	$tmpl->setNamespace( 'mos' );
	$tmpl->setRoot( dirname( __FILE__ ). '/templates' );
	//$tmpl->setAttribute( 'body', 'src', 'cpanel.html' );
	$tmpl->readTemplatesFromFile( 'cpanel.html' );
	if (defined('_JEXEC')) {
		JToolBarHelper::title( JText::_( 'GMaps - Control Panel' ), 'generic.png' );
	}
	$tmpl->displayParsedTemplate('cpanel');	
}


function saveMap($apply=false) {
	$id = mosGetParam( $_REQUEST, 'id', '' );
	$title = mosGetParam( $_REQUEST, 'title', '' );
	$dao = new GMapDAO();
	$obj = new GMap();
	$obj->setId($id);
	$obj->setTitle($title);
	$obj->setDescription(mosGetParam( $_REQUEST, 'description', '' ));
	$obj->setOverlay1(mosGetParam( $_REQUEST, 'overlay1', '' ));	
	$obj->setOverlay2(mosGetParam( $_REQUEST, 'overlay2', '' ));
	$obj->setOverlay3(mosGetParam( $_REQUEST, 'overlay3', '' ));
	$obj->setOverlay4(mosGetParam( $_REQUEST, 'overlay4', '' ));
	$obj->setOverlay5(mosGetParam( $_REQUEST, 'overlay5', '' ));
	$height = 'height = ' .mosGetParam( $_REQUEST, 'height');
	$width = 'width = ' .mosGetParam( $_REQUEST, 'width');
	$maptype = 'maptype = ' .mosGetParam( $_REQUEST, 'maptype');
	$showmaptype = 'showmaptype = ' .mosGetParam( $_REQUEST, 'showmaptype');	
	$zoom = 'zoom = ' .mosGetParam( $_REQUEST, 'zoom');
	$zoomtype = 'zoomtype = ' .mosGetParam( $_REQUEST, 'zoomtype');
	$showindex = 'showindex = ' .mosGetParam( $_REQUEST, 'showindex');
	$indexformat = 'indexformat = ' .mosGetParam( $_REQUEST, 'indexformat');
	$indextitle = 'indextitle = ' .mosGetParam( $_REQUEST, 'indextitle');
	$centerlatitude = 'centerlatitude = ' .mosGetParam( $_REQUEST, 'centerlatitude');				
	$centerlongitude = 'centerlongitude = ' .mosGetParam( $_REQUEST, 'centerlongitude');	
	$enabledirections = 'enabledirections = ' .mosGetParam( $_REQUEST, 'enabledirections');
	$tab1content = 'tab1content = ' .mosGetParam( $_REQUEST, 'tab1content');
	$tab2content = 'tab2content = ' .mosGetParam( $_REQUEST, 'tab2content');						
	$tab1header = 'tab1header = ' .mosGetParam( $_REQUEST, 'tab1header');
	$tab2header = 'tab2header = ' .mosGetParam( $_REQUEST, 'tab2header');
	$autoopenmarker = 'autoopenmarker = ' .mosGetParam( $_REQUEST, 'autoopenmarker');	
	$obj->setProperties($height .'\n' .$width .'\n'.$maptype.'\n'.$showmaptype.'\n'.$zoom.
			'\n'.$zoomtype.'\n'.$showindex.'\n'.$indexformat.'\n'.$indextitle.
			'\n'.$centerlatitude.'\n'.$centerlongitude.'\n'.$enabledirections.
			'\n'.$tab1content . '\n' . $tab1header .
			'\n'.$tab2content . '\n' . $tab2header .
			'\n' . $autoopenmarker);
					
	if ($id != 0) {
		if ($dao->updateMap($obj)) {
			if ($apply) {
				mosRedirect('index2.php?option=com_gmaps&task=editMap&amp;cid[]='.$id);
			} else
				mosRedirect('index2.php?option=com_gmaps&task=listMaps');			
		}	
	} else {
		if ($dao->insertMap($obj)) {
			$id = mysql_insert_id();
			if ($apply) {
				mosRedirect('index2.php?option=com_gmaps&task=editMap&amp;cid[]='.$id);
			} else
				mosRedirect('index2.php?option=com_gmaps&task=listMaps');
		}
	}
}

function deleteMap($id) {
	$dao = new GMapDAO();	
	$obj = $dao->getMap($id);
	if ($id != 0) {
		if ($dao->deleteMap($obj)) {
			mosRedirect('index2.php?option=com_gmaps&task=listMaps');
		}	
	} else {
		mosRedirect('index2.php?option=com_gmaps&task=listMaps','Invalid ID passed to delete function');
	}
}

function saveMarker() {
	$id = mosGetParam( $_REQUEST, 'id', '' );
	$name = mosGetParam( $_REQUEST, 'name', '' );
	$latitude = mosGetParam( $_REQUEST, 'latitude', '' );
	$longitude = mosGetParam( $_REQUEST, 'longitude', '' );
	$description = mosGetParam( $_REQUEST, 'description', '', _MOS_ALLOWHTML  );
	$icon = mosGetParam( $_REQUEST, 'icon', '' );
	$dao = new GMapDAO();	
	$obj = new Marker();
	$obj->setId($id);
	$obj->setName($name);
	$obj->setLatitude($latitude);
	$obj->setLongitude($longitude);
	$obj->setDescription($description);	
	$obj->setIcon($icon);
	$imageurl = 'imageurl = ' .mosGetParam( $_REQUEST, 'imageurl');
	$tmpdesc = str_replace('"',"'",$description);
	$obj->setDescription($tmpdesc);
	$obj->setProperties($imageurl);	
	if ($id != 0) {
		if ($dao->updateMarker($obj)) {
			mosRedirect('index2.php?option=com_gmaps&task=listMarkers');
		}	
	} else {
		if ($dao->insertMarker($obj)) {
			mosRedirect('index2.php?option=com_gmaps&task=listMarkers');
		}
	}
}

function saveConfig() {
	$key = mosGetParam( $_REQUEST, 'key');
	$maptype = mosGetParam( $_REQUEST, 'maptype');
	$zoomtype = mosGetParam( $_REQUEST, 'zoomtype');	
	$zoom = mosGetParam( $_REQUEST, 'zoom');	
	$height = mosGetParam( $_REQUEST, 'height');
	$width = mosGetParam( $_REQUEST, 'width');		
	$defaulticon = mosGetParam( $_REQUEST, 'defaulticon');	

	$dao = new GmapConfigDAO();
	$count = $dao->getRowCount();
				
	$config = new GmapConfig();	
 	$config->setGoogleKey($key);
 	$config->setMaptype($maptype);
	$config->setZoomtype($zoomtype); 	
 	$config->setZoom($zoom);
	$config->setHeight($height);
	$config->setWidth($width);
	$config->setDefaultIcon($defaulticon);	
	if ($count == 0)
		$rc = $dao->insert($config);	
	else		
		$rc = $dao->update($config);
	if ($rc == 0) 
		mosRedirect('index2.php?option=com_gmaps','Configuration updated');
	else
		mosRedirect('index2.php?option=com_gmaps','ERROR ' . $rc . ' WAS ENCOUNTERED');
				
	mosRedirect('index2.php?option=com_gmaps');

}

		
function deleteMarker($id) {
	$dao = new GMapDAO();	
	$obj = $dao->getMarker($id);
	if ($id != 0) {
		if ($dao->deleteMarker($obj)) {
			mosRedirect('index2.php?option=com_gmaps&task=listMarkers');
		}	
	} else {
		if ($dao->deleteMarker($obj)) {
			mosRedirect('index2.php?option=com_gmaps&task=listMarkers');
		}
	}
}


function editCSS() {
		global $mosConfig_absolute_path, $option ;
		//require_once( $mosConfig_absolute_path . '/includes/patTemplate/patTemplate.php' );
if (!class_exists('patTemplate') ) {
	require_once( _GMAPS_PATTEMPLATE_DIR . 'patTemplate.php' );
} 				
		$tmpl = new patTemplate;	
		$tmpl->setNamespace( 'mos' );
		$tmpl->setRoot( dirname( __FILE__ ). '/templates' );
		$tmpl->readTemplatesFromFile( 'editcss.html' );	
		$css = readCSS();
		$tmpl->addVar( 'form', 'CSSCONTENT', $css );		
		$tmpl->addVar( 'form', 'OPTION', $option );		
		$tmpl->addVar( 'form', 'TASK', 'editCSS' );
		$tmpl->addVar( 'form', 'formName', 'adminForm' );
	if (defined('_JEXEC')) {
		JToolBarHelper::title( JText::_( 'Edit CSS' ), 'generic.png' );
	}		
		$tmpl->displayParsedTemplate('form');		
} 


function readCSS() {
				
		global $mosConfig_absolute_path;
		$cssfile = $mosConfig_absolute_path."/components/com_gmaps/css/gmaps.css";
		if ($fp = fopen( $cssfile, "r" )){
			$css = fread( $fp, filesize( $cssfile ) );
			$css = htmlspecialchars( $css );
		}
			else mosRedirect( "index2.php?option=com_gmaps", "Error opening ".$cssfile );
		return $css;		
}

   function saveCSS() {
		global $mosConfig_absolute_path, $option;
		//$option = "com_gmaps";
		$csscontent = mosGetParam( $_POST, 'csscontent', '', _MOS_ALLOWHTML );	
		$enable_write = mosGetParam($_POST,'enable_write',null);
		$disable_write = mosGetParam($_POST,'disable_write',null);

		$cssfile = $mosConfig_absolute_path."/components/com_gmaps/css/gmaps.css";
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

function viewReadme() {
		global $mosConfig_absolute_path, $option ;
		//require_once( $mosConfig_absolute_path . '/includes/patTemplate/patTemplate.php' );
if (!class_exists('patTemplate') ) {
	require_once( _GMAPS_PATTEMPLATE_DIR . 'patTemplate.php' );
} 				
		$tmpl = new patTemplate;	
		$tmpl->setNamespace( 'mos' );
		$tmpl->setRoot( dirname( __FILE__ ). '/templates' );
		$tmpl->readTemplatesFromFile( 'viewreadme.html' );	
		$readme = readReadme();
		$tmpl->addVar( 'form', 'FILECONTENT', $readme );		
		$tmpl->addVar( 'form', 'OPTION', $option );		
		$tmpl->addVar( 'form', 'TASK', 'viewReadme' );
		$tmpl->addVar( 'form', 'formName', 'adminForm' );
		$tmpl->displayParsedTemplate('form');		
}     

function readReadme() {
		global $mosConfig_absolute_path;
		$rfile = $mosConfig_absolute_path."/components/com_gmaps/readme.txt";
		if ($fp = fopen( $rfile, "r" )){
			$contents = fread( $fp, filesize( $rfile ) );
			$contents = htmlspecialchars( $contents );
		}
			else mosRedirect( "index2.php?option=com_gmaps", "Error opening ".$rfile );
		return $contents;
}	
    
    
function saveIcon() {
	$id = mosGetParam( $_REQUEST, 'id', '' );
	$icon = mosGetParam( $_REQUEST, 'icon', '' );
	$height = mosGetParam( $_REQUEST, 'height', '' );
	$width = mosGetParam( $_REQUEST, 'width', '' );
	$dao = new IconDAO();	
	$obj = new Icon();
	$obj->setId($id);
	$obj->setIcon($icon);
	$obj->setHeight($height);
	$obj->setWidth($width);
	if ($id != 0) {
		if ($dao->update($obj)) {
			mosRedirect('index2.php?option=com_gmaps&task=listIcons');
		}	
	} else {
		if ($dao->insert($obj)) {
			mosRedirect('index2.php?option=com_gmaps&task=listIcons');
		}
	}
}

function deleteIcon($id) {
	$dao = new IconDAO();	
	$obj = $dao->getIconById($id);
	if ($id != 0) {
		if ($dao->delete($obj)) {
			mosRedirect('index2.php?option=com_gmaps&task=listIcons');
		}	
	} else {
		mosRedirect('index2.php?option=com_gmaps&task=listIcons','Invalid ID passed to delete function');
	}
}    
?>
