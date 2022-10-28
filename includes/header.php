<?php
    require_once("connect_db.php"); 
    require_once("helpers.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/style.css">

    <title>Blog de videojuegos</title>
</head>

<body>
    <!-- header -->
    <header class="header">
        <div class="logo">
            <a href="index.php">
                Blog de videojuegos
            </a>
        </div>

        <!-- menú -->
        <nav class="menu">
            <ul>
                <li><a href="index.php">Inicio</a></li>

                <?php
                    $categorias = conseguirCategorias($db);
                    if(!empty($categorias)):
                    while($cat = mysqli_fetch_assoc($categorias)): 
                ?>
                    <li><a href="categoria.php?id=<?= $cat['id'] ?>"><?= $cat['nombre'] ?></a></li>
                <?php  
                    endwhile;
                    endif; 
                ?>

                <li><a href="">Sobre mí</a></li>
                <li><a href="">Contacto</a></li>
            </ul>
        </nav>
        <div class="clearfix"></div>
    </header>

    <div class="container">