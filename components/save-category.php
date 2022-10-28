<?php 
    if(isset($_POST)){
        require_once("../includes/connect_db.php");

        $name = isset($_POST['name']) ? mysqli_real_escape_string($db, $_POST['name']) : false;

        $err = [];

        if($name && !empty($name) && !is_numeric($name)){
            $valid_name = true;
        }else{
            $valid_name = false;
            $err['name'] = "El nombre ingresado es invalido";
        }

        $_SESSION['error-category'] = $err;

        if(count($err) == 0){
            $sql = "INSERT INTO categorias VALUES(NULL, '$name')";
            $save = mysqli_query($db, $sql);

            if($save){
                $_SESSION['success-category'] = "Categoria creada correctamente";
            }else{
                $_SESSION['error-category'] = 'Error en la creacion de la categoria';
            }
        }
    }

    header("Location: ../crear-categoria.php");
?>