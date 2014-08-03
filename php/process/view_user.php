<?php
include 'db_config.php';

$output = '<table>
                <tr>
                    <th>Vorname</th>
                    <th>Nachname</th>
                    <th>Email</th>
                    <th>Benutzername</th>
                    <th>Karte</th>
                    <th>Daten</th>
                    <th>Admin</th>
                    <th>&Auml;ndern</th>
                </tr>';
  
$query = mysql_query("SELECT * FROM `login` ORDER BY `Nachname` ASC");
echo mysql_error();
if (mysql_num_rows($query) != 0) {
        while ($row = mysql_fetch_object($query)) {
                $id = $row->id;
                $user = $row->user;
                $map = $row->map;
                $data = $row->data;
                $admin = $row->admin;
                $vorname = $row->vorname;
                $nachname = $row->nachname;
                $email = $row->email;
                
                switch($admin){
                    case '0':
                        $admin = 'Nein';
                        break;
                    case '1':
                        $admin = 'Ja';
                        break;
                }
                
                switch($data){
                    case '0':
                        $data = 'Kein Zugriff';
                        break;
                    case '1':
                        $data = 'Ansehen';
                        break;
                    case '2':
                        $data = '&Auml;ndern';
                        break;
                }
                
                switch($map){
                    case '0':
                        $map = 'Kein Zugriff';
                        break;
                    case '1':
                        $map = 'Ansehen';
                        break;
                    case '2':
                        $map = '&Auml;ndern';
                        break;
                }
                
                $output .= '<tr>
                                <td>'.$vorname.'</td>
                                <td>'.$nachname.'</td>
                                <td><a href="mailto:'.$email.'">'.$email.'</a></td>
                                <td>'.$user.'</td>
                                <td>'.$map.'</td>
                                <td>'.$data.'</td>
                                <td>'.$admin.'</td>
                                <td>Hier Symbol</td>
                            </tr>';
        }
}

$output .= '</table>';

echo $output;
?>