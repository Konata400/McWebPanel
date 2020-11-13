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

//EN CASO DE TENER UN DOMINIO O SUBDOMINIO CAMBIAR LA VARIABLE $dominio
//EJEMPLOS

//$dominio = ".eldominio.com"

//$dominio = ".subdominio.eldominio.com"

$dominio = "";

if (PHP_VERSION_ID < 70300) {
  //VERSION ANTIGUA A 7.3
  if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
    //SI ES HTTPS
    session_set_cookie_params(3600, '/', $dominio, true, true);
  } else {
    //SI ES HTTP
    session_set_cookie_params(3600, '/', $dominio, false, true);
  }
} else {
  //version mas moderna soporte samesite
  if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
    //SI ES HTTPS
    session_set_cookie_params(3600, '/', $dominio, true, true);
    ini_set('session.cookie_samesite', "Strict");
  } else {
    //SI ES HTTP
    session_set_cookie_params(3600, '/', $dominio, false, true);
    ini_set('session.cookie_samesite', "Strict");
  }
}

session_start();

if (isset($_SESSION['IDENTIFICARSESSION'])) {
  $rutanofunction = getcwd();
  $rutanofunction = trim($rutanofunction);
  $rutanofunction .= "/config/confopciones.php";

  $rutasifunction = dirname(getcwd()) . PHP_EOL;
  $rutasifunction = trim($rutasifunction);
  $rutasifunction .= "/config/confopciones.php";

  if (file_exists($rutanofunction)) {
    require_once("config/confopciones.php");
  } else {
    if (file_exists($rutasifunction)) {
      require_once("../config/confopciones.php");
    }
  }

  $getconflakey = "";

  if (defined('CONFIGSESSIONKEY')) {
    $getconflakey = CONFIGSESSIONKEY;
  }

  if ($getconflakey != $_SESSION['IDENTIFICARSESSION']) {
    echo '<div class="alert alert-danger" role="alert">Tu sesión no pertenece a este panel, elimina la sesión y vuelve a intentar</div>';
    exit;
  }
}

unset($dominio);
unset($getconflakey);
