<style type="text/css">

/* CSS Document */

.fan_box .page_stream {
border-top:1px solid #D8DFEA;
height:300px;
overflow:auto;
padding:0 10px;
position:relative;
text-align:center;
background-color:#000000;
}

#footpanel {
	position: fixed;
	bottom: 0; left: 0;
	z-index: 9999; /*--Keeps the panel on top of all other elements--*/
	background: #e3e2e2;
	border: 1px solid #c3c3c3;
	border-bottom: none;
	width: 94%;
	margin: 0 3%;
}

#footpanel ul {
	padding: 0; margin: 0;
	float: left;
	width: 100%;
	list-style: none;
	border-top: 1px solid #fff; /*--Gives the bevel feel on the panel--*/
	font-size: 1.1em;
}
#footpanel ul li{
	padding: 0; margin: 0;
	float: left;
	position: relative;
}
#footpanel ul li a{
	padding: 5px;
	float: left;
	text-indent: -9999px; /*--For text replacement - Shove text off of the page--*/
	height: 16px; width: 16px;
	text-decoration: none;
	color: #333;
	position: relative;
}
html #footpanel ul li a:hover{	background-color: #fff; }
html #footpanel ul li a.active { /*--Active state when sub-panel is open--*/
	background-color: #fff;
	height: 17px;
	margin-top: -2px; /*--Push it up 2px to attach the active button to sub-panel--*/
	border: 1px solid #555;
	border-top: none;
	z-index: 200; /*--Keeps the active link on top of the sub-panel--*/
	position: relative;
}
</style>
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
echo $egbzoom;
	
?>


