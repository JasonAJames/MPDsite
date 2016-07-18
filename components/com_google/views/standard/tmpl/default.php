<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
require(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'configuration.php');
JHTML::_('behavior.mootools');
//variables
$lang =& JFactory::getLanguage();
$lang_tag = $lang->getTag();
$current_language = split('-',$lang_tag);
$current_language = $current_language[0];
$direction_language = $current_language . '_' . strtoupper($current_language);
$document =& JFactory::getDocument();

//api key
$split_homepage = explode(",",$homepage_url_temp);
$split_api = explode(",",$google_api_temp);
$curr_homepage = str_replace("www.","",$_SERVER['SERVER_NAME']);
$counter = 0;
foreach ($split_homepage as $homepage){ 
	$uri = trim($homepage);
	$u =& JURI::getInstance( $uri );
	$temp_homepage = str_replace("www.","",$u->getHost());
	
	if ($temp_homepage==$curr_homepage) {
		$google_api = $split_api[$counter];
		break;
	}
	$counter++;
}

//category data
$name = $this->category->name;
if($this->params->get('cat_width')) {
	$width = $this->params->get('cat_width');
}else{
	$width = $this->category->width;
}
if($this->params->get('cat_height')) {
	$height = $this->params->get('cat_height');
}else{
	$height = $this->category->height;
}
if($this->params->get('cat_setcenter')) {
	$set_center = $this->params->get('cat_setcenter');
}else{
	$set_center = $this->category->setCenter;
}
if($this->params->get('cat_zoom')) {
	$zoomlevel = $this->params->get('cat_zoom');
}else{
	$zoomlevel = $this->category->zoomlevel;
}
$description = $this->category->description;
$description2 = $this->category->description2;
$published = $this->category->published;


//params component/menu
if($this->params->get('marker_picture')!='') {
	$marker_picture = $this->params->get('marker_picture');
}else{
	$marker_picture = $this->params_cat->get('marker_picture');
}
if($this->params->get('marker_address')!='') {
	$marker_address = $this->params->get('marker_address');
}else{
	$marker_address = $this->params_cat->get('marker_address');
}
if($this->params->get('marker_text')!='') {
	$marker_text = $this->params->get('marker_text');
}else{
	$marker_text = $this->params_cat->get('marker_text');
}
if($this->params->get('marker_onstart')!='') {
	$marker_onstart = $this->params->get('marker_onstart');
}else{
	$marker_onstart = $this->params_cat->get('marker_onstart');
}

if($this->params->get('routing')!='') {
	$routing = $this->params->get('routing');
}else{
	$routing = $this->params_cat->get('routing');
}
if($this->params->get('route_print')!='') {
	$route_print = $this->params->get('route_print');
}else{
	$route_print = $this->params_cat->get('route_print');
}
if($this->params->get('map_controls')!='') {
	$map_controls = $this->params->get('map_controls');
}else{
	$map_controls = $this->params_cat->get('map_controls');
}
if($this->params->get('map_scale_control')!='') {
	$map_scale_control = $this->params->get('map_scale_control');
}else{
	$map_scale_control = $this->params_cat->get('map_scale_control');
}
if($this->params->get('map_scroll_zoom')!='') {
	$map_scroll_zoom = $this->params->get('map_scroll_zoom');
}else{
	$map_scroll_zoom = $this->params_cat->get('map_scroll_zoom');
}
if($this->params->get('enable_continuous_zoom')!='') {
	$enable_continuous_zoom = $this->params->get('enable_continuous_zoom');
}else{
	$enable_continuous_zoom = $this->params_cat->get('enable_continuous_zoom');
}
if($this->params->get('street_view')!='') {
	$street_view = $this->params->get('street_view');
}else{
	$street_view = $this->params_cat->get('street_view');
}
if($this->params->get('map_type_controls')!='') {
	$map_type_controls = $this->params->get('map_type_controls');
}else{
	$map_type_controls = $this->params_cat->get('map_type_controls');
}

if($this->params->get('adsense')!='') {
	$adsense = $this->params->get('adsense');
}else{
	$adsense = $this->params_cat->get('adsense');
}
if($this->params->get('adsense_adsafe')!='') {
	$adsense_adsafe = $this->params->get('adsense_adsafe');
}else{
	$adsense_adsafe = $this->params_cat->get('adsense_adsafe');
}
if($this->params->get('adsense_client')!='') {
	$adsense_client = $this->params->get('adsense_client');
}else{
	$adsense_client = $this->params_cat->get('adsense_client');
}
if($this->params->get('adsense_channel')!='') {
	$adsense_channel = $this->params->get('adsense_channel');
}else{
	$adsense_channel = $this->params_cat->get('adsense_channel');
}

$page_suffix = $this->params->get('pageclass_sfx');
$page_title_1 = $this->params->get('show_page_title', 0);
$page_title = $this->escape($this->params->get('page_title'));

$header .= '
window.addEvent(\'load\', function() {
	load();
});
	
window.addEvent(\'onunload\', function(){
	GUnload();
});

var marker;
var overlayInstance = null;
var map;
var panoClient;
var myPano;
var info = [];
var gmarkers = [];
var htmls = [];
var i = 0;

function load() {
	if (GBrowserIsCompatible()) { 
   	';
	  if ($street_view==1) : 
			$header .= '
			panoClient  = new GStreetviewClient();
		  ';
	  endif;
	  if ($adsense==1) : 
			$header .= '
			var mapOptions = {
				googleBarOptions : {
				  style : "new",
				  adsOptions : {
					client: "'.$adsense_client.'",
					channel: "'.$adsense_channel.'",
					adsafe: "'.$adsense_adsafe.'",
					language: "'.$current_language.'"
				  }
				}
			}
			map = new GMap2(document.getElementById("googlemap'.$page_suffix.'", mapOptions));';
		else : 
			$header .= "map = new GMap2(document.getElementById('googlemap$page_suffix'));\n";
		endif;
				
		if($map_controls==1) { 
			$header .= "map.addControl(new GLargeMapControl());\n"; 
		}else{
			$header .= "map.addControl(new GSmallMapControl());\n";
		}
		
		if($map_scale_control==1) { $header .= "map.addControl(new GScaleControl());\n"; } 
		
		$header .= "map.addControl(new GMapTypeControl());\n";
		
		if($map_type_controls==1) { 
			$header .= "map.setMapType(G_SATELLITE_MAP);\n"; 
		}elseif($map_type_controls==2){
			$header .= "map.setMapType(G_HYBRID_MAP);\n"; 
		}else{
			$header .= "map.setMapType(G_NORMAL_MAP);\n"; 
		}	
				
		$header .= "map.setCenter(new GLatLng($set_center), $zoomlevel);\n";
		if ($street_view==1) : 
			$header .= '
			  var guyIcon = new GIcon(G_DEFAULT_ICON);
			  guyIcon.image = "http://maps.google.com/intl/en_us/mapfiles/cb/man_arrow-0.png";
			  guyIcon.transparent = "http://maps.google.com/intl/en_us/mapfiles/cb/man-pick.png";
			  guyIcon.imageMap = [
					26,13, 30,14, 32,28, 27,28, 28,36, 18,35, 18,27, 16,26,
					16,20, 16,14, 19,13, 22,8
				 ];
			  guyIcon.iconSize = new GSize(49, 52);
			  guyIcon.iconAnchor = new GPoint(25, 35);  
			  guyIcon.infoWindowAnchor = new GPoint(25, 5);  
			
			  marker = new GMarker(new GLatLng('.$set_center.'), {icon: guyIcon, draggable: true});
			  map.addOverlay(marker);
			  marker.openInfoWindowHtml("Drag me around");
			  
			   GEvent.addListener(marker, "dragend", function() {
					stop_timeout();										  
					var point = marker.getPoint();
					map.panTo(point);
					panoClient.getNearestPanorama(marker.getLatLng(), showPanoData);
					marker.closeInfoWindow() 
				  });
			
			  myPano = new GStreetviewPanorama(document.getElementById("pano'.$page_suffix.'"));
	
			  toggleOverlay();
		';
		endif;
		if($map_scroll_zoom==1) {$header .= "map.enableScrollWheelZoom();\n"; } 
		if($enable_continuous_zoom==1) {$header .= "map.enableContinuousZoom();\n"; } 

		$header .= "map.enableDoubleClickZoom();";
		
		if ($adsense==1) : 
			$header .= "map.enableGoogleBar();";
		endif; 
		
		$header .='
			var baseIcon = new GIcon();
			baseIcon.shadow = "'.JURI::base().'components/com_google/icons/map_shadow.png";
			
			baseIcon.shadowSize = new GSize(35, 45);
			baseIcon.iconAnchor = new GPoint(9, 34);
			baseIcon.infoWindowAnchor = new GPoint(9, 2);
			baseIcon.infoShadowAnchor = new GPoint(18, 25);


			function createMarker(point, tekst, type, index) {

			  var icon = new GIcon(baseIcon);
			  icon.image =  "'.JURI::base().'components/com_google/icons/"+type;
			  var marker = new GMarker(point, icon);
				
			  GEvent.addListener(marker, "click", function() {
				marker.openInfoWindowHtml(tekst);
			  });

			  gmarkers[i] = marker;
			  info[i] = tekst;
			  i++;
			  return marker;
			}

		';
		
		//Google indhold
		for ($i=0, $n=count( $this->google ); $i < $n; $i++)	{
			$row = &$this->google[$i];
			 // $txt = JFilterOutput::cleanText($row->txt);
			$txt = str_replace(chr(13),'<br />',$row->txt);
			$txt = str_replace(chr(10),'',$txt);
			$txt = str_replace(chr(34),chr(39),$txt);
			$google_html = "<div class='google_html'>";
			$google_html = $google_html .  "<b>" .$row->name . "</b>";
			if($row->picture && $marker_picture==1){
				$imgSizeInfo=getimagesize('images/google/'.$row->picture);
				$google_html = $google_html .  "<br /><br />" ."<img src='".JURI::root()."images/google/".$row->picture."' border='0' width='".$imgSizeInfo[0]."' height='".$imgSizeInfo[1]."'/>";
			}
			if(($row->address || $row->zipcode || $row->town) && $marker_address==1)
			{
				$google_html = $google_html .  "<br /><br /><strong>". JText::_( 'GOOGLE_ADDRESS') ."</strong><br />" .$row->address;
				$google_html = $google_html .  "<br />" .$row->zipcode;
				$google_html = $google_html .  " -- " .$row->town;
			}
			if($txt && $marker_text==1){$google_html = $google_html .  "<br /><br /><strong>". JText::_( 'GOOGLE_DESCRIPTION') ."</strong><br />".$txt;}
			
			$google_html = $google_html . "</div>";
			
			$header .='
			var point = new GLatLng("'.$row->lat.'","'.$row->long.'");
			map.addOverlay(createMarker(point,"'.$google_html.'","'.$row->icon_type.'"));
			';
			
		}
		
		if ($marker_onstart==1 && $street_view==0) : 
			$header .= 'gmarkers[0].openInfoWindowHtml(info[0]);';
		endif;
		
	$header .= '	
		
	}
}

function resetmap() {
	document.getElementById("directions'.$page_suffix.'").innerHTML = "";
	document.getElementById("direction_feedback'.$page_suffix.'").innerHTML = "";	
}
';

if ($street_view==1) : 
	$header .= '
function toggleOverlay() {
  if (!overlayInstance) {
	overlayInstance = new GStreetviewOverlay();
	map.addOverlay(overlayInstance);
  } else {
	map.removeOverlay(overlayInstance);
	overlayInstance = null;
  }
}

function showPanoData(panoData) {
	if (panoData.code != 200) {
		paneffektgo();
	return;
   }else{
	   document.getElementById("pano'.$page_suffix.'").style.display="block";
  }
  var angle = computeAngle(marker.getLatLng(), panoData.location.latlng);
  myPano.setLocationAndPOV(panoData.location.latlng, {yaw: angle});
}

function computeAngle(endLatLng, startLatLng) {
  var DEGREE_PER_RADIAN = 57.2957795;
  var RADIAN_PER_DEGREE = 0.017453;

  var dlat = endLatLng.lat() - startLatLng.lat();
  var dlng = endLatLng.lng() - startLatLng.lng();
  var yaw = Math.atan2(dlng * Math.cos(endLatLng.lat() * RADIAN_PER_DEGREE), dlat)
		 * DEGREE_PER_RADIAN;
  return wrapAngle(yaw);
}

function wrapAngle(angle) {
	if (angle >= 360) {
	  angle -= 360;
	} else if (angle < 0) {
	 angle += 360;
	}
	return angle;
};

var stop_nu;
function paneffektgo() {
	location.href = "#top";
	document.getElementById("pano_feedback'.$page_suffix.'").innerHTML = "<span>'.JText::_( 'GOOGLE_PANO_FEEDBACK').'</span>";
	opacity("pano_feedback'.$page_suffix.'", 0, 100, 500);
	stop_nu = setTimeout("opacity(\'pano_feedback'.$page_suffix.'\', 100, 0, 2000)",7000);
}


function opacity(id, opacStart, opacEnd, millisec) {
	var speed = Math.round(millisec / 100);
    var timer = 0;
	if(opacStart > opacEnd) {
        for(i = opacStart; i >= opacEnd; i--) {
            setTimeout("changeOpac(" + i + ",\'" + id + "\')",(timer * speed));
            timer++;
        }
    } else if(opacStart < opacEnd) {
        for(i = opacStart; i <= opacEnd; i++)
            {
            setTimeout("changeOpac(" + i + ",\'" + id + "\')",(timer * speed));
            timer++;
        }
    }
}

function changeOpac(opacity, id) {
	var object = document.getElementById(id).style;

	object.display = "block";
	object.filter = "alpha(opacity=" + opacity + ")";
	object.opacity = (opacity / 100);
	object.MozOpacity = (opacity / 100);
	object.KhtmlOpacity = (opacity / 100);
	if (opacity == 0) {
		object.display = "none";
	}
}

function stop_timeout() {	
	clearTimeout(stop_nu);
	document.getElementById("pano_feedback'.$page_suffix.'").style.display="none";
}
';
endif;

if($routing==1){	
	
	$header .='
//route
var geocoder;
function map_start() {
	var map;
	var gdir = null;
	var geocoder = null;
	var addressMarker;
	
	var from_address = document.getElementById("from_address").value;
	var from_zipcode = document.getElementById("from_zipcode").value;
	var from_town = document.getElementById("from_town").value;
	var to_address = document.getElementById("to_address").value;
	
	var from_start = "";
	if(from_address=="'.JText::_( 'GOOGLE_INPUT_FIELDSET').'") from_address="";
	if(from_zipcode=="'.JText::_( 'GOOGLE_INPUT_FIELDSET_AREA').'") from_zipcode="";
	if(from_town=="'.JText::_( 'GOOGLE_INPUT_FIELDSET_TOWN').'") from_town="";
	if(from_address) from_start = from_address + ","+"";
	if(from_zipcode) from_start += from_zipcode+ ","+"";
	if(from_town) from_start += from_town;

	function initialize() {
	  if (GBrowserIsCompatible()) {

		map = new GMap2(document.getElementById("googlemap'.$page_suffix.'"));
		';
		
		if($map_controls==1) { 
			$header .= "map.addControl(new GLargeMapControl());\n"; 
		}else{
			$header .= "map.addControl(new GSmallMapControl());\n";
		}
		
		if($map_scale_control==1) { $header .= "map.addControl(new GScaleControl());\n"; } 
		
		$header .= "map.addControl(new GMapTypeControl());\n";

		if($map_scroll_zoom==1) {$header .= "map.enableScrollWheelZoom();\n"; } 
		if($enable_continuous_zoom==1) {$header .= "map.enableContinuousZoom();\n"; } 

		$header .= '
		
		map.enableDoubleClickZoom();
		gdir = new GDirections(map, document.getElementById("directions'.$page_suffix.'"));
		GEvent.addListener(gdir, "load", onGDirectionsLoad);
		GEvent.addListener(gdir, "error", handleErrors);
		setDirections(from_start, to_address, "'.$direction_language.'");
	  }
	}

	function setDirections(fromAddress, toAddress, locale) {
	  gdir.load("from: " + fromAddress + " to: " + toAddress,{ "locale": locale });
	}

	function handleErrors(){
	   if (gdir.getStatus().code == G_GEO_UNKNOWN_ADDRESS){
			alert("'.JText::_( 'GOOGLE_INITIALIZE_ERROR1').'");
			load();
	   }else{
			alert("'.JText::_( 'GOOGLE_INITIALIZE_ERROR2').'");
			load();
		}
	}
	
	function onGDirectionsLoad(){
	';
	 if (!$route_print) :   
	 $header .='document.getElementById("direction_feedback'.$page_suffix.'").innerHTML = "<a href=\"javascript: load();resetmap();\" id=\"direction_started\">'.JText::_( 'GOOGLE_DIRECTION_FEEDBACK').'</a>";';
	 else :
	    $header .= 'document.getElementById("direction_feedback'.$page_suffix.'").innerHTML= "<input type=\"button\" value=\"'.JText::_( 'GOOGLE_DIRECTION_PRINT').'\" onClick=\"printSpecial()\" class=\"print_btn\"/>"+"<a href=\"javascript: load();resetmap();\" id=\"direction_started\">'.JText::_( 'GOOGLE_DIRECTION_FEEDBACK').'</a>";';
	endif;
	
	 $header .='
	 document.getElementById("directions'.$page_suffix.'").innerHTML = "";
	}

	initialize();		
}

//print
var gAutoPrint = false;
function printSpecial()
{
	if (document.getElementById != null)
	{
		var html = "<HTML>\n<HEAD>\n";
		html += "\n</HE" + "AD>\n<BODY>\n";
		var printReadyElem = document.getElementById("directions'.$page_suffix.'");
		if (printReadyElem != null)
		{		
				html += "<button onclick=window.print()>'.JText::_( 'GOOGLE_DIRECTION_PRINT').'</button><br /><br/>";
				html += printReadyElem.innerHTML;
		}
		else
		{
			alert("Could not find the printReady section in the HTML");
			return;
		}
		html += "\n</BO" + "DY>\n</HT" + "ML>";
		var printWin = window.open("","printSpecial", "width = 600");
		printWin.document.open();
		printWin.document.write(html);
		printWin.document.close();
		if (gAutoPrint)

			printWin.print();
	}
	else
	{
		alert("'.JText::_( 'GOOGLE_DIRECTION_OK').'");
	}
}
	
';

}
$document->addscript("http://maps.google.com/maps?file=api&amp;v=2&amp;hl=$current_language&amp;key=$google_api");
$document->addScriptDeclaration($header);
$document->addStyleSheet(JURI::root().'components'.DS.'com_google'.DS.'css'.DS.'google.css');
?>

<div id="googlecontainer<?php echo $page_suffix; ?>">
	<span id="top"></span>
    
	<?php if ($page_title_1) : ?>
        <h1 class="componentheading<?php echo $page_suffix; ?>"><?php echo $page_title; ?></h1>
    <?php endif; ?>
    
	<?php if ($description) : ?>
    	<div id="pretext<?php echo $page_suffix; ?>"><?php echo $description ?></div>
    <?php endif; ?>
      
	<div id="pano_feedback<?php echo $page_suffix; ?>"></div>
	<div id="googlemap<?php echo $page_suffix; ?>" style="width:<?php echo $width;?>;height:<?php echo $height;?>;"></div>
    <div id="pano<?php echo $page_suffix; ?>" style="display: none;"></div>

    <?php if ($routing==1) : ?>
    	
        
         <fieldset id="google_select<?php echo $this->params->get('pageclass_sfx');?>">
        	<legend><?php echo JText::_( 'GOOGLE_ROUTEPLANNING'); ?></legend>
            <form action="" onsubmit="map_start(); return false" method="post">    
             	
                <label><?php echo JText::_( 'GOOGLE_FROM'); ?></label>
                <input type="text" name="from_address" id="from_address" onfocus="if (this.value=='<?php echo JText::_( 'GOOGLE_INPUT_FIELDSET'); ?>') {this.value=''}" onblur="if (this.value=='') {this.value='<?php echo JText::_( 'GOOGLE_INPUT_FIELDSET'); ?>'}" value="<?php echo JText::_( 'GOOGLE_INPUT_FIELDSET'); ?>"/> 
                <input type="text" name="from_zipcode" id="from_zipcode" onfocus="if (this.value=='<?php echo JText::_( 'GOOGLE_INPUT_FIELDSET_AREA'); ?>') {this.value=''}" onblur="if (this.value=='') {this.value='<?php echo JText::_( 'GOOGLE_INPUT_FIELDSET_AREA'); ?>'}" value="<?php echo JText::_( 'GOOGLE_INPUT_FIELDSET_AREA'); ?>" />
                <input type="text" name="from_town" id="from_town" onfocus="if (this.value=='<?php echo JText::_( 'GOOGLE_INPUT_FIELDSET_TOWN'); ?>') {this.value=''}" onblur="if (this.value=='') {this.value='<?php echo JText::_( 'GOOGLE_INPUT_FIELDSET_TOWN'); ?>'}" value="<?php echo JText::_( 'GOOGLE_INPUT_FIELDSET_TOWN'); ?>"/>
                 <label><?php echo JText::_( 'GOOGLE_TILL'); ?></label>
				 <select name="to_address" id="to_address">
                    <option value="0"><?php echo JText::_( 'GOOGLE_SELECT_VALUE'); ?></option>
                     <?php 
                    for ($i=0, $n=count( $this->google ); $i < $n; $i++)	{
                        $row = &$this->google[$i];
                     	if($row->assign_routeplanning){echo "<option value=\"$row->lat,$row->long\">$row->name</option>";}
                    }
                    ?>
                 </select>
                <label></label>
                <input type="submit" value="<?php echo JText::_( 'GOOGLE_SELECT_BUTTON'); ?>" class="btn" />
            </form>
         </fieldset>
        <div class="clear"></div>	
		<div id="directions<?php echo $page_suffix; ?>" style="width:<?php echo $width;?>;height: auto;"></div> 
        <div id="direction_feedback<?php echo $page_suffix; ?>"></div>
  	<?php endif; ?>
  
   <?php if ($description2) : ?>
   <div class="clear"></div>
  	<div id="aftertext<?php echo $page_suffix; ?>"><?php echo $description2; ?></div>
   <?php endif; ?>
  
	
	<?php /*?><?php echo" <p class='google_link_author'>". JText::_( 'GOOGLE_JAN_SANGILL') ."&nbsp;<a href='http://joomla.jansangill.dk'>Jan Sangill</a>, <a href='http://vestjyskmarketing.dk'>Vestjysk Marketing</a></p>"; ?><?php */?>

</div>