<?php 
    if(isset($_POST)){
        require_once("../includes/connect_db.php");

        if(!isset($_SESSION)){
            session_start();
        }

        $name = isset($_POST['name']) ? mysqli_real_escape_string($db, $_POST['name']) : false;
        $surname = isset($_POST['surname']) ? mysqli_real_escape_string($db, $_POST['surname']) : false;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($db, $_POST['email']) : false;

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

        $update_user = false;
        if(count($err) == 0){
            $update_user = true;

            $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
            $request = mysqli_query($db, $sql);
            $db_user = mysqli_fetch_assoc($request);

            if($db_user['id'] == $_SESSION['user']['id'] || !empty($db_user)){
                if($_SESSION['user']['email'] != $email){
                    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
                    $query = mysqli_query($db, $sql);

                    if(mysqli_num_rows($query) == 0){
                        $sql = "UPDATE usuarios SET nombre = '$name', apellido = '$surname', email = '$email' WHERE id = {$_SESSION['user']['id']}";
                    }else{
                        $sql = "UPDATE usuarios SET nombre = '$name', apellido = '$surname' WHERE id = {$_SESSION['user']['id']}";
                        $err['email'] = "el correo ya existe en la base de datos";
                    }
                }else{
                    $sql = "UPDATE usuarios SET nombre = '$name', apellido = '$surname' WHERE id = {$_SESSION['user']['id']}";
                    $err['email'] = "el correo ya existe en la base de datos";
                }

                $update = mysqli_query($db, $sql);

                if($update){
                    $_SESSION['user']['nombre'] = $name;
                    $_SESSION['user']['apellido'] = $surname;
                    $_SESSION['user']['email'] = $email;

                    $_SESSION['success-user-update'] = "Datos actualizados correctamente :D";
                }else{
                    $_SESSION["error-user-update"]['general'] = "Ups, sucedió algo al completar el camhbio de tu informacion :c";
                }
            }else{
                $SESSION["error-user-update"]['general'] = "El usuario ya existe"; 
            }
        }

        $_SESSION["error-user-update"] = $err;
    }

    header("Location: ../mis-datos.php");
?>