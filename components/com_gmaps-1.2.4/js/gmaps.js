

var Markers = new Array();
var MarkersInfo = new Array(); 

function openInfoWindow(mapid,id,usetabs) {  
	if (usetabs == 'N') {     
		Markers[mapid,id].openInfoWindowHtml(MarkersInfo[mapid,id]);
	} else {     
		Markers[mapid,id].openInfoWindowTabsHtml(MarkersInfo[mapid,id]);   
	}
}