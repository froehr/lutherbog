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
		
		<!--<link rel="stylesheet" href="http://js.arcgis.com/3.10/js/esri/css/esri.css">
		<link rel="stylesheet" href="http://js.arcgis.com/3.10/js/dojo/dijit/themes/claro/claro.css">-->
		<link rel="stylesheet" href="http://js.arcgis.com/3.14/dijit/themes/claro/claro.css">
		<link rel="stylesheet" href="http://js.arcgis.com/3.14/esri/css/esri.css">

		<!--<script src="http://js.arcgis.com/3.10/"></script>-->
		<script src="http://js.arcgis.com/3.14/"></script>

		<script>dojoConfig = {async: true, parseOnLoad: false}</script>
		<script src="//ajax.googleapis.com/ajax/libs/dojo/1.10.4/dojo/dojo.js"></script>
				
	</head>
	
	<body class="claro">
		
		<div id="map">
			<div id="HomeButton"></div>
			<div id="map-submitted" class="map-processing"><img src="../img/map/submitted.png" width="200" height="200"></div>
			<div id="map-loading" class="map-processing"><img src="../img/map/loading.gif" width="200" height="200"></div>
			<div id="map-success" class="map-processing"><img src="../img/map/success.png" width="200" height="200"></div>
			<div id="map-error" class="map-processing"><img src="../img/map/error.png" width="200" height="200"></div>
			<div id="map-wrongIP" class="map-processing"><img src="../img/map/wrongIP.png" width="200" height="200"></div>
						
			<div id="Funktionen">
				<div data-dojo-type="dijit/TitlePane" data-dojo-props="title: 'Switch Basemap',closable:false, open:false">
					<!--<div data-dojo-type="dijit/layout/ContentPane" style="width:380px; height:280px; overflow:auto;">-->
							<div id="basemapGallery"></div>
					<!--</div>-->
				</div>
				<div data-dojo-type="dijit/TitlePane" data-dojo-props="title: 'Measurement', closable:false, open:false">
					<div id="measurementDiv"></div>
					<span style="font-size:smaller;padding:5px 5px;">Press <b>CTRL</b> to enable snapping.</span>
				</div>
			</div>
			
		</div>
		
		
		<div id="mapdetails">
				<div id="layerList">
					<h3>Verfügbare Layer:</h3>
					<input type='checkbox' id='sites' value=0 /> Messpunkte (Sites)</br>
					<input type='checkbox' id='hoehe' value=0 /> Höhenmodel (DTM) </br>
					<input type="range" id="hoehe_opacity" min="0" max="1" step="0.01"> <input type="text" id="hoehe_opacity_value" size = "4" value = "50%" readonly> </br>
					
					<input type='checkbox' id='isolines' value=0 /> Höhenlinien </br>
					<input type="range" id="isolines_difference" min=".1" max="5" step="0.01"> <input type="text" id="isolines_difference_value" size = "4" value = "2.55m" readonly> </br>
					<div class="submit-button" id="process-isolines-button">
                                <p>Prozess starten</p>
                         </div></br></br>
					
					<input type='checkbox' id='ortho_tiles' value=1 /> <a onclick=window.open("https://geo-arcgis.uni-muenster.de:6443/arcgis/services/LutherBog/Luther_Marsch_Orthofotos_2006/MapServer/WFSServer?SERVICE=WFS&VERSION=1.1.0&REQUEST=GetCapabilities") title="GetCapabilities" style="cursor: pointer"> Luftbilder 2006 (Tiles)</a> </br>
					<!--<input type="range" id="ortho_tiles_opacity" min="0" max="1" step="0.01"> <input type="text" id="ortho_tiles_opacity_value" size = "4" value = "50%" readonly></br>-->
					<input type='checkbox' id='ortho_merged' value=1 /> <a onclick=window.open("https://geo-arcgis.uni-muenster.de:6443/arcgis/services/LutherBog/Luther_Marsch_Orthophotos_2006_merged/MapServer/WFSServer?SERVICE=WFS&VERSION=1.1.0&REQUEST=GetCapabilities") title="GetCapabilities" style="cursor: pointer"> Luftbilder 2006 (Merged)</a> </br>
					<!--<input type="range" id="ortho_merged_opacity" min="0" max="1" step="0.01"> <input type="text" id="ortho_merged_opacity_value" size = "4" value = "50%" readonly></br>-->
					<!--<input type='checkbox' id='ortho_uav' value=1 /> IfGi UAV Luftbilder 2013</br>-->
					<!--<input type="range" id="ortho_uav_opacity" min="0" max="1" step="0.01"> <input type="text" id="ortho_uav_opacity_value" size = "4" value = "50%" readonly></br></br>-->
					</br>
					<input type='checkbox' id='uas_flight' value=1 /> alle Flüge 2015</br>
					
					
					<a>&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='flug1' value=1 /> <a onclick=window.open("https://geo-arcgis.uni-muenster.de:6443/arcgis/services/LutherBog/Flight1/MapServer/WFSServer?SERVICE=WFS&VERSION=1.1.0&REQUEST=GetCapabilities") title="GetCapabilities" style="cursor: pointer"> Flug 1</a>
					</br>
					<a>&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='flug2' value=1 /> <a onclick=window.open("https://geo-arcgis.uni-muenster.de:6443/arcgis/services/LutherBog/Flight2/MapServer/WFSServer?SERVICE=WFS&VERSION=1.1.0&REQUEST=GetCapabilities") title="GetCapabilities" style="cursor: pointer"> Flug 2</a>
					</br>
					<a>&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='flug3' value=1 /> <a onclick=window.open("https://geo-arcgis.uni-muenster.de:6443/arcgis/services/LutherBog/Flight3/MapServer/WFSServer?SERVICE=WFS&VERSION=1.1.0&REQUEST=GetCapabilities") title="GetCapabilities" style="cursor: pointer"> Flug 3</a>
					</br>
					<a>&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='flug4' value=1 /> <a onclick=window.open("https://geo-arcgis.uni-muenster.de:6443/arcgis/services/LutherBog/Flight4/MapServer/WFSServer?SERVICE=WFS&VERSION=1.1.0&REQUEST=GetCapabilities") title="GetCapabilities" style="cursor: pointer"> Flug 4</a>
					</br>
					<a>&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='flug5' value=1 /> <a onclick=window.open("https://geo-arcgis.uni-muenster.de:6443/arcgis/services/LutherBog/Flight5/MapServer/WFSServer?SERVICE=WFS&VERSION=1.1.0&REQUEST=GetCapabilities") title="GetCapabilities" style="cursor: pointer"> Flug 5</a>
					</br>
					</br>
					<!-- 
					<div id="list1" class="dropdown-check-list" tabindex="100">
						<span class="anchor">Wähle Flug</span>
						<ul class="items">
							<li><input type='checkbox' id='flug1' value=1 /> Flug 1</li>							
							<li><input type='checkbox' id='flug2' value=1 /> Flug 2</li>
							<li><input type='checkbox' id='flug3' value=1 /> Flug 3</li>
							<li><input type='checkbox' id='flug4' value=1 /> Flug 4</li>
							<li><input type='checkbox' id='flug5' value=1 /> Flug 5</li>
						</ul>
					</div>
					</br>
					</br>

					<script type="text/javascript">

						var checkList = document.getElementById('list1');
						checkList.getElementsByClassName('anchor')[0].onclick = function (evt) {
							if (checkList.classList.contains('visible'))
								checkList.classList.remove('visible');
							else
								checkList.classList.add('visible');
						}

						checkList.onblur = function(evt) {
							checkList.classList.remove('visible');
						}
					</script>
						
-->
					
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
				<br>  </br>
				<div id="mainWindow" data-dojo-type="dijit/layout/BorderContainer" data-dojo-props="design:'headline',gutters:false" style="width:100%; height:100%;">
					<!--<div data-dojo-type="dijit/layout/ContentPane" id="rightPane" data-dojo-props="region:'right'">-->
						<!--<div style='margin-left:5px;'>-->
							<p> Shapefile hinzufügen (Add zipped shp. file) </p>
							<form enctype="multipart/form-data" method="post" id="uploadForm">
								<div class="field">
									<label class="file-upload">
										<!--<span><strong><p>-->Füge hinzu<!--</p></strong></span>-->
										<input type="file" name="file" id="inFile" />
									</label>
								</div>
							</form>
							<span class="file-upload-status" style="opacity:0;" id="upload-status"></span>
							<div id="fileInfo">&nbsp;</div>
							<!--<div id="mapCanvas" data-dojo-type="dijit/layout/ContentPane" data-dojo-props="region:'center'"></div>-->
						<!--</div>-->
					<!--</div> -->
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
		<script src="../js/measurement.js"></script>
		<script src="../js/addShapefile.js"></script>
		<script src="../js/userinterface.js"></script>
	</body>
</html>
