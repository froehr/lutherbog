<?php session_start();?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php
			include 'php/head.php';
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
						<li><form action="php/logout.php" method="post"><input name="submit" type="submit" value="Ausloggen" class="header-buttons" id="logout" /></form></li>
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