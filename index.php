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
		
		<script src="js/lib/jquery/jquery-2.1.0.min.js"></script>
		<script src="js/lib/jquery/jquery-ui-1.10.4.js"></script>
		<script src="js/lib/introJS/intro.js"></script>
		<?php
			include 'php/process/login.php';
		?>
	</head>
	<body>
		<div id="page">
			<header>
                            <a href="http://www.uni-muenster.de/Landschaftsoekologie/"><img src="img/iloek_logo.png"></a>
                            <a href="#"><h1>LUTHERbog WebGIS</h1></a>
				<nav>
					<ul>
						<li><a href="#" class="header-buttons" id="login">Einloggen</a></li>
						<li><a href="php/process/logout.php" class="header-buttons" id="logout">Ausloggen</a></li>
						<li><a href="php/administration.php" class="header-buttons" id="admin">Administration</a></li>
						<li><a href="php/webgis.php" class="header-buttons" id="webgis">WebGIS</a></li>
						<li><a href="http://www.uni-muenster.de/HydrologieBodenkunde/LUTHERbog.html" class="header-buttons" id="project" target="_blank">Das Projekt</a></li>
						<li><a href="php/help.php" class="header-buttons" id="help-button">Hilfe / About</a></li>
					</ul>
				</nav>
			</header>
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
			
			<div id="logout-content">
				<form action="#" method="post">
					<h1>Sie sind angemeldet als:</h1>
					<p><?php echo $_SESSION['vorname']." ".$_SESSION['nachname']; ?></p>
					<p><?php echo $_SESSION['email']?></p>
				</form>
			</div>
			
			<div id="welcome">
				<h1>Willkommen zum WebGIS der Arbeitsgruppe Hydrologie</h1>
				<div id="welcome-about">
					<h2>Informationen</h2>
					<p>Dieses Websystem soll die Arbeit der Arbeitsgruppe Hydrologie erheblich erleichtern und nebensächliche Arbeiten wie Sortierung und Speicherung übernehmen.</p>
					<p>Gleichzeitig soll aber auch die Möglichkeit bestehen erste Auswertungen durchzuführen.</p>
					<img src="img/welcome/luther_bog_fotos.png" width="300px">
				</div>
				<div id="welcome-from">
					<h2>Entwicklung</h2>
					<p>Dieses webbasierte GIS System wurde im Zuge einer Bachelorarbeit von Fabian Röhr im Sommer 2014 entwickelt.</p>
					<p>Bis zum jetzigen Zeitpunkt handelt es sich jedoch nur um einen ersten Schritt,der das Grundgerüst und die wichtigsten Funktionen bereitstellt und auf dem in Zukunft aufgebaut werden kann.</p>
				</div>
				<div id="welcome-technologies">
					<h2>Technologien</h2>
					<p>Das System beruht zu großen Teilen auf ESRIs ArcGIS Server und der ArcGIS API for JavaScript 3.10. Damit können auf einfache Art und Weise Karten und Prozesse eingebunden werden</p>
					<p>Hinzu kommen natürlich noch andere Webtechnologien wie HTML, PHP und andere...</p>
					<img src="img/welcome/html-css-js.png" width="300px">
					<img src="img/welcome/php.png" width="200px"><br><br>
					<img src="img/welcome/mysql.jpg" width="200px">
				</div>
				<div id="welcome-news">
					<h2>Neuigkeiten</h2>
					<p>20.08.2014 - Umstellung von Leaflet auf die ArcGIS API for JavaScript zur Ermöglichung von Web Processing Services.</p>
					<p>17.08.2014 - Asychrone Datenübertragung führt zu besserer Geschwindigkeit.</p>
					<p>06.08.2014 - Erste Kartenansicht basierend auf Leaflet veröffentlicht. Grundlegende Aktionen sind damit bereits möglich.</p>
					<p>05.08.2014 - Wetterdaten können in einer Diagrammansicht dynamisch angezeigt werden.</p>
					<p>20.07.2014 - Login System eingefügt. Der Zugriff auf alle Daten ist nur noch nach vorherigem Einloggen möglich.</p>
					<p>11.07.2014 - Start der Programmierarbeit.</p>
					
				</div>
			</div>
			
			<div id='impressum-content'>
				<h1>Impressum</h1>
				<p>Diese Website ist im Zuge der Bachelorarbeit von Fabian Röhr entstanden.</p>
				<p>Die verarbeiteten Daten wurden von der Arbeitsgruppe Hydrologie, die von Prof. Dr. Blodau geleitet wird, gesammelt und zur Verfügung gestellt.</p>	
			</div>
                        
                        <footer>
                                <a href="http://www.uni-muenster.de/HydrologieBodenkunde/LUTHERbog.html" id="projectinfo">Projektinfomationen</a>
				<a href="php/help.php" id="help">Hilfe</a>
				<a href="#" id="impressum">Impressum</a>
			</footer>
		</div>
		
		<script src="js/login.js"></script>
		<script src="js/userinterface.js"></script>
		
	</body>
</html>