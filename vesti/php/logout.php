<?php
    session_start();
    if(isset($_GET['logout'])){
        if($_GET['logout'] == 1){
            session_destroy();
            header('location: ../index.php');
        }
    }
?>