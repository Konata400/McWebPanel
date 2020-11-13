<?php

/*
This file is part of McWebPanel.
Copyright (C) 2020 Cristina Ibañez, Konata400

    McWebPanel is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    McWebPanel is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with McWebPanel.  If not, see <https://www.gnu.org/licenses/>.
*/

require_once("template/session.php");
require_once("template/errorreport.php");
require_once("config/confopciones.php");
require_once("template/header.php");

//FUNCION DEVUELVE DATOS EN EL FORMATO B/KB/MB/GB/TB
function devolverdatos($losbytes, $opcion)
{
    $eltipo = "";

    if ($losbytes >= 0) {
        $eltipo = "B";
        $result = $losbytes;
    }

    if ($losbytes >= 1024) {
        $eltipo = "KB";
        $result = $losbytes / 1024;
    }

    if ($losbytes >= 1048576) {
        $eltipo = "MB";
        $result = $losbytes / 1048576;
    }

    if ($losbytes >= 1073741824) {
        $eltipo = "GB";
        $result = $losbytes / 1073741824;
    }

    if ($losbytes >= 1099511627776) {
        $eltipo = "TB";
        $result = $losbytes / 1099511627776;
    }

    if ($opcion == 0) {
        $result = str_replace(".", ",", strval(round($result, 2)));
        return $result;
    } elseif ($opcion == 1) {
        $result = str_replace(".", ",", strval(round($result, 2))) . " " . $eltipo;
        return $result;
    }
}
?>
<!-- Custom styles for this template-->
<link href="css/test.css" rel="stylesheet">

</head>

<body id="page-top">

    <?php

    $expulsar = 0;

    //COMPROVAR SI SESSION EXISTE SINO CREARLA CON NO
    if (!isset($_SESSION['VALIDADO']) || !isset($_SESSION['KEYSECRETA'])) {
        $_SESSION['VALIDADO'] = "NO";
        $_SESSION['KEYSECRETA'] = "0";
        header("location:index.php");
        exit;
    }

    //COMPROVAR SI ES EL SUPERADMIN O ADMIN O USER CON PERMISOS
    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivos', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivos'] == 1) {
        $expulsar = 1;
    }

    if ($expulsar != 1) {
        header("location:index.php");
        exit;
    }

    //VALIDAMOS SESSION SINO ERROR
    if ($_SESSION['VALIDADO'] == $_SESSION['KEYSECRETA']) {
    ?>

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php
            require_once("template/menu.php");
            ?>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="card border-left-primary shadow h-100">
                                <div class="card-body">

                                    <!-- Page Heading -->
                                    <div class="py-1">
                                        <div class="container">
                                            <h1 class="">Gestor Archivos</h1>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php

                                                    //INICIAR VARIABLES
                                                    $contadorarchivos = 0;
                                                    $eltamano = "";
                                                    $archivoconcreto = "";
                                                    $tipoarchivo = "";
                                                    $getinfofile = "";
                                                    $getrutalimpia = "";
                                                    $getrutaparseada = "";
                                                    $valencontrado = 0;
                                                    $rutahta = "";

                                                    $recpuerto = CONFIGPUERTO;
                                                    $recram = CONFIGRAM;
                                                    $rectiposerv = CONFIGTIPOSERVER;
                                                    $recnombreserv = CONFIGNOMBRESERVER;
                                                    $reccarpmine = CONFIGDIRECTORIO;
                                                    $recarchivojar = CONFIGARCHIVOJAR;
                                                    $receulaminecraft = CONFIGEULAMINECRAFT;

                                                    //OBTENER RUTA SERVIDOR MINECRAFT
                                                    $rutaarchivo = getcwd();
                                                    $rutaarchivo = trim($rutaarchivo);
                                                    $rutaarchivo .= "/" . $reccarpmine;

                                                    //INICIALIZAR SESSION RUTACTUAL Y RUTALIMITE
                                                    if (!isset($_SESSION['RUTACTUAL'])) {
                                                        $_SESSION['RUTACTUAL'] = $rutaarchivo;
                                                        $_SESSION['RUTALIMITE'] = $rutaarchivo;
                                                        $_SESSION['COPIARFILES'] = "0";
                                                    } else {
                                                        $rutaarchivo = $_SESSION['RUTACTUAL'];
                                                    }

                                                    //COMPROVAR SI EXISTE CARPETA SERVIDOR MINECRAF
                                                    //CON DOBLE CONFIRMACION POR SI TE QUEDAS ATASCADO EN UNA CARPETA SUPERIOR Y LUEGO SE ELIMINO POR CONSOLA O FTP
                                                    clearstatcache();
                                                    if (!file_exists($rutaarchivo)) {
                                                        $_SESSION['RUTACTUAL'] = $_SESSION['RUTALIMITE'];
                                                        $rutaarchivo = $_SESSION['RUTALIMITE'];
                                                        clearstatcache();
                                                        if (!file_exists($rutaarchivo)) {
                                                            echo "<div class='alert alert-danger' role='alert'>Error: No existe la carpeta servidor minecraft.</div>";
                                                            exit;
                                                        }
                                                    }

                                                    //COMPROVAR SI SE PUEDE LEER CARPETA
                                                    clearstatcache();
                                                    if (!is_readable($rutaarchivo)) {
                                                        echo "<div class='alert alert-danger' role='alert'>Error: La carpeta servidor minecraft no tiene permisos de lectura.</div>";
                                                        exit;
                                                    }

                                                    //COMPROVAR SI SE PUEDE ESCRIVIR EN CARPETA
                                                    clearstatcache();
                                                    if (!is_writable($rutaarchivo)) {
                                                        echo "<div class='alert alert-danger' role='alert'>Error: La carpeta servidor minecraft no tiene permisos de escritura.</div>";
                                                        exit;
                                                    }

                                                    //COMPROVAR SI SE PUEDE EJECUTAR EN CARPETA
                                                    clearstatcache();
                                                    if (!is_executable($rutaarchivo)) {
                                                        echo "<div class='alert alert-danger' role='alert'>Error: La carpeta servidor minecraft no tiene permisos de ejecucion.</div>";
                                                        exit;
                                                    }

                                                    //FORZAR .htaccess CARPETA SERVIDOR MINECRAFT
                                                    $rutahta = $_SESSION['RUTALIMITE'] . "/.htaccess";
                                                    $file = fopen($rutahta, "w");
                                                    fwrite($file, "deny from all" . PHP_EOL);
                                                    fclose($file);

                                                    //SEPARAR RUTA EN ARRAY
                                                    $getrutalimpia = explode("/", $_SESSION['RUTACTUAL']);

                                                    //RECORRER ARRAY Y OBTENER SOLO A PARTIR DE LA CARPETA SERVER MINECRAFT
                                                    for ($a = 0; $a < count($getrutalimpia); $a++) {
                                                        if ($getrutalimpia[$a] == $reccarpmine) {
                                                            $valencontrado = 1;
                                                        }

                                                        if ($valencontrado == 1) {
                                                            $getrutaparseada .= $getrutalimpia[$a] . " / ";
                                                        }
                                                    }

                                                    ?>

                                                    <nav aria-label="breadcrumb">
                                                        <ol class="breadcrumb">
                                                            <li class="breadcrumb-item active"><?php echo "Carpeta: / " . $getrutaparseada; ?></li>
                                                        </ol>
                                                    </nav>
                                                    <button type="button" id="bnactualizar" class="btn btn-primary mr-1" title="Actualizar"><img src="img/botones/refresh.png" alt="Actualizar"></button>

                                                    <?php
                                                    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivoscrearcarpeta', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivoscrearcarpeta'] == 1) {
                                                    ?>
                                                        <button type="button" id="bnnuevacarpeta" class="btn btn-primary mr-1" title="Crear Carpeta"><img src="img/botones/new.png" alt="+"> Crear Carpeta</button>
                                                    <?php
                                                    }
                                                    ?>

                                                    <?php
                                                    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivoscopiar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivoscopiar'] == 1) {
                                                    ?>
                                                        <button type="button" id="bcopiar" class="btn btn-primary mr-1" title="Copiar"><img src="img/botones/copiar.png" alt="+"> Copiar</button>
                                                        <?php
                                                        if ($_SESSION['COPIARFILES'] != "0") {
                                                            echo '<button type="button" id="bpegar" class="btn btn-primary mr-1" title="Pegar"><img src="img/botones/pegar.png" alt="+"> Pegar</button>';
                                                        }
                                                        ?>
                                                    <?php
                                                    }
                                                    ?>
                                                    <button type="button" id="bselectall" class="btn btn-primary mr-1" title="Seleccionar Todo"><img src="img/botones/checkselect.png" alt=""> Seleccionar Todo</button>
                                                    <button type="button" id="bunselectall" class="btn btn-primary mr-1" title="Quitar Selección"><img src="img/botones/checkunselect.png" alt=""> Quitar Selección</button>

                                                    <?php
                                                    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivosborrar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivosborrar'] == 1) {
                                                    ?>
                                                        <button type="button" id="beliminarseleccion" class="btn btn-danger mr-1" title="Eliminar Seleccionados"><img src="img/botones/borrar.png" alt=""> Eliminar Seleccionados</button>
                                                    <?php
                                                    }
                                                    ?>


                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-borderless">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Nombre</th>
                                                                    <th scope="col">Fecha</th>
                                                                    <th scope="col">Tamaño</th>
                                                                    <th scope="col">Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php

                                                                //CONTAR CUANTOS ARCHIVOS TIENE LA CARPETA
                                                                $files = array();
                                                                if ($handle = opendir($rutaarchivo)) {
                                                                    while (false !== ($file = readdir($handle))) {
                                                                        $fileNameCmps = explode(".", $file);
                                                                        $fileExtension = strtolower(end($fileNameCmps));
                                                                        $contadorarchivos++;
                                                                    }
                                                                    closedir($handle);
                                                                }

                                                                //SI NO HAY ARCHIVOS MOSTRAR INFORMACION
                                                                if ($contadorarchivos == 0) {
                                                                    echo '<tr>';
                                                                    echo '<th scope="row">Actualmente no hay archivos servidor minecraft.</th><td></td><td></td><td></td>';
                                                                    echo '</tr>';
                                                                } else {

                                                                    //CARGAR ARRAYS
                                                                    $files = array();
                                                                    $fcarpetas = array();
                                                                    $farchivos = array();

                                                                    //OBTENER CARPETAS Y DIRECTORIOS
                                                                    $a = scandir($rutaarchivo);

                                                                    //SEPARAR CARPETAS Y DIRECTORIOS
                                                                    for ($i = 0; $i < count($a); $i++) {
                                                                        $rutfil = $rutaarchivo . "/" . $a[$i];
                                                                        clearstatcache();
                                                                        if (is_dir($rutfil)) {
                                                                            //Evitar mostrar .
                                                                            if ($a[$i] != ".") {
                                                                                $fcarpetas[] = $a[$i];
                                                                            }
                                                                        } else {
                                                                            //Evitar mostrar .htaccess
                                                                            if ($a[$i] != ".htaccess") {
                                                                                $farchivos[] = $a[$i];
                                                                            }
                                                                        }
                                                                    }

                                                                    //JUNTAR ARRAYS
                                                                    for ($i = 0; $i < count($farchivos); $i++) {
                                                                        $fcarpetas[] = $farchivos[$i];
                                                                    }

                                                                    //RECORRER ARRAY Y AÑADIR LAS PROPIEDADES Y LOS BOTONES
                                                                    for ($i = 0; $i < count($fcarpetas); $i++) {
                                                                        $archivoconcreto = $rutaarchivo . "/" . $fcarpetas[$i];
                                                                        echo '<tr class = "menu-hover">';

                                                                        echo '<th scope="row">';

                                                                        if ($fcarpetas[$i] != "." && $fcarpetas[$i] != "..") {
                                                                            clearstatcache();
                                                                            if (is_dir($archivoconcreto)) {
                                                                                clearstatcache();
                                                                                if (is_executable($archivoconcreto)) {
                                                                                    echo '<input class="laseleccion mr-2" type="checkbox" value="' . $fcarpetas[$i] . '">';
                                                                                } else {
                                                                                    echo '<input class="mr-2" title="Sin permisos de ejecucion/Enter" type="checkbox" disabled>';
                                                                                }
                                                                            } else {
                                                                                echo '<input class="laseleccion mr-2" type="checkbox" value="' . $fcarpetas[$i] . '">';
                                                                            }
                                                                        }

                                                                        $getinfofile = pathinfo($archivoconcreto);

                                                                        clearstatcache();
                                                                        if (is_dir($archivoconcreto)) {
                                                                            echo '<img class="mr-2" src="img/gestorarchivos/carpeta.png">' . $fcarpetas[$i] . '</th>';
                                                                        } else {

                                                                            //FIX SI EL ARCHIVO NO TIENE EXTENSION
                                                                            if (isset($getinfofile['extension'])) {
                                                                                $tipoarchivo = "." . strtolower($getinfofile['extension']);
                                                                            }

                                                                            //VER TIPO Y AÑADIR ICONO
                                                                            if ($tipoarchivo == ".txt") {
                                                                                echo '<img class="mr-2" src="img/gestorarchivos/txt.png">' . $fcarpetas[$i] . '</th>';
                                                                            } elseif ($tipoarchivo == ".jar") {
                                                                                echo '<img class="mr-2" src="img/gestorarchivos/java.png">' . $fcarpetas[$i] . '</th>';
                                                                            } elseif ($tipoarchivo == ".yml") {
                                                                                echo '<img class="mr-2" src="img/gestorarchivos/yml.png">' . $fcarpetas[$i] . '</th>';
                                                                            } elseif ($tipoarchivo == ".json") {
                                                                                echo '<img class="mr-2" src="img/gestorarchivos/json.png">' . $fcarpetas[$i] . '</th>';
                                                                            } elseif ($tipoarchivo == ".htaccess") {
                                                                                echo '<img class="mr-2" src="img/gestorarchivos/htaccess.png">' . $fcarpetas[$i] . '</th>';
                                                                            } elseif ($tipoarchivo == ".properties") {
                                                                                echo '<img class="mr-2" src="img/gestorarchivos/mine.png">' . $fcarpetas[$i] . '</th>';
                                                                            } elseif ($tipoarchivo == ".bmp") {
                                                                                echo '<img class="mr-2" src="img/gestorarchivos/img.png">' . $fcarpetas[$i] . '</th>';
                                                                            } elseif ($tipoarchivo == ".dib") {
                                                                                echo '<img class="mr-2" src="img/gestorarchivos/img.png">' . $fcarpetas[$i] . '</th>';
                                                                            } elseif ($tipoarchivo == ".jpg") {
                                                                                echo '<img class="mr-2" src="img/gestorarchivos/img.png">' . $fcarpetas[$i] . '</th>';
                                                                            } elseif ($tipoarchivo == ".jpeg") {
                                                                                echo '<img class="mr-2" src="img/gestorarchivos/img.png">' . $fcarpetas[$i] . '</th>';
                                                                            } elseif ($tipoarchivo == ".jpe") {
                                                                                echo '<img class="mr-2" src="img/gestorarchivos/img.png">' . $fcarpetas[$i] . '</th>';
                                                                            } elseif ($tipoarchivo == ".jfif") {
                                                                                echo '<img class="mr-2" src="img/gestorarchivos/img.png">' . $fcarpetas[$i] . '</th>';
                                                                            } elseif ($tipoarchivo == ".gif") {
                                                                                echo '<img class="mr-2" src="img/gestorarchivos/img.png">' . $fcarpetas[$i] . '</th>';
                                                                            } elseif ($tipoarchivo == ".tiff") {
                                                                                echo '<img class="mr-2" src="img/gestorarchivos/img.png">' . $fcarpetas[$i] . '</th>';
                                                                            } elseif ($tipoarchivo == ".png") {
                                                                                echo '<img class="mr-2" src="img/gestorarchivos/img.png">' . $fcarpetas[$i] . '</th>';
                                                                            } elseif ($tipoarchivo == ".heic") {
                                                                                echo '<img class="mr-2" src="img/gestorarchivos/img.png">' . $fcarpetas[$i] . '</th>';
                                                                            } elseif ($tipoarchivo == ".zip") {
                                                                                echo '<img class="mr-2" src="img/gestorarchivos/zip.png">' . $fcarpetas[$i] . '</th>';
                                                                            } elseif ($tipoarchivo == ".gz" || $tipoarchivo == ".tar" || $tipoarchivo == ".bz2") {
                                                                                echo '<img class="mr-2" src="img/gestorarchivos/tar.png">' . $fcarpetas[$i] . '</th>';
                                                                            } else {
                                                                                echo '<img class="mr-2" src="img/gestorarchivos/void.png">' . $fcarpetas[$i] . '</th>';
                                                                            }
                                                                        }

                                                                        //AÑADIR FECHA ARCHIVO/CARPETA
                                                                        clearstatcache();
                                                                        if (!is_dir($archivoconcreto)) {
                                                                            echo '<td>' . date("d/m/Y H:i:s", filemtime($archivoconcreto)) . '</td>';
                                                                        } else {
                                                                            echo '<td>' . date("d/m/Y H:i:s", filemtime($archivoconcreto)) . '</td>';
                                                                        }

                                                                        //AÑADIR TAMAÑO ARCHIVO
                                                                        clearstatcache();
                                                                        if (!is_dir($archivoconcreto)) {
                                                                            $eltamano = devolverdatos(filesize($archivoconcreto), 1);
                                                                        } else {
                                                                            $eltamano = ".";
                                                                        }
                                                                        echo '<td>' . $eltamano . '</td>';
                                                                        echo '<td>';

                                                                        //CREAR BOTONES ARCHIVOS Y CARPETAS
                                                                        clearstatcache();
                                                                        if (!is_dir($archivoconcreto)) {
                                                                ?>
                                                                            <?php
                                                                            //BOTON DESCARGAR
                                                                            if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivosdescargar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivosdescargar'] == 1) {
                                                                            ?>
                                                                                <button type="button" class="descargarfile btn btn-primary mr-1" value="<?php echo $fcarpetas[$i]; ?>" title="Descargar"><img src="img/botones/down.png" alt="Descargar"></button>
                                                                            <?php
                                                                            }
                                                                            ?>

                                                                            <?php
                                                                            //BOTON DESCOMPRIMIR
                                                                            if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivosdescomprimir', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivosdescomprimir'] == 1) {
                                                                                if ($tipoarchivo == ".gz" || $tipoarchivo == ".tar" || $tipoarchivo == ".bz2") {
                                                                                    echo '<button type="button" class="descomprimirtar btn btn-primary mr-1" value="' . $fcarpetas[$i] . '" title="Descomprimir"><img src="img/botones/descomprimir.png" alt="Descomprimir"></button>';
                                                                                } elseif ($tipoarchivo == ".zip") {
                                                                                    echo '<button type="button" class="descomprimirzip btn btn-primary mr-1" value="' . $fcarpetas[$i] . '" title="Descomprimir"><img src="img/botones/descomprimir.png" alt="Descomprimir"></button>';
                                                                                }
                                                                            }

                                                                            //BOTON EDITAR ARCHIVO
                                                                            if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivoseditar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivoseditar'] == 1) {
                                                                                if ($tipoarchivo == ".txt" || $tipoarchivo == ".json" || $tipoarchivo == ".log" || $tipoarchivo == ".mcmeta" || $tipoarchivo == ".yml" || $tipoarchivo == ".properties") {
                                                                                    echo '<button type="button" class="editarfile btn btn-info text-white mr-1" value="' . $fcarpetas[$i] . '" title="Editar"><img src="img/botones/editar.png" alt="Editar"></button>';
                                                                                }
                                                                            }
                                                                            ?>

                                                                            <?php
                                                                            //BOTON RENOMBRAR ARCHIVO
                                                                            if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivosrenombrar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivosrenombrar'] == 1) {
                                                                            ?>
                                                                                <button type="button" class="renamefile btn btn-warning text-white mr-1" id="<?php echo $fcarpetas[$i]; ?>" value="<?php echo $fcarpetas[$i]; ?>" title="Renombrar"><img src="img/botones/rename.png" alt="Renombrar"></button>
                                                                            <?php
                                                                            }
                                                                            ?>

                                                                            <?php
                                                                            //BOTON BORRAR ARCHIVO
                                                                            if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivosborrar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivosborrar'] == 1) {
                                                                            ?>
                                                                                <button type="button" class="borrarfile btn text-white btn-danger" id="<?php echo $fcarpetas[$i]; ?>" value="<?php echo $fcarpetas[$i]; ?>" title="Borrar"><img src="img/botones/borrar.png" alt="Borrar"></button>
                                                                            <?php
                                                                            }
                                                                            ?>

                                                                            </td>
                                                                            </tr>
                                                                            <?php
                                                                        } else {
                                                                            if ($fcarpetas[$i] == "..") {

                                                                                $elatras = explode('/', $_SESSION['RUTACTUAL']);
                                                                                $elatras = end($elatras);
                                                                                $elatras = trim($elatras);
                                                                            ?>
                                                                                <button type="button" class="atras btn btn-info text-white mr-1" value="<?php echo $elatras; ?>" title="Atras"><img src="img/botones/atras.png" alt="Atras"> Atras</button>
                                                                            <?php
                                                                            } elseif ($fcarpetas[$i] == ".") {
                                                                            ?>

                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <button type="button" class="entrar btn btn-info text-white mr-1" value="<?php echo $fcarpetas[$i]; ?>" title="Entrar"><img src="img/botones/entrar.png" alt="Entrar"></button>

                                                                                <?php
                                                                                //BOTON COMPRIMIR CARPETA
                                                                                if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivoscomprimir', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivoscomprimir'] == 1) {
                                                                                ?>
                                                                                    <button type="button" class="comprimirzipfolder btn btn-warning text-white mr-1" value="<?php echo $fcarpetas[$i]; ?>" title="Comprimir carpeta en Zip"><img src="img/botones/comprimir.png" alt="Comprimir carpeta en Zip"></button>
                                                                                <?php
                                                                                }
                                                                                ?>

                                                                                <?php
                                                                                //BOTON RENOMBRAR CARPETA
                                                                                if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivosrenombrar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivosrenombrar'] == 1) {
                                                                                ?>
                                                                                    <button type="button" id="<?php echo $fcarpetas[$i]; ?>" class="renamefolder btn btn-warning text-white mr-1" value="<?php echo $fcarpetas[$i]; ?>" title="Renombrar"><img src="img/botones/rename.png" alt="Renombrar"></button>
                                                                                <?php
                                                                                }
                                                                                ?>

                                                                                <?php
                                                                                //BOTON BORRAR CARPETA
                                                                                if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivosborrar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivosborrar'] == 1) {
                                                                                ?>
                                                                                    <button type="button" id="<?php echo $fcarpetas[$i]; ?>" class="borrarcarpeta btn text-white btn-danger" value="<?php echo $fcarpetas[$i]; ?>" title="Borrar"><img src="img/botones/borrar.png" alt="Borrar"></button>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                <?php
                                                                            }
                                                                        }
                                                                    }
                                                                }

                                                                ?>
                                                            </tbody>
                                                        </table>
                                                        <p class="lead" id="textoretorno"></p>
                                                    </div>
                                                    <hr>
                                                    <?php
                                                    //SUBIR ARCHIVO
                                                    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivossubir', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivossubir'] == 1) {
                                                    ?>
                                                        <h1 class="">Subir Archivo</h1>
                                                        <div class="row">
                                                            <div class="col-md-4">

                                                                <p>(Limite Subida: <?php echo ini_get("upload_max_filesize"); ?>B)</p>

                                                                <form id="form" action="function/gestoruploadfile.php" method="post" enctype="multipart/form-data">

                                                                    <div class="custom-file mb-3">
                                                                        <input type="file" class="custom-file-input" id="fileName" name="uploadedFile">
                                                                        <label class="custom-file-label" for="fileName">Elija el archivo</label>
                                                                    </div>

                                                                    <button class="btn btn-primary btn-block btn-lg text-white mt-2" id="botonsubir" type="submit" value="Upload">Subir Archivo</button>
                                                                </form>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <img class="" src="img/loading.gif" id="gifloading" alt="loading">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <p class="lead" id="textouploadretorno"></p>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

        <script src="js/gestorarchivos.js"></script>

    <?php

        //FINAL VALIDAR SESSION
    } else {
        header("location:index.php");
    }
    ?>

</body>

</html>