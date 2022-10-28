<?php
    require_once '../includes/connect_db.php';

    if(isset($_SESSION['user']) && isset($_GET['id'])){
        $user_id = $_SESSION['user']['id'];
        $post_id = $_GET['id'];
        
        $sql = "DELETE FROM entradas WHERE user_id = $user_id AND id = $post_id";
        $query = mysqli_query($db, $sql);
    }

    header("Location: ../index.php")
?>