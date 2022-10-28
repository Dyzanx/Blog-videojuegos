<?php
    require_once("includes/header.php");
    require_once("includes/sidebar.php");
?>

<!-- contenido principal -->
<div class="principal">
    <h1>Ultimas entradas</h1>
    <?php 
        $entradas = conseguirEntradas($db, 5);
        if(!empty($entradas)):
        while($ent = mysqli_fetch_assoc($entradas)):
    ?>
    <article class="entrada">
        <a href="entrada.php?id=<?= $ent['id'] ?>">
            <h2><?= $ent["titulo"] ?></h2>
            <span class="input-info"><?= $ent['categoria']."  |  ".$ent['fecha'] ?></span>
            <p><?= substr($ent["descripcion"], 0, 500)."..." ?></p>
        </a>
    </article>
    <?php 
        endwhile;
        endif;
    ?>

    <div class="see-all">
        <a href="ver-entradas.php">Ver todas las entradas</a>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>