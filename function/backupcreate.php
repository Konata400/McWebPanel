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

    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pbackupscrear', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pbackupscrear'] == 1) {

        if (isset($_POST['action']) && !empty($_POST['action'])) {

            $retorno = "";
            $reccarpmine = CONFIGDIRECTORIO;
            $elerror = 0;
            $test = 0;

            $archivo = test_input($_POST['action']);

            //Evitar poder ir a una ruta hacia atras
            if (strpos($archivo, '..') !== false || strpos($archivo, '*.*') !== false || strpos($archivo, '*/*.*') !== false) {
                exit;
            }

            if ($elerror == 0) {

                $verificar = array('..', '...', '/.', '~', '../', './', ';', ':', '>', '<', '/', '\\', '&&');

                for ($i = 0; $i < count($verificar); $i++) {

                    $test = substr_count($archivo, $verificar[$i]);

                    if ($test >= 1) {
                        $retorno = "novalidoname";
                        $elerror = 1;
                    }
                }
            }

            $dirconfig = "";
            $dirconfig = dirname(getcwd()) . PHP_EOL;
            $dirconfig = trim($dirconfig);
            $dirconfig .= "/backups";

            if ($elerror == 0) {
                if (file_exists($dirconfig)) {
                    //COMPROVAR SI SE PUEDE ESCRIVIR
                    if (is_writable($dirconfig)) {
                        $rutaarchivo = dirname(getcwd()) . PHP_EOL;
                        $rutaarchivo = trim($rutaarchivo);
                        $rutaminelimpia = $rutaarchivo . "/" . $reccarpmine;
                        if (is_readable($rutaminelimpia)) {
                            $rutaarchivo .= "/" . $reccarpmine . "/ .";
                            $dirconfig = $dirconfig . "/" . $archivo . "-";
                            //$t = time();
                            $t = date("Y-m-d-G:i:s");
                            $elcomando = "tar -czvf " . $dirconfig . $t . ".tar.gz -C " . $rutaarchivo;
                            if (is_executable($rutaminelimpia)) {
                                exec($elcomando, $out, $oky);

                                if (!$oky) {
                                    $retorno = "okbackup";
                                } else {
                                    $retorno = "nobackup";
                                    //AUNQUE NO SE CREA, A VECES SI CREA UN FICHERO VACIO
                                    $borrarerror = $dirconfig . $t . ".tar.gz";
                                    if (file_exists($borrarerror)) {
                                        unlink($borrarerror);
                                    }
                                }
                            } else {
                                $retorno = "noejecutable";
                            }
                        } else {
                            $retorno = "nolectura";
                        }
                    } else {
                        $retorno = "nowritable";
                    }
                } else {
                    $retorno = "noexiste";
                }
            }
        }
        echo $retorno;
    }
}
