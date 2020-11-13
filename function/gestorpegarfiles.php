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

    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pgestorarchivoscopiar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pgestorarchivoscopiar'] == 1) {

        if (isset($_POST['action']) && !empty($_POST['action'])) {

            $copiados = array();
            $getpost = "";
            $retorno = "";
            $elerror = 0;
            $ejecucion = "";

            $getpost = test_input($_POST['action']);

            if ($getpost != "ok") {
                $elerror = 1;
            } else {
                $copiados = $_SESSION['COPIARFILES'];
            }

            //COMPROBAR SI ESTA VACIO
            if ($elerror == 0) {
                if ($copiados == "") {
                    $retorno = "nocopy";
                    $elerror = 1;
                }
            }

            //COMPROVAR QUE EXISTAN TODOS
            if ($elerror == 0) {
                for ($a = 0; $a < count($copiados); $a++) {
                    clearstatcache();
                    if (!file_exists($copiados[$a])) {
                        $retorno = "noexiste";
                        $elerror = 1;
                    }
                }
            }

            //MIRAR SI LA CARPETA DONDE SE COPIARAN TIENE PERMISOS DE ESCRITURA
            if ($elerror == 0) {
                clearstatcache();
                if (!is_writable($_SESSION['RUTACTUAL'])) {
                    $retorno = "nowrite";
                    $elerror = 1;
                }
            }

            //PEGAR
            if ($elerror == 0) {
                for ($b = 0; $b < count($copiados); $b++) {
                    $ejecucion = "cp -r '" . $copiados[$b] . "' " . $_SESSION['RUTACTUAL'];
                    shell_exec($ejecucion);
                }

                //PERFMISOS FTP
                $permcomando = "cd '" . $_SESSION['RUTACTUAL'] . "' && find . -type d -print0 | xargs -0 -I {} chmod 775 {}";
                exec($permcomando);
                $permcomando = "cd '" . $_SESSION['RUTACTUAL'] . "' && find . -type f -print0 | xargs -0 -I {} chmod 664 {}";
                exec($permcomando);

                $retorno = "OK";
            }

            $_SESSION['COPIARFILES'] = "0";
            echo $retorno;
        }
    }
}
