<?php
    if(isset($_POST)){
        require_once("../includes/connect_db.php");

        if(isset($_SESSION["error-login"])){
            // session_unset($_SESSION['error-login']);
            $_SESSION["error-login"] = null;
        }

        if(!isset($_SESSION)){
            session_start();
        }

        $email = trim($_POST["email"]);      
        $password = $_POST['password'];

        $sql = "SELECT * FROM usuarios WHERE email = '$email'";

        $get_user = mysqli_query($db, $sql);

        if($get_user && mysqli_num_rows($get_user) == 1){
            $user = mysqli_fetch_assoc($get_user);

            $secure_password = password_hash($password, PASSWORD_BCRYPT, ["cost"=>5]);
            $verify = password_verify($password, $user["contraseña"]);

            if($verify){
                $_SESSION['user'] = $user;
            }else{
                $_SESSION["error-login"] = "Ups, sucedió algo al iniciar sesion";
            }
        }else{
            $_SESSION["error-login"] = "Credenciales incorrectos";
        }
    }

    header("Location: ../index.php");
?>