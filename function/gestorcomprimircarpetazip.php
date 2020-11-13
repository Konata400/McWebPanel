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

    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivoscomprimir', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivoscomprimir'] == 1) {

        if (isset($_POST['action']) && !empty($_POST['action'])) {

            $archivo = "";
            $retorno = "";
            $elerror = 0;
            $getarchivo = "";
            $limpio = "";
            $lacarpeta = "";
            $test = 0;

            $archivo = test_input($_POST['action']);

            //COMPROBAR SI ESTA VACIO
            if ($elerror == 0) {
                if ($archivo == "") {
                    $retorno = "nada";
                    $elerror = 1;
                }
            }

            //AÑADIR RUTA ACTUAL AL ARCHIVO
            if ($elerror == 0) {
                $archivo = $_SESSION['RUTACTUAL'] . "/" . $archivo;
            }

            //COMPROVAR QUE EL INICIO DE RUTA SEA IGUAL A LA SESSION
            if ($elerror == 0) {
                if ($_SESSION['RUTALIMITE'] != substr($archivo, 0, strlen($_SESSION['RUTALIMITE']))) {
                    $retorno = "rutacambiada";
                    $elerror = 1;
                }
            }

            //COMPOBAR SI HAY ".." "..."
            if ($elerror == 0) {

                $verificar = array('..', '...', '~', '../', './', '&&');

                for ($i = 0; $i < count($verificar); $i++) {

                    $test = substr_count($archivo, $verificar[$i]);

                    if ($test >= 1) {
                        $retorno = "novalido";
                        $elerror = 1;
                    }
                }
            }

            //MIRAR SI EXISTE
            if ($elerror == 0) {
                clearstatcache();
                if (!file_exists($archivo)) {
                    $retorno = "noexiste";
                    $elerror = 1;
                }
            }

            //COMPROBAR SI EXISTE EL FICHERO
            if ($elerror == 0) {

                $getarchivo = pathinfo($archivo);
                $limpio = $getarchivo['basename'];
                $limpio .= ".zip";

                $elzip = $_SESSION['RUTACTUAL'] . "/" . $limpio;

                clearstatcache();
                if (file_exists($elzip)) {
                    $retorno = "carpyaexiste";
                    $elerror = 1;
                }
            }

            //COMPROBAR SI SE PUEDE EJECUTAR/ENTRAR A LA CARPETA
            if ($elerror == 0) {
                clearstatcache();
                if (!is_executable($archivo)) {
                    $retorno = "nopermenter";
                    $elerror = 1;
                }
            }

            //COMPRIMIR
            if ($elerror == 0) {

                $zip = new ZipArchive();
                if ($zip->open($elzip, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {

                    $files = new RecursiveIteratorIterator(
                        new RecursiveDirectoryIterator($archivo),
                        RecursiveIteratorIterator::LEAVES_ONLY
                    );

                    foreach ($files as $name => $file) {

                        if (!$file->isDir()) {

                            $filePath = $file->getRealPath();
                            $relativePath = substr($filePath, strlen($archivo) + 1);

                            $zip->addFile($filePath, $relativePath);
                        }
                    }
                    $zip->close();

                    //PERFMISOS FTP
                    $permcomando = "chmod 664 '" . $elzip . "'";
                    exec($permcomando);

                    $retorno = "ok";
                } else {
                    $retorno = 'fallo';
                }
            }

            $elarray = array("eserror" => $retorno, "carpeta" => $limpio);
            echo json_encode($elarray);
        }
    }
}
