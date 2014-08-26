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
                                    <div id="dataplot"></div>
                                    <div id="weatherplot"></div>
                                    <div id="plotter-loading" class="plotter-processing"><img src="../img/map/loading.gif" width="200" height="200"></div>
                                    <div id="plotter-success" class="plotter-processing"><img src="../img/map/success.png" width="200" height="200"></div>
                                </div>
                                <div id="scatterplot-settings">
                                    <h3>Messadaten anzeigen: <input id="plot-data" type="radio" name="choose"> </h3>
                                    <h4>Datum von / bis:</h4>
                                    Von: <input class="date" id="data-start-date">
                                    Bis: <input class="date" id="data-end-date"> <br>
                                    Temperatur: <input type="radio" id="data-temp" name="data-radio">
                                    Pegelstand: <input type="radio" id="data-gauge" name="data-radio"> <br>
                                    Methan: <input type="radio" id="data-ch4" name="data-radio1">
                                    Kohlendioxid: <input type="radio" id="data-co2" name="data-radio1"> <br>
                                    
                                    <a href="webgis.php?site=1" target="_blank">Site 1:</a> <input type="checkbox" id="data-site1">
                                    <a href="webgis.php?site=2" target="_blank">Site 2:</a> <input type="checkbox" id="data-site2">
                                    <a href="webgis.php?site=3" target="_blank">Site 3:</a> <input type="checkbox" id="data-site3">
                                    <a href="webgis.php?site=4" target="_blank">Site 4:</a> <input type="checkbox" id="data-site4">
                                    
                                    <h3>Wetterdaten anzeigen: <input id="plot-weather" type="radio" name="choose"></h3>
                                    <h4>Datum von / bis:</h4>
                                    Von:        <input class="date" id="weather-start-date">
                                    Bis:        <input class="date" id="weather-end-date"> <br>
                                    Regen:      <input type="checkbox" id="weather-rain"        class="color {valueElement:'rain-color',styleElement:'rain-color-show'}">               <input type="hidden" id="rain-color" value="#000000">       <input type="text" size = "1" id="rain-color-show" readonly><br>
                                    Par:        <input type="checkbox" id="weather-par"         class="color {valueElement:'par-color',styleElement:'par-color-show'}">                 <input type="hidden" id="par-color" value="#000000">        <input type="text" size = "1" id="par-color-show" readonly><br>
                                    Temperatur: <input type="checkbox" id="weather-temperatur"  class="color {valueElement:'temperatur-color',styleElement:'temperatur-color-show'}">   <input type="hidden" id="temperatur-color" value="#000000"> <input type="text" size = "1" id="temperatur-color-show" readonly><br>
                                    Luftfeuchte:<input type="checkbox" id="weather-humidity"    class="color {valueElement:'humidity-color',styleElement:'humidity-color-show'}">       <input type="hidden" id="humidity-color" value="#000000">   <input type="text" size = "1" id="humidity-color-show" readonly><br>
                                    Wind:       <input type="checkbox" id="weather-wind"        class="color {valueElement:'wind-color',styleElement:'wind-color-show'}">               <input type="hidden" id="wind-color" value="#000000">       <input type="text" size = "1" id="wind-color-show" readonly><br>
                                    Böen:       <input type="checkbox" id="weather-gust"        class="color {valueElement:'gust-color',styleElement:'gust-color-show'}">               <input type="hidden" id="gust-color" value="#000000">       <input type="text" size = "1" id="gust-color-show" readonly><br>
                                </div>
			</div>
			
			<div class="switch-content" id="changeuser-content">
				<p>anderes</p>
			</div>
                        
                        <footer>
                                <a href="http://www.uni-muenster.de/HydrologieBodenkunde/LUTHERbog.html" id="projectinfo">Projektinfomationen</a>
				<a href="help.php" id="help">Hilfe</a>
				<a href="#" id="impressum">Impressum</a>
			</footer>
                </div>
                <script src="../js/login.js"></script>';
                <script src="../js/userinterface.js"></script>
                <script src="../js/plotter.js"></script>
	</body>
</html>