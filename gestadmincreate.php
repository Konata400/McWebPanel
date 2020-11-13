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

    //COMPROVAR SI ES EL SUPERADMIN O ADMIN
    if (array_key_exists('rango', $_SESSION['CONFIGUSER'])) {
        if ($_SESSION['CONFIGUSER']['rango'] == 1) {
            $expulsar = 1;
        }
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
                                            <h1 class="mb-5">Crear Administrador</h1>
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <form action="function/gestusercrearadmin.php" method="POST" id="form-createuser">
                                                        <div class="py-1">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="negrita" for="eluser">Nombre Usuario</label>
                                                                            <input type="text" class="form-control" id="eluser" name="eluser" required="required">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label class="negrita" for="elpass">Contraseña</label>
                                                                        <input type="password" class="form-control" id="elpass" name="elpass" placeholder="••••" required="required">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="negrita" for="elrepass">Confirmar Contraseña</label>
                                                                        <input type="password" class="form-control" id="elrepass" name="elrepass" placeholder="••••" required="required">
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <p class="lead" id="textoretorno"></p>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <br>
                                                                        <label class="negrita">Asignar Permisos:</label>
                                                                        <br><br>

                                                                        <!-- SYSTEM CONFIG -->
                                                                        <div class="negrita card-header text-white bg-primary">Página System Config</div>
                                                                        <div class="card-body border">

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="psystemconfpuerto" name="psystemconfpuerto" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="psystemconfpuerto">Puerto</label>
                                                                                </div>
                                                                                <p>Permite cambiar el puerto del servidor de minecraft.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="psystemconfmemoria" name="psystemconfmemoria" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="psystemconfmemoria">Memoria</label>
                                                                                </div>
                                                                                <p>Permite cambiar la memoria máxima del servidor.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="psystemconftipo" name="psystemconftipo" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="psystemconftipo">Tipo Servidor</label>
                                                                                </div>
                                                                                <p>Permite cambiar el tipo de servidor.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="psystemconfsubida" name="psystemconfsubida" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="psystemconfsubida">Limite Subida Archivos</label>
                                                                                </div>
                                                                                <p>Permite cambiar el tamaño máximo de subida de archivos.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="psystemconfnombre" name="psystemconfnombre" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="psystemconfnombre">Nombre Servidor</label>
                                                                                </div>
                                                                                <p>Permite cambiar el nombre del servidor.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="psystemconfavanzados" name="psystemconfavanzados" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="psystemconfavanzados">Parámetros Avanzados</label>
                                                                                </div>
                                                                                <p>Permite administrar las opciones de lanzamiento del servidor minecraft.</p>
                                                                            </div>

                                                                        </div>

                                                                    </div>


                                                                    <div class="col-md-12">
                                                                        <br>
                                                                        <button class="btn btn-lg btn-primary btn-block" id="btcrearusuario" name="btcrearusuario" type="submit">Crear Administrador</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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

                    <!-- Footer -->
                    <!-- End of Footer -->
                </div>
                <!-- End of Content Wrapper -->
            </div>
            <!-- End of Page Wrapper -->

            <script src="js/gestadmincreate.js"></script>

        </div>
    <?php
        //FINAL VALIDAR SESSION
    } else {
        header("location:index.php");
    }
    ?>

</body>

</html>