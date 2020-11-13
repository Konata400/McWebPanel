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
$rutaarchivo = "";
$elarchivo = "";

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

    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pprogtareascrear', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pprogtareascrear'] == 1) {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['action']) && $_POST['action'] === 'submit') {

                if ($elerror == 0) {
                    if (empty($_POST["mes"])) {
                        $retorno = "errmes";
                        $elerror = 1;
                    }
                }

                if ($elerror == 0) {
                    if (empty($_POST["semana"])) {
                        $retorno = "errsemana";
                        $elerror = 1;
                    }
                }

                if ($elerror == 0) {
                    if (empty($_POST["hora"])) {
                        $retorno = "errhora";
                        $elerror = 1;
                    }
                }

                if ($elerror == 0) {
                    if (empty($_POST["minuto"])) {
                        $retorno = "errminuto";
                        $elerror = 1;
                    }
                }

                if ($elerror == 0) {
                    $getaccion = test_input($_POST["laaccion"]);
                    if ($getaccion == "acc4") {
                        if (empty($_POST["elcomando"])) {
                            $retorno = "nocomando";
                            $elerror = 1;
                        } else {
                            $getcommando = $_POST["elcomando"];
                        }
                    } else {
                        $getcommando = "";
                    }
                }



                if ($elerror == 0) {
                    //OBTENER Y GENERAR ARRAY MES
                    $anadido = 0;

                    for ($i = 0; $i < 12; $i++) {
                        for ($b = 0; $b < count($_POST["mes"]); $b++) {
                            if ($_POST["mes"][$b] == (strval($i + 1))) {
                                $aresultmes['tmes'][$i] = strval($i + 1);
                                $anadido = 1;
                            }
                        }

                        if ($anadido == 0) {
                            $aresultmes['tmes'][$i] = '-1';
                        }

                        $anadido = 0;
                    }

                    //OBTENER Y GENERAR ARRAY SEMANA
                    $anadido = 0;

                    for ($i = 0; $i < 7; $i++) {
                        for ($b = 0; $b < count($_POST["semana"]); $b++) {
                            if ($_POST["semana"][$b] == (strval($i + 1))) {
                                $aresultsemana['tsemana'][$i] = strval($i + 1);
                                $anadido = 1;
                            }
                        }

                        if ($anadido == 0) {
                            $aresultsemana['tsemana'][$i] = '-1';
                        }

                        $anadido = 0;
                    }


                    //OBTENER Y GENERAR ARRAY HORA
                    $anadido = 0;

                    for ($i = 0; $i < 24; $i++) {
                        for ($b = 0; $b < count($_POST["hora"]); $b++) {
                            if ($_POST["hora"][$b] == strval($i)) {
                                $aresulthora['thora'][$i] = strval($i);
                                $anadido = 1;
                            }
                        }

                        if ($anadido == 0) {
                            $aresulthora['thora'][$i] = '-1';
                        }

                        $anadido = 0;
                    }


                    //OBTENER Y GENERAR ARRAY MINUTO
                    $anadido = 0;
                    $losminutos = "";

                    for ($i = 0; $i < 60; $i++) {
                        for ($b = 0; $b < count($_POST["minuto"]); $b++) {
                            if ($i >= 0 && $i <= 9) {
                                $losminutos = "0" . strval($i);
                            } else {
                                $losminutos = strval($i);
                            }
                            if ($_POST["minuto"][$b] == strval($losminutos)) {
                                $aresultminuto['tminuto'][$i] = strval($losminutos);
                                $anadido = 1;
                            }
                        }

                        if ($anadido == 0) {
                            $aresultminuto['tminuto'][$i] = '-1';
                        }

                        $anadido = 0;
                    }
                }

                //OBTENER RUTA CONFIG
                $rutaarchivo = dirname(getcwd()) . PHP_EOL;
                $rutaarchivo = trim($rutaarchivo);
                $rutaarchivo .= "/config";

                $elarchivo = $rutaarchivo;
                $elarchivo .= "/array.json";

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

                if ($elerror == 0) {
                    clearstatcache();
                    if (!file_exists($elarchivo)) {

                        //OBTENER DATOS Y GENERAR ARRAY FINAL
                        $arrayfinal[0]['nombre'] = test_input($_POST["nombretarea"]);
                        $arrayfinal[0]['accion'] = test_input($_POST["laaccion"]);
                        $arrayfinal[0]['estado'] = test_input("activado");
                        $arrayfinal[0]['comando'] = $getcommando;

                        for ($i = 0; $i < 12; $i++) {
                            $arrayfinal[0][$i]["mes"] = $aresultmes['tmes'][$i];
                        }

                        for ($i = 0; $i < 7; $i++) {
                            $arrayfinal[0][$i]["semana"] = $aresultsemana['tsemana'][$i];
                        }

                        for ($i = 0; $i < 24; $i++) {
                            $arrayfinal[0][$i]["hora"] = $aresulthora['thora'][$i];
                        }

                        for ($i = 0; $i < 60; $i++) {
                            $arrayfinal[0][$i]["minuto"] = $aresultminuto['tminuto'][$i];
                        }

                        //GUARDAR ARRAY EN ARCHIVO
                        $serialized = serialize($arrayfinal);
                        file_put_contents($elarchivo, $serialized);
                        $retorno = "OK";
                    } else {

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

                        if ($elerror == 0) {

                            $getarray = file_get_contents($elarchivo);
                            $arrayobtenido = unserialize($getarray);

                            $elindice = count($arrayobtenido);

                            $arrayobtenido[$elindice]['nombre'] = test_input($_POST["nombretarea"]);
                            $arrayobtenido[$elindice]['accion'] = test_input($_POST["laaccion"]);
                            $arrayobtenido[$elindice]['estado'] = test_input("activado");
                            $arrayobtenido[$elindice]['comando'] = $getcommando;

                            for ($i = 0; $i < 12; $i++) {
                                $arrayobtenido[$elindice][$i]["mes"] = $aresultmes['tmes'][$i];
                            }

                            for ($i = 0; $i < 7; $i++) {
                                $arrayobtenido[$elindice][$i]["semana"] = $aresultsemana['tsemana'][$i];
                            }

                            for ($i = 0; $i < 24; $i++) {
                                $arrayobtenido[$elindice][$i]["hora"] = $aresulthora['thora'][$i];
                            }

                            for ($i = 0; $i < 60; $i++) {
                                $arrayobtenido[$elindice][$i]["minuto"] = $aresultminuto['tminuto'][$i];
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
