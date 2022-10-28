<?php
    $db = mysqli_connect("localhost", "root", "12345678", "blog juegos");
    mysqli_query($db, "SET NAMES 'utf-8'");

    session_start();
?>