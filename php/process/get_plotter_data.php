<?php
include 'db_config.php';

$output = [];
$i = 0;

if (isset($_POST['weather_start_date']) && isset($_POST['weather_end_date'])){
    if ( $_POST['weather_start_date'] != "" && $_POST['weather_end_date'] != "") {    
        $start_date = htmlentities(mysql_real_escape_string($_POST['weather_start_date']));
        $end_date = htmlentities(mysql_real_escape_string($_POST['weather_end_date']));
        $rain = htmlentities(mysql_real_escape_string($_POST['rain']));
        $par = htmlentities(mysql_real_escape_string($_POST['par']));
        $temp = htmlentities(mysql_real_escape_string($_POST['temp']));
        $rh = htmlentities(mysql_real_escape_string($_POST['rh']));
        $wind_speed = htmlentities(mysql_real_escape_string($_POST['wind_speed']));
        $gust_speed = htmlentities(mysql_real_escape_string($_POST['gust_speed']));
        $bat = htmlentities(mysql_real_escape_string($_POST['bat']));
        
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
        if ($bat == 'true'){
            $values .= " `bat`,";
        }
        // Nachstehendes Komma lšschen
        $values = substr($values, 0, -1);
        
        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        
        $query = mysql_query("SELECT ". $values ." FROM `weatherstation` WHERE `date` >= '". $start_date ."' AND `date` <= '". $end_date ."'");
        if (mysql_num_rows($query) != 0) {
                while ($row = mysql_fetch_object($query)) {
                            
                    $output[$i]['id'] = $row->id;
                    $output[$i]['date'] = $row->date;
                    $output[$i]['unixdate'] = strtotime($row->date); 
                    
                    if ($rain == 'true'){
                        $output[$i]['rain'] = $row->rain;
                    }
                    if ($par == 'true'){
                        $output[$i]['par'] = $row->par;
                    }
                    if ($temp == 'true'){
                        $output[$i]['temp'] = $row->temp;
                    }
                    if ($rh == 'true'){
                       $output[$i]['rh'] = $row->rh;
                    }
                    if ($wind_speed == 'true'){
                        $output[$i]['wind_speed'] = $row->wind_speed;
                    }
                    if ($gust_speed == 'true'){
                        $output[$i]['gust_speed'] = $row->gust_speed;
                    }
                    if ($bat == 'true'){
                        $output[$i]['bat'] = $row->bat;
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
?>