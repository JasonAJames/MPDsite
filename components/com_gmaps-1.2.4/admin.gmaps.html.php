<?php
/**
* @version 
* @package 		GMaps
* @subpackage 	Administration
* @copyright 	(C) 2006-2007 Chris Strieter
* @license 		http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

/**
 * CHANGE HISTORY:
 * 02/28/2007	Modified to allow for a SHOWMAPTYPE option.  
 * 03/04/2007	Added support for enabling directions on each of the maps
 * 				markers				
 */
 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
// Joomla 1.5 defined( '_JEXEC' ) or die( 'Restricted access' );

 require_once ('classes/gmapdao.class.php');
 require_once ('classes/icondao.class.php');
 require_once ('classes/htmlhelper.class.php');
require_once ('classes/config.class.php'); 
 
/**
 * 
 */
class GMapAdminScreens {

	function editConfig() {
		global $option, $mosConfig_absolute_path, $mainframe;
		//require_once( $mosConfig_absolute_path . '/includes/patTemplate/patTemplate.php' );
if (!class_exists('patTemplate') ) {
	require_once( _GMAPS_PATTEMPLATE_DIR . 'patTemplate.php' );
} 		
		$tmpl = new patTemplate;	
		$tmpl->setNamespace( 'mos' );
		$tmpl->setRoot( dirname( __FILE__ ). '/templates' );
		$tmpl->readTemplatesFromFile( 'admeditconfig.html' );		
		
		$config = new GmapConfig();
		$tmpl->addVar('form', 'KEY', $config->getGoogleKey());
		$tmpl->addVar('form','MAPTYPELIST',HtmlHelper::getMaptypeList('maptype',$config->getMaptype()));
		$tmpl->addVar('form','ZOOMTYPELIST',HtmlHelper::getZoomtypeList('zoomtype',$config->getZoomtype()));		
		$tmpl->addVar('form','ZOOMLIST',HtmlHelper::getZoomList('zoom',$config->getZoom()));
		$tmpl->addVar('form','DEFAULTICONLIST',HtmlHelper::getIconSelectList('defaulticon',$config->getDefaultIcon()));
				
		$tmpl->addVar('form','HEIGHT',$config->getHeight());
		$tmpl->addVar('form','WIDTH',$config->getWidth());	
		$tmpl->addVar( 'form', 'OPTION', $option );		
		$tmpl->addVar( 'form', 'TASK', 'saveConfig' );		
		$tmpl->addVar( 'form', 'INPUT_HEADER', 'Edit Configuration' );
		$tmpl->addVar( 'form', 'formName', 'adminForm' );
			
		$tmpl->displayParsedTemplate('form');
    }
    
    /**
     * listMaps will render a list of the currently defined maps on the administration section
     */
	function listMaps() {
		global $option, $mosConfig_absolute_path, $mainframe;
		//require_once( $mosConfig_absolute_path . '/includes/patTemplate/patTemplate.php' );
		if (!class_exists('patTemplate') ) {
	require_once( _GMAPS_PATTEMPLATE_DIR . 'patTemplate.php' );
} 
		require_once( 'includes/pageNavigation.php' );		
		$tmpl = new patTemplate;	
		$tmpl->setNamespace( 'mos' );
		$tmpl->setRoot( dirname( __FILE__ ) . '/templates' );
		$tmpl->readTemplatesFromFile( 'admlistmaps.html' );	
		
		$dao = new GMapDAO();
		$total = $dao->getMapCount();
	
	   	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit',10 );
	   	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart",'limitstart', 0 );
	   	$levellimit = $mainframe->getUserStateFromRequest( "view{$option}limit",'levellimit', 10 );
	
		$pageNav = new mosPageNav( $total, $limitstart, $limit  );
		$list = $dao->getRecords($pageNav->limitstart, $pageNav->limit);
		$tmpl->addVar('admintemplate','ROWCOUNT',sizeof($list)+1);
		$tmpl->addVar( 'admintemplate', 'PAGELINKS', $pageNav->getListFooter());			
		if (sizeof($list)> 0) {		
			for ($y=0; $y<(sizeof($list)); $y++) {
				$data[$y] = array(
						'CID'=> $y,
						'ID'=> $list[$y]->id,			
						'NAME'=> $list[$y]->title,
						'DESCRIPTION'=> $list[$y]->description						
				);
			}
			$tmpl->addRows('data-list', $data, 'DATA_');
		} 
		$tmpl->addVar( 'form', 'formName', 'adminForm' );
		$tmpl->addVar( 'admintemplate', 'OPTION', 'com_gmaps' );		
		$tmpl->addVar( 'admintemplate', 'TASK', 'listMaps' );				
		$tmpl->displayParsedTemplate('form');
    }	


    /**
     * editMap - this function will retrieve a Map object and render the screen for the admin
     * to update the data.
     */
	function editMap($id) {
		global $option, $mosConfig_absolute_path, $mosConfig_live_site, $mainframe;
		//require_once( $mosConfig_absolute_path . '/includes/patTemplate/patTemplate.php' );
		//$mainframe->addCustomHeadTag("<link id=\"luna-tab-style-sheet\" type=\"text/css\" rel=\"stylesheet\" href=\"http://mercury/city/includes/js/tabs/tabpane.css\" />");
		//$mainframe->addCustomHeadTag("<script type=\"text/javascript\" src=\"http://mercury/city/includes/js/tabs/tabpane_mini.js\"></script>");"
		//$mainframe->addCustomHeadTag( "<link id=\"luna-tab-style-sheet\" type=\"text/css\" rel=\"stylesheet\" src=\"" . $mosConfig_live_site . "/includes/js/tabs/tabpane.css\">");		
		//$mainframe->addCustomHeadTag( "<script type=\"text/javascript\" src=\"" . $mosConfig_live_site . "/includes/js/tabs/tabpane_mini.js\"></script>");
if (!class_exists('patTemplate') ) {
	require_once( _GMAPS_PATTEMPLATE_DIR . 'patTemplate.php' );
} 		
		$autoopenmarker = "";
		$tmpl = new patTemplate;	
		$tmpl->setNamespace( 'mos' );
		$tmpl->setRoot( dirname( __FILE__ ). '/templates' );
		$tmpl->readTemplatesFromFile( 'admeditmap.html' );		
		$dao = new GMapDAO();		
		if ($id != 0) {
			$obj = $dao->getMap($id);
			$tmpl->addVar( 'form', 'DATA_ID', $obj->id);
			$tmpl->addVar( 'form', 'JOOMLAROOT',$mosConfig_live_site);		
			$tmpl->addVar( 'form', 'DATA_TITLE', $obj->title );		
			$tmpl->addVar( 'form', 'DATA_DESCRIPTION', $obj->getDescription() );			
			$tmpl->addVar( 'form', 'DATA_OVERLAY1', HtmlHelper::getMapSelectList('overlay1',$obj->getOverlay1()));			
			$tmpl->addVar( 'form', 'DATA_OVERLAY2', HtmlHelper::getMapSelectList('overlay2',$obj->getOverlay2()) );
			$tmpl->addVar( 'form', 'DATA_OVERLAY3', HtmlHelper::getMapSelectList('overlay3',$obj->getOverlay3()) );
			$tmpl->addVar( 'form', 'DATA_OVERLAY4', HtmlHelper::getMapSelectList('overlay4',$obj->getOverlay4()) );
			$tmpl->addVar( 'form', 'DATA_OVERLAY5', HtmlHelper::getMapSelectList('overlay5',$obj->getOverlay5()) );
			$params = new mosParameters($obj->getProperties());
			$tmpl->addVar( 'form', 'DATA_HEIGHT',$params->get('height'));												
			$tmpl->addVar( 'form', 'DATA_WIDTH',$params->get('width'));		
			$tmpl->addVar( 'form', 'ENABLEDIRECTIONS', HTMLHelper::getYesNoSelectList('enabledirections', $params->get('enabledirections')));

			if (strlen($params->get('tab1content')) != 0)
				$tmpl->addVar( 'form', 'TAB1CONTENT', HTMLHelper::getMarkerTabSelectList('tab1content', $params->get('tab1content')));
			else							
				$tmpl->addVar( 'form', 'TAB1CONTENT', HTMLHelper::getMarkerTabSelectList('tab1content','DTL'));
			if (strlen($params->get('tab1header'))!=0)
				$tmpl->addVar( 'form', 'TAB1HEADER', $params->get('tab1header'));			
			else
				$tmpl->addVar( 'form', 'TAB1HEADER', 'Details');				
			if (strlen($params->get('tab2content')) !=0)
				$tmpl->addVar( 'form', 'TAB2CONTENT', HTMLHelper::getMarkerTabSelectList('tab2content', $params->get('tab2content')));
			else							
				$tmpl->addVar( 'form', 'TAB2CONTENT', HTMLHelper::getMarkerTabSelectList('tab2content','DIR'));
			
			if (strlen($params->get('tab2header'))!=0)
				$tmpl->addVar( 'form', 'TAB2HEADER', $params->get('tab2header'));			
			else
				$tmpl->addVar( 'form', 'TAB2HEADER', 'Directions');
								
			$tmpl->addVar( 'form', 'MAPTYPE', HTMLHelper::getMaptypeList('maptype', $params->get('maptype')));
			$tmpl->addVar( 'form', 'SHOWMAPTYPE', HTMLHelper::getYesNoSelectList('showmaptype', $params->get('showmaptype')));			
			$tmpl->addVar( 'form', 'ZOOMLEVEL', HTMLHelper::getZoomlist('zoom', $params->get('zoom')));			
			$tmpl->addVar( 'form', 'ZOOMTYPE', HTMLHelper::getZoomtypelist('zoomtype', $params->get('zoomtype')));
			$tmpl->addVar( 'form', 'SHOWINDEX', HTMLHelper::getYesNoSelectList('showindex', $params->get('showindex')));	
			$tmpl->addVar( 'form', 'INDEXFORMAT', HTMLHelper::getIndexFormatList('indexformat', $params->get('indexformat')));			
			$tmpl->addVar( 'form', 'INDEXTITLE', $params->get('indextitle'));
			$tmpl->addVar( 'form', 'CENTERLATITUDE', $params->get('centerlatitude'));							
			$tmpl->addVar( 'form', 'CENTERLONGITUDE', $params->get('centerlongitude'));			
			$tmpl->addVar( 'form', 'FUNCTION', 'Edit' );			
			$tmpl->addVar('ADD-MARKER-SECTION','EDITING_MAP','Y');
			$tmpl->addVar('ADD-MARKER-SECTION','DATA_ID',$obj->id);		
		   	$dlist = $obj->getMarkers();
		   	//TODO:  May want to remove HTML code into the HTML helper class later.  Doesn't seem clean
		   	$assignedMarkerList[0] = mosHTML::makeOption('0','- None -');
			if (sizeof($dlist)> 0) {		
				for ($y=0; $y<(sizeof($dlist)); $y++) {
					if ($dlist[$y]->mapid == $id) {
						$action = '<a href="index2.php?option=com_gmaps&task=removeMarker&map_id=' . $id . '&marker_id=' . $dlist[$y]->id .'" >delete</a>';
					} else {
						$action = 'Not avail';
					}
					$data[$y] = array(
							'ID'=> $dlist[$y]->id,			
							'NAME'=> $dlist[$y]->name,
							'LATITUDE'=> $dlist[$y]->latitude,
							'LONGITUDE'=> $dlist[$y]->longitude,
							'ACTION'=> $action
					);
					$assignedMarkerList[$y+1] = mosHTML::makeOption($dlist[$y]->id,$dlist[$y]->name);
				}
				//<IMG SRC="'. $mosConfig_live_site . '/images/publish_x.png">
				$tmpl->addRows('marker-list', $data, 'MARK_');
				
				$autoopenmarker = mosHTML::selectList($assignedMarkerList,'autoopenmarker','class="inputbox"','value','text',$params->get('autoopenmarker'));							
		}			
		} else {
			$tmpl->addVar( 'form', 'DATA_ID', '0');
			$tmpl->addVar( 'form', 'JOOMLAROOT',$mosConfig_live_site);
			$tmpl->addVar( 'form', 'FUNCTION', 'Add' );
			$tmpl->addVar( 'form', 'DATA_OVERLAY1', HtmlHelper::getMapSelectList('overlay1',''));			
			$tmpl->addVar( 'form', 'DATA_OVERLAY2', HtmlHelper::getMapSelectList('overlay2','') );
			$tmpl->addVar( 'form', 'DATA_OVERLAY3', HtmlHelper::getMapSelectList('overlay3','') );
			$tmpl->addVar( 'form', 'DATA_OVERLAY4', HtmlHelper::getMapSelectList('overlay4','') );
			$tmpl->addVar( 'form', 'DATA_OVERLAY5', HtmlHelper::getMapSelectList('overlay5','') );
			$config = new GmapConfig();				
			$tmpl->addVar( 'form', 'MAPTYPE', HTMLHelper::getMaptypeList('maptype', $config->getMaptype()));
			$tmpl->addVar( 'form', 'ZOOMLEVEL', HTMLHelper::getZoomlist('zoom', $config->getZoom()));			
			$tmpl->addVar( 'form', 'ZOOMTYPE', HTMLHelper::getZoomtypelist('zoomtype', $config->getZoomtype()));
			$tmpl->addVar( 'form', 'SHOWINDEX', HTMLHelper::getYesNoSelectList('showindex','N'));	
			$tmpl->addVar( 'form', 'INDEXFORMAT', HTMLHelper::getIndexFormatList('indexformat', '0'));
			$tmpl->addVar( 'form', 'INDEXTITLE', 'Index');
			$tmpl->addVar( 'form', 'ENABLEDIRECTIONS', HTMLHelper::getYesNoSelectList('enabledirections', 'N'));
			$tmpl->addVar( 'form', 'TAB1CONTENT', HTMLHelper::getMarkerTabSelectList('tab1content','DTL'));
			$tmpl->addVar( 'form', 'TAB1HEADER', 'Details');				
			$tmpl->addVar( 'form', 'TAB2CONTENT', HTMLHelper::getMarkerTabSelectList('tab2content','DIR'));
			$tmpl->addVar( 'form', 'TAB2HEADER', 'Directions');
			$tmpl->addVar( 'form', 'SHOWMAPTYPE', HTMLHelper::getYesNoSelectList('showmaptype', 'Y'));			
			$tmpl->addVar( 'form', 'CENTERLATITUDE', '');							
			$tmpl->addVar( 'form', 'CENTERLONGITUDE', '');
			$tmpl->addVar('ADD-MARKER-SECTION','EDITING_MAP','N');			
		}
		$markers = $dao->getAllMarkersForSelectList();
		$markerlist = mosHTML::selectList( $markers, 'marker_id', 'class="inputbox" ','value', 'text', 0);
		$tmpl->addVar('form','AUTOOPENMARKER',$autoopenmarker);
	   	$tmpl->addVar('ADD-MARKER-SECTION','MARKER_LIST',$markerlist);
		$tmpl->addVar( 'ADD-MARKER-SECTION', 'OPTION', $option );			   			
		$tmpl->addVar( 'form', 'OPTION', $option );		
		$tmpl->addVar( 'form', 'TASK', 'listMaps' );
		$tmpl->addVar( 'form', 'formName', 'adminForm' );
			
		$tmpl->displayParsedTemplate('form');
    }
    
    	    
   /**
     * A simple message
     */
	function listMarkers() {
		global $option, $mosConfig_absolute_path, $mainframe;
		//require_once( $mosConfig_absolute_path . '/includes/patTemplate/patTemplate.php' );
if (!class_exists('patTemplate') ) {
	require_once( _GMAPS_PATTEMPLATE_DIR . 'patTemplate.php' );
} 		
		require_once( 'includes/pageNavigation.php' );		
		$tmpl = new patTemplate;	
		$tmpl->setNamespace( 'mos' );
		$tmpl->setRoot( dirname( __FILE__ ). '/templates' );
		$tmpl->readTemplatesFromFile( 'admlistmarkers.html' );	
		
		$dao = new GMapDAO();
		$total = $dao->getMarkerCount();
	
	   	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit',10 );
	   	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart",'limitstart', 0 );
	   	$levellimit = $mainframe->getUserStateFromRequest( "view{$option}limit",'levellimit', 10 );
	
		$pageNav = new mosPageNav( $total, $limitstart, $limit  );
		$list = $dao->getMarkerRecords($pageNav->limitstart, $pageNav->limit);
		
		//need to increment by one since the array starts at 0
		$tmpl->addVar('admintemplate','ROWCOUNT',sizeof($list)+1);
		$tmpl->addVar( 'admintemplate', 'PAGELINKS', $pageNav->getListFooter());	
		
		if (sizeof($list)> 0) {		
			for ($y=0; $y<(sizeof($list)); $y++) {
				$data[$y] = array(
						'CID'=> $y,
						'ID'=> $list[$y]->id,			
						'NAME'=> $list[$y]->name,
						'LATITUDE'=> $list[$y]->latitude,						
						'LONGITUDE'=> $list[$y]->longitude,
						'ICON'=> $list[$y]->icon,						
						'DESCRIPTION'=> $list[$y]->description						
				);
			}
			$tmpl->addRows('data-list', $data, 'DATA_');
		} 
		$tmpl->addVar( 'form', 'formName', 'adminForm' );
		$tmpl->addVar( 'admintemplate', 'OPTION', 'com_gmaps' );		
		$tmpl->addVar( 'admintemplate', 'TASK', 'listMarkers' );				
		$tmpl->displayParsedTemplate('form');
			
    }	
    	
    	    
    	    
   /**
     * editMarker - this function will retrieve a Marker object and render the screen for the admin
     * to update the data.
     */
	function editMarker($id) {
		global $option, $mosConfig_absolute_path, $mosConfig_live_site, $mainframe;
		//require_once( $mosConfig_absolute_path . '/includes/patTemplate/patTemplate.php' );
if (!class_exists('patTemplate') ) {
	require_once( _GMAPS_PATTEMPLATE_DIR . 'patTemplate.php' );
} 		
		$tmpl = new patTemplate;	
		$tmpl->setNamespace( 'mos' );
		$tmpl->setRoot( dirname( __FILE__ ) . '/templates' );
		$tmpl->readTemplatesFromFile( 'admeditmarker.html' );		
		
		if ($id != 0) {
			$dao = new GMapDAO();
			$obj = $dao->getMarker($id);
			$tmpl->addVar( 'form', 'DATA_ID', $obj->getId());		
			$tmpl->addVar( 'form', 'DATA_NAME', $obj->getName() );		
			$tmpl->addVar( 'form', 'DATA_LATITUDE', $obj->getLatitude() );			
			$tmpl->addVar( 'form', 'DATA_LONGITUDE', $obj->getLongitude() );
			$tmpl->addVar( 'form', 'DATA_DESCRIPTION', $obj->getDescription() );
			$tmpl->addVar( 'form', 'ICON_SELECTLIST', HtmlHelper::getIconSelectList('icon',$obj->getIcon()) );
			$params = new mosParameters($obj->getProperties());			
			$tmpl->addVar( 'form', 'DATA_IMAGEURL',$params->get('imageurl'));						
			$tmpl->addVar( 'form', 'FUNCTION', 'Edit' );			
		} else {
			$tmpl->addVar( 'form', 'ICON_SELECTLIST', HtmlHelper::getIconSelectList('icon','') );
			$tmpl->addVar( 'form', 'DATA_ID', '0');			
			$tmpl->addVar( 'form', 'FUNCTION', 'Add' );
		}
	   			
		$tmpl->addVar( 'form', 'OPTION', $option );		
		$tmpl->addVar( 'form', 'TASK', 'listMarkers' );
		$tmpl->addVar( 'form', 'formName', 'adminForm' );
			
		$tmpl->displayParsedTemplate('form');
    }
    
   /**
     * List icons currently definede
     */
	function listIcons() {
		global $option, $mosConfig_absolute_path, $mainframe;
		//require_once( $mosConfig_absolute_path . '/includes/patTemplate/patTemplate.php' );
if (!class_exists('patTemplate') ) {
	require_once( _GMAPS_PATTEMPLATE_DIR . 'patTemplate.php' );
} 		
		require_once( 'includes/pageNavigation.php' );		
		$tmpl = new patTemplate;	
		$tmpl->setNamespace( 'mos' );
		$tmpl->setRoot( dirname( __FILE__ ) . '/templates' );
		$tmpl->readTemplatesFromFile( 'admlisticons.html' );	
		
		$dao = new IconDAO();
		$total = $dao->getRowCount();
	
	   	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit',10 );
	   	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart",'limitstart', 0 );
	   	$levellimit = $mainframe->getUserStateFromRequest( "view{$option}limit",'levellimit', 10 );
	
		$pageNav = new mosPageNav( $total, $limitstart, $limit  );
		$list = $dao->getRecords($pageNav->limitstart, $pageNav->limit);
		
		//need to increment by one since the array starts at 0
		$tmpl->addVar('admintemplate','ROWCOUNT',sizeof($list)+1);
		$tmpl->addVar( 'admintemplate', 'PAGELINKS', $pageNav->getListFooter());	
		
		if (sizeof($list)> 0) {		
			for ($y=0; $y<(sizeof($list)); $y++) {
				$data[$y] = array(
						'CID'=> $y,
						'ID'=> $list[$y]->id,			
						'ICON'=> $list[$y]->icon,
						'WIDTH'=> $list[$y]->width,						
						'HEIGHT'=> $list[$y]->height					
				);
			}
			$tmpl->addRows('data-list', $data, 'DATA_');
		} 
		$tmpl->addVar( 'form', 'formName', 'adminForm' );
		$tmpl->addVar( 'admintemplate', 'OPTION', 'com_gmaps' );		
		$tmpl->addVar( 'admintemplate', 'TASK', 'listIcons' );				
		$tmpl->displayParsedTemplate('form');
			
    }	

	function editIcon($id) {
		global $option, $mosConfig_absolute_path, $mosConfig_live_site, $mainframe;
		//require_once( $mosConfig_absolute_path . '/includes/patTemplate/patTemplate.php' );
if (!class_exists('patTemplate') ) {
	require_once( _GMAPS_PATTEMPLATE_DIR . 'patTemplate.php' );
} 		
		$tmpl = new patTemplate;	
		$tmpl->setNamespace( 'mos' );
		$tmpl->setRoot(dirname( __FILE__ ). '/templates' );
		$tmpl->readTemplatesFromFile( 'admediticon.html' );		
		
		if ($id != 0) {
			$dao = new IconDAO();
			$obj = $dao->getIconById($id);
			$tmpl->addVar( 'form', 'DATA_ID', $obj->getId());		
			$tmpl->addVar( 'form', 'DATA_HEIGHT', $obj->getHeight() );			
			$tmpl->addVar( 'form', 'DATA_WIDTH', $obj->getWidth() );
			$tmpl->addVar( 'form', 'ICON_SELECTLIST', HtmlHelper::getIconFilesSelectList($mosConfig_absolute_path.'/components/com_gmaps/icons/', 'icon',$obj->getIcon()) );			
			$tmpl->addVar( 'form', 'FUNCTION', 'Edit' );			
		} else {
			$tmpl->addVar( 'form', 'ICON_SELECTLIST', HtmlHelper::getIconFilesSelectList($mosConfig_absolute_path.'/components/com_gmaps/icons/', 'icon','') );			
			$tmpl->addVar( 'form', 'DATA_ID', '0');			
			$tmpl->addVar( 'form', 'FUNCTION', 'Add' );
		}
	   			
		$tmpl->addVar( 'form', 'OPTION', $option );		
		$tmpl->addVar( 'form', 'TASK', 'listIcons' );
		$tmpl->addVar( 'form', 'formName', 'adminForm' );
			
		$tmpl->displayParsedTemplate('form');
    }
    
        	
    
}
?>