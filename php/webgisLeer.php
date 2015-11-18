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
		<script>
		  var dojoConfig = { isDebug: true };
		</script>
		<link rel="stylesheet" href="http://js.arcgis.com/3.10/js/esri/css/esri.css">
		<link rel="stylesheet" href="http://js.arcgis.com/3.10/js/dojo/dijit/themes/claro/claro.css">
		<!--<link rel="stylesheet" href="../css/layout.css" />-->
		<script src="http://js.arcgis.com/3.10/"></script>
		
		<link rel="stylesheet" href="../css/fileupload.css">

		<script>dojoConfig = {async: true, parseOnLoad: false}</script>
		<script src="//ajax.googleapis.com/ajax/libs/dojo/1.10.4/dojo/dojo.js"></script>
				
	</head>
	
	<body class="claro">
	<div class="row">	
		<header>
                 <div class="hide-for-small-only">    
							<a href="http://www.uni-muenster.de/Landschaftsoekologie/"><img src="../img/iloek_logo.png"></a>
                 </div> 
			     <a href="../index.php"><h1>LUTHERbog WebGIS</h1></a>
				<nav>
					<section class="top-bar-section">
					<div class="show-for-large-up">
					<ul class="right" style="margin-top:17px">
						<li><a href="process/logout.php" class="header-buttons" id="logout" >Ausloggen</a></li>
						<li><a href="upload.php" class="header-buttons" id="upload">Daten hinzuf&uuml;gen</a></li>
						<li><a href="access.php" class="header-buttons" id="access">Daten einsehen</a></li>
					</ul>
					</div>
					</section>
					<ul class="right" style="margin-top:10px">
					<div class="hide-for-large-up">
					
					<a href="#" data-reveal-id="myModal"><img src="../img/welcome/menu.png" width="40" height="40"></a>
					<div id="myModal" class="reveal-modal [tiny]" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
					    <a href="process/logout.php" class="button" id="logout" >Ausloggen</a><br></br>
						<a href="upload.php" class="button" id="upload">Daten hinzuf&uuml;gen</a><br></br>
						<a href="access.php" class="button" id="access">Daten einsehen</a>
						<a class="close-reveal-modal" aria-label="Close">&#215;</a>
						<div id="logout-content2">
							<form action="#" method="post">
								<h1>Sie sind angemeldet als:</h1>
								<p><?php echo $_SESSION['vorname']." ".$_SESSION['nachname']; ?></p>
								<p><?php echo $_SESSION['email']?></p>
							</form>
						</div>
					</div>
					
				</div>
				</ul>
				</nav>
		</header>
		
		
		
	</div>	
		<div class="row" style="overflow: hidden">
			
		<div class="large-2 medium-4 small-12 columns" style="height: 87%">
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

					
					<input type='checkbox' id='SiteAlleMitRaster' value=1 /> Felddaten aller Sites</br>
										
					<a>&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='site1Kl' value=1 /> <a href="javascript: popup('../img/Site1.PNG', 'Site1', 'width=843, height=712')" title="" style="cursor: pointer"> Site 1</a></br>					
					<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='site1' value=1 /> <a href="javascript: popup('../img/Site1.PNG', 'Site1', 'width=843, height=712')" title="" style="cursor: pointer"> Felddaten</a>
					</br>
					<a>&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='site2Kl' value=1 /> <a href="javascript: popup('../img/Site1.PNG', 'Site1', 'width=843, height=712')" title="" style="cursor: pointer"> Site 2</a></br>
					<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='site2' value=1 /> <a href="javascript: popup('../img/Site2.PNG', 'Site2', 'width=844, height=713')" title="" style="cursor: pointer"> Felddaten</a>
					</br>
					<a>&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='site3Kl' value=1 /> <a href="javascript: popup('../img/Site1.PNG', 'Site1', 'width=843, height=712')" title="" style="cursor: pointer"> Site 3</a></br>
					<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='site3' value=1 /> <a href="javascript: popup('../img/Site3.PNG', 'Site3', 'width=842, height=714')" title="" style="cursor: pointer"> Felddaten</a>
					</br>
					<a>&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='site4Kl' value=1 /> <a href="javascript: popup('../img/Site1.PNG', 'Site1', 'width=843, height=712')" title="" style="cursor: pointer"> Site 4</a></br>
					<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><input type='checkbox' id='site4' value=1 /> <a href="javascript: popup('../img/Site4.PNG', 'Site4', 'width=843, height=711')" title="" style="cursor: pointer"> Felddaten</a>
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
				

							<p> Shapefile oder .gpx-Datei hinzufügen (Add zipped shp. file) </p>							
							
							<form enctype="multipart/form-data" method="post" id="uploadForm">
								<div class="field">
									<label class="file-upload">
										<span><strong>Add File</strong></span>
										<input type="file" name="file" id="inFile" />
									</label>
								</div>
							</form>
							<span class="file-upload-status" style="opacity:0;" id="upload-status"></span>
							<div id="fileInfo">&nbsp;</div>
							<div id="alreadyAdded"></div>
							
													
							<p style="padding:4px;"><span>Ziehen Sie ein Bild oder eine .csv Datei mit angegeben Längen- und Breitengrade auf die Karte.</span>


							</p>

							<div id='msg' style='color:red;display:none;padding:4px;'> 'You are using a browser that
							  doesn't support drag/drop use the file upload box below to add your csv:'
							</div>
							<form id="uploadForm" style='display:none;padding:4px;' method="post" enctype="multipart/form-data">
							  <input type="file" name="data" id="inFile" size="15" />
							</form>
							<span id="status"></span>
							
							<div id="fileInfo"> </div>
							<p style='padding:4px;'>Wichtig: Die .csv Datei muss die Koordinaten in Felder mit folgenenden Bezeichnungen speichern:							  <br />
							  <b>Feld für den Breitengrad:</b>lat, latitude, y, ycenter


							  <br />


							  <b>Feld für den Längengrad:</b>lon, long, longitude, x, xcenter
							  <br />
							</p>
							
							<button id="clearButton" class="roundedCorner">
							  <div id="cleanup">
							  <span>Leere Karte</span>
							  </div>
							</button>

				</div>

			</div>
		</div>		
		</div>
		
		<div class="large-10 medium-8 small-12 columns"  style="height:90%">
		<div id="map">
		
			<div id="HomeButton" style="width: 30px"></div>
			<div id="map-submitted" class="map-processing"><img src="../img/map/submitted.png" width="200" height="200"></div>
			<div id="map-loading" class="map-processing"><img src="../img/map/loading.gif" width="200" height="200"></div>
			<div id="map-success" class="map-processing"><img src="../img/map/success.png" width="200" height="200"></div>
			<div id="map-error" class="map-processing"><img src="../img/map/error.png" width="200" height="200"></div>
			<!--<div id="map-wrongIP" class="map-processing"><img src="../img/map/wrongIP.png" width="200" height="200"></div>-->
						
			<div id="Funktionen">
				
				<div data-dojo-type="dijit/TitlePane" data-dojo-props="title: 'Level of Detail',closable:false, open:false">
					<input type="radio" id="standardLOD" name="lod">Standard LOD <br>
					<input type="radio" id="customLOD" name="lod" checked>Benutzerdefinierter LOD 
					
				</div>
			</div>
			
			
				
			





			
		</div>
		</div>
		
		</div>
		<div id="page">













			
			<div id="logout-content">
				<form action="#" method="post">
					<h1>Sie sind angemeldet als:</h1>
					<p><?php echo $_SESSION['vorname']." ".$_SESSION['nachname']; ?></p>
					<p><?php echo $_SESSION['email']?></p>
				</form>
			</div>
			    
            












		</div>
		
		
		<script src="../js/login.js"></script>
		<script src="../js/mapLeer.js"></script>
		<script src="../js/addShapefile.js"></script>
		<script src="../js/userinterface.js"></script>
		<script src="../js/addGPX.js"></script>
		<script src="../js/DragAndDrop.js"></script>
		<script src="../js/vendor/jquery.js"></script>
		<script src="../js/vendor/fastclick.js"></script>
		<script src="../js/foundation.min.js"></script>
		<script>
				$(document).foundation();
		</script>
	</body>
</html>
