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
    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pbackups', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pbackups'] == 1) {
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
                                            <h1 class="">Listado Backups</h1>
                                            <div class="row">
                                                <div class="col-md-12">
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

                                                                //INICIAR VARIABLES
                                                                $contadorarchivos = 0;
                                                                $eltamano = "";
                                                                $archivoconcreto = "";

                                                                //OBTENER RUTA BACKUPS
                                                                $rutaarchivo = getcwd();
                                                                $rutaarchivo = trim($rutaarchivo);
                                                                $rutaarchivo .= "/backups";

                                                                //COMPROVAR SI EXISTE CARPETA BACKUP
                                                                if (!file_exists($rutaarchivo)) {
                                                                    echo "<div class='alert alert-danger' role='alert'>Error: No existe la carpeta backup.</div>";
                                                                    exit;
                                                                }

                                                                clearstatcache();

                                                                //COMPROVAR SI SE PUEDE LEER CARPETA BACKUP
                                                                if (!is_readable($rutaarchivo)) {
                                                                    echo "<div class='alert alert-danger' role='alert'>Error: La carpeta backup no tiene permisos de lectura.</div>";
                                                                    exit;
                                                                }

                                                                clearstatcache();

                                                                //COMPROVAR SI SE PUEDE ESCRIVIR EN CARPETA BACKUP
                                                                if (!is_writable($rutaarchivo)) {
                                                                    echo "<div class='alert alert-danger' role='alert'>Error: La carpeta backup no tiene permisos de escritura.</div>";
                                                                    exit;
                                                                }

                                                                clearstatcache();

                                                                //CONTAR CUANTOS ARCHIVOS GZ TIENE LA CARPETA BACKUPS
                                                                $files = array();
                                                                if ($handle = opendir($rutaarchivo)) {
                                                                    while (false !== ($file = readdir($handle))) {
                                                                        $fileNameCmps = explode(".", $file);
                                                                        $fileExtension = strtolower(end($fileNameCmps));

                                                                        if ($fileExtension == "gz") {
                                                                            $contadorarchivos++;
                                                                        }
                                                                    }
                                                                    closedir($handle);
                                                                }

                                                                //SI NO HAY ARCHIVOS GZ MOSTRAR INFORMACION
                                                                if ($contadorarchivos == 0) {
                                                                    echo '<tr>';
                                                                    echo '<th scope="row">Actualmente no hay ningún backup.</th><td></td><td></td><td></td>';
                                                                    echo '</tr>';
                                                                } else {

                                                                    //MONSTRAR LOS ARCHIVOS GZ DE LA CARPETA BACKUPS ORDENADOS
                                                                    $ignored = array('.', '..', '.svn', '.htaccess');

                                                                    $files = array();

                                                                    foreach (scandir($rutaarchivo) as $file) {
                                                                        if (in_array($file, $ignored)) continue;
                                                                        $fileNameCmps = explode(".", $file);
                                                                        $fileExtension = strtolower(end($fileNameCmps));
                                                                        if ($fileExtension == "gz") {
                                                                            $files[$file] = filemtime($rutaarchivo . '/' . $file);
                                                                        }
                                                                    }

                                                                    arsort($files);
                                                                    $files = array_keys($files);

                                                                    //RECORRER ARRAY Y AÑADIR LAS PROPIEDADES Y LOS BOTONES
                                                                    for ($i = 0; $i < count($files); $i++) {
                                                                        $archivoconcreto = $rutaarchivo;
                                                                        $archivoconcreto .= "/" . $files[$i];
                                                                        echo '<tr class="menu-hover" id="' . $files[$i] . '">';
                                                                        echo '<th scope="row">' . $files[$i] . '</th>';
                                                                        echo '<td>' . date("d/m/Y H:i:s", filemtime($archivoconcreto)) . '</td>';
                                                                        $eltamano = devolverdatos(filesize($archivoconcreto), 1);
                                                                        echo '<td>' . $eltamano . '</td>';
                                                                        echo '<td>';
                                                                ?>

                                                                        <?php
                                                                        if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pbackupsdescargar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pbackupsdescargar'] == 1) {
                                                                        ?>
                                                                            <button type="button" class="descargar btn btn-info text-white mr-1" value="<?php echo $files[$i] ?>">Descargar</button>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pbackupsrestaurar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pbackupsrestaurar'] == 1) {
                                                                        ?>
                                                                            <button type="button" class="restaurar btn btn-warning text-white mr-1" value="<?php echo $files[$i] ?>">Restaurar</button>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pbackupsborrar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pbackupsborrar'] == 1) {
                                                                        ?>
                                                                            <button type="button" class="borrar btn text-white btn-danger" value="<?php echo $files[$i] ?>">Borrar</button>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        </td>
                                                                        </tr>
                                                                <?php
                                                                    }
                                                                }

                                                                ?>
                                                            </tbody>
                                                        </table>
                                                        <p class="lead" id="textoretorno"></p>
                                                    </div>
                                                    <hr>
                                                    <?php
                                                    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pbackupscrear', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pbackupscrear'] == 1) {
                                                    ?>
                                                        <h1 class="">Crear Backup</h1>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <p class="lead">Nombre Backup</p>
                                                                <input class="form-control" id="inputbackup" type="text" maxlength="100">
                                                                <button type="button" class="btn btn-primary btn-block btn-lg text-white mt-2" id="crearbackup">Crear Backup</button>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <img class="" src="img/loading.gif" id="gifloading" alt="loading">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <p class="lead" id="textobackupretorno"></p>
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
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->

        <script src="js/backups.js"></script>

    <?php

        //FINAL VALIDAR SESSION
    } else {
        header("location:index.php");
    }
    ?>

</body>

</html>