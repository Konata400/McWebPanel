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

  if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pconsolaenviar', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pconsolaenviar'] == 1) {

    if (isset($_POST['action']) && !empty($_POST['action'])) {

      $retorno = "";
      $elcomando = "";
      $dirconfig = "";
      $elnombrescreen = "";
      $elpid = "";
      $laejecucion = "";
      $paraejecutar = "";
      $permcomando = "";
      $elerror = 0;

      $paraejecutar = addslashes($_POST['action']);

      //OBTENER PID SABER SI ESTA EN EJECUCION
      $elnombrescreen = CONFIGDIRECTORIO;
      $elcomando = "screen -ls | awk '/\." . $elnombrescreen . "\t/ {print strtonum($1)'}";
      $elpid = shell_exec($elcomando);

      if ($elerror == 0) {
        if (strlen($paraejecutar) > 4096) {
          $elerror = 1;
          $retorno = "lenmax";
        }
      }

      if ($elerror == 0) {
        $buscar = preg_match('/[\^][a-zA-Z]/', $paraejecutar);
        if ($buscar >= 1) {
          $retorno = "badchars";
          $elerror = 1;
        }
      }


      if ($elerror == 0) {
        //SI ESTA EN EJECUCION ENVIAR COMANDO
        if (!$elpid == "") {
          $laejecucion = 'screen -S ' . $elnombrescreen . ' -X stuff "' . trim($paraejecutar) . '^M"';
          shell_exec($laejecucion);
          $retorno = "ok";
        } else {
          $retorno = "off";
        }
      }
      echo $retorno;
    }
  }
}
