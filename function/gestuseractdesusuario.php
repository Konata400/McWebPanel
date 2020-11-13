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

    //COMPROVAR SI ES EL SUPERADMIN O ADMIN
    if (array_key_exists('rango', $_SESSION['CONFIGUSER'])) {

        if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2) {

            $archivo = "";
            $retorno = "";
            $elerror = 0;
            $test = 0;
            $usuario = "";

            if (!isset($_POST['action'])) {
                $retorno = "nohayusuario";
                $elerror = 1;
            }

            if ($elerror == 0) {
                $usuario = test_input($_POST['action']);
            }

            //RUTAS AL ARCHIVO
            if ($elerror == 0) {
                $rutaarchivo = dirname(getcwd()) . PHP_EOL;
                $rutaarchivo = trim($rutaarchivo);
                $rutaarchivo .= "/config";

                $elarchivo = $rutaarchivo;
                $elarchivo .= "/confuser.json";
            }


            //COMPROVAR SI EXISTE CARPETA CONFIG
            if ($elerror == 0) {
                clearstatcache();
                if (!file_exists($rutaarchivo)) {
                    $retorno = "errarchnoconfig";
                    $elerror = 1;
                }
            }

            //COMPROVAR SI CONFIG TIENE PERMISOS DE LECTURA
            if ($elerror == 0) {
                clearstatcache();
                if (!is_readable($rutaarchivo)) {
                    $retorno = "errconfignoread";
                    $elerror = 1;
                }
            }

            //COMPROVAR SI CONFIG TIENE PERMISOS DE ESCRITURA
            if ($elerror == 0) {
                clearstatcache();
                if (!is_writable($rutaarchivo)) {
                    $retorno = "errconfignowrite";
                    $elerror = 1;
                }
            }

            //COMPROVAR SI EXISTE EL JSON
            if ($elerror == 0) {
                clearstatcache();
                if (!file_exists($elarchivo)) {
                    $retorno = "errjsonnoexist";
                    $elerror = 1;
                }
            }

            //COMPROVAR SI SE PUEDE LEER EL JSON
            if ($elerror == 0) {
                clearstatcache();
                if (!is_readable($elarchivo)) {
                    $retorno = "errjsonnoread";
                    $elerror = 1;
                }
            }

            //COMPROVAR SI SE PUEDE ESCRIVIR EL JSON
            if ($elerror == 0) {
                clearstatcache();
                if (!is_writable($elarchivo)) {
                    $retorno = "errjsonnowrite";
                    $elerror = 1;
                }
            }


            //CARGAR ARRAY
            if ($elerror == 0) {
                $getarray = file_get_contents($elarchivo);
                $arrayobtenido = unserialize($getarray);
                $elindice = count($arrayobtenido);
            }

            //BORRAR USUARIO
            if ($elerror == 0) {

                if ($_SESSION['CONFIGUSER']['rango'] == 1) {

                    for ($i = 0; $i < count($arrayobtenido); $i++) {

                        if ($arrayobtenido[$i]['usuario'] != $usuario) {
                            $nuevoarray[] = $arrayobtenido[$i];
                        } else {
                            //PROTECCION EVITAR QUE SUPERADMIN SEA DESACTIVADO
                            if ($arrayobtenido[$i]['rango'] == 1) {
                                $nuevoarray[] = $arrayobtenido[$i];
                            } else {
                                switch ($arrayobtenido[$i]['estado']) {
                                    case "activado":
                                        $arrayobtenido[$i]['estado'] = "desactivado";
                                        break;
                                    case "desactivado":
                                        $arrayobtenido[$i]['estado'] = "activado";
                                        break;
                                }

                                $nuevoarray[] = $arrayobtenido[$i];
                            }
                        }
                    }

                    $serialized = serialize($nuevoarray);
                    file_put_contents($elarchivo, $serialized);
                    $retorno = "OK";
                } elseif ($_SESSION['CONFIGUSER']['rango'] == 2) {

                    for ($i = 0; $i < count($arrayobtenido); $i++) {

                        if ($arrayobtenido[$i]['usuario'] != $usuario) {
                            $nuevoarray[] = $arrayobtenido[$i];
                        } else {
                            //PROTECCION EVITAR QUE SUPERADMIN O ADMIN SEAN DESACTIVADOS
                            if ($arrayobtenido[$i]['rango'] == 1 || $arrayobtenido[$i]['rango'] == 2) {
                                $nuevoarray[] = $arrayobtenido[$i];
                            } else {
                                switch ($arrayobtenido[$i]['estado']) {
                                    case "activado":
                                        $arrayobtenido[$i]['estado'] = "desactivado";
                                        break;
                                    case "desactivado":
                                        $arrayobtenido[$i]['estado'] = "activado";
                                        break;
                                }

                                $nuevoarray[] = $arrayobtenido[$i];
                            }
                        }
                    }

                    $serialized = serialize($nuevoarray);
                    file_put_contents($elarchivo, $serialized);
                    $retorno = "OK";
                }
            }
        }
    }
    echo $retorno;
}
