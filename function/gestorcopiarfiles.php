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


//COMPROVAR SI SESSION EXISTE SINO CREARLA CON NO
if (!isset($_SESSION['VALIDADO']) || !isset($_SESSION['KEYSECRETA'])) {
    $_SESSION['VALIDADO'] = "NO";
    $_SESSION['KEYSECRETA'] = "0";
}

//VALIDAMOS SESSION
if ($_SESSION['VALIDADO'] == $_SESSION['KEYSECRETA']) {

    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivoscopiar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivoscopiar'] == 1) {

        if (isset($_POST['action']) && !empty($_POST['action'])) {

            $copiados = array();
            $retorno = "";
            $elerror = 0;
            $test = 0;

            $copiados = $_POST['action'];

            //COMPROBAR SI ESTA VACIO
            if ($elerror == 0) {
                if ($copiados == "") {
                    $retorno = "nocopy";
                    $elerror = 1;
                }
            }

            //SANEAR INPUT ENTRANTE ARRAY
            if ($elerror == 0) {
                for ($a = 0; $a < count($copiados); $a++) {
                    $copiados[$a] = trim($copiados[$a]);
                    $copiados[$a] = stripslashes($copiados[$a]);
                    $copiados[$a] = htmlspecialchars($copiados[$a]);
                }
            }

            //AÑADIR RUTA ACTUAL AL COPIADOS
            if ($elerror == 0) {
                for ($a = 0; $a < count($copiados); $a++) {
                    $copiados[$a] = $_SESSION['RUTACTUAL'] . "/" . $copiados[$a];
                }
            }

            //COMPROVAR QUE EL INICIO DE RUTA SEA IGUAL A LA SESSION
            if ($elerror == 0) {

                for ($a = 0; $a < count($copiados); $a++) {

                    if ($_SESSION['RUTALIMITE'] != substr($copiados[$a], 0, strlen($_SESSION['RUTALIMITE']))) {
                        $retorno = "rutacambiada";
                        $elerror = 1;
                    }
                }
            }

            //COMPOBAR SI HAY ".." "..."
            if ($elerror == 0) {

                $verificar = array('..', '...', '~', '../', './', '&&');

                for ($a = 0; $a < count($copiados); $a++) {

                    for ($i = 0; $i < count($verificar); $i++) {

                        $test = substr_count($copiados[$a], $verificar[$i]);

                        if ($test >= 1) {
                            $retorno = "novalido";
                            $elerror = 1;
                        }
                    }
                }
            }

            //MIRAR SI EXISTE
            if ($elerror == 0) {
                for ($a = 0; $a < count($copiados); $a++) {
                    clearstatcache();
                    if (!file_exists($copiados[$a])) {
                        $retorno = "noexiste";
                        $elerror = 1;
                    }
                }
            }

            //COMPROVAR SI SE PUEDEN ENTER/EJECUTAR
            if ($elerror == 0) {
                for ($a = 0; $a < count($copiados); $a++) {
                    clearstatcache();
                    if (is_dir($copiados[$a])) {
                        clearstatcache();
                        if (!is_executable($copiados[$a])) {
                            $retorno = "nopermenter";
                            $elerror = 1;
                        }
                    }
                }
            }

            if ($elerror == 0) {
                $_SESSION['COPIARFILES'] = $copiados;
                $retorno = "OK";
            }

            echo $retorno;
        }
    }
}
