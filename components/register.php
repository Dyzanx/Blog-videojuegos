<?php
    if(isset($_POST)){
        require_once("../includes/connect_db.php");

        if(!isset($_SESSION)){
            session_start();
        }

        $name = isset($_POST['name']) ? mysqli_real_escape_string($db, $_POST['name']) : false;
        $surname = isset($_POST['surname']) ? mysqli_real_escape_string($db, $_POST['surname']) : false;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($db, $_POST['email']) : false;
        $password = isset($_POST['pass']) ? mysqli_real_escape_string($db, $_POST['pass']) : false;


        $err = [];


        if(!empty($name) && !is_numeric($name) && !preg_match("/[0-9]/", $name)){
            $valid_name = true;
        }else{
            $valid_name = true;
            $err["name"] = "El nombre es invalido";
        }

        if(!empty($surname) && !is_numeric($surname) && !preg_match("/[0-9]/", $surname)){
            $valid_surname = true;
        }else{
            $valid_surname = true;
            $err["surname"] = "Los apellidos son invalidos";
        }

        if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
            $valid_email = true;
        }else{
            $valid_email = true;
            $err["email"] = "El email es invalido";
        }

        if(!empty($password)){
            $valid_password = true;
        }else{
            $valid_password = true;
            $err["password"] = "La contraseña es invalida";
        }

        $save_user = false;
        if(count($err) == 0){
            $save_user = true;

            $secure_password = password_hash($password, PASSWORD_BCRYPT, ["cost"=>5]);
            $sql = "INSERT INTO usuarios VALUES(NULL, '$name', '$surname', '$email', '$secure_password', CURDATE());";

            $save = mysqli_query($db, $sql);

            if($save){
                $_SESSION['success'] = "Tu registro ha sido completado :D";
            }else{
                $_SESSION["error"]["general"] = "Ups, sucedió algo al completar el registro :c";
            }
        }else{
            $_SESSION["error"] = $err;
        }
    }

    header("Location: ../index.php");
?>