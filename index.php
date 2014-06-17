<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<title>LUTHERbog Canada</title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<link href="js/lib/jquery/jquery-ui-1.10.4.css" rel="stylesheet" type="text/css" />
		<link href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" rel="stylesheet" type="text/css" />
		<link href="js/lib/Leaflet.locator/L.Control.Locate.css" rel="stylesheet" type="text/css" />
		<link href="js/lib/Leaflet.minimap/Control.MiniMap.css" rel="stylesheet" type="text/css" />
		<link href="js/lib/Leaflet.geosearch/l.geosearch.css" rel="stylesheet" type="text/css" />
		<link href="js/lib/Leaflet.coordinates/Control.Coordinates.css" rel="stylesheet" type="text/css" />
		<link href="js/lib/Leaflet.coordinates/Control.Coordinates.ie.css" rel="stylesheet" type="text/css" />
		<link href="js/lib/Leaflet.locationfilter/locationfilter.css" rel="stylesheet" type="text/css" />
		<link href="js/lib/Leaflet.markercluster/MarkerCluster.css" rel="stylesheet" type="text/css" />
		<link href="js/lib/Leaflet.markercluster/MarkerCluster.Default.css" rel="stylesheet" type="text/css" />
		<link href="js/lib/Leaflet.draw/leaflet.draw.css" rel="stylesheet" type="text/css" />
		<link href="js/lib/Leaflet.measureControl/leaflet.measurecontrol.css" rel="stylesheet" type="text/css" />
		<link href="js/lib/Leaflet.fusesearch/leaflet.fusesearch.css" rel="stylesheet" type="text/css" />	
		<link href="js/lib/introJS/themes/introjs-nassim.css" rel="stylesheet" type="text/css" >
		
		<script src="js/lib/jquery/jquery-2.1.0.min.js"></script>
		<script src="js/lib/jquery/jquery-ui-1.10.4.js"></script>
		<!-- Leaflet version 0.7.3 -->
		<script src="js/lib/Leaflet/leaflet.js"></script>
		<script src="js/lib/Leaflet.minimap/Control.MiniMap.js"></script>
		<script src="js/lib/Leaflet.geosearch/l.control.geosearch.js"></script>
		<script src="js/lib/Leaflet.geosearch/l.geosearch.provider.google.js"></script>
		<script src="js/lib/Leaflet.locator/L.Control.Locate.js"></script>
		<script src="js/lib/Leaflet.groupedlayercontrol/leaflet.groupedlayercontrol.js"></script>
		<script src="js/lib/Leaflet.coordinates/Control.Coordinates.js"></script>
		<script src="js/lib/Leaflet.locationfilter/locationfilter.js"></script>
		<script src="js/lib/Leaflet.slidercontrol/SliderControl.js"></script>
		<script src="js/lib/Leaflet.markercluster/leaflet.markercluster-src.js"></script>
		<script src="js/lib/Leaflet.draw/leaflet.draw.js"></script>
		<script src="js/lib/Leaflet.measureControl/leaflet.measurecontrol.js"></script>
		<script src="js/lib/Leaflet.fusesearch/fuse.js"></script>
		<script src="js/lib/Leaflet.fusesearch/leaflet.fusesearch.js"></script>
		<script src="js/lib/Leaflet.layerjson/leaflet.layerjson.js"></script>	
		<script src="js/lib/introJS/intro.js"></script>
		<?php
			include 'php/login.php';
		?>
	</head>
	<body>
		<div id="page">
			<header>
                            <a href='http://www.uni-muenster.de/Landschaftsoekologie/'><img src=img/iloek_logo.png></a>
                            <a href='#'><h1>LUTHERbog WebGIS</h1></a>
				<nav>
					<ul>
						<li><a href="#" class="header-buttons" id="login">Einloggen</a></li>
						<li><a href=php/logout.php class="header-buttons" id="logout">Ausloggen</a></li>
						<li><a href=php/administration.php class="header-buttons" id="admin">Administration</a></li>
						<li><a href="php/webgis.php" class="header-buttons" id="webgis">WebGIS</a></li>
						<li><a href="http://www.uni-muenster.de/HydrologieBodenkunde/LUTHERbog.html" class="header-buttons" id="project" target="_blank">Das Projekt</a></li>
					</ul>
				</nav>
			</header>
			<div id="login-content">
				<form action="#" method="post">
					<h1>Benutzername</h1>
					<input type="text" name="username" id="username" required/>
					<h1>Passwort</h1>
					<input type="password" name="password" id="password" required/>
					<div class="submit"><input type="submit" value="Login &nbsp; &#9658;" id="submit" /></div>
				</form>
			</div>
			
			<div id="switch">
				<ul>
					<li id="viewuser"><h1>Die Karte</h1></li>
					<li id="changeuser"><h1>Messungen zeigen</h1></li>
					<li id="adduser"><h1>Messungen &auml;ndern</h1></li>
					<li id="adduser"><h1>Messungen verarbeiten</h1></li>
					<li id="adduser"><h1>Administration</h1></li>
				</ul>
			</div>
			
			<div id="logout-content">
				<form action="#" method="post">
					<h1>Sie sind angemeldet als:</h1>
					<p><?php echo $_SESSION['vorname']." ".$_SESSION['nachname']; ?></p>
				</form>
			</div>
			
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
		</div>
		
		<script src="js/userinterface.js"></script>
		
		<?php
			if(isset($_SESSION['user'])){
				echo '<script src="js/login.js"></script>';
			}
		?>
	</body>
</html>