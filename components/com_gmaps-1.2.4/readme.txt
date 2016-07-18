
GMaps 1.x
===============================================
* Build 1.2.2 11/07/2007
	-- Updated gmaps.xml file to fix incompatibility with J1.5
	-- Resovled array issue when running under Joomla 1.5
	-- Updated many of the admin views to be consistent with Joomla 1.5 
	
* Build 1.2.1 10/24/2007
	-- Resolved some undefined variable issues
	
* Build 1.2 09/08/2007
	-- Added fix to resolve issue reported with JCalPRO
	
* Build 1.1.1 08/08/2007
	-- Removed the ALTER statements from the gmaps.xml file to change table type to MyISAM

* Build 1.1  07/31/2007
	-- Security fix for reported sql injection issue
	
* Build 1.0.2 04/20/2007
	-- Increased size of Map title (altered during install)
	-- Fixed issue with UNDEFINED VARIABLE warnings/notices being generated
	-- Added some code cleanup in the viewmap.html file

* Build 1.0.1  03/17/2007
  	-- Added support to define TAB headers
  	-- Added support to order the tabs on the markers
  	-- Supports auto-opening of a defined marker
  	-- Added standard hover capabilities over the markers
  	-- Added support for images within the markers info window
  	
* Build 1.0.0  03/04/2007
	-- Added configuration option on the map to enable directory
		tabs for the markers
		
* Build 0.9.0  03/02/2007
 	-- Removed reference to external JS and CSS
 	-- Removed unnecessary published parameters in the module
 	-- Removed last DIV tag in the viewmaps.html template
 	-- Removed toolbar icons on the GMaps Control Panel
 	-- Rewrote the Google API class to utilize the new GMarkerManager class
 	-- Added link on the Component configuration to provide a link to the 
 		Google API signup page
 	-- Added APPLY button to the edit map template
 	-- Added option SHOWMAPTYPE to remove the Hybrid,Satellite,Normal controls from
 		the map
 	-- Added functions to manage icons
 		** 	This was required due to rewrite of the Google API class to ensure 
 			cross-browser compatibility.  Size of the Icon is required when 
 			rendering the icons in IE
 	-- Minor code cleanup
 	-- Fixed bug with the config module saving the default icon
 	-- Added DIV tags to enable greater styling flexibility on the frontend View Map page
 	-- Added DIV and CLASS elements for the frontend list to enable more styling options
 	-- Added INDEX TITLE parameter when creating the MAP.  INDEX is the default but this
 		value maybe changed on the Map properties page
 	-- Support for defining default center of map (otherwise first marker is set to center)
 	-- Fixed issue with double quotes on the info window.  If user enters double quotes, 
 		they will be converted to single quotes

* Build 0.8.8  02/24/2007
	-- Fixes load issue with COLUMN SIZE GREATER THAN 255 USE TEXT
	-- Resolves issues some were having with adding foreign key
	-- Eliminates hard-code of icon size when maps are rendered
	-- Added ability to view README.TXT from the control panel