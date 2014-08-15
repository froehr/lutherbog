var map;
var lutherbog_elevation, lutherbog_ortho_tiles, flooded_area; 

require([
	'esri/map',
	
	'esri/layers/ArcGISDynamicMapServiceLayer',
        'esri/layers/ImageParameters',
	'esri/layers/FeatureLayer',
	'esri/graphic',
	'esri/tasks/Geoprocessor',
        'esri/domUtils',
	
	'esri/dijit/Legend',
	'esri/dijit/HomeButton',
	'esri/dijit/Scalebar',
	'esri/dijit/OverviewMap',
	'esri/dijit/BasemapGallery',
	
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
	domUtils,
	
	Legend,
	HomeButton,
	Scalebar,
	OverviewMap,
	BasemapGallery,
	
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
	
        lutherbog_elevation = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/lutherbog_elevation/MapServer", {});
	lutherbog_ortho_tiles = new ArcGISDynamicMapServiceLayer("http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/Luther_Marsch_Orthofotos_2006/MapServer", {});
	
        map.addLayer(lutherbog_elevation);
	lutherbog_elevation.hide();
	map.addLayer(lutherbog_ortho_tiles);
	lutherbog_ortho_tiles.hide();
	
	// Geoprocessing flooded areas
	var gpServiceUrl= "http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/extract_flooded_areas/GPServer/flooded_areas";
        var mapserviceurl= "http://geo-arcgis.uni-muenster.de:6080/arcgis/rest/services/LutherBog/extract_flooded_areas/MapServer/jobs/";
	var legend;

	function getFlooded(){
		$('#flooded_area').prop('checked', true);
		var gp = new Geoprocessor(gpServiceUrl);
		var params = {
			SQL_Expression: buildDefinitionQuery()
		};
		//cleanup any results from previous runs
		cleanup();
		gp.submitJob(params, gpJobComplete, gpJobStatus, gpJobFailed);
        }
	
	function gpJobComplete(jobinfo){
		//construct the result map service url using the id from jobinfo we'll add a new layer to the map
		var mapurl = mapserviceurl + "/" + jobinfo.jobId;
		flooded_area = new ArcGISDynamicMapServiceLayer(mapurl,{
			"id":"HotspotLayer",
			"opacity": 0.7
		});
		//add the hotspot layer to the map
		map.addLayers([flooded_area]);
	}      
	
	function gpJobStatus(jobinfo){
		domUtils.show(dom.byId('GPStatus'));
		var jobstatus = '';
		switch (jobinfo.jobStatus) {
			case 'esriJobSubmitted':
				jobstatus = 'Submitted...';
			break;
			case 'esriJobExecuting':
				jobstatus = 'Executing...';
			break;
			case 'esriJobSucceeded':
				jobstatus = 'Success...';
				setTimeout(function() {
					domUtils.hide(dom.byId('GPStatus'));
				}, 1500);
				
			break;
			}
		
		dom.byId('GPStatus').innerHTML = jobstatus;
	}
	
	function buildDefinitionQuery(){
		var defQuery;
		//get input info from form and build definition expression
		defQuery = "Value < " + $('#flooded_area_gauge').val();
		defQuery = defQuery.replace('.',',');
		return defQuery;
	}
	
	function gpJobFailed(error){
		dom.byId('GPStatus').innerHTML = error;
		domUtils.hide(dom.byId('GPStatus'));
	}
	
	function cleanup(){
		//hide the legend and remove the existing hotspot layer
		domUtils.hide(dom.byId('legendDiv'));
		var hotspotLayer = map.getLayer('HotspotLayer');
		if(hotspotLayer){
			map.removeLayer(hotspotLayer);
		}
	}
	
	app = {
		getFlooded: getFlooded
	};
	return app;
});

$('#hoehe_opacity').change(function (){
	lutherbog_elevation.setOpacity($('#hoehe_opacity').val());
	$('#hoehe_opacity_value').val(($('#hoehe_opacity').val()*100) + "%");
	
});

$('#ortho_tiles_opacity').change(function (){
	lutherbog_ortho_tiles.setOpacity($('#ortho_tiles_opacity').val());
	$('#ortho_tiles_opacity_value').val(($('#ortho_tiles_opacity').val()*100) + "%");
});

$('#flooded_area_opacity').change(function (){
	flooded_area.setOpacity($('#flooded_area_opacity').val());
	$('#flooded_area_opacity_value').val(($('#flooded_area_opacity').val()*100) + "%");
});

$('#flooded_area_gauge').change(function (){
	$('#flooded_area_gauge_value').val($('#flooded_area_gauge').val() + "m");
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

$('#flooded_area').change(function(){
	if($('#flooded_area').is(':checked') == true){
		flooded_area.show();
	}
	else{
		flooded_area.hide();
	}
});




