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
				<a href="#panel1a">Die Kartenfunktionen - eine Übersicht</a>
				<div id="panel1a" class="content active">
					</br>	
					<div class="panel" style="margin-left:5%">
								
					<p>Das WebGIS besteht aus einer Karte, die einerseits statisches Kartenmaterial, wie ein Höhenmodell und verschiedene Luftbilder sowie dynamische Layer, die per Web Processing Service von einem ArcGIS Server durch den Benutzer nachgeladen werden können.<br></p>
					
					<img src="../img/help/map-help.png" width="700">
					<br></br>
					<h3>Die Karte umfasst verschiedene Elemente und Funktionen:</h3>
					
					<ul>
						<li>Im oberen rechten Bereich befindet sich eine Übersichtskarte, die eine relative Lokalisierung gewährleistet und den aktuellen Kartenausschnitt im größeren Kontext zeigt. Die Übersichtskarte lässt sich aber ebenfalls mit dem kleinen Pfeil in der Ecke ausblenden.<br></li>
						<li>Im rechten oberen Bereich der Karte findet der Nutzer ebenfalls die Basiskartengallerie. Mit einem Klick auf eine entsprechende Basiskarte ändert sich diese in der Hauptkarte.</li>
						<li>Im linken unteren Bereich wird der aktuelle Maßstab des Kartenausschnitts aufgezeigt.</li>
						<li>In der linken Seitennavigation gibt das "Table of Content" Informationen über die sich im Kartenausschnitt befindlichen Kartenlayer. Mit einem Klick auf einen entsprechenden Layer lässt sich dieser ein oder ausblenden. Weiterhin dient das TOC als Legende.</li>
						<li>Der Kartenausschnitt visualisiert den angewählten Geodaten.</li>
					</ul>
					</br>
					</div>
					</br>
					
				</div>
			  </dd>
			  <ul class="side-nav"><li class="divider"></li></ul>
			  <dd class="accordion-navigation">
				<a href="#panel2a">Messungen zeigen</a>
				<div id="panel2a" class="content">
				  </br>	
					<div class="panel" style="margin-left:5%">
								
					<p>Das WebGIS besteht aus einer Karte, die einerseits statisches Kartenmaterial, wie ein Höhenmodell und verschiedene Luftbilder sowie dynamische Layer, die per Web Processing Service von einem ArcGIS Server durch den Benutzer nachgeladen werden können.<br></p>
					
					<img src="../img/help/map-help.png" width="700">
					<br></br>
					<h3>Die Karte umfasst verschiedene Elemente und Funktionen:</h3>
					
					<ul>
						<li>Im oberen rechten Bereich befindet sich eine Übersichtskarte, die eine relative Lokalisierung gewährleistet und den aktuellen Kartenausschnitt im größeren Kontext zeigt. Die Übersichtskarte lässt sich aber ebenfalls mit dem kleinen Pfeil in der Ecke ausblenden.<br></li>
						<li>Im rechten oberen Bereich der Karte findet der Nutzer ebenfalls die Basiskartengallerie. Mit einem Klick auf eine entsprechende Basiskarte ändert sich diese in der Hauptkarte.</li>
						<li>Im linken unteren Bereich wird der aktuelle Maßstab des Kartenausschnitts aufgezeigt.</li>
						<li>In der linken Seitennavigation gibt das "Table of Content" Informationen über die sich im Kartenausschnitt befindlichen Kartenlayer. Mit einem Klick auf einen entsprechenden Layer lässt sich dieser ein oder ausblenden. Weiterhin dient das TOC als Legende.</li>
						<li>Der Kartenausschnitt visualisiert den angewählten Geodaten.</li>
					</ul>
					</br>
					</div>
					</br>
				</div>
			  </dd>
			  <ul class="side-nav"><li class="divider"></li></ul>
			  <dd class="accordion-navigation">
				<a href="#panel3a">Messungen hinzufügen</a>
				<div id="panel3a" class="content">
				 </br>	
					<div class="panel" style="margin-left:5%">
								
					<p>Das WebGIS besteht aus einer Karte, die einerseits statisches Kartenmaterial, wie ein Höhenmodell und verschiedene Luftbilder sowie dynamische Layer, die per Web Processing Service von einem ArcGIS Server durch den Benutzer nachgeladen werden können.<br></p>
					
					<img src="../img/help/map-help.png" width="700">
					<br></br>
					<h3>Die Karte umfasst verschiedene Elemente und Funktionen:</h3>
					
					<ul>
						<li>Im oberen rechten Bereich befindet sich eine Übersichtskarte, die eine relative Lokalisierung gewährleistet und den aktuellen Kartenausschnitt im größeren Kontext zeigt. Die Übersichtskarte lässt sich aber ebenfalls mit dem kleinen Pfeil in der Ecke ausblenden.<br></li>
						<li>Im rechten oberen Bereich der Karte findet der Nutzer ebenfalls die Basiskartengallerie. Mit einem Klick auf eine entsprechende Basiskarte ändert sich diese in der Hauptkarte.</li>
						<li>Im linken unteren Bereich wird der aktuelle Maßstab des Kartenausschnitts aufgezeigt.</li>
						<li>In der linken Seitennavigation gibt das "Table of Content" Informationen über die sich im Kartenausschnitt befindlichen Kartenlayer. Mit einem Klick auf einen entsprechenden Layer lässt sich dieser ein oder ausblenden. Weiterhin dient das TOC als Legende.</li>
						<li>Der Kartenausschnitt visualisiert den angewählten Geodaten.</li>
					</ul>
					</br>
					</div>
					</br>
				</div>
			  </dd>
			  <ul class="side-nav"><li class="divider"></li></ul>
			  <dd class="accordion-navigation">
				<a href="#panel4a">Technisches</a>
				<div id="panel4a" class="content">
				  </br>	
					<div class="panel" style="margin-left:5%">
								
					<p>Das WebGIS besteht aus einer Karte, die einerseits statisches Kartenmaterial, wie ein Höhenmodell und verschiedene Luftbilder sowie dynamische Layer, die per Web Processing Service von einem ArcGIS Server durch den Benutzer nachgeladen werden können.<br></p>
					
					<img src="../img/help/map-help.png" width="700">
					<br></br>
					<h3>Die Karte umfasst verschiedene Elemente und Funktionen:</h3>
					
					<ul>
						<li>Im oberen rechten Bereich befindet sich eine Übersichtskarte, die eine relative Lokalisierung gewährleistet und den aktuellen Kartenausschnitt im größeren Kontext zeigt. Die Übersichtskarte lässt sich aber ebenfalls mit dem kleinen Pfeil in der Ecke ausblenden.<br></li>
						<li>Im rechten oberen Bereich der Karte findet der Nutzer ebenfalls die Basiskartengallerie. Mit einem Klick auf eine entsprechende Basiskarte ändert sich diese in der Hauptkarte.</li>
						<li>Im linken unteren Bereich wird der aktuelle Maßstab des Kartenausschnitts aufgezeigt.</li>
						<li>In der linken Seitennavigation gibt das "Table of Content" Informationen über die sich im Kartenausschnitt befindlichen Kartenlayer. Mit einem Klick auf einen entsprechenden Layer lässt sich dieser ein oder ausblenden. Weiterhin dient das TOC als Legende.</li>
						<li>Der Kartenausschnitt visualisiert den angewählten Geodaten.</li>
					</ul>
					</br>
					</div>
					</br>
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