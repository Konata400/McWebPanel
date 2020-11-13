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
    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('psystemconf', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['psystemconf'] == 1) {
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
                                    <div class="py-1">
                                        <div class="container">
                                            <h1 class="mb-5">System Config</h1>
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <!-- Page Heading -->
                                                    <?php

                                                    //VARIABLES
                                                    $contadorarchivos = 0;
                                                    $contadorsiexiste = 0;

                                                    $recpuerto = CONFIGPUERTO;
                                                    $recram = CONFIGRAM;
                                                    $rectiposerv = CONFIGTIPOSERVER;
                                                    $recnombreserv = CONFIGNOMBRESERVER;
                                                    $reccarpmine = CONFIGDIRECTORIO;
                                                    $recarchivojar = CONFIGARCHIVOJAR;
                                                    $receulaminecraft = CONFIGEULAMINECRAFT;
                                                    $recmaxupload = CONFIGMAXUPLOAD;

                                                    $recgarbagecolector = CONFIGOPTIONGARBAGE;
                                                    $recforseupgrade = CONFIGOPTIONFORCEUPGRADE;
                                                    $recerasecache = CONFIGOPTIONERASECACHE;

                                                    $elnombredirectorio = $reccarpmine;
                                                    $rutaarchivo = getcwd();
                                                    $rutaarchivo = trim($rutaarchivo);
                                                    $rutaarchivo .= "/" . $elnombredirectorio;

                                                    //COMPRUEVA SI LA CARPETA DEL SERVIDOR MINECRAFT EXISTE
                                                    clearstatcache();
                                                    if (!file_exists($rutaarchivo)) {
                                                        echo "<div class='alert alert-danger' role='alert'>Error: La carpeta del servidor minecraft no existe.</div>";
                                                        exit;
                                                    }

                                                    //COMPRUEBA SI LA CARPETA DEL SERVIDOR MINECRAFT SE PUEDE LEER
                                                    clearstatcache();
                                                    if (!is_readable($rutaarchivo)) {
                                                        echo "<div class='alert alert-danger' role='alert'>Error: La carpeta del servidor minecraft no tiene permisos de lectura.</div>";
                                                        exit;
                                                    }

                                                    ?>
                                                    <form id="formconf" action="function/guardasysconf.php" method="post">
                                                        <div class="form-group">
                                                            <label for="listadojars">Seleccione Servidor Minecraft:</label>
                                                            <select class="form-control mb-2" id="listadojars" name="listadojars">

                                                                <?php

                                                                if ($handle = opendir($rutaarchivo)) {
                                                                    while (false !== ($file = readdir($handle))) {
                                                                        $fileNameCmps = explode(".", $file);
                                                                        $fileExtension = strtolower(end($fileNameCmps));

                                                                        if ($file == $recarchivojar) {
                                                                            $contadorsiexiste = 1;
                                                                        }

                                                                        if ($fileExtension == "jar") {
                                                                            $contadorarchivos++;
                                                                        }
                                                                    }
                                                                    closedir($handle);
                                                                }

                                                                if ($contadorarchivos == 0) {
                                                                    echo '<option selected disabled hidden>No hay subido ningún servidor .jar</option>';
                                                                } else {

                                                                    if ($recarchivojar == "" || $contadorsiexiste == 0) {
                                                                        echo '<option selected disabled hidden>No hay ningún servidor seleccionado</option>';
                                                                    }


                                                                    if ($handle = opendir($rutaarchivo)) {
                                                                        while (false !== ($file = readdir($handle))) {
                                                                            $fileNameCmps = explode(".", $file);
                                                                            $fileExtension = strtolower(end($fileNameCmps));

                                                                            if ($fileExtension == "jar") {

                                                                                if ($file == $recarchivojar) {
                                                                                    echo '<option selected value="' . $file . '">' . $file . '</option>';
                                                                                } else {
                                                                                    echo '<option value="' . $file . '">' . $file . '</option>';
                                                                                }
                                                                            }
                                                                        }
                                                                        closedir($handle);
                                                                    }
                                                                }

                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-row">

                                                            <?php
                                                            //PUERTO
                                                            if ($_SESSION['CONFIGUSER']['rango'] == 1 || array_key_exists('psystemconfpuerto', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['psystemconfpuerto'] == 1) {
                                                            ?>
                                                                <div class="form-group col-md-6">
                                                                    <label for="elport">Puerto</label>
                                                                    <input type="number" value="<?php echo $recpuerto; ?>" class="form-control" id="elport" name="elport" required="required" min="1025" max="65535">
                                                                </div>

                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            //PUERTO
                                                            if ($_SESSION['CONFIGUSER']['rango'] == 1 || array_key_exists('psystemconfmemoria', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['psystemconfmemoria'] == 1) {
                                                            ?>
                                                                <div class="form-group col-md-6">
                                                                    <label for="elram" class="">Memoria Ram Limite</label>
                                                                    <select id="elram" name="elram" class="form-control" required="required">
                                                                        <?php

                                                                        $salida = shell_exec('free -h | grep Mem');
                                                                        $totalram = substr($salida, 14, 4);
                                                                        $totalram = preg_replace('/\s+/', '', $totalram);
                                                                        $totalram = trim($totalram);

                                                                        for ($i = 1;; $i++) {
                                                                            if ($i > $totalram) {
                                                                                break;
                                                                            }

                                                                            if ($recram == $i) {
                                                                                echo '<option selected value="' . $i . '">' . $i . ' GB</option>';
                                                                            } else {
                                                                                echo '<option value="' . $i . '">' . $i . ' GB</option>';
                                                                            }
                                                                        }

                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>

                                                        <div class="form-row">

                                                            <?php
                                                            //TIPO SERVIDOR
                                                            if ($_SESSION['CONFIGUSER']['rango'] == 1 || array_key_exists('psystemconftipo', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['psystemconftipo'] == 1) {
                                                            ?>


                                                                <div class="form-group col-md-6">
                                                                    <label for="eltipserv">Tipo Servidor</label>
                                                                    <select id="eltipserv" name="eltipserv" class="form-control" required="required">
                                                                        <?php
                                                                        $opcionesserver = array('vanilla', 'spigot', 'paper', 'otros');

                                                                        for ($i = 0; $i < count($opcionesserver); $i++) {

                                                                            if ($rectiposerv == $opcionesserver[$i]) {
                                                                                echo '<option selected value="' . $opcionesserver[$i] . '">' . $opcionesserver[$i] . '</option>';
                                                                            } else {
                                                                                echo '<option value="' . $opcionesserver[$i] . '">' . $opcionesserver[$i] . '</option>';
                                                                            }
                                                                        }

                                                                        ?>

                                                                    </select>
                                                                </div>

                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            //TIPO SERVIDOR
                                                            if ($_SESSION['CONFIGUSER']['rango'] == 1 || array_key_exists('psystemconfsubida', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['psystemconfsubida'] == 1) {
                                                            ?>

                                                                <div class="form-group col-md-6">
                                                                    <label for="elmaxupload">Subida Fichero Máximo (MB)</label>
                                                                    <select id="elmaxupload" name="elmaxupload" class="form-control" required="required">
                                                                        <?php

                                                                        $opcionesserver = array('128', '256', '386', '512', '640', '768', '896', '1024');

                                                                        for ($i = 0; $i < count($opcionesserver); $i++) {

                                                                            if ($recmaxupload == $opcionesserver[$i]) {
                                                                                echo '<option selected value="' . $opcionesserver[$i] . '">' . $opcionesserver[$i] . " MB" . '</option>';
                                                                            } else {
                                                                                echo '<option value="' . $opcionesserver[$i] . '">' . $opcionesserver[$i] . " MB" . '</option>';
                                                                            }
                                                                        }

                                                                        ?>

                                                                    </select>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>

                                                        <?php
                                                        //NOMBRE SERVIDOR
                                                        if ($_SESSION['CONFIGUSER']['rango'] == 1 || array_key_exists('psystemconfnombre', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['psystemconfnombre'] == 1) {
                                                        ?>

                                                            <div class="form-group">
                                                                <label for="elnomserv">Nombre Servidor</label>
                                                                <input type="text" class="form-control" id="elnomserv" name="elnomserv" required="required" value="<?php echo $recnombreserv; ?>">
                                                            </div>

                                                        <?php
                                                        }
                                                        ?>

                                                        <?php
                                                        //PARAMETROS AVANZADOS
                                                        if ($_SESSION['CONFIGUSER']['rango'] == 1 || array_key_exists('psystemconfavanzados', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['psystemconfavanzados'] == 1) {
                                                        ?>
                                                        <div class="form-group">
                                                            <label>Parametros Avanzados:</label>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <br>
                                                                    <label>Garbage collector - Recolector de basura</label>
                                                                    <div>
                                                                        <input type="radio" id="basura0" name="recbasura" value="0" <?php if ($recgarbagecolector == "0") {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                                                                        <label for="basura0">Ninguno</label>
                                                                    </div>

                                                                    <div>
                                                                        <input type="radio" id="basura1" name="recbasura" value="1" <?php if ($recgarbagecolector == "1") {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                                                                        <label for="basura1">Usar ConcMarkSweepGC (Solo Java 8)</label>
                                                                    </div>

                                                                    <div>
                                                                        <input type="radio" id="basura2" name="recbasura" value="2" <?php if ($recgarbagecolector == "2") {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                                                                        <label for="basura2">Usar G1GC (Java 8/11 o superior)</label>
                                                                    </div>

                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <br>
                                                                    <label>Conversion Mapa ¡PRECAUCIÓN!</label>
                                                                    <div>
                                                                        <input id="opforceupgrade" name="opforceupgrade" type="checkbox" value="1"<?php if ($recforseupgrade == "1") {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                                                                        <label for="opforceupgrade">Usar --forceUpgrade (Requiere Versión: 1.13 o superior)</label>
                                                                    </div>

                                                                    <div>
                                                                        <input id="operasecache" name="operasecache" type="checkbox" value="1"<?php if ($recerasecache == "1") {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                                                                        <label for="operasecache">Usar --eraseCache (Requiere Versión: 1.14 o superior)</label>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <?php
                                                        }
                                                        ?>


                                                        <?php
                                                        //NOMBRE CARPETA
                                                        if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2) {
                                                        ?>
                                                            <div class="form-group">
                                                                <label for="eldirect">Nombre carpeta del servidor Minecraft</label>
                                                                <input readonly type="text" data-toggle="tooltip" data-placement="top" title="No se puede modificar la carpeta" class="form-control" id="eldirect" name="eldirect" required="required" value="<?php echo $reccarpmine; ?>">
                                                            </div>

                                                        <?php
                                                        }
                                                        ?>

                                                        <div class="form-group">
                                                            <span id="result"></span>
                                                        </div>

                                                        <button class="btn btn-primary btn-block" id="guardaserver" name="guardarserver">Guardar Cambios</button>
                                                        <input type="hidden" name="action" value="submit">

                                                    </form>


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
                </div>
                <!-- End of Content Wrapper -->
            </div>
            <!-- End of Page Wrapper -->
        </div>
        <script src="js/sysconf.js"></script>
    <?php
        //FINAL VALIDAR SESSION
    } else {
        header("location:index.php");
    }
    ?>

</body>

</html>