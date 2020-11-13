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

    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivosborrar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivosborrar'] == 1) {

        if (isset($_POST['action']) && !empty($_POST['action'])) {

            function delete_directory($dirname)
            {
                if (is_dir($dirname))
                    $dir_handle = opendir($dirname);
                if (!$dir_handle)
                    return false;
                while ($file = readdir($dir_handle)) {
                    if ($file != "." && $file != "..") {
                        if (!is_dir($dirname . "/" . $file))
                            unlink($dirname . "/" . $file);
                        else
                            delete_directory($dirname . '/' . $file);
                    }
                }
                closedir($dir_handle);
                rmdir($dirname);
                return true;
            }

            $archivos = "";
            $retorno = "";
            $elerror = 0;
            $test = 0;

            $archivos = $_POST['action'];

            //COMPROBAR SI ESTA VACIO
            if ($elerror == 0) {
                if ($archivos == "") {
                    $retorno = "nocopy";
                    $elerror = 1;
                }
            }

            //AÑADIR RUTA ACTUAL AL ARCHIVO
            if ($elerror == 0) {
                for ($a = 0; $a < count($archivos); $a++) {
                    $archivos[$a] = $_SESSION['RUTACTUAL'] . "/" . $archivos[$a];
                }
            }

            //COMPROVAR QUE EL INICIO DE RUTA SEA IGUAL A LA SESSION
            if ($elerror == 0) {
                for ($a = 0; $a < count($archivos); $a++) {
                    if ($_SESSION['RUTALIMITE'] != substr($archivos[$a], 0, strlen($_SESSION['RUTALIMITE']))) {
                        $retorno = "rutacambiada";
                        $elerror = 1;
                    }
                }
            }


            //COMPOBAR SI HAY ".." "..."
            if ($elerror == 0) {
                $verificar = array('..', '...', '~', '../', './', '&&');

                for ($a = 0; $a < count($archivos); $a++) {

                    for ($i = 0; $i < count($verificar); $i++) {

                        $test = substr_count($archivos[$a], $verificar[$i]);

                        if ($test >= 1) {
                            $retorno = "novalido";
                            $elerror = 1;
                        }
                    }
                }
            }

            //COMPROVAR QUE EXISTAN TODOS
            if ($elerror == 0) {
                for ($a = 0; $a < count($archivos); $a++) {
                    clearstatcache();
                    if (!file_exists($archivos[$a])) {
                        $retorno = "noexiste";
                        $elerror = 1;
                    }
                }
            }

            //COMPROVAR SI SE PUEDEN ESCRIVIR
            if ($elerror == 0) {
                for ($a = 0; $a < count($archivos); $a++) {
                    clearstatcache();
                    if (!is_writable($archivos[$a])) {
                        $retorno = "nowrite";
                        $elerror = 1;
                    }
                }
            }

            //COMPROVAR SI SE PUEDEN ENTER/EJECUTAR
            if ($elerror == 0) {
                for ($a = 0; $a < count($archivos); $a++) {
                    clearstatcache();
                    if (is_dir($archivos[$a])) {
                        clearstatcache();
                        if (!is_executable($archivos[$a])) {
                            $retorno = "nopermenter";
                            $elerror = 1;
                        }
                    }
                }
            }

            //ELIMINAR ARCHIVOS Y CARPETAS
            if ($elerror == 0) {
                for ($a = 0; $a < count($archivos); $a++) {
                    clearstatcache();
                    if (is_dir($archivos[$a])) {
                        delete_directory($archivos[$a]);
                    } else {
                        unlink($archivos[$a]);
                    }
                }
                $retorno = "OK";
            }

            echo $retorno;
        }
    }
}
