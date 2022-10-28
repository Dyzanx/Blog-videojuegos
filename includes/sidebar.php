<?php require_once("helpers.php"); ?>

<!-- sidebar -->
<div class="sidebar">
    <aside class="lateral">
        <div id="buscador" class="block-aside">
            <h3>Buscar en el blog</h3>
            <form action="buscar.php" method="post">
                <label for="search">Buscar entradas por titulo </label>
                <input type="text" name="search" autocomplete="off">

                <input type="submit" value="Buscar">
            </form>
        </div>
    </aside>
    <?php if(isset($_SESSION['user'])): ?>
    <aside class="lateral">
        <div id="loged-user" class="block-aside">
            <h3>Hola <?= $_SESSION['user']['nombre'] ?>!, bienvenido</h3>
            <!-- Botones -->
            <a href="crear-entradas.php" class="button green-button">Crear entradas</a>
            <a href="crear-categoria.php" class="button">Crear categorias</a>
            <a href="mis-datos.php" class="button orange-button">Mis datos</a>
            <a href="components/logout.php" class="button red-button">Cerrar sesion</a>
        </div>
    </aside>
    <?php else: ?>
    <aside class="lateral">
        <div id="loged-user" class="block-aside">
            <h3>Iniciar sesión</h3>
            <?php if(isset($_SESSION["error-login"])): ?>
            <div class="alerta alerta-error">
                <?= $_SESSION["error-login"] ?>
            </div>
            <?php endif; ?>
            <form action="components/login.php" method="post">
                <label for="email">Email: </label>
                <input type="email" name="email" autocomplete="off">

                <label for="pass">Contraseña: </label>
                <input type="password" name="password" autocomplete="off">

                <input type="submit" value="Ingresar">
            </form>
        </div>
    </aside>

    <aside class="lateral">
        <div id="register" class="block-aside">
            <h3>Registrarse</h3>

            <!-- Mostrar alertas -->
            <?php if(isset($_SESSION['success'])): ?>
            <div class="alerta alerta-exitosa">
                <?= $_SESSION["success"] ?>
            </div>
            <?php elseif(isset($_SESISON["error"])): ?>
            <div class="alerta alerta-error">
                <?=$_SESSION["error"]["general"]?>
            </div>
            <?php endif; ?>

            <form action="components/register.php" method="post">
                <label for="name">Nombres: </label>
                <input type="text" name="name" autocomplete="off">
                <?php echo isset($_SESSION['error']) ? mostrarErrores($_SESSION["error"], "name") : "" ?>

                <label for="surname">Apellidos: </label>
                <input type="text" name="surname" autocomplete="off">
                <?php echo isset($_SESSION['error']) ? mostrarErrores($_SESSION["error"], "surname") : "" ?>

                <label for="email">Email: </label>
                <input type="email" name="email" autocomplete="off">
                <?php echo isset($_SESSION['error']) ? mostrarErrores($_SESSION["error"], "email") : "" ?>

                <label for="pass">Contraseña: </label>
                <input type="password" name="pass" autocomplete="off">
                <?php echo isset($_SESSION['error']) ? mostrarErrores($_SESSION["error"], "password") : "" ?>

                <input type="submit" value="Registrarse">
            </form>
            <?php borrarErrores(); ?>
        </div>
    </aside>
    <?php endif; ?>
</div>