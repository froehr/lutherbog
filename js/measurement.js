 var map;
    require([
        "dojo/dom",
        "esri/Color",
        "dojo/keys",
        "dojo/parser",

        "esri/config",
        "esri/sniff",
        "esri/map",
        "esri/SnappingManager",
        "esri/dijit/Measurement",
        "esri/layers/FeatureLayer",
        "esri/renderers/SimpleRenderer",
        "esri/tasks/GeometryService",
        "esri/symbols/SimpleLineSymbol",
        "esri/symbols/SimpleFillSymbol",

        "esri/dijit/Scalebar",
        "dijit/layout/BorderContainer",
        "dijit/layout/ContentPane",
        "dijit/TitlePane",
        "dijit/form/CheckBox", 
        "dojo/domReady!"
      ], function(
        dom, Color, keys, parser, 
        esriConfig, has, Map, SnappingManager, Measurement, FeatureLayer, SimpleRenderer, GeometryService, SimpleLineSymbol, SimpleFillSymbol
      ) {
        parser.parse();
        
        map 

        var sfs = new SimpleFillSymbol(
          "solid",
          new SimpleLineSymbol("solid", new Color([195, 176, 23]), 2), 
          null
        );

        var parcelsLayer = new FeatureLayer("osm", {
          mode: FeatureLayer.MODE_ONDEMAND,
          outFields: ["*"]
        });
        parcelsLayer.setRenderer(new SimpleRenderer(sfs));
        /*map.addLayers([parcelsLayer]);*/

        //dojo.keys.copyKey maps to CTRL on windows and Cmd on Mac., but has wrong code for Chrome on Mac
        var snapManager = map.enableSnapping({
          snapKey: has("mac") ? keys.META : keys.CTRL
        });
        var layerInfos = [{
          layer: parcelsLayer
        }];
        snapManager.setLayerInfos(layerInfos);

        var measurement = new Measurement({
          map: map
		
        }, dom.byId("measurementDiv"));
        measurement.startup();
      });
 