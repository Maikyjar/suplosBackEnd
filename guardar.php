<?php
    //Se realiza la conexion a la base de datos y se inserta en la base de datos realizando el volcado de los datos necesarios segun su estructura
    require "conexion.php";
    $data = file_get_contents("data-1.json");
    $bienes = json_decode($data, true);
    
    if(isset($_POST["identificacion"])){  
        $guardarBien = "";
        foreach ($bienes as $bien) {
            if($bien["Id"] == $_POST['identificacion']) {
                $guardarBien = $bien;
            }
        }
        $Id= $guardarBien["Id"];
        $Direccion = $guardarBien["Direccion"] ;
        $Ciudad =  $guardarBien["Ciudad"];
        $Telefono = $guardarBien["Telefono"];
        $Codigo_Postal =  $guardarBien["Codigo_Postal"];
        $Tipo = $guardarBien["Tipo"] ;
        $Precio =  $guardarBien["Precio"];
        $insertar = "INSERT INTO bienes VALUES ('$Id','$Direccion', '$Ciudad', '$Telefono', '$Codigo_Postal', '$Tipo', '$Precio')";
        $query = mysqli_query( $conexionBd, $insertar);
        if($query) {
            echo('guardado');
        } else {
            echo('incorrecto');
        }
    }
    header("location:index.php");
?>