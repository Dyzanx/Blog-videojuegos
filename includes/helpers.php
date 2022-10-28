<?php
    function mostrarErrores($error, $field){
        $alert = '';
        if(isset($error[$field]) && !empty($field)){
            $alert = "<div class='alerta alerta-error'>$error[$field]</div>";
        }

        return $alert;
    }

    function borrarErrores(){
        $unset = false;

        if(isset($_SESSION["error"])){
            $_SESSION["error"] = null;
        }
        if(isset($_SESSION["success"])){
            $_SESSION["success"] = null;
        }

        if(isset($_SESSION["error-post"])){
            $_SESSION["error-post"] = null;
        }
        if(isset($_SESSION["succes-post"])){
            $_SESSION["succes-post"] = null;
        }

        if(isset($_SESSION["success-category"])){
            $_SESSION["success-category"] = null;
        }
        if(isset($_SESSION["error-category"])){
            $_SESSION["error-category"] = null;
        }

        if(isset($_SESSION["success-user-update"])){
            $_SESSION["success-user-update"] = null;
        }
        if(isset($_SESSION["error-user-update"])){
            $_SESSION["error-user-update"] = null;
        }

        return $unset;
    }

    function conseguirCategorias($conexion){
        $sql = "SELECT * FROM categorias ORDER BY id ASC;";
        $categorias = mysqli_query($conexion, $sql);
        
        $res = [];
        if($categorias && mysqli_num_rows($categorias) >= 1){
            $res = $categorias;
        }

        return $res;
    }

    function conseguirCategoria($conexion, $id){
        $sql = "SELECT * FROM categorias WHERE id = $id;";
        $cat = mysqli_query($conexion, $sql);
        
        $res = [];
        if($cat && mysqli_num_rows($cat) >= 1){
            $res = mysqli_fetch_assoc($cat);
        }

        return $res;
    }

    function conseguirEntradas($conexion, $limit = null, $categoria = null, $busqueda = null){
        $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e ".
                "INNER JOIN categorias c ON e.categoria_id = c.id ";

        if($categoria != null && is_numeric($categoria)){
            $sql .= "WHERE e.categoria_id = $categoria ";
        }
        if($busqueda != null){
            $sql .= "WHERE e.titulo LIKE '%$busqueda%' ";
        }
        $sql .= "ORDER BY id DESC ";
        if($limit != null){
            $sql .= "LIMIT $limit";
        }
        $entradas = mysqli_query($conexion, $sql);
        
        $res = [];
        if($entradas && mysqli_num_rows($entradas) >= 1){
            $res = $entradas;
        }

        return $res;
    }

    function conseguirEntrada($conexion, $id){
        $sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellido) AS usuario ".
                "FROM entradas e ".
                "INNER JOIN categorias c ON e.categoria_id = c.id ".
                "INNER JOIN usuarios u ON e.user_id = u.id ".
                "WHERE e.id = $id";

        $ent = mysqli_query($conexion, $sql);
        
        $res = [];
        if($ent && mysqli_num_rows($ent) >= 1){
            $res = mysqli_fetch_assoc($ent);
        }

        return $res;
    }   
?>