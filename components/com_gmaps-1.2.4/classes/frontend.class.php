<?php
/**
* @version 
* @package 		GMaps
* @subpackage 	Classes
* @copyright 	(C) 2006-2007 Chris Strieter
* @license 		http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
// Joomla 1.5 defined( '_JEXEC' ) or die( 'Restricted access' );


require_once ('gmapdao.class.php');
require_once ('gmaphelper.class.php');
require_once ('htmlhelper.class.php');
require_once ('config.class.php');

class Frontend {

    function Frontend() {
    }
    
    function viewmap($id) {
		global $mainframe, $option, $Itemid, $mosConfig_live_site, $mosConfig_absolute_path;
		$dao = new GMapDAO();
		// 07/31/2007 added to prevent sql injection
		$id = intval( $id );
		$map = $dao->getMap($id);
		if ($map == null) {
			echo "No Map Found";
			return;
		}
		require_once( _GMAPS_PATTEMPLATE_DIR . 'patTemplate.php' );    				
		$tmpl = new patTemplate();	
		$tmpl->setRoot( $mosConfig_absolute_path.'/components/com_gmaps/templates' );		
		$tmpl->setNamespace( 'mos' );
		$tmpl->readTemplatesFromFile( 'viewmap.html' );

		$tmpl->addvar('viewmap', 'TITLE', $map->getTitle());
		$tmpl->addvar('viewmap','DESCRIPTION', $map->getDescription());

		$config = new GmapConfig();
		$helper = new GmapHelper();	
		$properties = $map->getProperties();
		$props = new mosParameters($properties);

		//Add additional component properties
		$props->set('defaulticon',$config->getDefaultIcon() );
		$props->set('key',$config->getGoogleKey());
		$props->set('id', $map->getId());
		// Set defaults if map props are not found
		if (strlen(trim($props->get('height'))) == 0) {
			$props->set('height',$config->getHeight());
		}
		if (strlen(trim($props->get('width'))) == 0) {
			$props->set('width',$config->getWidth());
		}
		if (strlen(trim($props->get('maptype'))) == 0) {
			$props->set('maptype',$config->getMaptype());
		}
		if (strlen(trim($props->get('zoomtype'))) == 0) {
			$props->set('zoomtype',$config->getZoomtype());
		}					
		$map->setProperties($props);
		// NEED TO CONVERT TO PARAMETER
		$code = $helper->getMap($map);
		$tmpl->addvar('viewmap','INSERTED_CODE', $code);
		$hindex = $helper->getMarkerIndex($map,1);
		$vindex = $helper->getMarkerIndex($map,0);
		$tmpl->addvar('viewmap','HMARKER_INDEX',$hindex);
		$tmpl->addvar('viewmap','VMARKER_INDEX',$vindex);
				
		$tmpl->displayParsedTemplate();
    }
    
    function viewmaps() {
		global $option, $Itemid, $mosConfig_live_site, $mosConfig_absolute_path;
		require_once( _GMAPS_PATTEMPLATE_DIR . 'patTemplate.php' );    				
		$tmpl = new patTemplate();	
		//$tmpl->setRoot( dirname( __FILE__ ) . '/templates' );
		$tmpl->setRoot( $mosConfig_absolute_path.'/components/com_gmaps/templates' );		
		$tmpl->setNamespace( 'mos' );
		$tmpl->readTemplatesFromFile( 'viewmaps.html' );

		$dao = new GMapDAO();
		$maps = $dao->getMaps();
		
		$newurl = '<a href="index.php?option=com_gmaps&amp;task=newmap&Itemid='.$Itemid.'">'
				. '[ CREATE MAP ]</a>';
		$newurl = '';
			//. '<img border=0 src="'.$mosConfig_live_site.'/components/com_gmaps/images/new.png"></a>';				
		for ($y=0; $y<(sizeof($maps)); $y++) {
			$url = 'index.php?option=com_gmaps&amp;task=viewmap&Itemid='.$Itemid . '&mapId=' . $maps[$y]->getId();
			// Build Action URLs
			$editurl = '<a href="index.php?option=com_gmaps&amp;task=editmap&Itemid='.$Itemid . '&mapId=' . $maps[$y]->getId().'">'
				. '<img border=0 src="'.$mosConfig_live_site.'/components/com_gmaps/images/edit.png"></a>';			
			$delurl = '<a href="index.php?option=com_gmaps&amp;task=deletemap&Itemid='.$Itemid . '&mapId=' . $maps[$y]->getId().'">'
				. '<img border=0 src="'.$mosConfig_live_site.'/components/com_gmaps/images/delete.png"></a>';
		//	$actionurls = $editurl . $delurl;
			$actionurls = '';				
			$data[$y] = array(
					'ID'=> $maps[$y]->getId(),
					'TITLE'=> $maps[$y]->getTitle(),
					'DESCRIPTION'=> $maps[$y]->getDescription(),
					'URL'=> $url,
					'ACTIONS'=>$actionurls
			);
		}
		$tmpl->addVar('listMaps','CREATE_ICON',$newurl);
		$tmpl->addRows('mapList-table', $data, 'MAP_');
		$tmpl->displayParsedTemplate();
    }		

    function editmap($id) {
		global $mainframe, $option, $Itemid, $mosConfig_live_site, $mosConfig_absolute_path;
		require_once( _GMAPS_PATTEMPLATE_DIR . 'patTemplate.php' );		
		$tmpl = new patTemplate;	
		$tmpl->setNamespace( 'mos' );
		$tmpl->setRoot( $mosConfig_absolute_path.'/components/com_gmaps/templates' );
		$tmpl->readTemplatesFromFile( 'editmap.html' );		
		$dao = new GMapDAO();		
		if ($id != 0) {

			$obj = $dao->getMap($id);
			$tmpl->addVar( 'form', 'DATA_ID', $obj->id);		
			$tmpl->addVar( 'form', 'DATA_TITLE', $obj->title );		
			$tmpl->addVar( 'form', 'DATA_DESCRIPTION', $obj->getDescription() );			
			$tmpl->addVar( 'form', 'DATA_OVERLAY1', HtmlHelper::getMapSelectList('overlay1',$obj->getOverlay1(),$id));			
			$tmpl->addVar( 'form', 'DATA_OVERLAY2', HtmlHelper::getMapSelectList('overlay2',$obj->getOverlay2(),$id) );
			$tmpl->addVar( 'form', 'DATA_OVERLAY3', HtmlHelper::getMapSelectList('overlay3',$obj->getOverlay3(),$id) );
			$tmpl->addVar( 'form', 'DATA_OVERLAY4', HtmlHelper::getMapSelectList('overlay4',$obj->getOverlay4(),$id) );
			$tmpl->addVar( 'form', 'DATA_OVERLAY5', HtmlHelper::getMapSelectList('overlay5',$obj->getOverlay5(),$id) );												
			$tmpl->addVar( 'form', 'FUNCTION', 'Edit' );			
			$tmpl->addVar('ADD-MARKER-SECTION','EDITING_MAP','Y');
			$tmpl->addVar('ADD-MARKER-SECTION','DATA_ID',$obj->id);		
		   	$dlist = $obj->getMarkers();
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
				}
				//<IMG SRC="'. $mosConfig_live_site . '/images/publish_x.png">
				$tmpl->addRows('marker-list', $data, 'MARK_');
							
		}			
		} else {
			$tmpl->addVar( 'form', 'DATA', '0');			
			$tmpl->addVar( 'form', 'FUNCTION', 'Add' );
			$tmpl->addVar('ADD-MARKER-SECTION','EDITING_MAP','N');
		}
		$markers = $dao->getAllMarkersForSelectList();
		$markerlist = mosHTML::selectList( $markers, 'marker_id', 'class="inputbox" ','value', 'text', 0);
		
	   	$tmpl->addVar('ADD-MARKER-SECTION','MARKER_LIST',$markerlist);
		$tmpl->addVar( 'ADD-MARKER-SECTION', 'OPTION', $option );			   			
		$tmpl->addVar( 'form', 'OPTION', $option );		
		$tmpl->addVar( 'form', 'TASK', 'listMaps' );
		$tmpl->addVar( 'form', 'formName', 'adminForm' );
			
		$tmpl->displayParsedTemplate('form');    	
    }

	function savemap() {
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
		if ($id != 0) {
			if ($dao->updateMap($obj)) {
				mosRedirect('index.php?option=com_gmaps&task=viewmaps','Map updated');
			}	
		} else {
			if ($dao->insertMap($obj)) {
				mosRedirect('index.php?option=com_gmaps&task=viewmaps','Map created');
			}
		}
	}
	
	function deleteMap($id) {
		$dao = new GMapDAO();	
		$obj = $dao->getMap($id);
		if ($id != 0) {
			if ($dao->deleteMap($obj)) {
				mosRedirect('index.php?option=com_gmaps&task=viewmaps','Map deleted');
			}	
		} else {
			mosRedirect('index2.phpoption=com_gmaps&task=viewmaps','Invalid ID passed to delete function');
		}
	}	
   
}
?>
