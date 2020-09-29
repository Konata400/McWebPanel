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

            $verificar = array('..', '...', '/.', '~', '../', './', '&&');

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

        //obtener solo nombre fichero sin extension
        if ($elerror == 0) {
            $getarchivo = pathinfo($archivo);
            $limpio = "." . strtolower($getarchivo['extension']);

            if ($limpio == ".zip") {
                $limpio = rtrim($getarchivo['basename'], ".zip");
            } else {
                $retorno = "nozip";
                $elerror = 1;
            }
        }

        //comprovar si existe la carpeta
        if ($elerror == 0) {
            $lacarpeta = $getarchivo['dirname'] . "/" . $limpio;

            clearstatcache();
            if (!file_exists($lacarpeta)) {
                mkdir($lacarpeta, 0700);
            } else {
                $retorno = "carpyaexiste";
                $elerror = 1;
            }
        }

        //DESCOMPRIMIR
        if ($elerror == 0) {

            $zip = new ZipArchive;
            if ($zip->open($archivo) === TRUE) {
                $zip->extractTo($lacarpeta);
                $zip->close();

                //PERFMISOS FTP
                $permcomando = "chmod -R 775 " . $lacarpeta;
                exec($permcomando);

                $retorno = 'ok';
            } else {
                $retorno = 'fallo';
            }
        }

        $elarray = array("eserror" => $retorno, "carpeta" => $limpio);
        echo json_encode($elarray);
    }
}
