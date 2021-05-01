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

function converdatoscarpmine($losbytes, $opcion, $decimal)
{
    $eltipo = "GB";
    $result = $losbytes / 1048576;

    if ($opcion == 0) {
        $result = strval(round($result, $decimal));
        return $result;
    } elseif ($opcion == 1) {
        $result = strval(round($result, $decimal)) . " " . $eltipo;
        return $result;
    }
}

//COMPROVAR SI SESSION EXISTE SINO CREARLA CON NO
if (!isset($_SESSION['VALIDADO']) || !isset($_SESSION['KEYSECRETA'])) {
    $_SESSION['VALIDADO'] = "NO";
    $_SESSION['KEYSECRETA'] = "0";
}

//VALIDAMOS SESSION
if ($_SESSION['VALIDADO'] == $_SESSION['KEYSECRETA']) {

    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivosdescomprimir', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivosdescomprimir'] == 1) {

        if (isset($_POST['action']) && !empty($_POST['action'])) {

            $archivo = "";
            $retorno = "";
            $elerror = 0;
            $getarchivo = "";
            $limpio = "";
            $lacarpeta = "";
            $test = 0;

            $permcomando = "";
            $dirconfig = "";
            $reccarpmine = CONFIGDIRECTORIO;
            $limitmine = CONFIGFOLDERMINECRAFTSIZE;
            $rutacarpetamine = "";
            $getgigasmine = "";

            $archivo = test_input($_POST['action']);

            //OBTENER RUTA RAIZ
            $rutaraiz = dirname(getcwd()) . PHP_EOL;
            $rutaraiz = trim($rutaraiz);

            //OBTENER RUTA TEMP
            $dirtemp = "";
            $dirtemp = dirname(getcwd()) . PHP_EOL;
            $dirtemp = trim($dirtemp);
            $dirtemp .= "/temp";

            //OBTENER RUTA SH TEMP
            $dirsh = "";
            $dirsh = $dirtemp;
            $dirsh .= "/descomprimirzip.sh";

            //OBTENER IDENFIFICADOR SCREEN
            $nombrescreen = $rutaraiz . "/gestorarchivos";
            $nombrescreen = str_replace("/", "", $nombrescreen);

            //COMPROBAR SI ESTA VACIO
            if ($elerror == 0) {
                if ($archivo == "") {
                    $retorno = "nada";
                    $elerror = 1;
                }
            }

            //VER SI HAY UN PROCESO YA EN PROCESO
            if ($elerror == 0) {
                $elcomando = "screen -ls | awk '/\." . $nombrescreen . "\t/ {print strtonum($1)'}";
                $elpid = shell_exec($elcomando);

                if ($elpid != "") {
                    $retorno = "processenejecucion";
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

            //MIRAR SI EXISTE EL ARCHIVO A DESCOMPRIMIR
            if ($elerror == 0) {
                clearstatcache();
                if (!file_exists($archivo)) {
                    $retorno = "noexiste";
                    $elerror = 1;
                }
            }

            //MIRAR SI LA CARPETA TEMP EXISTE
            if ($elerror == 0) {
                clearstatcache();
                if (!file_exists($dirtemp)) {
                    $retorno = "notempexiste";
                    $elerror = 1;
                }
            }

            //MIRAR SI CARPETA TEMP SE PUEDE ESCRIVIR
            if ($elerror == 0) {
                clearstatcache();
                if (!is_writable($dirtemp)) {
                    $retorno = "notempwritable";
                    $elerror = 1;
                }
            }

            //obtener solo nombre fichero sin extension
            if ($elerror == 0) {
                $getarchivo = pathinfo($archivo);
                $laextension = strtolower($getarchivo['extension']);

                if ($laextension != "zip") {
                    $retorno = "nozip";
                    $elerror = 1;
                }
            }

            //COMPROBAR TIPO ARCHIVO
            if ($elerror == 0) {

                $eltipoapplication = mime_content_type($archivo);
                $eltipoapplication = trim($eltipoapplication);

                switch ($eltipoapplication) {
                    case "application/zip":
                        break;
                    default:
                        $elerror = 1;
                        $retorno = "novaltipe";
                }
            }

            //LIMITE ALMACENAMIENTO
            if ($elerror == 0) {

                //OBTENER CARPETA SERVIDOR MINECRAFT
                $rutacarpetamine = dirname(getcwd()) . PHP_EOL;
                $rutacarpetamine = trim($rutacarpetamine);
                $rutacarpetamine .= "/" . $reccarpmine;

                //OBTENER GIGAS CARPETA BACKUPS
                $getgigasmine = shell_exec("du -s " . $rutacarpetamine . " | awk '{ print $1 }' ");
                $getgigasmine = trim($getgigasmine);

                if (!is_numeric($getgigasmine)) {
                    $retorno = "ERRORGETSIZE";
                    $elerror = 1;
                }
            }

            if ($elerror == 0) {

                $getgigasmine = converdatoscarpmine($getgigasmine, 0, 2);

                //MIRAR SI ES ILIMITADO
                if ($limitmine >= 1) {
                    if ($getgigasmine > $limitmine) {
                        $retorno = "OUTGIGAS";
                        $elerror = 1;
                    }
                }
            }

            //COMPROVAR SI EXISTE LA CARPETA
            if ($elerror == 0) {
                $limpio = $getarchivo['filename'];
                $limpio = trim($limpio);
                $lacarpeta = $getarchivo['dirname'] . "/" . $limpio;

                clearstatcache();
                if (file_exists($lacarpeta)) {
                    $retorno = "carpyaexiste";
                    $elerror = 1;
                }
            }

            //DESCOMPRIMIR
            if ($elerror == 0) {

                $elcomando1 = "unzip '" . $archivo . "' -d " . "'" . $lacarpeta . "'";
                $elcomando2 = "cd '" . $lacarpeta . "' && find . -name .htaccess -print0 | xargs -0 -I {} rm {}";
                $delsh = "rm " . $dirsh;

                $file = fopen($dirsh, "w");
                fwrite($file, "#!/bin/bash" . PHP_EOL);
                fwrite($file, $elcomando1 . PHP_EOL);
                fwrite($file, $elcomando2 . PHP_EOL);
                fwrite($file, $delsh . PHP_EOL);
                fclose($file);

                //DAR PERMISOS AL SH
                $comando = "cd " . $dirtemp . " && chmod +x descomprimirzip.sh";
                exec($comando);

                //INICIAR SCREEN
                $comando = "cd " . $dirtemp . " && umask 002 && screen -dmS '" . $nombrescreen . "' sh descomprimirzip.sh";
                exec($comando, $out, $oky);

                if (!$oky) {
                    $_SESSION['GESTARCHPROSSES'] = 1;
                } else {
                    $retorno = "fallo";
                }
            }

            $elarray = array("eserror" => $retorno, "carpeta" => $limpio);
            echo json_encode($elarray);
        }
    }
}
