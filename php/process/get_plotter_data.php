<?php
include 'db_config.php';

$output = [];
$i = 0;

// Daten für Wetterplot als JSON zurückliefern
if (isset($_POST['weather_start_date']) && isset($_POST['weather_end_date']) && $_POST['action'] == "weatherplot"){
    if ( $_POST['weather_start_date'] != "" && $_POST['weather_end_date'] != "") {    
        $start_date = htmlentities(mysql_real_escape_string($_POST['weather_start_date']));
        $end_date = htmlentities(mysql_real_escape_string($_POST['weather_end_date']));
        $rain = htmlentities(mysql_real_escape_string($_POST['rain']));
        $par = htmlentities(mysql_real_escape_string($_POST['par']));
        $temp = htmlentities(mysql_real_escape_string($_POST['temp']));
        $rh = htmlentities(mysql_real_escape_string($_POST['rh']));
        $wind_speed = htmlentities(mysql_real_escape_string($_POST['wind_speed']));
        $gust_speed = htmlentities(mysql_real_escape_string($_POST['gust_speed']));
        
        $values = "`id`, `date`,";
        
        // Abzufragende Werte setzen
        if ($rain == 'true'){
            $values .= " `rain`,";
        }
        if ($par == 'true'){
            $values .= " `par`,";
        }
        if ($temp == 'true'){
            $values .= " `temp`,";
        }
        if ($rh == 'true'){
            $values .= " `rh`,";
        }
        if ($wind_speed == 'true'){
            $values .= " `wind_speed`,";
        }
        if ($gust_speed == 'true'){
            $values .= " `gust_speed`,";
        }
        
        // Nachstehendes Komma löschen
        $values = substr($values, 0, -1);
        
        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        
        $query = "SELECT ". $values ." FROM `weatherstation` WHERE `date` BETWEEN '". $start_date ."' AND '". $end_date ."'";
        $result = mysql_query($query);
        if (mysql_num_rows($result) != 0) {
            while ($row = mysql_fetch_object($result)) {
                        
                $output[$i]['date'] = $row->date;
                $output[$i]['unixdate'] = strtotime($row->date) * 1000; 
                
                if ($rain == 'true'){
                    $output[$i]['rain'] = floatval($row->rain);
                }
                if ($par == 'true'){
                    $output[$i]['par'] = floatval($row->par);
                }
                if ($temp == 'true'){
                    $output[$i]['temp'] = floatval($row->temp);
                }
                if ($rh == 'true'){
                   $output[$i]['rh'] = floatval($row->rh);
                }
                if ($wind_speed == 'true'){
                    $output[$i]['wind_speed'] = floatval($row->wind_speed);
                }
                if ($gust_speed == 'true'){
                    $output[$i]['gust_speed'] = floatval($row->gust_speed);
                }
                $i++;
            }
        }
        $output = json_encode($output);
        echo $output;
    }
    else {
        echo "error";
    }
}

// Daten für Dataplot als JSON zurückgeben
if (isset($_POST['data_start_date']) && isset($_POST['data_end_date']) && $_POST['action'] == "dataplot"){
    if ( $_POST['data_start_date'] != "" && $_POST['data_end_date'] != "") {    
        $start_date = htmlentities(mysql_real_escape_string($_POST['weather_start_date']));
        $end_date = htmlentities(mysql_real_escape_string($_POST['weather_end_date']));
        $ch4 = htmlentities(mysql_real_escape_string($_POST['ch4']));
        $c02 = htmlentities(mysql_real_escape_string($_POST['co2']));
        $site1 = htmlentities(mysql_real_escape_string($_POST['site1']));
        $site2 = htmlentities(mysql_real_escape_string($_POST['site2']));
        $site3 = htmlentities(mysql_real_escape_string($_POST['site3']));
        $site4 = htmlentities(mysql_real_escape_string($_POST['site4']));
        $site5 = htmlentities(mysql_real_escape_string($_POST['site5']));
        $site6 = htmlentities(mysql_real_escape_string($_POST['site6']));
        
        // Array initialisieren, dass später alle Ergebnisse aus der DB speichert
        $output = [];
        
        // Datum in MySQL Format ändern;
        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        
        // Abzufragende Werte aus DB lesen
        if ($ch4 == 'true'){
	    if ($site1 == true){
                $query = "SELECT * FROM ch4 WHERE WHERE (`date` BETWEEN '". $start_date ."' AND '". $end_date ."') AND `site` = 1";
                $result = mysql_query($query);
                if (mysql_num_rows($result) != 0) {
                    $i = 0;
                    while ($row = mysql_fetch_object($result)) {      
                        $output[$i]['ch4_site1']['date'] = $row->date;
                        $output[$i]['ch4_site1']['unixdate'] = strtotime($row->date) * 1000; 
                        $output[$i]['ch4_site1']['value'] = floatval($row->value);
                        $i++;
                    }
                }
            }
            if ($site2 == true){
                $query = "SELECT * FROM ch4 WHERE WHERE (`date` BETWEEN '". $start_date ."' AND '". $end_date ."') AND `site` = 2";
                $result = mysql_query($query);
                if (mysql_num_rows($result) != 0) {
                    $i = 0;
                    while ($row = mysql_fetch_object($result)) {      
                        $output[$i]['ch4_site2']['date'] = $row->date;
                        $output[$i]['ch4_site2']['unixdate'] = strtotime($row->date) * 1000; 
                        $output[$i]['ch4_site2']['value'] = floatval($row->value);
                        $i++;
                    }
                }
            }
            if ($site3 == true){
                $query = "SELECT * FROM ch4 WHERE WHERE (`date` BETWEEN '". $start_date ."' AND '". $end_date ."') AND `site` = 3";
                $result = mysql_query($query);
                if (mysql_num_rows($result) != 0) {
                    $i = 0;
                    while ($row = mysql_fetch_object($result)) {      
                        $output[$i]['ch4_site3']['date'] = $row->date;
                        $output[$i]['ch4_site3']['unixdate'] = strtotime($row->date) * 1000; 
                        $output[$i]['ch4_site3']['value'] = floatval($row->value);
                        $i++;
                    }
                }
            }
            if ($site4 == true){
                $query = "SELECT * FROM ch4 WHERE WHERE (`date` BETWEEN '". $start_date ."' AND '". $end_date ."') AND `site` = 4";
                $result = mysql_query($query);
                if (mysql_num_rows($result) != 0) {
                    $i = 0;
                    while ($row = mysql_fetch_object($result)) {      
                        $output[$i]['ch4_site4']['date'] = $row->date;
                        $output[$i]['ch4_site4']['unixdate'] = strtotime($row->date) * 1000; 
                        $output[$i]['ch4_site4']['value'] = floatval($row->value);
                        $i++;
                    }
                }
            }
            if ($site5 == true){
                $query = "SELECT * FROM ch4 WHERE WHERE (`date` BETWEEN '". $start_date ."' AND '". $end_date ."') AND `site` = 5";
                $result = mysql_query($query);
                if (mysql_num_rows($result) != 0) {
                    $i = 0;
                    while ($row = mysql_fetch_object($result)) {      
                        $output[$i]['ch4_site5']['date'] = $row->date;
                        $output[$i]['ch4_site5']['unixdate'] = strtotime($row->date) * 1000; 
                        $output[$i]['ch4_site5']['value'] = floatval($row->value);
                        $i++;
                    }
                }
            }
            if ($site6 == true){
                $query = "SELECT * FROM ch4 WHERE WHERE (`date` BETWEEN '". $start_date ."' AND '". $end_date ."') AND `site` = 6";
                $result = mysql_query($query);
                if (mysql_num_rows($result) != 0) {
                    $i = 0;
                    while ($row = mysql_fetch_object($result)) {      
                        $output[$i]['ch4_site6']['date'] = $row->date;
                        $output[$i]['ch4_site6']['unixdate'] = strtotime($row->date) * 1000; 
                        $output[$i]['ch4_site6']['value'] = floatval($row->value);
                        $i++;
                    }
                }
            }
        }
        
        if ($co2 == 'true'){
            if ($site1 == true){
                $query = "SELECT * FROM co2 WHERE WHERE (`date` BETWEEN '". $start_date ."' AND '". $end_date ."') AND `site` = 1";
                $result = mysql_query($query);
                if (mysql_num_rows($result) != 0) {
                    $i = 0;
                    while ($row = mysql_fetch_object($result)) {      
                        $output[$i]['co2_site1']['date'] = $row->date;
                        $output[$i]['co2_site1']['unixdate'] = strtotime($row->date) * 1000; 
                        $output[$i]['co2_site1']['value'] = floatval($row->value);
                        $i++;
                    }
                }
            }
            if ($site2 == true){
                $query = "SELECT * FROM co2 WHERE WHERE (`date` BETWEEN '". $start_date ."' AND '". $end_date ."') AND `site` = 2";
                $result = mysql_query($query);
                if (mysql_num_rows($result) != 0) {
                    $i = 0;
                    while ($row = mysql_fetch_object($result)) {      
                        $output[$i]['co2_site2']['date'] = $row->date;
                        $output[$i]['co2_site2']['unixdate'] = strtotime($row->date) * 1000; 
                        $output[$i]['co2_site2']['value'] = floatval($row->value);
                        $i++;
                    }
                }
            }
            if ($site3 == true){
                $query = "SELECT * FROM co2 WHERE WHERE (`date` BETWEEN '". $start_date ."' AND '". $end_date ."') AND `site` = 3";
                $result = mysql_query($query);
                if (mysql_num_rows($result) != 0) {
                    $i = 0;
                    while ($row = mysql_fetch_object($result)) {      
                        $output[$i]['co2_site3']['date'] = $row->date;
                        $output[$i]['co2_site3']['unixdate'] = strtotime($row->date) * 1000; 
                        $output[$i]['co2_site3']['value'] = floatval($row->value);
                        $i++;
                    }
                }
            }
            if ($site4 == true){
                $query = "SELECT * FROM co2 WHERE WHERE (`date` BETWEEN '". $start_date ."' AND '". $end_date ."') AND `site` = 4";
                $result = mysql_query($query);
                if (mysql_num_rows($result) != 0) {
                    $i = 0;
                    while ($row = mysql_fetch_object($result)) {      
                        $output[$i]['co2_site4']['date'] = $row->date;
                        $output[$i]['co2_site4']['unixdate'] = strtotime($row->date) * 1000; 
                        $output[$i]['co2_site4']['value'] = floatval($row->value);
                        $i++;
                    }
                }
            }
            if ($site5 == true){
                $query = "SELECT * FROM co2 WHERE WHERE (`date` BETWEEN '". $start_date ."' AND '". $end_date ."') AND `site` = 5";
                $result = mysql_query($query);if (mysql_num_rows($result) != 0) {
                    $i = 0;
                    while ($row = mysql_fetch_object($result)) {      
                        $output[$i]['co2_site5']['date'] = $row->date;
                        $output[$i]['co2_site5']['unixdate'] = strtotime($row->date) * 1000; 
                        $output[$i]['co2_site5']['value'] = floatval($row->value);
                        $i++;
                    }
                }
            }
            if ($site6 == true){
                $query = "SELECT * FROM co2 WHERE WHERE (`date` BETWEEN '". $start_date ."' AND '". $end_date ."') AND `site` = 6";
                $result = mysql_query($query);
                if (mysql_num_rows($result) != 0) {
                    $i = 0;
                    while ($row = mysql_fetch_object($result)) {      
                        $output[$i]['co2_site6']['date'] = $row->date;
                        $output[$i]['co2_site6']['unixdate'] = strtotime($row->date) * 1000; 
                        $output[$i]['co2_site6']['value'] = floatval($row->value);
                        $i++;
                    }
                }
            }
        }
        $output = json_encode($output);
        echo 'blals';
    }
    
    else {
        echo "error";
    }
} 
?>