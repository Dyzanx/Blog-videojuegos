<?php
    require_once("includes/header.php");
    require_once("includes/sidebar.php");

    $ent = conseguirEntrada($db, $_GET['id']);
    if(!isset($ent['id'])){
        header("Location: index.php");
    }
?>

<!-- contenido principal -->
<div class="principal">
    <h1><?= $ent['titulo'] ?></h1>
    <a href="categoria.php?id=<?= $ent['categoria_id'] ?>">
        <h2><?= $ent['categoria'] ?></h2>
    </a>
    <h4><?= $ent['fecha'] ?>  |  <?= $ent['usuario'] ?></h4>

    <p><?= $ent['descripcion'] ?></p>
    
    <?php if(isset($_SESSION['user']) && $_SESSION['user']['id'] === $ent['user_id']): ?>
        <a href="editar-entrada.php?id=<?= $ent['id'] ?>" class="button green-button button-post">Editar entrada</a>
        <a href="components/delete-post.php?id=<?= $ent['id'] ?>" class="button button-post">Eliminar entrada</a>
    <?php endif; ?>
</div>

<?php require_once("includes/footer.php"); ?>