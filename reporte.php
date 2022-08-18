<?php
    //Se recibe toda la informacion en formato .json se convierte a un array PHP
    $data = file_get_contents("data-1.json");
    $bienes = json_decode($data, true);
    $resultadoCiudad = array();
    $resultadoTipo = array();
    //Se realizan los filtros opcionales
    if(isset($_POST['ciudad']) && isset($_POST['tipo'])) {
        $arrPrecio = explode(';',$_POST['precio']);

        foreach ($bienes as $bien) {
            if($bien["Ciudad"] == $_POST['ciudad']) {
                array_push($resultadoCiudad, $bien);
            }
        }
        
        foreach ($resultadoCiudad as $bien) {
          if($bien["Tipo"] == $_POST['tipo']) {
              array_push($resultadoTipo, $bien);
          }
        }
    }

    if(!isset($_POST['tipo']) && isset($_POST['ciudad']) ) {
        foreach ($bienes as $bien) {
            if($bien["Ciudad"] == $_POST['ciudad']) {
                array_push($resultadoTipo, $bien);
            }
        }
      }
  
    if( !isset($_POST['ciudad']) && isset($_POST['tipo']) ) {
        foreach ($bienes as $bien) {
            if($bien["Tipo"] == $_POST['tipo']) {
                array_push($resultadoTipo, $bien);
            }
        }
    }

    if(count($resultadoTipo) > 1) {
        $reporte = $resultadoTipo;
    } else {
        $reporte = $bienes;
    }
//Se realiza la exportacion a Excel con el formato de tabla
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename= archivo.xls');

?>
<table>
    <tr>
        <th>Id</th>
        <th>Direccion</th>
        <th>Ciudad</th>
        <th>Telefono</th>
        <th>Codigo_Postal</th>
        <th>Tipo</th>
        <th>Precio</th>
    </tr>
    <?php foreach($reporte as $fila):?>
        <tr>
            <td><?= $fila["Id"]?></td>
            <td><?= $fila["Direccion"]?></td>
            <td><?=$fila["Ciudad"]?></td>
            <td><?= $fila["Telefono"]?></td>
            <td><?= $fila["Codigo_Postal"]?></td>
            <td><?= $fila["Tipo"]?></td>
            <td><?= $fila["Precio"]?></td>
        </tr>
        <?php endforeach?>
</table>