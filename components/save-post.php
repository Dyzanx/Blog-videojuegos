<?php  
    if(isset($_POST)){
        require_once("../includes/connect_db.php");

        if(!isset($_SESSION)){
            session_start();
        }

        $user_id = $_SESSION['user']['id'];
        $category = isset($_POST['category']) ? mysqli_real_escape_string($db, $_POST['category']) : false;
        $title = isset($_POST['title']) ? mysqli_real_escape_string($db, $_POST['title']) : false;
        $description = isset($_POST['description']) ? mysqli_real_escape_string($db, $_POST['description']) : false;
        $entrada = $_POST['id'];

        $err = [];

        if($title && !empty($title) && !is_numeric($title)){
            $valid_title = true;
        }else{
            $valid_title = false;
            $err['title'] = "El titulo ingresado es invalido";
        }
        if($description && !empty($description) && !is_numeric($description)){
            $valid_description = true;
        }else{
            $valid_description = false;
            $err['description'] = "La descripcion ingresada es invalida";
        }

        $_SESSION['error-post'] = $err;

        if(count($err) == 0){
            if(isset($_POST['id'])){
                $sql = "UPDATE entradas SET titulo = '$title', descripcion = '$description', categoria_id = $category, fecha = CURDATE() "
                        ."WHERE id = $entrada AND user_id = $user_id";
            }else{
                $sql = "INSERT INTO entradas VALUES(NULL, $user_id, $category, '$title', '$description', CURDATE());";
            }

            $save = mysqli_query($db, $sql);
            if($save){
                $_SESSION['succes-post'] = "Entrada guardada satisfactoriamente";
                header("Location: ../index.php");
            }else{
                $_SESSION['error-post'] = "No se pudo guardar la entrada";
                header("Location: ../crear-entradas.php");
            }
        }else{
            if(isset($_POST['id'])){
                header("Location: ../editar-entrada.php?id=$entrada");
            }else{
                header("Location: ../crear-entradas.php");
            }

        }
    }

?>