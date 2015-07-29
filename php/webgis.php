<?php
session_start();
$_SESSION['page'] = 'map';
include 'process/granted.php';


if (isset($_GET['site'])) {
	echo '<input type="hidden" id="AcessSideID" value='. $_GET['site'];
}
else{
	echo '<input type="hidden" id="AccesSideID" value="0"';
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<?php
			include 'head.php';
		?>
		
		<link rel="stylesheet" href="http://js.arcgis.com/3.10/js/esri/css/esri.css">
		<link rel="stylesheet" href="http://js.arcgis.com/3.10/js/dojo/dijit/themes/claro/claro.css"> 
		<link rel="stylesheet" href="http://js.arcgis.com/3.14/dijit/themes/claro/claro.css">
		<link rel="stylesheet" href="http://js.arcgis.com/3.14/esri/css/esri.css">

		<script src="http://js.arcgis.com/3.14/"></script>
	</head>
	
	<body class="claro">
		<div id="map">
			<div id="HomeButton"></div>
			<div id="map-submitted" class="map-processing"><img src="../img/map/submitted.png" width="200" height="200"></div>
			<div id="map-loading" class="map-processing"><img src="../img/map/loading.gif" width="200" height="200"></div>
			<div id="map-success" class="map-processing"><img src="../img/map/success.png" width="200" height="200"></div>
			<div id="map-error" class="map-processing"><img src="../img/map/error.png" width="200" height="200"></div>
			<div id="map-wrongIP" class="map-processing"><img src="../img/map/wrongIP.png" width="200" height="200"></div>
			<div id="BasemapFrame">
				<div data-dojo-type="dijit/TitlePane" data-dojo-props="title:'Switch Basemap', closable:false, open:false">
					<div data-dojo-type="dijit/layout/ContentPane" style="width:380px; height:280px; overflow:auto;">
						<div id="basemapGallery"></div>
					</div>
				</div>
			</div>
			
			<div id="Measurement">
				<div data-dojo-type="dijit/TitlePane" data-dojo-props="title:'Measurement', closable:false, open:false">
					<div data-dojo-type="dijit/layout/ContentPane" style="width:380px; height:200px; overflow:auto;">
						<div id="measurementDiv"></div>
						<span style="font-size:smaller;padding:5px 5px;">Press <b>CTRL</b> to enable snapping.</span>
					</div>
				</div>
			</div>
		</div>
		
		

		
		<div id="mapdetails">
				<div id="layerList">
					<h3>Verfügbare Layer:</h3>
					<input type='checkbox' id='sites' value=0 /> Sites </br>
					<input type='checkbox' id='hoehe' value=0 /> Höhenmodel </br>
					<input type="range" id="hoehe_opacity" min="0" max="1" step="0.01"> <input type="text" id="hoehe_opacity_value" size = "4" value = "50%" readonly> </br>
					
					<input type='checkbox' id='isolines' value=0 /> Höhenlinien </br>
					<input type="range" id="isolines_difference" min=".1" max="5" step="0.01"> <input type="text" id="isolines_difference_value" size = "4" value = "2.55m" readonly> </br>
					<div class="submit-button" id="process-isolines-button">
                                <p>Prozess starten</p>
                         </div></br></br>
					
					<input type='checkbox' id='ortho_tiles' value=1 /> Luftbilder Tiles 2006</br>
					<input type="range" id="ortho_tiles_opacity" min="0" max="1" step="0.01"> <input type="text" id="ortho_tiles_opacity_value" size = "4" value = "50%" readonly></br>
					<input type='checkbox' id='ortho_merged' value=1 /> Luftbilder Merged 2006</br>
					<input type="range" id="ortho_merged_opacity" min="0" max="1" step="0.01"> <input type="text" id="ortho_merged_opacity_value" size = "4" value = "50%" readonly></br>
					<input type='checkbox' id='ortho_uav' value=1 /> IfGi UAV Luftbilder 2013</br>
					<input type="range" id="ortho_uav_opacity" min="0" max="1" step="0.01"> <input type="text" id="ortho_uav_opacity_value" size = "4" value = "50%" readonly></br></br>
					
					<input type='checkbox' id='flooded_area_part' value=1 /> Überflutete Teilgebiete</br>
					<input type="range" id="flooded_area_gauge_part" min="480" max="494" step="0.01"> <input type="text" id="flooded_area_gauge_value_part" size = "4" value = "487m" readonly></br>
					<input type="range" id="flooded_area_opacity_part" min="0" max="1" step="0.01"> <input type="text" id="flooded_area_opacity_value_part" size = "4" value = "50%" readonly></br>
					<div class="submit-button" id="process-flooded-part-button">
                                <p>Prozess starten</p>
                         </div></br>
					
					<input type='checkbox' id='flooded_area' value=1 /> Überflutete Gebiete</br>
					<input type="range" id="flooded_area_gauge" min="460" max="500" step="0.01"> <input type="text" id="flooded_area_gauge_value" size = "4" value = "480m" readonly></br>
					<input type="range" id="flooded_area_opacity" min="0" max="1" step="0.01"> <input type="text" id="flooded_area_opacity_value" size = "4" value = "50%" readonly></br>
					
					<div class="submit-button" id="process-flooded-button">
                                <p>Prozess starten</p>
                         </div>
				</div>
			</div> 
		
		<div id="page">
			<header>
                    <a href="http://www.uni-muenster.de/Landschaftsoekologie/"><img src="../img/iloek_logo.png"></a>
			     <a href="../index.php"><h1>LUTHERbog WebGIS</h1></a>
				<nav>
					<ul>
						<li><a href="process/logout.php" class="header-buttons" id="logout">Ausloggen</a></li>
						<li><a href="upload.php" class="header-buttons" id="upload">Daten hinzuf&uuml;gen</a></li>
						<li><a href="access.php" class="header-buttons" id="access">Daten einsehen</a></li>
					</ul>
				</nav>
			</header>
			
			<div id="logout-content">
				<form action="#" method="post">
					<h1>Sie sind angemeldet als:</h1>
					<p><?php echo $_SESSION['vorname']." ".$_SESSION['nachname']; ?></p>
					<p><?php echo $_SESSION['email']?></p>
				</form>
			</div>
			
			<div id='impressum-content'>
				<h1>Impressum</h1>
				<p>Diese Website ist im Zuge der Bachelorarbeit von Fabian Röhr entstanden.</p>
				<p>Die verarbeiteten Daten wurden von der Arbeitsgruppe Hydrologie, die von Prof. Dr. Blodau geleitet wird, gesammelt und zur Verfügung gestellt.</p>	
			</div>
                        
               <footer>
                    <a href="http://www.uni-muenster.de/HydrologieBodenkunde/LUTHERbog.html" id="projectinfo">Projektinfomationen</a>
				<a href="help.php" id="help">Hilfe</a>
				<a href="#" id="impressum">Impressum</a>
			</footer>
		</div>
		<script src="../js/login.js"></script>
		<script src="../js/map.js"></script>
		<script src="../js/userinterface.js"></script>
	</body>
</html>