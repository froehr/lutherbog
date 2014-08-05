<?php
include 'db_config.php';

$output = [];
$i = 0;

// Daten fŸr Wetterplot als JSON zurŸckliefern
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
        
        // Nachstehendes Komma lšschen
        $values = substr($values, 0, -1);
        
        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        
        $query = "SELECT ". $values ." FROM `weatherstation` WHERE `date` BETWEEN '". $start_date ."' AND '". $end_date ."'";
        $result = mysql_query($query);
        if (mysql_num_rows($result) != 0) {
                while ($row = mysql_fetch_object($result)) {
                            
                    $output[$i]['id'] = $row->id;
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

// Daten fŸr Dataplot als JSON zurŸckgeben
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
        
        $values = "`id`, `date`,";
        
        // Abzufragende Werte setzen
        if ($ch4 == 'true'){
            $values .= " `rain`,";
        }
        if ($co2 == 'true'){
            $values .= " `par`,";
        }
        
        $values = substr($values, 0, -1);
        
        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        
        $query = "";
        $result = mysql_query($query);
    }
}
?>

















