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

    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivos', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivos'] == 1) {

        if (isset($_POST['action']) && !empty($_POST['action'])) {

            $retorno = "";
            $elerror = 0;
            $downOne = "";
            $dirraiz = "";
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
                $archivo = $_SESSION['RUTACTUAL'];
            }

            //COMPROBAR QUE EL INICIO DE RUTA SEA IGUAL A LA SESSION
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

            //AÑADIR COLETILLA PARA IR ATRAS
            if ($elerror == 0) {
                $getsession = $_SESSION['RUTALIMITE'];

                $dirraiz = "";
                $dirraiz = dirname(getcwd()) . PHP_EOL;
                $dirraiz = trim($dirraiz);

                $downOne = dirname($archivo, 1);

                if ($downOne == $dirraiz) {
                    $retorno = "noatras";
                    $elerror = 1;
                }

                //COMPROBAR QUE LA RUTA OBTENIDA NO ESTE POR DEBAJO DE RUTA RAIZ
                if ($dirraiz != substr($archivo, 0, strlen($dirraiz))) {
                    $retorno = "noatras";
                    $elerror = 1;
                }
            }

            if ($elerror == 0) {
                $_SESSION['RUTACTUAL'] = $downOne;
                $retorno = "OK";
            }

            echo $retorno;
        }
    }
}
