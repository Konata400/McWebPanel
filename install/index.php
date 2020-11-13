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

header("Content-Security-Policy: default-src 'self'; script-src 'self'; child-src 'none'; object-src 'none'; frame-ancestors 'none'");
header('X-Content-Type-Options: nosniff');
header('Strict-Transport-Security: max-age=63072000; includeSubDomains; preload');

require_once("../template/errorreport.php");

function buscarmodulo($modulo)
{
  $getmodules = "";
  $getmodules = Apache_get_modules();

  for ($a = 0; $a < count($getmodules); $a++) {

    if ($getmodules[$a] == $modulo) {
      return true;
    }
  }
  return false;
}

?>

<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="Referrer-Policy" content="no-referrer, strict-origin-when-cross-origin">
  <meta name="robots" content="noindex, nofollow">
  <meta http-equiv="cache-control" content="no-cache">
  <meta name="description" content="Instalador">
  <meta name="author" content="Konata400">
  <title>McWebPanel Install</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">

  <!-- Script AJAX -->
  <script src="../js/jquery.min.js"></script>

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="../img/icons/apple-icon-180x180.png" sizes="180x180">
  <link rel="icon" href="../img/icons/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="../img/icons/favicon-16x16.png" sizes="16x16" type="image/png">
  <link rel="icon" href="../img/icons/favicon.ico">
</head>
<?php

//CARGAR VARIABLES
$losrequisitos = 0;
$comreq = "";
$permisos = "";
$estamodulo = "";

?>

<body>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="py-1">
            <div class="container">
              <div class="row">
                <div class="col-md-3"><img class="d-block float-right" src="logo.png" alt="Logo"></div>
                <div class="col-md-9">
                  <h1 class="display-4 text-left">McWebPanel (Instalacíon)</h1>
                </div>
              </div>
              <hr>
            </div>
          </div>
          <br>
          <h4 class="mb-4 text-left">Requisitos del sistema</h4>
          <div class="table-responsive">
            <table class="table table-borderless table-striped">
              <thead>
                <tr>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-center">PHP comando Shell_exec</td>
                  <td></td>

                  <?php

                  //REQUISITO SHELL_EXEC
                  if (function_exists('shell_exec')) {
                    echo '<td class="text-success">Activado - SI</td>';
                  } else {
                    echo '<td class="text-danger">Activado - NO</td></tr></tbody></table><div class="alert alert-danger" role="alert">La instalación no puede continuar.</div>';
                    exit;
                  }

                  ?>

                </tr>
                <tr>
                  <td class="text-center">Maquina Virtual Java</td>
                  <td></td>

                  <?php

                  //REQUISITO JAVA
                  $comreq = shell_exec('command -v java >/dev/null && echo "yes" || echo "no"');
                  $comreq = trim($comreq);
                  if ($comreq == "no") {
                    $losrequisitos = 1;
                    echo '<td class="text-danger">Instalado - NO</td>';
                  } elseif ($comreq == "yes") {
                    echo '<td class="text-success">Instalado - SI</td>';
                  }

                  ?>

                </tr>
                <tr>
                  <td class="text-center">GNU Screen</td>
                  <td></td>

                  <?php

                  //REQUISITO SCREEN
                  $comreq = shell_exec('command -v screen >/dev/null && echo "yes" || echo "no"');
                  $comreq = trim($comreq);
                  if ($comreq == "no") {
                    $losrequisitos = 1;
                    echo '<td class="text-danger">Instalado - NO</td>';
                  } elseif ($comreq == "yes") {
                    echo '<td class="text-success">Instalado - SI</td>';
                  }

                  ?>

                </tr>
                <tr>
                  <td class="text-center">Extensión PHP mbstring</td>
                  <td></td>

                  <?php

                  //REQUISITO MBSTRING
                  if (!extension_loaded('mbstring')) {
                    $losrequisitos = 1;
                    echo '<td class="text-danger">Instalado - NO</td>';
                  } else {
                    echo '<td class="text-success">Instalado - SI</td>';
                  }

                  ?>
                </tr>

                <tr>
                  <td class="text-center">Extensión PHP ZIP</td>
                  <td></td>

                  <?php

                  //REQUISITO phpzip
                  if (!extension_loaded('zip')) {
                    $losrequisitos = 1;
                    echo '<td class="text-danger">Instalado - NO</td>';
                  } else {
                    echo '<td class="text-success">Instalado - SI</td>';
                  }

                  ?>
                </tr>

                <tr>
                  <td class="text-center">PHP CLI</td>
                  <td></td>

                  <?php

                  //PHP CLI
                  $comreq = shell_exec('command -v php -v >/dev/null && echo "yes" || echo "no"');
                  $comreq = trim($comreq);
                  if ($comreq == "no") {
                    $losrequisitos = 1;
                    echo '<td class="text-danger">Instalado - NO</td>';
                  } elseif ($comreq == "yes") {
                    echo '<td class="text-success">Instalado - SI</td>';
                  }

                  ?>

                </tr>

                <tr>
                  <td class="text-center">Apache mod_rewrite</td>
                  <td></td>

                  <?php

                  //REQUISITO MOD_REWRITE
                  $estamodulo = buscarmodulo("mod_rewrite");

                  if ($estamodulo == 1) {
                    echo '<td class="text-success">Activado - SI</td>';
                  } else {
                    echo '<td class="text-danger">No activado - NO</td>';
                    $losrequisitos = 1;
                  }

                  ?>

                </tr>

                <tr>
                  <td class="text-center">Carpeta install permisos escritura</td>
                  <td></td>

                  <?php

                  //PERMISOS CARPETA INSTALL
                  $permisos = getcwd() . PHP_EOL;
                  $permisos = trim($permisos);
                  if (is_writable($permisos)) {
                    echo '<td class="text-success">Escritura - SI</td>';
                  } else {
                    echo '<td class="text-danger">Escritura - NO</td>';
                    $losrequisitos = 1;
                  }
                  ?>

                </tr>
              </tbody>
            </table>
          </div>


          <form action="<?php if ($losrequisitos == 0) {
                          echo 'install2.php';
                        } ?>" method="POST" id="login-install">
            <?php
            if ($losrequisitos == 1) {
              echo '<button type="submit" class="btn btn-primary btn-block disabled">No cumples los requisitos para continuar la instalación.</button>';
            } elseif ($losrequisitos == 0) {
              echo '<button type="submit" class="btn btn-primary btn-block">Continuar Instalación</button>';
            }

            ?>
            <br>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>

</html>