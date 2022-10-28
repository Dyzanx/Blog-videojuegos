<?php
    require_once("includes/redirect.php");
    require_once("includes/header.php");
    require_once("includes/sidebar.php");
?>

<!-- contenido principal -->
<div class="principal">
    <h1>Editar entrada</h1>
    <p class="content-info">Edita el contenido de tus entradas del blog <?php $ent['titulo'] ?></p>

    <?php if(isset($_SESSION['succes-post'])): ?>
        <div class="alerta"><?= $_SESSION['succes-post'] ?></div>
    <?php endif; ?>

    <form action="components/save-post.php" method="post">
        <label for="category">Selecciona una categoria : </label>
        <select name="category">
            <?php 
                $categorias = conseguirCategorias($db);
                $ent = conseguirEntrada($db, $_GET['id']);
                while($cat = mysqli_fetch_assoc($categorias)): 
                    if($cat['id'] == $ent['categoria_id']):
            ?>
                        <option value="<?= $cat['id'] ?>" selected="true"><?= $cat['nombre'] ?></option>
                    <?php endif; ?>
                    <?php if($cat['id'] != $ent['categoria_id']):?>
                        <option value="<?= $cat['id'] ?>"><?= $cat['nombre'] ?></option>
                    <?php endif; ?>
            <?php endwhile; ?>
        </select>

        <label for="title">Titulo de la entradas : </label>
        <input type="text" name="title" value="<?= $ent['titulo'] ?>" autocomplete="off">
        <?php echo isset($_SESSION['error-post']) ? mostrarErrores($_SESSION["error-post"], "title") : "" ?>

        <label for="description">Descripcion : </label>
        <input type="text" name="description" value="<?= $ent['descripcion'] ?>" autocomplete="off">
        <?php echo isset($_SESSION['error-post']) ? mostrarErrores($_SESSION["error-post"], "description") : "" ?>

        <input type="hidden" name="id" value="<?= $ent['id'] ?>">

        <input type="submit" value="Actualizar entrada">
    </form>
    <?php borrarErrores(); ?>
</div>

<?php require_once("includes/footer.php"); ?>