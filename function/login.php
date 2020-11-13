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

function generarkey()
{
    $secretkey = "";
    $gethash = "";

    for ($a = 1; $a <= 32; $a++) {
        $secretkey .= strval(random_int(0, 9));
    }

    $gethash = hash("sha3-512", $secretkey);

    return $gethash;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //INICIAR VARIABLES
    $retorno = "";
    $elerror = 0;
    $noencontrouser = 0;
    $getconfuser = "";
    $getconfpass = "";
    $elusuario = "";
    $elpassword = "";
    $lakey = "";
    $receulaminecraft = "";
    $dirconfig = "";

    //SESSION DE REINTENTOS
    if (!isset($_SESSION['count'])) {
        $_SESSION['count'] = 0;
    } else {
        $_SESSION['count']++;
        if ($_SESSION['count'] >= 2) {
            $retorno = "maxintentos";
            $elerror = 1;
        }
    }

    //COMPROBAR SI HAY DATOS
    if ($elerror == 0) {

        if (!isset($_POST['eluser']) || !isset($_POST['elpass'])) {
            $retorno = "faltandatos";
            $elerror = 1;
        }
    }

    //LOGIN
    if ($elerror == 0) {
        require_once("../config/confopciones.php");

        $dirconfig = dirname(getcwd()) . PHP_EOL;
        $dirconfig = trim($dirconfig);
        $dirconfig .= "/config/confuser.json";

        //OBTENER ARRAY DE USUARIOS
        $getarray = file_get_contents($dirconfig);
        $arrayobtenido = unserialize($getarray);

        //COGER INDICE
        $elindice = count($arrayobtenido);

        //COGER INPUTS
        $elusuario = test_input($_POST["eluser"]);
        $elpassword = test_input($_POST["elpass"]);

        //GENERAR HASH
        $hashed = hash("sha3-512", $elpassword);

        //RECORRER USUARIOS DEL ARRAY
        for ($i = 0; $i < $elindice; $i++) {
            $getconfuser = $arrayobtenido[$i]['usuario'];
            $getconfpass = $arrayobtenido[$i]['hash'];

            //SI EL USUARIO CONCUERTDA
            if ($elusuario == $getconfuser && $hashed == $getconfpass) {
                $noencontrouser = 1;

                if ($arrayobtenido[$i]['estado'] == "desactivado") {
                    $retorno = "userdesactivado";
                } else {

                    //REGENERAR SESSION
                    session_regenerate_id();
                    $getconflakey = CONFIGSESSIONKEY;

                    $lakey = generarkey($lakey);

                    $_SESSION['KEYSECRETA'] = $lakey;
                    $_SESSION['VALIDADO'] = $lakey;
                    $_SESSION['IDENTIFICARSESSION'] = $getconflakey;
                    $_SESSION['CONFIGUSER'] = $arrayobtenido[$i];

                    unset($lakey);

                    $receulaminecraft = CONFIGEULAMINECRAFT;

                    if ($receulaminecraft == "") {
                        $retorno = "gotoeula";
                    } else {
                        $retorno = "gotostatus";
                    }
                }
            }
        }

        if ($noencontrouser == 0) {
            $retorno = "novaliduser";
        }
    }

    echo $retorno;
}
