<?php
    require_once("includes/header.php");
    require_once("includes/sidebar.php");

    if(!isset($_POST['search'])){
        header("Location: index.php");
    }
?>

<!-- contenido principal -->
<div class="principal">
    <h1>Busqueda de: <?= $_POST['search'] ?></h1>

    <?php 
        $entradas = conseguirEntradas($db, null, null, $_POST['search']); 
        if(!empty($entradas) && mysqli_num_rows($entradas) >= 1):
        while($ent = mysqli_fetch_assoc($entradas)):
    ?>
        <article class="entrada">
            <a href="entrada.php?id=<?= $ent['id'] ?>">
                <h2><?= $ent["titulo"] ?></h2>
                <span class="input-info"><?= $ent['categoria']."  |  ".$ent['fecha'] ?></span>
                <p><?= substr($ent["descripcion"], 0, 500)."..." ?></p>
            </a>
        </article>
    <?php endwhile; ?>
    <?php else: ?>
        <div class="alerta">Al parecer no hay entradas correspondientes a esta categoria</div>
    <?php endif; ?>

</div>

<?php require_once("includes/footer.php"); ?>