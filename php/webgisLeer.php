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
		<!--<link rel="stylesheet" href="../css/layout.css" />-->
		<script src="http://js.arcgis.com/3.10/"></script>
		

		<script>dojoConfig = {async: true, parseOnLoad: false}</script>
		<script src="//ajax.googleapis.com/ajax/libs/dojo/1.10.4/dojo/dojo.js"></script>
				
	</head>
	
	<body class="claro">
	<div class="row" style="width:100%">	
		<header>
                 <div class="hide-for-small-only">    
							<a href="http://www.uni-muenster.de/Landschaftsoekologie/"><img src="../img/iloek_logo.png"></a>
                 </div> 
			     <a href="../index.php"><h1>LUTHERbog WebGIS</h1></a>
				<nav>
					<section class="top-bar-section">
					<div class="hide-for-small-only">
					<ul class="right">
						<li><a href="process/logout.php" class="header-buttons" id="logout">Ausloggen</a></li>
						<li><a href="upload.php" class="header-buttons" id="upload">Daten hinzuf&uuml;gen</a></li>
						<li><a href="access.php" class="header-buttons" id="access">Daten einsehen</a></li>
					</ul>
					</div>
					</section>
				</nav>
		</header>
	</div>	
		<div class="row" style="width:100%">
			
		<div class="large-2 medium-4 small-12 columns">
		<div id="mapdetails">
		
				<div id="layerList">
					<div data-dojo-type="dijit/TitlePane" data-dojo-props="title:'Verfügbare Layer'"> 

					
					<input type='checkbox' id='hoehe' value=0 /> Höhenmodel (DTM) </br>
					<input type="range" id="hoehe_opacity" min="0" max="1" step="0.01"> <input type="text" id="hoehe_opacity_value" size = "4" value = "50%" readonly> </br>
					
					<input type='checkbox' id='isolines' value=0 /> Höhenlinien </br>
					<input type="range" id="isolines_difference" min=".1" max="5" step="0.01"> <input type="text" id="isolines_difference_value" size = "4" value = "2.55m" readonly> </br>
					<div class="submit-button" id="process-isolines-button">
                                <p>Prozess starten</p>
                         </div></br>
					
					<input type='checkbox' id='ortho_tiles' value=1 /> <a onclick=window.open("https://geo-arcgis.uni-muenster.de:6443/arcgis/services/LutherBog/Luther_Marsch_Orthofotos_2006/MapServer/WFSServer?SERVICE=WFS&VERSION=1.1.0&REQUEST=GetCapabilities") title="GetCapabilities" style="cursor: pointer"> Luftbilder 2006 (Tiles)</a> </br>
					<input type='checkbox' id='ortho_merged' value=1 /> <a onclick=window.open("https://geo-arcgis.uni-muenster.de:6443/arcgis/services/LutherBog/Luther_Marsch_Orthophotos_2006_merged/MapServer/WFSServer?SERVICE=WFS&VERSION=1.1.0&REQUEST=GetCapabilities") title="GetCapabilities" style="cursor: pointer"> Luftbilder 2006 (Merged)</a> </br>
					
					</div>

					<div data-dojo-type="dijit/TitlePane" data-dojo-props="title:'Flüge'">

					
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
					
					</div>

					<div data-dojo-type="dijit/TitlePane" data-dojo-props="title:'Vegetationsindex'">

					
					<input type='checkbox' id='uas_ndvi' value=1 /> NDVI aller Flüge 2015</br>
										
					<a>&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='ndvi1' value=1 /> NDVI des 1. Flugs</a>
					</br>
					<a>&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='ndvi2' value=1 /> NDVI des 2. Flugs</a>
					</br>
					<a>&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='ndvi3' value=1 /> NDVI des 3. Flugs</a>
					</br>
					<a>&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='ndvi4' value=1 /> NDVI des 4. Flugs</a>
					</br>
					<a>&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='ndvi5' value=1 /> NDVI des 5. Flugs</a>
					</br>
					
					</div>
				
					<div data-dojo-type="dijit/TitlePane" data-dojo-props="title:'Mikrotopographie & Vegetation'">

					
					<input type='checkbox' id='SiteAlleMitRaster' value=1 /> Klassifizierungen aller Sites</br>
										
					<a>&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='site1' value=1 /> <a href="javascript: popup('../img/Site1.PNG', 'Site1', 'width=843, height=712')" title="" style="cursor: pointer"> Site 1</a>
					</br>
					<a>&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='site2' value=1 /> <a href="javascript: popup('../img/Site2.PNG', 'Site2', 'width=844, height=713')" title="" style="cursor: pointer"> Site 2</a>
					</br>
					<a>&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='site3' value=1 /> <a href="javascript: popup('../img/Site3.PNG', 'Site3', 'width=842, height=714')" title="" style="cursor: pointer"> Site 3</a>
					</br>
					<a>&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='site4' value=1 /> <a href="javascript: popup('../img/Site4.PNG', 'Site4', 'width=843, height=711')" title="" style="cursor: pointer"> Site 4</a>
					</br>
					
					</div>
					
					<div data-dojo-type="dijit/TitlePane" data-dojo-props="title:'Prozesse'">
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
		
				
			
				
				<div data-dojo-type="dijit/TitlePane" data-dojo-props="title:'Upload'">
				

							<p> Shapefile hinzufügen (Add zipped shp. file) </p>
							<form enctype="multipart/form-data" method="post" id="uploadForm">
								<div class="field">
									<label class="file-upload">
										<input type="file" name="file" id="inFile" />
									</label>
								</div>
							</form>
							<span class="file-upload-status" style="opacity:0;" id="upload-status"></span>
							<div id="fileInfo">&nbsp;</div>
							
							
							<p> gpx-Datei hinzufügen </p>
							<form enctype="multipart/form-data" method="post" id="uploadForm">
								<div class="field">
									<label class="file-upload">
										<span><strong>Add gpx</strong></span>
										<input type="file" name="file" id="inFile"/>
									</label>
								</div>
							</form>
							<span class="file-upload-status" style="opacity:0;" id="upload-status"></span>
							<div id="fileInfo">&nbsp;</div>
							
							<p style="padding:4px;"><span>Drag and drop services, images or a csv file with latitude/longitude information
								  from windows explorer to the map.</span>
							</p>

							<div id='msg' style='color:red;display:none;padding:4px;'> 'You are using a browser that
							  doesn't support drag/drop use the file upload box below to add your csv:'
							</div>
							<form id="uploadForm" style='display:none;padding:4px;' method="post" enctype="multipart/form-data">
							  <input type="file" name="data" id="inFile" size="15" />
							</form>
							<span id="status"></span>
							
							<div id="fileInfo"> </div>
							<p style='padding:4px;'>Note: The CSV file must store the location in fields with one of the following
							  names:
							  <br />
							  <b>latitude fields:</b>lat, latitude, y, ycenter
							  <br />
							  <b>longitude fields:</b>lon, long, longitude, x, xcenter
							  <br />
							</p>

				</div>

			</div>
		</div>		
		</div>
		
		<div class="large-10 medium-8 small-12 columns"  style="height:100%">
		<div id="map">
		
			<div id="HomeButton"></div>
			<div id="map-submitted" class="map-processing"><img src="../img/map/submitted.png" width="200" height="200"></div>
			<div id="map-loading" class="map-processing"><img src="../img/map/loading.gif" width="200" height="200"></div>
			<div id="map-success" class="map-processing"><img src="../img/map/success.png" width="200" height="200"></div>
			<div id="map-error" class="map-processing"><img src="../img/map/error.png" width="200" height="200"></div>
			<div id="map-wrongIP" class="map-processing"><img src="../img/map/wrongIP.png" width="200" height="200"></div>
						
			<div id="Funktionen">
				<!--<div data-dojo-type="dijit/TitlePane" data-dojo-props="title: 'Hintergrundkarten',closable:false, open:false">
					
							<div id="basemapGallery"></div>
					
				</div>
				<div data-dojo-type="dijit/TitlePane" data-dojo-props="title: 'Messungen und Koordinaten', closable:false, open:false">
					<div id="measurementDiv"></div>
					<span style="font-size:smaller;padding:5px 5px;">Press <b>CTRL</b> to enable snapping.</span>
				</div>-->
				<div data-dojo-type="dijit/TitlePane" data-dojo-props="title: 'Level of Detail',closable:false, open:false">
					<input type="radio" id="standardLOD" name="lod" >Standard LOD <br>
					<input type="radio" id="customLOD" name="lod" checked>Custom LOD 
					
				</div>
			</div>
			
			<div id="mapCanvas" data-dojo-type="dijit/layout/ContentPane" data-dojo-props="region:'center'">
				<div id="clearButton" class="roundedCorner">
				  <span>Clear Map</span>
				</div>
			</div>
			
		</div>
		</div>
		
		</div>
		<div id="page">
			<!--<header>
                 <div class="hide-for-small-only">    
							<a href="http://www.uni-muenster.de/Landschaftsoekologie/"><img src="../img/iloek_logo.png"></a>
                 </div> 
			     <a href="../index.php"><h1>LUTHERbog WebGIS</h1></a>
				<nav>
					<ul>
						<li><a href="process/logout.php" class="header-buttons" id="logout">Ausloggen</a></li>
						<li><a href="upload.php" class="header-buttons" id="upload">Daten hinzuf&uuml;gen</a></li>
						<li><a href="access.php" class="header-buttons" id="access">Daten einsehen</a></li>
					</ul>
				</nav>
			</header>-->
			
			<div id="logout-content">
				<form action="#" method="post">
					<h1>Sie sind angemeldet als:</h1>
					<p><?php echo $_SESSION['vorname']." ".$_SESSION['nachname']; ?></p>
					<p><?php echo $_SESSION['email']?></p>
				</form>
			</div>
			
			<div id='impressum-content'>
				<h1>Impressum</h1>
				<p>Diese Website ist im Zuge der Bachelorarbeiten von Fabian Röhr und Luisa Bodem entstanden.</p>
				<p>Die verarbeiteten Daten wurden von der Arbeitsgruppe Hydrologie, die von Prof. Dr. Blodau geleitet wird, gesammelt und zur Verfügung gestellt.</p>	
			</div>
                        
            <footer>
                    <a href="http://www.uni-muenster.de/HydrologieBodenkunde/LUTHERbog.html" id="projectinfo">Projektinfomationen</a>
				<a href="help.php" id="help">Hilfe</a>
				<a href="#" id="impressum">Impressum</a>
			</footer>
		</div>
		<script src="../js/login.js"></script>
		<script src="../js/mapLeer.js"></script>
		<script src="../js/measurement.js"></script>
		<script src="../js/addShapefile.js"></script>
		<script src="../js/userinterface.js"></script>
		<script src="../js/addGPX.js"></script>
		<script src="../js/DragAndDrop.js"></script>
	</body>
</html>
