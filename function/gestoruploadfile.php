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

    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivossubir', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivossubir'] == 1) {

        if (isset($_SESSION['RUTACTUAL'])) {

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

                //GUARDAMOS LA RUTA DONDE SE SUBIRAN LOS ARCHIVOS
                $target_dir = $_SESSION['RUTACTUAL'];

                //GUARDAMOS EL ARCHIVO TEMPORAL A SUBIR
                $tmp = $_FILES['uploadedFile']['tmp_name'];

                //COMPROVAR SI ES UN ARCHIVO NO PERMITIDO
                if ($elerror == 0) {
                    $fileName = $_FILES['uploadedFile']['name'];
                    $fileNameCmps = explode(".", $fileName);
                    $fileExtension = strtolower(end($fileNameCmps));


                    $verificar = array('phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'exe', 'pl', 'asp', 'aspx', 'shtml', 'shtm', 'fcgi', 'fpl', 'jsp', 'htm', 'html', 'wml', 'js', 'xhtml', 'xht', 'asa', 'cer', 'asax', 'swf', 'xap', 'css', 'sh', 'py', 'pdf');

                    for ($i = 0; $i < count($verificar); $i++) {

                        if ($fileExtension == $verificar[$i]) {
                            $retorno = "novalido";
                            $elerror = 1;
                        }
                    }
                }

                //COMPROBAR SI ES REALMENTE EL ARCHIVO QUE DICE SER
                if ($elerror == 0) {
                    $eltipoapplication = mime_content_type($_FILES["uploadedFile"]["tmp_name"]);

                    switch ($eltipoapplication) {
                        case "text/html":
                            $elerror = 1;
                            $retorno = "novaltipe";
                            break;
                        case "text/x-php":
                            $elerror = 1;
                            $retorno = "novaltipe";
                            break;
                        case "text/css":
                            $elerror = 1;
                            $retorno = "novaltipe";
                            break;
                        case "application/javascript":
                            $elerror = 1;
                            $retorno = "novaltipe";
                            break;
                        case "application/pkix-cert":
                            $elerror = 1;
                            $retorno = "novaltipe";
                            break;
                        case "application/xhtml+xml":
                            $elerror = 1;
                            $retorno = "novaltipe";
                            break;
                        case "application/x-shockwave-flash":
                            $elerror = 1;
                            $retorno = "novaltipe";
                            break;
                        case "application/x-silverlight-app":
                            $elerror = 1;
                            $retorno = "novaltipe";
                            break;
                        case "text/x-shellscript":
                            $elerror = 1;
                            $retorno = "novaltipe";
                            break;
                        case "application/pdf":
                            $elerror = 1;
                            $retorno = "novaltipe";
                            break;
                        case "application/x-msdownload":
                            $elerror = 1;
                            $retorno = "novaltipe";
                            break;
                    }
                }

                //COMPOBAR SI HAY ".." "..."
                if ($elerror == 0) {

                    $fileName = $_FILES['uploadedFile']['name'];

                    $verificar = array('..', '...', '/.', '~', '../', './', ';', ':', '>', '<', '/', '\\', '&&');

                    for ($i = 0; $i < count($verificar); $i++) {

                        $test = substr_count($fileName, $verificar[$i]);

                        if ($test >= 1) {
                            $retorno = "novalidoname";
                            $elerror = 1;
                        }
                    }
                }

                //COMPROVAR SI SE PUEDE ESCRIVIR LA RUTA
                if ($elerror == 0) {
                    clearstatcache();
                    if (!is_writable($target_dir)) {
                        $retorno = "nowrite";
                        $elerror = 1;
                    }
                }

                //COMPROVAR SI EXISTE UN ARCHIVO IGUAL
                if ($elerror == 0) {
                    $archivo = $target_dir;
                    $archivo .= "/" . $_FILES['uploadedFile']['name'];

                    clearstatcache();
                    if (file_exists($archivo)) {
                        $retorno = "yaexiste";
                        $elerror = 1;
                    }
                }

                //SUBIR ARCHIVO
                if ($elerror == 0) {

                    $target_file = $target_dir . "/" . basename($_FILES["uploadedFile"]["name"]);

                    if (move_uploaded_file($tmp, $target_file)) {

                        //PERFMISOS FTP
                        $permcomando = "chmod 664 '" . $target_file . "'";
                        exec($permcomando);

                        $retorno = "subidook";
                    } else {
                        $retorno = "errorupload";
                    }
                }
            } else {

                $retorno = "errprocess";
            }

            echo $retorno;
        }
    }
}
