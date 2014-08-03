<?php
if(!isset($_SESSION)){
	session_start();
}

include 'db_config.php';

if (isset($_POST['username']) && isset($_POST['action']) && $_POST['action'] == 'testUsername'){
    $username = htmlentities(mysql_real_escape_string($_POST['username']));

    $query = mysql_query("SELECT * FROM `login` WHERE `user` = '".$username."'");
    if (mysql_num_rows($query) == 1) {
        echo ("error");
    }
    
    else{
        echo ("success");
    };
}

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['mapaccess']) && isset($_POST['dataaccess']) && isset($_POST['adminaccess']) && isset($_POST['action']) && $_POST['action'] == 'insertIntoDB'){
    $username = htmlentities(mysql_real_escape_string($_POST['username']));
    $password = sha1(htmlentities(mysql_real_escape_string($_POST['password'])));
    $name = htmlentities(mysql_real_escape_string($_POST['name']));
    $surname = htmlentities(mysql_real_escape_string($_POST['surname']));
    $email = htmlentities(mysql_real_escape_string($_POST['email']));
    $mapaccess = htmlentities(mysql_real_escape_string($_POST['mapaccess']));
    $dataaccess = htmlentities(mysql_real_escape_string($_POST['dataaccess']));
    $adminaccess = htmlentities(mysql_real_escape_string($_POST['adminaccess']));
    
    $result = mysql_query("INSERT INTO `login`(`user`, `password`, `map`, `data`, `admin`, `vorname`, `nachname`, `email`)
                    VALUES ('".$username."','".$password."','".$mapaccess."','".$dataaccess."','".$adminaccess."','".$name."','".$surname."','".$email."')");
    
    if ($result == true) {
        echo ("success");
    } 
    else{
        echo ("error");
    };
}
?>