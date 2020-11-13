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

$RUTAPRINCIPAL = $_SERVER['PHP_SELF'];
$RUTAPRINCIPAL = substr($RUTAPRINCIPAL, 0, -14);
$RUTACONFIG = $RUTAPRINCIPAL . "/config/confopciones.php";

require_once($RUTACONFIG);

$elerror = 0;
$time = date("G:i");
$mesactual = date('n');
$semanactual = date('N');
$horactual = date('G');
$minutoactual = date('i');

//OBTENER RUTA CONFIG
$rutaarchivo = $RUTAPRINCIPAL;
$rutaarchivo = trim($rutaarchivo);
$rutaarchivo .= "/config";

$elarchivo = $rutaarchivo;
$elarchivo .= "/array.json";

//COMPROVAR SI EXISTE CARPETA CONFIG
if ($elerror == 0) {
    if (!file_exists($rutaarchivo)) {
        $elerror = 1;
    }
}

//COMPROVAR SI CONFIG TIENE PERMISOS DE LECTURA
if ($elerror == 0) {
    if (!is_readable($rutaarchivo)) {
        $elerror = 1;
    }
}

//COMPROVAR SI CONFIG TIENE PERMISOS DE ESCRITURA
if ($elerror == 0) {
    if (!is_writable($rutaarchivo)) {
        $elerror = 1;
    }
}

if ($elerror == 0) {
    clearstatcache();
    if (file_exists($elarchivo)) {

        //COMPROVAR SI SE PUEDE LEER EL JSON
        if ($elerror == 0) {
            if (!is_readable($elarchivo)) {
                $elerror = 1;
            }
        }

        //COMPROVAR SI SE PUEDE ESCRIVIR EL JSON
        if ($elerror == 0) {
            if (!is_writable($elarchivo)) {
                $elerror = 1;
            }
        }

        if ($elerror == 0) {
            //LEER FICHERO OBTENER ARRAY
            $getarray = file_get_contents($elarchivo);
            $arrayobtenido = unserialize($getarray);

            $elindice = count($arrayobtenido);

            for ($i = 0; $i < $elindice; $i++) {
                if ($arrayobtenido[$i]['estado'] == "activado") {
                    for ($a = 0; $a < 12; $a++) {
                        if ($arrayobtenido[$i][$a]['mes'] == $mesactual) {
                            for ($b = 0; $b < 7; $b++) {
                                if ($arrayobtenido[$i][$b]['semana'] == $semanactual) {
                                    for ($c = 0; $c < 24; $c++) {
                                        if ($arrayobtenido[$i][$c]['hora'] == $horactual) {
                                            for ($d = 0; $d < 60; $d++) {
                                                if ($arrayobtenido[$i][$d]['minuto'] == $minutoactual) {
                                                    //TAREA VALIDA PROCEDER A LA EJECUCION
                                                    $tarea = $arrayobtenido[$i]['accion'];
                                                    //echo "DENTRO";

                                                    switch ($tarea) {
                                                        case "acc1":
                                                            //APAGAR SERVIDOR

                                                            //OBTENER PID SABER SI ESTA EN EJECUCION
                                                            $elcomando = "";
                                                            $elnombrescreen = CONFIGDIRECTORIO;
                                                            $elcomando = "screen -ls | awk '/\." . $elnombrescreen . "\t/ {print strtonum($1)'}";
                                                            $elpid = shell_exec($elcomando);

                                                            //SI ESTA EN EJECUCION ENVIAR COMANDO APAGAR
                                                            if (!$elpid == "") {
                                                                $paraejecutar = "stop";
                                                                $laejecucion = 'screen -S ' . $elnombrescreen . ' -X stuff "' . $paraejecutar . '\\015"';
                                                                shell_exec($laejecucion);

                                                                //PERFMISOS FTP
                                                                $dirconfig = $RUTAPRINCIPAL;
                                                                $dirconfig = trim($dirconfig);
                                                                $dirconfig .= "/" . $elnombrescreen;

                                                                $permcomando = "cd '" . $dirconfig . "' && find . -type d -print0 | xargs -0 -I {} chmod 775 {}";
                                                                exec($permcomando);
                                                                $permcomando = "cd '" . $dirconfig . "' && find . -type f -print0 | xargs -0 -I {} chmod 664 {}";
                                                                exec($permcomando);
                                                            }

                                                            break;
                                                        case "acc2":
                                                            //INICIAR SERVIDOR

                                                            //OBTENER PID SABER SI ESTA EN EJECUCION
                                                            $elcomando = "";
                                                            $elnombrescreen = CONFIGDIRECTORIO;
                                                            $elcomando = "screen -ls | awk '/\." . $elnombrescreen . "\t/ {print strtonum($1)'}";
                                                            $elpid = shell_exec($elcomando);

                                                            if ($elpid == "") {

                                                                $retorno = "";
                                                                $elerror = 0;

                                                                $reccarpmine = CONFIGDIRECTORIO;
                                                                $recarchivojar = CONFIGARCHIVOJAR;
                                                                $recram = CONFIGRAM;
                                                                $rectiposerv = CONFIGTIPOSERVER;
                                                                $receulaminecraft = CONFIGEULAMINECRAFT;
                                                                $recpuerto = CONFIGPUERTO;

                                                                $rutacarpetamine = "";

                                                                //VERIFICAR CARPETA MINECRAFT
                                                                $rutacarpetamine = $RUTAPRINCIPAL;
                                                                $rutacarpetamine = trim($rutacarpetamine);
                                                                $rutacarpetamine .= "/" . $reccarpmine;

                                                                //VARIABLE RUTA CARPETA CONFIG
                                                                $rutacarpetaconfig = $RUTAPRINCIPAL;
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

                                                                //VERIFICAR EULA
                                                                if ($elerror == 0) {
                                                                    if ($receulaminecraft == "") {
                                                                        $retorno = "no hay eula";
                                                                        $elerror = 1;
                                                                    }
                                                                }

                                                                //VERIFICAR EULA
                                                                if ($elerror == 0) {
                                                                    if ($receulaminecraft == "") {
                                                                        $elerror = 1;
                                                                        $retorno = "noeula";
                                                                    } elseif ($receulaminecraft == "1") {
                                                                        $rutaescrivir = $rutacarpetamine;
                                                                        $rutaescrivir .= "/eula.txt";

                                                                        $file = fopen($rutaescrivir, "w");
                                                                        fwrite($file, "eula=true" . PHP_EOL);
                                                                        fclose($file);
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
                                                                        $retorno = "no puerto";
                                                                        $elerror = 1;
                                                                    }
                                                                }

                                                                //COMPROVAR SERVER.PROPERTIES
                                                                if ($elerror == 0) {
                                                                    $rutacarpetamine = $RUTAPRINCIPAL;
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
                                                                    }

                                                                    fclose($gestor);
                                                                    fclose($file);
                                                                    unlink($rutacarpetamine);
                                                                    rename($rutatemp, $rutacarpetamine);
                                                                    copy($rutacarpetamine, $rutafinal);
                                                                }

                                                                //INSERTAR SERVER-ICON EN CASO QUE NO EXISTA
                                                                if ($elerror == 0) {
                                                                    $rutacarpetamine = $RUTAPRINCIPAL;
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

                                                                    $rutacarpetamine = $RUTAPRINCIPAL;
                                                                    $rutacarpetamine = trim($rutacarpetamine);
                                                                    $rutacarpetamine .= "/" . $reccarpmine . "/" . $recarchivojar;

                                                                    if ($rectiposerv == "vanilla") {
                                                                        $comandoserver .= "cd " . $RUTAPRINCIPAL . " && cd " . $reccarpmine . " && umask 002 && screen -dmS " . $reccarpmine . " java -Xms1G -Xmx" . $recram . "G -jar '" . $rutacarpetamine . "' nogui";
                                                                    } elseif ($rectiposerv == "spigot") {
                                                                        $comandoserver .= "cd " . $RUTAPRINCIPAL . " && cd " . $reccarpmine . " && umask 002 && screen -dmS " . $reccarpmine . " java -Xms1G -Xmx" . $recram . "G -XX:+UseConcMarkSweepGC -Djline.terminal=jline.UnsupportedTerminal -Dfile.encoding=UTF8 -jar '" . $rutacarpetamine . "' nogui -nojline --log-strip-color";
                                                                    } elseif ($rectiposerv == "paper") {
                                                                        $comandoserver .= "cd " . $RUTAPRINCIPAL . " && cd " . $reccarpmine . " && umask 002 && screen -dmS " . $reccarpmine . " java -Xms1G -Xmx" . $recram . "G -jar '" . $rutacarpetamine . "' nogui";
                                                                    } elseif ($rectiposerv == "otros") {
                                                                        $comandoserver .= "cd " . $RUTAPRINCIPAL . " && cd " . $reccarpmine . " && umask 002 && screen -dmS " . $reccarpmine . " java -Xms1G -Xmx" . $recram . "G -jar '" . $rutacarpetamine . "' nogui";
                                                                    }
                                                                    $elpid = shell_exec($comandoserver);
                                                                }
                                                            }

                                                            break;
                                                        case "acc3":
                                                            //BACKUP SERVIDOR

                                                            $reccarpmine = CONFIGDIRECTORIO;

                                                            $archivo = "AUTOMATICO";

                                                            $dirconfig = "";
                                                            $dirconfig = $RUTAPRINCIPAL;
                                                            $dirconfig = trim($dirconfig);
                                                            $dirconfig .= "/backups";

                                                            if (file_exists($dirconfig)) {
                                                                //COMPROVAR SI SE PUEDE ESCRIVIR
                                                                if (is_writable($dirconfig)) {
                                                                    $rutaarchivo = $RUTAPRINCIPAL;
                                                                    $rutaarchivo = trim($rutaarchivo);
                                                                    $rutaminelimpia = $rutaarchivo . "/" . $reccarpmine;
                                                                    if (is_readable($rutaminelimpia)) {
                                                                        $rutaarchivo .= "/" . $reccarpmine . "/ .";
                                                                        $dirconfig = $dirconfig . "/" . $archivo . "-";
                                                                        $t = date("Y-m-d-G:i:s");
                                                                        $elcomando = "tar -czvf " . $dirconfig . $t . ".tar.gz -C " . $rutaarchivo;
                                                                        if (is_executable($rutaminelimpia)) {
                                                                            exec($elcomando, $out, $oky);

                                                                            if (!$oky) {
                                                                            } else {

                                                                                //AUNQUE NO SE CREA, A VECES SI CREA UN FICHERO VACIO
                                                                                $borrarerror = $dirconfig . $t . ".tar.gz";
                                                                                if (file_exists($borrarerror)) {
                                                                                    unlink($borrarerror);
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }

                                                            break;
                                                        case "acc4":
                                                            //ENVIAR COMANDO

                                                            $paraejecutar = addslashes($arrayobtenido[$i]['comando']);

                                                            //OBTENER PID SABER SI ESTA EN EJECUCION
                                                            $elcomando = "";
                                                            $elnombrescreen = CONFIGDIRECTORIO;
                                                            $elcomando = "screen -ls | awk '/\." . $elnombrescreen . "\t/ {print strtonum($1)'}";
                                                            $elpid = shell_exec($elcomando);

                                                            //SI ESTA EN EJECUCION ENVIAR COMANDO
                                                            if (!$elpid == "") {
                                                                $laejecucion = 'screen -S ' . $elnombrescreen . ' -X stuff "' . trim($paraejecutar) . '^M"';

                                                                shell_exec($laejecucion);

                                                                //PERFMISOS FTP
                                                                if (strtolower($paraejecutar) == "stop") {
                                                                    $dirconfig = $RUTAPRINCIPAL;
                                                                    $dirconfig = trim($dirconfig);
                                                                    $dirconfig .= "/" . $elnombrescreen;

                                                                    $permcomando = "cd '" . $dirconfig . "' && find . -type d -print0 | xargs -0 -I {} chmod 775 {}";
                                                                    exec($permcomando);
                                                                    $permcomando = "cd '" . $dirconfig . "' && find . -type f -print0 | xargs -0 -I {} chmod 664 {}";
                                                                    exec($permcomando);
                                                                }
                                                            }

                                                            break;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
