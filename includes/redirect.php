<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['user']) || $_SESSION['user'] == null){
        header("Location: index.php");
    }
?>