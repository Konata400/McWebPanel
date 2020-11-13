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
require_once("../config/confopciones.php");

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

    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pbackupsrestaurar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pbackupsrestaurar'] == 1) {

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

            $retorno = "";
            $reccarpmine = CONFIGDIRECTORIO;
            $loserrores = 0;
            $verificarex = "";

            $archivo = test_input($_POST['action']);

            //Evitar poder ir a una ruta hacia atras
            if (strpos($archivo, '..') !== false || strpos($archivo, '*.*') !== false || strpos($archivo, '*/*.*') !== false) {
                exit;
            }

            //VERIFICAR EXTENSION
            $verificarex = substr($archivo, -7);
            if ($verificarex != ".tar.gz") {
                exit;
            }

            $rutaraiz = dirname(getcwd()) . PHP_EOL;
            $rutaraiz = trim($rutaraiz);

            $dirmine = $rutaraiz . "/" . $reccarpmine;

            $comproarchivo = $rutaraiz;
            $comproarchivo = $comproarchivo . "/backups/" . $archivo;

            //COMPROVAR SI LA RAIZ SE PUEDE ESCRIVIR
            if ($loserrores == 0) {
                clearstatcache();
                if (!is_writable($rutaraiz)) {
                    $retorno = "nowriteraiz";
                    $loserrores = 1;
                }
            }

            //COMPROVAR SI EXISTE LA CARPETA SERVIDOR MINECRAFT
            if ($loserrores == 0) {
                clearstatcache();
                if (!file_exists($dirmine)) {
                    $retorno = "nominexiste";
                    $loserrores = 1;
                }
            }

            //COMPROVAR SI SE PUEDE ESCRIBIR LA CARPETA SERVIDOR MINECRAFT
            if ($loserrores == 0) {
                clearstatcache();
                if (!is_writable($dirmine)) {
                    $retorno = "minenowrite";
                    $loserrores = 1;
                }
            }


            //COMPROVAR SI EXISTE EL ARCHIVO TAR
            if ($loserrores == 0) {
                clearstatcache();
                if (!file_exists($comproarchivo)) {
                    $retorno = "tarnoexiste";
                    $loserrores = 1;
                }
            }

            //COMPROVAR SI SE PUEDE ESCRIVIR EN ARCHIVO TAR
            if ($loserrores == 0) {
                clearstatcache();
                if (!is_readable($comproarchivo)) {
                    $retorno = "tarnolectura";
                    $loserrores = 1;
                }
            }

            //BORRAR CARPETA SERVIDOR MINECRAFT
            if ($loserrores == 0) {
                $compdel = delete_directory($dirmine);
                if ($compdel != 1) {
                    $loserrores = 1;
                    $retorno = "noborrado";
                }
            }


            //PROCEDE A RESTAURAR
            if ($loserrores == 0) {
                //CREAR CARPETA
                mkdir("$dirmine", 0700);

                //GUARDAR FICHERO .htaccess
                $diraccess = $dirmine . "/.htaccess";
                $fileht = fopen($diraccess, "w");
                fwrite($fileht, "deny from all" . PHP_EOL);
                fclose($fileht);

                //DESCOMPRIMIR TAR
                $dirbackups = $rutaraiz;
                $dirbackups = $dirbackups . "/backups/";

                $elcomando = "tar -xzvf " . $dirbackups . $archivo . " -C " . $dirmine;
                exec($elcomando, $out, $oky);

                if (!$oky) {
                    $retorno = "okrestore";
                } else {
                    $retorno = "norestore";
                }
            }
        }
        echo $retorno;
    }
}
