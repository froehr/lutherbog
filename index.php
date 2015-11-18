<?php
if(!isset($_SESSION)){
	session_start();
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<title>LUTHERbog Canada</title>
		<link href="img/favicon.ico" rel="icon" type="image/x-icon" />
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<link href="js/lib/jquery/jquery-ui-1.10.4.css" rel="stylesheet" type="text/css" />	
		<link href="js/lib/introJS/themes/introjs-nassim.css" rel="stylesheet" type="text/css" >
		<link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/foundation.css">
		<script src="js/lib/jquery/jquery-2.1.0.min.js"></script>
		<script src="js/lib/jquery/jquery-ui-1.10.4.js"></script>
		<script src="js/lib/introJS/intro.js"></script>
		<script src="js/vendor/modernizr.js"></script>

		<?php
			include 'php/process/login.php';
		?>
	</head>
	<body>
		<div id="page">
			<header>
			<nav class="top-bar">
			<div style="padding-bottom: 15px">
				<div class="show-for-medium-up">    
					<a href="http://www.uni-muenster.de/Landschaftsoekologie/"><img src="img/iloek_logo.png"></a>
				</div>   
			<ul class="title-area">
					<a href="#"><h1>LUTHERbog WebGIS</h1></a>
			</ul>
				<section class="top-bar-section">
				<div class="show-for-large-up">
					<ul class="right">
						<li style="padding-top: 10px"><a href="#" class="button" id="login">Einloggen</a></li>
						<li style="padding-top: 10px"><a href="php/process/logout.php" class="button" id="logout">Ausloggen</a></li>
						<li style="padding-top: 10px"><a href="php/administration.php" class="button" id="admin">Administration</a></li>
						<li style="padding-top: 10px"><a href="php/webgis.php" class="button" id="webgis">WebGIS</a></li>
						<li style="padding-top: 10px"><a href="http://www.uni-muenster.de/HydrologieBodenkunde/LUTHERbog.html" class="button" id="project" target="_blank">Das Projekt</a></li>
						<li style="padding-top: 10px"><a href="php/help.php" class="button" id="help-button">Hilfe / About</a></li>
					</ul>
				</div>
				
						<div id="login-content">
							<h1>Benutzername</h1>
							<input type="text" id="username" onkeypress="if(event.keyCode==13) {login();}" autofocus/>
							<h1>Passwort</h1>
							<input type="password" id="password" onkeypress="if(event.keyCode==13) {login();}"/>
							<div id="input-error">
								Benutzername oder Passwort ist leer
							</div>
							<div id="login-error">
								Benutzername oder Passwort ist falsch
							</div>
							<div id="login-success">
								Sie wurden erfolgreich eingeloggt!
							</div>
							<div class="submit-button" id="login-button">
								<p>Login &nbsp; &#9658;</p>
							</div>
						</div>
						
				</section>
				
				<ul class="right" style="margin-top:10px">
				<div class="hide-for-large-up">
					
					<a href="#" data-reveal-id="myModal"><img src="img/welcome/menu.png" width="40" height="40"></a>
					<div id="myModal" class="reveal-modal [tiny]" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
					    <a href="#" data-reveal-id="secondModal" class="button" id="login">Einloggen</a><br></br>
						<a href="php/process/logout.php" class="button" id="logout">Ausloggen</a><br></br>
						<a href="php/administration.php" class="button" id="admin">Administration</a><br></br>
						<a href="php/webgis.php" class="button" id="webgis">WebGIS</a><br></br>
						<a href="http://www.uni-muenster.de/HydrologieBodenkunde/LUTHERbog.html" class="button" id="project" target="_blank">Das Projekt</a><br></br>
						<a href="php/help.php" class="button" id="help-button">Hilfe / About</a><br></br>
						<a class="close-reveal-modal" aria-label="Close">&#215;</a>
					
						
					</div>
					
					<div id="secondModal" class="reveal-modal" data-reveal aria-labelledby="secondModalTitle" aria-hidden="true" role="dialog">
					  <h2 id="secondModalTitle">Einloggen</h2>
					  <div id="login-content2">
							<h2>Benutzername</h2>
							<input type="text" id="username" onkeypress="if(event.keyCode==13) {login();}" autofocus/>
							<h2>Passwort</h2>
							<input type="password" id="password" onkeypress="if(event.keyCode==13) {login();}"/>
							<div id="input-error">
								Benutzername oder Passwort ist leer
							</div>
							<div id="login-error">
								Benutzername oder Passwort ist falsch
							</div>
							<div id="login-success">
								Sie wurden erfolgreich eingeloggt!
							</div>
							<div class="submit-button" id="login-button">
								<p>Login &nbsp; &#9658;</p>
							</div>
						</div>
					<a class="close-reveal-modal" aria-label="Close">&#215;</a>
					</div>  
						    <div id="login-content">
								<h1>Benutzername</h1>
								<input type="text" id="username" onkeypress="if(event.keyCode==13) {login();}" autofocus/>
								<h1>Passwort</h1>
								<input type="password" id="password" onkeypress="if(event.keyCode==13) {login();}"/>
								<div id="input-error">
									Benutzername oder Passwort ist leer
								</div>
								<div id="login-error">
									Benutzername oder Passwort ist falsch
								</div>
								<div id="login-success">
									Sie wurden erfolgreich eingeloggt!
								</div>
								<div class="submit-button" id="login-button">
									<p>Login &nbsp; &#9658;</p>
								</div>
							</div>
					
				</ul>
				
				</div>
			</div>
			</nav>
			</header>
			
			
			
			
			
			<div id="logout-content">
				<form action="#" method="post">
					<h1>Sie sind angemeldet als:</h1>
					<p><?php echo $_SESSION['vorname']." ".$_SESSION['nachname']; ?></p>
				</form>
			</div>
			
			
			<div class="rows">
				<div class="show-for-large-up">
					</br>
					<center><h2>Willkommen zum WebGIS der Arbeitsgruppe Hydrologie</h2></center>
					</br>
				</div>
				<div class="show-for-medium-only">
					</br>
					<center><h2>Willkommen zum WebGIS der Arbeitsgruppe Hydrologie</h2></center>
					</br>
				</div>
				<div class="show-for-small-only">
					</br>
					<center><h3>Willkommen zum WebGIS der Arbeitsgruppe Hydrologie</h3></center>
					</br>
				</div>
				
				<div class="small-12 medium-6 large-3 columns">
					<div class="panel">
					<h2>Informationen</h2>
					<p>Dieses Websystem soll die Arbeit der Arbeitsgruppe Hydrologie erheblich erleichtern und nebensächliche Arbeiten wie Sortierung und Speicherung übernehmen.</p>
					<p>Gleichzeitig soll aber auch die Möglichkeit bestehen erste Auswertungen durchzuführen.</p>
					<p>Gastzugang:</br> Benutzername: gast </br>Passwort:123</p>
					<img src="img/welcome/luther_bog_fotos.png" width="300px">
					</div>
				</div>
				
				<div class="small-12 medium-6 large-3 columns">
					<div class="panel">
					<h2>Entwicklung</h2>
					<p>Dieses webbasierte GIS System wurde im Zuge einer Bachelorarbeit von Fabian Röhr im Sommer 2014 entwickelt.</p>
					<p>Im Herbst 2015 wurde dieses WebGIS erweitert und optimiert.</p>
					</div>
				</div>
				
				<div class="small-12 medium-6 large-3 columns">
					<div class="panel">
					<h2>Technologien</h2>
					<p>Das System beruht zu großen Teilen auf ESRIs ArcGIS Server und der ArcGIS API for JavaScript 3.10. Damit können auf einfache Art und Weise Karten und Prozesse eingebunden werden</p>
					<p>Hinzu kommen natürlich noch andere Webtechnologien wie HTML, PHP und andere...</p>
					<img src="img/welcome/html-css-js.png" width="300px">
					<img src="img/welcome/esri.png" width="200px"><br><br>
					<img src="img/welcome/php.png" width="200px"><br><br>
					<img src="img/welcome/mysql.jpg" width="200px">
					</div>
				</div>
				
				<div class="small-12 medium-6 large-3 columns">
					<div class="panel">
					<h2>Neuigkeiten</h2>
					<p>30.10.2015 - Drag and Drop für Bilder und .csv-Dateien realisiert.</p>
					<p>30.10.2015 - Unbegrenzter Zoom möglich.</p>
					<p>16.10.2015 - Anpassung des Designs für mobile Endgeräte mit Foundation.</p>
					<p>23.09.2015 - Berechnungs des NDVI für die Flüge möglich.</p>
					<p>22.09.2015 - Ergebnis der Bachelorarbeit von Niclas Kolbe einbegunden.</p>
					<p>03.09.2015 - Kleine Layout-Änderungen zur Übersichtlichkeit.</p>
					<p>15.08.2015 - GetCapabilities der Flüge können angerufen werden.</p>
					<p>10.08.2015 - UAS Flights können angezeigt werden und ein Shapefile kann hinzugefügt werden.</p>
					<p>05.08.2015 - Strecken und Flächen können nun in der Karte gemessen werden.</p>
					<p>2015       - Luisa Bodem Übernimmt.</p>
					<p>27.08.2014 - Plotten von CH4 und CO2 Daten ist jetzt möglich.</p>
					<p>20.08.2014 - Umstellung von Leaflet auf die ArcGIS API for JavaScript zur Ermöglichung von Web Processing Services.</p>
					<p>17.08.2014 - Asychrone Datenübertragung führt zu besserer Geschwindigkeit.</p>
					<p>06.08.2014 - Erste Kartenansicht basierend auf Leaflet veröffentlicht. Grundlegende Aktionen sind damit bereits möglich.</p>
					<p>05.08.2014 - Wetterdaten können in einer Diagrammansicht dynamisch angezeigt werden.</p>
					<p>20.07.2014 - Login System eingefügt. Der Zugriff auf alle Daten ist nur noch nach vorherigem Einloggen möglich.</p>
					<p>11.07.2014 - Start der Programmierarbeit.</p>
					</div>
				</div>
			</div>	
		
			
			
                        
			<footer>
			<ul class="breadcrumbs">
			  <li class="current"><a href="#">Home</a></li>
			  <li><a href="http://www.uni-muenster.de/HydrologieBodenkunde/LUTHERbog.html" id="projectinfo">Projektinformation</a></li>
			  <li><a href="php/help.php" id="help">Hilfe</a></li>
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
		
		<script src="js/login.js"></script>
		<script src="js/userinterface.js"></script>
		<script src="js/vendor/jquery.js"></script>
		<script src="js/vendor/fastclick.js"></script>	
		<script src="js/foundation.min.js"></script>
			
		<script>
			$(document).foundation();
		</script>
		
	</body>
</html>