<?php
session_start(); 
    $_SESSION['id'] = '';
    $_SESSION['user'] = '';
    $_SESSION['map'] = '';
    $_SESSION['data'] = '';
    $_SESSION['page'] = '';
    
    session_destroy();
    
echo '<script>window.location = "../../index.php";</script>';

?>