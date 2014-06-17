<?php
session_start();
$_SESSION['page'] = 'administration';
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
						<li><a href="#" class="header-buttons" id="login">Einloggen</a></li>
						<li><a href=logout.php class="header-buttons" id="logout">Ausloggen</a></li>
						<li><a href="webgis.php" class="header-buttons" id="webgis">WebGIS</a></li>
						<li><a href="http://www.uni-muenster.de/HydrologieBodenkunde/LUTHERbog.html" class="header-buttons" id="project" target="_blank">Das Projekt</a></li>
					</ul>
				</nav>
			</header>
			
			<div id="logout-content">
				<form action="#" method="post">
					<h1>Sie sind angemeldet als:</h1>
					<p><?php echo $_SESSION['vorname']." ".$_SESSION['nachname']; ?></p>
				</form>
			</div>
			
			<div id="switch">
				<ul>
					<li id="viewuser"><h1>Benutzer anzeigen</h1></li>
					<li id="changeuser"><h1>Benutzer &auml;ndern / L&ouml;schen</h1></li>
					<li id="adduser"><h1>Benutzer hinzuf&uuml;gen</h1></li>
				</ul>
			</div>
			
			<div class=switch-content id=viewuser-content>
				<h2>Auf dieser Seite k&ouml;nnen bestehende Benutzer und ihre Rechte eingesehen werden:</h2>
				<?php include 'view-user.php' ?>
			</div>
			
			<div class=switch-content id=changeuser-content>
				<p>Changeuser</p>
			</div>
			
			<div class=switch-content id=adduser-content>
				<h2>Auf dieser Seite k&ouml;nnen neue Benutzer erstellt werden:</h2>
				
				<table>
					<form action="#" method="post">
						<tr>
							<td>Benutzername</td>
							<td><input type="text" name="username" id="username" required/></td>
						</tr>
						<tr>
							<td>Passwort</td>
							<td><input type="password" name="password" id="password" required/></td>
						</tr>
						<tr>
							<td>Passwort wiederholen</td>
							<td><input type="password" name="password" id="password" required/></td>
						</tr>
						<tr>
							<td>Vorname</td>
							<td><input type="text" name="username" id="username" required/></td>
						</tr>
						<tr>
							<td>Nachname</td>
							<td><input type="text" name="username" id="username" required/></td>
						</tr>
						<tr>
							<td>Rechte</td>
							<td><input type="radio" name="username" id="username" required/></td>
						</tr>
						<tr>
							<td colspan="2"><div class="submit"><input type="submit" value="Login &nbsp; &#9658;" id="submit" /></div></td>
						</tr>
					</form>
				</table>
			</div>
			
			
			<div id="impressum-content">
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
		<script src="../js/userinterface.js"></script>
                <script src="../js/login.js"></script>
	</body>
</html>