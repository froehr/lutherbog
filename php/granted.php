<?php
if(isset($_SESSION['map'])){
    switch($_SESSION['page']){
        case 'map':
            if($_SESSION['map'] > 0){
                break;
            }
            else{
                echo '<script>window.location = "../index.php";</script>';
                break;
            }
        case 'access':
            if($_SESSION['data'] > 0){
                break;
            }
            else{
                echo '<script>window.location = "../php/webgis.php";</script>';
                break;
            }
        case 'upload':
            if($_SESSION['data'] > 1){
                break;
            }
            else{
                echo '<script>window.location = "../php/webgis.php";</script>';
                break;
            }
    }
}
else{
    echo '<script>window.location = "../index.php";</script>';
}


?>