dojo.provide("utilities.app");
dojo.require("dojo.colors");
dojo.require("esri.widgets");
dojo.require("esri.arcgis.utils");
dojo.require("apl.ElevationsSOEUtils");
dojo.require("utilities.AppConfigUtils");

var map;
var measure;
var elevationsSOEUtils = null;
var defaults = null;
function init() {
    defaults = {
        webmap: "c4201eb104cf45139f1cc3859b25a2e8",
        appid: "",
        helperServices: {
            geometry: {
                url: document.location.protocol + "//utility.arcgisonline.com/arcgis/rest/services/Geometry/GeometryServer"
            }
        },
        bingmapskey: "",
        proxy: "",
        sharingurl: "http://www.arcgis.com",
        
        
    };

    dojo.connect(dojo.byId("uploadForm").data, "onchange", function (evt) {
        var fileName = evt.target.value.toLowerCase();
        if (dojo.isIE) { //filename is full path in IE so extract the file name
            var arr = fileName.split("\\");
            fileName = arr[arr.length - 1];
        }
        if (fileName.indexOf(".gpx") !== -1) {
            generateFeatureCollection(fileName);
        } else {
            dojo.byId('upload-status').innerHTML = '<p style="color:red">Aggiugere file gpx</p>';
        }
    });
	

}

function generateFeatureCollection(fileName) {
    var name = fileName.split(".");
    //Chrome and IE add c:\fakepath to the value - we need to remove it
    //See this link for more info: http://davidwalsh.name/fakepath
    name = name[0].replace("c:\\fakepath\\", "");

    dojo.byId('upload-status').innerHTML = '<b>Loading ... </b>' + name;

    //Define the input params for generate see the rest doc for details
    //http://www.arcgis.com/apidocs/rest/index.html?generate.html
    var params = {
        'name': name,
        'targetSR': map.spatialReference,
        'maxRecordCount': 1000,
        'enforceInputFileSizeLimit': true,
        'enforceOutputJsonSizeLimit': true
    };

    //generalize features for display Here we generalize at 1:40,000 which is approx 10 meters
    //This should work well when using web mercator.
    var extent = esri.geometry.getExtentForScale(map, 40000);
    var resolution = extent.getWidth() / map.width;
    params.generalize = true;
    params.maxAllowableOffset = resolution;
    params.reducePrecision = true;
    params.numberOfDigitsAfterDecimal = 0;

    var myContent = {
        'filetype': 'gpx',
        'publishParameters': dojo.toJson(params),
        'f': 'json',
        'callback.html': 'textarea'
    };

    //use the rest generate operation to generate a feature collection from the gpx
    esri.request({
        url: defaults.sharingurl + '/sharing/rest/content/features/generate',
        content: myContent,
        form: dojo.byId('uploadForm'),
        handleAs: 'json',
        load: dojo.hitch(this, function (response) {
            if (response.error) {
                errorHandler(response.error);
                return;
            }
            dojo.byId('upload-status').innerHTML = '<b>Loaded: </b>' + response.featureCollection.layers[0].layerDefinition.name;

            var layer = new esri.layers.FeatureLayer(response.featureCollection.layers[0]);
            changeRenderer(layer);
            map.addLayer(layer);
            map.setExtent(layer.fullExtent.expand(1.25), true);
            dojo.byId('upload-status').innerHTML = "";
            var grp = layer.graphics[0];
    }),
        error: dojo.hitch(this, errorHandler)
    });
}

function changeRenderer(layer) {
    //change the default symbol for the feature collection for polygons and points
    var symbol = null;
    switch (layer.geometryType) {
        case 'esriGeometryPoint':
            symbol = new esri.symbol.PictureMarkerSymbol({
                'angle': 0,
                'xoffset': 0,
                'yoffset': 0,
                'type': 'esriPMS',
                'url': 'http://static.arcgis.com/images/Symbols/Shapes/BluePin1LargeB.png',
                'contentType': 'image/png',
                'width': 20,
                'height': 20
            });
            break;
        case 'esriGeometryPolygon':
            symbol = new esri.symbol.SimpleFillSymbol(esri.symbol.SimpleFillSymbol.STYLE_SOLID, new esri.symbol.SimpleLineSymbol(esri.symbol.SimpleLineSymbol.STYLE_SOLID, new dojo.Color([112, 112, 112]), 1), new dojo.Color([136, 136, 136, 0.25]));
            break;
    }
    if (symbol) {
        layer.setRenderer(new esri.renderer.SimpleRenderer(symbol));
    }
}

function errorHandler(error) {
    dojo.byId('upload-status').innerHTML = "<p style='color:red'>" + error.message + "</p>";
}

function initMap(options) {
    console.log(options);
    esri.arcgis.utils.createMap(options.webmap, 'map', {
        mapOptions: {
            sliderStyle: "small"
        },
        bingMapsKey: options.bingmapskey || ""
    }).then(dojo.hitch(this, function (response) {
        map = response.map;
        // TITLE //
        //if (response.itemInfo.item.title !== null) {
        //    dojo.byId('title').innerHTML = response.itemInfo.item.title;
        //}
        // SNIPPET //
        //if (response.itemInfo.item.snippet !== null) {
        //    dojo.byId('snippet').innerHTML = response.itemInfo.item.snippet;
        //}
        // DESCRIPTION //
        //            if (response.itemInfo.item.description !== null) {
        //                var descriptionPane = new dijit.layout.ContentPane({
        //                    region: 'top',
        //                    innerHTML: response.itemInfo.item.description,
        //                    style: "max-height:50%;"
        //                }, dojo.create('div'));
        //                dijit.byId('infoContainer').addChild(descriptionPane);
        //            }

        if (map.loaded) {
            this.initUI(options, response);
        } else {
            dojo.connect(map, "onLoad", dojo.hitch(this, function () {
                this.initUI(options, response);
            }));
        }

    }), dojo.hitch(this, function (err) {
        console.log("Error creating map", err);
    }));
}




