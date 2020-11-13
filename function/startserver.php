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

    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pstatusstarserver', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pstatusstarserver'] == 1) {

        if (isset($_POST['action']) && !empty($_POST['action'])) {

            $retorno = "";
            $elerror = 0;

            $reccarpmine = CONFIGDIRECTORIO;
            $recarchivojar = CONFIGARCHIVOJAR;
            $recram = CONFIGRAM;
            $rectiposerv = CONFIGTIPOSERVER;
            $receulaminecraft = CONFIGEULAMINECRAFT;
            $recpuerto = CONFIGPUERTO;

            $recgarbagecolector = CONFIGOPTIONGARBAGE;
            $recforseupgrade = CONFIGOPTIONFORCEUPGRADE;
            $recerasecache = CONFIGOPTIONERASECACHE;

            $rutacarpetamine = "";

            //VARIABLE RUTA SERVIDOR MINECRAFT
            $rutacarpetamine = dirname(getcwd()) . PHP_EOL;
            $rutacarpetamine = trim($rutacarpetamine);
            $rutacarpetamine .= "/" . $reccarpmine;

            //VARIABLE RUTA CARPETA CONFIG
            $rutacarpetaconfig = dirname(getcwd()) . PHP_EOL;
            $rutacarpetaconfig = trim($rutacarpetaconfig);
            $rutacarpetaconfig .= "/config";

            //VARIABLE RUTA SERVERPROPERTIES.TXT
            $rutaconfigproperties = $rutacarpetaconfig . "/serverproperties.txt";

            //VERIFICAR CARPETA MINECRAFT
            if ($elerror == 0) {
                clearstatcache();
                if (!file_exists($rutacarpetamine)) {
                    $elerror = 1;
                    $retorno = "noexistecarpetaminecraft";
                }
            }

            //VERIFICAR SI HAY PERMISOS DE LECTURA EN EL SERVIDOR MINECRAFT
            if ($elerror == 0) {
                clearstatcache();
                if (!is_readable($rutacarpetamine)) {
                    $elerror = 1;
                    $retorno = "nolecturamine";
                }
            }

            //VERIFICAR SI HAY ESCRITURA EN EL SERVIDOR MINECRAFT
            if ($elerror == 0) {
                clearstatcache();
                if (!is_writable($rutacarpetamine)) {
                    $elerror = 1;
                    $retorno = "noescritura";
                }
            }

            //VERIFICAR SI HAY PERMISOS DE EJECUCION EN EL SERVIDOR MINECRAFT
            if ($elerror == 0) {
                clearstatcache();
                if (!is_executable($rutacarpetamine)) {
                    $elerror = 1;
                    $retorno = "noejecutable";
                }
            }

            //VERIFICAR SI HAY ESCRITURA EN CARPETA CONFIG
            if ($elerror == 0) {
                clearstatcache();
                if (!is_writable($rutacarpetaconfig)) {
                    $elerror = 1;
                    $retorno = "noconfigwrite";
                }
            }

            //VERIFICAR SI EXISTE ARCHIVO /CONFIG/SERVERPROPERTIES
            if ($elerror == 0) {
                if (!file_exists($rutaconfigproperties)) {
                    $elerror = 1;
                    $retorno = "noserverpropertiestxt";
                }
            }

            //VERIFICAR SI HAY ESCRITURA EN ARCHIVO /CONFIG/SERVERPROPERTIES
            if ($elerror == 0) {
                clearstatcache();
                if (!is_writable($rutaconfigproperties)) {
                    $elerror = 1;
                    $retorno = "noconfservpropergwrite";
                }
            }

            //VERIFICAR EULA EN CONFIG
            if ($elerror == 0) {
                if ($receulaminecraft == "") {
                    $elerror = 1;
                    $retorno = "noeula";
                }
            }

            //CREAR EULA FORZADO
            if ($elerror == 0) {
                if ($receulaminecraft == "1") {
                    $rutaescrivir = $rutacarpetamine;
                    $rutaescrivir .= "/eula.txt";

                    clearstatcache();
                    if (file_exists($rutaescrivir)) {
                        clearstatcache();
                        if (is_writable($rutaconfigproperties)) {
                            $file = fopen($rutaescrivir, "w");
                            fwrite($file, "eula=true" . PHP_EOL);
                            fclose($file);
                        } else {
                            $retorno = "eulanowrite";
                            $elerror = 1;
                        }
                    } else {
                        $file = fopen($rutaescrivir, "w");
                        fwrite($file, "eula=true" . PHP_EOL);
                        fclose($file);
                    }
                }
            }

            //VERIFICAR SI HAY NOMBRE.JAR
            if ($elerror == 0) {
                if ($recarchivojar == "") {
                    $elerror = 1;
                    $retorno = "noconfjar";
                }
            }

            //VERIFICAR SI EXISTE REALMENTE
            if ($elerror == 0) {
                $rutajar = $rutacarpetamine . "/" . $reccarpmine . "/" . $recarchivojar;

                clearstatcache();
                if (!file_exists($rutacarpetamine)) {
                    $elerror = 1;
                    $retorno = "noexistejar";
                }
            }

            //COMPROVAR PUERTO EN USO
            if ($elerror == 0) {
                $comandopuerto = "netstat -tulpn 2>/dev/null | grep :" . $recpuerto;
                $obtener = exec($comandopuerto);
                if ($obtener != "") {
                    $elerror = 1;
                    $retorno = "puertoenuso";
                }
            }

            //COMPROVAR SERVER.PROPERTIES
            if ($elerror == 0) {
                $rutacarpetamine = dirname(getcwd()) . PHP_EOL;
                $rutacarpetamine = trim($rutacarpetamine);
                $rutatemp = $rutacarpetamine;
                $rutafinal = $rutacarpetamine;
                $rutacarpetamine .= "/config/serverproperties.txt";
                $rutatemp .= "/config/serverproperties.tmp";
                $rutafinal .= "/" . $reccarpmine . "/server.properties";

                $gestor = @fopen($rutacarpetamine, "r");
                $file = fopen($rutatemp, "w");

                while (($búfer = fgets($gestor, 4096)) !== false) {
                    $str = $búfer;
                    $array = explode("=", $str);

                    if ($array[0] == "server-port") {
                        fwrite($file, 'server-port=' . $recpuerto . PHP_EOL);
                    } else {
                        fwrite($file, $búfer);
                    }
                }

                if (!feof($gestor)) {
                    $elerror = 1;
                    $retorno = "fallofgets";
                }

                fclose($gestor);
                fclose($file);
                unlink($rutacarpetamine);
                rename($rutatemp, $rutacarpetamine);
                copy($rutacarpetamine, $rutafinal);
            }

            //INSERTAR SERVER-ICON EN CASO QUE NO EXISTA
            if ($elerror == 0) {
                $rutacarpetamine = dirname(getcwd()) . PHP_EOL;
                $rutacarpetamine = trim($rutacarpetamine);

                $rutaiconoimg = $rutacarpetamine . "/img/server-icon.png";
                $rutaiconofinal = $rutacarpetamine . "/" . $reccarpmine . "/server-icon.png";
                $rutacarpetamine .= "/" . $reccarpmine;

                //COMPROVAR SI EXISTE EN CARPETA IMG Y COPIARLA EN CASO QUE EL SERVIDOR NO LA TENGA
                clearstatcache();
                if (file_exists($rutaiconoimg)) {
                    clearstatcache();
                    if (!file_exists($rutaiconofinal)) {
                        copy($rutaiconoimg, $rutaiconofinal);
                    }
                }
            }

            //INICIAR SERVIDOR
            if ($elerror == 0) {
                $comandoserver = "";

                $rutacarpetamine = dirname(getcwd()) . PHP_EOL;
                $rutacarpetamine = trim($rutacarpetamine);
                $rutacarpetamine .= "/" . $reccarpmine . "/" . $recarchivojar;

                $inigc = "";
                $iniforceupg = "";
                $inieracecache = "";

                if ($recgarbagecolector == "1") {
                    $inigc = "-XX:+UseConcMarkSweepGC";
                } elseif ($recgarbagecolector == "2") {
                    $inigc = "-XX:+UseG1GC";
                }

                if ($recforseupgrade == "1") {
                    $iniforceupg = "--forceUpgrade";
                }

                if ($recerasecache == "1") {
                    $inieracecache = "--eraseCache";
                }

                if ($rectiposerv == "vanilla") {
                    $comandoserver .= "cd .. && cd " . $reccarpmine . " && umask 002 && screen -dmS " . $reccarpmine . " java -Xms1G -Xmx" . $recram . "G " . $inigc . " -jar '" . $rutacarpetamine . "' " . $iniforceupg . " " . $inieracecache . " nogui";
                } elseif ($rectiposerv == "spigot") {
                    //shell_exec('cd minecraft1 && screen -dmS minecraft1 java -Xms1G -Xmx8G -XX:+UseConcMarkSweepGC -Djline.terminal=jline.UnsupportedTerminal -Dfile.encoding=UTF8 -jar /var/www/mineadmin/minecraft1/server.jar nogui -nojline --log-strip-color');
                    $comandoserver .= "cd .. && cd " . $reccarpmine . " && umask 002 && screen -dmS " . $reccarpmine . " java -Xms1G -Xmx" . $recram . "G " . $inigc . " -Djline.terminal=jline.UnsupportedTerminal -Dfile.encoding=UTF8 -jar '" . $rutacarpetamine . "' " . $iniforceupg . " " . $inieracecache . " nogui -nojline --log-strip-color";
                } elseif ($rectiposerv == "paper") {
                    $comandoserver .= "cd .. && cd " . $reccarpmine . " && umask 002 && screen -dmS " . $reccarpmine . " java -Xms1G -Xmx" . $recram . "G " . $inigc . " -jar '" . $rutacarpetamine . "' " . $iniforceupg . " " . $inieracecache . " nogui";
                } elseif ($rectiposerv == "otros") {
                    $comandoserver .= "cd .. && cd " . $reccarpmine . " && umask 002 && screen -dmS " . $reccarpmine . " java -Xms1G -Xmx" . $recram . "G " . $inigc . " -jar '" . $rutacarpetamine . "' " . $iniforceupg . " " . $inieracecache . " nogui";
                }


                $elpid = shell_exec($comandoserver);
                $retorno = "ok";
            }
            echo $retorno;
        }
    }
}
