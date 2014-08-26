var map;
var lutherbog_elevation, lutherbog_ortho_tiles, flooded_area, part_flooded; 

require([
	'esri/map',
	
	'esri/layers/ArcGISDynamicMapServiceLayer',
        'esri/layers/ImageParameters',
	'esri/layers/FeatureLayer',
	'esri/graphic',
	'esri/tasks/Geoprocessor',
	'esri/tasks/GeometryService',
	'esri/symbols/SimpleFillSymbol',
	'esri/symbols/SimpleLineSymbol',
	'esri/geometry/Point',
	'esri/geometry/Extent',
	
        'esri/domUtils',	
	
	'esri/dijit/Legend',
	'esri/dijit/HomeButton',
	'esri/dijit/Scalebar',
	'esri/dijit/OverviewMap',
	'esri/dijit/BasemapGallery',
	'esri/dijit/Popup',
	'esri/dijit/PopupTemplate',
	
	'esri/arcgis/utils',
	
	'dojo/dom', 
	'dojo/parser',
	'dojo/_base/array',
	'dojo/date/locale',
	
	'dijit/layout/BorderContainer',
	'dijit/layout/ContentPane',
	'dijit/TitlePane',
	'dijit/registry',
	'dojo/domReady!',
    ], 
    function(
	Map,
	
	ArcGISDynamicMapServiceLayer,
	ImageParameters,
	FeatureLayer,
	graphic,
	Geoprocessor,
	GeometryService,
	SimpleFillSymbol,
	SimpleLineSymbol,
	Point,
	Extent,
	
	domUtils,
	
	Legend,
	HomeButton,
	Scalebar,
	OverviewMap,
	BasemapGallery,
	Popup,
	PopupTemplate,
	
	utils,
	
	dom,
	parser,
	array,
	locale,
	
	BorderContainer,
	ContentPane,
	TitlePane,
	registry
	) {
	
        parser.parse();

        map = new Map("map", {
		center: [-80.409833, 43.924083],
		zoom: 14,
		basemap: "osm"
	});
	
	var basemapGallery = new BasemapGallery({
		showArcGISBasemaps: true,
		map: map
	}, "basemapGallery");
	basemapGallery.startup();
	
	var home = new HomeButton({
		map: map
	}, "HomeButton");
	home.startup();
	
	var scalebar = new Scalebar({
		map: map,
		scalebarUnit: "dual"
        });
	
	var overviewMapDijit = new OverviewMap({
		map: map,
		visible: true
        });
        overviewMapDijit.startup();
	
	var popupTemplate = new PopupTemplate({
		title: '{name}',
		description: 'Daten dieser Site <a href="access.php">anzeigen</a>',
	});
	
	/*LÖSCHEN
	
	map.on("click", addPoint);

          function addPoint(evt) {
            var latitude = evt.mapPoint.getLatitude();
            var longitude = evt.mapPoint.getLongitude();
            map.infoWindow.setTitle("Coordinates");
            map.infoWindow.setContent(
              "lat/lon : " + latitude.toFixed(10) + ", " + longitude.toFixed(10) + 
              "<br>screen x/y : " + evt.screenPoint.x + ", " + evt.screenPoint.y
            );
            map.infoWindow.show(evt.mapPoint, map.getInfoWindowAnchor(evt.screenPoint));
          }
	
	BIS HIER */
		
	lutherbog_elevation = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/lutherbog_elevation/MapServer", {});
        map.addLayer(lutherbog_elevation);
	lutherbog_elevation.hide();
	lutherbog_elevation.setOpacity(0.5);
	
	lutherbog_ortho_tiles = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/Luther_Marsch_Orthofotos_2006/MapServer", {});
	map.addLayer(lutherbog_ortho_tiles);
	lutherbog_ortho_tiles.hide();
	lutherbog_ortho_tiles.setOpacity(0.5);
	
	lutherbog_ortho_merged = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/Luther_Marsch_Orthophotos_2006_merged/MapServer", {});
	map.addLayer(lutherbog_ortho_merged);
	lutherbog_ortho_merged.hide();
	lutherbog_ortho_merged.setOpacity(0.5);
	
	lutherbog_uav_merged = new ArcGISDynamicMapServiceLayer("dsd", {});
	map.addLayer(lutherbog_uav_merged);
	lutherbog_uav_merged.hide();
	lutherbog_uav_merged.setOpacity(0.5);
	
	lutherbog_sites = new FeatureLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/Sites_lutherbog/FeatureServer/0", {
		mode: FeatureLayer.MODE_SNAPSHOT,
		infoTemplate: popupTemplate,
		outFields: ["*"]
	});
	map.addLayer(lutherbog_sites);
	lutherbog_sites.hide();
	
	// Geoprocessing flooded areas
	var gpServiceUrl= "http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/extract_flooded_areas/GPServer/flooded_areas";
        var mapserviceurl= "http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/extract_flooded_areas/MapServer/jobs";
	
	// Geoprocessing flooded areas part
	var gpServiceUrlPart= "http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/extract_flooded_areas_part/GPServer/flooded_areas_part2";
        var mapserviceurlPart= "http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/extract_flooded_areas_part/MapServer/jobs";
	
	// Geoprocessing isolines
	var gpServiceUrlIso= "http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/isolines/GPServer/isolines";
        var mapserviceurlIso= "http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/isolines/MapServer/jobs";

	function getFlooded(){
		$('#flooded_area').prop('checked', true);
		var gp = new Geoprocessor(gpServiceUrl);
		var params = {
			SQL_Expression: ("Value < " + $('#flooded_area_gauge').val()).replace('.',',')
		};
		//cleanup any results from previous runs
		cleanup("flooded_area");
		gp.submitJob(params, gpJobCompleteFlooded, gpJobStatus, gpJobFailed);
        }
	
	function getFloodedPart(){
		$('#flooded_area_part').prop('checked', true);
		var gp = new Geoprocessor(gpServiceUrlPart);
		var params = {
			SQL_Expression: ("Value < " + $('#flooded_area_gauge_part').val()).replace('.',',')
		};
		//cleanup any results from previous runs
		cleanup("part_flooded");
		gp.submitJob(params, gpJobCompleteFloodedPart, gpJobStatus, gpJobFailed);
        }
	
	function getIsolines(){
		$('#isolines').prop('checked', true);
		var gp = new Geoprocessor(gpServiceUrlIso);
		var params = {
			Double: ($('#isolines_difference').val())
		};
		//cleanup any results from previous runs
		cleanup("isolines");
		gp.submitJob(params, gpJobCompleteIsolines, gpJobStatus, gpJobFailed);
        }
	
	function gpJobCompleteFlooded(jobinfo){
		//construct the result map service url using the id from jobinfo we'll add a new layer to the map
		var mapurl = mapserviceurl + "/" + jobinfo.jobId;
		flooded_area = new ArcGISDynamicMapServiceLayer(mapurl,{"id":"flooded_area", "opacity": 0.5});
		//add the hotspot layer to the map
		map.addLayers([flooded_area]);
	}
	
	function gpJobCompleteFloodedPart(jobinfo){
		//construct the result map service url using the id from jobinfo we'll add a new layer to the map
		var mapurl = mapserviceurlPart + "/" + jobinfo.jobId;
		part_flooded = new ArcGISDynamicMapServiceLayer(mapurl,{"id":"part_flooded", "opacity": 0.5});
		//add the hotspot layer to the map
		map.addLayers([part_flooded]);
	}
	
	function gpJobCompleteIsolines(jobinfo){
		//construct the result map service url using the id from jobinfo we'll add a new layer to the map
		var mapurl = mapserviceurlIso + "/" + jobinfo.jobId;
		isolines = new ArcGISDynamicMapServiceLayer(mapurl,{"id":"isolines", "opacity": 0.5});
		//add the hotspot layer to the map
		map.addLayers([isolines]);
	}
	
	function gpJobStatus(jobinfo){
		$('#map-error').css('display','none');
		switch (jobinfo.jobStatus) {
			case 'esriJobSubmitted':
				$('#map-submitted').css('display', 'block');
			break;
			case 'esriJobExecuting':
				$('#map-submitted').css('display', 'none');
				$('#map-loading').css('display', 'block');
			break;
			case 'esriJobSucceeded':
				$('#map-loading').css('display','none');
				$('#map-success').css('display','block');
				setTimeout(function() {
					$('#map-success').css('display','none');
				}, 1500);
				
			break;
			}
	}
	
	function gpJobFailed(error){
		$('#map-error').css('display','block');
		setTimeout(function() {
			$('#map-error').css('display','none');
		}, 1500);
	}
	
	function cleanup(layer){
		var removeLayer = map.getLayer(layer);
		if(removeLayer){
			map.removeLayer(removeLayer);
		}
	}
	
	function SetZoomSite(siteID){
	if (siteID > 0) {
		$('#sites').prop('checked', true);
		lutherbog_sites.show();
	}
	switch (siteID) {
		case '1':
			var mapPoint = new Point(-80.4038194656, 43.9170864435);
			map.centerAndZoom(mapPoint, 18);
		break;
		case '2':
			var mapPoint = new Point(-80.4060081482, 43.9190958081);
			map.centerAndZoom(mapPoint, 18);
		break;
		case '3':
			var mapPoint = new Point(-80.4071668624, 43.9203323064);
			map.centerAndZoom(mapPoint, 18);
		break;
		case '4':
			var mapPoint = new Point(-80.4085401535, 43.9223570170);
			map.centerAndZoom(mapPoint, 18);
		break;
		case '5':
			var mapPoint = new Point(-80.4092482566, 43.9233152529);
			map.centerAndZoom(mapPoint, 18);
		break;
		case '6':
			var mapPoint = new Point(-80.4096559524, 43.9239643717);
			map.centerAndZoom(mapPoint, 18);
		break;
		}
	}
	
	SetZoomSite($('#AcessSideID').val());
	
	app = {
		getFlooded: getFlooded,
		getFloodedPart: getFloodedPart,
		getIsolines: getIsolines,
		SetZoomSite: SetZoomSite
	};
	return app;

});

$('#hoehe_opacity').change(function (){
	$('#hoehe_opacity_value').val(($('#hoehe_opacity').val()*100) + "%");
	lutherbog_elevation.setOpacity($('#hoehe_opacity').val());
	
});

$('#ortho_tiles_opacity').change(function (){
	$('#ortho_tiles_opacity_value').val(($('#ortho_tiles_opacity').val()*100) + "%");
	lutherbog_ortho_tiles.setOpacity($('#ortho_tiles_opacity').val());
});

$('#ortho_merged_opacity').change(function (){
	$('#ortho_merged_opacity_value').val(($('#ortho_merged_opacity').val()*100) + "%");
	lutherbog_ortho_merged.setOpacity($('#ortho_merged_opacity').val());
});

$('#ortho_uav_opacity').change(function (){
	$('#ortho_uav_opacity_value').val(($('#ortho_uav_opacity').val()*100) + "%");
	lutherbog_uav_merged.setOpacity($('#ortho_uav_opacity').val());
});

$('#flooded_area_gauge_part').change(function (){
	$('#flooded_area_gauge_value_part').val($('#flooded_area_gauge_part').val() + "m");
});

$('#flooded_area_opacity_part').change(function (){
	$('#flooded_area_opacity_value_part').val(($('#flooded_area_opacity_part').val()*100) + "%");
	part_flooded.setOpacity($('#flooded_area_opacity_part').val());
});

$('#flooded_area_gauge').change(function (){
	$('#flooded_area_gauge_value').val($('#flooded_area_gauge').val() + "m");
});

$('#flooded_area_opacity').change(function (){
	$('#flooded_area_opacity_value').val(($('#flooded_area_opacity').val()*100) + "%");
	flooded_area.setOpacity($('#flooded_area_opacity').val());
});

$('#isolines_difference').change(function (){
	$('#isolines_difference_value').val($('#isolines_difference').val() + "m");
});

$('#sites').change(function(){
	if($('#sites').is(':checked') == true){
		lutherbog_sites.show();
	}
	else{
		lutherbog_sites.hide();
	}
});

$('#hoehe').change(function(){
	if($('#hoehe').is(':checked') == true){
		lutherbog_elevation.show();
	}
	else{
		lutherbog_elevation.hide();
	}
});

$('#ortho_tiles').change(function(){
	if($('#ortho_tiles').is(':checked') == true){
		lutherbog_ortho_tiles.show();
	}
	else{
		lutherbog_ortho_tiles.hide();
	}
});

$('#ortho_merged').change(function(){
	if($('#ortho_merged').is(':checked') == true){
		lutherbog_ortho_merged.show();
	}
	else{
		lutherbog_ortho_merged.hide();
	}
});

$('#ortho_uav').change(function(){
	if($('#ortho_uav').is(':checked') == true){
		lutherbog_uav_merged.show();
	}
	else{
		lutherbog_uav_merged.hide();
	}
});

$('#flooded_area_part').change(function(){
	if($('#flooded_area_part').is(':checked') == true){
		part_flooded.show();
	}
	else{
		part_flooded.hide();
	}
});

$('#flooded_area').change(function(){
	if($('#flooded_area').is(':checked') == true){
		flooded_area.show();
	}
	else{
		flooded_area.hide();
	}
});

$('#isolines').change(function(){
	if($('#isolines').is(':checked') == true){
		isolines.show();
	}
	else{
		isolines.hide();
	}
});

$('#process-flooded-button').click(function(){
	app.getFlooded();
});

$('#process-flooded-part-button').click(function(){
	app.getFloodedPart();
});

$('#process-isolines-button').click(function(){
	app.getIsolines();
});

// Mapbreite anpassen
$('#map').css('width', $(window).width() - ($('#mapdetails').width()+20));
$(window).resize(function(){
        $('#map').css("width", $(window).width() - ($('#mapdetails').width()+20));
});

// Position von Loading anzeige anpassen
var mapwidth = $('#map').width();
var mapheight = $('#map').height();
$('.map-processing').css('left', mapwidth/2-100);
$('.map-processing').css('top', mapheight/2-100);
$(window).resize(function(){
	var mapwidth = $('#map').width();
	var mapheight = $('#map').height();
	$('.map-processing').css('left', mapwidth/2-100);
	$('.map-processing').css('top', mapheight/2-100);
});

$('.map-processing').click(function(){
	$('#map-submitted').css('display','none');
	$('#map-loading').css('display','none');
	$('#map-success').css('display','none');
	$('#map-error').css('display','none');
});

// Wenn die Anfrage nicht aus dem Uninetz kommt Fehlermeldung anzeigen
jQuery.ajax({
    type: "POST",
    url: 'process/getIP.php',
    dataType: 'html',
    data: {action:"ip"},
    success: function(data) {
        $('#map-wrongIP').css('display',data);
    },
});