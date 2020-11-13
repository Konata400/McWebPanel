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

    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('psubirservidor', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['psubirservidor'] == 1) {

        if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {

            $retorno = "";
            $elerror = 0;
            $target_dir = "";
            $target_file = "";
            $tmp = "";
            $archivo = "";
            $test = 0;

            $fileName = "";
            $fileNameCmps = "";
            $fileExtension = "";

            $tmp = $_FILES['uploadedFile']['tmp_name'];

            //COMPROVAR SI ES .JAR
            if ($elerror == 0) {
                $fileName = $_FILES['uploadedFile']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                if (!$fileExtension == "jar") {
                    $retorno = "nojar";
                    $elerror = 1;
                }
            }

            //COMPROBAR SI ES REALMENTE ARCHIVO JAVA
            if ($elerror == 0) {
                $eltipoapplication = mime_content_type($_FILES["uploadedFile"]["tmp_name"]);

                switch ($eltipoapplication) {
                    case "application/java-archive":
                        $tipovalido = 1;
                        break;
                    case "application/zip":
                        $tipovalido = 1;
                        break;
                }

                if ($tipovalido == 0) {
                    $retorno = "notipovalido";
                    $elerror = 1;
                }
            }

            //COMPOBAR SI HAY ".." "..."
            if ($elerror == 0) {

                $verificar = array('..', '...', '/.', '~', '../', './', ';', ':', '>', '<', '/', '\\', '&&');

                for ($i = 0; $i < count($verificar); $i++) {

                    $test = substr_count($fileName, $verificar[$i]);

                    if ($test >= 1) {
                        $retorno = "novalidoname";
                        $elerror = 1;
                    }
                }
            }

            //SI HAY PERMISOS ESCRITURA EN RAIZ
            if ($elerror == 0) {
                $rutaraiz = dirname(getcwd()) . PHP_EOL;
                $rutaraiz = trim($rutaraiz);

                clearstatcache();
                if (!is_writable($rutaraiz)) {
                    $retorno = "nowriteraiz";
                    $elerror = 1;
                }
            }

            //COMPROVAR SI EXISTE LA CARPETA MINECRAFT
            if ($elerror == 0) {
                $elnombredirectorio = CONFIGDIRECTORIO;
                $rutacarpetamine = dirname(getcwd()) . PHP_EOL;
                $rutacarpetamine = trim($rutacarpetamine);
                $rutacarpetamine .= "/" . $elnombredirectorio;

                clearstatcache();
                if (!file_exists($rutacarpetamine)) {
                    //SI NO EXISTE, CREARLA
                    mkdir("$rutacarpetamine", 0700);

                    //PERFMISOS FTP
                    $permcomando = "chmod 775 '" . $rutacarpetamine . "'";
                    exec($permcomando);
                }

                clearstatcache();
                if (!file_exists($rutacarpetamine)) {
                    $retorno = "nocarpserver";
                    $elerror = 1;
                }
            }

            //COMPROBAR PERMISOS ESCRITURA SERVER MINECRAFT
            if ($elerror == 0) {
                clearstatcache();
                if (!is_writable($rutacarpetamine)) {
                    $retorno = "nowriteservmine";
                    $elerror = 1;
                }
            }

            //CREAR .htaccess
            if ($elerror == 0) {
                $rutaescrivir = $rutacarpetamine;
                $rutaescrivir .= "/.htaccess";
                $file = fopen($rutaescrivir, "w");
                fwrite($file, "deny from all" . PHP_EOL);
                fclose($file);
            }

            //COMPROVAR SI EXISTE EL ARCHIVO A SUBIR EN LA CARPETA MINECRAFT
            if ($elerror == 0) {
                $rutacarpetamine .= "/" . $_FILES['uploadedFile']['name'];
                clearstatcache();
                if (file_exists($rutacarpetamine)) {
                    $retorno = "jarexiste";
                    $elerror = 1;
                }
            }

            if ($elerror == 0) {
                $target_dir = dirname(getcwd()) . PHP_EOL;
                $target_dir = trim($target_dir);
                $target_dir .= "/" . $elnombredirectorio . "/";
                $target_file = $target_dir . basename($_FILES["uploadedFile"]["name"]);

                if (move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], $target_file)) {

                    //PERFMISOS FTP
                    $permcomando = "chmod 664 '" . $target_file . "'";
                    exec($permcomando);

                    $retorno = "OK";
                } else {
                    $retorno = "errorsubir";
                }
            }
        } else {

            $retorno = "errprocess";
        }

        echo $retorno;
    }
}
