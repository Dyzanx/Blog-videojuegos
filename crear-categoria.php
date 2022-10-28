<?php
    require_once("includes/redirect.php");
    require_once("includes/header.php");
    require_once("includes/sidebar.php");
?>

<!-- contenido principal -->
<div class="principal">
    <h1>Crear una nueva categoria</h1>

    <p class="content-info">Añade categorias al blog, para permitir a los usuarios usarlas al momento de la creacion de sus entradas a cerca de los videojuegos </p>
    <?php if(isset($_SESSION['success-category'])): ?>
        <div class="alerta"><?= $_SESSION['success-category'] ?></div>
    <?php endif; ?>

    <form action="components/save-category.php" method="post">
        <label for="name">Nombre de la nueva categoria : </label>
        <input type="text" name="name" autocomplete="off">
        <?php echo isset($_SESSION['error-category']) ? mostrarErrores($_SESSION["error-category"], "name") : "" ?>

        <input type="submit" value="Crear categoria">
    </form>
    <?php borrarErrores(); ?>
</div>

<?php require_once("includes/footer.php"); ?>