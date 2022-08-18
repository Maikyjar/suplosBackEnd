<?php
    //Se realiza la conexion a la base de datos con el manejador de errores Try and Catch
    //se esta mostrando un error en respecto a la linea 9 de este archivo a pesar de que la variable esta declarada de forma correcta
    try {
        $host = "localhost";
        $user = "root";
        $clave = "";
        $bd = "intelcost_bienes";
        $conexionBd = mysqli_connect($host, $user, $$clave, $bd) or die ("could not connect to mysql");
        /* if(isset($conexionBd)) {
            echo "si esta";
        } */
        global $conexionBd;
    } catch (\Throwable $th) {
        echo $th;
    }
?>