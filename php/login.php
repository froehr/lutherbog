<?php
if (isset($_POST['username']) && isset($_POST['password'])){
    $username = htmlentities(mysql_real_escape_string($_POST['username']));
    $password = sha1(htmlentities(mysql_real_escape_string($_POST['password'])));
  
    include 'db_config.php';
    $query = mysql_query("SELECT * FROM `login` WHERE `user` = '".$username."' AND `password` = '".$password."'");
    if (mysql_num_rows($query) != 0) {
            while ($row = mysql_fetch_object($query)) {
                    $_SESSION['id'] = $row->id;
                    $_SESSION['user'] = $row->user;
                    $_SESSION['map'] = $row->map;
                    $_SESSION['data'] = $row->data;
                    $_SESSION['admin'] = $row->admin;
                    $_SESSION['vorname'] = $row->vorname;
                    $_SESSION['nachname'] = $row->nachname;
                    $_SESSION['email'] = $row->email;
            }
    }
}
?>