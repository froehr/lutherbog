var map;
var lutherbog_elevation, lutherbog_ortho_tiles, flooded_area, part_flooded, ndvi1, ndvi2, ndvi3, ndvi4, ndvi5; 

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
	'esri/dijit/BasemapLayer',
	'esri/dijit/Basemap',
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
	BasemapLayer,
	Basemap,
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
	
	var layer = new BasemapLayer({
		
   	});

	var basemap = new Basemap({

    layers:[layer],

    title:"NoMap",
	
    thumbnailUrl:"../img/noMap.PNG"

  });

  basemapGallery.add(basemap);
	
	
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
	
	lutherbog_alle_flights = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/uasFlight1/MapServer", {});
	map.addLayer(lutherbog_alle_flights);
	lutherbog_alle_flights.hide();
	lutherbog_alle_flights.setOpacity(0.5);
	
	lutherbog_flight1 = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/Flight1/MapServer", {});
	map.addLayer(lutherbog_flight1);
	lutherbog_flight1.hide();
	lutherbog_flight1.setOpacity(0.5);
	
	lutherbog_flight2 = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/Flight2/MapServer", {});
	map.addLayer(lutherbog_flight2);
	lutherbog_flight2.hide();
	lutherbog_flight2.setOpacity(0.5);
	
	lutherbog_flight3 = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/Flight3/MapServer", {});
	map.addLayer(lutherbog_flight3);
	lutherbog_flight3.hide();
	lutherbog_flight3.setOpacity(0.5);
	
	lutherbog_flight4 = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/Flight4/MapServer", {});
	map.addLayer(lutherbog_flight4);
	lutherbog_flight4.hide();
	lutherbog_flight4.setOpacity(0.5);
	
	lutherbog_flight5 = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/Flight5/MapServer", {});
	map.addLayer(lutherbog_flight5);
	lutherbog_flight5.hide();
	lutherbog_flight5.setOpacity(0.5);
	
	lutherbog_ndviAll = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/NDVIAll/MapServer", {});
	map.addLayer(lutherbog_ndviAll);
	lutherbog_ndviAll.hide();
	lutherbog_ndviAll.setOpacity(0.5);
	
	lutherbog_ndvi2 = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/NDVI2/MapServer", {});
	map.addLayer(lutherbog_ndvi2);
	lutherbog_ndvi2.hide();
	lutherbog_ndvi2.setOpacity(0.5);
	
	lutherbog_ndvi1 = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/NDVI1/MapServer", {});
	map.addLayer(lutherbog_ndvi1);
	lutherbog_ndvi1.hide();
	lutherbog_ndvi1.setOpacity(0.5);
	
	lutherbog_ndvi3 = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/NDVI3/MapServer", {});
	map.addLayer(lutherbog_ndvi3);
	lutherbog_ndvi3.hide();
	lutherbog_ndvi3.setOpacity(0.5);
	
	lutherbog_ndvi4 = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/NDVI4/MapServer", {});
	map.addLayer(lutherbog_ndvi4);
	lutherbog_ndvi4.hide();
	lutherbog_ndvi4.setOpacity(0.5);
	
	lutherbog_ndvi5 = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/NDVI5/MapServer", {});
	map.addLayer(lutherbog_ndvi5);
	lutherbog_ndvi5.hide();
	lutherbog_ndvi5.setOpacity(0.5);
	
	lutherbog_siteAll = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/SiteAlleMitRaster/MapServer", {});
	map.addLayer(lutherbog_siteAll);
	lutherbog_siteAll.hide();
	lutherbog_siteAll.setOpacity(0.5);
	
	lutherbog_site1 = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/Site1/MapServer", {});
	map.addLayer(lutherbog_site1);
	lutherbog_site1.hide();
	lutherbog_site1.setOpacity(0.5);
	
	lutherbog_site2 = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/Site2/MapServer", {});
	map.addLayer(lutherbog_site2);
	lutherbog_site2.hide();
	lutherbog_site2.setOpacity(0.5);
	
	lutherbog_site3 = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/Site3/MapServer", {});
	map.addLayer(lutherbog_site3);
	lutherbog_site3.hide();
	lutherbog_site3.setOpacity(0.5);
	
	lutherbog_site4 = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/Site4/MapServer", {});
	map.addLayer(lutherbog_site4);
	lutherbog_site4.hide();
	lutherbog_site4.setOpacity(0.5);
	
	lutherbog_site1Kl = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/Site1Kl/MapServer", {});
	map.addLayer(lutherbog_site1Kl);
	lutherbog_site1Kl.hide();
	lutherbog_site1Kl.setOpacity(0.3);
	
	lutherbog_site2Kl = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/Site2Kl/MapServer", {});
	map.addLayer(lutherbog_site2Kl);
	lutherbog_site2Kl.hide();
	lutherbog_site2Kl.setOpacity(0.3);
	
	lutherbog_site3Kl = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/Site3Kl/MapServer", {});
	map.addLayer(lutherbog_site3Kl);
	lutherbog_site3Kl.hide();
	lutherbog_site3Kl.setOpacity(0.3);
	
	lutherbog_site4Kl = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/Site4Kl/MapServer", {});
	map.addLayer(lutherbog_site4Kl);
	lutherbog_site4Kl.hide();
	lutherbog_site4Kl.setOpacity(0.3);
	
	
	
	
	lutherbog_uav_merged = new ArcGISDynamicMapServiceLayer("dsd", {});
	map.addLayer(lutherbog_uav_merged);
	lutherbog_uav_merged.hide();
	lutherbog_uav_merged.setOpacity(0.5);
	
	/*lutherbog_sites = new FeatureLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/Sites_lutherbog/FeatureServer/0", {
		mode: FeatureLayer.MODE_SNAPSHOT,
		infoTemplate: popupTemplate,
		outFields: ["*"]
	});
	map.addLayer(lutherbog_sites);
	lutherbog_sites.hide();*/
	
	// Geoprocessing flooded areas
	var gpServiceUrl= "http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/extract_flooded_areas/GPServer/flooded_areas";
        var mapserviceurl= "http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/extract_flooded_areas/MapServer/jobs";
	
	// Geoprocessing flooded areas part
	var gpServiceUrlPart= "http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/extract_flooded_areas_part/GPServer/flooded_areas_part2";
        var mapserviceurlPart= "http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/extract_flooded_areas_part/MapServer/jobs";
	
	// Geoprocessing isolines
	var gpServiceUrlIso= "http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/isolines/GPServer/isolines";
        var mapserviceurlIso= "http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/isolines/MapServer/jobs";
	
	// Geoprocessing ndvi1
	var gpServiceUrlndvi1="http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/ndvi1/GPServer/ndvi1";
		var mapserviceurlndvi1="http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/ndvi1/MapServer/jobs";
		
	// Geoprocessing ndvi2
	var gpServiceUrlndvi2="http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/ndvi2/GPServer/ndvi2";
		var mapserviceurlndvi2="http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/ndvi2/MapServer/jobs";
		
	// Geoprocessing ndvi3
	var gpServiceUrlndvi3="http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/ndvi3/GPServer/ndvi3";
		var mapserviceurlndvi3="http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/ndvi3/MapServer/jobs";
		
	// Geoprocessing ndvi4
	var gpServiceUrlndvi4="http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/ndvi4/GPServer/ndvi4";
		var mapserviceurlndvi4="http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/ndvi4/MapServer/jobs";
		
	// Geoprocessing ndvi5
	var gpServiceUrlndvi5="http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/ndvi5/GPServer/ndvi5";
		var mapserviceurlndvi5="http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/ndvi5/MapServer/jobs";
	
	
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
		var part_flooded = new ArcGISDynamicMapServiceLayer(mapurl,{"id":"part_flooded", "opacity": 0.5});
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
	
	function gpJobCompletendvi1(jobinfo){
		//construct the result map service url using the id from jobinfo we'll add a new layer to the map
		var mapurl = mapserviceurlndvi1 + "/" + jobinfo.jobId;
		ndvi1 = new ArcGISDynamicMapServiceLayer(mapurl,{"id":"ndvi1", "opacity": 0.5});
		//add the hotspot layer to the map
		map.addLayers([ndvi1]);
	}
	
	function gpJobCompletendvi2(jobinfo){
		//construct the result map service url using the id from jobinfo we'll add a new layer to the map
		var mapurl = mapserviceurlndvi1 + "/" + jobinfo.jobId;
		ndvi2 = new ArcGISDynamicMapServiceLayer(mapurl,{"id":"ndvi2", "opacity": 0.5});
		//add the hotspot layer to the map
		map.addLayers([ndvi2]);
	}
	
	function gpJobCompletendvi3(jobinfo){
		//construct the result map service url using the id from jobinfo we'll add a new layer to the map
		var mapurl = mapserviceurlndvi1 + "/" + jobinfo.jobId;
		ndvi3 = new ArcGISDynamicMapServiceLayer(mapurl,{"id":"ndvi3", "opacity": 0.5});
		//add the hotspot layer to the map
		map.addLayers([ndvi3]);
	}
	
	function gpJobCompletendvi4(jobinfo){
		//construct the result map service url using the id from jobinfo we'll add a new layer to the map
		var mapurl = mapserviceurlndvi1 + "/" + jobinfo.jobId;
		ndvi4 = new ArcGISDynamicMapServiceLayer(mapurl,{"id":"ndvi4", "opacity": 0.5});
		//add the hotspot layer to the map
		map.addLayers([ndvi4]);
	}
	
	function gpJobCompletendvi5(jobinfo){
		//construct the result map service url using the id from jobinfo we'll add a new layer to the map
		var mapurl = mapserviceurlndvi1 + "/" + jobinfo.jobId;
		ndvi5 = new ArcGISDynamicMapServiceLayer(mapurl,{"id":"ndvi5", "opacity": 0.5});
		//add the hotspot layer to the map
		map.addLayers([ndvi5]);
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
	

	

	
	$('#customLOD').change (function () {
		window.location.replace("../php/webgisLeer.php");
	})
	
	
	
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
		/*getndvi1: getndvi1,
		getndvi2: getndvi2,
		getndvi3: getndvi3,
		getndvi4: getndvi4,
		getndvi5: getndvi5*/
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
		map.centerAndZoom([-80.416725, 43.937263],13);
		lutherbog_elevation.show();
	}
	else{
		lutherbog_elevation.hide();
	}
});

$('#ortho_tiles').change(function(){
	if($('#ortho_tiles').is(':checked') == true){
		map.centerAndZoom([-80.416725, 43.937263],13);
		lutherbog_ortho_tiles.show();
	}
	else{
		lutherbog_ortho_tiles.hide();
	}
});

$('#ortho_merged').change(function(){
	if($('#ortho_merged').is(':checked') == true){
		map.centerAndZoom([-80.416725, 43.937263],13);
		lutherbog_ortho_merged.show();
	}
	else{
		lutherbog_ortho_merged.hide();
	}
});

$('#ortho_uav').change(function(){
	if($('#ortho_uav').is(':checked') == true){
		map.centerAndZoom([-80.416725, 43.937263],13);
		lutherbog_uav_merged.show();
	}
	else{
		lutherbog_uav_merged.hide();
	}
});

$('#uas_flight').change(function(){
	if($('#uas_flight').is(':checked') == true){
		map.centerAndZoom([-80.405860, 43.919791],16);
		lutherbog_alle_flights.show();
	}
	else{
		lutherbog_alle_flights.hide();
	}
});

$('#flug1').change(function(){
	if($('#flug1').is(':checked') == true){
		map.centerAndZoom([-80.405970, 43.918175],17);
		lutherbog_flight1.show();
	}
	else{
		lutherbog_flight1.hide();
	}
});

$('#flug2').change(function(){
	if($('#flug2').is(':checked') == true){
		map.centerAndZoom([-80.405860, 43.920038],17);
		lutherbog_flight2.show();
	}
	else{
		lutherbog_flight2.hide();
	}
});

$('#flug3').change(function(){
	if($('#flug3').is(':checked') == true){
		map.centerAndZoom([-80.407212, 43.921120],17);
		lutherbog_flight3.show();
	}
	else{
		lutherbog_flight3.hide();
	}
});

$('#flug4').change(function(){
	if($('#flug4').is(':checked') == true){
		map.centerAndZoom([-80.406954, 43.920687],17);
		lutherbog_flight4.show();
	}
	else{
		lutherbog_flight4.hide();
	}
});

$('#flug5').change(function(){
	if($('#flug5').is(':checked') == true){
		map.centerAndZoom([-80.404787, 43.917890],17);
		lutherbog_flight5.show();
	}
	else{
		lutherbog_flight5.hide();
	}
});

$('#uas_ndvi').change(function(){
	if($('#uas_ndvi').is(':checked') == true){
		map.centerAndZoom([-80.405860, 43.919791],16);
		lutherbog_ndviAll.show();
		myWindow = window.open("../LegendeNDVI.html", "myWindow", "top=680, left=1490, width=220, height=370");
	}
	else{
		lutherbog_ndviAll.hide();
		myWindow.close();
	}
});
$('#ndvi1').change(function(){
	if($('#ndvi1').is(':checked') == true){
		map.centerAndZoom([-80.405970, 43.918175],17);
		lutherbog_ndvi2.show();
		myWindow1 = window.open("../LegendeNDVI.html", "myWindow1", "top=680, left=1490, width=220, height=370");
		
	}
	else{
		lutherbog_ndvi2.hide();
		myWindow1.close();
	}
});
$('#ndvi2').change(function(){
	if($('#ndvi2').is(':checked') == true){
		map.centerAndZoom([-80.405860, 43.920038],17);
		lutherbog_ndvi1.show();
		myWindow2 = window.open("../LegendeNDVI.html", "myWindow2", "top=680, left=1490, width=220, height=370");
	}
	else{
		lutherbog_ndvi1.hide();
		myWindow2.close();
	}
});
$('#ndvi3').change(function(){
	if($('#ndvi3').is(':checked') == true){
		map.centerAndZoom([-80.407212, 43.921120],17);
		lutherbog_ndvi3.show();
		myWindow3 = window.open("../LegendeNDVI.html", "myWindow3", "top=680, left=1490, width=220, height=370");
	}
	else{
		lutherbog_ndvi3.hide();
		myWindow3.close();
	}
});
$('#ndvi4').change(function(){
	if($('#ndvi4').is(':checked') == true){
		map.centerAndZoom([-80.406954, 43.920687],17);
		lutherbog_ndvi4.show();
		myWindow4 = window.open("../LegendeNDVI.html", "myWindow4", "top=680, left=1490, width=220, height=370");
	}
	else{
		lutherbog_ndvi4.hide();
		myWindow4.close();
	}
});
$('#ndvi5').change(function(){
	if($('#ndvi5').is(':checked') == true){
		map.centerAndZoom([-80.404787, 43.917890],17);
		lutherbog_ndvi5.show();
		myWindow5 = window.open("../LegendeNDVI.html", "myWindow5", "top=680, left=1490, width=220, height=370");
	}
	else{
		lutherbog_ndvi5.hide();
		myWindow5.close();
	}
});

$('#SiteAlleMitRaster').change(function(){
	if($('#SiteAlleMitRaster').is(':checked') == true){
		map.centerAndZoom([-80.406144, 43.919796],16);
		lutherbog_siteAll.show();
	}
	else{
		lutherbog_siteAll.hide();
	}
});
$('#site1').change(function(){
	if($('#site1').is(':checked') == true){
		map.centerAndZoom([-80.404000, 43.916949],19);
		lutherbog_site1.show();
	}
	else{
		lutherbog_site1.hide();
	}
});

$('#site2').change(function(){
	if($('#site2').is(':checked') == true){
		map.centerAndZoom([-80.405601, 43.919110],19);
		lutherbog_site2.show();
	}
	else{
		lutherbog_site2.hide();
	}
});

$('#site3').change(function(){
	if($('#site3').is(':checked') == true){
		map.centerAndZoom([-80.406924, 43.920466],19);
		lutherbog_site3.show();
	}
	else{
		lutherbog_site3.hide();
	}
});

$('#site4').change(function(){
	if($('#site4').is(':checked') == true){
		map.centerAndZoom([-80.408264, 43.922290],19);
		lutherbog_site4.show();
	}
	else{
		lutherbog_site4.hide();
	}
});

$('#site1Kl').change(function(){
	if($('#site1Kl').is(':checked') == true){
		map.centerAndZoom([-80.404000, 43.916949],19);
		lutherbog_site1Kl.show();
	}
	else{
		lutherbog_site1Kl.hide();
	}
});

$('#site2Kl').change(function(){
	if($('#site2Kl').is(':checked') == true){
		map.centerAndZoom([-80.405601, 43.919110],19);
		lutherbog_site2Kl.show();
	}
	else{
		lutherbog_site2Kl.hide();
	}
});

$('#site3Kl').change(function(){
	if($('#site3Kl').is(':checked') == true){
		map.centerAndZoom([-80.406924, 43.920466],19);
		lutherbog_site3Kl.show();
	}
	else{
		lutherbog_site3Kl.hide();
	}
});

$('#site4Kl').change(function(){
	if($('#site4Kl').is(':checked') == true){
		map.centerAndZoom([-80.408264, 43.922290],19);
		lutherbog_site4Kl.show();
	}
	else{
		lutherbog_site4Kl.hide();
	}
});


$('#flooded_area_part').change(function(){
	if($('#flooded_area_part').is(':checked') == true){
		map.centerAndZoom([-80.416725, 43.937263],13);
		part_flooded.show();
	}
	else{
		part_flooded.hide();
	}
});

$('#flooded_area').change(function(){
	if($('#flooded_area').is(':checked') == true){
		map.centerAndZoom([-80.416725, 43.937263],13);
		flooded_area.show();
	}
	else{
		flooded_area.hide();
	}
});

$('#isolines').change(function(){
	if($('#isolines').is(':checked') == true){
		map.centerAndZoom([-80.416725, 43.937263],13);
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

$('#process-ndvi1-button').click(function(){
	app.getNDVI1();
});

$('#process-ndvi2d-button').click(function(){
	app.getNDVI2();
});

$('#process-ndvi3-button').click(function(){
	app.getNDVI3();
});

$('#process-ndvi4-button').click(function(){
	app.getNDVI4();
});

$('#process-ndvi5-button').click(function(){
	app.getNDVI5();
});


	function cleanup(layer){
		var removeLayer = map.getLayer(layer);
		if(removeLayer){
			map.removeLayer(removeLayer);
		}
		myWindow.close();
		myWindow1close();
		myWindow2.close();
		myWindow3.close();
		myWindow4.close();
		myWindow5.close();
	}

function popup(url,name,size) 
{ 
window.open(url,name,size); 
}


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
