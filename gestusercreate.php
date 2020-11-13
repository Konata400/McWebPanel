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
        if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2) {
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
                                            <h1 class="mb-5">Crear Usuario</h1>
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <form action="function/gestusercrearusuario.php" method="POST" id="form-createuser">
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

                                                                        <!-- STATUS -->
                                                                        <div class="negrita card-header text-white bg-primary">Página Status</div>
                                                                        <div class="card-body border">

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pstatusstarserver" name="pstatusstarserver" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pstatusstarserver">Iniciar Servidor</label>
                                                                                </div>
                                                                                <p>Permite al usuario iniciar el servidor.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pstatusstopserver" name="pstatusstopserver" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pstatusstopserver">Apagar Servidor</label>
                                                                                </div>
                                                                                <p>Permite al usuario apagar el servidor.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pstatuskillserver" name="pstatuskillserver" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pstatuskillserver">Kill Servidor</label>
                                                                                </div>
                                                                                <p>Permite al usuario matar el proceso del servidor.</p>
                                                                            </div>

                                                                        </div>

                                                                        <br>

                                                                        <!-- Consola -->
                                                                        <div class="negrita card-header text-white bg-primary">Página Consola</div>
                                                                        <div class="card-body border">

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pconsolaread" name="pconsolaread" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pconsolaread">Acceder y Leer Consola</label>
                                                                                </div>
                                                                                <p>Permite acceder a la página y leer la consola del servidor.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pconsolaenviar" name="pconsolaenviar" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pconsolaenviar">Enviar Comando</label>
                                                                                </div>
                                                                                <p>Permite enviar comandos a la consola del servidor.</p>
                                                                            </div>

                                                                        </div>

                                                                        <br>

                                                                        <!-- CONFIG MINECRAFT -->
                                                                        <div class="negrita card-header text-white bg-primary">Página Config Minecraft</div>
                                                                        <div class="card-body border">

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pconfmine" name="pconfmine" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pconfmine">Acceder y Configurar</label>
                                                                                </div>
                                                                                <p>Permite acceder a la página y configurar server properties de minecraft.</p>
                                                                            </div>

                                                                        </div>

                                                                        <br>

                                                                        <!-- PROG TAREAS -->
                                                                        <div class="negrita card-header text-white bg-primary">Página Prog Tareas</div>
                                                                        <div class="card-body border">

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pprogtareas" name="pprogtareas" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pprogtareas">Acceder</label>
                                                                                </div>
                                                                                <p>Permite acceder a la página de tareas.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pprogtareascrear" name="pprogtareascrear" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pprogtareascrear">Crear Tareas</label>
                                                                                </div>
                                                                                <p>Permite crear tareas programables.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pprogtareasactdes" name="pprogtareasactdes" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pprogtareasactdes">Activar / Desactivar Tareas</label>
                                                                                </div>
                                                                                <p>Permite activar / desactivar tareas programadas.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pprogtareasborrar" name="pprogtareasborrar" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pprogtareasborrar">Borrar Tareas</label>
                                                                                </div>
                                                                                <p>Permite borrar las tareas programadas.</p>
                                                                            </div>

                                                                        </div>

                                                                        <br>

                                                                        <!-- SYSTEM CONFIG -->
                                                                        <div class="negrita card-header text-white bg-primary">Página System Config</div>
                                                                        <div class="card-body border">

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="psystemconf" name="psystemconf" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="psystemconf">Acceder y Configurar</label>
                                                                                </div>
                                                                                <p>Permite acceder a la página y seleccionar el servidor .jar existente.</p>
                                                                            </div>

                                                                        </div>

                                                                        <br>

                                                                        <!-- SUBIR SERVIDOR -->
                                                                        <div class="negrita card-header text-white bg-primary">Página Subir Servidor</div>
                                                                        <div class="card-body border">

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="psubirservidor" name="psubirservidor" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="psubirservidor">Acceder y Configurar</label>
                                                                                </div>
                                                                                <p>Permite acceder a la página y subir el servidor minecraft .jar</p>
                                                                            </div>

                                                                        </div>

                                                                        <br>

                                                                        <!-- Backups -->
                                                                        <div class="negrita card-header text-white bg-primary">Página Backups</div>
                                                                        <div class="card-body border">

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pbackups" name="pbackups" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pbackups">Acceder</label>
                                                                                </div>
                                                                                <p>Permite acceder a la página de backups.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pbackupscrear" name="pbackupscrear" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pbackupscrear">Crear Backups</label>
                                                                                </div>
                                                                                <p>Permite crear backups del servidor.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pbackupsdescargar" name="pbackupsdescargar" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pbackupsdescargar">Descargar Backups</label>
                                                                                </div>
                                                                                <p>Permite descargar backups.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pbackupsrestaurar" name="pbackupsrestaurar" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pbackupsrestaurar">Restaurar Backups</label>
                                                                                </div>
                                                                                <p>Permite restaurar backups.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pbackupsborrar" name="pbackupsborrar" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pbackupsborrar">Borrar Backups</label>
                                                                                </div>
                                                                                <p>Permite borrar backups.</p>
                                                                            </div>

                                                                        </div>

                                                                        <br>

                                                                        <!-- Gestor Archivos -->
                                                                        <div class="negrita card-header text-white bg-primary">Página Gestor Archivos</div>
                                                                        <div class="card-body border">

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pgestorarchivos" name="pgestorarchivos" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pgestorarchivos">Acceder</label>
                                                                                </div>
                                                                                <p>Permite acceder al gestor de archivos.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pgestorarchivoscrearcarpeta" name="pgestorarchivoscrearcarpeta" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pgestorarchivoscrearcarpeta">Crear Carpetas</label>
                                                                                </div>
                                                                                <p>Permite crear carpetas.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pgestorarchivoscopiar" name="pgestorarchivoscopiar" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pgestorarchivoscopiar">Copiar / Pegar</label>
                                                                                </div>
                                                                                <p>Permite copiar y pegar archivos y carpetas.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pgestorarchivosborrar" name="pgestorarchivosborrar" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pgestorarchivosborrar">Eliminar</label>
                                                                                </div>
                                                                                <p>Permite borrar archivos y carpetas.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pgestorarchivosdescomprimir" name="pgestorarchivosdescomprimir" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pgestorarchivosdescomprimir">Descomprimir</label>
                                                                                </div>
                                                                                <p>Permite descomprimir archivos zip y tar.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pgestorarchivoscomprimir" name="pgestorarchivoscomprimir" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pgestorarchivoscomprimir">Comprimir</label>
                                                                                </div>
                                                                                <p>Permite comprimir carpetas en zip.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pgestorarchivosdescargar" name="pgestorarchivosdescargar" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pgestorarchivosdescargar">Descargar</label>
                                                                                </div>
                                                                                <p>Permite descargar archivos.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pgestorarchivoseditar" name="pgestorarchivoseditar" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pgestorarchivoseditar">Editar Archivos</label>
                                                                                </div>
                                                                                <p>Permite editar archivos.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pgestorarchivosrenombrar" name="pgestorarchivosrenombrar" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pgestorarchivosrenombrar">Renombrar</label>
                                                                                </div>
                                                                                <p>Permite renombrar archivos y carpetas.</p>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <input id="pgestorarchivossubir" name="pgestorarchivossubir" type="checkbox" value="1">
                                                                                    <label class="negrita mr-2" for="pgestorarchivossubir">Subir Archivo</label>
                                                                                </div>
                                                                                <p>Permite subir archivos.</p>
                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <br>
                                                                        <button class="btn btn-lg btn-primary btn-block" id="btcrearusuario" name="btcrearusuario" type="submit">Crear Usuario</button>
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

            <script src="js/gestusercreate.js"></script>

        </div>
    <?php
        //FINAL VALIDAR SESSION
    } else {
        header("location:index.php");
    }
    ?>

</body>

</html>