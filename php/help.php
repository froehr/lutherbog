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
                            <a href="http://www.uni-muenster.de/Landschaftsoekologie/"><img src="../img/iloek_logo.png"></a>
                            <a href="../index.php"><h1>LUTHERbog WebGIS</h1></a>
				<nav>
					<ul>
                                            <li><a href="../index.php" class="header-buttons" id="home">Home</a></li>
                                            <li><a href="http://www.uni-muenster.de/HydrologieBodenkunde/LUTHERbog.html" class="header-buttons" id="project" target="_blank">Das Projekt</a></li>
					</ul>
				</nav>
			</header>

                        <div id="switch">
                            <ul>
                                <li id="map-help"><h1>Die Karte</h1></li>
                                <li id="access-help"><h1>Messungen zeigen</h1></li>
                                <li id="upload-help"><h1>Messungen hinzufügen</h1></li>
                                <li id="technical-help"><h1>Technisches</h1></li>
                            </ul>
			</div>
			
			<div class="switch-content" id="map-help-content">
				<div class="help-content">
					<h2>Die Kartenfunktion - Eine Übersicht</h2>
					
					<p>Das WebGIS besteht aus einer Karte, die einerseits statisches Kartenmaterial, wie ein Höhenmodell und verschiedene Luftbilder sowie dynamische Layer, die per Web Processing Service von einem ArcGIS Server durch den Benutzer nachgeladen werden können.<br></p>
					
					<img src="../img/help/map-help.png" width="700">
					<h3>Die Karte umfasst verschiedene Elemente und Funktionen:</h3>
					
					<ul>
						<li>Im oberen rechten Bereich befindet sich eine Übersichtskarte, die eine relative Lokalisierung gewährleistet und den aktuellen Kartenausschnitt im größeren Kontext zeigt. Die Übersichtskarte lässt sich aber ebenfalls mit dem kleinen Pfeil in der Ecke ausblenden.<br></li>
						<li>Im rechten oberen Bereich der Karte findet der Nutzer ebenfalls die Basiskartengallerie. Mit einem Klick auf eine entsprechende Basiskarte ändert sich diese in der Hauptkarte.</li>
						<li>Im linken unteren Bereich wird der aktuelle Maßstab des Kartenausschnitts aufgezeigt.</li>
						<li>In der linken Seitennavigation gibt das "Table of Content" Informationen über die sich im Kartenausschnitt befindlichen Kartenlayer. Mit einem Klick auf einen entsprechenden Layer lässt sich dieser ein oder ausblenden. Weiterhin dient das TOC als Legende.</li>
						<li>Der Kartenausschnitt visualisiert den angewählten Geodaten.</li>
					</ul>
					
				</div>
			</div>
			
			<div class="switch-content" id="access-help-content">
				<div class="help-content">
					<h2>Datenzugriff - Möglichkeiten</h2>
				</div>
			</div>
			<div class="switch-content" id="upload-help-content">
				<div class="help-content">
				
				</div>
			</div>
			<div class="switch-content" id="technical-help-content">
				<div class="help-content">
					<h2>Technische Details des Systems</h2>
				</div>
			</div>
                        
                        <footer>
                                <a href="http://www.uni-muenster.de/HydrologieBodenkunde/LUTHERbog.html" id="projectinfo">Projektinfomationen</a>
				<a href="#" id="impressum">Impressum</a>
			</footer>
                </div>
                <script src="../js/login.js"></script>';
                <script src="../js/userinterface.js"></script>
	</body>
</html>