<?php
session_start();
$_SESSION['page'] = 'map';
include 'granted.php';
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
                            <a href='http://www.uni-muenster.de/Landschaftsoekologie/'><img src=../img/iloek_logo.png></a>
                            <a href='../index.php'><h1>LUTHERbog WebGIS</h1></a>
				<nav>
					<ul>
						<li><a href=logout.php class="header-buttons" id="logout">Ausloggen</a></li>
						<li><a href="upload.php" class="header-buttons" id="upload">Daten hinzuf&uuml;gen</a></li>
						<li><a href="access.php" class="header-buttons" id="access">Daten einsehen</a></li>
					</ul>
				</nav>
			</header>
			
			<div id="logout-content">
				<form action="#" method="post">
					<h1>Sie sind angemeldet als:</h1>
					<p><?php echo $_SESSION['vorname']." ".$_SESSION['nachname']; ?></p>
				</form>
			</div>
			
			<div id='map'></div>
			<div id='mapcontrol'></div>
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
			
		<script src="../js/login.js"></script>
		<script src="../js/map.js"></script>
		<script src="../js/userinterface.js"></script>                
	</body>
</html>