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

    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pbackupsdescargar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pbackupsdescargar'] == 1) {

        if (isset($_GET['action']) && !empty($_GET['action'])) {

            $retorno = "";
            $verificarex = "";

            $archivo = test_input($_GET['action']);

            //Evitar poder ir a una ruta hacia atras
            if (strpos($archivo, '..') !== false || strpos($archivo, '*.*') !== false || strpos($archivo, '*/*.*') !== false) {
                exit;
            }

            //VERIFICAR EXTENSION
            $verificarex = substr($archivo, -7);
            if ($verificarex != ".tar.gz") {
                exit;
            }

            $dirconfig = "";
            $dirconfig = dirname(getcwd()) . PHP_EOL;
            $dirconfig = trim($dirconfig);
            $dirconfig .= "/backups";

            $dirconfig = $dirconfig . "/" . $archivo;

            //COMPROVAR SI EXISTE
            if (file_exists($dirconfig)) {
                //COMPROVAR SI SE PUEDE LEER
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
