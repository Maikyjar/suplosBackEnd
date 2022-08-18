<?php
    //Se requiere la conexion a la base de datos y se envia una query con el total de los bienes
    require "conexion.php";

    $consulta = "SELECT * FROM bienes";
    $resultados = mysqli_query($conexionBd, $consulta);
    //Se muestran el total de los datos encontrados en la base de datos
    foreach ($resultados as $bien): ?>
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
                <form action="eliminar.php" method="post">
                    <input type="hidden" name="identificacion" value=<?=$bien["Id"]?>>
                    <input class="botonEliminar" type="submit" value="Eliminar">
                </form>
            </li>
        </ul>
    </div>
<?php endforeach ?>

