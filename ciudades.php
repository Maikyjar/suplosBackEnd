<?php
    //Se crea un array con todas las ciudades del archivo .json
    $data = file_get_contents("data-1.json");
    $bienes = json_decode($data, true);
    $ciudades = array();
    foreach ($bienes as $bien) {
        if(!in_array($bien["Ciudad"], $ciudades)) {
            array_push($ciudades, $bien["Ciudad"]);
        }
    }
?>