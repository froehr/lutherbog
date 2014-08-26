<?php

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // Letzter Zugriffe mehr als X Sekunden her --> Logout
    session_unset();
    session_destroy();
}

$_SESSION['LAST_ACTIVITY'] = time();

if(isset($_SESSION['map'])){
    // In diesem Switch wird entschieden, ob ein bestimmter Benutzer zuggriff auf eine bestimmte Funktion der Seite hat. Falls ein Recht nicht besteht wird er auf
    // die Index umgeleitet. 
    switch($_SESSION['page']){
        case 'map':
            if($_SESSION['map'] > 0){
                break;
            }
            else{
                echo '<script>window.location = "../index.php";</script>';
                break;
            }
        case 'access':
            if($_SESSION['data'] > 0){
                break;
            }
            else{
                echo '<script>window.location = "../php/webgis.php";</script>';
                break;
            }
        case 'upload':
            if($_SESSION['data'] > 1){
                break;
            }
            else{
                echo '<script>window.location = "../php/webgis.php";</script>';
                break;
            }
        case 'administration':
            if($_SESSION['admin'] > 0){
                break;
            }
            else{
                echo '<script>window.location = "../index.php";</script>';
                break;
            }
    }
}
// Ist kein Benutzer eingeloggt bestehen auch keine Rechte
else{
    echo '<script>window.location = "../index.php";</script>';
}

?>