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
    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pprogtareas', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pprogtareas'] == 1) {
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
                                            <h1 class="">Programar Tareas</h1>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-borderless">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Nombre</th>
                                                                    <th scope="col">Acción</th>
                                                                    <th scope="col">Comando</th>
                                                                    <th scope="col">Estado</th>
                                                                    <th scope="col">Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php

                                                                function devolver_accion($laaccion)
                                                                {
                                                                    if ($laaccion == "acc1") {
                                                                        return "Apagar Servidor";
                                                                    } elseif ($laaccion == "acc2") {
                                                                        return "Iniciar Servidor";
                                                                    } elseif ($laaccion == "acc3") {
                                                                        return "Backup Servidor";
                                                                    } elseif ($laaccion == "acc4") {
                                                                        return "Enviar Comando";
                                                                    }
                                                                }

                                                                function test_input($data)
                                                                {
                                                                    $data = trim($data);
                                                                    $data = stripslashes($data);
                                                                    $data = htmlspecialchars($data);
                                                                    return $data;
                                                                }

                                                                //INICIAR VARIABLES
                                                                $contadorarchivos = 0;
                                                                $eltamano = "";
                                                                $archivoconcreto = "";

                                                                //OBTENER RUTA BACKUPS
                                                                $rutaarchivo = getcwd();
                                                                $rutaarchivo = trim($rutaarchivo);
                                                                $rutaarchivo .= "/config";

                                                                $elarchivo = $rutaarchivo . "/array.json";

                                                                if (file_exists($elarchivo)) {
                                                                    $contadorarchivos = 1;
                                                                }

                                                                //SI NO HAY ARCHIVOS MOSTRAR INFORMACION
                                                                if ($contadorarchivos == 0) {
                                                                    echo ('<tr>');
                                                                    echo ('<th scope="row">No hay ninguna tarea programada.</th><td></td><td></td><td></td><td></td>');
                                                                    echo ('</tr>');
                                                                } else {

                                                                    //OBTENER ARRAY TAREAS
                                                                    $getarray = file_get_contents($elarchivo);
                                                                    $arrayobtenido = unserialize($getarray);

                                                                    //RECORRER ARRAY Y AÑADIR LAS PROPIEDADES Y LOS BOTONES
                                                                    for ($i = 0; $i < count($arrayobtenido); $i++) {
                                                                        echo ('<tr class="menu-hover" id="' . $i . '">');
                                                                        echo ('<th scope="row">' . $arrayobtenido[$i]["nombre"] . '</th>');
                                                                        echo ('<td>' . devolver_accion($arrayobtenido[$i]["accion"]) . '</td>');
                                                                        echo ('<td>' . test_input(addslashes($arrayobtenido[$i]["comando"])) . '</td>');
                                                                        echo ('<td>' . $arrayobtenido[$i]["estado"] . '</td>');
                                                                        echo ('<td>');
                                                                ?>

                                                                        <?php
                                                                        if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pprogtareasactdes', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pprogtareasactdes'] == 1) {
                                                                        ?>
                                                                            <button type="button" class="actdes btn btn-info text-white mr-1" value="<?php echo $i ?>">Activar/Desactivar</button>
                                                                        <?php
                                                                        }
                                                                        ?>

                                                                        <?php
                                                                        if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pprogtareasborrar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pprogtareasborrar'] == 1) {
                                                                        ?>
                                                                            <button type="button" class="borrar btn text-white btn-danger" value="<?php echo $i ?>">Borrar</button>
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

                                                    </div>
                                                    <hr>
                                                    <?php
                                                    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pprogtareascrear', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pprogtareascrear'] == 1) {
                                                    ?>

                                                        <h1 class="">Crear Tarea</h1>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <button type="button" class="btn btn-primary btn-block btn-lg text-white mt-2" id="anadirtarea">Añadir Nueva Tarea</button>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <p class="lead" id="textotarearetorno"></p>
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
            </div>
        </div>

        <script src="js/tareas.js"></script>

    <?php

        //FINAL VALIDAR SESSION
    } else {
        header("location:index.php");
    }
    ?>

</body>

</html>