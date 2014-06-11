// create a map in the "map" div, set the view to a given place and zoom
var map = new L.Map('map', {
		center : [43.919083, -80.402833],
		zoom : 15,
		dragging : true,
		touchZoom : true,
		scrollWheelZoom : true,
		doubleClickZoom : true,
		boxZoom : true,
		tap : true,
		tapTolerance : 15,
		trackResize : true,
		worldCopyJump : false,
		closePopupOnClick : true,
		scale : true,
	});

// Basemaps
// add an OpenStreetMap tile layer
var osm_mq = new L.tileLayer('http://{s}.mqcdn.com/tiles/1.0.0/osm/{z}/{x}/{y}.png', {
		attribution : '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
		subdomains: ['otile1','otile2','otile3','otile4']
	}).addTo(map);

var osm_hot = new L.tileLayer('http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
		attribution : '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
	});
	
var osm_mapnik = new L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution : '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
	});

var LutherBog_ortho = new L.tileLayer.wms('http://geo-arcgis.uni-muenster.de:6080/arcgis/services/LutherBog/Luther_Marsch_Orthofotos_2006/MapServer/WMSServer', {
                layers : '0,1,2,3,4,5,6,7,8,9,10,11,,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35',
		format : 'image/png',
		version : '1.3.0',
		transparent : true,
		opacity : 1
	});

var LutherBog_ortho_merged = new L.tileLayer.wms('http://geo-arcgis.uni-muenster.de:6080/arcgis/services/LutherBog/Luther_Marsch_Orthofotos_2006_Merged/ImageServer/WMSServer', {
                layers : '0',
		format : 'image/png',
		version : '1.3.0',
		transparent : true,
		opacity : 1
	});

var LutherBog_elevation_grca = new L.tileLayer.wms('http://geo-arcgis.uni-muenster.de:6080/arcgis/services/LutherBog/lutherbog_elevation/MapServer/WMSServer', {
                layers : '0',
		format : 'image/png',
		version : '1.3.0',
		transparent : true,
		opacity : 1
	});

// New minimap - Plugin magic goes here! Note that you cannot use the same layer object again, as that will confuse the two map controls
var overviewMap = new L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
		maxZoom : 18,
		attribution : 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap<\/a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA<\/a>, Imagery © <a href="http://cloudmade.com">CloudMade<\/a>'
	});

// Minimap
var LminiMap = new L.Control.MiniMap(overviewMap, {
		toggleDisplay : true,
		mapOptions : {
			panControl : false,
			zoomsliderControl : false,
			crs : L.CRS.Simple,
		}
	}).addTo(map);

baseLayers = {
                'Open Street Map MapQuest' : osm_mq,
                'Open Street Map Humanitarian' : osm_hot,
                'Open Street Map Mapnik' : osm_mapnik,
};

groupedOverLayers = {
	"Additional Maps" : {
                'LutherBog Luft Bilder 2006' : LutherBog_ortho,
                'LutherBog Luft Bilder 2006 merged' : LutherBog_ortho_merged,
                'Elevation model' : LutherBog_elevation_grca
	}
};

// Layer switcher
var LlayerSwitcher = new L.control.groupedLayers(baseLayers, groupedOverLayers, {position: 'bottomleft'}).addTo(map);