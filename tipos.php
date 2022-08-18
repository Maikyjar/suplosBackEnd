<?php
    //Se crea un array con todos los tipos del archivo .json
    $data = file_get_contents("data-1.json");
    $bienes = json_decode($data, true);
    $tipos = array();
    foreach ($bienes as $bien) {
        if(!in_array($bien["Tipo"], $tipos)) {
            array_push($tipos, $bien["Tipo"]);
        }
    }
?>