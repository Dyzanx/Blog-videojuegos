<?php
    require_once("includes/redirect.php");
    require_once("includes/header.php");
    require_once("includes/sidebar.php");
?>

<!-- contenido principal -->
<div class="principal">
    <h1>Crear una nuevas entradas</h1>

    <p class="content-info">Crea entradas a cerca de algun videojuego para que otros usuarios puedan leerla y disfrutar
        el contenido</p>
    <?php if(isset($_SESSION['succes-post'])): ?>
        <div class="alerta"><?= $_SESSION['succes-post'] ?></div>
    <?php endif; ?>

    <form action="components/save-post.php" method="post">
        <label for="category">Selecciona una categoria : </label>
        <select name="category">
            <?php 
                $categorias = conseguirCategorias($db);
                while($cat = mysqli_fetch_assoc($categorias)): 
            ?>
            <option value="<?= $cat['id'] ?>"><?= $cat['nombre'] ?></option>
            <?php endwhile; ?>
        </select>

        <label for="title">Titulo de la entradas : </label>
        <input type="text" name="title" autocomplete="off">
        <?php echo isset($_SESSION['error-post']) ? mostrarErrores($_SESSION["error-post"], "title") : "" ?>

        <label for="description">Descripcion : </label>
        <textarea name="description" id="" cols="30" rows="10"></textarea>
        <?php echo isset($_SESSION['error-post']) ? mostrarErrores($_SESSION["error-post"], "description") : "" ?>

        <input type="submit" value="Crear nueva entrada">
    </form>
    <?php borrarErrores(); ?>
</div>

<?php require_once("includes/footer.php"); ?>