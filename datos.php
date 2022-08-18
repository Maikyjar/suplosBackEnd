<?php
    //No se esta usando este modulo ya que se necesitan variables del archivo index.php pero esto causa un error en la ejecuccion
    $data = file_get_contents("data-1.json");
    include("index.php");

    if(count($resultadoPrecio) > 1) {
        $bienes = $resultadoPrecio;
    } else {
        $bienes = json_decode($data, true);
    }

foreach ($bienes as $bien): ?>
    <div class='bien'>
        <div class='image'><img src='img/home.jpg' width='250px' /></div>
        <ul class="lista">
            <li><b>Direccion : </b><?=$bien["Direccion"]?></li>
            <li><b>Ciudad : </b><?=$bien["Ciudad"]?></li>
            <li><b>Telefono : </b><?=$bien["Telefono"]?></li>
            <li><b>Codigo Postal : </b><?=$bien["Codigo_Postal"]?></li>
            <li><b>Tipo : </b><?=$bien["Tipo"]?></li>
            <li><b>Precio : </b><?=$bien["Precio"]?></li>
            <li>
                <form action="guardar.php" method="post">
                    <input type="hidden" name="identificacion" value=<?=$bien["Id"]?>>
                    <input class="botonGuardar" type="submit" value="Guardar">
                </form>
            </li>
        </ul>
    </div>
<?php endforeach ?>