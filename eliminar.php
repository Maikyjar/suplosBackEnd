<?php
    //Se requiere la conexion a la base de datos y se envia una query eliminando el registro con el Id recibido por el POST
    require "conexion.php";
    
    if(isset($_POST["identificacion"])){
        $Id= $_POST["identificacion"];
        $eliminar = "DELETE FROM bienes WHERE Id = '$Id'";
        $query = mysqli_query( $conexionBd, $eliminar);
        if($query) {
            echo('eliminado');
        } else {
            echo('incorrecto');
        }
    }
    header("location:index.php");
?>