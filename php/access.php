<?php
session_start();
$_SESSION['page'] = 'access';
include 'granted.php';

echo "Hier wird zugegriffen";

?>