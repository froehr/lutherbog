<?php
session_start();
$_SESSION['page'] = 'access';
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
						<li><a href="logout.php" class="header-buttons" id="logout">Ausloggen</a></li>
						<li><a href="upload.php" class="header-buttons" id="upload">Daten hinzuf&uuml;gen</a></li>
						<li><a href="webgis.php" class="header-buttons" id="webgis">Webgis</a></li>
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
                        
                        <div id="switch">
				<ul>
					<li id="plotten"><h1>Daten Plotten</h1></li>
					<li id="changeuser"><h1>anderes</h1></li>
				</ul>
			</div>
			
			<div class="switch-content" id="plotten-content">
				<h2>Auf dieser Seite k&ouml;nnen Daten geplottet werden:</h2>
                                <div id="scatterplot">
                                </div>
                                <div id="scatterplot-settings">
                                    <h3>Daten ausw&auml;hlen:</h3>
                                    Von: <input type="date" id="start-date">
                                    Bis: <input type="date" id="end-date"> </br>
                                    Methan: <input type="radio" name="type"> </br>
                                    Kohlendioxid: <input type="radio" name="type">
                                </div>
			</div>
			
			<div class="switch-content" id="changeuser-content">
				<p>anderes</p>
			</div>
                        
                        <footer>
                                <a href="http://www.uni-muenster.de/HydrologieBodenkunde/LUTHERbog.html" id="projectinfo">Projektinfomationen</a>
				<a href="#" id="help">Hilfe</a>
				<a href="#" id="impressum">Impressum</a>
			</footer>
                        
                <script src="../js/login.js"></script>';
                <script src="../js/userinterface.js"></script>
                <script src="../js/plotter.js"></script>
	</body>
</html>