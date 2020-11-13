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

    if (isset($_POST['action']) && !empty($_POST['action'])) {

        $retorno = "";

        $lakey = CONFIGSESSIONKEY;
        $elnombreservidor = CONFIGNOMBRESERVER;
        $eldirectorio = CONFIGDIRECTORIO;
        $elpuerto = CONFIGPUERTO;
        $laram = CONFIGRAM;
        $eltiposerver = CONFIGTIPOSERVER;
        $ellistadojars = CONFIGARCHIVOJAR;
        $eleulaminecraft = 1;
        $elmaxupload = CONFIGMAXUPLOAD;
        $elgarbagecolector = CONFIGOPTIONGARBAGE;
        $elforseupgrade = CONFIGOPTIONFORCEUPGRADE;
        $elerasecache = CONFIGOPTIONERASECACHE;

        //OBTENER RUTA DONDE TIENE QUE ESTAR LA CARPETA CONFIG
        $dirconfig = "";
        $dirconfig = dirname(getcwd()) . PHP_EOL;
        $dirconfig = trim($dirconfig);
        $dirconfig .= "/config";

        if (file_exists($dirconfig)) {
            //COMPROVAR SI SE PUEDE ESCRIVIR
            if (is_writable($dirconfig)) {

                //CREAR RUTA FICHERO .htaccess
                $rutaescrivir = $dirconfig;
                $rutaescrivir .= "/.htaccess";

                //GUARDAR FICHERO .htaccess
                $file = fopen($rutaescrivir, "w");
                fwrite($file, "deny from all" . PHP_EOL);
                fclose($file);

                //CREAR RUTA FICHERO CONFOPCIONES.PHP
                $rutaescrivir = $dirconfig;
                $rutaescrivir .= "/confopciones.php";

                //GUARDAR FICHERO CONFOPCIONES.PHP
                $file = fopen($rutaescrivir, "w");
                fwrite($file, "<?php " . PHP_EOL);
                fwrite($file, 'define("CONFIGSESSIONKEY", "' . $lakey . '");' . PHP_EOL);
                fwrite($file, 'define("CONFIGNOMBRESERVER", "' . $elnombreservidor . '");' . PHP_EOL);
                fwrite($file, 'define("CONFIGDIRECTORIO", "' . $eldirectorio . '");' . PHP_EOL);
                fwrite($file, 'define("CONFIGPUERTO", "' . $elpuerto . '");' . PHP_EOL);
                fwrite($file, 'define("CONFIGRAM", "' . $laram . '");' . PHP_EOL);
                fwrite($file, 'define("CONFIGTIPOSERVER", "' . $eltiposerver . '");' . PHP_EOL);
                fwrite($file, 'define("CONFIGARCHIVOJAR", "' . $ellistadojars . '");' . PHP_EOL);
                fwrite($file, 'define("CONFIGEULAMINECRAFT", "' . $eleulaminecraft . '");' . PHP_EOL);
                fwrite($file, 'define("CONFIGMAXUPLOAD", "' . $elmaxupload . '");' . PHP_EOL);
                fwrite($file, 'define("CONFIGOPTIONGARBAGE", "' . $elgarbagecolector . '");' . PHP_EOL);
                fwrite($file, 'define("CONFIGOPTIONFORCEUPGRADE", "' . $elforseupgrade . '");' . PHP_EOL);
                fwrite($file, 'define("CONFIGOPTIONERASECACHE", "' . $elerasecache . '");' . PHP_EOL);
                fwrite($file, "?>" . PHP_EOL);
                fclose($file);

                //SI HAY PERMISOS ESCRITURA EN RAIZ
                $rutaraiz = dirname(getcwd()) . PHP_EOL;
                $rutaraiz = trim($rutaraiz);

                if (is_writable($rutaraiz)) {
                    //COMPROVAR SI EXISTE LA CARPETA MINECRAFT
                    $elnombredirectorio = CONFIGDIRECTORIO;
                    $rutacarpetamine = dirname(getcwd()) . PHP_EOL;
                    $rutacarpetamine = trim($rutacarpetamine);
                    $rutacarpetamine .= "/" . $elnombredirectorio;

                    if (!file_exists($rutacarpetamine)) {
                        //SI NO EXISTE, CREARLA
                        mkdir("$rutacarpetamine", 0700);
                        //devuelve 1 si la ha creado
                    }

                    //DOBLE SI EXISTE MINECRAFT
                    if (file_exists($rutacarpetamine)) {
                        //GUARDAR EULA.TXT
                        $rutaescrivir = $rutacarpetamine;
                        $rutaescrivir .= "/eula.txt";

                        $file = fopen($rutaescrivir, "w");
                        fwrite($file, "eula=true" . PHP_EOL);
                        fclose($file);
                    }
                }

                $retorno = "ok";
            } else {
                $retorno = "no";
            }
        } else {
            $retorno = "no";
        }

        echo $retorno;
    }
}
