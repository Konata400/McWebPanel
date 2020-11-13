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
<link href="css/editararchivo.css" rel="stylesheet">

</head>

<body id="page-top">

    <?php

    //COMPROVAR SI SESSION EXISTE SINO CREARLA CON NO
    if (!isset($_SESSION['VALIDADO']) || !isset($_SESSION['KEYSECRETA'])) {
        $_SESSION['VALIDADO'] = "NO";
        $_SESSION['KEYSECRETA'] = "0";
        header("location:index.php");
        exit;
    }

    //COMPROVAR SI ES EL SUPERADMIN O ADMIN O USER CON PERMISOS
    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivoseditar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivoseditar'] == 1) {
        $expulsar = 1;
    }

    if ($expulsar != 1) {
        header("location:index.php");
        exit;
    }

    //CARGAR SESSION
    if (!isset($_SESSION['EDITARFILE'])) {
        header("location:gestorarchivos.php");
        exit;
    }

    if ($_SESSION['EDITARFILE'] == "") {
        header("location:gestorarchivos.php");
        exit;
    }

    //MIRAR SI EXISTE
    clearstatcache();
    if (!file_exists($_SESSION['EDITARFILE'])) {
        $_SESSION['EDITARFILE'] == "";
        header("location:gestorarchivos.php");
        exit;
    }

    //MIRAR SI SE PUEDE SOBREESCRIVIR
    clearstatcache();
    if (!is_writable($_SESSION['EDITARFILE'])) {
        $_SESSION['EDITARFILE'] == "";
        header("location:gestorarchivos.php");
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

                                    <div class="container">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <?php

                                                $elerror = 0;
                                                $elarchivo = "";
                                                $getinfofile = "";
                                                $nombrefile = "";

                                                //MIRAR SI EXISTE EL ARCHIVO
                                                $elarchivo = $_SESSION['EDITARFILE'];

                                                $rutboton = explode('/', $_SESSION['EDITARFILE']);
                                                $rutboton = end($rutboton);
                                                $rutboton = trim($rutboton);

                                                //BORRAR SESSION
                                                $_SESSION['EDITARFILE'] = "";

                                                //LEER ARCHIVO
                                                if ($elerror == 0) {
                                                    $eltextofile = file_get_contents($elarchivo);

                                                    $getinfofile = pathinfo($elarchivo);
                                                    $nombrefile = $getinfofile['basename'];
                                                }

                                                ?>
                                                <h1 class="h2 text-gray-800 mb-3">Archivo: <?php echo $nombrefile; ?></h1>
                                                <textarea class="form-control textoeleditor" id="eleditor" name="eleditor"><?php echo $eltextofile; ?></textarea>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-primary btn-block btn-lg" id="guardarfile" type="button" value="<?php echo $rutboton; ?>">Guardar</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn btn-secondary btn-block btn-lg" id="cancelar" type="button">Cancelar</button>
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

        <script src="js/editararchivo.js"></script>

    <?php
        //FINAL VALIDAR SESSION
    } else {
        header("location:index.php");
    }
    ?>


</body>

</html>