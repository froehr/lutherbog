<?php
session_start();
$_SESSION['page'] = 'access';
include 'process/granted.php';
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
						<li><a href="process/logout.php" class="header-buttons" id="logout">Ausloggen</a></li>
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
                                    <div id="dataplot">
                                    </div>
                                    <div id="weatherplot">
                                    </div>
                                </div>
                                <div id="scatterplot-settings">
                                    <h3>Messadaten anzeigen: <input id="plot-data" type="radio" name="choose"> </h3>
                                    <h4>Datum von / bis:</h4>
                                    Von: <input class="date" id="start-date">
                                    Bis: <input class="date" id="end-date"> <br>
                                    Methan: <input type="radio" name="type"> <br>
                                    Kohlendioxid: <input type="radio" name="type">
                                    
                                    <h3>Wetterdaten anzeigen: <input id="plot-weather" type="radio" name="choose"></h3>
                                    <h4>Datum von / bis:</h4>
                                    Von: <input class="date" id="weather-start-date">
                                    Bis: <input class="date" id="weather-end-date"> <br>
                                    Regen: <input type="checkbox" id="weather-rain"> <br>
                                    Par: <input type="checkbox" id="weather-par"> <br>
                                    Temperatur: <input type="checkbox" id="weather-temperatur"> <br>
                                    Luftfeuchte: <input type="checkbox" id="weather-humidity"> <br>
                                    Wind: <input type="checkbox" id="weather-wind"> <br>
                                    B&ouml;en: <input type="checkbox" id="weather-gust"> <br>
                                    Bat: <input type="checkbox" id="weather-bat"> <br>
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
                </div>
                <script src="../js/login.js"></script>';
                <script src="../js/userinterface.js"></script>
                <script src="../js/plotter.js"></script>
	</body>
</html>