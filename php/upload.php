<?php
session_start();
$_SESSION['page'] = 'upload';
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
						<li><a href="logout.php" class="header-buttons" id="logout">Ausloggen</a></li>
						<li><a href="access.php" class="header-buttons" id="access">Daten einsehen</a></li>
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
					<li id="calibration"><h1>Kalibrierung</h1></li>
					<li id="weather"><h1>Wetterstation</h1></li>
                                        <li id="methan"><h1>CH4</h1></li>
                                        <li id="cholendioxid"><h1>CO2</h1></li>
				</ul>
			</div>
                        
                        <div class=switch-content id=calibration-content>
                            <h2>Auf dieser Seite k&ouml;nnen t&auml;gliche Messungen kalibriert werde:</h2>
                            <table>
                                <tr>
                                        <td>Datum</td>
                                        <td><input class="date" name="date" id="date" required/></td>
                                </tr>
                                
                                <tr>
                                        <td colspan="2"><div class="submit"><input type="submit" value="Login &nbsp; &#9658;" id="submit" /></div></td>
                                </tr>
                            </table>
			</div>
                        
                        <div class=switch-content id=weather-content>
			    <h2>Auf dieser Seite k&ouml;nnen Wetterdaten im CSV Format hochgeladen werden:</h2>
                                
                            <input type="file" id="files" name="files"/>
                            <div id="list"></div>
                            
                            Anzahl der Zeilen, die am Anfang ignoriert werden <input id="upload_offset" type="text" default="0"><br>
                            <p>Da die Datenbank bestimmte Daten erwartet muss die Reihenfolge dieser Daten angegeben werden:<br>
                            Mögliche Werte sind: date, rain, par, temp, rh, wind_speed, gust_speed<br>
                            Es ist möglich die Reihenfolge zu variieren je nach Reihenfolge der Datei, die hochgeladen wird.<br>
                            Es können Daten weggelassen werden, wenn diese nicht in der Datei enthalten sind.<br>
                            Die Schreibweise darf sich jedoch nicht verändern.<br></p>
                            Reihenfolge der Attribute mit Komma getrennt: <input id="upload_attributes" type="text" placeholder="Wert 1, Wert 2, ..., Wert n"><br>
                            
                            <div class="submit-button" id="upload-button">
                                <p>Speichern</p>
                            </div>
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
                        
                <?php
                    if(isset($_SESSION['user'])){
                            echo '<script src="../js/login.js"></script>';
                    }
		?>
                </div>
		<script src="../js/userinterface.js"></script>
                <script src="../js/upload.js"></script> 
	</body>
</html>