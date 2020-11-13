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
<link href="css/consola.css" rel="stylesheet">

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
    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pconsolaread', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pconsolaread'] == 1) {
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

                        <!-- Page Heading -->
                        <h1 class="h3 text-gray-800 pt-2 mb-2">Consola</h1>

                        <div class="py-0">

                            <div class="row">
                                <div class="col-md-12">
                                    <textarea readonly class="form-control textoconsola mb-1" id="laconsola" name="laconsola"></textarea>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <?php
                        if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pconsolaenviar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pconsolaenviar'] == 1) {
                        ?>
                            <div class="py-0">

                                <div class="row">
                                    <div class="col-md-11">
                                        <input type="text" class="form-control mb-2" id="elcomando" name="elcomando" placeholder="Comando">
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-primary mb-2" id="botonconsola" type="button">Enviar</button>
                                    </div>
                                </div>

                            </div>
                        <?php
                        }
                        ?>


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

        <script src="js/consola.js"></script>

    <?php
        //FINAL VALIDAR SESSION
    } else {
        header("location:index.php");
    }
    ?>
</body>

</html>