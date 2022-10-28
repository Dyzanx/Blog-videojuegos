<?php
    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_SESSION['user'])){
        // session_destroy($_SESSION['user']);
        $_SESSION['user'] = null;
        session_unset($_SESSION['user']);
    }

    header("Location: ../index.php")
?>