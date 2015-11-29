<?php
session_start();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<?php
			include 'head.php';
		?>
	</head>
	<body>
		<div id="page">
			<header>
			<nav class="top-bar">
			<div class="large-12 medium-12 small-12 columns"style="padding-bottom: 15px">
                        <div class="hide-for-small-only">    
							<a href="http://www.uni-muenster.de/Landschaftsoekologie/"><img src="../img/iloek_logo.png"></a>
                        </div>   
			<ul class="title-area">
					<a href="../index.php"><h1>LUTHERbog WebGIS</h1></a>
			</ul>
				<section class="top-bar-section">
				<div class="show-for-large-up">
					<ul class="right">
						<li style="padding-top: 10px"><a href="webgis.php" class="button" id="webgis">WebGIS</a></li>
						<li style="padding-top: 10px"><a href="http://www.uni-muenster.de/HydrologieBodenkunde/LUTHERbog.html" class="button" id="project" target="_blank">Das Projekt</a></li>
					</ul>
				</div>
				
				
		
				</section>
				<ul class="right" style="margin-top:10px">
				<div class="hide-for-large-up">
				
				<a href="#" data-reveal-id="myModal"><img src="../img/welcome/menu.png" width="40" height="40"></a>
				<div id="myModal" class="reveal-modal [tiny]" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
				  <a href="webgis.php" class="button" id="webgis">WebGIS</a><br></br>
				  <a href="http://www.uni-muenster.de/HydrologieBodenkunde/LUTHERbog.html" class="button" id="project" target="_blank">Das Projekt</a>
				  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
				</div>
				
				</div>
				</ul>
			</div>
			
			</nav>
			</header>
			
			<div class="row" style="width:80%; margin-left: 10%">
			<dl class="accordion" data-accordion style="padding-top: 32px">
			  <dd class="accordion-navigation">
				<a href="#panel1a">Die Karte - eine Übersicht</a>
				<div id="panel1a" class="content active">
					</br>	
					<div class="panel" style="margin-left:5%">
								
					<p>Das WebGIS besteht aus einer Karte, verschiedenen Layern und spezifischen Funktionen.<br></p>
					
					<img src="../img/help/Karte.png" width="700">
					<br></br>
					<h3>Übersicht:</h3>
					
					<ul>
						<li>In der linken Seitennavigation gibt das "Table of Content" Informationen über die sich im Kartenausschnitt befindlichen Kartenlayer. Mit einem Klick auf einen entsprechenden Layer lässt sich dieser ein oder ausblenden.</li>
						<li>Im linken unteren Bereich wird der aktuelle Maßstab des Kartenausschnitts aufgezeigt.</li>
						<li>Im oberen rechten Bereich befindet sich eine Übersichtskarte, die eine relative Lokalisierung gewährleistet und den aktuellen Kartenausschnitt im größeren Kontext zeigt.<br></li>
						<li>Im mittlere rechten Bereich der Karte findet der Nutzer die Basiskartengallerie. Mit einem Klick auf eine entsprechende Basiskarte ändert sich diese in der Hauptkarte.</li>
						<li>Darunter befinden sich die Messwerkzeuge, mit denen der Nutzer Flächen und Entfernungen messen und Koordinaten auslesen kann.</li>
						<li>Darunter kann man einen Level of Detail wählen. Bei dem voreingestellten Level of Detail, sind Hintergrundkarten und Messwerkzeuge verfügbar, jedoch kann man nur bis auf ein bestimmtes Level ranzoomen. Genügt einem dieses Level nicht, wählt man den benutzerdefinierten Detailgrad. </li>
						<li>Der Kartenausschnitt visualisiert die angewählten Geodaten.</li>
					</ul>
					</br>
					</div>
					</br>
					
				</div>
			  </dd>
			  <ul class="side-nav"><li class="divider"></li></ul>
			  <dd class="accordion-navigation">
				<a href="#panel2a">Verfügbare Layer</a>
				<div id="panel2a" class="content">
				  </br>	
					<div class="panel" style="margin-left:5%">
					<div class="row" style="padding-bottom: 10px">		
						<div class="small-6 medium-4 large-3 columns">
							<img src="../img/help/VerfügbareLayer.png" width="218" height="732" align="left" border="0" style="padding-right: 10px">
							<br></br>
						</div>
						
						<div class="small-6 medium-8 large-9 columns">				
							<p>Als verfügbare Layer stehen ein Höhenmodell, Höhenlinien und verschiedene Luftbilder zur Verfügung. 
							Beim Höhenmodell kann man mit dem Schieber die Deckkraft des Layers einstellen.
							Durch den Schieber unter den Höhenlinien lässt sich der Abstand der Linien variieren.
							Die Luftbilder wählt man über einen Klick in die Checkbox aus.</p>
						</div>
					</div>
					<div class="row">
					<div class="small-12 medium-12 large-12 columns">
							<p>Klickt man auf den Button "Layerinfos" hinter "Luftbilder 2006 (Tiles)" und "Luftbilder 2006 (Merged)" erscheint dieses Fenster:
							<img src="../img/help/GetMap.png" width="400">
					</div>
					</div>
					</br>
					<div class="row">
					<div class="small-12 medium-12 large-12 columns">
						<p>Es zeigt drei verschieden Links zu den jeweiligen Services.</p>
						<ul>
							<li>Web Map Service: Klickt man auf den Link, markiert er sich vollständig. Jetzt braucht man ihn nur noch kopieren und in ein anderes WebGIS oder ein DesktopGIS einfügen. Er stellt die jeweilige Karte den anderen Geoinformationssystemen bereit. Klickt man auf den blauen Begriff "Web Map Service", öffnet sich das XML-Dokument mit den Capabilities.</li>
							<li>Web Feature Service: Klickt man auf den Link, markiert er sich vollständig. Er stellt die Features des Layers bereit. </li>
							<li>KLM Datei: Klickt man auf den Link, markiert er sich vollständig. Kopiert man ihn in ein neues Fenster, kann man den Layer zum Beispiel als .kmz-Datei herunterladen, welches das richtige Dateiformat für Google Earth ist.</li>
						</ul>
					</div>
					</div>
					</br>
					</div>
				</div>
				
			  </dd>
			   <ul class="side-nav"><li class="divider"></li></ul>
			  <dd class="accordion-navigation">
				<a href="#panel3a">Flüge</a>
				<div id="panel3a" class="content">
				  </br>	
					<div class="panel" style="margin-left:5%">
					<div class="row" style="padding-bottom: 10px">		
						<div class="small-6 medium-4 large-3 columns">
							<img src="../img/help/Flüge.png" width="218" height="732" align="left" border="0" style="padding-right: 10px">
							<br></br>
						</div>
						
						<div class="small-6 medium-8 large-9 columns">				
							<p>Die Flüge sind Luftbilder aus dem Jahr 2015. Sie können alle einzeln oder durch Markieren der ersten Checkbox alle zusammen dargestellt werden.</p>
						</div>
					</div>
					<div class="row">
					<div class="small-12 medium-12 large-12 columns">
							<p>Klickt man auf den Button "Layerinfos" hinter den Begriffen "FlugX" erscheint dieses Fenster:
							<img src="../img/help/GetMap.png" width="400">
					</div>
					</div>
					</br>
					<div class="row">
					<div class="small-12 medium-12 large-12 columns">
						<p>Es zeigt drei verschieden Links zu den jeweiligen Services.</p>
						<ul>
							<li>Web Map Service: Klickt man auf den Link, markiert er sich vollständig. Jetzt braucht man ihn nur noch kopieren und in ein anderes WebGIS oder ein DesktopGIS einfügen. Er stellt die jeweilige Karte den anderen Geoinformationssystemen bereit. Klickt man auf den blauen Begriff "Web Map Service", öffnet sich das XML-Dokument mit den Capabilities.</li>
							<li>Web Feature Service: Klickt man auf den Link, markiert er sich vollständig. Er stellt die Features des Layers bereit. </li>
							<li>KLM Datei: Klickt man auf den Link, markiert er sich vollständig. Kopiert man ihn in ein neues Fenster, kann man den Layer zum Beispiel als .kmz-Datei herunterladen, welches das richtige Dateiformat für Google Earth ist.</li>
						</ul>
					</div>
					</div>
					</br>
					</div>
					</br>
				</div>
			  </dd>
			   <ul class="side-nav"><li class="divider"></li></ul>
			  <dd class="accordion-navigation">
				<a href="#panel4a">Vegetationsindex</a>
				<div id="panel4a" class="content">
				  </br>	
					<div class="panel" style="margin-left:5%">
					<div class="row" style="padding-bottom: 10px">		
						<div class="small-6 medium-4 large-3 columns">
							<img src="../img/help/NDVI.png" width="218" height="732" align="left" border="0" style="padding-right: 10px">
							<br></br>
						</div>
						
						<div class="small-6 medium-8 large-9 columns">				
							<p>Der Vegetaionsindex wird aus den multispektralen Bildern der Flüge berechnet. Durch Markieren der Checkbox werden sie auf der Karte angezeigt.
							Die Berechnung wurde durch einen Web Processing Service realisiert.
							Durch Auswahl eines Layers erscheint eine Legende zur Interpretation des Layers.</p>
						</div>
					</div>
					
					</br>
					</br>
					</div>
					</br>
				</div>
			  </dd>
			   <ul class="side-nav"><li class="divider"></li></ul>
			  <dd class="accordion-navigation">
				<a href="#panel5a">Mikrotopographie  Vegetation</a>
				<div id="panel5a" class="content">
				  </br>	
					<div class="panel" style="margin-left:5%">
					<div class="row" style="padding-bottom: 10px">		
						<div class="small-6 medium-4 large-3 columns">
							<img src="../img/help/Mikrotopo.png" width="218" height="732" align="left" border="0" style="padding-right: 10px">
							<br></br>
						</div>
						
						<div class="small-6 medium-8 large-9 columns">				
							<p>Die Sites sind die einzelnen Messstellen, die von Niclas Kolbe untersucht wurden.</p>
						</div>
					</div>
					<div class="row">
					<div class="small-12 medium-12 large-12 columns">
							<p>Klickt man auf die blauen Begriffe "SiteX" erscheint dieses Fenster:
							<img src="../img/help/Site.png" width="600">
					</div>
					</div>
					</br>
					<div class="row">
					<div class="small-12 medium-12 large-12 columns">
						<p>Die jeweilige Messtelle wird in einem eigenen Fenster in bester Auflösung angezeigt.
						</p>Das ist die einzige Möglichkeit die Legende zu den Standorten zu sehen. Man kann das Bild aber auch runterladen und damit lokal weiterarbeiten.
						
					</div>
					</div>
					</br>
					</div>
					</br>
				</div>
			  </dd>
			  <ul class="side-nav"><li class="divider"></li></ul>
			  <dd class="accordion-navigation">
				<a href="#panel6a">Prozesse</a>
				<div id="panel6a" class="content">
				  </br>	
					<div class="panel" style="margin-left:5%">
					<div class="row" style="padding-bottom: 10px">		
						<div class="small-6 medium-4 large-3 columns">
							<img src="../img/help/Prozesse.png" width="218" height="732" align="left" border="0" style="padding-right: 10px">
							<br></br>
						</div>
						
						<div class="small-6 medium-8 large-9 columns">				
							<p>Prozesse sind hier als Web Processing Service umgesetzt. Als Variable kann man die Höhe der Überflutung selbst bestimmen. Der zweite Regler ist für die Deckkraft des errechneten Layers.
							Die errechneten Layer stellen die überfluteten Gebiete oder Teilgebiete dar.</p>
						</div>
					</div>
					
					</br>
					</div>
					</br>
				</div>
			  </dd>

			  <ul class="side-nav"><li class="divider"></li></ul>
			  <dd class="accordion-navigation">
				<a href="#panel7a">Upload</a>
				<div id="panel7a" class="content">
				 </br>	
					<div class="panel" style="margin-left:5%">
					<div class="row" style="padding-bottom: 10px">		
						<div class="small-6 medium-4 large-3 columns">
							<img src="../img/help/Upload.png" width="218" height="732" align="left" border="0" style="padding-right: 10px">
							<br></br>
						</div>
						
						<div class="small-6 medium-8 large-9 columns">				
							<h5>Man hat die Möglichkeit Shapefiles (.shp) oder .gpx-Dateien hochzuladen und .csv-Dateien auf die Karte zu ziehen.</h5>
							<h3>Shapefiles</h3>
							<p>Möchte man ein Shapefile visualisieren, muss man die .shp-Datei zusammen mit den zugehörigen .dbf, .prj und .shx Dateien in ein Archiv zippen.
							Erst dann wird er vom System akzeptiert und angezeigt. Die Funktion wird durch Anklicken des "Add File" Buttons gestartet. Es öffnet sich ein Navigationsfenster, welches das Auswählen der Datei ermöglicht.</p>
							<br></br>
							<h3>.gpx-Datei</h3>
							<p>Auch hier startet der Button "Add File" die Funktion und mit dem erscheinenden Navigationsfenster kann man eine .gpx-Datei auswählen, die dann auf der Karte angezeigt wird.</p>
							<br></br>
							<h3>.csv-Datei</h3>
							<p>Eine .csv-Datei wird durch Ziehen vom Desktop auf die Karte visualisiert. Es ist notwendig die Hinweise zu beachten. Werden die Spalten anders bezeichnet als angegeben, kann die Datei nicht gelesen werden.
							Sind die Koordinaten nicht in Dezimalgrad angegeben, sondern in Grad, Minuten, Sekunden nimmt die Funktion an, es wäre das richtige Format und der Standort stimmt nicht.
							Es müssen Dezimalgrad mit dem Bezugssystem WGS84 sein.<br></br>
							Beispiel einer .csv Datei:</p><img src="../img/help/BeispielCSV.png">
						</div>
					</div>
					</div>
					</br>
				</div>
			  </dd>
			  <ul class="side-nav"><li class="divider"></li></ul>
			  <dd class="accordion-navigation">
				<a href="#panel8a">Level of Detail</a>
				<div id="panel8a" class="content">
				  </br>	
					<div class="panel" style="margin-left:5%">
					<div class="row" style="padding-bottom: 10px">		
						<div class="small-6 medium-4 large-3 columns">
							<img src="../img/help/LoD.PNG" width="218" height="732" align="left" border="0" style="padding-right: 10px">
							<br></br>
						</div>
						
						<div class="small-6 medium-8 large-9 columns">				
							<p> Wählt man den benutzerdefinierten Level of Detail, kann man beliebig nah in der Karte heranzoomen. Von besonderer Bedeutung ist das bei der Anzeige der Felddaten und Sites.
						</div>
					</div>
					</div>
					
				</div>
			  </dd>
			  
			  <ul class="side-nav"><li class="divider"></li></ul>
			  <dd class="accordion-navigation">
				<a href="#panel9a">Allgemeine Probleme</a>
				<div id="panel9a" class="content">
				  </br>	
					<div class="panel" style="margin-left:5%">
								
					<p>Falls die Seite sich nicht korrekt aufbaut, drücken sie F5!
					Für die beste Darstellung wird der Internet Explorer als Browser empfohlen.</p>
					
					</div>
					
				</div>
			  </dd>
			</dl>
			
			</div>
			
			
            
			
            <footer>
            <ul class="breadcrumbs">
			  <li><a href="../index.php">Home</a></li>
			  <li><a href="http://www.uni-muenster.de/HydrologieBodenkunde/LUTHERbog.html" id="projectinfo">Projektinformation</a></li>
			  <li class="current"><a href="'" id="help">Hilfe</a></li>
			  <li><a href="#" data-reveal-id="myModal3" id="impressum">Impressum</a></li>
			  
			  <div id="myModal3" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
					<h1>Impressum</h1>
					<p>Diese Website ist im Zuge der Bachelorarbeit von Fabian Röhr und Luisa Bodem entstanden.</p>
					<p>Die verarbeiteten Daten wurden von der Arbeitsgruppe Hydrologie, die von Prof. Dr. Blodau geleitet wird, gesammelt und zur Verfügung gestellt.</p>	
			
					<a class="close-reveal-modal" aria-label="Close">&#215;</a>
				</div>
			</ul>
			</footer>
                </div>
                <script src="../js/login.js"></script>
                <script src="../js/userinterface.js"></script>
				<!--<script src="../js/foundation/foundation.js"></script>-->
				<script src="../js/vendor/jquery.js"></script>
				<script src="../js/vendor/fastclick.js"></script>
				<script src="../js/foundation.min.js"></script>
				<script>
				$(document).foundation();
				</script>
	</body>
</html>