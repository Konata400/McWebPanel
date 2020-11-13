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

$retorno = "";
$elerror = 0;

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

if ($_SESSION['VALIDADO'] == $_SESSION['KEYSECRETA']) {

    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pprogtareasactdes', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pprogtareasactdes'] == 1) {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['action']) && !empty($_POST['action'])) {

                $indexarrayborrar = test_input($_POST['action']);

                if ($indexarrayborrar == 'CERO') {
                    $indexarrayborrar = 0;
                }

                //OBTENER RUTA CONFIG
                $rutaarchivo = dirname(getcwd()) . PHP_EOL;
                $rutaarchivo = trim($rutaarchivo);
                $rutaarchivo .= "/config";

                $elarchivo = $rutaarchivo;
                $elarchivo .= "/array.json";

                //COMPROVAR SI EXISTE CARPETA CONFIG
                if ($elerror == 0) {
                    if (!file_exists($rutaarchivo)) {
                        $retorno = "errarchnoconfig";
                        $elerror = 1;
                    }
                }

                //COMPROVAR SI CONFIG TIENE PERMISOS DE LECTURA
                if ($elerror == 0) {
                    if (!is_readable($rutaarchivo)) {
                        $retorno = "errconfignoread";
                        $elerror = 1;
                    }
                }

                //COMPROVAR SI CONFIG TIENE PERMISOS DE ESCRITURA
                if ($elerror == 0) {
                    if (!is_writable($rutaarchivo)) {
                        $retorno = "errconfignowrite";
                        $elerror = 1;
                    }
                }

                if ($elerror == 0) {
                    clearstatcache();
                    if (file_exists($elarchivo)) {

                        //COMPROVAR SI SE PUEDE LEER EL JSON
                        if ($elerror == 0) {
                            if (!is_readable($elarchivo)) {
                                $retorno = "errjsonnoread";
                                $elerror = 1;
                            }
                        }

                        //COMPROVAR SI SE PUEDE ESCRIVIR EL JSON
                        if ($elerror == 0) {
                            if (!is_writable($elarchivo)) {
                                $retorno = "errjsonnowrite";
                                $elerror = 1;
                            }
                        }

                        if ($elerror == 0) {
                            //LEER FICHERO OBTENER ARRAY
                            $getarray = file_get_contents($elarchivo);
                            $arrayobtenido = unserialize($getarray);

                            $elindice = count($arrayobtenido);

                            for ($i = 0; $i < $elindice; $i++) {
                                if ($indexarrayborrar == $i) {
                                    $getestado = $arrayobtenido[$i]['estado'];

                                    switch ($getestado) {
                                        case "activado":
                                            $getestado = "desactivado";
                                            break;
                                        case "desactivado":
                                            $getestado = "activado";
                                            break;
                                    }

                                    $arrayobtenido[$i]['estado'] = $getestado;
                                }
                            }

                            $serialized = serialize($arrayobtenido);
                            file_put_contents($elarchivo, $serialized);

                            $retorno = "OK";
                        }
                    }
                }

                echo $retorno;
            }
        }
    }
}
