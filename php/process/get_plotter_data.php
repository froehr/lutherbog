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
        $start_date = htmlentities(mysql_real_escape_string($_POST['data_start_date']));
        $end_date = htmlentities(mysql_real_escape_string($_POST['data_end_date']));
        $ch4 = htmlentities(mysql_real_escape_string($_POST['ch4']));
        $co2 = htmlentities(mysql_real_escape_string($_POST['co2']));
        $site1 = htmlentities(mysql_real_escape_string($_POST['site1']));
        $site2 = htmlentities(mysql_real_escape_string($_POST['site2']));
        $site3 = htmlentities(mysql_real_escape_string($_POST['site3']));
        $site4 = htmlentities(mysql_real_escape_string($_POST['site4']));
        
        // Sites auswählen      
        $values = "";
        
        if ($site1 == 'true'){
            $values .= " OR sites.site_id = 1";
        }
        if ($site2 == 'true'){
            $values .= " OR sites.site_id = 2";
        }
        if ($site3 == 'true'){
            $values .= " OR sites.site_id = 3";
        }
        if ($site4 == 'true'){
            $values .= " OR sites.site_id = 4";
        }

        // Nachstehendes Komma löschen
        $values = substr($values, 4, 1000);
        
        if ($site1 == 'true' || $site2 == 'true' || $site3 == 'true' || $site4== 'true' ) {
           $values = "AND (" . $values . ")"; 
        }
        else {
            $values = "AND (sites.site_id = 10000)";
        }
        
        // Array initialisieren, dass später alle Ergebnisse aus der DB speichert
        $output = [];
        
        // Datum in MySQL Format ändern;
        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        
        // Abzufragende Werte aus DB lesen
        if ($ch4 == 'true'){
            $query = "SELECT ch4.value, ch4.date, collar.name, sites.site_id FROM ch4 INNER JOIN collar ON ch4.collar_id=collar.collar_id INNER JOIN  sites ON collar.site_id=sites.site_id WHERE (`ch4`.`date` BETWEEN '". $start_date ."' AND '". $end_date ."') " . $values;
            $result = mysql_query($query);
            if (mysql_num_rows($result) != 0) {
                $i = 0;
                while ($row = mysql_fetch_object($result)) {      
                    $output[$i]['ch4']['date'] = date_format(date_create($row->date), "d.m.Y");
                    $output[$i]['ch4']['ch4_value'] = floatval($row->value);
                    $output[$i]['ch4']['collar'] = $row->name;
                    
                    $query1 = "SELECT water_gauge.value, water_gauge.date FROM ch4 INNER JOIN water_gauge ON ch4.collar_id = water_gauge.collar_id WHERE water_gauge.date = '". $row->date ."' GROUP BY date";
                    $result1 = mysql_query($query1);
                    if (mysql_num_rows($result1) != 0) {
                        $row1 = mysql_fetch_object($result1);
                        $output[$i]['ch4']['gauge_value'] = round(floatval($row1->value),2);
                    }
                        
                    $query2 = "SELECT AVG(temp) AS temperatur FROM `weatherstation` WHERE '" . $row->date . "' = date GROUP BY day";
                    $result2 = mysql_query($query2);
                    if (mysql_num_rows($result2) != 0) {
                        $row2 = mysql_fetch_object($result2);
                        $output[$i]['ch4']['temp_value'] = round(floatval($row2->temperatur),2);
                    }
                    $i++;
                }
            }
        }
        
        if ($co2 == 'true'){
            $query = "SELECT co2.value, co2.date, collar.name, sites.site_id FROM co2 INNER JOIN collar ON co2.collar_id=collar.collar_id INNER JOIN  sites ON collar.site_id=sites.site_id WHERE (`co2`.`date` BETWEEN '". $start_date ."' AND '". $end_date ."') " . $values;
            $result = mysql_query($query);
            if (mysql_num_rows($result) != 0) {
                $i = 0;
                while ($row = mysql_fetch_object($result)) {      
                    $output[$i]['co2']['date'] = date_format(date_create($row->date), "d.m.Y"); 
                    $output[$i]['co2']['co2_value'] = floatval($row->value);
                    $output[$i]['co2']['collar'] = $row->name;
                    
                    $query1 = "SELECT water_gauge.value, water_gauge.date FROM co2 INNER JOIN water_gauge ON co2.collar_id = water_gauge.collar_id WHERE water_gauge.date = '". $row->date ."' GROUP BY date";
                    $result1 = mysql_query($query1);
                    if (mysql_num_rows($result1) != 0) {
                        $row1 = mysql_fetch_object($result1);
                        $output[$i]['co2']['gauge_value'] = round(floatval($row1->value),2);
                    }
                        
                    $query2 = "SELECT AVG(temp) AS temperatur FROM `weatherstation` WHERE '" . $row->date . "' = date GROUP BY day";
                    $result2 = mysql_query($query2);
                    if (mysql_num_rows($result2) != 0) {
                        $row2 = mysql_fetch_object($result2);
                        $output[$i]['co2']['temp_value'] = round(floatval($row2->temperatur),2);
                    }
                    $i++;
                }
            }
        }
            
        $output = json_encode($output);
        echo $output;
    }
    
    else {
        echo "error";
    }
} 
?>