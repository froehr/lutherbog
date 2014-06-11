<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<title>LUTHERbog Canada</title>
		<link href="../css/style.css" rel="stylesheet" type="text/css" />
		<link href="../js/lib/jquery/jquery-ui-1.10.4.css" rel="stylesheet" type="text/css" />
		<link href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" rel="stylesheet" type="text/css" />
		<link href="../js/lib/Leaflet.locator/L.Control.Locate.css" rel="stylesheet" type="text/css" />
		<link href="../js/lib/Leaflet.minimap/Control.MiniMap.css" rel="stylesheet" type="text/css" />
		<link href="../js/lib/Leaflet.geosearch/l.geosearch.css" rel="stylesheet" type="text/css" />
		<link href="../js/lib/Leaflet.coordinates/Control.Coordinates.css" rel="stylesheet" type="text/css" />
		<link href="../js/lib/Leaflet.coordinates/Control.Coordinates.ie.css" rel="stylesheet" type="text/css" />
		<link href="../js/lib/Leaflet.locationfilter/locationfilter.css" rel="stylesheet" type="text/css" />
		<link href="../js/lib/Leaflet.markercluster/MarkerCluster.css" rel="stylesheet" type="text/css" />
		<link href="../js/lib/Leaflet.markercluster/MarkerCluster.Default.css" rel="stylesheet" type="text/css" />
		<link href="../js/lib/Leaflet.draw/leaflet.draw.css" rel="stylesheet" type="text/css" />
		<link href="../js/lib/Leaflet.measureControl/leaflet.measurecontrol.css" rel="stylesheet" type="text/css" />
		<link href="../js/lib/Leaflet.fusesearch/leaflet.fusesearch.css" rel="stylesheet" type="text/css" />	
		<link href="../js/lib/introJS/themes/introjs-nassim.css" rel="stylesheet" type="text/css" >
		
		<script src="../js/lib/jquery/jquery-2.1.0.min.js"></script>
		<script src="../js/lib/jquery/jquery-ui-1.10.4.js"></script>
		<!-- Leaflet version 0.7.3 -->
		<script src="../js/lib/Leaflet/leaflet.js"></script>
		<script src="../js/lib/Leaflet.minimap/Control.MiniMap.js"></script>
		<script src="../js/lib/Leaflet.geosearch/l.control.geosearch.js"></script>
		<script src="../js/lib/Leaflet.geosearch/l.geosearch.provider.google.js"></script>
		<script src="../js/lib/Leaflet.locator/L.Control.Locate.js"></script>
		<script src="../js/lib/Leaflet.groupedlayercontrol/leaflet.groupedlayercontrol.js"></script>
		<script src="../js/lib/Leaflet.coordinates/Control.Coordinates.js"></script>
		<script src="../js/lib/Leaflet.locationfilter/locationfilter.js"></script>
		<script src="../js/lib/Leaflet.slidercontrol/SliderControl.js"></script>
		<script src="../js/lib/Leaflet.markercluster/leaflet.markercluster-src.js"></script>
		<script src="../js/lib/Leaflet.draw/leaflet.draw.js"></script>
		<script src="../js/lib/Leaflet.measureControl/leaflet.measurecontrol.js"></script>
		<script src="../js/lib/Leaflet.fusesearch/fuse.js"></script>
		<script src="../js/lib/Leaflet.fusesearch/leaflet.fusesearch.js"></script>
		<script src="../js/lib/Leaflet.layerjson/leaflet.layerjson.js"></script>	
		<script src="../js/lib/introJS/intro.js"></script>
	
	</head>
	<body>
		<div id="page">
			<header>
                            <a href='http://www.uni-muenster.de/Landschaftsoekologie/'><img src=../img/iloek_logo.png></a>
                            <a href='../index.php'><h1>LUTHERbog WebGIS</h1></a>
				<nav>
					<ul>
						<li><a href="../index.php" class="header-buttons" id="login">Ausloggen</a></li>
						<li><a href="upload.php" class="header-buttons" id="upload">Daten hinzuf&uuml;gen</a></li>
					</ul>
				</nav>
			</header>
			
			<div id='map'></div>
			<div id='mapcontrol'></div>
			<div id='impressum-content'>
				<h1>Impressum</h1>
				<p>Diese Website ist im Zuge der Bachelorarbeit von Fabian R&ouml;hr entstanden.</p>
				<p>Die verarbeiteten Daten wurden von der Arbeitsgruppe Hydrologie, die von Prof. Dr. Blodau geleitet wird, gesammelt und zur Verf&uuml;gung gestellt.</p>	
			</div>
                        
                        <footer>
                                <a href="http://www.uni-muenster.de/HydrologieBodenkunde/LUTHERbog.html" id="projectinfo">Projektinfomationen</a>
				<a href="#" id="help">Hilfe</a>
				<a href="#" id="impressum">Impressum</a>
			</footer>
		
		<script src="../js/map.js"></script>
		<script src="../js/userinterface.js"></script>
                
	</body>
</html>