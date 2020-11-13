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

require_once("../template/session.php");
require_once("../template/errorreport.php");

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//COMPROVAR SI SESSION EXISTE SINO CREARLA CON NO
if (!isset($_SESSION['VALIDADO']) || !isset($_SESSION['KEYSECRETA'])) {
    $_SESSION['VALIDADO'] = "NO";
    $_SESSION['KEYSECRETA'] = "0";
}

//VALIDAMOS SESSION
if ($_SESSION['VALIDADO'] == $_SESSION['KEYSECRETA']) {

    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivosdescargar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivosdescargar'] == 1) {

        if (isset($_SESSION['RUTACTUAL'])) {

            if (isset($_GET['action']) && !empty($_GET['action'])) {

                $retorno = "";
                $getinfofile = "";
                $elerror = 0;
                $test = 0;

                $dirconfig = test_input($_GET['action']);

                //Evitar poder ir a una ruta hacia atras
                if (strpos($dirconfig, '..') !== false || strpos($dirconfig, '*.*') !== false || strpos($dirconfig, '*/*.*') !== false) {
                    exit;
                }

                //AÑADIR RUTA ACTUAL AL ARCHIVO
                if ($elerror == 0) {
                    $dirconfig = $_SESSION['RUTACTUAL'] . "/" . $dirconfig;
                }

                //COMPOBAR SI HAY ".." "..."
                if ($elerror == 0) {

                    $verificar = array('..', '...', '/.', '~', '../', './', '&&');

                    for ($i = 0; $i < count($verificar); $i++) {

                        $test = substr_count($dirconfig, $verificar[$i]);

                        if ($test >= 1) {
                            exit;
                        }
                    }
                }

                $getinfofile = pathinfo($dirconfig);

                //COMPROVAR SI ESTAS DENTRO DE LA CARPETA DEL FICHERO QUE QUIERES DESCARGAR
                if ($getinfofile['dirname'] != $_SESSION['RUTACTUAL']) {
                    exit;
                }


                //COMPROVAR SI EXISTE
                clearstatcache();
                if (file_exists($dirconfig)) {
                    //COMPROVAR SI SE PUEDE LEER
                    clearstatcache();
                    if (is_readable($dirconfig)) {
                        header('Content-Description: File Transfer');
                        header('Content-Type: application/octet-stream');
                        header('Content-Disposition: attachment; filename="' . basename($dirconfig) . '"');
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate');
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($dirconfig));
                        readfile($dirconfig);
                        exit;
                    } else {
                        echo ('<!doctype html><html lang="es"><head><title>Backups</title><link rel="stylesheet" href="../css/bootstrap.min.css"></head><body>');
                        echo '<div class="alert alert-danger" role="alert">Error: El backup no tiene permisos de lectura.</div>';
                        echo ('</body></html>');
                    }
                }
            }
        }
    }
}
