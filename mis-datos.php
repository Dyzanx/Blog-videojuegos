<?php
    require_once("includes/redirect.php");
    require_once("includes/header.php");
    require_once("includes/sidebar.php");
?>

<!-- contenido principal -->
<div class="principal">
    <h1>Editar informacion de tu cuenta</h1>

    <p class="content-info">actualiza la informacion de tu perfil de ususario</p>
    <?php if(isset($_SESSION['success-user-update'])): ?>
        <div class="alerta"><?= $_SESSION['success-user-update'] ?></div>
    <?php elseif(isset($_SESSION['error-user-update']['general'])): ?>
        <div class="alerta alerta-error"><?= $_SESSION['error-user-update']['general'] ?></div>
    <?php endif; ?>

    <form action="components/update-user.php" method="post">
        <label for="name">Nombre(s) : </label>
        <input type="text" name="name" value="<?= $_SESSION['user']['nombre'] ?>">
        <?php echo isset($_SESSION['error-user-update']) ? mostrarErrores($_SESSION["error-user-update"], "name") : "" ?>

        <label for="surname">Apellido(s) : </label>
        <input type="text" name="surname" value="<?= $_SESSION['user']['apellido'] ?>">
        <?php echo isset($_SESSION['error-user-update']) ? mostrarErrores($_SESSION["error-user-update"], "surname") : "" ?>

        
        <label for="email">Email : </label>
        <input type="text" name="email" value="<?= $_SESSION['user']['email'] ?>">
        <?php echo isset($_SESSION['error-user-update']) ? mostrarErrores($_SESSION["error-user-update"], "email") : "" ?>

        <input type="submit" value="Actualizar datos">
    </form>
    <?php borrarErrores(); ?>
</div>

<?php require_once("includes/footer.php"); ?>