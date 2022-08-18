<?php
    //Se declaran las variables y bucles necesarios para iterar el total de los datos del archivo .json
    //obteniendo por medio del POST la informacion seleccionda por el usuario.
    include("ciudades.php");
    include("tipos.php");

    $data = file_get_contents("data-1.json");
    $bienes = json_decode($data, true);
    $resultadoCiudad = array();
    $resultadoTipo = array();
    $resultadoPrecio = array();
    if(isset($_POST['ciudad']) && isset($_POST['tipo']) && isset($_POST['precio'])) {
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
        
        foreach ($resultadoTipo as $bien) {
          $num = str_replace('$','',$bien["Precio"]);
          $bienPrecio = (int) str_replace(',','', $num);
          if($bienPrecio > $arrPrecio[0] && $bienPrecio < $arrPrecio[1]) {
              array_push($resultadoPrecio, $bien);
          }
        }
    }

    if(!isset($_POST['tipo']) && isset($_POST['ciudad']) ) {
      foreach ($bienes as $bien) {
          if($bien["Ciudad"] == $_POST['ciudad']) {
              array_push($resultadoPrecio, $bien);
          }
      }
    }

    if( !isset($_POST['ciudad']) && isset($_POST['tipo']) ) {
        foreach ($bienes as $bien) {
            if($bien["Tipo"] == $_POST['tipo']) {
                array_push($resultadoPrecio, $bien);
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/customColors.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/index.css"  media="screen,projection"/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Formulario</title>
</head>

<body>
  <!-- <video src="img/video.mp4" id="vidFondo"></video> -->
  <div class="contenedor">
    <div class="card rowTitulo">
      <h1>Bienes Intelcost</h1>
    </div>
    <div class="colFiltros">
      <form action="index.php" method="POST" id="formulario">
        <div class="filtrosContenido">
          <div class="tituloFiltros">
            <h5>Filtros</h5>
          </div>
          <div class="filtroCiudad input-field">
            <p><label for="selectCiudad">Ciudad:</label><br></p>
            <select name="ciudad" id="selectCiudad">
              <!-- Se obtiene la variable ciudades del archivo ciudades.php -->
              <option value="" selected disabled>Elige una ciudad</option>
                <?php
                    foreach ($ciudades as $ciudad): ?>
                    <option value=<?= $ciudad ?> ><?=$ciudad?></option>
                <?php endforeach ?>
            </select>
          </div>
          <div class="filtroTipo input-field">
            <p><label for="selecTipo">Tipo:</label></p>
            <br>
            <select name="tipo" id="selectTipo">
              <!-- Se obtiene la variable tipos del archivo tipos.php -->
              <option value="" selected disabled>Elige un tipo</option>
                <?php
                    foreach ($tipos as $tipo): ?>
                    <option value=<?= $tipo ?> ><?=$tipo?></option>
                <?php endforeach ?>
            </select>
          </div>
          <div class="filtroPrecio">
            <label for="rangoPrecio">Precio:</label>
            <input type="text" id="rangoPrecio" name="precio" value="" />
          </div>
          <div class="botonField">
            <input type="submit" class="btn white" value="Buscar" id="submitButton">
          </div>
        </div>
      </form>
    </div>
    <div id="tabs" style="width: 75%;">
      <ul>
        <li><a href="#tabs-1">Bienes disponibles</a></li>
        <li><a href="#tabs-2">Mis bienes</a></li>
        <li><a href="#tabs-3">Reportes</a></li>
      </ul>
      <div id="tabs-1">
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Resultados de la búsqueda:</h5>
            <div class="divider"></div>
            <div class>
            <!-- Se realiza un bucle para mostrar la informacion del total de los datos o el resultado de los datos filtrados -->
                <?php
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
            </div>
          </div>
        </div>
      </div>
      <div id="tabs-2" >
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Bienes guardados:</h5>
            <div class="divider"></div>
            <!-- Se muestra la informacion del archivo guardados.php -->
            <?php
              include("guardados.php");
            ?>
          </div>
        </div>
      </div>

      <div id="tabs-3">
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <div class="divider"></div>
            <h5>Exportar reporte:</h5>
            <!-- Se muestra un form con los filtros opcionales para descargar la informacion-->
            <form action="reporte.php" method="POST" id="reporte">
              <div class="tituloFiltros">
                <h5>Filtros</h5>
              </div>
              <div class="filtroCiudad input-field">
                <p><label for="selectCiudad">Ciudad:</label><br></p>
                <select name="ciudad" id="selectCiudad">
                  <option value="" selected disabled>Elige una ciudad</option>
                    <?php
                        foreach ($ciudades as $ciudad): ?>
                        <option value=<?= $ciudad ?> ><?=$ciudad?></option>
                    <?php endforeach ?>
                </select>
              </div>
              <div class="filtroTipo input-field">
                <p><label for="selecTipo">Tipo:</label></p>
                <br>
                <select name="tipo" id="selectTipo">
                  <option value="" selected disabled>Elige un tipo</option>
                    <?php
                        foreach ($tipos as $tipo): ?>
                        <option value=<?= $tipo ?> ><?=$tipo?></option>
                    <?php endforeach ?>
                </select>
              </div>
              <div class="botonField">
                <input type="submit" class="btn white" value="Generar Excel" id="submitButton">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    
    <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/buscador.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
      $( document ).ready(function() {
          $( "#tabs" ).tabs();
      });
    </script>
  </body>
  </html>