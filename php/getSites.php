<?php
include 'db_config.php';

$output = [];
$i = 0;
  
$query = mysql_query("SELECT * FROM `sites` ORDER BY `id` ASC");
echo mysql_error();
if (mysql_num_rows($query) != 0) {
        while ($row = mysql_fetch_object($query)) {
                    
            $output[$i]['id'] = $row->id;
            $output[$i]['name'] = $row->name;
            $output[$i]['latitude'] = $row->latitude;
            $output[$i]['longitude'] = $row->longitude;
            
            $i++;
        }
}
$output = json_encode($output);
echo $output;
?>