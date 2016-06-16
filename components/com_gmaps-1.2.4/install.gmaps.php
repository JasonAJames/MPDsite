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
 * 02/28/2007	cjs	Added code to insert default icons
 * 04/20/2007	cjs Added code to convert the TITLE to 100 char.
 * 08/08/2007	cjs	Changed installation notice
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once ('classes/configdao.class.php');
require_once ('classes/config.class.php');
require_once ('classes/icondao.class.php');
require_once ('classes/errorhandler.class.php');

function com_install() {
  global $database;

  $config = new GmapConfig();
  
  if (!$config->isConfigured()) {
  	$config->setHeight("400px");
  	$config->setWidth("100%");
  	$config->setZoom("12");
 	$config->setMaptype("Normal");
 	$config->setZoomtype("Large");
	$config->setDefaultIcon("default.png"); 	
	$dao = new GmapConfigDAO();
	$dao->insert($config);
  }
  // LOAD ICONS INTO TABLE ONLY IF THERE ARE NO ICONS DEFINED
  $dao = new IconDAO();
  if ($dao->getRowCount() == 0) {
  	$icon = new Icon();
  	$height=20; 
  	$width=12;
  	$icon->setHeight($height);
  	$icon->setWidth($width);  	
  	$icon->setIcon('aqua-marker.png');
  	$dao->insert($icon);
  	$icon->setIcon('blue-marker.png');
  	$dao->insert($icon);
  	$icon->setIcon('default.png');
  	$dao->insert($icon);
  	$icon->setIcon('green-marker.png');
  	$dao->insert($icon);
  	$icon->setIcon('orange-marker.png');
  	$dao->insert($icon);
  	$icon->setIcon('purple-marker.png');
  	$dao->insert($icon);
  	$icon->setIcon('red-marker.png');
  	$dao->insert($icon);
  	$icon->setIcon('school.png');
  	$dao->insert($icon);
  	$icon->setIcon('yellow-marker.png');
	$dao->insert($icon);
  }
  
  /**
   * This step is in place to alter tables conditionally since mysql doesn't support if exists at 
   * the column level
   */
  $fields = $database->getTableFields(array('#__gmaps_markers') );
  $fldArray = $fields['#__gmaps_markers'];
  $flag = false;
  if (array_key_exists('categoryid',$fldArray) ) {
		$flag=true;
  }
  if (!$flag) {
		$query = 'alter table #__gmaps_markers add column categoryid int(11)';
		$database->setQuery($query);
		if (!$database->query()) {
			ErrorHandler::displayError($database->getErrorMsg());
			exit();
		}  
  }
  $flag = false;
  if (array_key_exists('properties',$fldArray) ) {
		$flag=true;
  }
  if (!$flag) {
		$query = 'alter table #__gmaps_markers add column properties text';
		$database->setQuery($query);
		if (!$database->query()) {
			ErrorHandler::displayError($database->getErrorMsg());
			exit();
		}  
  }   
  $fields = $database->getTableFields(array('#__gmaps_maps') );
  $flag = false;
  if (array_key_exists('title',$fldArray) ) {
		$flag=true;
  }
  if (!$flag) {
		$query = 'alter table #__gmaps_maps modify column title varchar(100)';
		$database->setQuery($query);
		if (!$database->query()) {
			ErrorHandler::displayError($database->getErrorMsg());
			exit();
		}  
  }    

?>
<div style="text-align:left;">
<img src="components/com_gmaps/gmapslogo.png"/>
<h1>GMaps Component for Joomla</h1>
<p>
Thanks for installing GMaps 1.2 for Joomla.  GMaps will allow you to create and manage
maps that can be rendered as a front-end component.  Maps defined using the GMap component can also be
rendered within your content using the GMaps plugin.  Any comments and/or suggestions are welcome.    
</p>
<p>
GMaps includes a concept of a "map overlay". Basically, you will define several maps with their own markers that 
are plotted.  A "map overlay" is another map, that is associated to other maps.  It inherits the markers from the
maps it is associated with.  This enables you to present multiple views of mapping data within one content page
without having to render multiple views. 
 <a href="http://firestorm-technologies.com/index.php?option=com_content&task=view&id=13&Itemid=29">Check out our page on GMaps for more details. </a>
</p>
<p>
GMaps is free software and is provided "as is".  It is offered to you under the terms
of the <a href="http://www.gnu.org/copyleft/gpl.html#SEC1">GNU Public License</a>. Although we believe 
this component is safe to use, there still may be some minor defects yet identified by the developers.   Also,
by you installing this component and associated plugin, you waive any form of liability against the developer
for problems or damaged caused by this software to your environment.
</p>

</div>

<?php
}  

?>